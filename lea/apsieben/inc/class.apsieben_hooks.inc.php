<?php
class apsieben_hooks
{
	static function search_link($location){
	/**
	* Méthode initialisant la liste des hooks
	*
	* NOTE : $location ne sert à rien
	* 
	* @param int $location paramètres locaux à charger
	* @return array
	*/
		$appname = 'apsieben';
		
		// Fonctions de récupération des titres et de recherche
		return array(
			'query' => 'apsieben.apsieben_bo.link_query',
			'title' => 'apsieben.apsieben_bo.link_title',
			'titles' => 'apsieben.apsieben_bo.link_titles',
		);
	}

	function calendar_resources($args){
		return array(
			'info' => 'apsieben.apsieben_bo.get_calendar_info',// Retourne les infos d'un bénéficiaire
			'new_status' => 'apsieben.apsieben_bo.get_calendar_new_status',// Statut par défaut à l'ajout comme participant
			'type' => 'b',// Caractère d'identification pour les bénéficiaires
			'icon' => 'calicon',//icone
			'participants_header' => lang('Beneficiary'), // Libellé pour les bénéficiaires
		);
	}

	static function all_hooks($args){
	/**
	* Méthode initialisant les variables globales des tickets et chargeant les préférences paramétrées.
	* Permet aussi d'afficher le menu et de créer des liens dirigés vers son contenu
	*
	* \version BBO - 07/09/2010 - Les menu de configuration ont été séparés pour accélérer l'affichage du panneau de configuration
	*
	* @param array $args tableau contenant l'index location définissant l'endroit où l'utilisateur se trouve : spid menu,spid,admin,... (on en déduit ainsi les paramètres à afficher)
	*/
		$appname = 'apsieben';
	
			
	}

	static function settings(){
	 /**
	 * charge les préférences dans $GLOBALS['settings']
	 * 
	 * Fonction non développée pour spiclients
	 *
	 * NOTE : la fonction retourne toujours true
	 *
	 * @return boolean
	 */

		return true;	// otherwise prefs say it cant find the file ;-)
	}

	/**
	 * Check if reasonable default preferences are set and set them if not
	 *
	 * It sets a flag in the app-session-data to be called only once per session
	 */
	static function check_set_default_prefs(){
	/**
	 * Vérifie et applique les paramètres de session comme paramètres par défaut.
	 *
	 * NOTE : La fonction ne retourne pas toujours une valeur ...
	 * 
	 * @return boolean
	 */
	}
}
?>