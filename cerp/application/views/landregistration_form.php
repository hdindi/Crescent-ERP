<!DOCTYPE html>
<html lang="en">
<head>
	
<meta charset="utf-8" />
<title>CRESCENT FARM:LAND REGISTRATION</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
  <script type="text/javascript" src="<?php echo base_url(); ?>javascripts/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" 
		type="text/css" media="all">
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/screen.css" 
		type="text/css" media="all">
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css" />
<script>
$(function() {
$( "#dateofcontract" ).datepicker();
});
</script>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <link rel="stylesheet" href="css/screen.css">
 
  <script type="text/javascript" src="<?php echo base_url(); ?>javascript/datepickr.js"></script>
		<script type="text/javascript">
			
			
			new datepickr('dateofcontract', {
				'dateFormat': 'm/d/y'
			});
			
			
		</script>

      
        
  </head>
    <header>      
  
            <h4 class="logo"> 
      
    
    </h4>
             <nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><?php echo anchor('landregistration',' Land Registration '); ?></li>
        <li><?php echo anchor('weeding',' Weeding '); ?></li>
        <li><?php echo anchor('harvesting',' Harvesting '); ?></li>
        <li><?php echo anchor('farming/getallfarms','View Leased Farms'); ?></li>
        
      </ul>

</nav>
<div class="clear"></div>
        </header>

	
 <div id="container">
 
 
 <fieldset class="overall"> 
   <fieldset class="weight">
  <p>



  </p>
    
    <?php echo form_open('/index.php/landregistration/submit'); ?>
    <?php echo validation_errors('<p class="error">','</p>'); ?>
   <legend></legend><h3>Land Leasing Information</h3> 
       <p><label for="leasorname" > Leasor Name :</label>  <input type="text" name="leasorname" id="leasorname" placeholder="e.g Shikuku Wanyama"/> </p>

     


       <p> <label for="farmname" >Farm Name:</label> <input name="farmname"  id="farmname" placeholder="e.g Buyofu 148" >  </p>



       <p> <label for="acre">Acre</label> <input type="text" name="acre" id="acre" placeholder="e.g 10(number only)"/> </p>


      <p> <label for="dateofcontract" >Date of Contract:</label>  <input type="text" id="dateofcontract" class="dateofcontract" name="dateofcontract" placeholder="format:d-M-y" id="dateofcontract"/>  </p>
      <p><label> Crop Cycle: </label> <input type="text" name="cropcycle" placeholder="plant crop / ratoon" id="cropcycle"/> </p>   
        <p><label for="zones"> Zone</label> <input type="text" name="zone" placeholder="e.g TESO" id="zone"/></p>
  

</fieldset>  

        
       

      
        </fieldset>
       
  
      </fieldset>
         <p>
      <?php echo form_submit('submit','Submit'); ?>
        </p>
      <?php echo form_close(); ?>

  
  
</div>

</div>
<footer>
             crescentfarm.com. All rights reserved &copy; <?php echo date ('Y');?>.
        </footer>
</html>