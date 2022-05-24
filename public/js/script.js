$(document).ready(function () {
    $(document).on("keydown", disableF5);
    var elem = document.body; // Make the body go full screen.
    requestFullScreen(elem);
    count_down_timer(timer)
});




function forceFullScreen() {
    document.documentElement.requestFullscreen()
}

function disableF5(e) {
    if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault();
};

function requestFullScreen(element) {
    // Supports most browsers and their versions.
    var requestMethod = element.requestFullScreen || element.webkitRequestFullScreen || element.mozRequestFullScreen || element.msRequestFullScreen;

    if (requestMethod) { // Native full screen.
        requestMethod.call(element);
    } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
        var wscript = new ActiveXObject("WScript.Shell");
        if (wscript !== null) {
            wscript.SendKeys("{F11}");
        }
    }
}

function count_down_timer(baseTime) {
    var baseTime = new Date(baseTime)
    console.log("Base Time: " + baseTime)
    var baseTimeSecond = baseTime.getTime()
    var addSecond = 60 * 60 * 2000; // Duration
    //var addSecond = 60 * 60 * 500; // Duration

    var newBaseTime = new Date(baseTimeSecond + addSecond);
    console.log("End Time: " + newBaseTime)

    // Time calculations for days, hours, minutes and seconds
    var interVal = setInterval(function () {
        var now = new Date().getTime();
        var distance = newBaseTime.getTime() - now;
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        console.log(hours + "h " + minutes + "m " + seconds + "s ")
        $('.count-down').text(hours + "h " + minutes + "m " + seconds + "s ")
        /* document.getElementsByClassName("count-down").innerHTML = hours + "h " +
            minutes + "m " + seconds + "s "; */

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(interVal);
            $('.count-down').text('EXPIRED')
            //document.getElementsByClassName("count-down").innerHTML = "EXPIRED";
            SubmitFunction()
        }
    }, 1000);

}

function SubmitFunction() {
    //submitted.innerHTML = "Time is up!";
    document.getElementById('form-wizard1').submit();

}
/* var div = document.getElementById('display');
var submitted = document.getElementById('submitted');

function CountDown(duration, display) {

    var timer = duration,
        minutes, seconds;

    var interVal = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        display.innerHTML = "<b>" + minutes + "m : " + seconds + "s" + "</b>";
        if (timer > 0) {
            --timer;
        } else {
            clearInterval(interVal)
            SubmitFunction();
        }

    }, 1000);

}

function SubmitFunction() {
    //submitted.innerHTML = "Time is up!";
    document.getElementById('form-wizard1').submit();

}
CountDown(5, div); */