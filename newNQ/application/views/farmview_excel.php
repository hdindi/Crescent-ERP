<?php
//This application is developed by www.webinfoipedia.com. || Copyright 2011.
//For more examples related PHP visit www.webinfoipedia.com and enjoy demo and free download..


//connect the database
require_once("db.php");

//Enter the headings of the excel columns
$contents="id, plotnumber,farmname,crop,fielddescription,leasorname\n";

//Mysql query to get records from datanbase
//You can customize the query to filter from particular date and month etc...Which will depends your database structure.
$user_query = mysql_query('SELECT id, plotnumber, farmname, crop, fielddescription,leasorname FROM farm ORDER BY RAND( ) LIMIT 0 , 15');

//While loop to fetch the records
while($row = mysql_fetch_array($user_query))
{
$contents.=$row['id'].",";
$contents.=$row['plotnumber'].",";
$contents.=$row['farmname'].",";
$contents.=$row['crop'].",";
$contents.=$row['fielddescription'].",";
$contents.=$row['leasorname']."\n";
}

// remove html and php tags etc.
$contents = strip_tags($contents); 

//header to make force download the file
header("Content-Disposition: attachment; filename=farmreport_as_at_".date('d-m-Y').".xlsx");
print $contents;

//For more examples related PHP visit www.webinfoipedia.com and enjoy demo and free download..
?>