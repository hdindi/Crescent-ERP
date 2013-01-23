<?php
$attributes = array('enctype' => 'multipart/form-data');
echo form_open('equipment_used_controller/save', $attributes);
echo validation_errors('
<p class="error">', '</p>
');
?>

<table>
	<tr>
		<td><label>Equipment Name</label></td>
		<td>
		<select name="equipment" id="equipment">
			<option value="0" selected>--Select Equipment--</option>
			<?php
			foreach ($equipments as $equip) {
				echo "<option value='$equip->id'>$equip->Name</option>";
			}
			?>
		</select></td>
	</tr>
	<tr>
		<td><label>Date of Last Calibration</label></td>
		<td>
		<input type="text" name="last_calibrated" />
		</td>
	</tr>
	<tr>
		<td><label>Date of Next Calibration</label></td>
		<td>
		<input type="text" name="next_calibration" />
		</td>
	</tr>
	<tr>
		<td><label>Remarks</label></td>
		<td>		<textarea name="remarks"></textarea></td>
	</tr>
	<tr>
		<td></td><td>
		<input name="submit" type="submit" value="Save Equipment">
		</td>
	</tr>
</table>
<?php echo form_close();?>