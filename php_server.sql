/*
 Navicat Premium Data Transfer

 Source Server         : mysql_task01
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : php_server

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 07/05/2025 14:45:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for articles
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '文章标题',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '文章内容',
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '文章类型',
  `publish_time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '发布时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of articles
-- ----------------------------
INSERT INTO `articles` VALUES (1, '三星堆博物馆开展香港青少年“云游学•四川行” 直播导览活动', '<p><span style=\"background-color: rgb(245, 219, 77);\"><strong>hello world</strong></span></p><p><br></p>', '活动', '2025-05-03 17:37:30');
INSERT INTO `articles` VALUES (2, '青春“动”起来，文物“活”起来——三星堆博物馆开展“古蜀文明进校园”研学活动', '<p><br></p><p style=\"text-indent: 2em; text-align: left;\">金色九月，秋高气爽，丹桂飘香。在这个收获的季节里，9月25日，三星堆博物馆社教人员来到广汉市金鱼镇第二小学，开展了一次独具特色的古蜀文明研学活动，与学校的100余名师生一起感受新时代三星堆古老文明绽放出来的青春与活力。</p><p style=\"text-indent: 2em; text-align: left;\">“古蜀勇士”趣味运动：让青春“动起来”</p><p style=\"text-indent: 2em; text-align: left;\">25日下午2：30分，在学校的操场上，一场趣味十足的“古蜀勇士”争夺赛拉开了本次活动的序幕。身穿不同颜色队服的50名同学分成5组展开了激烈的比拼。</p><p style=\"text-indent: 2em; text-align: left;\">从体现团队配合和协作能力的第一关“顺流而下”，到比拼体力和耐力的第二关“蜀王快跑”，再到考验身体协调能力和形象思维能力的第三关“蜀宝拼拼乐”，每一次闯关比赛看似简单，却要求每一名参赛的队员必须与队友通力合作和密切配合才能顺利过关。虽然只有简单的三关比赛，但对只有10岁左右的孩子们来说，在体力、智力、协调能力、合作精神等方面确是不小的考验</p><p><br></p>', '活动', '2025-05-03 21:32:37');

-- ----------------------------
-- Table structure for product_images
-- ----------------------------
DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL COMMENT '商品ID',
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '图片URL',
  `sort_order` int(11) NULL DEFAULT 0 COMMENT '排序顺序',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_id`(`product_id`) USING BTREE,
  CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_images
-- ----------------------------
INSERT INTO `product_images` VALUES (1, 4, 'https://cn.bing.com/images/search?q=%E4%B8%89%E6%98%9F%E5%A0%86&form=HDRSC2&first=1&cw=1449&ch=752', 0);

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10, 2) NULL DEFAULT 0.00,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `status` tinyint(1) NULL DEFAULT 1 COMMENT '状态：1=有效，0=无效',
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '商品描述',
  `column01` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `column02` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `column03` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `column04` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `column05` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `column06` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `column07` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `column08` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `column09` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `column10` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'iPhone 13', 7999.99, 'Apple iPhone 13 with A15 chip', '2025-04-29 22:21:33', 1, '手机', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `products` VALUES (2, 'Samsung Galaxy S21', 6999.99, 'Samsung flagship phone', '2025-04-29 22:21:37', 1, '手机', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `products` VALUES (3, 'MacBook Pro', 12999.98, 'Apple MacBook Pro 16-inch', '2025-04-29 22:21:44', 1, '笔记本电脑', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `products` VALUES (4, '商青铜立人像', 0.00, '在三星堆众多的青铜雕像群中，足以领衔群像的最高统治者非大立人像莫属，——不论是从服饰、形像还是体量等各方面看，这尊大立人像都堪称它们的“领袖”人物。以往殷墟出土的玉石铜人像与之相比，真可谓是“小巫”见“大巫”了。就全世界范围来看，三星堆青铜大立人也是同时期体量最大的青铜人物雕像。 雕像系采用分段浇铸法嵌铸而成，身体中空，分人像和底座两部分。人像头戴高冠，身穿窄袖与半臂式共三层衣，衣上纹饰繁复精丽，以龙纹为主，辅配鸟纹、虫纹和目纹等，身佩方格纹带饰。其双手手型环握中空，两臂略呈环抱状构势于胸前。脚戴足镯，赤足站立于方形怪兽座上。其整体形象典重庄严，似乎表现的是一个具有通天异禀、神威赫赫的大人物正在作法。其所站立的方台，即可理解为其作法的道场——神坛或神山。', '2025-05-03 14:56:34', 1, '0', '中国历史学年代,商(前1600~前1046)', '一级', '雕塑、造像', '高260.8cm，人像高180cm，底座横宽48.5cm，纵长46.7cm，高35cm', NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for user_article_favorites
-- ----------------------------
DROP TABLE IF EXISTS `user_article_favorites`;
CREATE TABLE `user_article_favorites`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `article_id` int(11) NOT NULL COMMENT '文章ID',
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `unique_user_article`(`user_id`, `article_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_article_favorites
-- ----------------------------
INSERT INTO `user_article_favorites` VALUES (1, 1, 1, '2025-05-03 18:05:13');

-- ----------------------------
-- Table structure for user_favorites
-- ----------------------------
DROP TABLE IF EXISTS `user_favorites`;
CREATE TABLE `user_favorites`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `product_id` int(11) NOT NULL COMMENT '商品ID',
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `unique_user_product`(`user_id`, `product_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_favorites
-- ----------------------------
INSERT INTO `user_favorites` VALUES (7, 1, 2, '2025-05-03 21:34:38');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '用户名',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '密码（加密存储）',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '邮箱（可选）',
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '手机号（可选）',
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '创建时间',
  `userCol01` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `userCol02` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `userCol03` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `userCol04` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `userCol05` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `userCol06` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `userCol07` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `userCol08` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `userCol09` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nickname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'testuser01', '$2y$10$wYVXkmeJ.L86JSvT96VNr.mGjtJWQaNwyJIYcUWJDTiCB2gIb3tN6', '', '', '2025-04-28 22:25:39', 'value11', 'value22', '3', '4', '5', '6', '6', '6', '6', '昵称11');
INSERT INTO `users` VALUES (2, 'testuser02', '$2y$10$ip6cMH2TjhIm3vXnAO9GjOv5mRb9GdfcHy.WBWfEB1JPkogefY.au', NULL, NULL, '2025-04-28 22:28:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (3, 'testuser03', '$2y$10$mHy1QBoveZtxjy6QgNId3egbxbCjQbq4iBOzso/3PnMiIAELL6Z3C', NULL, NULL, '2025-04-28 22:29:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
