var servsec = null;
(function($){
	servsec = {
		init: function() {
			this.accordian();
		},
		accordian: function(){
			$('body').on('click', '.svs-accordian-section .svs-accordian-wrapper', function(){
				var _reff = $(this).find('.svs-accordian-description').slideToggle();
			});
		}
	};
	$(document).ready(function(){
		servsec.init();
	});
})(jQuery);