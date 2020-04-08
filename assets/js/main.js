;(function ($) {
  $(document).ready(function () {
    alert("Hello");

    var slider = tns({
      container: '.my-slider',
      items: 1,
      slideBy: 'page',
      autoplay: false
    });
  });
})(jQuery);