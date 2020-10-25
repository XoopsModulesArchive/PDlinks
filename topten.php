<?php
/**
 * $Id: topten.php v 1.0.3 06 july 2004 Liquid Exp $
 * Module: PD-Links
 * Version: v1.0
 * Release Date: 04. März 2005
 * Author: Power-Dreams Team
 * Licence: GNU
 */
require __DIR__ . '/header.php';
require_once XOOPS_ROOT_PATH . '/class/xoopstree.php';

global $xoopsDB, $xoopsUser;

$mytree = new XoopsTree($xoopsDB->prefix('PDlinks_cat'), 'cid', 'pid');
$GLOBALS['xoopsOption']['template_main'] = 'PDlinks_topten.html';

$groups = (is_object($xoopsUser)) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
$module_id = $xoopsModule->getVar('mid');
$gpermHandler = xoops_getHandler('groupperm');

require XOOPS_ROOT_PATH . '/header.php';

$action_array = ['hit' => 0, 'rate' => 1];
$list_array = ['hits', 'rating'];
$lang_array = [_MD_PDD2_HITS, _MD_PDD2_RATING];

$sort = (isset($_GET['list']) && in_array($_GET['list'], $action_array, true)) ? $_GET['list'] : 'rate';
$this = $action_array[$sort];
$sortDB = $list_array[$this];

$catarray['imageheader'] = PDd_imageheader();
$catarray['letters'] = PDd_letters();
$catarray['toolbar'] = PDd_toolbar();
$xoopsTpl->assign('catarray', $catarray);

$arr = [];
$result = $xoopsDB->query('SELECT cid, title FROM ' . $xoopsDB->prefix('PDlinks_cat') . ' WHERE pid=0');

$e = 0;
$rankings = [];
while (list($cid, $ctitle) = $xoopsDB->fetchRow($result)) {
    if ($gpermHandler->checkRight('PDlinkCatPerm', $cid, $groups, $module_id)) {
        $query = 'SELECT lid, cid, title, hits, rating, votes FROM ' . $xoopsDB->prefix('PDlinks_links') . ' WHERE published > 0 AND published <= ' . time() . ' AND (expired = 0 OR expired > ' . time() . ") AND offline = 0 AND (cid=$cid";
        $arr = $mytree->getAllChildId($cid);
        for ($i = 0; $i < count($arr); $i++) {
            $query .= ' or cid=' . $arr[$i] . '';
        }
        $query .= ') order by ' . $sortDB . ' DESC';
        $result2 = $xoopsDB->query($query, 10, 0);
        $filecount = $xoopsDB->getRowsNum($result2);

        if ($filecount > 0) {
            $rankings[$e]['title'] = htmlspecialchars($ctitle);
            $rank = 1;

            while (list($did, $dcid, $dtitle, $hits, $rating, $votes) = $xoopsDB->fetchRow($result2)) {
                if ($gpermHandler->checkRight('PDlinkFilePerm', $did, $groups, $xoopsModule->getVar('mid'))) {
                    $catpath = $mytree->getPathFromId($dcid, 'title');
                    $catpath = basename($catpath);

                    $dtitle = htmlspecialchars($dtitle);
                    //if ($catpath != $ctitle)
                    //{
                    //    $dtitle = $myts -> htmlSpecialChars($ctitle); //. $ctitle;
                    //}

                    $rankings[$e]['file'][] = ['id' => $did, 'cid' => $dcid, 'rank' => $rank, 'title' => $dtitle, 'category' => $catpath, 'hits' => $hits, 'rating' => number_format($rating, 2), 'votes' => $votes];
                    $rank++;
                }
            }
            $e++;
        }
    }
}

$xoopsTpl->assign('lang_sortby', $lang_array[$this]);

$xoopsTpl->assign('rankings', $rankings);
require XOOPS_ROOT_PATH . '/footer.php';

require XOOPS_ROOT_PATH . '/footer.php';
