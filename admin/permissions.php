<?php
/**
 * $Id: permissions.php v 1.03 05 july 2004 Liquid Exp $
 * Module: PD-Links
 * Version: v1.0
 * Release Date: 04. März 2005
 * Author: Power-Dreams Team
 * Licence: GNU
 */
require __DIR__ . '/admin_header.php';
require_once XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';

xoops_cp_header();
PDd_adminmenu(_AM_PDD2_PERM_MANAGEMENT);

echo "
		<fieldset><legend style='font-weight: bold; color: #900;'>" . _AM_PDD2_PERM_CPERMISSIONS . "</legend>\n
		<div style='padding: 2px;'>\n";

$cat_form = new XoopsGroupPermForm('', $xoopsModule->getVar('mid'), 'PDlinkCatPerm', _AM_PDD2_PERM_CSELECTPERMISSIONS);
$result = $xoopsDB->query('SELECT cid, pid, title FROM ' . $xoopsDB->prefix('PDlinks_cat'));
if ($xoopsDB->getRowsNum($result)) {
    while (false !== ($cat_row = $xoopsDB->fetcharray($result))) {
        $cat_form->addItem($cat_row['cid'], $cat_row['title'], $cat_row['pid']);
    }
    echo $cat_form->render();
} else {
    echo '<div><b>' . _AM_PDD2_PERM_CNOCATEGORY . '</b></div>';
}
echo '</div></fieldset><br>';
unset($cat_form);

/*
* File permission form
*/
echo "
		<fieldset><legend style='font-weight: bold; color: #900;'>" . _AM_PDD2_PERM_FPERMISSIONS . "</legend>\n
		<div style='padding: 2px;'>\n";
$file_form = new XoopsGroupPermForm('', $xoopsModule->getVar('mid'), 'PDlinkFilePerm', _AM_PDD2_PERM_FSELECTPERMISSIONS);
$result2 = $xoopsDB->query('SELECT lid, title FROM ' . $xoopsDB->prefix('PDlinks_links'));
if ($xoopsDB->getRowsNum($result2)) {
    while (false !== ($file_row = $xoopsDB->fetcharray($result2))) {
        $file_form->addItem($file_row['lid'], $file_row['title'], 0);
    }
    echo $file_form->render();
} else {
    echo '<div><b>' . _AM_PDD2_PERM_FNOFILES . '</b></div>';
}
echo '</div></fieldset><br>';
unset($file_form);
echo _AM_PDD2_PERM_PERMSNOTE;

xoops_cp_footer();
