;(function ($) {
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction("frontend/element_ready/TimerWidget.default", function (scope, $) {
            var clockElement = $(scope).find(".clock");
            var displayType = clockElement.data('display-type');
            var clockFormat = clockElement.data('clock-format');
            if ('clock' == displayType) {
                clockFace = '12' == clockFormat ? 'TwelveHourClock' : 'TwentyFourHourClock';
                clockElement.FlipClock({
                    clockFace: clockFace
                });
            }else if('timerc' == displayType){
                var now = new Date();
                var targetTime = clockElement.data('target-time');
                var targetDataObject = new Date(targetTime);
                var difference = (targetDataObject.getTime()-now.getTime())/1000;
                clockFace = 'HourlyCounter';
                if(difference >24*60*60){
                    clockFace='DailyCounter';
                }
                var clock = clockElement.FlipClock({
                    clockFace: clockFace,
                });
                clock.setTime(difference);
                clock.setCountdown(true);
            }else if('genericc' == displayType){
                clockFace = 'Counter';
                var countdownValue = clockElement.data('countdown');
                var decrement = clockElement.data('decrement');
                var clock = clockElement.FlipClock(countdownValue,{
                    clockFace: clockFace,
                });
                setInterval(function(){
                    clock.decrement();
                },decrement)
            }
        });
    })
})(jQuery);

