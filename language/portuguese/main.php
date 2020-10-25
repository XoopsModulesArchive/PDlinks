<?php
/**
 * $Id: main.php v 1.22 02 july 2004 Liquid Exp $
 * Module: PD-links
 * Version: v1.0
 * Release Date: 04. März 2005
 * Author: Power-Dreams Team
 * Licence: GNU
 */

//Todo - Still to remove redundat defines from this area.
define('_MD_PDD2_NOlink', 'This link does not exist!');

define('_MD_PDD2_SUBCATLISTING', 'Category Listing');
define('_MD_PDD2_ISADMINNOTICE', 'Webmaster: There is a problem with this image.');
define('_MD_PDD2_THANKSFORINFO', 'Thank-you for your submission. You will be notified once your request has be approved by the webmaster.');
define('_MD_PDD2_ISAPPROVED', 'Thank-you for your submission. Your request has been approved and will now appear in our listing.');
define('_MD_PDD2_THANKSFORHELP', "Thank-you for helping to maintain this directory's integrity.");
define('_MD_PDD2_FORSECURITY', 'For security reasons your user name and IP address will also be temporarily recorded.');
define(
    '_MD_PDD2_NOPERMISETOlink',
    "This file doesn't belong to the site you came from <br><br>Please e-mail the webmaster of the site you came from and tell him:   <br><b>NOT TO LEECH OTHER SITES links!!</b> <br><br><b>Definition of a Leecher:</b> One who is to lazy to link from his own server or steals other peoples hard work and makes it look like his own <br><br>  Your IP address <b>has been logged</b>."
);
define('_MD_PDD2_DESCRIPTION', 'Description');
define('_MD_PDD2_SUBMITCATHEAD', 'Submit link Form');
define('_MD_PDD2_MAIN', 'HOME');
define('_MD_PDD2_POPULAR', 'Popular');
define('_MD_PDD2_NEWTHISWEEK', 'New this week');
define('_MD_PDD2_UPTHISWEEK', 'Updated this week');
define('_MD_PDD2_POPULARITYLTOM', 'Popularity (Least to Most Hits)');
define('_MD_PDD2_POPULARITYMTOL', 'Popularity (Most to Least Hits)');
define('_MD_PDD2_TITLEATOZ', 'Title (A to Z)');
define('_MD_PDD2_TITLEZTOA', 'Title (Z to A)');
define('_MD_PDD2_DATEOLD', 'Date (Old Files Listed First)');
define('_MD_PDD2_DATENEW', 'Date (New Files Listed First)');
define('_MD_PDD2_RATINGLTOH', 'Rating (Lowest Score to Highest Score)');
define('_MD_PDD2_RATINGHTOL', 'Rating (Highest Score to Lowest Score)');
define('_MD_PDD2_DESCRIPTIONC', 'Description: ');
define('_MD_PDD2_CATEGORYC', 'Category: ');
define('_MD_PDD2_VERSION', 'Version');
define('_MD_PDD2_SUBMITDATE', 'Released');
define('_MD_PDD2_DLTIMES', 'linked %s times');
define('_MD_PDD2_FILESIZE', 'File Size');
define('_MD_PDD2_SUPPORTEDPLAT', 'Platform');
define('_MD_PDD2_HOMEPAGE', 'Home Page');
define('_MD_PDD2_PUBLISHERC', 'Publisher: ');
define('_MD_PDD2_RATINGC', 'Rating: ');
define('_MD_PDD2_ONEVOTE', '1 Vote');
define('_MD_PDD2_NUMVOTES', '%s Votes');
define('_MD_PDD2_RATETHISFILE', 'Rate Resource');
define('_MD_PDD2_REVIEWTHISFILE', 'Review Resource');
define('_MD_PDD2_REVIEWS', 'Reviews:');
define('_MD_PDD2_linkHITS', 'links');
define('_MD_PDD2_MODIFY', 'Modify');
define('_MD_PDD2_REPORTBROKEN', 'Report Broken');
define('_MD_PDD2_BROKENREPORT', 'Report Broken Resource');
define('_MD_PDD2_SUBMITBROKEN', 'Submit');
define('_MD_PDD2_BEFORESUBMIT', 'Before submitting a broken resource request, please check that the actual source of the file you intend reporting broken, is no longer there and that the website is not temporally link.');
define('_MD_PDD2_TELLAFRIEND', 'Recommend');
define('_MD_PDD2_EDIT', 'Edit');
define('_MD_PDD2_THEREARE', 'There are <b>%s</b> <i>Categories</i> and <b>%s</b> <i>Links</i> listed');
define('_MD_PDD2_THEREIS', 'There is <b>%s</b> <i>Category</i> and <b>%s</b> <i>Links</i> listed');
define('_MD_PDD2_LATESTLIST', 'Latest Listings');
define('_MD_PDD2_FILETITLE', 'link Title: ');
define('_MD_PDD2_DLURL', 'link URL: ');
define('_MD_PDD2_HOMEPAGEC', 'Home Page: ');
define('_MD_PDD2_UPLOAD_FILEC', 'Upload File: ');
define('_MD_PDD2_VERSIONC', 'Version: ');
define('_MD_PDD2_FILESIZEC', 'File Size: ');
define('_MD_PDD2_NUMBYTES', '%s bytes');
define('_MD_PDD2_PLATFORMC', 'Platform: ');
define('_MD_PDD2_PRICE', 'Price');
define('_MD_PDD2_LIMITS', 'Limitations');
define('_MD_PDD2_linkLICENSE', 'License');
define('_MD_PDD2_NOTSPECIFIED', 'Not Specified');
define('_MD_PDD2_MIRRORSITE', 'link Mirror');
define('_MD_PDD2_MIRROR', 'Mirror Website');
define('_MD_PDD2_PUBLISHER', 'Publisher');
define('_MD_PDD2_UPDATEDON', 'Updated On');
define('_MD_PDD2_PRICEFREE', 'Free');
define('_MD_PDD2_VIEWDETAILS', 'View Full Details');
define('_MD_PDD2_OPTIONS', 'Options: ');
define('_MD_PDD2_NOTIFYAPPROVE', 'Notify me when this file is approved');
define('_MD_PDD2_VOTEAPPRE', 'Your vote is appreciated.');
define('_MD_PDD2_THANKYOU', 'Thank you for taking the time to vote here at %s'); // %s is your site name
define('_MD_PDD2_VOTEONCE', 'Please do not vote for the same resource more than once.');
define('_MD_PDD2_RATINGSCALE', 'The scale is 1 - 10, with 1 being poor and 10 being excellent.');
define('_MD_PDD2_BEOBJECTIVE', "Please be objective, if everyone receives a 1 or a 10, the ratings aren't very useful.");
define('_MD_PDD2_DONOTVOTE', 'Do not vote for your own resource.');
define('_MD_PDD2_RATEIT', 'Rate It!');
define('_MD_PDD2_INTFILEFOUND', 'Here is a good file to link at %s'); // %s is your site name
define('_MD_PDD2_RANK', 'Rank');
define('_MD_PDD2_CATEGORY', 'Category');
define('_MD_PDD2_HITS', 'Hits');
define('_MD_PDD2_RATING', 'Rating');
define('_MD_PDD2_VOTE', 'Vote');
define('_MD_PDD2_SORTBY', 'Sort by:');
define('_MD_PDD2_TITLE', 'Title');
define('_MD_PDD2_DATE', 'Date');
define('_MD_PDD2_POPULARITY', 'Popularity');
define('_MD_PDD2_TOPRATED', 'Rating');
define('_MD_PDD2_CURSORTBY', 'Files currently sorted by: %s');
define('_MD_PDD2_CANCEL', 'Cancel');
define('_MD_PDD2_ALREADYREPORTED', 'You have already submitted a broken report for this resource.');
define('_MD_PDD2_MUSTREGFIRST', "Sorry, you don't have the permission to perform this action.<br>Please register or login first!");
define('_MD_PDD2_NORATING', 'No rating selected.');
define('_MD_PDD2_CANTVOTEOWN', 'You cannot vote on the resource you submitted.<br>All votes are logged and reviewed.');
define('_MD_PDD2_SUBMITlink', 'Submit link');
define('_MD_PDD2_SUB_SNEWMNAMEDESC', "<ul><li>All new links's are subject to validation and may take up to 24 hours before they appear in our listing.</li><li>We reserve the rights to refuse any submitted link or change the content without approval.</li></ul>");
define('_MD_PDD2_MAINLISTING', 'Main Category Listings');
define('_MD_PDD2_LASTWEEK', 'Last Week');
define('_MD_PDD2_LAST30DAYS', 'Last 30 Days');
define('_MD_PDD2_1WEEK', '1 Week');
define('_MD_PDD2_2WEEKS', '2 Weeks');
define('_MD_PDD2_30DAYS', '30 Days');
define('_MD_PDD2_SHOW', 'Show');
define('_MD_PDD2_DAYS', 'days');
define('_MD_PDD2_NEWlinks', 'New links');
define('_MD_PDD2_TOTALNEWlinks', 'Total New links');
define('_MD_PDD2_DTOTALFORLAST', 'Total new links for last');
define('_MD_PDD2_AGREE', 'I Agree');
define('_MD_PDD2_DOYOUAGREE', 'Do you agree to the above terms?');
define('_MD_PDD2_DISCLAIMERAGREEMENT', 'Disclaimer');
define('_MD_PDD2_DUPLOADSCRSHOT', 'Upload Screenshot Image:');
define('_MD_PDD2_RESOURCEID', 'Resource id#: ');
define('_MD_PDD2_REPORTER', 'Original Reporter: ');
define('_MD_PDD2_DATEREPORTED', 'Date Reported: ');
define('_MD_PDD2_RESOURCEREPORTED', 'Resource Reported Broken');
define('_MD_PDD2_RESOURCEREPORTED2', 'This link has been already reported as broken, we are working on a fix');
define('_MD_PDD2_BROWSETOTOPIC', '<b>Browse links by alphabetical listing</b>');
define('_MD_PDD2_WEBMASTERACKNOW', 'Broken Report Acknowledged: ');
define('_MD_PDD2_WEBMASTERCONFIRM', 'Broken Report Confirmed: ');
define('_MD_PDD2_DELETE', 'Delete');
define('_MD_PDD2_DISPLAYING', 'Displayed by: ');
define('_MD_PDD2_LEGENDTEXTNEW', 'New Today');
define('_MD_PDD2_LEGENDTEXTNEWTHREE', 'New 3 Days');
define('_MD_PDD2_LEGENDTEXTTHISWEEK', 'New This Week');
define('_MD_PDD2_LEGENDTEXTNEWLAST', 'Over 1 Week');
define('_MD_PDD2_THISFILEDOESNOTEXIST', 'Error: This file does not exist!');
define('_MD_PDD2_BROKENREPORTED', 'Broken link Reported');
// visit
define('_MD_PDD2_linkINPROGRESS', 'link in Progress');
define('_MD_PDD2_linksTARTINSEC', 'Your link should start in 3 seconds...<b>please wait</b>.');
define('_MD_PDD2_linkNOTSTART', 'If your link does not start, ');
define('_MD_PDD2_CLICKHERE', 'Click here!');
define('_MD_PDD2_BROKENFILE', 'Broken File');
define('_MD_PDD2_PLEASEREPORT', 'Please report this broken file to the webmaster, ');
// Reviews
define('_MD_PDD2_REV_TITLE', 'Review Title:');
define('_MD_PDD2_REV_RATING', 'Review Rating:');
define('_MD_PDD2_REV_DESCRIPTION', 'Review:');
define('_MD_PDD2_REV_SUBMITREV', 'Submit Review');
define(
    '_MD_PDD2_REV_SNEWMNAMEDESC',
    " 
Please completely fill out the form below, and we'll add your review as soon as possible.<br><br>
Thank you for taking the time to submit your opinion. We want to give our users a possibility to find quality software faster.<br><br>All reviews will be reviewed by one of our webmasters before they are put up on the web site. 
"
);
define('_MD_PDD2_ISNOTAPPROVED', 'Your submission has to be approved by a moderator first.');
define('_MD_PDD2_LICENCEC', 'Software Licence: ');
define('_MD_PDD2_LIMITATIONS', 'Software limitations: ');
define('_MD_PDD2_KEYFEATURESC', "Key Features:<br><br><span style='font-weight: normal;'>Seperate each Key Feature with a #</span>");
define('_MD_PDD2_REQUIREMENTSC', "System Requirements:<br><br><span style='font-weight: normal;'>Seperate each Requirement with #</span>");
define('_MD_PDD2_HISTORYC', 'link History:');
define('_MD_PDD2_HISTORYD', "Add New link History:<br><br><span style='font-weight: normal;'>The Submit date will automatically be added to this.</span>");
define('_MD_PDD2_HOMEPAGETITLEC', 'Home Page Title: ');
define('_MD_PDD2_REQUIREMENTS', 'System Requirements:');
define('_MD_PDD2_FEATURES', 'Features:');
define('_MD_PDD2_HISTORY', 'link History:');
define('_MD_PDD2_PRICEC', 'Price:');
define('_MD_PDD2_SCREENSHOT', 'Screenshot:');
define('_MD_PDD2_SCREENSHOTCLICK', 'Display full image');
define('_MD_PDD2_OTHERBYUID', 'Other files by: ');
define('_MD_PDD2_linkTIMES', 'link Times: ');
define('_MD_PDD2_MAINTOTAL', 'Total Files: ');
define('_MD_PDD2_linkNOW', 'Open Now');
define('_MD_PDD2_PAGES', '<b>Pages</b>');
define('_MD_PDD2_REVIEWER', 'Reviewer');
define('_MD_PDD2_RATEDRESOURCE', 'Rated Resource');
define('_MD_PDD2_SUBMITTER', 'Submitter');
define('_MD_PDD2_REVIEWTITLE', 'User Reviews');
define('_MD_PDD2_REVIEWTOTAL', '<b>Reviews total:</b> %s');
define('_MD_PDD2_USERREVIEWSTITLE', 'User Reviews');
define('_MD_PDD2_USERREVIEWS', 'Read User Reviews on %s');
define('_MD_PDD2_NOUSERREVIEWS', 'Be the first person to review %s.');
define('_MD_PDD2_ERROR', 'Error Updating Database: Information not saved');
define('_MD_PDD2_COPYRIGHT', 'copyright');
define('_MD_PDD2_INFORUM', 'Discuss In Forum');

//added frankblack

//submit.php
define('_MD_PDD2_NOTALLOWESTOSUBMIT', 'You are not allowed to submit files');
define('_MD_PDD2_INFONOSAVEDB', 'Information not saved to database: <br><br>');

//review.php
define('_MD_PDD2_ERROR_CREATCHANNEL', 'Create Channel first');

define('_MD_PDD2_NEWLAST', 'New Submitted Before Last Week');
define('_MD_PDD2_NEWTHIS', 'New Submitted Within This week');
define('_MD_PDD2_THREE', 'New Submitted Within Last Three days');
define('_MD_PDD2_TODAY', 'New Submitted Today');
define('_MD_PDD2_NO_FILES', 'No Files Yet');
