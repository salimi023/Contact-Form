window.onload = initPage;

function initPage() {
    document.getElementById("respond").onclick = writeResponse;
    document.getElementById("delete").onclick = deleteMessage;
    document.getElementById("archive").onclick = archiveMessage;
}

function writeResponse() {
    document.getElementById("editor").innerHTML =
        '<form id="res_form" method="post">' +
        '<h2>Write a response</h2><div class="form-group">' +
        '<label for="subject">Subject: </label>' +
        '<input type="text" id="subject" name="subject" class="form-control" required/></div>' +
        '<textarea class="form-control" name="text" id="text" rows="10" cols="80" / required></textarea><br />' +
        '<input type="submit" id="send" name="send" class="btn btn-danger" role="button" value="Send" />' +
        '&nbsp&nbsp' +
        '<button id="no" class="btn btn-info" role="button" onclick="dismissForm()">No</button></form>';
}

function deleteMessage() {
    var id = document.getElementById("msg_id").getAttribute("data-value");
    document.getElementById("del_msg").innerHTML = '<div id="err" class="alert alert-danger" role="alert">' +
        'Are you sure that you want to delete this message?<br /><br />' +
        '<button id="delbtn" class="btn btn-warning" role="button">Delete</button>&nbsp&nbsp' +
        '<button id="no" class="btn btn-info" role="button" onclick="dismissMessage()">No</button></div>';
    document.getElementById("delbtn").onclick = function() {
        $.ajax({
            type: "POST",
            url: "delete.php",
            data: { id: id },
            datatype: "html",
            success: function(result) {
                if (result === 'okay') {
                    alert("The message has been successfuly deleted!");
                    window.location = "messages.php";
                }
            }
        })
    }
}

function archiveMessage() {
    var id = document.getElementById("msg_id").getAttribute("data-value");
    document.getElementById("del_msg").innerHTML = '<div id="err" class="alert alert-info" role="alert">' +
        'Are you sure that you want to archivate this message?<br /><br />' +
        '<button id="archbtn" class="btn btn-danger" role="button">Archive</button>&nbsp&nbsp' +
        '<button id="no" class="btn btn-warning" role="button" onclick="dismissMessage()">No</button></div>';
    document.getElementById("archbtn").onclick = function() {
        $.ajax({
            type: "POST",
            url: "../helpers/arch_ajax.php",
            data: { id: id },
            datatype: "html",
            success: function(result) {
                if (result === 'okay') {
                    alert("The message has been successfuly archived!");
                    window.location = "messages.php";
                }
            }
        })
    }
}

function dismissForm() {
    $("#res_form").hide();
}

function dismissMessage() {
    $("#err").hide();
}