<?php class TitreValidationTb extends Zend_Db_Table
{
    protected $_name = 'egw_bp_titre_validation';
	/*protected $titre_default = array ('bool_titre_sommaire'=>1,
									  'bool_titre_intro'=>'Introduction',
									  'bool_titre_1'=>'Pr�sentation g�n�rale du projet',
									  'bool_titre_1_1'=>'Executive Summary',
									  'bool_titre_1_2'=>'Fiche d\'identit� de l\'entreprise',
									  'bool_titre_2'=>'L\'entreprise',
									  'bool_titre_2_1'=>'Historique', 
									  'bool_titre_2_2'=>'Le management',
									  'bool_titre_2_3'=>'Le produit',
									  'bool_titre_3'=>'Le march�',
									  'bool_titre_3_0'=>'L\'�tude de march�',
									  'bool_titre_3_1'=>'L\'environnement',
									  'bool_titre_3_1_1'=>'L\'�tat de l\'art de la technologie',
									  'bool_titre_3_1_2'=>'Le contexte',
									  'bool_titre_3_2'=>'La demande',
									  'bool_titre_3_2_1'=>'Les chiffres: potentiel et tendances',
									  'bool_titre_3_2_2'=>'Analyse qualitative et segmentation',
									  'bool_titre_3_2_3'=>'Les r�sultats terrain',
									  'bool_titre_3_3'=>'La concurrence',
									  'bool_titre_3_3_1'=>'La p�n�tration du march�',
									  'bool_titre_3_3_2'=>'Les produits analyse comparative',
									  'bool_titre_3_3_3'=>'Les strat�gies commerciales et les moyens mis en oeuvre',
									  'bool_titre_3_4'=>'Opportunit� de d�veloppement / Avantages concurrentiel',
									  'bool_titre_4'=>'Strat�gies de d�veloppement et plans d\'action',
									  'bool_titre_4_1'=>'Le business model',
									  'bool_titre_4_2'=>'La strat�gie produit',
									  'bool_titre_4_2_1'=>'Ad�quation produit/march�', 	
									  'bool_titre_4_2_2'=>'Positionnement et prix',
									  'bool_titre_4_2_3'=>'Programme de R & D',
									  'bool_titre_4_2_4'=>'Protection industrielle',
									  'bool_titre_4_3'=>'La strat�gie de production',
									  'bool_titre_4_3_1'=>'Organisation',
									  'bool_titre_4_3_2'=>'Politique d\'achat',
									  'bool_titre_4_3_3'=>'Budget de production et co�t de revient unitaire',
									  'bool_titre_4_4'=>'Strat�gie commerciale',
									  'bool_titre_4_4_1'=>'Objectifs commerciaux',
									  'bool_titre_4_4_2'=>'Organisation de la mise sur le march�',
									  'bool_titre_4_4_3'=>'Plan d\'action commercial',
									  'bool_titre_5'=>'Le calendrier du projet',
									  'bool_titre_6'=>'L\'organisation des moyens � mettre en oeuvre',
									  'bool_titre_6_1'=>'Organisation et moyens humains',
									  'bool_titre_6_2'=>'Les moyens techniques',
									  'bool_titre_6_3'=>'La structure juridique',
									  'bool_titre_7'=>'Bilan des risques et des opportunit�s',
									  'bool_titre_8'=>'Conclusion',
									  'bool_titre_9'=>'Annexes',
									  );*/
									  
	
	function  get_value($id_bp)
	{
		
		return $this->fetchRow(
						   $this->select()
						          ->where('id_bp = ?',$id_bp)
							
								 			);
		
		
	
	}
	function initialiserTitreValidation($id_bp)
	{			
				
				$this->insert(array("id_bp"=>$id_bp));
	}
	
	function updateValidation($val,$champ,$id_bp)
	{
		
		$data = array("bool_".$champ.""=>$val);
		$this->update($data ,'id_bp='.$id_bp);
	
	}
	
	}

?>