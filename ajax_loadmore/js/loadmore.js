

$(document).ready(function(){

var countpage = 1;

$("#custom-load-more").click(function(){
	 
	$.ajax({
	  url: "https://jsonplaceholder.typicode.com/posts/"+countpage,
	  beforeSend: function() {
	   	// you can add loader image
	  }
	})
	.done(function( data ) {
	      // you can remove loader image
	      countpage++;
	      var id = data.userId;
	      var title = data.title;
	      var desc = data.body;

	      var template = htmltemplate(id,title,desc);
	      $("#custom-data-holder").append(template);

	      console.log(data);
	  
	});

});




});

function htmltemplate(text1,text2,text3){

var html = '<div class="custom-post"><div class="text-center">USER ID : '+text1+'</div>';
	html +='<div class="title text-center">'+text2+'</div>';
	html +='<div class="desc-title text-center">'+text3+'</div></div>';

return html;

}
