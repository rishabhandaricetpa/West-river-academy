
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


$("#not_california").click(function () { 
  $("#transcript-country").removeClass("show");

});