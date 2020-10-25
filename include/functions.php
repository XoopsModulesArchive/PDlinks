<?php
/**
 * $Id: functions.php v 1.03 06 july 2004 Liquid Exp $
 * Module: PD-Links
 * Version: v1.0
 * Release Date: 04. März 2005
 * Author: Power-Dreams Team
 * Licence: GNU
 * @param mixed $name
 */

// Search if one module exist in database by king76
function SearchModule($name)
{
    global $xoopsDB;

    $sql = $xoopsDB->query('SELECT count(*) FROM ' . $xoopsDB->prefix('modules') . " WHERE dirname = '" . $name . "'");
    [$numrows] = $xoopsDB->fetchRow($sql);
    if ($numrows > 0) {
        return true;
    }
}

function PDd_save_Permissions($groups, $id, $perm_name)
{
    $result = true;
    $hModule = xoops_getHandler('module');
    $PDdModule = &$hModule->getByDirname('PDlinks');

    $module_id = $PDdModule->getVar('mid');
    $gpermHandler = xoops_getHandler('groupperm');

    /*
    * First, if the permissions are already there, delete them
    */
    $gpermHandler->deleteByModule($module_id, $perm_name, $id);
    /*
    *  Save the new permissions
    */
    if (is_array($groups)) {
        foreach ($groups as $group_id) {
            $gpermHandler->addRight($perm_name, $id, $group_id, $module_id);
        }
    }

    return $result;
}

/**
 * toolbar()
 *
 * @return
 **/
function PDd_toolbar()
{
    global $xoopsModuleConfig, $xoopsUser;
    if (is_object($xoopsUser)) {
        $groups = $xoopsUser->getGroups();
        if (array_intersect($xoopsModuleConfig['submitarts'], $groups)) {
            $suballow = 1;
        }
    } else {
        if (isset($xoopsModuleConfig['anonpost']) && 1 == $xoopsModuleConfig['anonpost']) {
            $suballow = 1;
        }
    }
    $toolbar = '[ ';
    if (1 == $suballow) {
        $toolbar .= "<a href='submit.php'>" . _MD_PDD2_SUBMITlink . '</a> | ';
    }
    $toolbar .= "<a href='newlist.php'>" . _MD_PDD2_LATESTLIST . "</a> | <a href='topten.php?list=hit'>" . _MD_PDD2_POPULARITY . "</a> | <a href='topten.php?list=rate'>" . _MD_PDD2_TOPRATED . '</a> ]';

    return $toolbar;
}

/**
 * PDd_serverstats()
 *
 * @return
 **/
function PDd_serverstats()
{
    echo "
		<fieldset><legend style='font-weight: bold; color: #900;'>" . _AM_PDD2_link_IMAGEINFO . "</legend>\n
		<div style='padding: 8px;'>\n
		<div>" . _AM_PDD2_link_SPHPINI . "</div>\n
		";

    $safemode = (ini_get('safe_mode')) ? _AM_PDD2_link_ON . _AM_PDD2_link_SAFEMODEPROBLEMS : _AM_PDD2_link_OFF;
    $registerglobals = ('' == ini_get('register_globals')) ? _AM_PDD2_link_OFF : _AM_PDD2_link_ON;
    $links = (ini_get('file_uploads')) ? _AM_PDD2_link_ON : _AM_PDD2_link_OFF;

    $gdlib = (function_exists('gd_info')) ? _AM_PDD2_link_GDON : _AM_PDD2_link_GDOFF;
    echo '<li>' . _AM_PDD2_link_GDLIBSTATUS . $gdlib;
    if (function_exists('gd_info')) {
        if (true === $gdlib = gd_info()) {
            echo '<li>' . _AM_PDD2_link_GDLIBVERSION . '<b>' . $gdlib['GD Version'] . '</b>';
        }
    }
    echo "<br><br>\n\n";
    echo '<li>' . _AM_PDD2_link_SAFEMODESTATUS . $safemode;
    echo '<li>' . _AM_PDD2_link_REGISTERGLOBALS . $registerglobals;
    echo '<li>' . _AM_PDD2_link_SERVERUPLOADSTATUS . $links;
    echo '</div>';
    echo '</fieldset><br>';
}

/**
 * displayicons()
 *
 * @param         $time
 * @param int $status
 * @param int $counter
 * @return
 */
function PDd_displayicons($time, $status = 0, $counter = 0)
{
    global $xoopsModuleConfig;

    $new = '';
    $pop = '';

    $newdate = (time() - (86400 * intval($xoopsModuleConfig['daysnew'])));
    $popdate = (time() - (86400 * intval($xoopsModuleConfig['daysupdated'])));

    if (3 != $xoopsModuleConfig['displayicons']) {
        if ($newdate < $time) {
            if (intval($status) > 1) {
                if (1 == $xoopsModuleConfig['displayicons']) {
                    $new = '&nbsp;<img src=' . XOOPS_URL . "/modules/PDlinks/images/icon/update.gif alt='' align ='absmiddle'>";
                }
                if (2 == $xoopsModuleConfig['displayicons']) {
                    $new = '<i>Updated!</i>';
                }
            } else {
                if (1 == $xoopsModuleConfig['displayicons']) {
                    $new = '&nbsp;<img src=' . XOOPS_URL . "/modules/PDlinks/images/icon/newred.gif alt='' align ='absmiddle'>";
                }
                if (2 == $xoopsModuleConfig['displayicons']) {
                    $new = '<i>New!</i>';
                }
            }
        }
        if ($popdate < $time) {
            if ($counter >= $xoopsModuleConfig['popular']) {
                if (1 == $xoopsModuleConfig['displayicons']) {
                    $pop = '&nbsp;<img src =' . XOOPS_URL . "/modules/PDlinks/images/icon/pop.gif alt='' align ='absmiddle'>";
                }
                if (2 == $xoopsModuleConfig['displayicons']) {
                    $pop = '<i>Popular</i>';
                }
            }
        }
    }
    $icons = $new . ' ' . $pop;

    return $icons;
}

if (!function_exists('convertorderbyin')) {
    // Reusable Link Sorting Functions
    /**
     * convertorderbyin()
     *
     * @param $orderby
     * @return
     **/
    function convertorderbyin($orderby)
    {
        switch (trim($orderby)) {
            case 'titleA':
                $orderby = 'title ASC';
                break;
            case 'dateA':
                $orderby = 'published ASC';
                break;
            case 'hitsA':
                $orderby = 'hits ASC';
                break;
            case 'ratingA':
                $orderby = 'rating ASC';
                break;
            case 'titleD':
                $orderby = 'title DESC';
                break;
            case 'hitsD':
                $orderby = 'hits DESC';
                break;
            case 'ratingD':
                $orderby = 'rating DESC';
                break;
            case'dateD':
            default:
                $orderby = 'published DESC';
                break;
        }

        return $orderby;
    }
}
if (!function_exists('convertorderbytrans')) {
    function convertorderbytrans($orderby)
    {
        if ('hits ASC' == $orderby) {
            $orderbyTrans = _MD_PDD2_POPULARITYLTOM;
        }
        if ('hits DESC' == $orderby) {
            $orderbyTrans = _MD_PDD2_POPULARITYMTOL;
        }
        if ('title ASC' == $orderby) {
            $orderbyTrans = _MD_PDD2_TITLEATOZ;
        }
        if ('title DESC' == $orderby) {
            $orderbyTrans = _MD_PDD2_TITLEZTOA;
        }
        if ('published ASC' == $orderby) {
            $orderbyTrans = _MD_PDD2_DATEOLD;
        }
        if ('published DESC' == $orderby) {
            $orderbyTrans = _MD_PDD2_DATENEW;
        }
        if ('rating ASC' == $orderby) {
            $orderbyTrans = _MD_PDD2_RATINGLTOH;
        }
        if ('rating DESC' == $orderby) {
            $orderbyTrans = _MD_PDD2_RATINGHTOL;
        }

        return $orderbyTrans;
    }
}
if (!function_exists('convertorderbyout')) {
    function convertorderbyout($orderby)
    {
        if ('title ASC' == $orderby) {
            $orderby = 'titleA';
        }
        if ('published ASC' == $orderby) {
            $orderby = 'dateA';
        }
        if ('hits ASC' == $orderby) {
            $orderby = 'hitsA';
        }
        if ('rating ASC' == $orderby) {
            $orderby = 'ratingA';
        }
        if ('title DESC' == $orderby) {
            $orderby = 'titleD';
        }
        if ('published DESC' == $orderby) {
            $orderby = 'dateD';
        }
        if ('hits DESC' == $orderby) {
            $orderby = 'hitsD';
        }
        if ('rating DESC' == $orderby) {
            $orderby = 'ratingD';
        }

        return $orderby;
    }
}

/**
 * updaterating()
 *
 * @param $sel_id
 * @return updates rating data in itemtable for a given item
 **/
function PDd_updaterating($sel_id)
{
    global $xoopsDB;
    $query = 'select rating FROM ' . $xoopsDB->prefix('PDlinks_votedata') . ' WHERE lid = ' . $sel_id . '';
    $voteresult = $xoopsDB->query($query);
    $votesDB = $xoopsDB->getRowsNum($voteresult);
    $totalrating = 0;
    while (list($rating) = $xoopsDB->fetchRow($voteresult)) {
        $totalrating += $rating;
    }
    $finalrating = $totalrating / $votesDB;
    $finalrating = number_format($finalrating, 4);
    $sql = sprintf('UPDATE %s SET rating = %u, votes = %u WHERE lid = %u', $xoopsDB->prefix('PDlinks_links'), $finalrating, $votesDB, $sel_id);
    $xoopsDB->query($sql);
}

/**
 * totalcategory()
 *
 * @param int $pid
 * @return
 **/
function PDd_totalcategory($pid = 0)
{
    global $xoopsDB, $xoopsModule, $xoopsUser;

    $groups = (is_object($xoopsUser)) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
    $gpermHandler = xoops_getHandler('groupperm');

    $sql = 'SELECT cid FROM ' . $xoopsDB->prefix('PDlinks_cat') . ' ';
    if ($pid > 0) {
        $sql .= 'WHERE pid = 0';
    }
    $result = $xoopsDB->query($sql);
    $catlisting = 0;
    while (list($cid) = $xoopsDB->fetchRow($result)) {
        if ($gpermHandler->checkRight('PDlinkCatPerm', $cid, $groups, $xoopsModule->getVar('mid'))) {
            $catlisting++;
        }
    }

    return $catlisting;
}

/**
 * getTotalItems()
 *
 * @param int $sel_id
 * @param int $get_child
 * @return the total number of items in items table that are accociated with a given table $table id
 **/
function PDd_getTotalItems($sel_id = 0, $get_child = 0)
{
    global $xoopsDB, $mytree, $xoopsModule, $xoopsUser;

    $groups = (is_object($xoopsUser)) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
    $gpermHandler = xoops_getHandler('groupperm');

    $count = 0;
    $published_date = 0;

    $arr = [];
    $query = 'select lid, published from ' . $xoopsDB->prefix('PDlinks_links') . ' 
		WHERE offline = 0 AND published > 0 AND published <= ' . time() . ' AND (expired = 0 OR expired > ' . time() . ')';
    if ($sel_id) {
        $query .= ' AND cid=' . $sel_id . '';
    }
    $result = $xoopsDB->query($query);
    while (list($lid, $published) = $xoopsDB->fetchRow($result)) {
        if ($gpermHandler->checkRight('PDlinkFilePerm', $lid, $groups, $xoopsModule->getVar('mid'))) {
            $count++;
            $published_date = ($published > $published_date) ? $published : $published_date;
        }
    }
    $thing = 0;
    if (1 == $get_child) {
        $arr = $mytree->getAllChildId($sel_id);
        $size = count($arr);
        for ($i = 0; $i < count($arr); $i++) {
            $query2 = 'select lid, published from ' . $xoopsDB->prefix('PDlinks_links') . ' WHERE status > 0 AND offline = 0 AND published > 0 AND published <= ' . time() . ' AND (expired = 0 OR expired > ' . time() . ') AND cid=' . $arr[$i] . '';
            $result2 = $xoopsDB->query($query2);
            while (list($lid, $published) = $xoopsDB->fetchRow($result2)) {
                if ($gpermHandler->checkRight('PDlinkFilePerm', $lid, $groups, $xoopsModule->getVar('mid'))) {
                    $published_date = ($published > $published_date) ? $published : $published_date;
                    $thing++;
                }
            }
        }
    }
    $info['count'] = $count + $thing;
    $info['published'] = $published_date;

    return $info;
}

function PDd_imageheader()
{
    global $xoopsDB, $xoopsModule, $xoopsModuleConfig;

    $image = '';
    $result = $xoopsDB->query('SELECT indeximage, indexheading FROM ' . $xoopsDB->prefix('PDlinks_indexpage ') . ' ');
    [$indeximage, $indexheading] = $xoopsDB->fetchrow($result);
    if (!empty($indeximage)) {
        $image = PDd_displayimage($indeximage, "'index.php'", $xoopsModuleConfig['mainimagedir'], $indexheading);
    }

    return $image;
}

function PDd_displayimage($image = '', $path = '', $imgsource = '', $alttext = '')
{
    global $xoopsConfig, $xoopsUser, $xoopsModule;

    $showimage = '';

    /**
     * Check to see if link is given
     */
    if ($path) {
        $showimage = '<a href=' . $path . '>';
    }

    /**
     * checks to see if the file is valid else displays default blank image
     */

    if (!is_dir(XOOPS_ROOT_PATH . '/' . $imgsource . '/' . $image) && file_exists(XOOPS_ROOT_PATH . '/' . $imgsource . '/' . $image)) {
        $showimage .= "<img src='" . XOOPS_URL . '/' . $imgsource . '/' . $image . "' border='0' alt='" . $alttext . "'></a>";
    } else {
        if ($xoopsUser && $xoopsUser->isAdmin($xoopsModule->mid())) {
            $showimage .= "<img src='" . XOOPS_URL . "/modules/PDlinks/images/brokenimg.png' alt='" . _MD_PDD2_ISADMINNOTICE . "'></a>";
        } else {
            $showimage .= "<img src='" . XOOPS_URL . "/modules/PDlinks/images/blank.png' alt=" . $alttext . '></a>';
        }
    }
    clearstatcache();

    return $showimage;
}

/**
 * link_createthumb()
 *
 * @param         $img_name
 * @param         $img_path
 * @param         $img_savepath
 * @param int $img_w
 * @param int $img_h
 * @param int $quality
 * @param int $update
 * @param int $aspect
 * @return
 **/
function link_createthumb($img_name, $img_path, $img_savepath, $img_w = 100, $img_h = 100, $quality = 100, $update = 0, $aspect = 1)
{
    global $xoopsModuleConfig, $xoopsConfig;
    // paths
    if (0 == $xoopsModuleConfig['usethumbs']) {
        $image_path = XOOPS_URL . "/{$img_path}/{$img_name}";

        return $image_path;
    }
    $image_path = XOOPS_ROOT_PATH . "/{$img_path}/{$img_name}";

    $savefile = $img_path . '/' . $img_savepath . '/' . $img_w . 'x' . $img_h . '_' . $img_name;
    $savepath = XOOPS_ROOT_PATH . '/' . $savefile;
    // Return the image if no update and image exists
    if (0 == $update && file_exists($savepath)) {
        return XOOPS_URL . '/' . $savefile;
    }

    [$width, $height, $type, $attr] = getimagesize($image_path, $info);

    switch ($type) {
        case 1:
            # GIF image
            if (function_exists('imagecreatefromgif')) {
                $img = @imagecreatefromgif($image_path);
            } else {
                $img = @imagecreatefrompng($image_path);
            }
            break;
        case 2:
            # JPEG image
            $img = @imagecreatefromjpeg($image_path);
            break;
        case 3:
            # PNG image
            $img = @imagecreatefrompng($image_path);
            break;
        default:
            return $image_path;
            break;
    }

    if (!empty($img)) {
        /**
         * Get image size and scale ratio
         */
        $scale = min($img_w / $width, $img_h / $height);
        /**
         * If the image is larger than the max shrink it
         */
        if ($scale < 1 && 1 == $aspect) {
            $img_w = floor($scale * $width);
            $img_h = floor($scale * $height);
        }
        /**
         * Create a new temporary image
         */
        if (function_exists('imagecreatetruecolor')) {
            $tmp_img = imagecreatetruecolor($img_w, $img_h);
        } else {
            $tmp_img = imagecreate($img_w, $img_h);
        }
        /**
         * Copy and resize old image into new image
         */
        imagecopyresampled($tmp_img, $img, 0, 0, 0, 0, $img_w, $img_h, $width, $height);
        imagedestroy($img);
        flush();
        $img = $tmp_img;
    }

    switch ($type) {
        case 1:
        default:
            # GIF image
            if (function_exists('imagegif')) {
                imagegif($img, $savepath);
            } else {
                imagepng($img, $savepath);
            }
            break;
        case 2:
            # JPEG image
            imagejpeg($img, $savepath, $quality);
            break;
        case 3:
            # PNG image
            imagepng($img, $savepath);
            break;
    }
    imagedestroy($img);
    flush();

    return XOOPS_URL . '/' . $savefile;
}

function PDd_letters()
{
    global $xoopsModule;

    $letterchoice = '<div>' . _MD_PDD2_BROWSETOTOPIC . '</div>';
    $letterchoice .= '[  ';
    $alphabet = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
    $num = count($alphabet) - 1;
    $counter = 0;
    while (list(, $ltr) = each($alphabet)) {
        $letterchoice .= "<a href='" . XOOPS_URL . "/modules/PDlinks/viewcat.php?list=$ltr'>$ltr</a>";
        if ($counter == round($num / 2)) {
            $letterchoice .= ' ]<br>[ ';
        } elseif ($counter != $num) {
            $letterchoice .= '&nbsp;|&nbsp;';
        }
        $counter++;
    }
    $letterchoice .= ' ]';

    return $letterchoice;
}

function PDd_isnewimage($published)
{
    global $xoopsDB;

    $oneday = (time() - (86400 * 1));
    $threedays = (time() - (86400 * 3));
    $week = (time() - (86400 * 7));

    if ($published > 0 && $published < $week) {
        $indicator['image'] = 'images/icon/linkload4.gif';
        $indicator['alttext'] = _MD_PDD2_NEWLAST;
    } elseif ($published >= $week && $published < $threedays) {
        $indicator['image'] = 'images/icon/linkload3.gif';
        $indicator['alttext'] = _MD_PDD2_NEWTHIS;
    } elseif ($published >= $threedays && $published < $oneday) {
        $indicator['image'] = 'images/icon/linkload2.gif';
        $indicator['alttext'] = _MD_PDD2_THREE;
    } elseif ($published >= $oneday) {
        $indicator['image'] = 'images/icon/linkload1.gif';
        $indicator['alttext'] = _MD_PDD2_TODAY;
    } else {
        $indicator['image'] = 'images/icon/linkload.gif';
        $indicator['alttext'] = _MD_PDD2_NO_FILES;
    }

    return $indicator;
}

function PDd_strrrchr($haystack, $needle)
{
    return mb_substr($haystack, 0, mb_strpos($haystack, $needle) + 1);
}

function PDd_adminmenu($header = '', $menu = '', $extra = '', $scount = 4)
{
    global $xoopsConfig, $xoopsModule;

    if (isset($_SERVER['PHP_SELF'])) {
        $thispage = basename($_SERVER['PHP_SELF']);
    }
    $op = (isset($_GET['op'])) ? $op = '?op=' . $_GET['op'] : '';

    echo "
		<table width='100%' cellspacing='0' cellpadding='0' border='0' class='outer'>\n
		<tr>\n
		<td style='font-size: 10px; text-align: left; color: #2F5376; padding: 2px 6px; line-height: 18px;'>\n
		<a href='../../system/admin.php?fct=preferences&op=showmod&mod=" . $xoopsModule->getVar('mid') . "'>" . _AM_PDD2_PREFS . "</a> | \n
		<a href='../admin/index.php'>" . _AM_PDD2_BINDEX . "</a> | \n
		<a href='../admin/permissions.php'>" . _AM_PDD2_PERMISSIONS . "</a> | \n
		<a href='../admin/myblocksadmin.php'>" . _MI_PDD2_BLOCKADMIN . "</a> | \n
		<a href='../index.php'>" . _AM_PDD2_GOMODULE . "</a> | \n
		<a href='../admin/about.php'>" . _AM_PDD2_ABOUT . "</a> \n
		</td>\n
		</tr>\n
		</table><br>\n
		";

    if (empty($menu)) {
        /**
         * You can change this part to suit your own module. Defining this here will save you form having to do this each time.
         */
        $menu = [
            // _AM_GENERALSET => "" . XOOPS_URL . "/modules/system/admin.php?fct=preferences&op=showmod&mod=" . $xoopsModule->getVar('mid') . "",
            _AM_PDD2_INDEXPAGE => 'indexpage.php',
            _AM_PDD2_MCATEGORY => 'category.php',
            _AM_PDD2_Mlinks => 'index.php?op=linkload',
            _AM_PDD2_MUPLOADS => 'upload.php',
            _AM_PDD2_MVOTEDATA => 'votedata.php',
            _AM_PDD2_MCOMMENTS => '../../system/admin.php?module=' . $xoopsModule->mid() . '&status=0&limit=100&fct=comments&selsubmit=Go',
        ];
    }

    if (!is_array($menu)) {
        echo "
		<table width = '100%' cellpadding= '2' cellspacing= '1' class='outer'>\n
		<tr><td class ='even' align ='center'><b>" . _AM_PDD2_NOMENUITEMS . "</b></td></tr></table><br>\n
		";

        return false;
    }

    $oddnum = [1 => '1', 3 => '3', 5 => '5', 7 => '7', 9 => '9', 11 => '11', 13 => '13'];
    // number of rows per menu
    $menurows = count($menu) / $scount;
    // total amount of rows to complete menu
    $menurow = ceil($menurows) * $scount;
    // actual number of menuitems per row
    $rowcount = $menurow / ceil($menurows);
    $count = 0;
    for ($i = count($menu); $i < $menurow; $i++) {
        $tempArray = [1 => null];
        $menu = array_merge($menu, $tempArray);
        $count++;
    }

    /**
     * Sets up the width of each menu cell
     */
    $width = 100 / $scount;
    $width = ceil($width);

    $menucount = 0;
    $count = 0;
    /**
     * Menu table output
     */
    echo "<table width = '100%' cellpadding= '2' cellspacing= '1' class='outer'><tr>";
    /**
     * Check to see if $menu is and array
     */
    if (is_array($menu)) {
        $classcounts = 0;
        $classcol[0] = 'even';

        for ($i = 1; $i < $menurow; $i++) {
            $classcounts++;
            if ($classcounts >= $scount) {
                if ('odd' == $classcol[$i - 1]) {
                    $classcol[$i] = ('odd' == $classcol[$i - 1] && in_array($classcounts, $oddnum, true)) ? 'even' : 'odd';
                } else {
                    $classcol[$i] = ('even' == $classcol[$i - 1] && in_array($classcounts, $oddnum, true)) ? 'odd' : 'even';
                }
                $classcounts = 0;
            } else {
                $classcol[$i] = ('even' == $classcol[$i - 1]) ? 'odd' : 'even';
            }
        }
        unset($classcounts);

        foreach ($menu as $menutitle => $menulink) {
            if ($thispage . $op == $menulink) {
                $classcol[$count] = 'outer';
            }
            echo "<td class='" . $classcol[$count] . "' align='center' valign='middle' width='$width%'>";
            if (is_string($menulink)) {
                echo "<a href='" . $menulink . "'><small>" . $menutitle . '</small></a></td>';
            } else {
                echo '&nbsp;</td>';
            }
            $menucount++;
            $count++;
            /**
             * Break menu cells to start a new row if $count > $scount
             */
            if ($menucount >= $scount) {
                echo '</tr>';
                $menucount = 0;
            }
        }
        echo '</table><br>';
        unset($count);
        unset($menucount);
    }
    echo "<h3 style='color: #2F5376;'>" . $header . '</h3>';
    if ($extra) {
        echo "<div>$extra</div>";
    }
}

function PDd_getDirSelectOption($selected, $dirarray, $namearray)
{
    echo "<select size='1' name='workd' onchange='location.href=\"upload.php?rootpath=\"+this.options[this.selectedIndex].value'>";
    echo "<option value=''>--------------------------------------</option>";
    foreach ($namearray as $namearray => $workd) {
        if ($workd === $selected) {
            $opt_selected = 'selected';
        } else {
            $opt_selected = '';
        }
        echo "<option value='" . htmlspecialchars($namearray, ENT_QUOTES) . "' $opt_selected>" . $workd . '</option>';
    }
    echo '</select>';
}

function PDd_uploading($_FILES, $uploaddir = 'uploads', $allowed_mimetypes = '', $redirecturl = 'index.php', $num = 0, $redirect = 0, $usertype = 1)
{
    global $_FILES, $xoopsConfig, $xoopsModuleConfig, $_POST, $xoopsModule;

    $down = [];

    require_once XOOPS_ROOT_PATH . '/modules/PDdownloads/class/uploader.php';

    if (empty($allowed_mimetypes)) {
        $allowed_mimetypes = PDd_retmime($_FILES['userfile']['name'], $usertype);
    }
    $upload_dir = XOOPS_ROOT_PATH . '/' . $uploaddir . '/';

    $maxfilesize = $xoopsModuleConfig['maxfilesize'];
    $maxfilewidth = $xoopsModuleConfig['maximgwidth'];
    $maxfileheight = $xoopsModuleConfig['maximgheight'];

    $uploader = new XoopsMediaUploader($upload_dir, $allowed_mimetypes, $maxfilesize, $maxfilewidth, $maxfileheight);
    $uploader->noAdminSizeCheck(1);

    if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
        if (!$uploader->upload()) {
            $errors = $uploader->getErrors();
            redirect_header($redirecturl, 2, $errors);
        } else {
            if ($redirect) {
                redirect_header($redirecturl, 1, _AM_PDD_UPLOADFILE);
            } else {
                if (is_file($uploader->savedDestination)) {
                    $down['url'] = XOOPS_URL . '/' . $uploaddir . '/' . mb_strtolower($uploader->savedFileName);
                    $down['size'] = filesize(XOOPS_ROOT_PATH . '/' . $uploaddir . '/' . mb_strtolower($uploader->savedFileName));
                }

                return $down;
            }
        }
    } else {
        $errors = $uploader->getErrors();
        redirect_header($redirecturl, 1, $errors);
    }
}

function PDd_getforum($forumid)
{
    global $xoopsDB, $xoopsConfig;

    echo "<select name='forumid'>";
    echo "<option value='0'>----------------------</option>";
    $result = $xoopsDB->query('SELECT forum_name, forum_id FROM ' . $xoopsDB->prefix('bb_forums') . ' ORDER BY forum_id');
    while (list($forum_name, $forum_id) = $xoopsDB->fetchRow($result)) {
        if ($forum_id == $forumid) {
            $opt_selected = "selected='selected'";
        } else {
            $opt_selected = '';
        }
        echo "<option value='" . $forum_id . "' $opt_selected>" . $forum_name . '</option>';
    }
    echo '</select></div>';

    return $forumid;
}

function PDd_linklistheader($heading)
{
    echo "
		<fieldset><legend style='font-weight: bold; color: #900;'>" . $heading . "</legend><br>\n
		<table width='100%' cellspacing='1' cellpadding='2' border='0' class = 'outer'>\n
		<tr>\n
		<th align='center'><b>" . _AM_PDD2_MINDEX_ID . "</b></th>\n
		<th><b>" . _AM_PDD2_MINDEX_TITLE . "</b></th>\n
		<th align='center'><b>" . _AM_PDD2_MINDEX_POSTER . "</b></th>\n
		<th align='center'><b>" . _AM_PDD2_MINDEX_SUBMITTED . "</b></th>\n
		<th align='center'><b>" . _AM_PDD2_MINDEX_PUBLISHED . "</b></th>\n
		<th align='center'><b>" . _AM_PDD2_MINDEX_ACTION . "</b></th>\n
		</tr>\n
		";
}

function PDd_linklistbody($published)
{
    global $myts, $imagearray;

    $lid = $published['lid'];
    $cid = $published['cid'];
    $title = "<a href='../singlefile.php?cid=" . $published['cid'] . '&lid=' . $published['lid'] . "'>" . htmlspecialchars(trim($published['title'])) . '</a>';
    $submitter = XoopsUserUtility::getUnameFromId(intval($published['submitter']));
    $publish = formatTimestamp($published['published'], 's');
    $status = ($published['published'] > 0) ? $imagearray['online'] : "<a href='newlinks.php'>" . $imagearray['offline'] . '</a>';
    $offline = (0 == $published['offline']) ? $imagearray['online'] : $imagearray['offline'];
    $modify = "<a href='index.php?op=linkload&lid=" . $lid . "'>" . $imagearray['editimg'] . '</a>';
    $delete = "<a href='index.php?op=dellinkload&lid=" . $lid . "'>" . $imagearray['deleteimg'] . '</a>';

    echo "
		<tr>\n
		<td class='head' align='center'>" . $lid . "</td>\n
		<td class='even'>" . $title . "</td>\n
		<td class='even' align='center'>" . $submitter . "</td>\n
		<td class='even' align='center'>" . $publish . "</td>\n
		<td class='even' align='center'>" . $offline . "</td>\n
		<td class='even' align='center' width = '10%' nowrap>$modify $delete</td>\n
		</tr>\n
		";
    unset($published);
}

function PDd_linklistfooter()
{
    echo "
		<tr>\n
		<td class='head' align='center' colspan= '7'>" . _AM_PDD2_MINDEX_NOlinksFOUND . "</td>\n
		</tr>\n
		";
}

function PDd_linklistpagenav($pubrowamount, $start, $art = 'art')
{
    global $xoopsModuleConfig;

    echo "</table>\n";
    // Display Page Nav if published is > total display pages amount.
    $page = ($pubrowamount > $xoopsModuleConfig['admin_perpage']) ? _AM_PDD2_MINDEX_PAGE : '';
    $pagenav = new XoopsPageNav($pubrowamount, $xoopsModuleConfig['admin_perpage'], $start, 'st' . $art);
    echo '<div align="right" style="padding: 8px;">' . $page . '' . $pagenav->renderNav() . '</div>';
    echo '</fieldset><br>';
}
