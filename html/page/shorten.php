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
    <!--Title-->
    <title>Shorten links</title>
</head>
<body>
    <!--Noscript-->
    <noscript>
        <p>Turn on javascript or get lost.</p>
    </noscript>
    <!--Header-->
    <header>
        <?php include '_common/navbar.php'; ?>
    </header>
    <!--Main content-->
    <main class="container">
        <?php include '_script/auth.php'; ?>
        <form class="upload-form" id="url-form" action="/page/_script/shorten.php" method="post" enctype="multipart/form-data">
            <div class="upload-element mb-2 ms-5 me-5">
                <label class="form-label" for="url"></label>
                <input class="form-control" type="text" id="url" name="url" placeholder="Enter your URL here" required>
            </div>
            <div class="justify-content-center mb-2 ms-5 me-5">
                <button class="form-control" onclick="shortenUrl()" type="button" value="Shorten URL">Shorten URL</button>
            </div>
        </form>
        <div class="container my-3">
            <p class="text-center" id="response"></p>
        </div>
        <!--Display shortened links from the databse-->
        <?php
            // exits if the request type isn't get
            if ($_SERVER["REQUEST_METHOD"] !== "GET") {
                exit("GET request method required.");
            }

            include_once("_script/_config.php");

            // set total records/page. if it isn't set, it'll be 10 by default
            $recordsPerPage = isset($_GET['recordsPerPage']) ? (int)$_GET['recordsPerPage'] : 10;

            // set the page id. if the page id isn't set, it'll be 1 (first page) by default
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

            // calculates the starting index
            $startIndex = ($page - 1) * $recordsPerPage;

            // gets the values according to the parameters, where LIMIT is $recordsPerPage and the OFFSET is $startIndex
            $query = $mysqli->prepare("SELECT id, url, shortUrl, addedBy, dateAdded FROM urlShortener LIMIT ?, ?");
            $query->bind_param('ss', $startIndex, $recordsPerPage);
            $query->execute();
            $query->bind_result($id, $url, $shortUrl, $addedBy, $dateAdded);
            // $query->close();
        ?>
        <h2 class="text-center text-white mt-6 mb-3">Links shortened by others</h2>
        <!-- <p class="text-center"><i>Displaying URLs is a bit broken at the moment, please be patient.</i></p>
        <p class="text-center">The core (shortening and redirecting) still works, so don't worry.</p> -->
        <div class="container table-responsive d-block">
            <table class="table table-dark caption-top">
                <caption class="text-white">Shortened links</caption>
                <thead>
                    <th class="idTitle" scope="col">Id</th>
                    <th class="originalLinkTitle" scope="col">Original link</th>
                    <th class="shortenedLinkTitle" scope="col">Shortened link</th>
                    <!-- <th class="viewCountTitle" scope="col">View count</th> -->
                    <th class="shortenedAtTitle" scope="col">Shortened at</th>
                    <th class="shortenedByTitle" scope="col">Shortened by</th>
                </thead>
                <tbody>
                    <?php while ($query->fetch()): ?>
                        <tr>
                            <td class="id"><?php echo $id; ?></td>
                            <td class="originalLink text-truncate"><?php echo $url; ?></td>
                            <td class="shortenedLink"><a target="_blank" href="/ref/<?php echo $shortUrl; ?>"><?php echo $shortUrl; ?></a></td>
                            <td class="shortenedAt"><?php echo $dateAdded; ?></td>
                            <td class="shortenedBy"><?php echo $addedBy; ?></td>
                        </tr>
                    <?php endwhile; $query->close(); ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-12 col-md-4 mb-1 mt-2 dropdown d-flex justify-content-start">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Records per page: <?php echo $recordsPerPage; ?>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?page=1&recordsPerPage=10">10</a></li>
                        <li><a class="dropdown-item" href="?page=1&recordsPerPage=25">25</a></li>
                        <li><a class="dropdown-item" href="?page=1&recordsPerPage=50">50</a></li>
                    </ul>
                </div>
                <div class="col-12 col-md-4 pagination d-flex justify-content-center">
                    <ul class="pagination">
                        <?php
                            //get table's total record count
                            $totalRecordsQuery = $mysqli->prepare("SELECT COUNT(*) AS total FROM urlShortener");
                            $totalRecordsQuery->execute();
                            $totalRecordsResult = $totalRecordsQuery->get_result();
                            $totalRecordsRow = $totalRecordsResult->fetch_row();
                            $totalRecords = $totalRecordsRow[0];
                            $totalPages = ceil($totalRecords / $recordsPerPage);
                        ?>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?php echo ($i == $page ? 'active' : ''); ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>&recordsPerPage=<?php echo $recordsPerPage; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; $totalRecordsQuery->close(); ?>
                    </ul>
                </div>
                <div class="col-12 col-md-4 d-flex justify-content-end">
                    <p>Showing page <?php echo $page; ?> of <?php echo $totalPages;?></p>
                </div>
            </div>
        </div>
    </main>
    <!--Footer-->
    <?php include '_common/footer.php'; ?>
    <!--Script import-->
    <script src="https://cdn.vb2007.hu/webstatic/js/rainbow_shit.js"></script>
    <script src="https://cdn.vb2007.hu/webstatic/js/shortener_handler.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>