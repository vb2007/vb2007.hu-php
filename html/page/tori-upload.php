<!DOCTYPE html>
<html lang="en">
<head>
    <!--Settings-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="title" content="VB2007">
    <meta name="description" content="Just another general purpose site.">
    <meta name="author" content="VB2007">
    <meta name="keywords" content="vb2007, hu, free, download, upload, shorten, 2022, 2023, 2024">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--3rd party import-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!--Local import-->
    <link rel="stylesheet" href="https://cdn.vb2007.hu/webstatic/css/design.css">
    <link rel="stylesheet" href="https://cdn.vb2007.hu/webstatic/css/upload.css">
    <!--Title-->
    <title>Upload</title>
</head>
<body>
    <!--Noscript-->
    <noscript>
        <p>Turn on javascript or get lost.</p>
    </noscript>
    <!--Header-->
    <header>
        <?php //include '_common/navbar.php'; ?>
    </header>
    <!--Main content-->
    <main id="content" class="container">
        <?php include("_script/auth.php"); ?>
        <form class="upload-form" action="/page/_script/tori_upload.php" method="post" enctype="multipart/form-data">
            <div class="upload-element mb-2 ms-5 me-5">
                <label class="form-label" for="file"></label>
                <input class="form-control" type="file" id="file" name="fileToUpload"/>
            </div>
            <div class="justify-content-center mb-2 ms-5 me-5">
                <input class="form-control" type="submit" value="Upload File" name="submit">
            </div>
        </form>
        <hr>
        <div>
            <p class="ms-5 me-5" id="upload-status"></p>
        </div>
        <hr>
        <div class="container" id="progress" style="display:none;">
            <div id="bar"></div>
            <div id="percent">0%</div>
        </div>
    </main>
    <!--Footer-->
    <?php include '_common/footer.php'; ?>
    <!--Script import-->
    <script src="https://cdn.vb2007.hu/webstatic/js/tori_upload_progressbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>