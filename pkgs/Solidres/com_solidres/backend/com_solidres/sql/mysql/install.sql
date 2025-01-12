-- -----------------------------------------------------
-- Table `#__sr_categories`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `#__sr_categories` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `parent_id` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `asset_id` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `lft` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `rgt` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `title` VARCHAR(255) NOT NULL ,
  `alias` VARCHAR(255) NOT NULL ,
  `description` TEXT NOT NULL ,
  `state` TINYINT(3) NOT NULL DEFAULT 0 ,
  `ordering` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `access` INT(11) UNSIGNED NOT NULL DEFAULT 1 ,
  `checked_out` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  `created_by` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `created_date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  `modified_by` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `modified_date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  `params` TEXT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__sr_countries`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `#__sr_countries` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `code_2` VARCHAR(10) NOT NULL ,
  `code_3` VARCHAR(10) NOT NULL ,
  `state` TINYINT(11) NOT NULL DEFAULT 0 ,
  `checked_out` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  `created_by` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `created_date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  `modified_by` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `modified_date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__sr_geo_states`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `#__sr_geo_states` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `country_id` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `name` VARCHAR(45) NOT NULL ,
  `code_2` VARCHAR(10) NOT NULL ,
  `code_3` VARCHAR(10) NOT NULL ,
  `state` TINYINT(3) NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_sr_geo_states_sr_countries1_idx` (`country_id` ASC) ,
  CONSTRAINT `fk_sr_geo_states_sr_countries1`
    FOREIGN KEY (`country_id` )
    REFERENCES `#__sr_countries` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__sr_customer_groups`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `#__sr_customer_groups` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `state` TINYINT(3) NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__sr_customers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `#__sr_customers` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `customer_group_id` INT(11) UNSIGNED NULL DEFAULT NULL ,
  `user_id` INT(11) UNSIGNED NOT NULL COMMENT 'The Joomla User Id' ,
  `customer_code` VARCHAR(255) NULL ,
  `firstname` VARCHAR(255) NULL ,
  `middlename` VARCHAR(255) NULL ,
  `lastname` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_sr_customers_sr_customer_groups1_idx` (`customer_group_id` ASC) ,
  CONSTRAINT `fk_sr_customers_sr_customer_groups1`
    FOREIGN KEY (`customer_group_id` )
    REFERENCES `#__sr_customer_groups` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__sr_currencies`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `#__sr_currencies` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `currency_name` VARCHAR(45) NOT NULL ,
  `currency_code` VARCHAR(10) NOT NULL ,
  `state` TINYINT(3) NOT NULL DEFAULT 0 ,
  `exchange_rate` FLOAT UNSIGNED NOT NULL DEFAULT 0 ,
  `sign` VARCHAR(10) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__sr_reservation_assets`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `#__sr_reservation_assets` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `asset_id` INT(11) UNSIGNED NULL DEFAULT NULL ,
  `category_id` INT(11) UNSIGNED NULL DEFAULT NULL ,
  `name` VARCHAR(255) NOT NULL ,
  `alias` VARCHAR(255) NOT NULL ,
  `address_1` VARCHAR(255) NOT NULL ,
  `address_2` VARCHAR(255) NOT NULL ,
  `city` VARCHAR(45) NOT NULL ,
  `postcode` VARCHAR(45) NOT NULL ,
  `phone` VARCHAR(30) NOT NULL ,
  `description` TEXT NOT NULL ,
  `email` VARCHAR(50) NOT NULL ,
  `website` VARCHAR(255) NOT NULL ,
  `featured` TINYINT(3) UNSIGNED NOT NULL DEFAULT 0 ,
  `fax` VARCHAR(45) NOT NULL ,
  `rating` TINYINT(3) UNSIGNED NOT NULL DEFAULT 0 ,
  `geo_state_id` INT(11) UNSIGNED NULL DEFAULT NULL ,
  `country_id` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `created_date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  `modified_date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  `created_by` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `modified_by` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `state` TINYINT(3) NOT NULL DEFAULT 0 ,
  `checked_out` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  `ordering` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `archived` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 ,
  `approved` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 ,
  `access` INT(11) UNSIGNED NOT NULL DEFAULT 1 ,
  `params` TEXT NOT NULL ,
  `language` VARCHAR(10) NOT NULL ,
  `hits` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `metakey` TEXT NOT NULL ,
  `metadesc` TEXT NOT NULL ,
  `metadata` TEXT NOT NULL ,
  `xreference` VARCHAR(50) NOT NULL ,
  `partner_id` INT(11) UNSIGNED NULL ,
  `lat` FLOAT(10,6) NULL DEFAULT 0 ,
  `lng` FLOAT(10,6) NULL DEFAULT 0 ,
  `default` TINYINT(3) UNSIGNED NOT NULL DEFAULT 0 ,
  `deposit_required` TINYINT(3) UNSIGNED NULL DEFAULT 0 ,
  `deposit_is_percentage` TINYINT(3) UNSIGNED NULL DEFAULT 1 ,
  `deposit_amount` FLOAT(10,6) UNSIGNED NULL ,
  `currency_id` INT(11) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_sr_reservation_assets_sr_categories1_idx` (`category_id` ASC) ,
  INDEX `fk_sr_reservation_assets_sr_countries1_idx` (`country_id` ASC) ,
  INDEX `fk_sr_reservation_assets_sr_geo_states1_idx` (`geo_state_id` ASC) ,
  INDEX `fk_sr_reservation_assets_sr_customers1_idx` (`partner_id` ASC) ,
  INDEX `fk_sr_reservation_assets_sr_currencies1_idx` (`currency_id` ASC) ,
  CONSTRAINT `fk_sr_reservation_assets_sr_categories1`
    FOREIGN KEY (`category_id` )
    REFERENCES `#__sr_categories` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sr_reservation_assets_sr_countries1`
    FOREIGN KEY (`country_id` )
    REFERENCES `#__sr_countries` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sr_reservation_assets_sr_geo_states1`
    FOREIGN KEY (`geo_state_id` )
    REFERENCES `#__sr_geo_states` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sr_reservation_assets_sr_customers1`
    FOREIGN KEY (`partner_id` )
    REFERENCES `#__sr_customers` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sr_reservation_assets_sr_currencies1`
    FOREIGN KEY (`currency_id` )
    REFERENCES `#__sr_currencies` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__sr_room_types`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `#__sr_room_types` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `reservation_asset_id` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `name` VARCHAR(255) NOT NULL ,
  `alias` VARCHAR(255) NOT NULL ,
  `description` TEXT NOT NULL ,
  `state` TINYINT(3) NOT NULL DEFAULT 0 ,
  `checked_out` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  `created_by` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `created_date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  `modified_by` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `modified_date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  `language` VARCHAR(10) NOT NULL ,
  `params` TEXT NOT NULL ,
  `featured` TINYINT(3) UNSIGNED NOT NULL DEFAULT 0 ,
  `ordering` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `occupancy_adult` TINYINT(2) UNSIGNED NOT NULL DEFAULT 0 ,
  `occupancy_child` TINYINT(2) UNSIGNED NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_sr_room_types_sr_reservation_assets1_idx` (`reservation_asset_id` ASC) ,
  CONSTRAINT `fk_sr_room_types_sr_reservation_assets1`
    FOREIGN KEY (`reservation_asset_id` )
    REFERENCES `#__sr_reservation_assets` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__sr_coupons`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `#__sr_coupons` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `state` TINYINT(3) NOT NULL DEFAULT 0 ,
  `coupon_name` VARCHAR(255) NOT NULL ,
  `coupon_code` VARCHAR(15) NOT NULL ,
  `amount` INT(11) NOT NULL ,
  `is_percent` TINYINT(1) NOT NULL DEFAULT 0 ,
  `valid_from` DATE NOT NULL DEFAULT '0000-00-00' ,
  `valid_to` DATE NOT NULL DEFAULT '0000-00-00' ,
  `customer_group_id` INT(11) UNSIGNED NULL ,
  `reservation_asset_id` INT(11) UNSIGNED NOT NULL ,
  `valid_from_checkin` DATE NULL DEFAULT '0000-00-00' ,
  `valid_to_checkin` DATE NULL DEFAULT '0000-00-00' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_sr_coupons_sr_customer_groups1_idx` (`customer_group_id` ASC) ,
  INDEX `fk_sr_coupons_sr_reservation_assets1_idx` (`reservation_asset_id` ASC) ,
  CONSTRAINT `fk_sr_coupons_sr_customer_groups1`
    FOREIGN KEY (`customer_group_id` )
    REFERENCES `#__sr_customer_groups` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sr_coupons_sr_reservation_assets1`
    FOREIGN KEY (`reservation_asset_id` )
    REFERENCES `#__sr_reservation_assets` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__sr_reservations`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `#__sr_reservations` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `state` TINYINT(3) NOT NULL DEFAULT 0 ,
  `customer_id` INT(11) UNSIGNED NULL DEFAULT NULL ,
  `created_date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  `modified_date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  `modified_by` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `created_by` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `payment_method_id` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `code` VARCHAR(255) NOT NULL ,
  `coupon_id` INT(11) UNSIGNED NULL ,
  `coupon_code` VARCHAR(15) NULL DEFAULT NULL ,
  `customer_firstname` VARCHAR(255) NULL ,
  `customer_middlename` VARCHAR(255) NULL ,
  `customer_lastname` VARCHAR(255) NULL ,
  `customer_email` VARCHAR(255) NULL ,
  `customer_phonenumber` VARCHAR(45) NULL ,
  `customer_company` VARCHAR(45) NULL ,
  `customer_address1` VARCHAR(45) NULL ,
  `customer_address2` VARCHAR(45) NULL ,
  `customer_city` VARCHAR(45) NULL ,
  `customer_zipcode` VARCHAR(45) NULL ,
  `customer_country_id` INT(11) NULL ,
  `customer_geo_state_id` INT(11) NULL ,
  `checkin` DATE NOT NULL DEFAULT '0000-00-00' ,
  `checkout` DATE NOT NULL DEFAULT '0000-00-00' ,
  `invoice_number` VARCHAR(255) NULL ,
  `currency_id` INT(11) UNSIGNED NULL ,
  `currency_code` VARCHAR(10) NULL ,
  `total_price` DECIMAL(12,2) UNSIGNED NULL ,
  `total_price_tax_incl` DECIMAL(12,2) UNSIGNED NULL ,
  `total_price_tax_excl` DECIMAL(12,2) UNSIGNED NULL ,
  `total_extra_price` DECIMAL(12,2) UNSIGNED NULL ,
  `total_extra_price_tax_incl` DECIMAL(12,2) UNSIGNED NULL ,
  `total_extra_price_tax_excl` DECIMAL(12,2) UNSIGNED NULL ,
  `total_discount` DECIMAL(12,2) UNSIGNED NULL ,
  `note` TEXT NULL DEFAULT NULL ,
  `reservation_asset_id` INT(11) UNSIGNED NULL DEFAULT NULL ,
  `reservation_asset_name` VARCHAR(255) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `code_UNIQUE` (`code` ASC) ,
  INDEX `fk_sr_reservations_sr_coupons1_idx` (`coupon_id` ASC) ,
  INDEX `fk_sr_reservations_sr_reservation_assets1_idx` (`reservation_asset_id` ASC) ,
  CONSTRAINT `fk_sr_reservations_sr_coupons1`
    FOREIGN KEY (`coupon_id` )
    REFERENCES `#__sr_coupons` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sr_reservations_sr_reservation_assets1`
    FOREIGN KEY (`reservation_asset_id` )
    REFERENCES `#__sr_reservation_assets` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__sr_media`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `#__sr_media` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `type` VARCHAR(45) NOT NULL ,
  `value` TEXT NOT NULL ,
  `name` VARCHAR(255) NOT NULL ,
  `created_date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  `modified_date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  `created_by` INT(11) NOT NULL DEFAULT 0 ,
  `modified_by` INT(11) NOT NULL DEFAULT 0 ,
  `mime_type` VARCHAR(255) NOT NULL ,
  `size` INT(11) NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__sr_extras`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `#__sr_extras` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `state` TINYINT(3) NOT NULL DEFAULT 0 ,
  `description` TEXT NOT NULL ,
  `created_date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  `modified_date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  `created_by` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `modified_by` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `price` DECIMAL(12,2) UNSIGNED NOT NULL DEFAULT 0 ,
  `ordering` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `max_quantity` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `daily_chargable` TINYINT(3) UNSIGNED NOT NULL DEFAULT 0 ,
  `reservation_asset_id` INT(11) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_sr_extras_sr_reservation_assets1_idx` (`reservation_asset_id` ASC) ,
  CONSTRAINT `fk_sr_extras_sr_reservation_assets1`
    FOREIGN KEY (`reservation_asset_id` )
    REFERENCES `#__sr_reservation_assets` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__sr_prices`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `#__sr_prices` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `currency_id` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `customer_group_id` INT(11) UNSIGNED NULL DEFAULT NULL COMMENT 'price for each user groups' ,
  `price` DECIMAL(12,2) NOT NULL ,
  `valid_from` DATETIME NOT NULL ,
  `valid_to` DATETIME NOT NULL ,
  `room_type_id` INT(11) UNSIGNED NULL ,
  `title` VARCHAR(45) NULL ,
  `description` VARCHAR(255) NULL ,
  `d_min` TINYINT NULL ,
  `d_max` TINYINT NULL ,
  `p_min` TINYINT NULL ,
  `p_max` TINYINT NULL ,
  `w_day` TINYINT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_sr_prices_sr_currencies1_idx` (`currency_id` ASC) ,
  INDEX `fk_sr_prices_sr_room_types1_idx` (`room_type_id` ASC) ,
  INDEX `fk_sr_prices_sr_customer_groups1_idx` (`customer_group_id` ASC) ,
  CONSTRAINT `fk_sr_prices_sr_currencies1`
    FOREIGN KEY (`currency_id` )
    REFERENCES `#__sr_currencies` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sr_prices_sr_room_types1`
    FOREIGN KEY (`room_type_id` )
    REFERENCES `#__sr_room_types` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sr_prices_sr_customer_groups1`
    FOREIGN KEY (`customer_group_id` )
    REFERENCES `#__sr_customer_groups` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__sr_rooms`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `#__sr_rooms` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `label` VARCHAR(255) NOT NULL ,
  `room_type_id` INT(11) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_sr_rooms_sr_room_types1_idx` (`room_type_id` ASC) ,
  CONSTRAINT `fk_sr_rooms_sr_room_types1`
    FOREIGN KEY (`room_type_id` )
    REFERENCES `#__sr_room_types` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__sr_reservation_room_xref`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `#__sr_reservation_room_xref` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `reservation_id` INT(11) UNSIGNED NOT NULL ,
  `room_id` INT(11) UNSIGNED NULL ,
  `room_label` VARCHAR(255) NULL ,
  `adults_number` TINYINT(2) UNSIGNED NOT NULL DEFAULT 0 ,
  `children_number` TINYINT(2) UNSIGNED NOT NULL DEFAULT 0 ,
  `guest_fullname` VARCHAR(500) NULL ,
  `room_price` DECIMAL(12,2) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_reservations_rooms_xref_reservations1_idx` (`reservation_id` ASC) ,
  INDEX `fk_sr_reservation_room_coupon_extra_xref_sr_rooms1_idx` (`room_id` ASC) ,
  CONSTRAINT `fk_reservations_rooms_xref_reservations1`
    FOREIGN KEY (`reservation_id` )
    REFERENCES `#__sr_reservations` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sr_reservation_room_coupon_extra_xref_sr_rooms1`
    FOREIGN KEY (`room_id` )
    REFERENCES `#__sr_rooms` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = '\nit include extra optionaly.\n';


-- -----------------------------------------------------
-- Table `#__sr_media_reservation_assets_xref`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `#__sr_media_reservation_assets_xref` (
  `media_id` INT(11) UNSIGNED NOT NULL ,
  `reservation_asset_id` INT(11) UNSIGNED NOT NULL ,
  `weight` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`media_id`, `reservation_asset_id`) ,
  INDEX `fk_sr_media_ref_reservation_assets_sr_media1_idx` (`media_id` ASC) ,
  INDEX `fk_sr_media_ref_reservation_assets_sr_reservation1_idx` (`reservation_asset_id` ASC) ,
  CONSTRAINT `fk_sr_media_ref_reservation_assets_sr_media1`
    FOREIGN KEY (`media_id` )
    REFERENCES `#__sr_media` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sr_media_ref_reservation_assets_sr_reservation1`
    FOREIGN KEY (`reservation_asset_id` )
    REFERENCES `#__sr_reservation_assets` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__sr_media_roomtype_xref`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `#__sr_media_roomtype_xref` (
  `media_id` INT(11) UNSIGNED NOT NULL ,
  `room_type_id` INT(11) UNSIGNED NOT NULL ,
  `weight` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  INDEX `fk_sr_media_ref_roomtype_sr_media1_idx` (`media_id` ASC) ,
  INDEX `fk_sr_media_ref_roomtype_sr_room_types1_idx` (`room_type_id` ASC) ,
  CONSTRAINT `fk_sr_media_ref_roomtype_sr_media1`
    FOREIGN KEY (`media_id` )
    REFERENCES `#__sr_media` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sr_media_ref_roomtype_sr_room_types1`
    FOREIGN KEY (`room_type_id` )
    REFERENCES `#__sr_room_types` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__sr_reservation_asset_fields`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `#__sr_reservation_asset_fields` (
  `reservation_asset_id` INT(11) UNSIGNED NOT NULL ,
  `field_key` VARCHAR(100) NOT NULL ,
  `field_value` TEXT NULL ,
  `ordering` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`field_key`, `reservation_asset_id`) ,
  INDEX `fk_sr_reservation_asset_fields_sr_reservation_assets1_idx` (`reservation_asset_id` ASC) ,
  CONSTRAINT `fk_sr_reservation_asset_fields_sr_reservation_assets1`
    FOREIGN KEY (`reservation_asset_id` )
    REFERENCES `#__sr_reservation_assets` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__sr_customer_fields`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `#__sr_customer_fields` (
  `user_id` INT(11) UNSIGNED NOT NULL ,
  `field_key` VARCHAR(100) NOT NULL ,
  `field_value` VARCHAR(255) NULL ,
  `ordering` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`field_key`) ,
  INDEX `fk_sr_customer_fields_sr_customers1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_sr_customer_fields_sr_customers1`
    FOREIGN KEY (`user_id` )
    REFERENCES `#__sr_customers` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__sr_taxes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `#__sr_taxes` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `rate` FLOAT NOT NULL ,
  `state` TINYINT(3) NOT NULL ,
  `country_id` INT(11) UNSIGNED NULL ,
  `geo_state_id` INT(11) UNSIGNED NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_sr_taxes_sr_countries1_idx` (`country_id` ASC) ,
  INDEX `fk_sr_taxes_sr_geo_states1_idx` (`geo_state_id` ASC) ,
  CONSTRAINT `fk_sr_taxes_sr_countries1`
    FOREIGN KEY (`country_id` )
    REFERENCES `#__sr_countries` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sr_taxes_sr_geo_states1`
    FOREIGN KEY (`geo_state_id` )
    REFERENCES `#__sr_geo_states` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__sr_room_type_coupon_xref`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `#__sr_room_type_coupon_xref` (
  `room_type_id` INT(11) UNSIGNED NOT NULL ,
  `coupon_id` INT(11) UNSIGNED NOT NULL ,
  PRIMARY KEY (`room_type_id`, `coupon_id`) ,
  INDEX `fk_sr_room_type_coupon_xref_sr_coupons1_idx` (`coupon_id` ASC) ,
  INDEX `fk_sr_room_type_coupon_xref_sr_room_types1_idx` (`room_type_id` ASC) ,
  CONSTRAINT `fk_sr_room_type_coupon_xref_sr_coupons1`
    FOREIGN KEY (`coupon_id` )
    REFERENCES `#__sr_coupons` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sr_room_type_coupon_xref_sr_room_types1`
    FOREIGN KEY (`room_type_id` )
    REFERENCES `#__sr_room_types` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__sr_room_type_extra_xref`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `#__sr_room_type_extra_xref` (
  `room_type_id` INT(11) UNSIGNED NOT NULL ,
  `extra_id` INT(11) UNSIGNED NOT NULL ,
  PRIMARY KEY (`room_type_id`, `extra_id`) ,
  INDEX `fk_sr_room_type_extra_xref_sr_extras1_idx` (`extra_id` ASC) ,
  INDEX `fk_sr_room_type_extra_xref_sr_room_types1_idx` (`room_type_id` ASC) ,
  CONSTRAINT `fk_sr_room_type_extra_xref_sr_extras1`
    FOREIGN KEY (`extra_id` )
    REFERENCES `#__sr_extras` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sr_room_type_extra_xref_sr_room_types1`
    FOREIGN KEY (`room_type_id` )
    REFERENCES `#__sr_room_types` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__sr_reservation_room_extra_xref`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `#__sr_reservation_room_extra_xref` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `reservation_id` INT(11) UNSIGNED NOT NULL ,
  `room_id` INT(11) UNSIGNED NULL ,
  `room_label` VARCHAR(255) NULL ,
  `extra_id` INT(11) UNSIGNED NULL ,
  `extra_name` VARCHAR(255) NULL ,
  `extra_quantity` INT(11) UNSIGNED NULL ,
  `extra_price` DECIMAL(12,2) UNSIGNED NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_sr_reservation_room_extra_xref_sr_reservations1` (`reservation_id` ASC) ,
  INDEX `fk_sr_reservation_room_extra_xref_sr_rooms1` (`room_id` ASC) ,
  INDEX `fk_sr_reservation_room_extra_xref_sr_extras1` (`extra_id` ASC) ,
  CONSTRAINT `fk_sr_reservation_room_extra_xref_sr_reservations1`
    FOREIGN KEY (`reservation_id` )
    REFERENCES `#__sr_reservations` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sr_reservation_room_extra_xref_sr_rooms1`
    FOREIGN KEY (`room_id` )
    REFERENCES `#__sr_rooms` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sr_reservation_room_extra_xref_sr_extras1`
    FOREIGN KEY (`extra_id` )
    REFERENCES `#__sr_extras` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__sr_room_type_fields`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `#__sr_room_type_fields` (
  `room_type_id` INT(11) UNSIGNED NOT NULL ,
  `field_key` VARCHAR(100) NOT NULL ,
  `field_value` TEXT NULL ,
  `ordering` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`room_type_id`, `field_key`) ,
  INDEX `fk_sr_room_type_fields_sr_room_types1_idx` (`room_type_id` ASC) ,
  CONSTRAINT `fk_sr_room_type_fields_sr_room_types1`
    FOREIGN KEY (`room_type_id` )
    REFERENCES `#__sr_room_types` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__sr_reservation_notes`
-- -----------------------------------------------------
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
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__sr_config_data`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `#__sr_config_data` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `scope_id` INT(11) UNSIGNED NOT NULL DEFAULT 0 ,
  `data_key` VARCHAR(255) NOT NULL ,
  `data_value` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;



--
-- Dumping data for table `#__sr_countries`
--
INSERT INTO `#__sr_countries` (`id`, `name`, `code_2`, `code_3`, `state`, `checked_out`, `checked_out_time`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(2, 'Afghanistan', 'AF', 'AFG', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 'Albania', 'AL', 'ALB', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 'Algeria', 'DZ', 'DZA', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(5, 'American Samoa', 'AS', 'ASM', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(6, 'Andorra', 'AD', 'AND', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(7, 'Angola', 'AO', 'AGO', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(8, 'Anguilla', 'AI', 'AIA', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(9, 'Antarctica', 'AQ', 'ATA', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(10, 'Antigua and Barbuda', 'AG', 'ATG', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(11, 'Argentina', 'AR', 'ARG', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(12, 'Armenia', 'AM', 'ARM', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(13, 'Aruba', 'AW', 'ABW', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(14, 'Australia', 'AU', 'AUS', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(15, 'Austria', 'AT', 'AUT', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(16, 'Azerbaijan', 'AZ', 'AZE', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(17, 'Bahamas', 'BS', 'BHS', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(18, 'Bahrain', 'BH', 'BHR', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(19, 'Bangladesh', 'BD', 'BGD', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(20, 'Barbados', 'BB', 'BRB', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(21, 'Belarus', 'BY', 'BLR', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(22, 'Belgium', 'BE', 'BEL', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(23, 'Belize', 'BZ', 'BLZ', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(24, 'Benin', 'BJ', 'BEN', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(25, 'Bermuda', 'BM', 'BMU', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(26, 'Bhutan', 'BT', 'BTN', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(27, 'Bolivia', 'BO', 'BOL', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(28, 'Bosnia and Herzegowina', 'BA', 'BIH', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(29, 'Botswana', 'BW', 'BWA', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(30, 'Bouvet Island', 'BV', 'BVT', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(31, 'Brazil', 'BR', 'BRA', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(32, 'British Indian Ocean Territory', 'IO', 'IOT', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(33, 'Brunei Darussalam', 'BN', 'BRN', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(34, 'Bulgaria', 'BG', 'BGR', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(35, 'Burkina Faso', 'BF', 'BFA', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(36, 'Burundi', 'BI', 'BDI', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(37, 'Cambodia', 'KH', 'KHM', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(38, 'Cameroon', 'CM', 'CMR', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(39, 'Canada', 'CA', 'CAN', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(40, 'Cape Verde', 'CV', 'CPV', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(41, 'Cayman Islands', 'KY', 'CYM', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(42, 'Central African Republic', 'CF', 'CAF', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(43, 'Chad', 'TD', 'TCD', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(44, 'Chile', 'CL', 'CHL', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(45, 'China', 'CN', 'CHN', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(46, 'Christmas Island', 'CX', 'CXR', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(47, 'Cocos (Keeling) Islands', 'CC', 'CCK', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(48, 'Colombia', 'CO', 'COL', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(49, 'Comoros', 'KM', 'COM', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(50, 'Congo', 'CG', 'COG', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(51, 'Cook Islands', 'CK', 'COK', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(52, 'Costa Rica', 'CR', 'CRI', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(53, 'Cote D''Ivoire', 'CI', 'CIV', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(54, 'Croatia', 'HR', 'HRV', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(55, 'Cuba', 'CU', 'CUB', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(56, 'Cyprus', 'CY', 'CYP', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(57, 'Czech Republic', 'CZ', 'CZE', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(58, 'Denmark', 'DK', 'DNK', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(59, 'Djibouti', 'DJ', 'DJI', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(60, 'Dominica', 'DM', 'DMA', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(61, 'Dominican Republic', 'DO', 'DOM', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(62, 'East Timor', 'TP', 'TMP', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(63, 'Ecuador', 'EC', 'ECU', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(64, 'Egypt', 'EG', 'EGY', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(65, 'El Salvador', 'SV', 'SLV', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(66, 'Equatorial Guinea', 'GQ', 'GNQ', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(67, 'Eritrea', 'ER', 'ERI', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(68, 'Estonia', 'EE', 'EST', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(69, 'Ethiopia', 'ET', 'ETH', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(70, 'Falkland Islands (Malvinas)', 'FK', 'FLK', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(71, 'Faroe Islands', 'FO', 'FRO', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(72, 'Fiji', 'FJ', 'FJI', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(73, 'Finland', 'FI', 'FIN', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(74, 'France', 'FR', 'FRA', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(75, 'France, Metropolitan', 'FX', 'FXX', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(76, 'French Guiana', 'GF', 'GUF', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(77, 'French Polynesia', 'PF', 'PYF', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(78, 'French Southern Territories', 'TF', 'ATF', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(79, 'Gabon', 'GA', 'GAB', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(80, 'Gambia', 'GM', 'GMB', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(81, 'Georgia', 'GE', 'GEO', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(82, 'Germany', 'DE', 'DEU', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(83, 'Ghana', 'GH', 'GHA', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(84, 'Gibraltar', 'GI', 'GIB', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(85, 'Greece', 'GR', 'GRC', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(86, 'Greenland', 'GL', 'GRL', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(87, 'Grenada', 'GD', 'GRD', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(88, 'Guadeloupe', 'GP', 'GLP', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(89, 'Guam', 'GU', 'GUM', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(90, 'Guatemala', 'GT', 'GTM', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(91, 'Guinea', 'GN', 'GIN', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(92, 'Guinea-bissau', 'GW', 'GNB', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(93, 'Guyana', 'GY', 'GUY', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(94, 'Haiti', 'HT', 'HTI', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(95, 'Heard and Mc Donald Islands', 'HM', 'HMD', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(96, 'Honduras', 'HN', 'HND', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(97, 'Hong Kong', 'HK', 'HKG', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(98, 'Hungary', 'HU', 'HUN', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(99, 'Iceland', 'IS', 'ISL', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(100, 'India', 'IN', 'IND', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(101, 'Indonesia', 'ID', 'IDN', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(102, 'Iran (Islamic Republic of)', 'IR', 'IRN', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(103, 'Iraq', 'IQ', 'IRQ', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(104, 'Ireland', 'IE', 'IRL', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(105, 'Israel', 'IL', 'ISR', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(106, 'Italy', 'IT', 'ITA', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(107, 'Jamaica', 'JM', 'JAM', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(108, 'Japan', 'JP', 'JPN', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(109, 'Jordan', 'JO', 'JOR', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(110, 'Kazakhstan', 'KZ', 'KAZ', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(111, 'Kenya', 'KE', 'KEN', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(112, 'Kiribati', 'KI', 'KIR', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(113, 'Korea, Democratic People''s Republic of', 'KP', 'PRK', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(114, 'Korea, Republic of', 'KR', 'KOR', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(115, 'Kuwait', 'KW', 'KWT', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(116, 'Kyrgyzstan', 'KG', 'KGZ', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(117, 'Lao People''s Democratic Republic', 'LA', 'LAO', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(118, 'Latvia', 'LV', 'LVA', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(119, 'Lebanon', 'LB', 'LBN', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(120, 'Lesotho', 'LS', 'LSO', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(121, 'Liberia', 'LR', 'LBR', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(122, 'Libyan Arab Jamahiriya', 'LY', 'LBY', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(123, 'Liechtenstein', 'LI', 'LIE', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(124, 'Lithuania', 'LT', 'LTU', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(125, 'Luxembourg', 'LU', 'LUX', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(126, 'Macau', 'MO', 'MAC', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(127, 'Macedonia, The Former Yugoslav Republic of', 'MK', 'MKD', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(128, 'Madagascar', 'MG', 'MDG', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(129, 'Malawi', 'MW', 'MWI', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(130, 'Malaysia', 'MY', 'MYS', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(131, 'Maldives', 'MV', 'MDV', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(132, 'Mali', 'ML', 'MLI', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(133, 'Malta', 'MT', 'MLT', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(134, 'Marshall Islands', 'MH', 'MHL', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(135, 'Martinique', 'MQ', 'MTQ', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(136, 'Mauritania', 'MR', 'MRT', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(137, 'Mauritius', 'MU', 'MUS', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(138, 'Mayotte', 'YT', 'MYT', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(139, 'Mexico', 'MX', 'MEX', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(140, 'Micronesia, Federated States of', 'FM', 'FSM', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(141, 'Moldova, Republic of', 'MD', 'MDA', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(142, 'Monaco', 'MC', 'MCO', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(143, 'Mongolia', 'MN', 'MNG', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(144, 'Montserrat', 'MS', 'MSR', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(145, 'Morocco', 'MA', 'MAR', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(146, 'Mozambique', 'MZ', 'MOZ', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(147, 'Myanmar', 'MM', 'MMR', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(148, 'Namibia', 'NA', 'NAM', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(149, 'Nauru', 'NR', 'NRU', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(150, 'Nepal', 'NP', 'NPL', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(151, 'Netherlands', 'NL', 'NLD', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(152, 'Netherlands Antilles', 'AN', 'ANT', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(153, 'New Caledonia', 'NC', 'NCL', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(154, 'New Zealand', 'NZ', 'NZL', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(155, 'Nicaragua', 'NI', 'NIC', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(156, 'Niger', 'NE', 'NER', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(157, 'Nigeria', 'NG', 'NGA', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(158, 'Niue', 'NU', 'NIU', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(159, 'Norfolk Island', 'NF', 'NFK', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(160, 'Northern Mariana Islands', 'MP', 'MNP', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(161, 'Norway', 'NO', 'NOR', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(162, 'Oman', 'OM', 'OMN', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(163, 'Pakistan', 'PK', 'PAK', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(164, 'Palau', 'PW', 'PLW', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(165, 'Panama', 'PA', 'PAN', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(166, 'Papua New Guinea', 'PG', 'PNG', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(167, 'Paraguay', 'PY', 'PRY', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(168, 'Peru', 'PE', 'PER', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(169, 'Philippines', 'PH', 'PHL', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(170, 'Pitcairn', 'PN', 'PCN', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(171, 'Poland', 'PL', 'POL', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(172, 'Portugal', 'PT', 'PRT', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(173, 'Puerto Rico', 'PR', 'PRI', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(174, 'Qatar', 'QA', 'QAT', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(175, 'Reunion', 'RE', 'REU', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(176, 'Romania', 'RO', 'ROM', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(177, 'Russian Federation', 'RU', 'RUS', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(178, 'Rwanda', 'RW', 'RWA', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(179, 'Saint Kitts and Nevis', 'KN', 'KNA', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(180, 'Saint Lucia', 'LC', 'LCA', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(181, 'Saint Vincent and the Grenadines', 'VC', 'VCT', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(182, 'Samoa', 'WS', 'WSM', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(183, 'San Marino', 'SM', 'SMR', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(184, 'Sao Tome and Principe', 'ST', 'STP', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(185, 'Saudi Arabia', 'SA', 'SAU', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(186, 'Senegal', 'SN', 'SEN', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(187, 'Seychelles', 'SC', 'SYC', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(188, 'Sierra Leone', 'SL', 'SLE', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(189, 'Singapore', 'SG', 'SGP', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(190, 'Slovakia (Slovak Republic)', 'SK', 'SVK', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(191, 'Slovenia', 'SI', 'SVN', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(192, 'Solomon Islands', 'SB', 'SLB', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(193, 'Somalia', 'SO', 'SOM', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(194, 'South Africa', 'ZA', 'ZAF', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(195, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(196, 'Spain', 'ES', 'ESP', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(197, 'Sri Lanka', 'LK', 'LKA', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(198, 'St. Helena', 'SH', 'SHN', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(199, 'St. Pierre and Miquelon', 'PM', 'SPM', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(200, 'Sudan', 'SD', 'SDN', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(201, 'Suriname', 'SR', 'SUR', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(202, 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(203, 'Swaziland', 'SZ', 'SWZ', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(204, 'Sweden', 'SE', 'SWE', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(205, 'Switzerland', 'CH', 'CHE', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(206, 'Syrian Arab Republic', 'SY', 'SYR', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(207, 'Taiwan', 'TW', 'TWN', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(208, 'Tajikistan', 'TJ', 'TJK', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(209, 'Tanzania, United Republic of', 'TZ', 'TZA', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(210, 'Thailand', 'TH', 'THA', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(211, 'Togo', 'TG', 'TGO', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(212, 'Tokelau', 'TK', 'TKL', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(213, 'Tonga', 'TO', 'TON', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(214, 'Trinidad and Tobago', 'TT', 'TTO', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(215, 'Tunisia', 'TN', 'TUN', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(216, 'Turkey', 'TR', 'TUR', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(217, 'Turkmenistan', 'TM', 'TKM', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(218, 'Turks and Caicos Islands', 'TC', 'TCA', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(219, 'Tuvalu', 'TV', 'TUV', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(220, 'Uganda', 'UG', 'UGA', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(221, 'Ukraine', 'UA', 'UKR', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(222, 'United Arab Emirates', 'AE', 'ARE', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(223, 'United Kingdom', 'GB', 'GBR', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(224, 'United States', 'US', 'USA', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(225, 'United States Minor Outlying Islands', 'UM', 'UMI', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(226, 'Uruguay', 'UY', 'URY', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(227, 'Uzbekistan', 'UZ', 'UZB', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(228, 'Vanuatu', 'VU', 'VUT', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(229, 'Vatican City State (Holy See)', 'VA', 'VAT', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(230, 'Venezuela', 'VE', 'VEN', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(231, 'Viet Nam', 'VN', 'VNM', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(232, 'Virgin Islands (British)', 'VG', 'VGB', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(233, 'Virgin Islands (U.S.)', 'VI', 'VIR', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(234, 'Wallis and Futuna Islands', 'WF', 'WLF', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(235, 'Western Sahara', 'EH', 'ESH', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(236, 'Yemen', 'YE', 'YEM', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(237, 'Serbia', 'RS', 'SRB', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(238, 'The Democratic Republic of Congo', 'DC', 'DRC', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(239, 'Zambia', 'ZM', 'ZMB', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(240, 'Zimbabwe', 'ZW', 'ZWE', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(241, 'East Timor', 'XE', 'XET', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(242, 'Jersey', 'XJ', 'XJE', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(243, 'St. Barthelemy', 'XB', 'XSB', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(244, 'St. Eustatius', 'XU', 'XSE', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(245, 'Canary Islands', 'XC', 'XCA', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(246, 'Montenegro', 'ME', 'MNE', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');


--
-- Dumping data for table `#__sr_geo_states`
--
INSERT INTO `#__sr_geo_states` (`id`, `country_id`, `name`, `code_2`, `code_3`, `state`) VALUES
(2, 224, 'Alabama', 'AL', 'ALA', 1),
(3, 224, 'Alaska', 'AK', 'ALK', 1),
(4, 224, 'Arizona', 'AZ', 'ARZ', 1),
(5, 224, 'Arkansas', 'AR', 'ARK', 1),
(6, 224, 'California', 'CA', 'CAL', 1),
(7, 224, 'Colorado', 'CO', 'COL', 1),
(8, 224, 'Connecticut', 'CT', 'CCT', 1),
(9, 224, 'Delaware', 'DE', 'DEL', 1),
(10, 224, 'District Of Columbia', 'DC', 'DOC', 1),
(11, 224, 'Florida', 'FL', 'FLO', 1),
(12, 224, 'Georgia', 'GA', 'GEA', 1),
(13, 224, 'Hawaii', 'HI', 'HWI', 1),
(14, 224, 'Idaho', 'ID', 'IDA', 1),
(15, 224, 'Illinois', 'IL', 'ILL', 1),
(16, 224, 'Indiana', 'IN', 'IND', 1),
(17, 224, 'Iowa', 'IA', 'IOA', 1),
(18, 224, 'Kansas', 'KS', 'KAS', 1),
(19, 224, 'Kentucky', 'KY', 'KTY', 1),
(20, 224, 'Louisiana', 'LA', 'LOA', 1),
(21, 224, 'Maine', 'ME', 'MAI', 1),
(22, 224, 'Maryland', 'MD', 'MLD', 1),
(23, 224, 'Massachusetts', 'MA', 'MSA', 1),
(24, 224, 'Michigan', 'MI', 'MIC', 1),
(25, 224, 'Minnesota', 'MN', 'MIN', 1),
(26, 224, 'Mississippi', 'MS', 'MIS', 1),
(27, 224, 'Missouri', 'MO', 'MIO', 1),
(28, 224, 'Montana', 'MT', 'MOT', 1),
(29, 224, 'Nebraska', 'NE', 'NEB', 1),
(30, 224, 'Nevada', 'NV', 'NEV', 1),
(31, 224, 'New Hampshire', 'NH', 'NEH', 1),
(32, 224, 'New Jersey', 'NJ', 'NEJ', 1),
(33, 224, 'New Mexico', 'NM', 'NEM', 1),
(34, 224, 'New York', 'NY', 'NEY', 1),
(35, 224, 'North Carolina', 'NC', 'NOC', 1),
(36, 224, 'North Dakota', 'ND', 'NOD', 1),
(37, 224, 'Ohio', 'OH', 'OHI', 1),
(38, 224, 'Oklahoma', 'OK', 'OKL', 1),
(39, 224, 'Oregon', 'OR', 'ORN', 1),
(40, 224, 'Pennsylvania', 'PA', 'PEA', 1),
(41, 224, 'Rhode Island', 'RI', 'RHI', 1),
(42, 224, 'South Carolina', 'SC', 'SOC', 1),
(43, 224, 'South Dakota', 'SD', 'SOD', 1),
(44, 224, 'Tennessee', 'TN', 'TEN', 1),
(45, 224, 'Texas', 'TX', 'TXS', 1),
(46, 224, 'Utah', 'UT', 'UTA', 1),
(47, 224, 'Vermont', 'VT', 'VMT', 1),
(48, 224, 'Virginia', 'VA', 'VIA', 1),
(49, 224, 'Washington', 'WA', 'WAS', 1),
(50, 224, 'West Virginia', 'WV', 'WEV', 1),
(51, 224, 'Wisconsin', 'WI', 'WIS', 1),
(52, 224, 'Wyoming', 'WY', 'WYO', 1),
(53, 39, 'Alberta', 'AB', 'ALB', 1),
(54, 39, 'British Columbia', 'BC', 'BRC', 1),
(55, 39, 'Manitoba', 'MB', 'MAB', 1),
(56, 39, 'New Brunswick', 'NB', 'NEB', 1),
(57, 39, 'Newfoundland and Labrador', 'NL', 'NFL', 1),
(58, 39, 'Northwest Territories', 'NT', 'NWT', 1),
(59, 39, 'Nova Scotia', 'NS', 'NOS', 1),
(60, 39, 'Nunavut', 'NU', 'NUT', 1),
(61, 39, 'Ontario', 'ON', 'ONT', 1),
(62, 39, 'Prince Edward Island', 'PE', 'PEI', 1),
(63, 39, 'Quebec', 'QC', 'QEC', 1),
(64, 39, 'Saskatchewan', 'SK', 'SAK', 1),
(65, 39, 'Yukon', 'YT', 'YUT', 1),
(66, 223, 'England', 'EN', 'ENG', 1),
(67, 223, 'Northern Ireland', 'NI', 'NOI', 1),
(68, 223, 'Scotland', 'SD', 'SCO', 1),
(69, 223, 'Wales', 'WS', 'WLS', 1),
(70, 14, 'Australian Capital Territory', 'AC', 'ACT', 1),
(71, 14, 'New South Wales', 'NS', 'NSW', 1),
(72, 14, 'Northern Territory', 'NT', 'NOT', 1),
(73, 14, 'Queensland', 'QL', 'QLD', 1),
(74, 14, 'South Australia', 'SA', 'SOA', 1),
(75, 14, 'Tasmania', 'TS', 'TAS', 1),
(76, 14, 'Victoria', 'VI', 'VIC', 1),
(77, 14, 'Western Australia', 'WA', 'WEA', 1),
(78, 139, 'Aguascalientes', 'AG', 'AGS', 1),
(79, 139, 'Baja California Norte', 'BN', 'BCN', 1),
(80, 139, 'Baja California Sur', 'BS', 'BCS', 1),
(81, 139, 'Campeche', 'CA', 'CAM', 1),
(82, 139, 'Chiapas', 'CS', 'CHI', 1),
(83, 139, 'Chihuahua', 'CH', 'CHA', 1),
(84, 139, 'Coahuila', 'CO', 'COA', 1),
(85, 139, 'Colima', 'CM', 'COL', 1),
(86, 139, 'Distrito Federal', 'DF', 'DFM', 1),
(87, 139, 'Durango', 'DO', 'DGO', 1),
(88, 139, 'Guanajuato', 'GO', 'GTO', 1),
(89, 139, 'Guerrero', 'GU', 'GRO', 1),
(90, 139, 'Hidalgo', 'HI', 'HGO', 1),
(91, 139, 'Jalisco', 'JA', 'JAL', 1),
(92, 139, 'M?xico (Estado de)', 'EM', 'EDM', 1),
(93, 139, 'Michoac?n', 'MI', 'MCN', 1),
(94, 139, 'Morelos', 'MO', 'MOR', 1),
(95, 139, 'Nayarit', 'NY', 'NAY', 1),
(96, 139, 'Nuevo Le?n', 'NL', 'NUL', 1),
(97, 139, 'Oaxaca', 'OA', 'OAX', 1),
(98, 139, 'Puebla', 'PU', 'PUE', 1),
(99, 139, 'Quer?taro', 'QU', 'QRO', 1),
(100, 139, 'Quintana Roo', 'QR', 'QUR', 1),
(101, 139, 'San Luis Potos?', 'SP', 'SLP', 1),
(102, 139, 'Sinaloa', 'SI', 'SIN', 1),
(103, 139, 'Sonora', 'SO', 'SON', 1),
(104, 139, 'Tabasco', 'TA', 'TAB', 1),
(105, 139, 'Tamaulipas', 'TM', 'TAM', 1),
(106, 139, 'Tlaxcala', 'TX', 'TLX', 1),
(107, 139, 'Veracruz', 'VZ', 'VER', 1),
(108, 139, 'Yucat?n', 'YU', 'YUC', 1),
(109, 139, 'Zacatecas', 'ZA', 'ZAC', 1),
(110, 31, 'Acre', 'AC', 'ACR', 1),
(111, 31, 'Alagoas', 'AL', 'ALG', 1),
(112, 31, 'Amap?', 'AP', 'AMP', 1),
(113, 31, 'Amazonas', 'AM', 'AMZ', 1),
(114, 31, 'Bah?a', 'BA', 'BAH', 1),
(115, 31, 'Cear?', 'CE', 'CEA', 1),
(116, 31, 'Distrito Federal', 'DF', 'DFB', 1),
(117, 31, 'Espirito Santo', 'ES', 'ESS', 1),
(118, 31, 'Goi?s', 'GO', 'GOI', 1),
(119, 31, 'Maranh?o', 'MA', 'MAR', 1),
(120, 31, 'Mato Grosso', 'MT', 'MAT', 1),
(121, 31, 'Mato Grosso do Sul', 'MS', 'MGS', 1),
(122, 31, 'Minas Gera?s', 'MG', 'MIG', 1),
(123, 31, 'Paran?', 'PR', 'PAR', 1),
(124, 31, 'Para?ba', 'PB', 'PRB', 1),
(125, 31, 'Par?', 'PA', 'PAB', 1),
(126, 31, 'Pernambuco', 'PE', 'PER', 1),
(127, 31, 'Piau?', 'PI', 'PIA', 1),
(128, 31, 'Rio Grande do Norte', 'RN', 'RGN', 1),
(129, 31, 'Rio Grande do Sul', 'RS', 'RGS', 1),
(130, 31, 'Rio de Janeiro', 'RJ', 'RDJ', 1),
(131, 31, 'Rond?nia', 'RO', 'RON', 1),
(132, 31, 'Roraima', 'RR', 'ROR', 1),
(133, 31, 'Santa Catarina', 'SC', 'SAC', 1),
(134, 31, 'Sergipe', 'SE', 'SER', 1),
(135, 31, 'S?o Paulo', 'SP', 'SAP', 1),
(136, 31, 'Tocantins', 'TO', 'TOC', 1),
(137, 45, 'Anhui', '34', 'ANH', 1),
(138, 45, 'Beijing', '11', 'BEI', 1),
(139, 45, 'Chongqing', '50', 'CHO', 1),
(140, 45, 'Fujian', '35', 'FUJ', 1),
(141, 45, 'Gansu', '62', 'GAN', 1),
(142, 45, 'Guangdong', '44', 'GUA', 1),
(143, 45, 'Guangxi Zhuang', '45', 'GUZ', 1),
(144, 45, 'Guizhou', '52', 'GUI', 1),
(145, 45, 'Hainan', '46', 'HAI', 1),
(146, 45, 'Hebei', '13', 'HEB', 1),
(147, 45, 'Heilongjiang', '23', 'HEI', 1),
(148, 45, 'Henan', '41', 'HEN', 1),
(149, 45, 'Hubei', '42', 'HUB', 1),
(150, 45, 'Hunan', '43', 'HUN', 1),
(151, 45, 'Jiangsu', '32', 'JIA', 1),
(152, 45, 'Jiangxi', '36', 'JIX', 1),
(153, 45, 'Jilin', '22', 'JIL', 1),
(154, 45, 'Liaoning', '21', 'LIA', 1),
(155, 45, 'Nei Mongol', '15', 'NML', 1),
(156, 45, 'Ningxia Hui', '64', 'NIH', 1),
(157, 45, 'Qinghai', '63', 'QIN', 1),
(158, 45, 'Shandong', '37', 'SNG', 1),
(159, 45, 'Shanghai', '31', 'SHH', 1),
(160, 45, 'Shaanxi', '61', 'SHX', 1),
(161, 45, 'Sichuan', '51', 'SIC', 1),
(162, 45, 'Tianjin', '12', 'TIA', 1),
(163, 45, 'Xinjiang Uygur', '65', 'XIU', 1),
(164, 45, 'Xizang', '54', 'XIZ', 1),
(165, 45, 'Yunnan', '53', 'YUN', 1),
(166, 45, 'Zhejiang', '33', 'ZHE', 1),
(167, 105, 'Israel', 'IL', 'ISL', 1),
(168, 105, 'Gaza Strip', 'GZ', 'GZS', 1),
(169, 105, 'West Bank', 'WB', 'WBK', 1),
(170, 152, 'St. Maarten', 'SM', 'STM', 1),
(171, 152, 'Bonaire', 'BN', 'BNR', 1),
(172, 152, 'Curacao', 'CR', 'CUR', 1),
(173, 176, 'Alba', 'AB', 'ABA', 1),
(174, 176, 'Arad', 'AR', 'ARD', 1),
(175, 176, 'Arges', 'AG', 'ARG', 1),
(176, 176, 'Bacau', 'BC', 'BAC', 1),
(177, 176, 'Bihor', 'BH', 'BIH', 1),
(178, 176, 'Bistrita-Nasaud', 'BN', 'BIS', 1),
(179, 176, 'Botosani', 'BT', 'BOT', 1),
(180, 176, 'Braila', 'BR', 'BRL', 1),
(181, 176, 'Brasov', 'BV', 'BRA', 1),
(182, 176, 'Bucuresti', 'B', 'BUC', 1),
(183, 176, 'Buzau', 'BZ', 'BUZ', 1),
(184, 176, 'Calarasi', 'CL', 'CAL', 1),
(185, 176, 'Caras Severin', 'CS', 'CRS', 1),
(186, 176, 'Cluj', 'CJ', 'CLJ', 1),
(187, 176, 'Constanta', 'CT', 'CST', 1),
(188, 176, 'Covasna', 'CV', 'COV', 1),
(189, 176, 'Dambovita', 'DB', 'DAM', 1),
(190, 176, 'Dolj', 'DJ', 'DLJ', 1),
(191, 176, 'Galati', 'GL', 'GAL', 1),
(192, 176, 'Giurgiu', 'GR', 'GIU', 1),
(193, 176, 'Gorj', 'GJ', 'GOR', 1),
(194, 176, 'Hargita', 'HR', 'HRG', 1),
(195, 176, 'Hunedoara', 'HD', 'HUN', 1),
(196, 176, 'Ialomita', 'IL', 'IAL', 1),
(197, 176, 'Iasi', 'IS', 'IAS', 1),
(198, 176, 'Ilfov', 'IF', 'ILF', 1),
(199, 176, 'Maramures', 'MM', 'MAR', 1),
(200, 176, 'Mehedinti', 'MH', 'MEH', 1),
(201, 176, 'Mures', 'MS', 'MUR', 1),
(202, 176, 'Neamt', 'NT', 'NEM', 1),
(203, 176, 'Olt', 'OT', 'OLT', 1),
(204, 176, 'Prahova', 'PH', 'PRA', 1),
(205, 176, 'Salaj', 'SJ', 'SAL', 1),
(206, 176, 'Satu Mare', 'SM', 'SAT', 1),
(207, 176, 'Sibiu', 'SB', 'SIB', 1),
(208, 176, 'Suceava', 'SV', 'SUC', 1),
(209, 176, 'Teleorman', 'TR', 'TEL', 1),
(210, 176, 'Timis', 'TM', 'TIM', 1),
(211, 176, 'Tulcea', 'TL', 'TUL', 1),
(212, 176, 'Valcea', 'VL', 'VAL', 1),
(213, 176, 'Vaslui', 'VS', 'VAS', 1),
(214, 176, 'Vrancea', 'VN', 'VRA', 1),
(215, 106, 'Agrigento', 'AG', 'AGR', 1),
(216, 106, 'Alessandria', 'AL', 'ALE', 1),
(217, 106, 'Ancona', 'AN', 'ANC', 1),
(218, 106, 'Aosta', 'AO', 'AOS', 1),
(219, 106, 'Arezzo', 'AR', 'ARE', 1),
(220, 106, 'Ascoli Piceno', 'AP', 'API', 1),
(221, 106, 'Asti', 'AT', 'AST', 1),
(222, 106, 'Avellino', 'AV', 'AVE', 1),
(223, 106, 'Bari', 'BA', 'BAR', 1),
(224, 106, 'Belluno', 'BL', 'BEL', 1),
(225, 106, 'Benevento', 'BN', 'BEN', 1),
(226, 106, 'Bergamo', 'BG', 'BEG', 1),
(227, 106, 'Biella', 'BI', 'BIE', 1),
(228, 106, 'Bologna', 'BO', 'BOL', 1),
(229, 106, 'Bolzano', 'BZ', 'BOZ', 1),
(230, 106, 'Brescia', 'BS', 'BRE', 1),
(231, 106, 'Brindisi', 'BR', 'BRI', 1),
(232, 106, 'Cagliari', 'CA', 'CAG', 1),
(233, 106, 'Caltanissetta', 'CL', 'CAL', 1),
(234, 106, 'Campobasso', 'CB', 'CBO', 1),
(235, 106, 'Carbonia-Iglesias', 'CI', 'CAR', 1),
(236, 106, 'Caserta', 'CE', 'CAS', 1),
(237, 106, 'Catania', 'CT', 'CAT', 1),
(238, 106, 'Catanzaro', 'CZ', 'CTZ', 1),
(239, 106, 'Chieti', 'CH', 'CHI', 1),
(240, 106, 'Como', 'CO', 'COM', 1),
(241, 106, 'Cosenza', 'CS', 'COS', 1),
(242, 106, 'Cremona', 'CR', 'CRE', 1),
(243, 106, 'Crotone', 'KR', 'CRO', 1),
(244, 106, 'Cuneo', 'CN', 'CUN', 1),
(245, 106, 'Enna', 'EN', 'ENN', 1),
(246, 106, 'Ferrara', 'FE', 'FER', 1),
(247, 106, 'Firenze', 'FI', 'FIR', 1),
(248, 106, 'Foggia', 'FG', 'FOG', 1),
(249, 106, 'Forli-Cesena', 'FC', 'FOC', 1),
(250, 106, 'Frosinone', 'FR', 'FRO', 1),
(251, 106, 'Genova', 'GE', 'GEN', 1),
(252, 106, 'Gorizia', 'GO', 'GOR', 1),
(253, 106, 'Grosseto', 'GR', 'GRO', 1),
(254, 106, 'Imperia', 'IM', 'IMP', 1),
(255, 106, 'Isernia', 'IS', 'ISE', 1),
(256, 106, 'L''Aquila', 'AQ', 'AQU', 1),
(257, 106, 'La Spezia', 'SP', 'LAS', 1),
(258, 106, 'Latina', 'LT', 'LAT', 1),
(259, 106, 'Lecce', 'LE', 'LEC', 1),
(260, 106, 'Lecco', 'LC', 'LCC', 1),
(261, 106, 'Livorno', 'LI', 'LIV', 1),
(262, 106, 'Lodi', 'LO', 'LOD', 1),
(263, 106, 'Lucca', 'LU', 'LUC', 1),
(264, 106, 'Macerata', 'MC', 'MAC', 1),
(265, 106, 'Mantova', 'MN', 'MAN', 1),
(266, 106, 'Massa-Carrara', 'MS', 'MAS', 1),
(267, 106, 'Matera', 'MT', 'MAA', 1),
(268, 106, 'Medio Campidano', 'VS', 'MED', 1),
(269, 106, 'Messina', 'ME', 'MES', 1),
(270, 106, 'Milano', 'MI', 'MIL', 1),
(271, 106, 'Modena', 'MO', 'MOD', 1),
(272, 106, 'Napoli', 'NA', 'NAP', 1),
(273, 106, 'Novara', 'NO', 'NOV', 1),
(274, 106, 'Nuoro', 'NU', 'NUR', 1),
(275, 106, 'Ogliastra', 'OG', 'OGL', 1),
(276, 106, 'Olbia-Tempio', 'OT', 'OLB', 1),
(277, 106, 'Oristano', 'OR', 'ORI', 1),
(278, 106, 'Padova', 'PD', 'PDA', 1),
(279, 106, 'Palermo', 'PA', 'PAL', 1),
(280, 106, 'Parma', 'PR', 'PAA', 1),
(281, 106, 'Pavia', 'PV', 'PAV', 1),
(282, 106, 'Perugia', 'PG', 'PER', 1),
(283, 106, 'Pesaro e Urbino', 'PU', 'PES', 1),
(284, 106, 'Pescara', 'PE', 'PSC', 1),
(285, 106, 'Piacenza', 'PC', 'PIA', 1),
(286, 106, 'Pisa', 'PI', 'PIS', 1),
(287, 106, 'Pistoia', 'PT', 'PIT', 1),
(288, 106, 'Pordenone', 'PN', 'POR', 1),
(289, 106, 'Potenza', 'PZ', 'PTZ', 1),
(290, 106, 'Prato', 'PO', 'PRA', 1),
(291, 106, 'Ragusa', 'RG', 'RAG', 1),
(292, 106, 'Ravenna', 'RA', 'RAV', 1),
(293, 106, 'Reggio Calabria', 'RC', 'REG', 1),
(294, 106, 'Reggio Emilia', 'RE', 'REE', 1),
(295, 106, 'Rieti', 'RI', 'RIE', 1),
(296, 106, 'Rimini', 'RN', 'RIM', 1),
(297, 106, 'Roma', 'RM', 'ROM', 1),
(298, 106, 'Rovigo', 'RO', 'ROV', 1),
(299, 106, 'Salerno', 'SA', 'SAL', 1),
(300, 106, 'Sassari', 'SS', 'SAS', 1),
(301, 106, 'Savona', 'SV', 'SAV', 1),
(302, 106, 'Siena', 'SI', 'SIE', 1),
(303, 106, 'Siracusa', 'SR', 'SIR', 1),
(304, 106, 'Sondrio', 'SO', 'SOO', 1),
(305, 106, 'Taranto', 'TA', 'TAR', 1),
(306, 106, 'Teramo', 'TE', 'TER', 1),
(307, 106, 'Terni', 'TR', 'TRN', 1),
(308, 106, 'Torino', 'TO', 'TOR', 1),
(309, 106, 'Trapani', 'TP', 'TRA', 1),
(310, 106, 'Trento', 'TN', 'TRE', 1),
(311, 106, 'Treviso', 'TV', 'TRV', 1),
(312, 106, 'Trieste', 'TS', 'TRI', 1),
(313, 106, 'Udine', 'UD', 'UDI', 1),
(314, 106, 'Varese', 'VA', 'VAR', 1),
(315, 106, 'Venezia', 'VE', 'VEN', 1),
(316, 106, 'Verbano Cusio Ossola', 'VB', 'VCO', 1),
(317, 106, 'Vercelli', 'VC', 'VER', 1),
(318, 106, 'Verona', 'VR', 'VRN', 1),
(319, 106, 'Vibo Valenzia', 'VV', 'VIV', 1),
(320, 106, 'Vicenza', 'VI', 'VII', 1),
(321, 106, 'Viterbo', 'VT', 'VIT', 1),
(322, 196, 'A Coru?a', '15', 'ACO', 1),
(323, 196, 'Alava', '01', 'ALA', 1),
(324, 196, 'Albacete', '02', 'ALB', 1),
(325, 196, 'Alicante', '03', 'ALI', 1),
(326, 196, 'Almeria', '04', 'ALM', 1),
(327, 196, 'Asturias', '33', 'AST', 1),
(328, 196, 'Avila', '05', 'AVI', 1),
(329, 196, 'Badajoz', '06', 'BAD', 1),
(330, 196, 'Baleares', '07', 'BAL', 1),
(331, 196, 'Barcelona', '08', 'BAR', 1),
(332, 196, 'Burgos', '09', 'BUR', 1),
(333, 196, 'Caceres', '10', 'CAC', 1),
(334, 196, 'Cadiz', '11', 'CAD', 1),
(335, 196, 'Cantabria', '39', 'CAN', 1),
(336, 196, 'Castellon', '12', 'CAS', 1),
(337, 196, 'Ceuta', '51', 'CEU', 1),
(338, 196, 'Ciudad Real', '13', 'CIU', 1),
(339, 196, 'Cordoba', '14', 'COR', 1),
(340, 196, 'Cuenca', '16', 'CUE', 1),
(341, 196, 'Girona', '17', 'GIR', 1),
(342, 196, 'Granada', '18', 'GRA', 1),
(343, 196, 'Guadalajara', '19', 'GUA', 1),
(344, 196, 'Guipuzcoa', '20', 'GUI', 1),
(345, 196, 'Huelva', '21', 'HUL', 1),
(346, 196, 'Huesca', '22', 'HUS', 1),
(347, 196, 'Jaen', '23', 'JAE', 1),
(348, 196, 'La Rioja', '26', 'LRI', 1),
(349, 196, 'Las Palmas', '35', 'LPA', 1),
(350, 196, 'Leon', '24', 'LEO', 1),
(351, 196, 'Lleida', '25', 'LLE', 1),
(352, 196, 'Lugo', '27', 'LUG', 1),
(353, 196, 'Madrid', '28', 'MAD', 1),
(354, 196, 'Malaga', '29', 'MAL', 1),
(355, 196, 'Melilla', '52', 'MEL', 1),
(356, 196, 'Murcia', '30', 'MUR', 1),
(357, 196, 'Navarra', '31', 'NAV', 1),
(358, 196, 'Ourense', '32', 'OUR', 1),
(359, 196, 'Palencia', '34', 'PAL', 1),
(360, 196, 'Pontevedra', '36', 'PON', 1),
(361, 196, 'Salamanca', '37', 'SAL', 1),
(362, 196, 'Santa Cruz de Tenerife', '38', 'SCT', 1),
(363, 196, 'Segovia', '40', 'SEG', 1),
(364, 196, 'Sevilla', '41', 'SEV', 1),
(365, 196, 'Soria', '42', 'SOR', 1),
(366, 196, 'Tarragona', '43', 'TAR', 1),
(367, 196, 'Teruel', '44', 'TER', 1),
(368, 196, 'Toledo', '45', 'TOL', 1),
(369, 196, 'Valencia', '46', 'VAL', 1),
(370, 196, 'Valladolid', '47', 'VLL', 1),
(371, 196, 'Vizcaya', '48', 'VIZ', 1),
(372, 196, 'Zamora', '49', 'ZAM', 1),
(373, 196, 'Zaragoza', '50', 'ZAR', 1),
(374, 12, 'Aragatsotn', 'AG', 'ARG', 1),
(375, 12, 'Ararat', 'AR', 'ARR', 1),
(376, 12, 'Armavir', 'AV', 'ARM', 1),
(377, 12, 'Gegharkunik', 'GR', 'GEG', 1),
(378, 12, 'Kotayk', 'KT', 'KOT', 1),
(379, 12, 'Lori', 'LO', 'LOR', 1),
(380, 12, 'Shirak', 'SH', 'SHI', 1),
(381, 12, 'Syunik', 'SU', 'SYU', 1),
(382, 12, 'Tavush', 'TV', 'TAV', 1),
(383, 12, 'Vayots-Dzor', 'VD', 'VAD', 1),
(384, 12, 'Yerevan', 'ER', 'YER', 1),
(385, 100, 'Andaman & Nicobar Islands', 'AI', 'ANI', 1),
(386, 100, 'Andhra Pradesh', 'AN', 'AND', 1),
(387, 100, 'Arunachal Pradesh', 'AR', 'ARU', 1),
(388, 100, 'Assam', 'AS', 'ASS', 1),
(389, 100, 'Bihar', 'BI', 'BIH', 1),
(390, 100, 'Chandigarh', 'CA', 'CHA', 1),
(391, 100, 'Chhatisgarh', 'CH', 'CHH', 1),
(392, 100, 'Dadra & Nagar Haveli', 'DD', 'DAD', 1),
(393, 100, 'Daman & Diu', 'DA', 'DAM', 1),
(394, 100, 'Delhi', 'DE', 'DEL', 1),
(395, 100, 'Goa', 'GO', 'GOA', 1),
(396, 100, 'Gujarat', 'GU', 'GUJ', 1),
(397, 100, 'Haryana', 'HA', 'HAR', 1),
(398, 100, 'Himachal Pradesh', 'HI', 'HIM', 1),
(399, 100, 'Jammu & Kashmir', 'JA', 'JAM', 1),
(400, 100, 'Jharkhand', 'JH', 'JHA', 1),
(401, 100, 'Karnataka', 'KA', 'KAR', 1),
(402, 100, 'Kerala', 'KE', 'KER', 1),
(403, 100, 'Lakshadweep', 'LA', 'LAK', 1),
(404, 100, 'Madhya Pradesh', 'MD', 'MAD', 1),
(405, 100, 'Maharashtra', 'MH', 'MAH', 1),
(406, 100, 'Manipur', 'MN', 'MAN', 1),
(407, 100, 'Meghalaya', 'ME', 'MEG', 1),
(408, 100, 'Mizoram', 'MI', 'MIZ', 1),
(409, 100, 'Nagaland', 'NA', 'NAG', 1),
(410, 100, 'Orissa', 'OR', 'ORI', 1),
(411, 100, 'Pondicherry', 'PO', 'PON', 1),
(412, 100, 'Punjab', 'PU', 'PUN', 1),
(413, 100, 'Rajasthan', 'RA', 'RAJ', 1),
(414, 100, 'Sikkim', 'SI', 'SIK', 1),
(415, 100, 'Tamil Nadu', 'TA', 'TAM', 1),
(416, 100, 'Tripura', 'TR', 'TRI', 1),
(417, 100, 'Uttaranchal', 'UA', 'UAR', 1),
(418, 100, 'Uttar Pradesh', 'UT', 'UTT', 1),
(419, 100, 'West Bengal', 'WE', 'WES', 1),
(420, 102, 'Ahmadi va Kohkiluyeh', 'BO', 'BOK', 1),
(421, 102, 'Ardabil', 'AR', 'ARD', 1),
(422, 102, 'Azarbayjan-e Gharbi', 'AG', 'AZG', 1),
(423, 102, 'Azarbayjan-e Sharqi', 'AS', 'AZS', 1),
(424, 102, 'Bushehr', 'BU', 'BUS', 1),
(425, 102, 'Chaharmahal va Bakhtiari', 'CM', 'CMB', 1),
(426, 102, 'Esfahan', 'ES', 'ESF', 1),
(427, 102, 'Fars', 'FA', 'FAR', 1),
(428, 102, 'Gilan', 'GI', 'GIL', 1),
(429, 102, 'Gorgan', 'GO', 'GOR', 1),
(430, 102, 'Hamadan', 'HA', 'HAM', 1),
(431, 102, 'Hormozgan', 'HO', 'HOR', 1),
(432, 102, 'Ilam', 'IL', 'ILA', 1),
(433, 102, 'Kerman', 'KE', 'KER', 1),
(434, 102, 'Kermanshah', 'BA', 'BAK', 1),
(435, 102, 'Khorasan-e Junoubi', 'KJ', 'KHJ', 1),
(436, 102, 'Khorasan-e Razavi', 'KR', 'KHR', 1),
(437, 102, 'Khorasan-e Shomali', 'KS', 'KHS', 1),
(438, 102, 'Khuzestan', 'KH', 'KHU', 1),
(439, 102, 'Kordestan', 'KO', 'KOR', 1),
(440, 102, 'Lorestan', 'LO', 'LOR', 1),
(441, 102, 'Markazi', 'MR', 'MAR', 1),
(442, 102, 'Mazandaran', 'MZ', 'MAZ', 1),
(443, 102, 'Qazvin', 'QA', 'QAS', 1),
(444, 102, 'Qom', 'QO', 'QOM', 1),
(445, 102, 'Semnan', 'SE', 'SEM', 1),
(446, 102, 'Sistan va Baluchestan', 'SB', 'SBA', 1),
(447, 102, 'Tehran', 'TE', 'TEH', 1),
(448, 102, 'Yazd', 'YA', 'YAZ', 1),
(449, 102, 'Zanjan', 'ZA', 'ZAN', 1);