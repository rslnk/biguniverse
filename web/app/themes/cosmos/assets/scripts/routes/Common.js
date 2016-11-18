export default {
  init() {
    // JavaScript to be fired on all pages
    /* global stickyNavOnScroll toggleMobileMenu toggleSearchModal */
    /* eslint prefer-arrow-callback: ["error", { "allowNamedFunctions": true }] */
    function addStickyClassToNav() {
      const windowTop = $(window).scrollTop();
      if (windowTop > 250) {
        $('.js-global-nav').addClass('is-sticky');
      } else {
        $('.js-global-nav').removeClass('is-sticky');
      }
    }

    function stickyNavOnScroll() {
      $(window).scroll(addStickyClassToNav);
      addStickyClassToNav();
    }

    function toggleMobileMenu() {
      $('.js-toggle-modal-menu').click(function stopDefAction(evt) {
        evt.preventDefault();
        $('.js-modal-menu').fadeToggle();
        $('.js-toggle-modal-menu').toggleClass('is-open');
        $('body').toggleClass('is-modal');
      });
    }
    function toggleSearchModal() {
      $('.js-toggle-modal-search').click(function stopDefAction(evt) {
        evt.preventDefault();
        $('.js-modal-search').fadeToggle();
        $('body').toggleClass('is-modal');
      });
    }
    stickyNavOnScroll();
    toggleMobileMenu();
    toggleSearchModal();
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
