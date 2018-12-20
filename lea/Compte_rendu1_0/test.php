<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document sans titre</title>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
function verifForm() {
  if (document.F.civilite.value == "") {
    alert("Nom obligatoire.\n");
    document.F.civilite.focus();
    return false;
  }
  if (document.F.nom.value == "") {
    alert("Nom obligatoire.\n");
    document.F.nom.focus();
    return false;
  }
  if (document.F.prenom.value == "") {
    alert("Prénom obligatoire.\n");
    document.F.prenom.focus();
    return false;
  }
 
  return true;
}
</script>
</head>

<body>
<form action="" method="get" name="F">
<input name="civilite" type="text" value="<?php if (isset($_GET['civilite'])){echo $_GET['civilite'];} ?>" />
<input name="nom" type="text" value="<?php if (isset($_GET['nom'])){echo $_GET['nom'];} ?>" />
<input name="prenom" type="text" value="<?php if (isset($_GET['civilite'])){echo $_GET['prenom'];} ?>" />

<input name="valide" type="submit" onClick="verifForm(this.form)" value="Valider" />
</form>


</body>
</html>