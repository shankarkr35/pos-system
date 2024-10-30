-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 29, 2024 at 03:03 PM
-- Server version: 5.7.23-23
-- PHP Version: 8.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wxitelsy_pos_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=>admin,2=>cashier'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `type`) VALUES
(1, 'Admin', 'admin@gmail.com', '123456', 1),
(2, 'Cashier', 'subadmin@gmail.com', '123456', 2);

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` int(11) NOT NULL,
  `position` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`id`, `position`, `image`, `link`, `status`) VALUES
(1, 'home-1', 'trails_sport_events_adv_31AF3E9059E63770E06E4916028B81E1.jpg', 'https://www.google.com/', 1),
(2, 'home-2', 'trails_sport_events_adv_FC11F14F1BD5DBD49E87A2B900928493.jpg', 'https://www.google.com/', 1),
(3, 'event-details', 'trails_sport_events_adv_C93FA7A5A53380009320F3C6D1157F43.jpg', 'https://www.google.com/', 1),
(4, 'shop-1', 'trails_sport_events_adv_1C83ED26252F75C5DC48310D242B027D.jpg', 'https://www.google.com/', 1),
(5, 'shop-2', 'trails_sport_events_adv_D1914A67BCDDE63FC8B1CF7357CC8134.jpg', 'https://www.google.com/', 1),
(6, 'blogs', 'trails_sport_events_adv_2E00482BA6905ED0FBC0F5536D744C5F.png', 'https://www.google.com/', 1),
(7, 'events-1', 'trails_sport_events_adv_625C31DAC1A3BAAE1957D6BF81186AD2.jpg', 'https://www.google.com/', 1),
(8, 'events-2', 'trails_sport_events_adv_BD7289C0AB203EB305D50E7C7D11D30D.jpg', 'https://www.google.com/', 1),
(9, 'order-confirm', 'trails_sport_events_adv_7E78370BFA740D13B28AD371070E8392.jpg', 'https://www.google.com/', 1),
(10, 'event-registration', 'trails_sport_events_adv_FA258067019112A4119722380D461BEB.jpg', 'https://www.google.com/', 1);

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE `api_keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `my_key` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL,
  `is_private_key` tinyint(1) NOT NULL,
  `ip_addresses` text COLLATE utf8_unicode_ci,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `api_keys`
--

INSERT INTO `api_keys` (`id`, `user_id`, `my_key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 0, 'development101010102020203030', 0, 0, 0, NULL, '2021-10-13 09:13:17');

-- --------------------------------------------------------

--
-- Table structure for table `area_table`
--

CREATE TABLE `area_table` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ar_name` varchar(100) NOT NULL,
  `flag_image` varchar(250) NOT NULL,
  `createdby` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `area_table`
--

INSERT INTO `area_table` (`id`, `name`, `ar_name`, `flag_image`, `createdby`, `status`, `create_date`) VALUES
(2, 'United States', 'United States', 'flags_CDDCE426EEAC5AF1EEF8702C52A9D498.png', 1, 1, '2021-08-05 09:37:40'),
(3, 'Turkey', 'Turkey', 'flags_A06677798AD705FA7F3FDA7CAEB21C67.png', 1, 1, '2021-08-05 09:55:07'),
(4, 'China', 'China', 'flags_B75670959B2E831B25B5874E47050A0D.png', 1, 1, '2021-08-05 09:55:27'),
(5, 'Germany', 'Germany', 'flags_ED0922DF5C5A523C2AFED5B49B9AA8E3.png', 1, 1, '2021-08-05 09:55:45'),
(7, 'qatar', 'qatar', 'flags_8D43AD001129267A897ADE6B9EA5F69E.png', 1, 1, '2021-09-02 16:54:23'),
(8, 'India', 'India', 'flags_F3471564F10895877EB3B8284E0E8E7A.png', 1, 1, '2021-12-28 11:10:41');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(250) NOT NULL,
  `nameUrl` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `status` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `nameUrl`, `image`, `status`, `createdby`, `create_date`) VALUES
(9, 'saree 3', 'saree-3', 'catgories_308839371AF1EF8A656EA2E5A604AFD6.jpg', 1, 1, '2021-07-27 18:16:28'),
(14, 'saree 2', 'saree-2', 'catgories_0487081CDCF794F605100204F9397639.jpg', 1, 1, '2022-09-20 13:33:01'),
(15, 'Saree 1', 'saree-1', 'catgories_F385E9DEE76DFE19E8A2169BF3691DAB.jpg', 1, 1, '2022-10-17 10:04:20');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `email`, `message`, `date`) VALUES
(1, 'contact@us.com', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2021-09-14 12:18:21'),
(3, 'get@ggg.com', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2021-09-14 12:19:17');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_number` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `login_type` int(11) NOT NULL COMMENT '0=Normal,1=Google,2=Facebook',
  `status` int(11) NOT NULL DEFAULT '0',
  `access_token` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `email`, `mobile_number`, `password`, `address`, `image`, `login_type`, `status`, `access_token`, `created_at`) VALUES
(1, 'Shankar Kumar', 'shankar@gmail.com', '7717720891', '123456', ' Near Bharat Petrol Pump Barkagaon Jharkhand', '', 0, 1, '', '2022-10-31 06:35:25'),
(2, 'alshaab', 'aalfarhan@gmail.com', '99417776', '81dc9bdb52d04dc20036dbd8313ed055', '', '', 0, 1, '', '2022-06-21 17:42:23'),
(3, 'Anuj', 'anujpal20@gmail.com', '99995555', 'd8578edf8458ce06fbc5bb76a58c5ca4', '', '', 0, 1, '', '2022-06-22 13:47:11'),
(8, 'bader', 'alameri92@hotmail.com', '99292002', 'eecac594edf37e68bf4851b3cbe95863', '', '', 0, 1, '', '2022-07-15 18:39:53'),
(12, 'mitali', 'mitali@gmail.com', '78787878', 'e10adc3949ba59abbe56e057f20f883e', '', '', 0, 1, '', '2022-07-26 18:11:07'),
(13, 'dev', 'devtes323@gmail.com', '12345678', '81dc9bdb52d04dc20036dbd8313ed055', '', '', 0, 1, '', '2022-07-28 17:46:02'),
(14, 'mitali', 'mitali.anomla@gmail.com', '85528804', '9180cf095734d9749ff5d8f41c89e248', '', '', 0, 1, '', '2022-08-05 10:09:50'),
(16, 'Rahul kumar', 'rahul35@gmail.com', '805117314', '', 'Ranchi Jharkhand 825311', 'members_1FB899D2579DAD8BA705F76CAE5F136C.jpg', 0, 1, '', '2022-11-02 07:24:02'),
(17, 'test', 'test2gmail.com', '8051173155', '', 'Ranchi Jharkhand', 'default-image.png', 0, 0, '', '2022-11-02 08:38:31'),
(18, 'Shankar dKumar', 'shankar35@gmail.com', '08051173156', '', 'Ranchi Jharkhand', 'members_0C257488285F00F70953C2A2A78E9108.jpg', 0, 0, '', '2022-11-02 08:41:05');

-- --------------------------------------------------------

--
-- Table structure for table `customers_wishlist`
--

CREATE TABLE `customers_wishlist` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variation_id` int(11) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers_wishlist`
--

INSERT INTO `customers_wishlist` (`id`, `user_id`, `product_id`, `variation_id`, `create_date`) VALUES
(8, 6, 23, 33, '2022-07-14 21:31:43'),
(10, 11, 19, 29, '2022-07-21 15:57:42');

-- --------------------------------------------------------

--
-- Table structure for table `customer_addresses`
--

CREATE TABLE `customer_addresses` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `street1` varchar(200) NOT NULL,
  `street2` varchar(200) NOT NULL,
  `jadda` varchar(100) NOT NULL,
  `area` varchar(100) NOT NULL,
  `block` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_addresses`
--

INSERT INTO `customer_addresses` (`id`, `customer_id`, `street1`, `street2`, `jadda`, `area`, `block`) VALUES
(1, 0, '', '', '', '', ''),
(2, 1, 'sgz', '\'\";\";', 'fhdh', 'xhx', 'chhx');

-- --------------------------------------------------------

--
-- Table structure for table `measurement_units`
--

CREATE TABLE `measurement_units` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `titleUrl` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `categories` varchar(300) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createdby` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `measurement_units`
--

INSERT INTO `measurement_units` (`id`, `name`, `titleUrl`, `category_id`, `categories`, `status`, `createdby`, `create_date`, `update_date`) VALUES
(1, 'kg', 'kg', 0, '', 1, 1, '2022-11-01 12:52:58', '2022-11-01 09:52:58'),
(2, 'gm', 'gm', 0, '', 1, 1, '2022-11-01 12:53:10', '2022-11-01 09:53:10'),
(3, 'ltr', 'ltr', 0, '', 1, 1, '2022-11-01 16:06:06', '2022-11-01 13:06:06'),
(4, 'pieces', 'pieces', 0, '', 1, 1, '2022-11-01 16:41:57', '2022-11-01 13:41:57');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_unique_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` mediumtext NOT NULL,
  `phone` varchar(255) NOT NULL,
  `total_amount` double(10,2) NOT NULL,
  `coupon_code` varchar(100) NOT NULL,
  `coupon_amt` double(10,2) NOT NULL,
  `shipping_charges` double(10,2) NOT NULL,
  `payment_method` varchar(150) DEFAULT NULL,
  `payment_status` int(11) NOT NULL DEFAULT '0',
  `status` int(11) DEFAULT '0' COMMENT '0=confirmed,1=Processing,3=Shipped,4=Delivered,5=Cancel Rrequest,6=Canceled,7=Returned',
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_unique_id`, `user_id`, `user_name`, `email`, `address`, `phone`, `total_amount`, `coupon_code`, `coupon_amt`, `shipping_charges`, `payment_method`, `payment_status`, `status`, `create_date`) VALUES
(1, 'ORD-3110221353920630', 1, 'Shankar Kumar', 'shankar@gmail.com', '', '7717720891', 220.00, '', 0.00, 0.00, 'cash', 1, 0, '2022-10-31 10:55:16'),
(2, 'ORD-311022944898721', 0, '', '', '', '', 450.00, '', 0.00, 0.00, 'card', 1, 0, '2022-10-31 12:37:50'),
(3, 'ORD-3110221637341925', 0, '', '', '', '', 198.00, '', 22.00, 0.00, 'cash', 1, 0, '2022-10-31 15:35:11'),
(4, 'ORD-311022378390951', 3, 'Anuj', 'anujpal20@gmail.com', '', '99995555', 100.00, '', 20.00, 0.00, 'cash', 1, 0, '2022-10-31 15:40:46'),
(5, 'ORD-011122326989212', 1, 'Shankar Kumar', 'shankar@gmail.com', '', '7717720891', 210.00, '', 10.00, 0.00, 'cash', 1, 0, '2022-11-01 18:41:47'),
(6, 'ORD-0111221958921894', 0, '', '', '', '', 160.00, '', 0.00, 0.00, 'cash', 1, 0, '2022-11-01 18:47:26'),
(7, 'ORD-0211221635616869', 1, 'Shankar Kumar', 'shankar@gmail.com', '', '7717720891', 610.00, '', 0.00, 0.00, 'cash', 1, 1, '2022-11-02 15:11:02'),
(8, 'ORD-0911221025040612', 0, '', '', '', '', 140.00, '', 20.00, 0.00, 'cash', 1, 0, '2022-11-09 08:32:50'),
(9, 'ORD-240323286877227', 0, '', '', '', '', 720.00, '', 0.00, 0.00, 'cash', 1, 0, '2023-03-24 16:32:27'),
(10, 'ORD-2403231534680424', 1, 'Shankar Kumar', 'shankar@gmail.com', '', '7717720891', 450.00, '', 0.00, 0.00, 'cash', 1, 0, '2023-03-24 16:34:09'),
(11, 'ORD-240323652197800', 0, '', '', '', '', 440.00, '', 0.00, 0.00, 'cash', 1, 0, '2023-03-24 16:52:15'),
(12, 'ORD-1004231486997311', 0, '', '', '', '', 98.00, '', 0.00, 0.00, 'cash', 1, 0, '2023-04-10 10:56:44'),
(13, 'ORD-1004231172609834', 0, '', '', '', '', 49.00, '', 0.00, 0.00, 'cash', 1, 0, '2023-04-10 12:34:00'),
(14, 'ORD-1204231098206734', 3, 'Anuj', 'anujpal20@gmail.com', '', '99995555', 98.00, '', 0.00, 0.00, 'cash', 1, 0, '2023-04-12 11:45:14'),
(15, 'ORD-1204232044277330', 0, '', '', '', '', 147.00, '', 0.00, 0.00, 'cash', 1, 0, '2023-04-12 11:53:50'),
(16, 'ORD-1204231771520239', 0, '', '', '', '', 320.00, '', 0.00, 0.00, 'cash', 1, 0, '2023-04-12 12:02:16'),
(17, 'ORD-1204232073478294', 0, '', '', '', '', 245.00, '', 0.00, 0.00, 'card', 1, 0, '2023-04-12 12:07:05'),
(18, 'ORD-120423801593702', 1, 'Shankar Kumar', 'shankar@gmail.com', '', '7717720891', 160.00, '', 0.00, 0.00, 'cash', 1, 0, '2023-04-12 12:38:11'),
(19, 'ORD-1404231488863', 0, '', '', '', '', 770.00, '', 0.00, 0.00, 'cash', 1, 0, '2023-04-14 15:32:08'),
(20, 'ORD-150423965014933', 0, '', '', '', '', 150.00, '', 10.00, 0.00, 'cash', 1, 0, '2023-04-15 13:14:19'),
(21, 'ORD-190423368160629', 1, 'Shankar Kumar', 'shankar@gmail.com', '', '7717720891', 44.00, '', 100.00, 0.00, 'cash', 1, 0, '2023-04-19 16:40:46'),
(22, 'ORD-1904231398643000', 0, '', '', '', '', 45.00, '', 0.00, 0.00, 'cash', 1, 0, '2023-04-19 16:41:59'),
(23, 'ORD-190423553211049', 0, '', '', '', '', 45.00, '', 0.00, 0.00, 'cash', 1, 0, '2023-04-19 16:58:36'),
(24, 'ORD-1904231269170206', 0, '', '', '', '', 45.00, '', 0.00, 0.00, 'cash', 1, 0, '2023-04-19 17:12:41'),
(25, 'ORD-200423925634347', 0, '', '', '', '', 160.00, '', 0.00, 0.00, 'cash', 1, 0, '2023-04-20 13:30:20');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `orderUniqid` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variation_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `order_status` int(11) NOT NULL COMMENT '0=Confirmed,1=Processing,3=Shipped,4=Delivered,5=Cancel Rrequest,6=Canceled,7=Returned',
  `create_date` datetime NOT NULL,
  `payment_mode` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `orderUniqid`, `user_id`, `product_id`, `variation_id`, `product_name`, `product_image`, `quantity`, `price`, `order_status`, `create_date`, `payment_mode`) VALUES
(1, 1, 'ORD-3110221353920630', 1, 6, 4, 'Bikano Gulab Jamun', 'products_7CA15195FB51355C838A212DDC5B6320.jpg', 1, 220.00, 0, '2022-10-31 10:55:16', '0'),
(2, 2, 'ORD-311022944898721', 0, 7, 5, 'Ghasitaram Gifts Pure Kaju Katlis Box', 'products_AABB5DC933E39031507B8EFD75482C92.jpg', 1, 450.00, 0, '2022-10-31 12:37:50', '1'),
(3, 3, 'ORD-3110221637341925', 0, 6, 4, 'Bikano Gulab Jamun', 'products_7CA15195FB51355C838A212DDC5B6320.jpg', 1, 220.00, 0, '2022-10-31 15:35:11', '0'),
(4, 4, 'ORD-311022378390951', 3, 4, 2, 'sugar cake s', 'products_D53315F3276196DF0F966FD7E443365C.jpg', 1, 120.00, 0, '2022-10-31 15:40:46', '0'),
(5, 5, 'ORD-011122326989212', 1, 6, 4, 'Bikano Gulab Jamun', 'products_7CA15195FB51355C838A212DDC5B6320.jpg', 1, 220.00, 0, '2022-11-01 18:41:47', '0'),
(6, 6, 'ORD-0111221958921894', 0, 10, 6, 'dvb', 'products_0527199CCB1B4D98825D7AB9D8110938.jpg', 1, 160.00, 0, '2022-11-01 18:47:26', '0'),
(7, 7, 'ORD-0211221635616869', 1, 7, 5, 'Ghasitaram Gifts Pure Kaju Katlis Box', 'products_AABB5DC933E39031507B8EFD75482C92.jpg', 1, 450.00, 0, '2022-11-02 15:11:02', '0'),
(8, 7, 'ORD-0211221635616869', 1, 10, 6, 'dvb', 'products_0527199CCB1B4D98825D7AB9D8110938.jpg', 1, 160.00, 0, '2022-11-02 15:11:02', '0'),
(9, 8, 'ORD-0911221025040612', 0, 10, 6, 'dvb', 'products_0527199CCB1B4D98825D7AB9D8110938.jpg', 1, 160.00, 0, '2022-11-09 08:32:50', '0'),
(10, 9, 'ORD-240323286877227', 0, 2, 3, 'cake p gg', 'products_229AD3A0F0BC2F5080A6F81C81A86D0B.jpg', 2, 250.00, 0, '2023-03-24 16:32:27', '0'),
(11, 9, 'ORD-240323286877227', 0, 6, 4, 'Bikano Gulab Jamun', 'products_7CA15195FB51355C838A212DDC5B6320.jpg', 1, 220.00, 0, '2023-03-24 16:32:27', '0'),
(12, 10, 'ORD-2403231534680424', 1, 7, 5, 'Ghasitaram Gifts Pure Kaju Katlis Box', 'products_AABB5DC933E39031507B8EFD75482C92.jpg', 1, 450.00, 0, '2023-03-24 16:34:09', '0'),
(13, 11, 'ORD-240323652197800', 0, 6, 4, 'Bikano Gulab Jamun', 'products_7CA15195FB51355C838A212DDC5B6320.jpg', 2, 220.00, 0, '2023-03-24 16:52:15', '0'),
(14, 12, 'ORD-1004231486997311', 0, 13, 7, 'benarasi saree', 'products_5604EECA4306CED3ADE69A3CA89D9D7B.jpg', 2, 49000.00, 0, '2023-04-10 10:56:44', '0'),
(15, 13, 'ORD-1004231172609834', 0, 13, 7, 'benarasi saree', 'products_5604EECA4306CED3ADE69A3CA89D9D7B.jpg', 1, 49000.00, 0, '2023-04-10 12:34:00', '0'),
(16, 14, 'ORD-1204231098206734', 3, 13, 7, 'benarasi saree', 'products_5604EECA4306CED3ADE69A3CA89D9D7B.jpg', 2, 49000.00, 0, '2023-04-12 11:45:14', '0'),
(17, 15, 'ORD-1204232044277330', 0, 13, 7, 'benarasi saree', 'products_5604EECA4306CED3ADE69A3CA89D9D7B.jpg', 3, 49000.00, 0, '2023-04-12 11:53:50', '0'),
(18, 16, 'ORD-1204231771520239', 0, 10, 6, 'bandhej', 'products_DA17DDBFFDE900D57C30CB4A01EB162C.jpg', 2, 160.00, 0, '2023-04-12 12:02:16', '0'),
(19, 17, 'ORD-1204232073478294', 0, 13, 7, 'benarasi saree', 'products_5604EECA4306CED3ADE69A3CA89D9D7B.jpg', 5, 49000.00, 0, '2023-04-12 12:07:05', '1'),
(20, 18, 'ORD-120423801593702', 1, 10, 6, 'bandhej', 'products_DA17DDBFFDE900D57C30CB4A01EB162C.jpg', 1, 160.00, 0, '2023-04-12 12:38:11', '0'),
(21, 19, 'ORD-1404231488863', 0, 7, 5, 'Silk', 'products_617742F37F89B94AB436AFAAC507E9B5.jpg', 1, 450.00, 0, '2023-04-14 15:32:08', '0'),
(22, 19, 'ORD-1404231488863', 0, 10, 6, 'bandhej', 'products_DA17DDBFFDE900D57C30CB4A01EB162C.jpg', 2, 160.00, 0, '2023-04-14 15:32:08', '0'),
(23, 20, 'ORD-150423965014933', 0, 10, 6, 'bandhej', 'products_DA17DDBFFDE900D57C30CB4A01EB162C.jpg', 1, 160.00, 0, '2023-04-15 13:14:19', '0'),
(24, 21, 'ORD-190423368160629', 1, 7, 5, 'Silk', 'products_617742F37F89B94AB436AFAAC507E9B5.jpg', 1, 45000.00, 0, '2023-04-19 16:40:46', '0'),
(25, 22, 'ORD-1904231398643000', 0, 7, 5, 'Silk', 'products_617742F37F89B94AB436AFAAC507E9B5.jpg', 1, 45000.00, 0, '2023-04-19 16:41:59', '0'),
(26, 23, 'ORD-190423553211049', 0, 7, 5, 'Silk', 'products_617742F37F89B94AB436AFAAC507E9B5.jpg', 1, 45000.00, 0, '2023-04-19 16:58:36', '0'),
(27, 24, 'ORD-1904231269170206', 0, 7, 5, 'Silk', 'products_617742F37F89B94AB436AFAAC507E9B5.jpg', 1, 45000.00, 0, '2023-04-19 17:12:41', '0'),
(28, 25, 'ORD-200423925634347', 0, 10, 6, 'bandhej', 'products_DA17DDBFFDE900D57C30CB4A01EB162C.jpg', 1, 160.00, 0, '2023-04-20 13:30:20', '0');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title_en` text NOT NULL,
  `title_ar` text NOT NULL,
  `page_url` text NOT NULL,
  `en_desc` longtext NOT NULL,
  `ar_desc` longtext NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title_en`, `title_ar`, `page_url`, `en_desc`, `ar_desc`, `status`) VALUES
(1, 'Terms and Conditions', 'الأحكام والشروط', 'terms-and-conditions', '<h1>TERMS AND CONDITIONS</h1><p style=\"color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-size: medium;\">Welcome to www.lorem-ipsum.info. This site is provided as a service to our visitors and may be used for informational purposes only. Because the Terms and Conditions contain legal obligations, please read them carefully.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-weight: bold !important;\">1. YOUR AGREEMENT</h2><p style=\"color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-size: medium;\">By using this Site, you agree to be bound by, and to comply with, these Terms and Conditions. If you do not agree to these Terms and Conditions, please do not use this site.</p><blockquote style=\"color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-size: medium;\" class=\"blockquote\">PLEASE NOTE: We reserve the right, at our sole discretion, to change, modify or otherwise alter these Terms and Conditions at any time. Unless otherwise indicated, amendments will become effective immediately. Please review these Terms and Conditions periodically. Your continued use of the Site following the posting of changes and/or modifications will constitute your acceptance of the revised Terms and Conditions and the reasonableness of these standards for notice of changes. For your information, this page was last updated as of the date at the top of these terms and conditions.</blockquote><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-weight: bold !important;\">2. PRIVACY</h2><p style=\"color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-size: medium;\">Please review our Privacy Policy, which also governs your visit to this Site, to understand our practices.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-weight: bold !important;\">3. LINKED SITES</h2><p style=\"color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-size: medium;\">This Site may contain links to other independent third-party Web sites (\"Linked Sites”). These Linked Sites are provided solely as a convenience to our visitors. Such Linked Sites are not under our control, and we are not responsible for and does not endorse the content of such Linked Sites, including any information or materials contained on such Linked Sites. You will need to make your own independent judgment regarding your interaction with these Linked Sites.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-weight: bold !important;\">4. FORWARD LOOKING STATEMENTS</h2><p style=\"color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-size: medium;\">All materials reproduced on this site speak as of the original date of publication or filing. The fact that a document is available on this site does not mean that the information contained in such document has not been modified or superseded by events or by a subsequent document or filing. We have no duty or policy to update any information or statements contained on this site and, therefore, such information or statements should not be relied upon as being current as of the date you access this site.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-weight: bold !important;\">5. DISCLAIMER OF WARRANTIES AND LIMITATION OF LIABILITY</h2><p style=\"color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-size: medium;\">A. THIS SITE MAY CONTAIN INACCURACIES AND TYPOGRAPHICAL ERRORS. WE DOES NOT WARRANT THE ACCURACY OR COMPLETENESS OF THE MATERIALS OR THE RELIABILITY OF ANY ADVICE, OPINION, STATEMENT OR OTHER INFORMATION DISPLAYED OR DISTRIBUTED THROUGH THE SITE. YOU EXPRESSLY UNDERSTAND AND AGREE THAT: (i) YOUR USE OF THE SITE, INCLUDING ANY RELIANCE ON ANY SUCH OPINION, ADVICE, STATEMENT, MEMORANDUM, OR INFORMATION CONTAINED HEREIN, SHALL BE AT YOUR SOLE RISK; (ii) THE SITE IS PROVIDED ON AN \"AS IS\" AND \"AS AVAILABLE\" BASIS; (iii) EXCEPT AS EXPRESSLY PROVIDED HEREIN WE DISCLAIM ALL WARRANTIES OF ANY KIND, WHETHER EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, WORKMANLIKE EFFORT, TITLE AND NON-INFRINGEMENT; (iv) WE MAKE NO WARRANTY WITH RESPECT TO THE RESULTS THAT MAY BE OBTAINED FROM THIS SITE, THE PRODUCTS OR SERVICES ADVERTISED OR OFFERED OR MERCHANTS INVOLVED; (v) ANY MATERIAL DOWNLOADED OR OTHERWISE OBTAINED THROUGH THE USE OF THE SITE IS DONE AT YOUR OWN DISCRETION AND RISK; and (vi) YOU WILL BE SOLELY RESPONSIBLE FOR ANY DAMAGE TO YOUR COMPUTER SYSTEM OR FOR ANY LOSS OF DATA THAT RESULTS FROM THE DOWNLOAD OF ANY SUCH MATERIAL.</p><p style=\"color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-size: medium;\">B. YOU UNDERSTAND AND AGREE THAT UNDER NO CIRCUMSTANCES, INCLUDING, BUT NOT LIMITED TO, NEGLIGENCE, SHALL WE BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, PUNITIVE OR CONSEQUENTIAL DAMAGES THAT RESULT FROM THE USE OF, OR THE INABILITY TO USE, ANY OF OUR SITES OR MATERIALS OR FUNCTIONS ON ANY SUCH SITE, EVEN IF WE HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. THE FOREGOING LIMITATIONS SHALL APPLY NOTWITHSTANDING ANY FAILURE OF ESSENTIAL PURPOSE OF ANY LIMITED REMEDY.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-weight: bold !important;\">6. EXCLUSIONS AND LIMITATIONS</h2><p style=\"color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-size: medium;\">SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OF CERTAIN WARRANTIES OR THE LIMITATION OR EXCLUSION OF LIABILITY FOR INCIDENTAL OR CONSEQUENTIAL DAMAGES. ACCORDINGLY, OUR LIABILITY IN SUCH JURISDICTION SHALL BE LIMITED TO THE MAXIMUM EXTENT PERMITTED BY LAW.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-weight: bold !important;\">7. OUR PROPRIETARY RIGHTS</h2><p style=\"color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-size: medium;\">This Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party\'s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively \"Trademarks\") or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.</p><p style=\"color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-size: medium;\">The framing, mirroring, scraping or data mining of the Site or any of its content in any form and by any method is expressly prohibited.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-weight: bold !important;\">8. INDEMNITY</h2><p style=\"color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-size: medium;\">By using the Site web sites you agree to indemnify us and affiliated entities (collectively \"Indemnities\") and hold them harmless from any and all claims and expenses, including (without limitation) attorney\'s fees, arising from your use of the Site web sites, your use of the Products and Services, or your submission of ideas and/or related materials to us or from any person\'s use of any ID, membership or password you maintain with any portion of the Site, regardless of whether such use is authorized by you.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-weight: bold !important;\">9. COPYRIGHT AND TRADEMARK NOTICE</h2><p style=\"color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-size: medium;\">Except our generated dummy copy, which is free to use for private and commercial use, all other text is copyrighted. generator.lorem-ipsum.info © 2013, all rights reserved</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-weight: bold !important;\">10. INTELLECTUAL PROPERTY INFRINGEMENT CLAIMS</h2><p style=\"color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-size: medium;\">It is our policy to respond expeditiously to claims of intellectual property infringement. We will promptly process and investigate notices of alleged infringement and will take appropriate actions under the Digital Millennium Copyright Act (\"DMCA\") and other applicable intellectual property laws. Notices of claimed infringement should be directed to:</p><p style=\"color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-size: medium;\">generator.lorem-ipsum.info</p><p style=\"color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-size: medium;\">126 Electricov St.</p><p style=\"color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-size: medium;\">Kiev, Kiev 04176</p><p style=\"color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-size: medium;\">Ukraine</p><p style=\"color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-size: medium;\">contact@lorem-ipsum.info</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-weight: bold !important;\">11. PLACE OF PERFORMANCE</h2><p style=\"color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-size: medium;\">This Site is controlled, operated and administered by us from our office in Kiev, Ukraine. We make no representation that materials at this site are appropriate or available for use at other locations outside of the Ukraine and access to them from territories where their contents are illegal is prohibited. If you access this Site from a location outside of the Ukraine, you are responsible for compliance with all local laws.</p><h2 style=\"font-size: 13px; color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-weight: bold !important;\">12. GENERAL</h2><p style=\"color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-size: medium;\">A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer\'s documents or purchase orders.</p><p style=\"color: rgb(0, 0, 0); font-family: \"Times New Roman\"; font-size: medium;\">B. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.</p>', '<div style=\"text-align: right;\"><h1 style=\"font-family: \" source=\"\" sans=\"\" pro\",=\"\" -apple-system,=\"\" blinkmacsystemfont,=\"\" \"segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" ui=\"\" symbol\";=\"\" color:=\"\" rgb(33,=\"\" 37,=\"\" 41);=\"\" text-align:=\"\" left;\"=\"\">TERMS AND CONDITIONS</h1><p times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"text-align: left; color: rgb(0, 0, 0);\">Welcome to www.lorem-ipsum.info. This site is provided as a service to our visitors and may be used for informational purposes only. Because the Terms and Conditions contain legal obligations, please read them carefully.</p><h2 times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\" style=\"font-family: \" source=\"\" sans=\"\" pro\",=\"\" -apple-system,=\"\" blinkmacsystemfont,=\"\" \"segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" ui=\"\" symbol\";=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);=\"\" font-size:=\"\" 13px;=\"\" text-align:=\"\" left;\"=\"\">1. YOUR AGREEMENT</h2><p times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"text-align: left; color: rgb(0, 0, 0);\">By using this Site, you agree to be bound by, and to comply with, these Terms and Conditions. If you do not agree to these Terms and Conditions, please do not use this site.</p><blockquote times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\" class=\"blockquote\" style=\"text-align: left; color: rgb(0, 0, 0);\">PLEASE NOTE: We reserve the right, at our sole discretion, to change, modify or otherwise alter these Terms and Conditions at any time. Unless otherwise indicated, amendments will become effective immediately. Please review these Terms and Conditions periodically. Your continued use of the Site following the posting of changes and/or modifications will constitute your acceptance of the revised Terms and Conditions and the reasonableness of these standards for notice of changes. For your information, this page was last updated as of the date at the top of these terms and conditions.</blockquote><h2 times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\" style=\"font-family: \" source=\"\" sans=\"\" pro\",=\"\" -apple-system,=\"\" blinkmacsystemfont,=\"\" \"segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" ui=\"\" symbol\";=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);=\"\" font-size:=\"\" 13px;=\"\" text-align:=\"\" left;\"=\"\">2. PRIVACY</h2><p times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"text-align: left; color: rgb(0, 0, 0);\">Please review our Privacy Policy, which also governs your visit to this Site, to understand our practices.</p><h2 times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\" style=\"font-family: \" source=\"\" sans=\"\" pro\",=\"\" -apple-system,=\"\" blinkmacsystemfont,=\"\" \"segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" ui=\"\" symbol\";=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);=\"\" font-size:=\"\" 13px;=\"\" text-align:=\"\" left;\"=\"\">3. LINKED SITES</h2><p times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"text-align: left; color: rgb(0, 0, 0);\">This Site may contain links to other independent third-party Web sites (\"Linked Sites”). These Linked Sites are provided solely as a convenience to our visitors. Such Linked Sites are not under our control, and we are not responsible for and does not endorse the content of such Linked Sites, including any information or materials contained on such Linked Sites. You will need to make your own independent judgment regarding your interaction with these Linked Sites.</p><h2 times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\" style=\"font-family: \" source=\"\" sans=\"\" pro\",=\"\" -apple-system,=\"\" blinkmacsystemfont,=\"\" \"segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" ui=\"\" symbol\";=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);=\"\" font-size:=\"\" 13px;=\"\" text-align:=\"\" left;\"=\"\">4. FORWARD LOOKING STATEMENTS</h2><p times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"text-align: left; color: rgb(0, 0, 0);\">All materials reproduced on this site speak as of the original date of publication or filing. The fact that a document is available on this site does not mean that the information contained in such document has not been modified or superseded by events or by a subsequent document or filing. We have no duty or policy to update any information or statements contained on this site and, therefore, such information or statements should not be relied upon as being current as of the date you access this site.</p><h2 times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\" style=\"font-family: \" source=\"\" sans=\"\" pro\",=\"\" -apple-system,=\"\" blinkmacsystemfont,=\"\" \"segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" ui=\"\" symbol\";=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);=\"\" font-size:=\"\" 13px;=\"\" text-align:=\"\" left;\"=\"\">5. DISCLAIMER OF WARRANTIES AND LIMITATION OF LIABILITY</h2><p times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"text-align: left; color: rgb(0, 0, 0);\">A. THIS SITE MAY CONTAIN INACCURACIES AND TYPOGRAPHICAL ERRORS. WE DOES NOT WARRANT THE ACCURACY OR COMPLETENESS OF THE MATERIALS OR THE RELIABILITY OF ANY ADVICE, OPINION, STATEMENT OR OTHER INFORMATION DISPLAYED OR DISTRIBUTED THROUGH THE SITE. YOU EXPRESSLY UNDERSTAND AND AGREE THAT: (i) YOUR USE OF THE SITE, INCLUDING ANY RELIANCE ON ANY SUCH OPINION, ADVICE, STATEMENT, MEMORANDUM, OR INFORMATION CONTAINED HEREIN, SHALL BE AT YOUR SOLE RISK; (ii) THE SITE IS PROVIDED ON AN \"AS IS\" AND \"AS AVAILABLE\" BASIS; (iii) EXCEPT AS EXPRESSLY PROVIDED HEREIN WE DISCLAIM ALL WARRANTIES OF ANY KIND, WHETHER EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, WORKMANLIKE EFFORT, TITLE AND NON-INFRINGEMENT; (iv) WE MAKE NO WARRANTY WITH RESPECT TO THE RESULTS THAT MAY BE OBTAINED FROM THIS SITE, THE PRODUCTS OR SERVICES ADVERTISED OR OFFERED OR MERCHANTS INVOLVED; (v) ANY MATERIAL DOWNLOADED OR OTHERWISE OBTAINED THROUGH THE USE OF THE SITE IS DONE AT YOUR OWN DISCRETION AND RISK; and (vi) YOU WILL BE SOLELY RESPONSIBLE FOR ANY DAMAGE TO YOUR COMPUTER SYSTEM OR FOR ANY LOSS OF DATA THAT RESULTS FROM THE DOWNLOAD OF ANY SUCH MATERIAL.</p><p times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"text-align: left; color: rgb(0, 0, 0);\">B. YOU UNDERSTAND AND AGREE THAT UNDER NO CIRCUMSTANCES, INCLUDING, BUT NOT LIMITED TO, NEGLIGENCE, SHALL WE BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, PUNITIVE OR CONSEQUENTIAL DAMAGES THAT RESULT FROM THE USE OF, OR THE INABILITY TO USE, ANY OF OUR SITES OR MATERIALS OR FUNCTIONS ON ANY SUCH SITE, EVEN IF WE HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. THE FOREGOING LIMITATIONS SHALL APPLY NOTWITHSTANDING ANY FAILURE OF ESSENTIAL PURPOSE OF ANY LIMITED REMEDY.</p><h2 times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\" style=\"font-family: \" source=\"\" sans=\"\" pro\",=\"\" -apple-system,=\"\" blinkmacsystemfont,=\"\" \"segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" ui=\"\" symbol\";=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);=\"\" font-size:=\"\" 13px;=\"\" text-align:=\"\" left;\"=\"\">6. EXCLUSIONS AND LIMITATIONS</h2><p times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"text-align: left; color: rgb(0, 0, 0);\">SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OF CERTAIN WARRANTIES OR THE LIMITATION OR EXCLUSION OF LIABILITY FOR INCIDENTAL OR CONSEQUENTIAL DAMAGES. ACCORDINGLY, OUR LIABILITY IN SUCH JURISDICTION SHALL BE LIMITED TO THE MAXIMUM EXTENT PERMITTED BY LAW.</p><h2 times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\" style=\"font-family: \" source=\"\" sans=\"\" pro\",=\"\" -apple-system,=\"\" blinkmacsystemfont,=\"\" \"segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" ui=\"\" symbol\";=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);=\"\" font-size:=\"\" 13px;=\"\" text-align:=\"\" left;\"=\"\">7. OUR PROPRIETARY RIGHTS</h2><p times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"text-align: left; color: rgb(0, 0, 0);\">This Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party\'s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively \"Trademarks\") or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.</p><p times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"text-align: left; color: rgb(0, 0, 0);\">The framing, mirroring, scraping or data mining of the Site or any of its content in any form and by any method is expressly prohibited.</p><h2 times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\" style=\"font-family: \" source=\"\" sans=\"\" pro\",=\"\" -apple-system,=\"\" blinkmacsystemfont,=\"\" \"segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" ui=\"\" symbol\";=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);=\"\" font-size:=\"\" 13px;=\"\" text-align:=\"\" left;\"=\"\">8. INDEMNITY</h2><p times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"text-align: left; color: rgb(0, 0, 0);\">By using the Site web sites you agree to indemnify us and affiliated entities (collectively \"Indemnities\") and hold them harmless from any and all claims and expenses, including (without limitation) attorney\'s fees, arising from your use of the Site web sites, your use of the Products and Services, or your submission of ideas and/or related materials to us or from any person\'s use of any ID, membership or password you maintain with any portion of the Site, regardless of whether such use is authorized by you.</p><h2 times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\" style=\"font-family: \" source=\"\" sans=\"\" pro\",=\"\" -apple-system,=\"\" blinkmacsystemfont,=\"\" \"segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" ui=\"\" symbol\";=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);=\"\" font-size:=\"\" 13px;=\"\" text-align:=\"\" left;\"=\"\">9. COPYRIGHT AND TRADEMARK NOTICE</h2><p times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"text-align: left; color: rgb(0, 0, 0);\">Except our generated dummy copy, which is free to use for private and commercial use, all other text is copyrighted. generator.lorem-ipsum.info © 2013, all rights reserved</p><h2 times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\" style=\"font-family: \" source=\"\" sans=\"\" pro\",=\"\" -apple-system,=\"\" blinkmacsystemfont,=\"\" \"segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" ui=\"\" symbol\";=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);=\"\" font-size:=\"\" 13px;=\"\" text-align:=\"\" left;\"=\"\">10. INTELLECTUAL PROPERTY INFRINGEMENT CLAIMS</h2><p times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"text-align: left; color: rgb(0, 0, 0);\">It is our policy to respond expeditiously to claims of intellectual property infringement. We will promptly process and investigate notices of alleged infringement and will take appropriate actions under the Digital Millennium Copyright Act (\"DMCA\") and other applicable intellectual property laws. Notices of claimed infringement should be directed to:</p><p times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"text-align: left; color: rgb(0, 0, 0);\">generator.lorem-ipsum.info</p><p times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"text-align: left; color: rgb(0, 0, 0);\">126 Electricov St.</p><p times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"text-align: left; color: rgb(0, 0, 0);\">Kiev, Kiev 04176</p><p times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"text-align: left; color: rgb(0, 0, 0);\">Ukraine</p><p times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"text-align: left; color: rgb(0, 0, 0);\">contact@lorem-ipsum.info</p><h2 times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\" style=\"font-family: \" source=\"\" sans=\"\" pro\",=\"\" -apple-system,=\"\" blinkmacsystemfont,=\"\" \"segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" ui=\"\" symbol\";=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);=\"\" font-size:=\"\" 13px;=\"\" text-align:=\"\" left;\"=\"\">11. PLACE OF PERFORMANCE</h2><p times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"text-align: left; color: rgb(0, 0, 0);\">This Site is controlled, operated and administered by us from our office in Kiev, Ukraine. We make no representation that materials at this site are appropriate or available for use at other locations outside of the Ukraine and access to them from territories where their contents are illegal is prohibited. If you access this Site from a location outside of the Ukraine, you are responsible for compliance with all local laws.</p><h2 times=\"\" new=\"\" roman\";=\"\" font-weight:=\"\" bold=\"\" !important;\"=\"\" style=\"font-family: \" source=\"\" sans=\"\" pro\",=\"\" -apple-system,=\"\" blinkmacsystemfont,=\"\" \"segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" ui=\"\" symbol\";=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);=\"\" font-size:=\"\" 13px;=\"\" text-align:=\"\" left;\"=\"\">12. GENERAL</h2><p times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"text-align: left; color: rgb(0, 0, 0);\">A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer\'s documents or purchase orders.</p><p times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"text-align: left; color: rgb(0, 0, 0);\">B. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.</p></div>', 1),
(2, 'Privacy Policy', 'سياسة خاصة', 'privacy-policy', '<h1>PRIVACY POLICY</h1><p><span style=\"font-family: \"Mercury SSm A\", \"Mercury SSm B\", Georgia, Times, \"Times New Roman\", \"Microsoft YaHei New\", \"Microsoft Yahei\", 微软雅黑, 宋体, SimSun, STXihei, 华文细黑, serif; font-size: 19px; background-color: rgb(255, 255, 255);\"><font color=\"#000000\" style=\"\">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private. As the owner and operator of loremipsum.io (the \"Website\") hereafter referred to in this Privacy Policy as \"Lorem Ipsum\", \"us\", \"our\" or \"we\", we have provided this Privacy Policy to explain how we collect, use, share and protect information about the users of our Website (hereafter referred to as “user”, “you” or \"your\"). For the purposes of this Agreement, any use of the terms \"Lorem Ipsum\", \"us\", \"our\" or \"we\" includes Wasai LLC, without limitation. We will not use or share your personal information with anyone except as described in this Privacy Policy.</font></span></p><h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\">What is Lorem Ipsum?</h2><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\"><strong style=\"margin: 0px; padding: 0px; font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p><h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\">Where does it come from?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p><h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\">Why do we use it?</h2><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\"><span style=\"font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">t is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</span></p><h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\">Where can I get some?</h2><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\"><span style=\"font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</span><br></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\"><br></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\"><br></p><p><span style=\"font-family: \"Mercury SSm A\", \"Mercury SSm B\", Georgia, Times, \"Times New Roman\", \"Microsoft YaHei New\", \"Microsoft Yahei\", 微软雅黑, 宋体, SimSun, STXihei, 华文细黑, serif; font-size: 19px; background-color: rgb(255, 255, 255);\"><font color=\"#000000\" style=\"\"><br></font></span><br></p>', '<h1 style=\"text-align: right; \" source=\"\" sans=\"\" pro\",=\"\" -apple-system,=\"\" blinkmacsystemfont,=\"\" \"segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" ui=\"\" symbol\";=\"\" color:=\"\" rgb(33,=\"\" 37,=\"\" 41);\"=\"\">PRIVACY POLICY</h1><p><span style=\"font-family: \" mercury=\"\" ssm=\"\" a\",=\"\" \"mercury=\"\" b\",=\"\" georgia,=\"\" times,=\"\" \"times=\"\" new=\"\" roman\",=\"\" \"microsoft=\"\" yahei=\"\" new\",=\"\" yahei\",=\"\" 微软雅黑,=\"\" 宋体,=\"\" simsun,=\"\" stxihei,=\"\" 华文细黑,=\"\" serif;=\"\" font-size:=\"\" 19px;\"=\"\"><font color=\"#000000\">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private. As the owner and operator of loremipsum.io (the \"Website\") hereafter referred to in this Privacy Policy as \"Lorem Ipsum\", \"us\", \"our\" or \"we\", we have provided this Privacy Policy to explain how we collect, use, share and protect information about the users of our Website (hereafter referred to as “user”, “you” or \"your\"). For the purposes of this Agreement, any use of the terms \"Lorem Ipsum\", \"us\", \"our\" or \"we\" includes Wasai LLC, without limitation. We will not use or share your personal information with anyone except as described in this Privacy Policy.</font></span></p><h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-family: DauphinPlain; line-height: 24px; color: rgb(0, 0, 0); font-size: 24px; padding: 0px;\">What is Lorem Ipsum?</h2><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\"><span style=\"font-weight: bolder; margin: 0px; padding: 0px; font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">Lorem Ipsum</span><span style=\"font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p><h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-family: DauphinPlain; line-height: 24px; color: rgb(0, 0, 0); font-size: 24px; padding: 0px;\">Where does it come from?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p><h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-family: DauphinPlain; line-height: 24px; color: rgb(0, 0, 0); font-size: 24px; padding: 0px;\">Why do we use it?</h2><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\"><span style=\"font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">t is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</span></p><h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-family: DauphinPlain; line-height: 24px; color: rgb(0, 0, 0); font-size: 24px; padding: 0px;\">Where can I get some?</h2><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\"><span style=\"font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</span><br></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\"><br></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\"><br></p><p><span style=\"font-family: \" mercury=\"\" ssm=\"\" a\",=\"\" \"mercury=\"\" b\",=\"\" georgia,=\"\" times,=\"\" \"times=\"\" new=\"\" roman\",=\"\" \"microsoft=\"\" yahei=\"\" new\",=\"\" yahei\",=\"\" 微软雅黑,=\"\" 宋体,=\"\" simsun,=\"\" stxihei,=\"\" 华文细黑,=\"\" serif;=\"\" font-size:=\"\" 19px;\"=\"\"><font color=\"#000000\"><br></font></span></p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `titleUrl` text NOT NULL,
  `description` longtext NOT NULL,
  `sort_description` mediumtext NOT NULL,
  `category` varchar(255) NOT NULL,
  `categories` varchar(250) NOT NULL,
  `subcategory` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `product_type` varchar(250) NOT NULL,
  `raw_name` varchar(255) NOT NULL,
  `raw_quantity` varchar(255) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `measure_unit` varchar(150) NOT NULL,
  `createdby` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `titleUrl`, `description`, `sort_description`, `category`, `categories`, `subcategory`, `status`, `product_type`, `raw_name`, `raw_quantity`, `product_qty`, `measure_unit`, `createdby`, `create_date`, `update_date`) VALUES
(13, 'benarasi saree', 'benarasi-saree', '', '', '', '14', '2', 1, '', '[\"\"]', '[\"\"]', 17, '', 1, '2023-04-10 10:54:46', '2023-04-10 13:24:46'),
(6, 'cotton', 'cotton', '', '<p><span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters</span><br></p>', '', '15', '3', 1, '', '[\"\",\"\",\"\"]', '[\"2\",\"1\",\"2\"]', 12, '', 1, '2022-10-17 10:12:57', '2023-04-10 10:49:51'),
(14, 'Test23', 'test23-1695734948', '', '<p>fsdfsd</p>', '', '15', '4', 1, '', '[\"11\"]', '[\"10\"]', 24, '', 1, '2023-09-26 15:14:19', '2023-09-26 16:29:08'),
(7, 'Silk', 'silk-1681905457', '', '', '', '15', '2', 0, '', '[\"\",\"\",\"\"]', '[\"1\",\"1\",\"1\"]', 21, '', 1, '2022-10-17 10:33:38', '2023-04-19 14:57:37'),
(10, 'bandhej', 'bandhej', '', '', '', '15', '2', 1, '', '[\"\",\"\",\"\"]', '[\"1\",\"4\",\"4\"]', 13, '', 1, '2022-11-01 18:16:19', '2023-04-10 10:42:44');

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `mrp_price` double(10,2) NOT NULL,
  `sale_price` double(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `color` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `gallery` mediumtext NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `attributes` longtext NOT NULL,
  `raw_name` varchar(255) NOT NULL,
  `raw_quantity` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_variations`
--

INSERT INTO `product_variations` (`id`, `product_id`, `mrp_price`, `sale_price`, `quantity`, `color`, `size`, `image`, `gallery`, `status`, `attributes`, `raw_name`, `raw_quantity`, `create_date`, `update_date`) VALUES
(5, 7, 60000.00, 45000.00, 19, 0, 0, 'products_617742F37F89B94AB436AFAAC507E9B5.jpg', '[\"products_617742F37F89B94AB436AFAAC507E9B51.jpg\"]', 1, '', '', '', '2022-10-17 10:34:35', '2023-04-19 14:58:27'),
(2, 4, 150.00, 120.00, 2, 0, 20, 'products_D53315F3276196DF0F966FD7E443365C.jpg', '', 1, '', '', '', '2022-09-29 16:51:12', '2022-09-29 13:51:12'),
(3, 2, 150.00, 250.00, 200, 0, 20, 'products_229AD3A0F0BC2F5080A6F81C81A86D0B.jpg', '[\"products_229AD3A0F0BC2F5080A6F81C81A86D0B1.jpg\"]', 1, '', '', '', '2022-09-29 16:52:58', '2022-09-29 13:52:58'),
(4, 6, 240.00, 220.00, 22, 0, 0, 'products_FBC1DF84C462CD5A8BF0AD968104C56B.jpg', '[\"products_7CA15195FB51355C838A212DDC5B63201.jpg\",\"products_FBC1DF84C462CD5A8BF0AD968104C56B1.jpg\"]', 1, '', '', '', '2022-10-17 10:15:06', '2023-04-10 10:51:24'),
(6, 10, 180.00, 160.00, 2, 0, 23, 'products_DA17DDBFFDE900D57C30CB4A01EB162C.jpg', '[\"products_DA17DDBFFDE900D57C30CB4A01EB162C1.jpg\"]', 1, '', '', '', '2022-11-01 18:27:57', '2023-04-10 10:45:40'),
(7, 13, 50000.00, 49000.00, 0, 0, 0, 'products_5604EECA4306CED3ADE69A3CA89D9D7B.jpg', '[\"products_5604EECA4306CED3ADE69A3CA89D9D7B1.jpg\"]', 1, '', '', '', '2023-04-10 10:55:43', '2023-04-10 13:25:43'),
(8, 14, 120.00, 100.00, 0, 0, 0, 'products_62B1DF3AC3D1E6346E1A8538A397289F.png', '', 1, '', '', '', '2023-09-26 15:15:17', '2023-09-26 17:45:17');

-- --------------------------------------------------------

--
-- Table structure for table `raw_material`
--

CREATE TABLE `raw_material` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `titleUrl` varchar(255) NOT NULL,
  `quantity` varchar(120) NOT NULL,
  `measure_unit` varchar(120) NOT NULL,
  `unit` varchar(120) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createdby` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `raw_material`
--

INSERT INTO `raw_material` (`id`, `name`, `titleUrl`, `quantity`, `measure_unit`, `unit`, `status`, `createdby`, `create_date`, `update_date`) VALUES
(4, 'Egg', 'egg', '116', '4', '', 1, 1, '2022-09-22 10:48:58', '2022-09-22 07:48:58'),
(5, 'Cream', 'cream', '17', '1', '', 1, 1, '2022-09-22 10:49:35', '2022-09-22 07:49:35'),
(6, 'Sugar', 'sugar', '14', '1', '', 1, 1, '2022-09-22 10:50:18', '2022-09-22 07:50:18'),
(8, 'Milk', 'milk', '10', '3', '', 1, 1, '2022-10-17 10:08:38', '2022-10-17 07:08:38'),
(9, 'Refined wheat flour', 'refined-wheat-flour', '5', '1', '', 1, 1, '2022-10-17 10:10:52', '2022-10-17 07:10:52'),
(10, 'Pulses', 'pulses', '2', '1', '', 1, 1, '2022-11-01 16:17:58', '2022-11-01 13:17:58'),
(11, 'new demo', 'new-demo', '0', '1', '', 1, 1, '2023-09-26 13:16:47', '2023-09-26 15:46:47');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` int(11) NOT NULL,
  `name_en` text NOT NULL,
  `name_ar` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `banner` varchar(200) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `url` text NOT NULL,
  `status` int(11) NOT NULL,
  `categories` text NOT NULL,
  `city` varchar(200) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `name_en`, `name_ar`, `email`, `mobile`, `password`, `banner`, `logo`, `url`, `status`, `categories`, `city`, `create_date`) VALUES
(1, 'Primo Emporios', 'Primo Emporiod', 'PrimoEmporio@gmail.com', '98695895', '1234567', 'shop_934E329725612AB6103E4DF5F7C3A286.png', 'shop_14954F67C7834931F625A103681F9A25.png', 'primo-emporios', 1, '13,11,10,9,8', 'salmiya', '2022-05-03 13:05:38'),
(2, 'By-Sh', 'By-Sh', 'Bysh@gmail.com', '98265465', '123456789', 'shop_52BD6871D0F5B6A3076A8FC4D34F9B3E.jpeg', 'shop_895A65F4E728E6DE2005B7BF73BA00AA.jpeg', 'by-sh', 1, '13,11,10,9', 'salmiya', '2022-05-05 06:55:46'),
(3, 'trica', 'trica', 'trica@gmail.com', '95235656', '123456789', 'shop_E581E067B0A1DDA4F8A5938FBC3EF2DB.jpeg', 'shop_347A0D56788D522354DE2FD5F2403A78.jpeg', 'trica', 1, '13,11,10,9', 'salmiya', '2022-05-05 06:57:12'),
(4, 'testing', 'تيست', 'alameri92@hotmail.com', '99292002', '123456', 'shop_8B85C109E72585C6FD09A601B748C3DC.png', 'shop_184282ECBD2F054630C25061AF8FBCB4.png', 'testing', 1, '13,11', 'salmiya', '2022-05-15 19:45:06');

-- --------------------------------------------------------

--
-- Table structure for table `signup_temp`
--

CREATE TABLE `signup_temp` (
  `id` bigint(20) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_number` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `login_type` int(11) NOT NULL COMMENT '0=Normal,1=Google,2=Facebook',
  `status` int(11) NOT NULL DEFAULT '0',
  `signup_otp` int(11) NOT NULL,
  `access_token` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `signup_temp`
--

INSERT INTO `signup_temp` (`id`, `customer_name`, `email`, `mobile_number`, `password`, `login_type`, `status`, `signup_otp`, `access_token`, `created_at`) VALUES
(1, 'Siddu Kaul', 'Siddu@gmail.com', '96598989898', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, 91829, '', '2022-05-25 12:46:18'),
(2, 'alshaab', 'aalfarhan@gmail.com', '99417776', '81dc9bdb52d04dc20036dbd8313ed055', 0, 0, 84509, '', '2022-06-21 17:41:42'),
(4, 'siddhu singh', 'siddhukool@gmail.com', '78795538', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, 58494, '', '2022-07-14 11:39:42'),
(5, 'Siddu Kaul', 'Siddu@gmail.com', '96598989898', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, 95737, '', '2022-07-14 16:56:49');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `titleUrl` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `categories` varchar(300) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createdby` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `date`) VALUES
(1, 'developer@test.com', '2021-09-14 11:10:03'),
(3, 'chhayatrylogic@gmail.com', '2021-09-23 12:07:55'),
(4, 'siddhukol@gmail.com', '2021-11-08 13:20:58');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(250) NOT NULL,
  `name_url` varchar(250) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createdby` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `name_url`, `category_id`, `image`, `status`, `createdby`, `create_date`) VALUES
(2, 'New Style', 'new-style', 14, '', 1, 1, '2022-09-20 13:44:40'),
(3, 'Rasgulas', 'rasgulas', 15, '', 1, 1, '2022-10-17 10:05:34'),
(4, 'Barfi', 'barfi', 15, '', 1, 1, '2022-10-17 10:31:55');

-- --------------------------------------------------------

--
-- Table structure for table `user_cart`
--

CREATE TABLE `user_cart` (
  `id` int(11) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variation_id` int(11) NOT NULL,
  `color` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_cart`
--

INSERT INTO `user_cart` (`id`, `user_id`, `product_id`, `variation_id`, `color`, `size`, `quantity`, `create_date`, `update_date`) VALUES
(98, '', 6, 4, 0, 0, 1, '2023-11-23 11:58:34', '2023-11-23 11:58:34'),
(96, '', 10, 6, 0, 23, 2, '2023-11-18 11:02:48', '2023-11-18 11:02:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `area_table`
--
ALTER TABLE `area_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers_wishlist`
--
ALTER TABLE `customers_wishlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `measurement_units`
--
ALTER TABLE `measurement_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw_material`
--
ALTER TABLE `raw_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signup_temp`
--
ALTER TABLE `signup_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `area_table`
--
ALTER TABLE `area_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `customers_wishlist`
--
ALTER TABLE `customers_wishlist`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `measurement_units`
--
ALTER TABLE `measurement_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `raw_material`
--
ALTER TABLE `raw_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `signup_temp`
--
ALTER TABLE `signup_temp`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_cart`
--
ALTER TABLE `user_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
