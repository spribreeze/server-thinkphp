/*
 Navicat Premium Data Transfer

 Source Server         : root
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : php_server

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 11/05/2025 10:51:25
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
  `image_url` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '图片',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of articles
-- ----------------------------
INSERT INTO `articles` VALUES (1, '三星堆博物馆开展香港青少年“云游学•四川行” 直播导览活动', '<p><span style=\"background-color: rgb(245, 219, 77);\"><strong>hello world</strong></span></p><p><br></p>', '活动', '2025-05-03 17:37:30', 'https://sxd-tx-1315371622.cos.ap-nanjing.myqcloud.com/newPage/1745573026_aa609d6e-7ce7-4d30-98d0-e602d4b3efef.png');
INSERT INTO `articles` VALUES (2, '青春“动”起来，文物“活”起来——三星堆博物馆开展“古蜀文明进校园”研学活动', '<p><br></p><p style=\"text-indent: 2em; text-align: left;\">金色九月，秋高气爽，丹桂飘香。在这个收获的季节里，9月25日，三星堆博物馆社教人员来到广汉市金鱼镇第二小学，开展了一次独具特色的古蜀文明研学活动，与学校的100余名师生一起感受新时代三星堆古老文明绽放出来的青春与活力。</p><p style=\"text-indent: 2em; text-align: left;\">“古蜀勇士”趣味运动：让青春“动起来”</p><p style=\"text-indent: 2em; text-align: left;\">25日下午2：30分，在学校的操场上，一场趣味十足的“古蜀勇士”争夺赛拉开了本次活动的序幕。身穿不同颜色队服的50名同学分成5组展开了激烈的比拼。</p><p style=\"text-indent: 2em; text-align: left;\">从体现团队配合和协作能力的第一关“顺流而下”，到比拼体力和耐力的第二关“蜀王快跑”，再到考验身体协调能力和形象思维能力的第三关“蜀宝拼拼乐”，每一次闯关比赛看似简单，却要求每一名参赛的队员必须与队友通力合作和密切配合才能顺利过关。虽然只有简单的三关比赛，但对只有10岁左右的孩子们来说，在体力、智力、协调能力、合作精神等方面确是不小的考验</p><p><br></p>', '活动', '2025-05-03 21:32:37', 'https://sxd-tx-1315371622.cos.ap-nanjing.myqcloud.com/newPage/1744702361_706308f7-23b3-4fe0-a504-a231903978c5.png');
INSERT INTO `articles` VALUES (3, '三星堆文明：从古蜀秘境走向全球视野', '<div data-v-8daa8330=\"\" class=\"detail-content\"><p style=\"text-align: center;\"><img src=\"https://sxd-tx-1315371622.cos.ap-nanjing.myqcloud.com/newPage/1744702361_706308f7-23b3-4fe0-a504-a231903978c5.png\" alt=\"\" data-href=\"\" style=\"\"></p><p style=\"text-align: center;\"><span style=\"font-family: 宋体;\">三星堆博物馆中，观众打卡戴金面罩青铜人头像</span></p><p style=\"text-indent: 32pt;\">4月，以“构想焕发生机的未来社会”为主题的2025年日本大阪世博会正式拉开序幕。三星堆青铜神树、青铜大面具等精美文物的复制品远赴日本，亮相大阪世博会中国馆，一展三星堆文明的璀璨。</p><p style=\"text-indent: 32pt;\">三星堆遗址考古成果丰富，代表着古蜀文明的辉煌灿烂和中华文明的深厚积淀，其独特的文化内涵，赋予了三星堆海外传播的天然影响力。2023年7月，习近平总书记在三星堆博物馆新馆考察时指出，三星堆遗址考古成果在世界上是叫得响的，展现了四千多年前的文明成果。文物保护修复是一项长期任务，要久久为功，做出更大成绩。</p><p style=\"text-indent: 32pt;\">近年来，三星堆博物馆牢记嘱托、真抓实干，持续擦亮“世界三星堆”的文化名片，在建设世界一流博物馆、世界知名旅游目的地、打造国家文化地标的道路上砥砺前行。</p><p style=\"text-indent: 32.15pt;\"><br></p><p style=\"text-indent: 32.15pt;\"><strong>三星堆文物展示中华文明多元一体</strong></p><p style=\"text-indent: 32pt;\">向世界讲好三星堆的故事、展示中华文明的多元一体和深厚底蕴，是三星堆博物馆工作的重中之重。</p><p style=\"text-indent: 32pt;\">在本届大阪世博会中，中国馆是用地面积最大的外国自建馆之一，以“共同构建人与自然生命共同体——绿色发展的未来社会”为主题，重点展示博大精深的中华文化。哪些文物能够展现中华文明的多元一体？自2024年以来，专家在全国各大遗址中挑选对比，最终选定了三星堆在内的几处遗址的文物复制品。据三星堆博物馆副馆长余健介绍，负责中国馆布置的专家首先选定了三星堆镇馆之宝青铜神树。“因为神树代表了人类早期对天地自然的认知体系及趋同化的神话宇宙观，而三星堆神树是中国众多神树中伟大的实物标本，可以视作上古先民人神互通神话意识的形象化写照，是古蜀人神话宇宙观具象化的物质载体，恰好和世博会中国馆的主题契合。”此外，青铜面具是三星堆出土青铜器中的典型代表，视觉造型别致、内涵丰富；青铜兽首冠人像造型同样独特，看上去神秘莫测。余健表示，这三件器物展示了三星堆青铜文明丰富的文化面貌，是向世界展示中华文明多元一体的生动例证。</p><p style=\"text-indent: 32pt;\">三星堆众多文物中不乏国宝重器，自2023年7月三星堆博物馆新馆建成以来，国内外游客纷至沓来。据统计，三星堆博物馆新馆开馆至今已接待游客900余万人，年均接待境外和中央、省级、市级媒体80余家，研发文创产品超1600种，销售收入超1.5亿元。2024年，央视频推出“文脉千年回响”大型直播活动，以三星堆遗址为窗口探寻中华文化瑰宝。直播期间，全网累计发布图文、视频信息近10万条，共计31个国家和地区的227家新闻媒体专题报道了三星堆考古新发现，全网阅读量超500亿次。这次媒体融合海量传播不仅擦亮了三星堆“超级名片”，更推动了中华文化更好走向世界。</p><p style=\"text-indent: 32pt;\"> </p><p style=\"text-indent: 32.15pt;\"><strong>跨媒介叙事：三星堆多维度对话世界的创新实践</strong></p><p style=\"text-indent: 32pt;\">近几年，中华优秀传统文化的国际传播环境正在经历叙事格局和传播场景的转变，世界各国对人文交流抱以更多期待。以三星堆为代表的古蜀文明，是文明交流互鉴的鲜活例证。在“推进文化自信自强”的时代背景下，三星堆文化的国际传播更具深厚内涵。</p><p style=\"text-indent: 32pt; text-align: center;\"><img src=\"https://sxd-tx-1315371622.cos.ap-nanjing.myqcloud.com/newPage/1744702406_f3b3f768-a2b5-4f77-8316-6bf0ad394f49.png\" alt=\"\" data-href=\"\" style=\"\"></p><p style=\"text-align: center;\"><span style=\"font-family: 宋体;\">1993年5月，三星堆文物在瑞士洛桑奥林匹克博物馆展出</span></p><p style=\"text-indent: 32pt;\">三星堆博物馆以展陈文物的方式，溯源古老文明的内核与基因，向世界讲好中国故事。1993年，三星堆首次走出国门、亮相瑞士洛桑奥林匹克博物馆。此后累计走进20多个国家和100多个地区，参与各类国际性主题展览与外事活动近百次。2018—2019年，“三星堆：人与神的世界——四川古蜀文明特展”相继走进意大利那不勒斯国家考古博物馆、罗马图拉真市场及帝国广场博物馆。2024年11月，“太阳之光：古蜀与印加文明互鉴展”在秘鲁印加博物馆揭幕，来自三星堆和金沙的古蜀珍宝，借助复制品和数智技术来到万里之外的秘鲁，让当地观众得以领略古蜀的风采与神秘。</p><p style=\"text-indent: 32pt; text-align: center;\"><img src=\"https://sxd-tx-1315371622.cos.ap-nanjing.myqcloud.com/newPage/1744702434_96209e7d-7125-4fff-a82a-08d6239cbe93.png\" alt=\"\" data-href=\"\" style=\"\"></p><p style=\"text-align: center;\"><span style=\"font-family: 宋体;\">2001年9月，三星堆文物在美国金泊尔艺术博物馆展出</span></p><p style=\"text-align: center;\"><br></p><p style=\"text-indent: 32pt;\">三星堆博物馆以学术研讨的形式，厚植古老文明的底蕴与内涵，架起文明对话桥梁。三星堆新一轮考古发掘是“中国特色、中国风格、中国气派”考古学的示范工程，也因此增强了“中国阐释”的含金量。近年来，三星堆博物馆联合多家单位举办“国际视角下的三星堆文明”等学术活动，邀请海内外学者共同探讨三星堆考古新发现的重要意义，促进三星堆与世界古老文明的交流与对话。《三星堆研究》《三星堆共识》等科研成果不断出炉，实现国际性的学术资源与研究成果共享。在教育浸润方面，三星堆博物馆积极举办中外青年视频云对话，邀请150多位英国青年与汉学名家、考古学者在线探讨，面向英美学生开展三星堆博物馆之夜直播。</p><p style=\"text-indent: 32pt;\">三星堆博物馆以影视艺术为桥梁，演绎古老文明的前世与今生，为历史注入光影魔力。一是举办创意活动。开展“The Big Draw·艺绘三星堆”“三星堆&amp;威尼斯创意设计嘉年华”等艺术主题活动，拓展三星堆文化艺术的想象空间。二是设计剧情演绎。2024年上海国际电影节中，国内首部人工智能全流程制作的科幻短剧集《三星堆：未来启示录》正式亮相，为三星堆文化注入了科幻想象。三是参与纪实传播。中埃联合制作的四集纪录片《当法老遇见三星堆》共六国语言版本在世界各大媒体平台播出，观看量超5000万次。借助海外媒体的独特视角和国际化表达，三星堆文化的全球影响力不断提升。</p><p style=\"text-indent: 32pt; text-align: center;\"><img src=\"https://sxd-tx-1315371622.cos.ap-nanjing.myqcloud.com/newPage/1744702519_7e41f456-9794-46cc-9a50-e6dc2468ddc3.png\" alt=\"\" data-href=\"\" style=\"\"></p><p style=\"text-align: center;\"><span style=\"font-family: 宋体;\">“邂逅三星堆——12K微距看国宝”全球巡展首站在卡塔尔正式启动</span></p><p style=\"text-indent: 32pt;\">三星堆博物馆以数智技术为载体，重现古老文明的气韵与风采，为时空对话开启智慧之门。2024年，“邂逅三星堆——12K 微距看国宝”全球巡展相继亮相卡塔尔、纽约曼哈顿等地，展览利用数字VR作品、全景式多媒体影像再现古蜀文明灿烂辉煌。在2024文化遗产保护数字化国际论坛“文明伙伴计划——三星堆推介专场”上，三星堆国际展示传播平台正式揭幕，中国三星堆金面具与希腊阿伽门农金面具同框出镜，为“一带一路”框架下的中希文化交流书写了新的注脚。</p><p style=\"text-indent: 32pt; text-align: center;\"><img src=\"https://sxd-tx-1315371622.cos.ap-nanjing.myqcloud.com/newPage/1744702545_55618369-4758-43c7-aee4-e6079c22741b.png\" alt=\"\" data-href=\"\" style=\"\"></p><p style=\"text-indent: 32pt; text-align: center;\">“邂逅三星堆——12K微距看国宝”全球巡展亮相纽约曼哈顿</p><p style=\"text-indent: 32.15pt;\"><br></p><p style=\"text-indent: 32.15pt;\"><strong>三星堆文化出海“方法论”</strong></p><p style=\"text-indent: 32pt;\">举世瞩目的三星堆，是数千年前先民留下的灿烂文明成果。如何将文化瑰宝保护好、传播好？三星堆博物馆秉持开放多元的理念，开展跨界合作，激发古蜀文化创意，探索了一条中华文化国际传播的新路径。</p><p style=\"text-indent: 32pt;\">首先，注重科技赋能，唤醒沉睡千年的文明记忆。三星堆博物馆主动聚焦典型文物，树立以考古文博为核心的传播议题，利用数字智能化技术赋能文博展示。例如，“邂逅三星堆”全球巡展巧妙运用了“文化+科技”的创新表达。展览通过全球首个12K超高清微距技术，将青铜神树、黄金面罩等文物的细微纹路放大至亿万像素级，观众仿佛穿越时空，指尖轻触屏幕便能看清三千年前的铸造痕迹与岁月斑驳。</p><p>其次，形成传播矩阵，构建全球文化共振场域。三星堆博物馆顺应互联网传播规律，打造多元化的传播渠道和方式。2023年4月13日，三星堆博物馆与抖音集团正式签订了框架合作协议，共同打造“三星堆博物馆”抖音官方账号，提供科普内容和信息资讯，并结合年度重要节点和宣传主题策划推广活动，利用AR、VR等技术手段助力三星堆建筑、文物、故事“活起来”。据统计，截至目前“三星堆博物馆”的微信公众号、微博及抖音账号的粉丝共计788万，新媒体运营成效显著。</p><p style=\"text-align: center;\"><img src=\"https://sxd-tx-1315371622.cos.ap-nanjing.myqcloud.com/newPage/1744702577_f6a41ceb-0877-4e27-ae74-81e7c605636f.png\" alt=\"\" data-href=\"\" style=\"\"></p><p style=\"text-align: center;\"><span style=\"font-family: 宋体;\">三星堆博物馆文创商店内，各色商品琳琅满目</span></p><p style=\"text-indent: 32pt;\">再次，坚持创意破圈，打造现象级文化IP。三星堆博物馆主动走出文博行业“舒适圈”，秉持多元开放的理念，开展跨界合作，打造三星堆生活美学，“让文化和自然遗产在新时代焕发新活力、绽放新光彩”。几年前，三星堆博物馆推出青铜面具文创雪糕，一炮走红。此后，文创馆里摆满了琳琅满目的文创产品，包括缩小版金面罩巧克力、袖珍款青铜神树冰箱贴、三星堆主题盲盒等。这些产品不仅满足了游客的文化消费需求，也有力推动三星堆文化的广泛传播。</p><p style=\"text-indent: 32pt;\">最后，回归价值共鸣，构建人类命运共同体叙事。三星堆博物馆主动遵循国际传播规律，适应国际化语境与表达方式，树立“分享为先”的国际传播观念，找寻共通审美与信仰，实现与海外公众的关切点、兴趣点的契合与互动，促进思想共鸣与文化互鉴。2021年3月20日，由四川日报川观新闻、四川省文物考古研究院、三星堆博物馆联合策划推出的电音歌曲《我怎么这么好看》MV，通过方言说唱的年轻表达、押韵贴切的歌词以及真实细腻的原创手绘动画，收获了海内外媒体和网友的喜爱。这种“亚文化”“非主流”的传播方式，以轻松、新潮的形式触达海内外Z世代群体，不仅讲述了中国故事，更加构建了人类共通的情感坐标系。</p><p style=\"text-indent: 32pt;\"><br></p><p style=\"text-indent: 32pt;\">文物是文化传承的历史印记，三星堆博物馆将承载更多中华文化国际传播、推动文明交流互鉴的任务，用文物、文化凝聚中华民族的磅礴力量，为全球观众呈现更加多元化的文化遗产内涵，共绘美美与共的人类文明画卷。</p><p> </p><p>来源：中国新闻发布</p><p style=\"text-align: center;\"><br></p></div>', '活动', '2025-05-10 17:12:51', 'https://sxd-tx-1315371622.cos.ap-nanjing.myqcloud.com/newPage/1744702361_706308f7-23b3-4fe0-a504-a231903978c5.png');

-- ----------------------------
-- Table structure for articles_comments
-- ----------------------------
DROP TABLE IF EXISTS `articles_comments`;
CREATE TABLE `articles_comments`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL COMMENT '关联的文章ID',
  `user_id` int(11) NOT NULL COMMENT '评论用户的ID',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '评论内容',
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '评论时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `article_id`(`article_id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  CONSTRAINT `articles_comments_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `articles_comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of articles_comments
-- ----------------------------
INSERT INTO `articles_comments` VALUES (1, 1, 1, '这是一条评论', '2025-05-08 10:48:18');
INSERT INTO `articles_comments` VALUES (2, 1, 1, '这是一条评论', '2025-05-08 10:56:32');
INSERT INTO `articles_comments` VALUES (3, 1, 1, '这是一条评论3', '2025-05-08 10:56:54');
INSERT INTO `articles_comments` VALUES (4, 3, 2, '火钳刘明', '2025-05-10 18:22:04');
INSERT INTO `articles_comments` VALUES (5, 3, 2, '12313', '2025-05-10 18:25:09');
INSERT INTO `articles_comments` VALUES (6, 3, 2, '火钳刘明', '2025-05-10 18:29:15');
INSERT INTO `articles_comments` VALUES (7, 3, 2, '111', '2025-05-10 18:29:56');
INSERT INTO `articles_comments` VALUES (8, 3, 3, '这是我的第一条评论', '2025-05-10 18:30:37');
INSERT INTO `articles_comments` VALUES (9, 3, 2, '火钳刘明', '2025-05-10 18:34:02');

-- ----------------------------
-- Table structure for notice
-- ----------------------------
DROP TABLE IF EXISTS `notice`;
CREATE TABLE `notice`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '公告ID',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '公告标题',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '公告内容',
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '公告类型（例如：通知、新闻等）',
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '创建时间',
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0) COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_type`(`type`) USING BTREE COMMENT '索引: 类型'
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '公告表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of notice
-- ----------------------------
INSERT INTO `notice` VALUES (1, '重要系统维护通知', '我们将于本周五凌晨进行系统维护...', '通知', '2025-05-08 00:19:24', '2025-05-08 00:19:24');
INSERT INTO `notice` VALUES (2, '新产品发布会', '欢迎参加我们的新产品发布会...', '新闻', '2025-05-08 00:19:24', '2025-05-08 00:19:24');
INSERT INTO `notice` VALUES (3, '三星堆博物馆保障资源采购项目结果公告', '三星堆博物馆保障资源采购项目 结果公告项目名称三星堆博物馆保障资源采购项目项目编号SYRD2025（043）号采购方式竞争性磋商采购人四川广汉三星堆博物馆联系人秦老师联系方式0838-6096907采购代理机构四川晟越容大招标代理有限公司联系人尹女士联系方式0838-2907685成交供应商成都超算中心运营管理有限公司成交金额15.80万元（大写：壹拾伍万捌仟元整）公示期限1', '通知', '2025-05-10 20:31:08', '2025-05-10 20:31:11');
INSERT INTO `notice` VALUES (4, '三星堆博物馆保障资源采购项目', '磋商采购公告 四川晟越容大招标代理有限公司受四川广汉三星堆博物馆的委托，拟对三星堆博物馆保障资源采购项目以竞争性磋商方式进行采购，兹邀请符合本次磋商采购要求的供应商参加磋商。 （一）项目编号：SYRD2025（043）号 （二）项目名称：三星堆博物馆保障资源采购项目 （三）项目概况：三星堆博物馆保障资源采购项目，预算价：16万元。 ', '通知', '2025-05-10 20:33:56', '2025-05-10 20:33:58');

-- ----------------------------
-- Table structure for post
-- ----------------------------
DROP TABLE IF EXISTS `post`;
CREATE TABLE `post`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '帖子ID',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT '用户ID',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '帖子标题',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '帖子内容',
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '帖子类型（如：问答、分享、公告等）',
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_user_id`(`user_id`) USING BTREE,
  INDEX `idx_type`(`type`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '帖子表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of post
-- ----------------------------
INSERT INTO `post` VALUES (1, 1, '如何学好ThinkPHP？', '我刚开始学习TP框架，请大家给点建议。', '问答', '2025-05-09 22:00:41', '2025-05-09 22:00:41');
INSERT INTO `post` VALUES (2, 1, '请问有这种木雕吗', '有吗有吗有吗', '问答', '2025-05-10 12:41:01', '2025-05-10 12:41:01');
INSERT INTO `post` VALUES (3, 2, '沙雕大甩卖！！', '<p>沙雕大甩卖！！</p>', '日常水贴', '2025-05-10 19:23:28', '2025-05-10 19:23:28');

-- ----------------------------
-- Table structure for post_comment
-- ----------------------------
DROP TABLE IF EXISTS `post_comment`;
CREATE TABLE `post_comment`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL COMMENT '关联的帖子ID',
  `user_id` int(11) NOT NULL COMMENT '评论人ID',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '评论内容',
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_post_id`(`post_id`) USING BTREE,
  INDEX `idx_user_id`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '帖子评论表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of post_comment
-- ----------------------------
INSERT INTO `post_comment` VALUES (1, 2, 1, '没有这种木雕', '2025-05-10 12:42:25');
INSERT INTO `post_comment` VALUES (2, 2, 1, '没有这种木雕2', '2025-05-10 18:48:04');
INSERT INTO `post_comment` VALUES (3, 2, 1, '没有这种木雕3', '2025-05-10 18:48:20');
INSERT INTO `post_comment` VALUES (4, 3, 2, '真好', '2025-05-10 20:03:38');

-- ----------------------------
-- Table structure for post_like
-- ----------------------------
DROP TABLE IF EXISTS `post_like`;
CREATE TABLE `post_like`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT '用户ID',
  `post_id` int(10) UNSIGNED NOT NULL COMMENT '帖子ID',
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '点赞时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `idx_user_post`(`user_id`, `post_id`) USING BTREE COMMENT '用户与帖子联合唯一索引',
  INDEX `idx_post_id`(`post_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '帖子点赞表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of post_like
-- ----------------------------
INSERT INTO `post_like` VALUES (1, 1, 2, '2025-05-10 13:25:34');
INSERT INTO `post_like` VALUES (2, 2, 3, '2025-05-10 20:07:10');

-- ----------------------------
-- Table structure for post_types
-- ----------------------------
DROP TABLE IF EXISTS `post_types`;
CREATE TABLE `post_types`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of post_types
-- ----------------------------
INSERT INTO `post_types` VALUES (1, '问答', NULL);
INSERT INTO `post_types` VALUES (2, '教程', NULL);
INSERT INTO `post_types` VALUES (3, '公告', NULL);
INSERT INTO `post_types` VALUES (4, '咨询', NULL);
INSERT INTO `post_types` VALUES (5, '日常水贴', NULL);

-- ----------------------------
-- Table structure for product_comments
-- ----------------------------
DROP TABLE IF EXISTS `product_comments`;
CREATE TABLE `product_comments`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL COMMENT '关联的商品ID',
  `user_id` int(11) NOT NULL COMMENT '评论用户的ID',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '评论内容',
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '评论时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_id`(`product_id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  CONSTRAINT `product_comments_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `product_comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_comments
-- ----------------------------
INSERT INTO `product_comments` VALUES (1, 1, 1, '这是一条评论1', '2025-05-08 14:26:01');
INSERT INTO `product_comments` VALUES (2, 4, 2, '123123', '2025-05-10 14:18:19');
INSERT INTO `product_comments` VALUES (3, 4, 2, '真好', '2025-05-10 15:17:38');
INSERT INTO `product_comments` VALUES (4, 1, 1, '这是一条评论2', '2025-05-10 15:22:31');
INSERT INTO `product_comments` VALUES (5, 4, 2, '12313223', '2025-05-10 15:45:27');
INSERT INTO `product_comments` VALUES (6, 4, 2, '123123', '2025-05-10 15:45:42');
INSERT INTO `product_comments` VALUES (7, 4, 2, '1231232', '2025-05-10 15:48:56');
INSERT INTO `product_comments` VALUES (8, 4, 2, '火钳刘明', '2025-05-10 16:00:10');
INSERT INTO `product_comments` VALUES (9, 4, 2, '测试', '2025-05-10 16:33:30');
INSERT INTO `product_comments` VALUES (10, 4, 2, '测试2', '2025-05-10 16:40:18');
INSERT INTO `product_comments` VALUES (11, 4, 3, '好酷啊', '2025-05-10 18:23:32');

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_images
-- ----------------------------
INSERT INTO `product_images` VALUES (1, 4, 'https://x0.ifengimg.com/ucms/2021_15/F453CDEFA738EE48593D80828E7E7D5E304788D2_size66_w1080_h735.jpg', 0);
INSERT INTO `product_images` VALUES (2, 4, 'https://youimg1.c-ctrip.com/target/100o1e000001evcz67D85.jpg', 0);
INSERT INTO `product_images` VALUES (3, 4, 'https://img1.qunarzz.com/p/tts8/1801/c3/5ded9aa32d7dd602.jpg_r_720x480x95_a208ceaf.jpg', 0);

-- ----------------------------
-- Table structure for product_types
-- ----------------------------
DROP TABLE IF EXISTS `product_types`;
CREATE TABLE `product_types`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_types
-- ----------------------------
INSERT INTO `product_types` VALUES (1, '类型1', NULL);
INSERT INTO `product_types` VALUES (2, '类型2', NULL);
INSERT INTO `product_types` VALUES (3, '类型3', NULL);
INSERT INTO `product_types` VALUES (4, '类型4', NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_favorites
-- ----------------------------
INSERT INTO `user_favorites` VALUES (7, 1, 2, '2025-05-03 21:34:38');
INSERT INTO `user_favorites` VALUES (8, 1, 1, '2025-05-10 15:23:01');
INSERT INTO `user_favorites` VALUES (13, 2, 1, '2025-05-10 16:17:54');
INSERT INTO `user_favorites` VALUES (15, 1, 4, '2025-05-10 16:26:05');
INSERT INTO `user_favorites` VALUES (17, 3, 4, '2025-05-10 18:24:34');

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
  `avatar_url` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '用户头像链接',
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
INSERT INTO `users` VALUES (1, 'testuser01', '$2y$10$wYVXkmeJ.L86JSvT96VNr.mGjtJWQaNwyJIYcUWJDTiCB2gIb3tN6', '', '', '2025-04-28 22:25:39', 'imgUrl', 'value22', '3', '4', '5', '6', '6', '6', '6', '小红');
INSERT INTO `users` VALUES (2, 'testuser02', '$2y$10$ip6cMH2TjhIm3vXnAO9GjOv5mRb9GdfcHy.WBWfEB1JPkogefY.au', NULL, '181****7412', '2025-04-28 22:28:46', 'http://192.168.0.108:8000//storage/uploads/20250510/355b927b7698382ceabd56db2818fb51.png', '江宁区', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '张三');
INSERT INTO `users` VALUES (3, 'testuser03', '$2y$10$mHy1QBoveZtxjy6QgNId3egbxbCjQbq4iBOzso/3PnMiIAELL6Z3C', NULL, '12345678901', '2025-04-28 22:29:39', 'http://192.168.0.108:8000//storage/uploads/20250510/c8fa5734ad5b7067145341b72e0643d0.jpg', '福建闽南', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '小红');

SET FOREIGN_KEY_CHECKS = 1;
