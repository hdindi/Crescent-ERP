<head>
<style type="text/css">
table{
	width:330px;
	border:#000000 1px solid;
	margin:auto;
	text-align: center;
}
td, th{
	border:#000000 1px solid;
	margin:0px;	
}
input[type=text]{
	width:250px;
	height:20px;
}

</style>
   <link rel="stylesheet" type="text/css" href="stylesheets/jquery.validate.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/style1.css" />
        <script src="lib/jquery/jquery-1.3.2.js" type="text/javascript">
        </script>
        <script src="javascripts/jquery.validate.js" type="text/javascript">
        </script>
        <script src="javascripts/jquery.validation.functions.js" type="text/javascript">
        </script>
        <script src="javascripts/nqcl.js" type="text/javascript">
        </script>
    <script type="text/javascript" >
        
  $.fn.sumValues = function() {
	var sum = 0;
	this.each(function() {
		if ( $(this).is(':input') ) {
			var val = $(this).val();
		} else {
			var val = $(this).text();
		}
		sum += parseFloat( ('0' + val).replace(/[^0-9-\.]/g, ''), 10 );
	});
	return sum;
};
$(document).ready(function() {
	$('input.p').bind('keyup', function() {
		$('span.sc').html( $('input.p').sumValues()); 
                
                               $('span.smean').html( $('input.p').sumValues()/4 );

         var myspan = document.getElementById('sa');
        var span_textnode = myspan.firstChild;
        var span_text = span_textnode.data;
          $('input#pHreading').val(span_text);
          
          
          
           var myspan1 = document.getElementById('sa1');
        var span_textnode1 = myspan1.firstChild;
        var span_text1 = span_textnode1.data;          
          $('input#pHmean').val( span_text1);
          
          
          
	});    

        });
         jQuery(function(){
                jQuery("#p1").validate({
                    expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
                    message: "Please enter a valid number"
                });
                   jQuery("#p2").validate({
                    expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
                    message: "Please enter a valid number"
                });
                   jQuery("#p3").validate({
                    expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
                    message: "Please enter a valid number"
                });
                   jQuery("#p4").validate({
                    expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
                    message: "Please enter a valid number"
                   });
                
                
				jQuery('.AdvancedForm').validated(function(){
					alert("Use this call to make AJAX submissions.");
				});
            });



    </script>
        <script src="javascripts/nqcl.js" type="text/javascript">
        </script>
</head>
<body>
   <p> <center>Determination of pH</center></p>
<hr />
<?php echo form_open('ph/save_ph');?>
<table width="332" border="0" cellpadding="1" cellspacing="0">
  <tr>
    <th width="133">No</th>
    <th width="220">Sample pH reading</th>
  </tr>
  <tr>
    <td>1</td>
    <td><input type="text" name="pH1" id="p1" class="p" required/></td>
  </tr>
  <tr>
    <td>2</td>
    <td><input type="text" name="pH2" id="p2" class="p" required/></td>
  </tr>
  <tr>
    <td>3</td>
    <td><input type="text" name="pH3" id="p3" class="p" required/></td>
  </tr>
  <tr>
    <td>4</td>
    <td><input type="text" name="pH4" id="p4" class="p" required/></td>
  </tr>
  <tr>
      <td><strong>Mean</strong></td>
      
    <td><span class="smean" id="sa1"></span></td>
    <input type="hidden" name="pHmean" id="pHmean"  />
  </tr>
</table>
<center>
<p><strong>ph of the sample:</p></strong> <span class="sc" id="sa"></span>
  <input type="hidden" name="pHreading" id="pHreading"  />
</p></center>
 <p><input type="submit" value="Save pH" class="submit-button" id="FormSubmit"></input></p>
</form>
