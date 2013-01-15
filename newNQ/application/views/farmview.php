<html>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">
	<head>
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

	</head> 
	<body>
<div id="container">
<aside>
 <div class="widget" id="widget">
  
   <div>
  
  <?php if(Current_User::user()): ?>
    <h3>Hello <em><?php echo Current_User::user()->username; ?></em>.</h3>
    <h3><?php echo anchor('index.php/logout','Logout'); ?></h3>
    <h3><?php echo anchor('index.php/landregistration','Land Registration'); ?></h3>
    <h3><?php echo anchor('index.php/weeding','Weeding'); ?></h3>
  <?php else: ?>
   <h3>Login/Register</h3> 
    <h3>New Users: <?php echo anchor('/index.php/createaccount','Create an Account'); ?>.</h3>
    <h3>Members: <?php echo anchor('index.php/login','Login'); ?>.</h3>
  <?php endif; ?>
  
  
</div>
   
</div>

</aside>
<div>


<?php echo form_open('farming/landregistration '); ?>
        <label for="f_state">State<span class="red">*</span></label>




        <select id="f_state" name="f_state" required>
            <option value="" selected=selected>--Select state--</option>
            <?php
            foreach($statename as $state):
                echo '<option value="' . $state->id . '">' . $state->zonename . '</option>';
            endforeach;
            ?>

        </select>
        <label for="f_city"  id="f_city_label">City<span class="red" >*</span></label>
        <!--this will be filled based on the tree selection above-->
        <select id="f_city" name="f_city" id="f_city_label"> 
            <option value=""></option>
        </select>
        
      <p>
      <?php echo form_submit('submit','Submit'); ?>
        </p>
<?php echo form_close(); ?>
</div>
<div> <table id='farms' >
	<thead>

<th>Id</th>
<th>Plot Number</th>
<th>Farm Name</th>
<th>Crop</th>
<th>Field Description</th>
<th>Leasor Name </th>


	</thead>
	<tbody >

<?php
foreach($query as $row){
	?>
	<tr>
	<td><span><?php echo $row->id ?></span></td>
	<td><span><?php echo $row->plotnumber ?></span></td>
	<td><span><?php echo $row->farmname ?></span></td>
	<td><span><?php echo $row->crop ?></span></td>
	<td> <span><?php echo $row->fielddescription ?></span></td>
	<td><span><?php echo $row->leasorname ?></span></td>
	

	</tr>
<?php 
}
?>
</tbody>
</table>
<br> <br>
<a href='toExcelAll'><span style='color:green;'>Export All Data</span></a>
</div>



	

</div>

	</body>
</html>