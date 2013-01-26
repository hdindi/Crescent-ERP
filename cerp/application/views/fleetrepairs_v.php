<html>
<?php foreach ($fleetrepairs as $value): ?>
	<ul><li><a name="farmname" href="<?php echo base_url().'fleetrepairsupload/data/'.$value->fleetrepairs;?>"><?php echo $value->fleetrepairs;?></a></li></ul>
	
<?php endforeach?>


</html>