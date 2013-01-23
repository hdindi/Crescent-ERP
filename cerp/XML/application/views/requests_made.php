
<script>
$(function() {
$(".data-table tr:even").css({'color':'#dddddd',
'background-color' : '#dedede' });
});
</script>

<div id="view_content">
	<a class="action_button" id="new_client" href="<?php echo site_url('request_management/add') ?>">New Request</a>
	  <div class="center_div">
		<table class="data-table" >
			<tr>
				<th>Client id</th>
				<th>Request id</th>
				<th>Product_name</th>
				<th>Batch_no</th>
				<th>Date of Request</th>
				<th>Quantity</th>
				<th>Action</th>
				
			</tr>
			<?php
			foreach ($info as $infos) {
				echo "<tr><td>" . $infos['client_id'] . "</td><td>" . $infos['request_id'] 
				. "</td><td>" . $infos['product_name'] . "</td><td>" . $infos['Batch_no'] . "</td><td>" . $infos['Designation_date'] . 
				"</td><td>" . $infos['sample_qty'] ."</td><td><a href=".site_url('sample_controller/test/'.$infos['id'].'/'.$infos['request_id']).">"."View"."</a></td><tr>";
			}
			?>
		</table>
	</div>
	<div id="entry_form" title="New Client">
		<?php
		$attributes = array('class' => 'input_form');
		echo form_open('client_management/save', $attributes);
		?>
		</form>
	</div>
</div>
