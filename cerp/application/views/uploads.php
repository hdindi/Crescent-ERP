





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

<div id="main">
	<img id="beta" src="<?=base_url()?>images/beta.png" />
	<div id="top"></div>
	<div id="middle">
		
		<img id="logo" src="<?=base_url()?>images/logo.png" /> <h1>: Upload</h1>
		
		<form enctype="multipart/form-data" action="<?=site_url().'uploads/do_upload/'.$farm.'/'.$cyclename?>" method="post">
                    <label> Please Upload Excel file with the  farm name : <?php echo $farm; ?> and of crop cycle : <?php echo $cyclename; ?></label>
			<div id="boxtop"></div><div id="boxmid">

				<div class="section">
					<span>File:</span>
					<input type="file" name="userfile" />
				</div>

			</div><div id="boxbot"></div>
	
			<div class="text" style="float: left;"><p>Before uploading, check out</p><p>the <a href=#>Terms of Service</a>.</p></div>
		   	<div class="text" style="float: right;">

			<input type="submit" value="Upload" name="upload" class="submit" />
		</div>
		<br style="clear:both; height: 0px;" />
		
		</form>
	
	</div>
	<div id="bottom"></div>
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