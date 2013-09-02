<?php
	include 'Excel/reader.php';
	$data = new Spreadsheet_Excel_Reader();
	$data->setOutputEncoding('CP1251');
	$data->read('product.xls');
	 
	//columns:
	$sql = "INSERT INTO movieDetails (";
	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++)
	{
	    $sql .= "`" . mysql_escape_string($data->sheets[0]['cells'][1][$j]) . "`,";
	}
	$sql = substr($sql, 0, -1) . ") VALUES\r\n";
	
	//cells
	for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++)
	{
	    $sql .= "(";
	    for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++)
	    {
	        $sql .= "'" . mysql_escape_string($data->sheets[0]['cells'][$i][$j]) . "',";
	    }
	    $sql = substr($sql, 0, -1) . "),\r\n";
	}
	
	$sql =  substr($sql, 0, -3) . ";";
	 
	echo '<pre>';
	//echo $sql;
	
	// make a conection to mysql db and run the insert query
	$server ='localhost';
	$username='root';
	$password = 'password123';
	$link = mysql_connect($server, $username, $password);
	$database = 'unboxd';	
	if ($link) mysql_select_db($database);
	
	mysql_query($sql);
?>