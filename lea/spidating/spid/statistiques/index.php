<?php
$GLOBALS['egw_info']['flags'] = array(
		'currentapp' 	=> 'spid',
		'noheader' 		=> true,
		'nonavbar' 		=> true,
);

include('../../header.inc.php');

function DoubleZero($int) {
    if(strlen($int)==1) {
        return '0'.$int;
    } else {
        return $int;
    };
}

function RGB_vers_HEX($r, $g, $b) {
    $rouge = DoubleZero(dechex($r));
    $vert = DoubleZero(dechex($g));
    $bleu = DoubleZero(dechex($b));
    
    return strtoupper($rouge.$vert.$bleu);
}


switch($_GET['stats']){
	case 'ca':
		$title="Chiffre d'affaires par client";
		break;
	default:
		$title="";
		break;
}

$cols=array(
	'S.client_id',
	'S.account_id',
	'S.client_company',
	'SUM(F.total_ht) as montant_total',
);
$where=array(
	'S.client_id'	=> 'F.client_id',
);
$join =', spid_factures F where S.client_id=F.client_id';
$clients= $GLOBALS['egw']->db->select('spid_clients S',$cols,'',__LINE__,__FILE__,false,'group by S.client_id',false,0,$join);
$tableau="";
//_debug_array($clients);

foreach($clients as $rows)
{
	$random1=round(rand(0,255));
	$random2=round(rand(0,255));
	$random3=round(rand(0,255));
	$couleur=RGB_vers_HEX($random1, $random2, $random3);
	//[150, 0xFF9900, 'Gibbon', 0],
	
	$tableau.="[".$rows['montant_total'].", 0x".$couleur.", '".$rows['client_company']."', 0],"."\r\n";
}

$tableau=substr($tableau,0,-2)."\n";
//echo $tableau;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta Http-Equiv="Cache-Control" Content="no-cache">
<meta Http-Equiv="Pragma" Content="no-cache">
<meta Http-Equiv="Expires" Content="0">
<title></title>

<style type="text/css">
	body {background-color:#EEEEEE;}
</style>
<script type="text/javascript">

////////////////////////////////////////////////////////////////////////////////////////////////////////

function $(id)								// façon "prototype"
{
	return document.getElementById(id);
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////

function arr2str()						// convertit le tableau de données en une chaîne de caractères
{												// Séparateurs : ",," et ","
	for (var i=0,n=arr.length,temp=[];i<n;i++) temp[i]=arr[i].join(',');
	return temp.join(',,');
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////

function handle(response)
{
	if (response.charAt(0)=='@') {	// caractère signalant une erreur
		alert(response.substr(1));
		return;
	}
	
	// les champs (d'abord le nom du fichier, ensuite les différentes portions) sont séparés par '\n'
	var t=response.split('\n'),j,n,s='';
	// les coordonnées des portions sont déjà séparées par ',' : il n'y a donc pas lieu à remanier t[j] !
	for (j=1,n=t.length-1;j<n;j++)
		s+='<area shape="poly" coords="'+t[j]+'" href="javascript:go(\''+(j-1)+'\');"/>';
	
	document.getElementsByName('mymap').item(0).innerHTML=s;
	$('myimg').src=t[0];
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////

function go(index)
{
	arr[index][3]= (arr[index][3])? 0 : 1;	
	request();
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////

function request()				// envoie la requête et récupère la réponse
{	
	var 
		xhr= (window.ActiveXObject)? new ActiveXObject('Microsoft.XMLHTTP') : new XMLHttpRequest(),
		url=server+'?class=aabasic&title='+title+'&str='+arr2str()+'&size='+size+'&ajax=1&bg1='+bgcolor;

	xhr.onreadystatechange=function() {
		if (xhr.readyState==4 && xhr.status==200) handle(xhr.responseText);
	}

	xhr.open('get',url,true);
	xhr.send(null);
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////

</script>
</head>

<body>

<img id="myimg" src="" usemap="#mymap" border="0"/>
<map name="mymap"></map>						<!-- "id" supporté par IE mais pas par FF -->

<script type="text/javascript">
var 
	server="interactivecamembert.php",
	title="<?php echo $title; ?>",	// les accents sont supportés
	size=3,											// 1,2,3
	bgcolor=0xEEEEEE,								// couleur du fond
	arr=[
	<?php echo $tableau; ?>
	];

// codage de la légende du tableau
for (var i=0,n=arr.length;i<n;i++) arr[i][2]=encodeURIComponent(arr[i][2]);
// on est prêt
request();
</script>

</body></html>