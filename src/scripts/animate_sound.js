(function() {
    var $ = require('jquery');

    module.exports = {
        clear: function () {
            $('#p5_soundWave').addClass('u-hidden');
            $('#p5_bubble').addClass('u-hidden');

            //this.hasAnimated();
        },
        sound: function () {
            $('#p5_soundWave').removeClass('u-hidden');

            //this.isAnimated();
        },
        bubble: function () {
           $('#p5_bubble').removeClass('u-hidden');

          // this.isAnimated();
        },
        isAnimated: function () {
            $('#playBtn').addClass('no-click');
            $('#recordBtn').addClass('no-click');
        },
        hasAnimated: function () {
            $('#playBtn').removeClass('no-click');
            $('#recordBtn').removeClass('no-click');
        }
    };

}());
