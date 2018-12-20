<?php
ini_set('display_errors',0);
include ("jpgraph/jpgraph.php");
include ("jpgraph/jpgraph_pie.php");
include ("jpgraph/jpgraph_pie3d.php");
include ("jpgraph/jpgraph_bar.php");

class ImageGraph
{
function createBarGradient($data,$imageName,$titre)
{
	
// Create the graph. These two calls are always required
$graph = new Graph(350,250,'auto');
$graph->SetScale("textlin");

//$theme_class="DefaultTheme";
//$graph->SetTheme(new $theme_class());
$c=0;
if(strlen($data['valeur'][2])==2)
{
	$compt = 100;
}
if(strlen($data['valeur'][2])==3)
{
	$compt = 1000;
}
elseif(strlen($data['valeur'][2])==4)
{
	$compt = 1000;
}
elseif(strlen($data['valeur'][2])==5)
{
	$compt = 10000;
}
elseif(strlen($data['valeur'][2])==6)
{
	$compt = 100000;
}
elseif(strlen($data['valeur'][2])==7)
{
	$compt = 100000;
}
elseif(strlen($data['valeur'][2])==8)
{
	$compt = 1000000;
}
elseif(strlen($data['valeur'][2])>=9)
{
	$compt = 10000000;
}
for($i=0;$i<=$data['valeur'][2];$i++)
{
	
	$grad[$i] = $c;
	$c = $c+$compt;
	
}

// set major and minor tick positions manually
$graph->yaxis->SetTickPositions($grad);


$graph->SetMargin(90,0,20,30);
//$graph->ygrid->SetColor('gray');
$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels($data['intitule']);
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

// Create the bar plots
$b1plot = new BarPlot($data['valeur']);

// ...and add it to the graPH
$graph->Add($b1plot);


$b1plot->SetColor("white");
$b1plot->SetFillGradient("#0A0091","white",GRAD_LEFT_REFLECTION);
$b1plot->SetWidth(50);
$graph->title->Set($titre);

// Provoquer l'affichage (renvoie directement l'image au navigateur)
$graph->Stroke('./dompdf/www/test/images/'.$imageName.'.png');

}
	function createCamembert($data,$dataColor,$imageName,$titre)
	{
/*print_r($dataColor);
exit();*/
// On spécifie la largeur et la hauteur du graph
$graph = new PieGraph(300,200);
$graph->SetFrame(false); // optional, if you don't want a frame border
$graph->SetColor('white'); // pick any color not in the graph itself
$graph->img->SetTransparent('white'); // must be same color as above
// Ajouter une ombre au conteneur
//$graph->SetShadow();
// Set A title for the plot
$graph->title->Set($titre);

// Donner un titre
//$graph->title->Set("Volume des ventes par années style PIE 3D");

// Quelle police et quel style pour le titre
// Prototype: function SetFont($aFamily,$aStyle=FS_NORMAL,$aSize=10)
// 1. famille
// 2. style
// 3. taille
//$graph->title->SetFont(FF_GEORGIA,FS_BOLD, 12);

// Créer un camembert 
$pie = new PiePlot3D($data);
//$pie->labeltype = 3;
// Quelle partie se détache du reste
$pie->ExplodeSlice(0);


// Légendes qui accompagnent le graphique, ici chaque année avec sa couleur
//$pie->SetLegends($tableauAnnees);

// Position du graphique (0.5=centré)
$pie->SetCenter(0.55);

// Type de valeur (pourcentage ou valeurs)
//$pie->SetValueType(PIE_VALUE_ABS);

// Personnalisation des étiquettes pour chaque partie
//$pie->value->SetFormat('%d ventes');

// Personnaliser la police et couleur des étiquettes
//$pie->value->SetFont(FF_ARIAL,FS_NORMAL, 9);
//$pie->value->SetColor('blue');

// ajouter le graphique PIE3D au conteneur 
$graph->Add($pie);


// Spécifier des couleurs personnalisées... #FF0000 ok
$pie->SetSliceColors($dataColor);		

// Provoquer l'affichage (renvoie directement l'image au navigateur)
$graph->Stroke('./dompdf/www/test/images/'.$imageName.'.png');
		
	}
}

?>