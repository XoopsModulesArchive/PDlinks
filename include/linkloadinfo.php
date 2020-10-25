<?php
/**
 * $Id: linkloadinfo.php v 1.01 02 july 2004 Liquid Exp $
 * Module: PD-Links
 * Version: v1.0
 * Release Date: 04. März 2005
 * Author: Power-Dreams Team
 * Licence: GNU
 */
$link['id'] = intval($link_arr['lid']);
$link['cid'] = intval($link_arr['cid']);

$path = $mytree->getPathFromId($link_arr['cid'], 'title');
$path = mb_substr($path, 1);
$path = basename($path);
$path = str_replace('/', '', $path);
$link['category'] = $path;

$rating = round(number_format($link_arr['rating'], 0) / 2);
$rateimg = "rate$rating.gif";
$link['rateimg'] = $rateimg;
$link['votes'] = (1 == $link_arr['votes']) ? _MD_PDD2_ONEVOTE : sprintf(_MD_PDD2_NUMVOTES, $link_arr['votes']);
$link['hits'] = intval($link_arr['hits']);

$xoopsTpl->assign('lang_dltimes', sprintf(_MD_PDD2_DLTIMES, $link['hits']));

$link['title'] = $link_arr['title'];
$link['url'] = $link_arr['url'];

if (isset($link_arr['screenshot'])) {
    $link['screenshot_full'] = htmlspecialchars($link_arr['screenshot']);
    if (!empty($link_arr['screenshot']) && file_exists(XOOPS_ROOT_PATH . '/' . $xoopsModuleConfig['screenshots'] . '/' . xoops_trim($link_arr['screenshot']))) {
        if (isset($xoopsModuleConfig['usethumbs']) && 1 == $xoopsModuleConfig['usethumbs']) {
            $link['screenshot_thumb'] = link_createthumb(
                $link['screenshot_full'],
                $xoopsModuleConfig['screenshots'],
                'thumbs',
                $xoopsModuleConfig['shotwidth'],
                $xoopsModuleConfig['shotheight'],
                $xoopsModuleConfig['imagequality'],
                $xoopsModuleConfig['updatethumbs'],
                $xoopsModuleConfig['keepaspect']
            );
        } else {
            $link['screenshot_thumb'] = XOOPS_URL . '/' . $xoopsModuleConfig['screenshots'] . '/' . xoops_trim($link_arr['screenshot']);
        }
    }
}

$link['comments'] = $link_arr['comments'];

$time = (0 != $link_arr['updated']) ? $link_arr['updated'] : $link_arr['published'];
$link['updated'] = formatTimestamp($time, $xoopsModuleConfig['dateformat']);
$is_updated = (0 != $link_arr['updated']) ? _MD_PDD2_UPDATEDON : _MD_PDD2_SUBMITDATE;
$xoopsTpl->assign('lang_subdate', $is_updated);

$link['description'] = $myts->displayTarea($link_arr['description'], 0); //no html
$link['submitter'] = XoopsUserUtility::getUnameFromId(intval($link_arr['submitter']));
$link['publisher'] = (isset($link_arr['publisher']) && !empty($link_arr['publisher'])) ? htmlspecialchars($link_arr['publisher']) : _MD_PDD2_NOTSPECIFIED;

$link['mail_subject'] = rawurlencode(sprintf(_MD_PDD2_INTFILEFOUND, $xoopsConfig['sitename']));
$link['mail_body'] = rawurlencode(sprintf(_MD_PDD2_INTFILEFOUND, $xoopsConfig['sitename']) . ':  ' . XOOPS_URL . '/modules/PDlinks/singlefile.php?cid=' . $link_arr['cid'] . '&lid=' . $link_arr['lid']);

$link['isadmin'] = (!empty($xoopsUser) && $xoopsUser->isAdmin($xoopsModule->mid())) ? true : false;

$link['adminlink'] = '';
if (true === $link['isadmin']) {
    $link['adminlink'] = '[ <a href="' . XOOPS_URL . '/modules/PDlinks/admin/index.php?op=linkload&lid=' . $link_arr['lid'] . '">' . _MD_PDD2_EDIT . '</a> | ';
    $link['adminlink'] .= '<a href="' . XOOPS_URL . '/modules/PDlinks/admin/index.php?op=dellinkload&lid=' . $link_arr['lid'] . '">' . _MD_PDD2_DELETE . '</a> ]';
}
$votestring = (1 == $link_arr['votes']) ? _MD_PDD2_ONEVOTE : sprintf(_MD_PDD2_NUMVOTES, $link_arr['votes']);
$is_updated = ($link_arr['updated'] > 0) ? _MD_PDD2_UPDATEDON : _MD_PDD2_SUBMITDATE;
$xoopsTpl->assign('lang_subdate', $is_updated);
if (is_object($xoopsUser) && true !== $link['isadmin']) {
    $link['useradminlink'] = ($xoopsUser->getvar('uid') == $link_arr['submitter']) ? true : false;
}

$moduleHandler = xoops_getHandler('module');
$xoopsforumModule = $moduleHandler->getByDirname('newbb');
if (is_object($xoopsforumModule) && $xoopsforumModule->getVar('isactive')) {
    $link['forumid'] = ($link_arr['forumid'] > 0) ? $link_arr['forumid'] : 0;
}

$link['icons'] = PDd_displayicons($link_arr['published'], $link_arr['status'], $link_arr['hits']);
$xoopsTpl->append('file', $link);
