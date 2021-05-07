

$( document ).ready(function() {

  /* Bootstrap dropdown on hover */
$(".dropdown-menu").css('margin-top', 0);
$(".dropdown")
  .mouseover(function () {
    $(this).addClass('show').attr('aria-expanded', "true");
    $(this).find('.dropdown-menu').addClass('show');
  })
  .mouseout(function () {
    $(this).removeClass('show').attr('aria-expanded', "false");
    $(this).find('.dropdown-menu').removeClass('show');
  });

/* Header on scroll */
$(window).scroll(function () {
  var scroll = $(window).scrollTop();
  //>=, not <=
  if (scroll >= 500) {
    //clearHeader, not clearheader - caps H
    $(".site-header").addClass("stickyHeader");
  }
  else {
    $(".site-header").removeClass("stickyHeader");
  }
}); //missing );

/* Notifications */
$(".notify-btn").click(function () {
  $(".notification").toggleClass('d-block');
});

/* Show transcript popup by default */
$('#transcript-notification').modal('show');
$(document).on("click", function (event) {
  if (!$(event.target).closest(".notification-wrap").length) {
    $(".notification").removeClass("d-block");
  }
});

// country transcript

$("#transcript-country").click(function () {
  $('.transcript-detail').addClass('show');
  $('.present-detail').removeClass('show');
 });

 $("#transcript-present").click(function () {
   $('.present-detail').addClass('show');
    $('.transcript-detail').removeClass('show');
 });

/* order a personal consultation */
$("#select-english").click(function () {
  // console.log("click me");
  $('#call_method_1').addClass('d-block');
  $('#call_method_2').removeClass('d-block');
 });

 $("#select-spanish").click(function () {
   $('#call_method_2').addClass('d-block');
    $('#call_method_1').removeClass('d-block');
 });

 $('#select-apostille:checkbox').change(function(){
  if($(this).is(":checked")) {
      $('div.menuitem').addClass("menuitemshow");
  } else {
      $('div.menuitem').removeClass("menuitemshow");
  }
});
 $(function() {
  $("#select-particular").change(function() {
  if(( $('option:selected', this).text() =='United States' )){
      $('#select-us').addClass('d-block');
      }
      else{
          $('#select-us').removeClass('d-block'); 
      }
  });
});
});

$('#select-apostille:checkbox').change(function(){
  if($(this).is(":checked")) {
      $('div.menuitem').addClass("menuitemshow");
  } else {
      $('div.menuitem').removeClass("menuitemshow");
  }
});

  $( document ).ready(function() {
     var bodyHeight = jQuery(document ).height(); 
  jQuery('body').css({
    'height':  bodyHeight + 'px'
  });
});
//for making other school required


  $('[id="other_school_name"]').change(function()
      {
    if ($(this).is(':checked')) {
      console.log('required');
      $('input[id="other_school"]').attr('required', 'required');
    document.getElementById("other_school").disabled = false;
    }   ;
  });
 
  $('[id="wra_school"]').change(function()
      {
    if ($(this).is(':checked')) {
      console.log(' not required');
      $('input[name="other_school"]').removeAttr('required');
         document.getElementById("other_school").disabled = true;
    }   ;
 });


 ////tabs
//  $('#myTab a').on('click', function (e) {
//   e.preventDefault()
//   $(this).tab('show')
// })
// $('#myTab a[href="#profile"]').tab('show') // Select tab by name
// $('#myTab li:first-child a').tab('show') // Select first tab
// $('#myTab li:last-child a').tab('show') // Select last tab
// $('#myTab li:nth-child(3) a').tab('show') // Select third tab
 