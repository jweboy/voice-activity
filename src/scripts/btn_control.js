(function() {
    var $ = require('jquery');

    var soundAnimation = require('./animate_sound');
    var init = require('./start_app');

    module.exports = {
        timer: null,
        init:function() {
            this.play();
            this.record();
            this.reRecord();
            this.submit();

            this.rule();
            this.closeRule();
        },
        play: function() {
            $('#playBtn').click(function () {
                if($(this).hasClass('no-click')) {
                    return;
                }
                console.log('play');
                soundAnimation.sound(5);
                soundAnimation.bubble(5);

                setTimeout(function () {
                    soundAnimation.clear(5);
                }, 3000);
            });
        },
        record: function () {
            $('#recordBtn').on('touchstart', function () {
                soundAnimation.sound(5);
                soundAnimation.bubble(5);

            }).on('touchend', function () {
                soundAnimation.clear(5);

                this.reRecordIn();

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
            $('#playBtn').removeClass('no-click').css('background-image','url("../imgs/p5-btn1.png")');
            $('#reRecordBtn').removeClass('no-click').css('background-image','url("../imgs/p5-btn2.png")');
        },
        reRecordOut: function () {
            $('#playBtn').addClass('no-click').css('background-image','url("../imgs/p5-btn1-no.png")');
            $('#reRecordBtn').addClass('no-click').css('background-image','url("../imgs/p5-btn2-no.png")');
        },
    };
}());
