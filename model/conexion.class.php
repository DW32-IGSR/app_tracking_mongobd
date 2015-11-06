<?php
class Conexion {
    private static $db;
	function __construct() {
	}
	
	public static function conectar() {
		//$m = new MongoClient("mongodb://test:test@ds033400.mongolab.com:33400/zmwebdev-test");
		$db = new MongoClient("mongodb://admin:zubiri@localhost/app_tracking");
		//$db = new MongoClient("mongodb://dw32igsr:Zubiri2015@ds049864.mongolab.com:49864/app_tracking");

		return $db;
	}
}