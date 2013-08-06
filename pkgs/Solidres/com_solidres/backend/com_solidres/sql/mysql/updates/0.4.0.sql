ALTER TABLE  `#__sr_media_reservation_assets_xref` ADD  `weight` INT(11) UNSIGNED NOT NULL DEFAULT 0;
ALTER TABLE  `#__sr_media_roomtype_xref` ADD  `weight` INT(11) UNSIGNED NOT NULL DEFAULT 0;
ALTER TABLE  `#__sr_reservation_asset_fields` CHANGE  `field_value`  `field_value` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;
ALTER TABLE  `#__sr_room_type_fields` CHANGE  `field_value`  `field_value` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;
ALTER TABLE  `#__sr_prices` CHANGE  `customer_group_id`  `customer_group_id` INT( 11 ) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE  `#__sr_customers` CHANGE  `customer_group_id`  `customer_group_id` INT( 11 ) UNSIGNED NULL DEFAULT NULL;