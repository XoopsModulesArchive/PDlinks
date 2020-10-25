<?php

function b_sitemap_PDlinks()
{
    $xoopsDB = XoopsDatabaseFactory::getDatabaseConnection();

    $block = sitemap_get_categoires_map($xoopsDB->prefix('PDlinks_cat'), 'cid', 'pid', 'title', 'viewcat.php?cid=', 'title');

    return $block;
}
