//A-yo. ;)

(function(){

	// options
	var options = {
		duration: 400,
		easing: 'easeOutCubic',
		auto: true,
		interval: 6000
	};

	// doms
	var $window = $(window),
		$container = $('#slider'),
		$element = $container.find('ul'),
		$list = $element.find('li'),
		$next = $container.find('#next'),
		$prev = $container.find('#prev'),
		shift = 2,
		lw = $list.width(),
		len = $list.length,
		timer = '';

	var $header = $('#header'),
		$headerAfter = $header.next(),
		headerY = $header.height(),
		containerY = $container.height();

	function initialize(){
		setup();
		$window.on('resize', resize);
		$next.on('click', function(){ slide(true); });
		$prev.on('click', function(){ slide(false); });
		$window.on('scroll', scroll);
		load();
		if(options.auto) timer = setInterval(function(){ slide(true) }, options.interval);
	};

	function setup(){

		for(var i = shift; i > 0; i--) $element.find('li').eq(len - i).remove().prependTo($element);

		// div.layer繧2縺､霑ｽ蜉縺吶ｋ縲
		for(var i = 0; i < 2; i++) $('<div class="layer"></div>').insertAfter($element);

		// 荳翫〒霑ｽ蜉縺励◆div繧貞､画焚縺ｫ蜈･繧後ｋ
		$leftlayer = $container.find('.layer').eq(0);
		$rightlayer = $container.find('.layer').eq(1);

		// resize髢｢謨ｰ繧貞他縺ｶ
		resize();

	};

	function resize(){
		var _val = ($window.width() - lw) / 2 - lw * shift;
		$element.css({
			'width': lw * len,
			'left': _val
		});
		$leftlayer.css('left', _val + lw);
		$rightlayer.css('left', _val + lw * 3);
	};

	// 繧｢繝九Γ繝ｼ繧ｷ繝ｧ繝ｳ繧堤ｮ｡逅�☆繧矩未謨ｰ
	function slide(direction){

		// $element縺後い繝九Γ繝ｼ繧ｷ繝ｧ繝ｳ荳ｭ縺ｪ繧峨∝�逅�＠縺ｪ縺
		if($element.filter(':animated').length) return;

		// 繝ｫ繝ｼ繝励ｒ蛛懈ｭ｢
		if(options.auto) clearInterval(timer);

		// 遘ｻ蜍輔ｒ螟画焚縺ｫ蜈･繧後ｋ縲ょｼ墓焚縺荊rue縺ｪ繧-lw,false縺ｪ繧瑛w
		val = (direction)? -lw: lw;

		// 繧｢繝九Γ繝ｼ繧ｷ繝ｧ繝ｳ繧ｹ繧ｿ繝ｼ繝医よ怙蠕後↓繧ｳ繝ｼ繝ｫ繝舌ャ繧ｯ髢｢謨ｰ繧貞他縺ｳ蜃ｺ縺吶
		$element.animate({
			'marginLeft': val
		}, options.duration, options.easing, callback);

	};

	// slide髢｢謨ｰ螳溯｡悟ｾ後↓蜻ｼ縺ｳ蜃ｺ縺咎未謨ｰ
	function callback(){

		// val縺0繧医ｊ蟆上＆縺代ｌ縺ｰ縲∵怙蛻昴�li繧呈怙蠕後↓遘ｻ蜍輔＆縺帙ｋ縲ゅ
		// val縺0繧医ｊ螟ｧ縺阪￠繧後�縲∵怙蠕後�li繧呈怙蛻昴↓遘ｻ蜍輔＆縺帙ｋ縲
		(0 > val)? $element.find('li').eq(0).remove().appendTo($element): $element.find('li').eq(len - 1).remove().prependTo($element);

		// val縺0繧医ｊ螟ｧ縺阪￠繧後�縲∵怙蠕後�li繧呈怙蛻昴↓遘ｻ蜍輔＆縺帙ｋ縲
		$element.css('marginLeft', 0);

		// options.auto縺荊rue縺ｪ繧峨√Ν繝ｼ繝励ｒ髢句ｧ
		if(options.auto) timer = setInterval(function(){ slide(true) }, options.interval);

	};


	// 繝倥ャ繝繝ｼ繧貞崋螳壹☆繧矩未謨ｰ
	function scroll(){

		// 繧ｹ繧ｯ繝ｭ繝ｼ繝ｫ驥上′containerY繧剃ｸ雁屓縺｣縺溘ｉ縲�未謨ｰ_fixed繧貞ｮ溯｡
		// 繧ｹ繧ｯ繝ｭ繝ｼ繝ｫ驥上′containerY繧剃ｸ雁屓縺｣縺溘ｉ縲�未謨ｰ_static繧貞ｮ溯｡
		(containerY <= $window.scrollTop())?
			_fixed() :
			_static();

		function _fixed(){
			$header.css({
				'position': 'fixed',
				'top': 0,
				'left': 0
			});
			$headerAfter.css('marginTop', headerY);
		};

		function _static(){
			$header.css({
				'position': 'static',
				'top': '',
				'left': ''
			});
			$headerAfter.css('marginTop', '');
		};

	};

	function load(){
		var array = [$element, $next, $prev];
		for(var i = 0; i < array.length; i++) array[i].css('visibility', 'visible');
		$container.css('background', 'none');
	};

	$window.on('load', initialize);
	
}());