<?php
/**
 * @access public
 */
class Messager {
	
	
	public function __construct() {
		// Not yet implemented
	}

	/**
	 * @access public
	 */
	public function inserer_messager($id_destinaire, $id_expediteur, $message_status, $objet, $message) 
	{
		// Not yet implemented
		
		
		
		//insertion
		$data = array('message_owner' => $id_destinaire, 'message_from' => $id_expediteur,'message_date'=>time(), 'message_status' => $message_status, 'message_subject' =>  $objet,'message_content' =>$message);
				
	$GLOBALS['db']->insert('phpgw_messenger_messages',$data);
		
		
		
			

	
	}
	
}
?>