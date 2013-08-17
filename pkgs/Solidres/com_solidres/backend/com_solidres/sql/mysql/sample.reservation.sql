--
-- Dumping data for table `#__sr_reservations`
--
INSERT INTO `#__sr_reservations` (`id`, `state`, `customer_id`, `created_date`, `modified_date`, `modified_by`, `created_by`, `payment_method_id`, `code`, `coupon_id`, `coupon_code`, `customer_firstname`, `customer_middlename`, `customer_lastname`, `customer_email`, `customer_phonenumber`, `customer_company`, `customer_address1`, `customer_address2`, `customer_city`, `customer_zipcode`, `customer_country_id`, `customer_geo_state_id`, `checkin`, `checkout`, `invoice_number`, `currency_id`, `currency_code`, `total_price`, `total_price_tax_incl`, `total_price_tax_excl`, `total_extra_price`, `total_extra_price_tax_incl`, `total_extra_price_tax_excl`, `total_discount`, `note`, `reservation_asset_id`, `reservation_asset_name`) VALUES
(1, 0, NULL, '2013-01-30 08:01:12', '0000-00-00 00:00:00', 0, 0, 0, 'a5b58c94', NULL, NULL, 'Susan', '', 'Jane', 'susanjane@localhost.dev', '0111222333', '', '123 Junior Street', '', 'LA', '70000', 224, 6, '2013-01-30', '2013-01-31', NULL, 1, 'USD', 169.88, 169.88, 137.00, 20.00, 20.00, 20.00, NULL, '', 8, 'Sunflower'),
(2, 0, NULL, '2013-01-30 08:04:00', '0000-00-00 00:00:00', 0, 0, 0, '944a0dc2', NULL, NULL, 'Johan', '', 'Cruyff', 'johancruyff@localhost.dev', '998123456', '', '777 Street 5', '', 'Chartlotte', '123456', 224, 35, '2013-02-03', '2013-02-06', NULL, 1, 'USD', 651.00, 651.00, 525.00, 0.00, 0.00, 0.00, NULL, '', 8, 'Sunflower'),
(3, 0, 32, '2013-01-30 08:10:35', '0000-00-00 00:00:00', 0, 90002, 0, '9ebee0ad', NULL, NULL, 'Wilson', '', 'Miller', 'wilsonmiller@localhost.dev', '123456789', '', '789 Street ABC', '', 'HCM', '08', 231, 0, '2013-02-10', '2013-02-14', NULL, 1, 'USD', 2827.20, 2827.20, 2280.00, 60.00, 60.00, 60.00, NULL, '', 8, 'Sunflower'),
(4, 0, 32, '2013-01-30 08:12:22', '0000-00-00 00:00:00', 0, 90002, 0, '01658078', NULL, NULL, 'Wilson', '', 'Miller', 'wilsonmiller@localhost.dev', '123456789', '', '123456 Street ABC', '', 'DN', '065', 231, 0, '2013-03-13', '2013-03-14', NULL, 1, 'USD', 192.20, 192.20, 155.00, 100.00, 100.00, 100.00, NULL, '', 8, 'Sunflower'),
(5, 0, 33, '2013-01-30 08:13:47', '0000-00-00 00:00:00', 0, 90003, 0, '93119278', NULL, NULL, 'Kaito', '', 'Kazuki', 'kaitokazuki@localhost.dev', '456456456', '', '333 Street YUI', '', 'HN', '04', 231, 0, '2013-02-18', '2013-02-22', NULL, 1, 'USD', 1041.60, 1041.60, 840.00, 0.00, 0.00, 0.00, NULL, '', 8, 'Sunflower'),
(6, 0, 33, '2013-01-30 08:15:47', '0000-00-00 00:00:00', 0, 90003, 0, '3ab5e942', NULL, NULL, 'Kaito', '', 'Kazuki', 'kaitokazuki@localhost.dev', '123456789', '', '246 Street Sunset', '', 'DT', '012', 231, 0, '2013-03-19', '2013-03-20', NULL, 1, 'USD', 414.16, 414.16, 334.00, 0.00, 0.00, 0.00, NULL, '', 8, 'Sunflower'),
(7, 0, 35, '2013-01-30 08:20:35', '0000-00-00 00:00:00', 0, 90005, 0, 'a0fab994', NULL, NULL, 'Kaito', '', 'Kazuki', 'kaitokazuki@localhost.dev', '123456789', '', '246 Street Sunset', '', 'DT', '012', 231, 0, '2013-04-15', '2013-04-19', NULL, 1, 'USD', 2083.20, 2083.20, 1680.00, 0.00, 0.00, 0.00, NULL, '', 8, 'Sunflower'),
(8, 0, 35, '2013-01-30 08:21:04', '0000-00-00 00:00:00', 0, 90005, 0, '2ecac208', NULL, NULL, 'Kaito', '', 'Kazuki', 'kaitokazuki@localhost.dev', '123456789', '', '246 Street Sunset', '', 'DT', '012', 231, 0, '2013-03-26', '2013-03-30', NULL, 1, 'USD', 768.80, 768.80, 620.00, 0.00, 0.00, 0.00, NULL, '', 8, 'Sunflower'),
(9, 0, 31, '2013-01-30 08:21:51', '0000-00-00 00:00:00', 0, 90001, 0, '26c745d6', NULL, NULL, 'Kaito', '', 'Kazuki', 'kaitokazuki@localhost.dev', '123456789', '', '246 Street Sunset', '', 'DT', '012', 231, 0, '2013-02-25', '2013-02-28', NULL, 1, 'USD', 651.00, 651.00, 525.00, 0.00, 0.00, 0.00, NULL, '', 8, 'Sunflower'),
(10, 0, 31, '2013-01-30 08:22:29', '0000-00-00 00:00:00', 0, 90001, 0, 'e94aefc0', NULL, NULL, 'Kaito', '', 'Kazuki', 'kaitokazuki@localhost.dev', '123456789', '', '246 Street Sunset', '', 'DT', '012', 231, 0, '2013-05-05', '2013-05-11', NULL, 1, 'USD', 3174.40, 3174.40, 2560.00, 0.00, 0.00, 0.00, NULL, '', 8, 'Sunflower'),
(11, 0, 31, '2013-01-30 08:23:31', '0000-00-00 00:00:00', 0, 90001, 0, '74ab4c61', NULL, NULL, 'Kaito', '', 'Kazuki', 'kaitokazuki@localhost.dev', '123456789', '', '246 Street Sunset', '', 'DT', '012', 231, 0, '2013-06-12', '2013-06-14', NULL, 1, 'USD', 414.16, 414.16, 334.00, 0.00, 0.00, 0.00, NULL, '', 8, 'Sunflower');


--
-- Dumping data for table `#__sr_reservation_room_extra_xref`
--
INSERT INTO `#__sr_reservation_room_extra_xref` (`id`, `reservation_id`, `room_id`, `room_label`, `extra_id`, `extra_name`, `extra_quantity`, `extra_price`) VALUES
(1, 1, 33, 'X001', 2, 'Airport pickup', 1, 20.00),
(2, 3, 52, 'ED001', 2, 'Airport pickup', 1, 20.00),
(3, 3, 52, 'ED001', 3, 'Flower', 1, 15.00),
(4, 3, 52, 'ED001', 5, 'Buffet Breakfast', 1, 25.00),
(5, 4, 41, 'CD01', 1, 'Wine', 1, 100.00);


--
-- Dumping data for table `#__sr_reservation_room_xref`
--
INSERT INTO `#__sr_reservation_room_xref` (`id`, `reservation_id`, `room_id`, `room_label`, `adults_number`, `children_number`, `guest_fullname`, `room_price`) VALUES
(1, 1, 33, 'X001', 2, 0, 'Susan', 137.00),
(2, 2, 37, 'V101', 1, 1, 'Johan', 525.00),
(3, 3, 52, 'ED001', 2, 0, 'Wilson', 1140.00),
(4, 3, 53, 'ED002', 1, 0, 'Jade', 1140.00),
(5, 4, 41, 'CD01', 0, 0, 'Wilson', 155.00),
(6, 5, 47, 'CS001', 0, 0, 'Kaito', 840.00),
(7, 6, 33, 'X001', 2, 0, 'Kaito', 167.00),
(8, 6, 34, 'X002', 0, 0, 'Kohsuke', 167.00),
(9, 7, 47, 'CS001', 2, 0, 'Kenneth', 840.00),
(10, 7, 48, 'CS002', 2, 0, 'Ben', 840.00),
(11, 8, 41, 'CD01', 2, 0, 'Kaito', 620.00),
(12, 9, 37, 'V101', 2, 0, 'David', 525.00),
(13, 10, 47, 'CS001', 2, 0, 'Kaito', 1280.00),
(14, 10, 48, 'CS002', 1, 0, 'Kohsuke', 1280.00),
(15, 11, 33, 'X001', 2, 0, 'Kaito', 334.00);


