<?php
/**
 * $Id: PDlinks.php v 1.03 05 july 2004 Catwolf Exp $
 * Module: PD-Links
 * Version: v1.0
 * Release Date: 04. März 2005
 * Author: Power-Dreams Team
 * Licence: GNU
 */

/**
 * Function: b_mylinks_top_show
 * Input   : $options[0] = date for the most recent links
 *                     hits for the most popular links
 *            $block['content'] = The optional above content
 *            $options[1]   = How many links are displayes
 * Output  : Returns the most recent or most popular links
 */
require_once XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';

function b_PDlinks_top_show($options)
{
    global $xoopsDB, $xoopsModule, $xoopsUser;

    $block = [];
    $myts = MyTextSanitizer::getInstance();

    $moduleHandler = xoops_getHandler('module');
    $xoopsModule = $moduleHandler->getByDirname('PDlinks');
    $configHandler = xoops_getHandler('config');
    $xoopsModuleConfig = &$configHandler->getConfigsByCat(0, $xoopsModule->getVar('mid'));

    $groups = (is_object($xoopsUser)) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
    $gpermHandler = xoops_getHandler('groupperm');

    $result = $xoopsDB->query('SELECT lid, cid, title, date, hits FROM ' . $xoopsDB->prefix('PDlinks_links') . ' WHERE status > 0 AND offline = 0 ORDER BY ' . $options[0] . ' DESC', $options[1], 0);
    while (false !== ($myrow = $xoopsDB->fetchArray($result))) {
        if ($gpermHandler->checkRight('PDlinkFilePerm', $myrow['lid'], $groups, $xoopsModule->getVar('mid'))) {
            $linkload = [];
            $title = htmlspecialchars($myrow['title']);
            if (!XOOPS_USE_MULTIBYTES) {
                if (mb_strlen($myrow['title']) >= $options[2]) {
                    $title = htmlspecialchars(mb_substr($myrow['title'], 0, ($options[2] - 1))) . '...';
                }
            }
            $linkload['id'] = $myrow['lid'];
            $linkload['cid'] = $myrow['cid'];
            $linkload['title'] = $title;
            if ('date' == $options[0]) {
                $linkload['date'] = formatTimestamp($myrow['date'], $xoopsModuleConfig['dateformat']);
            } elseif ('hits' == $options[0]) {
                $linkload['hits'] = $myrow['hits'];
            }
            $linkload['dirname'] = $xoopsModule->dirname();
            $block['links'][] = $linkload;
        }
    }

    return $block;
}

function b_PDlinks_top_edit($options)
{
    $form = '' . _MB_PDD2_DISP . '&nbsp;';
    $form .= "<input type='hidden' name='options[]' value='";
    if ('date' == $options[0]) {
        $form .= "date'";
    } else {
        $form .= "hits'";
    }
    $form .= '>';
    $form .= "<input type='text' name='options[]' value='" . $options[1] . "'>&nbsp;" . _MB_PDD2_FILES . '';
    $form .= '&nbsp;<br>' . _MB_PDD2_CHARS . "&nbsp;<input type='text' name='options[]' value='" . $options[2] . "'>&nbsp;" . _MB_PDD2_LENGTH . '';

    return $form;
}
