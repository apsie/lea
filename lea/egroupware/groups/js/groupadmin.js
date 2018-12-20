/**
 * Stylite - Group-Admin - Javascript UI
 *
 * @link http://www.egroupware.org
 * @package filemanager
 * @author Ralf Becker <RalfBecker-AT-outdoor-training.de>
 * @copyright (c) 2014 by Ralf Becker <RalfBecker-AT-outdoor-training.de>
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 * @version $Id: groupadmin.js 3102 2014-06-16 20:55:55Z ralfbecker $
 */

/**
 * UI for Group-Admin
 *
 * Get only loaded in popup!
 *
 * @augments AppJS
 */
app.classes.groups = AppJS.extend(
/**
 * @lends app.classes.stylite
 */
{
	appname: 'groups',

	/**
	 * Constructor
	 *
	 * @memberOf app.classes.stylite
	 */
	init: function()
	{
		// call parent
		this._super.apply(this, arguments);
	},

	/**
	 * Destructor
	 */
	destroy: function()
	{
		// call parent
		this._super.apply(this, arguments);
	},

	/**
	 * This function is called when the etemplate2 object is loaded
	 * and ready.  If you must store a reference to the et2 object,
	 * make sure to clean it up in destroy().
	 *
	 * @param {etemplate2} _et2
	 * @param {string} _name name of template loaded
	 */
	et2_ready: function(_et2, _name)
	{
		// call parent
		this._super.apply(this, arguments);

		switch(_name)
		{
		}
	},

	/**
	 * ACL button clicked
	 *
	 * @param {jQuery.Event} _ev
	 * @param {et2_button} _widget
	 */
	acl: function(_ev, _widget)
	{
		var app = _widget.id.substr(7, _widget.id.length-8);	// button[appname]
		var apps = this.et2.getArrayMgr('content').data.apps;
		for(var i=0; i < apps.length; i++)
		{
			var data = apps[i];
			if (data.appname == app && data.action)
			{
				if (data.action === true)
				{
					data.action = this.egw.link('/index.php', {
						menuaction: 'admin.admin_acl.index',
						account_id: this.et2.getArrayMgr('content').data.account_id,
						acl_filter: 'other',
						acl_app: app
					});
					data.popup = '900x450';
				}
				egw(opener).open_link(data.action, data.popup ? '_blank' : '_self', data.popup);
				break;
			}
		}
	},

	/**
	 * Delete button clicked
	 *
	 * @param {jQuery.Event} _ev
	 * @param {et2_button} _widget
	 */
	delete: function(_ev, _widget)
	{
		var account_id = this.et2.getArrayMgr('content').data.account_id;
		var egw = this.egw;

		et2_dialog.show_dialog(function(button)
		{
			if (button == et2_dialog.YES_BUTTON)
			{
				egw.json('admin_account::ajax_delete_group', [account_id]).sendRequest(false);	// false = synchronious request
				window.close();
			}
		}, this.egw.lang('Delete this group')+'?');
	},

	/**
	 * Field changed, call server validation
	 *
	 * @param {jQuery.Event} _ev
	 * @param {et2_button} _widget
	 */
	change: function(_ev, _widget)
	{
		var account_id = this.et2.getArrayMgr('content').data.account_id;
		var data = {account_id: account_id};
		data[_widget.id] = _widget.getValue();

		this.egw.json('groups_admin::ajax_check', [data], function(_msg)
		{
			if (_msg)
			{
				egw(window).message(_msg, 'error');	// context get's lost :(
				_widget.getDOMNode().focus();
			}
		}, this).sendRequest();	// false = synchronious request
	}
});
