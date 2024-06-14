<?php
    require_once ('../sql.inc.php');
    $id_dashboard = ($_GET['id']);
    mysqli_query($db_link, "DELETE FROM dashboard_kbo WHERE id = ".$id_dashboard."");
    echo '<html><head><meta http-equiv="refresh" content="0; url=dashboard_kbo_edit.php"></head></html>';
?>