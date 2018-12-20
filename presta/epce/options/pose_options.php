<?php
session_start();
ini_set('display_errors', 0);
if(isset($_SESSION['id']))
{}
else
{ header('Location: ../erreur.php');
}
include("../inc/class.epce.inc.php");
include('../../inc/class.rapport_activite.inc.php');

$rapport = new Rapport_activite($_SESSION['id']);
$rapport->action('pose des options');
	 $epce=new epce(date('y'));
	if(isset( $_GET['conseiller']))
					{
					$conseiller=$_GET['conseiller'];
					}
					else
					{
					$conseiller=NULL;
					}
					
					if(isset($_GET['conseiller_id']))
					{
					$id_con=$_GET['conseiller_id'];
					}
					else
					{
					$id_con=NULL;
					}
	 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="all" href="../../css/presta.css" title="blue">
<title>Poser des options</title>

<link rel="stylesheet" type="text/css" media="all" href="index.php_fichiers/calendar-blue.css" title="blue">
<script type="text/javascript" src="index.php_fichiers/calendar.js"></script>
<script type="text/javascript" src="index.php_fichiers/jscalendar-setup.php"></script>
<script type="text/javascript" src="index.php_fichiers/etemplate.js"></script>

<script>

function Check_all(state)
{
  
  var i;
  var tabInput=document.getElementsByTagName("input");
  var n=tabInput.length;
  
  for(i=0;i<n;i++)
  {
  	if(tabInput[i].type=='checkbox')
  	{
  		tabInput[i].checked=state;
  	}
  		
  }
 }
 
   
   </script>
   <style>
   select
{
	width:auto;
	background-color: #FFF;
	color: #000;
	
	border:1px solid #DBDBDB;
}</style>
</head>



<body>
<form method="POST"  action="" >

<?php if( isset($_GET['lieu']) and  $_GET['lieu']!=NULL)
{
$val='<option value='.$_GET['lieu'].'>'.$_GET['lieu'].'</option>';}
else
{
	$val='<option value=""></option>';
}
			   ?>

<table >
	<tr >
		<td width="112"  align="left" ><select name="nombre"><?php for($i=0;$i<101;$i++)
		{echo "<option  value='$i'>$i</option>";}?></select> Options pour</td>
		<td width="321"  align="left" ><?php $epce->selectionner_conseiller3($id_con); echo' a '; ?> <select name="lieu"><?php echo $val;?><option value="Melun">Melun</option><option value="Vitry">Vitry</option><option value="Montereau">Montereau</option><option value="Coulommiers">Coulommiers</option><option value="Provins">Provins</option><option value="Torcy">Torcy</option><option value="Meaux">Meaux</option><option value="Courbevoie">Courbevoie</option><option value="Epinay">Epinay</option><option value="Gennevilliers">Gennevilliers</option><option value="Saint-Denis">Saint-Denis</option><option value="Saint-Maur">Saint-Maur</option></select></td>
	</tr>
	<tr >
		<td  align="left">Date/heure de debut </td>
		<td  align="left">







<table  cellspacing="0">
	<tr >
		<td  align="left"><input type="text" id="exec[start][str]" name="date_start" size="10" value="<?php 
		if(isset($_GET['date_choisi']) and $_GET['date_choisi']!=NULL)
		{echo $_GET['date_choisi'];
		}
		else
		{ echo date('Y/m/d');
		}?>" />
<script type="text/javascript">
	document.writeln('<img id="exec[start][str]-trigger" src="index.php_fichiers/datepopup.gif" title="Sélectionner la date" style="cursor:pointer; cursor:hand;"/>');
	Calendar.setup(
	{
		inputField  : "exec[start][str]",
		button      : "exec[start][str]-trigger"
	}
	);
</script>
</td>
		<td  align="left"> &nbsp; &nbsp; </td>
		<td  align="left">
</td>
	</tr>
</table>
</td>
	</tr>
	<tr >
		<td  align="left">Duration* </td>
		<td  align="left">

<!-- BEGIN hbox -->

<table >
	<tr >
		<td ><select name="duree">

<option value="3600" selected="selected">1:00</option>

</select>
</td>
		<td  >

<!-- BEGIN eTemplate *** generated fields for date -->



<!-- BEGIN grid  -->
<table  cellspacing="0">
	
</table>
<!-- END grid  -->

<!-- END eTemplate *** generated fields for date -->

</td>
	</tr>
</table>


<!-- END hbox -->

</td>
	</tr>
	<tr >
		<td  align="left">Plage horaire </td>
		<td  align="left">

<!-- BEGIN hbox -->

<table >
	<tr >
		<td >

<!-- BEGIN eTemplate *** generated fields for date -->



<!-- BEGIN grid  -->
<table  cellspacing="0">
	<tr >
		<td  align="left"><select name="plage1" id="exec[start_time][H]" >


<option value="9" selected="selected" >09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>

</select>
</td>
	</tr>
</table>


</td>
		<td >jusqu'a </td>
		<td >

<table  cellspacing="0">
	<tr >
		<td  align="left"><select name="plage2" id="exec[end_time][H]"  >


<option value="9">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17" selected="selected">17</option>
<option value="18">18</option>

</select>
</td>
	</tr>
    
</table></td>
</tr>
</table>




</td>
	</tr><tr><tr><td>Sur</td><td><select name="selection"><option value="1">Un jour</option><option selected="selected" value="7">Une semaine</option><option value="14">Deux semaines</option><option value="21">Trois semaines</option><option value="28">Quatre semaines</option></select></td></tr>
    <tr><tr><td>Tous les</td><td><select name="jours"><option value="Monday">Lundi</option><option  value="Tuesday">Mardi</option><option value="Wednesday">Mercredi</option><option value="Thursday">Jeudi</option><option value="Friday">Vendredi</option><option selected="selected"  value="6">Jours ouvres</option></select></td></tr>
	 
	<tr >
		<td  align="left"><input type="submit"  value="Nouvelle recherche" />
</td>
		<td  align="left">


</td>
	</tr>
	<tr >
		<td  colspan="2" align="left">







</td>
	</tr>
</table>


</form>
<?php
//$_POST['date_']. $_POST['prestation']. $_POST['option']. $_POST['lieu'];

if(isset($_POST['date_start']) and $_POST['date_start']!=null)
{
if($_POST['lieu']=="")
{
echo"<br/> <font color=red>Veuillez préciser le lieu de cette option...</font>";
}
elseif($_POST['conseiller_id']=="")
{
echo"<br/> <font color=red>Veuillez préciser le conseiller pour cette option...</font>";
}
else
{

$epce->chercher_options($_POST['date_start'],$_POST['selection'],$_POST['plage1'],$_POST['plage2'],$_POST['duree'],$_POST['conseiller_id'],$_POST['lieu'],$_POST['nombre'],$_POST['jours']);
}
}
?>
</td>
								</tr>
							</table>
							</div>
		  	<!-- Applicationbox Column -->
		  	</td>
			<td width=8 ></td>
		 </tr>
	</table>

  
</div>
</div>
	



</body>
</html>

