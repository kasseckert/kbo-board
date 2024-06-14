<?php
require_once ('../sql.inc.php');
//
// Tiny API Key
// 7blguhqt8uursc0fxrezzrfza894dclvb15srp9ubp5e28o0
//
?>

<!DOCTYPE html>
<html lang="de">
    
<head>
    <title>KBO Admin</title>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://cdn.tiny.cloud/1/7blguhqt8uursc0fxrezzrfza894dclvb15srp9ubp5e28o0/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <?php
        echo $bootstrap_css;
        echo $bootstrap_js;
        echo $bootstrap_icons;
    ?>
</head>

<body>

<div class="container p-4 my-4 border bg-light">

<a href="index.php"><img src="images/logo.png" class="float-end" height="75"></a>
<h3 class="display-5">KBO Admin</h3><br><br>

<div class="row">
  <div class="col-sm-8">
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<textarea id="open-source-plugins" name="eintrag"></textarea>
		<!-- Ab hier auskommentieren, wenn man TinyMCE nicht nutzen möchte. -->
		<script>
			tinymce.init({
			selector: 'textarea',
			/*
			width : 850,
			*/
			language: 'de',
			language_url: '/home/sites/site100018672/web/vw.rsp-cloud.org/verwaltung/de.js',
			statusbar: false,
			menubar: false,
			/* enable title field in the Image dialog*/
  			image_title: true,
  			/* enable automatic uploads of images represented by blob or data URIs*/
  			automatic_uploads: true,
  			/*
    		URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
    		images_upload_url: 'postAcceptor.php',
    		here we add custom filepicker only to Image dialog
  			*/
  			file_picker_types: 'image',
  			/* and here's our custom image picker*/
  			file_picker_callback: (cb, value, meta) => {
    		const input = document.createElement('input');
    		input.setAttribute('type', 'file');
    		input.setAttribute('accept', 'image/*');
    		input.addEventListener('change', (e) => {
      		const file = e.target.files[0];
      		const reader = new FileReader();
      		reader.addEventListener('load', () => {
        	/*
          	Note: Now we need to register the blob in TinyMCEs image blob
          	registry. In the next release this part hopefully won't be
          	necessary, as we are looking to handle it internally.
        	*/
        	const id = 'blobid' + (new Date()).getTime();
        	const blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        	const base64 = reader.result.split(',')[1];
        	const blobInfo = blobCache.create(id, file, base64);
        	blobCache.add(blobInfo);
        	/* call the callback and populate the Title field with the file name */
        	cb(blobInfo.blobUri(), { title: file.name });
      		});
      		reader.readAsDataURL(file);
    		});
    		input.click();
  			},
			plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
			toolbar: 'blocks fontsize forecolor backcolor | bold italic underline align | image | numlist bullist | charmap',
			tinycomments_mode: 'embedded',
			tinycomments_author: 'Realschule Pegnitz',
			mergetags_list: [
				{ value: 'First.Name', title: 'First Name' },
				{ value: 'Email', title: 'Email' },
			],
			});
		</script>
		<!-- ... bis hierher auskommentieren. -->
        <div class="form-check">
            <input class="form-check-input" type="radio" name="h" id="h" value="h">
            <label class="form-check-label" for="h"><span class="badge bg-danger">handwerklicher Bereich</span></label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="t" id="t" value="t">
            <label class="form-check-label" for="t"><span class="badge bg-info">gewerblich-technischer Bereich</span></label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="s" id="s" value="s">
            <label class="form-check-label" for="s"><span class="badge bg-warning">sozialer Bereich; Dienstleistungssektor</span></label>
        </div>
        <br>
        <div class="formbuilder-date form-group field-datum">
		Zum folgenden Datum soll die Nachricht gelöscht werden:
        <input type="date" class="form-control" name="loeschen" required="required" aria-required="true">
        </div>
		<br>
		<button type="submit" class="btn btn-secondary" name="submit" id="submit">absenden</button> 
		<a href="../kbo/index.php" target="_blank"><button button type="button" class="btn btn-outline-secondary">Web-Aushang ansehen</button></a>
	</form>

	<?php
		if ( $_POST['eintrag'] != "" )
		{
			if ($_POST['h'] == "h"){
				$sql = " INSERT INTO dashboard_kbo ";
				$sql .= "SET";
				$sql .= " handwerk='". $_POST['eintrag'] ."', ";
                $sql .= " technik='', ";
                $sql .= " sozial='', ";
				$sql .= " loeschen='". $_POST['loeschen'] ."', ";
				$sql .= " datum='". date("Y-m-d") ."' ";
				$db_erg = mysqli_query( $db_link, $sql );
				//echo $sql;
				echo '<br><div class="alert alert-success">Der Aushang wurde veröffentlicht.</div>';
			} 
            elseif ($_POST['t'] == "t"){
				$sql = " INSERT INTO dashboard_kbo ";
				$sql .= "SET";
				$sql .= " handwerk='', ";
                $sql .= " technik='". $_POST['eintrag'] ."', ";
                $sql .= " sozial='', ";
				$sql .= " loeschen='". $_POST['loeschen'] ."', ";
				$sql .= " datum='". date("Y-m-d") ."' ";
				$db_erg = mysqli_query( $db_link, $sql );
				//echo $sql;
				echo '<br><div class="alert alert-success">Der Aushang wurde veröffentlicht.</div>';
			}
            elseif ($_POST['s'] == "s"){
				$sql = " INSERT INTO dashboard_kbo ";
				$sql .= "SET";
				$sql .= " handwerk='', ";
                $sql .= " technik='', ";
                $sql .= " sozial='". $_POST['eintrag'] ."', ";
				$sql .= " loeschen='". $_POST['loeschen'] ."', ";
				$sql .= " datum='". date("Y-m-d") ."' ";
				$db_erg = mysqli_query( $db_link, $sql );
				//echo $sql;
				echo '<br><div class="alert alert-success">Der Aushang wurde veröffentlicht.</div>';
			} 
			else {
				echo '<br><div class="alert alert-danger"><strong>Achtung!</strong> Bereich wurde nicht festgelegt.</div>';
			}
		}
	?>
  </div>

  <div class="col-sm-4">
	<?php
        echo '<p><b>aktuelle Aushänge:</b></p>';
		$eintraege = $db_link->query("SELECT * FROM dashboard_kbo ORDER BY loeschen ASC");
		while ($zeile = $eintraege->fetch_object()) {
			if ($zeile->handwerk != ''){
				echo '<a href=dashboard_kbo_loeschen.php?id='.$zeile->id.'>';
				echo '<i class="bi bi-trash"></i>';
				echo '</a> ';
				echo '<span class="badge bg-danger">id-'.$zeile->id.'</span><br><small><small>(erstellt am '.date('d.m.y', strtotime($zeile->datum)).' - wird am '.date('d.m.y', strtotime($zeile->loeschen) + (3600 * 24)).' gelöscht)</small></small><br>';
			} elseif ($zeile->technik != '') {
				echo '<a href=dashboard_kbo_loeschen.php?id='.$zeile->id.'>';
				echo '<i class="bi bi-trash"></i>';
				echo '</a> ';
				echo '<span class="badge bg-info">id-'.$zeile->id.'</span><br><small><small>(erstellt am '.date('d.m.y', strtotime($zeile->datum)).' - wird am '.date('d.m.y', strtotime($zeile->loeschen) + (3600 * 24)).' gelöscht)</small></small><br>';
			} else {
                echo '<a href=dashboard_kbo_loeschen.php?id='.$zeile->id.'>';
				echo '<i class="bi bi-trash"></i>';
				echo '</a> ';
				echo '<span class="badge bg-warning">id-'.$zeile->id.'</span><br><small><small>(erstellt am '.date('d.m.y', strtotime($zeile->datum)).' - wird am '.date('d.m.y', strtotime($zeile->loeschen) + (3600 * 24)).' gelöscht)</small></small><br>';
            }
		}
		mysqli_query($db_link, "DELETE FROM dashboard_kbo WHERE DATEDIFF(CURDATE(), loeschen) > 0");
		// Schließen der Datenbankverbindung
		$eintraege->free();
		$db_link->close();
	?>
  </div>
</div>

</div>

<div class="container p-4 my-4 border bg-light">
	<div class="row">
		<div class="col-sm-12">
			<p>
				<b>Text für den Monitor-Aushang ändern</b>
			</p>
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
				<textarea name="kbo_board"><?php echo file_get_contents('../kbo/kbo_text.cfg'); ?></textarea>
				<br>
				<button type="submit" class="btn btn-secondary" name="submit" id="submit">absenden</button> 
				<a href="../kbo/index-monitor.php" target="_blank">
					<button type="button" class="btn btn-outline-secondary">Monitor-Aushang ansehen</button>
				</a>
			</form>

			<?php
				if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['kbo_board']) && $_POST['kbo_board'] != "") {
					$file = '../kbo/kbo_text.cfg';
					$current = $_POST['kbo_board'] . PHP_EOL;
					if (file_put_contents($file, $current) !== false) {
						echo '<html><head><meta http-equiv="refresh" content="0; url=dashboard_kbo_edit.php"></head></html>';
						exit();
					} else {
						echo "<p>Fehler beim Schreiben in die Datei.</p>";
					}
				}
			?>
		</div>
	</div>
</div>

</body>
</html>
