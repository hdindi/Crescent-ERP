<?php 
  $host = "localhost";
  $user = "root";
  $pass = "";

  $databaseName = "enqcl";
  $tableName = "clients";


  $client_id = $_REQUEST['id'];
  $con = mysql_connect($host,$user,$pass);
  $dbs = mysql_select_db($databaseName, $con);

  $result = mysql_query("SELECT * FROM $tableName WHERE id = $client_id");          
  $array = mysql_fetch_row($result);                       

  echo json_encode($array);

?>