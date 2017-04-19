(function() {
    var Swiper = require('swiper');

    var animationControl = require('./animate_control');
    var btnEvent = require('./btn_control');

    var $upArrow = $('#upArrow');

    var bgMusic = $('audio')[0];

    var pageRender = function() {
        $('#loadingArea').fadeOut('slow', function() {
            $('#swiper').removeClass('u-hidden');
            $upArrow.removeClass('u-hidden');

            initSwiper();

            btnEvent.init();
        });
    };

    var initSwiper = function() {

        // 初始化轮播
        new Swiper('.swiper-container', {
            mousewheelControl: true, // 是否开启鼠标控制Swiper切换 （用于调试）
            direction: 'vertical', // 垂直方向
            lazyLoading: true,
            lazyLoadingInPrevNext: true,
            speed: 400, // 轮播切换速度
            fade: {
                crossFade: false // 关闭淡出效果
            },
            effect: 'coverflow', // 类似3D界面切换
            coverflow: { // coverflow效果参数
                rotate: 100,
                stretch: 0,
                depth: 300,
                modifier: 1,
                slideShadows: false // 关闭slides阴影
            },

            // flip: { // 3D翻转参数
            //     slideShadows: false // 关闭slides阴影
            // },

            onInit: function(swiper) { // 初始化回调
                animationControl.initAnimationItems(); // 初始化动画操作
                animationControl.playAnimation(swiper); // 播放首屏动画
            },
            onTransitionStart: function(swiper) {
                if (swiper.activeIndex === swiper.slides.length - 1) { // 轮播到最后一页 隐藏向上箭头
                    $upArrow.hide();

                    $('#p5_bg').addClass('swiper-no-swiping');

                } else {
                    $upArrow.show();
                }
            },
            onTransitionEnd: function(swiper) {
                animationControl.playAnimation(swiper); // 播放当前页的动画

            },
            onTouchStart: function(swiper) {

            }
        });
    };

    module.exports = {
        pageRender: pageRender
    };
}());
