<?php class TitreProjetTb extends Zend_Db_Table
{
    protected $_name = 'egw_bp_titre_projet';
	protected $titre_default = array (
									  'titre_1'=>'LE PRODUIT/SERVICE ET LE MARCHE',
									  'titre_1_1'=>'Description du produit ou du service',
									  'titre_1_2'=>'Le marche',
									  'titre_1_3'=>'les clients',
									  'titre_1_4'=>'La concurrence', 
									  'titre_1_5'=>'Les fournisseurs et sous traitants',
									  'titre_1_6'=>'L\'emplacement geographique',
									  'titre_2'=>'LA STRATEGIE COMMERCIALE',
									  'titre_2_1'=>'La politique de produit/service',
									  'titre_2_2'=>'La politique de prix',
									  'titre_2_3'=>'La politique de communication',
									  'titre_2_4'=>'Chiffre d\'affaires prévisionnel',
									  'titre_3'=>'LES MOYENS DE PRODUCTION',
									  'titre_3_1'=>'Les moyens humains',
									  'titre_3_2'=>'Les moyens en immeuble et/ou en terrain',
	'titre_3_3'=>'Les moyens en matériel d\'exploitation et outillage',
	'titre_3_4'=>'Les moyens incorporels',
	'titre_3_5'=>'Les stocks',
	'titre_4'=>'LES ASPECTS JURIDIQUES, FISCAUX et SOCIAUX',
	'titre_4_1'=>'Les aspects juridiques',
	'titre_4_1_1'=>'Les réglementations de l\'activité et la capacité du porteur de projet',
	'titre_4_1_2'=>'Choix de la forme juridique',
	'titre_4_1_3'=>'Nombre d\'associés et désignation du g�rant',
	'titre_4_1_4'=>'Répartition du capital social',
	'titre_4_1_5'=>'La Propriété intellectuelle',
	'titre_4_2'=>'Les aspects fiscaux',
	'titre_4_2_1'=>'Le régime d\'imposition (IR/IS)',
	'titre_4_2_2'=>'La TVA',
	'titre_4_2_3'=>'Les exonérations fiscales',
	'titre_4_3'=>'Les aspects sociaux',
	'titre_4_3_1'=>'Le statut social du dirigeant (TNS/AS, mutuelle)',
	'titre_4_3_2'=>'La composition du foyer (conjoint collaborateur, enfant à charge)',
	'titre_4_3_3'=>'Les exonérations sociales (ACCRE, ZFU, ZRU)',
	'titre_4_3_4'=>'Les aides à l\'embauche si présence de salariés'
	
									  );
									  
	
	function  get_value($id_bp)
	{
		
		$data =  $this->fetchRow(
						   $this->select()
						          ->where('id_bp = ?',$id_bp)
							
								 			);
		$newData =  new stdClass();
        foreach ($data as $key => $value) {
            $newData->$key = utf8_encode($value);
        }
       
		return $newData;
	
	}
	function initialiser_titre($id_bp)
	{			
				$this->titre_default['id_bp'] = $id_bp;
				$this->insert($this->titre_default);
	}
	
	}

?>