
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;


CREATE TABLE `user`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`timezone_id` INTEGER,
	`name` VARCHAR(255)  NOT NULL,
	`email` VARCHAR(255)  NOT NULL,
	`password` VARCHAR(255)  NOT NULL,
	`profile` VARCHAR(255),
	`is_active` TINYINT default 1,
	`remember_me_code` VARCHAR(255),
	`ip` VARCHAR(20),
	`last_login` DATETIME,
	`lang` VARCHAR(7),
	`phpbb_id` INTEGER,
	`remind_code` VARCHAR(32),
	`subscribe_news` TINYINT default 1,
	`subscribe_photo` TINYINT default 1,
	`subscribe_video` TINYINT default 1,
	`notes` TEXT,
	PRIMARY KEY (`id`),
	UNIQUE KEY `user_U_1` (`name`),
	UNIQUE KEY `user_U_2` (`email`),
	INDEX `user_FI_1` (`timezone_id`),
	CONSTRAINT `user_FK_1`
		FOREIGN KEY (`timezone_id`)
		REFERENCES `timezone` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- timezone
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `timezone`;


CREATE TABLE `timezone`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`value` FLOAT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- timezone_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `timezone_i18n`;


CREATE TABLE `timezone_i18n`
(
	`title` VARCHAR(255)  NOT NULL,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `timezone_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `timezone` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- comments
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;


CREATE TABLE `comments`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`user_id` INTEGER,
	`show` TINYINT default 1,
	`status` TINYINT default 0,
	PRIMARY KEY (`id`),
	INDEX `comments_FI_1` (`user_id`),
	CONSTRAINT `comments_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- comments_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `comments_i18n`;


CREATE TABLE `comments_i18n`
(
	`body` TEXT  NOT NULL,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `comments_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `comments` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- text
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `text`;


CREATE TABLE `text`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

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
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- itemtypes
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `itemtypes`;


CREATE TABLE `itemtypes`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(10)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

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
)Type=InnoDB;

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
	`prev_img` VARCHAR(255),
	PRIMARY KEY (`id`),
	KEY `news_I_1`(`type`),
	KEY `index_order`(`order`),
	KEY `updated_at`(`updated_at`),
	CONSTRAINT `news_FK_1`
		FOREIGN KEY (`type`)
		REFERENCES `newstypes` (`id`)
)Type=InnoDB;

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
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- newstypes
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `newstypes`;


CREATE TABLE `newstypes`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(20)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- news2comments
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `news2comments`;


CREATE TABLE `news2comments`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`news_id` INTEGER,
	`comments_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `news2comments_FI_1` (`news_id`),
	CONSTRAINT `news2comments_FK_1`
		FOREIGN KEY (`news_id`)
		REFERENCES `news` (`id`),
	INDEX `news2comments_FI_2` (`comments_id`),
	CONSTRAINT `news2comments_FK_2`
		FOREIGN KEY (`comments_id`)
		REFERENCES `comments` (`id`)
)Type=InnoDB;

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
)Type=InnoDB;

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
	`prev_img` VARCHAR(255),
	PRIMARY KEY (`id`),
	KEY `updated_at`(`updated_at`),
	INDEX `photo_FI_1` (`photoalbum_id`),
	CONSTRAINT `photo_FK_1`
		FOREIGN KEY (`photoalbum_id`)
		REFERENCES `photoalbum` (`id`)
)Type=InnoDB;

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
)Type=InnoDB;

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
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- photoalbum_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `photoalbum_i18n`;


CREATE TABLE `photoalbum_i18n`
(
	`title` TEXT,
	`author` VARCHAR(255),
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `photoalbum_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `photoalbum` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- photo2comments
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `photo2comments`;


CREATE TABLE `photo2comments`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`photo_id` INTEGER,
	`comments_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `photo2comments_FI_1` (`photo_id`),
	CONSTRAINT `photo2comments_FK_1`
		FOREIGN KEY (`photo_id`)
		REFERENCES `photo` (`id`),
	INDEX `photo2comments_FI_2` (`comments_id`),
	CONSTRAINT `photo2comments_FK_2`
		FOREIGN KEY (`comments_id`)
		REFERENCES `comments` (`id`)
)Type=InnoDB;

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
)Type=InnoDB;

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
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- video2comments
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `video2comments`;


CREATE TABLE `video2comments`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`video_id` INTEGER,
	`comments_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `video2comments_FI_1` (`video_id`),
	CONSTRAINT `video2comments_FK_1`
		FOREIGN KEY (`video_id`)
		REFERENCES `video` (`id`),
	INDEX `video2comments_FI_2` (`comments_id`),
	CONSTRAINT `video2comments_FK_2`
		FOREIGN KEY (`comments_id`)
		REFERENCES `comments` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- quote
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `quote`;


CREATE TABLE `quote`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

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
)Type=InnoDB;

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
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- audio_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `audio_i18n`;


CREATE TABLE `audio_i18n`
(
	`updated_at_extra` DATETIME,
	`title` TEXT,
	`author` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	KEY `updated_at_extra`(`updated_at_extra`),
	CONSTRAINT `audio_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `audio` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- alert
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `alert`;


CREATE TABLE `alert`
(
	`created_at` DATETIME,
	`user_id` INTEGER  NOT NULL,
	`item_type` INTEGER  NOT NULL,
	`item_id` INTEGER  NOT NULL,
	`item_lang` VARCHAR(7)  NOT NULL,
	`item_by_user` INTEGER,
	`is_comment` TINYINT default 0 NOT NULL,
	`status` INTEGER  NOT NULL,
	PRIMARY KEY (`user_id`,`item_type`,`item_id`,`item_lang`,`is_comment`,`status`),
	KEY `alert_I_1`(`user_id`),
	KEY `alert_I_2`(`status`),
	CONSTRAINT `alert_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`),
	INDEX `alert_FI_2` (`item_by_user`),
	CONSTRAINT `alert_FK_2`
		FOREIGN KEY (`item_by_user`)
		REFERENCES `user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- subscribe
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `subscribe`;


CREATE TABLE `subscribe`
(
	`user_id` INTEGER  NOT NULL,
	`item_id` INTEGER  NOT NULL,
	`item_type` INTEGER  NOT NULL,
	`item_lang` VARCHAR(7)  NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`user_id`,`item_id`,`item_type`,`item_lang`),
	KEY `subscribe_I_1`(`user_id`),
	CONSTRAINT `subscribe_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- mail
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `mail`;


CREATE TABLE `mail`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`sent` TINYINT default 0,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- mail_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `mail_i18n`;


CREATE TABLE `mail_i18n`
(
	`title` TEXT,
	`body` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `mail_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `mail` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
