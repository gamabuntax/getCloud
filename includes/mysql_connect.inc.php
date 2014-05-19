<?php

	function pg_connection_string() {
  		return "";
	}

	$link = pg_connect(pg_connection_string());
    //$link = mysqli_connect("127.0.0.1", "root", "hello", "final") or die ("Error: ". mysqli_error($link)); 
?>
