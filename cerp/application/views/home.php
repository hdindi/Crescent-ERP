<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Home</title>
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js'></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" 
		type="text/css" media="all">
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/screen.css" 
		type="text/css" media="all">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>CRESCENT ENTRPRISE SYSTEM</title>
        <link rel="stylesheet" href="css/screen.css">
        <style type="text/css">
 #slideshow { 
    margin-left: 5px auto; 
    position: relative; 
    width: 230px; 
    height: 200px; 
    padding: 10px; 
  
}

#slideshow > div { 
    position: absolute; 
    top: 10px; 
    left: 10px; 
    right: 10px; 
    bottom: 10px; 
}
.data{
margin-top:210px;
}
h4.logo1{
float-right:870px;
}



        </style>
        <script>
    $("#slideshow > div:gt(0)").hide();

setInterval(function() { 
  $('#slideshow > div:first')
    .fadeOut(1500)
    .next()
    .fadeIn(1000)
    .end()
    .appendTo('#slideshow');
},  3000);
        </script>
        
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
		<h2><?php echo anchor('farms/get_All','View Leased Farms'); ?></h2>
		
	<?php else: ?>
		<h2>New Users: <?php echo anchor('/index.php/createaccount','Create an Account'); ?>.</h2>
		<h2>Members: <?php echo anchor('index.php/login','Login'); ?>.</h2>
	<?php endif; ?>
	
	
</div>
   
</div>

</aside>

<div id="slideshow">
   <div>
     <img src="<?php echo site_url('Images/1.jpg'); ?>" />
   </div>   
    <div>
     <img src="<?php echo site_url('Images/2.jpg'); ?>" />
   </div>
   <div>
     <img src="<?php echo site_url('Images/3.jpg'); ?>" />
   </div>
   <div>
     <img src="<?php echo site_url('Images/4.jpg'); ?>" />
   </div>
   <div>
     <img src="<?php echo site_url('Images/5.jpg'); ?>" />
   </div>
  
  
</div>
           
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