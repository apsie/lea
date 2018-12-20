<?php
/**	spiclient : SpireaClient
*	SPIREA - 23/12/2009
*	Spirea - 16/20 avenue de l'agent Sarre
*	Tél : 0141192772
*	Email : contact@spirea.fr
*	www : www.spirea.fr
*
*	Propriété de Spirea
*
*	Logiciel SpireaClient - Ce logiciel est un programme informatique servant à la gestion de clients dans un environnement egroupware.
*
*	Reproduction, utilisation ou modification interdite sans autorisation de Spirea
*/
require_once(EGW_INCLUDE_ROOT. '/spiclient/inc/class.admin_bo.inc.php');	

class spiclient_admin extends admin_bo
{
	var $public_functions = array(
		'index' 	=> true,
		'help'		=> true,
	);

	function __construct(){
	/**
	* Méthode appelée directement par le constructeur. Charge les varibles globales
	*/
		
		/// Il faut être admin pour accèder à l'admin de SpiClient
		if (!$GLOBALS['egw_info']['user']['apps']['admin']){
			if(!isset($_GET['view'])){
				$GLOBALS['egw']->framework->render('<h1 style="color: red;">'.lang('Permission denied !!!')." - Réf.  __construct</h1>\n",null,true);
				return;
			}
		}
		parent::__construct();

		$this->prefs = $GLOBALS['egw_info']['user']['preferences']['spiclient'];
		// $this->obj_js = CreateObject('phpgwapi.javascript');
		$GLOBALS['egw_info']['flags']['java_script'].=$this->write_js();
	}
	
	function spiclient_admin(){
	/**
	*Constructeur
	*/
		self::__construct();
	}
	
	function write_js(){
	/**
	* NOTE : Fonction... inutile
	*/
		return "";
	}
	
	function index($content=null){
	/**
	* Crée l'index général, les filtres sur les membres de la classe courante, et les appliques aux diverses e-templates. Un message par défaut peut être passé via $_GET('msg'), un filtre via $_GET('filter'), la vue du tableau de bord via $_GET['view']
	*
	* Pour supprimer des index, assigner un tableau d'identifiants de zone à supprimer à $content['nm']['rows']['delete']
	*
	* @param array $content=null correspond aux éléments à examiner (mettre à jour ou supprimer).
	*/
		$msg='';
		if(is_array($content)){
			list($button) = @each($content['button']);
			switch($button){
				case 'save':
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
		
		$content = $this->obj_config;
		$sel_options = array(
			'SellerType' => $this->get_type_client(),
			'ClientType' => $this->get_type_client(),
			'ProspectType' => $this->get_type_client(),
			'ProviderType' => $this->get_type_client(),
			'SubcType' => $this->get_type_client(),

			'DefaultProvider' => $this->get_providers(),

			'default_role_contract' => $this->get_role(),
		);
				
		$tpl = CreateObject('etemplate.etemplate', 'spiclient.admin.general');
		$tpl->exec('spiclient.spiclient_admin.index', $content,$sel_options,$no_button, $content);
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
		
		$content = $this->obj_config;
		
		$sel_options = array(
			// 'default_cat_meeting' => array('' => lang('Select one')) + spidating_so::get_cal_cat(),
			// 'field_participant' => $this->get_cal_fields(),
		);
		
		$tpl = new etemplate('spiclient.admin.help');
		$tpl->exec('spiclient.spiclient_admin.help', $content,$sel_options,$no_button, $content);
	}
}

?>
