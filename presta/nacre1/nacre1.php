<div style="padding:20px"><hr style="border:1px dashed #CCC"/><a href=""> <h2>1. Preconisation d'accompagement</h2></a><center><div><div style="float:left"><table><tr class="pourcent">
	      <td height="30" align="center">&nbsp;</td><td align="center">&nbsp;</td><td align="center">&nbsp;</td><td align="center">&nbsp;</td><td align="center">&nbsp;</td></tr><tr align="center"><td><input onclick="window.location.href='../evaluation/coherence.php?id_presta=<?php echo $_GET['id_presta'] ;?>&choix=<?php echo $_GET['choix'] ;?>'" type="button" style="width:120px; height:80px; background-color:<?php echo $couleur2;  ?>; font-size:12px; color:#FFF" value="Cohérence H/P" /></td><td> <input onclick="window.location.href='../evaluation/commerciaux.php?id_presta=<?php echo $_GET['id_presta'] ;?>&choix=<?php echo $_GET['choix'] ;?>'" type="button" style="width:120px; height:80px; background-color:<?php echo $couleur3;  ?> ; font-size:12px; color:#FFF" value="Aspect commerciaux" /></td><td> <input onclick="window.location.href='../evaluation/financier.php?id_presta=<?php echo $_GET['id_presta'] ;?>&choix=<?php echo $_GET['choix'] ;?>'"  type="button" style="width:120px; height:80px; background-color:<?php echo $couleur4;  ?> ; font-size:12px; color:#FFF" value="Aspect financier" /> </td><td><input onclick="window.location.href='../evaluation/juridique.php?id_presta=<?php echo $_GET['id_presta'] ;?>&choix=<?php echo $_GET['choix'] ;?>'"  type="button" style="width:120px; height:80px; background-color:<?php echo $couleur5;  ?> ; font-size:12px; color:#FFF" value="Aspect juridique" /> </td><td><input onclick="window.location.href='../evaluation/bilan.php?id_presta=<?php echo $_GET['id_presta'] ;?>&choix=<?php echo $_GET['choix'] ;?>'" type="button" style="width:120px; height:80px; background-color: <?php echo $couleur6;  ?>; font-size:12px; color:#FFF" value="Bilan" /></td></tr><tr><td align="center">&nbsp;</td><td align="center">&nbsp;</td><td align="center">&nbsp;</td><td align="center">&nbsp;</td><td align="center">&nbsp;</td></tr></table> </div><div style="float:none">
	        <table >
  <tr>
<td width="255" ><table width="255" >
  <form action="./imprimer_bilan.php" method="get">
    <tr>
      <td width="247" height="97"><table width="251" style="border:1px solid #CCC">
      <tr>
        <td width="215" bgcolor="#F3F3F3"><span class="rouge">1.</span> Emargement <span class="vert">x2</span></td>
        <td width="20" align="center" style="text-align: center"><a href="./../../nacre1/impression/imprimer.php?imp_emargement=1&id_presta=<?php echo $_GET['id_presta']; ?>&id_beneficiaire=<?php echo $choix; ?>"><img alt="Imprimer"  title="Imprimer" border="0" src="../images/print_16.png" /></a></td>
      </tr>
      <tr>
        <td bgcolor="#F3F3F3"><span class="rouge">2.</span> Couvertures <span class="vert">x1</span></td>
        <td width="20" align="center"><a href="./../../nacre1/impression/imprimer.php?imp_couverture=1&id_presta=<?php echo $_GET['id_presta']; ?>&id_beneficiaire=<?php echo $choix; ?>"><img alt="Imprimer"  title="Imprimer" border="0" src="../images/print_16.png" /></a></td>
      </tr>
    </table>      
      </tr>
  </form>
</table></td></tr><td height="2"></form></table></div></div>
<br/>

</center><br/><a href="">
<h2>2. Entretien préliminaire </h2>
	 
	      </a>
<center>
<table width="616"><tr class="pourcent">
	      <td width="309" height="30" align="center"><a href="#preliminaire"><img onclick="window.location.href='/nacre1/formulaire_nacre_preliminaire.php?choix=<?php echo $choix; ?>&type_presta=<?php echo $_GET['type_presta']; ?>&lc=<?php echo $_GET['lc']; ?>&id_presta=<?php echo $_GET['id_presta']; ?>&imprimer=preliminaire'"  border="0" title="Analyser" src="../images/32x32/zoom.png" /></a></td><td width="295" align="center"><a name="preliminaire"></a><a href="#preliminaire"><img border="0" onclick="window.location.href='../../nacre1/impression.php?id_ben=<?php echo $choix; ?>&id_presta=<?php echo $_GET['id_presta']; ?>&imprimer=preliminaire'"  title="Imprimer" src="../images/32x32/print.png" /></a></td></tr></table>
  </center>
 <a href=""> <h2>3. Prévisionnel financier</h2> 
	
  </a><a onclick="window.open('../../../Projet1_1/details.php?domain=default&id_projet=<?php echo $id_projet_return; ?>','Projet','type=fullWindow,fullscreen,scrollbars=yes');" href="javascript::void(0)">Voir projet du bénéficiaire </a>
</div>