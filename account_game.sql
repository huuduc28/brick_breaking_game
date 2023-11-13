-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th10 29, 2017 lúc 11:07 AM
-- Phiên bản máy phục vụ: 5.6.35
-- Phiên bản PHP: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Cơ sở dữ liệu: `account_game`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
--
CREATE TABLE `account` (
  `username` varchar (50)COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar (50) NOT NULL,
  `displayname` varchar (50)COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `account` (`username`, `password`,`displayname`) VALUES
('duc', '123456','Hữu Đức');
INSERT INTO `account` (`username`, `password`,`displayname`) VALUES
('Minh', '123456','Thiên Minh');

-- ---