-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 05 Feb 2017 pada 13.49
-- Versi Server: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `academic`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `acos`
--

DROP TABLE IF EXISTS `acos`;
CREATE TABLE `acos` (
  `id` int(10) NOT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `status` smallint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `acos`
--

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `description`, `lft`, `rght`, `remarks`, `status`, `created`, `modified`) VALUES
(1, NULL, NULL, NULL, 'superadmin', '', 1, 82, NULL, 1, '2014-11-25 00:00:00', '2014-11-26 10:21:30'),
(2, 1, NULL, NULL, 'Administrator', '-', 66, 75, NULL, 1, '2017-02-02 23:31:26', '2017-02-02 23:31:26'),
(3, 2, NULL, NULL, 'Admin', '-', 67, 68, NULL, 1, '2017-02-02 23:32:57', '2017-02-02 23:32:57'),
(4, 2, NULL, NULL, 'Module_Object', '-', 69, 70, NULL, 1, '2017-02-02 23:33:25', '2017-02-02 23:33:25'),
(5, 2, NULL, NULL, 'Admin_Group', '-', 71, 72, NULL, 1, '2017-02-02 23:33:55', '2017-02-02 23:33:55'),
(6, 1, NULL, NULL, 'Dashboard', '-', 76, 77, NULL, 1, '2017-02-02 23:34:19', '2017-02-02 23:34:19'),
(7, 2, NULL, NULL, 'Permission', '-', 73, 74, NULL, 1, '2017-02-02 23:36:48', '2017-02-02 23:36:48'),
(8, 1, NULL, NULL, 'Kelas', '-', 78, 79, NULL, 1, '2017-02-03 00:12:57', '2017-02-03 00:12:57'),
(9, 1, NULL, NULL, 'Pelajaran', '-', 80, 81, NULL, 1, '2017-02-05 19:17:41', '2017-02-05 19:17:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `aro_id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `aro_id`, `username`, `fullname`, `password`, `status`, `created`, `modified`) VALUES
(1, 1, 'admin', 'Superadmin', '2sXP4s+SqZI=', 1, '2014-02-06 04:09:01', '2016-11-22 14:29:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_groups`
--

DROP TABLE IF EXISTS `admin_groups`;
CREATE TABLE `admin_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `admin_groups`
--

INSERT INTO `admin_groups` (`id`, `name`, `description`, `status`, `created`, `modified`) VALUES
(1, 'superadmin', '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `aros`
--

DROP TABLE IF EXISTS `aros`;
CREATE TABLE `aros` (
  `id` int(10) NOT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  `total_admin` int(11) NOT NULL DEFAULT '0',
  `status` smallint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `description`, `lft`, `rght`, `total_admin`, `status`, `created`, `modified`) VALUES
(1, NULL, NULL, NULL, 'superadmin', '', 1, 14, 1, 1, '2014-11-25 00:00:00', '2014-11-25 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `aros_acos`
--

DROP TABLE IF EXISTS `aros_acos`;
CREATE TABLE `aros_acos` (
  `id` bigint(20) NOT NULL,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `aros_acos`
--

INSERT INTO `aros_acos` (`id`, `aro_id`, `aco_id`, `_create`, `_read`, `_update`, `_delete`) VALUES
(21, 1, 8, '1', '1', '1', '1'),
(20, 1, 6, '1', '1', '1', '1'),
(19, 1, 7, '1', '1', '1', '1'),
(18, 1, 5, '1', '1', '1', '1'),
(17, 1, 4, '1', '1', '1', '1'),
(16, 1, 3, '1', '1', '1', '1'),
(15, 1, 2, '1', '1', '1', '1'),
(22, 1, 9, '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cms_menus`
--

DROP TABLE IF EXISTS `cms_menus`;
CREATE TABLE `cms_menus` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `sort` int(2) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `cms_menus`
--

INSERT INTO `cms_menus` (`id`, `name`, `url`, `sort`, `class`, `status`) VALUES
(1, 'Dashboard', 'Home/Index', 1, 'dash', 1),
(2, 'Kelas', 'Kelas/Index', 3, 'catalog', 1),
(3, 'Administrator', '', 2, 'user', 1),
(4, 'Pelajaran', 'Pelajarans/Index', 4, 'forms', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cms_submenus`
--

DROP TABLE IF EXISTS `cms_submenus`;
CREATE TABLE `cms_submenus` (
  `id` int(11) NOT NULL,
  `cms_menu_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `cms_submenus`
--

INSERT INTO `cms_submenus` (`id`, `cms_menu_id`, `name`, `url`, `status`) VALUES
(2, 3, 'Admin', 'Admins/Index', 1),
(3, 3, 'Admin Group', 'Aros/Index', 1),
(4, 3, 'Module Object', 'Acos/Index', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `contents`
--

DROP TABLE IF EXISTS `contents`;
CREATE TABLE `contents` (
  `id` int(11) NOT NULL,
  `model` varchar(100) NOT NULL,
  `model_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `host` varchar(255) NOT NULL,
  `url` varchar(100) NOT NULL,
  `cloud` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=Masih di server loka,1=Sudah di server cloud',
  `mime_type` varchar(100) NOT NULL,
  `path` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `contents`
--

INSERT INTO `contents` (`id`, `model`, `model_id`, `type`, `host`, `url`, `cloud`, `mime_type`, `path`) VALUES
(408, 'DiningServiceImage', 4, 'big', 'http://dummy-bedrock.com/', 'contents/DiningServiceImage/4/4_big.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/DiningServiceImage/4/4_big.jpg'),
(407, 'DiningServiceImage', 4, 'thumb', 'http://dummy-bedrock.com/', 'contents/DiningServiceImage/4/4_thumb.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/DiningServiceImage/4/4_thumb.jpg'),
(406, 'DiningServiceImage', 3, 'big', 'http://dummy-bedrock.com/', 'contents/DiningServiceImage/3/3_big.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/DiningServiceImage/3/3_big.jpg'),
(405, 'DiningServiceImage', 3, 'thumb', 'http://dummy-bedrock.com/', 'contents/DiningServiceImage/3/3_thumb.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/DiningServiceImage/3/3_thumb.jpg'),
(404, 'DiningServiceImage', 2, 'big', 'http://dummy-bedrock.com/', 'contents/DiningServiceImage/2/2_big.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/DiningServiceImage/2/2_big.jpg'),
(403, 'DiningServiceImage', 2, 'thumb', 'http://dummy-bedrock.com/', 'contents/DiningServiceImage/2/2_thumb.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/DiningServiceImage/2/2_thumb.jpg'),
(402, 'DiningServiceImage', 1, 'big', 'http://dummy-bedrock.com/', 'contents/DiningServiceImage/1/1_big.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/DiningServiceImage/1/1_big.jpg'),
(401, 'DiningServiceImage', 1, 'thumb', 'http://dummy-bedrock.com/', 'contents/DiningServiceImage/1/1_thumb.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/DiningServiceImage/1/1_thumb.jpg'),
(400, 'WebPage', 6, 'big', 'http://dummy-bedrock.com/', 'contents/WebPage/6/6_big.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/WebPage/6/6_big.jpg'),
(399, 'WebPage', 6, 'thumb', 'http://dummy-bedrock.com/', 'contents/WebPage/6/6_thumb.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/WebPage/6/6_thumb.jpg'),
(398, 'SpecialOffer', 2, 'big', 'http://dummy-bedrock.com/', 'contents/SpecialOffer/2/2_big.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/SpecialOffer/2/2_big.jpg'),
(397, 'SpecialOffer', 2, 'thumb', 'http://dummy-bedrock.com/', 'contents/SpecialOffer/2/2_thumb.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/SpecialOffer/2/2_thumb.jpg'),
(396, 'SpecialOffer', 1, 'big', 'http://dummy-bedrock.com/', 'contents/SpecialOffer/1/1_big.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/SpecialOffer/1/1_big.jpg'),
(395, 'SpecialOffer', 1, 'thumb', 'http://dummy-bedrock.com/', 'contents/SpecialOffer/1/1_thumb.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/SpecialOffer/1/1_thumb.jpg'),
(394, 'SpecialOffer', 0, 'big', 'http://dummy-bedrock.com/', 'contents/SpecialOffer/0/0_big.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/SpecialOffer/0/0_big.jpg'),
(393, 'SpecialOffer', 0, 'thumb', 'http://dummy-bedrock.com/', 'contents/SpecialOffer/0/0_thumb.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/SpecialOffer/0/0_thumb.jpg'),
(392, 'RoomImage', 6, 'big', 'http://dummy-bedrock.com/', 'contents/RoomImage/6/6_big.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/RoomImage/6/6_big.jpg'),
(391, 'RoomImage', 6, 'thumb', 'http://dummy-bedrock.com/', 'contents/RoomImage/6/6_thumb.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/RoomImage/6/6_thumb.jpg'),
(390, 'RoomImage', 5, 'big', 'http://dummy-bedrock.com/', 'contents/RoomImage/5/5_big.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/RoomImage/5/5_big.jpg'),
(389, 'RoomImage', 5, 'thumb', 'http://dummy-bedrock.com/', 'contents/RoomImage/5/5_thumb.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/RoomImage/5/5_thumb.jpg'),
(388, 'RoomImage', 4, 'big', 'http://dummy-bedrock.com/', 'contents/RoomImage/4/4_big.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/RoomImage/4/4_big.jpg'),
(387, 'RoomImage', 4, 'thumb', 'http://dummy-bedrock.com/', 'contents/RoomImage/4/4_thumb.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/RoomImage/4/4_thumb.jpg'),
(386, 'RoomImage', 3, 'big', 'http://dummy-bedrock.com/', 'contents/RoomImage/3/3_big.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/RoomImage/3/3_big.jpg'),
(385, 'RoomImage', 3, 'thumb', 'http://dummy-bedrock.com/', 'contents/RoomImage/3/3_thumb.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/RoomImage/3/3_thumb.jpg'),
(384, 'SalesTeam', 3, 'big', 'http://dummy-bedrock.com/', 'contents/SalesTeam/3/3_big.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/SalesTeam/3/3_big.jpg'),
(383, 'SalesTeam', 3, 'thumb', 'http://dummy-bedrock.com/', 'contents/SalesTeam/3/3_thumb.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/SalesTeam/3/3_thumb.jpg'),
(382, 'SalesTeam', 2, 'big', 'http://dummy-bedrock.com/', 'contents/SalesTeam/2/2_big.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/SalesTeam/2/2_big.jpg'),
(381, 'SalesTeam', 2, 'thumb', 'http://dummy-bedrock.com/', 'contents/SalesTeam/2/2_thumb.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/SalesTeam/2/2_thumb.jpg'),
(380, 'SalesTeam', 1, 'big', 'http://dummy-bedrock.com/', 'contents/SalesTeam/1/1_big.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/SalesTeam/1/1_big.jpg'),
(379, 'SalesTeam', 1, 'thumb', 'http://dummy-bedrock.com/', 'contents/SalesTeam/1/1_thumb.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/SalesTeam/1/1_thumb.jpg'),
(378, 'WebPage', 4, 'big', 'http://dummy-bedrock.com/', 'contents/WebPage/4/4_big.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/WebPage/4/4_big.jpg'),
(377, 'WebPage', 4, 'thumb', 'http://dummy-bedrock.com/', 'contents/WebPage/4/4_thumb.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/WebPage/4/4_thumb.jpg'),
(376, 'WebPage', 2, 'big', 'http://dummy-bedrock.com/', 'contents/WebPage/2/2_big.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/WebPage/2/2_big.jpg'),
(375, 'WebPage', 2, 'thumb', 'http://dummy-bedrock.com/', 'contents/WebPage/2/2_thumb.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/WebPage/2/2_thumb.jpg'),
(371, 'HomeSlider', 2, 'thumb', 'http://dummy-bedrock.com/', 'contents/HomeSlider/2/2_thumb.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/HomeSlider/2/2_thumb.jpg'),
(372, 'HomeSlider', 2, 'big', 'http://dummy-bedrock.com/', 'contents/HomeSlider/2/2_big.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/HomeSlider/2/2_big.jpg'),
(373, 'HomeSlider', 3, 'thumb', 'http://dummy-bedrock.com/', 'contents/HomeSlider/3/3_thumb.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/HomeSlider/3/3_thumb.jpg'),
(374, 'HomeSlider', 3, 'big', 'http://dummy-bedrock.com/', 'contents/HomeSlider/3/3_big.jpg', '', 'image/jpeg', '/Library/WebServer/Documents/amaya/amaya-005-bedrock/app/webroot/contents/HomeSlider/3/3_big.jpg'),
(410, 'SalesTeam', 4, 'big', 'http://dummy-bedrock.com/', 'contents/SalesTeam/4/4_big.jpg', '', 'image/jpeg', 'C:\\xampp\\htdocs\\amaya-005-bedrock\\app\\webroot\\contentsSalesTeam/4/4_big.jpg'),
(409, 'SalesTeam', 4, 'thumb', 'http://dummy-bedrock.com/', 'contents/SalesTeam/4/4_thumb.jpg', '', 'image/jpeg', 'C:\\xampp\\htdocs\\amaya-005-bedrock\\app\\webroot\\contentsSalesTeam/4/4_thumb.jpg'),
(441, 'WebPage', 9, 'thumb', 'http://dummy-bedrock.com/', 'contents/WebPage/9/9_thumb.jpg', '', 'image/jpeg', 'C:\\xampp\\htdocs\\amaya-005-bedrock\\app\\webroot\\contents\\WebPage/9/9_thumb.jpg'),
(450, 'PhotoGallery', 1, 'bedrock1', 'http://dummy-bedrock.com/', 'contents/PhotoGallery/1/1_bedrock1.jpg', '', 'image/jpeg', 'C:\\xampp\\htdocs\\amaya-005-bedrock\\app\\webroot\\contents\\PhotoGallery/1/1_bedrock1.jpg'),
(451, 'PhotoGallery', 1, 'bedrock2', 'http://dummy-bedrock.com/', 'contents/PhotoGallery/1/1_bedrock2.png', '', 'image/png', 'C:\\xampp\\htdocs\\amaya-005-bedrock\\app\\webroot\\contents\\PhotoGallery/1/1_bedrock2.png'),
(452, 'PhotoGallery', 1, 'bedrock3', 'http://dummy-bedrock.com/', 'contents/PhotoGallery/1/1_bedrock3.jpg', '', 'image/jpeg', 'C:\\xampp\\htdocs\\amaya-005-bedrock\\app\\webroot\\contents\\PhotoGallery/1/1_bedrock3.jpg'),
(453, 'PhotoGallery', 1, 'bedrock4', 'http://dummy-bedrock.com/', 'contents/PhotoGallery/1/1_bedrock4.png', '', 'image/png', 'C:\\xampp\\htdocs\\amaya-005-bedrock\\app\\webroot\\contents\\PhotoGallery/1/1_bedrock4.png'),
(454, 'PhotoGallery', 1, 'bedrock5', 'http://dummy-bedrock.com/', 'contents/PhotoGallery/1/1_bedrock5.jpg', '', 'image/jpeg', 'C:\\xampp\\htdocs\\amaya-005-bedrock\\app\\webroot\\contents\\PhotoGallery/1/1_bedrock5.jpg'),
(442, 'WebPage', 9, 'big', 'http://dummy-bedrock.com/', 'contents/WebPage/9/9_big.jpg', '', 'image/jpeg', 'C:\\xampp\\htdocs\\amaya-005-bedrock\\app\\webroot\\contents\\WebPage/9/9_big.jpg'),
(469, 'Advertisement', 0, 'big', 'http://dummy-bedrock.com/', 'contents/Advertisement/0/0_big.jpg', '', 'image/jpeg', 'C:\\xampp\\htdocs\\amaya-005-bedrock\\app\\webroot\\contents\\Advertisement/0/0_big.jpg'),
(478, 'PhotoGalleryImage', 1, 'thumb', 'http://dummy-bedrock.com/', 'contents/PhotoGalleryImage/1/1_thumb.jpg', '', 'image/jpeg', 'C:\\xampp\\htdocs\\amaya-005-bedrock\\app\\webroot\\contents\\PhotoGalleryImage/1/1_thumb.jpg'),
(479, 'PhotoGalleryImage', 1, 'big', 'http://dummy-bedrock.com/', 'contents/PhotoGalleryImage/1/1_big.jpg', '', 'image/jpeg', 'C:\\xampp\\htdocs\\amaya-005-bedrock\\app\\webroot\\contents\\PhotoGalleryImage/1/1_big.jpg'),
(480, 'PhotoGalleryImage', 2, 'thumb', 'http://dummy-bedrock.com/', 'contents/PhotoGalleryImage/2/2_thumb.jpg', '', 'image/jpeg', 'C:\\xampp\\htdocs\\amaya-005-bedrock\\app\\webroot\\contents\\PhotoGalleryImage/2/2_thumb.jpg'),
(481, 'PhotoGalleryImage', 2, 'big', 'http://dummy-bedrock.com/', 'contents/PhotoGalleryImage/2/2_big.jpg', '', 'image/jpeg', 'C:\\xampp\\htdocs\\amaya-005-bedrock\\app\\webroot\\contents\\PhotoGalleryImage/2/2_big.jpg'),
(482, 'PhotoGalleryImage', 3, 'thumb', 'http://dummy-bedrock.com/', 'contents/PhotoGalleryImage/3/3_thumb.jpg', '', 'image/jpeg', 'C:\\xampp\\htdocs\\amaya-005-bedrock\\app\\webroot\\contents\\PhotoGalleryImage/3/3_thumb.jpg'),
(483, 'PhotoGalleryImage', 3, 'big', 'http://dummy-bedrock.com/', 'contents/PhotoGalleryImage/3/3_big.jpg', '', 'image/jpeg', 'C:\\xampp\\htdocs\\amaya-005-bedrock\\app\\webroot\\contents\\PhotoGalleryImage/3/3_big.jpg'),
(468, 'Advertisement', 0, 'thumb', 'http://dummy-bedrock.com/', 'contents/Advertisement/0/0_thumb.jpg', '', 'image/jpeg', 'C:\\xampp\\htdocs\\amaya-005-bedrock\\app\\webroot\\contents\\Advertisement/0/0_thumb.jpg'),
(470, 'Advertisement', 1, 'thumb', 'http://dummy-bedrock.com/', 'contents/Advertisement/1/1_thumb.jpg', '', 'image/jpeg', 'C:\\xampp\\htdocs\\amaya-005-bedrock\\app\\webroot\\contents\\Advertisement/1/1_thumb.jpg'),
(471, 'Advertisement', 1, 'big', 'http://dummy-bedrock.com/', 'contents/Advertisement/1/1_big.jpg', '', 'image/jpeg', 'C:\\xampp\\htdocs\\amaya-005-bedrock\\app\\webroot\\contents\\Advertisement/1/1_big.jpg'),
(472, 'Advertisement', 2, 'thumb', 'http://dummy-bedrock.com/', 'contents/Advertisement/2/2_thumb.jpg', '', 'image/jpeg', 'C:\\xampp\\htdocs\\amaya-005-bedrock\\app\\webroot\\contents\\Advertisement/2/2_thumb.jpg'),
(473, 'Advertisement', 2, 'big', 'http://dummy-bedrock.com/', 'contents/Advertisement/2/2_big.jpg', '', 'image/jpeg', 'C:\\xampp\\htdocs\\amaya-005-bedrock\\app\\webroot\\contents\\Advertisement/2/2_big.jpg'),
(474, 'Advertisement', 3, 'thumb', 'http://dummy-bedrock.com/', 'contents/Advertisement/3/3_thumb.jpg', '', 'image/jpeg', 'C:\\xampp\\htdocs\\amaya-005-bedrock\\app\\webroot\\contents\\Advertisement/3/3_thumb.jpg'),
(475, 'Advertisement', 3, 'big', 'http://dummy-bedrock.com/', 'contents/Advertisement/3/3_big.jpg', '', 'image/jpeg', 'C:\\xampp\\htdocs\\amaya-005-bedrock\\app\\webroot\\contents\\Advertisement/3/3_big.jpg'),
(476, 'RoomImage', 7, 'thumb', 'http://dummy-bedrock.com/', 'contents/RoomImage/7/7_thumb.jpg', '', 'image/jpeg', 'C:\\xampp\\htdocs\\amaya-005-bedrock\\app\\webroot\\contents\\RoomImage/7/7_thumb.jpg'),
(477, 'RoomImage', 7, 'big', 'http://dummy-bedrock.com/', 'contents/RoomImage/7/7_big.jpg', '', 'image/jpeg', 'C:\\xampp\\htdocs\\amaya-005-bedrock\\app\\webroot\\contents\\RoomImage/7/7_big.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

DROP TABLE IF EXISTS `kelas`;
CREATE TABLE `kelas` (
  `kd_kelas` varchar(11) NOT NULL,
  `nm_kelas` varchar(25) NOT NULL,
  `pro_keahlian` varchar(25) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nip` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`kd_kelas`, `nm_kelas`, `pro_keahlian`, `jumlah`, `nip`) VALUES
('KL003', 'IPA 1', 'Kesenian', 90, ''),
('KLS01', 'IPS 5', 'Multimedia', 20, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `letters`
--

DROP TABLE IF EXISTS `letters`;
CREATE TABLE `letters` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `pasien_id` int(11) DEFAULT NULL,
  `letter_type_id` int(11) DEFAULT NULL,
  `keterangan` text,
  `status` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `letters`
--

INSERT INTO `letters` (`id`, `doctor_id`, `pasien_id`, `letter_type_id`, `keterangan`, `status`, `created`, `modified`) VALUES
(1, 25, 4, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel maximus nulla. Pellentesque et fringilla est. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In hac habitasse platea dictumst. Pellentesque in odio eget metus pretium rhoncus a vel est. Proin lacinia, arcu sit amet varius tempor, nisi lorem interdum odio, eu auctor mi nisi eu nisi. Quisque finibus eget lorem et condimentum. Nam eget leo hendrerit, hendrerit erat non, convallis sapien. Nunc finibus tellus eu facilisis iaculis. Vivamus laoreet vitae ligula vel sollicitudin. Donec quis odio non tortor sodales tempus nec ut nunc. Nullam venenatis tellus tortor. Integer est leo, varius sed vehicula in, congue quis eros. Nunc sit amet erat feugiat, blandit massa a, egestas ex. Vestibulum quis urna sem.', 1, '2016-07-31 14:03:11', '2016-07-31 14:03:11'),
(2, 25, 4, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel maximus nulla. Pellentesque et fringilla est. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In hac habitasse platea dictumst. Pellentesque in odio eget metus pretium rhoncus a vel est. Proin lacinia, arcu sit amet varius tempor, nisi lorem interdum odio, eu auctor mi nisi eu nisi. Quisque finibus eget lorem et condimentum. Nam eget leo hendrerit, hendrerit erat non, convallis sapien. Nunc finibus tellus eu facilisis iaculis. Vivamus laoreet vitae ligula vel sollicitudin. Donec quis odio non tortor sodales tempus nec ut nunc. Nullam venenatis tellus tortor. Integer est leo, varius sed vehicula in, congue quis eros. Nunc sit amet erat feugiat, blandit massa a, egestas ex. Vestibulum quis urna sem.', 1, '2016-07-31 14:14:40', '2016-07-31 14:14:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `letter_types`
--

DROP TABLE IF EXISTS `letter_types`;
CREATE TABLE `letter_types` (
  `id` int(11) NOT NULL,
  `name` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `letter_types`
--

INSERT INTO `letter_types` (`id`, `name`) VALUES
(1, 'Surat Sakit'),
(2, 'Surat Rujuk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `medical_records`
--

DROP TABLE IF EXISTS `medical_records`;
CREATE TABLE `medical_records` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `keluhan` text,
  `diagnosa` text,
  `status` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `medical_records`
--

INSERT INTO `medical_records` (`id`, `doctor_id`, `pasien_id`, `keluhan`, `diagnosa`, `status`, `created`, `modified`) VALUES
(1, 20, 4, '- Sakit Perut', 'Diare Akut', 1, '2016-07-31 04:43:16', '2016-07-31 04:43:16'),
(2, 20, 4, '- Lemas', 'Kurang Darah', 1, '2016-08-15 15:10:50', '2016-08-15 15:10:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasiens`
--

DROP TABLE IF EXISTS `pasiens`;
CREATE TABLE `pasiens` (
  `id` int(11) NOT NULL,
  `code` varchar(11) DEFAULT NULL,
  `name` varchar(25) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `address` text,
  `gender` int(1) DEFAULT NULL,
  `gol_darah` varchar(2) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `place_of_birth` varchar(15) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pasiens`
--

INSERT INTO `pasiens` (`id`, `code`, `name`, `username`, `password`, `address`, `gender`, `gol_darah`, `phone`, `place_of_birth`, `date_of_birth`, `status`, `created`, `modified`) VALUES
(3, 'PSN003', 'Helga', 'helda', '6cLV4sbQqZI=', 'st. James jun', 1, 'AB', '089108819809', 'jakarta', '2016-07-25', 1, '2016-07-30 13:29:54', '2016-08-16 14:15:25'),
(4, 'PSN009', 'Daniro', 'daniro', '6cLV4sbQqZI=', 'Jakarta', 0, 'A', '088991238907', 'Jakarta', '2016-08-24', 1, '2016-08-12 21:32:20', '2016-08-15 13:31:50'),
(5, 'PSN099', 'Sandiko', 'sandiko', '6cLV4sbQqZM=', 'St. Alistic Juan', 0, 'AB', '089914327890', 'Jakarta', '2016-08-21', 1, '2016-08-15 13:32:53', '2016-08-16 13:38:00'),
(6, 'PSN019', 'Ruby', 'pasien019', '6cLV4sbQqZI=', 'H. Janim', 0, 'B', '081288882234', 'Jakarta', '1998-08-19', 1, '2016-08-17 18:16:29', '2016-08-17 18:16:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelajarans`
--

DROP TABLE IF EXISTS `pelajarans`;
CREATE TABLE `pelajarans` (
  `kd_pelajaran` varchar(11) NOT NULL,
  `nm_pelajaran` varchar(25) NOT NULL,
  `nip` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pelajarans`
--

INSERT INTO `pelajarans` (`kd_pelajaran`, `nm_pelajaran`, `nip`) VALUES
('PLJ001', 'Science', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `program_keahlians`
--

DROP TABLE IF EXISTS `program_keahlians`;
CREATE TABLE `program_keahlians` (
  `id` int(11) NOT NULL,
  `kd_program` varchar(15) NOT NULL,
  `nm_program` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(255) NOT NULL DEFAULT '',
  `site_title` varchar(255) NOT NULL DEFAULT '',
  `site_description` text NOT NULL,
  `site_keywords` text NOT NULL,
  `site_domain` varchar(255) NOT NULL DEFAULT '',
  `web_url` varchar(255) NOT NULL DEFAULT 'http://webmld.coda-technology.dev/',
  `wap_url` varchar(255) NOT NULL DEFAULT 'http://mld.coda-technology.dev/',
  `cms_url` varchar(255) NOT NULL,
  `path_content` varchar(255) NOT NULL DEFAULT 'D:/xampp/htdocs/mld-web/contents/',
  `path_webroot` varchar(255) NOT NULL,
  `facebook_app_id` varchar(255) NOT NULL,
  `facebook_app_secret` varchar(255) NOT NULL,
  `bucket_name` varchar(255) DEFAULT NULL,
  `aws_host` varchar(255) DEFAULT NULL,
  `aws_host_url` varchar(255) DEFAULT NULL,
  `aws_access_key` varchar(255) DEFAULT NULL,
  `aws_secret_key` varchar(255) DEFAULT NULL,
  `mandrill_api_key` varchar(100) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `gplus_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `site_title`, `site_description`, `site_keywords`, `site_domain`, `web_url`, `wap_url`, `cms_url`, `path_content`, `path_webroot`, `facebook_app_id`, `facebook_app_secret`, `bucket_name`, `aws_host`, `aws_host_url`, `aws_access_key`, `aws_secret_key`, `mandrill_api_key`, `facebook_url`, `gplus_url`, `twitter_url`, `instagram_url`) VALUES
(2, 'SMK Yapera', 'SMK Yapera', 'SMK Yapera', 'SMK Yapera', 'http://localhost/systemacademic/', 'http://localhost/systemacademic/', '', 'http://localhost/systemacademic/', 'C:\\xampp\\htdocs\\systemacademic\\app\\webroot\\contents\\', 'C:\\xampp\\htdocs\\systemacademic\\app\\webroot\\contents\\', '', '', '', '', '', '', '', 'Wi8K7CXGFDE4aYM9jY4JmA', 'https://www.facebook.com/BedrockBarAndGrill', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acos`
--
ALTER TABLE `acos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lft` (`lft`),
  ADD KEY `rght` (`rght`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_groups`
--
ALTER TABLE `admin_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aros`
--
ALTER TABLE `aros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lft` (`lft`),
  ADD KEY `rght` (`rght`);

--
-- Indexes for table `aros_acos`
--
ALTER TABLE `aros_acos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`),
  ADD KEY `aro_id` (`aro_id`),
  ADD KEY `aco_id` (`aco_id`);

--
-- Indexes for table `cms_menus`
--
ALTER TABLE `cms_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_submenus`
--
ALTER TABLE `cms_submenus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cloud` (`cloud`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kd_kelas`);

--
-- Indexes for table `letters`
--
ALTER TABLE `letters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `letter_types`
--
ALTER TABLE `letter_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_records`
--
ALTER TABLE `medical_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasiens`
--
ALTER TABLE `pasiens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelajarans`
--
ALTER TABLE `pelajarans`
  ADD PRIMARY KEY (`kd_pelajaran`);

--
-- Indexes for table `program_keahlians`
--
ALTER TABLE `program_keahlians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acos`
--
ALTER TABLE `acos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `admin_groups`
--
ALTER TABLE `admin_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `aros`
--
ALTER TABLE `aros`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `aros_acos`
--
ALTER TABLE `aros_acos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `cms_menus`
--
ALTER TABLE `cms_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cms_submenus`
--
ALTER TABLE `cms_submenus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=484;
--
-- AUTO_INCREMENT for table `letters`
--
ALTER TABLE `letters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `letter_types`
--
ALTER TABLE `letter_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `medical_records`
--
ALTER TABLE `medical_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pasiens`
--
ALTER TABLE `pasiens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `program_keahlians`
--
ALTER TABLE `program_keahlians`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
