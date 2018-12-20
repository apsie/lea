<?php
session_start();

include('../inc/class.epce_impression.inc.php');
include('../inc/class.epce.inc.php');
include('../inc/class.zend_mail.inc.php');


if(isset($_GET['id']))
	{
	$_SESSION['id']=$_GET['id'];
	$_GET['id_beneficiaire']=$_GET['id_ben'];
	}


if($_GET['selection']=='NSPP')
{
	

	$epce = new epce(date('Y'));
	$epce->valider($_GET['id_ben'],"NSPP",$_SESSION['id_presta']);
$epce->rdv_statut($_SESSION['intitule'],'R',$_SESSION['id_presta']);
$epce->update_presta_epce($_SESSION['id_ben'],'Annulee',$_SESSION['id_presta']);

$imp=new epce_impression($_GET['id_ben'],$_SESSION['id'],$_SESSION['id_presta']);
$imp->imprimer="none";
$imp->email_siege="presta@apsie.org";
$imp->imprimer_totalite_evenement($_GET['id_ben'],$_SESSION['id'],'NSPP');

echo'<SCRIPT LANGUAGE="JavaScript">
 
  var obj ="alert(\'La fiche évènement NSPP a été envoyé sur presta@apsie.org\')";
   var obj2 ="window.parent.opener.location.reload()";
    var obj3 ="window.close()";
  setTimeout(obj,1000);
   setTimeout(obj2,3000);
  setTimeout(obj3,5000);

  </script>';
  

/*echo'<div align="center" style="display:block; border:2px solid #F00; font-size:12px; font-family:Arial;  background:#FDB0BC; width:400px" id="alert1"><span style="font-weight: bold; text-align:center;">RAPPEL</span><br/><br/>
<blink>Fiche évènement</blink> : <a href="imprimer_bilan.php?id_presta='.$_SESSION['id_presta'].'&id_ben='.$_SESSION['id_ben'].'&selection=8&email_siege=none"><img alt="Imprimer"  title="Imprimer" border="0" src="../images/print_16.png" /></a>  ou 
  <a href="imprimer_bilan.php?id_presta='.$_SESSION['id_presta'].'&id_ben='.$_SESSION['id_ben'].'&selection=8"><img alt="Imprimer"  title="Imprimer et envoyer à presta@apsie.org" border="0" src="../images/print_16.png" /><img alt="Imprimer"  title="Imprimer et envoyer à presta@apsie.org" border="0" src="../images/letter_16.png" /></a><br/>
<br/>
 <input type="button" style="border:1px solid #CCC"  value="Fermer" onclick="window.close();"/> <br />
  </a></div><br/>';*/


}
elseif($_GET['selection']=='adhere_pas')
{
	
	$epce = new epce(date('Y'));
$epce->rdv_statut($_SESSION['intitule'],'A',$_SESSION['id_presta']);
$epce->update_presta_epce($_SESSION['id_ben'],'Annulee',$_SESSION['id_presta']);

echo'<div align="center" style="display:block; border:2px solid #F00; font-size:12px; font-family:Arial;  background:#FDB0BC; width:400px" id="alert1"><span style="font-weight: bold; text-align:center;">RAPPEL</span><br/><br/>
<blink>Fiche évènement</blink> : 
  <input  onclick="window.location.href=\'imprimer_bilan.php?id_ben='.$_SESSION['id_ben'].'&selection=10&id='.$_GET['id'].'\'" type="button" value="Imprimer et envoyer" /><br/><br/>
 <input type="button" style="border:1px solid #CCC"  value="Fermer" onclick="window.close();"/> <br />
  </a></div><br/>';


}
elseif($_GET['selection']=='abandon')
{
	
	$epce = new epce(date('Y'));
//$epce->rdv_statut($_SESSION['intitule'],'A');
//$epce->update_presta_epce($_SESSION['id_ben'],'Annulee',$_SESSION['id_presta']);

/*echo'<div align="center" style="display:block; border:2px solid #F00; font-size:12px; font-family:Arial;  background:#FDB0BC; width:400px" id="alert1"><span style="font-weight: bold; text-align:center;">RAPPEL</span><br/><br/><table><tr><td width="159"><blink>Fiche évènement</blink></td><td width="225"> <input type="button" onclick="window.location.href=\'imprimer_bilan.php?id_presta='.$_SESSION['id_presta'].'&id_ben='.$_SESSION['id_ben'].'&selection=11&id='.$_GET['id'].'\'"  value="Imprimer et envoyer" /></td></tr><tr>
      <td><blink>Bilan partiel</blink></td><td> <input type="button" onclick="window.location.href=\'imprimer_bilan.php?id_presta='.$_SESSION['id_presta'].'&id_ben='.$_SESSION['id_ben'].'&selection=1&id='.$_GET['id'].'\'"     value="Imprimer et envoyer" /></td></tr><tr>
        <td><blink>Plan d\'&eacute;valuation</blink></td><td> <input type="button" onclick="window.location.href=\'imprimer_bilan.php?id_presta='.$_SESSION['id_presta'].'&id_ben='.$_SESSION['id_ben'].'&email_siege=none&selection=0&id='.$_GET['id'].'\'"     value="Imprimer" /></td></tr><tr>
          <td><blink>Feuille d\'&eacute;margement</blink></td><td><input type="button" onclick="window.location.href=\'imprimer_bilan.php?id_presta='.$_SESSION['id_presta'].'&id_ben='.$_SESSION['id_ben'].'&selection=3&id='.$_GET['id'].'\'"     value="Imprimer" /></td></tr><tr>
            <td><blink>Annexe 1</blink></td><td><input type="button" onclick="window.location.href=\'imprimer_bilan.php?id_presta='.$_SESSION['id_presta'].'&id_ben='.$_SESSION['id_ben'].'&selection=2&id='.$_GET['id'].'\'"     value="Imprimer " /></td></tr></table><br/>
 <input type="button" style="border:1px solid #CCC"  value="Fermer" onclick="window.close();"/> <br />
  </a></div><br/>';*/
echo'<SCRIPT LANGUAGE="JavaScript">
    window.open(\'../control.php?lc='.$_GET['lc'].'&id_presta='.$_GET['id_presta'].'&abandon=1&id='.$_GET['id'].'&id_ben='.$_GET['id_ben'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=768\');</script>';


echo'<SCRIPT LANGUAGE="JavaScript">
 

   var obj ="parent.close()";
 
  setTimeout(obj,10000);
 

  </script>';

}
elseif($_GET['selection']=='present')
{

$epce=new epce(date('Y'));
	$epce->rdv_statut($_GET['intitule'],'A',$_SESSION['id_presta']);
	$epce->update_presta_epce($_GET['id_ben'],'En cours',$_SESSION['id_presta']);

echo'<SCRIPT LANGUAGE="JavaScript">
 
  var obj ="window.open(\'../control.php?lc='.$_GET['lc'].'&id_presta='.$_GET['id_presta'].'&id='.$_GET['id'].'&id_ben='.$_GET['id_ben'].'\',\'APSIE : PANEL\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=768\')";
   var obj2 ="window.parent.opener.location.reload()";
    var obj3 ="window.close()";
  setTimeout(obj,1000);
   setTimeout(obj2,3000);
  setTimeout(obj3,5000);

  </script>';





/*echo'<SCRIPT LANGUAGE="JavaScript">
      window.close();</script>';
*/

}
elseif($_GET['selection']=='continuer')
{

$epce=new epce(date('Y'));
	//$epce->rdv_statut($_GET['intitule'],'A');
	//$epce->update_presta_epce($_GET['id_ben'],'En cours');


echo'<SCRIPT LANGUAGE="JavaScript">
    window.open(\'../control.php?lc='.$_GET['lc'].'&presta='.$_GET['presta'].'&id_presta='.$_GET['id_presta'].'&continuer=1&id='.$_GET['id'].'&id_ben='.$_GET['id_ben'].'\',\'APSIE : PANEL EPCE\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=0, copyhistory=0, menuBar=0, width=1024, height=768\');</script>';


echo'<SCRIPT LANGUAGE="JavaScript">
 

   var obj ="parent.close()";
 
  setTimeout(obj,10000);
 

  </script>';
}
elseif($_GET['selection']=='apres')
{

	
echo'<SCRIPT LANGUAGE="JavaScript">
      window.close();</script>';

}
elseif($_GET['selection']==8)
{

 
$impression_nspp= new epce_impression($_GET['id_ben'],$_SESSION['id'],$_GET['id_presta']);	
 $impression_nspp->email_siege='presta@apsie.org';
$impression_nspp->imprimer_totalite_evenement($_GET['id_ben'],$_SESSION['id'],'NSPP');

}
elseif($_GET['selection']==10)
{

 
$impression_pas= new epce_impression($_GET['id_ben'],$_GET['id'],$_GET['id_presta']);	
 $impression_pas->email_siege='presta@apsie.org';
$impression_pas->imprimer_totalite_evenement($_GET['id_ben'],$_GET['id'],'adhere_pas');
}
elseif($_GET['selection']==11)
{

 
$impression_nspp= new epce_impression($_GET['id_ben'],$_GET['id'],$_GET['id_presta']);	
 $impression_nspp->email_siege='presta@apsie.org';
$impression_nspp->imprimer_totalite_evenement($_GET['id_ben'],$_GET['id'],'abandon');
}
	elseif($_GET['selection']==1)
{
	
	$impression = new epce_impression($_GET['id_beneficiaire'],$_SESSION['id'],$_GET['id_presta']);
	
	if($_GET['email_siege']!="none")
	{
		
	$impression->email_siege='presta@apsie.org';
	}
	
	else
	{
		$impression->email_siege=NULL;
	}
		
		
		
		
if($_GET['imprimer']!=NULL)
	{
		
	$impression->imprimer='none';
$retour = $impression->imprimer_totalite($_GET['id_beneficiaire'],$_SESSION['id']);
	

	header('Location: panel.php?choix='.$_GET['id_beneficiaire'].'&mail_bilan=presta@apsie.org#imprim'); 
	
	}
	elseif($_GET['imprimer']==NULL)
	{
		
$impression->imprimer_totalite($_GET['id_beneficiaire'],$_SESSION['id']);
	}

}
elseif($_GET['selection']==0)
{
	
	$impression = new epce_impression($_GET['id_beneficiaire'],$_SESSION['id'],$_GET['id_presta']);
	if($_GET['email_siege']!="none")
	{
		
	$impression->email_siege='presta@apsie.org';
	}
	
	else
	{
		$impression->email_siege=NULL;
	}
	if($_GET['imprimer']!=NULL )
	{
		
	$impression->imprimer='none';
	$impression->imprimer_totalite_plan($_GET['id_beneficiaire'],$_SESSION['id']);
	

	header('Location: panel.php?idpresta='.$_GET['id_presta'].'&choix='.$_GET['id_beneficiaire'].'&mail_plan=presta@apsie.org et '.$impression->mel_pole.'#imprim'); 

	
	}
	elseif($_GET['imprimer']==NULL)
	{
		
$impression->imprimer_totalite_plan($_GET['id_beneficiaire'],$_SESSION['id']);
	}



}
elseif($_GET['selection']==12)
{
	
	$impression = new epce_impression($_GET['id_beneficiaire'],$_SESSION['id'],$_GET['id_presta']);
	if($_GET['email_siege']!="none")
	{
		
	$impression->email_siege='presta@apsie.org';
	}
	
	else
	{
		$impression->email_siege=NULL;
	}
	if($_GET['imprimer']!=NULL )
	{
		
	$impression->imprimer='none';
	$impression->imprimer_totalite_plan($_GET['id_beneficiaire'],$_SESSION['id']);
	

	echo '<script>alert("La fiche évènement a été envoyé à presta@apsie.org");</script>';

	
	}
	elseif($_GET['imprimer']==NULL)
	{
		
$impression->imprimer_totalite_plan($_GET['id_beneficiaire'],$_SESSION['id']);
	}



}
elseif($_GET['selection']==9)
{
	
	$impression = new epce_impression($_GET['id_beneficiaire'],$_SESSION['id'],$_GET['id_presta']);

		$impression->email_siege=NULL;
	
$impression->imprimer_totalite_plan($_GET['id_beneficiaire'],$_SESSION['id']);



}
elseif($_GET['selection']==2)
{
	$impression = new epce_impression($_GET['id_beneficiaire'],$_SESSION['id'],$_GET['id_presta']);
$impression->imprimer_totalite_annexe1($_GET['id_beneficiaire'],$_SESSION['id']);
}
elseif($_GET['selection']==3)
{
	$impression = new epce_impression($_GET['id_beneficiaire'],$_SESSION['id'],$_GET['id_presta']);
$impression->imprimer_totalite_emargement($_GET['id_beneficiaire'],$_SESSION['id']);
}
elseif($_GET['selection']==4)
{
	$impression = new epce_impression($_GET['id_beneficiaire'],$_SESSION['id'],$_GET['id_presta']);
	if($_GET['email_siege']!="none")
	{
		
	$impression->email_siege='presta@apsie.org.org';
	}
	
	else
	{
		$impression->email_siege=NULL;
	}
	if($_GET['imprimer']!=NULL )
	{
	
	$impression->imprimer='none';
	$impression->imprimer_totalite_evenement($_GET['id_beneficiaire'],$_SESSION['id'],'adhere');
	
	header('Location: panel.php?choix='.$_GET['id_beneficiaire'].'&mail_evenement=presta@apsie.org#imprim'); 
	}
else
{
$impression->imprimer_totalite_evenement($_GET['id_beneficiaire'],$_SESSION['id'],'adhere');
}
}
elseif($_GET['selection']==5)
{
	$impression = new epce_impression($_GET['id_beneficiaire'],$_SESSION['id'],$_GET['id_presta']);
$impression->imprimer_couvertures();


}
elseif($_GET['selection']==13)
{
	$impression = new epce_impression($_GET['id_beneficiaire'],$_SESSION['id'],$_GET['id_presta']);

$impression->form();

}
elseif($_GET['selection']==6)
{
	$impression = new epce_impression($_GET['id_beneficiaire'],$_SESSION['id'],$_GET['id_presta']);
$impression->imprimer_couverture3();
}
elseif($_GET['selection']==7)
{
	$impression = new epce_impression($_GET['id_beneficiaire'],$_SESSION['id'],$_GET['id_presta']);
$impression->imprimer_couverture2();
}





else
{
echo'erreur';
}

?>