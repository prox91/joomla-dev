--
-- Empty table #__sr_room_type_fields
--
DELETE  FROM "#__sr_room_type_fields";


--
-- Empty table #__sr_reservation_room_extra_xref
--
DELETE  FROM "#__sr_reservation_room_extra_xref";


--
-- Empty table #__sr_reservation_notes
--
DELETE  FROM "#__sr_reservation_notes";


--
-- Empty table #__sr_room_type_extra_xref
--
DELETE  FROM "#__sr_room_type_extra_xref";


--
-- Empty table #__sr_room_type_coupon_xref
--
DELETE  FROM "#__sr_room_type_coupon_xref";


--
-- Empty table #__sr_taxes
--
DELETE  FROM "#__sr_taxes";


--
-- Empty table #__sr_customer_fields
--
DELETE  FROM "#__sr_customer_fields";


--
-- Empty table #__sr_reservation_asset_fields
--
DELETE  FROM "#__sr_reservation_asset_fields";


--
-- Empty table #__sr_media_roomtype_xref
--
DELETE  FROM "#__sr_media_roomtype_xref";


--
-- Empty table #__sr_media_reservation_assets_xref
--
DELETE  FROM "#__sr_media_reservation_assets_xref";


--
-- Empty table #__sr_reservation_room_xref
--
DELETE  FROM "#__sr_reservation_room_xref";


--
-- Empty table #__sr_rooms
--
DELETE  FROM "#__sr_rooms";


--
-- Empty table #__sr_prices
--
DELETE  FROM "#__sr_prices";


--
-- Empty table #__sr_extras
--
DELETE  FROM "#__sr_extras";


--
-- Empty table #__sr_media
--
DELETE  FROM "#__sr_media";


--
-- Empty table #__sr_reservations
--
DELETE  FROM "#__sr_reservations";


--
-- Empty table #__sr_room_types
--
DELETE  FROM "#__sr_room_types";


--
-- Empty table #__sr_coupons
--
DELETE  FROM "#__sr_coupons";


--
-- Empty table #__sr_config_data
--
DELETE  FROM "#__sr_config_data";


--
-- Empty table #__sr_reservation_assets
--
DELETE  FROM "#__sr_reservation_assets";


--
-- Empty table #__sr_currencies
--
DELETE  FROM "#__sr_currencies";


--
-- Empty table #__sr_categories
--
DELETE  FROM "#__sr_categories";


--
-- Empty table #__sr_customers
--
DELETE  FROM "#__sr_customers";


--
-- Empty table #__sr_customer_groups
--
DELETE  FROM "#__sr_customer_groups";


DELETE FROM "#__users" WHERE id IN (90001, 90002, 90003, 90004, 90005);

DELETE FROM "#__user_usergroup_map" WHERE user_id IN (90001, 90002, 90003, 90004, 90005);