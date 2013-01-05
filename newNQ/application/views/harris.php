<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Home</title>
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js'></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>javascripts/jquery.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" 
		type="text/css" media="all">
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/screen.css" 
		type="text/css" media="all">
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
        <script type="text/javascript" src="<?php echo base_url(); ?>javascripts/jquery-1.8.2.js"></script>
        <script>
    $(document).ready(function(){
        $('#submit').click(function(){        
            dataString2=$('#harris').serialize();        
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>/weeding",
                data: dataString2,
                success: function() {
                    alert("Got Data ");
                },
                error: function(){
                    alert('An internal problem has been experienced!');
                }
                
            });
        }); 
        });
           
    
    
    $(document).ready(function() {

                // $("div#sampleassay").hide();
                //standard preparation
                $("#type2").attr("disabled", "disabled");
                $("#cost1").attr("disabled", "disabled");
                $("#res1").attr("disabled", "disabled");
                $("#type3").attr("disabled", "disabled");
                $("#cost3").attr("disabled", "disabled");
                $("#res3").attr("disabled", "disabled");


                $("#dill1").click(function() {
                    if ($("#dill1").is(":checked", true)) {
                        $("#type2").attr("disabled", false);
                        $("#cost1").attr("disabled", false);
                        $("#res1").attr("disabled", false);



                    } else {
                        $("#type2").attr("disabled", "disabled");
                        $("#cost1").attr("disabled", "disabled");
                        $("#res1").attr("disabled", "disabled");
                        $('#cost1').val('');
                        $('input.result').val('');

                    }
                });
                $("#dill2").click(function() {
                    if ($("#dill2").is(":checked", true)) {
                        $("#type3").attr("disabled", false);
                        $("#cost3").attr("disabled", false);
                        $("#res3").attr("disabled", false);



                    } else {
                        $("#type3").attr("disabled", "disabled");
                        $("#cost3").attr("disabled", "disabled");
                        $("#res3").attr("disabled", "disabled");
                        $('#cost3').val('');
                        $('input.result').val('');



                    }

                });

                $('.num').live('keyup', function() {
                    var sum = 0;
                    var sum1 = 0;

                    $('.num').each(function() {
                        sum += Number($(this).val());
                        sum1 = sum.toFixed(2);

                    });

                    $('input.result').val(sum1);


                });


                $('#recalculate').click(function() {
                    var sum = 0;
                    var sum1 = 0;

                    $('.num').each(function() {
                        sum += Number($(this).val());
                        sum1 = sum.toFixed(2);

                    });

                    $('input.result').val(sum1);


                });

            });
        </script>
        <style type="text/css" >
            fieldset.class12{
                width: 200px;
                float: left;
            }
            fieldset.class13{
                width: 200px;
                float: left;
            }
        </style>
        
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
 <?php

echo form_dropdown('PLOT NUMBER',$dropdown);
?>
 
     <form id="harris">
     
            <fieldset class12>
                <div class="class1">

                    <legend>A</legend>

                    <p><label for="type">Type</label>
                        <select id="type1"required="true">
                            <option value="">--Select--</option>
                            <option value="chemical">Chemical</option>
                            <option value="hand">Hand</option>
                        </select>
                    </p>

                    <p><label for="cost">Cost</label>
                        <input type="text" name="cost" id="cost"  required="true" class="num"/></p>
                    <p><label for="res">Resources</label>
                        <input type="text" name="res" id="res" required="true"/></p>
                </div>
            </fieldset>
            <fieldset class13>
                <input type="checkbox" name="dill1" id="dill1">
                <div class="class12">

                    <legend>B</legend>
                    <p><label for="type">Type</label>
                        <select id="type2">
                            <option value="">--Select--</option>
                            <option value="chemical">Chemical</option>
                            <option value="hand">Hand</option>
                        </select>
                    </p>

                    <p><label for="cost1">Cost</label>
                        <input type="text" name="cost1" id="cost1" class="num"/></p>
                    <p><label for="res1">Resources</label>
                        <input type="text" name="res1" id="res1"/></p>
                </div>
            </fieldset>
            <fieldset class13>
                <input type="checkbox" name="dill2" id="dill2">
                <div class="class12">

                    <legend>C</legend>
                    <p><label for="type">Type</label>
                        <select id="type3">
                            <option value="">--Select--</option>
                            <option value="chemical">Chemical</option>
                            <option value="hand">Hand</option>
                        </select>
                    </p>

                    <p><label for="cost3">Cost</label>
                        <input type="text" name="cost3" id="cost3" class="num"/></p>
                    <p><label for="res3">Resources</label>
                        <input type="text" name="res3" id="res3" /></p>

                    <input type="text" id="result" name="result" class="result" value=""/>
                </div>
            </fieldset>

            <input type="button" value="submit" id="submit"/>
            <input type="button" value="recalculate" id="recalculate"/>

        </form>
  
  
</div>
           
           

</div>
<footer>
             crescentfarm.com. All rights reserved &copy; <?php echo date ('Y');?>.
        </footer>
</html>