(function($) {
	$(function() {
		
		$(".pageTop").hide();
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$(".pageTop").stop().fadeTo(500,1);
			} else {
				$(".pageTop").stop().fadeTo(500,0);
			}
		});
		$(".pageTop a").click(function() {
			$("html, body").animate({ scrollTop : 0 });
			return false;
		});
    
    $(".scrollAnc").click(function() {
			$("html, body").animate({ scrollTop : $("#anc").offset().top });
			return false;
		});
		
		//$("body:not('#pageCorp') a[href^=#]").click(function(){
			//var off= $($(this).attr("href")).offset().top;
			//var offTop=off;
			//$('html,body').stop(true, false).animate({ scrollTop:offTop},500);
			 //return false;
		//});
		
		$(".hover").hover(function() {
			$(this).stop().fadeTo("fast", 0.6);
		},function(){
			$(this).stop().fadeTo("fast", 1.0);
		});
		
		$('.btnMore a').click(function(){
			$('.photoList.hidden').fadeIn(500, function(){
				$(".fixHeight").fixHeight();
				$('.btnMore').fadeOut();
			});
			return false;
		});
		
		if ($().carouFredSel) {
			/* TOP kyev */
			$('#keyv .text ul').carouFredSel({
				width: '1000',
				auto: true,
				prev: false,
				next: false,
				circular: true,
				infinite : true,
				direction: "up",
				scroll: {
					items: 1, //スクロールする個数
            		duration: 1000,  //スクロールにかかる時間(ms)
					fx:"crossfade"
				},
				auto: 5000 //切り替わる間隔(ms)
			});
			
			
			/* TOP news */
			$('.carouselNews ul').carouFredSel({
				width: '100%',
				auto: true,
				circular: true,
				infinite : true,
				align : "left",
				items: {
					visible: 1,
					minimum: 1
				},
				scroll: {
					items: 1,
					duration:1000
				},
				prev		: ".news .prev",
				next		: ".news .next"
			});
			
			/* npo detail */
			$('.photoBox03 ul').carouFredSel({
				width: '1000px',
				auto: false,
				prev: '.photoBox03 .prev',
				next: '.photoBox03 .next',
				circular: true,
				infinite : true,
				align : "center",
				items: {
					visible: 1,
					minimum: 1
				},
				scroll: {
					fx:"crossfade"
				},
				pagination: {
					container: '.photoBox03 #pager03'
				}
				
			});
		}
		
		if ($().cycle) {
			/* TOP caurousel */
			$(window).bind("load", function() {
				$("#cycleSlider02").cycle({
					fx		: "fade",
					speed	: 600,
					timeout	: 0,
					allowPagerClickBubble: true, 
					pager	: "#cyclePager02",
					width:1000
				});
			});
		}
		
		$(".fixHeight").fixHeight();
		
		$(window).load(function(){
			$('.photoGroup ul').carouFredSel({
				auto: true,
				circular: false,
				infinite : true,
				align : "center",
				items: {

					visible: 4,
					minimum: 4
				},
				scroll: {
					fx        : "crossfade",
					items: 4,
					duration:600
				},
				pagination: {
					container: '#cyclePager'
				}
			});
		});

		// ==============================================================
		// フェードイン・フェードアウト
		// ==============================================================
		$(".fade").click(function() {
			
			var elm = $(this);
			
			// 次の要素が非表示だった場合は、.fadeに.activeを付与+次の要素をフェードイン
			if (elm.next().is(":hidden")) {
				elm.addClass("active")
					.next()
					.fadeIn();
				
			// 次の要素が表示されていた場合は、.fadeと.activeを削除+次の要素をフェードアウト
			} else {
				elm.removeClass("active")
					.next()
					.fadeOut();
			}
		});
		
		
		// ==============================================================
		// スライド式トグル
		// ==============================================================
		$(".slideToggle").click(function() {
			
			var elm = $(this);
			elm.next().slideToggle(100);
			
			//.slideTogleに.activeが無ければ、.activeを付与
			if (elm.hasClass("active")) {
				elm.removeClass("active");
			} else {
				elm.addClass("active");
			}
		});
		
		// ==============================================================
		// タブメニュー
		// ==============================================================
		$(".tab a").click(function() {
			
			var elm = $(this);
			
			elm.parent("li")
				.siblings()
				.removeClass("active");
			
			elm.parent("li").addClass("active");
			
			// コンテンツ本体である.tabContentsを一旦隠す
			elm.parents(".tab")
				.next()
				.children(".tabBox")
				.hide();
			
			// htmlにはメニューのa要素href属性に
			// 表示したいボックスのIDを記述する
			// 例） <a href="#tab1"> など
			$(this.hash).fadeIn();
			return false;
		});
		
		// ==============================================================
		// メインビジュアル制御 
		// ==============================================================
		
		$(function(){
			$('.slide_body').bxSlider({
				auto:true,
				pager:false,
				speed:500,
				pause:6000,
				slideWidth: 1200,
				minSlides: 3,
				maxSlides: 3,
				moveSlides: 1,
				slideMargin: 0,
				onSliderLoad:function(currentIndex){
					$('.slide').removeClass('active');
					$('.slide_body > li:nth-child(3n-1)').addClass('active');
				},
				onSlideBefore: function($slideElement, oldIndex, newIndex){
					var new_i = newIndex%3 - 1;
					var nth = (new_i < 0) ? '3n-1' : '3n'+new_i;
					$('.slide').removeClass('active');
					$('.slide_body > li:nth-child('+nth+')').addClass('active');
				}
			});
		});
		
		// ==============================================================
		// ライトボックス jquery.colorbox.js
		// ==============================================================
		if ($().colorbox) {
			// 画像をグループ化
			$("a.colorboxGroup").colorbox({
				rel			: "group",
				maxWidth	: "90%",
				maxHeight	: "90%"
			});
			
			// Ajaxで外部ファイル読み込み
			$("a.colorboxAjax").colorbox();
			
			// Youtubeの読み込み
			$("a.colorboxYoutube").colorbox({
				iframe		: true,
				innerWidth	: 560,
				innerHeight	: 315
			});
			
			// iframeで外部サイト読み込み
			$("a.colorboxIframe").colorbox({
				iframe	: true,
				width	:"80%",
				height	: "80%"
			});
			
			// インラインのHTML読み込み
			$("a.colorboxInline").colorbox({
				inline	: true,
				width:900
			});
			
			$('.popup .close').click(function(){
				$('#cboxClose').trigger('click');
				return false;
			})
		}
	});
})(jQuery);