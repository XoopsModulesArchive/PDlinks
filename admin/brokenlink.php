<?php

declare(strict_types=1);

/**
 * $Id: brokenlink.php v 1.03 06 july 2004 Liquid Exp $
 * Module: PD-Links
 * Version: v1.0
 * Release Date: 04. März 2005
 * Author: Power-Dreams Team
 * Licence: GNU
 */
require __DIR__ . '/admin_header.php';

$op = '';

if (!isset($_POST['op'])) {
    $op = $_GET['op'] ?? 'listBrokenlinks';
} else {
    $op = $_POST['op'];
}

$lid = (isset($_GET['lid'])) ? $_GET['lid'] : 0;

switch ($op) {
    case 'updateNotice':
        global $xoopsDB;

        if (isset($_GET['con'])) {
            $confirmed = (isset($_GET['con']) && 0 == $_GET['con']) ? 1 : 1;
            $xoopsDB->queryF(
                'UPDATE ' . $xoopsDB->prefix('PDlinks_broken') . " SET confirmed = '$confirmed' 
			WHERE lid='$lid'"
            );
            $update_mess = _AM_PDD2_BROKEN_NOWCON;
        }
        redirect_header("index.php?op=linkload&lid=$lid", 3, _AM_PDD2_BROKEN_NOWCON);
        break;
    case 'delBrokenlinks':
        global $xoopsDB;

        $xoopsDB->queryF('DELETE FROM ' . $xoopsDB->prefix('PDlinks_broken') . " WHERE lid = '$lid'");
        $xoopsDB->queryF('DELETE FROM ' . $xoopsDB->prefix('PDlinks_links') . " WHERE lid = '$lid'");
        redirect_header('brokenlink.php?op=default', 1, _AM_PDD2_BROKENFILEDELETED);
        exit();
        break;
    case 'ignoreBrokenlinks':
        global $xoopsDB;

        $xoopsDB->queryF('DELETE FROM ' . $xoopsDB->prefix('PDlinks_broken') . " WHERE lid = '$lid'");
        redirect_header('brokenlink.php?op=default', 1, _AM_PDD2_BROKEN_FILEIGNORED);
        break;
    case 'listBrokenlinks':
    case 'default':

        global $xoopsDB, $imagearray, $xoopsModule;
        $result = $xoopsDB->query('SELECT * FROM ' . $xoopsDB->prefix('PDlinks_broken') . ' ORDER BY reportid');
        $totalbrokenlinks = $xoopsDB->getRowsNum($result);

        xoops_cp_header();

        PDd_adminmenu(_AM_PDD2_BROKEN_FILE);

        echo "
		<fieldset><legend style='font-weight: bold; color: #900;'>" . _AM_PDD2_BROKEN_REPORTINFO . "</legend>\n
		<div style='padding: 8px;'>" . _AM_PDD2_BROKEN_REPORTSNO . "&nbsp;<b>$totalbrokenlinks</b><div>\n
		<div style='padding: 8px;'>\n
		<ul><li>" . $imagearray['ignore'] . ' ' . _AM_PDD2_BROKEN_IGNOREDESC . "</li>\n
		<li>" . $imagearray['editimg'] . ' ' . _AM_PDD2_BROKEN_EDITDESC . '</li>
		<li>' . $imagearray['deleteimg'] . ' ' . _AM_PDD2_BROKEN_DELETEDESC . "</li>\n
		<li>" . $imagearray['ack_yes'] . ' ' . _AM_PDD2_BROKEN_ACKDESC . "</li>
		</ul></div>\n
		</fieldset><br>\n

		<table width='100%' border='0' cellspacing='1' cellpadding = '2' class='outer'>\n
		<tr align = 'center'>\n
		<th width = '3%' align = 'center'>" . _AM_PDD2_BROKEN_ID . "</th>\n
		<th width = '35%' align = 'left'>" . _AM_PDD2_BROKEN_TITLE . "</th>\n
		<th>" . _AM_PDD2_BROKEN_REPORTER . "</th>\n
		<th>" . _AM_PDD2_BROKEN_FILESUBMITTER . "</th>\n
		<th>" . _AM_PDD2_BROKEN_DATESUBMITTED . "</th>\n
		<th align='center'>" . _AM_PDD2_BROKEN_ACTION . "</th>\n
		</tr>\n
		";

        if (0 == $totalbrokenlinks) {
            echo "<tr align = 'center'><td align = 'center' class='head' colspan = '6'>" . _AM_PDD2_BROKEN_NOFILEMATCH . '</td></tr>';
        } else {
            while (list($reportid, $lid, $sender, $ip, $date, $confirmed, $acknowledged) = $xoopsDB->fetchRow($result)) {
                $result2 = $xoopsDB->query('SELECT cid, title, url, submitter FROM ' . $xoopsDB->prefix('PDlinks_links') . " WHERE lid=$lid");
                [$cid, $fileshowname, $url, $submitter] = $xoopsDB->fetchRow($result2);

                if (0 != $sender) {
                    $result3 = $xoopsDB->query('SELECT uname, email FROM ' . $xoopsDB->prefix('users') . ' WHERE uid=' . $sender . '');
                    [$sendername, $email] = $xoopsDB->fetchRow($result3);
                }

                $result4 = $xoopsDB->query('SELECT uname, email FROM ' . $xoopsDB->prefix('users') . ' WHERE uid=' . $sender . '');
                [$ownername, $owneremail] = $xoopsDB->fetchRow($result4);

                echo "
		<tr align = 'center'>\n
		<td class = 'head'>$reportid</td>\n
		<td class = 'even' align = 'left'><a href='" . XOOPS_URL . '/modules/PDlinks/singlefile.php?cid=' . $cid . '&lid=' . $lid . "' target='_blank'>" . $fileshowname . "</a></td>\n
		";
                if ('' == $email) {
                    echo "<td class = 'even'>$sendername ($ip)";
                } else {
                    echo "<td class = 'even'><a href='mailto:$email'>$sendername</a> ($ip)";
                }
                if ('' == $owneremail) {
                    echo "<td class = 'even'>$ownername";
                } else {
                    echo "<td class = 'even'><a href='mailto:$owneremail'>$ownername</a>";
                }
                echo "
		</td>\n
		<td class='even' align='center'>" . formatTimestamp($date, $xoopsModuleConfig['dateformat']) . "</td>\n
		<td align='center' class = 'even' nowrap>\n
		<a href='brokenlink.php?op=ignoreBrokenlinks&lid=$lid'>" . $imagearray['ignore'] . "</a>\n";
                $con_image = ($confirmed) ? $imagearray['con_yes'] : $imagearray['con_no'];
                echo "
		<a href='brokenlink.php?op=updateNotice&lid=$lid&con=$confirmed'> " . $imagearray['editimg'] . " </a>\n
		<a href='brokenlink.php?op=delBrokenlinks&lid=$lid'>" . $imagearray['deleteimg'] . "</a>\n
		" . $con_image . "</td></tr>\n";
            }
        }
        echo '</table>';
}
xoops_cp_footer();
