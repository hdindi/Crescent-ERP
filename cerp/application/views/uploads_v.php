
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Crop Cycles</title>
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js'></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" 
		type="text/css" media="all">
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/screen.css" 
		type="text/css" media="all">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>CRESCENT ENTRPRISE SYSTEM</title>
        <link rel="stylesheet" href="css/screen.css">
   
        
  </head>
    <header>      
  
            <h4 class="logo"> 
      
    
    </h4>
             <nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        
      </ul>
</nav>
<div class="clear"></div>
        </header>

	
 <div id="container">
 
 
<aside>
 <div class="widget" id="widget">
   <h2>Login/Register</h2> 
   <div>
	
	<?php if(Current_User::user()): ?>
		<h2>Hello <em><?php echo Current_User::user()->username; ?></em>.</h2>
		<h2><?php echo anchor('logout','Logout'); ?></h2>
    <h2><?php echo anchor('farming', 'Farming'); ?></h2>
		<h2><?php echo anchor('landregistration','Land Registration'); ?></h2>
		<h2><?php echo anchor('weeding','Weeding'); ?></h2>
		<h2><?php echo anchor('farming/getallfarms','View Leased Farms'); ?></h2>
		
	<?php else: ?>
		<h2>New Users: <?php echo anchor('/index.php/createaccount','Create an Account'); ?>.</h2>
		<h2>Members: <?php echo anchor('index.php/login','Login'); ?>.</h2>
	<?php endif; ?>
	
	
</div>
   
</div>

</aside>
<?php echo $precost1['1']->cyclename;
$data1 = $precost1['0']->cyclename;?>
<?php foreach ($precost1 as $value): ?>
     <ul><li><a name="farmname" href="<?php echo base_url().'uploads/do_upload/'.$farm.'/'.$value->cyclename;?>"><?php echo $value->cyclename; ?> <label>planted</label> <?php  echo $value->monthofplantation;?></a></li></ul>
	
<?php endforeach?>

           
           <div class="data">
            <p><strong><em> CRESCENT FARM ENTERPRISES 
            <br />
            P.O BOX 279 NAMBALE KENYA </p>
            <br />
            </div>

</div>
<footer>
             crescentfarm.com. All rights reserved &copy; <?php echo date ('Y');?>.
        </footer>
</html>