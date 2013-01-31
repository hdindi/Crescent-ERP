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



    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>CRESCENT ENTRPRISE SYSTEM</title>
        <link rel="stylesheet" href="css/screen.css">
       <style>
    .container {
      margin-top:5px;
      margin-left:5px;
    }

    .container ul {
      color: #E59934;
    }

    .container ul li {
      margin:5px;
      padding:5px;
      width: 100px;
      height:70px;
      float: left;  
      border: 1px solid lightgray;
      list-style:none;
      
    }

    .container ul li:hover {
      border: 1px solid orange;
    }
  </style>
    
    <script type="text/javascript" src="<?php echo base_url()."Scripts/FusionCharts/FusionCharts.js"?>"></script>
    
    

     
        
  </head>
    <header>      
  
            <h4 class="logo"> 
      
    
    </h4>
             <nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><?php echo anchor('farming/landregistration',' Land Registration '); ?></li>
        <li><?php echo anchor('farming/weeding',' Weeding '); ?></li>
        <li><?php echo anchor('farming/harvesting',' Harvesting '); ?></li>
        <li><?php echo anchor('report','View  Perfrmance Reports'); ?></li>
        
      </ul>

</nav>
<div class="clear"></div>
        </header>

	
 <div id="container">
 
 
 <fieldset class="overall"> 
   <fieldset class="weight">
       <p>     
       
       
  <div > 

<span>  <object align="" style="padding-left: 25px;" >
  
<?php  echo @$pie_graph;
      ?>
        
      </object> </span>
 
</div>

<div > 

<span>  <object align="" style="padding-right: 25px;">
  
<?php  echo @$column_graph;
      ?>
        
      </object> </span>

</div>

</fieldset>  

        
       

      
        </fieldset>
       
  
      </fieldset>
         <p>
    
  
</div>

</div>
<footer>
             crescentfarm.com. All rights reserved &copy; <?php echo date ('Y');?>.
        </footer>
</html>