<?php $facility=$this -> session -> userdata('news');
$access_level = $this -> session -> userdata('user_indicator');
?>
<style>
	.message {
	display: block;
	padding: 10px 20px;
	margin: 15px;
	width: 70%;
	}
	.warning {
	background: #FEFFC8 url('<?php echo base_url()?>Images/Alert_Resized.png') 20px 50% no-repeat;
	border: 1px solid #F1AA2D;
	width: 70%;
	}
	.message h2 {
	margin-left: 60px;
	margin-bottom: 5px;
	}
	.message p {
	width: auto;
	margin-bottom: 0;
	margin-left: 60px;
	}
	.activity{
	display: block;
	padding: 10px 20px;
	margin: 15px;
	width: 70%;	
	}
	.activity h2 {
	margin-left: 60px;
	margin-bottom: 5px;
	}
	.update{
	background: url('<?php echo base_url()?>Images/updates-resize1.png') 10px 50% no-repeat;
	border: 1px solid black;
	width: 70%;
	height: 40%;
	}
	.issue{
	background: url('<?php echo base_url()?>Images/Drug-basket-resize.png') 10px 50% no-repeat;
	border: 1px solid black;
	width: 70%;
	height: 40%;
	}
	.order{
	background: url('<?php echo base_url()?>Images/ordering-resize.png') 10px 50% no-repeat;
	border: 1px solid black;
	width: 70%;
	height: 40%;
	}
	.update_order{
	background: url('<?php echo base_url()?>Images/Inventory-resize.png') 10px 50% no-repeat;
	border: 1px solid black;
	width: 70%;
	height: 40%;
	}
	.reports{
	background: url('<?php echo base_url()?>Images/numbers-resize.png') 10px 50% no-repeat;
	border: 1px solid black;
	width: 70%;
	height: 40%;
	}
	.users{
	background: url('<?php echo base_url()?>Images/user-resize.png') 10px 50% no-repeat;
	border: 1px solid black;
	width: 70%;
	height: 40%;
	}
	#left_content{
	width:45%;
	float: left;
	}
	#right_content{
	width:50%;
	float: right;
	}
	.information {
	background: #C3E4FD url('<?php echo base_url()?>Images/Notification_Resized.png') 20px 50% no-repeat;
	border: 1px solid #688FDC;
	}
	.graph{
	
	border: 1px solid #739F1D;
	}
	.graph h2{
		margin-left:0;
	}
	#main_content{
	overflow:hidden;
	}
	#full_width{
	float:left;
	width:100%
	} 
	.graph_container{
		margin:0 auto;
		width:800px;	
	}
	a{
		text-decoration: none;
	}
</style>
<div id="main_content">
	<div id="left_content">
		<fieldset>
		<legend>Actions</legend>
	     <?php if(count($stock)>0){} else {?> 
	    <div class="activity update">
	    <a href="<?php echo site_url('stock_management/facility_first_run');?>"><h2>Update Stock Level</h2>	</a>
		</div>
		<?php }?>
		<div class="activity issue">
		<a href="<?php echo site_url('Issues_main/index');?>"><h2>Issue Commodities</h2></a>
		</div>
		<div class="activity order">
		<a href="<?php echo site_url('order_management/new_order');?>">	<h2>Order Commodities</h2>		</a>
		</div>
		<div class="activity update_order">
		<a href="<?php echo site_url('order_management/all_deliveries/'.$facility);?>"><h2>Update Order Delivery</h2>	</a>
		</div>
		<?php if($access_level=="facility"): ?>
		<div class="activity users">
		<a href="<?php echo site_url('user_management/users_manage');?>"><h2>User Management</h2></a>
		</div>
		<?php endif; ?>
		<div class="activity reports">
	    <a href="<?php echo site_url('report_management/reports_Home');?>">	<h2>Facility Reports</h2>	</a>
		</div>	
		</fieldset>
	</div>
	<div id="right_content">
		<fieldset>
			<legend>Notifications</legend>
		<?php if($dispatched>0):?>
		<div class="message information">			
			<h2>Dispatched Orders</h2>			
			<p>
			<a class="link" href="<?php echo site_url("Order_Management/index/");?>"> Order(s)</a> has been Dispatched from the KEMSA stores.
			</p>
		</div>
		<?php endif;?>
	<?php if($diff > 0): ?>
			<div class="message warning">
			<h2>Make order</h2>
			<p>
				<a href="<?php 
				echo site_url('stock_management/stock_level');?>" <a class="link"><?php echo $diff.' Days to deadline. Order now'?> </a>
			</p>
		</div>
			<?php endif; ?>
               <?php if($pending_orders >0):?>
		<div class="message warning">
			<h2>Pending Order(s)</h2>
			<p>
				<a class="link" href="<?php 
				 echo site_url("Order_Management/index/");?>"><?php echo $pending_orders;?> Order(s)</a>pending review
			</p>
		</div>
		<?php endif;?>
		 <?php if($exp >0):?>
		<div class="message warning">
			<h2>Expired Product(s)</h2>
			<p>
			<a class="link" href="<?php echo site_url("stock_expiry_management/expired/");?>"><?php echo $exp?> Product(s)</a> have expired.
			</p>
		</div>
		<?php endif;?>
		<?php if($exp_count['balance']==0){} else {?> 
		<div class="message warning">
                       <h2>Potential Expiries</h2>
                       <p>
                       <a href="<?php echo site_url('stock_expiry_management/get_expiries');?>" <a class="link"><?php echo $exp_count['balance']; ?> Product(s)</a> Expiring in the next 6 months</a>
                       </p>
               </div>
               <?php }?>
		</fieldset>
	</div>
	<!--<div id="full_width">
		<div class="message graph"> 
			<h2>Average Order Satisfaction %</h2>
			<p>
				
			</p>
			<div id="order_satisfaction" class="graph_container"></div>
			
		</div>
	</div>-->
</div>
