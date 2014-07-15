(function(window, $, undefined) {
	$(document).ready(function() {
		jQuery('p:empty').remove();
	});
})(window, jQuery);

/**
 * NSCLICK javascript modules
 */
(function (window, $, undefined) {
  if (!Object.prototype.hasOwnProperty.call(window, 'nsclick'))
  	window.nsclick = {
  		'fn' : {}, // functions
  		'var': {}  // variables
  	};

  /**
   * Form Tracking
   */
	(function () {
		var pages = {};

		function trackPageView (pagePath) {
			if ( !Object.prototype.hasOwnProperty.call(window, '_gaq') || (typeof(pagePath) != typeof('')) )
				return;

			// console.log('trackPageView: ', pagePath);
			_gaq.push(['_trackPageview', pagePath]);
		};

		nsclick.fn.formtrack = function (pagePath) {
			
			if (pages.hasOwnProperty(pagePath))
				return false;
			pages[pagePath] = true;
			return trackPageView(pagePath);
		};

	})();

})(window, jQuery);
