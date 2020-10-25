<?php
/**
 * $Id: main.php v 1.15 02 july 2004 Liquid Exp $
 * Module: PD-links
 * Version: v1.0
 * Release Date: 04. März 2005
 * Author: Power-Dreams Team
 * Licence: GNU
 */

// Module Info
// The name of this module
define('_MI_PDD2_NAME', 'PD-Links');

// A brief description of this module
define('_MI_PDD2_DESC', 'Erstellt eine Link-Sektion in der User Links, Bewerten und &Uuml;bertragen k&ouml;nnen.');

// Names of blocks for this module (Not all module has blocks)
define('_MI_PDD2_BNAME1', 'Aktuelle Links');
define('_MI_PDD2_BNAME2', 'Top Links');

// Sub menu titles
define('_MI_PDD2_SMNAME1', 'Einsenden');
define('_MI_PDD2_SMNAME2', 'Popul&auml;r');
define('_MI_PDD2_SMNAME3', 'Best bewertet');

// Names of admin menu items
define('_MI_PDD2_BINDEX', 'Hauptindex');
define('_MI_PDD2_INDEXPAGE', 'Index Seitenverwaltung');
define('_MI_PDD2_MCATEGORY', 'Kategorieverwaltung');
define('_MI_PDD2_Mlinks', 'Dateiverwaltung');
define('_MI_PDD2_MUPLOADS', 'Bild-Hochladen');
define('_MI_PDD2_PERMISSIONS', 'Berechtigungseinstellungen');
define('_MI_PDD2_BLOCKADMIN', 'Block Einstellungen');
define('_MI_PDD2_MVOTEDATA', 'Bewertungen');

// Title of config items
define('_MI_PDD2_POPULAR', 'Popularit&auml;tsz&auml;hler');
define('_MI_PDD2_POPULARDSC', 'Anzahl an Aufrufe, bevor eine Link als popul&auml;r gilt');

//Display Icons
define('_MI_PDD2_ICONDISPLAY', 'Popul&auml;re und Neue Links:');
define('_MI_PDD2_DISPLAYICONDSC', 'Wie sollen popul&auml;re und neue Links markiert werden.');
define('_MI_PDD2_DISPLAYICON1', 'Zeige als Icon');
define('_MI_PDD2_DISPLAYICON2', 'Zeige als Text');
define('_MI_PDD2_DISPLAYICON3', 'Nicht zeigen');

define('_MI_PDD2_DAYSNEW', 'Dauer Status <b>NEU</b> in Tagen:');
define('_MI_PDD2_DAYSNEWDSC', 'Anzahl an Tagen, die ein link als <b>NEU</b> markiert bleibt.');
define('_MI_PDD2_DAYSUPDATED', 'Dauer Status <b>UPDATE</b> in Tagen:');
define('_MI_PDD2_DAYSUPDATEDDSC', 'Anzahl an Tagen, die ein Link als <b>UPDATE</b> markiert bleibt.');

define('_MI_PDD2_PERPAGE', 'Anzahl von Links pro Seite');
define('_MI_PDD2_PERPAGEDSC', 'Maximale Anzahl von Links die auf jeder Seite dargestellt werden');

define('_MI_PDD2_USESHOTS', 'Screenshots anzeigen?');
define('_MI_PDD2_USESHOTSDSC', 'W&auml;hle <b>Ja</b> um Screenshots f&uuml;r jeden Link anzuzeigen');
define('_MI_PDD2_SHOTWIDTH', 'Bildattribut *width* [in px]');
define('_MI_PDD2_SHOTWIDTHDSC', 'Maximale Breite (width) des Screenshot/Thumbnails');
define('_MI_PDD2_SHOTHEIGHT', 'Bildattribut *height* [in px]');
define('_MI_PDD2_SHOTHEIGHTDSC', 'Maximale H&ouml;he (height) des Screenshot/Thumbnails');
define('_MI_PDD2_CHECKHOST', 'Unterbinde direkte Verlinkung? (leeching)');
define('_MI_PDD2_REFERERS', 'Folgende Seite darf direkt linken<br>Separiert mit #');
define('_MI_PDD2_ANONPOST', 'Anonyme Einsendungen:');
define('_MI_PDD2_ANONPOSTDSC', 'Anonymen Usern erlauben, links zu posten?');
define('_MI_PDD2_AUTOAPPROVE', 'Automatische Linkfreigabe');
define('_MI_PDD2_AUTOAPPROVEDSC', 'Neue Links ohne (Admin-)&Uuml;berpr&uuml;fung in die Datenbank &uuml;bernehmen?');

define('_MI_PDD2_MAXFILESIZE', 'Maximale Uploadgr&auml;&szlig;e [in KB]');
define('_MI_PDD2_MAXFILESIZEDSC', 'Maximale Dateigr&ouml;&szlig;e die per Upload m&ouml;glich sein soll.');
define('_MI_PDD2_IMGWIDTH', 'Maximale Breite von Bildern');
define('_MI_PDD2_IMGWIDTHDSC', 'Maximal erlaubte Breite (width) eines Bildes, dass hochgeladen werden darf');
define('_MI_PDD2_IMGHEIGHT', 'Maximale H&ouml;he von Bildern');
define('_MI_PDD2_IMGHEIGHTDSC', 'Maximal erlaubte H&ouml;he (height) eines Bildes, dass hochgeladen werden darf');

define('_MI_PDD2_UPLOADDIR', 'Uploadverzeichnis (Kein Trailingslash)');
define('_MI_PDD2_ALLOWSUBMISS', 'User Einsendungen:');
define('_MI_PDD2_ALLOWSUBMISSDSC', 'User d&uuml;rfen Links &uuml;bermitteln?');
define('_MI_PDD2_ALLOWUPLOADS', 'User Uploads:');
define('_MI_PDD2_ALLOWUPLOADSDSC', 'User d&uuml;rfen links uploaden?');
define('_MI_PDD2_SCREENSHOTS', 'Uploadverzeichnis f&uuml;r Screenshots');
define('_MI_PDD2_CATEGORYIMG', 'Uploadverzeichnis f&uuml;r Kategoriebilder');
define('_MI_PDD2_MAINIMGDIR', 'Hauptbilderverzeichnis');
define('_MI_PDD2_USETHUMBS', 'Thumbnails:');
define('_MI_PDD2_USETHUMBSDSC', 'Unterst&uuml;tzte Dateitypen: <b>JPG, GIF, PNG</b>.<br><br>Zu den links geh&ouml;rende Bilder werden als Thumbnails dargestellt. Falls der Server das Resizen von Bildern nicht unterst&uuml;tzt, sollte dieser Wert auf <b>\'Nein\'</b> gesetzt werden.');
define('_MI_PDD2_DATEFORMAT', 'Datumsformat/Zeitstempel:');
define('_MI_PDD2_DATEFORMATDSC', 'W&auml;hle Datumformat f&uuml;r PD-Links:');
define('_MI_PDD2_SHOWDISCLAIMER', 'Einsendungsbestimmungen (Disclaimer)');
define('_MI_PDD2_SHOWDISCLAIMERDSC', 'Zeige die Einsendungsbestimmungen bevor ein User einen Link übermittelt?');
define('_MI_PDD2_SHOWlinkDISCL', 'Linkbestimmungen (Disclaimer)');
define('_MI_PDD2_SHOWlinkDISCLDSC', 'Zeige Linkbestimmungen vor dem Aufruf?');
define('_MI_PDD2_DISCLAIMER', 'Disclaimertext f&uuml;r &Uuml;bertragung eingeben:');
define('_MI_PDD2_linkDISCLAIMER', 'Disclaimertext f&uuml;r den Link eingeben:');
define('_MI_PDD2_SUBCATS', 'Unterkategorien:');

define('_MI_PDD2_SUBMITART', 'Link Einsendungen:');
define('_MI_PDD2_SUBMITARTDSC', 'Gruppe ausw&auml;hlen, die neue Links &uuml;bermitteln darf:');

define('_MI_PDD2_IMGUPDATE', 'Update Thumbnails?');
define('_MI_PDD2_IMGUPDATEDSC', 'Thumbnails bei jedem Seitenaufruf aktualisieren. Anderenfalls wird immer das erste &uuml;bermittelte (gecachte) Thumbnail verwendet.<br><br>');
define('_MI_PDD2_QUALITY', 'Thumbnail Qualit&auml;t: ');
define('_MI_PDD2_QUALITYDSC', 'Niedrigste:0 H&ouml;chste:100');
define('_MI_PDD2_KEEPASPECT', 'Seitenverh&auml;ltnis (Ratio)');
define('_MI_PDD2_KEEPASPECTDSC', 'Seitenverh&auml;ltnis (Ratio) der Bilder beibehalten?');
define('_MI_PDD2_ADMINPAGE', 'Anzahl darzustellender Links im Adminbereich:');
define('_MI_PDD2_AMDMINPAGEDSC', 'Anzahl der neuen Links die im Adminbereich dargestellt werden.');
define('_MI_PDD2_ARTICLESSORT', 'Darstellung der Links, sortiert nach:');
define('_MI_PDD2_ARTICLESSORTDSC', 'Select the default order for the link listings.');
define('_MI_PDD2_TITLE', 'Titel');
define('_MI_PDD2_RATING', 'Bewertung');
define('_MI_PDD2_WEIGHT', 'Gewichtung');
define('_MI_PDD2_POPULARITY', 'Popularit&auml;t');
define('_MI_PDD2_SUBMITTED2', 'Einsendedatum');
define('_MI_PDD2_COPYRIGHT', 'Copyright anzeigen?');
define('_MI_PDD2_COPYRIGHTDSC', 'Copyright Statement auf der Linkseite anzeigen?');
// Description of each config items
define('_MI_PDD2_SUBCATSDSC', 'Ja ausw&auml;hlen, um Unterkategorien anzuzeigen. Falls \'Nein\' ausgew&auml;hlt wird, werden Unterkategorien nicht gelistet.');

// Text for notifications
define('_MI_PDD2_GLOBAL_NOTIFY', 'Global');
define('_MI_PDD2_GLOBAL_NOTIFYDSC', 'Globale Link-Benachrichtigungsoptionen.');

define('_MI_PDD2_CATEGORY_NOTIFY', 'Kategorie');
define('_MI_PDD2_CATEGORY_NOTIFYDSC', 'Benachrichtigungsoptionen der aktuellen Kategorie.');

define('_MI_PDD2_FILE_NOTIFY', 'Link');
define('_MI_PDD2_FILE_NOTIFYDSC', 'Benachrichtigungsoptionen des aktuellen Links.');

define('_MI_PDD2_GLOBAL_NEWCATEGORY_NOTIFY', 'Neue Kategorie');
define('_MI_PDD2_GLOBAL_NEWCATEGORY_NOTIFYCAP', 'Benachrichtigung wenn eine neue Kategorie angelegt wird.');
define('_MI_PDD2_GLOBAL_NEWCATEGORY_NOTIFYDSC', 'Benachrichtigung erhalten, wenn eine neue Kategorie angelegt wird.');
define('_MI_PDD2_GLOBAL_NEWCATEGORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Neue Kategorie wurde erstellt');

define('_MI_PDD2_GLOBAL_FILEMODIFY_NOTIFY', 'Link&auml;nderung angefragt');
define('_MI_PDD2_GLOBAL_FILEMODIFY_NOTIFYCAP', 'Benachrichtigung bei Link&auml;nderungsmeldung.');
define('_MI_PDD2_GLOBAL_FILEMODIFY_NOTIFYDSC', 'Benachrichtigung erhalten, wenn eine Link&auml;nderung gemeldet wird.');
define('_MI_PDD2_GLOBAL_FILEMODIFY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Link&auml;nderungsanfrage');

define('_MI_PDD2_GLOBAL_FILEBROKEN_NOTIFY', 'Defekter Link &uuml;bermittelt');
define('_MI_PDD2_GLOBAL_FILEBROKEN_NOTIFYCAP', 'Benachrichtigung bei gemeldeten defekten Links.');
define('_MI_PDD2_GLOBAL_FILEBROKEN_NOTIFYDSC', 'Benachrichtigung erhalten, wenn ein defekter Link gemeldet wird.');
define('_MI_PDD2_GLOBAL_FILEBROKEN_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Defekter Link &uuml;bermittelt');

define('_MI_PDD2_GLOBAL_FILESUBMIT_NOTIFY', 'Neue Link &uuml;bermittelt');
define('_MI_PDD2_GLOBAL_FILESUBMIT_NOTIFYCAP', 'Benachrichtigung bei (wartenden) neuen gemeldeten links.');
define('_MI_PDD2_GLOBAL_FILESUBMIT_NOTIFYDSC', 'Benachrichtigung erhalten, wenn (wartende) neue Links gemeldet werden.');
define('_MI_PDD2_GLOBAL_FILESUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Neuer Link &uuml;bermittelt');

define('_MI_PDD2_GLOBAL_NEPDILE_NOTIFY', 'Neuer Link');
define('_MI_PDD2_GLOBAL_NEPDILE_NOTIFYCAP', 'Benachrichtigung wenn ein neuer Link gemeldet wird.');
define('_MI_PDD2_GLOBAL_NEPDILE_NOTIFYDSC', 'Benachrichtigung erhalten, wenn ein neuer Link gemeldet wird.');
define('_MI_PDD2_GLOBAL_NEPDILE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Neuer Link');

define('_MI_PDD2_CATEGORY_FILESUBMIT_NOTIFY', 'Link in aktueller Kategorie gemeldet');
define('_MI_PDD2_CATEGORY_FILESUBMIT_NOTIFYCAP', 'Benachrichtigung bei (wartenden) neuen Links f&uuml;r die aktuelle Kategorie.');
define('_MI_PDD2_CATEGORY_FILESUBMIT_NOTIFYDSC', 'Benachrichtigung erhalten, wenn (wartende) neue Links f&uuml;r die aktuelle Kategorie gemeldet werden.');
define('_MI_PDD2_CATEGORY_FILESUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Link in aktueller Kategorie gemeldet');

define('_MI_PDD2_CATEGORY_NEPDILE_NOTIFY', 'Neuer Link in Kategorie');
define('_MI_PDD2_CATEGORY_NEPDILE_NOTIFYCAP', 'Benachrichtigung wenn ein neuer Link in die aktuelle Kategorie aufgenommen wird.');
define('_MI_PDD2_CATEGORY_NEPDILE_NOTIFYDSC', 'Benachrichtigung erhalten, wenn ein neuer Link in die aktuelle Kategorie aufgenommen wird.');
define('_MI_PDD2_CATEGORY_NEPDILE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Neuer Link in Kategorie');

define('_MI_PDD2_FILE_APPROVE_NOTIFY', 'Link freigegeben');
define('_MI_PDD2_FILE_APPROVE_NOTIFYCAP', 'Benachrichtigung wenn ein Link freigegeben wird.');
define('_MI_PDD2_FILE_APPROVE_NOTIFYDSC', 'Benachrichtigung erhalten, wenn der Link freigegeben wird.');
define('_MI_PDD2_FILE_APPROVE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Link freigegeben');

define('_MI_PDD2_AUTHOR_INFO', 'Entwickler Information');
define('_MI_PDD2_AUTHOR_NAME', 'Entwickler');
define('_MI_PDD2_AUTHOR_WEBSITE', 'Entwickler Website');
define('_MI_PDD2_AUTHOR_EMAIL', 'Entwickler-Email');
define('_MI_PDD2_AUTHOR_CREDITS', 'Credits');
define('_MI_PDD2_MODULE_DEVINFO', 'Module Development Information');
define('_MI_PDD2_MODULE_INFO', 'Module Information');
define('_MI_PDD2_MODULE_STATUS', 'Entwicklungsstatus');
define('_MI_PDD2_MODULE_DISCLAIMER', 'Disclaimer');
define('_MI_PDD2_RELEASE', 'Ver&ouml;ffentlichungsdatum: ');

define(
    '_MI_PDD2_WARNINGTEXT',
    'THE SOFTWARE IS PROVIDED BY Power-Dreams "AS IS" AND "WITH ALL FAULTS."
Power-Dreams MAKES NO REPRESENTATIONS OR WARRANTIES OF ANY KIND CONCERNING
THE QUALITY, SAFETY OR SUITABILITY OF THE SOFTWARE, EITHER EXPRESS OR
IMPLIED, INCLUDING WITHOUT LIMITATION ANY IMPLIED WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, OR NON-INFRINGEMENT.
FURTHER, ABLEMEDIA MAKES NO REPRESENTATIONS OR WARRANTIES AS TO THE TRUTH,
ACCURACY OR COMPLETENESS OF ANY STATEMENTS, INFORMATION OR MATERIALS
CONCERNING THE SOFTWARE THAT IS CONTAINED IN Power-Dreams WEBSITE. IN NO
EVENT WILL ABLEMEDIA BE LIABLE FOR ANY INDIRECT, PUNITIVE, SPECIAL,
INCIDENTAL OR CONSEQUENTIAL DAMAGES HOWEVER THEY MAY ARISE AND EVEN IF
Power-Dreams HAS BEEN PREVIOUSLY ADVISED OF THE POSSIBILITY OF SUCH DAMAGES..'
);

define(
    '_MI_PDD2_AUTHOR_CREDITSTEXT',
    'The Power-Dreams Team would like to thank the following people for their help and support during the development phase of this module:<br><br>
Frankblack, King76, baerchen, mcleines and all Beta-Testers from myXOOPS.de.'
);
define('_MI_PDD2_AUTHOR_BUGFIXES', 'Version History');
