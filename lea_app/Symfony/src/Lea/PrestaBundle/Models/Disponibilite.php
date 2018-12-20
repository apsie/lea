<?php
namespace Lea\PrestaBundle\Models;
setlocale(LC_TIME, "fr_FR");

class Disponibilite
{
	public $em;
	public $dateDebut = null;
	public $nbJour = 7;
	public $nbHeureRecherche = null;
	public $plageDebut = 8;
	public $plageFin = 18;
	public $duree = 3600;
	public $account_id = null;
	public $id_category = null; 
	public $holiday  = array();
	public $typeRecherche = 1;
	public $idPrestation;
	public $idDispositif = null;
	public $catId = null;
	public $isOption = false;
	public $intervalle = 0;
	public $jours = "";
	public $colorCodeWeek = array (
	"01"=>'#D3EAFF',"02"=>'#E1FFD3',"03"=>'#FFF9D3',"04"=>'#FFDAD3',"05"=>'#D3F7FF',"06"=>'#EFD3FF',"07"=>'#FFD3F5',"08"=>'#B7BCB5',"09"=>'#C3C7DB',"10"=>'#E0E1E2',
	"11"=>'#C9ADB0',"12"=>'#ADC8C9',"13"=>'#C9B6AD',"14"=>'#ADBFC9',"15"=>'#B5ADC9',"16"=>'#F7F19B',"17"=>'#CCCCCC',
	"18"=>'#D3EAFF',"19"=>'#E1FFD3',"20"=>'#FFF9D3',"21"=>'#FFDAD3',"22"=>'#D3F7FF',"23"=>'#EFD3FF',"24"=>'#FFD3F5',"25"=>'#B7BCB5',"26"=>'#C3C7DB',"27"=>'#E0E1E2',
	"28"=>'#C9ADB0',"29"=>'#ADC8C9',"30"=>'#C9B6AD',"31"=>'#ADBFC9',"32"=>'#B5ADC9',"33"=>'#F7F19B',"34"=>'#CCCCCC',
	"35"=>'#D3EAFF',"36"=>'#E1FFD3',"37"=>'#FFF9D3',"38"=>'#FFDAD3',"39"=>'#D3F7FF',"40"=>'#EFD3FF',"41"=>'#FFD3F5',"42"=>'#B7BCB5',"43"=>'#C3C7DB',"44"=>'#E0E1E2',
	"45"=>'#C9ADB0',"46"=>'#ADC8C9',"47"=>'#C9B6AD',"48"=>'#ADBFC9',"49"=>'#B5ADC9',"50"=>'#F7F19B',"51"=>'#CCCCCC',
	"52"=>'#D3EAFF',"53"=>'#E1FFD3');
	
	public function __construct($params)
	{
		if(isset($params['em']))
		$this->em = $params['em'];
			
		if(!isset($params['dateDebut']))
			$this->dateDebut = date('d/m/Y H:i',mktime(0,0,0,date('n'),date('j')-2,date('Y')));
		else 
			$this->dateDebut = $params['dateDebut']. ' 00:00';
		// if(!isset($params['dateDebut']))
		// $this->dateDebut = date('d/m/Y H:i');
		// else 
		// $this->dateDebut = $params['dateDebut']. ' 00:00';
		
		if(isset($params['plageDebut']))
		$this->plageDebut = $params['plageDebut'];
		
		if(isset($params['plageFin']))
		$this->plageFin = $params['plageFin'];
		
		if(isset($params['duree']))
		$this->duree = $params['duree'];
		
		if(isset($params['account_id']))
		$this->account_id = $params['account_id'];
		
		if(isset($params['nbJour']))
		$this->nbJour = $params['nbJour'];
		
		if(isset($params['idPrestation']))
		$this->idPrestation = $params['idPrestation'];
		
		if(isset($params['typeRecherche']))
		$this->typeRecherche = $params['typeRecherche'];
		
		if(isset($params['idDispositif']))
		$this->idDispositif = $params['idDispositif'];
		
		if(isset($params['catId']))
		$this->catId = $params['catId'];
		
		if(isset($params['isOption']))
		$this->isOption = $params['isOption'];
		
		if(isset($params['jours']))
		$this->jours = $params['jours'];
		
		if(isset($params['nbIntervalle']))
		$this->intervalle = $params['nbIntervalle'] * $params['typeIntervalle'];
		
		$this->nbHeureRecherche = $this->nbJour * 24 ;
		
	}
	public function get()
	{
		$libelle = null;
		#Rdv de l'account
		$rdvAcc = $this->getRdv($this->account_id, $this->getTmps($this->dateDebut),null,null,$this->getTmps($this->dateDebut)+$this->nbHeureRecherche*60*60);
		//$rdvAcc = $this->getRdv($this->account_id, $this->getTmps($this->dateDebut),null,null,$this->getTmps($this->dateDebut)+$this->nbHeureRecherche*60*60);
		//\Doctrine\Common\Util\Debug::dump($rdvAcc,3);die();
		//print_r($rdvAcc); die();
		//$rdvAcc = array();
		$dispo = array();
		$rdv_dispo = 0;
		$tpsInt = 0;
		
		$tpsOld = 0;
		
		//die('test'.  date('H:i', $this->getTmps($this->dateDebut)));
		for ($i = 0; $i < $this->nbHeureRecherche; $i++) {
			
			$tps =  $this->getTmps($this->dateDebut) + $i*$this->duree + $tpsInt;
			
			
			if($i*$this->duree + $tpsInt >  $this->nbHeureRecherche * 60 * 60)
				break;
				
			
				
			if($this->typeRecherche == 1)
			{
			
			
			if(date('H',$tps)!=13 &&  date('H',$tps)>=$this->plageDebut && date('H',$tps)<$this->plageFin && date('w',$tps)!=0 &&  date('w',$tps)!=6 && preg_match("/".date('w',$tps)."/",$this->jours ) == true)
			{
				
			
			
				$disabled = null;
				$class="rdv_dispo";
				$description='Rendez vous disponible';
				/*#On exclus les vacances
				foreach ($this->holiday as $hol) {
					
					if($tps>=$hol['TPS_DEB'] && $tps<=$hol['TPS_FIN'] )
					{
					$disabled = 'disabled';
					$class ="holiday";
					$description="Période de vacance";
					}
					else
					$disabled = null;
				};*/
				
				if(count($rdvAcc)>0)
				{
					if($this->idPrestation!=null)
					{
					$prestation = $this->em->getRepository('LeaPrestaBundle:EgwPrestation')->get(null,null,null,null,null,null,null,$this->idPrestation);
					$libelle =  ' - '.date('Ym',$tps).'_'.$prestation[0]->getDispositif()->getNomDispositif().'_'.$prestation[0]->getIntitule();	
					}
					else if($this->isOption)
					{
					$dispositif = $this->em->getRepository('LeaPrestaBundle:EgwDispositif')->find($this->idDispositif);
					$cat = $this->em->getRepository('LeaPrestaBundle:EgwCategories')->find($this->catId);
					$c = explode('_',$cat->getCatName());
					$libelle =  ' - '.date('Ym',$tps).'_'.$dispositif->getNomDispositif().'_option_'.$c[2];	

					}
					$disabled = null;
					$class="rdv_dispo";
					$description='Rendez-vous disponible';
									#On exclus les rdv posés
				foreach ($rdvAcc as $key => $rdv) {
					
					
					if($tps>=$rdv->getEgwCalIdDates()->getCalStart() && $tps<$rdv->getEgwCalIdDates()->getCalEnd() )
					{
					$disabled = 'disabled';
					$class ="rdv_pose";
					$description="Tranche horaire non disponible";
					$libelle = ' - '.$rdv->getCalTitle();
					//\Doctrine\Common\Util\Debug::dump($rdv);die();
					}
					
					
				};
				}
				
			
				
				if($disabled!='disabled')
			   $rdv_dispo = $rdv_dispo +1;
				
				$dispo[] = array(	'NUMEROSEM'		=> date('W',$tps),
									'COLORWEEK'		=> $this->colorCodeWeek[date('W',$tps)],
									'DESCRIPTION'	=>	$description,
									'DISABLED'  	=>  $disabled,
									'CLASSE'		=>  $class,
									'TYPEINPUT'		=>	'checkbox',
									'VALUE'			=>	$tps,
									'JOUR'			=>  strftime ('%A',$tps),
									'DATE'			=>	date('d/m/Y H:i',$tps).$libelle);
				
			if($disabled == null)
			$tpsInt =  $tpsInt + $this->intervalle;	
			/*else
			$tpsInt = $tpsInt - 43200;
			*/
			
			}
			
			$tpsOld = $tps;
			
			
		
			}
			elseif($this->typeRecherche == 2)
			{
				$calId = null;
				
			if(date('H',$tps)!=13 && date('H',$tps)>=$this->plageDebut && date('H',$tps)<$this->plageFin  && date('w',$tps)!=0 &&  date('w',$tps)!=6 && preg_match("/".date('w',$tps)."/",$this->jours ) == true )
			{
					$disabled = 'disabled';
					$class ="rdv_pose";
					$description="Tranche horaire libre";
				
				
				if(count($rdvAcc)>0)
				{
					$prestation = $this->em->getRepository('LeaPrestaBundle:EgwPrestation')->get(null,null,null,null,$this->idPrestation);
				    $disabled = 'disabled';
					$class ="rdv_pose";
					$description="Tranche horaire libre";
					
					$libelle =  ' - Tranche horaire libre';	
				#On exclus les rdv posés
				foreach ($rdvAcc as $key => $rdv) {
					
					
					if($tps>=$rdv->getEgwCalIdDates()->getCalStart() && $tps<$rdv->getEgwCalIdDates()->getCalEnd() )
					{
					$disabled = null;
					$class="rdv_dispo";
					$description='Lier ce bénéficiaire aux rendez vous';
					
					$calId = $rdv->getCalId();
					// SPIREA-YLF - 05/2015 - 'c' => 'b' pour correspondre aux bénéficiaires et pas aux contacts
					$nbContact = $this->em->getRepository('LeaPrestaBundle:EgwCal')->getNbParticipants($rdv->getCalId(),'b');
					$nbConseiller = $this->em->getRepository('LeaPrestaBundle:EgwCal')->getNbParticipants($rdv->getCalId(),'u');
					$libelle = ' - '.$rdv->getCalTitle().' ( Bén:'.$nbContact['nb'].' - Con:'.$nbConseiller['nb'].')';
					$rdv_dispo = $rdv_dispo + 1;
					}
					
					
				};
			
				}
				
				$dispo[] = array(	'NUMEROSEM'		=> date('W',$tps),
									'COLORWEEK'		=> $this->colorCodeWeek[date('W',$tps)],
									'DESCRIPTION'	=>	$description,
									'DISABLED'  	=>  $disabled,
									'CLASSE'		=>  $class,
									'TYPEINPUT'		=>	'checkbox',
									'VALUE'			=>	$calId,
									'JOUR'			=>  strftime ('%A',$tps),
									'DATE'			=>	date('d/m/Y H:i',$tps).$libelle);
				
			}
			
			
			}
			
			
		}
		
		return array('rdv'=>$dispo,'rdv_dispo'=>$rdv_dispo);
	
	}
	public function getOptions($libellePrestation = null)
	{
		$opts = $this->getOptionsBdd($libellePrestation);
		$newOpts = array();
		foreach ($opts as $key => $value) {
			$date = $value->getEgwCalIdDates();
			$tps = $date->getCalStart();
			
			$newOpts[] = array(	'DESCRIPTION'	=> $value->getCalTitle(),
								'DISABLED'  	=>  '',
								'CLASSE'		=>  'rdv_dispo',
								'TYPEINPUT'		=> 'radio',
								'VALUE'			=>	$value->getCalId(),
								'DATE'			=>	date('d/m/Y H:i',$tps).' - '.$value->getCalTitle());
		}
		unset($opts);
		return array('opts'=>$newOpts);
	}
	private function getRdv($account_id = null,$dateDebut =null,$dateFin = null)
	{
		$rdv = $this->em->getRepository('LeaPrestaBundle:EgwCal')->getRdv($account_id,$dateDebut,null,null,$dateFin);
		//$rdv = $this->em->getRepository('LeaPrestaBundle:EgwCal')->getRdv($account_id,$dateDebut);
		//\Doctrine\Common\Util\Debug::dump($rdv,10);die();
		
		return $rdv;
	}
	private function getOptionsBdd($libellePrestation = null)
	{
		
	  $options = $this->em->getRepository('LeaPrestaBundle:EgwCal')->getOption($this->account_id,$this->getTmps($this->dateDebut),$libellePrestation);
      
      return $options;
	}
	private function getTmps($date,$separateur="/",$multiplicateur=1,$addition=0,$gmt = false)
	{
		
		list($d,$h) = explode(" ",$date);
		list($heure,$min) = explode(":",$h);
		
		if(!is_numeric($heure))
		$heure = 0;
		
		if(!is_numeric($min))
		$min = 0;
		
		list($d,$m,$y) = explode($separateur,$d);
		
		if($gmt)
		$tps = gmmktime($heure,$min,0, $m, $d, $y);
		else
		$tps = mktime($heure,$min,0, $m, $d, $y);
		

		if($multiplicateur!=1)
		$tps = $tps * $multiplicateur;
		
		if($addition!=0)
		$tps = $tps + $addition;

		
		return $tps;
	}
	
}