<h4>Book Data</h4>
<?php if(count($detail) > 0) { ?>
<table border="1">
<tr>
<th>ID</th>
<th>Title</th>
<th>Author</th>
</tr>
<?php
foreach($detail as $rows) {
echo "<tr>";
echo "
<td>".  $rows['id']."</td>
<td>". $rows['plotnumber'] ."</td>
<td>". $rows['farmname'] ."</td>
<td>". $rows['leasorname']."</td>
"; } ?>
</table>
<?php } ?>
<br> <br>
<a href='toExcelAll'><span style='color:green;'>Export All Data</span></a>