

<!--div class="" id="confirm-dialog"><p class="alert">Confirm assignment?</p></div-->

<div class="view_content">
	
	<fieldset id="assign_tests" class="no_border">
		
	<legend>Sample Issuance&nbsp;&rarr;&nbsp;<?php
	
	$reqid = $this -> uri -> segment(3)."/".$this -> uri -> segment(4)."/".$this -> uri -> segment(5)."/".$this -> uri -> segment(6);
	
	echo $reqid; ?></legend>
	
	<hr>
	
	<table id="tests">
	
		<tr>&nbsp;</tr>	
		
		<tr id="assign_tests_title" class="center_text" >
		<th>Test</th><!--th>Limits</th--><th>Analyst</th><th>Department</th><th>Samples Issued</th><th>Status</th><th>Assign</th>
		</tr>
	
		<?php 
		
		foreach($mytests as $test){?>
		
		<?php
		$attributes = array('id' => 'entry_form');
		echo form_open('sample_issue/save/'. $reqid . '/'.$test['id'],$attributes);
		echo validation_errors('
		<p class="error">', '</p>
		');
		?>
		
		
		<!--form action="#" method="post" -->
		
		
		<tr id="assign_tests_body">	
			<!--div id="message"></div-->
			<td><input type="text" name="test_name" readonly placeholder="e.g Assay" id = "<?php echo $test['Department']; ?>" value="<?php echo $test['Name']; ?>" required  /></td>
			<!--td><input type="text" name="test_limit" placeholder="e.g 90%" required /></td-->
	
			<td><select name="analyst_id" id="analyst_id" >
				<?php
					//var_dump($analysts);		
					foreach ($analysts as $analyst) {
						
						//<!--<script> if("#")</script-->
					if($test['Department'] = $analyst['department_id']) {		
						
					echo '<option value="' . $analyst['id']. '" id = ' . $analyst['department_id']. '>'  . $analyst['fname']." ".$analyst['lname'] . '</option>'; ?>
								
					
				
					<?php }}?>
			</select></td>
			
			<td><input type="text" readonly name="test_department" id="<?php echo $departments[0]['id']; ?>" placeholder="" value="<?php echo $departments[0]['Name']; ?>" required /></td>
			<td><input type="text" id="samples_no" name="samples_no" value="" placeholder="50" required/></td>
			
			<td>
			<label id="status_name" class="">Documentation Stores</label>
			</td>	
		
		<td><input type="submit" value="Assign Sample" class="submit-button" id="assign_submit" name="assign_submit"/></td>
		
	</tr>
		
		<input type="hidden" id="test_id"  name="test_id" value= "<?php echo $test['id'];?>">
		<input type="hidden" id="department_id" name="department_id" value= "<?php echo $departments[0]['id'];?>">
		<input type="hidden" id="lab_ref_no" name="lab_ref_no" value= "<?php echo $reqid;?>">
		<input type="hidden" name="status_id" id="status_id" value= "">
		
		</form>
		<?php  }?>
	</table>
</fieldset>
</div>
