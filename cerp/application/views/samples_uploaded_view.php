<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>elFinder 2.0</title>

		<!-- jQuery and jQuery UI (REQUIRED) -->
<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="<?php echo base_url();?>javascripts/jquery.min.js" ></script> 
<script type="text/javascript" src="<?php echo base_url();?>javascripts/js/jquery-ui.min.js"></script>


		<!-- elFinder CSS (REQUIRED) -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>javascripts/css/elfinder.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>javascripts/css/theme.css">

		<!-- elFinder JS (REQUIRED) -->
		<script type="text/javascript" src="<?php echo base_url();?>javascripts/js/elfinder.min.js"></script>

		<!-- elFinder translation (OPTIONAL) -->
		<script type="text/javascript" src="<?php echo base_url();?>javascripts/js/i18n/elfinder.ru.js"></script>

		<!-- elFinder initialization (REQUIRED) -->
		<script type="text/javascript" charset="utf-8">
			$().ready(function() {
				var elf = $('#elfinder').elfinder({
					url : '<?php echo base_url();?>reviewer/elfinder_init/'  // connector URL (REQUIRED)
					// lang: 'ru',             // language (OPTIONAL)
				}).elfinder('instance');	
			});
		</script>
	</head>
        
	<body>
            

		<!-- Element where elFinder will be created (REQUIRED) -->
		<div id="elfinder"></div>

	</body>
</html>
