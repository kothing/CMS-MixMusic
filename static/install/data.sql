INSERT INTO `prefix_class` (`in_id`, `in_name`, `in_hide`, `in_order`) VALUES
(1, '网络流行', 0, 1),
(2, '经典怀旧', 0, 2),
(3, '舞曲串烧', 0, 3),
(4, '电子摇滚', 0, 4),
(5, '原创翻唱', 0, 5);
--preset--
INSERT INTO `prefix_special_class` (`in_id`, `in_name`, `in_hide`, `in_order`) VALUES
(1, '华语专辑', 0, 1),
(2, '欧美专辑', 0, 2),
(3, '日韩专辑', 0, 3),
(4, '影视原声', 0, 4),
(5, '动漫游戏', 0, 5);
--preset--
INSERT INTO `prefix_singer_class` (`in_id`, `in_name`, `in_hide`, `in_order`) VALUES
(1, '华语男歌手', 0, 1),
(2, '华语女歌手', 0, 2),
(3, '华语组合', 0, 3),
(4, '欧美男歌手', 0, 4),
(5, '欧美女歌手', 0, 5),
(6, '欧美组合', 0, 6),
(7, '日韩男歌手', 0, 7),
(8, '日韩女歌手', 0, 8),
(9, '日韩组合', 0, 9),
(10, '其他歌手', 0, 10);
--preset--
INSERT INTO `prefix_video_class` (`in_id`, `in_name`, `in_hide`, `in_order`) VALUES
(1, '内地', 0, 1),
(2, '港台', 0, 2),
(3, '欧美', 0, 3),
(4, '韩语', 0, 4),
(5, '日语', 0, 5),
(6, '二次元', 0, 6),
(7, '其它', 0, 7);
--preset--
INSERT INTO `prefix_link` (`in_id`, `in_name`, `in_url`, `in_cover`, `in_type`, `in_hide`, `in_order`) VALUES
(1, 'MixMusic', 'http://www.missra.com/', 'http://{host}{path}static/admincp/images/preview.png', 2, 0, 0),
(2, 'MixMusic', 'http://www.missra.com/', '', 1, 0, 1);
--preset--
INSERT INTO `prefix_tag` (`in_id`, `in_title`, `in_type`) VALUES
(1, '台湾', 0),
(2, '香港', 0),
(3, '内地', 0),
(4, '日本', 0),
(5, '韩国', 0),
(6, '美国', 0),
(7, '英国', 0),
(8, '法国', 0),
(9, '德国', 0),
(10, '印度', 0),
(11, '泰国', 0),
(12, '波兰', 0),
(13, '荷兰', 0),
(14, '巴西', 0),
(15, '瑞典', 0),
(16, '挪威', 0),
(17, '丹麦', 0),
(18, '捷克', 0),
(19, '伊朗', 0),
(20, '冰岛', 0),
(21, '意大利', 0),
(22, '加拿大', 0),
(23, '俄罗斯', 0),
(24, '奥地利', 0),
(25, '墨西哥', 0),
(26, '土耳其', 0),
(27, '新西兰', 0),
(28, '爱尔兰', 0),
(29, '以色列', 0),
(30, '匈牙利', 0),
(31, '比利时', 0),
(32, '阿根廷', 0),
(33, '西班牙', 0),
(34, '葡萄牙', 0),
(35, '新加坡', 0),
(36, '马来西亚', 0);
--preset--
INSERT INTO `prefix_tag` (`in_id`, `in_title`, `in_type`) VALUES
(37, 'OST', 1),
(38, 'pop', 1),
(39, 'indie', 1),
(40, '民谣', 1),
(41, 'Folk', 1),
(42, 'J-POP', 1),
(43, 'Electronic', 1),
(44, 'rock', 1),
(45, '流行', 1),
(46, '摇滚', 1),
(47, 'JPOP', 1),
(48, '电影原声', 1),
(49, 'post-rock', 1),
(50, 'jazz', 1),
(51, 'R&B', 1),
(52, '独立音乐', 1),
(53, 'Brit-pop', 1),
(54, '中国摇滚', 1),
(55, 'britpop', 1),
(56, '纯音乐', 1),
(57, 'punk', 1),
(58, 'Metal', 1),
(59, 'classical', 1),
(60, '独立', 1),
(61, 'Alternative', 1),
(62, '古典', 1),
(63, 'newage', 1),
(64, '电子', 1),
(65, 'hip-hop', 1),
(66, 'Soundtrack', 1),
(67, '经典', 1),
(68, '钢琴', 1),
(69, 'Darkwave', 1),
(70, 'Post-Punk', 1),
(71, '原声', 1),
(72, 'piano', 1);
--preset--
INSERT INTO `prefix_tag` (`in_id`, `in_title`, `in_type`) VALUES
(73, '寂寞', 2),
(74, '想哭', 2),
(75, '舒服', 2),
(76, '心碎', 2),
(77, '宁静', 2),
(78, '珍惜', 2),
(79, '爱情', 2),
(80, '抒情', 2),
(81, '幸福', 2),
(82, '安静', 2),
(83, '怀念', 2),
(84, '轻快', 2),
(85, '思念', 2),
(86, '忧伤', 2),
(87, '欢快', 2),
(88, '甜蜜', 2),
(89, '忧郁', 2),
(90, '回忆', 2),
(91, '伤感', 2),
(92, '唯美', 2),
(93, '感动', 2),
(94, '深情', 2),
(95, '温暖', 2),
(96, '好听', 2),
(97, '励志', 2),
(98, '浪漫', 2),
(99, '空灵', 2),
(100, '轻柔', 2),
(101, '清澈', 2),
(102, '悠扬', 2),
(103, '干净', 2),
(104, '奇幻', 2),
(105, '美好', 2),
(106, '想念', 2),
(107, '情歌', 2),
(108, '可爱', 2);
--preset--
INSERT INTO `prefix_tag` (`in_id`, `in_title`, `in_type`) VALUES
(109, '陈绮贞', 3),
(110, '陈奕迅', 3),
(111, '周杰伦', 3),
(112, '王菲', 3),
(113, '孙燕姿', 3),
(114, '五月天', 3),
(115, '苏打绿', 3),
(116, '梁静茹', 3),
(117, 'Coldplay', 3),
(118, '久石让', 3),
(119, '张悬', 3),
(120, '蔡健雅', 3),
(121, '范晓萱', 3),
(122, '椎名林檎', 3),
(123, 'GreenDay', 3),
(124, 'LinkinPark', 3),
(125, '莫文蔚', 3),
(126, 'Radiohead', 3),
(127, '窦唯', 3),
(128, 'eason', 3),
(129, '王力宏', 3),
(130, '刘德华', 3),
(131, 'Bach', 3),
(132, '张震岳', 3),
(133, '曹方', 3),
(134, '许巍', 3),
(135, 'Oasis', 3),
(136, 'S.H.E', 3),
(137, '张靓颖', 3),
(138, 'KerenAnn', 3),
(139, '王杰', 3),
(140, '李志', 3),
(141, 'DamienRice', 3),
(142, 'Nirvana', 3),
(143, 'Eminem', 3),
(144, 'avrillavigne', 3),
(145, '刘若英', 3),
(146, '陈珊妮', 3),
(147, '萧亚轩', 3),
(148, 'JamesBlunt', 3),
(149, '张惠妹', 3),
(150, 'Beethoven', 3),
(151, '戴佩妮', 3),
(152, '张国荣', 3),
(153, '范玮琪', 3),
(154, 'Jay', 3),
(155, 'beatles', 3),
(156, '林一峰', 3),
(157, '蔡依林', 3),
(158, '陈升', 3),
(159, '苏打绿', 3),
(160, 'MariahCarey', 3),
(161, '林俊杰', 3),
(162, '张学友', 3),
(163, 'PinkFloyd', 3),
(164, '中岛美嘉', 3),
(165, '自然卷', 3),
(166, 'NorahJones', 3),
(167, '那英', 3),
(168, '周华健', 3);
--preset--
INSERT INTO `prefix_tag` (`in_id`, `in_title`, `in_type`) VALUES
(169, '华语', 4),
(170, '粤语', 4),
(171, '闽语', 4),
(172, '欧美', 4),
(173, '日韩', 4);