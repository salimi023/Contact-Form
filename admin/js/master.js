window.onload = initPage;

function initPage() {
    document.getElementById("name").onblur = closeEmailField;
    document.getElementById("email").onblur = closeNameField;
    document.getElementById("reset").onclick = newSearch;
    activateArchivedMessage();
}

function closeEmailField() {
    var name = document.getElementById("name").value;
    if (name !== '') {
        document.getElementById("email").disabled = true;
    }
}

function closeNameField() {
    var email = document.getElementById("email").value;
    if (email !== '') {
        document.getElementById("name").disabled = true;
    }
}

function newSearch() {
    location.reload();
}

function activateArchivedMessage() {
    var btn = document.getElementsByTagName("button");
    for (var i = 0; i < btn.length; i++) {
        btn[i].onclick = function() {
            var id = (event.target.id);
            $.ajax({
                type: "POST",
                url: "../helpers/act_ajax.php",
                data: { id: id },
                datatype: "html",
                success: function(result) {
                    if (result === "okay") {
                        alert("The message has been successfuly activated!");
                        window.location = "messages.php";
                    }
                }
            })
        }
    }
}