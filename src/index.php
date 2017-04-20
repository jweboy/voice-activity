<?php
Session_start();
require_once "../../wechat.class.php";
$options = array(
        'appid'=>'wx07b7c39a1c20e528', //填写高级调用功能的app id, 请在微信开发模式后台查询
        'appsecret'=>'9bbe25ea21403b8738e4051ca3e26a1b', //填写高级调用功能的密钥
);

$we_obj = new Wechat($options);
$js_ticket = $we_obj->getJsTicket();
if (!$js_ticket) {
}
$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$signPackage = $we_obj->getJsSign($url);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Voice-Activity</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="apple-touch-fullscreen" content="YES">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="renderer" content="webkit">
    <link rel="shortcut icon" type="image/png" href="imgs/favicon.jpg">
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"> </script>
    <script>
        (function() {
            // 根据不同设备设置缩放比例
            var phoneWidth = parseInt(window.screen.width),
                phoneScale = phoneWidth / 640,
                ua = navigator.userAgent,
                version = parseFloat(RegExp.$1);

            var meta = document.createElement('meta');
            meta.setAttribute('name', 'viewport');

            if (/Android (\d+\.\d+)/.test(ua)) {
                // andriod 2.3
                if (version > 2.3) {
                    meta.setAttribute('content', 'width=640, minimum-scale = ' + phoneScale + ', maximum-scale = ' + phoneScale + ', user-scalable=no');
                    // andriod 2.3以上
                } else {
                    meta.setAttribute('content', 'width=640, user-scalable=no');
                }
                // 其他系统
            } else {
                meta.setAttribute('content', 'width=640,user-scalable=no');
            }

            document.documentElement.firstElementChild.appendChild(meta);


            wx.config({
                debug: false,
                appId: '<?php echo $signPackage["appid"] ?>',
                timestamp: <?php echo $signPackage["timestamp"] ?>,
                nonceStr: '<?php echo $signPackage["noncestr"] ?>',
                signature: '<?php echo $signPackage["signature"] ?>',
                jsApiList: [
                    'checkJsApi',
                    'onMenuShareTimeline',
                    'onMenuShareAppMessage',
                    'startRecord',
                    'stopRecord',
                    'onVoiceRecordEnd',
                    'playVoice',
                    'pauseVoice',
                    'stopVoice',
                    'onVoicePlayEnd',
                    'uploadVoice',
                    'downloadVoice'
                ]
            });

            window.wxTitle = '测试标题';
            window.wxDesc = '测试备注';

            wx.error(function(res){
                console.log("error:"+JSON.stringify(res));
            });

            wx.ready(function () {
                setTimeout(wxShare, 500);
            });

        }());

        function wxShare(){
            wx.onMenuShareTimeline({
                title: window.wxTitle,
                link: 'http://ext.zeego.cn/voiceRecordGame/1231412312/index.php',
                imgUrl: 'http://ext.zeego.cn/voiceRecordGame/1231412312/imgs/favicon.jpg',
                trigger: function (res) {

                },
                success: function (res) {

                },
                cancel: function (res) {

                },
                fail: function (res) {
                    //alert(JSON.stringify(res));
                }
            });

            wx.onMenuShareAppMessage({
                title: window.wxTitle, // 分享标题
                desc: window.wxDesc, // 分享描述
                link: 'http://ext.zeego.cn/voiceRecordGame/1231412312/index.php',
                imgUrl: 'http://ext.zeego.cn/voiceRecordGame/1231412312/imgs/favicon.jpg',
                type: 'link', // 分享类型,music、video或link，不填默认为link
                dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                success: function () {

                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                },
                fail: function (res) {
                    //alert(JSON.stringify(res));
                }
            });
        }
    </script>
    <!-- 开发环境插入合并打包的css,以下两个注释需要保留 -->
    <link rel="stylesheet" href="styles/bundle.css">
</head>
<body>
    <!-- loading动画模块 -->
    <div id="loadingArea">
        <div class="cube">
            <div class="plane-1">
                <div class="top-left">
                </div>
                <div class="top-middle">
                </div>
                <div class="top-right">
                </div>
                <div class="middle-left">
                </div>
                <div class="middle-middle">
                </div>
                <div class="middle-right">
                </div>
                <div class="bottom-left">
                </div>
                <div class="bottom-middle">
                </div>
                <div class="bottom-right">
                </div>
            </div>
            <div class="plane-2">
                <div class="top-left">
                </div>
                <div class="top-middle">
                </div>
                <div class="top-right">
                </div>
                <div class="middle-left">
                </div>
                <div class="middle-middle">
                </div>
                <div class="middle-right">
                </div>
                <div class="bottom-left">
                </div>
                <div class="bottom-middle">
                </div>
                <div class="bottom-right">
                </div>
            </div>
            <div class="plane-3">
                <div class="top-left">
                </div>
                <div class="top-middle">
                </div>
                <div class="top-right">
                </div>
                <div class="middle-left">
                </div>
                <div class="middle-middle">
                </div>
                <div class="middle-right">
                </div>
                <div class="bottom-left">
                </div>
                <div class="bottom-middle">
                </div>
                <div class="bottom-right">
                </div>
            </div>
        </div>
        <div class="loadingText" id="loadingText">
            0%
        </div>
    </div>
    <!-- /loading动画模块 -->
    <!-- swiper轮播模块 -->
    <div class="swiper-container u-hidden" id="swiper">
        <div class="swiper-wrapper">
             <div class="swiper-slide p1-bg">
                <div class="main1">
                    <img class="text1 slide-element animated swiper-lazy" data-ani-name="fadeInUp" data-ani-duration="1.5s" data-ani-delay="0s" data-src="imgs/p1-text1.png" alt="示意图">
                    <img class="text2 slide-element animated swiper-lazy" data-ani-name="fadeInUp" data-ani-duration="1.5s" data-ani-delay="1.5s" data-src="imgs/p1-text2.png" alt="示意图">
                </div>
            </div>
            <div class="swiper-slide p2-bg">
                <div class="main1">
                    <img class="text1 slide-element animated swiper-lazy" data-ani-name="fadeInUp" data-ani-duration="1.5s" data-ani-delay="0s" data-src="imgs/p2-text1.png" alt="示意图">
                    <img class="text2 u-mgt20 slide-element animated swiper-lazy" data-ani-name="fadeInUp" data-ani-duration="1.5s" data-ani-delay="1.5s" data-src="imgs/p2-text2.png" alt="示意图">
                </div>
            </div>
            <div class="swiper-slide p3-bg">
                <div class="main1">
                    <img class="text1 slide-element animated swiper-lazy" data-ani-name="fadeInUp" data-ani-duration="1.5s" data-ani-delay="0s" data-src="imgs/p3-text1.png" alt="示意图">
                    <img class="text2 slide-element animated swiper-lazy" data-ani-name="fadeInUp" data-ani-duration="1.5s" data-ani-delay="1.5s" data-src="imgs/p3-text2.png" alt="示意图">
                </div>
            </div>
            <div class="swiper-slide p4-bg">
                <div class="main2">
                    <img class="text1 slide-element animated swiper-lazy" data-ani-name="fadeInUp" data-ani-duration="1.5s" data-ani-delay="0s" data-src="imgs/p4-text1.png" alt="示意图">
                    <img class="text2 slide-element animated swiper-lazy" data-ani-name="fadeInUp" data-ani-duration="1.5s" data-ani-delay="1.5s" data-src="imgs/p4-text2.png" alt="示意图">
                    <img class="text3 slide-element animated swiper-lazy" data-ani-name="fadeInUp" data-ani-duration="1.5s" data-ani-delay="3s" data-src="imgs/p4-text3.png" alt="示意图">
                </div>
            </div>
            <div class="swiper-slide p5-bg" id="p5_bg">
                <div class="tip slide-element animated swiper-lazy" ani-name="fadeInDown" data-ani-duration="1s" data-ani-delay="0s" id="tip"></div>
                <div class="main2">
                    <div class="text1 slide-element animated swiper-lazy" data-ani-name="fadeInUp" data-ani-duration="1.5s" data-ani-delay="1s"></div>
                    <div class="text2 slide-element animated swiper-lazy" data-ani-name="fadeInUp" data-ani-duration="1.5s" data-ani-delay="2.5s"></div>
                </div>
                 <div class="aside">
                    <div class="btn play-btn slide-element animated swiper-lazy no-click" data-ani-name="bounceIn" data-ani-duration="1s" data-ani-delay="5.5s" id="playBtn"></div>
                    <div class="btn reRecord-btn slide-element animated swiper-lazy no-click" data-ani-name="bounceIn" data-ani-duration="1s" data-ani-delay="6.5s" id="reRecordBtn"></div>
                    <div class="btn submit-btn slide-element animated swiper-lazy" data-ani-name="bounceIn" data-ani-duration="1s" data-ani-delay="7.5s" id="submitBtn"></div>
                </div>
                <div class="bottle slide-element animated swiper-lazy" data-ani-name="zoomIn" data-ani-duration="1s" data-ani-delay="4s" id="recordBtn"></div>
                <div class="sound slide-element animated infinite swiper-lazy u-hidden" data-ani-name="pulse" data-ani-duration="1s" data-ani-delay="0s" id="p5_soundWave"></div>
                <div class="bubble slide-element animated infinite swiper-lazy u-hidden" data-ani-name="fadeInUp" data-ani-duration="3.5s" data-ani-delay="0s" id="p5_bubble"></div>
               <div class="rule u-hidden" id="rule">
                    <img src="imgs/close.png" class="close" id="closeBtn" alt="关闭按钮">
                    <img class="slide-element animated swiper-lazy" data-src="imgs/rules.jpg" alt="规则">
                </div>
            </div>
        </div>
    </div>
    <!-- /swiper轮播模块 -->
    <!-- 轮播页向上小图标模块 -->
    <button class="up-arrow u-hidden" id="upArrow">
        <i class="iconfont icon-arrow"></i>
    </button>
    <!-- /轮播页向上小图标模块 -->
    <!-- 开发环境插入合并打包的js,以下两个注释需要保留 -->
    <script src="scripts/bundle.js"></script>
</body>
</html>
