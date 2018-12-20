<?php
/**
 * spid - export to csv
 *
 * @link www.egroupware.org
 * @author Ralf Becker <RalfBecker-AT-outdoor-training.de>
 * @copyright (c) 2006-8 by Ralf Becker <RalfBecker-AT-outdoor-training.de>
 * @package spid
 * @subpackage export
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 * @version $Id: class.spid_csv.inc.php 25566 2008-06-05 12:04:00Z ralfbecker $
 */

/**
 * export to csv
 */
class spid_csv
{
	/**
	 * spid Instance
	 *
	 * @var spid_bo
	 */
	var $obj;
	var $charset;
	var $charset_out;
	var $separator;
	static $types = array(
		'select-account' => array('owner','creator','modifier'),
		'date-time' => array('modified','created','last_event','next_event'),
		'select-cat' => array('cat_id'),
	);

	var $spid_fields=array(
	
	
	
	);
	
	function __construct(spid_bo $obj,$charset=null,$separator=';'){
	/**
	* Méthode de construction. Construit $obj avec les caractères $charset (UTF-8,ISO 8859-1,...) et avec comme séparateur de fichier CSV $separator
	*
	* @param spid_bo $obj
	* @param string $charset=NULL
	* @param string $separator=';'
	*/
		$this->obj = $obj;
		$this->separator = $separator;
		$this->charset_out = $charset;
		$this->charset = $GLOBALS['egw']->translation->charset();
	}
	
	function csv_fields($include_type=false){
	/**
	* Retourne les champs à exporter. Le tableau obtenu contient le nom des champs/NM en index, où NM peut être 'type' pour le type de champ, 'label' pour le nom du champ
	* Le tableau retour contient en outre les champs last_event et next_event, valeurs des dates par défaut des évènements calendrier (début et fin)
	*
	* @param boolean $include_type=false Inclure le type du champ CSV pour formatter les prochains exports
	* @return array
	*/
		$fields = $this->spid_fields;
		$fields['last_event'] = lang('Last date');
		$fields['next_event'] = lang('Next date');

		if ($include_type)
		{
			foreach(self::$types as $type => $names)
			{
				foreach($names as $name)
				{
					if (isset($fields[$name]))
					{
						$fields[$name] = array(
							'type'  => $type,
							'label' => $fields[$name],
						);
					}
				}
			}
		}
		return $fields;
	}
	
	function export($ids,$fields=null,$file=null){
	/**
	* Exporte les champs $fields des évènements $ids dans le fichier CSV $file
	*
	* NOTE : retourne toujours vrai
	*
	* @param array $ids tableau des identifiants des contacts
	* @param array $fields=NULL Champs à exporter dans le fichier CSV
	* @param string $file=NULL Nom du ficher (NULL si nous sommes dans le cas d'un téléchargement)
	* @return bool
	*/
		if (is_null($fields))
		{
			$fields = $this->csv_fields();
		}
		if (!$file)
		{
			$browser = new browser();
			$browser->content_header('spid.csv','text/comma-separated-values');
		}
		if (!($fp = fopen($file ? $file : 'php://output','w')))
		{
			return false;
		}
		fwrite($fp,$this->csv_encode($fields,$fields)."\n");

		if (isset($fields['last_event']) || isset($fields['next_event']))
		{
			$events = $this->obj->read_calendar($ids);
		}
		foreach($ids as $id)
		{
			if (!($data = $this->obj->read($id)))
			{
				return false;
			}
			if ($events && isset($events[$id]) && is_array($events[$id]))
			{
				$data += $events[$id];
			}
			$this->csv_prepare($data,$fields);

			fwrite($fp,$this->csv_encode($data,$fields)."\n");
		}
		fclose($fp);

		if (!$file)
		{
			$GLOBALS['egw']->common->egw_exit();
		}
		return true;
	}

	function csv_encode($data,$fields){
	/**
	* Exporte et code une ligne; chaque champ $fields de $data sera exporté. Retourne la ligne formattée en CSV
	*
	* @param array $data
	* @param array $fields
	* @return string
	*/
		$out = array();
		foreach($fields as $field => $label)
		{
			$value = $data[$field];
			if (strpos($value,$this->separator) !== false || strpos($value,"\n") !== false || strpos($value,"\r") !== false)
			{
				$value = '"'.str_replace(array('\\','"'),array('\\\\','\\"'),$value).'"';
			}
			$out[] = $value;
		}
		$out = implode($this->separator,$out);

		if ($this->charset_out && $this->charset != $this->charset_out)
		{
			$out = $GLOBALS['egw']->translation->convert($out,$this->charset,$this->charset_out);
		}
		return $out;
	}

	function csv_prepare(&$data,$fields){
	/**
	* Prépare un ligne à l'exportation. Remplace les identifiants et les timestamps de chaque champ $fields de $data par des valeurs lisibles
	*
	* @param array &$data
	* @param array $fields
	*/
		foreach(self::$types['select-account'] as $name)
		{
			if ($data[$name])
			{
				$data[$name] = $GLOBALS['egw']->common->grab_owner_name($data[$name]);
			}
			elseif ($name == 'owner')
			{
				$data[$name] = lang('Accounts');
			}
		}
		foreach(self::$types['date-time'] as $name)
		{
			if ($data[$name]) $data[$name] = date('Y-m-d H:i:s',$data[$name]);
		}
		if ($data['tel_prefer']) $data['tel_prefer'] = $fields[$data['tel_prefer']];

		$cats = array();
		foreach(explode(',',$data['cat_id']) as $cat_id)
		{
			if ($cat_id) $cats[] = $GLOBALS['egw']->categories->id2name($cat_id);
		}
		$data['cat_id'] = implode('; ',$cats);

		$data['private'] = $data['private'] ? lang('yes') : lang('no');

		$data['n_fileas'] = $this->obj->fileas($data);
		$data['n_fn'] = $this->obj->fullname($data);
	}


}