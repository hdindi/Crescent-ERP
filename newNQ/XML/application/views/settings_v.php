<?php
if(!isset($quick_link)){
$quick_link = null;
}  
?>
<div id="sub_menu">
	
	<a href="<?php echo site_url('request_management');?>" class="top_menu_link sub_menu_link first_link  <?php if($quick_link == "request"){echo "top_menu_active";}?>">Requests</a>
<a href="<?php echo site_url("client_management");?>" class="top_menu_link sub_menu_link   <?php if($quick_link == "client"){echo "top_menu_active";}?>">Clients</a>
<a href="<?php echo site_url("test_controller");?>" class="top_menu_link sub_menu_link last_link   <?php if($quick_link == "test"){echo "top_menu_active";}?>">Tests</a>

</div>
<div id="main_content">
<?php
$this->load->view($settings_view);
?>
</div>
