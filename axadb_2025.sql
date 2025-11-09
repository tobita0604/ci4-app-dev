-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2025-11-09 15:02:16
-- サーバのバージョン： 10.4.24-MariaDB-log
-- PHP のバージョン: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `axadb_2025`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `c00_charger`
--

CREATE TABLE `c00_charger` (
  `Charger_Id` varchar(50) NOT NULL COMMENT '0:営業担当者 1:オーガナーザ  9:管理者(KNT)',
  `Charger_Password` varchar(50) DEFAULT NULL,
  `Charger_Name` varchar(100) DEFAULT NULL,
  `Charger_Type` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `m01_option`
--

CREATE TABLE `m01_option` (
  `M01_Type` int(11) NOT NULL,
  `M01_Id` varchar(5) NOT NULL COMMENT 'ID',
  `M01_Id_Name` varchar(5) DEFAULT NULL COMMENT 'ID名称',
  `M01_Name` varchar(50) NOT NULL COMMENT 'ツアー名',
  `M01_Price1` int(11) NOT NULL COMMENT '大人単価',
  `M01_Price2` int(11) NOT NULL COMMENT '子供単価',
  `M01_Time` varchar(50) NOT NULL COMMENT '営業時間',
  `M01_Day1_On` int(11) NOT NULL DEFAULT 0 COMMENT '0:不可 1:受付可',
  `M01_Day1_Time` varchar(200) NOT NULL COMMENT '催行時間をカンマ形式',
  `M01_Day2_On` int(11) NOT NULL DEFAULT 0 COMMENT '0:不可 1:受付可',
  `M01_Day2_Time` varchar(200) NOT NULL COMMENT '催行時間をカンマ形式',
  `M01_Day3_On` int(11) DEFAULT 0,
  `M01_Day3_Time` varchar(200) DEFAULT NULL,
  `M01_Golf` int(11) NOT NULL DEFAULT 0 COMMENT '0:その他 1:ゴルフ',
  `M01_Sort_Order` int(2) NOT NULL COMMENT '表示順'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `m01_option_available`
--

CREATE TABLE `m01_option_available` (
  `M01_Type` int(11) NOT NULL,
  `M01_Day` int(11) NOT NULL,
  `M01_Period` int(11) NOT NULL,
  `M01_Id` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `m01_option_time`
--

CREATE TABLE `m01_option_time` (
  `M01_Stock_Id` int(3) NOT NULL COMMENT '在庫ID',
  `M01_Id` varchar(5) NOT NULL COMMENT 'ID',
  `M01_Time_Id` int(2) NOT NULL COMMENT '時間ID',
  `M01_Stock` int(3) NOT NULL COMMENT '在庫',
  `M01_Reserve` int(3) NOT NULL COMMENT '予約',
  `M01_Balance` int(3) NOT NULL COMMENT '残数',
  `M01_Date_Flg` int(1) NOT NULL COMMENT '1: 23日 2:24日',
  `M01_Time_Text` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `r01_car_rental`
--

CREATE TABLE `r01_car_rental` (
  `R01_User_Id` varchar(20) NOT NULL COMMENT 'ユーザーID',
  `R01_Name_Kanji` varchar(50) NOT NULL COMMENT '名前（漢字）',
  `R01_Name_Kana` varchar(50) NOT NULL COMMENT '名前（カナ）',
  `R01_Driver_License_No` varchar(20) NOT NULL COMMENT '運転免許証番号',
  `R01_Driver_License_Expiry` date NOT NULL COMMENT '運転免許証有効期限',
  `R01_Class` varchar(2) NOT NULL COMMENT 'レンタカークラス',
  `R01_FromDriveDate` date NOT NULL COMMENT '貸出日',
  `R01_FromDriveTime` varchar(5) NOT NULL COMMENT '貸出時間',
  `R01_ToDriveDate` date NOT NULL COMMENT '返却日',
  `R01_ToDriveTime` varchar(5) NOT NULL COMMENT '返却時間',
  `R01_Car_Insurance` varchar(6) NOT NULL COMMENT '自動車保険',
  `R01_Child_Seat` int(1) NOT NULL COMMENT 'チャイルドシート',
  `R01_Regist_Flg` int(1) NOT NULL DEFAULT 0 COMMENT '登録済みフラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `r01_member`
--

CREATE TABLE `r01_member` (
  `R01_Id` varchar(15) NOT NULL,
  `R01_seq` int(11) NOT NULL,
  `R01_Name` varchar(10) NOT NULL,
  `R01_Name_Last` varchar(10) NOT NULL,
  `R01_Name_First` varchar(10) NOT NULL,
  `R01_Roma_Last` varchar(10) NOT NULL,
  `R01_Roma_First` varchar(10) NOT NULL,
  `R01_Birthdate` date NOT NULL,
  `R01_Age` int(11) DEFAULT NULL,
  `R01_Gender` int(11) DEFAULT NULL,
  `R01_Relationship` int(11) DEFAULT NULL COMMENT '続柄',
  `R01_Mobile_No` varchar(20) NOT NULL,
  `R01_Email` varchar(100) NOT NULL,
  `R01_Passport_Flg` int(11) DEFAULT NULL,
  `R01_Passport_No` varchar(20) NOT NULL,
  `R01_Passport_Issue_Date` date NOT NULL,
  `R01_Passport_Valid_Date` date NOT NULL,
  `R01_Passport_Img` varchar(50) NOT NULL,
  `R01_Passport_Date` date NOT NULL,
  `R01_ESTA_Flg` int(11) NOT NULL,
  `R01_Nationality` varchar(50) NOT NULL,
  `R01_Postal1` varchar(5) NOT NULL,
  `R01_Postal2` varchar(5) NOT NULL,
  `R01_Prefecture` varchar(10) NOT NULL,
  `R01_Address` varchar(100) NOT NULL,
  `R01_Address2` varchar(100) NOT NULL COMMENT '町村名番地番号',
  `R01_Address3` varchar(100) DEFAULT NULL COMMENT '建物名・部屋番号等',
  `R01_Tel_No` varchar(50) NOT NULL,
  `R01_Emer_Name` varchar(100) NOT NULL,
  `R01_Emer_Relationship` varchar(100) NOT NULL,
  `R01_Emer_Tel_No` varchar(50) NOT NULL,
  `R01_Baby_Meal` int(11) NOT NULL,
  `R01_Baby_Bassinet` int(11) NOT NULL,
  `R01_Baby_Height` int(11) NOT NULL,
  `R01_Baby_Weight` int(11) NOT NULL,
  `R01_Baby_Chair` int(11) NOT NULL,
  `R01_Baby_Bed` int(11) NOT NULL,
  `R01_Baby_Bed2` int(11) NOT NULL,
  `R01_Baby_Car` int(11) NOT NULL,
  `R01_Infant_Bed` int(11) NOT NULL,
  `R01_Infant_Party` int(11) NOT NULL,
  `R01_Infant_Meal` int(11) NOT NULL,
  `R01_Infant_Chair` int(11) NOT NULL,
  `R01_Infant_Bassinet` int(11) NOT NULL,
  `R01_Entry_Flg` int(11) NOT NULL,
  `R01_Cancel_Flg` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `r01_note`
--

CREATE TABLE `r01_note` (
  `R01_Id` varchar(15) NOT NULL,
  `R01_note` varchar(2500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `r01_reserver`
--

CREATE TABLE `r01_reserver` (
  `R01_Id` varchar(15) NOT NULL,
  `R01_Password` varchar(20) NOT NULL,
  `R01_Code` varchar(10) NOT NULL,
  `R01_Category_Flg` varchar(10) NOT NULL,
  `R01_1Q_Flg` int(11) NOT NULL COMMENT '１Q家族招待CP 結果',
  `R01_4Q_Flg` varchar(1) DEFAULT NULL COMMENT '4Q家族招待CP 状況',
  `R01_Park_Flg` int(11) NOT NULL,
  `R01_Free_Invites` int(11) NOT NULL,
  `R01_Charge_Invites` int(11) NOT NULL,
  `R01_Branch_Cd` varchar(10) NOT NULL COMMENT '支社ｺｰﾄﾞ',
  `R01_Branch_Name` varchar(100) NOT NULL,
  `R01_Branch_Sort` int(11) NOT NULL COMMENT 'ｿｰﾄ番号',
  `R01_Brochure_Img` varchar(50) DEFAULT NULL,
  `R01_Note` varchar(200) DEFAULT NULL COMMENT '備考',
  `R01_Login_Flg` int(11) NOT NULL,
  `R01_First_Login_Date` datetime DEFAULT NULL,
  `R01_Last_Login_Date` datetime DEFAULT NULL,
  `R01_Update_Date` datetime DEFAULT NULL,
  `R01_Update_User` varchar(15) DEFAULT NULL,
  `R01_Invoice_Flg` int(11) NOT NULL,
  `R01_DinnerHotel_Flg` int(1) DEFAULT NULL,
  `R01_Car_Rental` int(1) DEFAULT 0,
  `R01_4q` int(11) DEFAULT NULL COMMENT '4q利用 0:OP 1:自費補助',
  `go_flight` varchar(50) DEFAULT NULL,
  `go_ticket` varchar(50) DEFAULT NULL,
  `R01_allcancel` int(11) NOT NULL DEFAULT 0,
  `R01_Test_Flg` int(11) NOT NULL COMMENT '0:通常 1:テスト用 9:nssテスト用',
  `R01_reentry` int(11) NOT NULL DEFAULT 0 COMMENT '0:通常 1:締め切り後入力可能',
  `seqno` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `r01_reserver_backup`
--

CREATE TABLE `r01_reserver_backup` (
  `R01_Backup_Id` int(11) NOT NULL,
  `R01_Backup_Date` datetime NOT NULL,
  `R01_Backup_User` varchar(15) NOT NULL,
  `R01_Id` varchar(15) NOT NULL,
  `R01_Password` varchar(20) NOT NULL,
  `R01_Code` varchar(10) NOT NULL,
  `R01_Category_Flg` int(11) NOT NULL,
  `R01_1Q_Flg` int(11) NOT NULL COMMENT '１Q家族招待CP 結果',
  `R01_4Q_Flg` varchar(1) DEFAULT NULL COMMENT '4Q家族招待CP 状況',
  `R01_Park_Flg` int(11) NOT NULL,
  `R01_Free_Invites` int(11) NOT NULL,
  `R01_Charge_Invites` int(11) NOT NULL,
  `R01_Branch_Cd` varchar(10) NOT NULL COMMENT '支社ｺｰﾄﾞ',
  `R01_Branch_Name` varchar(100) NOT NULL,
  `R01_Note` varchar(200) DEFAULT NULL COMMENT '備考',
  `R01_Login_Flg` int(11) NOT NULL,
  `R01_First_Login_Date` datetime NOT NULL,
  `R01_Last_Login_Date` datetime NOT NULL,
  `R01_Update_Date` datetime DEFAULT NULL,
  `R01_Update_User` varchar(15) DEFAULT NULL,
  `R01_Invoice_Flg` int(11) NOT NULL,
  `R01_DinnerHotel_Flg` int(1) DEFAULT NULL,
  `R01_Car_Rental` int(1) DEFAULT 0,
  `R01_4q` int(11) DEFAULT NULL,
  `go_flight` varchar(50) DEFAULT NULL,
  `go_ticket` varchar(50) DEFAULT NULL,
  `R01_allcancel` int(11) NOT NULL DEFAULT 0,
  `R01_Branch_Sort` int(11) NOT NULL COMMENT 'ｿｰﾄ番号',
  `R01_Brochure_Img` varchar(50) DEFAULT NULL,
  `R01_Test_Flg` int(11) NOT NULL,
  `R01_reentry` int(11) NOT NULL DEFAULT 0,
  `seqno` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `r01_reserver_testdata`
--

CREATE TABLE `r01_reserver_testdata` (
  `R01_Id` varchar(15) NOT NULL,
  `R01_Password` varchar(20) NOT NULL,
  `R01_Code` varchar(10) NOT NULL,
  `R01_Category_Flg` varchar(10) NOT NULL,
  `R01_1Q_Flg` int(11) NOT NULL COMMENT '１Q家族招待CP 結果',
  `R01_4Q_Flg` varchar(1) DEFAULT NULL COMMENT '4Q家族招待CP 状況',
  `R01_Park_Flg` int(11) NOT NULL,
  `R01_Free_Invites` int(11) NOT NULL,
  `R01_Charge_Invites` int(11) NOT NULL,
  `R01_Branch_Cd` varchar(10) NOT NULL COMMENT '支社ｺｰﾄﾞ',
  `R01_Branch_Name` varchar(100) NOT NULL,
  `R01_Branch_Sort` int(11) NOT NULL COMMENT 'ｿｰﾄ番号',
  `R01_Brochure_Img` varchar(50) NOT NULL,
  `R01_Note` varchar(200) NOT NULL COMMENT '備考',
  `R01_Login_Flg` int(11) NOT NULL,
  `R01_First_Login_Date` datetime NOT NULL,
  `R01_Last_Login_Date` datetime NOT NULL,
  `R01_Update_Date` datetime NOT NULL,
  `R01_Update_User` varchar(15) NOT NULL,
  `R01_Invoice_Flg` int(11) NOT NULL,
  `R01_Car_Rental` int(1) DEFAULT 0,
  `R01_4q` int(11) DEFAULT NULL COMMENT '4q利用 0:OP 1:自費補助',
  `go_flight` varchar(50) DEFAULT NULL,
  `go_ticket` varchar(50) DEFAULT NULL,
  `R01_allcancel` int(11) NOT NULL DEFAULT 0,
  `R01_Test_Flg` int(11) NOT NULL COMMENT '0:通常 1:テスト用 9:nssテスト用',
  `R01_reentry` int(11) NOT NULL DEFAULT 0 COMMENT '0:通常 1:締め切り後入力可能',
  `seqno` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `r02_car_rental_stock`
--

CREATE TABLE `r02_car_rental_stock` (
  `R02_Class` varchar(2) NOT NULL COMMENT 'クラス',
  `R02_Rental_Day` int(2) NOT NULL COMMENT 'レンタル日',
  `R02_Stock` int(3) NOT NULL DEFAULT 0 COMMENT '在庫',
  `R02_Reserve` int(3) NOT NULL DEFAULT 0 COMMENT '予約',
  `R02_Balance` int(3) NOT NULL DEFAULT 0 COMMENT '残数',
  `R02_Sort_Order` int(1) NOT NULL DEFAULT 0 COMMENT '昇降順'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `r02_option`
--

CREATE TABLE `r02_option` (
  `R02_Id` varchar(15) NOT NULL,
  `R02_seq` int(11) NOT NULL,
  `R02_Park_Flg` int(11) NOT NULL,
  `R02_Farm_Flg` int(11) NOT NULL,
  `R02_Farm_Tour` varchar(10) NOT NULL,
  `R02_Farm_Time` int(11) NOT NULL,
  `R02_Farm_Flg2` int(11) NOT NULL,
  `R02_Farm_Tour2` varchar(10) NOT NULL,
  `R02_Farm_Time2` int(11) NOT NULL,
  `R02_Golf_Flg` int(11) NOT NULL,
  `R02_Golf_Club` int(11) NOT NULL,
  `R02_Golf_Shoes` decimal(10,1) NOT NULL,
  `R02_Golf_Biko` text DEFAULT NULL COMMENT 'ゴルフ備考',
  `R02_Option1` varchar(20) NOT NULL COMMENT '1日目午前',
  `R02_Option2` varchar(20) NOT NULL COMMENT '1日目午後',
  `R02_Option3` varchar(20) NOT NULL COMMENT '2日目午前',
  `R02_Option4` varchar(20) NOT NULL COMMENT '2日目午後',
  `R02_Option5` varchar(20) NOT NULL COMMENT '3日目午前',
  `R02_Option1_Time` varchar(10) DEFAULT NULL COMMENT 'オプション１の時間',
  `R02_Option2_Time` varchar(10) DEFAULT NULL COMMENT 'オプション２の時間',
  `R02_Price` int(11) NOT NULL COMMENT '代金',
  `R02_Option_Type` int(1) NOT NULL DEFAULT 0 COMMENT '0:未選択　1:無料招待　2:自費参加',
  `R02_bus_dep` int(11) NOT NULL DEFAULT 0 COMMENT '0:未設定 1:シャトルバス 2:レンタカー',
  `R02_bus_arr` int(11) NOT NULL DEFAULT 0 COMMENT '0:未設定 1:シャトルバス 2:レンタカー'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `r03_admin_ip`
--

CREATE TABLE `r03_admin_ip` (
  `id` int(11) NOT NULL,
  `address_name` varchar(50) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `display_flg` int(1) NOT NULL DEFAULT 0 COMMENT '0：表示　1：非表示',
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `c00_charger`
--
ALTER TABLE `c00_charger`
  ADD PRIMARY KEY (`Charger_Id`);

--
-- テーブルのインデックス `m01_option`
--
ALTER TABLE `m01_option`
  ADD PRIMARY KEY (`M01_Type`,`M01_Id`);

--
-- テーブルのインデックス `m01_option_available`
--
ALTER TABLE `m01_option_available`
  ADD PRIMARY KEY (`M01_Type`,`M01_Day`,`M01_Period`,`M01_Id`);

--
-- テーブルのインデックス `m01_option_time`
--
ALTER TABLE `m01_option_time`
  ADD PRIMARY KEY (`M01_Stock_Id`);

--
-- テーブルのインデックス `r01_car_rental`
--
ALTER TABLE `r01_car_rental`
  ADD PRIMARY KEY (`R01_User_Id`);

--
-- テーブルのインデックス `r01_member`
--
ALTER TABLE `r01_member`
  ADD PRIMARY KEY (`R01_Id`,`R01_seq`);

--
-- テーブルのインデックス `r01_note`
--
ALTER TABLE `r01_note`
  ADD PRIMARY KEY (`R01_Id`);

--
-- テーブルのインデックス `r01_reserver`
--
ALTER TABLE `r01_reserver`
  ADD PRIMARY KEY (`R01_Id`);

--
-- テーブルのインデックス `r01_reserver_backup`
--
ALTER TABLE `r01_reserver_backup`
  ADD PRIMARY KEY (`R01_Backup_Id`);

--
-- テーブルのインデックス `r01_reserver_testdata`
--
ALTER TABLE `r01_reserver_testdata`
  ADD PRIMARY KEY (`R01_Id`);

--
-- テーブルのインデックス `r02_car_rental_stock`
--
ALTER TABLE `r02_car_rental_stock`
  ADD PRIMARY KEY (`R02_Class`,`R02_Rental_Day`);

--
-- テーブルのインデックス `r02_option`
--
ALTER TABLE `r02_option`
  ADD PRIMARY KEY (`R02_Id`,`R02_seq`);

--
-- テーブルのインデックス `r03_admin_ip`
--
ALTER TABLE `r03_admin_ip`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `r01_reserver_backup`
--
ALTER TABLE `r01_reserver_backup`
  MODIFY `R01_Backup_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `r03_admin_ip`
--
ALTER TABLE `r03_admin_ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
