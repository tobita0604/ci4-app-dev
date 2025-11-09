$(function(){
  var pageTop = $("#page-top");
  pageTop.hide();
  pageTop.click(function () {
    $('body, html').animate({ scrollTop: 0 }, 500);
    return false;
  });
  $(window).scroll(function () { 
    if($(this).scrollTop() >= 500) {
      pageTop.fadeIn();
    } else {
      pageTop.fadeOut();
    }
  });
});