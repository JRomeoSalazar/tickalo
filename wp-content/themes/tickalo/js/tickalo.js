/**
 * Created by Jorge on 15/01/2017.
 */

jQuery(document).ready(function ($) {
  var addTo        = 0,
      headerHeight = 0,
      $mainHeader  = $('.main-header'),
      $mainMenu    = $('#main-menu');
  if ($mainHeader.attr('data-sticky-menu') === 'on' && $(window).width() > 767) {
    if ($mainHeader.hasClass('fixed-small')) {
      addTo = $('#site-header').outerHeight();
    } else {
      addTo = $mainHeader.outerHeight();
    }
  }
  var hash = location.hash;
  if (hash) {
    var idName = hash.substring(1);
    var target = $(hash);
    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
    console.debug(target.offset().top - headerHeight - addTo);
    if (target.length) {
      $('html, body').animate(
        {scrollTop: target.offset().top - headerHeight - addTo - 560},
        {
          duration:1000,
          complete:function(){
            $('body').removeClass('mp-scrolling');
            $mainMenu.find('.current').removeClass('current');
            $mainMenu.find('a[href$="' + idName + '"]').parent('li').addClass('current');
          },
          start:function(){
            $('body').addClass('mp-scrolling');
          }
        }
      );
      return false;
    }
  }
});
