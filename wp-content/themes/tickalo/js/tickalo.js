/**
 * Created by Jorge on 15/01/2017.
 */

jQuery(document).ready(function ($) {
  var headerHeight = 0,
      $mainHeader  = $('.main-header'),
      $siteHeader  = $('.site-header'),
      $mainMenu    = $('#main-menu'),
      $mainSlider = $('#main-slider');
  if ($mainHeader.attr('data-sticky-menu') === 'on' && $(window).width() > 767) {
    if ($mainHeader.hasClass('fixed-small')) {
      headerHeight = $siteHeader.outerHeight();
    } else {
      headerHeight = $mainHeader.outerHeight();
    }
  }
  var hash = location.hash;
  if (hash) {
    var idName = hash.substring(1);
    var target = $(hash);
    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
    if (target.length) {
      $('html, body').animate(
        {scrollTop: target.offset().top - headerHeight - $mainSlider.outerHeight() + $mainSlider.find('.slides li').outerHeight()},
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
