<?php
class Conexion {
    private static $db;
	function __construct() {
	}
	
	public static function conectar() {
		//$db = new MongoClient("mongodb://admin:zubiri@localhost/app_tracking");
		$db = new MongoClient("mongodb://admin:zubiri@ds049864.mongolab.com:49864/app_tracking");

		return $db;
	}
}