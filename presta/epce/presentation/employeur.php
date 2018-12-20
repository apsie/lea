<?php require('../inc/class.epce.inc.php');
$epce=new epce(date('Y'));
if(isset($_GET['id']))
	{
	$id = $_GET['id'];
	}
	else
	{
		$id=NULL;
	}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="all" href="../../css/presta.css" title="blue">
<title>Les employeurs du bénéficiaire</title>
<style type="text/css">
<!--

	.suggestionsBox {
		position:relative;
		
		left: 30px;
		margin: 10px 0px 0px 0px;
		width: 400px;
		background-color: #212427;
		-moz-border-radius: 7px;
		-webkit-border-radius: 7px;
		border: 2px solid #000;	
		color: #fff;
		background-color: #000;
		z-index:10;
		
	}
	
	.suggestionList {
		margin: 0px;
		padding: 0px;
	}
	
	.suggestionList li {
		
		margin: 0px 0px 3px 0px;
		padding: 3px;
		cursor: pointer;
	}
	
	.suggestionList li:hover {
		background-color: #06C;
	}
-->
</style><script type="text/javascript" src="jquery-1.2.1.pack.js"></script>
<script type="text/javascript">
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("ajax_employeur.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions_rome').show();
					$('#autoSuggestionsList_rome').html(data);
				}
			});
		}
	} // lookup
	
	function fill(t1,t2,t3) {
		$('#rome').val(t1);
		$('#poste').val(t3);
		$('#domaine').val(t2);
		
	
		
		setTimeout("$('#suggestions_rome').hide();", 200);
	}

	function lookup_ville(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("ville_employeur.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions_ville').show();
					$('#autoSuggestionsList_ville').html(data);
				}
			});
		}
	} // lookup
	
	function fill_ville(v1,v2,v3,v4) {
		$('#adr_one_postalcode_e').val(v1);
		$('#adr_one_locality_e').val(v2);
		$('#adr_one_region_e').val(v3);
		$('#adr_one_countryname_e').val(v4);
	
		
		setTimeout("$('#suggestions_ville').hide();", 200);
	}

	
	
</script>


<script language="javascript">
function voirdiv(nomdiv)
		{
			
			if(document.getElementById(nomdiv).style.display=='none')
			{
			document.getElementById(nomdiv).style.display='block';
			}
			else 
			{
				document.getElementById(nomdiv).style.display='none';
			}
		
		}
        </script>
</head>

<body><form action="../test.php" method="post" ><input type="hidden"  name="cat_id" value="EMPLOYEURS"/><input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
<center>
  <h2>EMPLOYEUR</h2></center><h2>Carte d'identité</h2><hr />
<table><tr><td width="116">Civilité</td><td width="144"><select  style="width:120px" name="n_prefix_e"><option></option><option value="Monsieur">Monsieur</option><option value="Madame">Madame</option><option value="Mademoiselle">Mademoiselle</option></select></td>
<td>&nbsp;</td>
<td>&nbsp;</td></tr><tr><td>Nom</td><td><input  type="text"  name="n_family_e" /></td><td width="101">Prénom</td><td width="144"><input  type="text" name="n_given_e" /></td></tr><tr>
<td>Deuxième prénom</td>
<td><input type="text" name="n_middle_e" /></td>
<td>Nom de jeune fille</td><td><input name="n_suffix_e" type="text" /></td></tr><tr>
 <td>Tél bureau</td><td><input  name="tel_work_e" type="text" /></td><td>Tél portable</td><td><input name="tel_cell" type="text" /></td></tr><tr>
  <td>Tél privé</td>
 <td><input type="text"  name="tel_home_e" /></td>
 <td>Site web</td>
 <td><input name="url_e" type="text" /></td></tr><tr>
  <td>Email bureau</td>
 <td><input name="email_e" type="text" /></td>
 <td>Email domicile</td>
 <td><input name="email_home_e" type="text" /></td></tr></table>

<h2>Société</h2>
<hr /><table><tr>
   <td width="117">Société</td>
   <td width="144"><input style="border:1px solid #F00"  name="org_name_e" type="text" /></td></tr><tr>
<td>Service</td>
<td><input name="title" type="text" /></td>
<td width="98">Fonction</td>
<td width="144"><input name="org_unit_e" type="text" /></td></tr><tr>
 <td>Rue</td>
 <td><input name="adr_one_street_e" type="text" /></td></tr><tr>
  <td>Code postal</td>
 <td><input onblur="fill_ville();" id="adr_one_postalcode_e" onkeyup="lookup_ville(this.value);" name="adr_one_postalcode_e" type="text" /></td>
 <td>Ville</td>
 <td><input name="adr_one_locality_e" id="adr_one_locality_e" type="text" /></td></tr><tr>
  <td>Région</td>
 <td><input name="adr_one_region_e" id="adr_one_region_e" type="text" /></td>
 <td>Pays</td>
 <td><input name="adr_one_countryname_e" id="adr_one_countryname_e" type="text" /></td></tr></table><div class="suggestionsBox" id="suggestions_ville" style="display: none;">
				<img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="autoSuggestionsList_ville">
					&nbsp;
				</div>
			</div></div>
 
<a href="">
<h2>Parcours professionnel</h2></a>
<hr />
<table>
 
  <tr><td>Date de début</td><td><select style="width:40px"  name='j_e'><option></option><?php for($i=1;$i<32;$i++){echo" <option value='$i'>$i</option>'";} ?></select>/<select style="width:40px" name='m_e'><option></option><?php for($i=1;$i<13;$i++){echo" <option value='$i'>$i</option>'";} ?></select>/<select style="width:50px" name='a_e'><option></option><?php for($i=date('Y');$i>1900;$i--){echo" <option value='$i'>$i</option>'";} ?></select></td>
  <td width="76">Date de fin</td>
  <td width="136"><select style="width:40px" name='j_e_'><option></option><?php for($i=1;$i<32;$i++){echo" <option value='$i'>$i</option>'";} ?></select>/<select style="width:40px" name='m_e_'><option></option><?php for($i=1;$i<13;$i++){echo" <option value='$i'>$i</option>'";} ?></select>/<select style="width:50px" name='a_e_'><option></option><?php for($i=date('Y');$i>1900;$i--){echo" <option value='$i'>$i</option>'";} ?></select></td></tr><tr>
    <td width="114">Poste occupé</td>
    <td width="144"><input name="poste"  onblur="fill();"  onkeyup="lookup(this.value);" id="poste" type="text" /></td>
    <td>Code ROME</td>
    <td><input id="rome" name="rome" type="text" /></td>  <td>Domaine professionnel</td>
    <td><input id="domaine" size="45" name="domaine" type="text" /></td></tr><tr>
    <td>Qualification</td>
    <td width="144"><select style="width:120px"  name="qualification"><option></option><?php $epce->texte('Qualification');?></select></td>
  
    <td>Type de contrat</td>
    <td><select style="width:120px"  name="contrat"><option></option><?php $epce->texte('Type de contrat');?></select></td>
    <td width="132">Contrat aidé</td>
    <td width="159"><select style="width:120px"  name="contrat_aide"><option></option><?php $epce->texte('Contrat aide');?></select></td>
  </tr>
  
</table><div class="suggestionsBox" id="suggestions_rome" style="display: none;">
				<img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="autoSuggestionsList_rome">
					&nbsp;
				</div>
			</div></div>
<p><input type="submit" value="Enregistrer" /> <input type="button" value="Retour" OnClick="window.location='panel.php?<?php echo 'choix='.$id;?>'"></p></form>
</body>
</html>