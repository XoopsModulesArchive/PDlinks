<?php
/**
 * $Id: submit.php v 1.0.4 06 july 2004 Liquid Exp $
 * Module: PD-Links
 * Version: v1.0
 * Release Date: 04. März 2005
 * Author: Power-Dreams Team
 * Licence: GNU
 */
require __DIR__ . '/header.php';
require_once XOOPS_ROOT_PATH . '/class/xoopstree.php';
require_once XOOPS_ROOT_PATH . '/include/xoopscodes.php';
require XOOPS_ROOT_PATH . '/header.php';
require XOOPS_ROOT_PATH . '/class/xoopsformloader.php';

$myts = MyTextSanitizer::getInstance(); // MyTextSanitizer object
$mytree = new XoopsTree($xoopsDB->prefix('PDlinks_cat'), 'cid', 'pid');

global $xoopsDB, $myts, $mytree, $xoopsModuleConfig, $xoopsUser;
if (is_object($xoopsUser)) {
    $groups = $xoopsUser->getGroups();
    if (!array_intersect($xoopsModuleConfig['submitarts'], $groups)) {
        redirect_header('index.php', 1, _MD_PDD2_NOTALLOWESTOSUBMIT);
        exit();
    }
    $suballow = 1;
} else {
    if (isset($xoopsModuleConfig['anonpost']) && 1 == !$xoopsModuleConfig['anonpost']) {
        redirect_header('index.php', 1, _MD_PDD2_NOTALLOWESTOSUBMIT);
        exit();
    }
    $suballow = 1;
}
if (1 == $suballow) {
    if (isset($_POST['submit']) && !empty($_POST['submit'])) {
        $notify = !empty($_POST['notify']) ? 1 : 0;

        $lid = (!empty($_POST['lid'])) ? intval($_POST['lid']) : 0;
        $cid = (!empty($_POST['cid'])) ? intval($_POST['cid']) : 0;

        if (empty($_FILES['userfile']['name']) && $_POST['url'] && '' != $_POST['url'] && 'http://' != $_POST['url']) {
            $url = ('http://' != $_POST['url']) ? $myts->addslashes($_POST['url']) : '';
            $title = $myts->addslashes(trim($_POST['title']));
        } else {
            global $_FILES;
            $url = $link['url'];
            $title = $_FILES['userfile']['name'];
            $title = rtrim(PDd_strrrchr($title, '.'), '.');
            $title = (isset($_POST['title_checkbox']) && 1 == $_POST['title_checkbox']) ? $title : $myts->addslashes(trim($_POST['title']));
        }

        $descriptionb = $myts->addslashes(trim($_POST['descriptionb']));
        $submitter = !empty($xoopsUser) ? $xoopsUser->getVar('uid') : 0;
        $forumid = (isset($_POST['forumid']) && $_POST['forumid'] > 0) ? intval($_POST['forumid']) : 0;
        $offline = (isset($_POST['offline']) && 1 == $_POST['offline']) ? 1 : 0;
        $date = time();
        $publishdate = 0;
        $notifypub = (isset($_POST['notifypub']) && 1 == $_POST['notifypub']) ? 1 : 0;

        $ipaddress = $_SERVER['REMOTE_ADDR'];
        if (0 == $lid) {
            if (1 == $xoopsModuleConfig['autoapprove']) {
                $publishdate = time();
                $status = 1;
            }
            $status = (1 == $xoopsModuleConfig['autoapprove']) ? 1 : 0;
            $query = 'INSERT INTO ' . $xoopsDB->prefix('PDlinks_links') . ' 
			(lid, cid, title, url, submitter, status, 
			date, hits, rating, votes, comments, forumid, published, expired, offline, description, ipaddress, notifypub)';
            $query .= " VALUES 	('', $cid, '$title', '$url',   
			'$submitter', '$status', '$date', 0, 0, 0, 0, '$forumid', '$publishdate', 
			0, '$offline', '$descriptionb', '$ipaddress', '$notifypub')";
            $result = $xoopsDB->queryF($query);
            $error = _MD_PDD2_INFONOSAVEDB;
            $error .= $query;
            if (!$result) {
                trigger_error($error, E_USER_ERROR);
            }
            $newid = $xoopsDB->getInsertId();
            $groups = [1, 2];
            PDd_save_Permissions($groups, $newid, 'PDlinkFilePerm');
            /*
            *  Notify of new link (anywhere) and new link in category
            */
            $notificationHandler = xoops_getHandler('notification');
            $tags = [];
            $tags['FILE_NAME'] = $title;
            $tags['FILE_URL'] = XOOPS_URL . '/modules/PDlinks/singlefile.php?cid=' . $cid . '&lid=' . $newid;
            $sql = 'SELECT title FROM ' . $xoopsDB->prefix('mylinks_cat') . ' WHERE cid=' . $cid;
            $result = $xoopsDB->query($sql);
            $row = $xoopsDB->fetchArray($result);
            $tags['CATEGORY_NAME'] = $row['title'];
            $tags['CATEGORY_URL'] = XOOPS_URL . '/modules/PDlinks/viewcat.php?cid=' . $cid;
            if (1 == $xoopsModuleConfig['autoapprove']) {
                $notificationHandler->triggerEvent('global', 0, 'new_file', $tags);
                $notificationHandler->triggerEvent('category', $cid, 'new_file', $tags);
                redirect_header('index.php', 2, _MD_PDD2_ISAPPROVED . '');
            } else {
                $tags['WAITINGFILES_URL'] = XOOPS_URL . '/modules/PDlinks/admin/newlinks.php';
                $notificationHandler->triggerEvent('global', 0, 'file_submit', $tags);
                $notificationHandler->triggerEvent('category', $cid, 'file_submit', $tags);
                if ($notify) {
                    require_once XOOPS_ROOT_PATH . '/include/notification_constants.php';
                    $notificationHandler->subscribe('file', $newid, 'approve', XOOPS_NOTIFICATION_MODE_SENDONCETHENDELETE);
                }
                redirect_header('index.php', 2, _MD_PDD2_THANKSFORINFO);
            }
            exit();
        }
        $updated = (isset($_POST['up_dated']) && 0 == $_POST['up_dated']) ? 0 : time();

        if (1 == $xoopsModuleConfig['autoapprove']) {
            $updated = time();
            $xoopsDB->query(
                'UPDATE ' . $xoopsDB->prefix('PDlinks_links') . " SET cid = $cid, title = '$title', 
			url = '$url', updated = '$updated', offline = '$offline', description = '$descriptionb', ipaddress = '$ipaddress', notifypub = '$notifypub' WHERE lid = $lid"
            );
            $notificationHandler = xoops_getHandler('notification');
            $tags = [];
            $tags['FILE_NAME'] = $title;
            $tags['FILE_URL'] = XOOPS_URL . '/modules/PDlinks/singlefile.php?cid=' . $cid . '&lid=' . $lid;
            $sql = 'SELECT title FROM ' . $xoopsDB->prefix('PDlinks_cat') . ' WHERE cid=' . $cid;
            $result = $xoopsDB->query($sql);
            $row = $xoopsDB->fetchArray($result);
            $tags['CATEGORY_NAME'] = $row['title'];
            $tags['CATEGORY_URL'] = XOOPS_URL . '/modules/PDlinks/viewcat.php?cid=' . $cid;
        } else {
            $modifysubmitter = $xoopsUser->uid();
            $requestid = $modifysubmitter;
            $requestdate = time();
            $sql = 'INSERT INTO ' . $xoopsDB->prefix('PDlinks_mod') . ' 
				(requestid, lid, cid, title, url, forumid, description, modifysubmitter, requestdate)';
            $sql .= " VALUES 	('', $lid, $cid, '$title', '$url', '$forumid', '$descriptionb', 
				'$modifysubmitter', '$requestdate')";
            $result = $xoopsDB->query($sql);
            $error = '' . _MD_PDD2_ERROR . ': <br><br>' . $sql;
            if (!$result) {
                trigger_error($error, E_USER_ERROR);
            }
            $tags = [];
            $tags['MODIFYREPORTS_URL'] = XOOPS_URL . '/modules/PDlinks/admin/index.php?op=listModReq';
            $notificationHandler = xoops_getHandler('notification');
            $notificationHandler->triggerEvent('global', 0, 'file_modify', $tags);
        }

        if (1 == $xoopsModuleConfig['autoapprove']) {
            $notificationHandler->triggerEvent('global', 0, 'new_file', $tags);
            $notificationHandler->triggerEvent('category', $cid, 'new_file', $tags);
            redirect_header('index.php', 2, _MD_PDD2_ISAPPROVED . '');
        } else {
            $tags['WAITINGFILES_URL'] = XOOPS_URL . '/modules/PDlinks/admin/index.php?op=listNewlinks';
            $notificationHandler->triggerEvent('global', 0, 'file_submit', $tags);
            $notificationHandler->triggerEvent('category', $cid, 'file_submit', $tags);
            if ($notify) {
                require_once XOOPS_ROOT_PATH . '/include/notification_constants.php';
                $notificationHandler->subscribe('file', $newid, 'approve', XOOPS_NOTIFICATION_MODE_SENDONCETHENDELETE);
            }
            redirect_header('index.php', 2, _MD_PDD2_THANKSFORINFO);
            exit();
        }
    } else {
        global $_FILES, $xoopsModuleConfig, $xoopsConfig;

        if ($xoopsModuleConfig['showdisclaimer'] && !isset($_GET['agree'])) {
            echo "
		<p><div align = 'center'>" . PDd_imageheader() . "</div></p>\n
		<h4>" . _MD_PDD2_DISCLAIMERAGREEMENT . "</h4>\n
		<p><div>" . $myts->displayTarea($xoopsModuleConfig['disclaimer'], 0, 1, 1, 1, 1) . "</div></p>\n
		<form action='submit.php' method='post'>\n
		<div align='center'><b>" . _MD_PDD2_DOYOUAGREE . "</b><br><br>\n
		<input type = 'button' onclick = 'location=\"submit.php?agree=1\"' class='formButton' value='" . _MD_PDD2_AGREE . "' alt='" . _MD_PDD2_AGREE . "'>\n
		&nbsp;\n
		<input type='button' onclick = 'location=\"index.php\"' class='formButton' value='" . _CANCEL . "' alt='" . _CANCEL . "'>\n
		</div></form>\n";
            require XOOPS_ROOT_PATH . '/footer.php';
            exit();
        }

        $lid = 0;
        $cid = 0;
        $title = '';
        $url = 'http://';
        $descriptionb = '';
        $forumid = 0;
        $status = 0;
        $is_updated = 0;
        $offline = 0;
        $published = 0;
        $expired = 0;
        $updated = 0;
        $versiontypes = '';

        if (isset($_POST['lid'])) {
            $lid = $_POST['lid'];
        } elseif (isset($_GET['lid'])) {
            $lid = $_GET['lid'];
        } else {
            $lid = 0;
        }

        echo "
		<p><div align = 'center'>" . PDd_imageheader() . "</div></p>\n
		<div>" . _MD_PDD2_SUB_SNEWMNAMEDESC . "</div>\n";
        if ($lid) {
            $sql = 'SELECT * FROM ' . $xoopsDB->prefix('PDlinks_links') . ' WHERE lid=' . $lid . '';
            $link_array = $xoopsDB->fetchArray($xoopsDB->query($sql));

            $lid = htmlspecialchars($link_array['lid']);
            $cid = htmlspecialchars($link_array['cid']);
            $title = htmlspecialchars($link_array['title']);
            $url = htmlspecialchars($link_array['url']);
            $descriptionb = htmlspecialchars($link_array['description']);
            $published = htmlspecialchars($link_array['published']);
            $expired = htmlspecialchars($link_array['expired']);
            $updated = htmlspecialchars($link_array['updated']);
            $offline = htmlspecialchars($link_array['offline']);
        }
        $sform = new XoopsThemeForm(_MD_PDD2_SUBMITCATHEAD, 'storyform', xoops_getenv('PHP_SELF'));
        $sform->setExtra('enctype="multipart/form-data"');

        $sform->addElement(new XoopsFormText(_MD_PDD2_FILETITLE, 'title', 50, 255, $title), true);
        $sform->addElement(new XoopsFormText(_MD_PDD2_DLURL, 'url', 50, 255, $url), false);
        if ($xoopsModuleConfig['useruploads']) {
            $sform->addElement(new XoopsFormFile(_MD_PDD2_UPLOAD_FILEC, 'userfile', 0), false);
        }

        $mytree = new XoopsTree($xoopsDB->prefix('PDlinks_cat'), 'cid', 'pid');
        ob_start();
        $sform->addElement(new XoopsFormHidden('cid', 'pid'));
        $mytree->makeMySelBox('title', 'title', $cid, 0);
        $sform->addElement(new XoopsFormLabel(_MD_PDD2_CATEGORYC, ob_get_contents()));
        ob_end_clean();

        $sform->addElement(new XoopsFormDhtmlTextArea(_MD_PDD2_DESCRIPTION, 'descriptionb', $descriptionb, 15, 60), true);

        $option_tray = new XoopsFormElementTray(_MD_PDD2_OPTIONS, '<br>');
        $notify_checkbox = new XoopsFormCheckBox('', 'notifypub');
        $notify_checkbox->addOption(1, _MD_PDD2_NOTIFYAPPROVE);
        $option_tray->addElement($notify_checkbox);
        $sform->addElement($option_tray);
        $button_tray = new XoopsFormElementTray('', '');

        $button_tray->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
        $button_tray->addElement(new XoopsFormHidden('lid', $lid));
        $sform->addElement($button_tray);
        $sform->display();
        require XOOPS_ROOT_PATH . '/footer.php';
    }
}
