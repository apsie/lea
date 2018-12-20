<?php
/**	spiclient : SpireaClient
*	SPIREA - 23/12/2009->juillet 2012
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
require_once(EGW_INCLUDE_ROOT. '/spiclient/inc/class.address_bo.inc.php');	
require_once(EGW_INCLUDE_ROOT. '/spiclient/inc/class.acl_spiclient.inc.php');	

class address_ui extends address_bo
{
	var $public_functions = array(
		'index' 	=> true,
		'edit' 		=> true,
		'view' 		=> true,
	);

	function __construct(){
	/**
	* Méthode appelée directement par le constructeur. Charge les varibles globales
	*/
		parent::__construct();
	}
	
	function address_ui(){
	/**
	*Constructeur
	*/
		self::__construct();
	}
		
	function edit($content=null){
	/**
	* Charge l'e-template d'édition, l'exécute avec les paramètres donnés, charge les requêtes ajax et le javascript.
	*
	* $content contient 2 idex : 'button' et, au choix save,apply,cancel
	*
	* Le contenu à visualiser peut se faire via $_GET['id'] ($_GET['location_parent'] permets d'appliquer un filtre)
	*
	* NOTE : curieux, le case après le default ...
	*
	* @param array $content=null
	*/
		$msg='';
		if(is_array($content)){
			list($button) = @each($content['button']);
			switch($button){
				case 'save':
				case 'apply':
					$msg = $this->add_update_address($content);
					if($button=='save'){
						echo "<html><body><script>var referer = opener.location;opener.location.href = referer+(referer.search?'&':'?')+'msg=".
							addslashes(urlencode($msg))."'; window.close();</script></body></html>\n";
						$GLOBALS['egw']->common->egw_exit();
					}
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

			$id = $this->data['address_id'];
			
			$content['msg']=$msg;
		}else{
			if(isset($_GET['id'])){
				$id=$_GET['id'];
			}else{
				$id="";
				
			}
		}

		if(isset($id)){
			$content=array(
				'msg'         => $msg,
				'spiclient'        => $spiclient,
			);
			if(empty($id)){
				$content['client_id'] = $_GET['client_id'];
				$GLOBALS['egw_info']['flags']['app_header'] = lang('Add address');
			}else{
				$content += $this->get_info($id);
				$GLOBALS['egw_info']['flags']['app_header'] = lang('Edit address');
			}
		}

		$sel_options = array(
			'client_id' => $this->client_ui->get_all_clients(),
			'address_type_id' => $this->get_types(),
		);
			
		$tpl = CreateObject('etemplate.etemplate', 'spiclient.address.edit');
		$tpl->exec('spiclient.address_ui.edit', $content,$sel_options,$readonlys,$content,2);
	}
}

?>
