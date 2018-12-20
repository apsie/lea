<?php
$opt=$_POST['opt'];
$nb=$_POST['nb'];

echo $opt;
$opt = explode("-", $opt);
echo '<br/>';
/*for($i=0;$i<$nb;$i++)
{
	$requete= $requete.' and cal_id='.$opt[$i];
}
echo $requete;*/

?>