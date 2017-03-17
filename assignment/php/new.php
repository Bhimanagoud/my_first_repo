<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT']."/assignment/database/DbCls.php");

$users = new NewUser();

$fname = isset($_GET['first_name'])?$_GET['first_name']:"null";
$lname = isset($_GET['last_name'])?$_GET['last_name']:"null";
$desig = isset($_GET['designation'])?$_GET['designation']:"null";

$users->add_users($fname,$lname,$desig);
 
/**
* NEW USERS
*/
class NewUser
{
	
	function __construct()
	{
		# code...
	}

	function add_users($fname,$lname,$desig)
	{
		$data = array(
			'first_name' => $fname,
			'last_name' => $lname,
			'designation' => $desig
		);

		$db = new DbClass();
		$db->InsertData("users",$data);
		//print_r($data);
	}
}