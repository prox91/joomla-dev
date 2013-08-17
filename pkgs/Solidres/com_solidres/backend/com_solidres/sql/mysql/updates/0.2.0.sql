ALTER TABLE  `#__sr_reservation_assets` CHANGE  `category_id`  `category_id` INT( 11 ) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE  `#__sr_reservation_assets` CHANGE  `asset_id`  `asset_id` INT( 11 ) UNSIGNED NULL DEFAULT NULL
ALTER TABLE  `#__sr_reservation_assets` DROP `map`