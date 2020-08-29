-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2020 at 07:02 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookmeal_v1`
--

-- --------------------------------------------------------

--
-- Table structure for table `activation_keys`
--

CREATE TABLE `activation_keys` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `activation_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `job_title`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'Admin', '$2y$10$ZV6XedAeyrm6lawBrT4lNOoEjqdEZR81hnnREPIPlos3aYUvzx0vy', '1BMKyMgCNkGsoILcfwxGq8mXCwPHVJ6Y8LoD7LEAHFceCTv7ImTReu1TjfRV', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `meta_title` varchar(65) DEFAULT NULL,
  `meta_keyword` varchar(160) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `featured` int(1) DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `name`, `slug`, `description`, `image`, `meta_title`, `meta_keyword`, `meta_description`, `status`, `featured`, `created_at`, `updated_at`) VALUES
(4, 'ADD BLOG ADD BLOG ADD BLOG ADD BLOG', 'add-blog-add-blog-add-blog-add-blog', '<p><span style=\"color:rgb(117, 117, 117); font-family:open sans,sans-serif; font-size:16px\">ADD BLOGADD BLOGADD BLOGADD BLOGADD BLOGADD BLOGADD BLOGADD BLOGADD BLOG</span></p>', '15459170385c24d26ea2008.jpg', 'test', 'test', '<p>test</p>', 1, 1, '2018-11-19 10:41:06', '2018-12-27 13:24:46');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `payment_status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `product_name`, `qty`, `payment_status`, `created_at`, `updated_at`) VALUES
(7, '1', 18, NULL, 5, 0, '2019-03-25 13:28:51', '2019-03-27 05:51:42');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `start_time`, `end_time`, `image`, `status`, `featured`, `meta_title`, `meta_keyword`, `meta_description`, `created_at`, `updated_at`) VALUES
(7, 0, 'menu', 'menu', '00:00:00', '00:00:00', '15367471195b98e66f9e6fb.jpg', 1, 1, NULL, NULL, NULL, '2020-08-23 07:20:36', '2020-08-23 07:20:36'),
(10, 7, 'GRILLS AND KEBABS', 'grills-and-kebabs', '04:00:00', '13:00:00', '15983293815f449225a4e03.jpg', 1, 0, 'Breakfast', 'Breakfast', 'Breakfast', '2020-08-25 04:23:11', '2020-08-25 04:23:11'),
(11, 7, 'MAINS  VEGETERIAN', 'mains-vegeterian', '13:00:00', '17:00:00', '15983294565f4492709be9b.jpg', 1, 0, 'Lunch', 'Lunch', 'lunchdescription', '2020-08-26 06:27:45', '2020-08-26 06:27:45'),
(16, 7, 'MAINS  NON VEG.', 'mains-non-veg-', '17:00:00', '23:30:00', '15983295055f4492a1c1f3f.jpg', 1, 0, 'Dinner', 'dinner', 'dinner', '2020-08-26 06:27:34', '2020-08-26 06:27:34'),
(17, 7, 'ACCOMPAINTMENTS', 'accompaintments', '00:00:00', '00:00:00', '15983292445f44919cd4c53.jpg', 1, 0, 'd', NULL, NULL, '2020-08-25 04:25:39', '2020-08-25 04:25:39'),
(18, 7, 'APPETISERS', 'appetisers-24806041', '00:00:00', '00:00:00', '15983293195f4491e74dd2d.jpg', 1, 0, NULL, NULL, NULL, '2020-08-24 22:52:05', '2020-08-25 04:22:05');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `featured` int(1) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `title`, `image`, `url`, `featured`, `status`, `created_at`, `updated_at`) VALUES
(3, 'test1', '15459195865c24dc62da566.png', 'test', 1, 1, '2018-12-27 14:06:32', '2018-12-27 14:06:32'),
(4, 'test2', '15459196155c24dc7fa1dac.png', 'test', 1, 1, '2018-12-27 14:07:01', '2018-12-27 14:07:01'),
(5, 'test3', '15459196365c24dc947a1b4.png', 'test', 1, 1, '2018-12-27 14:07:21', '2018-12-27 14:07:21'),
(6, 'test4', '15459196665c24dcb24a6d4.png', 'test', 1, 1, '2018-12-27 14:07:51', '2018-12-27 14:07:51'),
(7, 'test5', '15459196875c24dcc73059f.png', 'test', 1, 1, '2018-12-27 14:08:11', '2018-12-27 14:09:11'),
(8, 'test6', '15459197105c24dcdef0558.png', 'google', 1, 1, '2018-12-27 14:08:52', '2020-05-03 11:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `message`, `created_at`, `updated_at`) VALUES
(1, 'john', 'jone@gmail.com', '8963824028', 'test message', '2018-12-20 08:36:37', '2018-12-20 08:36:37'),
(2, 'neeraj', 'rawat.neeraj.510@gmail.com', '8963824028', 'Hello please contact us on  my number', '2019-01-21 12:09:31', '2019-01-21 12:09:31'),
(3, 'as', 'dfgd@gmail.com', NULL, NULL, '2020-08-24 04:51:16', '2020-08-24 04:51:16'),
(4, 'fsdg', 'asfdds@gmail.com', '54545245', 'cvfbhfg', '2020-08-24 04:52:43', '2020-08-24 04:52:43');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AX', 'Aland Islands'),
(3, 'AL', 'Albania'),
(4, 'DZ', 'Algeria'),
(5, 'AS', 'American Samoa'),
(6, 'AD', 'Andorra'),
(7, 'AO', 'Angola'),
(8, 'AI', 'Anguilla'),
(9, 'AQ', 'Antarctica'),
(10, 'AG', 'Antigua and Barbuda'),
(11, 'AR', 'Argentina'),
(12, 'AM', 'Armenia'),
(13, 'AW', 'Aruba'),
(14, 'AU', 'Australia'),
(15, 'AT', 'Austria'),
(16, 'AZ', 'Azerbaijan'),
(17, 'BS', 'Bahamas'),
(18, 'BH', 'Bahrain'),
(19, 'BD', 'Bangladesh'),
(20, 'BB', 'Barbados'),
(21, 'BY', 'Belarus'),
(22, 'BE', 'Belgium'),
(23, 'BZ', 'Belize'),
(24, 'BJ', 'Benin'),
(25, 'BM', 'Bermuda'),
(26, 'BT', 'Bhutan'),
(27, 'BO', 'Bolivia'),
(28, 'BA', 'Bosnia and Herzegovina'),
(29, 'BW', 'Botswana'),
(30, 'BV', 'Bouvet Island'),
(31, 'BR', 'Brazil'),
(32, 'IO', 'British Indian Ocean Territory'),
(33, 'BN', 'Brunei Darussalam'),
(34, 'BG', 'Bulgaria'),
(35, 'BF', 'Burkina Faso'),
(36, 'BI', 'Burundi'),
(37, 'KH', 'Cambodia'),
(38, 'CM', 'Cameroon'),
(39, 'CA', 'Canada'),
(40, 'CV', 'Cape Verde'),
(41, 'KY', 'Cayman Islands'),
(42, 'CF', 'Central African Republic'),
(43, 'TD', 'Chad'),
(44, 'CL', 'Chile'),
(45, 'CN', 'China'),
(46, 'CX', 'Christmas Island'),
(47, 'CC', 'Cocos (Keeling) Islands'),
(48, 'CO', 'Colombia'),
(49, 'KM', 'Comoros'),
(50, 'CG', 'Congo'),
(51, 'CD', 'The Democratic Republic of The Congo'),
(52, 'CK', 'Cook Islands'),
(53, 'CR', 'Costa Rica'),
(54, 'HR', 'Croatia'),
(55, 'CU', 'Cuba'),
(56, 'CY', 'Cyprus'),
(57, 'CZ', 'Czech Republic'),
(58, 'DK', 'Denmark'),
(59, 'DJ', 'Djibouti'),
(60, 'DM', 'Dominica'),
(61, 'DO', 'Dominican Republic'),
(62, 'EC', 'Ecuador'),
(63, 'EG', 'Egypt'),
(64, 'SV', 'El Salvador'),
(65, 'GQ', 'Equatorial Guinea'),
(66, 'ER', 'Eritrea'),
(67, 'EE', 'Estonia'),
(68, 'ET', 'Ethiopia'),
(69, 'FK', 'Falkland Islands (Malvinas)'),
(70, 'FO', 'Faroe Islands'),
(71, 'FJ', 'Fiji'),
(72, 'FI', 'Finland'),
(73, 'FR', 'France'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GR', 'Greece'),
(84, 'GL', 'Greenland'),
(85, 'GD', 'Grenada'),
(86, 'GP', 'Guadeloupe'),
(87, 'GU', 'Guam'),
(88, 'GT', 'Guatemala'),
(89, 'GG', 'Guernsey'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard Island and Mcdonald Islands'),
(95, 'VA', 'Holy See (Vatican City State)'),
(96, 'HN', 'Honduras'),
(97, 'HK', 'Hong Kong'),
(98, 'HU', 'Hungary'),
(99, 'IS', 'Iceland'),
(100, 'IN', 'India'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IM', 'Isle of Man'),
(106, 'IL', 'Israel'),
(107, 'IT', 'Italy'),
(108, 'JM', 'Jamaica'),
(109, 'JP', 'Japan'),
(110, 'JE', 'Jersey'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KR', 'Republic of Korea'),
(116, 'KW', 'Kuwait'),
(117, 'KG', 'Kyrgyzstan'),
(118, 'LA', 'Lao Peoples Democratic Republic'),
(119, 'LV', 'Latvia'),
(120, 'LB', 'Lebanon'),
(121, 'LS', 'Lesotho'),
(122, 'LR', 'Liberia'),
(123, 'LY', 'Libya'),
(124, 'LI', 'Liechtenstein'),
(125, 'LT', 'Lithuania'),
(126, 'LU', 'Luxembourg'),
(127, 'MO', 'Macao'),
(128, 'MK', 'Macedonia'),
(129, 'MG', 'Madagascar'),
(130, 'MW', 'Malawi'),
(131, 'MY', 'Malaysia'),
(132, 'MV', 'Maldives'),
(133, 'ML', 'Mali'),
(134, 'MT', 'Malta'),
(135, 'MH', 'Marshall Islands'),
(136, 'MQ', 'Martinique'),
(137, 'MR', 'Mauritania'),
(138, 'MU', 'Mauritius'),
(139, 'YT', 'Mayotte'),
(140, 'MX', 'Mexico'),
(141, 'FM', 'Micronesia'),
(142, 'MD', 'Moldova'),
(143, 'MC', 'Monaco'),
(144, 'MN', 'Mongolia'),
(145, 'ME', 'Montenegro'),
(146, 'MS', 'Montserrat'),
(147, 'MA', 'Morocco'),
(148, 'MZ', 'Mozambique'),
(149, 'MM', 'Myanmar'),
(150, 'NA', 'Namibia'),
(151, 'NR', 'Nauru'),
(152, 'NP', 'Nepal'),
(153, 'NL', 'Netherlands'),
(154, 'AN', 'Netherlands Antilles'),
(155, 'NC', 'New Caledonia'),
(156, 'NZ', 'New Zealand'),
(157, 'NI', 'Nicaragua'),
(158, 'NE', 'Niger'),
(159, 'NG', 'Nigeria'),
(160, 'NU', 'Niue'),
(161, 'NF', 'Norfolk Island'),
(162, 'MP', 'Northern Mariana Islands'),
(163, 'NO', 'Norway'),
(164, 'OM', 'Oman'),
(165, 'PK', 'Pakistan'),
(166, 'PW', 'Palau'),
(167, 'PS', 'Palestinia'),
(168, 'PA', 'Panama'),
(169, 'PG', 'Papua New Guinea'),
(170, 'PY', 'Paraguay'),
(171, 'PE', 'Peru'),
(172, 'PH', 'Philippines'),
(173, 'PN', 'Pitcairn'),
(174, 'PL', 'Poland'),
(175, 'PT', 'Portugal'),
(176, 'PR', 'Puerto Rico'),
(177, 'QA', 'Qatar'),
(178, 'RE', 'Reunion'),
(179, 'RO', 'Romania'),
(180, 'RU', 'Russian Federation'),
(181, 'RW', 'Rwanda'),
(182, 'SH', 'Saint Helena'),
(183, 'KN', 'Saint Kitts and Nevis'),
(184, 'LC', 'Saint Lucia'),
(185, 'PM', 'Saint Pierre and Miquelon'),
(186, 'VC', 'Saint Vincent and The Grenadines'),
(187, 'WS', 'Samoa'),
(188, 'SM', 'San Marino'),
(189, 'ST', 'Sao Tome and Principe'),
(190, 'SA', 'Saudi Arabia'),
(191, 'SN', 'Senegal'),
(192, 'RS', 'Serbia'),
(193, 'SC', 'Seychelles'),
(194, 'SL', 'Sierra Leone'),
(195, 'SG', 'Singapore'),
(196, 'SK', 'Slovakia'),
(197, 'SI', 'Slovenia'),
(198, 'SB', 'Solomon Islands'),
(199, 'SO', 'Somalia'),
(200, 'ZA', 'South Africa'),
(201, 'SS', 'South Sudan'),
(202, 'GS', 'South Georgia and The South Sandwich Islands'),
(203, 'ES', 'Spain'),
(204, 'LK', 'Sri Lanka'),
(205, 'SD', 'Sudan'),
(206, 'SR', 'Suriname'),
(207, 'SJ', 'Svalbard and Jan Mayen'),
(208, 'SZ', 'Swaziland'),
(209, 'SE', 'Sweden'),
(210, 'CH', 'Switzerland'),
(211, 'SY', 'Syrian Arab Republic'),
(212, 'TW', 'Taiwan, Province of China'),
(213, 'TJ', 'Tajikistan'),
(214, 'TZ', 'Tanzania, United Republic of'),
(215, 'TH', 'Thailand'),
(216, 'TL', 'Timor-leste'),
(217, 'TG', 'Togo'),
(218, 'TK', 'Tokelau'),
(219, 'TO', 'Tonga'),
(220, 'TT', 'Trinidad and Tobago'),
(221, 'TN', 'Tunisia'),
(222, 'TR', 'Turkey'),
(223, 'TM', 'Turkmenistan'),
(224, 'TC', 'Turks and Caicos Islands'),
(225, 'TV', 'Tuvalu'),
(226, 'UG', 'Uganda'),
(227, 'UA', 'Ukraine'),
(228, 'AE', 'United Arab Emirates'),
(229, 'GB', 'United Kingdom'),
(230, 'US', 'United States'),
(231, 'UM', 'United States Minor Outlying Islands'),
(232, 'UY', 'Uruguay'),
(233, 'UZ', 'Uzbekistan'),
(234, 'VU', 'Vanuatu'),
(235, 'VE', 'Venezuela'),
(236, 'VN', 'Vietnam'),
(237, 'VG', 'Virgin Islands, British'),
(238, 'VI', 'Virgin Islands, U.S.'),
(239, 'WF', 'Wallis and Futuna'),
(240, 'EH', 'Western Sahara'),
(241, 'YE', 'Yemen'),
(242, 'ZM', 'Zambia'),
(243, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `couponcodes`
--

CREATE TABLE `couponcodes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `start_date` date DEFAULT NULL,
  `coupon_count` int(11) DEFAULT NULL,
  `apply_for` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `use_code_times` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `coupon_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `couponcodes`
--

INSERT INTO `couponcodes` (`id`, `name`, `description`, `start_date`, `coupon_count`, `apply_for`, `code`, `use_code_times`, `group_id`, `expire_date`, `coupon_type`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(4, 'test', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries', '2019-02-20', 21, 'category', 'TTT', 21, 1, '2019-03-31', 'percentage', '32', 1, '2018-09-20 09:18:42', '2019-03-25 14:05:35'),
(8, 'fsdf', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries', '2019-02-01', 33, 'product', 'TTO', 3, 1, '2019-03-11', 'amount', '33', 1, '2018-12-04 14:28:12', '2019-02-25 11:07:20'),
(9, 'YTER', 'onditionsconditioconditionsconditionsconditionsconditionsconditionsconditions', '2019-02-08', 10, 'product', 'YTER50', 2, 0, '2019-03-30', 'percentage', '20', 1, '2019-02-25 09:49:14', '2019-03-25 10:39:59');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_items`
--

CREATE TABLE `coupon_items` (
  `id` int(11) NOT NULL,
  `apply_for` varchar(255) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `couponcode_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupon_items`
--

INSERT INTO `coupon_items` (`id`, `apply_for`, `product_id`, `category_id`, `couponcode_id`, `created_at`, `updated_at`) VALUES
(24, 'product', 11, NULL, 8, '2019-02-25 11:07:20', '2019-02-25 11:07:20'),
(25, 'product', 16, NULL, 8, '2019-02-25 11:07:20', '2019-02-25 11:07:20'),
(29, 'product', 18, NULL, 9, '2019-03-25 10:40:00', '2019-03-25 10:40:00'),
(31, 'category', NULL, 11, 4, '2019-03-25 14:05:35', '2019-03-25 14:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text,
  `type` varchar(10) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `name`, `subject`, `message`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Template Name', 'New User Register', '<p>hi&nbsp;</p>\r\n\r\n<p>A new user register&nbsp;</p>\r\n\r\n<p>User details is:</p>\r\n\r\n<p><span style=\"font-family:source sans pro,helvetica neue,helvetica,arial,sans-serif; font-size:14px\">Name:- #CUSTOMER_FNAME #CUSTOMER_LNAME</span></p>\r\n\r\n<p><span style=\"font-family:source sans pro,helvetica neue,helvetica,arial,sans-serif; font-size:14px\">Email:-&nbsp;&nbsp;#CUSTOMER_EMAIL</span></p>\r\n\r\n<p>Phone No:-&nbsp;<span style=\"font-family:source sans pro,helvetica neue,helvetica,arial,sans-serif; font-size:14px\">#CUSTOMER_PHONE</span></p>\r\n\r\n<p><span style=\"font-family:source sans pro,helvetica neue,helvetica,arial,sans-serif; font-size:14px\">Thanks&nbsp;</span></p>\r\n\r\n<p>&nbsp;</p>', 'admin', 1, '2018-12-21 10:43:09', '2018-12-21 12:37:36'),
(2, 'User', 'Register', '<p>Hi ,<span style=\"font-family:source sans pro,helvetica neue,helvetica,arial,sans-serif; font-size:14px\">#CUSTOMER_USERNAME</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><font face=\"source sans pro, helvetica neue, helvetica, arial, sans-serif\"><span style=\"font-size:14px\">Your Login detail is:</span></font></p>\r\n\r\n<p>Email:-&nbsp;<span style=\"font-family:source sans pro,helvetica neue,helvetica,arial,sans-serif; font-size:14px\">#CUSTOMER_EMAIL</span></p>\r\n\r\n<p>Password:-&nbsp;<span style=\"font-family:source sans pro,helvetica neue,helvetica,arial,sans-serif; font-size:14px\">#CUSTOMER_PASSWORD</span></p>', 'user', 1, '2018-12-21 12:39:41', '2018-12-21 12:39:41'),
(3, 'Forgot Password', 'Forgot Password', '<p>hi ,&nbsp;<span style=\"font-family:source sans pro,helvetica neue,helvetica,arial,sans-serif; font-size:14px\">#CUSTOMER_USERNAME</span></p>\r\n\r\n<p>Your Login detail is :-</p>\r\n\r\n<p>Email :-&nbsp;<span style=\"font-family:source sans pro,helvetica neue,helvetica,arial,sans-serif; font-size:14px\">#CUSTOMER_EMAIL</span></p>\r\n\r\n<p><span style=\"font-family:source sans pro,helvetica neue,helvetica,arial,sans-serif; font-size:14px\">Password :&nbsp;#CUSTOMER_PASSWORD</span></p>\r\n\r\n<p><span style=\"font-family:source sans pro,helvetica neue,helvetica,arial,sans-serif; font-size:14px\">Thanks&nbsp;</span></p>', 'user', 1, '2019-01-10 14:08:49', '2019-01-10 14:08:49'),
(4, 'Order Summary', 'Order Summary', '<p>Thanks for ordering food , <span style=\"font-family:source sans pro,helvetica neue,helvetica,arial,sans-serif; font-size:14px\">#CUSTOMER_USERNAME</span><br />\r\nWe hope you enjoyed your meal . You can write them a review by clicking here.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:source sans pro,helvetica neue,helvetica,arial,sans-serif; font-size:14px\">#CUSTOMER_ORDER_SUMMARY</span></p>', 'user', 1, '2019-01-11 07:35:20', '2019-01-11 07:35:20');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `category_id` int(11) NOT NULL,
  `feature_group_id` int(11) NOT NULL,
  `is_filter` int(1) UNSIGNED DEFAULT '0',
  `is_required` tinyint(1) NOT NULL DEFAULT '0',
  `slug` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'string',
  `display_text` text,
  `is_option` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int(2) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`, `category_id`, `feature_group_id`, `is_filter`, `is_required`, `slug`, `type`, `display_text`, `is_option`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(6, 'tsfu ibniksb mbn infdin', 3, 3, 0, 0, 'tsfu-ibniksb-mbn-infdin', 'multiselect', NULL, 0, 0, 1, '2018-08-20 10:01:46', '2018-08-22 12:42:53'),
(8, 'aaa', 3, 3, 0, 0, 'aaa', 'singleselect', NULL, 0, 0, 1, '2018-08-23 06:03:11', '2018-08-23 06:03:11'),
(9, 'eewsde', 3, 3, 0, 0, 'eewsde', 'text', NULL, 0, 0, 1, '2018-08-23 07:00:28', '2018-08-23 07:00:28'),
(10, 'fxdgfg', 3, 6, 0, 0, 'fxdgfg', 'singleselect', NULL, 0, 0, 1, '2018-08-29 07:24:51', '2018-08-29 07:24:51');

-- --------------------------------------------------------

--
-- Table structure for table `feature_groups`
--

CREATE TABLE `feature_groups` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feature_groups`
--

INSERT INTO `feature_groups` (`id`, `category_id`, `name`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(3, 3, 'teret', 0, 1, '2018-08-21 10:41:16', '2018-08-23 05:57:23'),
(4, 4, 'rre', 0, 1, '2018-08-21 10:54:41', '2018-08-21 11:16:13'),
(6, 3, 'test', 0, 1, '2018-08-23 06:07:51', '2018-08-23 10:56:08');

-- --------------------------------------------------------

--
-- Table structure for table `feature_values`
--

CREATE TABLE `feature_values` (
  `id` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL,
  `value` varchar(150) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feature_values`
--

INSERT INTO `feature_values` (`id`, `feature_id`, `value`, `created_at`, `updated_at`) VALUES
(36, 6, 'zxcvb', '2018-08-21 06:54:33', '2018-08-21 06:54:33'),
(37, 6, 'xvcbcxvb', '2018-08-21 06:54:33', '2018-08-21 06:54:33'),
(38, 6, 'xcvbxcvbcvb', '2018-08-21 06:54:33', '2018-08-21 06:54:33'),
(39, 6, 'tew', '2018-08-21 06:55:05', '2018-08-21 06:55:05'),
(40, 6, 'ssss', '2018-08-21 06:55:05', '2018-08-21 06:55:05'),
(41, 8, 'rest', '2018-08-23 06:30:43', '2018-08-23 06:30:43'),
(42, 8, 'Host', '2018-08-23 06:30:53', '2018-08-23 06:30:53'),
(43, 10, 'sdfcdfgd', '2018-08-29 07:25:11', '2018-08-29 07:25:11'),
(44, 10, 'dfvdfhfgh', '2018-08-29 07:25:11', '2018-08-29 07:25:11');

-- --------------------------------------------------------

--
-- Table structure for table `franchises`
--

CREATE TABLE `franchises` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `franchises`
--

INSERT INTO `franchises` (`id`, `name`, `email`, `password`, `phone`, `address`, `status`, `remember_token`, `meta_title`, `meta_keyword`, `meta_description`, `created_at`, `updated_at`) VALUES
(2, 'saasfddf', 'manager@gmail.com', '$2y$10$.6EjYYwbGo8XZRKKUCx8dezWW4H4VPDHU3y/lVg9mI.s8S7c8643.', '8963824028', 'tesfedfsdf', 0, 'DA70c02bFaY0bJviUPmypdsDI16ZXSFBaSC3BKlGfZmf5aItz1YuVJxCgja6', '', '', '', '2018-09-17 06:35:20', '2018-09-17 06:35:20'),
(3, 'Test', 'Testrt@gmail.com', '$2y$10$ZV6XedAeyrm6lawBrT4lNOoEjqdEZR81hnnREPIPlos3aYUvzx0vy', '896382401', '165anji', 1, '73V09eiGX7qkGRkqzfv2TeO1twzsojtHzHuzlpxCFFOX0fur7YHE2WGFuUK0', '', '', '', '2018-09-20 08:01:20', '2018-09-21 01:11:26');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'user', 1, '2018-09-19 06:53:45', '2018-09-19 06:55:01'),
(2, 'Cool', 1, '2019-02-25 09:48:01', '2019-02-25 09:48:01');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(11, '2014_10_12_000000_create_users_table', 1),
(12, '2014_10_12_100000_create_password_resets_table', 2),
(13, '2018_08_03_063155_create_activation_keys_table', 3),
(14, '2018_08_06_064339_create_admins_table', 4),
(17, '2018_08_08_072844_create_categories_table', 5),
(18, '2018_08_10_072118_create_products_table', 6),
(19, '2018_08_14_114203_create_countries_table', 7),
(20, '2018_08_17_100324_create_product_images_table', 8),
(21, '2018_08_19_125916_create_features_table', 9),
(23, '2018_09_13_091828_create_postcodes_table', 11),
(24, '2018_09_12_103737_create_franchises_table', 12),
(25, '2018_09_17_121432_create_settings_table', 13),
(26, '2018_09_18_092126_create_groups_table', 14),
(27, '2018_09_19_141947_create_couponcodes_table', 15),
(28, '2018_10_10_054417_create_sliders_table', 16),
(29, '2018_10_11_062301_create_popups_table', 17),
(30, '2018_10_25_054227_create_carts_table', 18);

-- --------------------------------------------------------

--
-- Table structure for table `news_letters`
--

CREATE TABLE `news_letters` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news_letters`
--

INSERT INTO `news_letters` (`id`, `email`, `created_at`, `updated_at`) VALUES
(3, 'rawat@gmail.com', '2018-12-17 05:48:23', '2018-12-17 05:48:23'),
(4, 'admin@gmail.com', '2018-12-17 07:29:22', '2018-12-17 07:29:22'),
(5, 'xfag@gmail.com', '2020-08-24 05:21:31', '2020-08-24 05:21:31');

-- --------------------------------------------------------

--
-- Table structure for table `opening_times`
--

CREATE TABLE `opening_times` (
  `id` int(11) NOT NULL,
  `setting_id` int(11) DEFAULT NULL,
  `day_name` varchar(255) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `is_close` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `opening_times`
--

INSERT INTO `opening_times` (`id`, `setting_id`, `day_name`, `start_time`, `end_time`, `is_close`, `created_at`, `updated_at`) VALUES
(64, 1, 'monday', '01:00:00', '12:00:00', 1, '2020-08-29 04:57:57', '2020-08-29 04:57:57'),
(65, 1, 'tuesday', '00:00:00', '22:00:00', 1, '2020-08-29 04:57:57', '2020-08-29 04:57:57'),
(66, 1, 'wednesday', '02:00:00', '22:00:00', 1, '2020-08-29 04:57:58', '2020-08-29 04:57:58'),
(67, 1, 'thursday', '02:00:00', '20:00:00', 0, '2020-08-29 04:57:58', '2020-08-29 04:57:58'),
(68, 1, 'friday', '11:00:00', '22:00:00', 0, '2020-08-29 04:57:58', '2020-08-29 04:57:58'),
(69, 1, 'saturday', '04:00:00', '23:00:00', 0, '2020-08-29 04:57:58', '2020-08-29 04:57:58'),
(70, 1, 'sunday', '04:00:00', '23:00:00', 0, '2020-08-29 04:57:58', '2020-08-29 04:57:58');

-- --------------------------------------------------------

--
-- Table structure for table `open_hours`
--

CREATE TABLE `open_hours` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `sort_number` int(11) DEFAULT '0',
  `status` int(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `open_hours`
--

INSERT INTO `open_hours` (`id`, `title`, `start_time`, `end_time`, `sort_number`, `status`, `created_at`, `updated_at`, `type`, `text`) VALUES
(1, 'Monday - Friday', '09:00:00', '12:00:00', 1, 1, '2018-12-26 00:00:00', '2018-12-26 00:00:00', NULL, NULL),
(2, 'Saturday - Sunday', '00:00:00', '00:00:00', 1, 1, '2018-12-26 00:00:00', '2018-12-26 00:00:00', NULL, NULL),
(3, 'Breakfast', '07:00:00', '00:00:00', 1, 1, '2018-12-26 00:00:00', '2018-12-26 00:00:00', NULL, NULL),
(4, 'dsfsfssdf', '00:00:00', '00:00:00', NULL, 1, '2018-12-27 12:35:12', '2018-12-27 12:35:12', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_number` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `product_ids` varchar(255) DEFAULT NULL,
  `total_qty` int(11) DEFAULT NULL,
  `total_amount` float DEFAULT NULL,
  `order_status` varchar(50) DEFAULT 'Order Confirmed',
  `payment_status` varchar(255) DEFAULT 'failed',
  `assign_staff_id` int(11) DEFAULT '0',
  `user_address_id` int(11) DEFAULT '0',
  `delivery_address` varchar(255) DEFAULT NULL,
  `delivery_postcode` varchar(255) DEFAULT NULL,
  `delivery_phone` varchar(255) DEFAULT NULL,
  `tax_amount` varchar(255) DEFAULT NULL,
  `maintotal` varchar(255) DEFAULT NULL,
  `shippingamount` varchar(255) DEFAULT NULL,
  `shipping_type` varchar(255) DEFAULT NULL,
  `tax_percentage` varchar(25) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL,
  `coupon_discount` varchar(255) DEFAULT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `coupon_type` varchar(255) DEFAULT NULL,
  `coupon_amount` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `payment_id`, `product_ids`, `total_qty`, `total_amount`, `order_status`, `payment_status`, `assign_staff_id`, `user_address_id`, `delivery_address`, `delivery_postcode`, `delivery_phone`, `tax_amount`, `maintotal`, `shippingamount`, `shipping_type`, `tax_percentage`, `subtotal`, `coupon_discount`, `coupon_code`, `coupon_type`, `coupon_amount`, `created_at`, `updated_at`) VALUES
(18, 'OG35717', 1, 'PAYID-LRHJQEY7HF96730YK517750Y', 'a:2:{i:19;i:19;i:11;i:11;}', 2, 32.88, 'Order Confirmed', 'approved', 0, 0, 'aasasdas', '22222', '65262652152', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-28 05:51:36', '2019-01-28 05:51:36'),
(19, 'VX99681', 1, 'PAYID-LRHJVKY4BY4649756308350G', 'a:2:{i:21;i:21;i:17;i:17;}', 2, 67.09, 'Food Pack and Assign', 'approved', 0, 0, 'aasasdas', '22222', '65262652152', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-28 06:22:22', '2019-01-28 06:24:35'),
(20, 'VZ50622', 1, 'PAYID-LRRF4UA30T215175N3022417', 'a:2:{i:18;i:18;i:22;i:22;}', 6, 209.98, 'Order Confirmed', 'approved', 0, 0, 'aasasdas', '22222', '65262652152', '1.98', '209.98', '10', 'Paid', '1', NULL, NULL, NULL, NULL, NULL, '2019-02-12 05:58:23', '2019-02-12 05:58:23'),
(21, 'MY16123', 1, 'PAYID-LRRGMBI21U35667RV082842W', 'a:1:{i:11;i:11;}', 1, 10.1, 'Order Confirmed', 'approved', 0, 0, 'aasasdas', '22222', '65262652152', '0.001', '10.100999999999999', '10', 'Paid', '1', NULL, NULL, NULL, NULL, NULL, '2019-02-12 06:23:49', '2019-02-12 06:23:49'),
(22, 'WT20397', 1, 'PAYID-LRRGOBI75448188YV5618044', 'a:1:{i:17;i:17;}', 1, 44.65, 'Order Confirmed', 'approved', 0, 0, 'aasasdas', '22222', '65262652152', '0.3431', '44.6531', '10', 'Paid', '1', NULL, NULL, NULL, NULL, NULL, '2019-02-12 06:26:36', '2019-02-12 06:26:36'),
(23, 'FZ78125', 1, 'PAYID-LRRGPBQ9UJ01172SW568810X', 'a:1:{i:23;i:23;}', 1, 43.11, 'Order Confirmed', 'approved', 0, 0, 'aasasdas', '22222', '65262652152', '0.32780000000000004', '43.107800000000005', '10', 'Paid', '1', '32.78', NULL, NULL, NULL, NULL, '2019-02-12 06:28:50', '2019-02-12 06:28:50'),
(24, 'BC09974', 1, 'PAYID-LRRGYMI9N132714AB702035R', 'a:1:{i:18;i:18;}', 1, 43.33, 'Order Confirmed', 'approved', 0, 0, 'aasasdas', '22222', '65262652152', '0.33', '43.33', '10', 'Paid', '1', '33', NULL, NULL, NULL, NULL, '2019-02-12 06:49:15', '2019-02-12 06:49:15'),
(25, 'GB93219', 1, 'PAYID-LRZ62UQ1KF05653M9503050G', 'a:2:{i:11;i:11;i:18;i:18;}', 7, 10.94, 'Order Confirmed', 'approved', 0, 0, 'aasasdas', '22222', '65262652152', '0.336', '10.936', '10', 'Paid', '1', '33.6', '33', NULL, NULL, NULL, '2019-02-25 13:28:27', '2019-02-25 13:28:27'),
(26, 'MM55119', 1, 'PAYID-LR2N24Q6463763102031124V', 'a:1:{i:20;i:20;}', 1, 11.33, 'Order Confirmed', 'approved', 0, 0, 'aasasdas', '22222', '65262652152', '0.33', '11.329999999999998', '10', 'Paid', '1', '33', '32', NULL, NULL, NULL, '2019-02-26 06:32:52', '2019-02-26 06:32:52'),
(27, 'JL12060', 1, 'PAYID-LR3FASY71M16522MC327781T', 'a:2:{i:18;i:18;i:11;i:11;}', 8, 77.5, 'Order Confirmed', 'approved', 0, 0, 'aasasdas', '22222', '65262652152', '0.995', '77.495', '10', 'Paid', '1', '99.5', '33', NULL, NULL, NULL, '2019-02-27 08:55:18', '2019-02-27 08:55:18'),
(28, 'CD89090', 1, 'PAYID-LSDACSQ64H68272UA740503B', 'a:1:{i:23;i:23;}', 1, 36.55, 'Order Confirmed', 'approved', 0, 0, 'aasasdas', '22222', '65262652152', '0.32780000000000004', '36.55180000000001', '10', 'Paid', '1', '32.78', '6.556', NULL, NULL, NULL, '2019-03-11 06:39:32', '2019-03-11 06:39:32'),
(29, 'QF84914', 1, 'PAYID-LSMLMAI7TM10258VF655190L', 'a:1:{i:18;i:18;}', 10, 277.3, 'Order Confirmed', 'approved', 0, 0, 'aasasdas', '22222', '65262652152', '3.3', '277.3', '10', 'Paid', '1', '330', '66', 'YTER50', 'percentage', '20', '2019-03-25 11:07:38', '2019-03-25 11:07:38'),
(30, 'QV63746', 1, 'PAYID-LSMM45Q7AG80171NY229412Y', 'a:1:{i:18;i:18;}', 1, 32.77, 'Order Confirmed', 'approved', 0, 0, 'aasasdas', '22222', '65262652152', '0.33', '32.769999999999996', '10', 'Paid', '1', '33', '10.56', 'TTT', 'percentage', '32', '2019-03-25 12:50:43', '2019-03-25 12:50:43'),
(31, 'JP78181', 1, 'PAYID-LSMNIPA6JF244931W916504E', 'a:1:{i:18;i:18;}', 1, 32.77, 'Order Confirmed', 'approved', 0, 0, 'aasasdas', '22222', '65262652152', '0.33', '32.769999999999996', '10', 'Paid', '1', '33', '10.56', 'TTT', 'percentage', '32', '2019-03-25 13:16:02', '2019-03-25 13:16:02');

-- --------------------------------------------------------

--
-- Table structure for table `order_complaints`
--

CREATE TABLE `order_complaints` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_number` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `problem` text,
  `user_type` varchar(11) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_complaints`
--

INSERT INTO `order_complaints` (`id`, `user_id`, `order_number`, `subject`, `problem`, `user_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'PN35711', 'test complaint', 'i paid for this product but didn\'t get it', 'customer', 1, '2018-12-18 07:23:16', '2018-12-18 07:23:40'),
(2, 1, 'PN35711', 'this is new complaint', 'hey i ordered a food but i didn\'t it yet', 'customer', 0, '2018-12-21 15:15:09', '2018-12-21 15:15:09'),
(3, 1, 'PN35711', '', 'hello', 'admin', 0, '2018-12-21 15:18:19', '2018-12-21 15:18:19');

-- --------------------------------------------------------

--
-- Table structure for table `order_delivery_status`
--

CREATE TABLE `order_delivery_status` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `order_status` varchar(50) DEFAULT NULL,
  `order_status_type` varchar(20) DEFAULT 'confirmed',
  `user_type` varchar(20) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_delivery_status`
--

INSERT INTO `order_delivery_status` (`id`, `order_id`, `order_status`, `order_status_type`, `user_type`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 4, 'Order Confirmed', 'confirmed', 'admin', 1, '2018-12-31 10:25:59', '2018-12-31 10:25:59'),
(2, 4, 'Food Pack and Assign', 'assign_staff', 'staff', 3, '2018-12-31 10:29:44', '2018-12-31 10:29:44'),
(3, 4, 'Out For Delivery', 'out_for_delivery', 'staff', 3, '2019-01-02 07:28:41', '2019-01-02 07:28:41'),
(4, 4, 'Delivered', 'delivered', 'staff', 3, '2019-01-02 07:34:09', '2019-01-02 07:34:09'),
(5, 5, 'Order Confirmed', 'confirmed', 'admin', 1, '2019-01-25 09:33:05', '2019-01-25 09:33:05'),
(6, 6, 'Order Confirmed', 'confirmed', 'admin', 1, '2019-01-25 09:49:21', '2019-01-25 09:49:21'),
(7, 7, 'Order Confirmed', 'confirmed', 'admin', 1, '2019-01-25 09:49:26', '2019-01-25 09:49:26'),
(8, 8, 'Order Confirmed', 'confirmed', 'admin', 1, '2019-01-25 10:04:11', '2019-01-25 10:04:11'),
(9, 9, 'Order Confirmed', 'confirmed', 'admin', 1, '2019-01-25 10:04:25', '2019-01-25 10:04:25'),
(10, 10, 'Order Confirmed', 'confirmed', 'admin', 1, '2019-01-25 10:04:59', '2019-01-25 10:04:59'),
(11, 11, 'Order Confirmed', 'confirmed', 'admin', 1, '2019-01-25 10:08:41', '2019-01-25 10:08:41'),
(12, 12, 'Order Confirmed', 'confirmed', 'admin', 1, '2019-01-25 10:10:15', '2019-01-25 10:10:15'),
(13, 13, 'Order Confirmed', 'confirmed', 'admin', 1, '2019-01-25 10:13:49', '2019-01-25 10:13:49'),
(14, 14, 'Order Confirmed', 'confirmed', 'admin', 1, '2019-01-25 10:17:08', '2019-01-25 10:17:08'),
(15, 15, 'Order Confirmed', 'confirmed', 'admin', 1, '2019-01-25 10:18:46', '2019-01-25 10:18:46'),
(16, 16, 'Order Confirmed', 'confirmed', 'admin', 1, '2019-01-25 10:20:23', '2019-01-25 10:20:23'),
(17, 17, 'Order Confirmed', 'confirmed', 'admin', 1, '2019-01-25 10:28:22', '2019-01-25 10:28:22'),
(18, 18, 'Order Confirmed', 'confirmed', 'admin', 1, '2019-01-28 05:51:36', '2019-01-28 05:51:36'),
(19, 19, 'Order Confirmed', 'confirmed', 'admin', 1, '2019-01-28 06:22:22', '2019-01-28 06:22:22'),
(20, 19, 'Food Pack and Assign', 'assign_staff', 'staff', 3, '2019-01-28 12:26:53', '2019-01-28 12:26:53'),
(21, 20, 'Order Confirmed', 'confirmed', 'admin', 1, '2019-02-12 05:58:24', '2019-02-12 05:58:24'),
(22, 21, 'Order Confirmed', 'confirmed', 'admin', 1, '2019-02-12 06:23:49', '2019-02-12 06:23:49'),
(23, 22, 'Order Confirmed', 'confirmed', 'admin', 1, '2019-02-12 06:26:36', '2019-02-12 06:26:36'),
(24, 23, 'Order Confirmed', 'confirmed', 'admin', 1, '2019-02-12 06:28:50', '2019-02-12 06:28:50'),
(25, 24, 'Order Confirmed', 'confirmed', 'admin', 1, '2019-02-12 06:49:15', '2019-02-12 06:49:15'),
(26, 25, 'Order Confirmed', 'confirmed', 'admin', 1, '2019-02-25 13:28:28', '2019-02-25 13:28:28'),
(27, 26, 'Order Confirmed', 'confirmed', 'admin', 1, '2019-02-26 06:32:52', '2019-02-26 06:32:52'),
(28, 27, 'Order Confirmed', 'confirmed', 'admin', 1, '2019-02-27 08:55:18', '2019-02-27 08:55:18'),
(29, 28, 'Order Confirmed', 'confirmed', 'admin', 1, '2019-03-11 06:39:32', '2019-03-11 06:39:32'),
(30, 29, 'Order Confirmed', 'confirmed', 'admin', 1, '2019-03-25 11:07:38', '2019-03-25 11:07:38'),
(31, 30, 'Order Confirmed', 'confirmed', 'admin', 1, '2019-03-25 12:50:43', '2019-03-25 12:50:43'),
(32, 31, 'Order Confirmed', 'confirmed', 'admin', 1, '2019-03-25 13:16:02', '2019-03-25 13:16:02');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `total_amount` float DEFAULT NULL,
  `is_pre_order` tinyint(4) DEFAULT '0',
  `order_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `user_id`, `product_name`, `product_image`, `qty`, `amount`, `total_amount`, `is_pre_order`, `order_date`, `created_at`, `updated_at`) VALUES
(9, 18, 19, 1, 'Dum Aloo Lakhnawi', NULL, 1, 32.78, 32.78, 1, '2019-01-28', '2019-01-28 05:51:37', '2019-01-28 05:51:37'),
(10, 18, 11, 1, 'Veg Sandwich', '', 1, 0.1, 0.1, 1, '2019-01-28', '2019-01-28 05:51:37', '2019-01-28 05:51:37'),
(11, 19, 21, 1, 'Scrambled Eggs', NULL, 1, 32.78, 32.78, 0, '2019-01-28', '2019-01-28 06:22:22', '2019-01-28 06:22:22'),
(12, 19, 17, 1, 'Aloo Matar', NULL, 1, 34.31, 34.31, 1, '2019-01-28', '2019-01-28 06:22:22', '2019-01-28 06:22:22'),
(13, 20, 18, 1, 'Kadhi pakoda', NULL, 3, 33, 99, 1, '2019-02-12', '2019-02-12 05:58:24', '2019-02-12 05:58:24'),
(14, 20, 22, 1, 'Sausage', NULL, 3, 33, 99, 0, '2019-02-12', '2019-02-12 05:58:24', '2019-02-12 05:58:24'),
(15, 21, 11, 1, 'Veg Sandwich', '', 1, 0.1, 0.1, 0, '2019-02-12', '2019-02-12 06:23:49', '2019-02-12 06:23:49'),
(16, 22, 17, 1, 'Aloo Matar', NULL, 1, 34.31, 34.31, 1, '2019-02-12', '2019-02-12 06:26:36', '2019-02-12 06:26:36'),
(17, 23, 23, 1, 'Waffles', NULL, 1, 32.78, 32.78, 0, '2019-02-12', '2019-02-12 06:28:50', '2019-02-12 06:28:50'),
(18, 24, 18, 1, 'Kadhi pakoda', NULL, 1, 33, 33, 1, '2019-02-12', '2019-02-12 06:49:15', '2019-02-12 06:49:15'),
(19, 25, 11, 1, 'Veg Sandwich', '', 6, 0.1, 0.6, 1, '2019-02-26', '2019-02-25 13:28:28', '2019-02-25 13:28:28'),
(20, 25, 18, 1, 'Kadhi pakoda', NULL, 1, 33, 33, 0, '2019-02-25', '2019-02-25 13:28:28', '2019-02-25 13:28:28'),
(21, 26, 20, 1, 'Dum Paneer Kali Mirch', NULL, 1, 33, 33, 1, '2019-02-26', '2019-02-26 06:32:52', '2019-02-26 06:32:52'),
(22, 27, 18, 1, 'Kadhi pakoda', NULL, 3, 33, 99, 1, '2019-02-27', '2019-02-27 08:55:18', '2019-02-27 08:55:18'),
(23, 27, 11, 1, 'Veg Sandwich', '', 5, 0.1, 0.5, 0, '2019-02-27', '2019-02-27 08:55:18', '2019-02-27 08:55:18'),
(24, 28, 23, 1, 'Waffles', NULL, 1, 32.78, 32.78, 0, '2019-03-11', '2019-03-11 06:39:32', '2019-03-11 06:39:32'),
(25, 29, 18, 1, 'Kadhi pakoda', NULL, 10, 33, 330, 1, '2019-03-25', '2019-03-25 11:07:38', '2019-03-25 11:07:38'),
(26, 30, 18, 1, 'Kadhi pakoda', NULL, 1, 33, 33, 1, '2019-03-25', '2019-03-25 12:50:43', '2019-03-25 12:50:43'),
(27, 31, 18, 1, 'Kadhi pakoda', NULL, 1, 33, 33, 0, '2019-03-25', '2019-03-25 13:16:02', '2019-03-25 13:16:02');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `parent_page` tinyint(4) NOT NULL DEFAULT '0',
  `header_page` tinyint(4) NOT NULL DEFAULT '0',
  `footer_page` tinyint(4) NOT NULL DEFAULT '0',
  `other_page` tinyint(4) DEFAULT '0',
  `meta_title` varchar(65) DEFAULT NULL,
  `meta_keyword` varchar(160) DEFAULT NULL,
  `meta_description` varchar(256) DEFAULT NULL,
  `short_desc` text,
  `description` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort_number` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `parent_page`, `header_page`, `footer_page`, `other_page`, `meta_title`, `meta_keyword`, `meta_description`, `short_desc`, `description`, `status`, `sort_number`, `created_at`, `updated_at`) VALUES
(9, 'about us', 'about-us', 0, 0, 0, 0, NULL, NULL, NULL, NULL, '<div class=\"col-sm-12 col-md-12 col-lg-6 col-xs-12 commontop text-left\">\r\n<h4>about our restaurant food &amp; drinkes</h4>\r\n\r\n<div class=\"divider style-1 left\">&nbsp;</div>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id.</p>\r\n</div>', 1, NULL, '2018-12-18 10:54:20', '2018-12-18 10:54:20'),
(11, 'dssad', 'dssad', 0, 1, 1, 0, NULL, NULL, NULL, NULL, '<p>asdf</p>', 1, NULL, '2018-12-18 12:12:18', '2018-12-18 13:01:59');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('rawat.neeraj.510@gmail.com', '$2y$10$w9K/UV/gtf8d0ZGt/djsau/9T.6NiYf89SdTTuKzFM3JnGmouBXEG', '2018-09-28 01:41:34');

-- --------------------------------------------------------

--
-- Table structure for table `popups`
--

CREATE TABLE `popups` (
  `id` int(10) UNSIGNED NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `popups`
--

INSERT INTO `popups` (`id`, `image_url`, `type`, `category_id`, `sub_category_id`, `status`, `created_at`, `updated_at`) VALUES
(5, 'asdasdasd', 'site', '', NULL, 1, '2018-10-11 11:15:13', '2018-10-11 11:15:13'),
(6, 'asdasdasd', 'category', 'a:2:{i:0;s:1:\"7\";i:1;s:1:\"9\";}', NULL, 1, '2018-10-11 11:15:17', '2018-10-11 11:21:32');

-- --------------------------------------------------------

--
-- Table structure for table `postcodes`
--

CREATE TABLE `postcodes` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main` tinyint(4) NOT NULL DEFAULT '1',
  `franchise_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `postcodes`
--

INSERT INTO `postcodes` (`id`, `post_code`, `main`, `franchise_id`, `status`, `meta_title`, `meta_keyword`, `meta_description`, `created_at`, `updated_at`) VALUES
(2, '8888888', 0, 3, 1, NULL, NULL, NULL, '2018-09-13 10:21:56', '2018-09-27 07:30:22'),
(3, 'RERSDG50', 1, 0, 1, NULL, NULL, NULL, '2018-09-27 06:59:22', '2018-09-27 06:59:22'),
(5, '22222', 1, 0, 1, NULL, NULL, NULL, '2018-09-27 07:12:04', '2018-09-27 07:29:44');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `price` float DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `stock_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_popular` tinyint(4) NOT NULL DEFAULT '0',
  `allergen_key` text COLLATE utf8mb4_unicode_ci,
  `server_text_heading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `sub_category_id`, `name`, `model_no`, `slug`, `image`, `description`, `short_description`, `status`, `created_at`, `updated_at`, `price`, `quantity`, `start_time`, `end_time`, `stock_status`, `country_id`, `meta_title`, `meta_keyword`, `meta_description`, `is_popular`, `allergen_key`, `server_text_heading`) VALUES
(11, 7, 10, 'Veg Sandwich', NULL, 'veg-sandwich', '', '<p>sdsdfsdf</p>', NULL, 1, '2018-12-24 07:11:58', '2018-12-24 07:11:58', 0.1, '41', '00:00:00', '00:00:00', NULL, NULL, 'Veg Sandwich', 'Veg Sandwich', 'Indian spiced sweet corn stuffing is made for this sandwiches. These are good for breakfast or afternoon snack', 1, NULL, NULL),
(13, 7, 10, 'Poori Bhaji', NULL, 'poori-bhaji', '', NULL, NULL, 1, '2018-12-24 07:09:12', '2018-12-24 07:09:12', 324.2, '4', '00:00:00', '00:00:00', NULL, NULL, 'Breakfast', 'Breakfast', 'Poori bhaji is a combination of two dishes served together. Whole wheat flour deep fried flaky bread called puris and medium spiced boiled potato curry called bhaji. Puri bhaji is a versatile wholesome breakfast dish that is quite popular across India.', 1, NULL, NULL),
(16, 7, 10, 'Aloo Paratha', NULL, 'aloo-paratha', NULL, NULL, NULL, 1, '2018-12-24 07:10:10', '2018-12-24 07:10:10', 34.31, '3453', NULL, NULL, NULL, NULL, 'Aloo Paratha', 'Aloo Paratha', 'good quality', 1, NULL, NULL),
(17, 7, 11, 'Aloo Matar', NULL, 'aloo-matar', NULL, '<p>gfcghbn</p>', NULL, 1, '2018-12-24 07:17:01', '2018-12-24 07:17:01', 34.31, '3453', NULL, NULL, NULL, NULL, 'Aloo Matar', 'Aloo Matar', 'Vegetarian', 0, NULL, NULL),
(18, 7, 11, 'Kadhi pakoda', NULL, 'kadhi-pakoda', NULL, '<p>jhgjgh</p>', NULL, 1, '2018-12-24 07:19:59', '2018-12-24 07:19:59', 33, '3467', NULL, NULL, NULL, NULL, 'Kadhi pakoda', 'Kadhi pakoda', 'Gram flour with yogurt with gramflour fried balls', 0, NULL, NULL),
(19, 7, 16, 'Dum Aloo Lakhnawi', NULL, 'dum-aloo-lakhnawi', NULL, '<p>gfgfgjgj</p>', NULL, 1, '2018-12-24 07:23:47', '2018-12-24 07:23:47', 32.78, '500', NULL, NULL, NULL, NULL, 'Dum Aloo Lakhnawi', 'Dum Aloo Lakhnawi', 'Your family will thank you for this absolutely fantastic bowl of dum aloo cooked Lakhnawi style. Take some potatoes, crumbled paneer, kasuri methi, butter, onions and some ghee.', 0, NULL, NULL),
(20, 7, 16, 'Dum Paneer Kali Mirch', NULL, 'menu-dinner-menu-dinner-dum-paneer-kali-mirch', NULL, '<p>kiuygsfdxgchvj</p>', NULL, 1, '2020-08-23 09:45:47', '2020-08-23 09:45:47', 33, '500', NULL, NULL, NULL, NULL, 'Dum Paneer Kali Mirch', 'Dum Paneer Kali Mirch', 'Small chunks of paneer cooked with cinnamon, fried onions, black pepper, ginger, garlic and yogurt to make this gorgeous and fragrant curry.', 0, NULL, NULL),
(21, 8, 18, 'Scrambled Eggs', NULL, 'scrambled-eggs', NULL, NULL, NULL, 1, '2018-12-24 07:30:32', '2018-12-24 07:30:32', 32.78, '3453', NULL, NULL, NULL, NULL, 'Scrambled Eggs', 'Scrambled Eggs', 'Even if someone has just carried a steaming tray of these out of the kitchen, they\'re still congealed, lumpy and completely un-egg like. As breakfast, they\'re terrible. As a packing material, they\'d be perfect', 1, NULL, NULL),
(22, 8, 18, 'Sausage', NULL, 'sausage', NULL, '<p>jhgfhjkl</p>', NULL, 1, '2018-12-24 07:31:39', '2018-12-24 07:31:39', 33, '3467', NULL, NULL, NULL, NULL, 'Sausage', 'Sausage', 'You should always start your day by doing something you\'ll regret', 1, NULL, NULL),
(23, 8, 18, 'Waffles', NULL, 'waffles', NULL, '<p><strong>Lorem Ipsum</strong><span style=\"color:rgb(0, 0, 0); font-family:open sans,arial,sans-serif; font-size:14px\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</span></p>', NULL, 1, '2018-12-24 07:34:08', '2018-12-24 07:34:08', 32.78, '3467', NULL, NULL, NULL, NULL, 'Waffles', 'Waffles', 'Pouring a Dixie cup full of pre-mixed batter into the waffle iron is as close as some of us get to cooking (and by \"some of us,\" I mean me). But that doesn\'t mean you can\'t lace your fingers, extend your arms and brag about having fixed your own breakfast', 1, NULL, NULL),
(24, 8, 19, 'Crispy Calamari Rings', NULL, 'crispy-calamari-rings', NULL, '<p><span style=\"color:rgb(0, 0, 0); font-family:open sans,arial,sans-serif; font-size:14px\">It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</span></p>', NULL, 1, '2018-12-24 08:45:15', '2018-12-24 08:45:15', 34.31, '3467', NULL, NULL, NULL, NULL, 'Crispy Calamari Rings', 'Crispy Calamari Rings', 'A quick and easy snack recipe, calamari rings are basically squid rings deep fried in tempura batter and served hot and crispy alongside parsley sprig and thai chilli sauce.', 0, NULL, NULL),
(25, 8, 19, 'Paneer Steak', NULL, 'paneer-steak', NULL, '<p><span style=\"color:rgb(0, 0, 0); font-family:open sans,arial,sans-serif; font-size:14px\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English</span></p>', NULL, 1, '2018-12-24 08:47:51', '2018-12-24 08:47:51', 33, '3467', NULL, NULL, NULL, NULL, 'Paneer Steak', 'Paneer Steak', 'Pan fried cottage cheese patties baked with cheese and tomatoes.', 0, NULL, NULL),
(26, 8, 20, 'Red Rice', NULL, 'red-rice', NULL, '<p><span style=\"color:rgb(0, 0, 0); font-family:open sans,arial,sans-serif; font-size:14px\">Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)</span></p>', NULL, 1, '2018-12-24 08:50:35', '2018-12-24 08:50:35', 33, '500', NULL, NULL, NULL, NULL, 'Red Rice', 'Red Rice', 'Red rice is rich in an anti-oxidant called anthocyanins which prevents the risk of cancer and reduces inflammation.', 0, NULL, NULL),
(27, 8, 20, 'Yam Curry', NULL, 'yam-curry', NULL, '<p><span style=\"color:rgb(0, 0, 0); font-family:open sans,arial,sans-serif; font-size:14px\">All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc</span></p>', NULL, 1, '2018-12-24 08:51:48', '2018-12-24 08:51:48', 32.78, '500', NULL, NULL, NULL, NULL, 'Yam Curry', 'Yam Curry', 'Yam Curry is a delicious curry recipe that is loved by foodies all over the world. Yams are a great source of potassium and adding them in a curry makes for a mouth-watering delight', 0, NULL, NULL),
(28, 9, 21, 'Tofu Pudding', NULL, 'tofu-pudding', NULL, '<p><span style=\"color:rgb(0, 0, 0); font-family:open sans,arial,sans-serif; font-size:14px\">Contrary to popular belief, Lorem Ipsum is not simply random text.&nbsp;</span></p>', NULL, 1, '2018-12-24 08:54:50', '2018-12-24 08:54:50', 33, '500', NULL, NULL, NULL, NULL, 'Tofu Pudding', 'Tofu Pudding', 'Tofu pudding is a popular Chinese snack made with very soft tofu, which is made from raw beans.', 1, NULL, NULL),
(29, 9, 21, 'Wheat Noodles', NULL, 'wheat-noodles', NULL, '<p><strong>Lorem Ipsum</strong><span style=\"color:rgb(0, 0, 0); font-family:open sans,arial,sans-serif; font-size:14px\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span></p>', NULL, 1, '2018-12-24 08:56:02', '2018-12-24 08:56:02', 33, '3467', NULL, NULL, NULL, NULL, 'Wheat Noodles', 'Wheat Noodles', 'In northern China, where wheat is more commonly eaten, a bowl of hot and flavorful wheat noodles is a popular breakfast dish.', 1, NULL, NULL),
(30, 9, 21, 'Rice Noodles', NULL, 'rice-noodles', NULL, '<p><span style=\"color:rgb(0, 0, 0); font-family:open sans,arial,sans-serif; font-size:14px\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</span></p>', NULL, 1, '2018-12-24 08:57:06', '2018-12-24 08:57:06', 32.78, '3453', NULL, NULL, NULL, NULL, 'Rice Noodles', 'Rice Noodles', 'Rice noodles are a good choice if you are allergic to gluten. They are made of rice although they look like wheat noodles and the taste is different.', 1, NULL, NULL),
(31, 9, 22, 'Spring Rolls', NULL, 'spring-rolls', NULL, '<p><span style=\"color:rgb(0, 0, 0); font-family:open sans,arial,sans-serif; font-size:14px\">It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', NULL, 1, '2018-12-24 09:00:35', '2018-12-24 09:00:35', 34.31, '3467', NULL, NULL, NULL, NULL, 'Spring Rolls', 'Spring Rolls', 'A crisp appetizer where shredded veggies are encased in thin sheets and then fried golden.', 0, NULL, NULL),
(32, 9, 22, 'Stir Fried Tofu with Rice', NULL, 'stir-fried-tofu-with-rice', NULL, '<p><span style=\"color:rgb(0, 0, 0); font-family:open sans,arial,sans-serif; font-size:14px\">Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span></p>', NULL, 1, '2018-12-24 09:00:22', '2018-12-24 09:00:22', 34.31, '3467', NULL, NULL, NULL, NULL, 'Stir Fried Tofu with Rice', 'Stir Fried Tofu with Rice', 'A simple stir-fry with tofu and Oriental sauces. Serve with some fried rice to make a wholesome meal.', 0, NULL, NULL),
(33, 9, 23, 'Chow mein', NULL, 'chinese-dinner-chow-mein', NULL, '<p><span style=\"color:rgb(0, 0, 0); font-family:open sans,arial,sans-serif; font-size:14px\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English.</span></p>', NULL, 1, '2019-01-23 06:37:51', '2019-01-23 06:37:51', 32.78, '3467', NULL, NULL, NULL, NULL, 'Chow mein', 'Chow mein', 'stir-fried noodles', 0, NULL, NULL),
(34, 9, 23, 'Noodle soup', NULL, 'chinese-dinner-chinese-dinner-noodle-soup', NULL, '<p><span style=\"color:rgb(0, 0, 0); font-family:open sans,arial,sans-serif; font-size:14px\">Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, wh', 1, '2019-01-23 06:30:02', '2019-01-23 06:30:02', 32.78, '3453', NULL, NULL, NULL, NULL, 'Noodle soup', 'Noodle soup', 'noodles with soup', 0, NULL, NULL),
(36, 7, 17, 'coca cola', NULL, 'menu-drinks-menu-drinks-coca-cola', '15982731095f43b655f370f.jpg', NULL, NULL, 1, '2020-08-24 13:13:36', '2020-08-24 13:13:36', 10, '10', NULL, NULL, NULL, NULL, 'coca cola', 'coca cola', 'coca cola', 0, 'coca cola', 'dde'),
(40, 7, 16, '12GG', NULL, 'menu-mains-non-veg-menu-mains-non-veg-menu-mains-non-veg-menu-mains-non-veg-12gg', '15982783085f43caa45ddd2.jpg', '<p>xc</p>', 'xcv', 1, '2020-08-26 06:10:37', '2020-08-26 06:10:37', 50, '10', NULL, NULL, NULL, NULL, 'xc', 'xcv', 'xcv', 0, 'xcv', 's1');

-- --------------------------------------------------------

--
-- Table structure for table `product_features`
--

CREATE TABLE `product_features` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `feature_id` int(11) DEFAULT NULL,
  `feature_value_id` int(11) DEFAULT NULL,
  `value` varchar(200) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `unit` varchar(200) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_features`
--

INSERT INTO `product_features` (`id`, `product_id`, `feature_id`, `feature_value_id`, `value`, `type`, `unit`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 6, 37, 'Small', 'multiselect', NULL, 1, '2018-08-30 06:57:28', '2020-08-24 13:38:26'),
(2, 6, 8, 42, 'Medium', 'singleselect', NULL, 1, '2018-08-30 06:57:28', '2020-08-24 13:38:36'),
(3, 6, 9, 0, 'Large', 'text', NULL, 1, '2018-08-30 06:57:28', '2020-08-24 13:38:47');

-- --------------------------------------------------------

--
-- Table structure for table `product_feature_items`
--

CREATE TABLE `product_feature_items` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_feature_id` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_feature_items`
--

INSERT INTO `product_feature_items` (`id`, `product_id`, `product_feature_id`, `price`, `created_at`, `updated_at`) VALUES
(1, 39, 1, 10, '2020-08-24 14:10:01', '2020-08-24 14:10:01'),
(2, 39, 3, 20, '2020-08-24 14:10:01', '2020-08-24 14:10:01'),
(13, 40, 1, 1, '2020-08-26 06:10:37', '2020-08-26 06:10:37'),
(14, 40, 3, 2, '2020-08-26 06:10:37', '2020-08-26 06:10:37');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(4, 6, '15345049295b76afe17560f.jpg', '2018-08-17 05:52:09', '2018-08-17 11:22:09'),
(5, 6, '15359739655b8d1a4dc824b.jpg', '2018-09-03 05:56:05', '2018-09-03 11:26:05'),
(6, 6, '15359739655b8d1a4ddd240.jpg', '2018-09-03 05:56:05', '2018-09-03 11:26:05'),
(7, 10, '15379698375bab8ead98d80.jpg', '2018-09-26 08:20:53', '2018-09-26 13:50:53'),
(10, 10, '15379722865bab983e8af1f.jpg', '2018-09-26 09:01:42', '2018-09-26 14:31:42'),
(11, 34, '15875579225ea036225790e.jpg', '2020-04-22 06:49:24', '2020-04-22 12:19:24');

-- --------------------------------------------------------

--
-- Table structure for table `product_items`
--

CREATE TABLE `product_items` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `price` float DEFAULT NULL,
  `price_type` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_items`
--

INSERT INTO `product_items` (`id`, `product_id`, `title`, `description`, `price`, `price_type`, `created_at`, `updated_at`) VALUES
(18, 39, 'asdas', 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, NULL, '2019-01-22 12:09:21', '2019-01-22 12:09:21'),
(19, 39, 'test', 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, NULL, '2019-01-22 12:09:21', '2019-01-22 12:09:21'),
(20, 39, 'hjjj hihihihihihihi', 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, NULL, '2019-01-22 12:09:21', '2019-01-22 12:09:21'),
(21, 34, 'test', 'bnkfbui', NULL, NULL, '2019-01-23 06:30:02', '2019-01-23 06:30:02'),
(22, 34, 'test', 'nkm gk hj', NULL, NULL, '2019-01-23 06:30:02', '2019-01-23 06:30:02'),
(23, 33, 'Heyper text', 'test', NULL, NULL, '2019-01-23 06:37:51', '2019-01-23 06:37:51'),
(24, 33, 'kool mint', 'nljbl,mnol,', NULL, NULL, '2019-01-23 06:37:51', '2019-01-23 06:37:51'),
(29, 36, 'stro2', NULL, 1, 'Increment', '2020-08-24 13:13:36', '2020-08-24 13:13:36'),
(30, 36, 'glass2', NULL, 2, 'Decrement', '2020-08-24 13:13:36', '2020-08-24 13:13:36'),
(31, 36, 'tea', NULL, 2, 'Increment', '2020-08-24 13:13:36', '2020-08-24 13:13:36');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `review` text,
  `rating` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `product_id`, `user_id`, `review`, `rating`, `created_at`, `updated_at`) VALUES
(1, 11, 1, 'this is a goof prod t', 5, '2018-12-21 11:40:15', '2018-12-21 11:40:15'),
(2, 11, 40, 'very good', 5, '2018-12-21 15:28:03', '2018-12-21 15:28:03'),
(3, 16, 1, 'nice', 4, '2018-12-26 12:04:06', '2018-12-26 12:04:06'),
(4, 11, 6, 'this is a goof prod t', 3, '2018-12-21 11:40:15', '2018-12-21 11:40:15');

-- --------------------------------------------------------

--
-- Table structure for table `product_tags`
--

CREATE TABLE `product_tags` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_tags`
--

INSERT INTO `product_tags` (`id`, `product_id`, `tag`, `created_at`, `updated_at`) VALUES
(1, 30, 'hot', '2018-12-24 11:35:55', '2018-12-24 11:35:55'),
(2, 30, 'sweet', '2018-12-24 11:35:55', '2018-12-24 11:35:55'),
(3, 30, 'cold', '2018-12-24 11:35:55', '2018-12-24 11:35:55'),
(8, 35, 'sdf', '2019-01-03 09:43:36', '2019-01-03 09:43:36'),
(11, 13, 'hot', '2019-01-10 06:44:20', '2019-01-10 06:44:20'),
(14, 34, 'hot', '2019-01-23 06:30:02', '2019-01-23 06:30:02'),
(15, 34, 'cold', '2019-01-23 06:30:02', '2019-01-23 06:30:02'),
(16, 33, 'sweet', '2019-01-23 06:37:51', '2019-01-23 06:37:51'),
(17, 33, 'hot', '2019-01-23 06:37:51', '2019-01-23 06:37:51'),
(21, 20, 'chicken', '2020-08-23 09:45:48', '2020-08-23 09:45:48'),
(22, 20, 'cheese', '2020-08-23 09:45:48', '2020-08-23 09:45:48'),
(23, 20, 'potato, onion, fries', '2020-08-23 09:45:48', '2020-08-23 09:45:48');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `site_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` text COLLATE utf8mb4_unicode_ci,
  `g_plus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkdlin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_analytic` text COLLATE utf8mb4_unicode_ci,
  `site_currency_type` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT 'GBP',
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_table` int(11) DEFAULT NULL,
  `total_men` int(11) DEFAULT NULL,
  `men_in_table` int(11) DEFAULT NULL,
  `table_reservation_phone_number` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_title`, `email`, `email2`, `address`, `logo`, `mobile`, `phone`, `about`, `facebook`, `twitter`, `g_plus`, `linkdlin`, `youtube_link`, `google_analytic`, `site_currency_type`, `latitude`, `longitude`, `total_table`, `total_men`, `men_in_table`, `table_reservation_phone_number`, `created_at`, `updated_at`) VALUES
(1, 'Book meal 2', 'vinayverma158@deepaktanwar.com', 'vinayverma158@deepaktanwar.com', 'dallas', '15981655965f42125c09090.png', '8963824028', '8963824028', '<p>dfsdfsfsdf</p>', 'Facebook link', 'Twitter link', 'G plus link', 'Linkdlin link', 'Youtube link', NULL, 'GBP', '32.7766642', '-96.79698789999999', 10, 40, 4, 896532211, '0000-00-00 00:00:00', '2020-08-26 10:00:52');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_taxes`
--

CREATE TABLE `shipping_taxes` (
  `id` int(11) NOT NULL,
  `shipping_title` varchar(255) DEFAULT NULL,
  `shipping_type` varchar(255) DEFAULT NULL,
  `shipping_amount` varchar(255) DEFAULT NULL,
  `shipping_desc` text,
  `tax_text` varchar(255) DEFAULT NULL,
  `tax_percent` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping_taxes`
--

INSERT INTO `shipping_taxes` (`id`, `shipping_title`, `shipping_type`, `shipping_amount`, `shipping_desc`, `tax_text`, `tax_percent`, `created_at`, `updated_at`) VALUES
(1, 'd', 'Paid', '10', '<p>dsaadsfasd</p>', 'asdf', '1', NULL, '2019-02-11 12:12:22');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `button_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `title`, `sub_title`, `meta_description`, `description`, `button_text`, `button_url`, `status`, `created_at`, `updated_at`) VALUES
(1, '15435845315c013b139e184.jpg', 'Delicious Desserts', 'Order it online even now!', NULL, '', 'Order now!', '', 1, '2018-11-30 13:25:08', '2020-08-23 05:52:54'),
(2, '15441007575c091b951be63.jpg', 'Get 10% off coupon', 'and use it with your next order!', NULL, '', 'Get it now!', '', 1, '2018-12-06 12:52:57', '2020-08-23 05:52:05');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `address` text,
  `phone` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `description` text,
  `status` tinyint(4) DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`id`, `first_name`, `last_name`, `email`, `password`, `remember_token`, `image`, `address`, `phone`, `mobile`, `description`, `status`, `created_at`, `updated_at`) VALUES
(3, 'staff', 'first', 'jonny@gmail.com', '$2y$10$klAaKN9qc3jF0FyNrET7ju3H7dQl3KkJAiGybUXB9aOQ7U1So2x2K', 'bPOCOi1SdUnHDBpDrPCy5ynilOSvsj3VfKmtqqmlaSCxRnQlU9zy8TUzNT0D', '15459927635c25fa3bf1725.jpg', 'Address', '19239232966', '563534564', '<p><strong>Descriptionf efwef</strong></p>', 1, '2018-12-28 10:26:49', '2018-12-28 10:44:12');

-- --------------------------------------------------------

--
-- Table structure for table `table_reservations`
--

CREATE TABLE `table_reservations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `people_count` int(11) DEFAULT NULL,
  `reservation_time` time DEFAULT NULL,
  `reservation_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_reservations`
--

INSERT INTO `table_reservations` (`id`, `name`, `email`, `phone`, `people_count`, `reservation_time`, `reservation_date`, `created_at`, `updated_at`) VALUES
(1, 'sdf', 'fsd@gmail.com', '1231654548', 39, '12:00:00', '2020-08-26', '2020-08-26 11:52:19', '2020-08-26 11:52:19'),
(2, 'ds', 'dsdf@gmail.com', '21547898', 38, '13:00:00', '2020-08-26', '2020-08-26 12:15:46', '2020-08-26 12:15:46'),
(3, 'dsad', 'sdaf@gmail.com', '215456', 1, '13:00:00', '2020-08-26', '2020-08-26 12:16:25', '2020-08-26 12:16:25'),
(4, 'xfg', 'fgfh@gmail.com', '1232134', 1, '13:00:00', '2020-08-26', '2020-08-26 12:16:58', '2020-08-26 12:16:58'),
(5, 'fsdf', 'sfdsd@gmail.com', '123325345', 1, '14:00:00', '2020-08-26', '2020-08-26 12:17:27', '2020-08-26 12:17:27'),
(6, 'dsfsd', 'sheetal@gmail.com', '08827063469', 2, '05:00:00', '2020-09-01', '2020-08-28 14:19:40', '2020-08-28 14:19:40'),
(7, 'dsfsd', 'sheetal@gmail.com', '08827063469', 36, '05:00:00', '2020-09-01', '2020-08-28 14:20:14', '2020-08-28 14:20:14'),
(8, 'sdg', 'sheetal@gmail.com', '4654574', 37, '05:00:00', '2020-08-29', '2020-08-28 14:23:55', '2020-08-28 14:23:55'),
(9, 'sdg', 'sheetal@gmail.com', '4654574', 3, '05:00:00', '2020-08-29', '2020-08-28 14:24:14', '2020-08-28 14:24:14');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `description` text,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `show_inhome_page` tinyint(4) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `designation`, `description`, `status`, `show_inhome_page`, `created_at`, `updated_at`) VALUES
(4, 'Lorem Ipsum', 'businessman', '<p><strong>Lorem Ipsum</strong><span style=\"font-family:open sans,arial,sans-serif; font-size:14px\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span></p>', 1, 0, '2018-12-24 09:12:46', '2018-12-24 09:24:12'),
(5, 'James', 'CEO (IBM)', '<p><span style=\"color:#FFFFFF\"><span style=\"font-family:open sans,arial,sans-serif; font-size:14px\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</span></span></p>', 1, 0, '2018-12-24 09:14:44', '2018-12-24 09:25:37'),
(6, 'John', 'manager', '<p><span style=\"color:#FFFFFF\"><span style=\"font-family:open sans,arial,sans-serif; font-size:14px\">Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</span></span></p>', 1, 0, '2018-12-24 09:18:47', '2018-12-24 09:25:25'),
(7, 'Archie', 'bank manager', '<p><span style=\"color:#FFFFFF\"><span style=\"font-family:open sans,arial,sans-serif; font-size:14px\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English.</span></span></p>', 1, 0, '2018-12-24 09:21:51', '2018-12-24 09:25:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `otp` int(11) DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oauth_provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oauth_uid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_original` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `group_id`, `username`, `phone`, `otp`, `first_name`, `last_name`, `email`, `provider`, `provider_id`, `oauth_provider`, `oauth_uid`, `gender`, `locale`, `picture`, `dob`, `link`, `avatar`, `avatar_original`, `password`, `address`, `postcode`, `city`, `country_id`, `state`, `remember_token`, `activated`, `created_at`, `updated_at`) VALUES
(1, 1, 'jon andrew', 65262652152, NULL, 'jon', 'andrew', 'rawat.neeraj.510@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-12-13', NULL, '', '', '$2y$10$V/FP/TXxXBK2D2JY.x8Xxe1GBaHD6MHtBhrcvlPpuG1XAPdSIENei', 'aasasdas', '12345463', 'jaipur', 15, 'a', '69nDujTqPc3tlblRK5tRgGiQPbvZLY89EiDwOOoLaLdS4KfXpj74bwm32st9', 1, '2018-08-06 05:05:55', '2019-01-23 08:35:19'),
(6, 1, 'testsing', 8963814028, 481628, 'test', 'sing', 'test@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '$2y$10$YA55MBSovewzPlhhXwSPeezlp2aqeP4O0bE63fBiNqF30ih/dm.A2', NULL, '51561', NULL, NULL, NULL, 'SXduxciblWN10rt9dzu7fCxPU5OeAovqVMirTlg47gHYJXXloPFsu1dTVNCQ', 1, '2018-09-05 06:24:36', '2018-09-19 08:27:13'),
(40, 1, 'tetsrred', 8963824028, 168033, 'tets', 'rred', 'rawneeraj.510@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '$2y$10$tyKQhK7Rv4oilf5.2SoW0Oh2j3pYQNq./WfgoYgfjiAQFV7asX7SK', 'test', '896344', NULL, NULL, NULL, 'EaE1wj2wAyQB1QDy7uWCHbKO57a317MkVvshIzXT3xIkvELG1bZMttdIzT7q', 0, '2018-10-12 01:41:55', '2020-05-03 06:55:22'),
(52, 1, 'Neeraj Rawat', NULL, NULL, NULL, NULL, 'rawadsdfsdft.neeraj.510@gmail.com', 'google', '117959388769991669462', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'https://lh4.googleusercontent.com/-xiM9LrFkGEU/AAAAAAAAAAI/AAAAAAAAAAs/7GBz3gGRl9M/photo.jpg', '$2y$10$UCqvMrhEzHi6hw5spogO0.a6wpb6irpaMFCpv2PYpwmUuxNXdnNei', NULL, '12152', NULL, NULL, NULL, 'w1Kzsi9LJxTPeeMmXANRgGs9WKdpcAKrIqPhX2TMPIL3XLTtkPCLWnxUVLni', 0, '2018-11-28 08:07:06', '2019-01-10 08:44:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `address` text,
  `postcode` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_id`, `type`, `address`, `postcode`, `title`, `phone`, `created_at`, `updated_at`) VALUES
(1, 1, 'home', 'test', '2010', 'Home', '89652314', '2018-12-31 08:36:43', '2018-12-31 08:36:43'),
(2, 1, 'office', 'test tow', '7485236', 'office', '857421', '2018-12-31 08:36:43', '2018-12-31 08:36:43');

-- --------------------------------------------------------

--
-- Table structure for table `website_visitors`
--

CREATE TABLE `website_visitors` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `website_visitors`
--

INSERT INTO `website_visitors` (`id`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, '::1', '2019-03-26 08:35:16', '2019-03-26 08:35:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activation_keys`
--
ALTER TABLE `activation_keys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activation_keys_user_id_index` (`user_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `couponcodes`
--
ALTER TABLE `couponcodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_items`
--
ALTER TABLE `coupon_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_feature_category_id` (`category_id`);

--
-- Indexes for table `feature_groups`
--
ALTER TABLE `feature_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_feature_group_category_id` (`category_id`);

--
-- Indexes for table `feature_values`
--
ALTER TABLE `feature_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_feature_value_feature_id` (`feature_id`);

--
-- Indexes for table `franchises`
--
ALTER TABLE `franchises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_letters`
--
ALTER TABLE `news_letters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opening_times`
--
ALTER TABLE `opening_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `open_hours`
--
ALTER TABLE `open_hours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_complaints`
--
ALTER TABLE `order_complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_delivery_status`
--
ALTER TABLE `order_delivery_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `popups`
--
ALTER TABLE `popups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postcodes`
--
ALTER TABLE `postcodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_features`
--
ALTER TABLE `product_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_product_feature_feature` (`feature_id`),
  ADD KEY `FK_product_feature_product` (`product_id`);

--
-- Indexes for table `product_feature_items`
--
ALTER TABLE `product_feature_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_items`
--
ALTER TABLE `product_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_tags`
--
ALTER TABLE `product_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_taxes`
--
ALTER TABLE `shipping_taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_reservations`
--
ALTER TABLE `table_reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `website_visitors`
--
ALTER TABLE `website_visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activation_keys`
--
ALTER TABLE `activation_keys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT for table `couponcodes`
--
ALTER TABLE `couponcodes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `coupon_items`
--
ALTER TABLE `coupon_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `feature_groups`
--
ALTER TABLE `feature_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feature_values`
--
ALTER TABLE `feature_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `franchises`
--
ALTER TABLE `franchises`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `news_letters`
--
ALTER TABLE `news_letters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `opening_times`
--
ALTER TABLE `opening_times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `product_features`
--
ALTER TABLE `product_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_feature_items`
--
ALTER TABLE `product_feature_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_items`
--
ALTER TABLE `product_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `product_tags`
--
ALTER TABLE `product_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `table_reservations`
--
ALTER TABLE `table_reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
