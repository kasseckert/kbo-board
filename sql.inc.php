<?php
    error_reporting(E_ALL);
    define ('MYSQL_HOST','Host');
    define ('MYSQL_BENUTZER','Benutername');
    define ('MYSQL_KENNWORT','Passwort');
    define ( 'MYSQL_DATENBANK','Datenbankname');
    $db_link = mysqli_connect (MYSQL_HOST, 
                            MYSQL_BENUTZER, 
                            MYSQL_KENNWORT, 
                            MYSQL_DATENBANK);
    mysqli_set_charset($db_link, 'utf8');
    // Tiny API Key
    $tinykey = 'Tiny_API_Key';
    // Einbindung Bootstrap im Header
    $bootstrap_css = '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">';
    $bootstrap_js = '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>';
    $bootstrap_icons = '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">';
?>