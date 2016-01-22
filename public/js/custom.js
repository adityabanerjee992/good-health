/* Prescription Upload */
$(document).ready(function(){
    $('.savedpresc').on('click', function(){
        $('.saved-prescriptions').toggleClass('saved-prescriptions-show saved-prescriptions-hide');
    });
});

/* Tabs */
        
         $(document).ready(function(){
             $('.product-detail-tabs ul li:first-child').addClass('active');
             $('.product-detail-tabs .tab-content .tab-pane:first-child').addClass('active');
             $('#product-details-tabs a').click(function (e) {
                e.preventDefault()
                $(this).tab('show')
              });
              
//             $('.top-login-register').each(function(){  
//                 $('.top-login-register').on('click',function() {   
//                     $('top-login-register').removeClass('active'); 
//                     $(this).addClass('active');   
//                 });  
//             }); 
            $('.address_info_user .myaccount-address').first().addClass('active');
            $('.address_info_user .myaccount-address').on('click',function(){
                $('.address_info_user .myaccount-address').removeClass('active');
                $(this).addClass('active');
            });
            
            $('.enter-address .my-address').first().addClass('active');
            $('.enter-address .my-address').on('click',function(){
                $('.enter-address .my-address').removeClass('active');
                $(this).addClass('active');
            });
            
            
             
             
            /* Search Results Keyup keydown */
             
            $('.search-results ul').on('focus', 'li', function() {
                $this = $(this);
                $this.addClass('active').siblings().removeClass();
//                $this.closest('div.container').scrollTop($this.index() * $this.outerHeight());
            }).on('keydown', 'li', function(e) {
                alert('fafasf');
            }).find('li').first().focus();
            
            
            $(window).on('scroll',function(){
                var winWidth = $(window).width();
                if (winWidth > 767) {
                    var lastScrollPosition = 0;
                    var currentScrollPosition = $(window).scrollTop();
                    var header_height = $('.header-area').height();
                    //console.log(header_height);
                    //cosole.log('aggg-'+jQuery(this).scrollTop());
                    var header_height1 = header_height + 20;
                    if($(this).scrollTop() > header_height1){
                        //console.log('aa');
                        
                        $('.header-area').addClass('header-area-fixed');
                        $('.banner-static').css('top','10%');

                        if (currentScrollPosition < lastScrollPosition) {
                                $('.header-area').css('top', '-27px');
                        }
                        lastScrollPosition = currentScrollPosition;

                    }
                    else{
                        
                        $('.header-area').removeClass('header-area-fixed');
                        $('.banner-static').css('top','16%');
                         
                    }
                }
            });
            /* Placeholder */
            $.fn.togglePlaceholder = function() {
                return this.each(function() {
                    $(this) .data("holder", $(this).attr("placeholder"))
                    .focusin(function(){
                        $(this).attr('placeholder','');
                    })
                    .focusout(function(){
                        $(this).attr('placeholder',$(this).data('holder'));
                    });
                });
            };
            $("[placeholder]").togglePlaceholder();
            
            /* Upload File  For Home Page */
            // document.getElementById("uploadBtn").onchange = function () {
            //     document.getElementById("uploadFile").value = this.value;
            // };
            
            /* Pincode Popup */
            // $('#pincodePopup').modal('show');             
         }); 
               
// Drugs Order Form
$(".clsp").click(function() {
    if($("#collapseme").hasClass("out")) {
        $("#collapseme").addClass("in");
        $("#collapseme").removeClass("out");
    } else {
        $("#collapseme").addClass("out");
        $("#collapseme").removeClass("in");
    }
});

var main = function() {
$('.tbl-view').click(function() {
$('.tbl-data').toggle();
});
}

$(document).ready(main);




// BS Dropdown hover fade effect
$('ul.nav li.dropdown').hover(function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
}, function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
});




// Only enable if the document has a long scroll bar
// Note the window height + offset
if ( ($(window).height() + 100) < $(document).height() ) {
    $('#top-link-block').removeClass('hidden').affix({
        // how far to scroll down before link "slides" into view
        offset: {top:100}
    });
}

//MyCode
$.each(rows, function( index, value ) {

	var i=$('#select_'+value);

	i.change(function() {
	
	var rowId    = i.closest("tr").attr("id");
	var quantity = i.val();

	
    $.ajax({
      url: '/cart/update-cart',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'post',
      data: {'rowId': rowId,'quantity' : quantity},
      success: function(data, status) {
        if(data.status == "ok") {
          	window.location = "/cart";
        }
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call

	});	

	var j=$('#del_'+value);

	j.click(function() {
	
	var rowId    = j.closest("tr").attr("id");
	var quantity = j.val();

	
    $.ajax({
      url: '/cart/delete-product-from-cart',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'post',
      data: {'rowId': rowId},
      success: function(data, status) {
        if(data.status == "ok") {
          	window.location = "/cart";
        }
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call

	});
});

$('#coupon').click(function(){

	var couponCode= $('#coupon_code').val();
	
    $.ajax({
      url: '/coupon/apply-coupon',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'post',
      data: {'couponCode': couponCode},
      success: function(data, status) {
        if(data.status == "ok") {

        	alert('Invalid Coupon Applied');
          	window.location = "/cart";
        }
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call

});


$('#checkout').click(function(e) {
    if($('#terms').is(':checked') && $('#delivery').is(':checked')) {

    }
    else
    {
        e.preventDefault();
        bootbox.alert('Please Check The CheckBoxes', function() {
            console.log("Alert Callback");         
          });
    }
});

j=0;
$(document).ready(main);

/* Upload File */
$(document).on('change', '.btn-file :file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });

  $(document).ready( function() {
      $('.btn-file :file').on('fileselect', function(event, numFiles, label) {

          var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' files selected' : label;

          if( input.length ) {
              input.val(log);
          } else {
              if( log ) alert(log);
          }

      });
  });



