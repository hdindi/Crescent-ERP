<html>
<?php foreach ($farms as $value): ?>
	<ul><li><a name="farmname" href="<?php echo base_url().'uploads/data/'.$value->name;?>"><?php echo $value->name;?></a></li></ul>
	
<?php endforeach?>


</html>