<?php
    $status = $_GET['status'];
    $codes = array(
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Payload Too Large',
        414 => 'URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Range Not Satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',
        420 => 'Enchane Your Calm',
        421 => 'Misdirected Request',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        424 => 'Failed Dependency',
        425 => 'Too Early',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',
        444 => 'No Response',
        450 => 'Blocked by Windows Parental Controls',
        498 => 'Invalid Token',

        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient Storage',
        508 => 'Loop Detected',
        510 => 'Not Extended',
        511 => 'Network Authentication Required',
        521 => 'Web server Is Down',
        522 => 'Connection Timed Out',
        523 => 'Origin Is Unreachable',
        525 => 'SSL Handshake Failed',
        530 => 'Site Frozen',
        599 => 'Network Connect Timeout Error',
    );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--Settings-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="title" content="vb2007.ddns.net">
    <meta name="description" content="Just another general purpose site.">
    <meta name="author" content="VB2007">
    <meta name="keywords" content="vb2007, ddns, net, free, download, upload, 2022, 2023, 2024">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--3rd party import-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!--Local import-->
    <link rel="stylesheet" href="https://cdn.vb2007.hu/webstatic/css/design.css">
    <!--Title-->
    <title><?php echo $status?> - <?php echo $codes[$status]?></title>
</head>
<body>
    <!--Noscript-->
    <noscript>
        <p>Turn on javascript or get lost.</p>
    </noscript>
    <!--Header-->
    <header>
        <?php include '../_common/navbar.php'; ?>
    </header>
    <!--Main content-->
    <main class="container">
        <h1 class="text-center my-2">
            <?php
            if (array_key_exists($status, $codes)) {
                echo $status . " - " . $codes[$status];
            }
            else {
                echo "Error - Unknown error";
            }
            ?>
        </h1>
        <hr class="text-secondary">
        <p class="text-center h4 text-white">Better luck next time!</p>
        <img class="d-block mx-auto img-fluid rounded h-50" src="https://cdn.vb2007.hu/webstatic/http-response-codes/<?php  echo $status;?>.jpg" alt="An image of a cat that shows a HTTP <?php  echo $status;?> response.">
        <p class="text-center h3 mt-1"><a href="/"><i>Country roads, take me home...</i></a></p>
        <p class="text-center h5 mt-3 text-white">Credit to <a href="https://http.cat">http.cat</a>.</p>
    </main>
    <!--Footer-->
    <?php include '../_common/footer.php'; ?>
    <!--Script import-->
    <script src="https://cdn.vb2007.hu/webstatic/js/rainbow_shit.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>