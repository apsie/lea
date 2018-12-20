<style type="text/css">
<!--
.center {
	text-align: center;
	font-size: 12px;
	font-weight:bolder;
	background:#CCC;
}
-->
</style>




<div><h3>Edition des livrables</h3><br/>
<table >
<tr>
<td width="255" ><table width="255" >
  <form action="./imprimer_bilan.php" method="get">
    <tr><td width="247"><table width="251" style="border:1px solid #CCC">
      <tr>
        <td width="215" bgcolor="#F3F3F3"><span class="rouge">1.</span> Plan d'evaluation <span class="vert">x3</span></td>
        <td width="20" align="center" style="text-align: center" ><a href="./imprimer_bilan.php?id_presta=<?php echo $_GET['id_presta']; ?>&id_beneficiaire=<?php echo $choix; ?>&selection=0&email_siege=none"><img alt="Imprimer"  title="Imprimer" border="0" src="../images/print_16.png" /></a></td>
        </tr>
      <tr>
        <td bgcolor="#F3F3F3"><span class="rouge">2.</span> Emargement <span class="vert">x2</span></td>
        <td width="20" align="center" style="text-align: center"><a href="./imprimer_bilan.php?id_presta=<?php echo $_GET['id_presta']; ?>&id_beneficiaire=<?php echo $choix; ?>&selection=3"><img alt="Imprimer"  title="Imprimer" border="0" src="../images/print_16.png" /></a></td>
        </tr>
      <tr>
        <td bgcolor="#F3F3F3"><span class="rouge">3.</span> Fiche evenement <span class="vert">x1</span></td>
        <td width="20" align="center"><a href="./imprimer_bilan.php?id_presta=<?php echo $_GET['id_presta']; ?>&id_beneficiaire=<?php echo $choix; ?>&selection=4&email_siege=none"><img alt="Imprimer"  title="Imprimer" border="0" src="../images/print_16.png" /></a></td>
        </tr>
      <tr>
        <td bgcolor="#F3F3F3"><span class="rouge">4.</span> Couvertures <span class="vert">x1</span></td>
        <td width="20" align="center"><a href="./imprimer_bilan.php?id_presta=<?php echo $_GET['id_presta']; ?>&id_beneficiaire=<?php echo $choix; ?>&selection=5"><img alt="Imprimer"  title="Imprimer" border="0" src="../images/print_16.png" /></a></td>
        </tr>
      <tr>
        <td bgcolor="#F3F3F3"><span class="rouge">5.</span> Bilan <span class="vert">x3</span></td>
        <td width="20" align="center"><a href="./imprimer_bilan.php?id_presta=<?php echo $_GET['id_presta']; ?>&id_beneficiaire=<?php echo $choix; ?>&selection=1&email_siege=none"><img alt="Imprimer"  title="Imprimer" border="0" src="../images/print_16.png" /></a></td>
        </tr>
      <tr>
        <td bgcolor="#F3F3F3"><span class="rouge">6.</span> Annexe 1 <span class="vert">x2</span></td>
        <td width="20" align="center"><a href="./imprimer_bilan.php?id_presta=<?php echo $_GET['id_presta']; ?>&id_beneficiaire=<?php echo $choix; ?>&selection=2"><img alt="Imprimer"  title="Imprimer" border="0" src="../images/print_16.png" /></a></td>
        </tr><tr>
        <td bgcolor="#F3F3F3"><span class="rouge">7.</span> Form GED<span class="vert"></span></td>
        <td width="20" align="center"><a href="./imprimer_bilan.php?id_presta=<?php echo $_GET['id_presta']; ?>&id_beneficiaire=<?php echo $choix; ?>&selection=13"><img alt="Imprimer"  title="Imprimer" border="0" src="../images/print_16.png" /></a></td>
        </tr>
    </table>      <a href="./imprimer_bilan.php?id_beneficiaire=<?php echo $choix; ?>&amp;selection=1"></a></td>
      </tr>
  </form>
</table></td></tr></form></table>
<p>&nbsp;</p>
</div>
<br/>
<!--<form><br/><br/><u>Envoi de pieces jointe par courrier electronique a  </u><select><option>Liste des destinataires</option></select><br/><br/><input type="radio" checked="checked" />
Compte rendu<br/> <br/><input type="submit" value="Envoyer"  />
</form>
-->
