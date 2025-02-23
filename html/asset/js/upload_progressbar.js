document.querySelector('.upload-form').addEventListener('submit', function (e) {
  e.preventDefault();
    
  var formData = new FormData(this);
  
  var progressBar = document.getElementById('progress');
  var progressBarFill = document.getElementById('bar');
  var progressBarPercent = document.getElementById('percent');

  var messageContainer = document.getElementById("upload-status");
  
  var xhr = new XMLHttpRequest();
  
  xhr.open('POST', '/page/_script/upload.php', true);
  
  xhr.upload.onprogress = function(e) {
    if (e.lengthComputable) {
      var percentComplete = (e.loaded / e.total) * 100;
      progressBar.style.display = 'block';
      progressBarFill.style.width = percentComplete + '%';
      progressBarPercent.innerHTML = percentComplete.toFixed(2) + '%';
    }
  };

  xhr.onload = function() {
    var response = JSON.parse(xhr.responseText);
    // console.log(xhr.responseText);
    var fileLocation = response.file_location;
    var uploadError = response.error;

    if (xhr.status === 200) {
      //sikeres feltöltés, válasz kezelése
      
      if (response.success) {
        //elérési út kiírása a felhasználónak
        messageContainer.style.display = "block";
        messageContainer.innerHTML = `The file has been uploaded. You can view or download it <a target='_blank' href="https://cdn.vb2007.hu/${fileLocation}">here</a>.`;

        // document.body.appendChild(messageContainer);
      }
      else {
        console.error(response.error);
      }
    }
    else {
      //ha nem megy hát nem megy
      progressBar.style.display = 'none';

      messageContainer.style.display = "block";
      messageContainer.innerHTML = "An error occurred while uploading the file: " + uploadError;

      console.error("Upload failed.");
    }
  };

  xhr.onerror = function () {
    console.error("Network error during upload.");
  };

  xhr.send(formData);
});