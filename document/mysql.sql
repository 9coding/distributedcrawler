
--
-- Database: `crawler`
--

-- --------------------------------------------------------

--
-- 表的结构 `users`
--
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL auto_increment,
  `user_email` varchar(30) NOT NULL COMMENT '用户邮箱，登录用',
  `user_password` varchar(255) NOT NULL COMMENT '登录密码',
  `user_name` varchar(20) NOT NULL COMMENT '用户昵称',
  `user_phone` char(11) NOT NULL COMMENT '用户手机号',
  `user_point` int(10) unsigned NOT NULL default 0 COMMENT '用户积分',
  `user_money` decimal(9, 2) unsigned NOT NULL default 0 COMMENT '用户余额',
  `user_status` tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT '用户状态，1是正常，2是停用',
  `user_lastip` int(10) unsigned NOT NULL COMMENT '上次登录的IP地址',
  `user_lastdate` datetime NOT NULL COMMENT '上次登录的日期',
  `user_currentip` int(10) unsigned NOT NULL COMMENT '本次登录的IP地址',
  `user_currentdate` datetime NOT NULL COMMENT '本次登录的日期',
  `remember_token` varchar(100) NOT NULL default '' COMMENT '记住登录状态',
  `user_role` tinyint(3) unsigned NOT NULL DEFAULT 2 COMMENT '用户角色，关联roles表的role_id字段',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `index_user_email` (`user_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户表';
INSERT INTO `users` VALUES (1,'ivan820819@qq.com','$2y$10$15FPZ74gjfHPPbDl9oMbKOKfZl3cbqmT.Ypn4wyylZlSXqNKZFaPW','管理员','',0,0,1,0,now(),0,now(),'',1,now(),null,null);

-- --------------------------------------------------------

--
-- 表的结构 `roles`
--
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `role_id` tinyint(3) unsigned NOT NULL auto_increment,
  `role_name` varchar(20) NOT NULL COMMENT '角色名称',
  `role_status` tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT '状态，1是正常，2是停用',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户角色表';
INSERT INTO `roles` VALUES (1,'管理员',1),(2,'普通用户',1);

-- --------------------------------------------------------

--
-- 表的结构 `userpoints`
--
DROP TABLE IF EXISTS `userpoints`;
CREATE TABLE `userpoints` (
  `point_id` int(10) unsigned NOT NULL auto_increment,
  `point_user` int(10) unsigned NOT NULL COMMENT '用户ID，对应users表的user_id字段',
  `point_reason` tinyint(3) unsigned NOT NULL COMMENT '积分变更原因，1是订单支付时使用积分，2是订单成功完成后得到的积分，3是管理员在后台修改积分',
  `point_num` int(10) unsigned NOT NULL default 0 COMMENT '当次变更的积分数量',
  `point_change` enum('+','-') NOT NULL COMMENT '积分变更类型，+代表增加积分，-代表减少积分',
  `point_order` varchar(20) NOT NULL default '' COMMENT '订单号，关联purchases表的purchase_num字段',
  `point_date` datetime NOT NULL COMMENT '积分变更日期',
  PRIMARY KEY (`point_id`),
  INDEX `index_point_user` (`point_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户积分变更流程表';

-- --------------------------------------------------------

--
-- 表的结构 `usermoneys`
--
DROP TABLE IF EXISTS `usermoneys`;
CREATE TABLE `usermoneys` (
  `money_id` int(10) unsigned NOT NULL auto_increment,
  `money_user` int(10) unsigned NOT NULL COMMENT '用户ID，对应users表的user_id字段',
  `money_reason` tinyint(3) unsigned NOT NULL COMMENT '余额变更原因，1是订单支付时使用余额，2是账户充值得到的余额，3是订单退款到余额，4是管理员在后台修改余额',
  `money_num` decimal(9, 2) NOT NULL default 0 COMMENT '当次变更的余额数量',
  `money_change` enum('+','-') NOT NULL COMMENT '余额变更类型，+代表增加余额，-代表减少余额',
  `money_order` varchar(20) NOT NULL default '' COMMENT '订单号，关联purchases表的purchase_num字段',
  `money_date` datetime NOT NULL COMMENT '余额变更日期',
  PRIMARY KEY (`money_id`),
  INDEX `index_money_user` (`money_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户余额变更流程表';

-- --------------------------------------------------------

--
-- 表的结构 `categories`
--
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `category_id` smallint(5) unsigned NOT NULL auto_increment,
  `category_name` varchar(20) NOT NULL COMMENT '分类名',
  `category_description` varchar(300) NOT NULL COMMENT '分类描述',
  `category_status` tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT '分类状态，1是正常，2是停用',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='爬虫分类表';

-- --------------------------------------------------------

--
-- 表的结构 `crawlers`
--
DROP TABLE IF EXISTS `crawlers`;
CREATE TABLE `crawlers` (
  `crawler_id` int(10) unsigned NOT NULL auto_increment,
  `crawler_code` varchar(20) NOT NULL COMMENT '爬虫代号，举例tmall',
  `crawler_name` varchar(20) NOT NULL COMMENT '爬虫名称',
  `crawler_description` varchar(300) NOT NULL COMMENT '爬虫简介',
  `crawler_entry` varchar(50) NOT NULL COMMENT '爬虫入口网址',
  `crawler_status` tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT '爬虫状态，1是停止，2是启动',
  `crawler_purchase` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '爬虫购买人数',
  `crawler_allowbuy` tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT '是否允许购买，1是不允许，2是允许，当爬虫允许购买时则自动上架到market中',
  `crawler_price` decimal(9, 2) NOT NULL default 0 COMMENT '爬虫金额',
  `crawler_cluster` int(10) unsigned NOT NULL DEFAULT 1 COMMENT '所属集群，关联clusters表cluster_id字段',
  `crawler_user` int(10) unsigned NOT NULL DEFAULT 1 COMMENT '发布用户，关联users表user_id字段',
  `crawler_category` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '爬虫类别，关联categories表category_id字段',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`crawler_id`),
  INDEX `index_crawler_cluster` (`crawler_cluster`),
  UNIQUE KEY `index_crawler_code` (`crawler_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='爬虫表';

-- --------------------------------------------------------

--
-- 表的结构 `components`
--
DROP TABLE IF EXISTS `components`;
CREATE TABLE `components` (
  `component_id` int(10) unsigned NOT NULL auto_increment,
  `component_code` varchar(20) NOT NULL COMMENT '组件代号，例如detail',
  `component_fullcode` varchar(50) NOT NULL COMMENT '组件全称，与所属爬虫代号crawler_code和组件代号component_code一起组成具体执行组件，例如tmalldetail',
  `component_cluster` varchar(10) NOT NULL COMMENT '组件运行集群代号，关联clusters表cluster_code字段',
  `component_output` varchar(50) NOT NULL COMMENT '组件运行结果输出表名，根据组件code自动生成',
  `component_order` tinyint(3) unsigned NOT NULL COMMENT '组件执行顺序',
  `component_crawler` int(10) unsigned NOT NULL COMMENT '组件所属爬虫ID，关联crawlers表的crawler_id字段',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`component_id`),
  INDEX `index_component_crawler` (`component_crawler`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='爬虫组件表';

-- --------------------------------------------------------

--
-- 表的结构 `runs`
--
DROP TABLE IF EXISTS `runs`;
CREATE TABLE `runs` (
  `run_id` int(10) unsigned NOT NULL auto_increment,
  `run_code` varchar(20) NOT NULL COMMENT '运行代号',
  `run_start` datetime NOT NULL COMMENT '运行开始时间',
  `run_end` datetime NOT NULL COMMENT '运行结束时间',
  `run_status` tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT '运行状态，1是运行中，2是运行结束成功，3是手动停止结束，4是异常停止结束，5是暂停中',
  `run_crawler` int(10) unsigned NOT NULL COMMENT '爬虫ID，关联crawlers表的crawler_id字段',
  `run_user` int(10) unsigned NOT NULL DEFAULT 1 COMMENT '运行用户，关联users表user_id字段',
  PRIMARY KEY (`run_id`),
  INDEX `index_run_crawler` (`run_crawler`),
  UNIQUE KEY `index_run_code` (`run_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='爬虫运行记录表';

-- --------------------------------------------------------

--
-- 表的结构 `clusters`
--
DROP TABLE IF EXISTS `clusters`;
CREATE TABLE `clusters` (
  `cluster_id` int(10) unsigned NOT NULL auto_increment,
  `cluster_code` varchar(10) NOT NULL COMMENT '集群代号，由系统自动生成唯一值',
  `cluster_name` varchar(20) NOT NULL COMMENT '集群名称',
  `cluster_description` varchar(300) NOT NULL COMMENT '集群简介',
  `cluster_status` tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT '集群状态，1是可用，2是不可用',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cluster_id`),
  UNIQUE KEY `index_cluster_code` (`cluster_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='集群表';
INSERT INTO `clusters` VALUES (1,'default','默认集群','所有没有归属的机器都属于默认集群',1,now(),null);

-- --------------------------------------------------------

--
-- 表的结构 `workers`
--
DROP TABLE IF EXISTS `workers`;
CREATE TABLE `workers` (
  `worker_id` int(10) unsigned NOT NULL auto_increment,
  `worker_code` varchar(10) NOT NULL COMMENT '机器代号，由系统自动生成唯一值',
  `worker_name` varchar(20) NOT NULL COMMENT '机器名称，别名',
  `worker_status` tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT '机器状态，1是可用，2是不可用',
  `worker_cluster` int(10) unsigned NOT NULL DEFAULT 1 COMMENT '所属集群，关联clusters表cluster_id字段',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`worker_id`),
  UNIQUE KEY `index_worker_code` (`worker_code`),
  INDEX `index_worker_cluster` (`worker_cluster`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='worker表，又名客户端表';

-- --------------------------------------------------------

--
-- 表的结构 `notifies`
--
DROP TABLE IF EXISTS `notifies`;
CREATE TABLE `notifies` (
  `notify_id` int(10) unsigned NOT NULL auto_increment,
  `notify_content` varchar(500) NOT NULL COMMENT '通知内容',
  `notify_date` datetime NOT NULL COMMENT '通知日期',
  `notify_status` tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT '通知读取状态，1是未读，2是已读',
  `notify_user` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '接收通知用户，关联users表user_id字段',
  PRIMARY KEY (`notify_id`),
  INDEX `index_notify_user` (`notify_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='通知表';

-- --------------------------------------------------------

--
-- 表的结构 `purchases`
--
DROP TABLE IF EXISTS `purchases`;
CREATE TABLE `purchases` (
  `purchase_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `purchase_num` varchar(20) NOT NULL COMMENT '订单号',
  `purchase_name` varchar(10) NOT NULL COMMENT '联系人姓名',
  `purchase_phone` varchar(15) NOT NULL COMMENT '联系电话',
  `purchase_status` tinyint(3) unsigned NOT NULL default 1 COMMENT '订单状态，1是正常下单，2是正常完结，3是申请取消，4是取消完毕，5是申请退款，6是退款中，7是退款完毕，8是客服介入',
  `purchase_paystatus` tinyint(1) unsigned NOT NULL default 1 COMMENT '支付状态，1是未付款，2是已付款',
  `purchase_paydate` datetime NOT NULL COMMENT '付款时间',
  `purchase_invoice` tinyint(1) unsigned NOT NULL default 1 COMMENT '是否索取发票，1是不索取，2是索取',
  `purchase_refund` tinyint(1) unsigned NOT NULL default 1 COMMENT '退款方向，1是不退款，2是原路返回，3是退到余额',
  `purchase_date` datetime NOT NULL COMMENT '下单时间',
  `purchase_usepoint` int(10) unsigned NOT NULL default 0 COMMENT '订单使用了多少积分支付',
  `purchase_usemoney` decimal(9, 2) NOT NULL default 0 COMMENT '订单使用了多少余额支付',
  `purchase_price` decimal(9, 2) NOT NULL COMMENT '订单实际应支付的总金额',
  `purchase_user` int(10) unsigned NOT NULL COMMENT '下单用户，对应users表的user_id字段',
  `purchase_tranid` varchar(50) NOT NULL COMMENT '微信返回的微信与商户之间的订单ID',
  `purchase_refundno` varchar(50) NOT NULL default '' COMMENT '商户退款单号',
  `purchase_refundid` varchar(50) NOT NULL default '' COMMENT '微信退款单号',
  PRIMARY KEY (`purchase_id`),
  UNIQUE KEY `purchase_num` (`purchase_num`),
  INDEX `index_purchase_user` (`purchase_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='购买记录表';

-- --------------------------------------------------------

--
-- 表的结构 `purchase_status`
--
DROP TABLE IF EXISTS `purchase_status`;
CREATE TABLE `purchase_status` (
  `status_id` int(10) unsigned NOT NULL auto_increment,
  `status_order` varchar(20) NOT NULL COMMENT '订单号，关联purchases表的purchase_num字段',
  `status_user` int(10) unsigned NOT NULL default 0 COMMENT '改变状态的用户，对应user表的user_id字段',
  `status_number` tinyint(3) unsigned NOT NULL default 1 COMMENT '订单状态，详情见purchases表的purchase_status含义',
  `status_date` datetime NOT NULL COMMENT '状态变更时间',
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='购买记录状态改变流程表';

-- --------------------------------------------------------

--
-- 表的结构 `purchase_detail`
--
DROP TABLE IF EXISTS `purchase_detail`;
CREATE TABLE `purchase_detail` (
  `detail_id` int(10) unsigned NOT NULL auto_increment,
  `detail_order` varchar(20) NOT NULL COMMENT '订单号，关联purchases表的purchase_num字段',
  `detail_crawlerid` int(10) unsigned NOT NULL COMMENT '爬虫ID，关联crawlers表的crawler_id字段',
  `detail_crawlername` varchar(50) NOT NULL COMMENT '商品名称',
  `detail_crawlerprice` decimal(9, 2) NOT NULL COMMENT '商品价格',
  PRIMARY KEY (`detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='购买记录详情表';

-- --------------------------------------------------------

--
-- 表的结构 `comments`
--
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `comments_id` int(10) unsigned NOT NULL auto_increment,
  `comments_content` varchar(500) NOT NULL COMMENT '评论内容',
  `comments_publish` datetime NOT NULL COMMENT '评论发布日期',
  `comments_ip` int(10) unsigned NOT NULL COMMENT '评论者IP，0代表获取不到IP',
  `comments_status` tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT '评论审核状态，1是审核中，2是审核通过，3是审核拒绝',
  `comments_user` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '评论用户，关联users表user_id字段，若为0代表匿名用户评论',
  `comments_crawler` int(10) unsigned NOT NULL COMMENT '爬虫ID，关联crawlers表的crawler_id字段',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`comments_id`),
  INDEX `index_comments_crawler` (`comments_crawler`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='爬虫评论表';

