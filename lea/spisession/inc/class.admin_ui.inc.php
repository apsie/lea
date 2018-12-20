<?php
/**
 * spisession - Integrated Sessions Management Modules for eGroupware (trainings, meetings, etc.)
 * See About folder and www.spirea.fr for further information
 *
 * @link http://www.spirea.fr
 * @package spisession
 * @author Spirea SARL <contact@spirea.fr>
 * @copyright (c) 2012-december by Spirea +33141192772
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 */

require_once(EGW_INCLUDE_ROOT. '/spisession/inc/class.admin_bo.inc.php');

class admin_ui extends admin_bo{
	
	var $public_functions = array(
		'index'	=> true,
		'help' 	=> true,
		'mail' 	=> true,
	);
	
	
	function admin_ui(){
	/**
	 * Constructeur 
	 *
	 */
		parent::admin_bo();
		
		// Construction des droits - une seule fonction - dans class.acl_so.inc.php 
		$GLOBALS['egw_info']['user']['SpiSessionLevel'] = acl_so::get_spisession_level();
		// Gestion ACL - Simple utilisateur = Pas d'accès
		if ($GLOBALS['egw_info']['user']['SpiSessionLevel'] <= 10){
			$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied, please contact your administrator!!!')."</h1>\n",null,true);
			exit;
		}
		// Fin blocage au niveau du Constructeur 
		
	}

	function help($content = null){
	/**
	 * Charge le template aide
	 *
	 */ 
		$msg='';
		// Appuie sur un bouton (apply/save/cancel)
		if(is_array($content)){
			list($button) = @each($content['button']);
			switch($button){
				case 'save':
				case 'apply':
					$msg=$this->add_update_config($content);
					$GLOBALS['egw_info']['flags']['java_script'] .= "<script language=\"JavaScript\">
						var referer = opener.location;
						opener.location.href = referer+(referer.search?'&':'?')+'msg=".addslashes(urlencode($msg))."';</script>";
					break;
				default:
				case 'cancel':
					echo "<html><body><script>window.close();</script></body></html>\n";
					$GLOBALS['egw']->common->egw_exit();
					break;
			}
		}
		
		$content = $this->config;
		
		$tpl = new etemplate('spisession.admin.help');
		$tpl->exec('spisession.admin_ui.index', $content,$sel_options,$no_button, $content);
	}

	function mail($content = null){
	/**
	 * Charge le template mail
	 *
	 */ 
		$msg='';

		// Appuie sur un bouton (apply/save/cancel)
		if(is_array($content)){
			list($button) = @each($content['button']);
			switch($button){
				case 'save':
				case 'apply':
					$msg=$this->add_update_config($content);
					$GLOBALS['egw_info']['flags']['java_script'] .= "<script language=\"JavaScript\">
						var referer = opener.location;
						opener.location.href = referer+(referer.search?'&':'?')+'msg=".addslashes(urlencode($msg))."';</script>";
					break;
				default:
				case 'cancel':
					echo "<html><body><script>window.close();</script></body></html>\n";
					$GLOBALS['egw']->common->egw_exit();
					break;
			}
		}
		
		$content = $this->config;
		
		$tpl = new etemplate('spisession.admin.mail');
		$tpl->exec('spisession.admin_ui.index', $content,$sel_options,$no_button, $content);
	}
}
?>