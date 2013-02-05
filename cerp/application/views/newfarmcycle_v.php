
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>New Farm </title>
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js'></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" 
		type="text/css" media="all">
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/screen.css" 
		type="text/css" media="all">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>CRESCENT ENTRPRISE SYSTEM</title>
        <link rel="stylesheet" href="css/screen.css">

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
  <script type="text/javascript" src="<?php echo base_url(); ?>javascripts/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" 
		type="text/css" media="all">
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/screen.css" 
		type="text/css" media="all">
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css" />








<link rel="stylesheet" href="<?php echo base_url();?>zebra/css/reset.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url();?>zebra/css/zebra_dialog.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url();?>zebra/css/style.css" type="text/css">
       
        <script type="text/javascript" src="<?php echo base_url();?>zebra/javascript/zebra_dialog.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>zebra/javascript/functions.js"></script>


<script>
$(function() {
$( "#plantingdate" ).datepicker({dateFormat:'yy-m-d'});

var d = new Date('2013','01','02');
d.setMonth(d.getMonth()+18);
//alert()

});

</script>
<script>

$(document).ready(function(){
   $('#send').click(function(){
       var cropcycle=$("#cropcycle").val();
       var planting_date=$("#plantingdate").val();
       var acres=$().val("#acres");
       if(cropcycle==='' || planting_date==='' || acres===''){
           alert("Fields cannt be left empty");
           return false;
       }else{
       
       var farmname=$('#farmname1').val();
       datastring= $('#submit1').serialize();
       $.ajax({
           type:"POST",
           url:"<?php echo base_url();?>newfarmingactivity/submit",
       data:datastring,
           success:function(msg){
               
        $.Zebra_Dialog('<strong><?php echo $farmname; ?> registration was sucessfull!</strong>, Do you want to register a new Farm ' +
    'with a new crop cycle ?', {
    'type':     'question',
    'title':    'Custom buttons',
    'buttons':  [
                    {caption: 'Yes', callback: function() {window.location.href="<?php echo base_url();?>newfarmingactivity/" }},
                    {caption: 'No', callback: function() { window.location.href="<?php echo base_url();?>cropmanagement/" }},
                                ]
});        
       
   },
           error:function(msg){
               alert("<?php echo base_url();?>newfarmingactivity/submit");
           }
           
       });
       return true;
       }
   });

});

</script>


        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <link rel="stylesheet" href="css/screen.css">
 
  <script type="text/javascript" src="<?php echo base_url(); ?>javascript/datepickr.js"></script>
		
<input type="hidden" id="farmname1" value="<?php echo $farmname;?>"/>
<!--<input type="text" id="cycles1" value=""/>-->
     
        
        
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

     <div>
               <fieldset class="overall"> 
   <fieldset class="weight">
       <form id="submit1"/>
    <?php echo validation_errors('<p class="error">','</p>'); ?>
        
        <p><label>Crop Cycle: </label>
            <select name="cropcycle" id="cropcycle" class="cropcycle">
                 <option value=""> --Select Method--</option>
                    <?php foreach ($cropcycles as $value): ?>
                <option value="<?php echo $value->name;?>">
	<ul><li><?php echo $value->name;?></a></li></ul>
	</option>
<?php endforeach?>
        
            </select>
        
        <p> <label for="plantingdate" >Date of Plantation:</label>  <input type="text" id="plantingdate" class="plantingdate" name="plantingdate" placeholder="format:d-M-y" id="plantingdate" />  </p>
        
        <p> <label for="acres" >Number of Acres:</label>  <input type="number" id="acres" class="acres" name="acres" placeholder="integers only allowed" id="acres" />  </p>
  
        </p>
            
        <p> <input type="hidden" name="farmname" id="farmname" class="farmname"value="<?php echo $farmname; ?>"/></p>
                
                
                
</fieldset>  

        
       

      
        </fieldset>
         <input type="button" id="send" value="Submit"/>
        </p>
      <?php echo form_close(); ?>  
        
         
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