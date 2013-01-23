<script>
	$(document).ready(function() {
		$("#entry_form").dialog({
			height : 320,
			width : 510,
			modal : true,
			autoOpen : false
		});
		$("#new_client").click(function(){ 
			$("#entry_form").dialog("open");
		});
	});

</script>
<div id="view_content">
	<a class="action_button" id="new_client">New Client</a>
	<div align="center">
		<?php echo validation_errors('<p class="error">', '</p>');
		echo $this -> table -> generate($client_details);
		?>
	</div>
<div id="entry_form" title="New Client">
	<?php
	$attributes = array('class' => 'input_form');
	echo form_open('client_management/save', $attributes);

	?>
	<table>
<tr>
<td>Client Name</td>
<td><input type="text" name="client_name" /></td>
</tr>

<tr>
<td>Client Address</td>
<td><input type="text" name="client_address" /></td>
</tr>

<tr>
<td>Client Number</td>
<td><input type="text" name="client_number" /></td>
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
<td><select  name="clientT">
	<option>A</option>
	<option>B</option>
	<option>C</option>
	<option>D</option>
</select></td>

</tr>

<tr>
<td><input name="submit" type="submit" value="Save Client" class="button"></td>
</tr>
</table>
	</form>
</div>
</div>
