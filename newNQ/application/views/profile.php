<html>
<head>
	<link rel="stylesheet" href="<?=base_url()?>styles.css" type="text/css" charset="utf-8">
	<title>Uploadr</title>
</head>
<body>
<div id="main">
	<img id="beta" src="<?=base_url()?>images/beta.png" />
	<div id="top"></div>
	<div id="middle">
		
		<img id="logo" src="<?=base_url()?>images/logo.png" /> <h1>: Profile</h1>
		
		<div id="boxtop"></div><div id="boxmid">
			
			<?php foreach($files as $file): ?>
			
				<div class="section">
					<span><?=$file->name?></span>
					<div style="float: right;">
						<span><a href="<?=base_url()?>files/<?=$file->name?>">View</a></span>
						<span><a href="<?=site_url("profile/delete/".$file->id)?>">Delete</a></span>
					</div>	
				</div>
			
			<?php endforeach; ?>

		</div><div id="boxbot"></div>

	   	<div class="text" style="float: left;"><p>Before uploading, check out</p><p>the <a href=#>Terms of Service</a>.</p></div>
	   	<div class="text" style="float: right;">

			<a href="<?=site_url('login/logout')?>" class="submit red">Logout</a>
	   		<a href="<?=site_url('profile/upload')?>" class="submit">Upload</a>
		
	</div>
	<br style="clear:both; height: 0px;" />

</div>
<div id="bottom"></div>
</div>
</body>
</html>