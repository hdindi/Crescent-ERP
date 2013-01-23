 <!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Home</title>
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js'></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>javascripts/jquery.1.8.2.js"></script>
	<script type="text/javascript">
	$('#f_city, #f_city_label').hide();
$('#f_state').change(function(){
    var state_id = $('#f_state').val();
    if (state_id != ""){
        var post_url = "/index.php/control_form/get_cities/" + state_id;
        $.ajax({
            type: "POST",
             url: post_url,
             success: function(cities) //we're calling the response json array 'cities'
              {
                $('#f_city').empty();
                $('#f_city, #f_city_label').show();
                   $.each(cities,function(id,city) 
                   {
                    var opt = $('<option />'); // here we're creating a new select option for each group
                      opt.val(id);
                      opt.text(city);
                      $('#f_city').append(opt); 
                });
               } //end success
         }); //end AJAX
    } else {
        $('#f_city').empty();
        $('#f_city, #f_city_label').hide();
    }//end if
}); //end change
	</script>
 </head>
 <body>
 	<p>
 <?php

echo form_dropdown('PLOT NUMBER',$dropdown);
?>


 <?php echo form_open('control_form/add_all'); ?>
        <label for="f_state">State<span class="red">*</span></label>
        <span><select id="f_state" name="f_state">
            <option value=""></option>
            <?php
            foreach($dropdown as $state){
                echo '<option value="' . $state->id . '">' . $state->statename . '</option></br>';
            }
            ?>

        </select> </span></br>
        <label for="f_city">City<span class="red">*</span></label>
        <!--this will be filled based on the tree selection above-->
        <select id="f_city" name="f_city" id="f_city_label"> 
            <option value=""></option>
        </select>
        <label for="f_membername">Member Name<span class="red">*</span></label>
      <input type="text" name="f_membername"/>
<?php echo form_close(); ?>

<?php
/*
foreach($dropdown as $state)
{
?>
<option value = "<?php echo $state->id?>"><?php echo $state->statename;?></option>
<?php
}*/
?>

</p>
</body>
</html>
