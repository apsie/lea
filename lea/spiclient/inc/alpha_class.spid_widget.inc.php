<?php
/** ne pas supprimer - fichier en cours pour la v3
 * eGroupWare  eTemplate Extension - spid Widget
 *
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 * @package etemplate
 * @subpackage extensions
 * @link http://www.egroupware.org
 * @author Ralf Becker <RalfBecker@outdoor-training.de>
 * @version $Id: class.spid_widget.inc.php 26075 2008-10-07 12:50:14Z ralfbecker $
 */

/**
 * eTemplate Extension: spid widget
 *
 * This widget can be used to display data from an spid specified by it's id
 *
**/

class spid_widget
{
	/**
	 * Classe crée dans le but d'exporter des fonctions et des variables globales. Liste des variables :
	 *
	 * @var array $public_functions liste des méthodes de cette classe
	 * @var string/array $human_name Extensions disponibles avec leur nom dans l'éditeur
	 * @var bospid Instance de la classe bospid
	 */
	var $public_functions = array(
		'pre_process' => True,
	);

	var $human_name = array(
		'select-client'  => 'Select Client (company name)',
		'select-clientgroup'  => 'Select Client (group name)',
		'select-spidstate' => 'Select State',
	);

	var $spid;

	function spid_widget($ui)
	{
		/**
		*Constructeur
		*
		* @param ui $ui ObjetUI
		*/
		$this->ui = $ui;
		$this->spid =& new spid_so();
	}

	function pre_process($name,&$value,&$cell,&$readonlys,&$extension_data,&$tmpl){
	/**
	 * Fonction d'initialisation du module. Celle-ci est appelée quand on entre dans le module
	 *
	 * @param string $name nom de la page
	 * @param mixed &$value contenu existant de la page, qui peut être modifié
	 * @param array &$cell tableau contenant les objets, peut être modifié dans le but de créer des objets indépendans de l'interface graphique
	 * @param array &$readonlys nom des objets en lecture seule (passer des clefs)
	 * @param mixed &$extension_data données que le module peut enregistrer entre le pré et le post processing
	 * @param etemplate &$tmpl référence à la template contenant le module
	 * @return boolean true si le commentaire est autorisé, sinon false
	 */
		switch($cell['type'])
		{
			case 'select-client':
				$cell['sel_options'] = $this->spid->get_societe();
				$cell['type'] = 'select';
				$cell['no_lang'] = 1;
				break;
			case 'select-spidstate':
				$cell['sel_options'] = $this->spid->get_etat();
				$cell['type'] = 'select';
				$cell['no_lang'] = 1;
				break;
			case 'select-clientgroup':
				$cell['sel_options'] = $this->spid->groupeClients();
				$cell['type'] = 'select';
				$cell['no_lang'] = 1;
				break;
		}
		$cell['id'] = ($cell['id'] ? $cell['id'] : $cell['name'])."[$type]";

		return True;	// extra label ok
	}

}
