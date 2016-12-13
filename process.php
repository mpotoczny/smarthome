<?php

	$username = $_POST['user'];
	$password = $_POST['pass'];
        
        $problem = "problem";

	$username = stripcslashes($username);
	$password = stripcslashes($password);

	$username = mysqli_real_escape_string($username);
	$password = mysqli_real_escape_string($password);

	@mysql_connect("localhost", "root", "");
	@mysql_select_db("smarthome");

	$result = mysql_query("select * from user where login = '$username' and haslo = '$password'") 
                    or die("Nieudane polaczenie z baza danych ".mysql_error());
	$row = mysql_fetch_array($result);
	if ($row['username'] == $username && $row['password'] == $password ) 
            { echo "Logowanie udane. Cześć ".$row['username']; }
        else { echo "Nieudane logowanie"; }
?>

