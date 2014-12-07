<?php

class Connection {

	private static $conn;
	private static $hostname		="localhost"; //ou 127.0.0.1  ip padrao de servidor
	private static $dataBaseName	="JOHAN_YASSER_INTERDIS";
	private static $userName		="admin";
	private static $pwd				="masterkey";
	private static $dataBaseType	="mysql";
	
public static function connect(){		
		try
		{
			self::$conn = new 
			 PDO(self::$dataBaseType.":host=".
			 self::$hostname.";dbname=".
			 self::$dataBaseName,
			 self::$userName,
			 self::$pwd);
		}
		catch(Exception $ex)		
		{
			throw $ex;		
		}
	}
	public static function getConn(){
		return self::$conn;
	}
	public static function disconnect(){
		self::$conn=null;	
	}	
}
?>