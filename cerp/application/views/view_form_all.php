  <!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Home</title>
	
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
<body>
	<p>
<?php echo form_open('control_form/add_all'); ?>
        <label for="f_state">State<span class="red">*</span></label>




        <select id="f_state" name="f_state" required>
            <option value="" selected=selected>--Select state--</option>
            <?php
            foreach($statename as $state):
                echo '<option value="' . $state->id . '">' . $state->statename . '</option>';
            endforeach;
            ?>

        </select>
        <label for="f_city"  id="f_city_label">City<span class="red" >*</span></label>
        <!--this will be filled based on the tree selection above-->
        <select id="f_city" name="f_city" id="f_city_label"> 
            <option value=""></option>
        </select>
        <label for="f_membername">Member Name<span class="red">*</span></label>
      <input type="text" name="f_membername"/>
<?php echo form_close(); ?>


	</p>
</body>
</html>