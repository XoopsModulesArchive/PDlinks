<?php
/**
 * $Id: update.php v 1.03 29 july 2004 Liquid Exp $
 * Module: PD-Links
 * Version: v1.0
 * Release Date: 04. März 2005
 * Author: Power-Dreams Team
 * Licence: GNU
 */
include 'header.php';

define('IS_UPDATE_FILE', true);

global $xoopsDB, $xoopsConfig, $xoopsUser, $xoopsModule;
if (!is_object($xoopsUser) || !is_object($xoopsModule) || !$xoopsUser->isAdmin($xoopsModule->mid())) {
    exit('Access Denied');
}
require XOOPS_ROOT_PATH . '/header.php';

function install_header()
{
    ?>
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
    <html>
    <head>
        <title>PD-Links Upgrade</title>
        <meta http-equiv="Content-Type" content="text/html; charset=">
    </head>
    <body>
    <br><div style="text-align:center"><img src="./images/logo-en.gif" alt=""><h4>PD-Links Update</h4>
    <?php
}

function install_footer()
{
    ?>
    <img src="images/PDdl_slogo.png" alt="XOOPS" border="0"></div>
    </body>
    </html>
    <?php
}

// echo "Welcome to the PD-Links update script";
foreach ($_POST as $k => $v) {
    ${$k} = $v;
}

foreach ($_GET as $k => $v) {
    ${$k} = $v;
}

if (!isset($action) || '' == $action) {
    $action = 'message';
}

if ('message' == $action) {
    install_header();

    $moduleHandler = xoops_getHandler('module');
    $mylinks = $moduleHandler->getByDirname('mylinks');
    if ($mylinks) {
        $mylinks_version = round($mylinks->getVar('version') / 100, 2);
    }

    $moduleHandler = xoops_getHandler('module');
    $weblinks = $moduleHandler->getByDirname('weblinks');
    if ($weblinks) {
        $weblinks_version = round($weblinks->getVar('version') / 100, 2);
    }

    $act_PDlinks = $moduleHandler->getByDirname('PDlinks');
    if ($act_PDlinks) {
        $act_PDlinks_version = $act_PDlinks->getInfo('version');
    }

    echo $act_PDlinks_version;

    /**
     * Set version number
     */

    if (1.0 == $act_PDlinks_version && !$mylinks_version && !$weblinks_version) {
        echo '<h4>Latest version of PD-Links installed. No Update Required</h4>';
        install_footer();
        require_once XOOPS_ROOT_PATH . '/footer.php';
        exit();
    }

    $link_num = 0;
    if (isset($mylinks_version)) {
        $link_num = $mylinks_version;
    }

    if (isset($weblinks_version)) {
        $link_num = $weblinks_version;
    }

    if (isset($PDlinks_version) && 1.0 != $act_PDlinks_version) {
        $link_num = $PDlinks_version;
    }

    echo '<div><b>Welcome to the PD-Links Update script</b></div><br>';
    echo '<div>This script will upgrade My-links or weblinks.</div><br><br>';

    if (0 != $link_num) {
        echo "<div><span style='color:#ff0000;font-weight:bold;'>WARNING: If upgrading from My links or weblinks. The My links Module or weblinks Module will **NOT** function after the upgrade and should be unistalled. </span></div><br>";
        echo '<div><b>Before upgrading PD-Links, make sure that you have:</b></div><br>';
        echo "<div><span style='color:#ff0000; '>1. <b>Important:</b> First, create a back-up from your database before proceeding further. </span></div>";
        echo '<div>2. Upload all the contents of the PD-Links package to your server.</div><br>';
        echo '<div>3. After the upgrade you must update PD-Links in System Admin -> Modules.</div><br>';

        echo '<div><b>Press the button below to ';
        switch ($link_num) {
            case '1.0.1':
            case '1.10':
            case '1.1':
                echo "update My links $link_num</b></div>";
                break;
            case '0.91':
                echo "update weblinks $link_num</b></div>";
                break;
        }

        echo "<form action='" . $HTTP_SERVER_VARS['PHP_SELF'] . "' method='post'>
			<input type='submit' value='Start Upgrade'>
			<input type='hidden' value='upgrade' name='action'>
			<input type='hidden' name='link_num' value=$link_num>
			</form>";
    } else {
        echo '<h4>No module installed to update</h4>';
    }

    install_footer();
    require_once XOOPS_ROOT_PATH . '/footer.php';
    exit();
}
// THIS IS THE UPDATE DATABASE FROM HERE!!!!!!!!! DO NOT TOUCH THIS!!!!!!!!
if ('upgrade' == $action) {
    install_header();

    $num = $_POST['link_num'];

    switch ($num) {
        case '1.0.1':
        case '1.10':
        case '1.1':
            echo "Updating Mylinks $num";
            include 'update/mylinks_update.php';
            break;
        case '0.91':
            echo "Updating weblinks $num";
            include 'update/weblinks_update.php';
            break;
        case '0':
        default:
            echo "Version: $num not supported yet. Please contact the developers of this module";
            break;
    }
    echo 'To complete the upgrade, You must update PD-Links in Xoops System Admin -> Modules';
    echo 'Please enjoy using PD-Links, the Power-Dreams Team';
    require_once XOOPS_ROOT_PATH . '/footer.php';
}

?>
