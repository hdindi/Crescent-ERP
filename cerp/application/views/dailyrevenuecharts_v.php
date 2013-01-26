<html>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">
	<head>
	<style>
		.container {
			margin-top:5px;
			margin-left:5px;
		}

		.container ul {
			color: #E59934;
		}

		.container ul li {
			margin:5px;
			padding:5px;
			width: 100px;
			height:70px;
			float: left;	
			border: 1px solid lightgray;
			list-style:none;
			
		}

		.container ul li:hover {
			border: 1px solid orange;
		}
	</style>
	  
		<script type="text/javascript" src="<?php echo base_url()."Scripts/FusionCharts/FusionCharts.js"?>"></script>
		
		

	
	</head> 
	<body  bgcolor="#ffffff">
<div id="container">

<div > 

<span>  <object align="left" style="padding-left: 25px;" >
	
<?php  echo @$pie_graph;
 			?>
				
			</object> </span>
 
</div>

<div > 

<span>  <object align="right" style="padding-right: 25px;">
	
<?php  echo @$column_graph;
 			?>
				
			</object> </span>

</div>


	</body>
</html>