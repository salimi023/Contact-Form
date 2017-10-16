$(window).on("load", function() {
    var id = document.getElementById("msg_id").getAttribute("data-value");
    $.ajax({
        type: "POST",
        url: "../helpers/res_ajax.php",
        data: { stat: '1', msg_id: id },
        datatype: "html",
        success: function(result) {
            if (result === 'okay') {
                document.getElementById("respond").disabled = false;
            } else {
                document.getElementById("respond").disabled = true;
            }
        }
    })
});