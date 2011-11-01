
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- text
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `text`;


CREATE TABLE `text`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- text_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `text_i18n`;


CREATE TABLE `text_i18n`
(
	`title` VARCHAR(255)  NOT NULL,
	`body` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `text_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `text` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- itemtypes
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `itemtypes`;


CREATE TABLE `itemtypes`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(10)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- item2item
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `item2item`;


CREATE TABLE `item2item`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`item1_id` INTEGER  NOT NULL,
	`item1_type` INTEGER  NOT NULL,
	`item2_id` INTEGER  NOT NULL,
	`item2_type` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `item2item_I_1`(`item1_id`),
	KEY `item2item_I_2`(`item1_type`),
	KEY `item2item_I_3`(`item2_id`),
	KEY `item2item_I_4`(`item2_type`),
	CONSTRAINT `item2item_FK_1`
		FOREIGN KEY (`item1_type`)
		REFERENCES `itemtypes` (`id`),
	CONSTRAINT `item2item_FK_2`
		FOREIGN KEY (`item2_type`)
		REFERENCES `itemtypes` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- news
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `news`;


CREATE TABLE `news`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`date` DATE,
	`updated_at` DATETIME,
	`show` TINYINT default 1,
	`order` INTEGER  NOT NULL,
	`img` VARCHAR(255),
	`full_path` VARCHAR(255),
	`thumb_path` VARCHAR(255),
	`original` TEXT  NOT NULL,
	`type` INTEGER default 1 NOT NULL,
	PRIMARY KEY (`id`),
	KEY `news_I_1`(`type`),
	KEY `index_order`(`order`),
	KEY `updated_at`(`updated_at`),
	CONSTRAINT `news_FK_1`
		FOREIGN KEY (`type`)
		REFERENCES `newstypes` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- news_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `news_i18n`;


CREATE TABLE `news_i18n`
(
	`updated_at_extra` DATETIME,
	`title` TEXT  NOT NULL,
	`shortbody` TEXT  NOT NULL,
	`body` TEXT  NOT NULL,
	`author` VARCHAR(255),
	`translated_by` VARCHAR(255),
	`link` VARCHAR(255),
	`extradate` VARCHAR(255),
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	KEY `updated_at_extra`(`updated_at_extra`),
	CONSTRAINT `news_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `news` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- newstypes
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `newstypes`;


CREATE TABLE `newstypes`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(20)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- upload
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `upload`;


CREATE TABLE `upload`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255)  NOT NULL,
	`url` VARCHAR(255),
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- photo
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `photo`;


CREATE TABLE `photo`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`photoalbum_id` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`show` TINYINT default 1,
	`order` INTEGER  NOT NULL,
	`img` VARCHAR(255),
	`full_path` VARCHAR(255),
	`preview_path` VARCHAR(255),
	`thumb_path` VARCHAR(255),
	`link` VARCHAR(255),
	PRIMARY KEY (`id`),
	KEY `updated_at`(`updated_at`),
	INDEX `photo_FI_1` (`photoalbum_id`),
	CONSTRAINT `photo_FK_1`
		FOREIGN KEY (`photoalbum_id`)
		REFERENCES `photoalbum` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- photo_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `photo_i18n`;


CREATE TABLE `photo_i18n`
(
	`updated_at_extra` DATETIME,
	`title` TEXT,
	`body` TEXT,
	`author` VARCHAR(255),
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	KEY `updated_at_extra`(`updated_at_extra`),
	CONSTRAINT `photo_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `photo` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- photoalbum
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `photoalbum`;


CREATE TABLE `photoalbum`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`show` TINYINT default 1,
	`order` INTEGER  NOT NULL,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- photoalbum_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `photoalbum_i18n`;


CREATE TABLE `photoalbum_i18n`
(
	`title` TEXT,
	`body` TEXT,
	`author` VARCHAR(255),
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `photoalbum_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `photoalbum` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- video
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `video`;


CREATE TABLE `video`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`show` TINYINT default 1,
	`order` INTEGER  NOT NULL,
	`link` VARCHAR(255),
	`all_cultures` TINYINT default 0,
	PRIMARY KEY (`id`),
	KEY `updated_at`(`updated_at`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- video_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `video_i18n`;


CREATE TABLE `video_i18n`
(
	`updated_at_extra` DATETIME,
	`img` VARCHAR(255)  NOT NULL,
	`code` TEXT  NOT NULL,
	`title` TEXT,
	`body` TEXT,
	`author` VARCHAR(255),
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	KEY `updated_at_extra`(`updated_at_extra`),
	CONSTRAINT `video_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `video` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- quote
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `quote`;


CREATE TABLE `quote`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- quote_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `quote_i18n`;


CREATE TABLE `quote_i18n`
(
	`title` TEXT  NOT NULL,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `quote_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `quote` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- audio
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `audio`;


CREATE TABLE `audio`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`show` TINYINT default 1,
	`file` VARCHAR(255)  NOT NULL,
	`remote` VARCHAR(255),
	`size` FLOAT,
	`duration` FLOAT,
	`order` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `audio_I_1`(`order`),
	KEY `updated_at`(`updated_at`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- audio_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `audio_i18n`;


CREATE TABLE `audio_i18n`
(
	`updated_at_extra` DATETIME,
	`title` TEXT,
	`body` TEXT,
	`author` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	KEY `updated_at_extra`(`updated_at_extra`),
	CONSTRAINT `audio_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `audio` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
