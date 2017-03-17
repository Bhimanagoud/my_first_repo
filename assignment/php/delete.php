<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT']."/assignment/database/DbCls.php");

$users = new DeleteUser();
 
$users->delete_users_by_id(isset($_GET['id'])?$_GET['id']:"");
 
/**
* Get USERS
*/
class DeleteUser
{
	
	function __construct()
	{
		# code...
	}

	function delete_users_by_id($id)
	{
		$db = new DbClass();
		if(!is_null($id) || $id != ""){
			$db->DeleteData("users","id = ".$id);
		}
	}
}