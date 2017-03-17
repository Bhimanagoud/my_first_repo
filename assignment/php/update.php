<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT']."/assignment/database/DbCls.php");

$users = new UpdateUser();

$id = isset($_GET['id'])?$_GET['id']:"null";
$fname = isset($_GET['first_name'])?$_GET['first_name']:"null";
$lname = isset($_GET['last_name'])?$_GET['last_name']:"null";
$desig = isset($_GET['designation'])?$_GET['designation']:"null";

$users->update_users($id,$fname,$lname,$desig);
 
/**
* NEW USERS
*/
class UpdateUser
{
	
	function __construct()
	{
		# code...
	}

	function update_users($id,$fname,$lname,$desig)
	{
		$data = array(
			'first_name' => $fname,
			'last_name' => $lname,
			'designation' => $desig
		);

		$where = "id =".$id;

		$db = new DbClass();
		$db->UpdateData("users",$data,$where);

	}
}