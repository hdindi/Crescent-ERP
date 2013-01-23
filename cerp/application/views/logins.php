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
		
		<img id="logo" src="<?=base_url()?>images/logo.png" /> <h1>: Login</h1>

		<form action="<?=site_url("logins/go")?>" method="post">

			<div id="boxtop"></div><div id="boxmid">

				<div class="section">
					<span>Username:</span>
					<input type="text" name="username" value="Username" />
				</div>
				
				<div class="section">
					<span>Password:</span>
					<input type="password" name="password" value="Password" />
				</div>
	
			</div><div id="boxbot"></div>

		   	<div class="text" style="float: left;"><p>Haven't got an account? Want one?</p><p><a href="<?=site_url('logins/register')?>">Register</a>.</p></div>
		   	<div class="text" style="float: right;">

			<input type="submit" value="Login" name="login" class="submit" />
		</div>
		<br style="clear:both; height: 0px;" />
	
	</div>
	<div id="bottom"></div>
</div>
</body>
</html>