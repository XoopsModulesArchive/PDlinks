# phpMyAdmin SQL Dump
# version 2.5.5-pl1
# http://www.phpmyadmin.net
#
# Host: localhost
# Generation Time: Jul 25, 2004 at 11:45 PM
# Server version: 3.23.56
# PHP Version: 4.3.4
# 
# Database : `205test`
# 

# --------------------------------------------------------

#
# Table structure for table `PDlinks_broken`
#

CREATE TABLE PDlinks_broken (
    reportid     INT(5)         NOT NULL AUTO_INCREMENT,
    lid          INT(11)        NOT NULL DEFAULT '0',
    sender       INT(11)        NOT NULL DEFAULT '0',
    ip           VARCHAR(20)    NOT NULL DEFAULT '',
    date         VARCHAR(11)    NOT NULL DEFAULT '0',
    confirmed    ENUM ('0','1') NOT NULL DEFAULT '0',
    acknowledged ENUM ('0','1') NOT NULL DEFAULT '0',
    PRIMARY KEY (reportid),
    KEY lid (lid),
    KEY sender (sender),
    KEY ip (ip)
)
    ENGINE = ISAM;

#
# Dumping data for table `PDlinks_broken`
#


# --------------------------------------------------------

#
# Table structure for table `PDlinks_cat`
#

CREATE TABLE PDlinks_cat (
    cid          INT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
    pid          INT(5) UNSIGNED NOT NULL DEFAULT '0',
    title        VARCHAR(50)     NOT NULL DEFAULT '',
    imgurl       VARCHAR(150)    NOT NULL DEFAULT '',
    description  VARCHAR(255)    NOT NULL DEFAULT '',
    total        INT(11)         NOT NULL DEFAULT '0',
    spotlighttop INT(11)         NOT NULL DEFAULT '0',
    spotlighthis INT(11)         NOT NULL DEFAULT '0',
    nohtml       INT(1)          NOT NULL DEFAULT '0',
    nosmiley     INT(1)          NOT NULL DEFAULT '0',
    noxcodes     INT(1)          NOT NULL DEFAULT '0',
    noimages     INT(1)          NOT NULL DEFAULT '0',
    nobreak      INT(1)          NOT NULL DEFAULT '1',
    weight       INT(11)         NOT NULL DEFAULT '0',
    PRIMARY KEY (cid),
    KEY pid (pid)
)
    ENGINE = ISAM;

#
# Dumping data for table `PDlinks_cat`
#

# --------------------------------------------------------

#
# Table structure for table `PDlinks_links`
#

CREATE TABLE PDlinks_links (
    lid         INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    cid         INT(5) UNSIGNED  NOT NULL DEFAULT '0',
    title       VARCHAR(100)     NOT NULL DEFAULT '',
    url         VARCHAR(255)     NOT NULL DEFAULT '',
    screenshot  VARCHAR(255)     NOT NULL DEFAULT '',
    submitter   INT(11)          NOT NULL DEFAULT '0',
    publisher   VARCHAR(255)     NOT NULL DEFAULT '',
    status      TINYINT(2)       NOT NULL DEFAULT '0',
    date        INT(10)          NOT NULL DEFAULT '0',
    hits        INT(11) UNSIGNED NOT NULL DEFAULT '0',
    rating      DOUBLE(6, 4)     NOT NULL DEFAULT '0.0000',
    votes       INT(11) UNSIGNED NOT NULL DEFAULT '0',
    comments    INT(11) UNSIGNED NOT NULL DEFAULT '0',
    forumid     INT(11)          NOT NULL DEFAULT '0',
    published   INT(11)          NOT NULL DEFAULT '1089662528',
    expired     INT(10)          NOT NULL DEFAULT '0',
    updated     INT(11)          NOT NULL DEFAULT '0',
    offline     TINYINT(1)       NOT NULL DEFAULT '0',
    description TEXT             NOT NULL,
    ipaddress   VARCHAR(120)     NOT NULL DEFAULT '0',
    notifypub   INT(1)           NOT NULL DEFAULT '0',
    PRIMARY KEY (lid),
    KEY cid (cid),
    KEY status (status),
    KEY title (title(40))
)
    ENGINE = ISAM;

#
# Dumping data for table `PDlinks_links`
#

# --------------------------------------------------------

#
# Table structure for table `PDlinks_indexpage`
#

CREATE TABLE PDlinks_indexpage (
    indeximage       VARCHAR(255) NOT NULL DEFAULT 'blank.png',
    indexheading     VARCHAR(255) NOT NULL DEFAULT 'PD-Links',
    indexheader      TEXT         NOT NULL,
    indexfooter      TEXT         NOT NULL,
    nohtml           TINYINT(8)   NOT NULL DEFAULT '1',
    nosmiley         TINYINT(8)   NOT NULL DEFAULT '1',
    noxcodes         TINYINT(8)   NOT NULL DEFAULT '1',
    noimages         TINYINT(8)   NOT NULL DEFAULT '1',
    nobreak          TINYINT(4)   NOT NULL DEFAULT '0',
    indexheaderalign VARCHAR(25)  NOT NULL DEFAULT 'left',
    indexfooteralign VARCHAR(25)  NOT NULL DEFAULT 'center',
    FULLTEXT KEY indexheading (indexheading),
    FULLTEXT KEY indexheader (indexheader),
    FULLTEXT KEY indexfooter (indexfooter)
)
    ENGINE = ISAM;

#
# Dumping data for table `PDlinks_indexpage`
#

INSERT INTO PDlinks_indexpage
VALUES ('logo-en.gif', 'PD-Links', '<div><b>Welcome to the PD Links Section.</b></div>', 'PD-Links', 0, 0, 0, 0, 1, 'left', 'Center');

# --------------------------------------------------------


#
# Table structure for table `PDlinks_mod`
#

CREATE TABLE PDlinks_mod (
    requestid       INT(11)          NOT NULL AUTO_INCREMENT,
    lid             INT(11) UNSIGNED NOT NULL DEFAULT '0',
    cid             INT(5) UNSIGNED  NOT NULL DEFAULT '0',
    title           VARCHAR(255)     NOT NULL DEFAULT '',
    url             VARCHAR(255)     NOT NULL DEFAULT '',
    screenshot      VARCHAR(255)     NOT NULL DEFAULT '',
    submitter       INT(11)          NOT NULL DEFAULT '0',
    publisher       TEXT             NOT NULL,
    status          TINYINT(2)       NOT NULL DEFAULT '0',
    date            INT(10)          NOT NULL DEFAULT '0',
    hits            INT(11) UNSIGNED NOT NULL DEFAULT '0',
    rating          DOUBLE(6, 4)     NOT NULL DEFAULT '0.0000',
    votes           INT(11) UNSIGNED NOT NULL DEFAULT '0',
    comments        INT(11) UNSIGNED NOT NULL DEFAULT '0',
    forumid         INT(11)          NOT NULL DEFAULT '0',
    published       INT(10)          NOT NULL DEFAULT '0',
    expired         INT(10)          NOT NULL DEFAULT '0',
    updated         INT(11)          NOT NULL DEFAULT '0',
    offline         TINYINT(1)       NOT NULL DEFAULT '0',
    description     TEXT             NOT NULL,
    modifysubmitter INT(11)          NOT NULL DEFAULT '0',
    requestdate     INT(11)          NOT NULL DEFAULT '0',
    PRIMARY KEY (requestid)
)
    ENGINE = ISAM;

#
# Dumping data for table `PDlinks_mod`
#

# --------------------------------------------------------


#
# Table structure for table `PDlinks_votedata`
#

CREATE TABLE PDlinks_votedata (
    ratingid        INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
    lid             INT(11) UNSIGNED    NOT NULL DEFAULT '0',
    ratinguser      INT(11)             NOT NULL DEFAULT '0',
    rating          TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',
    ratinghostname  VARCHAR(60)         NOT NULL DEFAULT '',
    ratingtimestamp INT(10)             NOT NULL DEFAULT '0',
    PRIMARY KEY (ratingid),
    KEY ratinguser (ratinguser),
    KEY ratinghostname (ratinghostname),
    KEY lid (lid)
)
    ENGINE = ISAM;

#
# Dumping data for table `PDlinks_votedata`
#
