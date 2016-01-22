/*
* Author:      Marco Kuiper (http://www.marcofolio.net/)
*/
$(function() {

var currentSelection = 0;
var currentUrl = '';

// google.load("jquery", "1.3.1");
// google.setOnLoadCallback(function()
// {
	// alert('loaded ');
		// Register keypress events on the whole document
	$(document).keypress(function(e) {
		console.log( "Handler for .keypress() called." );	
		switch(e.keyCode) { 
			// User pressed "up" arrow
			case 38:
			// alert('loaded');
				navigate('up');
			break;
			// User pressed "down" arrow
			case 40:
				navigate('down');
			break;
			// User pressed "enter"
			case 13:
				if(currentUrl != '') {
					window.location = currentUrl;
				}
			break;
			default:
			 var keyword = $("#search").val();
	        var dataString = 'keyword='+ keyword;
			 $.ajax({
                  type: "POST",
                  url: "/form-search",
                   headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                  data: dataString,
                cache: false,
                beforeSend: function(html) 
                {
                  document.getElementById("search-results").innerHTML = ''; 
                  $("#keyword").show();
                      $(".keyword").html(keyword);
                      $("#flash").html('Loading Results');
                  },
                  success: function(html)
                  {
                      $("#search-results").show();
                       document.getElementById("search-results").innerHTML = ''; 
                      $("#search-results").append(html);
                      	
                      if($('#search').val() == ''){
                       $("#search-results").hide();
                      }
                  }		
              });

			break;
		}
	});
	
	// Add data to let the hover know which index they have
	for(var i = 0; i < $("#search-results ul li a").size(); i++) {
		$("#search-results ul li a").eq(i).data("number", i);
	}
	
	// Simulote the "hover" effect with the mouse
	$("#search-results ul li a").hover(
		function () {
			currentSelection = $(this).data("number");
			setSelected(currentSelection);
		}, function() {
			$("#search-results ul li a").removeClass("itemhover");
			currentUrl = '';
		}
	);
});

function navigate(direction) {
	// Check if any of the menu items is selected
	if($("#search-results ul li .itemhover").size() == 0) {
		currentSelection = -1;
	}
	
	if(direction == 'up' && currentSelection != -1) {
		if(currentSelection != 0) {
			currentSelection--;
		}
	} else if (direction == 'down') {
		if(currentSelection != $("#search-results ul li").size() -1) {
			currentSelection++;
		}
	}
	setSelected(currentSelection);
}

function setSelected(menuitem) {
	$("#search-results ul li a").removeClass("itemhover");
	$("#search-results ul li a").eq(menuitem).addClass("itemhover");
	currentUrl = $("#search-results ul li a").eq(menuitem).attr("href");
}