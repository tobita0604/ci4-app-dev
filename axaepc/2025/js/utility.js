
(function(){

	function rollover(){
		$(".rollover").hover(function(){
			$(this).attr("src",$(this).attr("src").replace(/^(.+)(\.[a-z]+)$/, "$1_on$2"));
		},function(){
			$(this).attr("src",$(this).attr("src").replace(/^(.+)_on(\.[a-z]+)$/, "$1$2"));
		}).each(function(){
			$("<img>").attr("src",$(this).attr("src").replace(/^(.+)(\.[a-z]+)$/, "$1_on$2"));
		});
	};

	function pagetop(){
		$(".pagetop a").click(function(){
			$('html,body').animate({
				scrollTop: $($(this).attr("href")).offset().top
			}, 800, 'easeInOutQuad');
			return false;
		});
	};

	$(window).on('load', function(){
		rollover();
		pagetop();	
	});
	
}());