function countdown() {
    var txtComment = document.querySelector("#comments");
    var limit = 150 - txtComment.textLength;
    var noChar = document.querySelector("#char");
    noChar.innerHTML = limit;
    if (limit <= 30) noChar.style.color = "red";
    else noChar.style.color = "black";

    if (limit <= 0) {
        txtComment.value = txtComment.value.substring(0, 150);
        countdown();
    }

}


function showResult(str) {
    if (str.length === 0) {
        document.querySelector("#livesearch").innerHTML = " "
        return;
    }
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "livesearch.php?q=" + str + "&option=" + 1, false);
    xhttp.send();
    var txt = xhttp.responseText.toString();
    //console.log(txt);
    document.querySelector("#livesearch").innerHTML = xhttp.responseText.toString();
}

function setResult(str) {
    document.querySelector("#email").value = str;
    showUser(str);
}

function showUser(str) {
    document.querySelector("#livesearch").innerHTML = " ";

    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "livesearch.php?q=" + str + "&option=" + 2, false);
    xhttp.send();
    var txt = xhttp.responseText.toString();
    console.log(txt.split(",").length);
    document.querySelector("#user").value = txt.split(",")[0];
    document.querySelector("#area").value = txt.split(",")[1];
}