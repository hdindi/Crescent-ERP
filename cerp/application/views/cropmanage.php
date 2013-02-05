<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Home</title>
        <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js'></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>fancyapps/source/jquery.fancybox.css" type="text/css" media="screen" />
        
        
        
                <!-- Add jQuery library -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="<?php echo base_url(); ?>fancyapps/lib/jquery.mousewheel-3.0.6.pack.js"></script>

<!-- Add fancyBox -->
<link rel="stylesheet" href="<?php echo base_url(); ?>fancyapps/source/jquery.fancybox.css?v=2.1.4" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo base_url(); ?>fancyapps/source/jquery.fancybox.pack.js?v=2.1.4"></script>

<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet" href="<?php echo base_url(); ?>fancyapps/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo base_url(); ?>fancyapps/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>fancyapps/source/helpers/jquery.fancybox-media.js?v=1.0.5"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>fancyapps/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo base_url(); ?>fancyapps/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>


<script type="text/javascript" href="<?php echo base_url(); ?>fancyapps/source/jquery.fancybox.pack.js"></script>
        <script type="text/javascript" href="<?php echo base_url(); ?>fancyapps/source/jquery.fancybox.js"></script>
     <script type="text/javascript">
	$(document).ready(function() {
                //$('.types').hide();
		$("a#link1").fancybox();
	});
</script>
        
        
        
	
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
.types{
    display: none;
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
        <li><a class="link1" id="link1"  href="#types">Land Registration</a></li>
        
        
        <li><?php echo anchor('transport',' Transport Services '); ?></li>
        <li><?php echo anchor('report',' View Reports '); ?></li>
        <li><?php echo anchor('farming/getallfarms','View Leased Farms'); ?></li>
        
      </ul>

</nav>
<div class="clear"></div>
        </header>
  <div class="types" id="types"> Do you want ot register a new Land or an Existing land? <ul><li><?php echo anchor('farming/landregistration',' Register a New Land!'); ?></li><li><?php echo anchor('farming/newfarmingactivity',' Use an Existing Registered Land!'); ?></li></ul></div>
	
 <div id="container">
 
 
<aside>
 <div class="widget" id="widget">
    
   <div>
	
	<?php if(Current_User::user()): ?>
		<h2>Hello <em><?php echo Current_User::user()->username; ?></em>.</h2>
		<h2><?php echo anchor('index.php/logout','Logout'); ?></h2>
		<h2 id="landregistration" name="landregistration" class="landregistration"><?php echo anchor('landregistration','Land Registration'); ?></h2>
		<h2><?php echo anchor('plots','File Uploads'); ?></h2>
		<h2><?php echo anchor('farming/getallfarms','View Leased Farms'); ?></h2>
                 <a href="large_image.jpg" class="fancybox" title="Sample title"><img src="small_image.jpg" /></a>
    
	<?php else: ?>
	<h2>Login/Register</h2>
		<h2>New Users: <?php echo anchor('createaccount','Create an Account'); ?>.</h2>
		<h2>Members: <?php echo anchor('login','Login'); ?>.</h2>
	<?php endif; ?>
	
	
</div>
   
</div>

</aside>

<div id="slideshow">
   <div>
     <img src="<?php echo site_url('images/1.jpg'); ?>" />
   </div>   
    <div>
     <img src="<?php echo site_url('images/2.jpg'); ?>" />
   </div>
   <div>
     <img src="<?php echo site_url('images/3.jpg'); ?>" />
   </div>
   <div>
     <img src="<?php echo site_url('images/4.jpg'); ?>" />
   </div>
   <div>
     <img src="<?php echo site_url('images/5.jpg'); ?>" />
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