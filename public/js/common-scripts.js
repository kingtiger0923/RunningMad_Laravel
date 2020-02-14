// Begin ready function.
$(function(){
    // Stripe ACA
    var pathname = window.location.pathname;
    if(pathname.indexOf("payment") != -1) {
        var stripe = Stripe('pk_live_HHtQ7NcvfZhmEgb1vERgSrHn00cB9QdWKC'); //RM
        // var stripe = Stripe('pk_test_LTOn51TCWCKF57JtVK9xQ3t7');//MR
        var elements = stripe.elements();
        // var cardElement = elements.create('card');
        var cardElement = elements.create('card', {
        hidePostalCode: true,
        });
        cardElement.mount('#card-element');

        var cardholderName = document.getElementById('cardholder-name');
        var cardButton = document.getElementById('card-button');
        var clientSecret = cardButton.dataset.secret;
        cardButton.addEventListener('click', function(ev) {
          stripe.handleCardPayment(
            clientSecret, cardElement, { 
              payment_method_data: {
                billing_details: {name: cardholderName.value}
              }
            }
          ).then(function(result) {
            if (result.error) {
                // console.log(result.error);
                $('.checkout-process-result').html(result.error.message);
            } else {
              // The payment has succeeded. Display a success message.
                $('.payment-loading-img').show();
                $.ajax({
                url: window.location.origin+'/chkprocess',
                type: "POST",
                data: { 'payment_method_id':1},
                success: function(data){
                    // alert('success');
                    $('.payment-loading-img').show();
                    window.location.href = window.location.origin+'/thankyou';
                 }
                });
            }
          });
        });
    }
    // End SCA

    // Begin input common focus and blur for value.
    $('input:text,input:password,textarea')
        .focus(function(){if(this.value==this.defaultValue){this.value=''}})
            .blur(function(){if(!this.value){this.value=this.defaultValue;}})
    // Ends input common focus and blur for value.

    // Begin Phone Nav
    $(".phone-nav").click(function(){
        $(".main-nav-wrap").slideToggle(400);
        $(this).toggleClass('open');
    }); // End Phone Nav

    // Begin Header Cart Slide
    $(document).on('click', '#headerCartBtn', function(e) { 
        $(".mini-cart-wrap").stop(true).slideToggle();
        $('#headerCartBtn').toggleClass('open');
    });

    // End Header Cart Slide
    $(document).click(function (e) {
        if (!$(e.target).closest('#headerCartBtn, #headerCart').length) {
            $('#headerCart').stop(true).slideUp();
            $('#headerCartBtn').removeClass('open');
        }
    }); // End Header Cart Slide

    // About page iframe/image parent tag selector
    $(".about-page-content iframe").parent().css({"padding": "0px"});
    $(".about-page-content img").parent().css({"padding": "0px"});

    // Begin Onclick Delivery Address Show Hide
    $("#deliveryBtn").click(function(){
        $(".delivery-address-content").slideToggle(400);
        $(this).toggleClass('open');
    }); // End Onclick Delivery Address Show Hide

    // Begin Sweetalert Button
    $(document).on('click', '.SwalBtn1', function() {
        swal.clickConfirm();
    });
    $(document).on('click', '.SwalBtn2', function() {
        swal.clickConfirm();
    });// End Sweetalert Button

    // Styled dropdown and browse
    $('div.styled-dropdown').each(function(){
        var $_this = $(this)
        $_this.find('> select').width($(this).width())
        $_this.find('> select').css({'opacity' : 0 })
        $_this.find('div.dropdown-styler > div').html( $_this.find( 'select option:selected').text())
        $_this.find('> select').change(function(){
        $_this.find('div.dropdown-styler > div').html( $_this.find(":selected").text() )
        })
    });// End styled dropdown

    // Evidence Browse
    $(document).on('click', '.browse', function(){
      var file = $(this).parent().parent().parent().find('.file');
      file.trigger('click');
    });
    $(document).on('change', '.file', function(){
      $(this).parent().find('.file-browse').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    }); // End Evidence Browse

    // Campaigns show more products
    $(".campaign-content ul > li.campaign-wrap").slice(0, 6).show();
    $("#showMoreCampaigns").on('click', function (e) {
        e.preventDefault();
        $(".campaign-content ul > li.campaign-wrap:hidden").slice(0, 3).slideDown();
        if ($(".campaign-content ul li.campaign-wrap:hidden").length == 0) {
            $("#showMoreCampaigns").fadeOut('slow');
        }
        $('html,body').animate({
            scrollTop: $(this).offset().top -110
        }, 1000);
    });// End Campaigns show more products
    
    // Campaigns progress
    const progress_bars = document.querySelectorAll('.progress');
    progress_bars.forEach(bar => {
        setTimeout(() => {
            const { size } = bar.dataset;
            bar.style.width = `${size}%`
        }, 1000);
    });// End Campaigns progress

    // Begin popup gallery
    $('.popupimage').magnificPopup({
        type: 'image',
        mainClass: 'mfp-with-zoom', 
        gallery:{
            enabled:true
        },
        zoom: {
        enabled: true, 
        duration: 300, 
        easing: 'ease-in-out',
        opener: function(openerElement) {
            return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }
    });
    // End  popup gallery

    // Fix Campaign Equal Heights On Page Load
    function campaignEqualHeight() {
        var heights = new Array();
        $('.campaign-item-wrap').each(function() { 
            $(this).css('min-height', '166px');
            $(this).css('max-height', 'none');
            $(this).css('height', 'auto');
            heights.push($(this).height());
        });
        var max = Math.max.apply( Math, heights );
        $('.campaign-item-wrap').each(function() {
            $(this).css('height', max + 'px');
        }); 
    }
    campaignEqualHeight();
    $(window).resize(function() {
        setTimeout(function() {
            campaignEqualHeight();
        }, 120);
    });

    // contact
    $("#contactpageprocess").submit(function(e) { 
        $('.contact-page-loading-img').show();
        var url = window.location.origin+"/processcontact";
        $(".contact-page-process-result").html("");
        $('.contact-page-process-result').show();
        $.ajax({
           type: "POST",
           url: url,
           data: $("#contactpageprocess").serialize(),// serializes the form's elements.
           success: function(data) {
                $('.contact-page-loading-img').hide();
                if($.isEmptyObject(data.error)){
                    $(".contact-page-process-result").html("Thank you for getting in touch!");
                    $("#contactpageprocess")[0].reset();
                    //For wait 5 seconds
                    setTimeout(function() {
                        $('.contact-page-process-result').hide();
                    }, 5000);
                } else {
                    printcontactErrorMsg(data.error);
                    setTimeout(function() {
                        $('.alert-danger').hide();
                    }, 5000);
                }
           }
        });
        e.preventDefault(); // avoid to execute the actual submit of the form.
    });


    // add to cart
    $(document.body).on('click', '.addtocart' ,function() { 
        var cart_url = window.location.origin+'/checkout';
        var interval = "single";
        var amount = $(this).attr('amount');
        var qty =  $(".race-quantity").find('.qty').val();
        // alert($(this).attr('coupon'));
        if( amount > 0 ) {
        $this = $(this);
        $.ajax({
            url: window.location.origin+'/addtocart',
            type: "POST",
            data: { 
                'id':$(this).attr('id'),
                'title': $(this).attr( "race-title" ),
                'amount':  amount,
                'image': $(this).attr('image'),
                'coupon': $(this).attr('coupon'),
                'interval':interval ,
                'qty':qty,
                'flag': $(this).attr('flag'),
                'charity': $(this).attr('charity'),
                'contribution': $(this).attr('contribution'),
            },
            beforeSend: function() { 
                $($this).html("<span class='cart-loading loading-img'></span>");
            },
            complete: function(){
                $(".cart-loading").css('display','none');
            },
            success: function(data){
                // $($this).html("Added to the cart(<a href='/puredeentravel/cart'>view</a>)");
                $($this).html("Added to cart");
                // popup response
                swal({
                    title: 'Race added',
                    type: 'success',
                    customClass: "cart-modal-wrap",
                    html:
                        '<button type="button" role="button" tabindex="0" class="SwalBtn1 customSwalBtn">' + 'Add more' + '</button>' +
                        '<a href="'+cart_url+'" class="SwalBtn2 customSwalBtn">' + 'Checkout' + '</a>',
                    showCancelButton: false,
                    showConfirmButton: false
                });

                $(".cart-loading").css('display','none');
                $("header .cart-btn-wrap").load( location.href+" header .cart-btn-wrap>*", function( response, status, xhr ) {
                    if ( status == "success" ) {
                        $(".mini-cart-wrap").slideToggle(500);
                        $(this).toggleClass('open');
                    }
                });
            }
            
        });     
        } else {
            $(amount).css({"background-color": "red"});
        }
      });

     // remove cart item
    $(document.body).on('click', '.remove-item' ,function() {
        $('.remove-loading-img').show();
        // alert();
        $.ajax({
            url: window.location.origin+'/removefromcart',
            type: "POST",
            data: { 'rowid':$(this).attr('rowid') },
            success: function(data){
            $('.remove-loading-img').hide();
            // refresh specific div
            $(".checkout-payment-section").load(location.href+" .checkout-payment-section>*","");
            $(".cart-section").load(location.href+" .cart-section>*","");
            $("header").load(location.href+" header>*","");
            $(".cart-count").load(location.href+" .cart-count","");
             }
        });        
    });
    
    $(document.body).on('click', '.header-item-remove' ,function() {
        $('.header-remove-loading-img').show();
        // alert();
        $.ajax({
            url: window.location.origin+'/removefromcart',
            type: "POST",
            data: { 'rowid':$(this).attr('rowid') },
            success: function(data){
            $('.header-remove-loading-img').hide();
            // refresh specific div
            $(".checkout-payment-section").load(location.href+" .checkout-payment-section>*","");
            $(".cart-section").load(location.href+" .cart-section>*","");
            $("header").load(location.href+" header>*","");
            $(".cart-count").load(location.href+" .cart-count","");
             }
        });        
    });

    // coupon
    $(document.body).on('click', '.couponbtn' ,function(e) { 
        e.preventDefault();
        //var id = $(this).attr('id');
        var coupon_id = '.coupon';
        // alert(id);
        $.ajax({
            url: window.location.origin+'/addcoupon',
            type: "POST",
            data: { 
                'code': $(coupon_id).val(),
                // 'coupon': $(this).attr('coupon'),
                // 'rowid':$(this).attr('crowid'),
            },
            success: function(data){
                //$('.remove-loading-img').hide();
                if(data == 'valid'){
                    // refresh specific div
                    $(".cart-content-section").load(location.href+" .cart-content-section>*","");
                    $(".checkout-payment-section .cart-content").load(location.href+" .checkout-payment-section .cart-content>*","");
                    $("header").load(location.href+" header>*","");
                    $(".cart-count").load(location.href+" .cart-count","");
                    $(".paypal-btn-img").load(location.href+" .paypal-btn-img>*","");
                    //$(".left-column").load(location.href+" .left-column>*","");
                    $(".coupon-result").html("The promo code is valid");
                    $($this).hide();
                } else 
                    $(".coupon-result").html("The promo code is invalid");
            }
        });        
    });

    // contribution
    $(document.body).on('click', '.contributionbtn' ,function(e) { 
        e.preventDefault();
        $('.loading-img').show();
        var id = $(this).attr('id');
        var contribution_id = '.contribution'+id;
        var camount = $(contribution_id).val();
        if( camount > 0 ) {
        $.ajax({
            url: window.location.origin+'/addcontribution',
            type: "POST",
            data: { 
                'contribution': $(contribution_id).val(),
                'rowid':$(this).attr('crowid'),
                'image':$(this).attr('image'),
            },
            success: function(data){
                $('.loading-img').hide();
                if(data == 'valid'){
                    // refresh specific div
                    $(".cart-content-section").load(location.href+" .cart-content-section>*","");
                    $(".checkout-payment-section .cart-content").load(location.href+" .checkout-payment-section .cart-content>*","");
                    //$(".checkout-payment-section").load(location.href+" .checkout-payment-section>*","");
                    $("header").load(location.href+" header>*","");
                    $(".cart-count").load(location.href+" .cart-count","");
                    $(".paypal-btn-img").load(location.href+" .paypal-btn-img>*","");
                    $(".contribution-result").html("Thank you for the contribution");
                } else 
                    $(".contribution-result").html("Something went wrong");
            }
        });
        } else  $(".contribution-result").html("Wrong input");       
    });

    // Payment Method Select Show Hide Option
    $(document.body).on('click', '.payment-method-btn input[type="radio"]' ,function() { 
    //$('.payment-method-btn input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        if(inputValue == 'paypal')
        $("form").addClass('paypalpaymentprocess');
        else 
        $("form").removeClass('paypalpaymentprocess');
        // alert(inputValue);
        $(".payment-box").not(targetBox).hide();
        $(targetBox).show();
    });//End Payment Method Select Show Hide Option

    // Evidence data process
    $('#evidenceprocess').on('submit', function(event){ 
        // alert();
        var img_attribs = [];
        $('#imgList li .thumb').each(function () {
            img_attribs.push( $(this).attr("data-id") );
        });
        //alert(img_attribs);
        var formData = new FormData(this);
        formData.append('imglists',img_attribs);
        $('.evidence-loading-img').show();
        var url = window.location.origin+'/evidenceprocess';
        $.ajax({
            type: "POST",
            url: url,
            // data:new FormData(this),
            data:formData,
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            // data: $("#evidenceprocess").serialize(),
            success: function(data) {
                $('.evidence-loading-img').hide(); 
                $('.evidence-process-result').css('display', 'block');
                $('.evidence-process-result').html(data.message);
                $('.evidence-process-result').addClass(data.class_name);
                $('.uploaded_image').html(data.uploaded_image);
                $(".evidence-container").load(location.href+" .evidence-container>*","");
                $(".userorderTable").load(location.href+" .userorderTable>*","");
                $(".status-info").load(location.href+" .status-info>*","");
                $('.success-icon').css('display', 'block');
            }
        });
       event.preventDefault(); // avoid to execute the actual submit of the form.
    });

    // Dashboard: update profile
    $('#updateprofile').on('submit', function(event){ 
        $('.loading-img').show();
        $(".update-message").html('');
        $(".update-message").css('display', 'block');
        var url = window.location.origin+'/updateprofile';
        $.ajax({
           type: "POST",
           url: url,
           data: $("#updateprofile").serialize(),// serializes the form's elements.
           success: function(data) {
                $('.loading-img').hide();
                if($.isEmptyObject(data.error)){
                    $(".update-message").html('Updated successfully');
                    $('.update-message').delay(5000).fadeOut('slow');
                    // refresh specific div
                    // $(".dashboard-profile-update").load(location.href+" .dashboard-profile-update>*","");
                } else {
                    printupdateprofileErrorMsg(data.error);
                    setTimeout(function() {
                        $('.up-print-error-msg').hide();
                    }, 5000);
                }
           }
        });
       event.preventDefault(); // avoid to execute the actual submit of the form.
    });

    function printupdateprofileErrorMsg(msg) {
        $(".up-print-error-msg").find("ul").html('');
        $(".up-print-error-msg").css('display','block');
        // $(".reference-number-wrap").css('display','none');
        $.each( msg, function( key, value ) {
            $(".up-print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }

     // update cart item
    $(document.body).on('click', '.update-item' ,function() {
        var qty = $('.'+$(this).attr('rowid')).val();
        $.ajax({
            url: window.location.origin+'/update_qty',
            type: "POST",
            data: { 'rowid':$(this).attr('rowid'), 'qty':qty },
            success: function(data){
                location.reload();
            }
        });        
    });

    // Paypal payment form validation
    $(document.body).on('click', '.pp', function(e) {
        var url = window.location.origin+"/paypalpaymentprocess";
        e.preventDefault();
        $.ajax({
           type: "POST",
           url: url,
           data: $(".paypalpaymentprocess").serialize(),
           // data: $(this).serialize(),// serializes the form's elements.
           success: function(data) {
                if($.isEmptyObject(data.error)){
                    $(".paypalpaymentprocess").submit();
                } else {
                    $("body,html").animate({ scrollTop: $("#payPalErrorMessage").offset().top +310 }, 1500);
                    paypalvalidateErrorMsg(data.error);
                }
           }
        });
        e.preventDefault(); // avoid to execute the actual submit of the form.
    });

    function paypalvalidateErrorMsg(msg) {
        $(".up-print-error-msg").find("ul").html('');
        $(".up-print-error-msg").css('display','block');
        // $(".reference-number-wrap").css('display','none');
        $.each( msg, function( key, value ) {
            $(".up-print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }

    // shop add to cart
    $(document.body).on('click', '.shopaddtocart' ,function() {  
        var cart_url = window.location.origin+'/checkout';
        var interval = "single";
        var amount = $(this).attr('amount');
        var qty =  1;
        if( amount > 0 ) {
        $this = $(this);
        $.ajax({
            url: window.location.origin+'/addtocart',
            type: "POST",
            data: { 
                'id':$(this).attr('id'),
                'title': $(this).attr( "product-title" ),
                'amount':  amount,
                'image': $(this).attr('image'),
                'coupon': 1,
                'flag': $(this).attr('flag'),
                'charity': 0,
                'interval':interval ,
                'contribution': 0,
                'qty':qty,
            },
            beforeSend: function() { 
                $($this).html("<span class='cart-loading loading-img'></span>");
            },
            complete: function(){
                $(".cart-loading").css('display','none');
            },
            success: function(data){
                // $($this).html("Added to the cart(<a href='/puredeentravel/cart'>view</a>)");
                $($this).html("Added to cart");
                // popup response
                swal({
                    title: 'Product added',
                    type: 'success',
                    customClass: "cart-modal-wrap",
                    html:
                        '<button type="button" role="button" tabindex="0" class="SwalBtn1 customSwalBtn">' + 'Add more' + '</button>' +
                        '<a href="'+cart_url+'" class="SwalBtn2 customSwalBtn">' + 'Checkout' + '</a>',
                    showCancelButton: false,
                    showConfirmButton: false
                });

                $(".cart-loading").css('display','none');
                $("header .cart-btn-wrap").load( location.href+" header .cart-btn-wrap>*", function( response, status, xhr ) {
                    if ( status == "success" ) {
                        $(".mini-cart-wrap").slideToggle(500);
                        $(this).toggleClass('open');
                    }
                });
            }
            
        });     
        } else {
            $(amount).css({"background-color": "red"});
        }
      });


    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });

});// End ready function

// Window load function
$(window).on("load", function() {
    // Home slider
    if($('#homeSlider').length){
        $('#homeSlider').flexslider({
            animation: "fade",
            slideshow: true,
            directionNav: false,
            controlNav: true,
            start: function(slider){
                $('body').removeClass('loading');
            }
            ,
            animationLoop: true
        });
    };// End home slider
});// End window load function


$(window).scroll(function(event) {
    // Begin sticky header
    var st = $(this).scrollTop();
    if (st > $("header").height()) {
        $(".header,.main-wrap-inner").addClass("sticky");
        $(".header").css("top", 0);
    } else {
        $(".header,.main-wrap-inner").removeClass("sticky");
        if (st < 100) {
            $(".header").css("top", -st);
        } else if (st < 200) {
            $(".header").removeClass("animated");
        } else {
            $(".header").css("top", -100);
            $(".header").addClass("animated");
        }
    }// End sticky header

});


