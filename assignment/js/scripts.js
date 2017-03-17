
$(function(){

var data = $("#example").dataTable({
   "sDom": '<"H"lfpir>t<"F"ip>',
   "bServerSide": false,			// customised server side ajax call (make it true)
   "sAjaxSource": "php/get.php?all", // customised url
   "sAjaxDataProp" : "aaData",			// give your json parent reponse data name
   "sPaginationType": "full_numbers",
   "bProcessing": false,	
   "bFilter": true,
   "bInfo":true,
   "bLengthChange": true,
   "iDisplayLength": 5,			// no of rows for dataTable
   "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
 
   "oLanguage": {
	    "sLengthMenu": "_MENU_",
	    "sInfoEmpty": "No Record Found",
	    "sInfo": "Total results: _TOTAL_  |  Showing results: _START_ - _END_",
	    "sEmptyTable": "NO DATA FOUND",
	    "sInfoFiltered": " (Filtered from _MAX_ total records)",
	    "sSearch": "",
    },
     
   
  "aoColumns": [  // add your columns all here
		  {   
        "mData":"id", 
        "bSearchable": false, 
        "bSortable": true,
        "bVisible": true,   
        "mRender":function(data,type,row){ 
             return data;
        }
      },{
		    "mData": "first_name",
        "bSearchable": true, 
        "bSortable": true,
        "bVisible": true,
		    "mRender":function(data,type,row){ 
			       return data;
		    }
		     
		  },{
		    "mData": "last_name",
        "bSearchable": true, 
        "bSortable": true,
        "bVisible": true,
		     "mRender":function(data,type,row){ 
			       return data;
		    }
		     
		  },{
        "mData": "designation",
        "bSearchable": true, 
        "bSortable": true,
        "bVisible": true,
        "mRender":function(data,type,row){ 
             return data;
        }
         
      },{
        "mData": "id",
        "bSearchable": false, 
        "bSortable": false,
        "bVisible": true,
        "sWidth":"150px",
        "mRender":function(data,type,row){ 

        var html = '<button onclick="edit('+data+')" type="button" class="edit_'+data+' edit-btn btn btn-success btn-sm pull-left" data-toggle="modal" data-target="#add-modal">';
          html += '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>';
          html += '</button>';
          html += '<button  onclick="remove('+data+')" type="button" class="remove-btn btn btn-danger btn-sm pull-left" data-toggle="modal" data-target="#add-modal">';
          html += '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
          html += '</button>';

          return html;
        }
         
      }
	 ]
});


})
 
var count = 0; 
function add(){

if(!$("#example tbody").find("tr").hasClass("new")){
 count++;
 var btn = '<button onclick="save_data(\'save_'+count+'\')" type="button" class="save-btn btn btn-info btn-sm pull-left" data-toggle="modal" data-target="#add-modal">';
  btn += '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
  btn += '</button>';

 var html = "<tr class='new' id='save_"+count+"'></tr>";
     html += "<td></td>";
     html += "<td><input type='text' id='fname_save_"+count+"' /></td>";
     html += "<td><input type='text' id='lname_save_"+count+"' /></td>";
     html += "<td><input type='text' id='designation_save_"+count+"' /></td>";
     html += "<td>"+btn+"</td>";

 $("#example tbody").find(".dataTables_empty").parent("tr").remove();

 $("#example tbody").append(html);

}

}

function remove(id){

    $.ajax({
      method: "GET",
      url: 'php/delete.php?id='+id,
      success : function(data){
        location.reload();
      },
      error : function(){
        console.log("fail : remove_user");
      }
    });
}

function save_data(id){
  

  var fname = $("#fname_"+id).val();
  var lname = $("#lname_"+id).val();
  var desig = $("#designation_"+id).val();

  $.ajax({
      method: "GET",
      url: 'php/new.php', //?first_name='+fname+'&last_name='+lname+'&designation='+desig,
      data : { first_name: fname, last_name: lname, designation: desig },
      success : function(data){
        location.reload();
      },
      error : function(){
        console.log("fail : remove_user");
      }
  });
 
}

function edit(id){

  var par = $(".edit_"+id).parent().parent();

  var tdFName = par.children("td:nth-child(2)"); 
  var tdLName = par.children("td:nth-child(3)"); 
  var tdDName = par.children("td:nth-child(4)"); 
  var tdButtons = par.children("td:nth-child(5)");


  var fname =  tdFName.text();
  var lname =  tdLName.text();
  var dname =  tdDName.text();


  tdFName.html("<input id='inline_fname_"+id+"' type='text' value='"+fname+"'>"); 
  tdLName.html("<input id='inline_lname_"+id+"' type='text' value='"+lname+"'>"); 
  tdDName.html("<input id='inline_dname_"+id+"' type='text' value='"+dname+"'>"); 


  var btn = '<button onclick="edit_save('+id+')" type="button" class="save-btn btn btn-info btn-sm pull-left" data-toggle="modal" data-target="#add-modal">';
       btn += '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
       btn += '</button>';

  tdButtons.html(btn); 
  

}

function edit_save(id){

  var fname = $('#inline_fname_'+id).val();
  var lname = $('#inline_lname_'+id).val();
  var desig = $('#inline_dname_'+id).val();

  $.ajax({
      method: "GET",
      url: 'php/update.php', 
      data : { id : id, first_name: fname, last_name: lname, designation: desig },
      success : function(data){
        location.reload();
      },
      error : function(){
        console.log("fail : update_user");
      }
  });

}