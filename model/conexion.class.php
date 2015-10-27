<?php
class Conexion {
    private static $db;
	function __construct() {
	}
    public static function conectar() {
		// Connect if not already connected
		if (is_null(self::$db)) {
			// DB connection settings
			//require_once("../../settings.php");
			// ? cloud9 : local
			$servername = getenv('C9_USER') ? getenv('IP') : "localhost";
			// db cloud9 : db local
			$database = getenv('C9_USER') ? "app-tracking" : "app-tracking";
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
	}
}