<?php
/**
 * $Id: singlefile.php v 1.04 06 july 2004 Liquid Exp $
 * Module: PD-Links
 * Version: v1.0
 * Release Date: 04. März 2005
 * Author: Power-Dreams Team
 * Licence: GNU
 */
require __DIR__ . '/header.php';
require_once XOOPS_ROOT_PATH . '/class/xoopstree.php';

$lid = intval($_GET['lid']);
$cid = intval($_GET['cid']);
$GLOBALS['xoopsOption']['template_main'] = 'PDlinks_singlefile.html';
$groups = (is_object($xoopsUser)) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
$module_id = $xoopsModule->getVar('mid');
$gpermHandler = xoops_getHandler('groupperm');

$sql = 'SELECT * FROM ' . $xoopsDB->prefix('PDlinks_links') . " WHERE lid = $lid";
$result = $xoopsDB->query($sql);
$link_arr = $xoopsDB->fetchArray($result);

if (!$link_arr) {
    redirect_header('index.php', 1, _MD_PDD2_NOlinkLOAD);
    exit();
}

require XOOPS_ROOT_PATH . '/header.php';

/**
 * Begin Main page Heading etc
 */
$link['imageheader'] = PDd_imageheader();
$link['id'] = intval($link_arr['lid']);
$link['cid'] = intval($link_arr['cid']);
/**
 * Breadcrumb
 */
$mytree = new XoopsTree($xoopsDB->prefix('PDlinks_cat'), 'cid', 'pid');
$pathstring = "<a href='index.php'>" . _MD_PDD2_MAIN . '</a>&nbsp;:&nbsp;';
$pathstring .= $mytree->getNicePathFromId($cid, 'title', 'viewcat.php?op=');
$link['path'] = $pathstring;

//abfrage ob man die berechtigung für den download hat oder nicht
if ($gpermHandler->checkRight('PDlinkFilePerm', $link_arr['lid'], $groups, $xoopsModule->getVar('mid'))) {
    require_once XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/include/linkloadinfo.php';
} else {
    redirect_header(XOOPS_URL, 3, _NOPERM);
    exit();
}
//ende der if-schleife

$xoopsTpl->assign('show_screenshot', false);
if (isset($xoopsModuleConfig['screenshot']) && 1 == $xoopsModuleConfig['screenshot']) {
    $xoopsTpl->assign('shots_dir', $xoopsModuleConfig['screenshots']);
    $xoopsTpl->assign('shotwidth', $xoopsModuleConfig['shotwidth']);
    $xoopsTpl->assign('shotheight', $xoopsModuleConfig['shotheight']);
    $xoopsTpl->assign('show_screenshot', true);
}
/**
 * Show other author links
 */
$groups = (is_object($xoopsUser)) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
$gpermHandler = xoops_getHandler('groupperm');

$sql = 'SELECT lid, cid, title, published FROM ' . $xoopsDB->prefix('PDlinks_links') . ' 
	WHERE submitter = ' . $link_arr['submitter'] . ' 
	AND published > 0 AND published <= ' . time() . ' AND (expired = 0 OR expired > ' . time() . ') 
	AND offline = 0 ORDER by published DESC';
$result = $xoopsDB->query($sql, 20, 0);

while (false !== ($arr = $xoopsDB->fetchArray($result))) {
    if (!$gpermHandler->checkRight('PDlinkFilePerm', $arr['lid'], $groups, $xoopsModule->getVar('mid')) || $arr['lid'] == $lid) {
        continue;
    }

    $linkuid['title'] = $arr['title'];
    $linkuid['lid'] = $arr['lid'];
    $linkuid['cid'] = $arr['cid'];
    $linkuid['published'] = formatTimestamp($arr['published'], $xoopsModuleConfig['dateformat']);
    $xoopsTpl->append('link_uid', $linkuid);
}

if (isset($xoopsModuleConfig['copyright']) && 1 == $xoopsModuleConfig['copyright']) {
    $xoopsTpl->assign('lang_copyright', '' . $link['title'] . ' © ' . _MD_PDD2_COPYRIGHT . ' ' . date('Y') . ' ' . XOOPS_URL);
}
$xoopsTpl->assign('link', $link);

require XOOPS_ROOT_PATH . '/include/comment_view.php';
require XOOPS_ROOT_PATH . '/footer.php';
