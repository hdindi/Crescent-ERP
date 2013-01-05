<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border='1' width="70%">
<tr>
<td>ID</td>
<td>TITLE</td>
<td>AUTHOR</td>
</tr>
<?
foreach($data1 as $item) {
?>
<tr>
<td><?=$item['id']?></td>
<td><?=$item['title']?></td>
<td><?=$item['author']?></td>
</tr>
<? } ?>
</table>