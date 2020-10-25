<?php

declare(strict_types=1);

/**
 * $Id: modifications.php v 1.03 06 july 2004 Liquid Exp $
 * Module: PD-Links
 * Version: v2.0.5a
 * Release Date: 04. März 2005
 * Author: Power-Dreams Team
 * Licence: GNU
 */
require __DIR__ . '/admin_header.php';

if (!isset($_POST['op'])) {
    $op = $_GET['op'] ?? 'main';
} else {
    $op = $_POST['op'];
}

switch ($op) {
    case 'listModReqshow':

        require XOOPS_ROOT_PATH . '/class/xoopsformloader.php';

        global $xoopsDB, $myts, $mytree, $xoopsModuleConfig, $xoopsUser;

        xoops_cp_header();
        PDd_adminmenu(_AM_PDD2_MOD_MODREQUESTS);

        $requestid = intval($_GET['requestid']);

        $sql = 'SELECT modifysubmitter, requestid, lid, cid, title, url, description, screenshot, forumid
			FROM ' . $xoopsDB->prefix('PDlinks_mod') . ' WHERE requestid=' . $_GET['requestid'];
        $mod_array = $xoopsDB->fetchArray($xoopsDB->query($sql));
        unset($sql);

        $sql = 'SELECT submitter, lid, cid, title, url, description, screenshot, forumid
			FROM ' . $xoopsDB->prefix('PDlinks_links') . ' WHERE lid=' . $mod_array['lid'];
        $orig_array = $xoopsDB->fetchArray($xoopsDB->query($sql));
        unset($sql);

        $orig_user = new XoopsUser($orig_array['submitter']);
        $submittername = XoopsUserUtility::getUnameFromId($orig_array['submitter']); // $orig_user->getvar("uname");
        $submitteremail = $orig_user->getUnameFromId('email');

        echo '<div><b>' . _AM_PDD2_MOD_MODPOSTER . "</b> $submittername</div>";
        $not_allowed = ['lid', 'submitter', 'requestid', 'modifysubmitter'];
        $sform = new XoopsThemeForm(_AM_PDD2_MOD_ORIGINAL, 'storyform', 'index.php');
        foreach ($orig_array as $key => $content) {
            if (in_array($key, $not_allowed, true)) {
                continue;
            }
            $lang_def = constant('_AM_PDD2_MOD_' . mb_strtoupper($key));

            if ('cid' == $key) {
                $sql = 'SELECT title FROM ' . $xoopsDB->prefix('PDlinks_cat') . ' WHERE cid=' . $content . '';
                $row = $xoopsDB->fetchArray($xoopsDB->query($sql));
                $content = $row['title'];
            }
            if ('forumid' == $key) {
                $content = '';
                $moduleHandler = xoops_getHandler('module');
                $xoopsforumModule = $moduleHandler->getByDirname('newbb');
                $sql = 'SELECT title FROM ' . $xoopsDB->prefix('bb_categories') . ' WHERE cid=' . $content . '';
                if ($xoopsforumModule && $content > 0) {
                    $content = "<a href='" . XOOPS_URL . '/modules/newbb/viewforum.php?forum=' . $content . "'>Forumid</a>";
                } else {
                    $content = '';
                }
            }
            if ('screenshot' == $key) {
                $content = '';
                if ($content > 0) {
                    $content = "<img src='" . XOOPS_URL . '/' . $xoopsModuleConfig['screenshots'] . '/' . $logourl . "' width='" . $xoopsModuleConfig['shotwidth'] . "' alt=''>";
                }
            }

            $sform->addElement(new XoopsFormLabel($lang_def, $content));
        }
        $sform->display();

        $orig_user = new XoopsUser($mod_array['modifysubmitter']);
        $submittername = XoopsUserUtility::getUnameFromId($mod_array['modifysubmitter']);
        $submitteremail = $orig_user->getUnameFromId('email');

        echo '<div><b>' . _AM_PDD2_MOD_MODIFYSUBMITTER . "</b> $submittername</div>";
        $sform = new XoopsThemeForm(_AM_PDD2_MOD_PROPOSED, 'storyform', 'modifications.php');
        foreach ($mod_array as $key => $content) {
            if (in_array($key, $not_allowed, true)) {
                continue;
            }
            $lang_def = constant('_AM_PDD2_MOD_' . mb_strtoupper($key));

            if ('cid' == $key) {
                $sql = 'SELECT title FROM ' . $xoopsDB->prefix('PDlinks_cat') . ' WHERE cid=' . $content . '';
                $row = $xoopsDB->fetchArray($xoopsDB->query($sql));
                $content = $row['title'];
            }
            if ('forumid' == $key) {
                $content = '';
                $moduleHandler = xoops_getHandler('module');
                $xoopsforumModule = $moduleHandler->getByDirname('newbb');
                $sql = 'SELECT title FROM ' . $xoopsDB->prefix('bb_categories') . ' WHERE cid=' . $content . '';
                $content = '';
                if ($xoopsforumModule && $content > 0) {
                    $content = "<a href='" . XOOPS_URL . '/modules/newbb/viewforum.php?forum=' . $content . "'>Forumid</a>";
                }
            }
            if ('screenshot' == $key) {
                $content = '';
                if ($content > 0) {
                    $content = "<img src='" . XOOPS_URL . '/' . $xoopsModuleConfig['screenshots'] . '/' . $logourl . "' width='" . $xoopsModuleConfig['shotwidth'] . "' alt=''>";
                }
            }
            $sform->addElement(new XoopsFormLabel($lang_def, $content));
        }

        $button_tray = new XoopsFormElementTray('', '');
        $button_tray->addElement(new XoopsFormHidden('requestid', $requestid));
        $button_tray->addElement(new XoopsFormHidden('lid', $mod_array['requestid']));
        $hidden = new XoopsFormHidden('op', 'changeModReq');
        $button_tray->addElement($hidden);
        if ($mod_array) {
            $butt_dup = new XoopsFormButton('', '', _AM_PDD2_BAPPROVE, 'submit');
            $butt_dup->setExtra('onclick="this.form.elements.op.value=\'changeModReq\'"');
            $button_tray->addElement($butt_dup);
        }
        $butt_dupct2 = new XoopsFormButton('', '', _AM_PDD2_BIGNORE, 'submit');
        $butt_dupct2->setExtra('onclick="this.form.elements.op.value=\'ignoreModReq\'"');
        $button_tray->addElement($butt_dupct2);
        $sform->addElement($button_tray);
        $sform->display();

        xoops_cp_footer();
        exit();
        break;
    case 'changeModReq':
        global $xoopsDB, $_POST, $eh, $myts;

        $sql = 'SELECT * FROM ' . $xoopsDB->prefix('PDlinks_mod') . ' WHERE requestid=' . $_POST['requestid'] . '';
        $link_array = $xoopsDB->fetchArray($xoopsDB->query($sql));

        $lid = $link_array['lid'];
        $cid = $link_array['cid'];
        $title = $link_array['title'];
        $url = $link_array['url'];
        $publisher = $xoopsUser->uname();
        $screenshot = $link_array['screenshot'];
        $description = $link_array['description'];
        $submitter = $link_array['modifysubmitter'];
        $updated = time();

        $xoopsDB->query(
            'UPDATE ' . $xoopsDB->prefix('PDlinks_links') . " SET cid = $cid, title = '$title', 
			url = '$url', submitter = '$submitter', screenshot = '$screenshot', publisher = '$publisher', status = '2', updated = '$updated', 
			description = '$description' WHERE lid = $lid"
        );
        $sql = 'DELETE FROM ' . $xoopsDB->prefix('PDlinks_mod') . ' WHERE requestid = ' . $_POST['requestid'] . '';
        $result = $xoopsDB->query($sql);
        redirect_header('index.php', 1, _AM_PDD2_MOD_REQUPDATED);
        break;
    case 'ignoreModReq':
        global $xoopsDB, $_POST;
        $sql = sprintf('DELETE FROM ' . $xoopsDB->prefix('PDlinks_mod') . ' WHERE requestid = ' . $_POST['requestid'] . '');
        $xoopsDB->query($sql);
        redirect_header('index.php', 1, _AM_PDD2_MOD_REQDELETED);
        break;
    case 'main':
    default:

        require_once XOOPS_ROOT_PATH . '/class/xoopstree.php';

        global $xoopsModuleConfig;
        $start = isset($_GET['start']) ? intval($_GET['start']) : 0;
        $mytree = new XoopsTree($xoopsDB->prefix('PDlinks_mod'), 'requestid', 0);

        global $xoopsDB, $myts, $mytree, $xoopsModuleConfig;
        $sql = 'SELECT * FROM ' . $xoopsDB->prefix('PDlinks_mod') . ' ORDER BY requestdate DESC';
        $result = $xoopsDB->query($sql, $xoopsModuleConfig['admin_perpage'], $start);
        $totalmodrequests = $xoopsDB->getRowsNum($xoopsDB->query($sql));

        xoops_cp_header();
        PDd_adminmenu(_AM_PDD2_MOD_MODREQUESTS);
        echo "
		<fieldset><legend style='font-weight: bold; color: #900;'>" . _AM_PDD2_MOD_MODREQUESTSINFO . "</legend>\n
		<div style='padding: 8px;'>" . _AM_PDD2_MOD_TOTMODREQUESTS . " <b>$totalmodrequests<></div>\n
		</fieldset><br>\n

		<table width='100%' cellspacing='1' cellpadding='2' border='0' class='outer'>\n
		<tr>\n
		<th align='center'><b>" . _AM_PDD2_MOD_MODID . "</b></th>\n
		<th><b>" . _AM_PDD2_MOD_MODTITLE . "</b></th>\n
		<th align='center'><b>" . _AM_PDD2_MOD_MODIFYSUBMIT . "</b></th>\n
		<th align='center'><b>" . _AM_PDD2_MOD_DATE . "</b></th>\n
		<th align='center'><b>" . _AM_PDD2_MINDEX_ACTION . "</b></th>\n
		</tr>\n";
        if ($totalmodrequests > 0) {
            while (false !== ($link_arr = $xoopsDB->fetchArray($result))) {
                $path = $mytree->getNicePathFromId($link_arr['requestid'], 'title', 'modifications.php?op=listModReqshow&requestid');
                $path = str_replace('/', '', $path);
                $path = str_replace(':', '', trim($path));
                $title = trim($path);
                $submitter = XoopsUserUtility::getUnameFromId($link_arr['modifysubmitter']);
                $requestdate = formatTimestamp($link_arr['requestdate'], $xoopsModuleConfig['dateformat']);
                echo "
		<tr>\n
		<td class='head' align='center'>" . $link_arr['requestid'] . "</td>\n
		<td class='even'>" . $title . "</td>\n
		<td class='even' align='center'>" . $submitter . "</td>\n
		<td class='even' align='center'>" . $requestdate . "</td>\n
		<td class='even' align='center'> <a href='modifications.php?op=listModReqshow&amp;requestid=" . $link_arr['requestid'] . "'>" . _AM_PDD2_MOD_VIEW . "</a></td>\n
		</tr>\n";
            }
        } else {
            echo "<tr><td class='head' align='center' colspan='7'>" . _AM_PDD2_MOD_NOMODREQUEST . '</td></tr>';
        }
        echo "</table>\n";

        require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
        $page = ($totalmodrequests > $xoopsModuleConfig['admin_perpage']) ? _AM_PDD2_MINDEX_PAGE : '';
        $pagenav = new XoopsPageNav($totalmodrequests, $xoopsModuleConfig['admin_perpage'], $start, 'start');
        echo "<div align='right' style='padding: 8px;'>" . $page . '' . $pagenav->renderNav() . '</div>';
        xoops_cp_footer();
}
