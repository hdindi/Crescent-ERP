
<div class="view_content">
<?php
$attributes = array('id' => 'entry_form');
echo form_open('sample_controller/save',$attributes);
echo validation_errors('
<p class="error">', '</p>
');
?>


<table class="dave-table">
	
	<fieldset class="no_border">
		
		<legend>Sample Information&nbsp;&rarr;&nbsp;<?php echo $mylist['request_id'] ?></legend>	
	
	<hr>
	
	<tr>
		<td><label>Date Sample Submitted</label></td><td><input type="text" name="submission_date" value="<?php echo date('Y-M-d'); ?>" required /></td>
		<td><label>Laboratory Reference No.</label></td><td><input type="text" name="lab_ref_no" value="<?php echo $mylist['request_id']; ?>" required /></td>
	</tr>
	
	<tr> 
		<td><label>Product Generic/Brand Name</label></td><td><input type="text" name="generic_brand_name" value="<?php echo $mylist['product_name'];?>" required /></td>
		<td><label>Product Chemical Name</label></td><td><input type="text" name="chemical_name" placeholder="e.g Amoxicillin Trihydrate" required /></td>
		<td></td>
	</tr>
	
	<tr>
		<td><label>Product Description</label></td><td><textarea name="description" title="Describe how product looks like" required  ></textarea></td>
		<td><label>Product Presentation</label></td><td><textarea type="text" name="presentation" title="Describe how product is presented, Viles, Tablets e.t.c" required></textarea></td>
	</tr>
	
	
	<tr>
		<td><label>Label Claim</label></td><td><input type="text" name="label_claim" placeholder="e.g Label Claim" required /></td>
	</tr>
	
	
	<tr>
		<td><label>Batch/Lot No</label></td><td><input type="text" name="batch_no" value="<?php echo $mylist['Batch_no'];?>" required /></td>
		<td><label>Product License No</label></td><td><input type="text" name="product_lic_no" placeholder="e.g Raj./ No .1640" required /></td>
	</tr>
	
	<tr>
		<td><label>Date of manufacture</label></td><td><input type="text" name="manufacture_date" value="<?php echo $mylist['Manufacture_date'];?>" required /></td>
		<td><label>Date of expiry</label></td><td><input type="text" name="expiry_date" value="<?php echo $mylist['exp_date'];?>" required /></td>
	</tr>
	
	<tr>
		<td><label>Manufacturer</label></td><td><input type="text" name="manufacturer" value="<?php echo $mylist['Manufacturer_Name'];?>" required /></td>
		<td><label>Country of Origin</label></td><td><input type="text" name="country_of_origin" placeholder="e.g India" required /></td>
	</tr>
	
	<tr>
		<td><label>Client Name</label></td><td><input type="text" name="client_name" value="<?php echo $clientinfo -> Name; ?>" required /></td>
		<td><label>Client Address</label></td><td><input type="text" name="client_address" value="<?php echo $clientinfo -> Address;?>" required /></td>
	</tr>
	
	<tr>
		<td><label>Client Reference Number</label></td><td><input type="text" name="client_reference" placeholder="e.g KEMSA/09/03/A" title="Optional - Fill only if provided" value="<?php echo $clientinfo -> Ref_number ?>" /></td>
	</tr>
	
	<tr>
		<td><input type="submit" value="Add sample information" class="submit-button" name="submit"/></td>
	</tr>
	
	</fieldset>
	
</table>	
</div>


<?php echo form_close();?>
