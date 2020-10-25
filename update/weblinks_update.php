<?php

if (!defined('IS_UPDATE_FILE')) {
    echo 'Cannot access this file directly!';
    exit();
}

/**
 * $Id: weblinks_update.php v 1.00 19 february 2005 Power-Dreams $
 * Module: PD-Links
 * Version: v1.0
 * Release Date: 04. März 2005
 * Author: Power-Dreams Team
 * Licence: GNU
 */
$error = [];
$output = [];
/**
 * Delete newly created tables in PD-Links
 */
$table_array = [
    'PDlinks_broken',
    'PDlinks_cat',
    'PDlinks_links',
    'PDlinks_mod',
    'PDlinks_votedata',
    'PDlinks_indexpage',
];
foreach ($table_array as $table_arr) {
    $result = $xoopsDB->queryF('DROP TABLE ' . $xoopsDB->prefix($table_arr) . ' ');
    if (!$result) {
        $error[] = "<b>Error:</b> Could <span style='color:#ff0000;font-weight:bold'>not delete</span> table <b>$table_arr</b> as it does not exist!";
    } else {
        $output[] = "<b>Success:</b> Table <b>$table_arr</b> was <span style='color:#FF0000;font-weight:bold'>delete</span> Successfully";
    }
}
/**
 * Copy over old links tables without delete;
 */
$table_array = [
    'weblinks_broken' => 'PDlinks_broken',
    'weblinks_category' => 'PDlinks_cat',
    'weblinks_link' => 'PDlinks_links',
    'weblinks_modify' => 'PDlinks_mod',
    'weblinks_votedata' => 'PDlinks_votedata',
];
foreach ($table_array as $table1 => $table2) {
    $result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix(trim($table1)) . ' RENAME TO ' . $xoopsDB->prefix(trim($table2)) . ' ');
    if (!$result) {
        $error[] = "<b>Error:</b> Could <span style='color:#ff0000;font-weight:bold'>not rename</span> table $table1 to table <b>$table2</b>!";
    } else {
        $output[] = "<b>Success:</b> Table <b>$table1</b> was <span style='color:#FF0000;font-weight:bold'>renamed</span> to $table2 Successfully";
    }
    unset($result);
}

/**
 * Create Index Page tables
 */
$result = $xoopsDB->queryF(
    'CREATE TABLE ' . $xoopsDB->prefix('PDlinks_indexpage') . " (
  		indeximage varchar(255) NOT NULL default 'blank.png',
  		indexheading varchar(255) NOT NULL default 'PD-Links',
  		indexheader text NOT NULL,
 		indexfooter text NOT NULL,
 		nohtml tinyint(8) NOT NULL default '1',
		nosmiley tinyint(8) NOT NULL default '1',
		noxcodes tinyint(8) NOT NULL default '1',
		noimages tinyint(8) NOT NULL default '1',
		nobreak tinyint(4) NOT NULL default '0',
		indexheaderalign varchar(25) NOT NULL default 'left',
		indexfooteralign varchar(25) NOT NULL default 'center',
		FULLTEXT KEY indexheading (indexheading),
  		FULLTEXT KEY indexheader (indexheader),
  		FULLTEXT KEY indexfooter (indexfooter)
		)
  	"
);
# Dumping data for table `PDlinks_indexpage`
$xoopsDB->query('INSERT INTO ' . $xoopsDB->prefix('PDlinks_indexpage') . " VALUES ('logo-en.gif', 'PD-Links', '<div><b>Welcome to the PD Links Section.</b></div>', 'PD-Links', 0, 0, 0, 0, 1, 'left', 'Center')");

/**
 * Update broken links
 */
//Add some Fields
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_broken') . " ADD date varchar(11) NOT null default '0'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_broken') . " ADD confirmed enum('0', '1') NOT null default '0'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_broken') . " ADD acknowledged enum('0', '1') NOT null default '0'");

//Change some Fields
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_broken') . ' CHANGE bid reportid int(5) NOT NULL auto_increment');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_broken') . " CHANGE sender sender int(11) NOT NULL default '0'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_broken') . " CHANGE lid lid int(11) NOT NULL default '0'");

/**
 * Update category
 */
//Change some Fields
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_cat') . " CHANGE imgurl imgurl varchar(150) NOT NULL default ''");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_cat') . " CHANGE description description varchar(255) NOT NULL default ''");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_cat') . " CHANGE orders weight int(11) NOT NULL default ''");

//Add some Fields
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_cat') . " ADD spotlighttop int(1) NOT null default '0'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_cat') . " ADD spotlighthis int(11) NOT null default '0'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_cat') . " ADD nohtml int(1) NOT null default '1'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_cat') . " ADD nosmiley int(1) NOT null default '1'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_cat') . " ADD noxcodes int(1) NOT null default '1'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_cat') . " ADD noimages int(1) NOT null default '1'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_cat') . " ADD nobreak int(1) NOT null default '0'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_cat') . " ADD total int(11) NOT NULL default '0'");

//Delete some Fields
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_cat') . ' DROP cflag');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_cat') . ' DROP lflag');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_cat') . ' DROP tflag');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_cat') . ' DROP displayimg');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_cat') . ' DROP catdescription');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_cat') . ' DROP catfooter');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_cat') . ' DROP groupid');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_cat') . ' DROP editaccess');

/**
 * Update links database
 */
//Change some Fields
$time = time();
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . " CHANGE uid submitter int(11) NOT NULL default '0'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . " CHANGE cids cid int(5) unsigned NOT NULL default '0'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . " CHANGE time_create date int(10) NOT NULL default '$time'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . " CHANGE time_update updated int(11) NOT NULL default '0'");

//Add new fields
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . " ADD screenshot varchar(255) NOT null default ''");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . " ADD publisher varchar(255) NOT null default ''");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . " ADD forumid int(11) NOT null default '0'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . " ADD expired int(10) NOT null default '0'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . " ADD offline tinyint(1) NOT null default '0'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . " ADD ipaddress varchar(120) NOT NULL default '0'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . " ADD notifypub int(1) NOT NULL default '0'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . " ADD status tinyint(2) NOT NULL default '0'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . " ADD published int(11) NOT NULL default '$time'");

//Delete some Fields
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . ' DROP banner');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . ' DROP name');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . ' DROP nameflag');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . ' DROP mail');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . ' DROP mailflag');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . ' DROP company');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . ' DROP addr');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . ' DROP tel');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . ' DROP search');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . ' DROP passwd');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . ' DROP admincomment');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . ' DROP mark');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . ' DROP width');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . ' DROP height');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . ' DROP recommend');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . ' DROP mutual');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . ' DROP broken');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . ' DROP rss_url');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . ' DROP rss_flag');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . ' DROP rss_xml');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . ' DROP rss_update');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . ' DROP usercomment');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . ' DROP zip');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . ' DROP state');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . ' DROP city');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . ' DROP addr2');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_links') . ' DROP fax');

/**
 * links modified
 */
//Change some Fields
$time = time();
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . ' CHANGE mid requestid int(11) NOT NULL auto_increment');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . " CHANGE mode status tinyint(2) NOT NULL default '0'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . " CHANGE cids cid int(5) unsigned NOT NULL default '0'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . " CHANGE muid modifysubmitter int(11) NOT NULL default '0'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . " CHANGE title title varchar(255) NOT NULL default ''");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . ' CHANGE description description text NOT NULL');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . " CHANGE time_create date int(10) NOT NULL default '$time'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . " CHANGE time_update updated int(11) NOT NULL default '$time'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . " CHANGE uid submitter int(11) NOT NULL default '0'");

// Add new fields
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . " ADD screenshot varchar(255) NOT null default ''");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . " ADD publisher varchar(255) NOT null default ''");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . " ADD forumid int(11) NOT null default '0'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . " ADD published int(10) NOT null default '0'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . " ADD expired int(10) NOT null default '0'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . " ADD offline tinyint(1) NOT null default '0'");
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . " ADD requestdate int(11) NOT null default '0'");

//Delete some Fields
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . ' DROP recommend');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . ' DROP mutual');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . ' DROP broken');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . ' DROP rss_url');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . ' DROP rss_flag');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . ' DROP rss_xml');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . ' DROP rss_update');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . ' DROP usercomment');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . ' DROP zip');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . ' DROP state');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . ' DROP city');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . ' DROP addr2');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . ' DROP fax');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . ' DROP nameflag');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . ' DROP mail');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . ' DROP mailflag');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . ' DROP company');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . ' DROP addr');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . ' DROP tel');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . ' DROP search');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . ' DROP passwd');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . ' DROP admincomment');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . ' DROP mark');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . ' DROP banner');
$result = $xoopsDB->queryF('ALTER TABLE ' . $xoopsDB->prefix('PDlinks_mod') . ' DROP name');

/**
 * Deleting some Tabels
 */
$result = $xoopsDB->queryF('DROP TABLE ' . $xoopsDB->prefix('weblinks_catlink') . ' ');
$result = $xoopsDB->queryF('DROP TABLE ' . $xoopsDB->prefix('weblinks_atomfeed') . ' ');
$result = $xoopsDB->queryF('DROP TABLE ' . $xoopsDB->prefix('weblinks_config') . ' ');

/**
 * Update comments
 */
$moduleHandler = xoops_getHandler('module');
$PDlinksModule = $moduleHandler->getByDirname('weblinks');
$PD_id = $PDlinksModule->getVar('mid');

$moduleHandler = xoops_getHandler('module');
$linksModule = $moduleHandler->getByDirname('weblinks');
$my_id = $linksModule->getVar('mid');
echo $my_id;
$sql = 'UPDATE ' . $xoopsDB->prefix('xoopscomments') . " SET com_modid = $PD_id WHERE com_modid = $my_id";
$result2 = $xoopsDB->queryF($sql);

echo "<p>...Updating</p>\n";
if (count($error)) {
    foreach ($error as $err) {
        echo $err . '<br>';
    }
}
if (count($output)) {
    echo "<p><span style='color:#0000FF;font-weight:bold'>There where updates made to your database.</span></p>\n";
    foreach ($output as $nonerr) {
        echo $nonerr . '<br>';
    }
}
echo "<p><span><a href='../../admin.php'><b>Finish updating Module</b></a></span></p>\n";
