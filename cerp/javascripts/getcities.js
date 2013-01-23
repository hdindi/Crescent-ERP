  $(document).ready(function(){
	$('#f_city, #f_city_label').hide();
  
$('#f_state').change(function(){
    var state_id = $('#f_state').val();
    if (state_id != ""){
        var post_url = "control_form/get_cities_by_state/"+ state_id;
        $.ajax({
            url: post_url,
            type: "POST",
             
             dataType: 'json',
             success: function(cities) //we're calling the response json array 'cities'
              {
                alert(cities);
                $('#f_city').empty();
                $('#f_city, #f_city_label').show();
                   $.each(cities,function() 
                   {
                    var items=cities.id;
                   // var items1=cities.st;

                    alert(items);
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
});