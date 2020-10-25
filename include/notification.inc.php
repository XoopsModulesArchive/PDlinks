<?php
/* $Id: notification.inc.php,v 1.3 july 2004 Catwolf Exp $
 * Module: PD-Links
 * Version: v1.0
 * Release Date: 04. März 2005
 * Author: Power-Dreams Team
 * Licence: GNU
 */ /

function PDlinks_notify_iteminfo($category, $item_id)
{
	global $xoopsModule, $xoopsModuleConfig, $xoopsConfig;

	if (empty($xoopsModule) || $xoopsModule->getVar('dirname') != 'PDlinks') {	
		$moduleHandler = xoops_getHandler('module');
		$module = $moduleHandler->getByDirname('PDlinks');
		$configHandler = xoops_getHandler('config');
		$config = $configHandler->getConfigsByCat(0,$module->getVar('mid'));
	} else {
		$module =& $xoopsModule;
		$config = $xoopsModuleConfig;
	}

	if ($category == 'global') {
		$item['name'] = '';
		$item['url'] = '';
		return $item;
	}

	global $xoopsDB;
	if ($category == 'category') {
		// Assume we have a valid category id
		$sql = 'SELECT title FROM ' . $xoopsDB->prefix('PDlinks_cat') . ' WHERE cid = '.$item_id;
		$result = $xoopsDB->query($sql); // TODO: error check
		$result_array = $xoopsDB->fetchArray($result);
		$item['name'] = $result_array['title'];
		$item['url'] = XOOPS_URL . '/modules/PDlinks/viewcat.php?cid=' . $item_id;
		return $item;
	}

	if ($category == 'file') {
		// Assume we have a valid file id
		$sql = 'SELECT cid,title FROM '.$xoopsDB->prefix('PDlinks_links') . ' WHERE lid = ' . $item_id;
		$result = $xoopsDB->query($sql); // TODO: error check
		$result_array = $xoopsDB->fetchArray($result);
		$item['name'] = $result_array['title'];
		$item['url'] = XOOPS_URL . '/modules/PDlinks/singlefile.php?cid=' . $result_array['cid'] . '&lid=' . $item_id;
		return $item;
	}
}
?>
