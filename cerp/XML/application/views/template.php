<?php
if (!$this -> session -> userdata('user_id')) {
	redirect("user_management/login");
}
if (!isset($link)) {
	$link = null;
}
if (!isset($quick_link)) {
	$quick_link = null;
}
$access_level = $this -> session -> userdata('user_indicator');

$user_is_facility = false;
$user_is_moh = false;
$user_is_district=false;
$user_is_moh_user=false;
$user_is_facility_user = false;
$user_is_kemsa=false;

if ($access_level == "facility") {
	$user_is_facility = true;
}
if ($access_level == "moh") {
	$user_is_moh = true;
}
if ($access_level == "district") {
	$user_is_district = true;
}
if($access_level=="moh_user"){
	$user_is_moh_user=true;
}
if($access_level=="fac_user"){
	$user_is_facility_user =true;
}
if($access_level=="kemsa"){
	$user_is_kemsa=true;
}
?>
<?php //foreach($name_facility->Codes as $drug){echo $drug->facility_name;}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
<link href="<?php echo base_url().'CSS/styles.less'?>" type="text/less" media="screen" rel="stylesheet"/> 
<link href="<?php echo base_url().'CSS/style.css'?>" type="text/css" rel="stylesheet"/> 
<link href="<?php echo base_url().'CSS/jquery-ui.css'?>" type="text/css" rel="stylesheet"/> 
<script src="<?php echo base_url().'Scripts/jquery.js'?>" type="text/javascript"></script> 
<script src="<?php echo base_url().'Scripts/jquery-ui.js'?>" type="text/javascript"></script> 
<script src="<?php echo base_url().'CSS/js/less-1.1.3.min.js'?>" type="text/javascript"></script> 



<?php
if (isset($script_urls)) {
	foreach ($script_urls as $script_url) {
		echo "<script src=\"" . $script_url . "\" type=\"text/javascript\"></script>";
	}
}
?>
<?php
if (isset($scripts)) {
	foreach ($scripts as $script) {
		echo "<script src=\"" . base_url() . "Scripts/" . $script . "\" type=\"text/javascript\"></script>";
	}
}
?>
<?php
if (isset($styles)) {
	foreach ($styles as $style) {
		echo "<link href=\"" . base_url() . "CSS/" . $style . "\" type=\"text/css\" rel=\"stylesheet\"/>";
	}
}
?>  
<script type="text/javascript">
	$(document).ready(function() {
		$("#my_profile_link").click(function(){
			$("#logout_section").css("display","block");
		});

	});

</script>
</head>

<body>
<div id="wrapper">
	<div id="top-panel">
		
		<div>
		
			    <div id="nqcl_logo">
				<a class="logo" href="<?php echo base_url();?>"><img src="<?php echo base_url() . "Images/nqcl_logo_full.png"; ?>"></a> 
				</div>

				<!--div class="center_text" id="project_title">
				<a href="http://www.nqcl.co.ke"><h3></h3></a>
				</div-->
				
				<div id="moh_logo" class="align_rignt" >
				<a href=""><img src="<?php echo base_url()."Images/moh_logo.png"; ?>" /></a>
				</div>
				
		</div>
	
				<?php $facility=$this -> session -> userdata('news');?>
 
 <div id="top_menu"> 

 	<?php
	//Code to loop through all the menus available to this user!
	//Fet the current domain
	$menus = $this -> session -> userdata('menu_items');
	$current = $this -> router -> class;
	$counter = 0;
?>
 	<a href="<?php echo base_url();?>home_controller" class="top_menu_link  first_link <?php
	if ($current == "home_controller") {echo " top_menu_active ";
	}
?>">Home </a>
<a href="<?php echo base_url();?>request_management" class="top_menu_link  first_link <?php
	if ($current == "request_management") {echo " top_menu_active ";
	}
?>">Tab A </a>

<?php if($user_is_facility_user){
	?>
	 	<a href="<?php echo base_url();?>order_management" class="top_menu_link <?php
	if ($quick_link == "order_listing") {echo " top_menu_active ";
	}
?>"> Orders </a> 



	
	<?php
}
?>
<?php if($user_is_district){
	?>
	 	<a href="<?php echo base_url();?>order_approval/district_orders" class="top_menu_link  first_link <?php
	if ($quick_link == "new_order") {echo " top_menu_active ";
	}
?>">District Orders</a>
	 	<a href="<?php echo base_url();?>user_management/dist_manage" class="top_menu_link  first_link <?php
	if ($current == "user_management") {echo " top_menu_active ";}?>">Users</a>
	<?php }
?>
<?php if($user_is_moh){
	?> 	
	 	<a href="<?php echo base_url();?>user_management/moh_manage" class="top_menu_link  first_link <?php
	if ($current == "user_management") {echo " top_menu_active ";}?>">Users</a>
	<?php }
?>
<?php
if($user_is_facility){
?>
 	<a href="<?php echo base_url();?>request_management" class="top_menu_link <?php
	if ($quick_link == "request_management") {echo " top_menu_active ";
	}
?>"> Tab A </a> 

<a href="<?php echo base_url();?>Issues_main" class="top_menu_link <?php
	if ($current == "Issues_main") {echo " top_menu_active ";
	}
?>">Tab B </a>	



 <?php
} ?>
<?php if($user_is_kemsa){
	?>
	<a href="<?php echo site_url('order_management/kemsa_order_v');?>" class="top_menu_link <?php
	if ($quick_link == "kemsa_order_v") {echo " top_menu_active ";
	}
?>">Orders</a>
	<?php
}
?>

<a ref="#" class="top_menu_link" id="my_profile_link"><?php echo "NQCL" ?></a>
 </div>
<label style="float: right; margin-right: 40px; margin-top: 70px;">Welcome : <?php echo $this -> session -> userdata('id');?> <?php echo $this -> session -> userdata('inames');?><a  class="link" href="<?php echo base_url();?>user_management/login">Logout?</a>|<a  class="link" href="<?php echo base_url();?>user_management/reset_pass">Change Password</a></label>
</div>

<div id="inner_wrapper"> 
<!-- MOH USR-->

<?php if($user_is_moh_user){
	?>
<div id="sub_menu">
	<a style="width:150px !important" href="<?php echo site_url('stock_management/stock_level_moh');?>" class="top_menu_link sub_menu_link first_link  <?php
	if ($quick_link == "load_stock") {echo "top_menu_active";
	}
	?>">Stock Level</a>
	<a style="width:150px !important" href="<?php echo site_url('order_management/moh_order_v');?>" class="top_menu_link sub_menu_link first_link  <?php
	if ($quick_link == "moh_order_v") {echo "top_menu_active";
	}
	?>">View Orders</a>
	<a style="width:150px !important" href="<?php echo site_url('order_management/unconfirmed');?>" class="top_menu_link sub_menu_link first_link  <?php
	if ($quick_link == "unconfirmed_orders") {echo "top_menu_active";
	}
	?>">Unconfirmed Orders</a>
	<a style="width:150px !important" href="<?php echo site_url('raw_data/trends');?>" class="top_menu_link sub_menu_link first_link  <?php
	if ($quick_link == "trends") {echo "top_menu_active";
	}
	?>">Trends</a>
	
</div>
<?php
}
?>
<?php if($user_is_moh){
	?>
<div id="sub_menu">
	<a style="width:150px !important" href="<?php echo site_url('stock_management/stock_level_moh');?>" class="top_menu_link sub_menu_link first_link  <?php
	if ($quick_link == "load_stock") {echo "top_menu_active";
	}
	?>">Stock Level</a>
	<a style="width:150px !important" href="<?php echo site_url('order_management/moh_order_v');?>" class="top_menu_link sub_menu_link first_link  <?php
	if ($quick_link == "moh_order_v") {echo "top_menu_active";
	}
	?>">View Orders</a>
    <a style="width:150px !important" href="<?php echo site_url('raw_data/getCounty');?>" class="top_menu_link sub_menu_link first_link  <?php
	if ($quick_link == "Consumption") {echo "top_menu_active";
	}
	?>">Consumption</a>
	<a style="width:150px !important" href="<?php echo site_url('raw_data/trends');?>" class="top_menu_link sub_menu_link first_link  <?php
	if ($quick_link == "trends") {echo "top_menu_active";
	}
	?>">Trends</a>
	
	
	
		
</div>
<?php
}
?>
<div id="main_wrapper"> 
 
<?php $this -> load -> view($content_view);?>
 
 
 
<!-- end inner wrapper --></div>
  <!--End Wrapper div--></div>
    <div id="bottom_ribbon">
        <div id="footer">
 <?php $this -> load -> view("footer_v");?>
    </div>
    </div>
</body>
</html>
