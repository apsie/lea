<?php
/* 
 * spidating 
 * SPIREA - 2013
 * Spirea - 16/20 avenue de l'agent Sarre
 * Tél : 0141192772
 * Email : contact@spirea.fr
 * www : www.spirea.fr
 * 
 * Propriété de Spirea
 * 
 * Logiciel SpiDating - Ce module est un programme informatique servant création en masse d'évènement de calendrier
 * 
 * Reproduction, utilisation ou modification interdite sans autorisation de Spirea
 */
require_once(EGW_INCLUDE_ROOT. '/spidating/inc/class.admin_bo.inc.php');

class spidating_admin extends admin_bo{
	
	var $public_functions = array(
		'index'	=> true,
		'help' 	=> true,
	);
	
	
	function spidating_admin(){
	/**
	 * Constructor
	 *
	 */
		parent::admin_bo();
	}
	
	function index($content = null){
	/**
	 * Charge le template index
	 *
	 */ 
		if(!array_key_exists('spireapi', $GLOBALS['egw_info']['apps'])){
			$content['cal_site'] = false;
			$content['hide_cal_site'] = true;
		}


		$msg='';
		if(is_array($content)){
			list($button) = @each($content['button']);
			switch($button){
				case 'save':
				case 'apply':
					$msg = $this->add_update_config($content);
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
		$content['spid'] = $this->spid_config;
		
		$sel_options = array(
			'default_cat_meeting' => array('' => lang('Select one')) + spidating_so::get_cal_cat(),
			'field_participant' => $this->get_cal_fields(),

			// 'default_cat' => array('' => lang('Select one')) + spidating_so::get_cal_cat(),
			// 'confirmed_intervention'=> spidating_so::get_cal_cat(),
			// 'realised_intervention'	=> spidating_so::get_cal_cat(),
			// 'option_intervention'	=> spidating_so::get_cal_cat(),
			// 'canceled_intervention'	=> spidating_so::get_cal_cat(),
		);
		
		$tpl = new etemplate('spidating.admin.general');
		$tpl->exec('spidating.spidating_admin.index', $content,$sel_options,$no_button, $content);
	}

	function help($content = null){
	/**
	 * Charge le template index
	 *
	 */ 
		$msg='';
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
		
		$sel_options = array(
			// 'default_cat_meeting' => array('' => lang('Select one')) + spidating_so::get_cal_cat(),
			// 'field_participant' => $this->get_cal_fields(),
		);
		
		$tpl = new etemplate('spidating.admin.help');
		$tpl->exec('spidating.spidating_admin.index', $content,$sel_options,$no_button, $content);
	}
}
?>