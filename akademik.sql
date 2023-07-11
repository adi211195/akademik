-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Jan 2023 pada 06.38
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akademik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `account`
--

CREATE TABLE `account` (
  `account_id` varchar(15) NOT NULL,
  `account_username` varchar(50) NOT NULL,
  `account_password` varchar(50) NOT NULL,
  `account_email` varchar(50) NOT NULL,
  `account_block` enum('No','Yes') NOT NULL,
  `create_date` datetime NOT NULL,
  `account_status` enum('Administrator','Mahasiswa','Dosen') NOT NULL,
  `account_photo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `account`
--

INSERT INTO `account` (`account_id`, `account_username`, `account_password`, `account_email`, `account_block`, `create_date`, `account_status`, `account_photo`) VALUES
('17gQZROlKzkd3i', 'mahasiswa2', '01484c79145c559ee6e3c9790ba6a1bb', 'mahasiswa2@gmail.com', 'No', '2021-03-28 03:23:03', 'Mahasiswa', 'image.png'),
('gtq0x7h1uAmZpM', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'dummy2@gmail.com', 'No', '2021-03-28 02:46:21', 'Administrator', 'image.png'),
('HMKdh3TrPLl62A', 'mahasiswa', '5787be38ee03a9ae5360f54d9026465f', 'mahasiswa@gmail.com', 'No', '2021-03-28 03:23:57', 'Mahasiswa', 'image.png'),
('yt1aHB4zNXkiWf', 'dosen', 'ce28eed1511f631af6b2a7bb0a85d636', 'dosen2@gmail.com', 'No', '2021-05-10 00:25:42', 'Dosen', 'image.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `calendar_color`
--

CREATE TABLE `calendar_color` (
  `calendar_color` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `calendar_color`
--

INSERT INTO `calendar_color` (`calendar_color`) VALUES
('danger'),
('dark'),
('info'),
('mint'),
('purple'),
('warning');

-- --------------------------------------------------------

--
-- Struktur dari tabel `chat_group`
--

CREATE TABLE `chat_group` (
  `group_id` varchar(15) NOT NULL,
  `curriculum_id` varchar(15) NOT NULL,
  `account_id` varchar(15) NOT NULL,
  `group_chat` text NOT NULL,
  `group_file` varchar(50) NOT NULL,
  `group_status` enum('1','0') NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `chat_group`
--

INSERT INTO `chat_group` (`group_id`, `curriculum_id`, `account_id`, `group_chat`, `group_file`, `group_status`, `create_date`) VALUES
('18gAeRZYQCwvk3', 'SXOq3b4mo1WdsT', 'HMKdh3TrPLl62A', 'testing', '', '1', '2021-04-08 01:07:06'),
('fnhgePxR0YVFyr', 'SXOq3b4mo1WdsT', 'HMKdh3TrPLl62A', 'testing', '', '1', '2021-04-08 01:13:23'),
('M6UThaeJZ14pWr', 'SXOq3b4mo1WdsT', 'yt1aHB4zNXkiWf', 'dosen', '', '1', '2021-04-17 19:40:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `chat_personal`
--

CREATE TABLE `chat_personal` (
  `personal_id` varchar(15) NOT NULL,
  `account_id` varchar(15) NOT NULL,
  `personal_send` varchar(15) NOT NULL,
  `personal_chat` text NOT NULL,
  `personal_file` varchar(50) NOT NULL,
  `personal_status` enum('1','0') NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `chat_personal`
--

INSERT INTO `chat_personal` (`personal_id`, `account_id`, `personal_send`, `personal_chat`, `personal_file`, `personal_status`, `create_date`) VALUES
('1sfPlJAHtiOFdy', '17gQZROlKzkd3i', 'HMKdh3TrPLl62A', '', '', '0', '2021-04-21 09:55:15'),
('JzDU5OSQkcxo0G', 'HMKdh3TrPLl62A', '17gQZROlKzkd3i', '', '', '0', '2021-04-21 09:55:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `drive_academic`
--

CREATE TABLE `drive_academic` (
  `drive_id` varchar(15) NOT NULL,
  `account_id` varchar(15) NOT NULL,
  `folder_id` varchar(15) NOT NULL,
  `drive_file` text NOT NULL,
  `drive_size` int(11) NOT NULL,
  `drive_type` varchar(10) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `drive_academic`
--

INSERT INTO `drive_academic` (`drive_id`, `account_id`, `folder_id`, `drive_file`, `drive_size`, `drive_type`, `create_date`) VALUES
('HMKdh3TrPLl622', 'HMKdh3TrPLl62A', 'HMKdh3TrPLl622', 'Document', 12400, 'doc', '2021-03-28 22:57:03'),
('vd8QyxhI0bTFK5', 'HMKdh3TrPLl62A', '', 'image.png', 5623, 'png', '2021-04-18 16:56:20'),
('wL5ZXDuSC71vE6', 'HMKdh3TrPLl62A', 'EdyHNeib1WIsQg', 'soti.jpeg', 9897, 'jpeg', '2021-04-08 01:43:13'),
('yL3gWVSZfeiXMl', 'yt1aHB4zNXkiWf', 'CsjJFNTaLfS3QD', 'image.png', 5623, 'png', '2021-04-18 17:22:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `drive_folder`
--

CREATE TABLE `drive_folder` (
  `folder_id` varchar(15) NOT NULL,
  `account_id` varchar(15) NOT NULL,
  `folder_name` varchar(50) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `drive_folder`
--

INSERT INTO `drive_folder` (`folder_id`, `account_id`, `folder_name`, `create_date`) VALUES
('CsjJFNTaLfS3QD', 'yt1aHB4zNXkiWf', 'testing', '2021-04-18 17:21:46'),
('EdyHNeib1WIsQg', 'HMKdh3TrPLl62A', 'Testing3', '2021-04-08 01:27:11'),
('HMKdh3TrPLl622', 'HMKdh3TrPLl62A', 'Latihan', '2021-03-28 22:35:13'),
('UmaHuNoAOsq5LT', 'HMKdh3TrPLl62A', 'mahasiswa2', '2021-04-18 16:55:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `drive_shared`
--

CREATE TABLE `drive_shared` (
  `shared_id` varchar(15) NOT NULL,
  `drive_id` varchar(15) NOT NULL,
  `account_id` varchar(15) NOT NULL,
  `account_send` varchar(15) NOT NULL,
  `shared_status` enum('Mahasiswa','Dosen') NOT NULL,
  `view_shared` enum('1','0') NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `drive_shared`
--

INSERT INTO `drive_shared` (`shared_id`, `drive_id`, `account_id`, `account_send`, `shared_status`, `view_shared`, `create_date`) VALUES
('Xwu097odzfrNBQ', 'HMKdh3TrPLl622', 'HMKdh3TrPLl62A', 'yt1aHB4zNXkiWf', 'Mahasiswa', '0', '2021-04-09 02:32:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `drive_type`
--

CREATE TABLE `drive_type` (
  `drive_type` varchar(15) NOT NULL,
  `drive_icon` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `drive_type`
--

INSERT INTO `drive_type` (`drive_type`, `drive_icon`) VALUES
('doc', 'demo-pli-file-word'),
('jpeg', 'demo-pli-file-jpg'),
('jpg', 'demo-pli-file-jpg'),
('txt', 'demo-pli-file-txt');

-- --------------------------------------------------------

--
-- Struktur dari tabel `elearning`
--

CREATE TABLE `elearning` (
  `elearning_id` varchar(15) NOT NULL,
  `curriculum_id` varchar(15) NOT NULL,
  `account_id` varchar(15) NOT NULL,
  `elearning_file` text NOT NULL,
  `elearning_type` varchar(15) NOT NULL,
  `elearning_size` int(11) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `elearning`
--

INSERT INTO `elearning` (`elearning_id`, `curriculum_id`, `account_id`, `elearning_file`, `elearning_type`, `elearning_size`, `create_date`) VALUES
('0WtDThv8Af7IRS', 'SXOq3b4mo1WdsT', 'yt1aHB4zNXkiWf', 'image.png', 'png', 5623, '2021-04-18 17:22:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `elearning_type`
--

CREATE TABLE `elearning_type` (
  `elearning_type` varchar(15) NOT NULL,
  `elearning_icon` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `elearning_type`
--

INSERT INTO `elearning_type` (`elearning_type`, `elearning_icon`) VALUES
('doc', 'demo-pli-file-word'),
('jpeg', 'demo-pli-file-jpg'),
('jpg', 'demo-pli-file-jpg'),
('png', 'demo-pli-file-jpg'),
('txt', 'demo-pli-file-txt');

-- --------------------------------------------------------

--
-- Struktur dari tabel `forum_comment`
--

CREATE TABLE `forum_comment` (
  `forum_comment_id` varchar(15) NOT NULL,
  `forum_comment` text NOT NULL,
  `forum_id` varchar(15) NOT NULL,
  `account_id` varchar(15) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `forum_comment`
--

INSERT INTO `forum_comment` (`forum_comment_id`, `forum_comment`, `forum_id`, `account_id`, `create_date`) VALUES
('hxQ8GYrun42qAk', 'Komen Mahasiswa', '0M1gxfbvSQkKRW', 'HMKdh3TrPLl62A', '2021-06-27 16:46:26'),
('U2IVKbS0MsHzuQ', 'Testing', 'f9F3Rt8hoAGC6z', 'admin', '2021-06-21 23:16:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `forum_general`
--

CREATE TABLE `forum_general` (
  `forum_id` varchar(15) NOT NULL,
  `forum_title` text NOT NULL,
  `forum_description` text NOT NULL,
  `forum_view` enum('No','Yes') NOT NULL,
  `account_id` varchar(15) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `forum_general`
--

INSERT INTO `forum_general` (`forum_id`, `forum_title`, `forum_description`, `forum_view`, `account_id`, `create_date`) VALUES
('XzcMlF8mQ5IJ1H', 'Forum General', '<p>But I must explain to you how all this mistaken idea of denouncing \r\npleasure and praising pain was born and I will give you a complete \r\naccount of the system. But I must explain to you how all \r\nthis mistaken idea of denouncing pleasure and praising pain was born and\r\n I will give you a complete account of the system. I must explain to you how all this \r\nmistaken idea of denouncing pleasure was born and I will give you a \r\ncomplete account of the system.\r\n<br></p>', 'No', 'HMKdh3TrPLl62A', '2021-06-29 00:45:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `forum_majors`
--

CREATE TABLE `forum_majors` (
  `forum_id` varchar(15) NOT NULL,
  `majors_code` varchar(25) NOT NULL,
  `forum_title` text NOT NULL,
  `forum_description` text NOT NULL,
  `forum_view` enum('No','Yes') NOT NULL,
  `account_id` varchar(15) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `forum_majors`
--

INSERT INTO `forum_majors` (`forum_id`, `majors_code`, `forum_title`, `forum_description`, `forum_view`, `account_id`, `create_date`) VALUES
('0M1gxfbvSQkKRW', 'majors', 'Forum Title 2', '<p>But I must explain to you how all this mistaken idea of denouncing \r\npleasure and praising pain was born and I will give you a complete \r\naccount of the system. But I must explain to you how all \r\nthis mistaken idea of denouncing pleasure and praising pain was born and\r\n I will give you a complete account of the system. I must explain to you how all this \r\nmistaken idea of denouncing pleasure was born and I will give you a \r\ncomplete account of the system.\r\n					                        <br></p>', 'No', 'gtq0x7h1uAmZpM', '2021-06-27 16:18:20'),
('f9F3Rt8hoAGC6z', 'majors', 'Forum Title', '<p>But I must explain to you how all this mistaken idea of denouncing \r\npleasure and praising pain was born and I will give you a complete \r\naccount of the system. But I must explain to you how all \r\nthis mistaken idea of denouncing pleasure and praising pain was born and\r\n I will give you a complete account of the system. I must explain to you how all this \r\nmistaken idea of denouncing pleasure was born and I will give you a \r\ncomplete account of the system.\r\n					                        <br></p>', 'No', 'gtq0x7h1uAmZpM', '2021-06-27 16:18:28'),
('Vr3kS4CcoqM7Hv', 'majors', 'Forum Title3', '<p>But I must explain to you how all this mistaken idea of denouncing \r\npleasure and praising pain was born and I will give you a complete \r\naccount of the system. But I must explain to you how all \r\nthis mistaken idea of denouncing pleasure and praising pain was born and\r\n I will give you a complete account of the system. I must explain to you how all this \r\nmistaken idea of denouncing pleasure was born and I will give you a \r\ncomplete account of the system.\r\n					                        </p><p><br></p>', 'No', 'HMKdh3TrPLl62A', '2021-06-27 16:16:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mail_academic_accepted`
--

CREATE TABLE `mail_academic_accepted` (
  `mail_id` varchar(15) NOT NULL,
  `mail_account` varchar(25) NOT NULL,
  `mail_sent` varchar(25) NOT NULL,
  `mail_subject` text NOT NULL,
  `mail_post` text NOT NULL,
  `mail_view` enum('1','0') NOT NULL,
  `mail_status` enum('Sent','Trash','Draft','Spam') NOT NULL,
  `mail_reply` varchar(15) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mail_academic_accepted`
--

INSERT INTO `mail_academic_accepted` (`mail_id`, `mail_account`, `mail_sent`, `mail_subject`, `mail_post`, `mail_view`, `mail_status`, `mail_reply`, `create_date`) VALUES
('17gQZROlKzkd2i', '12345@stdi.mail', 'dosen@stdi.mail', 'reply message', 'reply message post', '0', 'Sent', '17gQZROlKzkd32', '2021-03-29 12:50:55'),
('17gQZROlKzkd32', 'dosen@stdi.mail', '12345@stdi.mail', 'Kirim sUBJECT MAIL ACADEMIC', 'Kirim POST MAIL ACADEMIC', '1', 'Sent', '', '2021-03-29 01:36:48'),
('jGyerDgXt7lvR9', '67890@stdi.mail', 'dosen@stdi.mail', 'Testing email', '<p>tes</p>', '0', 'Sent', '', '2021-04-18 17:42:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mail_academic_sent`
--

CREATE TABLE `mail_academic_sent` (
  `mail_id` varchar(15) NOT NULL,
  `mail_account` varchar(25) NOT NULL,
  `mail_sent` varchar(25) NOT NULL,
  `mail_subject` text NOT NULL,
  `mail_post` text NOT NULL,
  `mail_view` enum('1','0') NOT NULL,
  `mail_status` enum('Sent','Trash','Draft','Spam') NOT NULL,
  `mail_reply` varchar(15) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mail_academic_sent`
--

INSERT INTO `mail_academic_sent` (`mail_id`, `mail_account`, `mail_sent`, `mail_subject`, `mail_post`, `mail_view`, `mail_status`, `mail_reply`, `create_date`) VALUES
('17gQZROlKzkd32', 'dosen@stdi.mail', '12345@stdi.mail', 'Kirim sUBJECT MAIL ACADEMIC', 'Kirim POST MAIL ACADEMIC', '0', 'Sent', '', '2021-03-29 01:36:48'),
('17gQZROlKzkd3i', '12345@stdi.mail', 'dosen@stdi.mail', 'rely mesaage', 'repply mesage post', '0', 'Sent', '17gQZROlKzkd32', '2021-03-29 12:55:54'),
('9rD2Eves5dIx0Q', '67890@stdi.mail', 'dosen@stdi.mail', 'Testing email', '<p>kirim email</p>', '0', 'Sent', '', '2021-04-08 23:33:47'),
('iL28x1YOIqdZnQ', '67890@stdi.mail', 'dosen@stdi.mail', 'Testing email draft2', '<p>hdkahlk lhl</p>', '0', 'Sent', '', '2021-04-18 17:34:40'),
('jGyerDgXt7lvR9', '67890@stdi.mail', 'dosen@stdi.mail', 'Testing email', '<p>tes</p>', '1', 'Sent', '', '2021-04-18 17:42:58'),
('okZjxr4XcQIwO2', '67890@stdi.mail', 'dosen@stdi.mail', 'Testing email draft2', '<p>draft</p>', '0', 'Trash', '', '2021-04-09 00:22:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mail_account`
--

CREATE TABLE `mail_account` (
  `account_id` varchar(15) NOT NULL,
  `mail_account` varchar(25) NOT NULL,
  `mail_account_status` enum('Student','Lecturer') NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mail_account`
--

INSERT INTO `mail_account` (`account_id`, `mail_account`, `mail_account_status`, `create_date`) VALUES
('17gQZROlKzkd3i', '12345@stdi.mail', 'Student', '2021-03-29 01:35:53'),
('HMKdh3TrPLl62A', '67890@stdi.mail', 'Student', '2021-04-18 17:34:13'),
('yt1aHB4zNXkiWf', 'dosen@stdi.mail', 'Lecturer', '2021-03-29 00:40:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mail_file`
--

CREATE TABLE `mail_file` (
  `mail_file_id` varchar(15) NOT NULL,
  `mail_id` varchar(15) NOT NULL,
  `mail_account` varchar(25) NOT NULL,
  `mail_file_name` text NOT NULL,
  `mail_file_size` int(11) NOT NULL,
  `mail_file_type` varchar(15) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mail_file_type`
--

CREATE TABLE `mail_file_type` (
  `mail_file_type` varchar(15) NOT NULL,
  `mail_file_icon` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mail_file_type`
--

INSERT INTO `mail_file_type` (`mail_file_type`, `mail_file_icon`) VALUES
('doc', 'demo-pli-file-word'),
('jpg', 'demo-pli-file-jpg'),
('png', 'demo-pli-file-jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_alumni`
--

CREATE TABLE `master_alumni` (
  `alumni_id` varchar(15) NOT NULL,
  `alumni_username` varchar(50) NOT NULL,
  `alumni_password` varchar(50) NOT NULL,
  `alumni_block` enum('No','Yes') NOT NULL,
  `alumni_photo` varchar(50) NOT NULL,
  `alumni_email` varchar(50) NOT NULL,
  `alumni_npm` varchar(25) NOT NULL,
  `alumni_name` varchar(50) NOT NULL,
  `alumni_gender` varchar(25) NOT NULL,
  `alumni_majors` varchar(50) NOT NULL,
  `alumni_place_birth` varchar(50) NOT NULL,
  `alumni_date_birth` date NOT NULL,
  `alumni_address` text NOT NULL,
  `alumni_phone` varchar(25) NOT NULL,
  `alumni_thesis` text NOT NULL,
  `alumni_thesis_type` varchar(25) NOT NULL,
  `alumni_sk_yudisium_date` date NOT NULL,
  `alumni_sk_yudisium` varchar(50) NOT NULL,
  `alumni_company` varchar(50) NOT NULL,
  `alumni_company_address` text NOT NULL,
  `alumni_exit_type` varchar(25) NOT NULL,
  `alumni_exit_date` date NOT NULL,
  `alumni_exit_semester` varchar(15) NOT NULL,
  `alumni_ipk` double NOT NULL,
  `alumni_no_ijasah` varchar(25) NOT NULL,
  `alumni_mentor1` varchar(50) NOT NULL,
  `alumni_mentor2` varchar(50) NOT NULL,
  `alumni_mentor3` varchar(50) NOT NULL,
  `alumni_examiner1` varchar(50) NOT NULL,
  `alumni_examiner2` varchar(50) NOT NULL,
  `alumni_examiner3` varchar(50) NOT NULL,
  `alumni_location` text NOT NULL,
  `alumni_sk_task_number` varchar(25) NOT NULL,
  `alumni_sk_task_date` date NOT NULL,
  `alumni_file_ijasah` varchar(50) NOT NULL,
  `alumni_file_transkrip` varchar(50) NOT NULL,
  `alumni_file_sck` varchar(50) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_alumni`
--

INSERT INTO `master_alumni` (`alumni_id`, `alumni_username`, `alumni_password`, `alumni_block`, `alumni_photo`, `alumni_email`, `alumni_npm`, `alumni_name`, `alumni_gender`, `alumni_majors`, `alumni_place_birth`, `alumni_date_birth`, `alumni_address`, `alumni_phone`, `alumni_thesis`, `alumni_thesis_type`, `alumni_sk_yudisium_date`, `alumni_sk_yudisium`, `alumni_company`, `alumni_company_address`, `alumni_exit_type`, `alumni_exit_date`, `alumni_exit_semester`, `alumni_ipk`, `alumni_no_ijasah`, `alumni_mentor1`, `alumni_mentor2`, `alumni_mentor3`, `alumni_examiner1`, `alumni_examiner2`, `alumni_examiner3`, `alumni_location`, `alumni_sk_task_number`, `alumni_sk_task_date`, `alumni_file_ijasah`, `alumni_file_transkrip`, `alumni_file_sck`, `create_date`) VALUES
('zwnqtE0o4RPvQ1', 'test2', 'd41d8cd98f00b204e9800998ecf8427e', 'Yes', '', 'test@gmail.com', 'test', 'test', 'Female', '', 'test', '0000-00-00', 'test', 'test', 'test', '', '2021-08-09', '', '2021-08-09', 'test', '', '0000-00-00', '', 0, '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '2021-08-09 23:07:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_alumni_agenda`
--

CREATE TABLE `master_alumni_agenda` (
  `alumni_agenda_id` varchar(15) NOT NULL,
  `alumni_agenda_expired` date NOT NULL,
  `alumni_agenda_title` text NOT NULL,
  `alumni_agenda_description` text NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_alumni_agenda`
--

INSERT INTO `master_alumni_agenda` (`alumni_agenda_id`, `alumni_agenda_expired`, `alumni_agenda_title`, `alumni_agenda_description`, `create_date`) VALUES
('vYIRXnaomFNCfh', '2021-05-25', 'dummy', '<p>dummy<br></p>', '2021-05-25 02:05:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_alumni_company`
--

CREATE TABLE `master_alumni_company` (
  `alumni_company_id` varchar(15) NOT NULL,
  `alumni_company_name` varchar(50) NOT NULL,
  `alumni_company_field` varchar(50) NOT NULL,
  `alumni_company_website` varchar(50) NOT NULL,
  `alumni_company_location` text NOT NULL,
  `alumni_company_address` text NOT NULL,
  `alumni_company_poscode` varchar(15) NOT NULL,
  `alumni_company_phone` varchar(25) NOT NULL,
  `alumni_company_fax` varchar(25) NOT NULL,
  `alumni_company_email` varchar(50) NOT NULL,
  `alumni_company_description` text NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_alumni_company`
--

INSERT INTO `master_alumni_company` (`alumni_company_id`, `alumni_company_name`, `alumni_company_field`, `alumni_company_website`, `alumni_company_location`, `alumni_company_address`, `alumni_company_poscode`, `alumni_company_phone`, `alumni_company_fax`, `alumni_company_email`, `alumni_company_description`, `create_date`) VALUES
('eSLlDqXonCf1va', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy@gmail.com', '', '2021-05-25 10:30:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_alumni_home`
--

CREATE TABLE `master_alumni_home` (
  `alumni_home_id` varchar(15) NOT NULL,
  `alumni_home` text NOT NULL,
  `alumni_home_logo` varchar(50) NOT NULL,
  `alumni_home_phone` varchar(25) NOT NULL,
  `alumni_home_handphone` varchar(25) NOT NULL,
  `alumni_home_address` text NOT NULL,
  `alumni_home_campus` text NOT NULL,
  `alumni_home_email` varchar(50) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_alumni_home`
--

INSERT INTO `master_alumni_home` (`alumni_home_id`, `alumni_home`, `alumni_home_logo`, `alumni_home_phone`, `alumni_home_handphone`, `alumni_home_address`, `alumni_home_campus`, `alumni_home_email`, `create_date`) VALUES
('zwnqtE0o4RPvQ1', '<p>testing<br></p>', 'image.png', 'dummy', 'dummy', 'dummy', 'dummy', 'dummy@gmail.com', '2021-05-25 11:06:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_alumni_job_vacancies_web`
--

CREATE TABLE `master_alumni_job_vacancies_web` (
  `alumni_job_vacancies_web_id` varchar(15) NOT NULL,
  `alumni_job_vacancies_web_logo` varchar(50) NOT NULL,
  `alumni_job_vacancies_web_title` varchar(50) NOT NULL,
  `alumni_job_vacancies_web_url` varchar(50) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_alumni_job_vacancies_web`
--

INSERT INTO `master_alumni_job_vacancies_web` (`alumni_job_vacancies_web_id`, `alumni_job_vacancies_web_logo`, `alumni_job_vacancies_web_title`, `alumni_job_vacancies_web_url`, `create_date`) VALUES
('jqPfYh1bzVUAtW', 'image.png', 'dummy', 'dummy', '2021-05-25 10:43:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_alumni_job_vacancy`
--

CREATE TABLE `master_alumni_job_vacancy` (
  `alumni_job_vacancy_id` varchar(15) NOT NULL,
  `alumni_job_vacancy_expired` date NOT NULL,
  `alumni_job_vacancy_title` text NOT NULL,
  `alumni_job_vacancy_description` text NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_alumni_job_vacancy`
--

INSERT INTO `master_alumni_job_vacancy` (`alumni_job_vacancy_id`, `alumni_job_vacancy_expired`, `alumni_job_vacancy_title`, `alumni_job_vacancy_description`, `create_date`) VALUES
('FNzy2JXKZsVU84', '2021-05-25', 'dummy', '<p>dummy<br></p>', '2021-05-25 02:01:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_alumni_links`
--

CREATE TABLE `master_alumni_links` (
  `alumni_links_id` varchar(15) NOT NULL,
  `alumni_links_title` varchar(50) NOT NULL,
  `alumni_links_url` text NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_alumni_links`
--

INSERT INTO `master_alumni_links` (`alumni_links_id`, `alumni_links_title`, `alumni_links_url`, `create_date`) VALUES
('gmIa3Foh4ZqOVW', 'dummy', 'dummy', '2021-05-25 00:36:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_attendance`
--

CREATE TABLE `master_attendance` (
  `attendance_id` varchar(15) NOT NULL,
  `curriculum_id` varchar(15) NOT NULL,
  `attendance_date` date NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_attendance`
--

INSERT INTO `master_attendance` (`attendance_id`, `curriculum_id`, `attendance_date`, `create_date`) VALUES
('93uorjCPqMGKUN', 'SXOq3b4mo1WdsT', '2021-04-18', '2021-04-18 17:12:36'),
('AELejWfKJ62VT0', 'N9maUdBwSTs41L', '2021-03-22', '2021-03-22 18:30:26'),
('pORdZq5bfXBTAt', 'SXOq3b4mo1WdsT', '2021-03-22', '2021-03-22 18:45:02'),
('PqdrMvpaelJIHY', 'nar8pvUbATu4O0', '2021-05-28', '2021-05-28 00:22:43'),
('r3xoc5b218MOda', 'SXOq3b4mo1WdsT', '2021-03-30', '2021-03-30 20:21:18'),
('r9ISoMbiYgwLTA', 'SXOq3b4mo1WdsT', '2021-03-23', '2021-03-22 20:11:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_attendance_list`
--

CREATE TABLE `master_attendance_list` (
  `attendance_list_id` varchar(15) NOT NULL,
  `attendance_id` varchar(15) NOT NULL,
  `student_nim` varchar(25) NOT NULL,
  `attendance_type` varchar(1) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_attendance_list`
--

INSERT INTO `master_attendance_list` (`attendance_list_id`, `attendance_id`, `student_nim`, `attendance_type`, `create_date`) VALUES
('8R91ZEerIwtOXD', 'r3xoc5b218MOda', '67890', 'H', '2021-04-18 01:00:47'),
('A1phkzBG6MsjnC', 'r9ISoMbiYgwLTA', '12345', 'H', '2021-03-23 02:12:36'),
('ayxdKlZcokHVYq', 'pORdZq5bfXBTAt', '67890', 'H', '2021-03-23 02:12:33'),
('IhBed3K9gXwJ1y', 'r3xoc5b218MOda', '12345', 'A', '2021-03-30 20:21:30'),
('KZ0WRLCM8Uec6s', 'r9ISoMbiYgwLTA', '67890', 'H', '2021-03-23 02:12:38'),
('TGAwj0RH58rlNb', 'pORdZq5bfXBTAt', '12345', 'H', '2021-03-23 02:12:30'),
('VqclXxtRzWdeKw', '93uorjCPqMGKUN', '67890', 'S', '2021-04-18 17:12:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_blog`
--

CREATE TABLE `master_blog` (
  `blog_id` varchar(15) NOT NULL,
  `blog_image` varchar(50) NOT NULL,
  `blog_title` text NOT NULL,
  `blog_post` text NOT NULL,
  `blog_by` varchar(15) NOT NULL,
  `blog_status` enum('Publish','Unpublish') NOT NULL,
  `blog_comment` varchar(15) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_blog`
--

INSERT INTO `master_blog` (`blog_id`, `blog_image`, `blog_title`, `blog_post`, `blog_by`, `blog_status`, `blog_comment`, `create_date`) VALUES
('bi0Enzqm8hYVGt', 'image.png', 'Blog Testing', '<p>Blog Testing<br></p>', '', 'Publish', 'Allow', '2021-06-26 20:30:00'),
('cUPzebYRvgE93m', 'image.png', 'Blog Testing', '<p>Blog Testing<br></p>', '', 'Publish', 'Allow', '2021-06-26 20:22:45'),
('GHfxMR9w7Cpv5c', 'image.png', 'Blog Testing', '<p>Blog Testing<br></p>', '', 'Publish', 'Allow', '2021-06-26 20:37:33'),
('HIOLTvnG89RrCA', 'image.png', 'Blog Testing', '<p>Blog Testing<br></p>', 'admin', 'Publish', 'Allow', '2021-06-26 20:38:44'),
('IpmWeRJPGL64Bv', 'image.png', 'Blog Testing', '<p>Blog Testing<br></p>', 'admin', 'Publish', 'Allow', '2021-06-26 20:38:56'),
('L6Ny07RTtgohXx', 'image.png', 'Blog Testing', '<p>Blog Testing<br></p>', '', 'Publish', 'Allow', '2021-06-26 20:36:17'),
('ZPFBeDEoqJRVcv', 'image.png', 'Blog Testing', '<p>Blog Testing<br></p>', '', 'Publish', 'Allow', '2021-06-26 20:38:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_blog_comment`
--

CREATE TABLE `master_blog_comment` (
  `blog_comment_id` varchar(15) NOT NULL,
  `blog_id` varchar(15) NOT NULL,
  `account_id` varchar(15) NOT NULL,
  `comment` text NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_blog_comment`
--

INSERT INTO `master_blog_comment` (`blog_comment_id`, `blog_id`, `account_id`, `comment`, `create_date`) VALUES
('bOR4e7tdWNsSCM', 'eicXvyQS94RjIw', 'HMKdh3TrPLl62A', 'Hei Dosen', '2021-06-20 17:12:40'),
('gSOtdGmfQiFUyB', 'fm7hTWFNzSIbo6', 'HMKdh3TrPLl62A', 'testing comment', '2021-04-07 01:26:25'),
('v3smar0TFYSn9J', 'eicXvyQS94RjIw', 'yt1aHB4zNXkiWf', 'Hei Admin\r\n', '2021-06-20 17:11:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_calendar`
--

CREATE TABLE `master_calendar` (
  `calendar_id` varchar(15) NOT NULL,
  `calendar_title` text NOT NULL,
  `calendar_start` date NOT NULL,
  `calendar_end` date NOT NULL,
  `calendar_color` varchar(15) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_calendar`
--

INSERT INTO `master_calendar` (`calendar_id`, `calendar_title`, `calendar_start`, `calendar_end`, `calendar_color`, `create_date`) VALUES
('E1ueAG0KxwlNFp', 'Libur Hari Raya Idul Adha', '2021-07-19', '2021-07-21', 'danger', '2021-06-27 17:14:18'),
('EMPYOLhbcv2sdF', 'Libur Lebaran', '2021-04-18', '2021-04-21', 'danger', '2021-04-18 17:07:01'),
('faEYlGXVnvcCKM', 'Libur Lebaran', '2021-04-01', '2021-04-10', 'danger', '2021-03-29 15:05:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_class`
--

CREATE TABLE `master_class` (
  `class_id` varchar(15) NOT NULL,
  `class_code` varchar(25) NOT NULL,
  `class` varchar(25) NOT NULL,
  `class_room` varchar(25) NOT NULL,
  `class_capacity` int(11) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_class`
--

INSERT INTO `master_class` (`class_id`, `class_code`, `class`, `class_room`, `class_capacity`, `create_date`) VALUES
('JFsYSl0dHfVqh5', 'class2', 'class2', 'Gedung B', 15, '2021-03-08 00:03:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_college`
--

CREATE TABLE `master_college` (
  `college_id` varchar(15) NOT NULL,
  `college_code` varchar(50) NOT NULL,
  `college` varchar(150) NOT NULL,
  `college_dean` varchar(50) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_college`
--

INSERT INTO `master_college` (`college_id`, `college_code`, `college`, `college_dean`, `create_date`) VALUES
('6glxsrL7UBDIAb', 'college', 'Sekolah Tinggi Desain', '-', '2021-09-01 16:49:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_cooperation`
--

CREATE TABLE `master_cooperation` (
  `cooperation_id` varchar(15) NOT NULL,
  `cooperation_status` enum('Education','Service','Research') NOT NULL,
  `cooperation_partner` varchar(50) NOT NULL,
  `cooperation_internasional` enum('0','1') NOT NULL,
  `cooperation_nasional` enum('0','1') NOT NULL,
  `cooperation_lokal` enum('0','1') NOT NULL,
  `cooperation_title` text NOT NULL,
  `cooperation_benefits` text NOT NULL,
  `cooperation_time` varchar(25) NOT NULL,
  `cooperation_proof` varchar(50) NOT NULL,
  `cooperation_over` varchar(5) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_cooperation`
--

INSERT INTO `master_cooperation` (`cooperation_id`, `cooperation_status`, `cooperation_partner`, `cooperation_internasional`, `cooperation_nasional`, `cooperation_lokal`, `cooperation_title`, `cooperation_benefits`, `cooperation_time`, `cooperation_proof`, `cooperation_over`, `create_date`) VALUES
('oRuTmrvV3ZwS06', 'Education', 'dummy', '1', '', '', 'dummy', 'dummy', 'dummy', 'image.png', '2021', '2021-05-25 14:56:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_courses`
--

CREATE TABLE `master_courses` (
  `courses_id` varchar(15) NOT NULL,
  `majors_code` varchar(25) NOT NULL,
  `courses_code` varchar(25) NOT NULL,
  `courses` varchar(50) NOT NULL,
  `courses_sks` int(11) NOT NULL,
  `courses_smt` int(11) NOT NULL,
  `courses_low_value` varchar(1) NOT NULL,
  `courses_discussion` text NOT NULL,
  `create_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_courses`
--

INSERT INTO `master_courses` (`courses_id`, `majors_code`, `courses_code`, `courses`, `courses_sks`, `courses_smt`, `courses_low_value`, `courses_discussion`, `create_date`) VALUES
('xfKta4NyGwisze', 'majors', 'Courses', 'Bahasa Pemograman', 4, 4, 'C', '', 2021);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_curriculum`
--

CREATE TABLE `master_curriculum` (
  `curriculum_id` varchar(15) NOT NULL,
  `curriculum_types_id` varchar(15) NOT NULL,
  `curriculum_school_year` varchar(25) NOT NULL,
  `curriculum_semester` varchar(25) NOT NULL,
  `class_code` varchar(25) NOT NULL,
  `majors_code` varchar(25) NOT NULL,
  `college_code` varchar(25) NOT NULL,
  `courses_code` varchar(25) NOT NULL,
  `lecturer_code` varchar(25) NOT NULL,
  `curriculum_day` varchar(15) NOT NULL,
  `curriculum_start` time NOT NULL,
  `curriculum_end` time NOT NULL,
  `curriculum_face` int(11) NOT NULL,
  `curriculum_status` enum('Active','Not Active') NOT NULL,
  `create_date` datetime NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_curriculum`
--

INSERT INTO `master_curriculum` (`curriculum_id`, `curriculum_types_id`, `curriculum_school_year`, `curriculum_semester`, `class_code`, `majors_code`, `college_code`, `courses_code`, `lecturer_code`, `curriculum_day`, `curriculum_start`, `curriculum_end`, `curriculum_face`, `curriculum_status`, `create_date`, `id`) VALUES
('nar8pvUbATu4O0', 'QLGr9uOnd6ChyH', '2020/2021', 'Genap', 'class2', 'majors', 'college', 'Courses', 'dosen', 'Friday', '13:00:00', '16:00:00', 4, 'Active', '2021-03-23 00:07:08', 2),
('SXOq3b4mo1WdsT', 'QLGr9uOnd6ChyH', '2020/2021', 'Genap', 'class2', 'majors', 'college', 'Courses', 'dosen', 'Monday', '10:00:00', '12:00:00', 2, 'Not Active', '2021-03-23 02:44:14', 3),
('Xc8gfWKvkhrREi', 'QLGr9uOnd6ChyH', '2020/2021', 'Genap', 'class2', 'majors', 'college', 'Courses', 'dosen', 'Monday', '10:00:00', '11:00:00', 4, 'Not Active', '2021-09-02 11:39:45', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_curriculum_types`
--

CREATE TABLE `master_curriculum_types` (
  `curriculum_types_id` varchar(15) NOT NULL,
  `curriculum_types` varchar(50) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_curriculum_types`
--

INSERT INTO `master_curriculum_types` (`curriculum_types_id`, `curriculum_types`, `create_date`) VALUES
('QLGr9uOnd6ChyH', 'Reguler', '2021-03-08 00:15:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_curriculum_uas`
--

CREATE TABLE `master_curriculum_uas` (
  `curriculum_id` varchar(15) NOT NULL,
  `uas_face` int(11) NOT NULL,
  `uas_start` time NOT NULL,
  `uas_end` time NOT NULL,
  `uas_date` date NOT NULL,
  `uas_class_code` varchar(15) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_curriculum_uas`
--

INSERT INTO `master_curriculum_uas` (`curriculum_id`, `uas_face`, `uas_start`, `uas_end`, `uas_date`, `uas_class_code`, `create_date`) VALUES
('nar8pvUbATu4O0', 4, '11:00:00', '12:00:00', '2021-03-23', 'class2', '2021-03-23 00:07:08'),
('Xc8gfWKvkhrREi', 8, '10:00:00', '11:00:00', '2021-09-02', 'class2', '2021-09-02 11:39:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_curriculum_uts`
--

CREATE TABLE `master_curriculum_uts` (
  `curriculum_id` varchar(15) NOT NULL,
  `uts_face` int(11) NOT NULL,
  `uts_start` time NOT NULL,
  `uts_end` time NOT NULL,
  `uts_date` date NOT NULL,
  `uts_class_code` varchar(15) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_curriculum_uts`
--

INSERT INTO `master_curriculum_uts` (`curriculum_id`, `uts_face`, `uts_start`, `uts_end`, `uts_date`, `uts_class_code`, `create_date`) VALUES
('nar8pvUbATu4O0', 4, '11:00:00', '12:00:00', '2021-03-23', 'class2', '2021-03-23 00:07:08'),
('Xc8gfWKvkhrREi', 4, '10:00:00', '11:00:00', '2021-09-02', 'class2', '2021-09-02 11:39:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_day`
--

CREATE TABLE `master_day` (
  `day` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_day`
--

INSERT INTO `master_day` (`day`) VALUES
('Monday'),
('Tuesday'),
('Wednesday'),
('Thrusday'),
('Friday'),
('Saturday'),
('Sunday');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_generation`
--

CREATE TABLE `master_generation` (
  `generation_id` varchar(15) NOT NULL,
  `generation` varchar(25) NOT NULL,
  `generation_status` enum('Active','Not Active') NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_generation`
--

INSERT INTO `master_generation` (`generation_id`, `generation`, `generation_status`, `create_date`) VALUES
('1Szp9ynFLJ3OVE', '2015/2016', 'Active', '2021-09-01 17:01:35'),
('8eysRw9fp3QkjP', '2014 Juni', 'Active', '2021-09-01 17:02:35'),
('8KXj4Dqwd9usWp', '2012/2013', 'Active', '2021-09-01 17:01:00'),
('9AJFluyK01edNU', '2010 Juni', 'Active', '2021-09-01 17:11:15'),
('9tnE4JpmgFUorX', '2011/2012', 'Active', '2021-09-01 17:01:12'),
('AD7CGoWPvdcJm1', '2018/2019', 'Active', '2021-09-01 17:03:33'),
('DHNv6WxwX2ayFZ', '2011 Juni', 'Active', '2021-09-01 17:02:06'),
('ecQY87dop2EIxr', '2012 Juni', 'Active', '2021-09-01 17:02:15'),
('jYZvsTwJlkCSXL', '2016/2017', 'Active', '2021-09-01 17:03:06'),
('nbvGxyQXj7lYEN', '2016 Juni', 'Active', '2021-09-01 17:02:55'),
('opSfJYk5Bmc2Ka', '2017/2018', 'Active', '2021-09-01 17:03:23'),
('rDapLlS7JxKg3Z', '2013/2014', 'Active', '2021-09-01 17:01:26'),
('ThZbg0QONw1xWq', '2017 Juni', 'Active', '2021-09-01 17:03:15'),
('Uf52h3O7NaF0cz', '2010/2011', 'Active', '2021-09-01 17:00:48'),
('WL3iHkXxunl2pP', '2013 Juni', 'Active', '2021-09-01 17:02:24'),
('xuTOzsmVpkEDHQ', '2015 Juni', 'Active', '2021-09-01 17:02:44'),
('YU2ARt5CJ8p1fd', '2014/2015', 'Active', '2021-09-01 17:01:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_ijasah`
--

CREATE TABLE `master_ijasah` (
  `ijasah_id` varchar(15) NOT NULL,
  `student_nim` varchar(25) NOT NULL,
  `ijasah_number` varchar(50) NOT NULL,
  `ijasah_date` date NOT NULL,
  `ijasah_concentration` text NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_ijasah`
--

INSERT INTO `master_ijasah` (`ijasah_id`, `student_nim`, `ijasah_number`, `ijasah_date`, `ijasah_concentration`, `create_date`) VALUES
('BglkfN7xU2yuOH', '12345', 'test', '2021-07-03', 'test', '2021-07-03 22:40:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_krs`
--

CREATE TABLE `master_krs` (
  `krs_id` varchar(15) NOT NULL,
  `curriculum_id` varchar(15) NOT NULL,
  `krs_school_year` varchar(15) NOT NULL,
  `krs_semester` varchar(15) NOT NULL,
  `student_nim` varchar(25) NOT NULL,
  `krs_approved` enum('Waiting','Approved','Not Approved') NOT NULL,
  `krs_advisor` varchar(15) NOT NULL,
  `krs_package_id` varchar(15) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_krs`
--

INSERT INTO `master_krs` (`krs_id`, `curriculum_id`, `krs_school_year`, `krs_semester`, `student_nim`, `krs_approved`, `krs_advisor`, `krs_package_id`, `create_date`) VALUES
('vxCVw5J3p9SfXT', 'SXOq3b4mo1WdsT', '2020/2021', 'Genap', '67890', 'Approved', 'dosen', 'HQizjEx1YNAVqL', '2021-05-11 17:05:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_krs_package`
--

CREATE TABLE `master_krs_package` (
  `krs_package_id` varchar(15) NOT NULL,
  `schedule_id` varchar(15) NOT NULL,
  `student_nim` varchar(25) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_krs_package`
--

INSERT INTO `master_krs_package` (`krs_package_id`, `schedule_id`, `student_nim`, `create_date`) VALUES
('7G0rf9sCENn5IQ', 'j2uzkySFeLTMvg', '67890', '2021-04-06 00:41:38'),
('HQizjEx1YNAVqL', 'j2uzkySFeLTMvg', '67890', '2021-05-11 17:05:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_lecturer`
--

CREATE TABLE `master_lecturer` (
  `account_id` varchar(15) NOT NULL,
  `lecturer_nidn` varchar(25) NOT NULL,
  `lecturer_code` varchar(25) NOT NULL,
  `lecturer_name` varchar(50) NOT NULL,
  `lecturer_phone` varchar(15) NOT NULL,
  `lecturer_place_birth` varchar(50) NOT NULL,
  `lecturer_date_birth` date NOT NULL,
  `lecturer_gender` enum('Male','Female') NOT NULL,
  `lecturer_npwp` varchar(25) NOT NULL,
  `lecturer_status` enum('Fixed','Not Fixed') NOT NULL,
  `lecturer_certification` varchar(50) NOT NULL,
  `lecturer_functional` varchar(50) NOT NULL,
  `lecturer_nidk` varchar(50) NOT NULL,
  `lecturer_nup` varchar(50) NOT NULL,
  `lecturer_education` varchar(50) NOT NULL,
  `lecturer_position` varchar(50) NOT NULL,
  `lecturer_specialist` varchar(50) NOT NULL,
  `lecturer_address` text NOT NULL,
  `lecturer_city` varchar(50) NOT NULL,
  `lecturer_poscode` varchar(15) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_lecturer`
--

INSERT INTO `master_lecturer` (`account_id`, `lecturer_nidn`, `lecturer_code`, `lecturer_name`, `lecturer_phone`, `lecturer_place_birth`, `lecturer_date_birth`, `lecturer_gender`, `lecturer_npwp`, `lecturer_status`, `lecturer_certification`, `lecturer_functional`, `lecturer_nidk`, `lecturer_nup`, `lecturer_education`, `lecturer_position`, `lecturer_specialist`, `lecturer_address`, `lecturer_city`, `lecturer_poscode`, `create_date`) VALUES
('yt1aHB4zNXkiWf', '', 'dosen', 'dosen', '089605905345', 'indramayu', '2021-03-28', 'Female', '', 'Fixed', '', '', '', '', '', '', '', 'indramayu', 'indramayu', '45252', '2021-05-10 00:25:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_logbook`
--

CREATE TABLE `master_logbook` (
  `logbook_id` varchar(15) NOT NULL,
  `logbook_date` date NOT NULL,
  `logbook_note` text NOT NULL,
  `logbook_information` text NOT NULL,
  `lecturer_code` varchar(25) NOT NULL,
  `student_nim` varchar(25) NOT NULL,
  `logbook_response` text NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_logbook`
--

INSERT INTO `master_logbook` (`logbook_id`, `logbook_date`, `logbook_note`, `logbook_information`, `lecturer_code`, `student_nim`, `logbook_response`, `create_date`) VALUES
('dLw1tGiAugmqRs', '2021-04-18', 'tes', 'tes', 'dosen', '67890', 'tes', '2021-04-18 13:51:29'),
('test', '2021-04-05', 'dummy', 'dummy', 'dosen', '12345', 'dummy', '2021-04-05 16:17:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_majors`
--

CREATE TABLE `master_majors` (
  `majors_id` varchar(15) NOT NULL,
  `college_code` varchar(25) NOT NULL,
  `majors_code` varchar(25) NOT NULL,
  `majors` varchar(50) NOT NULL,
  `prodi_code` varchar(15) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_majors`
--

INSERT INTO `master_majors` (`majors_id`, `college_code`, `majors_code`, `majors`, `prodi_code`, `create_date`) VALUES
('7BwjuE9XaoxGnF', 'college', 'majors', 'Desain Komunikasi Visual', '90241', '2021-09-01 16:52:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_profile`
--

CREATE TABLE `master_profile` (
  `profile_id` varchar(15) NOT NULL,
  `profile_title` varchar(25) NOT NULL,
  `profile_address` text NOT NULL,
  `profile_link_fb` text NOT NULL,
  `profile_link_ig` text NOT NULL,
  `profile_link_twitter` text NOT NULL,
  `profile_email` varchar(25) NOT NULL,
  `profile_telp` varchar(25) NOT NULL,
  `profile_maps` text NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_profile`
--

INSERT INTO `master_profile` (`profile_id`, `profile_title`, `profile_address`, `profile_link_fb`, `profile_link_ig`, `profile_link_twitter`, `profile_email`, `profile_telp`, `profile_maps`, `create_date`) VALUES
('Xwu097odzfrNBQ', 'Academic', '', '', '', '', '', '', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15864.74447239883!2d106.8180148!3d-6.2391836!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x61c0f75838aaf3c5!2sSekolah%20Tinggi%20Desain%20Inter%20Studi!5e0!3m2!1sid!2sid!4v1618667312023!5m2!1sid!2sid\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\" style=\"width: 100%; height: 200px;\"></iframe>', '2021-04-17 21:11:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_schedule`
--

CREATE TABLE `master_schedule` (
  `schedule_id` varchar(15) NOT NULL,
  `schedule` varchar(50) NOT NULL,
  `schedule_limit` int(11) NOT NULL,
  `college_code` varchar(15) NOT NULL,
  `majors_code` varchar(15) NOT NULL,
  `schedule_semester` varchar(15) NOT NULL,
  `schedule_school_year` varchar(15) NOT NULL,
  `schedule_generation` varchar(15) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_schedule`
--

INSERT INTO `master_schedule` (`schedule_id`, `schedule`, `schedule_limit`, `college_code`, `majors_code`, `schedule_semester`, `schedule_school_year`, `schedule_generation`, `create_date`) VALUES
('j2uzkySFeLTMvg', 'Testing2', 4, 'dummy', 'majors', 'Genap', '2020/2021', '2020/2021', '2021-03-28 12:47:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_school_year`
--

CREATE TABLE `master_school_year` (
  `school_year_id` varchar(15) NOT NULL,
  `school_year` varchar(25) NOT NULL,
  `school_year_status` enum('Active','Not Active') NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_school_year`
--

INSERT INTO `master_school_year` (`school_year_id`, `school_year`, `school_year_status`, `create_date`) VALUES
('01uFUfDwCM6HXy', '2020/2021', 'Active', '2021-09-01 17:18:07'),
('2j0u4Sfek8nbJL', '2021/2022', 'Not Active', '2021-09-01 17:18:19'),
('4T9CiM7FEKAp1J', '2019/2020', 'Active', '2021-09-01 17:17:41'),
('4zR5EFYbZ8pei2', '2018/2019', 'Not Active', '2021-09-01 17:16:56'),
('oldqJWybVPr0R2', 'Nilai Perbaikan', 'Not Active', '2021-09-01 17:17:51'),
('P2vijNdTyK1agq', '2016/2017', 'Not Active', '2021-09-01 17:17:29'),
('UKRrVnDsw6X0cq', 'Transfer', 'Not Active', '2021-09-01 17:17:06'),
('unD9v0wabKTA6H', '2017/2018', 'Not Active', '2021-09-01 17:16:45'),
('Usux7W51kraEFi', '2017', 'Not Active', '2021-09-01 17:17:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_score`
--

CREATE TABLE `master_score` (
  `score_id` varchar(15) NOT NULL,
  `curriculum_id` varchar(15) NOT NULL,
  `student_nim` varchar(25) NOT NULL,
  `score_school_year` varchar(15) NOT NULL,
  `score_semester` varchar(15) NOT NULL,
  `score_attendance` varchar(5) NOT NULL,
  `score_uts` varchar(5) NOT NULL,
  `score_uas` varchar(5) NOT NULL,
  `score_quiz` varchar(5) NOT NULL,
  `score_numbers` varchar(5) NOT NULL,
  `score_alphabet` varchar(5) NOT NULL,
  `score_quality` varchar(5) NOT NULL,
  `courses_code` varchar(15) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_score`
--

INSERT INTO `master_score` (`score_id`, `curriculum_id`, `student_nim`, `score_school_year`, `score_semester`, `score_attendance`, `score_uts`, `score_uas`, `score_quiz`, `score_numbers`, `score_alphabet`, `score_quality`, `courses_code`, `create_date`) VALUES
('uhKdan4b61OpzY', 'SXOq3b4mo1WdsT', '67890', '2020/2021', 'Genap', '3', '50', '70', '60', '70', 'B-', '2.75', 'Courses', '2021-05-01 01:22:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_score_file`
--

CREATE TABLE `master_score_file` (
  `score_file_id` varchar(15) NOT NULL,
  `curriculum_id` varchar(15) NOT NULL,
  `score_file_type` enum('UTS','UAS') NOT NULL,
  `score_file` varchar(50) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_score_file`
--

INSERT INTO `master_score_file` (`score_file_id`, `curriculum_id`, `score_file_type`, `score_file`, `create_date`) VALUES
('2DCZkvloOrpJsH', 'SXOq3b4mo1WdsT', 'UTS', 'efk0grth2cimage.png', '2021-05-28 01:00:31'),
('cIJ5hGr1BE2V9Q', 'SXOq3b4mo1WdsT', 'UAS', 'of62jyauv5image.png', '2021-05-28 00:59:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_score_weight`
--

CREATE TABLE `master_score_weight` (
  `curriculum_id` varchar(15) NOT NULL,
  `weight_attendance` int(11) NOT NULL,
  `weight_uts` int(11) NOT NULL,
  `weight_uas` int(11) NOT NULL,
  `weight_quiz` int(11) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_score_weight`
--

INSERT INTO `master_score_weight` (`curriculum_id`, `weight_attendance`, `weight_uts`, `weight_uas`, `weight_quiz`, `create_date`) VALUES
('SXOq3b4mo1WdsT', 25, 25, 25, 25, '2021-03-23 01:34:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_semester`
--

CREATE TABLE `master_semester` (
  `semester_id` varchar(15) NOT NULL,
  `semester` varchar(25) NOT NULL,
  `semester_status` enum('Active','Not Active') NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_semester`
--

INSERT INTO `master_semester` (`semester_id`, `semester`, `semester_status`, `create_date`) VALUES
('1EPGADtaShf98k', 'Ganjil', 'Active', '2021-09-01 17:21:42'),
('b2mGfiwhq70WZp', 'Genap', 'Active', '2021-09-01 17:21:50'),
('h41z5VLYfT9xrd', 'Pendek', 'Active', '2021-09-01 17:21:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_skripsi`
--

CREATE TABLE `master_skripsi` (
  `skripsi_id` varchar(15) NOT NULL,
  `student_nim` varchar(25) NOT NULL,
  `skripsi_title` text NOT NULL,
  `skripsi_abstract` text NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_skripsi`
--

INSERT INTO `master_skripsi` (`skripsi_id`, `student_nim`, `skripsi_title`, `skripsi_abstract`, `create_date`) VALUES
('tpFn8G04BQ5OZ3', '67890', 'Far far away, behind the word mountains\r\n', '<div class=\"blog-body\">\r\n					                            <p>A wonderful serenity has taken \r\npossession of my entire soul, like these sweet mornings of spring which I\r\n enjoy with my whole heart. A wonderful serenity has taken \r\npossession of my entire soul, like these sweet mornings of spring which I\r\n enjoy with my whole heart. A wonderful serenity has taken \r\npossession of my entire soul, like these sweet mornings of spring which I\r\n enjoy with my whole heart. A wonderful serenity has taken possession of\r\n my entire soul, like these sweet mornings of spring which I enjoy with \r\nmy whole heart. </p>\r\n					                        </div>', '2021-06-27 16:15:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_skripsi_file`
--

CREATE TABLE `master_skripsi_file` (
  `skripsi_file_id` varchar(15) NOT NULL,
  `student_nim` varchar(25) NOT NULL,
  `skripsi_file` varchar(50) NOT NULL,
  `skripsi_file_status` enum('Daftar Isi','Bab1','Bab2','Bab3','Bab4','Bab5','Penutup') NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_skripsi_file`
--

INSERT INTO `master_skripsi_file` (`skripsi_file_id`, `student_nim`, `skripsi_file`, `skripsi_file_status`, `create_date`) VALUES
('3kJUlWq0Krmnoa', '67890', 'HMKdh3TrPLl62ADaftar Isi.pdf', 'Daftar Isi', '2021-07-05 12:06:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_student`
--

CREATE TABLE `master_student` (
  `account_id` varchar(15) NOT NULL,
  `college_code` varchar(25) NOT NULL,
  `majors_code` varchar(25) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `student_nim` varchar(25) NOT NULL,
  `student_status` enum('Single','Married') NOT NULL,
  `student_generation` varchar(15) NOT NULL,
  `student_gender` enum('Male','Female') NOT NULL,
  `student_religion` varchar(25) NOT NULL,
  `student_phone` varchar(15) NOT NULL,
  `student_handphone` varchar(25) NOT NULL,
  `student_place_birth` varchar(50) NOT NULL,
  `student_date_birth` date NOT NULL,
  `student_nik` varchar(25) NOT NULL,
  `student_nisn` varchar(25) NOT NULL,
  `student_start_semester` varchar(10) NOT NULL,
  `student_kps` enum('No','Yes') NOT NULL,
  `student_no_kps` varchar(25) NOT NULL,
  `student_type_stay` varchar(50) NOT NULL,
  `student_transportation` varchar(50) NOT NULL,
  `student_registration_path` varchar(50) NOT NULL,
  `student_npwp` varchar(25) NOT NULL,
  `student_citizenship` varchar(50) NOT NULL,
  `student_registration_type` varchar(50) NOT NULL,
  `student_college_entry_date` date NOT NULL,
  `student_type_of_financing` varchar(50) NOT NULL,
  `student_address` text NOT NULL,
  `student_address_rt` varchar(5) NOT NULL,
  `student_address_rw` varchar(5) NOT NULL,
  `student_address_village` varchar(50) NOT NULL,
  `student_address_ward` varchar(50) NOT NULL,
  `student_address_district` varchar(50) NOT NULL,
  `student_city` varchar(50) NOT NULL,
  `student_poscode` varchar(10) NOT NULL,
  `student_advisor` varchar(25) NOT NULL,
  `student_sks` int(11) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_student`
--

INSERT INTO `master_student` (`account_id`, `college_code`, `majors_code`, `student_name`, `student_nim`, `student_status`, `student_generation`, `student_gender`, `student_religion`, `student_phone`, `student_handphone`, `student_place_birth`, `student_date_birth`, `student_nik`, `student_nisn`, `student_start_semester`, `student_kps`, `student_no_kps`, `student_type_stay`, `student_transportation`, `student_registration_path`, `student_npwp`, `student_citizenship`, `student_registration_type`, `student_college_entry_date`, `student_type_of_financing`, `student_address`, `student_address_rt`, `student_address_rw`, `student_address_village`, `student_address_ward`, `student_address_district`, `student_city`, `student_poscode`, `student_advisor`, `student_sks`, `create_date`) VALUES
('17gQZROlKzkd3i', 'dummy', 'majors', 'mahasiswa2', '12345', '', '2020/2021', 'Male', '', '0896059053452', '', 'indramayu2', '2021-03-28', '', '', '', 'No', '', '', '', '', '', '', '', '0000-00-00', '', 'indramayu2', '', '', '', '', '', 'indramayu2', '452522', 'dosen', 20, '2021-03-28 03:23:03'),
('HMKdh3TrPLl62A', 'dummy', 'majors', 'mahasiswa', '67890', '', '2020/2021', 'Female', '', '089605905345', '', 'indramayu', '2021-03-28', '', '', '', 'No', '', '', '', '', '', '', '', '0000-00-00', '', 'indramayu', '', '', '', '', '', 'indramayu', '45252', 'dosen', 20, '2021-03-28 03:23:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_student_access`
--

CREATE TABLE `master_student_access` (
  `student_access_id` varchar(15) NOT NULL,
  `student_nim` varchar(25) NOT NULL,
  `student_access_school_year` varchar(15) NOT NULL,
  `student_access_semester` varchar(15) NOT NULL,
  `student_access_uts` enum('0','1') NOT NULL,
  `student_access_quiz` enum('0','1') NOT NULL,
  `student_access_uas` enum('0','1') NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_student_access`
--

INSERT INTO `master_student_access` (`student_access_id`, `student_nim`, `student_access_school_year`, `student_access_semester`, `student_access_uts`, `student_access_quiz`, `student_access_uas`, `create_date`) VALUES
('DHXZrFkUYIgE8j', '12345', '2020/2021', 'Genap', '', '1', '1', '2021-06-20 16:41:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_student_father`
--

CREATE TABLE `master_student_father` (
  `student_nim` varchar(25) NOT NULL,
  `father_nik` varchar(25) NOT NULL,
  `father_name` varchar(50) NOT NULL,
  `father_date_birth` date NOT NULL,
  `father_phone` varchar(25) NOT NULL,
  `father_handphone` varchar(25) NOT NULL,
  `father_address` varchar(50) NOT NULL,
  `father_districts` varchar(50) NOT NULL,
  `father_education` varchar(25) NOT NULL,
  `father_profession` varchar(50) NOT NULL,
  `father_income` int(11) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_student_father`
--

INSERT INTO `master_student_father` (`student_nim`, `father_nik`, `father_name`, `father_date_birth`, `father_phone`, `father_handphone`, `father_address`, `father_districts`, `father_education`, `father_profession`, `father_income`, `create_date`) VALUES
('12345', '', '', '2021-06-20', '', '', '', '', '', '', 0, '2021-06-20 16:11:39'),
('67890', '', '', '2021-06-20', '', '', '', '', '', '', 0, '2021-06-20 16:11:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_student_guardian`
--

CREATE TABLE `master_student_guardian` (
  `student_nim` varchar(25) NOT NULL,
  `guardian_name` varchar(50) NOT NULL,
  `guardian_date_birth` date NOT NULL,
  `guardian_education` varchar(50) NOT NULL,
  `guardian_profession` varchar(50) NOT NULL,
  `guardian_income` int(11) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_student_guardian`
--

INSERT INTO `master_student_guardian` (`student_nim`, `guardian_name`, `guardian_date_birth`, `guardian_education`, `guardian_profession`, `guardian_income`, `create_date`) VALUES
('12345', '', '2021-06-20', '', '', 0, '2021-06-20 16:23:13'),
('67890', '', '2021-06-20', '', '', 0, '2021-06-20 16:23:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_student_history`
--

CREATE TABLE `master_student_history` (
  `student_history_id` varchar(15) NOT NULL,
  `student_nim` varchar(25) NOT NULL,
  `student_history_school_year` varchar(25) NOT NULL,
  `student_history_semester` varchar(25) NOT NULL,
  `student_history_status` varchar(25) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_student_history`
--

INSERT INTO `master_student_history` (`student_history_id`, `student_nim`, `student_history_school_year`, `student_history_semester`, `student_history_status`, `create_date`) VALUES
('A1Nyp6xMHrzQR0', '67890', '2020/2021', 'Genap', 'Active', '2021-05-27 09:18:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_student_mother`
--

CREATE TABLE `master_student_mother` (
  `student_nim` varchar(25) NOT NULL,
  `mother_nik` varchar(25) NOT NULL,
  `mother_name` varchar(50) NOT NULL,
  `mother_date_birth` date NOT NULL,
  `mother_phone` varchar(25) NOT NULL,
  `mother_handphone` varchar(25) NOT NULL,
  `mother_address` varchar(50) NOT NULL,
  `mother_districts` varchar(50) NOT NULL,
  `mother_education` varchar(25) NOT NULL,
  `mother_profession` varchar(50) NOT NULL,
  `mother_income` int(11) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_student_mother`
--

INSERT INTO `master_student_mother` (`student_nim`, `mother_nik`, `mother_name`, `mother_date_birth`, `mother_phone`, `mother_handphone`, `mother_address`, `mother_districts`, `mother_education`, `mother_profession`, `mother_income`, `create_date`) VALUES
('12345', '', '', '2021-06-20', '', '', '', '', '', '', 0, '2021-06-20 16:14:31'),
('67890', '', '', '2021-06-20', '', '', '', '', '', '', 0, '2021-06-20 16:14:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_student_school`
--

CREATE TABLE `master_student_school` (
  `student_nim` varchar(25) NOT NULL,
  `school_name` varchar(50) NOT NULL,
  `school_address` varchar(50) NOT NULL,
  `school_district` varchar(50) NOT NULL,
  `school_majors` varchar(50) NOT NULL,
  `school_study_program` varchar(50) NOT NULL,
  `school_graduation_year` varchar(10) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_student_school`
--

INSERT INTO `master_student_school` (`student_nim`, `school_name`, `school_address`, `school_district`, `school_majors`, `school_study_program`, `school_graduation_year`, `create_date`) VALUES
('12345', '', '', '', '', '', '', '2021-06-20 16:20:20'),
('67890', '', '', '', '', '', '', '2021-06-20 16:20:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_student_skpi`
--

CREATE TABLE `master_student_skpi` (
  `student_skpi_id` varchar(15) NOT NULL,
  `student_skpi_entry_year` varchar(5) NOT NULL,
  `student_skpi_graduation_date` date NOT NULL,
  `student_skpi_diploma_number` varchar(25) NOT NULL,
  `student_skpi_degree` varchar(25) NOT NULL,
  `student_skpi_length_study` varchar(25) NOT NULL,
  `student_skpi_sks` varchar(5) NOT NULL,
  `student_skpi_ipk` varchar(5) NOT NULL,
  `student_skpi_no` varchar(25) NOT NULL,
  `student_skpi_study_program` varchar(50) NOT NULL,
  `student_skpi_educational_level` text NOT NULL,
  `student_skpi_our_level` text NOT NULL,
  `student_skpi_admission_requirements` text NOT NULL,
  `student_skpi_language_instruction` text NOT NULL,
  `student_skpi_scoring_system` text NOT NULL,
  `student_skpi_further_education` text NOT NULL,
  `student_skpi_professional_status` varchar(50) NOT NULL,
  `student_skpi_dean_name` varchar(50) NOT NULL,
  `student_skpi_dean_nik` varchar(25) NOT NULL,
  `student_nim` varchar(25) NOT NULL,
  `capaian_pembelajaran_ind` text NOT NULL,
  `capaian_pembelajaran_ing` text NOT NULL,
  `kemampuan_dibidang_kerja_ind` text NOT NULL,
  `kemampuan_dibidang_kerja_ing` text NOT NULL,
  `pengetahuan_dikuasai_ind` text NOT NULL,
  `pengetahuan_dikuasai_ing` text NOT NULL,
  `sikap_khusus_ind` text NOT NULL,
  `sikap_khusus_ing` text NOT NULL,
  `prestasi_penghargaan_ind` text NOT NULL,
  `prestasi_penghargaan_ing` text NOT NULL,
  `penghargaan_pemenang_ind` text NOT NULL,
  `penghargaan_pemenang_ing` text NOT NULL,
  `seminar_ind` text NOT NULL,
  `seminar_ing` text NOT NULL,
  `organisasi_ind` text NOT NULL,
  `organisasi_ing` text NOT NULL,
  `tugas_akhir_ind` text NOT NULL,
  `tugas_akhir_ing` text NOT NULL,
  `bahasa_internasional_ind` text NOT NULL,
  `bahasa_internasional_ing` text NOT NULL,
  `magang_ind` text NOT NULL,
  `magang_ing` text NOT NULL,
  `pendidikan_karakter_ind` text NOT NULL,
  `pendidikan_karakter_ing` text NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_student_skpi`
--

INSERT INTO `master_student_skpi` (`student_skpi_id`, `student_skpi_entry_year`, `student_skpi_graduation_date`, `student_skpi_diploma_number`, `student_skpi_degree`, `student_skpi_length_study`, `student_skpi_sks`, `student_skpi_ipk`, `student_skpi_no`, `student_skpi_study_program`, `student_skpi_educational_level`, `student_skpi_our_level`, `student_skpi_admission_requirements`, `student_skpi_language_instruction`, `student_skpi_scoring_system`, `student_skpi_further_education`, `student_skpi_professional_status`, `student_skpi_dean_name`, `student_skpi_dean_nik`, `student_nim`, `capaian_pembelajaran_ind`, `capaian_pembelajaran_ing`, `kemampuan_dibidang_kerja_ind`, `kemampuan_dibidang_kerja_ing`, `pengetahuan_dikuasai_ind`, `pengetahuan_dikuasai_ing`, `sikap_khusus_ind`, `sikap_khusus_ing`, `prestasi_penghargaan_ind`, `prestasi_penghargaan_ing`, `penghargaan_pemenang_ind`, `penghargaan_pemenang_ing`, `seminar_ind`, `seminar_ing`, `organisasi_ind`, `organisasi_ing`, `tugas_akhir_ind`, `tugas_akhir_ing`, `bahasa_internasional_ind`, `bahasa_internasional_ing`, `magang_ind`, `magang_ing`, `pendidikan_karakter_ind`, `pendidikan_karakter_ing`, `create_date`) VALUES
('K28I0hWt3m5GUL', 'dummy', '2021-05-26', 'dummy2', 'dummy2', 'dummy2', 'dummy', 'dummy', 'dummy2', 'dummy2', 'dummy2', 'dummy2', 'dummy2', 'dummy2', 'dummy2', 'dummy2', 'dummy2 ', '', '', '67890', '<p>dummy<br></p>', '<p>dummy2<br></p>', '<p>dummy<br></p>', '<p>dummy2<br></p>', '<p>dummy<br></p>', '<p>dummy2<br></p>', '<p>dummy<br></p>', '<p>dummy<br></p>', '<p>dummy<br></p>', '<p>dummy2<br></p>', '<p>dummy<br></p>', '<p>dummy2<br></p>', '<p>dummy<br></p>', '<p>dummy2<br></p>', '<p>dummy<br></p>', '<p>dummy2<br></p>', '<p>dummy<br></p>', '<p>dummy2<br></p>', '<p>dummy<br></p>', '<p>dummy2<br></p>', '<p>dummy<br></p>', '<p>dummy2<br></p>', '<p>dummy<br></p>', '<p>dummy2<br></p>', '2021-05-26 16:14:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_student_skpi_file`
--

CREATE TABLE `master_student_skpi_file` (
  `student_skpi_file_id` varchar(15) NOT NULL,
  `student_skpi_file` varchar(50) NOT NULL,
  `student_nim` varchar(25) NOT NULL,
  `student_skpi_file_status` varchar(25) NOT NULL,
  `student_skpi_file_title_ind` text NOT NULL,
  `student_skpi_file_title_ing` text NOT NULL,
  `student_skpi_file_institution` text NOT NULL,
  `student_skpi_file_duration` int(11) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_student_skpi_file`
--

INSERT INTO `master_student_skpi_file` (`student_skpi_file_id`, `student_skpi_file`, `student_nim`, `student_skpi_file_status`, `student_skpi_file_title_ind`, `student_skpi_file_title_ing`, `student_skpi_file_institution`, `student_skpi_file_duration`, `create_date`) VALUES
('iA3L0fIVSse7Uw', '415bujxts0Attendance.pdf', '67890', 'prestasi ', 'dummy', 'dummy', 'dummy', 2, '2021-07-05 12:36:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_student_skpi_weight`
--

CREATE TABLE `master_student_skpi_weight` (
  `student_skpi_weight_id` varchar(15) NOT NULL,
  `student_nim` varchar(25) NOT NULL,
  `bobot_prestasi_penghargaan` int(11) NOT NULL,
  `bobot_penghargaan_pemenang` int(11) NOT NULL,
  `bobot_seminar` int(11) NOT NULL,
  `bobot_organisasi` int(11) NOT NULL,
  `bobot_tugas_akhir` int(11) NOT NULL,
  `bobot_bahasa_internasional` int(11) NOT NULL,
  `bobot_magang` int(11) NOT NULL,
  `bobot_pendidikan_karakter` int(11) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_student_skpi_weight`
--

INSERT INTO `master_student_skpi_weight` (`student_skpi_weight_id`, `student_nim`, `bobot_prestasi_penghargaan`, `bobot_penghargaan_pemenang`, `bobot_seminar`, `bobot_organisasi`, `bobot_tugas_akhir`, `bobot_bahasa_internasional`, `bobot_magang`, `bobot_pendidikan_karakter`, `create_date`) VALUES
('K28I0hWt3m5GUL', '67890', 10, 10, 10, 10, 10, 10, 10, 10, '2021-05-26 16:14:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_support`
--

CREATE TABLE `master_support` (
  `support_id` varchar(15) NOT NULL,
  `account_id` varchar(15) NOT NULL,
  `support_subject` text NOT NULL,
  `support_message` text NOT NULL,
  `support_reply` text NOT NULL,
  `support_reply_date` datetime NOT NULL,
  `support_email` varchar(25) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_support`
--

INSERT INTO `master_support` (`support_id`, `account_id`, `support_subject`, `support_message`, `support_reply`, `support_reply_date`, `support_email`, `create_date`) VALUES
('NjcOL7GBUShKCI', 'yt1aHB4zNXkiWf', 'testing', 'mesage', '', '0000-00-00 00:00:00', 'dosen@gmail.com', '2021-04-17 23:24:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_user`
--

CREATE TABLE `master_user` (
  `account_id` varchar(15) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_phone` varchar(15) NOT NULL,
  `user_place_birth` varchar(50) NOT NULL,
  `user_date_birth` date NOT NULL,
  `user_gender` enum('Male','Female') NOT NULL,
  `user_address` text NOT NULL,
  `user_city` varchar(50) NOT NULL,
  `user_poscode` varchar(15) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_user`
--

INSERT INTO `master_user` (`account_id`, `user_name`, `user_phone`, `user_place_birth`, `user_date_birth`, `user_gender`, `user_address`, `user_city`, `user_poscode`, `create_date`) VALUES
('gtq0x7h1uAmZpM', 'dummy2', '0896059053452', 'Indramayu2', '2021-11-12', 'Male', 'Indramayu2', 'Indramayu2', '452522', '2021-03-28 02:46:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `podcast`
--

CREATE TABLE `podcast` (
  `podcast_id` varchar(15) NOT NULL,
  `podcast_title` text NOT NULL,
  `podcast_description` text NOT NULL,
  `podcast_client_id` varchar(50) NOT NULL,
  `podcast_url` text NOT NULL,
  `podcast_start_date` datetime NOT NULL,
  `podcast_end_date` datetime NOT NULL,
  `account_id` varchar(15) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `podcast`
--

INSERT INTO `podcast` (`podcast_id`, `podcast_title`, `podcast_description`, `podcast_client_id`, `podcast_url`, `podcast_start_date`, `podcast_end_date`, `account_id`, `create_date`) VALUES
('FGNEdniAeBuJXz', 'Testing2', '<p>Testing2<br></p>', 'UCKnkCONTMhBPZyZrCRx2ulw', '', '2021-07-04 00:00:00', '2021-07-05 00:00:00', 'gtq0x7h1uAmZpM', '2021-07-04 00:51:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `polling_answer`
--

CREATE TABLE `polling_answer` (
  `polling_answer_id` varchar(15) NOT NULL,
  `polling_choice_id` varchar(15) NOT NULL,
  `polling_id` varchar(15) NOT NULL,
  `account_id` varchar(15) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `polling_answer`
--

INSERT INTO `polling_answer` (`polling_answer_id`, `polling_choice_id`, `polling_id`, `account_id`, `create_date`) VALUES
('iV4yHuScLeoJQn', '4hCj9dMcHSli3J', '7FTvON5EZj4m62', 'admin', '2021-06-27 16:44:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `polling_choice`
--

CREATE TABLE `polling_choice` (
  `polling_choice_id` varchar(15) NOT NULL,
  `polling_choice` text NOT NULL,
  `polling_id` varchar(15) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `polling_choice`
--

INSERT INTO `polling_choice` (`polling_choice_id`, `polling_choice`, `polling_id`, `create_date`) VALUES
('1bWqJiKC2HQpzt', 'Pilihan Ke 3', '1epvFQACbD76Sx', '2021-06-27 16:42:19'),
('4hCj9dMcHSli3J', 'Ketiga', '7FTvON5EZj4m62', '2021-06-27 16:27:06'),
('8ifz2KutLNdH0V', 'Pilihan Ke 2', '1epvFQACbD76Sx', '2021-06-27 16:42:19'),
('Amo0CBzMIp2bV9', 'Kedua', '7FTvON5EZj4m62', '2021-06-27 16:27:06'),
('Bjcvo4TwMG2aU8', 'Tiga', '3F6SoaJPWmzlsx', '2021-06-27 16:25:28'),
('BsvJjTIeD8YNAz', 'Pilihan Ke 1', '1epvFQACbD76Sx', '2021-06-27 16:42:19'),
('C9ln3MXOiE2sNR', 'Satu ', '3F6SoaJPWmzlsx', '2021-06-27 16:25:28'),
('ncSumQUoCYefMv', 'Pertama', '3HT6EuzcP9thVR', '2021-06-26 17:36:37'),
('qs0aFzIlZdW7fu', 'Kedua', '3HT6EuzcP9thVR', '2021-06-26 17:36:37'),
('V3ZKwgNH7LmnJv', 'Ketiga', '3HT6EuzcP9thVR', '2021-06-26 17:36:37'),
('vO7w2K6Vr9TqBb', 'Dua', '3F6SoaJPWmzlsx', '2021-06-27 16:25:28'),
('ZWTaVlXy6BjQeP', 'Kesatu', '7FTvON5EZj4m62', '2021-06-27 16:27:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `polling_general`
--

CREATE TABLE `polling_general` (
  `polling_id` varchar(15) NOT NULL,
  `polling_title` text NOT NULL,
  `polling_description` text NOT NULL,
  `polling_choice` text NOT NULL,
  `polling_start_date` datetime NOT NULL,
  `polling_end_date` datetime NOT NULL,
  `account_id` varchar(15) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `polling_general`
--

INSERT INTO `polling_general` (`polling_id`, `polling_title`, `polling_description`, `polling_choice`, `polling_start_date`, `polling_end_date`, `account_id`, `create_date`) VALUES
('3HT6EuzcP9thVR', 'Test Polling General', '<p>Test Polling General<br></p>', 'Pertama,Kedua,Ketiga', '2021-06-26 00:00:00', '2021-06-27 00:00:00', 'admin', '2021-06-26 17:36:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `polling_majors`
--

CREATE TABLE `polling_majors` (
  `polling_id` varchar(15) NOT NULL,
  `majors_code` varchar(25) NOT NULL,
  `polling_title` text NOT NULL,
  `polling_description` text NOT NULL,
  `polling_choice` text NOT NULL,
  `polling_start_date` datetime NOT NULL,
  `polling_end_date` datetime NOT NULL,
  `account_id` varchar(15) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `polling_majors`
--

INSERT INTO `polling_majors` (`polling_id`, `majors_code`, `polling_title`, `polling_description`, `polling_choice`, `polling_start_date`, `polling_end_date`, `account_id`, `create_date`) VALUES
('1epvFQACbD76Sx', 'majors', 'Testng Polling Ke 3', '<p>Keterangan Disini<br></p>', 'Pilihan Ke 1,Pilihan Ke 2,Pilihan Ke 3', '2021-06-28 00:00:00', '2021-06-29 00:00:00', 'admin', '2021-06-27 16:42:19'),
('3F6SoaJPWmzlsx', 'majors', 'Test Polling', '<p>But I must explain to you how all this mistaken idea of denouncing \r\npleasure and praising pain was born and I will give you a complete \r\naccount of the system. But I must explain to you how all \r\nthis mistaken idea of denouncing pleasure and praising pain was born and\r\n I will give you a complete account of the system. I must explain to you how all this \r\nmistaken idea of denouncing pleasure was born and I will give you a \r\ncomplete account of the system.\r\n					                        <br></p>', 'Satu ,Dua,Tiga', '2021-06-28 00:00:00', '2021-06-29 00:00:00', 'admin', '2021-06-27 16:25:28'),
('7FTvON5EZj4m62', 'majors', 'Test Polling 2', '<p>But I must explain to you how all \r\nthis mistaken idea of denouncing pleasure and praising pain was born and\r\n I will give you a complete account of the system. I must explain to you how all this \r\nmistaken idea of denouncing pleasure was born and I will give you a \r\ncomplete account of the system.</p>', 'Kesatu,Kedua,Ketiga', '2021-06-25 00:00:00', '2021-06-26 00:00:00', 'admin', '2021-06-27 16:27:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `questionnaire_academic`
--

CREATE TABLE `questionnaire_academic` (
  `q_academic_id` varchar(15) NOT NULL,
  `category_id` varchar(15) NOT NULL,
  `q_academic_description` text NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `questionnaire_academic`
--

INSERT INTO `questionnaire_academic` (`q_academic_id`, `category_id`, `q_academic_description`, `create_date`) VALUES
('8jsHQSI3m26aFY', '0wfGdopB4h8TtL', 'Academic 1', '2021-03-30 01:54:26'),
('qBo4Ntm5ADejFp', '0wfGdopB4h8TtL', 'Academic 2', '2021-03-30 01:54:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `questionnaire_advisor`
--

CREATE TABLE `questionnaire_advisor` (
  `q_advisor_id` varchar(15) NOT NULL,
  `category_id` varchar(15) NOT NULL,
  `q_advisor_description` text NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `questionnaire_advisor`
--

INSERT INTO `questionnaire_advisor` (`q_advisor_id`, `category_id`, `q_advisor_description`, `create_date`) VALUES
('Lzi4tP8gcTM1jV', '0wfGdopB4h8TtL', 'Supervisor 1', '2021-03-30 02:18:07'),
('WuCJs3bF1fzcTM', '0wfGdopB4h8TtL', 'Supervisor 2', '2021-03-30 02:18:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `questionnaire_category`
--

CREATE TABLE `questionnaire_category` (
  `category_id` varchar(15) NOT NULL,
  `category` text NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `questionnaire_category`
--

INSERT INTO `questionnaire_category` (`category_id`, `category`, `create_date`) VALUES
('0wfGdopB4h8TtL', 'Kategori 1', '2021-03-30 01:40:12'),
('5ipTCzVgUrHmnA', 'Kategori 4', '2021-03-30 01:40:57'),
('mq78pbMyeNSn6o', 'Kategori 3', '2021-03-30 01:40:44'),
('YekcQb2fN84Hxu', 'Kategori 2', '2021-03-30 01:40:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `questionnaire_general`
--

CREATE TABLE `questionnaire_general` (
  `q_general_id` varchar(15) NOT NULL,
  `category_id` varchar(15) NOT NULL,
  `q_general_description` text NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `questionnaire_general`
--

INSERT INTO `questionnaire_general` (`q_general_id`, `category_id`, `q_general_description`, `create_date`) VALUES
('59ebjM4gm8HI0n', '0wfGdopB4h8TtL', 'General 1', '2021-03-30 02:09:41'),
('5kvyxqAXrtC9JU', '0wfGdopB4h8TtL', 'General 2', '2021-03-30 02:09:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `questionnaire_lecturer`
--

CREATE TABLE `questionnaire_lecturer` (
  `q_lecturer_id` varchar(15) NOT NULL,
  `category_id` varchar(15) NOT NULL,
  `q_lecturer_description` text NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `questionnaire_lecturer`
--

INSERT INTO `questionnaire_lecturer` (`q_lecturer_id`, `category_id`, `q_lecturer_description`, `create_date`) VALUES
('Kp4fHuro6WhnR9', '0wfGdopB4h8TtL', 'Lecturer 1', '2021-03-30 02:05:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `questionnaire_report_academic`
--

CREATE TABLE `questionnaire_report_academic` (
  `qr_academic_id` varchar(15) NOT NULL,
  `q_academic_id` varchar(15) NOT NULL,
  `q_academic_answer` varchar(5) NOT NULL,
  `student_nim` varchar(25) NOT NULL,
  `school_year` varchar(15) NOT NULL,
  `semester` varchar(15) NOT NULL,
  `qr_status` enum('unfinish','finish') NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `questionnaire_report_advisor`
--

CREATE TABLE `questionnaire_report_advisor` (
  `qr_advisor_id` varchar(15) NOT NULL,
  `q_advisor_id` varchar(15) NOT NULL,
  `q_advisor_answer` varchar(5) NOT NULL,
  `student_nim` varchar(25) NOT NULL,
  `school_year` varchar(15) NOT NULL,
  `semester` varchar(15) NOT NULL,
  `qr_status` enum('unfinish','finish') NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `questionnaire_report_general`
--

CREATE TABLE `questionnaire_report_general` (
  `qr_general_id` varchar(15) NOT NULL,
  `q_general_id` varchar(15) NOT NULL,
  `q_general_answer` varchar(5) NOT NULL,
  `student_nim` varchar(25) NOT NULL,
  `school_year` varchar(15) NOT NULL,
  `semester` varchar(15) NOT NULL,
  `qr_status` enum('unfinish','finish') NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `questionnaire_report_general`
--

INSERT INTO `questionnaire_report_general` (`qr_general_id`, `q_general_id`, `q_general_answer`, `student_nim`, `school_year`, `semester`, `qr_status`, `create_date`) VALUES
('9h3wkWP8Es4Bxv', '59ebjM4gm8HI0n', '3', '67890', '2020/2021', 'Genap', 'finish', '2021-04-19 01:01:59'),
('TDqsGnpIhf65XK', '5kvyxqAXrtC9JU', '3', '67890', '2020/2021', 'Genap', 'finish', '2021-04-19 01:02:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `questionnaire_report_lecturer`
--

CREATE TABLE `questionnaire_report_lecturer` (
  `qr_lecturer_id` varchar(15) NOT NULL,
  `q_lecturer_id` varchar(15) NOT NULL,
  `curriculum_id` varchar(15) NOT NULL,
  `q_lecturer_answer` varchar(5) NOT NULL,
  `student_nim` varchar(25) NOT NULL,
  `school_year` varchar(15) NOT NULL,
  `semester` varchar(15) NOT NULL,
  `qr_status` enum('unfinish','finish') NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `questionnaire_report_lecturer`
--

INSERT INTO `questionnaire_report_lecturer` (`qr_lecturer_id`, `q_lecturer_id`, `curriculum_id`, `q_lecturer_answer`, `student_nim`, `school_year`, `semester`, `qr_status`, `create_date`) VALUES
('P1Do5mxspiaK7A', 'Kp4fHuro6WhnR9', 'SXOq3b4mo1WdsT', '2', '67890', '2020/2021', 'Genap', 'finish', '2021-04-19 02:10:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `questionnaire_report_suggestions`
--

CREATE TABLE `questionnaire_report_suggestions` (
  `qr_suggestions_id` varchar(15) NOT NULL,
  `suggestions_id` varchar(15) NOT NULL,
  `curriculum_id` varchar(15) NOT NULL,
  `qs_answer` text NOT NULL,
  `student_nim` varchar(25) NOT NULL,
  `school_year` varchar(15) NOT NULL,
  `semester` varchar(15) NOT NULL,
  `qr_status` enum('general','academic','lecturer','advisor') NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `questionnaire_report_suggestions`
--

INSERT INTO `questionnaire_report_suggestions` (`qr_suggestions_id`, `suggestions_id`, `curriculum_id`, `qs_answer`, `student_nim`, `school_year`, `semester`, `qr_status`, `create_date`) VALUES
('6WEDFqM5fjTJg1', '59ebjM4gm8HI0n', '', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ', '67890', '2020/2021', 'Genap', 'general', '2021-04-16 00:15:34'),
('PGM0imQvp3ZwVB', '59ebjM4gm8HI0n', 'SXOq3b4mo1WdsT', 'testing', '67890', '2020/2021', 'Genap', 'lecturer', '2021-04-19 02:10:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `questionnaire_status`
--

CREATE TABLE `questionnaire_status` (
  `status_id` varchar(15) NOT NULL,
  `questionnaire` enum('general','lecturer','advisor','academic') NOT NULL,
  `questionnaire_status` enum('open','close') NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `questionnaire_status`
--

INSERT INTO `questionnaire_status` (`status_id`, `questionnaire`, `questionnaire_status`, `create_date`) VALUES
('17gQZROlKzkd3i', 'general', 'open', '2021-04-16 00:30:43'),
('gtq0x7h1uAmZpM', 'lecturer', 'open', '2021-04-16 00:30:43'),
('HMKdh3TrPLl62A', 'academic', 'close', '2021-04-16 00:30:43'),
('yt1aHB4zNXkiWf', 'advisor', 'close', '2021-04-16 00:30:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `questionnaire_suggestions`
--

CREATE TABLE `questionnaire_suggestions` (
  `suggestions_id` varchar(15) NOT NULL,
  `qs_description` text NOT NULL,
  `qs_status` enum('general','academic','lecturer','advisor') NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `questionnaire_suggestions`
--

INSERT INTO `questionnaire_suggestions` (`suggestions_id`, `qs_description`, `qs_status`, `create_date`) VALUES
('59ebjM4gm8HI0n', 'Saran dan kritik.', 'lecturer', '2021-04-16 00:03:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `questions`
--

CREATE TABLE `questions` (
  `questions_id` varchar(15) NOT NULL,
  `curriculum_id` varchar(15) NOT NULL,
  `questions_file` text NOT NULL,
  `questions_information` text NOT NULL,
  `questions_type` enum('Quiz','UTS','UAS') NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `questions`
--

INSERT INTO `questions` (`questions_id`, `curriculum_id`, `questions_file`, `questions_information`, `questions_type`, `create_date`) VALUES
('hMXG4B3AYrlDdQ', 'SXOq3b4mo1WdsT', 'image.png', 'INFO', 'Quiz', '2021-04-18 13:39:39'),
('nLuIa5CpQwVTho', 'SXOq3b4mo1WdsT', 'image.png', 'mohon dikumpulkan paling lambat 10 mei 2021', 'Quiz', '2021-04-18 17:14:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `questions_answer`
--

CREATE TABLE `questions_answer` (
  `answer_id` varchar(15) NOT NULL,
  `questions_id` varchar(15) NOT NULL,
  `student_nim` varchar(25) NOT NULL,
  `answer_file` text NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `questions_answer`
--

INSERT INTO `questions_answer` (`answer_id`, `questions_id`, `student_nim`, `answer_file`, `create_date`) VALUES
('8bswNu36RJLnxe', 'hMXG4B3AYrlDdQ', '67890', 'image.png', '2021-04-18 14:31:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `salary_another`
--

CREATE TABLE `salary_another` (
  `another_id` varchar(15) NOT NULL,
  `lecturer_code` varchar(25) NOT NULL,
  `lecturer_salary` int(11) NOT NULL,
  `salary_date` date NOT NULL,
  `salary_type` text NOT NULL,
  `salary_amount` int(11) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `salary_another`
--

INSERT INTO `salary_another` (`another_id`, `lecturer_code`, `lecturer_salary`, `salary_date`, `salary_type`, `salary_amount`, `create_date`) VALUES
('iYbIeUTLNFSa31', 'dosen', 50000, '2021-04-25', 'dummy2', 2, '2021-04-26 17:13:23'),
('PbNTphOj5HvWQ3', 'dosen', 70000, '2021-04-26', 'dummy3', 3, '2021-04-26 17:21:43'),
('ZdFqHPV0nKWwvY', 'dosen', 10000, '2021-04-25', 'dummy', 1, '2021-04-25 13:48:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `salary_teaching`
--

CREATE TABLE `salary_teaching` (
  `teaching_id` varchar(15) NOT NULL,
  `lecturer_code` varchar(25) NOT NULL,
  `lecturer_salary` int(11) NOT NULL,
  `salary_month` varchar(2) NOT NULL,
  `salary_year` varchar(5) NOT NULL,
  `salary_status` enum('Fixed','Not Fixed') NOT NULL,
  `sks_discount` int(11) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `salary_teaching`
--

INSERT INTO `salary_teaching` (`teaching_id`, `lecturer_code`, `lecturer_salary`, `salary_month`, `salary_year`, `salary_status`, `sks_discount`, `create_date`) VALUES
('eR9pJt2PVHCsOZ', 'dosen', 10000, '04', '2021', 'Fixed', 3, '2021-04-25 14:17:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `salary_teaching_blacklist`
--

CREATE TABLE `salary_teaching_blacklist` (
  `blacklist_id` varchar(15) NOT NULL,
  `curriculum_id` varchar(15) NOT NULL,
  `attendance_date` date NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `schedule_package`
--

CREATE TABLE `schedule_package` (
  `schedule_package_id` varchar(15) NOT NULL,
  `curriculum_id` varchar(15) NOT NULL,
  `schedule_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `schedule_package`
--

INSERT INTO `schedule_package` (`schedule_package_id`, `curriculum_id`, `schedule_id`) VALUES
('1ZhCJoAMYKB87f', 'SXOq3b4mo1WdsT', 'j2uzkySFeLTMvg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings_open_krs`
--

CREATE TABLE `settings_open_krs` (
  `open_krs_id` varchar(15) NOT NULL,
  `open_school_year` varchar(15) NOT NULL,
  `open_semester` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `settings_open_krs`
--

INSERT INTO `settings_open_krs` (`open_krs_id`, `open_school_year`, `open_semester`) VALUES
('N9maUdBwSTs41L', '2020/2021', 'Genap');

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings_range_ipk`
--

CREATE TABLE `settings_range_ipk` (
  `range_ipk_id` varchar(15) NOT NULL,
  `range_ipk_min` float NOT NULL,
  `range_ipk_max` float NOT NULL,
  `range_ipk_alphabet` varchar(2) NOT NULL,
  `range_ipk_numbers` varchar(5) NOT NULL,
  `range_ipk_status` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `settings_range_ipk`
--

INSERT INTO `settings_range_ipk` (`range_ipk_id`, `range_ipk_min`, `range_ipk_max`, `range_ipk_alphabet`, `range_ipk_numbers`, `range_ipk_status`) VALUES
('', 85, 100, 'A', '4', 'Sangat Baik'),
('', 80, 84.995, 'A-', '3.75', 'Baik'),
('', 75, 76.995, 'B', '3.00', 'Baik'),
('', 77, 79.995, 'B+', '3.50', 'Baik'),
('', 70, 73.995, 'B-', '2.75', 'Lebih Dari Cukup'),
('', 66, 69.995, 'C+', '2.50', 'Lebih Dari Cukup'),
('', 60, 65.995, 'C', '2.00', 'Cukup'),
('', 45, 49.995, 'E', '0.00', 'Sangat Kurang'),
('', 50, 59.995, 'D', '1', 'Kurang'),
('', 40, 44.995, 'F', '0.00', 'Tidak Ikut Ujian'),
('', 0, 39.995, 'F', '0.00', 'Tidak Ikut Ujian');

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings_range_sks`
--

CREATE TABLE `settings_range_sks` (
  `range_sks_id` varchar(15) NOT NULL,
  `range_sks_min` varchar(5) NOT NULL,
  `range_sks_max` varchar(5) NOT NULL,
  `range_sks` int(11) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `settings_range_sks`
--

INSERT INTO `settings_range_sks` (`range_sks_id`, `range_sks_min`, `range_sks_max`, `range_sks`, `create_date`) VALUES
('row1', '0', '1.495', 12, '2021-03-08 01:11:55'),
('row2', '1.5', '1.995', 15, '2021-03-08 01:11:55'),
('row3', '2', '2.495', 18, '2021-03-08 01:11:55'),
('row4', '2.5', '2.995', 21, '2021-03-08 01:11:55'),
('row5', '3', '4', 24, '2021-03-08 01:11:55'),
('row6', '', '', 24, '2021-03-08 01:11:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `student_open_krs`
--

CREATE TABLE `student_open_krs` (
  `open_krs_id` varchar(15) NOT NULL,
  `student_nim` varchar(25) NOT NULL,
  `student_school_year` varchar(15) NOT NULL,
  `student_semester` varchar(15) NOT NULL,
  `open_start_date` datetime NOT NULL,
  `open_end_date` datetime NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `student_open_krs`
--

INSERT INTO `student_open_krs` (`open_krs_id`, `student_nim`, `student_school_year`, `student_semester`, `open_start_date`, `open_end_date`, `create_date`) VALUES
('A1Nyp6xMHrzQR0', '67890', '2020/2021', 'Genap', '2021-05-27 10:00:00', '2021-05-27 12:00:00', '2021-05-27 09:18:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `student_status`
--

CREATE TABLE `student_status` (
  `student_status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `student_status`
--

INSERT INTO `student_status` (`student_status`) VALUES
('Active'),
('Exit'),
('Graduated'),
('Leave'),
('Non Active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `view_blog`
--

CREATE TABLE `view_blog` (
  `view_id` varchar(15) NOT NULL,
  `blog_id` varchar(15) NOT NULL,
  `account_id` varchar(15) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `view_blog`
--

INSERT INTO `view_blog` (`view_id`, `blog_id`, `account_id`, `create_date`) VALUES
('EZOCYul3SNDdpy', 'eicXvyQS94RjIw', 'HMKdh3TrPLl62A', '2021-06-20 17:12:27'),
('O8kSZ5YljHIUhy', 'IpmWeRJPGL64Bv', 'HMKdh3TrPLl62A', '2021-06-27 17:06:39'),
('t4aTvsSjRq2gZB', 'cUPzebYRvgE93m', '01q87xBcuEUmGb', '2023-01-25 12:10:54'),
('testing', 'testing', 'testing', '2021-05-27 23:32:34'),
('UPORzyEQZKedV6', 'fm7hTWFNzSIbo6', 'HMKdh3TrPLl62A', '2021-05-27 23:38:17');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`);

--
-- Indeks untuk tabel `calendar_color`
--
ALTER TABLE `calendar_color`
  ADD PRIMARY KEY (`calendar_color`);

--
-- Indeks untuk tabel `chat_group`
--
ALTER TABLE `chat_group`
  ADD PRIMARY KEY (`group_id`);

--
-- Indeks untuk tabel `chat_personal`
--
ALTER TABLE `chat_personal`
  ADD PRIMARY KEY (`personal_id`);

--
-- Indeks untuk tabel `drive_academic`
--
ALTER TABLE `drive_academic`
  ADD PRIMARY KEY (`drive_id`);

--
-- Indeks untuk tabel `drive_folder`
--
ALTER TABLE `drive_folder`
  ADD PRIMARY KEY (`folder_id`);

--
-- Indeks untuk tabel `drive_shared`
--
ALTER TABLE `drive_shared`
  ADD PRIMARY KEY (`shared_id`);

--
-- Indeks untuk tabel `drive_type`
--
ALTER TABLE `drive_type`
  ADD PRIMARY KEY (`drive_type`);

--
-- Indeks untuk tabel `elearning`
--
ALTER TABLE `elearning`
  ADD PRIMARY KEY (`elearning_id`);

--
-- Indeks untuk tabel `elearning_type`
--
ALTER TABLE `elearning_type`
  ADD PRIMARY KEY (`elearning_type`);

--
-- Indeks untuk tabel `forum_comment`
--
ALTER TABLE `forum_comment`
  ADD PRIMARY KEY (`forum_comment_id`);

--
-- Indeks untuk tabel `forum_general`
--
ALTER TABLE `forum_general`
  ADD PRIMARY KEY (`forum_id`);

--
-- Indeks untuk tabel `forum_majors`
--
ALTER TABLE `forum_majors`
  ADD PRIMARY KEY (`forum_id`);

--
-- Indeks untuk tabel `mail_academic_accepted`
--
ALTER TABLE `mail_academic_accepted`
  ADD PRIMARY KEY (`mail_id`);

--
-- Indeks untuk tabel `mail_academic_sent`
--
ALTER TABLE `mail_academic_sent`
  ADD PRIMARY KEY (`mail_id`);

--
-- Indeks untuk tabel `mail_account`
--
ALTER TABLE `mail_account`
  ADD PRIMARY KEY (`account_id`);

--
-- Indeks untuk tabel `mail_file`
--
ALTER TABLE `mail_file`
  ADD PRIMARY KEY (`mail_file_id`);

--
-- Indeks untuk tabel `mail_file_type`
--
ALTER TABLE `mail_file_type`
  ADD PRIMARY KEY (`mail_file_type`);

--
-- Indeks untuk tabel `master_alumni`
--
ALTER TABLE `master_alumni`
  ADD PRIMARY KEY (`alumni_id`);

--
-- Indeks untuk tabel `master_alumni_agenda`
--
ALTER TABLE `master_alumni_agenda`
  ADD PRIMARY KEY (`alumni_agenda_id`);

--
-- Indeks untuk tabel `master_alumni_company`
--
ALTER TABLE `master_alumni_company`
  ADD PRIMARY KEY (`alumni_company_id`);

--
-- Indeks untuk tabel `master_alumni_home`
--
ALTER TABLE `master_alumni_home`
  ADD PRIMARY KEY (`alumni_home_id`);

--
-- Indeks untuk tabel `master_alumni_job_vacancies_web`
--
ALTER TABLE `master_alumni_job_vacancies_web`
  ADD PRIMARY KEY (`alumni_job_vacancies_web_id`);

--
-- Indeks untuk tabel `master_alumni_job_vacancy`
--
ALTER TABLE `master_alumni_job_vacancy`
  ADD PRIMARY KEY (`alumni_job_vacancy_id`);

--
-- Indeks untuk tabel `master_alumni_links`
--
ALTER TABLE `master_alumni_links`
  ADD PRIMARY KEY (`alumni_links_id`);

--
-- Indeks untuk tabel `master_attendance`
--
ALTER TABLE `master_attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indeks untuk tabel `master_attendance_list`
--
ALTER TABLE `master_attendance_list`
  ADD PRIMARY KEY (`attendance_list_id`);

--
-- Indeks untuk tabel `master_blog`
--
ALTER TABLE `master_blog`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indeks untuk tabel `master_blog_comment`
--
ALTER TABLE `master_blog_comment`
  ADD PRIMARY KEY (`blog_comment_id`);

--
-- Indeks untuk tabel `master_calendar`
--
ALTER TABLE `master_calendar`
  ADD PRIMARY KEY (`calendar_id`);

--
-- Indeks untuk tabel `master_class`
--
ALTER TABLE `master_class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indeks untuk tabel `master_college`
--
ALTER TABLE `master_college`
  ADD PRIMARY KEY (`college_id`);

--
-- Indeks untuk tabel `master_cooperation`
--
ALTER TABLE `master_cooperation`
  ADD PRIMARY KEY (`cooperation_id`);

--
-- Indeks untuk tabel `master_courses`
--
ALTER TABLE `master_courses`
  ADD PRIMARY KEY (`courses_id`);

--
-- Indeks untuk tabel `master_curriculum`
--
ALTER TABLE `master_curriculum`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_curriculum_types`
--
ALTER TABLE `master_curriculum_types`
  ADD PRIMARY KEY (`curriculum_types_id`);

--
-- Indeks untuk tabel `master_curriculum_uas`
--
ALTER TABLE `master_curriculum_uas`
  ADD PRIMARY KEY (`curriculum_id`);

--
-- Indeks untuk tabel `master_curriculum_uts`
--
ALTER TABLE `master_curriculum_uts`
  ADD PRIMARY KEY (`curriculum_id`);

--
-- Indeks untuk tabel `master_generation`
--
ALTER TABLE `master_generation`
  ADD PRIMARY KEY (`generation_id`);

--
-- Indeks untuk tabel `master_ijasah`
--
ALTER TABLE `master_ijasah`
  ADD PRIMARY KEY (`ijasah_id`);

--
-- Indeks untuk tabel `master_krs`
--
ALTER TABLE `master_krs`
  ADD PRIMARY KEY (`krs_id`);

--
-- Indeks untuk tabel `master_krs_package`
--
ALTER TABLE `master_krs_package`
  ADD PRIMARY KEY (`krs_package_id`);

--
-- Indeks untuk tabel `master_logbook`
--
ALTER TABLE `master_logbook`
  ADD PRIMARY KEY (`logbook_id`);

--
-- Indeks untuk tabel `master_majors`
--
ALTER TABLE `master_majors`
  ADD PRIMARY KEY (`majors_id`);

--
-- Indeks untuk tabel `master_profile`
--
ALTER TABLE `master_profile`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indeks untuk tabel `master_schedule`
--
ALTER TABLE `master_schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indeks untuk tabel `master_school_year`
--
ALTER TABLE `master_school_year`
  ADD PRIMARY KEY (`school_year_id`);

--
-- Indeks untuk tabel `master_score`
--
ALTER TABLE `master_score`
  ADD PRIMARY KEY (`score_id`);

--
-- Indeks untuk tabel `master_score_file`
--
ALTER TABLE `master_score_file`
  ADD PRIMARY KEY (`score_file_id`);

--
-- Indeks untuk tabel `master_score_weight`
--
ALTER TABLE `master_score_weight`
  ADD PRIMARY KEY (`curriculum_id`);

--
-- Indeks untuk tabel `master_semester`
--
ALTER TABLE `master_semester`
  ADD PRIMARY KEY (`semester_id`);

--
-- Indeks untuk tabel `master_skripsi`
--
ALTER TABLE `master_skripsi`
  ADD PRIMARY KEY (`skripsi_id`);

--
-- Indeks untuk tabel `master_skripsi_file`
--
ALTER TABLE `master_skripsi_file`
  ADD PRIMARY KEY (`skripsi_file_id`);

--
-- Indeks untuk tabel `master_student`
--
ALTER TABLE `master_student`
  ADD PRIMARY KEY (`account_id`);

--
-- Indeks untuk tabel `master_student_access`
--
ALTER TABLE `master_student_access`
  ADD PRIMARY KEY (`student_access_id`);

--
-- Indeks untuk tabel `master_student_father`
--
ALTER TABLE `master_student_father`
  ADD PRIMARY KEY (`student_nim`);

--
-- Indeks untuk tabel `master_student_guardian`
--
ALTER TABLE `master_student_guardian`
  ADD PRIMARY KEY (`student_nim`);

--
-- Indeks untuk tabel `master_student_history`
--
ALTER TABLE `master_student_history`
  ADD PRIMARY KEY (`student_history_id`);

--
-- Indeks untuk tabel `master_student_mother`
--
ALTER TABLE `master_student_mother`
  ADD PRIMARY KEY (`student_nim`);

--
-- Indeks untuk tabel `master_student_school`
--
ALTER TABLE `master_student_school`
  ADD PRIMARY KEY (`student_nim`);

--
-- Indeks untuk tabel `master_student_skpi`
--
ALTER TABLE `master_student_skpi`
  ADD PRIMARY KEY (`student_skpi_id`);

--
-- Indeks untuk tabel `master_student_skpi_file`
--
ALTER TABLE `master_student_skpi_file`
  ADD PRIMARY KEY (`student_skpi_file_id`);

--
-- Indeks untuk tabel `master_student_skpi_weight`
--
ALTER TABLE `master_student_skpi_weight`
  ADD PRIMARY KEY (`student_skpi_weight_id`);

--
-- Indeks untuk tabel `master_support`
--
ALTER TABLE `master_support`
  ADD PRIMARY KEY (`support_id`);

--
-- Indeks untuk tabel `master_user`
--
ALTER TABLE `master_user`
  ADD PRIMARY KEY (`account_id`);

--
-- Indeks untuk tabel `podcast`
--
ALTER TABLE `podcast`
  ADD PRIMARY KEY (`podcast_id`);

--
-- Indeks untuk tabel `polling_answer`
--
ALTER TABLE `polling_answer`
  ADD PRIMARY KEY (`polling_answer_id`);

--
-- Indeks untuk tabel `polling_choice`
--
ALTER TABLE `polling_choice`
  ADD PRIMARY KEY (`polling_choice_id`);

--
-- Indeks untuk tabel `polling_general`
--
ALTER TABLE `polling_general`
  ADD PRIMARY KEY (`polling_id`);

--
-- Indeks untuk tabel `polling_majors`
--
ALTER TABLE `polling_majors`
  ADD PRIMARY KEY (`polling_id`);

--
-- Indeks untuk tabel `questionnaire_academic`
--
ALTER TABLE `questionnaire_academic`
  ADD PRIMARY KEY (`q_academic_id`);

--
-- Indeks untuk tabel `questionnaire_advisor`
--
ALTER TABLE `questionnaire_advisor`
  ADD PRIMARY KEY (`q_advisor_id`);

--
-- Indeks untuk tabel `questionnaire_category`
--
ALTER TABLE `questionnaire_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeks untuk tabel `questionnaire_general`
--
ALTER TABLE `questionnaire_general`
  ADD PRIMARY KEY (`q_general_id`);

--
-- Indeks untuk tabel `questionnaire_lecturer`
--
ALTER TABLE `questionnaire_lecturer`
  ADD PRIMARY KEY (`q_lecturer_id`);

--
-- Indeks untuk tabel `questionnaire_report_academic`
--
ALTER TABLE `questionnaire_report_academic`
  ADD PRIMARY KEY (`qr_academic_id`);

--
-- Indeks untuk tabel `questionnaire_report_advisor`
--
ALTER TABLE `questionnaire_report_advisor`
  ADD PRIMARY KEY (`qr_advisor_id`);

--
-- Indeks untuk tabel `questionnaire_report_general`
--
ALTER TABLE `questionnaire_report_general`
  ADD PRIMARY KEY (`qr_general_id`);

--
-- Indeks untuk tabel `questionnaire_report_lecturer`
--
ALTER TABLE `questionnaire_report_lecturer`
  ADD PRIMARY KEY (`qr_lecturer_id`);

--
-- Indeks untuk tabel `questionnaire_report_suggestions`
--
ALTER TABLE `questionnaire_report_suggestions`
  ADD PRIMARY KEY (`qr_suggestions_id`);

--
-- Indeks untuk tabel `questionnaire_status`
--
ALTER TABLE `questionnaire_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indeks untuk tabel `questionnaire_suggestions`
--
ALTER TABLE `questionnaire_suggestions`
  ADD PRIMARY KEY (`suggestions_id`);

--
-- Indeks untuk tabel `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`questions_id`);

--
-- Indeks untuk tabel `questions_answer`
--
ALTER TABLE `questions_answer`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indeks untuk tabel `salary_another`
--
ALTER TABLE `salary_another`
  ADD PRIMARY KEY (`another_id`);

--
-- Indeks untuk tabel `salary_teaching`
--
ALTER TABLE `salary_teaching`
  ADD PRIMARY KEY (`teaching_id`);

--
-- Indeks untuk tabel `salary_teaching_blacklist`
--
ALTER TABLE `salary_teaching_blacklist`
  ADD PRIMARY KEY (`blacklist_id`);

--
-- Indeks untuk tabel `schedule_package`
--
ALTER TABLE `schedule_package`
  ADD PRIMARY KEY (`schedule_package_id`);

--
-- Indeks untuk tabel `settings_open_krs`
--
ALTER TABLE `settings_open_krs`
  ADD PRIMARY KEY (`open_krs_id`);

--
-- Indeks untuk tabel `settings_range_sks`
--
ALTER TABLE `settings_range_sks`
  ADD PRIMARY KEY (`range_sks_id`);

--
-- Indeks untuk tabel `student_open_krs`
--
ALTER TABLE `student_open_krs`
  ADD PRIMARY KEY (`open_krs_id`);

--
-- Indeks untuk tabel `student_status`
--
ALTER TABLE `student_status`
  ADD PRIMARY KEY (`student_status`);

--
-- Indeks untuk tabel `view_blog`
--
ALTER TABLE `view_blog`
  ADD PRIMARY KEY (`view_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `master_curriculum`
--
ALTER TABLE `master_curriculum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
