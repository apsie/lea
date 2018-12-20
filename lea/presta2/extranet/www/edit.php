<?php
include_once("php/dbconfig.php");
include_once("php/functions.php");
function getCalendarByRange($id){
  try{
    $db = new DBConnection();
    $db->getConnection();
    $sql = "select * from `apsie_jqcalendar` where `id` = " . $id;
    $handle = mysql_query($sql);
    //echo $sql;
    $row = mysql_fetch_object($handle);
	}catch(Exception $e){
  }
  return $row;
}
if($_GET["id"]){
  $event = getCalendarByRange($_GET["id"]);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
  <head>    
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">    
    <title>Calendar Details</title>    
     <link href="./style/calendar_css/main.css" rel="stylesheet" type="text/css" />       
    <link href="./style/calendar_css/dp.css" rel="stylesheet" />    
    <link href="./style/calendar_css/dropdown.css" rel="stylesheet" />    
    <link href="./style/calendar_css/colorselect.css" rel="stylesheet" />   
     
    <script src="./js/jquery.js" type="text/javascript"></script>    
    <script src="./js/Plugins/Common.js" type="text/javascript"></script>        
    <script src="./js/Plugins/jquery.form.js" type="text/javascript"></script>     
    <script src="./js/Plugins/jquery.validate.js" type="text/javascript"></script>     
    <script src="./js/Plugins/datepicker_lang_US.js" type="text/javascript"></script>        
    <script src="./js/Plugins/jquery.datepicker.js" type="text/javascript"></script>     
    <script src="./js/Plugins/jquery.dropdown.js" type="text/javascript"></script>     
    <script src="./js/Plugins/jquery.colorselect.js" type="text/javascript"></script>  
     
    <script type="text/javascript">
     
    </script>      
    <style type="text/css">     
    .calpick     {        
        width:16px;   
        height:16px;     
        border:none;        
        cursor:pointer;        
        background:url("sample-css/cal.gif") no-repeat center 2px;        
        margin-left:-22px;    
    }      
    </style>
  </head>
  <body>    
    <div>      
   Titre <input type="text" />        
    </div>
  </body>
</html>