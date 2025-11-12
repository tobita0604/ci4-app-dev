/*
Template Name: Velzon - Admin & Dashboard Template (Minimized)
Author: Themesbrand (Modified for CI4-App-Dev)
Version: 4.3.0-minimal
Website: https://github.com/tobita0604/ci4-app-dev
Contact: GitHub Issues
File: Minimal App JS File (jQuery-free, Bootstrap JS-free)
Description: Alpine.jsで代替した最小限のVelzon JS機能のみを含む
*/

(function () {
    "use strict";

    /**
     * グローバル変数
     */
    var navbarMenuHTML = document.querySelector(".navbar-menu") ? document.querySelector(".navbar-menu").innerHTML : "";
    var default_lang = "ja"; // デフォルト言語を日本語に設定
    var language = localStorage.getItem("language");

    /**
     * 言語設定の初期化
     */
    function initLanguage() {
        // デフォルト言語の設定
        (language === null) ? setLanguage(default_lang) : setLanguage(language);
        
        // 言語切替ボタンのイベントリスナー
        var languages = document.getElementsByClassName("language");
        if (languages) {
            Array.from(languages).forEach(function (dropdown) {
                dropdown.addEventListener("click", function (event) {
                    setLanguage(dropdown.getAttribute("data-lang"));
                });
            });
        }
    }

    /**
     * 言語の設定
     */
    function setLanguage(lang) {
        if (document.getElementById("header-lang-img")) {
            var flagImages = {
                "en": "assets/images/flags/us.svg",
                "ja": "assets/images/flags/japan.svg",
                "sp": "assets/images/flags/spain.svg",
                "gr": "assets/images/flags/germany.svg",
                "it": "assets/images/flags/italy.svg",
                "ru": "assets/images/flags/russia.svg",
                "ch": "assets/images/flags/china.svg",
                "fr": "assets/images/flags/french.svg",
                "ar": "assets/images/flags/ae.svg"
            };
            
            if (flagImages[lang]) {
                document.getElementById("header-lang-img").src = flagImages[lang];
            }
            
            localStorage.setItem("language", lang);
            language = localStorage.getItem("language");
            getLanguage();
        }
    }

    /**
     * 多言語対応 - JSON読み込み
     */
    function getLanguage() {
        language == null ? setLanguage(default_lang) : false;
        
        var request = new XMLHttpRequest();
        request.open("GET", "assets/lang/" + language + ".json");
        
        request.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                var data = JSON.parse(this.responseText);
                Object.keys(data).forEach(function (key) {
                    var elements = document.querySelectorAll("[data-key='" + key + "']");
                    Array.from(elements).forEach(function (elem) {
                        elem.textContent = data[key];
                    });
                });
            }
        };
        
        request.send();
    }

    /**
     * フルスクリーン切り替え
     */
    function initFullScreen() {
        var fullscreenBtn = document.querySelector('[data-toggle="fullscreen"]');
        if (fullscreenBtn) {
            fullscreenBtn.addEventListener("click", function (e) {
                e.preventDefault();
                document.body.classList.toggle("fullscreen-enable");
                
                if (!document.fullscreenElement && !document.mozFullScreenElement && 
                    !document.webkitFullscreenElement) {
                    if (document.documentElement.requestFullscreen) {
                        document.documentElement.requestFullscreen();
                    } else if (document.documentElement.mozRequestFullScreen) {
                        document.documentElement.mozRequestFullScreen();
                    } else if (document.documentElement.webkitRequestFullscreen) {
                        document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                    }
                } else {
                    if (document.cancelFullScreen) {
                        document.cancelFullScreen();
                    } else if (document.mozCancelFullScreen) {
                        document.mozCancelFullScreen();
                    } else if (document.webkitCancelFullScreen) {
                        document.webkitCancelFullScreen();
                    }
                }
            });
        }
        
        // ESCキーでフルスクリーン解除時の処理
        document.addEventListener('fullscreenchange', exitHandler);
        document.addEventListener('webkitfullscreenchange', exitHandler);
        document.addEventListener('mozfullscreenchange', exitHandler);
        
        function exitHandler() {
            if (!document.webkitIsFullScreen && !document.mozFullScreen && 
                !document.msFullscreenElement) {
                document.body.classList.remove("fullscreen-enable");
            }
        }
    }

    /**
     * ダークモード切り替え
     */
    function initModeSetting() {
        var html = document.getElementsByTagName("HTML")[0];
        var lightDarkBtn = document.querySelectorAll(".light-dark-mode");
        
        if (lightDarkBtn && lightDarkBtn.length) {
            lightDarkBtn.forEach(function(btn) {
                btn.addEventListener("click", function (event) {
                    var currentTheme = html.getAttribute("data-bs-theme");
                    var newTheme = currentTheme === "dark" ? "light" : "dark";
                    
                    html.setAttribute("data-bs-theme", newTheme);
                    localStorage.setItem("data-bs-theme", newTheme);
                    
                    // ウィンドウリサイズイベントを発火（チャート等の再描画用）
                    window.dispatchEvent(new Event('resize'));
                });
            });
        }
        
        // 保存されたテーマを復元
        var savedTheme = localStorage.getItem("data-bs-theme");
        if (savedTheme) {
            html.setAttribute("data-bs-theme", savedTheme);
        }
    }

    /**
     * レイアウト設定のリセット
     */
    function resetLayout() {
        var resetBtn = document.getElementById("reset-layout");
        if (resetBtn) {
            resetBtn.addEventListener("click", function () {
                sessionStorage.clear();
                window.location.reload();
            });
        }
    }

    /**
     * Feather Iconsの初期化
     */
    function initFeatherIcons() {
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    }

    /**
     * Simplebarの初期化（カスタムスクロールバー）
     */
    function initSimplebar() {
        var simplebarElements = document.querySelectorAll('[data-simplebar]');
        if (simplebarElements && simplebarElements.length > 0) {
            Array.from(simplebarElements).forEach(function (element) {
                if (!element.SimpleBar) {
                    new SimpleBar(element);
                }
            });
        }
    }

    /**
     * カウンターアニメーション
     */
    function counter() {
        var counterElements = document.querySelectorAll(".counter-value");
        
        counterElements.forEach(function (element) {
            var target = parseInt(element.getAttribute("data-target"));
            var duration = 2000; // 2秒
            var step = target / (duration / 16); // 60fps
            var current = 0;
            
            var timer = setInterval(function () {
                current += step;
                if (current >= target) {
                    element.textContent = target;
                    clearInterval(timer);
                } else {
                    element.textContent = Math.ceil(current);
                }
            }, 16);
        });
    }

    /**
     * 初期化関数
     */
    function init() {
        initLanguage();
        initFullScreen();
        initModeSetting();
        resetLayout();
        initFeatherIcons();
        initSimplebar();
        counter();
    }

    /**
     * DOMContentLoaded後に初期化実行
     */
    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", init);
    } else {
        init();
    }

    /**
     * ウィンドウリサイズ時の処理
     */
    var resizeTimer;
    window.addEventListener("resize", function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function () {
            // リサイズ処理（必要に応じて追加）
        }, 250);
    });

})();
