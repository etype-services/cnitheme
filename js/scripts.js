(function ($) {
  Drupal.behaviors.superfish = {
    attach: function (context) {

      function mobile_menu(w, searchForm) {
        var breakpoint;
        // console.log(Drupal.settings.cni.menu_break_point);
        // because some sites (San Marcos) are on their own theme, so cni breaks
        // needs fixing at some point to find
        if (typeof Drupal.settings.cni !== 'undefined') {
          breakpoint = Drupal.settings.cni.menu_break_point;
        } else {
          breakpoint = 767;
        }
        var wrapper = $('#mobile-menu-wrapper');

        if (w > breakpoint) {
          if (wrapper.length > 0) {
            wrapper.remove();
            searchForm.show();
          }
        }
        else {
          if (wrapper.length === 0) {
            $('.region-user-menu').prepend('<div id="mobile-menu-wrapper"><div id="mobile-menu-control"></div><ul id="mobile-menu" class="menu"></ul></div>');

            searchForm.hide();
            $('#superfish-1 li').clone().appendTo($('#mobile-menu'));
            $('#block-system-user-menu ul.menu li').clone().appendTo($('#mobile-menu'));
            $('#mobile-menu li ul').remove();
            $('#mobile-menu-control').click(function () {
              $('#mobile-menu').toggle()
            });

          }
        }
      }

      var searchForm = $('#search-block-form');
      var search = $('#search-control');
      if (search.length === 0) {
        $('#block-search-form .content').append('<div id="search-control"></div>');
        search = $('#search-control');
      }

      $(search).click(function () {
        searchForm.toggle();
        if (searchForm.is(':visible')) {
          $('#edit-search-block-form--2').focus();
        }
      });

      var w = $(window).width();
      mobile_menu(w, searchForm);

      $(window).resize(function () {
        var w = $(window).width();
        mobile_menu(w, searchForm);
      });
    }
  };

    Drupal.behaviors.cni = {
        attach: function (context) {
            $("li.views-fluid-grid-item")
                .mouseenter(
                    function () {
                        $(this).find('.overlay').css('display', 'none');
                    })
                .mouseleave(
                    function () {
                        $(this).find('.overlay').css('display', 'block');
                    });
        }
    };

})(jQuery);
