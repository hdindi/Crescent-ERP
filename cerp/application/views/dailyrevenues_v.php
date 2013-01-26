<html>
<?php foreach ($dailyrevenues as $value): ?>
	<ul><li><a name="dailyrevenues" href="<?php echo base_url().'dailyrevenue/do_upload/'.$value->filename;?>"><?php echo $value->filename;?></a></li></ul>
	
<?php endforeach?>


</html>