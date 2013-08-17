--
-- Dumping data for table `#__sr_categories`
--
INSERT INTO `#__sr_categories` (`id`, `parent_id`, `asset_id`, `lft`, `rgt`, `title`, `alias`, `description`, `state`, `ordering`, `access`, `checked_out`, `checked_out_time`, `created_by`, `created_date`, `modified_by`, `modified_date`, `params`) VALUES
(1, 1, 212, 0, 19, 'Root', 'Root', '', 1, 0, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 42, '2010-09-22 03:07:03', ''),
(12, 1, 216, 17, 18, 'Apartment', 'apartment', '', 1, 1, 1, 0, '0000-00-00 00:00:00', 42, '2010-09-16 02:49:21', 42, '2010-09-17 07:00:02', ''),
(13, 1, 215, 11, 16, 'Hotel', 'hotel', '', 1, 2, 1, 0, '0000-00-00 00:00:00', 42, '2010-09-16 02:49:40', 42, '2010-09-17 06:59:57', ''),
(14, 1, 214, 9, 10, 'Motel', 'motel', '', 1, 3, 1, 0, '0000-00-00 00:00:00', 42, '2010-09-16 02:49:52', 42, '2010-09-17 06:59:25', ''),
(15, 1, 213, 7, 8, 'Hostel', 'hostel', '', 1, 4, 1, 0, '0000-00-00 00:00:00', 42, '2010-09-16 02:50:05', 42, '2011-05-30 15:37:00', ''),
(16, 1, 250, 5, 6, 'Guest Accommodation', 'guest-accommodation', '', 1, 5, 1, 0, '0000-00-00 00:00:00', 42, '2011-05-30 15:37:51', 0, '0000-00-00 00:00:00', ''),
(17, 1, 249, 3, 4, 'Residence', 'residence', '', 1, 6, 1, 0, '0000-00-00 00:00:00', 42, '2011-05-30 15:38:26', 0, '0000-00-00 00:00:00', ''),
(18, 1, 248, 1, 2, 'Resort', 'resort', '', 1, 7, 1, 0, '0000-00-00 00:00:00', 42, '2011-05-30 15:38:51', 0, '0000-00-00 00:00:00', ''),
(19, 13, 255, 14, 15, 'Mini Hotel', 'mini-hotel', '', 1, 8, 1, 0, '0000-00-00 00:00:00', 118, '2012-07-23 03:35:48', 0, '0000-00-00 00:00:00', ''),
(20, 13, 256, 12, 13, 'Garden hotel', 'garden-hotel', '', 1, 9, 1, 0, '0000-00-00 00:00:00', 116, '2012-07-25 03:41:58', 0, '0000-00-00 00:00:00', '');


--
-- Dumping data for table `#__sr_customer_groups`
--
INSERT INTO `#__sr_customer_groups` (`id`, `name`, `state`) VALUES
(1, 'Regular Customer', 1),
(2, 'Silver Customer', 1),
(3, 'Gold Customer', 1),
(4, 'Premium Customer', 1),
(5, 'Diamond Customer', 1);

INSERT INTO `#__users` (`id`, `name`, `username`, `email`, `password`, `block`, `sendEmail`, `registerDate`, `lastvisitDate`, `activation`, `params`, `lastResetTime`, `resetCount`) VALUES
(90001, 'David  Jones', 'david', 'davidjones@localhost.dev', '404d92dfd6af3f22c5b4cdb04d8ab5fb:yInMUoQr1YR26Yrld2XOp56K4uB9VUqq', 0, 0, '2012-10-08 04:26:46', '0000-00-00 00:00:00', '', '{}', '0000-00-00 00:00:00', 0),
(90002, 'Wilson  Miller', 'wilsonmiller', 'wilsonmiller@localhost.dev', 'b0b76c68bc9a09cf658027780828b330:ErzYI78Xlk4e6NgKPriYCy8UPLaLQcXO', 0, 0, '2012-10-08 04:32:37', '0000-00-00 00:00:00', '', '{}', '0000-00-00 00:00:00', 0),
(90003, 'Kaito  Kazuki', 'kaitokazuki', 'kaitokazuki@localhost.dev', '40fb510d32dc6e7f709240c7f01d5e65:JomakywHd0ynnsxooLlYfsU3AWUTrgtj', 0, 0, '2012-10-08 04:34:58', '0000-00-00 00:00:00', '', '{}', '0000-00-00 00:00:00', 0),
(90004, 'Chan  Jiao', 'chanjiao', 'chanjiao@localhost.dev', '83ab0b5708cc133c1443b11bd23d1e2e:iq5w6mIr5bsiT5akzXCJcDo2tr4rLh7f', 0, 0, '2012-10-08 04:37:18', '0000-00-00 00:00:00', '', '{}', '0000-00-00 00:00:00', 0),
(90005, 'Kenneth  Edward', 'kennethedward', 'kennethedward@localhost.dev', '3d8410b43c0987b452a2ce0c85d55356:1JuSojyPE9AOMBJG4C6SB3UJdyFYOvgf', 0, 0, '2012-10-08 04:38:48', '0000-00-00 00:00:00', '', '{}', '0000-00-00 00:00:00', 0);

INSERT INTO `#__user_usergroup_map` (`user_id`, `group_id`) VALUES
(90001, 2),
(90002, 2),
(90003, 2),
(90004, 2),
(90005, 2);


--
-- Dumping data for table `#__sr_customers`
--
INSERT INTO `#__sr_customers` (`id`, `customer_group_id`, `user_id`, `customer_code`, `firstname`, `middlename`, `lastname`) VALUES
(31, 1, 90001, 'UY4568', 'David', '', 'Jones'),
(32, 2, 90002, 'JH3356', 'Wilson', '', 'Miller'),
(33, 3, 90003, 'AX2244', 'Kaito', '', 'Kazuki'),
(34, 4, 90004, 'OW4523', 'Chan', '', 'Jiao'),
(35, 5, 90005, 'KE9999', 'Kenneth', '', 'Edward');


--
-- Dumping data for table `#__sr_currencies`
--
INSERT INTO `#__sr_currencies` (`id`, `currency_name`, `currency_code`, `state`, `exchange_rate`, `sign`) VALUES
(1, 'US Dollar', 'USD', 1, 1, '$'),
(3, 'Euro', 'EUR', 1, 1.2, '£');


--
-- Dumping data for table `#__sr_reservation_assets`
--
INSERT INTO `#__sr_reservation_assets` (`id`, `asset_id`, `category_id`, `name`, `alias`, `address_1`, `address_2`, `city`, `postcode`, `phone`, `description`, `email`, `website`, `featured`, `fax`, `rating`, `geo_state_id`, `country_id`, `created_date`, `modified_date`, `created_by`, `modified_by`, `state`, `checked_out`, `checked_out_time`, `ordering`, `archived`, `approved`, `access`, `params`, `language`, `hits`, `metakey`, `metadesc`, `metadata`, `xreference`, `partner_id`, `lat`, `lng`, `default`, `deposit_required`, `deposit_is_percentage`, `deposit_amount`, `currency_id`) VALUES
(8, 253, NULL, 'Sunflower', 'sunflower', '1238 Collins Avenue, Miami Beach', '', 'Florida ', '33139', '855-265-1944', '<p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet I feel that I never was a greater artist than now. When, while the lovely</p>', 'info@sunflower.sf', 'http://www.sunflower.sf', 0, '305-531-3406', 5, NULL, 224, '2012-07-21 09:43:41', '2012-10-09 03:19:48', 117, 442, 1, 0, '0000-00-00 00:00:00', 8, 0, 0, 1, '{"termsofuse":"0","privacypolicy":"0","disclaimer":"0"}', '*', 237, '', '', '{"robots":"","author":"","rights":""}', '', NULL, 25.783525, -80.131203, 1, 0, 1, 0, 1);


--
-- Dumping data for table `#__sr_room_types`
--
INSERT INTO `#__sr_room_types` (`id`, `reservation_asset_id`, `name`, `alias`, `description`, `state`, `checked_out`, `checked_out_time`, `created_by`, `created_date`, `modified_by`, `modified_date`, `language`, `params`, `featured`, `ordering`, `occupancy_adult`, `occupancy_child`) VALUES
(15, 8, 'Colonial Superior', 'colonial-superior', '<p>This room measures 377 square feet (35 square meters). Complimentary wired and wireless Internet access keeps you connected, and the television is offered for your entertainment. A minibar and a refrigerator are provided. The private bathroom has a bathtub, as well as slippers, complimentary toiletries, and a hair dryer. Climate control, complimentary bottled water, and a safe are among the included amenities. Non-smoking. Free Wireless Internet. Breakfast Buffet.</p>', 1, 0, '0000-00-00 00:00:00', 117, '2012-07-21 04:28:07', 442, '2012-10-09 03:05:44', '*', '{"termsofuse":"0","privacypolicy":"0","disclaimer":"0","accessible":"0","businesscenter":"1","dining":"1","fitness":"0","golf":"0","meeting":"1","pets":"0","pool":"1","resort":"0","tennis":"0","whirlpool":"0","wireless":"1"}', 0, 10, 2, 0),
(16, 8, 'Colonial River Deluxe', 'colonial-river-deluxe', '<p>Measuring 452-484 square feet (42-45 square meters), this room overlooks the river. Complimentary wired and wireless Internet access keeps you connected, and the television is offered for your entertainment. A minibar and a refrigerator are provided. The private bathroom has a bathtub, as well as slippers, complimentary toiletries, and a hair dryer. Climate control, complimentary bottled water, and a safe are among the included amenities. Non-smoking. Free Wireless Internet. Breakfast Buffet.</p>', 1, 0, '0000-00-00 00:00:00', 117, '2012-07-21 04:36:02', 442, '2012-10-09 03:02:29', '*', '{"termsofuse":"0","privacypolicy":"0","disclaimer":"0","accessible":"1","dining":"1","golf":"1","pets":"1","resort":"1","whirlpool":"1","wireless":"1"}', 0, 11, 3, 2),
(17, 8, 'Colonial Deluxe ', 'colonial-deluxe', '<p><strong>35 square meters</strong>. Desk. Television with premium cable/satellite channels. <strong>Complimentary wired and wireless Internet access</strong>. In-room safe. Refrigerator and minibar. Ensuite bathroom with bathtub. Bath amenities include hair dryer, makeup/shaving mirror, and complimentary toiletries. Slippers. Iron/ironing board. Air conditioning.</p>', 1, 0, '0000-00-00 00:00:00', 117, '2012-07-21 08:00:05', 442, '2012-10-09 02:57:57', '*', '{"termsofuse":"0","privacypolicy":"0","disclaimer":"0","accessible":"1","businesscenter":"0","dining":"1","fitness":"0","golf":"0","meeting":"1","pets":"0","pool":"1","resort":"0","tennis":"0","whirlpool":"0","wireless":"1"}', 0, 12, 2, 0),
(18, 8, ' Colonial Suite', 'colonial-suite', '<p><strong>60 square meters</strong>. Windows open to <strong>view of the city</strong> and <strong>river</strong>. <strong>Living room</strong>. Desk. Television with premium cable/satellite channels. <strong>Complimentary wired and wireless Internet access</strong>. In-room safe. Refrigerator and minibar. Ensuite bathroom with bathtub. Bath amenities include hair dryer, makeup/shaving mirror, and complimentary toiletries. Slippers. Iron/ironing board. Air conditioning.</p>', 1, 0, '0000-00-00 00:00:00', 117, '2012-07-21 08:40:15', 442, '2012-10-09 02:57:18', '*', '{"termsofuse":"0","privacypolicy":"0","disclaimer":"0","accessible":"1","businesscenter":"1","dining":"1","fitness":"1","golf":"1","meeting":"1","pets":"1","pool":"1","resort":"1","tennis":"1","whirlpool":"1","wireless":"1"}', 0, 13, 2, 2),
(19, 8, 'Executive Deluxe', 'executive-deluxe', '<p>Desk. Television with premium cable/satellite channels. <strong>Complimentary wired and wireless Internet access</strong>. In-room safe. Refrigerator and minibar. Ensuite bathroom with bathtub. Bath amenities include hair dryer, makeup/shaving mirror, and complimentary toiletries. Slippers. Iron/ironing board. Air conditioning.</p>', 1, 0, '0000-00-00 00:00:00', 121, '2012-07-21 08:46:16', 442, '2012-10-09 03:10:14', '*', '{"termsofuse":"0","privacypolicy":"0","disclaimer":"0","accessible":"1","businesscenter":"0","dining":"1","fitness":"0","golf":"1","meeting":"1","pets":"0","pool":"1","resort":"0","tennis":"1","whirlpool":"0","wireless":"1"}', 0, 14, 2, 2);


--
-- Dumping data for table `#__sr_coupons`
--
INSERT INTO `#__sr_coupons` (`id`, `state`, `coupon_name`, `coupon_code`, `amount`, `is_percent`, `valid_from`, `valid_to`, `customer_group_id`, `reservation_asset_id`, `valid_from_checkin`, `valid_to_checkin` ) VALUES
(1, 1, 'Valentine', 'VLT', 20, 0, '2011-08-01', '2013-02-01', 1, 8, '2011-08-01', '2013-02-01'),
(2, 1, 'Christmas', 'CHR', 15, 1, '2011-08-01', '2012-12-01', 2, 8, '2011-08-01', '2012-12-01'),
(3, 1, 'New Year', 'NYR', 10, 0, '2011-08-10', '2012-12-01', 3, 8, '2011-08-10', '2012-12-01'),
(4, 1, 'Woman''s Day', 'WMD', 30, 0, '2012-08-01', '2013-03-01', 4, 8, '2012-08-01', '2013-03-01'),
(5, 1, 'Summer Holiday', 'SHD', 10, 1, '2012-07-01', '2012-10-24', 5, 8, '2012-07-01', '2012-10-24');


--
-- Dumping data for table `#__sr_media`
--
INSERT INTO `#__sr_media` (`id`, `type`, `value`, `name`, `created_date`, `modified_date`, `created_by`, `modified_by`, `mime_type`, `size`) VALUES
(1, 'IMAGE', 'hotel_sample_1.jpg', 'hotel_sample_1.jpg', '2012-09-07 03:05:00', '0000-00-00 00:00:00', 572, 0, 'image/jpeg', 92565),
(2, 'IMAGE', 'hotel_sample_2.jpg', 'hotel_sample_2.jpg', '2012-09-07 03:05:01', '0000-00-00 00:00:00', 572, 0, 'image/jpeg', 365011),
(3, 'IMAGE', 'hotel_sample_3.jpg', 'hotel_sample_3.jpg', '2012-09-07 03:05:01', '0000-00-00 00:00:00', 572, 0, 'image/jpeg', 537281),
(4, 'IMAGE', 'hotel_sample_4.jpg', 'hotel_sample_4.jpg', '2012-09-07 03:05:02', '0000-00-00 00:00:00', 572, 0, 'image/jpeg', 82480),
(5, 'IMAGE', 'hotel_sample_5.jpg', 'hotel_sample_5.jpg', '2012-09-07 03:05:02', '0000-00-00 00:00:00', 572, 0, 'image/jpeg', 685284),
(6, 'IMAGE', 'hotel_sample_6.jpg', 'hotel_sample_6.jpg', '2012-09-07 03:05:03', '0000-00-00 00:00:00', 572, 0, 'image/jpeg', 1008552),
(7, 'IMAGE', 'hotel_sample_7.jpg', 'hotel_sample_7.jpg', '2012-09-07 03:05:04', '0000-00-00 00:00:00', 572, 0, 'image/jpeg', 30735),
(8, 'IMAGE', 'hotel_sample_8.jpg', 'hotel_sample_8.jpg', '2012-09-07 03:05:04', '0000-00-00 00:00:00', 572, 0, 'image/jpeg', 129852),
(9, 'IMAGE', 'hotel_sample_9.jpg', 'hotel_sample_9.jpg', '2012-09-07 03:05:05', '0000-00-00 00:00:00', 572, 0, 'image/jpeg', 273128),
(10, 'IMAGE', 'hotel_sample_10.jpg', 'hotel_sample_10.jpg', '2012-09-07 03:05:06', '0000-00-00 00:00:00', 572, 0, 'image/jpeg', 60243),
(11, 'IMAGE', 'hotel_sample_11.jpg', 'hotel_sample_11.jpg', '2012-09-07 03:05:06', '0000-00-00 00:00:00', 572, 0, 'image/jpeg', 1155508),
(12, 'IMAGE', 'hotel_sample_12.jpg', 'hotel_sample_12.jpg', '2012-09-07 03:05:07', '0000-00-00 00:00:00', 572, 0, 'image/jpeg', 577485),
(13, 'IMAGE', 'hotel_sample_13.jpg', 'hotel_sample_13.jpg', '2012-09-07 03:05:08', '0000-00-00 00:00:00', 572, 0, 'image/jpeg', 481832),
(14, 'IMAGE', 'hotel_sample_14.jpg', 'hotel_sample_14.jpg', '2012-09-07 03:05:09', '0000-00-00 00:00:00', 572, 0, 'image/jpeg', 76248),
(15, 'IMAGE', 'hotel_sample_15.jpg', 'hotel_sample_15.jpg', '2012-09-07 03:05:09', '0000-00-00 00:00:00', 572, 0, 'image/jpeg', 30439),
(16, 'IMAGE', 'hotel_sample_16.jpg', 'hotel_sample_16.jpg', '2012-09-07 03:05:10', '0000-00-00 00:00:00', 572, 0, 'image/jpeg', 154914),
(17, 'IMAGE', 'hotel_sample_17.jpg', 'hotel_sample_17.jpg', '2012-09-07 03:16:34', '0000-00-00 00:00:00', 572, 0, 'image/jpeg', 219293),
(18, 'IMAGE', 'hotel_sample_18.jpg', 'hotel_sample_18.jpg', '2012-09-07 03:16:35', '0000-00-00 00:00:00', 572, 0, 'image/jpeg', 2430634),
(19, 'IMAGE', 'hotel_sample_19.jpg', 'hotel_sample_19.jpg', '2012-09-07 03:16:39', '0000-00-00 00:00:00', 572, 0, 'image/jpeg', 6443822),
(20, 'IMAGE', 'hotel_sample_20.jpg', 'hotel_sample_20.jpg', '2012-09-07 03:16:45', '0000-00-00 00:00:00', 572, 0, 'image/jpeg', 3925100),
(21, 'IMAGE', 'hotel_sample_21.jpg', 'hotel_sample_21.jpg', '2012-09-07 03:16:49', '0000-00-00 00:00:00', 572, 0, 'image/jpeg', 3192027),
(22, 'IMAGE', 'hotel_sample_22.jpg', 'hotel_sample_22.jpg', '2012-09-07 03:27:19', '0000-00-00 00:00:00', 572, 0, 'image/jpeg', 535906),
(23, 'IMAGE', 'hotel_sample_23.jpg', 'hotel_sample_23.jpg', '2012-09-07 03:27:22', '0000-00-00 00:00:00', 572, 0, 'image/jpeg', 722604),
(24, 'IMAGE', 'hotel_sample_24.jpg', 'hotel_sample_24.jpg', '2012-09-07 03:27:23', '0000-00-00 00:00:00', 572, 0, 'image/jpeg', 1364680),
(25, 'IMAGE', 'hotel_sample_25.jpg', 'hotel_sample_25.jpg', '2012-09-07 03:27:25', '0000-00-00 00:00:00', 572, 0, 'image/jpeg', 2365965);


--
-- Dumping data for table `#__sr_extras`
--
INSERT INTO `#__sr_extras` (`id`, `name`, `state`, `description`, `created_date`, `modified_date`, `created_by`, `modified_by`, `price`, `ordering`, `max_quantity`, `daily_chargable`, `reservation_asset_id`) VALUES
(1, 'Wine', 1, '<p>Wine for your sweet valentine</p>', '2011-05-07 08:58:50', '2011-05-07 09:10:20', 42, 42, 100.00, 1, 10, 1, 8),
(2, 'Airport pickup', 1, '<p>We will pick you up at the airport</p>', '2011-05-07 09:11:12', '0000-00-00 00:00:00', 42, 0, 20.00, 1, 30, 1, 8),
(3, 'Flower', 1, '<p>Flower</p>', '2011-05-07 09:14:36', '0000-00-00 00:00:00', 42, 0, 15.00, 1, 20, 1, 8),
(4, 'Beer', 1, 'heineken, tiger', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 5.00, 2, 50, 1, 8),
(5, 'Buffet Breakfast', 1, 'Daily International Buffet Breakfast', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 25.00, 3, 40, 1, 8);


--
-- Dumping data for table `#__sr_prices`
--
INSERT INTO `#__sr_prices` (`id`, `currency_id`, `customer_group_id`, `price`, `valid_from`, `valid_to`, `room_type_id`, `title`, `description`, `d_min`, `d_max`, `p_min`, `p_max`, `w_day`) VALUES
(1175, 1, NULL, 210.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 18, '', '', 0, 0, 0, 0, 1),
(1176, 1, NULL, 210.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 18, '', '', 0, 0, 0, 0, 2),
(1177, 1, NULL, 210.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 18, '', '', 0, 0, 0, 0, 3),
(1178, 1, NULL, 210.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 18, '', '', 0, 0, 0, 0, 4),
(1179, 1, NULL, 210.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 18, '', '', 0, 0, 0, 0, 5),
(1180, 1, NULL, 220.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 18, '', '', 0, 0, 0, 0, 6),
(1181, 1, NULL, 230.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 18, '', '', 0, 0, 0, 0, 0),
(1182, 1, 5, 168.00, '2012-08-01 00:00:00', '2012-09-30 00:00:00', 18, '', '', 0, 0, 0, 0, 0),
(1183, 1, 5, 162.00, '2012-08-01 00:00:00', '2012-09-30 00:00:00', 18, '', '', 0, 0, 0, 0, 1),
(1184, 1, 5, 163.00, '2012-08-01 00:00:00', '2012-09-30 00:00:00', 18, '', '', 0, 0, 0, 0, 2),
(1185, 1, 5, 164.00, '2012-08-01 00:00:00', '2012-09-30 00:00:00', 18, '', '', 0, 0, 0, 0, 3),
(1186, 1, 5, 165.00, '2012-08-01 00:00:00', '2012-09-30 00:00:00', 18, '', '', 0, 0, 0, 0, 4),
(1187, 1, 5, 166.00, '2012-08-01 00:00:00', '2012-09-30 00:00:00', 18, '', '', 0, 0, 0, 0, 5),
(1188, 1, 5, 167.00, '2012-08-01 00:00:00', '2012-09-30 00:00:00', 18, '', '', 0, 0, 0, 0, 6),
(1189, 1, 5, 160.00, '2012-10-01 00:00:00', '2012-12-31 00:00:00', 18, '', '', 0, 0, 0, 0, 7),
(1190, 1, 3, 180.00, '2012-07-25 00:00:00', '2012-10-31 00:00:00', 18, '', '', 0, 0, 0, 0, 7),
(1191, 1, 2, 200.00, '2012-07-25 00:00:00', '2012-12-31 00:00:00', 18, '', '', 0, 0, 0, 0, 7),
(1192, 1, NULL, 190.00, '2012-12-10 00:00:00', '2012-12-31 00:00:00', 18, 'Noel promotion', 'merry christmas', 0, 0, 0, 0, 0),
(1193, 1, NULL, 185.00, '2012-12-10 00:00:00', '2012-12-31 00:00:00', 18, 'Noel promotion', 'merry christmas', 0, 0, 0, 0, 1),
(1194, 1, NULL, 185.00, '2012-12-10 00:00:00', '2012-12-31 00:00:00', 18, 'Noel promotion', 'merry christmas', 0, 0, 0, 0, 2),
(1195, 1, NULL, 185.00, '2012-12-10 00:00:00', '2012-12-31 00:00:00', 18, 'Noel promotion', 'merry christmas', 0, 0, 0, 0, 3),
(1196, 1, NULL, 185.00, '2012-12-10 00:00:00', '2012-12-31 00:00:00', 18, 'Noel promotion', 'merry christmas', 0, 0, 0, 0, 4),
(1197, 1, NULL, 185.00, '2012-12-10 00:00:00', '2012-12-31 00:00:00', 18, 'Noel promotion', 'merry christmas', 0, 0, 0, 0, 5),
(1198, 1, NULL, 190.00, '2012-12-10 00:00:00', '2012-12-31 00:00:00', 18, 'Noel promotion', 'merry christmas', 0, 0, 0, 0, 6),
(1199, 1, NULL, 180.00, '2012-08-10 00:00:00', '2012-09-30 00:00:00', 18, 'Summer promotion', 'summer tourist', 0, 0, 0, 0, 7),
(1200, 1, NULL, 155.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 17, '', '', 0, 0, 0, 0, 7),
(1201, 1, 5, 135.00, '2012-07-21 00:00:00', '2012-12-31 00:00:00', 17, '', '', 0, 0, 0, 0, 7),
(1202, 1, 3, 145.00, '2012-07-21 00:00:00', '2012-10-21 00:00:00', 17, '', '', 0, 0, 0, 0, 0),
(1203, 1, 3, 140.00, '2012-07-21 00:00:00', '2012-10-21 00:00:00', 17, '', '', 0, 0, 0, 0, 1),
(1204, 1, 3, 140.00, '2012-07-21 00:00:00', '2012-10-21 00:00:00', 17, '', '', 0, 0, 0, 0, 2),
(1205, 1, 3, 140.00, '2012-07-21 00:00:00', '2012-10-21 00:00:00', 17, '', '', 0, 0, 0, 0, 3),
(1206, 1, 3, 140.00, '2012-07-21 00:00:00', '2012-10-21 00:00:00', 17, '', '', 0, 0, 0, 0, 4),
(1207, 1, 3, 140.00, '2012-07-21 00:00:00', '2012-10-21 00:00:00', 17, '', '', 0, 0, 0, 0, 5),
(1208, 1, 3, 145.00, '2012-07-21 00:00:00', '2012-10-21 00:00:00', 17, '', '', 0, 0, 0, 0, 6),
(1209, 1, 3, 150.00, '2012-09-22 00:00:00', '2012-12-31 00:00:00', 17, '', '', 0, 0, 0, 0, 0),
(1210, 1, 3, 142.00, '2012-09-22 00:00:00', '2012-12-31 00:00:00', 17, '', '', 0, 0, 0, 0, 1),
(1211, 1, 3, 145.00, '2012-09-22 00:00:00', '2012-12-31 00:00:00', 17, '', '', 0, 0, 0, 0, 2),
(1212, 1, 3, 145.00, '2012-09-22 00:00:00', '2012-12-31 00:00:00', 17, '', '', 0, 0, 0, 0, 3),
(1213, 1, 3, 145.00, '2012-09-22 00:00:00', '2012-12-31 00:00:00', 17, '', '', 0, 0, 0, 0, 4),
(1214, 1, 3, 145.00, '2012-09-22 00:00:00', '2012-12-31 00:00:00', 17, '', '', 0, 0, 0, 0, 5),
(1215, 1, 3, 150.00, '2012-09-22 00:00:00', '2012-12-31 00:00:00', 17, '', '', 0, 0, 0, 0, 6),
(1216, 1, 2, 150.00, '2012-08-01 00:00:00', '2012-11-01 00:00:00', 17, '', '', 0, 0, 0, 0, 7),
(1217, 1, NULL, 140.00, '2012-09-01 00:00:00', '2012-09-30 00:00:00', 17, 'National Day', 'national day holidays', 0, 0, 0, 0, 7),
(1218, 1, NULL, 130.00, '2012-10-01 00:00:00', '2012-10-31 00:00:00', 17, 'Summer promotion', 'summer tourist', 0, 0, 0, 0, 7),
(1224, 1, NULL, 175.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 16, '', '', 0, 0, 0, 0, 7),
(1225, 1, 5, 160.00, '2012-07-21 00:00:00', '2012-11-30 00:00:00', 16, '', '', 0, 0, 0, 0, 7),
(1226, 1, 4, 165.00, '2012-07-21 00:00:00', '2012-09-30 00:00:00', 16, '', '', 0, 0, 0, 0, 7),
(1227, 1, 4, 170.00, '2012-10-01 00:00:00', '2012-11-30 00:00:00', 16, '', '', 0, 0, 0, 0, 7),
(1228, 1, NULL, 155.00, '2012-08-01 00:00:00', '2012-09-30 00:00:00', 16, 'Summer Promotion', 'summer tourist', 0, 0, 0, 0, 7),
(1229, 1, NULL, 167.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 15, '', '', 0, 0, 0, 0, 7),
(1230, 1, 5, 135.00, '2012-07-01 00:00:00', '2012-09-01 00:00:00', 15, '', '', 0, 0, 0, 0, 7),
(1231, 1, 5, 140.00, '2012-10-01 00:00:00', '2012-12-01 00:00:00', 15, '', '', 0, 0, 0, 0, 7),
(1232, 1, 2, 150.00, '2012-08-01 00:00:00', '2012-12-01 00:00:00', 15, '', '', 0, 0, 0, 0, 7),
(1233, 1, NULL, 139.00, '2012-08-15 00:00:00', '2013-03-15 00:00:00', 15, 'Woman''s Day', 'International Woman', 0, 0, 0, 0, 0),
(1234, 1, NULL, 136.00, '2012-08-15 00:00:00', '2013-03-15 00:00:00', 15, 'Woman''s Day', 'International Woman', 0, 0, 0, 0, 1),
(1235, 1, NULL, 136.00, '2012-08-15 00:00:00', '2013-03-15 00:00:00', 15, 'Woman''s Day', 'International Woman', 0, 0, 0, 0, 2),
(1236, 1, NULL, 137.00, '2012-08-15 00:00:00', '2013-03-15 00:00:00', 15, 'Woman''s Day', 'International Woman', 0, 0, 0, 0, 3),
(1237, 1, NULL, 137.00, '2012-08-15 00:00:00', '2013-03-15 00:00:00', 15, 'Woman''s Day', 'International Woman', 0, 0, 0, 0, 4),
(1238, 1, NULL, 138.00, '2012-08-15 00:00:00', '2013-03-15 00:00:00', 15, 'Woman''s Day', 'International Woman', 0, 0, 0, 0, 5),
(1239, 1, NULL, 138.00, '2012-08-15 00:00:00', '2013-03-15 00:00:00', 15, 'Woman''s Day', 'International Woman', 0, 0, 0, 0, 6),
(1240, 1, NULL, 285.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 19, '', '', 0, 0, 0, 0, 7),
(1241, 1, 2, 270.00, '2012-07-22 00:00:00', '2012-12-22 00:00:00', 19, '', '', 0, 0, 0, 0, 7),
(1242, 1, 3, 265.00, '2012-07-22 00:00:00', '2012-11-22 00:00:00', 19, '', '', 0, 0, 0, 0, 7),
(1243, 1, 5, 255.00, '2012-08-22 00:00:00', '2012-12-22 00:00:00', 19, '', '', 0, 0, 0, 0, 7),
(1244, 1, 5, 260.00, '2012-07-22 00:00:00', '2012-08-21 00:00:00', 19, '', '', 0, 0, 0, 0, 7),
(1245, 1, NULL, 245.00, '2012-08-14 00:00:00', '2013-02-14 00:00:00', 19, 'Valentine''''s Day', 'Love', 0, 0, 0, 0, 7);


--
-- Dumping data for table `#__sr_rooms`
--
INSERT INTO `#__sr_rooms` (`id`, `label`, `room_type_id`) VALUES
(33, 'X001', 15),
(34, 'X002', 15),
(35, 'X003', 15),
(36, 'X004', 15),
(37, 'V101', 16),
(38, 'V102', 16),
(39, 'V201', 16),
(40, 'V202', 16),
(41, 'CD01', 17),
(42, 'CD02', 17),
(43, 'CD03', 17),
(44, 'CD04', 17),
(45, 'CD05', 17),
(46, 'CD05', 17),
(47, 'CS001', 18),
(48, 'CS002', 18),
(49, 'CS003', 18),
(50, 'CS004', 18),
(51, 'CS005', 18),
(52, 'ED001', 19),
(53, 'ED002', 19),
(54, 'ED003', 19),
(55, 'ED004', 19);


--
-- Dumping data for table `#__sr_media_reservation_assets_xref`
--
INSERT INTO `#__sr_media_reservation_assets_xref` (`media_id`, `reservation_asset_id`, `weight`) VALUES
(1, 8, 1),
(2, 8, 2),
(3, 8, 3),
(4, 8, 4),
(5, 8, 5),
(6, 8, 6),
(7, 8, 7),
(8, 8, 8),
(9, 8, 9),
(10, 8, 10),
(11, 8, 11),
(12, 8, 12),
(13, 8, 13),
(14, 8, 14),
(15, 8, 15),
(16, 8, 16);


--
-- Dumping data for table `#__sr_media_roomtype_xref`
--
INSERT INTO `#__sr_media_roomtype_xref` (`media_id`, `room_type_id`, `weight`) VALUES
(17, 18, 1),
(18, 18, 2),
(19, 17, 3),
(20, 16, 4),
(21, 16, 5),
(22, 15, 7),
(23, 15, 8),
(24, 19, 9),
(25, 19, 10);


--
-- Dumping data for table `#__sr_reservation_asset_fields`
--
INSERT INTO `#__sr_reservation_asset_fields` (`reservation_asset_id`, `field_key`, `field_value`, `ordering`) VALUES
(8, 'reservationasset_extra_fields.accepted_credit_cards', 'American Express, Visa, Euro/Mastercard, Diners Club, Maestro\r\nThe hotel reserves the right to pre-authorise credit cards prior to arrival.', 11),
(8, 'reservationasset_extra_fields.activities', 'Sauna, Fitness Center, Casino, Spa , Massage, Pool Table, Hot Tub, BBQ Facilities, Outdoor Swimming Pool, Outdoor Swimming Pool (All Year).', 2),
(8, 'reservationasset_extra_fields.cancellation_prepayment', 'Cancellation and prepayment policies vary according to room type. Please check the room conditions when selecting your room above. ', 8),
(8, 'reservationasset_extra_fields.checkin_time', 'From 14:00 hours ', 6),
(8, 'reservationasset_extra_fields.checkout_time', 'Until 12:00 hours ', 7),
(8, 'reservationasset_extra_fields.children_and_extra_beds', 'Free! All children under 12 years stay free of charge when using existing beds.\r\nFree! One child under 2 years stays free of charge in a baby cot.\r\nOne older child or adult is charged USD 69.30 per night and person in an extra bed.\r\nMaximum capacity', 9),
(8, 'reservationasset_extra_fields.facebook_link', 'http://facebook.com', 12),
(8, 'reservationasset_extra_fields.facebook_show', '1', 13),
(8, 'reservationasset_extra_fields.foursquare_link', '', 22),
(8, 'reservationasset_extra_fields.foursquare_show', '1', 23),
(8, 'reservationasset_extra_fields.general', 'Restaurant, Bar, 24-hour front desk, Newspapers, Garden, Terrace, Non-smoking rooms, Lift/elevator, Express check-in/check-out, Safety deposit box, Heating, Luggage storage, Air conditioning ', 1),
(8, 'reservationasset_extra_fields.gplus_link', 'https://plus.google.com/', 18),
(8, 'reservationasset_extra_fields.gplus_show', '0', 19),
(8, 'reservationasset_extra_fields.internet', 'Free! WiFi is available in all areas and is free of charge. ', 4),
(8, 'reservationasset_extra_fields.linkedin_link', 'http://www.linkedin.com', 16),
(8, 'reservationasset_extra_fields.linkedin_show', '1', 17),
(8, 'reservationasset_extra_fields.myspace_link', '', 24),
(8, 'reservationasset_extra_fields.myspace_show', '1', 25),
(8, 'reservationasset_extra_fields.parking', 'Private parking is possible on site (reservation is needed) and costs USD 7.50 per day.', 5),
(8, 'reservationasset_extra_fields.pets', 'Pets are not allowed.', 10),
(8, 'reservationasset_extra_fields.pinterest_link', '', 26),
(8, 'reservationasset_extra_fields.pinterest_show', '1', 27),
(8, 'reservationasset_extra_fields.services', 'Room Service, Meeting/Banquet Facilities, Business Center, Babysitting/Child Services, Laundry, Dry Cleaning, Hair/Beauty Salon, Ironing Service, Currency Exchange, Souvenir/Gift Shop, Shoeshine, Car Rental, Tour Desk, Fax/Photocopying, Ticket Service, On', 3),
(8, 'reservationasset_extra_fields.slideshare_link', '', 28),
(8, 'reservationasset_extra_fields.slideshare_show', '1', 29),
(8, 'reservationasset_extra_fields.tumblr_link', '', 20),
(8, 'reservationasset_extra_fields.tumblr_show', '1', 21),
(8, 'reservationasset_extra_fields.twitter_link', 'https://twitter.com', 14),
(8, 'reservationasset_extra_fields.twitter_show', '1', 15),
(8, 'reservationasset_extra_fields.vimeo_link', '', 30),
(8, 'reservationasset_extra_fields.vimeo_show', '1', 31),
(8, 'reservationasset_extra_fields.youtube_link', '', 32),
(8, 'reservationasset_extra_fields.youtube_show', '1', 33);


--
-- Dumping data for table `#__sr_taxes`
--
INSERT INTO `#__sr_taxes` (`id`, `name`, `rate`, `state`, `country_id`, `geo_state_id`) VALUES
(1, 'VAT', 0.1, 1, 224, NULL),
(2, 'Surtaxes', 0.05, 1, 224, NULL),
(3, 'Occupancy Tax', 0.05, 1, 224, NULL),
(4, 'Federal Tax', 0.04, 1, 224, NULL);


--
-- Dumping data for table `#__sr_room_type_coupon_xref`
--
INSERT INTO `#__sr_room_type_coupon_xref` (`room_type_id`, `coupon_id`) VALUES
(19, 1),
(17, 2),
(18, 2),
(18, 3),
(19, 3),
(15, 4),
(19, 4);


--
-- Dumping data for table `#__sr_room_type_extra_xref`
--
INSERT INTO `#__sr_room_type_extra_xref` (`room_type_id`, `extra_id`) VALUES
(17, 1),
(15, 2),
(19, 2),
(18, 3),
(19, 3),
(17, 4),
(18, 5),
(19, 5);


--
-- Dumping data for table `#__sr_room_type_fields`
--
INSERT INTO `#__sr_room_type_fields` (`room_type_id`, `field_key`, `field_value`, `ordering`) VALUES
(15, 'roomtype_custom_fields.bed_size', '2 Twin Or 1 Queen', 7),
(15, 'roomtype_custom_fields.breakfast_included', '0', 2),
(15, 'roomtype_custom_fields.free_cancellation', '1', 1),
(15, 'roomtype_custom_fields.prepayment', 'The total price of the reservation will be charged on the day of booking.', 4),
(15, 'roomtype_custom_fields.room_facilities', 'Balcony, Telephone, Radio, Satellite channels, Cable channels, Flat-screen TV, Safe, Air conditioning, Desk, Ironing facilities, Sitting area, Interconnecting room(s) available, Sofa, Bathtub, Hairdryer, Bathrobe, Free toiletries, Toilet, Bathroom, Slippe', 5),
(15, 'roomtype_custom_fields.room_size', '35 square meters.', 6),
(15, 'roomtype_custom_fields.taxes', '10 % VAT, 5 % service charge.', 3),
(16, 'roomtype_custom_fields.bed_size', '1 Twin, 1 Full. ', 7),
(16, 'roomtype_custom_fields.breakfast_included', '1', 2),
(16, 'roomtype_custom_fields.free_cancellation', '1', 1),
(16, 'roomtype_custom_fields.prepayment', 'The total price of the reservation will be charged on the day of booking.', 4),
(16, 'roomtype_custom_fields.room_facilities', 'Balcony, View , Telephone, Radio, Satellite channels, Cable channels, Flat-screen TV, Safe, Air conditioning, Desk, Ironing facilities, Sitting area, Interconnecting room(s) available, Sofa, Bathtub, Hairdryer, Bathrobe, Free toiletries, Toilet, Bathroom,', 5),
(16, 'roomtype_custom_fields.room_size', '45 square meters.', 6),
(16, 'roomtype_custom_fields.taxes', '10 % VAT, 5 % service charge.', 3),
(17, 'roomtype_custom_fields.bed_size', '2 Twin Or 1 Full.', 7),
(17, 'roomtype_custom_fields.breakfast_included', '1', 2),
(17, 'roomtype_custom_fields.free_cancellation', '1', 1),
(17, 'roomtype_custom_fields.prepayment', 'The total price of the reservation will be charged on the day of booking.', 4),
(17, 'roomtype_custom_fields.room_facilities', 'Balcony, View , Telephone, Radio, Satellite channels, Cable channels, Flat-screen TV, Safe, Air conditioning, Desk, Ironing facilities, Sitting area, Interconnecting room(s) available, Sofa, Bathtub, Hairdryer, Bathrobe, Free toiletries, Toilet, Bathroom.', 5),
(17, 'roomtype_custom_fields.room_size', '35 square meters.', 6),
(17, 'roomtype_custom_fields.taxes', '10 % VAT, 5 % service charge.', 3),
(18, 'roomtype_custom_fields.bed_size', '1 King.', 7),
(18, 'roomtype_custom_fields.breakfast_included', '1', 2),
(18, 'roomtype_custom_fields.free_cancellation', '1', 1),
(18, 'roomtype_custom_fields.prepayment', 'The total price of the reservation will be charged on the day of booking.', 4),
(18, 'roomtype_custom_fields.room_facilities', 'Balcony, View , Telephone, Radio, Satellite channels, Cable channels, Flat-screen TV, Safe, Air conditioning, Desk, Ironing facilities, Sitting area, Interconnecting room(s) available, Sofa, Bathtub, Hairdryer, Bathrobe, Free toiletries, Toilet, Bathroom.', 5),
(18, 'roomtype_custom_fields.room_size', '66 square meters.', 6),
(18, 'roomtype_custom_fields.taxes', '10 % VAT, 5 % service charge.', 3),
(19, 'roomtype_custom_fields.bed_size', '2 Twin Or 1 Queen.', 7),
(19, 'roomtype_custom_fields.breakfast_included', '1', 2),
(19, 'roomtype_custom_fields.free_cancellation', '1', 1),
(19, 'roomtype_custom_fields.prepayment', 'The total price of the reservation will be charged on the day of booking.', 4),
(19, 'roomtype_custom_fields.room_facilities', 'Balcony, View , Telephone, Radio, Satellite channels, Cable channels, Flat-screen TV, Safe, Air conditioning, Desk, Ironing facilities, Sitting area, Interconnecting room(s) available, Sofa, Bathtub, Hairdryer, Bathrobe, Free toiletries, Toilet, Bathroom,', 5),
(19, 'roomtype_custom_fields.room_size', '35 square meters.', 6),
(19, 'roomtype_custom_fields.taxes', '10 % VAT, 5 % service charge.', 3);
