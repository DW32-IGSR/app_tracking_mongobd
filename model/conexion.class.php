<?php
class Conexion {
    private static $db;
	function __construct() {
	}
    /*public static function conectar() {
		// Connect if not already connected
		if (is_null(self::$db)) {
			// DB connection settings
			//require_once("../../settings.php");
			// ? cloud9 : local
			$servername = getenv('C9_USER') ? getenv('IP') : "localhost";
			// db cloud9 : db local
			$database = getenv('C9_USER') ? "app_tracking" : "app_tracking";
			$dbport = 3306;
			// user cloud9 : user local
			$user = getenv('C9_USER') ? getenv('C9_USER') : "root";
			// pass cloud9 : pass local
			$pass = getenv('C9_USER') ? "" : "zubiri";
			$driverOpts = null;
			$dsn = "mysql:host=$servername;dbname=$database;port=$dbport;charset=utf8";
			self::$db = new PDO($dsn, $user, $pass, $driverOpts);
		}
		// Return the connection
		return self::$db;
	}*/
	
	public static function conectar() {
		//$m = new MongoClient("mongodb://${username}:${password}@localhost/database");
		//public MongoClient::__construct ([ string $server = "mongodb://localhost:27017" [, array $options = array("connect" => TRUE) [, array $driver_options ]]] )
		$db = new MongoClient("mongodb://admin:zubiri@localhost/app_tracking");
		//$m = new MongoClient("mongodb://test:test@ds033400.mongolab.com:33400/zmwebdev-test");
		//$db = new MongoClient("mongodb://dw32igsr:Zubiri2015@ds049864.mongolab.com:49864/app_tracking");
		//var conn = mongo.db('imbringing:sexyback@rose.mongohq.com:10029/blackbook');  
		return $db;
	}
}


/*class Conexion2 {
    static $db = NULL;

    static function getMongoCon()
    {
        if (self::$db === null)
        {
            try {
                $m = new Mongo('mongodb://'.$MONGO['servers'][$i]['mongo_host'].':'.$MONGO['servers'][$i]['mongo_port']);
                //$m = new Mongo("mongodb://admin:zubiri@localhost/app_tracking");

            } catch (MongoConnectionException $e) {
                die('Failed to connect to MongoDB '.$e->getMessage());
            }
            self::$db = $m;
        }

        return self::$db;
    }
}*/
// $m = Conexion2::getMongoCon();