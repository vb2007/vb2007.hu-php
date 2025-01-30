document.querySelector('.upload-form').addEventListener('submit', function (e) {
  e.preventDefault();
    
  var formData = new FormData(this);
  
  var progressBar = document.getElementById('progress');
  var progressBarFill = document.getElementById('bar');
  var progressBarPercent = document.getElementById('percent');
  
  var xhr = new XMLHttpRequest();
  
  xhr.open('POST', '/page/_script/tori_upload.php', true);
  
  xhr.upload.onprogress = function(e) {
    if (e.lengthComputable) {
      var percentComplete = (e.loaded / e.total) * 100;
      progressBar.style.display = 'block';
      progressBarFill.style.width = percentComplete + '%';
      progressBarPercent.innerHTML = percentComplete.toFixed(2) + '%';
    }
  };

  xhr.onload = function() {
    if (xhr.status === 200) {
      //sikeres feltöltés, válasz kezelése
      console.log(xhr.responseText);
      var response = JSON.parse(xhr.responseText);

      if (response.success) {
        var fileLocation = response.file_location;

        //elérési út kiírása a felhasználónak
        var messageContainer = document.getElementById("succesful-upload");
        messageContainer.style.display = "block";
        messageContainer.innerHTML = "The file has been uploaded. You can view or download it <a target='_blank' href='" + fileLocation + "'>here</a>.";

        //document.body.appendChild(messageContainer);
      } else {
        //ha nem megy hát nem megy
        console.error(response.error);
      }
      console.log(xhr.responseText);
    }
    else {
      //ha nem megy hát nem megy
      console.error("Upload failed.");
    }
  };

  xhr.onerror = function () {
    //a te hállózati problémád nem az én bajom basszam a szád
    console.error("Network error during upload.");
  };

  xhr.send(formData);
});