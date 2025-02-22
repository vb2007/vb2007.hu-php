<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include "auth.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  exit('POST request method required.');
}

// if (empty($_FILES)) {
//   exit('$_FILES is empty - is file_uploads set to "Off" in php.ini?');
// }

if ($_FILES["fileToUpload"]["size"] > 25000000) {
  echo json_encode(["success" => false, "error" => "File is too big for upload. The limit is 25MB."]);
  exit("File is too big for upload. The limit is 25MB.");
}

if ($_FILES["fileToUpload"]["error"] !== UPLOAD_ERR_OK) {
  switch ($_FILES["fileToUpload"]["error"]) {
    case UPLOAD_ERR_PARTIAL:
      exit('File only partially uploaded');
      break;
    case UPLOAD_ERR_NO_FILE:
      exit('No file was uploaded');
      break;
    case UPLOAD_ERR_EXTENSION:
      exit('File upload stopped by a PHP extension');
      break;
    case UPLOAD_ERR_FORM_SIZE:
      exit('File exceeds MAX_FILE_SIZE in the HTML form');
      break;
    case UPLOAD_ERR_INI_SIZE:
      exit('File exceeds upload_max_filesize in php.ini');
      break;
    case UPLOAD_ERR_NO_TMP_DIR:
      exit('Temporary folder not found');
      break;
    case UPLOAD_ERR_CANT_WRITE:
      exit('Failed to write file');
      break;
    default:
      exit('Unknown upload error');
      break;
  }
}

$target_dir = "/mnt/raid1/cdn/useruploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$file_name = htmlspecialchars(basename($_FILES["fileToUpload"]["name"]));

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
  $file_location = "/useruploads/" . $file_name;

  // Respond with the file location in JSON format
  echo json_encode(['success' => true, 'file_location' => $file_location]);
}
else {
  echo json_encode(['success' => false, 'error' => 'Sorry, there was an error uploading your file.']);
}
?>