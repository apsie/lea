<?php
/**
 * Stylite: Group administration
 *
 * @link http://www.stylite.de
 * @package stylite
 * @subpackage filemanager
 * @author Ralf Becker <rb@stylite.de>
 * @copyright (c) 2014 by Ralf Becker <rb@stylite.de>
 * @version $Id: class.groups_admin.inc.php 3124 2014-06-26 08:24:18Z ralfbecker $
 */

/**
 * Stylite group administration:
 * - hooks into admin to add and edit groups
 */
class groups_admin
{
	/**
	 * Methods callable via menuaction
	 *
	 * @var array
	 */
	var $public_functions = array(
		'edit' => true,
	);

	/**
	 * Reference to global accounts object
	 *
	 * @var accounts
	 */
	protected $accounts;
	/**
	 * Reference to global acl class (instanciated for current user)
	 *
	 * @var acl
	 */
	protected $acl;

	/**
	 * Apps supporting (group) ACL
	 *
	 * @var type
	 */
	protected $apps_with_acl = array(
		'calendar'    => True,
		'infolog'     => True,
		'filemanager' => array(
			'menuaction' => 'filemanager.filemanager_ui.file',
			'path' => '/home/$account_lid',
			'tabs' => 'eacl',
			'popup' => '495x400',
		),
		'bookmarks'   => True,
		'phpbrain'    => True,
		'projectmanager' => True,
		'timesheet'   => True
	);

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->acl = $GLOBALS['egw']->acl;
		$this->accounts = $GLOBALS['egw']->accounts;

		foreach($GLOBALS['egw']->hooks->process('group_acl','',true) as $app => $data)
		{
			if ($data) $this->apps_with_acl[$app] = $data;
		}
		// we need admin translations
		translation::add_app('admin');
	}

	/**
	 * Edit / add a group
	 *
	 * @param array $content=null
	 */
	public function edit(array $content=null)
	{
		$sel_options = $readonlys = array();
		$tpl = new etemplate_new('groups.group.edit');
		egw_framework::validate_file('/groups/js/groupadmin.js');

		if (!is_array($content))
		{
			if (isset($_GET['account_id']))
			{
				// invalidate account, before reading it, to code with changed to DB or LDAP outside EGw
				accounts::cache_invalidate((int)$_GET['account_id']);
				if ($this->accounts->exists((int)$_GET['account_id']) != 2 ||	// 2 = group
					!($content = $this->accounts->read((int)$_GET['account_id'])))
				{
					egw_framework::window_close(lang('Entry not found!'));
				}
				if ($GLOBALS['egw']->acl->check('group_access', 8, 'admin'))	// no view
				{
					egw_framework::window_close(lang('Permission denied!'));
				}
				$content['account_members'] = array_keys($content['members']);
				unset($content['members']);
				$content['old'] = $content;
			}
			else
			{
				if ($GLOBALS['egw']->acl->check('group_access', 4, 'admin'))	// no add
				{
					egw_framework::window_close(lang('Permission denied!'));
				}
				$content = array();
			}
		}
		elseif($content['button'])
		{
			list($button) = each($content['button']);
			unset($content['button']);
			$msg = '';

			switch($button)
			{
				case 'apply':
				case 'save':
					try {
						$refresh_type = !$content['old'] ? 'add' : 'edit';
						// check if some account-data changed
						if (!$content['old'] || $content['old'] != array_intersect_key($content, $content['old']))
						{
							$cmd = new admin_cmd_edit_group($content['account_id'], $content);
							$msg = $cmd->run();
							$content['account_id'] = $cmd->account;
							$content['old'] = array_intersect_key($content, $content['old'] ? $content['old'] :
								array_flip(array('account_id','account_lid','account_email','account_members')));
						}
						$apps = array();
						foreach((array)$content['apps'] as $data)
						{
							if ($data['run']) $apps[] = $data['appname'];
						}
						//error_log(__METHOD__."() apps=".array2string($apps).", old=".array2string($content['old_run']).", content[apps]=".array2string($content['apps']));
						// check if new apps added
						if (($added = array_diff($apps, $content['old_run'])))
						{
							//error_log(__METHOD__."() apps added: ".array2string($added));
							$add_cmd = new admin_cmd_account_app(true, $content['account_id'], $added);
							$msg .= $add_cmd->run();
						}
						// check if apps being removed
						if (($removed = array_diff($content['old_run'], $apps)))
						{
							//error_log(__METHOD__."() apps removed: ".array2string($removed));
							$rm_cmd = new admin_cmd_account_app(false, $content['account_id'], $removed);
							$msg .= $rm_cmd->run();
						}
						$content['old_run'] = $apps;
					}
					catch (Exception $ex) {
						$msg .= $ex->getMessage();
						unset($button);	// do NOT close dialog
					}
					if (!$msg)
					{
						$msg = lang('Nothing to save.');
					}
					else
					{
						egw_framework::refresh_opener($msg, 'admin', $content['account_id'], $refresh_type, null, null, null,
							isset($ex) ? 'error' : 'success');
					}
					if ($button != 'save')
					{
						egw_framework::message($msg, isset($ex) ? 'error' : 'success');
						break;
					}
					egw_framework::window_close();
			}
		}
		$run_rights = $content['account_id'] ? $this->acl->get_user_applications($content['account_id'], false, false) : array();
		$content['apps'] = $content['old_run'] = array();
		foreach($GLOBALS['egw_info']['apps'] as $app => $data)
		{
			if (!$data['enabled'] || !$data['status'] || $data['status'] == 3)
			{
				continue;	// do NOT show disabled apps, or our API (status = 3)
			}

			$popup = null;
			$acl_action = $this->_acl_action($app, $content['account_id'], $content['account_lid'], $popup);

			$content['apps'][] = array(
				'appname' => $app,
				'title' => lang($app),
				'action' => $acl_action,
				'popup' => $popup,
				'run' => (int)(boolean)$run_rights[$app],
			);
			if ($run_rights[$app]) $content['old_run'][] = $app;
			$readonlys['apps']['button['.$app.']'] = !$acl_action;
		}
		usort($content['apps'], function($a, $b)
		{
			if ($a['run'] !== $b['run']) return $b['run']-$a['run'];
			return strcasecmp($a['title'], $b['title']);
		});

		$readonlys['button[delete]'] = !$content['account_id'] ||
			$GLOBALS['egw']->acl->check('group_access', 32, 'admin');	// no delete
		if ($GLOBALS['egw']->acl->check('group_access', $content['account_id'] ? 16 : 4, 'admin'))	// no edit / add
		{
			$readonlys['button[save]'] = $readonlys['button[apply]'] = true;
		}
		$tpl->exec('groups.groups_admin.edit', $content, $sel_options, $readonlys, $content, 2);
	}

	/**
	 * Check entered data and return error-msg via json data or null
	 *
	 * @param array $data values for account_id and account_lid
	 */
	public static function ajax_check(array $data)
	{
		// set dummy member to get no error about no members yet
		$data['account_members'] = array($GLOBALS['egw_info']['user']['account_id']);

		try {
			$cmd = new admin_cmd_edit_group($data['account_id'], $data);
			$cmd->run(null, false, false, true);
		}
		catch(Exception $e)
		{
			egw_json_response::get()->data($e->getMessage());
		}
	}

	/**
	 * Return actions for groups
	 *
	 * @param string|array $location
	 */
	public static function actions($location)
	{
		unset($location);	// unused, but required by hooks signature

		return array(
			array(
				'id' => 'groups_admin_edit',
				'caption' => 'Edit group',
				'icon' => 'edit',
				'popup' => '600x400',
				'url' => 'menuaction=groups.groups_admin.edit&account_id=$id',
				'group' => 2,
			),
			array(
				'id' => 'groups_admin_add',
				'caption' => 'Add group',
				'icon' => 'new',
				'popup' => '600x400',
				'url' => 'menuaction=groups.groups_admin.edit',
				'group' => 2,
				'enableId' => '',
			),
			array(
				'id' => 'delete',
				'caption' => 'Delete',
				'icon' => 'delete',
				'confirm' => 'Delete this group',
				'group' => 99,
			)
		);
	}

	/**
	 * Check if app uses group ACL
	 *
	 * @param string $app
	 * @param int $account_id
	 * @param string $account_lid
	 * @param string &$popup on return $width.'x'.$height or null
	 * @return boolean|string false or link for action
	 */
	private function _acl_action($app, $account_id, $account_lid, &$popup)
	{
		if (!($acl_action = $this->apps_with_acl[$app]) || !$account_id)
		{
			return false;
		}
		if ($acl_action === true)
		{
			return true;
		}
		$replacements = array(
			'$app' => $app,
			'$account_id' => $account_id,
			'$account_lid' => $account_lid,
		);
		foreach($acl_action as &$value)
		{
			$value = str_replace(array_keys($replacements), array_values($replacements), $value);
		}
		$popup = $acl_action['popup'];
		unset($acl_action['popup']);

		return egw::link('/index.php',$acl_action);
	}
}
