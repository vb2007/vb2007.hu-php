<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  exit('POST request method required.');
}

if (empty($_FILES)) {
  exit('$_FILES is empty - is file_uploads set to "Off" in php.ini?');
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

$target_dir = "/var/www/html/html/uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
  echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
}
else {
  echo "Sorry, there was an error uploading your file.";
}
?>