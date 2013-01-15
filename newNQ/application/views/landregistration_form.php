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
    $(document).ready(function(){
    $(function() {
        $( "#dateofcontract" ).datepicker({
           dateFormat: 'mm-dd-yy'
        });
    });
  });
    //$('.date').datePicker({startDate: '01/01/2012'});
    </script>
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

        <script type="text/javascript" src="<?php echo base_url(); ?>javascripts/jquery.min.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
  $('#f_city, #f_city_label').hide();
  
$('#f_state').change(function(){
    var state_id = $('#f_state').val();
    if (state_id != ""){
        var post_url = "get_cities_by_state/" + state_id;
        $.ajax({
             url: post_url,
        type: "POST",
        dataType: "json",
             success: function(cities) //we're calling the response json array 'cities'
              {
                //alert(cities);
                $('#f_city').empty();
                $('#f_city, #f_city_label').show();
                   $.each(cities,function(i, city) 
                   {
                    var opt = $('<option />'); // here we're creating a new select option for each group
                     opt.val(city.id);
                    opt.text(city.cityname);
                    $('#f_city').append(opt); 
                });
               } //end success
         }); //end AJAX
    } else {
        $('#f_city').empty();
        $('#f_city, #f_city_label').hide();
    }//end if
}); //end change
});
  </script>
        
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

      <p> <label for="plotnumber" > Plot No :</label>  <input type="text"  id="plotnumber" name="plotnumber" placeholder="e.g 1078250" />  </p>



       <p> <label for="farmname" >Farm Name:</label> <input name="farmname"  id="farmname" placeholder="e.g Buyofu 148" >  </p>



       <p> <label for="acre">Acre</label> <input type="text" name="acre" id="acre" placeholder="e.g 10(number only)"/> </p>


      <p> <label for="dateofcontract" >Date of Contract:</label>  <input type="text" name="dateofcontract" placeholder="format:d-M-y" id="dateofcontract"/>  </p>
      <p><label> Crop Cycle: </label> <input type="text" name="cropcycle" placeholder="plant crop / ratoon"></p>   
        <p><label for="zones"> Zone</label> <input type="text" name="zone" placeholder="" id="zone"/></p>
  

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