<?php

declare(strict_types=1);

/**
 * $Id: index.php v 1.12 06 july 2004 Catwolf Exp $
 * Module: PD-Links
 * Version: v1.0
 * Release Date: 04. März 2005
 * Author: Power-Dreams Team
 * Licence: GNU
 */
require __DIR__ . '/admin_header.php';
require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
require_once XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';
require_once '../class/PDd_lists.php';

$mytree = new XoopsTree($xoopsDB->prefix('PDlinks_cat'), 'cid', 'pid');

function linkload()
{
    global $xoopsDB, $_GET, $_POST, $myts, $mytree, $xoopsModuleConfig, $xoopsModule;

    $lid = 0;
    $cid = 0;
    $title = '';
    $url = 'http://';
    $screenshot = '';
    $description = '';
    $forumid = 0;
    $status = 0;
    $is_updated = 0;
    $offline = 0;
    $published = 0;
    $expired = 0;
    $updated = 0;
    $versiontypes = '';
    $publisher = '';
    $ipaddress = '';
    $notifypub = '';

    if (isset($_POST['lid'])) {
        $lid = $_POST['lid'];
    } elseif (isset($_GET['lid'])) {
        $lid = $_GET['lid'];
    } else {
        $lid = 0;
    }
    $directory = $xoopsModuleConfig['screenshots'];

    $result = $xoopsDB->query('SELECT COUNT(*) FROM ' . $xoopsDB->prefix('PDlinks_cat') . '');
    [$numrows] = $xoopsDB->fetchRow($result);

    $link_array = '';

    if ($numrows) {
        xoops_cp_header();

        PDd_adminmenu(_AM_PDD2_Mlinks);

        if ($lid) {
            $sql = 'SELECT * FROM ' . $xoopsDB->prefix('PDlinks_links') . ' WHERE lid=' . $lid . '';
            $link_array = $xoopsDB->fetchArray($xoopsDB->query($sql));

            $lid = $link_array['lid'];
            $cid = $link_array['cid'];
            $title = htmlspecialchars($link_array['title']);
            $url = htmlspecialchars($link_array['url']);
            $publisher = htmlspecialchars($link_array['publisher']);
            $screenshot = htmlspecialchars($link_array['screenshot']);
            $description = htmlspecialchars($link_array['description']);
            $published = $link_array['published'];
            $expired = $link_array['expired'];
            $updated = $link_array['updated'];
            $offline = $link_array['offline'];
            $forumid = $link_array['forumid'];
            $ipaddress = $link_array['ipaddress'];
            $notifypub = $link_array['notifypub'];
            $sform = new XoopsThemeForm(_AM_PDD2_FILE_MODIFYFILE, 'storyform', xoops_getenv('PHP_SELF'));
        } else {
            $sform = new XoopsThemeForm(_AM_PDD2_FILE_CREATENEPDILE, 'storyform', xoops_getenv('PHP_SELF'));
        }

        $sform->setExtra('enctype="multipart/form-data"');
        if ($lid) {
            $sform->addElement(new XoopsFormLabel(_AM_PDD2_FILE_ID, $lid));
        }
        if ($ipaddress) {
            $sform->addElement(new XoopsFormLabel(_AM_PDD2_FILE_IP, $ipaddress));
        }
        $memberHandler = xoops_getHandler('member');
        $group_list = $memberHandler->getGroupList();

        $gpermHandler = xoops_getHandler('groupperm');
        $groups = $gpermHandler->getGroupIds('PDlinkFilePerm', $lid, $xoopsModule->getVar('mid'));

        $groups = ($groups) ? $groups : true;
        $sform->addElement(new XoopsFormSelectGroup(_AM_PDD2_FCATEGORY_GROUPPROMPT, 'groups', true, $groups, 5, true));

        $titles_tray = new XoopsFormElementTray(_AM_PDD2_FILE_TITLE, '<br>');
        $titles = new XoopsFormText('', 'title', 50, 255, $title);
        $titles_tray->addElement($titles);
        $sform->addElement($titles_tray);

        $mytree = new XoopsTree($xoopsDB->prefix('PDlinks_cat'), 'cid ', 'pid');
        $sform->addElement(new XoopsFormText(_AM_PDD2_FILE_DLURL, 'url', 50, 255, $url), true);
        $mytree = new XoopsTree($xoopsDB->prefix('PDlinks_cat'), 'cid', 'pid');
        ob_start();
        $sform->addElement(new XoopsFormHidden('cid', $cid));
        $mytree->makeMySelBox('title', 'title', $cid, 0);
        $sform->addElement(new XoopsFormLabel(_AM_PDD2_FILE_CATEGORY, ob_get_contents()));
        ob_end_clean();

        $sform->addElement(new XoopsFormDhtmlTextArea(_AM_PDD2_FILE_DESCRIPTION, 'description', $description, 15, 60), true);

        $graph_array = &PDsLists:: getListTypeAsArray(XOOPS_ROOT_PATH . '/' . $xoopsModuleConfig['screenshots'], $type = 'images');
        $indeximage_select = new XoopsFormSelect('', 'screenshot', $screenshot);
        $indeximage_select->addOptionArray($graph_array);
        $indeximage_select->setExtra("onchange='showImgSelected(\"image\", \"screenshot\", \"" . $xoopsModuleConfig['screenshots'] . '", "", "' . XOOPS_URL . "\")'");
        $indeximage_tray = new XoopsFormElementTray(_AM_PDD2_FILE_SHOTIMAGE, '&nbsp;');
        $indeximage_tray->addElement($indeximage_select);
        if (!empty($imgurl)) {
            $indeximage_tray->addElement(new XoopsFormLabel('', "<br><br><img src='" . XOOPS_URL . '/' . $xoopsModuleConfig['screenshots'] . '/' . $screenshot . "' name='image' id='image' alt=''>"));
        } else {
            $indeximage_tray->addElement(new XoopsFormLabel('', "<br><br><img src='" . XOOPS_URL . "/uploads/blank.gif' name='image' id='image' alt=''>"));
        }
        $sform->addElement($indeximage_tray);

        $sform->insertBreak(sprintf(_AM_PDD2_FILE_MUSTBEVALID, '<b>' . $directory . '</b>'), 'even');
        ob_start();
        PDd_getforum($forumid);
        $sform->addElement(new XoopsFormLabel(_AM_PDD2_FILE_DISCUSSINFORUM, ob_get_contents()));
        ob_end_clean();

        $publishtext = (!$lid && !$published) ? _AM_PDD2_FILE_SETPUBLISHDATE : _AM_PDD2_FILE_SETNEWPUBLISHDATE;
        if ($published > time()) {
            $publishtext = _AM_PDD2_FILE_SETPUBDATESETS;
        }
        $ispublished = ($published > time()) ? 1 : 0;
        $publishdates = ($published > time()) ? _AM_PDD2_FILE_PUBLISHDATESET . formatTimestamp($published, 'Y-m-d H:s') : _AM_PDD2_FILE_SETDATETIMEPUBLISH;
        $publishdate_checkbox = new XoopsFormCheckBox('', 'publishdateactivate', $ispublished);
        $publishdate_checkbox->addOption(1, $publishdates . '<br><br>');

        if ($lid) {
            $sform->addElement(new XoopsFormHidden('was_published', $published));
            $sform->addElement(new XoopsFormHidden('was_expired', $expired));
        }

        $publishdate_tray = new XoopsFormElementTray(_AM_PDD2_FILE_PUBLISHDATE, '');
        $publishdate_tray->addElement($publishdate_checkbox);
        $publishdate_tray->addElement(new XoopsFormDateTime($publishtext, 'published', 15, $published));
        $publishdate_tray->addElement(new XoopsFormRadioYN(_AM_PDD2_FILE_CLEARPUBLISHDATE, 'clearpublish', 0, ' ' . _YES . '', ' ' . _NO . ''));
        $sform->addElement($publishdate_tray);

        $isexpired = ($expired > time()) ? 1 : 0;
        $expiredates = ($expired > time()) ? _AM_PDD2_FILE_EXPIREDATESET . formatTimestamp($expired, 'Y-m-d H:s') : _AM_PDD2_FILE_SETDATETIMEEXPIRE;
        $warning = ($published > $expired && $expired > time()) ? _AM_PDD2_FILE_EXPIREWARNING : '';
        $expiredate_checkbox = new XoopsFormCheckBox('', 'expiredateactivate', $isexpired);
        $expiredate_checkbox->addOption(1, $expiredates . '<br><br>');

        $expiredate_tray = new XoopsFormElementTray(_AM_PDD2_FILE_EXPIREDATE . $warning, '');
        $expiredate_tray->addElement($expiredate_checkbox);
        $expiredate_tray->addElement(new XoopsFormDateTime(_AM_PDD2_FILE_SETEXPIREDATE . '<br>', 'expired', 15, $expired));
        $expiredate_tray->addElement(new XoopsFormRadioYN(_AM_PDD2_FILE_CLEAREXPIREDATE, 'clearexpire', 0, ' ' . _YES . '', ' ' . _NO . ''));
        $sform->addElement($expiredate_tray);

        $filestatus_radio = new XoopsFormRadioYN(_AM_PDD2_FILE_FILESSTATUS, 'offline', $offline, ' ' . _YES . '', ' ' . _NO . '');
        $sform->addElement($filestatus_radio);

        $up_dated = (0 == $updated) ? 0 : 1;
        $file_updated_radio = new XoopsFormRadioYN(_AM_PDD2_FILE_SETASUPDATED, 'up_dated', $up_dated, ' ' . _YES . '', ' ' . _NO . '');
        $sform->addElement($file_updated_radio);

        //checkt ob die datei defekt ist und zeigt einen radiobutton an - Anfang
        $resultmess = $xoopsDB->query('SELECT COUNT(*) FROM ' . $xoopsDB->prefix('PDlinks_broken') . " WHERE lid=$lid");
        [$countmess] = $xoopsDB->fetchRow($resultmess);
        if ($countmess > 0) {
            $editmess = (0 == $deleditmess) ? 0 : 1;
            $file_updated_radio = new XoopsFormRadioYN(_AM_PDD2_FILE_DELEDITMESS, 'editmess', $editmess, ' ' . _YES . '', ' ' . _NO . '');
            $sform->addElement($editmess_radio);
        }
        //Ende

        require_once XOOPS_ROOT_PATH . '/class/xoopstopic.php';

        /* PDDOWNLOADS - START MOD BY BAERCHN extended by POWER-DREAMS --------------------------------------- */ //for original news modul

        // Search module "news" in database by king76
        if (SearchModule('news')) {
            $sform->insertBreak(_AM_PDD2_FILE_CREATENEWSSTORY, 'bg3');
            $submitNews_radio = new XoopsFormRadioYN(_AM_PDD2_FILE_SUBMITNEWS, 'submitNews', 0, ' ' . _YES . '', ' ' . _NO . '');
            $sform->addElement($submitNews_radio);
            $xt = new XoopsTopic($xoopsDB->prefix('topics'));
            ob_start();
            $xt->makeTopicSelBox(1, 0, 'newstopicid');
            $sform->addElement(new XoopsFormLabel(_AM_PDD2_FILE_NEWSCATEGORY, ob_get_contents()));
            ob_end_clean();
            $sform->addElement(new XoopsFormText(_AM_PDD2_FILE_NEWSTITLE, 'newsTitle', 50, 255, ''), false);
        }

        // Search module "homenews" in database by king76
        if (SearchModule('homenews')) {
            //for homenews modul
            $sform->insertBreak(_AM_PDD2_FILE_CREATENEWSSTORY, 'bg3');
            $submitNews1_radio = new XoopsFormRadioYN(_AM_PDD2_FILE_SUBMITNEWS, 'submitNews1', 0, ' ' . _YES . '', ' ' . _NO . '');
            $sform->addElement($submitNews1_radio);
            $xt = new XoopsTopic($xoopsDB->prefix('homethemen'));
            ob_start();
            $xt->makeTopicSelBox(1, 0, 'newstopicid');
            $sform->addElement(new XoopsFormLabel(_AM_PDD2_FILE_NEWSCATEGORY, ob_get_contents()));
            ob_end_clean();
            $sform->addElement(new XoopsFormText(_AM_PDD2_FILE_NEWSTITLE, 'newsTitle', 50, 255, ''), false);
        }

        // Search module "altern8news" in database by king76
        if (SearchModule('altern8news')) {
            //for altern8news modul
            $sform->insertBreak(_AM_PDD2_FILE_CREATENEWSSTORY, 'bg3');
            $submitNews2_radio = new XoopsFormRadioYN(_AM_PDD2_FILE_SUBMITNEWS, 'submitNews2', 0, ' ' . _YES . '', ' ' . _NO . '');
            $sform->addElement($submitNews2_radio);
            $xt = new XoopsTopic($xoopsDB->prefix('beosthemen'));
            ob_start();
            $xt->makeTopicSelBox(1, 0, 'newstopicid');
            $sform->addElement(new XoopsFormLabel(_AM_PDD2_FILE_NEWSCATEGORY, ob_get_contents()));
            ob_end_clean();
            $sform->addElement(new XoopsFormText(_AM_PDD2_FILE_NEWSTITLE, 'newsTitle', 50, 255, ''), false);
        }
        /* PDDOWNLOADS - END MOD BY BAERCHN extended by POWER-DREAMS --------------------------------------- */

        if ($lid && 0 == $published) {
            $approved = (0 == $published) ? 0 : 1;
            $approve_checkbox = new XoopsFormCheckBox(_AM_PDD2_FILE_EDITAPPROVE, 'approved', 1);
            $approve_checkbox->addOption(1, ' ');
            $sform->addElement($approve_checkbox);
        }

        if (!$lid) {
            $button_tray = new XoopsFormElementTray('', '');
            $button_tray->addElement(new XoopsFormHidden('status', 1));
            $button_tray->addElement(new XoopsFormHidden('notifypub', $notifypub));
            $button_tray->addElement(new XoopsFormHidden('op', 'addlinkload'));
            $button_tray->addElement(new XoopsFormButton('', '', _AM_PDD2_BSAVE, 'submit'));
            $sform->addElement($button_tray);
        } else {
            $button_tray = new XoopsFormElementTray('', '');
            $button_tray->addElement(new XoopsFormHidden('lid', $lid));
            $button_tray->addElement(new XoopsFormHidden('status', 2));
            $hidden = new XoopsFormHidden('op', 'addlinkload');
            $button_tray->addElement($hidden);

            $butt_dup = new XoopsFormButton('', '', _AM_PDD2_BMODIFY, 'submit');
            $butt_dup->setExtra('onclick="this.form.elements.op.value=\'addlinkload\'"');
            $button_tray->addElement($butt_dup);

            $butt_dupct = new XoopsFormButton('', '', _AM_PDD2_BDELETE, 'submit');
            $butt_dupct->setExtra('onclick="this.form.elements.op.value=\'dellinkload\'"');
            $button_tray->addElement($butt_dupct);

            $butt_dupct2 = new XoopsFormButton('', '', _AM_PDD2_BCANCEL, 'submit');
            $butt_dupct2->setExtra('onclick="this.form.elements.op.value=\'linksConfigMenu\'"');
            $button_tray->addElement($butt_dupct2);
            $sform->addElement($button_tray);
        }
        $sform->display();
        unset($hidden);
    } else {
        redirect_header('category.php?', 1, _AM_PDD2_CCATEGORY_NOEXISTS);
        exit();
    }

    if ($lid) {
        global $imagearray;
        // Vote data
        $result01 = $xoopsDB->query('SELECT COUNT(*) FROM ' . $xoopsDB->prefix('PDlinks_votedata') . ' ');
        [$totalvotes] = $xoopsDB->fetchRow($result01);

        $result02 = $xoopsDB->query('SELECT ratingid, ratinguser, rating, ratinghostname, ratingtimestamp FROM ' . $xoopsDB->prefix('PDlinks_votedata') . " WHERE lid = $lid AND ratinguser != 0 ORDER BY ratingtimestamp DESC");
        $votesreg = $xoopsDB->getRowsNum($result02);
        $result03 = $xoopsDB->query('SELECT ratingid, ratinguser, rating, ratinghostname, ratingtimestamp FROM ' . $xoopsDB->prefix('PDlinks_votedata') . " WHERE lid = $lid AND ratinguser = 0 ORDER BY ratingtimestamp DESC");
        $votesanon = $xoopsDB->getRowsNum($result03);

        echo "
		<fieldset><legend style='font-weight: bold; color: #900;'>" . _AM_PDD2_VOTE_RATINGINFOMATION . "</legend>\n
		<div style='padding: 8px;'><b>" . _AM_PDD2_VOTE_TOTALVOTES . '</b>' . $totalvotes . "<br><br>\n
		";

        printf(_AM_PDD2_VOTE_REGUSERVOTES, $votesreg);

        echo '<br>';

        printf(_AM_PDD2_VOTE_ANONUSERVOTES, $votesanon);

        echo "
		</div>\n
		<table width='100%' cellspacing='1' cellpadding='2' class='outer'>\n
		<tr>\n
		<th align='center'>" . _AM_PDD2_VOTE_USER . "</td>\n
		<th align='center'>" . _AM_PDD2_VOTE_IP . "</td>\n
		<th align='center'>" . _AM_PDD2_VOTE_RATING . "</td>\n
		<th align='center'>" . _AM_PDD2_VOTE_USERAVG . "</td>\n
		<th align='center'>" . _AM_PDD2_VOTE_TOTALRATE . "</td>\n
		<th align='center'>" . _AM_PDD2_VOTE_DATE . "</td>\n
		<th align='center'>" . _AM_PDD2_MINDEX_ACTION . "</td>\n
		</tr>\n
		";

        if (0 == $votesreg) {
            echo "<tr><td align='center' colspan='7' class='even'><b>" . _AM_PDD2_VOTE_NOREGVOTES . '</b></td></tr>';
        }
        while (list($ratingid, $ratinguser, $rating, $ratinghostname, $ratingtimestamp) = $xoopsDB->fetchRow($result02)) {
            $result04 = $xoopsDB->query('SELECT rating FROM ' . $xoopsDB->prefix('PDlinks_votedata') . " WHERE ratinguser = $ratinguser");
            $uservotes = $xoopsDB->getRowsNum($result04);
            $formatted_date = formatTimestamp($ratingtimestamp, $xoopsModuleConfig['dateformat']);
            $useravgrating = 0;
            while (list($rating2) = $xoopsDB->fetchRow($result04)) {
                $useravgrating = $useravgrating + $rating2;
            }
            $useravgrating = $useravgrating / $uservotes;
            $useravgrating = number_format($useravgrating, 1);
            $ratinguname = XoopsUser:: getUnameFromId($ratinguser);

            echo "
		<tr><td align='center' class='head'>$ratinguname</td>\n
		<td align='center' class='even'>$ratinghostname</th>\n
		<td align='center' class='even'>$rating</th>\n
		<td align='center' class='even'>$useravgrating</th>\n
		<td align='center' class='even'>$uservotes</th>\n
		<td align='center' class='even'>$formatted_date</th>\n
		<td align='center' class='even'>\n
		<a href='index.php?op=delVote&lid=" . $lid . '&rid=' . $ratingid . "'>" . $imagearray['deleteimg'] . "</a>\n
		</th></tr>\n
		";
        }
        echo "
		</table>\n
		<br>\n
		<table width='100%' cellspacing='1' cellpadding='2' class='outer'>\n
		<tr>\n
		<th align='center'>" . _AM_PDD2_VOTE_USER . "</td>\n
		<th align='center'>" . _AM_PDD2_VOTE_IP . "</td>\n
		<th align='center'>" . _AM_PDD2_VOTE_RATING . "</td>\n
		<th align='center'>" . _AM_PDD2_VOTE_USERAVG . "</td>\n
		<th align='center'>" . _AM_PDD2_VOTE_TOTALRATE . "</td>\n
		<th align='center'>" . _AM_PDD2_VOTE_DATE . "</td>\n
		<th align='center'>" . _AM_PDD2_MINDEX_ACTION . "</td>\n
		</tr>\n
		";
        if (0 == $votesanon) {
            echo "<tr><td colspan='7' align='center' class='even'><b>" . _AM_PDD2_VOTE_NOUNREGVOTES . '</b></td></tr>';
        }
        while (list($ratingid, $ratinguser, $rating, $ratinghostname, $ratingtimestamp) = $xoopsDB->fetchRow($result03)) {
            $result05 = $xoopsDB->query('SELECT rating FROM ' . $xoopsDB->prefix('PDlinks_votedata') . " WHERE ratinguser = $ratinguser");
            $uservotes = $xoopsDB->getRowsNum($result05);
            $formatted_date = formatTimestamp($ratingtimestamp, $xoopsModuleConfig['dateformat']);
            $useravgrating = 0;
            while (list($rating2) = $xoopsDB->fetchRow($result04)) {
                $useravgrating = $useravgrating + $rating2;
            }
            $useravgrating = $useravgrating / $uservotes;
            $useravgrating = number_format($useravgrating, 1);
            $ratinguname = XoopsUser:: getUnameFromId($ratinguser);

            echo "
		<tr><td align='center' class='head'>$ratinguname</td>\n
		<td align='center' class='even'>$ratinghostname</th>\n
		<td align='center' class='even'>$rating</th>\n
		<td align='center' class='even'>$useravgrating</th>\n
		<td align='center' class='even'>$uservotes</th>\n
		<td align='center' class='even'>$formatted_date</th>\n
		<td align='center' class='even'>\n
		<a href='index.php?op=delVote&lid=" . $lid . '&rid=' . $ratingid . "'>" . $imagearray['deleteimg'] . "</a>\n
		</th></tr>\n
		";
        }
        echo "
		</table>\n
		</fieldset>\n
		";
    }
    xoops_cp_footer();
}

function delVote()
{
    global $xoopsDB, $_GET;
    $xoopsDB->queryF('DELETE FROM ' . $xoopsDB->prefix('PDlinks_votedata') . ' WHERE ratingid = ' . $_GET['rid'] . '');
    PDd_updaterating($_GET['lid']);
    redirect_header('index.php', 1, _AM_PDD2_VOTE_VOTEDELETED);
}

function addlinkload()
{
    global $xoopsDB, $xoopsUser, $xoopsModule, $myts, $_FILES, $xoopsModuleConfig;

    $groups = $_POST['groups'] ?? [];
    $lid = (!empty($_POST['lid'])) ? $_POST['lid'] : 0;
    $cid = (!empty($_POST['cid'])) ? $_POST['cid'] : 0;
    $status = (!empty($_POST['status'])) ? $_POST['status'] : 2;
    /**
     * Define URL
     */
    if (empty($_FILES['userfile']['name']) && $_POST['url'] && '' != $_POST['url'] && 'http://' != $_POST['url']) {
        $url = ('http://' != $_POST['url']) ? $myts->addslashes($_POST['url']) : '';
        $title = $myts->addslashes(trim($_POST['title']));
    } else {
        global $_FILES;
        $url = $myts->addslashes($link['url']);
        $title = $_FILES['userfile']['name'];
        $ext = rtrim(mb_strrchr($title, '.'), '.');
        $title = str_replace($ext, '', $title);
        $title = (isset($_POST['title_checkbox']) && 1 == $_POST['title_checkbox']) ? $title : $myts->addslashes(trim($_POST['title']));
    }
    /**
     * Get data from form
     */
    $screenshot = ('blank.png' != $_POST['screenshot']) ? $myts->addslashes($_POST['screenshot']) : '';

    $description = $myts->addslashes(trim($_POST['description']));
    $submitter = $xoopsUser->uid();
    $publisher = $xoopsUser->uname();
    $forumid = (isset($_POST['forumid']) && $_POST['forumid'] > 0) ? intval($_POST['forumid']) : 0;
    $updated = (isset($_POST['was_published']) && 0 == $_POST['was_published']) ? 0 : time();

    if (0 == $_POST['up_dated']) {
        $updated = 0;
        $status = 1;
    }

    $offline = (1 == $_POST['offline']) ? 1 : 0;
    $approved = (isset($_POST['approved']) && 1 == $_POST['approved']) ? 1 : 0;
    $notifypub = (isset($_POST['notifypub']) && 1 == $_POST['notifypub']);

    if (!$lid) {
        $date = time();
        $publishdate = time();
    } else {
        $publishdate = $_POST['was_published'];
        $expiredate = $_POST['was_expired'];
    }

    if (1 == $approved && empty($publishdate)) {
        $publishdate = time();
    }

    if (isset($_POST['publishdateactivate'])) {
        $publishdate = strtotime($_POST['published']['date']) + $_POST['published']['time'];
    }
    if ($_POST['clearpublish']) {
        $result = $xoopsDB->query('SELECT date FROM ' . $xoopsDB->prefix('PDlinks_links') . " WHERE lid=$lid");
        [$date] = $xoopsDB->fetchRow($result);
        $publishdate = $date;
    }

    if (isset($_POST['expiredateactivate'])) {
        $expiredate = strtotime($_POST['expired']['date']) + $_POST['expired']['time'];
    }
    if ($_POST['clearexpire']) {
        $expiredate = '0';
    }
    /**
     * Update or insert linkload data into database
     */
    if (!$lid) {
        $date = time();
        $publishdate = time();
        $ipaddress = $_SERVER['REMOTE_ADDR'];

        $query = 'INSERT INTO ' . $xoopsDB->prefix('PDlinks_links') . ' 
			(lid, cid, title, url, screenshot, submitter, publisher, status, 
			date, hits, rating, votes, comments, forumid, published, expired, updated, offline, description, ipaddress, notifypub)';
        $query .= " VALUES 	('', $cid, '$title', '$url', '$screenshot', 
			'$submitter', '$publisher','$status', '$date', 0, 0, 0, 0, '$forumid', '$publishdate', 
			0, '$updated', '$offline', '$description', '$ipaddress', '0')";
        $result = $xoopsDB->queryF($query);
        $error = 'Information not saved to database: <br><br>';
        $error .= $query;
        if (!$result) {
            trigger_error($error, E_USER_ERROR);
        }
        $newid = $xoopsDB->getInsertId();
        PDd_save_Permissions($groups, $newid, 'PDlinkFilePerm');
    } else {
        $xoopsDB->query(
            'UPDATE ' . $xoopsDB->prefix('PDlinks_links') . " SET cid = $cid, title = '$title', 
			url = '$url', screenshot = '$screenshot', publisher = '$publisher', status = '$status', forumid = '$forumid', published = '$publishdate', 
			expired = '$expiredate', updated = '$updated', offline = '$offline', description = '$description' WHERE lid = $lid"
        );

        PDd_save_Permissions($groups, $lid, 'PDlinkFilePerm');
    }
    /**
     * Send notifications
     */
    if (!$lid) {
        $tags = [];
        $tags['FILE_NAME'] = $title;
        $tags['FILE_URL'] = XOOPS_URL . '/modules/PDlinks/singlefile.php?cid=' . $cid . '&lid=' . $newid;
        $sql = 'SELECT title FROM ' . $xoopsDB->prefix('PDlinks_cat') . ' WHERE cid=' . $cid;
        $result = $xoopsDB->query($sql);
        $row = $xoopsDB->fetchArray($xoopsDB->query($sql));
        $tags['CATEGORY_NAME'] = $row['title'];
        $tags['CATEGORY_URL'] = XOOPS_URL . '/modules/PDlinks/viewcat.php?cid=' . $cid;
        $notificationHandler = xoops_getHandler('notification');
        $notificationHandler->triggerEvent('global', 0, 'new_file', $tags);
        $notificationHandler->triggerEvent('category', $cid, 'new_file', $tags);
    }
    if ($lid && $approved && $notifypub) {
        $tags = [];
        $tags['FILE_NAME'] = $title;
        $tags['FILE_URL'] = XOOPS_URL . '/modules/PDlinks/singlefile.php?cid=' . $cid . '&lid=' . $lid;
        $sql = 'SELECT title FROM ' . $xoopsDB->prefix('mylinks_cat') . ' WHERE cid=' . $cid;
        $result = $xoopsDB->query($sql);
        $row = $xoopsDB->fetchArray($result);
        $tags['CATEGORY_NAME'] = $row['title'];
        $tags['CATEGORY_URL'] = XOOPS_URL . '/modules/PDlinks/viewcat.php?cid=' . $cid;
        $notificationHandler = xoops_getHandler('notification');
        $notificationHandler->triggerEvent('global', 0, 'new_file', $tags);
        $notificationHandler->triggerEvent('category', $cid, 'new_file', $tags);
        $notificationHandler->triggerEvent('file', $lid, 'approve', $tags);
    }
    $message = (!$lid) ? _AM_PDD2_FILE_NEPDILEUPLOAD : _AM_PDD2_FILE_FILEMODIFIEDUPDATE;
    $message = ($lid && !$_POST['was_published'] && $approved) ? _AM_PDD2_FILE_FILEAPPROVED : $message;

    /* PDlinks - START MOD BY POWER-DREAMS --------------------------------------- */
    if (1 == $_POST['editmess']) {
        $xoopsDB->queryF('DELETE FROM ' . $xoopsDB->prefix('PDlinks_broken') . " WHERE lid = '$lid'");
    }

    if (1 == $_POST['submitNews']) {
        $title = (!empty($_POST['newsTitle'])) ? $_POST['newsTitle'] : $title;
        require_once 'newstory.php';
    }
    if (1 == $_POST['submitNews1']) {
        $title = (!empty($_POST['newsTitle'])) ? $_POST['newsTitle'] : $title;
        require_once 'newstory1.php';
    }
    if (1 == $_POST['submitNews2']) {
        $title = (!empty($_POST['newsTitle'])) ? $_POST['newsTitle'] : $title;
        require_once 'newstory2.php';
    }
    /* PDlinks - END MOD BY POWER-DREAMS --------------------------------------- */

    redirect_header('index.php', 1, $message);
}

// Page start here
if (isset($_POST)) {
    foreach ($_POST as $k => $v) {
        $$k = $v;
    }
}

if (isset($_GET)) {
    foreach ($_GET as $k => $v) {
        $$k = $v;
    }
}

if (!isset($_POST['op'])) {
    $op = $_GET['op'] ?? 'main';
} else {
    $op = $_POST['op'];
}

switch ($op) {
    case 'addlinkload':
        addlinkload();
        break;
    case 'linkload':
        linkload();
        break;
    case 'dellinkload':

        global $xoopsDB, $_POST, $xoopsModule, $xoopsModuleConfig;
        $confirm = (isset($confirm)) ? 1 : 0;
        if ($confirm) {
            $file = XOOPS_ROOT_PATH . '/' . $xoopsModuleConfig['uploaddir'] . '/' . basename($_POST['url']);
            if (is_file($file)) {
                @unlink($file);
            }
            $xoopsDB->query('DELETE FROM ' . $xoopsDB->prefix('PDlinks_links') . ' WHERE lid = ' . $_POST['lid'] . '');
            $xoopsDB->query('DELETE FROM ' . $xoopsDB->prefix('PDlinks_votedata') . ' WHERE lid = ' . $_POST['lid'] . '');
            // delete comments
            xoops_comment_delete($xoopsModule->getVar('mid'), $_POST['lid']);
            redirect_header('index.php', 1, sprintf(_AM_PDD2_FILE_FILEWASDELETED, $title));
            exit();
        }
            $lid = (isset($_POST['lid'])) ? $_POST['lid'] : $lid;
            $result = $xoopsDB->query('SELECT lid, title, url FROM ' . $xoopsDB->prefix('PDlinks_links') . " WHERE lid = $lid");
            [$lid, $title, $url] = $xoopsDB->fetchrow($result);
            xoops_cp_header();
            xoops_confirm(['op' => 'dellinkload', 'lid' => $lid, 'confirm' => 1, 'title' => $title, 'url' => $url], 'index.php', _AM_PDD2_FILE_REALLYDELETEDTHIS . '<br><br>' . $title, _DELETE);
            xoops_cp_footer();

        break;
    case 'delVote':
        delVote();
        break;
    case 'main':
    default:

        global $xoopsUser, $xoopsDB, $xoopsConfig;
        require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
        $start = isset($_GET['start']) ? intval($_GET['start']) : 0;
        $start1 = isset($_GET['start1']) ? intval($_GET['start1']) : 0;
        $start2 = isset($_GET['start2']) ? intval($_GET['start2']) : 0;
        $start3 = isset($_GET['start3']) ? intval($_GET['start3']) : 0;
        $start4 = isset($_GET['start4']) ? intval($_GET['start4']) : 0;
        $start5 = isset($_GET['start5']) ? intval($_GET['start5']) : 0;
        $totalcats = PDd_totalcategory();
        $result = $xoopsDB->query('SELECT COUNT(*) FROM ' . $xoopsDB->prefix('PDlinks_broken') . '');
        [$totalbrokenlinks] = $xoopsDB->fetchRow($result);
        $result2 = $xoopsDB->query('SELECT COUNT(*) FROM ' . $xoopsDB->prefix('PDlinks_mod') . '');
        [$totalmodrequests] = $xoopsDB->fetchRow($result2);

        $result3 = $xoopsDB->query('SELECT COUNT(*) FROM ' . $xoopsDB->prefix('PDlinks_links') . ' WHERE published = 0');
        [$totalnewlinks] = $xoopsDB->fetchRow($result3);
        $result4 = $xoopsDB->query('SELECT COUNT(*) FROM ' . $xoopsDB->prefix('PDlinks_links') . ' WHERE published > 0');
        [$totallinks] = $xoopsDB->fetchRow($result4);

        xoops_cp_header();
        PDd_adminmenu(_AM_PDD2_BINDEX);

        echo "
		<fieldset><legend style='font-weight: bold; color: #900;'>" . _AM_PDD2_MINDEX_linkSUMMARY . "</legend>\n
		<div style='padding: 8px;'><small>\n
		<a href='category.php'>" . _AM_PDD2_SCATEGORY . '</a><b>' . $totalcats . "</b> | \n
		<a href='index.php'>" . _AM_PDD2_SFILES . '</a><b>' . $totallinks . "</b> | \n
		<a href='newlinks.php'>" . _AM_PDD2_SNEPDILESVAL . '</a><b>' . $totalnewlinks . "</b> | \n
		<a href='modifications.php'>" . _AM_PDD2_SMODREQUEST . '</a><b>' . $totalmodrequests . "</b> | \n
		<a href='brokenlink.php'>" . _AM_PDD2_SBROKENSUBMIT . '</a><b>' . $totalbrokenlinks . "</b> | \n
		</small></div></fieldset><br>\n
		";

        PDd_serverstats();

        if ($totalcats > 0) {
            require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
            $mytree = new XoopsTree($xoopsDB->prefix('PDlinks_cat'), 'cid', 'pid');
            $sform = new XoopsThemeForm(_AM_PDD2_CCATEGORY_MODIFY, 'category', 'category.php');
            ob_start();
            $sform->addElement(new XoopsFormHidden('cid', ''));
            $mytree->makeMySelBox('title', 'title');
            $sform->addElement(new XoopsFormLabel(_AM_PDD2_CCATEGORY_MODIFY_TITLE, ob_get_contents()));
            ob_end_clean();
            $dup_tray = new XoopsFormElementTray('', '');
            $dup_tray->addElement(new XoopsFormHidden('op', 'modCat'));
            $butt_dup = new XoopsFormButton('', '', _AM_PDD2_BMODIFY, 'submit');
            $butt_dup->setExtra('onclick="this.form.elements.op.value=\'modCat\'"');
            $dup_tray->addElement($butt_dup);
            $butt_dupct = new XoopsFormButton('', '', _AM_PDD2_BDELETE, 'submit');
            $butt_dupct->setExtra('onclick="this.form.elements.op.value=\'del\'"');
            $dup_tray->addElement($butt_dupct);
            $sform->addElement($dup_tray);
            $sform->display();
        }

        if ($totallinks > 0) {
            $sql = 'SELECT * FROM ' . $xoopsDB->prefix('PDlinks_links') . ' 
				WHERE published > 0 AND published <= ' . time() . ' AND (expired = 0 OR expired > ' . time() . ') 
				AND offline = 0 ORDER BY lid DESC';
            $published_array = $xoopsDB->query($sql, $xoopsModuleConfig['admin_perpage'], $start);
            $published_array_count = $xoopsDB->getRowsNum($xoopsDB->query($sql));

            PDd_linklistheader(_AM_PDD2_MINDEX_PUBLISHEDlink);
            if ($published_array_count > 0) {
                while (false !== ($published = $xoopsDB->fetchArray($published_array))) {
                    PDd_linklistbody($published);
                }
            } else {
                PDd_linklistfooter();
            }
            PDd_linklistpagenav($published_array_count, $start, 'art');

            /**
             * Auto Publish
             */
            $sql = 'SELECT * FROM ' . $xoopsDB->prefix('PDlinks_links') . ' 
				WHERE published > ' . time() . ' ORDER BY lid DESC';
            $auto_publish_array = $xoopsDB->query($sql, $xoopsModuleConfig['admin_perpage'], $start2);
            $auto_publish_count = $xoopsDB->getRowsNum($xoopsDB->query($sql));
            PDd_linklistheader(_AM_PDD2_MINDEX_AUTOPUBLISHEDlink);
            if ($auto_publish_count > 0) {
                while (false !== ($auto_publish = $xoopsDB->fetchArray($auto_publish_array))) {
                    PDd_linklistbody($auto_publish);
                }
            } else {
                PDd_linklistfooter();
            }
            PDd_linklistpagenav($auto_publish_count, $start2, 'art2');

            /**
             * Auto expire
             */
            $sql = 'SELECT * FROM ' . $xoopsDB->prefix('PDlinks_links') . ' 
				WHERE expired > ' . time() . ' ORDER BY lid DESC';
            $auto_expire_array = $xoopsDB->query($sql, $xoopsModuleConfig['admin_perpage'], $start3);
            $auto_expire_count = $xoopsDB->getRowsNum($xoopsDB->query($sql));

            PDd_linklistheader(_AM_PDD2_MINDEX_AUTOEXPIRE);
            if ($auto_expire_count > 0) {
                while (false !== ($auto_expire = $xoopsDB->fetchArray($auto_expire_array))) {
                    PDd_linklistbody($auto_expire);
                }
            } else {
                PDd_linklistfooter();
            }
            PDd_linklistpagenav($auto_expire_count, $start3, 'art3');

            /**
             * Expired
             */
            $sql = 'SELECT * FROM ' . $xoopsDB->prefix('PDlinks_links') . ' 
				WHERE expired < ' . time() . ' AND expired > 0 ORDER BY lid DESC';
            $expired_array = $xoopsDB->query($sql, $xoopsModuleConfig['admin_perpage'], $start4);
            $expired_count = $xoopsDB->getRowsNum($xoopsDB->query($sql));

            PDd_linklistheader(_AM_PDD2_MINDEX_EXPIRED);
            if ($expired_count > 0) {
                while (false !== ($expired = $xoopsDB->fetchArray($expired_array))) {
                    PDd_linklistbody($expired);
                }
            } else {
                PDd_linklistfooter();
            }
            PDd_linklistpagenav($expired_count, $start4, 'art4');

            /**
             * Offline
             */
            $sql = 'SELECT * FROM ' . $xoopsDB->prefix('PDlinks_links') . ' WHERE 
				offline = 1 ORDER BY lid DESC';
            $offline_array = $xoopsDB->query($sql, $xoopsModuleConfig['admin_perpage'], $start5);
            $offline_count = $xoopsDB->getRowsNum($xoopsDB->query($sql));

            PDd_linklistheader(_AM_PDD2_MINDEX_OFFLINElink);
            if ($offline_count > 0) {
                while (false !== ($is_offline = $xoopsDB->fetchArray($offline_array))) {
                    PDd_linklistbody($is_offline);
                }
            } else {
                PDd_linklistfooter();
            }
            PDd_linklistpagenav($offline_count, $start5, 'art5');
        }
        xoops_cp_footer();
        break;
}
