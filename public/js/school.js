var countDownDate = new Date("june 16, 2022 23:59:59").getTime();
var x = setInterval(function() {

    var now = new Date().getTime();

    var distance = countDownDate - now;

    var newYear = "Okulların kapanmasına "
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    var kaldi = "Kaldı"

    document.getElementById("demo").innerHTML = newYear + days + " gün " + hours + " saat "
        + minutes + " dakika " + seconds + " saniye " + kaldi;

    if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
    }
}, 1000);

