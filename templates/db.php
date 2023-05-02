<?php

	$connection = new mysqli("localhost","root","","project_3");

	if($connection->connect_error){

		echo "Error with database connection";

	}

?>