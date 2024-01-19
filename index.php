<?php

include('templates/header.php');
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';

    $page = preg_replace('/[^a-zA-Z0-9\/]/', '', $page);

    $basePath = 'pages/';

   $pagePath = $basePath . $page . '.php';

    if (file_exists($pagePath)) {
        include $pagePath;
    } else {
        echo "404 - Page not found";
    }
include('templates/footer.php');
?>