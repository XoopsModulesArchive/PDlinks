<?php
/**
 * $Id: visit.php v 1.02 06 july 2004 Liquid Exp $
 * Module: PD-Links
 * Version: v1.0
 * Release Date: 04. März 2005
 * Author: Power-Dreams Team
 * Licence: GNU
 */
require __DIR__ . '/header.php';

global $xoopsModuleConfig, $myts;

$agreed = (isset($_GET['agree'])) ? $_GET['agree'] : 0;

$lid = intval($_GET['lid']);
$cid = intval($_GET['cid']);

if (0 == $agreed) {
    if ($xoopsModuleConfig['check_host']) {
        $goodhost = 1;
        break;
    }
}

if ($xoopsModuleConfig['showlinkdisclaimer'] && 0 == $agreed) {
    echo "
		<div align='center'>" . PDd_imageheader() . "</div>\n
		<h4>" . _MD_PDD2_DISCLAIMERAGREEMENT . "</h4>\n
		<div>" . $myts->displayTarea($xoopsModuleConfig['linkdisclaimer'], 0, 1, 1, 1, 1) . "</div><br>\n
		<form action='visit.php' method='post'>\n
		<div align='center'><b>" . _MD_PDD2_DOYOUAGREE . "</b><br><br>\n
		<input type='button' onclick='location=\"visit.php?agree=1&lid=$lid&cid=$cid\"' class='formButton' value='" . _MD_PDD2_AGREE . "' alt='" . _MD_PDD2_AGREE . "'>\n
		&nbsp;\n
		<input type='button' onclick='location=\"index.php\"' class='formButton' value='" . _CANCEL . "' alt='" . _CANCEL . "'>\n
		<input type='hidden' name='lid' value='1'>\n
		<input type='hidden' name='cid' value='1'>\n
		</div></form>\n";
    exit();
}
    $isadmin = (!empty($xoopsUser) && $xoopsUser->isAdmin($xoopsModule->mid())) ? true : false;
    $sql = sprintf('UPDATE ' . $xoopsDB->prefix('PDlinks_links') . " SET hits = hits+1 WHERE lid =$lid");
    $xoopsDB->queryF($sql);
    $result = $xoopsDB->query('SELECT url FROM ' . $xoopsDB->prefix('PDlinks_links') . " WHERE lid=$lid");
    [$url] = $xoopsDB->fetchRow($result);
    $url = htmlspecialchars(preg_replace('/javascript:/si', 'java script:', $url), ENT_QUOTES);

    if (!empty($url)) {
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        // HTTP/1.0
        header('Pragma: no-cache');
        // Date in the past
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        // always modified
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header("Refresh: 0; url=$url");
    } else {
        echo "<br><div align='center'>" . PDd_imageheader() . '</div>';
        reportBroken($lid);
    }
