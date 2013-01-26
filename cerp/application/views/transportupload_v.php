<html>
<head>
	<link rel="stylesheet" href="<?=base_url()?>styls.css" type="text/css" charset="utf-8">
	<title>Uploadr</title>
</head>
<body>
<div id="main">
	<img id="beta" src="<?=base_url()?>images/beta.png" />
	<div id="top"></div>
	<div id="middle">
		
		<img id="logo" src="<?=base_url()?>images/logo.png" /> <h1>: Upload</h1>
		
		<form enctype="multipart/form-data" action="<?=site_url().'transportupload/do_upload/'.$driverrenumerationfile?>" method="post">

			<div id="boxtop"></div><div id="boxmid">

				<div class="section">
					<span>File:</span>
					<input type="file" name="userfile" />
				</div>

			</div><div id="boxbot"></div>
	
			<div class="text" style="float: left;"><p>Before uploading, check out</p><p>the <a href=#>Terms of Service</a>.</p></div>
		   	<div class="text" style="float: right;">

			<input type="submit" value="Upload" name="upload" class="submit" />
		</div>
		<br style="clear:both; height: 0px;" />
		
		</form>
	
	</div>
	<div id="bottom"></div>
</div>
</body>
</html>