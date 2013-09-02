<?php

	$server ='localhost';
	$username='root';
	$password = 'password123';
	$link = mysql_connect($server, $username, $password);
	$database = 'unboxd';	
	if ($link) mysql_select_db($database);
?>	