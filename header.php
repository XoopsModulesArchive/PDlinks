<?php
/**
 * $Id: header.php v 1.0.2 02 july 2004 Liquid Exp $
 * Module: PD-Links
 * Version: v1.0
 * Release Date: 04. März 2005
 * Author: Power-Dreams Team
 * Licence: GNU
 */
require_once dirname(__DIR__, 2) . '/mainfile.php';
require XOOPS_ROOT_PATH . '/modules/PDlinks/include/functions.php';

if (!file_exists('language/' . $xoopsConfig['language'] . '/main.php')) {
    include 'language/' . $xoopsConfig['language'] . '/main.php';
}

$myts = &MyTextSanitizer:: getInstance(); // MyTextSanitizer object
