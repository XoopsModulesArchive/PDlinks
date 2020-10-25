<?php

declare(strict_types=1);

/**
 * $Id: admin_header.php v 1.13 06 july 2004 Catwolf Exp $
 * Module: PD-Links
 * Version: v1.0
 * Release Date: 04. März 2005
 * Author: Power-Dreams Team
 * Licence: GNU
 */
require dirname(__DIR__, 3) . '/mainfile.php';
require dirname(__DIR__, 3) . '/include/cp_header.php';
require dirname(__DIR__) . '/include/functions.php';

if (!file_exists('../language/' . $xoopsConfig['language'] . '/admin.php')) {
    include '../language/' . $xoopsConfig['language'] . '/admin.php';
}

require_once XOOPS_ROOT_PATH . '/class/xoopstree.php';
require_once XOOPS_ROOT_PATH . '/class/xoopslists.php';
require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';

if (is_object($xoopsUser)) {
    $xoopsModule = XoopsModule::getByDirname('PDlinks');
    if (!$xoopsUser->isAdmin($xoopsModule->mid())) {
        redirect_header(XOOPS_URL . '/', 3, _NOPERM);
        exit();
    }
} else {
    redirect_header(XOOPS_URL . '/', 1, _NOPERM);
    exit();
}
$myts = MyTextSanitizer::getInstance();

$imagearray = [
    'editimg' => "<img src='../images/icon/edit.gif' alt='" . _AM_PDD2_ICO_EDIT . "' align='middle'>",
    'deleteimg' => "<img src='../images/icon/delete.gif' alt='" . _AM_PDD2_ICO_DELETE . "' align='middle'>",
    'online' => "<img src='../images/icon/on.gif' alt='" . _AM_PDD2_ICO_ONLINE . "' align='middle'>",
    'offline' => "<img src='../images/icon/off.gif' alt='" . _AM_PDD2_ICO_OFFLINE . "' align='middle'>",
    'approved' => "<img src='../images/icon/on.gif' alt=''" . _AM_PDD2_ICO_APPROVED . "' align='middle'>",
    'notapproved' => "<img src='../images/icon/off.gif' alt='" . _AM_PDD2_ICO_NOTAPPROVED . "' align='middle'>",
    'relatedfaq' => "<img src='../images/icon/link.gif' alt='" . _AM_PDD2_ICO_LINK . "' align='absmiddle'>",
    'relatedurl' => "<img src='../images/icon/urllink.gif' alt='" . _AM_PDD2_ICO_URL . "' align='middle'>",
    'addfaq' => "<img src='../images/icon/add.gif' alt='" . _AM_PDD2_ICO_ADD . "' align='middle'>",
    'approve' => "<img src='../images/icon/approve.gif' alt='" . _AM_PDD2_ICO_APPROVE . "' align='middle'>",
    'statsimg' => "<img src='../images/icon/stats.gif' alt='" . _AM_PDD2_ICO_STATS . "' align='middle'>",
    'ignore' => "<img src='../images/icon/ignore.gif' alt='" . _AM_PDD2_ICO_IGNORE . "' align='middle'>",
    'ack_yes' => "<img src='../images/icon/on.gif' alt='" . _AM_PDD2_ICO_ACK . "' align='middle'>",
    'ack_no' => "<img src='../images/icon/off.gif' alt='" . _AM_PDD2_ICO_REPORT . "' align='middle'>",
    'con_yes' => "<img src='../images/icon/on.gif' alt='" . _AM_PDD2_ICO_CONFIRM . "' align='middle'>",
    'con_no' => "<img src='../images/icon/off.gif' alt='" . _AM_PDD2_ICO_CONBROKEN . "' align='middle'>",
];
