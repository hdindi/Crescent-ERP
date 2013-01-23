<script>
	$(function() {
		
		$("#entry_form").dialog({
			height : 300,
			width : 500,
			modal : true,
			autoOpen : false
		});
		
		$("#neworreturning").dialog({
			resizable : false,
			height : 140,
			modal : true,
			buttons : {
				"New" : function() {
					$(document.getElementById("applicant_name")).replaceWith('<input type="text" name="applicant_name" id="applicant_name"/>');
					$(this).dialog("close");
					$("#entry_form").dialog("open");
				},
				"Returning" : function() {
					$(this).dialog("close");
				}
			}
		});
	});

</script>

<script type="text/javascript" src="../Scripts/required_css.js"></script>

<div id="entry_form" title="New Client">
	<?php
	$attributes = array('class' => 'input_form');
	echo form_open('client_management/save', $attributes);

	?>
	<table>
<tr>
<td>Client Name</td>
<td><input type="text" name="client_name" value=""/></td>
</tr>

<tr>
<td>Client Address</td>
<td><input type="text" name="client_address" /></td>
</tr>


<tr>
<td>Client Ref. Number</td>
<td><input type="text" name="client_ref_no" /></td>
</tr>

<tr>
<td>Contact Person</td>
<td><input type="text" name="contact_person" /></td>
</tr>

<tr>
<td>Contact Telephone Number</label></td>
<td><input type="text" name="contact_phone" /></td>
</tr>
<tr>
<td>Client Type</td>
<td><select id="clientT" name="clientT">
	<option value="A">A</option>
	<option value="B">B</option>
	<option value="C">C</option>
	<option value="D">D</option>
	<option value="E">E</option>
</select></td>
</tr>

<tr>
<td><input name="submit" type="submit" value="Save Client" class="submit-button"></td>
</tr>
</table>
	</form>
</div>

<?php
$attributes = array('enctype' => 'multipart/form-data');
echo form_open('request_management/save', $attributes);
echo validation_errors('
<p class="error">', '</p>');
?>

<input type="hidden" name="lab_ref_no" id="lab_ref_no" value="" />

<p class="labrefno">Analysis Request Register&nbsp;&rarr;&nbsp;<label class="labrefno" id="labref_no"></label></p>

<table id="tests" class="">
<!--tr>
	<th style="font-size: 13px">ANALYSIS REQUEST REGISTER</th>
</tr-->

<legend><hr /></legend>

<tr></tr>

<tr>
<td>Applicant Name</td>
<td>
	<select name="applicant_name" id="applicant_name">
				<option value="" id=""></option>
				<?php
				foreach ($clients as $client) {
					echo '<option value="' . $client -> id . '" id="' . $client -> Client_type . '">' . $client -> Name . '</option>';
				}//end foreach
				?>
			</select>
			<input type="hidden" name="clientid" id="clientid"/>
</td>

<td>Applicant Address</td>
<td><input type="text" name="applicant_address" id="applicant_address" value="" required/></td>
</tr>

<tr>
<td>Contact Name</td>
<td>		<input type="text" id="contact_name" name="contact_name" required ></label>
</td>

<td>Contact Telephone</td>
<td><input type="text" name="contact_telephone" id="contact_telephone" required /></td>
</tr>


<tr>
<td>Product Name</td>
<td><input type="text" name="product_name" required /></td>

<td>Dosage Form</td>
<td><input type="text" name="dosage_form" required /></td>
</tr>

<tr>
<td>Manufacturer Name</td>
<td><input type="text" name="manufacturer_name" required /></td>

<td>Manufacturer Address</td>
<td><input type="text" name="manufacturer_address" required /></td>
</tr>

<tr>
<td>Batch/Lot Number</td>
<td><input type="text" name="batch_no" required /></td>
</tr>

<tr>
<td>Manufacture Date</td>
<td><input type="text" name="manufacture_date" id="manufacture_date" required /></td>

<td>Expiry Date</td>
<td><input type="text" name="expiry_date" id="expiry_date" required /></td>
</tr>

<tr>
<td>Active Ingredients</td>
<td><input type="text" name="active_ingredients" required /></td>

<td>Quantity Submitted</td>
<td><input type="text" name="quantity" required /></td>
</tr>

<tr>
<td id="ref_no_td">Applicant's Reference Number</td>
<td><input type="text" name="applicant_reference_number" id="appl_ref_no" /></td>
</tr>
</table>

<div id="neworreturning" title="New or Returning Client">Is this a new or returning client?</div>

<table>
<tr>
<legend>Departmental Tests</legend>
<hr />

</tr>

<tr>
<!--Accrodion-->
<td>
<div class="Accordion" id="sampleAccordion" tabindex="0">
	<div class="AccordionPanel">
		<div class="AccordionPanelTab"><b>Wet Chemistry Department</b></div>
		<div class="AccordionPanelContent">
			<table>
				<?php

				foreach ($wetchemistry as $wetchem) {
					echo "<tr><td>" . $wetchem -> Name . "</td><td><input type=checkbox id=" . $wetchem -> Alias . " value=" . $wetchem -> id. " name=test[]/></td></tr>";
				}
			?>
			</table>
		</div>
	</div>
	<div class="AccordionPanel">
		<div class="AccordionPanelTab"><b>Microbiological Analysis Department</b></div>
		<div class="AccordionPanelContent">
			<table>
				<?php

				foreach ($microbiologicalanalysis as $microbiology) {
					echo "<tr><td>" . $microbiology -> Name . "</td><td><input type=checkbox id=" . $microbiology -> Alias . " name=test[] value=" . $microbiology -> id . " /></td></tr>";
				}
				?>
			</table>
		</div>
	</div>
	<div class="AccordionPanel">
		<div class="AccordionPanelTab"><b>Medical Devices Department</b></div>
		<div class="AccordionPanelContent">
			<table>
			<?php

			foreach ($medicaldevices as $medical) {
				echo "<tr><td>" . $medical -> Name . "</td><td><input type=checkbox id=" . $medical -> Alias . " name=test[] value=" . $medical -> id . " /></td></tr>";
			}
			?>
			</table>
		</div>
	</div>
</div>
</td>
<!-- End Accrodion-->
<td>Full Monograph <input type="checkbox" name="fullmonograph" id="fullmonograph" value="fullmonograph" /></td>
</tr>
</table>

<table>
<tr>
	<legend>Authorization</legend>
</tr>

<hr />

<tr>
	<td>Name</td><td><input type="text" name="designator_name" required /></td> 
	
	<td>Designation</td><td><select name="designation">
		
				<?php
				foreach ($usertypes as $usertype) {
					echo '<option value="' . $usertype -> id.'">' . $usertype -> name . '</option>';
				}//end foreach
				?>
		
		
	</select></td>
	
	<td>Date</td><td><input type="text" name="designation_date" id="designation_date" required/></td>
</tr>
<tr>
	<td><input class="submit-button" name="submit" type="submit" value="Save Request"></td>
</tr>
</table>

<script>
	$("#applicant_name").change(function() {
		var str = "";
		
		$("#applicant_name option:selected").each(function() {
			str += $(this).attr("id") + "";
		});
		$("#labref_no").text("NDQ" + str + "/" + <?php echo date('Y') ?> + "/" + <?php echo date('m')?> + "/" + <?php echo $last_req_id -> id + 1; ?>);
		var label_contents = $("#labref_no").html();
		$("#lab_ref_no").val(label_contents);
	}).trigger('change');
</script>

<script>
	$('#applicant_name').change(function() {
		$.ajax({
			url : '../api.php',
			data : "id=" + $(this).val(),

			dataType : 'json',
			success : function(data) {
				//alert(data);
				var phone = data[5];
				var address = data[2];
				var name = data[4];
				var clientid = data[0];
				

				$('#contact_name').val(name);
				$('#clientid').val(clientid);
				$('#applicant_address').val(address);
				$('#contact_telephone').val(phone);
					
			}
		});
	});

	</script>
	<script language="JavaScript" type="text/javascript">
		var sampleAccordion = new Spry.Widget.Accordion("sampleAccordion");

		$(function() {
			$("#fullmonograph").change(function() {
				if($('#fullmonograph').is(':checked')) {
					document.getElementById("identification").checked = true;
					document.getElementById("dissolution").checked = true;
					document.getElementById("disintegration").checked = true;
					document.getElementById("friability").checked = true;
					document.getElementById("assay").checked = true;
					document.getElementById("uniformity").checked = true;
					document.getElementById("ph").checked = true;
					document.getElementById("contamination").checked = true;
					document.getElementById("sterility").checked = true;
					document.getElementById("endotoxin").checked = true;
					document.getElementById("integrity").checked = true;
					document.getElementById("viscosity").checked = true;
					document.getElementById("microbes").checked = true;
					document.getElementById("efficacy").checked = true;
					document.getElementById("melting").checked = true;
					document.getElementById("relativity").checked = true;
					document.getElementById("condom").checked = true;
					//document.getElementById("syringe").checked = true;
					document.getElementById("needle").checked = true;
					document.getElementById("glove").checked = true;
					document.getElementById("refractivity").checked = true;
				}
				
			});
		});
		$(function() {
			$( "#expiry_date" ).datepicker({
				dateFormat: 'd M, yy', 
			
			});
			$( "#manufacture_date" ).datepicker({
				dateFormat: 'd M, yy', 
			
			});
			$( "#designation_date" ).datepicker({
				dateFormat: 'd M, yy', 
			
			});
			
			
		});

	</script>
<?php echo form_close();?>