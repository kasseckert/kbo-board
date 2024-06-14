# KBO-Board  

## Voraussetzungen  
- Webspace mit MySQL-Datenbank
- Tiny API Key https://www.tiny.cloud/blog/how-to-get-tinymce-cloud-up-in-less-than-5-minutes/)  
## Datenbank-Tabelle anlegen  
(z. B. mit phpMyAdmin)  
`CREATE TABLE dashboard_kbo (`  
  `id int(11) NOT NULL,`  
  `handwerk mediumtext NOT NULL,`  
  `technik mediumtext NOT NULL,`  
  `sozial mediumtext NOT NULL,`  
  `datum date NOT NULL,`  
  `loeschen date NOT NULL`  
`) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;`  
`ALTER TABLE dashboard_kbo`  
  `ADD PRIMARY KEY (id);`  
`ALTER TABLE dashboard_kbo`  
  `MODIFY id int(11) NOT NULL AUTO_INCREMENT;`  
`COMMIT;`  
  
## Installation  
1. In der Datei `sql.inc.php` erfolgt der Eintrag der Zugangsdaten zur MySQL-Datenbank (Host, Benutzername, Passwort, Datenbankname) und der Tiny API Key.
2. Upload aller Daten auf den eigenen Webspace.
3. Schreibrechte für die Datei `kbo_text.cfg` vergeben (`chmod 777`).
4. Im Verzeichnis `images` eine Bilddatei des eigenen Schullogos hochladen. Der Dateiname `logo.png` darf nicht geändert werden. 
