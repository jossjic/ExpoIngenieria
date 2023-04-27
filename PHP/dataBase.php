<?php
	class Database {
		
		private static $dbName 					= 'expo';
		private static $dbHost 					= 'localhost';
		private static $dbUsername 			= 'root';
		private static $dbUserPassword 	= '';
		

		/*
		private static $dbName 					= 'TC2005B_401_5';
		private static $dbHost 					= 'localhost';
		private static $dbUsername 			= 'TC2005B_401_5';
		private static $dbUserPassword 	= 'b#-ap+E4ru97?STi';
		*/

		private static $cont  = null;
		

		public function __construct() {
			exit('Init function is not allowed');
		}
		

		
		public static function connect(){
		   // One connection through whole application
	    	if ( null == self::$cont ) {
		    	try {
		        	self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
		        }
		        catch(PDOException $e) {
		        	die($e->getMessage());
		        }
	       	}
	       	return self::$cont;
		}

		public static function disconnect() {
			self::$cont = null;
		}
	}
	
	
?>