export default {
  init() {
    // JavaScript to be fired on all pages
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
    $( ".burgermenu" ).click(function() {
        $(".nav-primary, .nav-tool-language, .nav-tool-login").toggle("fast");
	});
  },
};
