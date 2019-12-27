(function ($){

  $.fn.toggleChange = function () {
      $('.toggle').toggle(function() {
          $(this).addClass('toggle_active');
          $(this).find('.toggle_content').slideToggle();
      }, function() {
          $(this).removeClass('toggle_active');
          $(this).find('.toggle_content').slideToggle();
      });
  };

})( jQuery );
