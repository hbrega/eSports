<?php

function _connect() {
    
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$conn->set_charset("utf8");

	return $conn;	
}





?>