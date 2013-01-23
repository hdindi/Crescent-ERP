<script>
	$(document).ready(function() {
		$("#entry_form").dialog({
			height : 200,
			width : 400,
			modal : true,
			autoOpen : false
		});
		$("#new_test").click(function(){ 
			$("#entry_form").dialog("open");
		});
	});

</script>
<div id="view_content">
	<a class="action_button" id="new_test">New test</a>
	<div align="center">
		<?php echo validation_errors('<p class="error">', '</p>');
		echo $this -> table -> generate($test_details);
		?>
	</div>
<div id="entry_form" title="New Test">
	<?php
	$attributes = array('class' => 'input_form');
	echo form_open('test_controller/save', $attributes);

	?>
	<table>
		<tr>
			<td>Test Name</td>
			<td><input type="text" name="test_name" /></td>
		</tr>

		<tr>
			<td>Test Charge(s)</label></td>
			<td><input type="text" name="charges" /></td>
		</tr>

		<tr>
			<td><input name="submit" type="submit" value="Save Test" class="button"></td>
		</tr>
	</table>
	</form>
</div>
</div>
