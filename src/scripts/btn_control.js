(function() {
    var $ = require('jquery');

    var soundAnimation = require('./animate_sound');
    var init = require('./start_app');

    module.exports = {
        timer: null,
        localId:'',
        init:function() {
            this.play();
            this.record();
            this.reRecord();
            this.submit();

            this.rule();
            this.closeRule();

            var that = this;
            wx.onVoiceRecordEnd({
                // 录音时间超过一分钟没有停止的时候会执行 complete 回调
                complete: function (res) {
                    that.localId = res.localId;
                    alert(that.localId);
                }
            });

            wx.onVoicePlayEnd({
                success: function (res) {
                    soundAnimation.clear(5);
                }
            });
        },
        play: function() {
            $('#playBtn').on('touchstart', function () {
                if($(this).hasClass('no-click')) {
                    return;
                }
                console.log('play');
                soundAnimation.sound(5);
                soundAnimation.bubble(5);

                var that = this;
                alert(that.localId);
                wx.playVoice({
                    localId: that.localId // 需要播放的音频的本地ID，由stopRecord接口获得
                });
            });
        },
        record: function () {
            $('#recordBtn').on('touchstart', function () {
                soundAnimation.sound(5);
                soundAnimation.bubble(5);

                wx.startRecord();

            }).on('touchend', function () {

                var that = this;
                wx.stopRecord({
                    success: function (res) {
                        that.localId = res.localId;
                        alert(that.localId);
                        soundAnimation.clear(5);
                        that.reRecordIn();
                    }
                });
            }.bind(this));
        },
        reRecord: function() {
            $('#reRecordBtn').click(function() {
                if($(this).hasClass('no-click')) {
                    return;
                }
                console.log('reRecord');
                soundAnimation.clear(5);

                this.reRecordOut();
            }.bind(this));

        },
        submit: function () {
            $('#submitBtn').click(function() {
                alert('提交成功!');

                location.href = 'preview.html';
            });
        },
        rule: function () {
            var timer;

            $('#tip').click(function() {
               $('#rule').removeClass('u-hidden');

                setTimeout(function () {
                    $('#rule').addClass('rule-in');
                }, 0);

                $('#upArrow').addClass('u-hidden');
            });
        },
        closeRule: function () {
            $('#closeBtn').click(function() {
                $('#rule')
                    .removeClass('rule-in')
                    .addClass('rule-out');

                $('#upArrow')
                    .removeClass('u-hidden');

                setTimeout(function() {
                    $('#rule')
                        .addClass('u-hidden')
                        .removeClass('rule-out');
                }, 350);
            });
        },
        reRecordIn: function () {
            $('#playBtn').removeClass('no-click').css('background-image','url("imgs/p5-btn1.png")');
            $('#reRecordBtn').removeClass('no-click').css('background-image','url("imgs/p5-btn2.png")');
        },
        reRecordOut: function () {
            $('#playBtn').addClass('no-click').css('background-image','url("imgs/p5-btn1-no.png")');
            $('#reRecordBtn').addClass('no-click').css('background-image','url("imgs/p5-btn2-no.png")');
        },
    };
}());
