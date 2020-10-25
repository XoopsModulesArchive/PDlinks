<?php
/**
 * $Id: broken.php v 1.0.2 06 july 2004 Liquid Exp $
 * Module: PD-Links
 * Version: v1.0
 * Release Date: 04. März 2005
 * Author: Power-Dreams Team
 * Licence: GNU
 */
require __DIR__ . '/header.php';

if (!empty($_POST['submit'])) {
    global $xoopsModule, $xoopsModuleConfig, $xoopsUser;

    $sender = (is_object($xoopsUser)) ? $xoopsUser->getVar('uid') : 0;
    $ip = getenv('REMOTE_ADDR');
    $lid = intval($_POST['lid']);
    $time = time();
    /*
    *  Check if REG user is trying to report twice.
    */
    $result = $xoopsDB->query('SELECT COUNT(*) FROM ' . $xoopsDB->prefix('PDlinks_broken') . " WHERE lid=$lid");
    [$count] = $xoopsDB->fetchRow($result);
    if ($count > 0) {
        redirect_header('index.php', 2, _MD_PDD2_ALREADYREPORTED);
        exit();
    }
    $sql = sprintf('INSERT INTO ' . $xoopsDB->prefix('PDlinks_broken') . " (reportid, lid, sender, ip, date, confirmed, acknowledged ) VALUES ( '', '$lid', '$sender', '$ip', '$time', '0', '0')");
    $result = $xoopsDB->query($sql);

    $newid = $xoopsDB->getInsertId();
    $tags = [];
    $tags['BROKENREPORTS_URL'] = XOOPS_URL . '/modules/PDlinks/admin/index.php?op=listBrokenlinks';
    $notificationHandler = xoops_getHandler('notification');
    $notificationHandler->triggerEvent('global', 0, 'file_broken', $tags);

    /**
     * Send email to the owner of the linkload stating that it is broken
     */
    $sql = 'SELECT * FROM ' . $xoopsDB->prefix('PDlinks_links') . " WHERE lid = $lid AND published > 0 AND published <= " . time() . ' AND (expired = 0 OR expired > ' . time() . ')';
    $link_arr = $xoopsDB->fetchArray($xoopsDB->query($sql));
    unset($sql);

    $user = new XoopsUser(intval($link_arr['submitter']));
    $subdate = formatTimestamp($link_arr['date'], $xoopsModuleConfig['dateformat']);
    $cid = $link_arr['cid'];
    $title = $link_arr['title'];
    $subject = _MD_PDD2_BROKENREPORTED;

    $xoopsMailer = &getMailer();
    $xoopsMailer->useMail();
    $template_dir = XOOPS_ROOT_PATH . '/modules/PDlinks/language/' . $xoopsConfig['language'] . '/mail_template';

    $xoopsMailer->setTemplateDir($template_dir);
    $xoopsMailer->setTemplate('filebroken_notify.tpl');
    $xoopsMailer->setToEmails($user->email());
    $xoopsMailer->setFromEmail($xoopsConfig['adminmail']);
    $xoopsMailer->setFromName($xoopsConfig['sitename']);
    $xoopsMailer->assign('X_UNAME', $user->uname());
    $xoopsMailer->assign('SITENAME', $xoopsConfig['sitename']);
    $xoopsMailer->assign('X_ADMINMAIL', $xoopsConfig['adminmail']);
    $xoopsMailer->assign('X_SITEURL', XOOPS_URL . '/');
    $xoopsMailer->assign('X_TITLE', $title);
    $xoopsMailer->assign('X_SUB_DATE', $subdate);
    $xoopsMailer->assign('X_LINKLOAD', XOOPS_URL . '/modules/PDlinks/singlefile.php?cid=' . $cid . '&lid=' . $lid);
    $xoopsMailer->setSubject($subject);
    $xoopsMailer->send();
    redirect_header('index.php', 2, _MD_PDD2_BROKENREPORTED);
    exit();
}
    $GLOBALS['xoopsOption']['template_main'] = 'PDlinks_brokenfile.html';
    require XOOPS_ROOT_PATH . '/header.php';

    /**
     * Begin Main page Heading etc
     */
    $catarray['imageheader'] = PDd_imageheader();
    $xoopsTpl->assign('catarray', $catarray);

    $lid = (isset($_GET['lid']) && $_GET['lid'] > 0) ? intval($_GET['lid']) : 0;
    $sql = 'SELECT * FROM ' . $xoopsDB->prefix('PDlinks_links') . " WHERE lid = $lid AND published > 0 AND published <= " . time() . ' AND (expired = 0 OR expired > ' . time() . ')';
    $link_arr = $xoopsDB->fetchArray($xoopsDB->query($sql));
    unset($sql);

    $sql = 'SELECT * FROM ' . $xoopsDB->prefix('PDlinks_broken') . " WHERE lid = $lid";
    $broke_arr = $xoopsDB->fetchArray($xoopsDB->query($sql));

    if (is_array($broke_arr)) {
        global $xoopsModuleConfig;

        $broken['title'] = trim($link_arr['title']);
        $broken['id'] = $broke_arr['reportid'];
        $broken['reporter'] = XoopsUserUtility::getUnameFromId(intval($broke_arr['sender']));
        $broken['date'] = formatTimestamp($broke_arr['date'], $xoopsModuleConfig['dateformat']);
        $broken['acknowledged'] = (1 == $broke_arr['acknowledged']) ? _YES : _NO;
        $broken['confirmed'] = (1 == $broke_arr['confirmed']) ? _YES : _NO;

        $xoopsTpl->assign('broken', $broken);
        $xoopsTpl->assign('brokenreport', true);
        header('Refresh: 3; url=index.php');
    } else {
        $amount = $xoopsDB->getRowsNum($sql);

        if (!is_array($link_arr)) {
            redirect_header('index.php', 0, _MD_PDD2_THISFILEDOESNOTEXIST);
            exit();
        }
        /**
         * file info
         */
        $link['title'] = trim($link_arr['title']);
        $time = (0 != $link_arr['updated']) ? $link_arr['updated'] : $link_arr['published'];
        $link['updated'] = formatTimestamp($time, $xoopsModuleConfig['dateformat']);
        $is_updated = (0 != $link_arr['updated']) ? _MD_PDD2_UPDATEDON : _MD_PDD2_SUBMITDATE;
        $link['publisher'] = XoopsUserUtility::getUnameFromId(intval($link_arr['submitter']));

        $xoopsTpl->assign('file_id', $lid);
        $xoopsTpl->assign('lang_subdate', $is_updated);
        $xoopsTpl->assign('link', $link);
    }
    require_once XOOPS_ROOT_PATH . '/footer.php';
