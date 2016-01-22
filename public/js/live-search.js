
$(function() {
    $('#my-search-bar').submit(function(event){

       event.preventDefault();
    });

    $("#search-results").hide();
    
     $('#search').focus(function(){
     $(this).removeAttr('placeholder');
       if($('#search').val() != ''){
         $("#search-results").show();
      }else{
         $("#search-results").hide();
      }
    }); 


    $('#search').focusout(function() {
      $(this).attr('placeholder','SEARCH YOUR MEDICINE / OTC PRODUCTS');
        // alert('input box focus');
         // $("#search-results").hide();
    });
      
    $('#search-results-div').focusout(function() {
      alert('div Focus out ');
      // $(this).attr('placeholder','SEARCH YOUR MEDICINE / OTC PRODUCTS');     
        $("#search-results").hide();
    });    

$( "#search-results-divults" ).mouseup(function() {
  alert( "Handler for .mouseup() called." );
});
      // $("#search").keydown(function() {
      //   // alert('keydowney down');
      //   // $("#search-results").hide() ;
      // });

    if($("#search").val() == ''){ 
       $("#search-results").hide();
    }

    // $("#search").keyup(function(e) {
    //     var keyword = $("#search").val();
    //     var dataString = 'keyword='+ keyword;
    //     // alert(e.keyCode);
    //     if(e.keyCode != 38 && e.keyCode != 40 && e.keyCode != 13){
    //           $.ajax({
    //               type: "POST",
    //               url: "/form-search",
    //                headers: {
    //                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                 },
    //               data: dataString,
    //             cache: false,
    //             beforeSend: function(html) 
    //             {
    //               document.getElementById("search-results").innerHTML = ''; 
    //               $("#keyword").show();
    //                   $(".keyword").html(keyword);
    //                   $("#flash").html('Loading Results');
    //               },
    //               success: function(html)
    //               {
    //                   $("#search-results").show();
    //                    document.getElementById("search-results").innerHTML = ''; 
    //                   $("#search-results").append(html);

    //                   if($('#search').val() == ''){
    //                    $("#search-results").hide();
    //                   }
    //               }
    //           });
    //   }
    //    return false;
    // });

    $("#search").keyup(function() {
      // $("#search-results").hide();
    });
});