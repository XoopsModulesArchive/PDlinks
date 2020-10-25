<?php
/**
 * $Id: newsstory.php v 1.01 06 july 2004 Liquid Exp $
 * Module: PD-Links
 * Version: v1.0
 * Release Date: 04. März 2005
 * Author: Power-Dreams Team
 * Licence: GNU
 */
require_once XOOPS_ROOT_PATH . '/modules/altern8news/class/class.newsstory.php';

$story = new NewsStory();
$story->setUid($xoopsUser->uid());
$story->setPublished(time());
$story->setExpired(0);
$story->setType('admin');
$story->setHostname(getenv('REMOTE_ADDR'));
$story->setApproved(1);
$topicid = $_POST['newstopicid'];
$story->setTopicId($topicid);
$story->setTitle($title);

$_fileid = (isset($lid) && $lid > 0) ? $lid : $newid;
$_link = $_POST['description'] . '<br><div><a href=' . XOOPS_URL . '/modules/PDlinks/singlefile.php?cid=' . $cid . '&lid=' . $_fileid . '>' . $title . '</a></div>';

$description = $myts->addslashes(trim($_link));
$story->setHometext($description);
$story->setBodytext('');
$nohtml = (empty($nohtml)) ? 0 : 1;
$nosmiley = (empty($nosmiley)) ? 0 : 1;
$story->setNohtml($nohtml);
$story->setNosmiley($nosmiley);
$story->store();
$notificationHandler = xoops_getHandler('notification');
$tags = [];
$tags['STORY_NAME'] = $story->title();

$moduleHandler = xoops_getHandler('module');
$newsModule = $moduleHandler->getByDirname('altern8news');
$tags['STORY_URL'] = XOOPS_URL . '/modules/altern8news/article.php?storyid=' . $story->storyid();
if (!empty($isnew)) {
    $notificationHandler->triggerEvent('story', $story->storyid(), 'approve', $tags);
}
$notificationHandler->triggerEvent('global', 0, 'new_story', $tags);
unset($xoopsModule);
