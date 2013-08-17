ALTER TABLE `#__sr_currencies` DROP FOREIGN KEY `fk_sr_currencies_sr_countries1` ;

ALTER TABLE `#__sr_customers` DROP FOREIGN KEY `fk_sr_customers_sr_customer_groups1` ;

ALTER TABLE `#__sr_reservation_assets`
  ADD COLUMN `deposit_required` TINYINT(3) UNSIGNED NULL DEFAULT 0  AFTER `default` ,
  ADD COLUMN `deposit_is_percentage` TINYINT(3) UNSIGNED NULL DEFAULT 1  AFTER `deposit_required` ,
  ADD COLUMN `deposit_amount` FLOAT(10,6) UNSIGNED NULL DEFAULT NULL  AFTER `deposit_is_percentage` ,
  ADD COLUMN `currency_id` INT(11) UNSIGNED NOT NULL  AFTER `deposit_amount` ,
  CHANGE COLUMN `lat` `lat` FLOAT(10,6) NULL DEFAULT 0  ,
  CHANGE COLUMN `lng` `lng` FLOAT(10,6) NULL DEFAULT 0  ,
  ADD CONSTRAINT `fk_sr_reservation_assets_sr_currencies1`
  FOREIGN KEY (`currency_id` )
  REFERENCES `#__sr_currencies` (`id` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
, ADD INDEX `fk_sr_reservation_assets_sr_currencies1_idx` (`currency_id` ASC) ;

ALTER TABLE `#__sr_reservations`
  CHANGE COLUMN `note` `note` TEXT NULL DEFAULT NULL  AFTER `total_discount` ,
  CHANGE COLUMN `checkin` `checkin` DATE NOT NULL DEFAULT '0000-00-00'  ,
  CHANGE COLUMN `checkout` `checkout` DATE NOT NULL DEFAULT '0000-00-00'  ,
  ADD COLUMN `coupon_code` VARCHAR(15) NULL DEFAULT NULL  AFTER `coupon_id` ,
  ADD COLUMN `customer_phonenumber` VARCHAR(45) NULL DEFAULT NULL  AFTER `customer_email` ,
  ADD COLUMN `customer_company` VARCHAR(45) NULL DEFAULT NULL  AFTER `customer_phonenumber` ,
  ADD COLUMN `customer_address1` VARCHAR(45) NULL DEFAULT NULL  AFTER `customer_company` ,
  ADD COLUMN `customer_address2` VARCHAR(45) NULL DEFAULT NULL  AFTER `customer_address1` ,
  ADD COLUMN `customer_city` VARCHAR(45) NULL DEFAULT NULL  AFTER `customer_address2` ,
  ADD COLUMN `customer_zipcode` VARCHAR(45) NULL DEFAULT NULL  AFTER `customer_city` ,
  ADD COLUMN `customer_country_id` INT(11) NULL DEFAULT NULL  AFTER `customer_zipcode` ,
  ADD COLUMN `customer_geo_state_id` INT(11) NULL DEFAULT NULL  AFTER `customer_country_id` ,
  ADD COLUMN `currency_code` VARCHAR(10) NULL DEFAULT NULL  AFTER `currency_id` ,
  ADD COLUMN `reservation_asset_id` INT(11) UNSIGNED NULL DEFAULT NULL  AFTER `note` ,
  ADD COLUMN `reservation_asset_name` VARCHAR(255) NULL DEFAULT NULL  AFTER `reservation_asset_id` ,
  ADD CONSTRAINT `fk_sr_reservations_sr_reservation_assets1`
  FOREIGN KEY (`reservation_asset_id` )
  REFERENCES `#__sr_reservation_assets` (`id` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
, ADD INDEX `fk_sr_reservations_sr_reservation_assets1_idx` (`reservation_asset_id` ASC) ;

ALTER TABLE `#__sr_currencies`
  DROP COLUMN `country_id`
, DROP INDEX `fk_sr_currencies_sr_countries1_idx` ;

ALTER TABLE `#__sr_extras`
  CHANGE COLUMN `price` `price` DECIMAL(12,2) UNSIGNED NOT NULL DEFAULT 0  ;

ALTER TABLE `#__sr_reservation_room_xref`
  ADD COLUMN `room_price` DECIMAL(12,2) NULL DEFAULT NULL  AFTER `guest_fullname` ;

ALTER TABLE `#__sr_coupons`
  ADD COLUMN `valid_from_checkin` DATE NULL DEFAULT '0000-00-00'  AFTER `reservation_asset_id` ,
  ADD COLUMN `valid_to_checkin` DATE NULL DEFAULT '0000-00-00'  AFTER `valid_from_checkin` ,
  CHANGE COLUMN `valid_from` `valid_from` DATE NOT NULL DEFAULT '0000-00-00'  ,
  CHANGE COLUMN `valid_to` `valid_to` DATE NOT NULL DEFAULT '0000-00-00'  ,
  ADD CONSTRAINT `fk_sr_coupons_sr_reservation_assets1`
  FOREIGN KEY (`reservation_asset_id` )
  REFERENCES `#__sr_reservation_assets` (`id` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
, ADD INDEX `fk_sr_coupons_sr_reservation_assets1_idx` (`reservation_asset_id` ASC) ;

ALTER TABLE `#__sr_customers`
  DROP COLUMN `group_id` ,
  ADD COLUMN `customer_group_id` INT(11) UNSIGNED NOT NULL  AFTER `id` ,
  ADD CONSTRAINT `fk_sr_customers_sr_customer_groups1`
  FOREIGN KEY (`customer_group_id` )
  REFERENCES `#__sr_customer_groups` (`id` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
, DROP INDEX `fk_sr_customers_sr_customer_groups1_idx` 
, ADD INDEX `fk_sr_customers_sr_customer_groups1_idx` (`customer_group_id` ASC) ;

CREATE  TABLE IF NOT EXISTS `#__sr_reservation_notes` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `reservation_id` INT(11) UNSIGNED NULL DEFAULT NULL ,
  `text` TEXT NULL DEFAULT NULL ,
  `created_date` DATETIME NULL DEFAULT '0000-00-00 00:00:00' ,
  `created_by` INT(11) UNSIGNED NULL DEFAULT NULL ,
  `notify_customer` TINYINT(3) UNSIGNED NULL DEFAULT 0 ,
  `visible_in_frontend` TINYINT(3) UNSIGNED NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_jos_sr_reservation_notes_jos_sr_reservations1_idx` (`reservation_id` ASC) ,
  CONSTRAINT `fk_jos_sr_reservation_notes_jos_sr_reservations1`
    FOREIGN KEY (`reservation_id` )
    REFERENCES `#__sr_reservations` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE  TABLE IF NOT EXISTS `#__sr_config_data` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `scope_id` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `data_key` VARCHAR(255) NOT NULL ,
  `data_value` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;