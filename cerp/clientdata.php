<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "nqcl";

mysql_connect($host, $username, $password);
mysql_select_db($database);

$client_id = $_REQUEST['name'];
$query = "SELECT * FROM clients WHERE id = '$client_id'";
$result = mysql_query($query);
$details = mysql_fetch_assoc($result);
echo $details['contact_person'];
//echo $details['address'];
//echo json_encode($details);
?>