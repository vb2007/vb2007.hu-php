function uploadPaste() {
    var xhttp = new XMLHttpRequest();
  
    //echoes back the backend's response
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("response").innerHTML = this.responseText;
      }
    };
    
    var pasteTitle = document.getElementById("paste-title").value;
    var paste = document.getElementById("paste").value;

    xhttp.open("POST", "/page/_script/pastebin.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("pasteTitle=" + encodeURIComponent(pasteTitle) + "&paste=" + encodeURIComponent(paste));;
  }