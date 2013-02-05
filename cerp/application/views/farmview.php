<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Home</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" 
		type="text/css" media="all">
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/screen.css" 
		type="text/css" media="all">
                
                <link rel="stylesheet" href="<?php echo base_url(); ?>css/screen.css" 
    type="text/css" media="all">
		<script type="text/javascript" src="<?php echo base_url()."javascripts/jquery-1.8.2.js"?>"></script>
		<script type="text/javascript" charset="utf-8" src="<?php echo base_url()."javascripts/datatables/media/js/jquery.dataTables.js"?>"></script>
		<link rel="stylesheet" href="<?php echo base_url(); ?>javascripts/datatables/media/css/jquery.dataTables.css" type="text/css" rel="stylesheet"/>
		<link rel="stylesheet" href="<?php echo base_url(); ?>javascripts/datatables/media/css/jquery.dataTables.css" 
		type="text/css" media="all">

	<script>

	$(document).ready(function(){
    $('#farms').dataTable();
		} );
	</script>

	<script type="text/javascript" src="<?php echo base_url(); ?>jaascripts/jquery.min.js"></script>

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
                    opt.text(city.farmname);
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
                

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>CRESCENT ENTERPRISE SYSTEM</title>
      
        
    

        
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
       
       
                 
   
<div> <table id='farms'style='color:black;' >
	<thead style='color:black;'>

<th style='color:black;'>Id</th>
<th style='color:black;'>Plot Number</th>
<th style='color:black;'> Acres </th>
<th style='color:black;'>Crop</th>
<th style='color:black;'>Field Description</th>
<th style='color:black;'>Leasor Name </th>


	</thead >
	<tbody style='color:black;' >

<?php
foreach($query as $row){
	?>
	<tr>
	<td><span style='color:black;'><?php echo $row->id ?></span></td>
	<td><span style='color:black;'><?php echo $row->name ?></span></td>
	<td><span style='color:black;'><?php echo $row->acre ?></span></td>
	<td><span style='color:black;'><?php echo $row->zone ?></span></td>
	<td> <span style='color:black;'><?php echo $row->dateofcontract ?></span></td>
	<td><span style='color:black;'><?php echo $row->leasorname ?></span></td>
	

	</tr>
<?php 
}
?>
</tbody>
</table>
<br> <br>
<a href='toExcelAll'><span style='color:green;'>Export All Data</span></a>
</div>


       </p>

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