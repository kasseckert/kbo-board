<?php
    require_once ('../sql.inc.php');
?>

<!DOCTYPE html>
<html lang="de">
    
    <head>
        <title>Berufliche Orientierung</title>
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript">
            function checklength(i) {
                'use strict';
                if (i < 10) {
                    i = "0" + i;
                }
                return i;
            }
            var minutes, seconds, count, counter, timer;
            count = 10800; //Sekunden zum Reload
            counter = setInterval(timer, 1000);
            function timer() {
                'use strict';
                count = count - 1;
                minutes = checklength(Math.floor(count / 60));
                seconds = checklength(count - minutes * 60);
                if (count < 0) {
                    clearInterval(counter);
                    return;
                }
                document.getElementById("timer").innerHTML = '' + minutes + ':' + seconds + ' ';
                if (count === 0) {
                    location.reload();
                }
            }
        </script>
        <?php
        echo $bootstrap_css;
        echo $bootstrap_js;
        echo $bootstrap_icons;
        ?>
        <style>
            /* Stil für Bilder */
            img {
            max-width: 100%; /* Bildbreite maximal 100% des übergeordneten Containers */
            height: auto; /* Automatische Höhe, um das Seitenverhältnis beizubehalten */
            display: block; /* Bilder als Blockelemente anzeigen */
            margin: 0 auto; /* Zentrierung der Bilder im Container */
            }
            .ausnahme {
            /* Spezifische Stile für das ausgenommene Bild */
            max-width: none; /* Entfernt die Begrenzung der maximalen Breite */
            height: 75px;
            }
        </style>
    </head>

    <body>
        
        <img src="images/logo.png" class="ausnahme float-end">
        <h3 class="display-5">Berufliche Orientierung</h3>

        <div class="row">
            <div class="col-sm-4">
                <h5 class="display-8">Handwerk</h5>
                <?php
                    $eintraege1 = $db_link->query("SELECT * FROM dashboard_kbo WHERE DATEDIFF(CURDATE(), loeschen) < 0 ORDER BY datum ASC");
                    while ($zeile1 = $eintraege1->fetch_object()) {
                        if ($zeile1->handwerk != ''){
                            echo '<div class="alert alert-danger">'.$zeile1->handwerk.'<br><small>veröffentlicht am '.date('d.m.y', strtotime($zeile1->datum)).' | id-'.$zeile1->id.'</small></div>';
                        }
                    }
                ?>
            </div>
            
            <div class="col-sm-4">
                <h5 class="display-8">Gewerbe/Technik</h5>
                <?php
                    $eintraege2 = $db_link->query("SELECT * FROM dashboard_kbo WHERE DATEDIFF(CURDATE(), loeschen) < 0 ORDER BY datum ASC");
                    while ($zeile2 = $eintraege2->fetch_object()) {
                        if ($zeile2->technik != ''){
                            echo '<div class="alert alert-info">'.$zeile2->technik.'<br><small>veröffentlicht am '.date('d.m.y', strtotime($zeile2->datum)).' | id-'.$zeile2->id.'</small></div>';
                        }
                    }
                ?>
            </div>

            <div class="col-sm-4">
            <h5 class="display-8">Dienstleistung/Soziales</h5>
                <?php
                    $eintraege3 = $db_link->query("SELECT * FROM dashboard_kbo WHERE DATEDIFF(CURDATE(), loeschen) < 0 ORDER BY datum ASC");
                    while ($zeile3 = $eintraege3->fetch_object()) {
                        if ($zeile3->sozial != ''){
                            echo '<div class="alert alert-warning">'.$zeile3->sozial.'<br><small>veröffentlicht am '.date('d.m.y', strtotime($zeile3->datum)).' | id-'.$zeile3->id.'</small></div>';
                        }
                    }
                ?>
            </div>

        </div>
            <button class="btn btn-muted" disabled>
            <span class="spinner-border spinner-border-sm"></span>
            <span id="timer">
            </button>

        <?php
            // Schließen der Datenbankverbindung
            $eintraege1->free();
            $eintraege2->free();
            $eintraege3->free();
            $db_link->close();
        ?>

    </body>
    
</html>