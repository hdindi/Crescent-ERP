<html>
    <p> LIST OF ALL REGISTERED FARMS : </p>
<?php foreach ($farms as $value): ?>
	<ul><li><a  href="<?php echo base_url().'newfarmingactivity/cycles/'.$value->name;?>"><?php echo $value->name;?></a></li></ul>
	
<?php endforeach?>


</html>