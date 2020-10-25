<?php
/**
 * $Id: index.php v 1.13 03 july 2004 Liquid Exp $
 * Module: PD-Links
 * Version: v1.0
 * Release Date: 04. März 2005
 * Author: Power-Dreams Team
 * Licence: GNU
 */
require __DIR__ . '/header.php';
require_once XOOPS_ROOT_PATH . '/class/xoopstree.php';

global $xoopsModuleConfig, $xoopsModule, $xoopsUser;

$mytree = new XoopsTree($xoopsDB->prefix('PDlinks_cat'), 'cid', 'pid');

require XOOPS_ROOT_PATH . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'PDlinks_index.html';
/**
 * Begin Main page Heading etc
 */
$sql = 'SELECT * FROM ' . $xoopsDB->prefix('PDlinks_indexpage') . ' ';
$head_arr = $xoopsDB->fetchArray($xoopsDB->query($sql));
$catarray['imageheader'] = PDd_imageheader();
$catarray['indexheading'] = $myts->displayTarea($head_arr['indexheading']);
$catarray['indexheaderalign'] = $head_arr['indexheaderalign'];
$catarray['indexfooteralign'] = $head_arr['indexfooteralign'];

$html = ($head_arr['nohtml']) ? 0 : 1;
$smiley = ($head_arr['nosmiley']) ? 0 : 1;
$xcodes = ($head_arr['noxcodes']) ? 0 : 1;
$images = ($head_arr['noimages']) ? 0 : 1;
$breaks = ($head_arr['nobreak']) ? 1 : 0;

$catarray['indexheader'] = $myts->displayTarea($head_arr['indexheader'], $html, $smiley, $xcodes, $images, $breaks);
$catarray['indexfooter'] = $myts->displayTarea($head_arr['indexfooter'], $html, $smiley, $xcodes, $images, $breaks);
$catarray['letters'] = PDd_letters();
$catarray['toolbar'] = PDd_toolbar();
$xoopsTpl->assign('catarray', $catarray);
/**
 * End main page Headers
 */
$count = 1;
$chcount = 0;
$countin = 0;

$groups = (is_object($xoopsUser)) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
$module_id = $xoopsModule->getVar('mid');
$gpermHandler = xoops_getHandler('groupperm');

/**
 * Begin Main page linkload info
 */
$listings = PDd_getTotalItems();
/*
* get total amount of categories
*/
$total_cat = PDd_totalcategory();

$result = $xoopsDB->query('SELECT * FROM ' . $xoopsDB->prefix('PDlinks_cat') . ' WHERE pid = 0 ORDER BY weight');
while (false !== ($myrow = $xoopsDB->fetchArray($result))) {
    $countin++;
    $subtotallinkload = 0;
    $totallinkload = PDd_getTotalItems($myrow['cid'], 1);
    //$subtotallinkload = PDd_getTotalItems($myrow['cid'], 1);
    $indicator = PDd_isnewimage($totallinkload['published']);

    if ($gpermHandler->checkRight('PDlinkCatPerm', $myrow['cid'], $groups, $module_id)) {
        $title = htmlspecialchars($myrow['title']);
        $summary = $myts->displayTarea($myrow['summary']);
        /**
         * get child category objects
         */
        $arr = [];
        $mytree = new XoopsTree($xoopsDB->prefix('PDlinks_cat'), 'cid', 'pid');
        $arr = $mytree->getFirstChild($myrow['cid'], 'title');
        $space = 0;
        $chcount = 0;
        $subcategories = '';

        foreach ($arr as $ele) {
            if ($gpermHandler->checkRight('PDlinkCatPerm', $ele['cid'], $groups, $xoopsModule->getVar('mid'))) {
                if (1 == $xoopsModuleConfig['subcats']) {
                    $chtitle = htmlspecialchars($ele['title']);
                    if ($chcount > 5) {
                        $subcategories .= '...';
                        break;
                    }
                    if ($space > 0) {
                        $subcategories .= '<br>';
                    }
                    $subcategories .= "<a href='" . XOOPS_URL . '/modules/PDlinks/viewcat.php?cid=' . $ele['cid'] . "'>" . $chtitle . '</a>';
                    $space++;
                    $chcount++;
                }
            }
        }

        if (is_file(XOOPS_ROOT_PATH . '/' . $xoopsModuleConfig['catimage'] . '/' . htmlspecialchars($myrow['imgurl'])) && !empty($myrow['imgurl'])) {
            if ($xoopsModuleConfig['usethumbs'] && function_exists('gd_info')) {
                $imgurl = link_createthumb(
                    htmlspecialchars($myrow['imgurl']),
                    $xoopsModuleConfig['catimage'],
                    'thumbs',
                    $xoopsModuleConfig['shotwidth'],
                    $xoopsModuleConfig['shotheight'],
                    $xoopsModuleConfig['imagequality'],
                    $xoopsModuleConfig['updatethumbs'],
                    $xoopsModuleConfig['keepaspect']
                );
            } else {
                $imgurl = XOOPS_URL . '/' . $xoopsModuleConfig['catimage'] . '/' . htmlspecialchars($myrow['imgurl']);
            }
        } else {
            $imgurl = $indicator['image'];
        }
        $xoopsTpl->append(
            'categories',
            [
                'image' => $imgurl,
                'id' => $myrow['cid'],
                'title' => $title,
                'summary' => $summary,
                'subcategories' => $subcategories,
                'totallinks' => $totallinkload['count'],
                'count' => $count,
                'alttext' => $indicator['alttext'],
            ]
        );
        $count++;
    }
}
switch ($total_cat) {
    case '1':
        $lang_ThereAre = _MD_PDD2_THEREIS;
        break;
    default:
        $lang_ThereAre = _MD_PDD2_THEREARE;
        break;
}

$xoopsTpl->assign('lang_thereare', sprintf($lang_ThereAre, $total_cat, $listings['count']));

// New links listing in index mod (Beginn)
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
$sql .= 'ORDER BY date DESC';

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
// New links listing in index mod (End)

require XOOPS_ROOT_PATH . '/footer.php';
