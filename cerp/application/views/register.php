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
		
		<img id="logo" src="<?=base_url()?>images/logo.png" /> <h1>: Register</h1>

		<form action="<?=site_url('login/register')?>" method="post">

			<div id="boxtop"></div><div id="boxmid">

				<div class="section">
					<span>Desired Username:</span>
					<input type="text" name="username" />
				</div>

				<div class="section">
					<span>Desired Password:</span>
					<input type="password" name="password" />
				</div>
	
			</div><div id="boxbot"></div>

			<div class="text" style="float: left;"><p>Already got an account?</p><p><a href="<?=site_url('login')?>">Log In</a>.</p></div>
		   	<div class="text" style="float: right;">

			<input type="submit" value="Register" name="register" class="submit" />
		</div>
		<br style="clear:both; height: 0px;" />
	
	</div>
	<div id="bottom"></div>
</div>
</body>
</html>