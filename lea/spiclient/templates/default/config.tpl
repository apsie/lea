<!-- BEGIN header -->
<form method="POST" action="{action_url}">
<table border="0" align="center">
   <tr class="th">
    <td colspan="2"><font color="{th_text}">&nbsp;<b>{title}</b></font></td>
   </tr>
<!-- END header -->

<!-- BEGIN body -->
   <tr class="row_on">
    <td colspan="2">&nbsp;</td>
   </tr>
   <tr class="row_off">
    <td colspan="2"><b>SpiClient - fichier config.tpl {lang_site_configuration}</b></td>
   </tr>
   <tr class="row_on">
    <td>Activ&eacute;r le suivi d'utilisation d'eGroupWare</td>
    <td>
     <select name="newsettings[spiadmin_suivi_utlisation]">
      <option value="0"{selected_spiadmin_suivi_utlisation_0}>{lang_No}</option>
      <option value="1"{selected_spiadmin_suivi_utlisation_1}>{lang_Yes}</option>
     </select>
    </td>
   </tr>
  
<!-- END body -->

<!-- BEGIN footer -->
  <tr class="th">
    <td colspan="2">
&nbsp;
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      <input type="submit" name="submit" value="{lang_submit}">
      <input type="submit" name="cancel" value="{lang_cancel}">
    </td>
  </tr>
</table>
</form>
<!-- END footer -->
