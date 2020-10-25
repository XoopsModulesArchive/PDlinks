<?php

declare(strict_types=1);

/**
 * $Id: newlinks.php v 1.03 06 july 2004 Liquid Exp $
 * Module: PD-Links
 * Version: v1.0
 * Release Date: 04. März 2005
 * Author: Power-Dreams Team
 * Licence: GNU
 */
require __DIR__ . '/admin_header.php';

if (isset($_POST)) {
    foreach ($_POST as $k => $v) {
        $$k = $v;
    }
}

if (isset($_GET)) {
    foreach ($_GET as $k => $v) {
        $$k = $v;
    }
}

if (!isset($_POST['op'])) {
    $op = $_GET['op'] ?? 'main';
} else {
    $op = $_POST['op'];
}

switch ($op) {
    case 'approve':

        global $xoopsModule;

        $lid = $_GET['lid'];
        $result = $xoopsDB->query('SELECT cid, title, notifypub FROM ' . $xoopsDB->prefix('PDlinks_links') . ' WHERE lid=' . $lid . '');
        [$cid, $title, $notifypub] = $xoopsDB->fetchRow($result);
        /**
         * Update the database
         */
        $time = time();
        $publisher = $xoopsUser->getVar('uname');
        $xoopsDB->queryF('UPDATE ' . $xoopsDB->prefix('PDlinks_links') . " SET published = '$time.', status = '1', publisher = '$publisher' WHERE lid = " . $lid . '');

        $tags = [];
        $tags['FILE_NAME'] = $title;
        $tags['FILE_URL'] = XOOPS_URL . '/modules/PDlinks/singlefile.php?cid=' . $cid . '&lid=' . $lid;

        $sql = 'SELECT title FROM ' . $xoopsDB->prefix('PDlinks_cat') . ' WHERE cid=' . $cid;
        $result = $xoopsDB->query($sql);

        $row = $xoopsDB->fetchArray($result);
        $tags['CATEGORY_NAME'] = $row['title'];
        $tags['CATEGORY_URL'] = XOOPS_URL . '/modules/PDlinks/viewcat.php?cid=' . $cid;
        $notificationHandler = xoops_getHandler('notification');
        $notificationHandler->triggerEvent('global', 0, 'new_file', $tags);
        $notificationHandler->triggerEvent('category', $cid, 'new_file', $tags);

        if ($notifypub) {
            $notificationHandler->triggerEvent('file', $lid, 'approve', $tags);
        }
        redirect_header('newlinks.php', 1, _AM_PDD2_SUB_NEPDILECREATED);
        break;
    // List links waiting for validation
    case 'main':
    default:

        require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
        global $xoopsDB, $myts, $xoopsModuleConfig, $imagearray;

        $start = isset($_GET['start']) ? intval($_GET['start']) : 0;

        $sql = 'SELECT * FROM ' . $xoopsDB->prefix('PDlinks_links') . ' WHERE published = 0 ORDER BY lid DESC';
        $new_array = $xoopsDB->query($sql, $xoopsModuleConfig['admin_perpage'], $start);
        $new_array_count = $xoopsDB->getRowsNum($xoopsDB->query($sql));

        xoops_cp_header();
        PDd_adminmenu(_AM_PDD2_SUB_SUBMITTEDFILES);

        echo "
		<fieldset><legend style='font-weight: bold; color: #900;'>" . _AM_PDD2_SUB_FILESWAITINGINFO . "</legend>\n
		<div style='padding: 8px;'>" . _AM_PDD2_SUB_FILESWAITINGVALIDATION . "&nbsp;<b>$new_array_count</b><div>\n
		<div div style='padding: 8px;'>\n
		<li>" . $imagearray['approve'] . ' ' . _AM_PDD2_SUB_APPROVEWAITINGFILE . "\n
		<li>" . $imagearray['editimg'] . ' ' . _AM_PDD2_SUB_EDITWAITINGFILE . "\n
		<li>" . $imagearray['deleteimg'] . ' ' . _AM_PDD2_SUB_DELETEWAITINGFILE . "</div>\n
		</fieldset><br>\n

		<table width='100%' cellspacing='1' cellpadding='3' border='0' class='outer'>\n
		<tr>\n
		<td class='bg3' align='center' width = '3%'><b>" . _AM_PDD2_MINDEX_ID . "</b></td>\n
		<td class='bg3' width = '30%'><b>" . _AM_PDD2_MINDEX_TITLE . "</b></td>\n
		<td class='bg3' align='center' width = '15%'><b>" . _AM_PDD2_MINDEX_POSTER . "</b></td>\n
		<td class='bg3' align='center' width = '15%'><b>" . _AM_PDD2_MINDEX_SUBMITTED . "</b></td>\n
		<td class='bg3' align='center' width = '7%'><b>" . _AM_PDD2_MINDEX_ACTION . "</b></td>\n
		</tr>\n";
        if ($new_array_count > 0) {
            while (false !== ($new = $xoopsDB->fetchArray($new_array))) {
                $rating = number_format($new['rating'], 2);
                $title = htmlspecialchars($new['title']);
                $url = htmlspecialchars($new['url']);
                $url = urldecode($url);
                $logourl = htmlspecialchars($new['screenshot']);
                $submitter = XoopsUserUtility::getUnameFromId($new['submitter']);
                $datetime = formatTimestamp($new['date'], $xoopsModuleConfig['dateformat']);
                $status = ($new['published']) ? $approved : "<a href='newlinks.php?op=approve&lid=" . $new['lid'] . "'>" . $imagearray['approve'] . '</a>';
                $modify = "<a href='index.php?op=linkload&lid=" . $new['lid'] . "'>" . $imagearray['editimg'] . '</a>';
                $delete = "<a href='index.php?op=dellinkload&lid=" . $new['lid'] . "'>" . $imagearray['deleteimg'] . '</a>';

                echo "
		<tr>\n
		<td class='head' align='center'>" . $new['lid'] . "</td>\n
		<td class='even' nowrap><a href='newlinks.php?op=edit&lid=" . $new['lid'] . "'>" . $title . "</a></td>\n
		<td class='even' align='center' nowrap>$submitter</td>\n
		<td class='even' align='center'>" . $datetime . "</td>\n
		<td class='even' align='center' nowrap>$status $modify $delete</td>\n
		</tr>\n";
            }
        } else {
            echo "<tr ><td align='center' class='head' colspan='6'>" . _AM_PDD2_SUB_NOFILESWAITING . '</td></tr>';
        }
        echo "</table>\n";
        require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
        $page = ($new_array_count > $xoopsModuleConfig['admin_perpage']) ? _AM_PDD2_MINDEX_PAGE : '';
        $pagenav = new XoopsPageNav($new_array_count, $xoopsModuleConfig['admin_perpage'], $start, 'start');
        echo '<div align="right" style="padding: 8px;">' . $page . '' . $pagenav->renderNav() . '</div>';
        xoops_cp_footer();
        break;
}
