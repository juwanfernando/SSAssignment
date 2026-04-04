window.onload = function() {
    var dateChange = [];
    var input = document.getElementsByClassName('dateChange');
    for (var i = 0; i < input.length; i++) {
        input[i].onpaste = function (e) {
            e.preventDefault();
        }
    }
}
$(document).ready(function () {
    $("#detail").fadeIn(3200);
});