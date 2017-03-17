<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once($_SERVER['DOCUMENT_ROOT']."/assignment/php/get.php");
?>
<html>
<head>

<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/custom-dataTable.css">

<script type="text/javascript" charset="utf8" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" charset="utf8" src="js/jquery.dataTables.min.js"></script>
<script  type="text/javascript" charset="utf8" src="js/bootstrap.min.js"></script>
  
</head>
<body>
<br><br><br><br>
<div class="container">
        
    <div class="row">
    <div class="col-md-12 marginT20">

    <div class="table-responsive demo-x content">

    <button onclick="add();" type="button" class="add-btn btn btn-success btn-sm pull-left" data-toggle="modal" data-target="#add-modal">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
    </button>
 
    <table id="example" class="table table-striped table-bordered table-hover dataTable no-footer">
        <thead>
            <tr>
                
                <th>#ID</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Designation</th>
                <th></th>
            </tr>
        </thead>
    </table>
    </div>

    </div>
    </div>
</div>
 


</body>
</html>
<script type="text/javascript" charset="utf8" src="js/scripts.js"></script>