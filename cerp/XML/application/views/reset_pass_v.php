<?php
$use_id=$this -> session -> userdata('identity');
?>

<?php echo form_open('user_reset/submit'); ?>

				<table class="data-table" width="700">
	
	
	<?php echo validation_errors('<p class="error">','</p>'); ?>
	<tr><p>
		<label style="visibility: hidden"><input type="text" name="id" value="<?php echo $use_id?>" /></label>
		<td><label for="ppass">Previous Password:</label></td>
		<td><?php echo form_password('opassword'); ?></td>
	</p>
	</tr>
	<tr><p>
		<td><label for="npassword">Password: </label></td>
		<td><?php echo form_password('password'); ?></td>
	</p></tr>
	<tr><p>
		<td><label for="npassconf">Confirm Password: </label></td>
		<td><?php echo form_password('passconf'); ?></td>
	</p></tr>
	
	<tr><p>
		<td><?php echo form_submit('submit','Reset Password'); ?></td>
	</p></tr>
	<?php echo form_close(); ?>
	</table>