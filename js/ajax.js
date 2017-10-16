// Captcha validation 
$(document).ready(function() {
    $("#code").blur(function() {
        document.getElementById("code").className = "thinking";
        var code = document.getElementById("code").value;
        $.post("helpers/ajax.php", {
                day: code
            },
            function(status) {
                if (status === "okay") {
                    document.getElementById("code").className = "approved";
                    document.getElementById("send").disabled = false;
                } else {
                    document.getElementById("code").className = "denied";
                    document.getElementById("send").disabled = true;
                }
            });
    });
});