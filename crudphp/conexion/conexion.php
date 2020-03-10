<?php

$servidor="mysql:dbname=cherrydb;host=127.0.0.1;port=3307";
$usuario="root";
$password="";

try{

	$pdo= new PDO($servidor,$usuario,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
	#echo "Conectado...";
}
catch(PDOException $e){

	echo "Mala conexion: (".$e->getMessage();
}

?>