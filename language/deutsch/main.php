<?php
/**
 * $Id: main.php v 1.22 02 july 2004 Liquid Exp $
 * Module: PD-links
 * Version: v1.0
 * Release Date: 04. März 2005
 * Author: Power-Dreams Team
 * Licence: GNU
 */

//Todo - Still to remove redundat defines from this area.
define('_MD_PDD2_NOlink', 'Der Link existiert nicht!');

define('_MD_PDD2_SUBCATLISTING', 'Unterkategorie(n)');
define('_MD_PDD2_ISADMINNOTICE', 'Webmaster: Mit diesem Bild gibt es ein Problem.');
define('_MD_PDD2_THANKSFORINFO', 'Danke f&uuml;r die &Uuml;bermittlung. Du wirst informiert, sobald Deine Einsendung vom Webmaster freigegeben wurde.');
define('_MD_PDD2_ISAPPROVED', 'Danke f&uuml;r die &Uuml;bermittlung. Deine Einsendung wurde &uuml;berpr&uuml;ft, freigegeben und wird ab jetzt gelistet.');
define('_MD_PDD2_THANKSFORHELP', 'Vielen Dank f&uuml;r die Hilfe, diese Liste aktuell zu halten.');
define('_MD_PDD2_FORSECURITY', 'Aus Sicherheitsgr&uuml;nden werden Username und IP-Adresse tempor&auml;r gespeichert.');
define(
    '_MD_PDD2_NOPERMISETOlink',
    'Dieser Link geh&ouml;rt nicht zu der Seite von der Du kommst <br><br>Bitte nimm kontakt mit dem dortigen Webmaster auf und teile ihm mit, dass:   <br><b>ER KEINE links UNSERER SITE LEECHEN SOLL!!</b> <br><br><b>Definition eines Leechers:</b> Jemand der zu faul ist von seinem eigenen Server aus zu verlinken, oder einfach nur die Arbeit anderer als seine eigene ausgibt<br><br>  Deine IP Adresse <b>wurde gespeichert</b>.'
);
define('_MD_PDD2_DESCRIPTION', 'Beschreibung');
define('_MD_PDD2_SUBMITCATHEAD', 'Formular: Neuen Link einsenden');
define('_MD_PDD2_MAIN', 'Index');
define('_MD_PDD2_POPULAR', 'Popul&auml;r');
define('_MD_PDD2_NEWTHISWEEK', 'Neu diese Woche');
define('_MD_PDD2_UPTHISWEEK', 'Aktualisiert diese Woche');
define('_MD_PDD2_POPULARITYLTOM', 'Popularit&auml;t (geringste bis h&aouml;chste Anzahl Hits)');
define('_MD_PDD2_POPULARITYMTOL', 'Popularit&auml;t (h&aouml;chste bis geringste Anzahl Hits)');
define('_MD_PDD2_TITLEATOZ', 'Titel (A bis Z)');
define('_MD_PDD2_TITLEZTOA', 'Titel (Z bis A)');
define('_MD_PDD2_DATEOLD', 'Datum (&auml;ltere zuerst)');
define('_MD_PDD2_DATENEW', 'Datum (neuere zuerst)');
define('_MD_PDD2_RATINGLTOH', 'Bewertung (niedrigster bis h&ouml;chster Score)');
define('_MD_PDD2_RATINGHTOL', 'Bewertung (h&ouml;chster bis niedrigster Score)');
define('_MD_PDD2_DESCRIPTIONC', 'Beschreibung: ');
define('_MD_PDD2_CATEGORYC', 'Kategorie: ');
define('_MD_PDD2_SUBMITDATE', 'Ver&ouml;ffentlicht');
define('_MD_PDD2_DLTIMES', '%s mal gedwonloadet');
define('_MD_PDD2_FILESIZE', 'Dateigr&ouml;&szlig;e');
define('_MD_PDD2_HOMEPAGE', 'Homepage');
define('_MD_PDD2_PUBLISHERC', 'Publisher: ');
define('_MD_PDD2_RATINGC', 'Bewertung: ');
define('_MD_PDD2_ONEVOTE', '1 Wertung');
define('_MD_PDD2_NUMVOTES', '%s Wertungen');
define('_MD_PDD2_RATETHISFILE', 'Bewerten');
define('_MD_PDD2_REVIEWTHISFILE', 'Kritik schreiben');
define('_MD_PDD2_REVIEWS', 'Rezensionen:');
define('_MD_PDD2_linkHITS', 'Aufrufe: ');
define('_MD_PDD2_MODIFY', 'Modifizieren');
define('_MD_PDD2_REPORTBROKEN', 'Link als defekt melden');
define('_MD_PDD2_BROKENREPORT', 'Defekten Link melden');
define('_MD_PDD2_SUBMITBROKEN', 'Einsenden');
define('_MD_PDD2_BEFORESUBMIT', 'Bevor ein Link als defekt gemeldet wird sollte bitte &uuml;berpr&uuml;ft werden, ob der gewünschte Link wirklich nicht mehr verf&uuml;gbar, oder die entsprechende Seite nur tempor&auml;r offline ist.');
define('_MD_PDD2_TELLAFRIEND', 'Empfehlen');
define('_MD_PDD2_EDIT', 'Editieren');
define('_MD_PDD2_THEREARE', 'Es gibt <b>%s</b> <i>Kategorien</i> und <b>%s</b> <i>Links</i>');
define('_MD_PDD2_THEREIS', 'Es gibt <b>%s</b> <i>Kategorie</i> und <b>%s</b> <i>Links</i>');
define('_MD_PDD2_LATESTLIST', 'Aktuellste Links');
define('_MD_PDD2_FILETITLE', 'Link-Title: ');
define('_MD_PDD2_DLURL', 'Link-URL: ');
define('_MD_PDD2_FILESIZEC', 'Dateigr&ouml;&szlig;e: ');
define('_MD_PDD2_NUMBYTES', '%s Bytes');
define('_MD_PDD2_PUBLISHER', 'Veröffentlicht von');
define('_MD_PDD2_UPDATEDON', 'Aktualisiert am');
define('_MD_PDD2_VIEWDETAILS', 'Alle Details anzeigen');
define('_MD_PDD2_OPTIONS', 'Optionen: ');
define('_MD_PDD2_NOTIFYAPPROVE', 'Benachrichtigen wenn dieser Link freigegeben wird');
define('_MD_PDD2_VOTEAPPRE', 'Deine Bewertung ist willkommen.');
define('_MD_PDD2_THANKYOU', 'Danke dass Du Dir die Zeit nimmst auf %s abzustimmen'); // %s is your site name
define('_MD_PDD2_VOTEONCE', 'Bitte nicht mehrfach f&uuml;r die gleiche Ressource abstimmen.');
define('_MD_PDD2_RATINGSCALE', 'Die Skala reicht von 1 - 10, wobei 1 sehr schlecht und 10 sehr gut ist.');
define('_MD_PDD2_BEOBJECTIVE', 'Bitte sei objektiv. Wenn jeder nur mit 1 oder 10 abstimmt, ist die Bewertung nicht sehr hilfreich.');
define('_MD_PDD2_NOTSPECIFIED', 'Nicht angegeben');
define('_MD_PDD2_DONOTVOTE', 'Bitte keine eigenen Ressourcen bewerten.');
define('_MD_PDD2_RATEIT', 'Bewerten!');
define('_MD_PDD2_INTFILEFOUND', 'Auf %s gibt es einen interessanten Link'); // %s is your site name
define('_MD_PDD2_RANK', 'Rank');
define('_MD_PDD2_CATEGORY', 'Kategorie');
define('_MD_PDD2_HITS', 'Hits');
define('_MD_PDD2_RATING', 'Bewertung');
define('_MD_PDD2_VOTE', 'Wertungen');
define('_MD_PDD2_SORTBY', 'Sortieren nach:');
define('_MD_PDD2_TITLE', 'Titel');
define('_MD_PDD2_DATE', 'Datum');
define('_MD_PDD2_POPULARITY', 'Popularit&auml;t');
define('_MD_PDD2_TOPRATED', 'Bewertung');
define('_MD_PDD2_CURSORTBY', 'Dateien werden im Moment nach %s sortiert');
define('_MD_PDD2_CANCEL', 'Abbrechen');
define('_MD_PDD2_ALREADYREPORTED', 'Du hast diesen Link bereits als defekt gemeldet.');
define('_MD_PDD2_MUSTREGFIRST', 'Leider hast Du nicht die Berechtigung f&uuml;r diese Aktion.<br>Bitte zun&auml;chst registrieren oder anmelden!');
define('_MD_PDD2_NORATING', 'Keine Bewertung ausgew&auml;hlt.');
define('_MD_PDD2_CANTVOTEOWN', 'Du darfst f&uuml;r den Link den Du eingesendet hast nicht abstimmen.<br>Alle Stimmen werden geloggt und &uuml;berpr&uuml;ft.');
define('_MD_PDD2_SUBMITlink', 'Link einsenden');
define(
    '_MD_PDD2_SUB_SNEWMNAMEDESC',
    '<ul><li>Alle neuen Links werden zun&auml;chst verifiziert. Es kann daher bis zu 24 Stunden dauern, ehe sie in unserem Listing erscheinen.</li><li>Wir behalten uns das Recht vor, eingesendete Links abzulehnen oder ohne Nachfrage die Informationen zu modifizieren.</li></ul>'
);
define('_MD_PDD2_MAINLISTING', 'Hauptindex');
define('_MD_PDD2_LASTWEEK', 'Letzte Woche');
define('_MD_PDD2_LAST30DAYS', 'Letzten 30 Tage');
define('_MD_PDD2_1WEEK', '1 Woche');
define('_MD_PDD2_2WEEKS', '2 Wochen');
define('_MD_PDD2_30DAYS', '30 Tage');
define('_MD_PDD2_SHOW', 'Zeigen');
define('_MD_PDD2_DAYS', 'Tage');
define('_MD_PDD2_NEWlinks', 'Neue Links');
define('_MD_PDD2_TOTALNEWlinks', 'Neue Links insgesamt');
define('_MD_PDD2_DTOTALFORLAST', 'Neueste Links der letzten Zeit');
define('_MD_PDD2_AGREE', 'Ich stimme zu');
define('_MD_PDD2_DOYOUAGREE', 'Mit den Bestimmungen einverstanden?');
define('_MD_PDD2_DISCLAIMERAGREEMENT', 'Bestimmungen (Disclaimer)');
define('_MD_PDD2_DUPLOADSCRSHOT', 'Screenshot hochladen:');
define('_MD_PDD2_RESOURCEID', 'Ressource id#: ');
define('_MD_PDD2_REPORTER', 'Original Reporter: ');
define('_MD_PDD2_DATEREPORTED', 'Gemeldet am: ');
define('_MD_PDD2_RESOURCEREPORTED', 'Als defekt gemeldeter Link');
define('_MD_PDD2_RESOURCEREPORTED2', 'Dieser Link wurde bereits als defekt gemeldet und wird demnächst gefixt');
define('_MD_PDD2_BROWSETOTOPIC', '<b>Links in alphabetischer Reihenfolge durchuchen</b>');
define('_MD_PDD2_WEBMASTERACKNOW', 'Annerkannte Defektmeldungen: ');
define('_MD_PDD2_WEBMASTERCONFIRM', 'Best&auml;tigte Defektmeldungen: ');
define('_MD_PDD2_DELETE', 'L&ouml;schen');
define('_MD_PDD2_DISPLAYING', 'Dargestellt: ');
define('_MD_PDD2_LEGENDTEXTNEW', 'Heute neu');
define('_MD_PDD2_LEGENDTEXTNEWTHREE', 'letzten 3 Tage');
define('_MD_PDD2_LEGENDTEXTTHISWEEK', 'diese Wochen');
define('_MD_PDD2_LEGENDTEXTNEWLAST', '&auml;lter als 1 Woche');
define('_MD_PDD2_THISFILEDOESNOTEXIST', 'Fehler: Die Datei existiert nicht!');
define('_MD_PDD2_BROKENREPORTED', 'Defekten Link gemeldet');

define('_MD_PDD2_HOMEPAGETITLEC', 'Homepage Titel: ');
define('_MD_PDD2_SCREENSHOT', 'Screenshot:');
define('_MD_PDD2_SCREENSHOTCLICK', 'Vollbildanzeige');
define('_MD_PDD2_OTHERBYUID', 'Andere Links von: ');
define('_MD_PDD2_MAINTOTAL', 'Links gesamt: ');
define('_MD_PDD2_linkNOW', 'Jetzt aufrufen');
define('_MD_PDD2_PAGES', 'Seiten');
define('_MD_PDD2_SUBMITTER', 'Eingesendet von');
define('_MD_PDD2_ERROR', 'Datenbankupdate-Fehler: Information konnte nicht gesichert werden');
define('_MD_PDD2_COPYRIGHT', 'Copyright');
define('_MD_PDD2_INFORUM', 'Im Forum diskutieren');

//submit.php
define('_MD_PDD2_NOTALLOWESTOSUBMIT', 'Keine Berechtigung zum &Uuml;bertragen von Dateien');
define('_MD_PDD2_INFONOSAVEDB', 'Information wurde nicht in die Datenbank &uuml;bernommen: <br><br>');

define('_MD_PDD2_NEWLAST', 'Neu eingegangen vor der letzten Woche');
define('_MD_PDD2_NEWTHIS', 'Neu eingegangen diese Woche');
define('_MD_PDD2_THREE', 'Neu eingegenagen innerhalb der letzten drei Tage');
define('_MD_PDD2_TODAY', 'Heute neu eingegangen');
define('_MD_PDD2_NO_FILES', 'Noch keine Dateien');
