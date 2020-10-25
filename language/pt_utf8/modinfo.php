<?php
/**
 * $Id: main.php v 1.15 02 july 2004 Liquid Exp $
 * Module: PD-links
 * Version: v1.0
 * Release Date: 04. März 2005
 * Author: Power-Dreams Team
 * Licence: GNU
 */

// Module Info
// The name of this module
define('_MI_PDD2_NAME', 'PD-links');
// A brief description of this module
define('_MI_PDD2_DESC', 'Creates a links section where users can link/submit/rate various files.');
// Names of blocks for this module (Not all module has blocks)
define('_MI_PDD2_BNAME1', 'Recent PD-links');
define('_MI_PDD2_BNAME2', 'Top PD-links');
// Sub menu titles
define('_MI_PDD2_SMNAME1', 'Submit');
define('_MI_PDD2_SMNAME2', 'Popular');
define('_MI_PDD2_SMNAME3', 'Top Rated');
// Names of admin menu items
define('_MI_PDD2_BINDEX', 'Main Index');
define('_MI_PDD2_INDEXPAGE', 'Index Page Management');
define('_MI_PDD2_MCATEGORY', 'Category Management');
define('_MI_PDD2_Mlinks', 'File Management');
define('_MI_PDD2_MUPLOADS', 'Image Upload');
define('_MI_PDD2_PERMISSIONS', 'Permission Settings');
define('_MI_PDD2_BLOCKADMIN', 'Block Settings');
define('_MI_PDD2_MVOTEDATA', 'Votes');
// Title of config items
define('_MI_PDD2_POPULAR', 'link Popular Count');
define('_MI_PDD2_POPULARDSC', 'The number of hits before a link status will be considered as popular.');
//Display Icons
define('_MI_PDD2_ICONDISPLAY', 'links Popular and New:');
define('_MI_PDD2_DISPLAYICONDSC', 'Select how to display the popular and new icons in link listing.');
define('_MI_PDD2_DISPLAYICON1', 'Display As Icons');
define('_MI_PDD2_DISPLAYICON2', 'Display As Text');
define('_MI_PDD2_DISPLAYICON3', 'Do Not Display');
define('_MI_PDD2_DAYSNEW', 'links Days New:');
define('_MI_PDD2_DAYSNEWDSC', 'The number of days a link status will be considered as new.');
define('_MI_PDD2_DAYSUPDATED', 'links Days Updated:');
define('_MI_PDD2_DAYSUPDATEDDSC', 'The amount of days a link status will be considered as updated.');
define('_MI_PDD2_PERPAGE', 'link Listing Count:');
define('_MI_PDD2_PERPAGEDSC', 'Number of links to display in each category listing.');
define('_MI_PDD2_USESHOTS', 'Display Screenshot Images?');
define('_MI_PDD2_USESHOTSDSC', 'Select yes to display screenshot images for each link item');
define('_MI_PDD2_SHOTWIDTH', 'Image Display Width');
define('_MI_PDD2_SHOTWIDTHDSC', 'Display width for screenshot image');
define('_MI_PDD2_SHOTHEIGHT', 'Image Display Height');
define('_MI_PDD2_SHOTHEIGHTDSC', 'Display height for screenshot image');
define('_MI_PDD2_CHECKHOST', 'Disallow direct link linking? (leeching)');
define('_MI_PDD2_REFERERS', 'These sites can directly link to your files <br>Separate with #');
define('_MI_PDD2_ANONPOST', 'Anonymous User Submission:');
define('_MI_PDD2_ANONPOSTDSC', 'Allow Anonymous users to submit or upload to your website?');
define('_MI_PDD2_AUTOAPPROVE', 'Auto Approve Submitted links');
define('_MI_PDD2_AUTOAPPROVEDSC', 'Select to approve submitted links without moderation.');
define('_MI_PDD2_MAXFILESIZE', 'Upload Size (KB)');
define('_MI_PDD2_MAXFILESIZEDSC', 'Maximum file size permitted with file uploads.');
define('_MI_PDD2_IMGWIDTH', 'Upload Image width');
define('_MI_PDD2_IMGWIDTHDSC', 'Maximum image width permitted when uploading image files');
define('_MI_PDD2_IMGHEIGHT', 'Upload Image height');
define('_MI_PDD2_IMGHEIGHTDSC', 'Maximum image height permitted when uploading image files');
define('_MI_PDD2_UPLOADDIR', 'Upload Directory (No trailing slash)');
define('_MI_PDD2_ALLOWSUBMISS', 'User Submissions:');
define('_MI_PDD2_ALLOWSUBMISSDSC', 'Allow Users to Submit new links');
define('_MI_PDD2_ALLOWUPLOADS', 'User Uploads:');
define('_MI_PDD2_ALLOWUPLOADSDSC', 'Allow Users to upload files directly to your website');
define('_MI_PDD2_SCREENSHOTS', 'Screenshots Upload Directory');
define('_MI_PDD2_CATEGORYIMG', 'Category Image Upload Directory');
define('_MI_PDD2_MAINIMGDIR', 'Main Image Directory');
define('_MI_PDD2_USETHUMBS', 'Use Thumb Nails:');
define('_MI_PDD2_USETHUMBSDSC', "Supported file types: JPG, GIF, PNG.<div style='padding-top: 8px;'>PD-Links will use thumb nails for images. Set to 'No' to use orginal image if the server does not support this option.</div>");
define('_MI_PDD2_DATEFORMAT', 'Timestamp:');
define('_MI_PDD2_DATEFORMATDSC', 'Default Timestamp for PD-links:');
define('_MI_PDD2_SHOWDISCLAIMER', 'Show Disclaimer before User Submission?');
define('_MI_PDD2_SHOWDISCLAIMERDSC', 'Before a User can submit a Link show the Entry regulations?');
define('_MI_PDD2_SHOWlinkDISCL', 'Show Disclaimer before User link?');
define('_MI_PDD2_SHOWlinkDISCLDSC', 'Show link regulations before open a link?');
define('_MI_PDD2_DISCLAIMER', 'Enter Submission Disclaimer Text:');
define('_MI_PDD2_linkDISCLAIMER', 'Enter link Disclaimer Text:');
define('_MI_PDD2_SUBCATS', 'Sub-Categories:');
define('_MI_PDD2_SUBMITART', 'link Submission:');
define('_MI_PDD2_SUBMITARTDSC', 'Select groups that can submit new links.');
define('_MI_PDD2_IMGUPDATE', 'Update Thumbnails?');
define('_MI_PDD2_IMGUPDATEDSC', 'If selected Thumbnail images will be updated at each page render, otherwise the first thumbnail image will be used regardless. <br><br>');
define('_MI_PDD2_QUALITY', 'Thumb Nail Quality:');
define('_MI_PDD2_QUALITYDSC', 'Quality Lowest: 0 Highest: 100');
define('_MI_PDD2_KEEPASPECT', 'Keep Image Aspect Ratio?');
define('_MI_PDD2_KEEPASPECTDSC', '');
define('_MI_PDD2_ADMINPAGE', 'Admin Index Files Count:');
define('_MI_PDD2_AMDMINPAGEDSC', 'Number of new files to display in module admin area.');
define('_MI_PDD2_ARTICLESSORT', 'Default link Order:');
define('_MI_PDD2_ARTICLESSORTDSC', 'Select the default order for the link listings.');
define('_MI_PDD2_TITLE', 'Title');
define('_MI_PDD2_RATING', 'Bewertung');
define('_MI_PDD2_WEIGHT', 'Weight');
define('_MI_PDD2_POPULARITY', 'Popularity');
define('_MI_PDD2_SUBMITTED2', 'Submission Date');
define('_MI_PDD2_COPYRIGHT', 'Copyright Notice:');
define('_MI_PDD2_COPYRIGHTDSC', 'Select to display a copyright notice on link page.');
// Description of each config items
define('_MI_PDD2_SUBCATSDSC', 'SELECT Yes TO display sub-categories. Selecting NO will hide sub-categories FROM the listings');
// Text for notifications
define('_MI_PDD2_GLOBAL_NOTIFY', 'Global');
define('_MI_PDD2_GLOBAL_NOTIFYDSC', 'Global links notification options.');
define('_MI_PDD2_CATEGORY_NOTIFY', 'Category');
define('_MI_PDD2_CATEGORY_NOTIFYDSC', 'Notification options that apply to the current file category.');
define('_MI_PDD2_FILE_NOTIFY', 'File');
define('_MI_PDD2_FILE_NOTIFYDSC', 'Notification options that apply to the current file.');
define('_MI_PDD2_GLOBAL_NEWCATEGORY_NOTIFY', 'New Category');
define('_MI_PDD2_GLOBAL_NEWCATEGORY_NOTIFYCAP', 'Notify me when a new file category is created.');
define('_MI_PDD2_GLOBAL_NEWCATEGORY_NOTIFYDSC', 'Receive notification when a new file category is created.');
define('_MI_PDD2_GLOBAL_NEWCATEGORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New file category');
define('_MI_PDD2_GLOBAL_FILEMODIFY_NOTIFY', 'Modify File Requested');
define('_MI_PDD2_GLOBAL_FILEMODIFY_NOTIFYCAP', 'Notify me of any file modification request.');
define('_MI_PDD2_GLOBAL_FILEMODIFY_NOTIFYDSC', 'Receive notification when any file modification request is submitted.');
define('_MI_PDD2_GLOBAL_FILEMODIFY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : File Modification Requested');
define('_MI_PDD2_GLOBAL_FILEBROKEN_NOTIFY', 'Broken File Submitted');
define('_MI_PDD2_GLOBAL_FILEBROKEN_NOTIFYCAP', 'Notify me of any broken file report.');
define('_MI_PDD2_GLOBAL_FILEBROKEN_NOTIFYDSC', 'Receive notification when any broken file report is submitted.');
define('_MI_PDD2_GLOBAL_FILEBROKEN_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Broken File Reported');
define('_MI_PDD2_GLOBAL_FILESUBMIT_NOTIFY', 'File Submitted');
define('_MI_PDD2_GLOBAL_FILESUBMIT_NOTIFYCAP', 'Notify me when any new file is submitted (awaiting approval).');
define('_MI_PDD2_GLOBAL_FILESUBMIT_NOTIFYDSC', 'Receive notification when any new file is submitted (awaiting approval).');
define('_MI_PDD2_GLOBAL_FILESUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New file submitted');
define('_MI_PDD2_GLOBAL_NEPDILE_NOTIFY', 'New File');
define('_MI_PDD2_GLOBAL_NEPDILE_NOTIFYCAP', 'Notify me when any new file is posted.');
define('_MI_PDD2_GLOBAL_NEPDILE_NOTIFYDSC', 'Receive notification when any new file is posted.');
define('_MI_PDD2_GLOBAL_NEPDILE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New file');
define('_MI_PDD2_CATEGORY_FILESUBMIT_NOTIFY', 'File Submitted');
define('_MI_PDD2_CATEGORY_FILESUBMIT_NOTIFYCAP', 'Notify me when a new file is submitted (awaiting approval) to the current category.');
define('_MI_PDD2_CATEGORY_FILESUBMIT_NOTIFYDSC', 'Receive notification when a new file is submitted (awaiting approval) to the current category.');
define('_MI_PDD2_CATEGORY_FILESUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New file submitted in category');
define('_MI_PDD2_CATEGORY_NEPDILE_NOTIFY', 'New File');
define('_MI_PDD2_CATEGORY_NEPDILE_NOTIFYCAP', 'Notify me when a new file is posted to the current category.');
define('_MI_PDD2_CATEGORY_NEPDILE_NOTIFYDSC', 'Receive notification when a new file is posted to the current category.');
define('_MI_PDD2_CATEGORY_NEPDILE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New file in category');
define('_MI_PDD2_FILE_APPROVE_NOTIFY', 'File Approved');
define('_MI_PDD2_FILE_APPROVE_NOTIFYCAP', 'Notify me when this file is approved.');
define('_MI_PDD2_FILE_APPROVE_NOTIFYDSC', 'Receive notification when this file is approved.');
define('_MI_PDD2_FILE_APPROVE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : File Approved');
define('_MI_PDD2_AUTHOR_INFO', 'Developer Information');
define('_MI_PDD2_AUTHOR_NAME', 'Developer');
define('_MI_PDD2_AUTHOR_WEBSITE', 'Developer website');
define('_MI_PDD2_AUTHOR_EMAIL', 'Developer email');
define('_MI_PDD2_AUTHOR_CREDITS', 'Credits');
define('_MI_PDD2_MODULE_DEVINFO', 'Module Development Information');
define('_MI_PDD2_MODULE_INFO', 'Module Information');
define('_MI_PDD2_MODULE_STATUS', 'Development Status');
define('_MI_PDD2_MODULE_FEATURE', 'Suggest a new feature for this module');
define('_MI_PDD2_MODULE_DISCLAIMER', 'Disclaimer');
define('_MI_PDD2_RELEASE', 'Release Date: ');
define(
    '_MI_PDD2_WARNINGTEXT',
    'THE SOFTWARE IS PROVIDED BY Power-Dreams "AS IS" AND "WITH ALL FAULTS."
Power-Dreams MAKES NO REPRESENTATIONS OR WARRANTIES OF ANY KIND CONCERNING
THE QUALITY, SAFETY OR SUITABILITY OF THE SOFTWARE, EITHER EXPRESS OR
IMPLIED, INCLUDING WITHOUT LIMITATION ANY IMPLIED WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, OR NON-INFRINGEMENT.
FURTHER, ABLEMEDIA MAKES NO REPRESENTATIONS OR WARRANTIES AS TO THE TRUTH,
ACCURACY OR COMPLETENESS OF ANY STATEMENTS, INFORMATION OR MATERIALS
CONCERNING THE SOFTWARE THAT IS CONTAINED IN Power-Dreams WEBSITE. IN NO
EVENT WILL ABLEMEDIA BE LIABLE FOR ANY INDIRECT, PUNITIVE, SPECIAL,
INCIDENTAL OR CONSEQUENTIAL DAMAGES HOWEVER THEY MAY ARISE AND EVEN IF
Power-Dreams HAS BEEN PREVIOUSLY ADVISED OF THE POSSIBILITY OF SUCH DAMAGES..'
);
define(
    '_MI_PDD2_AUTHOR_CREDITSTEXT',
    'The Power-Dreams Team would like to thank the following people for their help and support during the development phase of this module:<br><br>
Frankblack, King76, baerchen, mcleines and all Beta-Testers from myXOOPS.de.'
);
define('_MI_PDD2_AUTHOR_BUGFIXES', 'Version History');
