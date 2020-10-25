<?php
/**
 * $Id: admin.php v 1.22 02 july 2004 Liquid Exp $
 * Module: PD-links
 * Version: v1.0
 * Release Date: 04. März 2005
 * Author: Power-Dreams Team
 * Licence: GNU
 */

// %%%%%%	Module NMDe 'Mylinks' (Admin)	  %%%%%
// Buttons
define('_AM_PDD2_BMODIFY', '&Auml;ndern');
define('_AM_PDD2_BDELETE', 'L&ouml;schen');
define('_AM_PDD2_BADD', 'Hinzuf&uuml;gen');
define('_AM_PDD2_BAPPROVE', 'Freigeben');
define('_AM_PDD2_BIGNORE', 'Ignorieren');
define('_AM_PDD2_BCANCEL', 'Abbrechen');
define('_AM_PDD2_BSAVE', 'Sichern');
define('_AM_PDD2_BRESET', 'Zur&uuml;cksetzen');
define('_AM_PDD2_BMOVE', 'Dateien verschieben');
define('_AM_PDD2_BUPLOAD', 'Upload');
define('_AM_PDD2_BDELETEIMAGE', 'Ausgew&auml;hltes Bild l&ouml;schen');
define('_AM_PDD2_BRETURN', 'Zur&uuml;ck wo Du herkommst!');
define('_AM_PDD2_DBERROR', 'Datenbank Zugriffs-Fehler: Bitte diesen Fehler einem der Webmaster der PD_Sections Homepage melden');
//Banned Users
define('_AM_PDD2_NONBANNED', 'Nicht gebannt');
define('_AM_PDD2_BANNED', 'Gebannt');
define('_AM_PDD2_EDITBANNED', 'Gebannte User editieren');
// Other Options
define('_AM_PDD2_TEXTOPTIONS', 'Texteinstellungen:');
define('_AM_PDD2_DISABLEHTML', ' HTML Tags deaktivieren');
define('_AM_PDD2_DISABLESMILEY', ' Smilie Icons deaktivieren');
define('_AM_PDD2_DISABLEXCODE', ' XOOPS Code deaktivieren');
define('_AM_PDD2_DISABLEIMAGES', ' Bilder deaktivieren');
define('_AM_PDD2_DISABLEBREAK', ' XOOPS Zeilenumbruch verwenden?');
define('_AM_PDD2_UPLOADFILE', 'Datei erfolgreich hochgeladen');
define('_AM_PDD2_NOMENUITEMS', 'Keine Men&uuml;items innerhalb dieses Men&uuml;s');

// Admin Bread crumb
define('_AM_PDD2_PREFS', 'Einstellungen');
define('_AM_PDD2_PERMISSIONS', 'Berechtigungen');
define('_AM_PDD2_BINDEX', 'Hauptindex');
define('_MI_PDD2_BLOCKADMIN', 'Block Einstellungen');
define('_AM_PDD2_BLOCKADMIN', 'Bl&ouml;cke');
define('_AM_PDD2_GOMODULE', 'Gehe zu Modul');
define('_AM_PDD2_ABOUT', 'About');

// Admin Summary
define('_AM_PDD2_SCATEGORY', 'Kategorie: ');
define('_AM_PDD2_SFILES', 'Dateien: ');
define('_AM_PDD2_SNEPDILESVAL', 'Eingesendet: ');
define('_AM_PDD2_SMODREQUEST', 'Modifiziert: ');
define('_AM_PDD2_SREVIEWS', 'Rezensionen: ');
// Admin Main Menu
define('_AM_PDD2_MCATEGORY', 'Kategorien');
define('_AM_PDD2_Mlinks', 'Neuen Link erstellen');
define('_AM_PDD2_INDEXPAGE', 'Einstellungen: Indexseite');
define('_AM_PDD2_MCOMMENTS', 'Kommentare');
define('_AM_PDD2_MVOTEDATA', 'Bewertungsdaten');
define('_AM_PDD2_MUPLOADS', 'Bild Hochladen');

// Catgeory defines
define('_AM_PDD2_CCATEGORY_CREATENEW', 'Kategorie anlegen');
define('_AM_PDD2_CCATEGORY_MODIFY', 'Kategorie &auml;ndern');
define('_AM_PDD2_CCATEGORY_MOVE', 'Dateien aus gew&auml;hlter Kategorie verschieben');
define('_AM_PDD2_CCATEGORY_MODIFY_TITLE', 'Kategorietitel:');
define('_AM_PDD2_CCATEGORY_MODIFY_FAILED', 'Verschieben fehlgeschlagen: Diese Kategorie kann nicht verschoben werden!');
define('_AM_PDD2_CCATEGORY_MODIFY_FAILEDT', 'Verschieben fehlgeschlagen: Kategorie konnte nicht gefunden werden!');
define('_AM_PDD2_CCATEGORY_MODIFY_MOVED', 'Dateien verschoben und Kategorie gel&ouml;scht');
define('_AM_PDD2_CCATEGORY_CREATED', 'Neue Kategorie angelegt und Datenbank erfolgreich aktualisiert');
define('_AM_PDD2_CCATEGORY_MODIFIED', 'Gew&auml;hlte Kategorie ge&auml;ndert und Datenbank erfolgreich aktualisiert');
define('_AM_PDD2_CCATEGORY_DELETED', 'Gew&auml;hlte Kategorie gel&ouml;scht und Datenbank erfolgreich aktualisiert');
define('_AM_PDD2_CCATEGORY_AREUSURE', 'WARNUNG: Soll die gew&auml;hlte Kategorie mit ALLEN Dateien und Kommentaren wirklich gel&ouml;scht werden?');
define('_AM_PDD2_CCATEGORY_NOEXISTS', 'Es muss erst eine Kategorie erstellt werden, bevor Dateien in die Datenbank eingetragen werden k&ouml;nnen');
define('_AM_PDD2_FCATEGORY_GROUPPROMPT', "Kategorie Zugriffsberechtigungen:<div style='padding-top: 8px;'><span style='font-weight: normal;'>Bitte Usergruppe ausw&auml;hlen, die zu Zugriff<br>auf diese Kategorie haben soll.</span></div>");
define('_AM_PDD2_FCATEGORY_TITLE', 'Titel f&uuml;r Kategorie:');
define('_AM_PDD2_FCATEGORY_WEIGHT', "Kategorie-Gewichtung: <div style='padding-top: 8px;'><span style='font-weight: normal;'>Reihenfolge in der die Kategorie auf der Indexseite erscheint<br>(0=ganz oben)</span></div>");
define('_AM_PDD2_FCATEGORY_SUBCATEGORY', 'Setze als Subkategorie von:');
define('_AM_PDD2_FCATEGORY_CIMAGE', 'Kategoriebild ausw&auml;hlen:');
define('_AM_PDD2_FCATEGORY_DESCRIPTION', 'Beschreibung f&uuml;r Kategorie erstellen:');
define('_AM_PDD2_FCATEGORY_SUMMARY', 'Zusammenfassung f&uuml;r Kategorie schreiben:');
/*
* Index page Defines
*/
define('_AM_PDD2_IPAGE_UPDATED', 'Modul-Startseite ge&auml;ndert und Datenbank erfolgreich aktualisiert!');
define('_AM_PDD2_IPAGE_INFORMATION', 'Indexseiten - Information');
define('_AM_PDD2_IPAGE_MODIFY', '&Auml;ndere Indexseite');
define('_AM_PDD2_IPAGE_CTITLE', "Titel Modulindexseite:<div style='padding-top: 8px;'><span style='font-weight: normal;'>Dieser Subtitel erscheint unterhalb dem gew&auml;hlten Logo (falls dies ausgew&auml;hlt wird).</span></div>");
define('_AM_PDD2_IPAGE_CIMAGE', 'Logo/Bild f&uuml;r Modulindex ausw&auml;hlen:');
define('_AM_PDD2_IPAGE_CHEADING', 'Headerbereich (Indexseite):');
define('_AM_PDD2_IPAGE_CHEADINGA', 'Header ausrichten (text-align):');
define('_AM_PDD2_IPAGE_CFOOTER', 'Footerbereich (Indexseite):');
define('_AM_PDD2_IPAGE_CFOOTERA', 'Footer ausrichten (text-align):');
define('_AM_PDD2_IPAGE_CLEFT', 'Links');
define('_AM_PDD2_IPAGE_CCENTER', 'Center');
define('_AM_PDD2_IPAGE_CRIGHT', 'Rechts');
/*
*  Permissions defines
*/
define('_AM_PDD2_PERM_MANAGEMENT', 'Berechtigungs-Management');
define(
    '_AM_PDD2_PERM_PERMSNOTE',
    '<div><b>Es gilt zu beachten</b>, da&szlig; obwohl die Berechtigungen hier korrekt gesetzt sein m&ouml;gen, eine Gruppe dennoch keine Sicht- und/oder Zugriffsrechte haben kann wenn entsprechende Modul-Rechte fehlen. Diese Rechte k&ouml;nnen unter <b>System > Gruppen</b> eingestellt werden. Dort die entsprechende Gruppe ausw&auml;hlen und die passenden Rechte setzen.</div>'
);
define('_AM_PDD2_PERM_CPERMISSIONS', 'Kategorieberechtigungen');
define('_AM_PDD2_PERM_CSELECTPERMISSIONS', 'Kategorie bestimmen die jeder Gruppe zug&auml;nglich ist');
define('_AM_PDD2_PERM_CNOCATEGORY', 'Berechtigung kann nicht gesetzt werden: Es existieren noch keine Kategorien!');
define('_AM_PDD2_PERM_FPERMISSIONS', 'Linkberechtigung');
define('_AM_PDD2_PERM_FNOFILES', 'Berechtigung kann nicht gesetzt werden: Es existieren noch keine Dateien!');
define('_AM_PDD2_PERM_FSELECTPERMISSIONS', 'Link bestimmen die jeder Gruppe zug&auml;nglich ist');
/*
* Upload defines
*/
define('_AM_PDD2_link_IMAGEUPLOAD', 'Bild erfolgreich in entsprechenden Uploadbereich hochgeladen');
define('_AM_PDD2_link_NOIMAGEEXIST', 'Fehler: Es wurde keine Datei zum Upload ausgew&auml;hlt. Bitte Vorgang wiederholen!');
define('_AM_PDD2_link_IMAGEEXIST', 'Bild existiert bereits in diesem Uploadbereich!');
define('_AM_PDD2_link_FILEDELETED', 'Datei wurde gel&ouml;scht.');
define('_AM_PDD2_link_FILEERRORDELETE', 'Fehler beim L&ouml;schen der Datei: Datei existiert nicht auf dem Server.');
define('_AM_PDD2_link_NOFILEERROR', 'Fehler beim L&ouml;schen der Datei: Keine Datei zum L&ouml;schen ausgew&auml;hlt.');
define('_AM_PDD2_link_DELETEFILE', 'WARNUNG: Soll diese Bilddatei wirklich gel&ouml;scht werden?');
define('_AM_PDD2_link_IMAGEINFO', 'Server Status');
define('_AM_PDD2_link_SPHPINI', '<b>Information aus der php.ini:</b>');
define('_AM_PDD2_link_SAFEMODESTATUS', 'Safe Mode Status: ');
define('_AM_PDD2_link_REGISTERGLOBALS', 'Register Globals: ');
define('_AM_PDD2_link_SERVERUPLOADSTATUS', 'Server Uploads Status: ');
define('_AM_PDD2_link_MAXUPLOADSIZE', 'Maximal erlaubte Uploadgr&ouml;&szlig;e: ');
define('_AM_PDD2_link_MAXPOSTSIZE', 'Maximal erlaubte POST-Gr&ouml;&szlig;e: ');
define('_AM_PDD2_link_SAFEMODEPROBLEMS', ' (Dadurch kann es zu Problemen kommen)');
define('_AM_PDD2_link_GDLIBSTATUS', 'GD Library Unterst&uuml;tzung: ');
define('_AM_PDD2_link_GDLIBVERSION', 'GD Library Version: ');
define('_AM_PDD2_link_GDON', '<b>aktiviert</b> (Thumbnails k&ouml;nnen verwendet werden)');
define('_AM_PDD2_link_GDOFF', '<b>deaktiviert</b> (keine Thumbnails m&ouml;glich)');
define('_AM_PDD2_link_OFF', '<b>AUS</b>');
define('_AM_PDD2_link_ON', '<b>AN</b>');
define('_AM_PDD2_link_CATIMAGE', 'Kategoriebilder');
define('_AM_PDD2_link_SCREENSHOTS', 'Screenshots');
define('_AM_PDD2_link_MAINIMAGEDIR', 'Hauptbilder');
define('_AM_PDD2_link_FCATIMAGE', 'Kategoriebilder Pfad');
define('_AM_PDD2_link_FSCREENSHOTS', 'Screenshots Pfad');
define('_AM_PDD2_link_FMAINIMAGEDIR', 'Hauptbild Pfad');
define('_AM_PDD2_link_FUPLOADIMAGETO', 'Bild hochladen: ');
define('_AM_PDD2_link_FUPLOADPATH', 'Uploadpfad: ');
define('_AM_PDD2_link_FUPLOADURL', 'Upload-URL: ');
define('_AM_PDD2_link_FOLDERSELECTION', 'Uploadziel ausw&auml;hlen:');
define('_AM_PDD2_link_FSHOWSELECTEDIMAGE', 'Zeige ausgew&auml;hltes Bild:');
define('_AM_PDD2_link_FUPLOADIMAGE', 'Neues Bild an die gew&auml;hlte Stelle hochladen:');

// Main Index defines
define('_AM_PDD2_MINDEX_linkSUMMARY', 'Zusammenfassung PD-Links');
define('_AM_PDD2_MINDEX_PUBLISHEDlink', 'Ver&ouml;ffentlichte Links:');
define('_AM_PDD2_MINDEX_AUTOPUBLISHEDlink', 'Links mit automatischem Ver&ouml;ffentlichungsdatum:');
define('_AM_PDD2_MINDEX_AUTOEXPIRE', 'Links mit automatischem Ablaufdatum:');
define('_AM_PDD2_MINDEX_EXPIRED', 'Links die abgelaufen sind:');
define('_AM_PDD2_MINDEX_OFFLINElink', 'Links mit Status -Offline-:');
define('_AM_PDD2_MINDEX_ID', 'ID');
define('_AM_PDD2_MINDEX_TITLE', 'Titel des Links');
define('_AM_PDD2_MINDEX_POSTER', 'eingesandt von');
define('_AM_PDD2_MINDEX_SUBMITTED', 'eingesendet am');
define('_AM_PDD2_MINDEX_ONLINESTATUS', 'Onlinestatus');
define('_AM_PDD2_MINDEX_PUBLISHED', 'Ver&ouml;ffentlicht');
define('_AM_PDD2_MINDEX_ACTION', 'Aktion');
define('_AM_PDD2_MINDEX_NOlinksFOUND', 'HINWEIS: Es existieren keine Links, die den Kriterien entsprechen');
define('_AM_PDD2_MINDEX_PAGE', '<b>Seite:<b> ');
define(
    '_AM_PDD2_MINDEX_PAGEINFOTXT',
    '<ul><li>Einstellung der PD-Links-Startseite.</li><li>Das Logo, der Sectionsheader- und Footer , usw. k&ouml;nnen sehr einfach gewechselt werden um dem Look and Feel der gesamten Seite zu entsprechen</li></ul><br><br>ANMERKUNG: Das hier selektierte Logo wird auf allen (PD-Links)Modulseiten erscheinen.'
);
define('_AM_PDD2_MINDEX_DOWNSEC', 'in unseren Linksbereich');

// Submitted Files
define('_AM_PDD2_SUB_SUBMITTEDFILES', '&Uuml;bermittelte Dateien');
define('_AM_PDD2_SUB_FILESWAITINGINFO', 'Wartende Dateien Informationen');
define('_AM_PDD2_SUB_FILESWAITINGVALIDATION', 'Files Waiting Validation: ');
define('_AM_PDD2_SUB_APPROVEWAITINGFILE', '<b>Freigabe</b> - Gibt den neuen Link ohne &Uuml;berpr&uuml;fung frei.');
define('_AM_PDD2_SUB_EDITWAITINGFILE', '<b>Editiere</b> den neuen Link und gebe ihn anschlie&szlig;end frei.');
define('_AM_PDD2_SUB_DELETEWAITINGFILE', '<b>L&ouml;sche</b> die neuen Datei-Informationen.');
define('_AM_PDD2_SUB_NOFILESWAITING', 'Es stimmen keine Dateien mit den vorliegenden Kriterien &uuml;berein');
define('_AM_PDD2_SUB_NEPDILECREATED', 'Neue Datei erstellt und Datenbank erfolgreich aktualisiert');

// Vote Information
define('_AM_PDD2_VOTE_RATINGINFOMATION', 'Bewertungs-Information');
define('_AM_PDD2_VOTE_TOTALVOTES', 'Stimmen insgesamt: ');
define('_AM_PDD2_VOTE_REGUSERVOTES', 'Stimmen registrierter User: %s');
define('_AM_PDD2_VOTE_ANONUSERVOTES', 'Stimmen anonymer User: %s');
define('_AM_PDD2_VOTE_USER', 'User');
define('_AM_PDD2_VOTE_IP', 'IP Adresse');
define('_AM_PDD2_VOTE_USERAVG', 'Durchschnitt aller Bewertungen');
define('_AM_PDD2_VOTE_TOTALRATE', 'Abgegebene Stimmen');
define('_AM_PDD2_VOTE_DATE', 'eingesendet am');
define('_AM_PDD2_VOTE_RATING', 'Bewertung');
define('_AM_PDD2_VOTE_NOREGVOTES', 'Keine Bewertung durch registrierte User');
define('_AM_PDD2_VOTE_NOUNREGVOTES', 'Keine Bewertung durch anonyme User');
define('_AM_PDD2_VOTE_VOTEDELETED', 'Bewertung gel&ouml;scht.');
define('_AM_PDD2_VOTE_ID', 'ID');
define('_AM_PDD2_VOTE_FILETITLE', 'Datei-Titel');
define('_AM_PDD2_VOTE_DISPLAYVOTES', 'Bewertungen/ Abstimmungsergebnisse');
define('_AM_PDD2_VOTE_NOVOTES', 'Keine User Bewertungen vorhanden');
define('_AM_PDD2_VOTE_DELETE', 'Keine User Bewertungen vorhanden');
define('_AM_PDD2_VOTE_DELETEDSC', '<b>L&ouml;scht</b> die entsprechende Bewertung aus der Datenbank.');

// Modifications
define('_AM_PDD2_MOD_TOTMODREQUESTS', '&Auml;nderungsanfragen insgesamt: ');
define('_AM_PDD2_MOD_MODREQUESTS', 'Ge&auml;nderte Dateien');
define('_AM_PDD2_MOD_MODREQUESTSINFO', 'Informationen: Ge&auml;nderte Dateien');
define('_AM_PDD2_MOD_MODID', 'ID');
define('_AM_PDD2_MOD_MODTITLE', 'Titel');
define('_AM_PDD2_MOD_MODPOSTER', 'Original von: ');
define('_AM_PDD2_MOD_DATE', '&uuml;bermittelt von');
define('_AM_PDD2_MOD_NOMODREQUEST', 'Es existieren keine Anfragen, die den Kriterien entsprechen');
define('_AM_PDD2_MOD_TITLE', 'Link Titel: ');
define('_AM_PDD2_MOD_LID', 'Link ID: ');
define('_AM_PDD2_MOD_CID', 'Kategorie: ');
define('_AM_PDD2_MOD_URL', 'Link URL: ');
define('_AM_PDD2_MOD_PUBLISHER', 'ver&ouml;ffentlicht von: ');
define('_AM_PDD2_MOD_FORUMID', 'Forum: ');
define('_AM_PDD2_MOD_SCREENSHOT', 'Screenshot: ');
define('_AM_PDD2_MOD_HOMEPAGE', 'Homepage: ');
define('_AM_PDD2_MOD_HOMEPAGETITLE', 'Homepage Titel: ');
define('_AM_PDD2_MOD_SHOTIMAGE', 'Screenshot Bild: ');
define('_AM_PDD2_MOD_DESCRIPTION', 'Beschreibung: ');
define('_AM_PDD2_MOD_MODIFYSUBMITTER', 'Eingesandt von: ');
define('_AM_PDD2_MOD_MODIFYSUBMIT', 'Eingesandt von');
define('_AM_PDD2_MOD_PROPOSED', 'Vorgeschlagene linkdetails');
define('_AM_PDD2_MOD_ORIGINAL', 'Orginal linkdetails');
define('_AM_PDD2_MOD_REQDELETED', '&Auml;nderungsanfrage aus Datenbank entfernt');
define('_AM_PDD2_MOD_REQUPDATED', 'Gew&auml;hlter link erfolgreich modifiziert und Datenbank aktualisiert');
define('_AM_PDD2_MOD_VIEW', 'Zeigen');

//File management
define('_AM_PDD2_FILE_ID', 'Datei ID: ');
define('_AM_PDD2_FILE_IP', 'Uploaders IP Adresse: ');
define('_AM_PDD2_FILE_ALLOWEDAMIME', "<div style='padding-top: 4px; padding-bottom: 4px;'><b>Erlaubte Admin Dateiendungen</b>:</div>");
define('_AM_PDD2_FILE_MODIFYFILE', 'Dateiinformationen modifizieren');
define('_AM_PDD2_FILE_CREATENEPDILE', 'Neuen Link erstellen');
define('_AM_PDD2_FILE_TITLE', 'Homepage-Title: ');
define('_AM_PDD2_FILE_DLURL', 'Homepage-URL (direkte URL): ');
define('_AM_PDD2_FILE_DESCRIPTION', 'Beschreibung des Links: ');
define('_AM_PDD2_FILE_CATEGORY', 'Kategorie ausw&auml;hlen: ');
define('_AM_PDD2_FILE_FILESSTATUS', " Link offline setzen?<br><br><span style='font-weight: normal;'>Dadurch wird der Link nach Au&szlig;en unsichtbar f&uuml;r die Besucher.</span>");
define('_AM_PDD2_FILE_SETASUPDATED', " Link Status auf Aktualisiert (Updated) setzen?<br><br><span style='font-weight: normal;'>Dadurch wird das Updated Icon gesetzt.</span>");
define('_AM_PDD2_FILE_SHOTIMAGE', 'Screenshot ausw&auml;hlen: ');
define('_AM_PDD2_FILE_DISCUSSINFORUM', 'Diskussion in Forum hinzuf&uuml;gen? (Nur Xoopsboard)');
define('_AM_PDD2_FILE_PUBLISHDATE', 'Ver&ouml;ffentlichungsdatum:');
define('_AM_PDD2_FILE_EXPIREDATE', 'Ablaufdatum:');
define('_AM_PDD2_FILE_CLEARPUBLISHDATE', '<br><br>Ver&ouml;ffentlichungsdatum entfernen:');
define('_AM_PDD2_FILE_CLEAREXPIREDATE', '<br><br>Ablaufdatum entfernen:');
define('_AM_PDD2_FILE_PUBLISHDATESET', ' Ver&ouml;ffentlichungsdatum setzen auf: ');
define('_AM_PDD2_FILE_SETDATETIMEPUBLISH', ' Setze Datum/Uhrzeit der Ver&ouml;ffentlichung');
define('_AM_PDD2_FILE_SETDATETIMEEXPIRE', ' Setze Datum/Uhrzeit des Ablaufs');
define('_AM_PDD2_FILE_SETPUBLISHDATE', '<b>Setze Ver&ouml;ffentlichungsdatum: </b>');
define('_AM_PDD2_FILE_SETNEWPUBLISHDATE', '<b>Setze Ver&ouml;ffentlichungsdatum</b><br>');
define('_AM_PDD2_FILE_SETPUBDATESETS', '<b>Ver&ouml;ffentlichungsdatum gesetzt auf: </b><br>');
define('_AM_PDD2_FILE_EXPIREDATESET', ' Ablaufdatum gesetzt auf: ');
define('_AM_PDD2_FILE_SETEXPIREDATE', '<b>Setze Ablaufdatum</b>');
define('_AM_PDD2_FILE_DELEDITMESS', "Defektmeldung löschen?<br><br><span style='font-weight: normal;'>Wenn Sie <b>JA</b> auswählen wird die Defektmeldung automatisch gelöscht und Sie bestätigen damit auch das der Link jetzt wieder funktioniert.</span>");
define('_AM_PDD2_FILE_MUSTBEVALID', 'G&uuml;ltige Screenshots m&uuml;ssen sich im Verzeichnis %s befinden (z.B. shot.gif). Leer lassen falls kein Bild existiert.');
define('_AM_PDD2_FILE_EDITAPPROVE', 'Link freigeben:');
define('_AM_PDD2_FILE_NEPDILEUPLOAD', 'Neuer Link eingetragen und Datenbank erfolgreich aktualisiert');
define('_AM_PDD2_FILE_FILEMODIFIEDUPDATE', 'Ausgewählte Datei modifiziert und Datenbank erfolgreich upgedated');
define('_AM_PDD2_FILE_REALLYDELETEDTHIS', 'Soll der Link wirklich gel&ouml;scht werden?');
define('_AM_PDD2_FILE_FILEWASDELETED', 'Link %s erfolgreich aus Datenbank entfernt!');
define('_AM_PDD2_FILE_FILEAPPROVED', 'Link freigegeben und Datenbank erfolgreich aktualisiert');
define('_AM_PDD2_FILE_CREATENEWSSTORY', '<b>News Story aus link erstellen</b>');
define('_AM_PDD2_FILE_SUBMITNEWS', 'Neuen Link als Artikel &uuml;bermitteln?');
define('_AM_PDD2_FILE_NEWSCATEGORY', 'Nachrichten-/Artikelkategorie ausw&auml;hlen:');
define('_AM_PDD2_FILE_NEWSTITLE', "Nachrichtentitel:<div style='padding-top: 4px; padding-bottom: 4px;'><span style='font-weight: normal;'>Leer lassen um Homepage-Titel als Artikeltitel zu verwenden</span></div>");

/*
* Defekte links defines
*/
define('_AM_PDD2_SBROKENSUBMIT', 'Defekt: ');
define('_AM_PDD2_BROKEN_FILE', 'Als defekt gemelde Links');
define('_AM_PDD2_BROKEN_FILEIGNORED', 'Die Defektmeldung wurde ignoriert und erfolgreich aus der Datenbank entfernt!');
define('_AM_PDD2_BROKEN_NOWACK', 'Status *anerkannt* ge&auml;ndert und Datenbank aktualisiert!');
define('_AM_PDD2_BROKEN_NOWCON', 'Status wurde auf *in Bearbeitung* ge&auml;ndert, Sie werden nun zur Link-Bearbeitung weitergeleitet.');
define('_AM_PDD2_BROKEN_REPORTINFO', 'Defektmeldungen - Information');
define('_AM_PDD2_BROKEN_REPORTSNO', 'Wartende Defektmeldungen:');
define('_AM_PDD2_BROKEN_IGNOREDESC', '<b>Ignoriere</b> und lösche die Defektmeldung');
define('_AM_PDD2_BROKEN_DELETEDESC', '<b>L&ouml;sche</b> den gemeldeten Download und die Defektmeldung.');
define('_AM_PDD2_BROKEN_EDITDESC', '<b>Editiere</b> den Link um das Problem zu beheben.');
define('_AM_PDD2_BROKEN_ACKDESC', '<b>In Bearbeitung</b> - Dieser Link wurde bereits Bearbeitet aber noch nicht als funktionierend deklariert.');
define('_AM_PDD2_BROKEN_CONFIRMDESC', '<b>Best&auml;tigt</b> - Setzt den Status der Defektmeldung auf *best&auml;tigt*.');

define('_AM_PDD2_BROKEN_ID', 'ID');
define('_AM_PDD2_BROKEN_TITLE', 'Titel');
define('_AM_PDD2_BROKEN_REPORTER', 'Reporter');
define('_AM_PDD2_BROKEN_FILESUBMITTER', 'Eingesandt durch');
define('_AM_PDD2_BROKEN_DATESUBMITTED', '&Uuml;bermittelt am');
define('_AM_PDD2_BROKEN_ACTION', 'Aktion');
define('_AM_PDD2_BROKEN_NOFILEMATCH', 'Es exisitieren keine Defektmeldungen mit den gew&auml;hlten Kriterien');
define('_AM_PDD2_BROKENFILEDELETED', 'Link und Defektmeldung aus der Datenbank entfernt');

/*
* About defines
*/
define('_AM_PDD2_BY', 'by');

//block defines
define('_AM_PDD2_BADMIN', 'Block Administration');
define('_AM_PDD2_BLKDESC', 'Beschreibung');
define('_AM_PDD2_TITLE', 'Titel');
define('_AM_PDD2_SIDE', 'Ausrichtung');
define('_AM_PDD2_WEIGHT', 'Gewichtung');
define('_AM_PDD2_VISIBLE', 'Sichtbarkeit');
define('_AM_PDD2_ACTION', 'Aktion');
define('_AM_PDD2_SBLEFT', 'Links');
define('_AM_PDD2_SBRIGHT', 'Rechts');
define('_AM_PDD2_CBLEFT', 'Center links');
define('_AM_PDD2_CBRIGHT', 'Center Rechts');
define('_AM_PDD2_CBCENTER', 'Center Mitte');
define('_AM_PDD2_ACTIVERIGHTS', 'Active Berechtigungen');
define('_AM_PDD2_ACCESSRIGHTS', 'Zugriffs Berechtigungen');

//image admin icon
define('_AM_PDD2_ICO_EDIT', 'Objekt editieren');
define('_AM_PDD2_ICO_DELETE', 'Objekt l&ouml;schen');
define('_AM_PDD2_ICO_ONLINE', 'Online');
define('_AM_PDD2_ICO_OFFLINE', 'Offline');
define('_AM_PDD2_ICO_APPROVED', 'Best&auml;tigt');
define('_AM_PDD2_ICO_NOTAPPROVED', 'Nicht best&auml;tigen');

define('_AM_PDD2_ICO_LINK', 'Verwandte Links');
define('_AM_PDD2_ICO_URL', 'Verwandten URL hinzuf&uuml;gen');
define('_AM_PDD2_ICO_ADD', 'Hinzuf&uuml;gen');
define('_AM_PDD2_ICO_APPROVE', 'Best&auml;tigung');
define('_AM_PDD2_ICO_STATS', 'Statistiken');

define('_AM_PDD2_ICO_IGNORE', 'Ignorieren');
define('_AM_PDD2_ICO_ACK', 'Anerkannte Defektmeldungen');
define('_AM_PDD2_ICO_REPORT', 'Defektmeldung anerkennen?');
define('_AM_PDD2_ICO_CONFIRM', 'Defektmeldung best&auml;tigt');
define('_AM_PDD2_ICO_CONBROKEN', 'Defektmeldung best&auml;tigen?');
