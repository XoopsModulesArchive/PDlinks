<?php
/**
 * $Id: admin.php v 1.22 02 july 2004 Liquid Exp $
 * Module: PD-links
 * Version: v1.0
 * Release Date: 04. März 2005
 * Author: Power-Dreams Team
 * Licence: GNU
 */

// %%%%%%	Module NMDe 'Mylinks' (Admin)	  %%%%%
// Buttons
define('_AM_PDD2_BMODIFY', 'Modify');
define('_AM_PDD2_BDELETE', 'Delete');
define('_AM_PDD2_BADD', 'Add');
define('_AM_PDD2_BAPPROVE', 'Approve');
define('_AM_PDD2_BIGNORE', 'Ignore');
define('_AM_PDD2_BCANCEL', 'Cancel');
define('_AM_PDD2_BSAVE', 'Save');
define('_AM_PDD2_BRESET', 'Reset');
define('_AM_PDD2_BMOVE', 'Move Files');
define('_AM_PDD2_BUPLOAD', 'Upload');
define('_AM_PDD2_BDELETEIMAGE', 'Delete Selected Image');
define('_AM_PDD2_BRETURN', 'Return to where you where!');
define('_AM_PDD2_DBERROR', 'Database Access Error: Please report this error to the PDSection Website');
//Banned Users
define('_AM_PDD2_NONBANNED', 'Not Banned');
define('_AM_PDD2_BANNED', 'Banned');
define('_AM_PDD2_EDITBANNED', 'Edit Banned Users');
// Other Options
define('_AM_PDD2_TEXTOPTIONS', 'Text Options:');
define('_AM_PDD2_DISABLEHTML', ' Disable HTML Tags');
define('_AM_PDD2_DISABLESMILEY', ' Disable Smilie Icons');
define('_AM_PDD2_DISABLEXCODE', ' Disable XOOPS Codes');
define('_AM_PDD2_DISABLEIMAGES', ' Disable Images');
define('_AM_PDD2_DISABLEBREAK', ' Use XOOPS linebreak conversion?');
define('_AM_PDD2_UPLOADFILE', 'File Uploaded Successfully');
define('_AM_PDD2_NOMENUITEMS', 'No menu items within the menu');

// Admin Bread crumb
define('_AM_PDD2_PREFS', 'Preferences');
define('_AM_PDD2_PERMISSIONS', 'Permissions');
define('_AM_PDD2_BINDEX', 'Main Index');
define('_AM_PDD2_BLOCKADMIN', 'Blocks');
define('_MI_PDD2_BLOCKADMIN', 'Block Settings');
define('_AM_PDD2_GOMODULE', 'Go to module');
define('_AM_PDD2_ABOUT', 'About');

// Admin Summary
define('_AM_PDD2_SCATEGORY', 'Category: ');
define('_AM_PDD2_SFILES', 'Files: ');
define('_AM_PDD2_SNEPDILESVAL', 'Submitted: ');
define('_AM_PDD2_SMODREQUEST', 'Modified: ');
define('_AM_PDD2_SREVIEWS', 'Reviews: ');
// Admin Main Menu
define('_AM_PDD2_MCATEGORY', 'Category Management');
define('_AM_PDD2_Mlinks', 'File Management');
define('_AM_PDD2_INDEXPAGE', 'Index Page Management');
define('_AM_PDD2_MMIMETYPES', 'Mimetypes Management');
define('_AM_PDD2_MCOMMENTS', 'Comments');
define('_AM_PDS_MVOTEDATA', 'Vote Data');

// Catgeory defines
define('_AM_PDD2_CCATEGORY_CREATENEW', 'Create New Category');
define('_AM_PDD2_CCATEGORY_MODIFY', 'Modify Category');
define('_AM_PDD2_CCATEGORY_MOVE', 'Move Category Files');
define('_AM_PDD2_CCATEGORY_MODIFY_TITLE', 'Category Title:');
define('_AM_PDD2_CCATEGORY_MODIFY_FAILED', 'Failed Moving Files: Cannot move to this Category');
define('_AM_PDD2_CCATEGORY_MODIFY_FAILEDT', 'Failed Moving Files: Cannot find this Category');
define('_AM_PDD2_CCATEGORY_MODIFY_MOVED', 'Files Moved and Category Deleted');
define('_AM_PDD2_CCATEGORY_CREATED', 'New Category Created and Database Updated Successfully');
define('_AM_PDD2_CCATEGORY_MODIFIED', 'Selected Category Modified and Database Updated Successfully');
define('_AM_PDD2_CCATEGORY_DELETED', 'Selected Category Deleted and Database Updated Successfully');
define('_AM_PDD2_CCATEGORY_AREUSURE', 'WARNING: Are you sure you want to delete this Category and ALL its Files and Comments?');
define('_AM_PDD2_CCATEGORY_NOEXISTS', 'You must create a Category before you can add a new file');
define('_AM_PDD2_FCATEGORY_GROUPPROMPT', "Category Access Permissions:<div style='padding-top: 8px;'><span style='font-weight: normal;'>Select user groups who will have access to this Category.</span></div>");
define('_AM_PDD2_FCATEGORY_TITLE', 'Category Title:');
define('_AM_PDD2_FCATEGORY_WEIGHT', 'Category Weight:');
define('_AM_PDD2_FCATEGORY_SUBCATEGORY', 'Set As Sub-Category:');
define('_AM_PDD2_FCATEGORY_CIMAGE', 'Select Category Image:');
define('_AM_PDD2_FCATEGORY_DESCRIPTION', 'Set Category Description:');
define('_AM_PDD2_FCATEGORY_SUMMARY', 'Set Category Summary:');
/*
* Index page Defines
*/
define('_AM_PDD2_IPAGE_UPDATED', 'Index Page Modified and Database Updated Successfully!');
define('_AM_PDD2_IPAGE_INFORMATION', 'Index Page Information');
define('_AM_PDD2_IPAGE_MODIFY', 'Modify Index Page');
define('_AM_PDD2_IPAGE_CIMAGE', 'Select Index Image:');
define('_AM_PDD2_IPAGE_CTITLE', 'Index Title:');
define('_AM_PDD2_IPAGE_CHEADING', 'Index Heading:');
define('_AM_PDD2_IPAGE_CHEADINGA', 'Index Heading Alignment:');
define('_AM_PDD2_IPAGE_CFOOTER', 'Index Footer:');
define('_AM_PDD2_IPAGE_CFOOTERA', 'Index Footer Alignment:');
define('_AM_PDD2_IPAGE_CLEFT', 'Align Left');
define('_AM_PDD2_IPAGE_CCENTER', 'Align Center');
define('_AM_PDD2_IPAGE_CRIGHT', 'Align Right');
/*
*  Permissions defines
*/
define('_AM_PDD2_PERM_MANAGEMENT', 'Permissions Management');
define(
    '_AM_PDD2_PERM_PERMSNOTE',
    '<div><b>NOTE:</b> Please be aware that even if you&#8217ve set correct viewing permissions here, a group might not see the articles or blocks if you don&#8217t also grant that group permissions to access the module. To do that, go to <b>System admin > Groups</b>, choose the appropriate group and click the checkboxes to grant its members the access.</div>'
);
define('_AM_PDD2_PERM_CPERMISSIONS', 'Category Permissions');
define('_AM_PDD2_PERM_CSELECTPERMISSIONS', 'Select categories that each group is allowed to view');
define('_AM_PDD2_PERM_CNOCATEGORY', "Cannot set permission's: No Categories's have been created yet!");
define('_AM_PDD2_PERM_FPERMISSIONS', 'File Permissions');
define('_AM_PDD2_PERM_FNOFILES', "Cannot set permission's: No files have been created yet!");
define('_AM_PDD2_PERM_FSELECTPERMISSIONS', 'Select the files that each group is allowed to view');
/*
* Upload defines
*/
define('_AM_PDD2_link_IMAGEUPLOAD', 'Image successfully uploaded to server destination');
define('_AM_PDD2_link_NOIMAGEEXIST', 'Error: No file was selected for uploading.  Please try again!');
define('_AM_PDD2_link_IMAGEEXIST', 'Image already exists in upload area!');
define('_AM_PDD2_link_FILEDELETED', 'File has been deleted.');
define('_AM_PDD2_link_FILEERRORDELETE', 'Error deleting File: File not found on server.');
define('_AM_PDD2_link_NOFILEERROR', 'Error deleting File: No File Selected For Deleting.');
define('_AM_PDD2_link_DELETEFILE', 'WARNING: Are you sure you want to delete this Image file?');
define('_AM_PDD2_link_IMAGEINFO', 'Server Status');
define('_AM_PDD2_link_SPHPINI', '<b>Information taken from PHP ini File:</b>');
define('_AM_PDD2_link_SAFEMODESTATUS', 'Safe Mode Status: ');
define('_AM_PDD2_link_REGISTERGLOBALS', 'Register Globals: ');
define('_AM_PDD2_link_SERVERUPLOADSTATUS', 'Server Uploads Status: ');
define('_AM_PDD2_link_MAXUPLOADSIZE', 'Max Upload Size Permitted: ');
define('_AM_PDD2_link_MAXPOSTSIZE', 'Max Post Size Permitted: ');
define('_AM_PDD2_link_SAFEMODEPROBLEMS', ' (This May Cause Problems)');
define('_AM_PDD2_link_GDLIBSTATUS', 'GD Library Support: ');
define('_AM_PDD2_link_GDLIBVERSION', 'GD Library Version: ');
define('_AM_PDD2_link_GDON', '<b>Enabled</b> (Thumbs Nails Available)');
define('_AM_PDD2_link_GDOFF', '<b>Disabled</b> (No Thumb Nails Available)');
define('_AM_PDD2_link_OFF', '<b>OFF</b>');
define('_AM_PDD2_link_ON', '<b>ON</b>');
define('_AM_PDD2_link_CATIMAGE', 'Category Images');
define('_AM_PDD2_link_SCREENSHOTS', 'Screenshot Images');
define('_AM_PDD2_link_MAINIMAGEDIR', 'Main images');
define('_AM_PDD2_link_FCATIMAGE', 'Category Image Path');
define('_AM_PDD2_link_FSCREENSHOTS', 'Screenshot Image Path');
define('_AM_PDD2_link_FMAINIMAGEDIR', 'Main image Path');
define('_AM_PDD2_link_FUPLOADIMAGETO', 'Upload Image: ');
define('_AM_PDD2_link_FUPLOADPATH', 'Upload Path: ');
define('_AM_PDD2_link_FUPLOADURL', 'Upload URL: ');
define('_AM_PDD2_link_FOLDERSELECTION', 'Select Upload Destination:');
define('_AM_PDD2_link_FSHOWSELECTEDIMAGE', 'Display Selected Image:');
define('_AM_PDD2_link_FUPLOADIMAGE', 'Upload New Image to Selected Destination:');

// Main Index defines
define('_AM_PDD2_MINDEX_linkSUMMARY', 'Module Admin Summary');
define('_AM_PDD2_MINDEX_PUBLISHEDlink', 'Published Files:');
define('_AM_PDD2_MINDEX_AUTOPUBLISHEDlink', 'Auto Published Files:');
define('_AM_PDD2_MINDEX_AUTOEXPIRE', 'Auto Expire Files:');
define('_AM_PDD2_MINDEX_EXPIRED', 'Expired Files:');
define('_AM_PDD2_MINDEX_OFFLINElink', 'Offline Files:');
define('_AM_PDD2_MINDEX_ID', 'ID');
define('_AM_PDD2_MINDEX_TITLE', 'File Title');
define('_AM_PDD2_MINDEX_POSTER', 'Poster');
define('_AM_PDD2_MINDEX_SUBMITTED', 'Submission Date');
define('_AM_PDD2_MINDEX_ONLINESTATUS', 'Online Status');
define('_AM_PDD2_MINDEX_PUBLISHED', 'Published');
define('_AM_PDD2_MINDEX_ACTION', 'Action');
define('_AM_PDD2_MINDEX_NOlinksFOUND', 'NOTICE: There are no files that match this criteria');
define('_AM_PDD2_MINDEX_PAGE', '<b>Page:<b> ');
define('_AM_PDD2_MINDEX_PAGEINFOTXT', '<ul><li>PD-links main page details.</li><li>You can easily change the image logo, heading, main index header and footer text to suit your own look</li></ul><br><br>Note: The Logo image choosen will be used throughout PD-links.');
define('_AM_PDD_MINDEX_DOWNSEC', 'in our linksection');

// Submitted Files
define('_AM_PDD2_SUB_SUBMITTEDFILES', 'Submitted Files');
define('_AM_PDD2_SUB_FILESWAITINGINFO', 'Waiting Files Information');
define('_AM_PDD2_SUB_FILESWAITINGVALIDATION', 'Files Waiting Validation: ');
define('_AM_PDD2_SUB_APPROVEWAITINGFILE', '<b>Approve</b> new file information without validation.');
define('_AM_PDD2_SUB_EDITWAITINGFILE', '<b>Edit</b> new file information and then approve.');
define('_AM_PDD2_SUB_DELETEWAITINGFILE', '<b>Delete</b> the new file information.');
define('_AM_PDD2_SUB_NOFILESWAITING', 'There are no files that match this critera');
define('_AM_PDD2_SUB_NEPDILECREATED', 'New File Data Created and Database Updated Successfully');

// Vote Information
define('_AM_PDD2_VOTE_RATINGINFOMATION', 'Voting Information');
define('_AM_PDD2_VOTE_TOTALVOTES', 'Total votes: ');
define('_AM_PDD2_VOTE_REGUSERVOTES', 'Registered User Votes: %s');
define('_AM_PDD2_VOTE_ANONUSERVOTES', 'Anonymous User Votes: %s');
define('_AM_PDD2_VOTE_USER', 'User');
define('_AM_PDD2_VOTE_IP', 'IP Address');
define('_AM_PDD2_VOTE_USERAVG', 'Average User Rating');
define('_AM_PDD2_VOTE_TOTALRATE', 'Total Ratings');
define('_AM_PDD2_VOTE_DATE', 'Submitted');
define('_AM_PDD2_VOTE_RATING', 'Rating');
define('_AM_PDD2_VOTE_NOREGVOTES', 'No Registered User Votes');
define('_AM_PDD2_VOTE_NOUNREGVOTES', 'No Unregistered User Votes');
define('_AM_PDD2_VOTE_VOTEDELETED', 'Vote data deleted.');
define('_AM_PDD2_VOTE_ID', 'ID');
define('_AM_PDD2_VOTE_FILETITLE', 'File Title');
define('_AM_PDD2_VOTE_DISPLAYVOTES', 'Voting Data Information');
define('_AM_PDD2_VOTE_NOVOTES', 'No User Votes to display');
define('_AM_PDD2_VOTE_DELETE', 'No User Votes to display');
define('_AM_PDD2_VOTE_DELETEDSC', '<b>Deletes</b> the chosen vote information from the database.');

// Modifications
define('_AM_PDD2_MOD_TOTMODREQUESTS', 'Total Modification Requests: ');
define('_AM_PDD2_MOD_MODREQUESTS', 'Modified Links');
define('_AM_PDD2_MOD_MODREQUESTSINFO', 'Modified Links Information');
define('_AM_PDD2_MOD_MODID', 'ID');
define('_AM_PDD2_MOD_MODTITLE', 'Title');
define('_AM_PDD2_MOD_MODPOSTER', 'Original Poster: ');
define('_AM_PDD2_MOD_DATE', 'Submitted');
define('_AM_PDD2_MOD_NOMODREQUEST', 'There are no requests that match this critera');
define('_AM_PDD2_MOD_TITLE', 'link Title: ');
define('_AM_PDD2_MOD_LID', 'link ID: ');
define('_AM_PDD2_MOD_CID', 'Category: ');
define('_AM_PDD2_MOD_URL', 'link Url: ');
define('_AM_PDD2_MOD_PUBLISHER', 'Publisher: ');
define('_AM_PDD2_MOD_FORUMID', 'Forum: ');
define('_AM_PDD2_MOD_SCREENSHOT', 'Screenshot Image: ');
define('_AM_PDD2_MOD_HOMEPAGE', 'Home Page: ');
define('_AM_PDD2_MOD_HOMEPAGETITLE', 'Home Page Title: ');
define('_AM_PDD2_MOD_SHOTIMAGE', 'Screenshot Image: ');
define('_AM_PDD2_MOD_DESCRIPTION', 'Description: ');
define('_AM_PDD2_MOD_MODIFYSUBMITTER', 'Submitter: ');
define('_AM_PDD2_MOD_MODIFYSUBMIT', 'Submitter');
define('_AM_PDD2_MOD_PROPOSED', 'Proposed link Details');
define('_AM_PDD2_MOD_ORIGINAL', 'Orginal link Details');
define('_AM_PDD2_MOD_REQDELETED', 'Modification request removed from the database');
define('_AM_PDD2_MOD_REQUPDATED', 'Selected link Modified and Database Updated Successfully');
define('_AM_PDD2_MOD_VIEW', 'View');

//File management
define('_AM_PDD2_FILE_ID', 'File ID: ');
define('_AM_PDD2_FILE_IP', 'Uploaders IP Address: ');
define('_AM_PDD2_FILE_ALLOWEDAMIME', "<div style='padding-top: 4px; padding-bottom: 4px;'><b>Allowed Admin File Extensions</b>:</div>");
define('_AM_PDD2_FILE_MODIFYFILE', 'Modify File Information');
define('_AM_PDD2_FILE_CREATENEPDILE', 'Create New File');
define('_AM_PDD2_FILE_TITLE', 'Homepage-Title: ');
define('_AM_PDD2_FILE_DLURL', 'Homepage-URL (direkte URL): ');
define('_AM_PDD2_FILE_DESCRIPTION', 'Link Description: ');
define('_AM_PDD2_FILE_CATEGORY', 'Select Category: ');
define('_AM_PDD2_FILE_FILESSTATUS', " Set link offline?<br><br><span style='font-weight: normal;'>link will not be viewable to all users.</span>");
define('_AM_PDD2_FILE_SETASUPDATED', " Set link Status as Updated?<br><br><span style='font-weight: normal;'>link will Display updated icon.</span>");
define('_AM_PDD2_FILE_SHOTIMAGE', 'Select Screenshot Image: ');
define('_AM_PDD2_FILE_DISCUSSINFORUM', 'Add Discuss in this Forum?');
define('_AM_PDD2_FILE_PUBLISHDATE', 'File Publish Date:');
define('_AM_PDD2_FILE_EXPIREDATE', 'File Expire Date:');
define('_AM_PDD2_FILE_CLEARPUBLISHDATE', '<br><br>Remove Publish date:');
define('_AM_PDD2_FILE_CLEAREXPIREDATE', '<br><br>Remove Expire date:');
define('_AM_PDD2_FILE_PUBLISHDATESET', ' Publish date set: ');
define('_AM_PDD2_FILE_SETDATETIMEPUBLISH', ' Set the date/time of publish');
define('_AM_PDD2_FILE_SETDATETIMEEXPIRE', ' Set the date/time of expire');
define('_AM_PDD2_FILE_SETPUBLISHDATE', '<b>Set Publish Date: </b>');
define('_AM_PDD2_FILE_SETNEWPUBLISHDATE', '<b>Set New Publish Date: </b><br>Published:');
define('_AM_PDD2_FILE_SETPUBDATESETS', '<b>Publish Date Set: </b><br>Publishes On Date:');
define('_AM_PDD2_FILE_EXPIREDATESET', ' Expire date set: ');
define('_AM_PDD2_FILE_SETEXPIREDATE', '<b>Set Expire Date: </b>');
define('_AM_PDD2_FILE_DELEDITMESS', "Delete Broken Report?<br><br><span style='font-weight: normal;'>When you choose <b>YES</b> the Broken Report will automatically deleted and you confirm that the link now works again.</span>");
define('_AM_PDD2_FILE_MUSTBEVALID', 'Screenshot image must be a valid image file under %s directory (ex. shot.gif). Leave it blank if there is no image file.');
define('_AM_PDD2_FILE_EDITAPPROVE', 'Approve link:');
define('_AM_PDD2_FILE_NEPDILEUPLOAD', 'New File Created and Database Updated Successfully');
define('_AM_PDD2_FILE_FILEMODIFIEDUPDATE', 'Selected File Modified and Database Updated Successfully');
define('_AM_PDD2_FILE_REALLYDELETEDTHIS', 'Really delete the selected file?');
define('_AM_PDD2_FILE_FILEWASDELETED', 'File %s successfully removed from the database!');
define('_AM_PDD2_FILE_FILEAPPROVED', 'File Approved and Database Updated Successfully');
define('_AM_PDD2_FILE_CREATENEWSSTORY', '<b>Create News Story From link</b>');
define('_AM_PDD2_FILE_SUBMITNEWS', 'Submit New file as News item?');
define('_AM_PDD2_FILE_NEWSCATEGORY', 'Select News Category to submit News:');
define('_AM_PDD2_FILE_NEWSTITLE', "News Title:<div style='padding-top: 4px; padding-bottom: 4px;'><span style='font-weight: normal;'>Leave Blank to use File Title</span></div>");

/*
* Broken links defines
*/
define('_AM_PDD2_SBROKENSUBMIT', 'Broken: ');
define('_AM_PDD2_BROKEN_FILE', 'Broken Reports');
define('_AM_PDD2_BROKEN_FILEIGNORED', 'Broken report ignored and successfully removed from the database!');
define('_AM_PDD2_BROKEN_NOWACK', 'Acknowledged status changed and database updated!');
define('_AM_PDD2_BROKEN_NOWCON', 'Status has been set to *in proceed*, you will be forwarded to the Edit-Link Page.');
define('_AM_PDD2_BROKEN_REPORTINFO', 'Broken Report Information');
define('_AM_PDD2_BROKEN_REPORTSNO', 'Broken Reports Waiting:');
define('_AM_PDD2_BROKEN_IGNOREDESC', '<b>Ignores</b> the report and only deletes the broken file report.');
define('_AM_PDD2_BROKEN_DELETEDESC', '<b>Deletes</b> the reported link data and broken file reports for the file.');
define('_AM_PDD2_BROKEN_EDITDESC', '<b>Edit</b> the link to fix the problem.');
define('_AM_PDD2_BROKEN_ACKDESC', '<b>In proceed</b> The link has been edited but its not clear if it really works.');
define('_AM_PDD2_BROKEN_CONFIRMDESC', '<b>Confirmed</b> Set confirmed state of broken file report.');

define('_AM_PDD2_BROKEN_ID', 'ID');
define('_AM_PDD2_BROKEN_TITLE', 'Title');
define('_AM_PDD2_BROKEN_REPORTER', 'Reporter');
define('_AM_PDD2_BROKEN_FILESUBMITTER', 'Submitter');
define('_AM_PDD2_BROKEN_DATESUBMITTED', 'Submit Date');
define('_AM_PDD2_BROKEN_ACTION', 'Action');
define('_AM_PDD2_BROKEN_NOFILEMATCH', 'There are no Broken reports that match this critera');
define('_AM_PDD2_BROKENFILEDELETED', 'link removed from database and broken report removed');

/*
* About defines
*/
define('_AM_PDD2_BY', 'by');

//block defines
define('_AM_PDD2_BADMIN', 'Block Administration');
define('_AM_PDD2_BLKDESC', 'Description');
define('_AM_PDD2_TITLE', 'Title');
define('_AM_PDD2_SIDE', 'Alignment');
define('_AM_PDD2_WEIGHT', 'Weight');
define('_AM_PDD2_VISIBLE', 'Visible');
define('_AM_PDD2_ACTION', 'Action');
define('_AM_PDD2_SBLEFT', 'Left');
define('_AM_PDD2_SBRIGHT', 'Right');
define('_AM_PDD2_CBLEFT', 'Center Left');
define('_AM_PDD2_CBRIGHT', 'Center Right');
define('_AM_PDD2_CBCENTER', 'Center Middle');
define('_AM_PDD2_ACTIVERIGHTS', 'Active Rights');
define('_AM_PDD2_ACCESSRIGHTS', 'Access Rights');

//image admin icon
define('_AM_PDD2_ICO_EDIT', 'Edit This Item');
define('_AM_PDD2_ICO_DELETE', 'Delete This Item');
define('_AM_PDD2_ICO_ONLINE', 'Online');
define('_AM_PDD2_ICO_OFFLINE', 'Offline');
define('_AM_PDD2_ICO_APPROVED', 'Approved');
define('_AM_PDD2_ICO_NOTAPPROVED', 'Not Approved');

define('_AM_PDD2_ICO_LINK', 'Related link');
define('_AM_PDD2_ICO_URL', 'Add Related URL');
define('_AM_PDD2_ICO_ADD', 'Add');
define('_AM_PDD2_ICO_APPROVE', 'Approve');
define('_AM_PDD2_ICO_STATS', 'Stats');

define('_AM_PDD2_ICO_IGNORE', 'Ignore');
define('_AM_PDD2_ICO_ACK', 'Broken Report Acknowledged');
define('_AM_PDD2_ICO_REPORT', 'Acknowledge Broken Report?');
define('_AM_PDD2_ICO_CONFIRM', 'Broken Report Confirmed');
define('_AM_PDD2_ICO_CONBROKEN', 'Confirm Broken Report?');
