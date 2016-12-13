<!DOCTYPE html>
<html>
    <head>
        <title>Strona logowania</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
	<div id="frm">
		<form action="process.php" method="POST">
		  <p>
			<label>Login</label>
			<input type="text" id="user" name="user" />
		  </p>
		  <p>
			<label>Haslo</label>
			<input type="password" id="pass" name="pass" />
		  </p>
		  <p>
			<input type="submit" id="btn" value="OK" />
		  </p>
		</form>
	</div>
    </body>
</html>