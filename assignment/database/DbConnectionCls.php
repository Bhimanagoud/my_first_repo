 
<?php
/**
 * Singleton Database connection establishment class. 
 */
class DbConnection
{
	
	/**
	 * statci variable to store database connection string
	 */
	private static $_msDbObj = null;
	
		
	/**
	 * constructor
	 * A private constructor; prevents direct creation of object 
	 */
	private function __construct() 
	{		
		//A private constructor; prevents direct creation of object		
	}
	
	/**
	 * GetDbConnection
	 * 
	 * creates singletons Database conenction object
	 */
	public static function GetDbConnection()
	{
		
		if(!self::$_msDbObj || !is_resource(self::$_msDbObj))
		{
			self::$_msDbObj = mysqli_connect(DB_HOST,DB_USER_NAME,DB_PASSWORD,DB_DATABASE);
			//mysql_select_db(DB_DATABASE);			
			
		}
		
		return self::$_msDbObj;
		
	}

}
?>
