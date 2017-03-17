<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT']."/assignment/database/DbCls.php");

if(isset($_GET['all']))
{

$users = new GetUser();
 
$users->get_all_users();

}

/**
* Get USERS
*/
class GetUser
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

	function get_all_users()
    {
    	$db = new DbClass();

    	$sTables = array("users");
     	
	    $aColumns = array(
	    				"id", 
						"first_name", 
						"last_name",
						"designation"
	    );
  
		$sIndexColumn = "id";

		/*
    	*  Filtering
    	*/
		$sWhere = "";
	    if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
	    {
	        $sWhere = "Where AND (";
	        for ( $i=0 ; $i<count($aColumns) ; $i++ )
	        {
	            if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
	            {
	                $sWhere .= $aColumns[$i]." LIKE '%".$_GET['sSearch']."%' OR ";
	            }
	        }
	        $sWhere = substr_replace( $sWhere, "", -3 );
	        $sWhere .= ')';
	    }
 

		/*
	     * Paging
	     */
	    $sLimit = "";
	    if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	    {
	        $sLimit = "LIMIT ".intval($_GET['iDisplayStart']).", ".intval($_GET['iDisplayLength']);
	    }
		    		     
	    /*
	     * Ordering
	     */
	    $sOrder = "";
	    if ( isset( $_GET['iSortCol_0'] ) )
	    {
	         $sOrder = "ORDER BY  ";
	         for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
	         {
	             if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
	             {
	                 $sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
	                     ".($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
	             }
	         }
	         
	         $sOrder = substr_replace( $sOrder, "", -2 );
	         if ( $sOrder == "ORDER BY" )
	         {
	             $sOrder = "";
	         }
	    }

 
		$all_columns = str_replace(" , ", " ", implode(", ", $aColumns));

		$all_tables = str_replace(" , ", " ", implode(", ", $sTables));
		 
	    /*
	     * SQL queries
	     * Get data to display as per the iDisplayLength
	     */
	    $sQuery = "
	        SELECT ".$all_columns."
	        FROM   ".$all_tables."
	        $sWhere
	        $sOrder
	        $sLimit
	    ";
		     
		$db->CustomQuery($sQuery);

		$rResult = $db->val;
			
		/*
	     * SQL queries
	     * Get data to count for iTotalRecords
	    */ 
	    $cQuery = "
	        SELECT Count(".$sIndexColumn.") as iTotal
	        FROM   ".str_replace(" , ", " ", implode(", ", $sTables))."
	        $sWhere
	    ";

	    $db->CustomQuery($cQuery);

	    $crResult = $db->val;
	    $iTotal = $crResult;
	    $iTotal = $iTotal[0]["iTotal"];
		     
	    /*
	     * Output, 
	     */
	    $output = array(

	    	"sEcho" => intval(isset($_GET['sEcho'])?$_GET['sEcho']:0),
	        "iTotalRecords" => $iTotal,
	        "iTotalDisplayRecords" =>  $iTotal,
	        "aaData" => $rResult,

	    );
     
	    echo json_encode($output);

	}
}




?>