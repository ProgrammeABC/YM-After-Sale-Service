-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2023-05-31 11:48:01
-- 服务器版本： 5.7.40-log
-- PHP 版本： 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `asdata`
--

-- --------------------------------------------------------

--
-- 表的结构 `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `eid` varchar(10) NOT NULL COMMENT 'employee ID',
  `name` varchar(20) DEFAULT NULL COMMENT '姓名',
  `tel` varchar(20) DEFAULT NULL COMMENT '电话',
  `qq` varchar(20) DEFAULT NULL COMMENT 'QQ',
  `password` varchar(255) DEFAULT NULL COMMENT '密码sha256',
  `role` int(11) DEFAULT '1' COMMENT '用户角色 0-管理员(admin) 1-客服(css) 2-工程师(tse) '
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `employee`
--

INSERT INTO `employee` (`id`, `eid`, `name`, `tel`, `qq`, `password`, `role`) VALUES
(3, 'root', 'BOSS', '18999999999', '10000', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 0),
(16, 'testkf01', '李可', '19999899982', '66110', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 1),
(17, 'testgcs01', '王素', '18936555655', '777110', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 2);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL COMMENT 'id',
  `createTime` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `orderNum` varchar(15) NOT NULL COMMENT '编号',
  `queryPwd` varchar(255) NOT NULL COMMENT '查询密码sha256',
  `orderStatus` int(11) DEFAULT '0' COMMENT '状态(0-已下单)',
  `urgent` int(11) DEFAULT '0' COMMENT '加急(0-no,1-yes)',
  `changeTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '状态修改时间',
  `CSSid` varchar(10) DEFAULT 'testkf01' COMMENT '客服id',
  `TSEid` varchar(10) DEFAULT 'testgcs01' COMMENT '工程师id TSE(TechnicalSupportEngineer)',
  `imei` varchar(255) DEFAULT NULL COMMENT '手机IMEI'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `createTime`, `orderNum`, `queryPwd`, `orderStatus`, `urgent`, `changeTime`, `CSSid`, `TSEid`, `imei`) VALUES
(86, '2023-04-20 14:42:41', '66110', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 0, 0, '2023-04-20 14:42:41', 'testkf01', 'testgcs01', '2005122100201979'),
(87, '2023-04-20 14:43:02', '10000', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 0, 1, '2023-04-21 01:47:40', 'testkf01', 'testgcs01', '2005122100201979'),
(88, '2023-03-07 06:39:05', '9566879591', 'B16JZVty5eOEx148nsAEEViRSUtZ1oxJH0KduM32h6CxS91F4RQXQ0F4Yzdpifmd', 2, 0, '2023-04-11 19:55:45', 'testkf01', 'testgcs01', '2005122102667318'),
(89, '2023-02-16 17:21:58', '0543880688', 'Du3hYQC4ZnoAh65W1ILW0Aqw4r6y1Lz4QP7qy7HlEe45jiVsHSekIWneXN65GQUd', 0, 1, '2023-03-20 13:14:32', 'testkf01', 'testgcs01', '2005122100180255'),
(90, '2023-04-17 00:09:08', '7073720281', 'GJYiq9fJO8s46w5p0Q6D02yqfd4eOyP8laRQ3rVBkK2DCf5kqY7HI9NPHuWOzael', 2, 0, '2023-03-24 17:13:31', 'testkf01', 'testgcs01', '2005122101057169'),
(91, '2023-01-28 11:45:07', '9838628517', 'HLQFgj9zCIxckWdp6pc6SyVpX2hJhJQyFVPgiRpxQAF9zhUhIRDZkJ1EHcQcJx8H', 1, 0, '2023-04-08 09:30:34', 'testkf01', 'testgcs01', '2005122101239533'),
(92, '2023-02-27 18:57:28', '0871721384', 'Mm3evftI1Hn04HNIh58kF3cabBOV59FQpNf8suAu37KVLOCbM1EhjuykEknvlixw', 6, 1, '2023-04-07 16:33:46', 'testkf01', 'testgcs01', '2005122103008021'),
(93, '2023-04-18 11:01:43', '7676895311', 'XGbWdMCm7Xsu6qONzLeBuEUZX9XwE6eViH2W06DW5WNz9NqZwdCENv5ih71vpSwD', 1, 1, '2023-03-20 02:51:42', 'testkf01', 'testgcs01', '2005122103602744'),
(94, '2023-02-17 12:46:06', '5222866465', 'TMcHpVex7hLCGzU8nuzLkyBUMmER8HJD9crFXU862bNUZkoLtjZijBPRHEkj0gPO', 5, 0, '2023-04-17 08:12:28', 'testkf01', 'testgcs01', '2005122105152165'),
(95, '2023-02-26 18:17:00', '9531517582', 'OX65HyJRDvsyDIBsBXWzO25q9tcrjQ0zoOcpECXCOOrACpMcmYP1lBL439dmKYrl', 2, 1, '2023-03-27 20:36:54', 'testkf01', 'testgcs01', '2005122100788515'),
(96, '2023-01-18 10:14:17', '5264490953', 'KlbpHQ7BebrrsHLpjv8McpWnhh1BjIoWsE2iM0DEiZIhQCKhFCH94sWfU1PfiSTo', 4, 0, '2023-03-22 08:49:01', 'testkf01', 'testgcs01', '2005122101925309'),
(97, '2023-03-27 00:46:50', '9125903927', '88v6MHoUpbKnDkASZ9OsZgGLr5xqztq8pwzsTf2YOqwZhaiVuYYgEg92WcaJqKSa', 6, 1, '2023-03-18 19:47:19', 'testkf01', 'testgcs01', '2005122102702052'),
(98, '2023-03-31 05:17:01', '7903560317', 'ulqsKzrch0yvHx1qaGSYD6itKRcJJkHwL7sZwFlfjXNTJlHqoe3HhAgyxDki8DJp', 2, 0, '2023-03-19 11:17:58', 'testkf01', 'testgcs01', '2005122100590268'),
(99, '2023-04-03 10:56:06', '7744287804', 'YtFYjwTSxLKCn77jVdk8THZhbuJwZcAlfaMQhQ7lQpGjbMYazvCiVUKnptInnml7', 1, 1, '2023-04-02 11:13:54', 'testkf01', 'testgcs01', '2005122100590268'),
(100, '2023-04-13 23:22:37', '7990049743', '2z8Z4TJTmGoOmBvD4FkzxoYyFTo4VyknXL2MujDs1t3MkKetlBHVFIkaSKVEuHJI', 3, 0, '2023-04-12 11:42:59', 'testkf01', 'testgcs01', '2005122102678872'),
(101, '2023-03-19 10:09:05', '3605153169', '1Vz5P4N7nKdaoha9MT9kCJSMBpBMHOr80rSLzuZiKpwv4Xm8Cgql1iLG3hgyLGpZ', 0, 0, '2023-03-28 18:54:15', 'testkf01', 'testgcs01', '2005122102629861'),
(102, '2023-02-04 16:12:24', '5651834810', '6qT1iX9k9DECfMde7EmJEvDN6nVGpjkfvYd7zKj8UvuSMc42LbCV2cEy2fOiXrn0', 0, 0, '2023-03-25 00:10:17', 'testkf01', 'testgcs01', '2005122102319771'),
(103, '2023-02-25 20:26:39', '7285711440', 'jKLPDiO2FLXRPaTq3KmcF2ItEsW3FK8yl3S4b1JNWPekFeu1Z1pS6tyIeQhUxlXv', 2, 0, '2023-04-16 09:13:40', 'testkf01', 'testgcs01', '2005122105691136'),
(104, '2023-04-13 05:23:43', '5017561220', 'PQxVU2HvjkurahzpGvqdPVlrBVbpMaz2vphByP3EYc6gUQrR32RROniY8zNpVxiN', 5, 1, '2023-04-17 18:06:13', 'testkf01', 'testgcs01', '2005122101758484'),
(105, '2023-01-25 15:45:49', '8719256745', 'Vfh5xmifyoXLJxnEx6OE3yo2ogBgMxs9XvqB4c7ZHtMte9l4GAeEVFLep6E5oLyh', 3, 0, '2023-04-15 19:47:10', 'testkf01', 'testgcs01', '2005122107506385'),
(106, '2023-04-07 19:29:41', '7390849283', '0EiK89LaM2Td6ghCetQfE5X1Kldf36D0wWSmarpp2SRybWcF2pIUcZOqRM2qcBIP', 5, 1, '2023-03-19 14:19:12', 'testkf01', 'testgcs01', '2005122106147318'),
(107, '2023-04-04 17:02:51', '7282691373', 'BofF3qg4o2Kgb0hNyMvmHg5uAfVHGYp3KYaUNgK5FduhIPptTufav5usGsMbUgeg', 6, 1, '2023-04-03 20:45:34', 'testkf01', 'testgcs01', '2005122103194860'),
(108, '2023-02-21 07:10:57', '7987309920', 'PaLMsLWWFsFbBOcMNcmpC6PpmP43twhqMvDD3VcYAWrwtZ9R3BNwsXzUi5bYgywt', 3, 0, '2023-03-25 03:50:03', 'testkf01', 'testgcs01', '2005122100865732'),
(109, '2023-01-23 01:50:21', '7741447294', 'oKGU848H4iZZ7lk7LxurfXqh8aTSWhUq6bpQ1iFkm2XAucoiiBbHZoXhuivSzpSB', 5, 0, '2023-03-24 02:10:53', 'testkf01', 'testgcs01', '2005122103052788'),
(110, '2023-03-14 21:45:48', '9949476515', 'tjBCEK6VZjdQBaKuKqsJDpSoHCUXL8j1qBNV4Xim5wEqB1BNhCDBRkZAn1hXgnLf', 1, 1, '2023-04-17 07:48:15', 'testkf01', 'testgcs01', '2005122102319771'),
(111, '2023-02-28 18:42:54', '6290107042', 'BFX3h3R9oR6TkYr9d7erB6xuQ6zFxF6yU2PLKn2I9IBbq6Btf4wUKfTjcNTDVyjm', 3, 0, '2023-04-11 01:43:38', 'testkf01', 'testgcs01', '2005122104708945'),
(112, '2023-03-29 19:20:43', '7327092249', 'bO9aaMvR7X3fCVL518JqvldkALhhFLPDKc45uD9Jrp4SzR50mFlrTdvFUkniNFmy', 5, 1, '2023-04-19 19:51:28', 'testkf01', 'testgcs01', '358339772910162'),
(113, '2023-02-23 14:02:57', '0061193926', 'NEpP4fwOTi3h8VNRQ8Gsqg1uUHVXvlFMxC8zimyBPVfhMjChazsKlwxkTAejl9ds', 4, 0, '2023-04-11 12:11:38', 'testkf01', 'testgcs01', '2005122108501237'),
(114, '2023-02-05 13:23:54', '8426420630', 'hvC4XfLFM8Zsexjhw5m715aBN1HiD4pbtP0HkgJTPZUMvOUCGqm7QWYvHkymgoN2', 5, 1, '2023-04-02 13:36:15', 'testkf01', 'testgcs01', '2005122105880746'),
(115, '2023-01-23 13:17:57', '1613679810', 'xe2C6932IxhfazqQXwyDrANaDmKSxDPMoFRzo4m2jNQuv8Vvwcw26mLA7V2WIDT6', 5, 0, '2023-04-20 02:28:30', 'testkf01', 'testgcs01', '2005122109737138'),
(116, '2023-02-10 08:04:58', '6084836826', 'w7NKcuUt63m8qmoEwAhmTPR6CZOQlvkEMPWuDwrPHxyxYugY5tjg9DfBqB1QTgG0', 3, 1, '2023-04-06 04:42:34', 'testkf01', 'testgcs01', '2005122108710737'),
(117, '2023-01-16 11:41:10', '5146566280', 'Ce5UqC3xV4nkCb1oUjwM5uw8HmBKhZLb2FJScGz4c9KHVUbAmoo0PsFMz4ZjU4GK', 1, 1, '2023-03-23 18:59:45', 'testkf01', 'testgcs01', '2005122109120116'),
(118, '2023-01-15 00:41:12', '7103461171', 'Jo97ksHudZNXmCDdbIrkv446BkUbCYPSI9XnpZGFfBxOzugHTB2WO6VUDjzSe9Hc', 3, 0, '2023-04-04 11:40:22', 'testkf01', 'testgcs01', '2005122100338627'),
(119, '2023-01-15 02:32:18', '5882049157', 'SsmjqbHcpDvmAFgVMdraxsVLq6AIVXBaIUe2Tij4e6qBtLWQ4uyoYNUHA5tpXmci', 6, 0, '2023-03-22 21:22:59', 'testkf01', 'testgcs01', '2005122107805602'),
(120, '2023-01-09 18:23:30', '3737625016', '9F8kkgZJGBWcuifgbvMOeILkcfP3Apb3pHCojqndXsJucrPvB7VpoMeZepyNvV75', 5, 0, '2023-04-07 08:28:06', 'testkf01', 'testgcs01', '2005122101316835'),
(121, '2023-03-09 20:50:19', '9063175043', 'nslenZGzqIg5F0IQndl6cXpldnW4tyX5iRGM90uPVNQmcJp5sgJu90klO2ABc6KH', 1, 0, '2023-03-23 20:15:16', 'testkf01', 'testgcs01', '2005122100590268'),
(122, '2023-03-09 07:45:56', '0608088579', 'F4ozpYs9OgveNWev05gmN0VehctXnjdHS8iYIVSrOFev751OajT93aC1E9F9pNQ6', 4, 0, '2023-03-24 23:14:13', 'testkf01', 'testgcs01', '2005122106235156'),
(123, '2023-03-29 15:12:48', '1680188867', 'cI4Vxow9SBMbUMvgmCVi5cVpnZ0A8iGUexNmfGyJv4KWWoK3Dpn1DP9PXSKGkQKK', 5, 0, '2023-04-17 14:08:27', 'testkf01', 'testgcs01', '2005122100020559'),
(124, '2023-03-16 19:27:12', '6357871209', 'UooEV8KClxK210UTLurGj6aNnpDGVYYSKge560lHCdYnnQB9eT6BdbyC9Me7Orbr', 2, 0, '2023-03-27 18:26:18', 'testkf01', 'testgcs01', '2005122104708945'),
(125, '2023-04-02 13:20:18', '9590872526', 'OJoz7z6a2nCmD7JOBNZnFNLOlw9GOOWXYgNUKVzo5JEM8rJKcRIRkdi26QXCXrza', 4, 0, '2023-03-24 09:30:11', 'testkf01', 'testgcs01', '2005122105307922'),
(126, '2023-04-15 00:31:57', '8465112141', 'h4zwyWwjxlSP5wjtz8uMNMPjQs7uq0SsfK5HncDtmCTeOcIkkiqD95or4Wl31VpX', 6, 1, '2023-04-07 14:54:39', 'testkf01', 'testgcs01', '2005122105880746'),
(127, '2023-02-06 09:35:20', '6284161541', 'wriDCcPXkVSOAaCvW4WrPdRhpuC0By1sKrwaGM99IfP5EhKTR32SGp3E2B4sPzFL', 5, 0, '2023-03-19 21:18:19', 'testkf01', 'testgcs01', '2005122104829467'),
(128, '2023-02-27 03:15:38', '3507075993', 'yC0Xp2Y6hoZAurLDD8c8chhUHMQD1XadLofwNTgYX3SKjsdv5HwymDcpDKFKxBFW', 0, 1, '2023-03-27 10:44:27', 'testkf01', 'testgcs01', '2005122103052788'),
(129, '2023-03-26 01:01:42', '5066783031', 'hVX588CYppdK7aoBwQUrEI2Emf9Bik1f0rAhAGlAJQTNJAoC9Vf9NyWQQ9mSMUdk', 3, 1, '2023-03-15 22:02:39', 'testkf01', 'testgcs01', '2005122103682538'),
(130, '2023-01-09 05:14:35', '7205801439', 'YcgDqgrDKhCTBquwb8pYUPjTsgHpIQdkXr0EqkUWctEQY92BMGCaP4xW71sm8w6Y', 6, 1, '2023-03-29 17:23:37', 'testkf01', 'testgcs01', '2005122104295141'),
(131, '2023-03-15 04:09:15', '6610272800', 'rT2AImbolvXCUOQHAIOZtBceGxmkSD73ga1aAQuar2V4kwRUQ6Jw7Nq3UWOy8hB3', 2, 1, '2023-03-22 11:15:44', 'testkf01', 'testgcs01', '2005122104829467'),
(132, '2023-02-19 21:47:13', '7887599997', 'uh81xj93DFn1loaMsnq2Zo20qSF9w00k7zb6wdwNqSwRuD8nDaTcLZ4LCaVusfpt', 4, 0, '2023-04-11 18:37:46', 'testkf01', 'testgcs01', '2005122106782027'),
(133, '2023-02-19 17:37:39', '8306686040', 'M5oqEyrtDKkJcpLyo9HOmjxj853TgfvRZD4gxOcTKmh4pSBswUm5uJbJmyOC7vxb', 3, 1, '2023-04-02 12:37:15', 'testkf01', 'testgcs01', '2005122104913193'),
(134, '2023-03-22 15:56:55', '5212183310', 'O2ZHmDPb4BdR6XQdc2cwkzI0Jjv2jVr9UuHheMnnj0NYYOkP8hmflk8HqyQS0Na8', 2, 0, '2023-04-10 23:20:44', 'testkf01', 'testgcs01', '2005122100280327'),
(135, '2023-02-07 11:59:51', '2636430777', 'vZFTUgA6xFiSi93ULNokZUfO033optgGySx2c8kp5GNVLnIlqkNW7HQzjdaoMJLx', 2, 1, '2023-04-05 04:52:38', 'testkf01', 'testgcs01', '2005122105691136'),
(136, '2023-01-27 21:33:18', '3624644685', 'K6dJk6WAjVJjSmpbL4yp9xmME8JvxiJofUIyvsvhohKw0Ot1rpLWilasMtT2E29b', 5, 0, '2023-04-12 06:50:02', 'testkf01', 'testgcs01', '2005122109259379'),
(137, '2023-03-12 21:58:29', '1783002626', 'mogs37jTcMmmt7PuTplO4IAqn3YCxzedSGFeiKzeXGNYZpveiaam7tQRKpkGS7ZG', 1, 1, '2023-03-19 23:36:19', 'testkf01', 'testgcs01', '2005122102319771'),
(138, '2023-04-21 01:49:00', '777110', '4d36671b0f09a6efe7aa3028632c8e343f946c8af290505c6d46c298e1c0f893', 0, 1, '2023-04-21 01:49:18', 'testkf01', 'testgcs01', '2005122100201979'),
(139, '2023-05-15 16:10:29', '1130484848', '944b687a4e3a22c9e29829aca06b89336da0208f2314b784cb704c3f7f58f797', 0, 0, '2023-05-15 16:10:29', 'testkf01', 'testgcs01', '2005122100201979'),
(140, '2023-05-21 07:39:49', '2458484844', '2c822a3ee25bdad040634802e715aae6d3cdefe0f6e906a7014a7b555ec52185', 0, 0, '2023-05-29 06:04:34', 'testkf01', 'testgcs01', '2005122100201979');

-- --------------------------------------------------------

--
-- 表的结构 `warranty`
--

CREATE TABLE `warranty` (
  `imei` varchar(16) NOT NULL COMMENT '设备IMEI编号',
  `activeTime` datetime DEFAULT NULL COMMENT '激活时间',
  `model` varchar(50) DEFAULT NULL COMMENT '设备型号',
  `warranty` int(11) DEFAULT NULL COMMENT '保修时长（天）'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `warranty`
--

INSERT INTO `warranty` (`imei`, `activeTime`, `model`, `warranty`) VALUES
('1145141919810', '2023-05-14 11:45:14', 'YUMI 14 下北泽定制版', 114514),
('2005122100020559', '2023-01-16 05:33:47', 'YUMI 5', 185),
('2005122100180255', '2022-12-03 13:03:30', 'YUMI 5', 550),
('2005122100184821', '2023-01-27 23:16:58', 'YUMI 2 PRO', 550),
('2005122100201979', '2023-03-20 05:26:46', 'YUMI 10S', 365),
('2005122100280327', '2023-01-20 02:57:20', 'YUMI 8 PLUS', 365),
('2005122100338627', '2022-12-30 14:02:16', 'YUMI 2 PRO', 365),
('2005122100469258', '2022-12-20 11:20:30', 'YUMI 8 PLUS', 365),
('2005122100536770', '2023-02-14 09:28:54', 'YUMI 2', 550),
('2005122100590268', '2023-03-04 07:48:58', 'YUMI 5', 185),
('2005122100638780', '2023-04-13 09:42:21', 'YUMI FIX 2023 PRO', 185),
('2005122100695631', '2023-01-14 12:46:58', 'YUMI 10S', 365),
('2005122100716738', '2022-12-15 12:40:11', 'YUMI 7 PRO', 550),
('2005122100756726', '2023-03-06 04:51:35', 'YUMI 5 PRO', 550),
('2005122100788515', '2023-04-18 05:02:39', 'YUMI 5 PRO', 365),
('2005122100865732', '2022-12-30 09:42:48', 'YUMI 10S', 365),
('2005122100913685', '2023-01-15 17:02:44', 'YUMI 5', 185),
('2005122101041532', '2023-02-01 21:16:55', 'YUMI 7 PRO', 550),
('2005122101057169', '2023-04-10 03:56:20', 'YUMI 2S', 550),
('2005122101239533', '2023-03-30 07:30:59', 'YUMI 2', 365),
('2005122101268384', '2023-04-14 03:45:18', 'YUMI 5 PRO', 185),
('2005122101316835', '2023-02-28 08:04:16', 'YUMI 2', 185),
('2005122101411580', '2022-12-16 08:35:59', 'YUMI FIX 2023 PRO', 365),
('2005122101507259', '2023-02-10 14:27:49', 'YUMI 5 PRO', 365),
('2005122101528522', '2022-12-23 08:23:01', 'YUMI 5 PRO', 185),
('2005122101559373', '2022-12-04 07:09:58', 'YUMI 2 PRO', 550),
('2005122101596223', '2023-04-11 13:52:53', 'YUMI 10S', 365),
('2005122101660107', '2023-04-20 09:06:52', 'YUMI FIX 2023 PRO', 185),
('2005122101758484', '2022-12-17 14:40:37', 'YUMI 2', 185),
('2005122101925309', '2023-02-22 21:36:32', 'YUMI 10S', 185),
('2005122101937866', '2023-04-14 16:42:36', 'YUMI 2 PRO', 550),
('2005122102083212', '2023-03-22 21:37:31', 'YUMI 2', 550),
('2005122102189199', '2022-12-28 07:32:20', 'YUMI FIX 2023 PRO', 550),
('2005122102319771', '2023-01-17 17:06:58', 'YUMI 5 PRO', 185),
('2005122102361167', '2023-01-06 17:08:54', 'YUMI 2', 550),
('2005122102629861', '2023-01-30 23:12:31', 'YUMI 2', 550),
('2005122102667318', '2023-02-01 23:25:40', 'YUMI 5 PRO', 185),
('2005122102670945', '2023-02-06 11:03:25', 'YUMI 2 PRO', 185),
('2005122102678872', '2023-04-04 09:56:14', 'YUMI 2 PRO', 185),
('2005122102702052', '2023-04-07 22:16:14', 'YUMI 5 PRO', 365),
('2005122102790715', '2022-12-04 09:37:24', 'YUMI 2 PRO', 550),
('2005122102856211', '2022-12-20 09:27:55', 'YUMI 5 PRO', 185),
('2005122103008021', '2023-04-05 05:17:39', 'YUMI 8 PLUS', 365),
('2005122103052788', '2022-12-19 21:56:06', 'YUMI 5', 185),
('2005122103073760', '2023-04-12 10:41:04', 'YUMI 5 PRO', 365),
('2005122103172145', '2023-03-22 00:42:58', 'YUMI 2 PRO', 365),
('2005122103194860', '2023-01-04 20:35:43', 'YUMI 2', 185),
('2005122103213589', '2023-01-10 16:52:21', 'YUMI 10S', 185),
('2005122103236416', '2022-12-22 11:32:32', 'YUMI 7 PRO', 550),
('2005122103292028', '2023-04-10 01:23:05', 'YUMI 10S', 185),
('2005122103602744', '2022-12-27 06:59:49', 'YUMI 10S', 185),
('2005122103682538', '2022-12-03 04:32:07', 'YUMI FIX 2023 PRO', 185),
('2005122103902209', '2023-03-12 19:35:31', 'YUMI 7 PRO', 550),
('2005122104064841', '2023-03-14 03:21:32', 'YUMI 10S', 550),
('2005122104202590', '2023-01-04 03:52:34', 'YUMI 2', 365),
('2005122104295141', '2023-01-08 08:32:57', 'YUMI 2 PRO', 550),
('2005122104354500', '2023-01-23 17:45:47', 'YUMI 7 PRO', 185),
('2005122104708945', '2023-03-22 03:37:24', 'YUMI 2', 185),
('2005122104826374', '2023-02-03 11:37:38', 'YUMI FIX 2023 PRO', 365),
('2005122104829467', '2023-02-18 22:57:18', 'YUMI 5 PRO', 185),
('2005122104913193', '2023-01-27 17:43:48', 'YUMI 7 PRO', 550),
('2005122105152165', '2023-04-09 23:42:35', 'YUMI 7 PRO', 550),
('2005122105269843', '2022-12-07 02:17:34', 'YUMI 5 PRO', 365),
('2005122105303117', '2023-02-10 04:13:57', 'YUMI 2 PRO', 365),
('2005122105307922', '2023-02-23 11:44:05', 'YUMI 5', 365),
('2005122105425865', '2023-02-17 02:54:42', 'YUMI 5 PRO', 550),
('2005122105503670', '2023-04-04 01:11:50', 'YUMI 7 PRO', 185),
('2005122105658862', '2023-02-20 06:39:01', 'YUMI 2 PRO', 365),
('2005122105691136', '2023-03-06 04:10:26', 'YUMI 7 PRO', 185),
('2005122105880746', '2023-03-20 16:15:48', 'YUMI 2S', 185),
('2005122106100093', '2023-01-12 16:15:14', 'YUMI 2 PRO', 185),
('2005122106147318', '2022-12-25 02:27:50', 'YUMI 8 PLUS', 185),
('2005122106235156', '2022-12-18 02:22:25', 'YUMI 7 PRO', 365),
('2005122106782027', '2023-03-16 17:41:19', 'YUMI 5', 185),
('2005122107506385', '2023-03-26 12:24:27', 'YUMI 2', 185),
('2005122107574740', '2023-01-06 21:08:45', 'YUMI 2S', 365),
('2005122107638650', '2023-02-04 07:36:49', 'YUMI 10S', 365),
('2005122107721790', '2023-03-19 20:01:36', 'YUMI 2S', 185),
('2005122107722650', '2023-02-18 21:16:44', 'YUMI 10S', 185),
('2005122107749033', '2023-02-08 17:35:45', 'YUMI 8 PLUS', 365),
('2005122107805602', '2023-01-19 05:40:40', 'YUMI 2 PRO', 365),
('2005122107807906', '2022-12-12 12:55:24', 'YUMI 2S', 365),
('2005122108159845', '2023-04-20 05:32:44', 'YUMI 2', 550),
('2005122108430894', '2023-04-15 14:27:24', 'YUMI 7 PRO', 185),
('2005122108446848', '2023-03-03 17:40:35', 'YUMI 2 PRO', 365),
('2005122108501237', '2023-01-17 19:29:00', 'YUMI 8 PLUS', 365),
('2005122108533388', '2023-01-30 17:59:12', 'YUMI 8 PLUS', 185),
('2005122108534851', '2023-02-28 02:39:58', 'YUMI 8 PLUS', 550),
('2005122108647069', '2023-03-09 19:06:54', 'YUMI 2', 365),
('2005122108710737', '2023-03-04 15:56:40', 'YUMI 5', 185),
('2005122109071888', '2023-03-05 16:45:32', 'YUMI FIX 2023 PRO', 365),
('2005122109079882', '2023-02-15 09:19:59', 'YUMI 7 PRO', 185),
('2005122109112134', '2023-04-02 21:41:54', 'YUMI 10S', 185),
('2005122109120116', '2023-04-02 04:16:59', 'YUMI FIX 2023 PRO', 185),
('2005122109225033', '2022-12-18 14:04:55', 'YUMI 2 PRO', 185),
('2005122109259379', '2022-12-30 00:41:54', 'YUMI 5 PRO', 365),
('2005122109283053', '2023-02-27 07:11:44', 'YUMI 2 PRO', 185),
('2005122109340267', '2023-02-20 14:35:27', 'YUMI 2S', 550),
('2005122109478344', '2023-03-09 10:51:07', 'YUMI 5', 365),
('2005122109618895', '2023-03-30 08:48:54', 'YUMI 2', 185),
('2005122109737138', '2023-02-21 22:46:38', 'YUMI FIX 2023 PRO', 365),
('358339772910162', NULL, NULL, NULL);

--
-- 转储表的索引
--

--
-- 表的索引 `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `cssid` (`eid`) USING BTREE;

--
-- 表的索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `pwd_username` (`orderNum`,`queryPwd`) USING BTREE,
  ADD KEY `cssid` (`CSSid`) USING BTREE;

--
-- 表的索引 `warranty`
--
ALTER TABLE `warranty`
  ADD PRIMARY KEY (`imei`) USING BTREE;

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=141;

--
-- 限制导出的表
--

--
-- 限制表 `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `cssid` FOREIGN KEY (`CSSid`) REFERENCES `employee` (`eid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
