<?php
$tableArray[0]['table_name']=PREFIX."administrator";
$tableArray[0]['table_create']="CREATE TABLE IF NOT EXISTS `".PREFIX."administrator` (
  `idAdmin` bigint(20) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `show_price` int(11) NOT NULL DEFAULT '1',
  `idCurrency` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) CHARACTER SET macce COLLATE macce_bin NOT NULL,
  `is_paypal` int(11) NOT NULL DEFAULT '1',
  `order_mail_to` varchar(250) NOT NULL,
  `paypal_link` varchar(250) NOT NULL,
  `paypal_business_mail` varchar(250) NOT NULL,
  `is_smtp` int(11) NOT NULL DEFAULT '0',
  `smtp_host` varchar(250) NOT NULL,
  `smtp_user` varchar(250) NOT NULL,
  `smtp_password` varchar(250) NOT NULL,
  `smtp_port` bigint(20) NOT NULL,
  `page_bottom_content` longtext NOT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
$tableArray[0]['table_insert']="INSERT INTO `".PREFIX."administrator` (`show_price`, `idCurrency`,`is_paypal`, `paypal_link`,`page_bottom_content`) VALUES
(1, 227,1,'https://www.sandbox.paypal.com/cgi-bin/webscr','<p><img src=img/pay-img.jpg></p>\r\n<p>By clicking the ORDER NOW button, you agree <br> to the <a target=`_blank` href=`#`>Terms & Conditions</a>.</p>')";


$tableArray[1]['table_name']=PREFIX."category";
$tableArray[1]['table_create']="CREATE TABLE IF NOT EXISTS `".PREFIX."category` (
  `idCategory` bigint(20) NOT NULL AUTO_INCREMENT,
  `idParent` bigint(20) NOT NULL,
  `catName` varchar(250) NOT NULL,
  `catDescription` longtext NOT NULL,
  `catImage` varchar(250) NOT NULL,
  `catPrice` double(15,2) NOT NULL DEFAULT '0.00',
  `is_image` int(11) NOT NULL DEFAULT '0' COMMENT '1 for image 2 for icon 0 for none',
  PRIMARY KEY (`idCategory`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
$tableArray[1]['table_insert']="INSERT INTO `".PREFIX."category` (`idCategory`, `idParent`, `catName`, `catDescription`, `catImage`, `catPrice`, `is_image`) 
								VALUES(1, 0, 'PSD to Responsive HTML5', 'PSD to Responsive HTML5', 'fa fa-html5', 0.00, 2),
(2, 0, 'PSD to CMS / ecommerce', 'PSD to CMS / ecommerce', 'fa fa-shopping-cart', 0.00, 2),
(4, 0, 'Other Services', ' Other Services', 'fa fa-lightbulb-o', 0.00, 2)";

$tableArray[2]['table_name']=PREFIX."cms";
$tableArray[2]['table_create']="CREATE TABLE IF NOT EXISTS `".PREFIX."cms` (
  `idCms` bigint(20) NOT NULL AUTO_INCREMENT,
  `content` varchar(250) NOT NULL,
  PRIMARY KEY (`idCms`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
$tableArray[2]['table_insert']="";

$tableArray[3]['table_name']=PREFIX."coupon";
$tableArray[3]['table_create']="CREATE TABLE IF NOT EXISTS `".PREFIX."coupon` (
  `idCoupon` bigint(20) NOT NULL AUTO_INCREMENT,
  `couponCode` varchar(250) NOT NULL,
  `discountType` enum('P','C') NOT NULL,
  `discountValue` varchar(200) NOT NULL,
  `dateFrom` date NOT NULL,
  `dateTo` date NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`idCoupon`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
$tableArray[3]['table_insert']="";

$tableArray[4]['table_name']=PREFIX."coupon_products";
$tableArray[4]['table_create']="CREATE TABLE IF NOT EXISTS `".PREFIX."coupon_products` (
  `idProductcoupon` bigint(20) NOT NULL AUTO_INCREMENT,
  `idCoupon` bigint(20) NOT NULL,
  `idProduct` bigint(20) NOT NULL,
  PRIMARY KEY (`idProductcoupon`),
  KEY `idProduct` (`idProduct`),
  KEY `idCoupon` (`idCoupon`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
";
$tableArray[4]['table_insert']="";

$tableArray[5]['table_name']=PREFIX."currency";
$tableArray[5]['table_create']="CREATE TABLE IF NOT EXISTS `".PREFIX."currency` (
  `idCurrency` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `country` varchar(200) DEFAULT NULL,
  `currency_code` char(3) DEFAULT NULL,
  `currency_name` varchar(32) DEFAULT NULL,
  `currrency_symbol` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`idCurrency`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";

$tableArray[5]['table_insert']="INSERT INTO `".PREFIX."currency` (`idCurrency`, `country`, `currency_code`, `currency_name`, `currrency_symbol`) VALUES
(13, 'Australia', 'AUD', 'Dollar', '$'),
(30, 'Brazil', 'BRL', 'Real', 'R$'),
(39, 'Canada', 'CAD', 'Dollar', '$'),
(46, 'Christmas Island', 'AUD', 'Dollar', '$'),
(47, 'Cocos Islands', 'AUD', 'Dollar', '$'),
(50, 'Cook Islands', 'NZD', 'Dollar', '$'),
(55, 'Czech Republic', 'CZK', 'Koruna', 'KÄ'),
(57, 'Denmark', 'DKK', 'Krone', 'kr'),
(61, 'East Timor', 'USD', 'Dollar', '$'),
(62, 'Ecuador', 'USD', 'Dollar', '$'),
(70, 'Faroe Islands', 'DKK', 'Krone', 'kr'),
(72, 'Finland', 'EUR', 'Euro', 'â‚¬'),
(73, 'France', 'EUR', 'Euro', 'â‚¬'),
(74, 'French Guiana', 'EUR', 'Euro', 'â‚¬'),
(76, 'French Southern Territories', 'EUR', 'Euro  ', 'â‚¬'),
(80, 'Germany', 'EUR', 'Euro', 'â‚¬'),
(83, 'Greece', 'EUR', 'Euro', 'â‚¬'),
(84, 'Greenland', 'DKK', 'Krone', 'kr'),
(86, 'Guadeloupe', 'EUR', 'Euro', 'â‚¬'),
(87, 'Guam', 'USD', 'Dollar', '$'),
(93, 'Heard Island and McDonald Islands', 'AUD', 'Dollar', '$'),
(95, 'Hong Kong', 'HKD', 'Dollar', '$'),
(96, 'Hungary', 'HUF', 'Forint', 'Ft'),
(102, 'Ireland', 'EUR', 'Euro', 'â‚¬'),
(103, 'Israel', 'ILS', 'Shekel', 'â‚ª'),
(104, 'Italy', 'EUR', 'Euro', 'â‚¬'),
(107, 'Japan', 'JPY', 'Yen', 'Â¥'),
(111, 'Kiribati', 'AUD', 'Dollar', '$'),
(120, 'Liechtenstein', 'CHF', 'Franc', 'CHF'),
(122, 'Luxembourg', 'EUR', 'Euro', 'â‚¬'),
(127, 'Malaysia', 'MYR', 'Ringgit', 'RM'),
(128, 'Maldives', 'MVR', 'Rufiyaa', 'Rf'),
(131, 'Marshall Islands', 'USD', 'Dollar', '$'),
(132, 'Martinique', 'EUR', 'Euro', 'â‚¬'),
(135, 'Mayotte', 'EUR', 'Euro', 'â‚¬'),
(136, 'Mexico', 'MXN', 'Peso', '$'),
(137, 'Micronesia', 'USD', 'Dollar', '$'),
(139, 'Monaco', 'EUR', 'Euro', 'â‚¬'),
(146, 'Nauru', 'AUD', 'Dollar', '$'),
(148, 'Netherlands', 'EUR', 'Euro', 'â‚¬'),
(151, 'New Zealand', 'NZD', 'Dollar', '$'),
(155, 'Niue', 'NZD', 'Dollar', '$'),
(156, 'Norfolk Island', 'AUD', 'Dollar', '$'),
(158, 'Northern Mariana Islands', 'USD', 'Dollar', '$'),
(159, 'Norway', 'NOK', 'Krone', 'kr'),
(162, 'Palau', 'USD', 'Dollar', '$'),
(163, 'Palestinian Territory', 'ILS', 'Shekel', 'â‚ª'),
(168, 'Philippines', 'PHP', 'Peso', 'Php'),
(169, 'Pitcairn', 'NZD', 'Dollar', '$'),
(170, 'Poland', 'PLN', 'Zloty', 'zÅ‚'),
(171, 'Portugal', 'EUR', 'Euro', 'â‚¬'),
(172, 'Puerto Rico', 'USD', 'Dollar', '$'),
(175, 'Reunion', 'EUR', 'Euro', 'â‚¬'),
(182, 'Saint Pierre and Miquelon', 'EUR', 'Euro', 'â‚¬'),
(185, 'San Marino', 'EUR', 'Euro', 'â‚¬'),
(192, 'Singapore', 'SGD', 'Dollar', '$'),
(194, 'Slovenia', 'EUR', 'Euro', 'â‚¬'),
(198, 'South Georgia and the South Sandwich Islands', 'GBP', 'Pound', 'Â£'),
(200, 'Spain', 'EUR', 'Euro', 'â‚¬'),
(204, 'Svalbard and Jan Mayen', 'NOK', 'Krone', 'kr'),
(206, 'Sweden', 'SEK', 'Krona', 'kr'),
(207, 'Switzerland', 'CHF', 'Franc', 'CHF'),
(209, 'Taiwan', 'TWD', 'Dollar', 'NT$'),
(210, 'Tajikistan', 'TJS', 'Somoni', NULL),
(212, 'Thailand', 'THB', 'Baht', 'à¸¿'),
(214, 'Tokelau', 'NZD', 'Dollar', '$'),
(218, 'Turkey', 'TRY', 'Lira', 'YTL'),
(220, 'Turks and Caicos Islands', 'USD', 'Dollar', '$'),
(221, 'Tuvalu', 'AUD', 'Dollar', '$'),
(222, 'U.S. Virgin Islands', 'USD', 'Dollar', '$'),
(226, 'United Kingdom', 'GBP', 'Pound', 'Â£'),
(227, 'United States', 'USD', 'Dollar', '$'),
(228, 'United States Minor Outlying Islands', 'USD', 'Dollar ', '$'),
(232, 'Vatican', 'EUR', 'Euro', 'â‚¬')";

$tableArray[6]['table_name']=PREFIX."mailtemplate";
$tableArray[6]['table_create']="CREATE TABLE IF NOT EXISTS `".PREFIX."mailtemplate` (
  `idTemplate` bigint(20) NOT NULL AUTO_INCREMENT,
  `templateName` varchar(250) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `mailContent` longtext NOT NULL,
  PRIMARY KEY (`idTemplate`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
$tableArray[6]['table_insert']="INSERT INTO `".PREFIX."mailtemplate` (`templateName`, `subject`, `mailContent`) VALUES
('Order confirmation (to customer)', 'Your order completed', ' Hello {name} \r\nThis is the confirmation email from yourwebsite.com to inform you that we have received your request successfully. Soon you will receive a response from one of our technical support expert. We try to keep our response time as fast as possible but sometime it may take upto 24 hours.\r\nOrder Details \r\n{items}\r\n\r\nRegards,\r\nYOUR BUSINESS NAME\r\nemail: YOUR EMAIL\r\nskype: YOUR SKYPE\r\nWebsite :YOUR WEBSITE'),
('Order confirmation (to admin)', 'We got new order from yourwebsite.com ', ' Hello Team, \r\n\r\nWe have new order successfully received and please analyze this order and send order confirmation mail asap.\r\nOrder Details \r\n{items}\r\nCustomer Details\r\n{customer}\r\n\r\nRegards,\r\nYOUR BUSINESS NAME\r\nemail: YOUR EMAIL\r\nskype: YOUR SKYPE\r\nWebsite :YOUR WEBSITE'),
('User request ', 'We have received a requst from customer', ' Hello Team, \r\n We have received a request from customer.\r\n\r\nCustomer Details\r\n{customer}\r\n\r\nRegards,\r\nYOUR BUSINESS NAME\r\nemail: YOUR EMAIL\r\nskype: YOUR SKYPE\r\nWebsite :YOUR WEBSITE')";

$tableArray[7]['table_name']=PREFIX."options";
$tableArray[7]['table_create']="CREATE TABLE IF NOT EXISTS `".PREFIX."options` (
  `idOption` bigint(20) NOT NULL AUTO_INCREMENT,
  `optionname` varchar(200) NOT NULL,
  `optionPrice` varchar(200) NOT NULL,
  PRIMARY KEY (`idOption`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
$tableArray[7]['table_insert']="INSERT INTO `".PREFIX."options` (`idOption`, `optionname`, `optionPrice`) VALUES
(6, 'Dynamic Menus ', '18'),
(7, 'Commented HTML5 ', '8'),
(8, 'CSS3 Animations ', '9'),
(9, 'Jquery Implementation', '9'),
(10, 'SEO semantic coding', '9'),
(11, 'Load speed optimization', '9'),
(12, 'Internet Explorer 8 compatibility ', '19'),
(13, 'Link all pages', '5'),
(14, 'CSS3 Animations ', '9'),
(15, 'Optimized for Retina Displays', '18'),
(16, 'Commented HTML5', '8'),
(17, 'Contact Form', '18'),
(18, 'Slider ', '8'),
(19, 'Cache Plugin', '9'),
(20, 'Jquery Implementation', '9'),
(21, 'Testimonial ', '8'),
(22, 'Gallery ', '9'),
(23, 'VirtueMart ', '48'),
(24, 'JEvents ', '16'),
(25, 'AdsManager ', '20'),
(26, 'JCE Editor', '5'),
(27, 'Newsletter ', '5'),
(28, 'EasyBlog ', '15'),
(29, 'Event Booking ', '16'),
(30, 'Video gallery', '9'),
(31, 'Contact Enhanced Component', '9'),
(32, 'PayPal IPN ', '10'),
(33, 'Backup and Migrate', '10'),
(34, 'File Upload', '9'),
(35, 'Statistics ', '5'),
(36, 'Views Slideshow', '6'),
(37, 'Multiple Table Rates Extension ', '10'),
(38, 'AddThis ', '5'),
(39, 'Magento-Wordpress Integration', '35'),
(40, 'Product Reviews ', '10'),
(41, 'Social Commerce Platform ', '13'),
(42, 'Stock manager', '13'),
(43, 'Video Gallery', '12'),
(44, 'Social Login & Sharing ', '12'),
(45, 'Shipping Module', '8'),
(46, 'Subscriptions manager ', '12'),
(47, 'Subscriptions manager ', '12'),
(48, 'Product rating and review module', '15'),
(49, 'Newsletter Module', '10'),
(50, 'Data Migration Module', '12'),
(51, 'Payment Gateway ', '16'),
(52, 'Sitemap ', '10'),
(53, 'Module Manager', '10'),
(54, 'Product purchase and sales report ', '15'),
(55, 'Shipping Methods', '20'),
(56, 'Newsletter Subscription', '10'),
(57, 'Categories Module', '16'),
(58, 'Multilanguage ', '15'),
(59, 'Advanced inventory manager', '15'),
(60, 'Customer Reviews', '15')";

$tableArray[8]['table_name']=PREFIX."orders";
$tableArray[8]['table_create']="CREATE TABLE IF NOT EXISTS `".PREFIX."orders` (
  `idOrder` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_details` longtext NOT NULL,
  `cart` longtext NOT NULL,
  `customer_email` varchar(250) NOT NULL,
  `Items` varchar(250) NOT NULL,
  `subTotal` varchar(250) NOT NULL,
  `discount` varchar(250) NOT NULL,
  `total` varchar(250) NOT NULL,
  `orderType` varchar(50) NOT NULL DEFAULT '0',
  `payment_status` varchar(250) NOT NULL,
  `txn_id` varchar(250) NOT NULL,
  `mailStatus` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idOrder`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
$tableArray[8]['table_insert']="";

$tableArray[9]['table_name']=PREFIX."product";
$tableArray[9]['table_create']="CREATE TABLE IF NOT EXISTS `".PREFIX."product` (
  `idproduct` bigint(20) NOT NULL AUTO_INCREMENT,
  `idCategory` bigint(20) NOT NULL,
  `productName` varchar(250) NOT NULL,
  `productDesc` longtext NOT NULL,
  `is_image` int(11) NOT NULL DEFAULT '0' COMMENT '1 for image 2 for icon 0 for none',
  `productImage` varchar(250) NOT NULL,
  `productPrice` double(15,2) NOT NULL,
  `purchaseSummary` longtext NOT NULL,
  `productDate` datetime NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`idproduct`),
  KEY `idCategory` (`idCategory`),
  KEY `idCategory_2` (`idCategory`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
$tableArray[9]['table_insert']="INSERT INTO `".PREFIX."product` (`idproduct`, `idCategory`, `productName`, `productDesc`, `is_image`, `productImage`, `productPrice`, `purchaseSummary`, `productDate`, `status`) VALUES
(1, 1, 'Basic Package', '   (  home page )<br/>\r\n<p class=high-cont>$49 - per inner page</p>\r\n<p>W3C Valid HTML5, Optimized CSS3,\r\nCustom Fonts</p>', 0, '', 89.00, ' Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '0000-00-00 00:00:00', '0'),
(2, 1, 'Hi-End Package', '<p>   ( home page ) </p>\r\n<p class=high-cont>$49 - per inner page</p>\r\n                    <p><strong>Basic Package +</strong> <br>Responsive Bootstrap, SEO, Speed Optimization</p>', 0, '', 129.00, ' Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '0000-00-00 00:00:00', '0'),
(3, 2, 'WordPress', 'WordPress details', 2, 'fa fa-wordpress', 190.00, ' Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '0000-00-00 00:00:00', '0'),
(4, 2, 'Joomla', ' Joomla Details', 2, 'fa fa-joomla', 185.00, ' Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '0000-00-00 00:00:00', '0'),
(5, 2, 'Drupal', 'Drupal details', 2, 'fa fa-drupal', 199.00, ' Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '0000-00-00 00:00:00', '0'),
(6, 2, 'Magento', ' Magento details', 2, 'fa fa-magento', 350.00, ' Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '0000-00-00 00:00:00', '0'),
(13, 2, 'Shopify', ' Shopify Details', 2, 'fa-shopify', 300.00, ' ', '0000-00-00 00:00:00', '0'),
(14, 2, 'Prestashop', 'Prestashop details', 2, 'fa-prestashop', 260.00, ' ', '0000-00-00 00:00:00', '0'),
(15, 2, 'Opencart', ' Opencart Details', 2, 'fa-opencart', 250.00, ' ', '0000-00-00 00:00:00', '0'),
(16, 2, 'Virtuemart', ' ', 2, 'fa-virtuemart', 256.00, ' ', '0000-00-00 00:00:00', '0')";

$tableArray[10]['table_name']=PREFIX."product_options";
$tableArray[10]['table_create']="CREATE TABLE IF NOT EXISTS `".PREFIX."product_options` (
  `idProductoption` bigint(20) NOT NULL AUTO_INCREMENT,
  `idOption` bigint(20) NOT NULL,
  `idProduct` bigint(20) NOT NULL,
  PRIMARY KEY (`idProductoption`),
  KEY `idOption` (`idOption`),
  KEY `idProduct` (`idProduct`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
$tableArray[10]['table_insert']="INSERT INTO `".PREFIX."product_options` (`idProductoption`, `idOption`, `idProduct`) VALUES
(37, 17, 3),
(38, 18, 3),
(39, 19, 3),
(40, 20, 3),
(41, 21, 3),
(42, 22, 3),
(53, 17, 4),
(54, 23, 4),
(55, 24, 4),
(56, 25, 4),
(57, 26, 4),
(58, 27, 4),
(59, 28, 4),
(60, 29, 4),
(61, 30, 4),
(62, 31, 4),
(63, 28, 5),
(64, 32, 5),
(65, 33, 5),
(66, 34, 5),
(67, 35, 5),
(68, 36, 5),
(74, 17, 6),
(75, 36, 6),
(76, 37, 6),
(77, 38, 6),
(78, 39, 6),
(86, 17, 13),
(87, 40, 13),
(88, 41, 13),
(89, 42, 13),
(90, 43, 13),
(91, 44, 13),
(92, 45, 13),
(93, 28, 14),
(94, 47, 14),
(95, 48, 14),
(96, 49, 14),
(97, 50, 14),
(98, 49, 15),
(99, 51, 15),
(100, 52, 15),
(101, 53, 15),
(102, 54, 15),
(103, 55, 15),
(104, 49, 16),
(105, 57, 16),
(106, 58, 16),
(107, 59, 16),
(108, 60, 16),
(137, 12, 2),
(138, 13, 2),
(139, 14, 2),
(140, 15, 2),
(141, 16, 2),
(142, 6, 1),
(143, 7, 1),
(144, 8, 1),
(145, 9, 1),
(146, 10, 1),
(147, 11, 1)";

$query1="ALTER TABLE `".PREFIX."coupon_products`
  ADD CONSTRAINT `".PREFIX."coupon_products_ibfk_2` FOREIGN KEY (`idCoupon`) REFERENCES `".PREFIX."coupon` (`idCoupon`) ON DELETE CASCADE,
  ADD CONSTRAINT `".PREFIX."coupon_products_ibfk_3` FOREIGN KEY (`idProduct`) REFERENCES `".PREFIX."product` (`idproduct`) ON DELETE CASCADE;";
$query2="ALTER TABLE `".PREFIX."product`
  ADD CONSTRAINT `".PREFIX."product_ibfk_1` FOREIGN KEY (`idCategory`) REFERENCES `".PREFIX."category` (`idCategory`) ON DELETE CASCADE;";
$query3="ALTER TABLE `".PREFIX."product_options`
  ADD CONSTRAINT `".PREFIX."product_options_ibfk_1` FOREIGN KEY (`idOption`) REFERENCES `".PREFIX."options` (`idOption`) ON DELETE CASCADE,
  ADD CONSTRAINT `".PREFIX."product_options_ibfk_2` FOREIGN KEY (`idProduct`) REFERENCES `".PREFIX."product` (`idproduct`) ON DELETE CASCADE;";

?>