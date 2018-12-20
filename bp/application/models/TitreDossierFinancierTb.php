<?php class TitreDossierFinancierTb extends Zend_Db_Table
{
    protected $_name = 'egw_bp_titre_dossier_financier';
	protected $titre_default = array (
									  'titre_1'=>'LES BESOINS DE FINANCEMENT',
									  'titre_1_1'=>'Besoin de financement global',
									  'titre_1_2'=>'Montant de fonds recherchés',
									  'titre_1_3'=>'Mode de calcul du chiffre d\'affaire',
									  'titre_2'=>'COMPOSITION DU DOSSIER FINANCIER', 
									  'titre_2_1'=>'Point mort',
									  'titre_2_2'=>'Besoin en fonds de roulement',
									  'titre_2_3'=>'Comptes de résultats prévisionnels',
									  'titre_2_4'=>'Bilans prévisionnels',
	'titre_2_5'=>'Tableaux de financement prévisionnels',
	'titre_2_6'=>'Plans de trésorerie',
									  
									  );
									  
	
	function  get_value($id_bp)
	{
		
		return $this->fetchRow(
						   $this->select()
						          ->where('id_bp = ?',$id_bp)
							
								 			);
		
		
	
	}
	function initialiser_titre($id_bp)
	{			
				$this->titre_default['id_bp'] = $id_bp;
				$this->insert($this->titre_default);
	}
	
	}

?>