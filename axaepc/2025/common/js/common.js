/*********************************************
 * common.js
 * -------------------------------------------
 * @namespace
 * - KNT_SOUGOU
 * @Util
 * @constructor
 * @module
 * - rollover
 * - tabletViewPort
 * - smoothScroll
 * - accordion
 * - popup
 * - hashTabs
 * - fadePageTop
 * - findRowLast
 * - linkAreaExpand
 * - fixedTable
  * - telLink
  * - sliderType01
 * @module(load)
 * - equalHeight
 * - figureFix
 * @requires
 * - jquery.js
*********************************************/

var KNT_SOUGOU = KNT_SOUGOU || {};

/* -------------------------------------------
 * @Util
 * @constructor
------------------------------------------- */
KNT_SOUGOU.Util = function(){
	this.ua = navigator.userAgent.toLowerCase();
	this.version = navigator.appVersion.toLowerCase();
	this.$w = $(window);
	this.$d = $(document);
	this.$h = $("html");
	this.$b = $("body");
};

KNT_SOUGOU.Util.prototype = {
	/*
	 * @method isMobile
	 * @return {Boolean} UAに["iphone","android, mobile"]が含まれるか
	 */
	isMobile: function(){
		var UA = {
			iPhone: this.ua.indexOf("iphone") != -1,
			AndroidMobile: this.ua.indexOf("android") != -1 && this.ua.indexOf("mobile") != -1,
		}
		return (UA.iPhone | UA.AndroidMobile) ? true : false;
	},
	/*
	 * @method isTablet
	 * @return {Boolean} UAに["ipad","android"]が含まれるか
	 */
	isTablet: function(){
		var UA = {
			iPad: this.ua.indexOf("ipad") != -1,
			Android: this.ua.indexOf("android") != -1 && this.ua.indexOf("mobile") == -1
		}
		return (UA.iPad | UA.Android) ? true : false;
	},
	/*
	 * @method isIE8
	 * @return {Boolean} UAに["MSIE","msie 9."]が含まれるか
	 */
	isIE8: function(){
		var UA = {
			OS: this.ua.indexOf("msie") != -1,
			VERSION: this.version.indexOf("msie 8.") != -1
		}
		return (UA.OS && UA.VERSION) ? true : false;
	},
	/*
	 * @method isFontSizeCheck
	 * @param {Function} callback
	 * フォントサイズが変更したら　callback　を実行
	 */
	isFontSizeCheck: function(callback){
		var HTML_FS_WATCH = $('<div id="fontSizeWatcher">&nbsp;</div>'),
			CSS_OBJECT = {
				display: "block",
				visibility: "hidden",
				position: "absolute",
				top: "0",
				padding: "0"
			},
			$elm,
			interval = 500,
			currentSize = 0;
		
		// 監視用HTMLを生成する
		HTML_FS_WATCH.css(CSS_OBJECT).appendTo("body");
		$elm = $("#fontSizeWatcher");
		
		// 要素の高さを取得
		var getSize = function($elm){ return $elm.height(); };
		
		// 要素の高さを比較して、異なればcallbackを実行
		var fontSizeCheck = function(){
			var h = getSize($elm);
			
			if(h === currentSize){
				return false;
			} else {
				currentSize = h;
				callback();
			}
		};
		setInterval(fontSizeCheck, interval);
	},
	/*
	 * @method isWindowSizeCheck
	 * @param {Function} callback
	 * windowのリサイズ処理が完了したら　callback　を実行
	 */
	isWindowSizeCheck: function(callback){
		var resize = false,
				interval = 500;
		
		this.$w.bind("resize", function(){
			// リサイズされている間は、何もしない
			if(resize !== false){ clearTimeout(resize); }
			
			resize = setTimeout(function(){
				callback();
			}, interval);
		});
	}
};

/* -------------------------------------------
 * @module
------------------------------------------- */
KNT_SOUGOU.module = function(){
	
	var u = new KNT_SOUGOU.Util();
	
	return {
		/**
		 * @method initialize
		 * 初期化
		 */
		initialize: function(){
			this.rollover();
			this.tabletViewPort();
			this.smoothScroll();
			//this.equalHeight(true);
			this.accordion();
			this.popup();
			this.hashTabs();
			this.fadePageTop();
			// this.figureFix();
			this.findRowLast();
			this.linkAreaExpand();
			this.sliderType01();
			this.sliderType02();
			if(u.isMobile()){
				this.fixedTable();
				this.telLink();
			}
		},
		/**
		 * @method rollover
		 */
		rollover: function(){
			var $elm = $(".rollover"),
					onSuffix = "on";
			
			if($elm.length === 0 || u.isMobile() || u.isTablet()){ return false; }
			
			var src = {
				over: function($elm){return $elm.attr("src").replace(/^(.+)(\.[a-z]+)$/, "$1" + onSuffix + "$2");},
				out: function($elm){return $elm.attr("src").replace(new RegExp("^(.+)" + onSuffix + "(\.[a-z]+)$" ), "$1$2");},
				preload: function($elm){return $elm.attr("src").replace(/^(.+)(\.[a-z]+)$/, "$1" + onSuffix + "$2");}
			};
			
			$elm.hover(
				function(){$(this).attr("src", src.over($(this)));},
				function(){$(this).attr("src", src.out($(this)));}
			).each(
				function(){$("<img>").attr("src", src.preload($(this)));}
			);
		},
		/**
		 * @method smartView
		 */
		tabletViewPort: function(){
			var viewPoint = 1190;
			if(u.isTablet()){
				$("body").css("width", viewPoint + "px");
				$("meta[name='viewport']").attr("content", "width=" + viewPoint + "px");
			}
		},
		/**
		 * @method smoothScroll
		 */
		smoothScroll: function(){
			var $elm = $('a[href^="#"]').not('a[href="#"], .no-scroll'),
					speed = 200,
					easing = "swing";
			
			$elm.click(function(){
				var href = $(this).attr("href"),
						target = $(href),
						$naviHeight = $("#headerFixed").outerHeight(),
						position = target.offset().top,	
						webkit = /webkit/;
				
				$("html, body").animate({
					scrollTop: position
				}, speed, easing);
				return false;
			});
		},
		/**
		 * @method equalHeight
		 * @param {Boolean} 文字可変に対応するかどうか
		 */
		equalHeight: function(fsCheck, wsCheck){
			var className = ".equalHeight",
				childBaseName = "equalChild",
				$elm = $(className),
				$children = $elm.children(),
				fsCheck = fsCheck || false,
				wsCheck = wsCheck || true;
			
			if($elm.length === 0 || $children.length < 2){ return false; }
			
			/* 各要素ごとにグループ化 */
			var grouping = function(){
				var $groupedChildren = $elm.find('*[class*=' + childBaseName + ']'),
					classNames = {},groups = [];
				
				$groupedChildren.each(function(){
					var splitClass = $(this).attr("class").split(" "),
						splitClassNum = splitClass.length,
						newClassName;
					
					for(var i = 0; i < splitClassNum; i++){
						newClassName = splitClass[i].match(RegExp(childBaseName + "[a-z0-9]+", 'i'));
						
						if(!newClassName){
							continue;
						} else {
							newClassName.toString();
							classNames[newClassName] = newClassName;
						}
					}
				});
				
				for(var c in classNames){
					groups.push($elm.find("." + c));
				}
				
				groups.push($children);
				return groups;
			};
			
			/* 各要素の高さを揃える */
			var equalHeight = function(elm){
				var maxHeight = 0;
				elm.css("height", "auto");
				
				elm.each(function(){
					if($(this).height() > maxHeight){
						maxHeight = $(this).height();
					}
				});
				return elm.height(maxHeight);
			};
			
			/* init */
			var init = function(){
				var groups = grouping(),
					h = [],
					child = [],
					maxHeight = 0,
					top = 0;
				
				$.each(groups, function(){
					var $group = $(this);
					
					$group.each(function(i){
						$(this).css("height", "auto");
						h[i] = $(this).height();
						
						if(top !== $(this).position().top){
							equalHeight($(child));
							child = [];
							top = $(this).position().top;
						}
						child.push(this);
					});
				});
				if(child.length > 1){ equalHeight($(child));}
			};
			
			// 文字可変への対応可否
			fsCheck ? u.isFontSizeCheck(init) : init();
			//wsCheck ? u.isWindowSizeCheck(init) : init();
		},
		/**
		 * @method popup
		 */
		popup: function(){
			var $elm = $(".popupType a"),
				name = "POPUP",
				height = 600,
				width = 1180,
				toolbar = 0,
				scrollbars = 1,
				status = 0,
				resizable = 1,
				left = 0,
				top = 0,
				parameters,
				center = true;
			
			if($elm.length === 0){ return false; }
			
			if(center){
				top = (screen.height - height) / 2;
				left = (screen.width - width) / 2;
			}
			
			parameters = "height=" + height + ",width=" + width + ",toolbar=" + toolbar + ",scrollbars=" + scrollbars + ",status=" + status + ",resizable=" + resizable + ",left=" + left + ",screenX=" + left + ",top=" + top + ",screenY=" + top;
			
			$elm.click(function(){
				window.open(this.href, name, parameters);
				return false;
			});
		},
		/**
		 * @method accordion
		 */
		accordion: function(config){	
			
			var $elm = $(".accordionBox");
			
			if ($elm.length === 0){ return false;}
	
			var c = $.extend({
				switchClass: ".switch",
				boxClass: ".detailsBox"
			}, config);
			
			$elm.each(function(){
			
				var box = $(c.boxClass, this),
						accordSwitch = $(c.switchClass, this);
				
				/* 開閉 */
				var accordion = function(){
					if (box.is(":hidden")){
						box.slideToggle(400);
						accordSwitch.toggleClass("open");
					} else {
						box.slideToggle(400);
						accordSwitch.toggleClass("open");
					}
				};
				
				$(accordSwitch).click(function(){
					accordion();
					KNT_SOUGOU.module.equalHeight();
				});
			
			});
		},
		/**
		 * @method hashTabs
		 */
		hashTabs: function(config){
			
			var c = $.extend({
				tabContentsName: ".hashTabs",
				tabClassName: ".hashTabList",
				boxClassName: ".hashTabDetail",
				defaultTabName: "#tab01"
			}, config);
			
			var $this = $(c.tabContentsName),
					list = $(c.tabClassName, $this),
					box = $(c.boxClassName, $this);
					
			if($this.length === 0){ return false; }
			
			$this.bind("change.tabs", function(e, tabName){
				list.find("li").removeClass("on");
				list.find("a[href = '"+ tabName +"']").parent().addClass("on");
				box.show();
				box.not(tabName).hide();
				
				if ($this.find(".hashTabs").length){
					
					var $tabs = $this.find(".hashTabs"),
							openClass = "on";
					
					$tabs.each(function(){
						
						var $list = $(".hashTabList", this),
								$box = $(".hashTabDetail", this);
						
						$box.hide();
						$box.eq(0).show();
						$("li", $list).removeClass(openClass);
						$list.each(function(){
							$("li", this).eq(0).addClass(openClass);
						});
						
					});
				}
				
			});
			
			$("a", list).click(function(){
				if (location.hash === $(this).attr("href")){
					return false;
				}
			});
			
			u.$w.bind("load hashchange", function(){
				var tabName = location.hash || c.defaultTabName;
				$this.trigger("change.tabs", tabName);
				KNT_SOUGOU.module.equalHeight();
			});

		},
		/**
		 * @method fadePageTop
		 */
		fadePageTop: function(){
			
			var $elm = $("#pageTop"),
					fadePoint = 300,
					timer = null;
			
			if($elm.length === 0){ return false; }
			
			u.$w.on("scroll",function() {
				clearTimeout(timer);
				timer = setTimeout(function() {
					if ($(this).scrollTop() > fadePoint) {
						$elm.fadeIn();
					} else {
						$elm.fadeOut();
					}
				}, 300);
			});
			
		},
		/**
		 * @plugin figureFix
		 */
		figureFix: function(){
			
			var $elm = $(".figureFix");
			
			if($elm.length === 0){ return false; }
			
			$elm.each(function() {
				var w = $("img", this).width();
				$(this).css("width", w);
			});
		},
		/**
		 * @plugin findRowLast
		 */
		findRowLast: function(config){
			
			var c = $.extend({
				targetName: ".findRowList",
				targetElmName: "li",
				rowsClass: "rowLast",
				fsCheck: false
			}, config);	
			
			if($(c.targetName).length === 0){ return false;	}
			
			var init = function(){	
				$(c.targetName).each(function() {
					var $target = $(c.targetElmName, this),
						len = $target.length,
						eOffset,
						gOffset;
					
					$target.removeClass(c.rowsClass);
					
					$target.eq(len-1).addClass(c.rowsClass);
					$target.each(function(){
						eOffset = parseInt($(this).offset().top);
						if(gOffset !== eOffset){
							$(this).prev().addClass(c.rowsClass);
							gOffset = eOffset;
						}
					});
				});
			};
			c.fsCheck ? u.isFontSizeCheck(init) : init();
		},
		/**
		 * @plugin linkAreaExpand
		 */
		linkAreaExpand: function(config){
			
			var c = $.extend({
				className: ".linkExpand",
				overClass: "on"
			}, config);
			
			if ($(c.className).length === 0){ return false;};
			
			$(c.className).filter(function(){
				return $("a",this).length > 0;
			}).each(function(){

				var href = $(this).find("a").attr("href"),
						target = $(this).find("a").attr("target");
				
				$(this).hover(function (){
					$(this).addClass(c.overClass);
				}, function(){
					$(this).removeClass(c.overClass);
				});
				
				$(this).click(function(){
					if(target){
						window.open(href, target,"null").focus();
						return false;
					} else {
						window.open(href, "_self");
					}
				});
	
			});
		},
		/**
		 * @method fixedTable
		 */
		fixedTable: function(){
			var $fixedTable = $(".fixedTable");
			
			if($fixedTable.length === 0){ return false; }
			
			$fixedTable.each(function(){
			
				var fixedTableHeight = $(this).outerHeight(),
						tableHeadWidth = $(this).find("th").outerWidth(),
						$cloneTable = $(this).clone().addClass("clone"),
						$spScroll = $(this).parents(".spScroll");
			
				$cloneTable.appendTo($spScroll).wrap('<div class="cloneWrap"></div>');
				$spScroll.css({"height": fixedTableHeight});
				$(".cloneWrap").css({"margin-left": tableHeadWidth + 1});
			
			});
			
		},
		/**
		 * @method telLink
		 */
		telLink: function(){
			var $telLink = $(".telLink");
			if($telLink.length === 0){ return false; }
			$telLink.each(function(){
				var tenNumber =$(this).attr("data-tel");
				$(this).wrap('<a href="tel:' + tenNumber +'" onclick="'+ "tmEvent('電話での問い合わせ');" +'"></a>');
			});
		},
		/**
		 * @method sliderType01
		 */
		sliderType01: function(){
			$sliderList = $(".sliderColumn01 .boxLink02");
			var option = {
				slideWidth: 500,
				slideMargin: 50,
				minSlides: 1,
				maxSlides: 2,
				moveSlides: 1,
				pager: false,
				controls:true
			};
			$sliderList.each(function(){
				if ($(this).find(".column").length == 1){
					$(this).addClass("oneType");
				} else {
					if (u.isMobile()){
						$(this).bxSlider({
							pager: false
						});
					} else {
						if ($(this).find(".column").length <= 2){
							option.controls = false;
						}
						$(this).bxSlider(option);
					}
				}
			});
		},
		/**
		 * @method sliderType02
		 */
		sliderType02: function(){
			$sliderList = $(".sliderColumn01 .typeB");
			$sliderList.each(function(){
				if ($(this).find(".boxLink01").length == 1){
					$(this).addClass("oneType");
				} else {
					if (u.isMobile()){
						$(this).bxSlider({
							pager: false
						});
					} else {
						$(this).bxSlider({
							slideWidth: 1150,
							slideMargin: 0,
							minSlides: 1,
							maxSlides: 2,
							moveSlides: 1,
							pager: false
						});
					}
				}
			});
		}
	};
}();

$(function(){
	var u = new KNT_SOUGOU.Util();

	KNT_SOUGOU.module.initialize();
	
	if (u.isIE8()){
		// IE8 png対応
		$("img, input").each(function() {
			if($(this).attr("src").indexOf(".png") != -1) {
				$(this).css({
					"filter": 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' + $(this).attr('src') + '", sizingMethod="scale");'
				});
			}
		});
	}

	$(window).scroll(function(){
		// #navigation
		if($(window).width() > 720){
			if($(this).scrollTop() > 280){
				$("#header").not(".noFix").addClass("fixed");
				$(".contents").addClass("fixed");
			} else {
				$("#header").removeClass("fixed");
				$(".contents").removeClass("fixed");
			}
		} else {
			if($(this).scrollTop() > 280){
				$("#header").addClass("fixed");
			} else {
				$("#header").removeClass("fixed");
			}
		}
	});

});

$(window).load(function(){
	var u = new KNT_SOUGOU.Util();

	KNT_SOUGOU.module.equalHeight(true);
	KNT_SOUGOU.module.figureFix();

});

$(function () {
	//SP用のナビ
	var $win = $(window);
	var $spHeader = $("#spHeader");
	var $spHdOverlay = $spHeader.find(".spHeaderOverlay");
	var $sideBtn = $("#spSideNav .sideNav .openButton");
	var $spSideNav = $("#spSideNav");
	var $sideNavScr = $spSideNav.find(".sideNavScr");
	var $spSideOverlay = $spSideNav.find(".spSideOverlay");
	
	$("#spHeader .navBtn").click(function(){
		if($spHeader.hasClass("jsOpen")) {
			$spHeader.removeClass("jsOpen");
			$sideBtn.removeClass("jsBtnHide");
		}else {
			$spHeader.addClass("jsOpen");
			$sideBtn.addClass("jsBtnHide");
		}
	});
	$spHdOverlay.click(function() {
		$spHeader.removeClass("jsOpen");
		$sideBtn.removeClass("jsBtnHide");
	});
	
	$sideBtn.click(function() {
		if($spSideNav.hasClass("jsOpen")) {
			$spSideNav.removeClass("jsOpen");
		}else {
			$spSideNav.addClass("jsOpen");
		}
	});
	$spSideOverlay.click(function() {
		$spSideNav.removeClass("jsOpen");
	});
	
	$win.resize(function() {
		$sideNavScr.css("height", "auto");
		if($win.height() < $sideNavScr.height() + 40) {
			$sideNavScr.height($win.height() - 40);
		}
	}).trigger("resize");
	
	
	//メガメニュー
	$("#globalNavi li").each(function() {
		var $this = $(this);
		if($this.find(".megaMenu").length) {
			$this.addClass("jsHasChild");
			$this.find("> a > span");
				/*.addClass("jsNavTxt")
				.append('<span class="bar">&nbsp;</span>')
				.append('<span class="arw">&nbsp;</span>');*/
		}
	});
	
	var $navs = $("#globalNavi .jsHasChild");
	$navs.each(function() {
		var $this = $(this);
		var $mega = $this.find(".megaMenu");
		var $bar = $this.find(".bar");
		var $arw = $this.find(".arw");
		var $fadeObj = $mega.add($bar).add($arw);
		$this.hover(function() {
			$mega.css({
				"display": "block",
				"z-index": 11
			});
			$fadeObj.stop().animate({
				opacity: 1
			}, 200, "linear");
		}, function() {
			$mega.css({
				"z-index": 10
			});
			$fadeObj.stop().animate({
				opacity: 0
			}, 200, "linear", function() {
				$mega.css({
					"display": "none"
				});
			});
		});
	});
});