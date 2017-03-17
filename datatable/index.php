<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/custom-dataTable.css">

  <script type="text/javascript" charset="utf8" src="js/jquery-1.8.2.min.js"></script>
  <script type="text/javascript" charset="utf8" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" charset="utf8" src="js/jquery.dataTables.min.js"></script>

</head>
<body>
<br><br>
<div class="container">

<table id="example" class="table table-striped table-bordered table-hover dataTable no-footer">
  <thead>
    <tr><th>id</th><th>name</th><th>price</th><th>tags</th></tr>
  </thead>
  <tbody>
  </tbody>
</table>


</div>

<script>
$(function(){
	var data = $("#example").dataTable({
           "sDom": '<"H"lfpir>t<"F"ip>',
	   "bServerSide": false,			// customised server side ajax call (make it true)
	   "sAjaxSource": "http://localhost/datatable/json/data.json", // customised url
           "sAjaxDataProp" : "data",			// give your json parent reponse data name
	   "sPaginationType": "full_numbers",
	   "bProcessing": false,	
           "bFilter": true,
           "bInfo":true,
           "bLengthChange": false,
	   "iDisplayLength": 10,			// no of rows for dataTable

	   "oLanguage": {
		    "sLengthMenu": "Display _MENU_ records per page",
		    "sInfoEmpty": "No Record Found",
		    "sInfo": "Total results: _TOTAL_  |  Showing results: _START_ - _END_",
		    "sEmptyTable": "NO DATA FOUND",
		    "sInfoFiltered": " (Filtered from _MAX_ total records)",
		    "sSearch": "Find : ",
            },
             
           
	  "aoColumns": [  // add your columns all here
			  {		
			    "mData":"id",			
			    "mRender":function(id){
				return id;
			    }
			  },{
			    "mData": "name",
			    "mRender":function(name){
				return "<a href=''>"+name+"</a>";
			    }
			     
			  },{
			    "mData": "price",
			     "mRender":function(price){
				return "<a href=''>"+price+"</a>";
			    }
			     
			  },{
			    "mData": "tags",
			     
			  }
		       ]
	});

  })
</script>
</body>
</html>
