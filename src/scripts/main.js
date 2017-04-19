(function() {
    var $ = require('jquery');
    var FastClick = require('fastclick');
    var swiper = require('swiper');

    var preLoadBgImg = require('./preload_bgImg');

    $(function() {

        // 解决移动端点击300ms延迟问题
        // FastClick.attach(document.body);

        // 加载页面资源
        preLoadBgImg.loadImage();


        console.log(FastClick);
    });
})();
