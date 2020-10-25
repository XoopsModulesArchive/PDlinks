<?php
/**
 * $Id: newlist.php v 1.03 06 july 2004 Liquid Exp $
 * Module: PD-Links
 * Version: v1.0
 * Release Date: 04. März 2005
 * Author: Power-Dreams Team
 * Licence: GNU
 */
require __DIR__ . '/header.php';
require_once XOOPS_ROOT_PATH . '/class/xoopstree.php';

require XOOPS_ROOT_PATH . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'PDlinks_newlistindex.html';

global $xoopsDB, $xoopsModule, $xoopsUser, $xoopsModuleConfig;

$groups = (is_object($xoopsUser)) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
$module_id = $xoopsModule->getVar('mid');
$gpermHandler = xoops_getHandler('groupperm');

$imageheader = PDd_imageheader();
$xoopsTpl->assign('imageheader', $imageheader);

$counter = 0;
$allweeklinks = 0;

while ($counter <= 7 - 1) {
    $newlinkloaddayRaw = (time() - (86400 * $counter));
    $newlinkloadday = date('d-M-Y', $newlinkloaddayRaw);
    $newlinkloadView = date('F d, Y', $newlinkloaddayRaw);
    $newlinkloadDB = formatTimestamp($newlinkloaddayRaw, 's');
    $totallinks = 0;
    $result = $xoopsDB->query('SELECT lid, cid, published, updated FROM ' . $xoopsDB->prefix('PDlinks_links') . ' WHERE published > 0 AND published <= ' . time() . ' AND (expired = 0 OR expired > ' . time() . ') AND offline = 0');
    while (false !== ($myrow = $xoopsDB->fetcharray($result))) {
        $published = ($myrow['updated'] > 0) ? $myrow['updated'] : $myrow['published'];
        if ($gpermHandler->checkRight('PDlinkCatPerm', $myrow['cid'], $groups, $module_id)) {
            if ($gpermHandler->checkRight('PDlinkFilePerm', $myrow['lid'], $groups, $module_id)) {
                if (formatTimestamp($published, 's') == $newlinkloadDB) {
                    $totallinks++;
                }
            }
        }
    }
    $counter++;
    $allweeklinks = $allweeklinks + $totallinks;
}

$counter = 0;
while ($counter <= 30 - 1) {
    $newlinkloaddayRaw = (time() - (86400 * $counter));
    $newlinkloadDB = formatTimestamp($newlinkloaddayRaw, 's');
    $totallinks = 0;
    $result = $xoopsDB->query('SELECT lid, cid, published, updated FROM ' . $xoopsDB->prefix('PDlinks_links') . ' WHERE published > 0 AND published <= ' . time() . ' AND (expired = 0 OR expired > ' . time() . ') AND offline = 0');
    while (false !== ($myrow = $xoopsDB->fetcharray($result))) {
        $published = ($myrow['updated'] > 0) ? $myrow['updated'] : $myrow['published'];
        if ($gpermHandler->checkRight('PDlinkCatPerm', $myrow['cid'], $groups, $module_id)) {
            if ($gpermHandler->checkRight('PDlinkFilePerm', $myrow['lid'], $groups, $module_id)) {
                if (formatTimestamp($published, 's') == $newlinkloadDB) {
                    $totallinks++;
                }
            }
        }
    }
    if (!isset($allmonthlinks)) {
        $allmonthlinks = 0;
    }
    $allmonthlinks = $allmonthlinks + $totallinks;
    $counter++;
}
$xoopsTpl->assign('allweeklinks', $allweeklinks);
$xoopsTpl->assign('allmonthlinks', $allmonthlinks);

/**
 * List Last VARIABLE Days of links
 */
$newlinkshowdays = (!isset($_GET['newlinkshowdays'])) ? 7 : $_GET['newlinkshowdays'];
$xoopsTpl->assign('newlinkshowdays', $newlinkshowdays);

$counter = 0;
$allweeklinks = 0;
while ($counter <= $newlinkshowdays - 1) {
    $newlinkloaddayRaw = (time() - (86400 * $counter));
    $newlinkloadday = formatTimestamp($newlinkloaddayRaw, 'd-M-Y');
    $newlinkloadView = formatTimestamp($newlinkloaddayRaw, 'F d, Y');
    $newlinkloadDB = formatTimestamp($newlinkloaddayRaw, 's');
    $totallinks = 0;

    $result = $xoopsDB->query(
        'SELECT lid, cid, published, updated FROM ' . $xoopsDB->prefix('PDlinks_links') . ' 
		WHERE published > 0 AND published <= ' . time() . ' 
		AND (expired = 0 OR expired > ' . time() . ') 
		AND offline = 0'
    );
    while (false !== ($myrow = $xoopsDB->fetcharray($result))) {
        $published = ($myrow['updated'] > 0) ? $myrow['updated'] : $myrow['published'];

        if ($gpermHandler->checkRight('PDlinkCatPerm', $myrow['cid'], $groups, $module_id)) {
            if ($gpermHandler->checkRight('PDlinkFilePerm', $myrow['lid'], $groups, $module_id)) {
                if (formatTimestamp($myrow['published'], 's') == $newlinkloadDB) {
                    $totallinks++;
                }
            }
        }
    }
    $counter++;
    $allweeklinks = $allweeklinks + $totallinks;
    $dailylinks['newlinkloadday'] = $dailylinks['newlinkloadView'] = $newlinkloadView;
    $dailylinks['newlinkloaddayRaw'] = $newlinkloaddayRaw;
    $dailylinks['totallinks'] = $totallinks;
    $xoopsTpl->append('dailylinks', $dailylinks);
}
$counter = 0;
$allmonthlinks = 0;

$mytree = new XoopsTree($xoopsDB->prefix('PDlinks_cat'), 'cid', 'pid');
$sql = 'SELECT * FROM ' . $xoopsDB->prefix('PDlinks_links') . ' ';
$sql .= 'WHERE published > 0 AND published <= ' . time() . ' 
		AND (expired = 0 OR expired > ' . time() . ') AND offline = 0 
		ORDER BY ' . $xoopsModuleConfig['filexorder'];

$result = $xoopsDB->query($sql, $xoopsModuleConfig['perpage'], 0);
while (false !== ($link_arr = $xoopsDB->fetchArray($result))) {
    if ($gpermHandler->checkRight('PDlinkFilePerm', $link_arr['lid'], $groups, $xoopsModule->getVar('mid'))) {
        require XOOPS_ROOT_PATH . '/modules/PDlinks/include/linkloadinfo.php';
    }
}

/**
 * Screenshots display
 */
$xoopsTpl->assign('show_screenshot', false);
if (isset($xoopsModuleConfig['screenshot']) && 1 == $xoopsModuleConfig['screenshot']) {
    $xoopsTpl->assign('shots_dir', $xoopsModuleConfig['screenshots']);
    $xoopsTpl->assign('shotwidth', $xoopsModuleConfig['shotwidth']);
    $xoopsTpl->assign('shotheight', $xoopsModuleConfig['shotheight']);
    $xoopsTpl->assign('show_screenshot', true);
}
require XOOPS_ROOT_PATH . '/footer.php';
