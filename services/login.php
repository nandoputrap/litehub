<?php
	session.start();
	mysql_connect(["localhost"]);
	mysql_query("select * from user");
	
?>