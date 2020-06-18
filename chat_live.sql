/*
Navicat MySQL Data Transfer

Source Server         : Titan
Source Server Version : 50721
Source Host           : 172.18.0.155:3306
Source Database       : chat_live

Target Server Type    : MYSQL
Target Server Version : 50721
File Encoding         : 65001

Date: 2020-06-18 14:53:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for chat_message
-- ----------------------------
DROP TABLE IF EXISTS `chat_message`;
CREATE TABLE `chat_message` (
  `chat_message_id` int(11) NOT NULL AUTO_INCREMENT,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`chat_message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of chat_message
-- ----------------------------
INSERT INTO `chat_message` VALUES ('1', '2', '1', '??', '2020-06-08 17:25:40', '0');
INSERT INTO `chat_message` VALUES ('2', '1', '2', '????', '2020-06-08 17:27:07', '0');
INSERT INTO `chat_message` VALUES ('3', '0', '1', '<p><img src=\"upload/driving-agv.jpg\" class=\"img-thumbnail\" width=\"200\" height=\"160\"></p><br>', '2020-06-08 17:31:05', '1');
INSERT INTO `chat_message` VALUES ('4', '2', '1', '2454', '2020-06-08 17:43:25', '0');
INSERT INTO `chat_message` VALUES ('5', '2', '1', '0...', '2020-06-08 17:57:05', '0');
INSERT INTO `chat_message` VALUES ('6', '3', '2', 'asdsadsasd', '2020-06-08 18:05:56', '0');
INSERT INTO `chat_message` VALUES ('7', '3', '2', '????', '2020-06-08 18:05:59', '0');
INSERT INTO `chat_message` VALUES ('8', '2', '3', '000', '2020-06-08 18:06:03', '2');
INSERT INTO `chat_message` VALUES ('9', '2', '1', 'dgsg', '2020-06-11 11:28:12', '1');
INSERT INTO `chat_message` VALUES ('10', '0', '1', '<p><img src=\"upload/driving-agv.jpg\" class=\"img-thumbnail\" width=\"200\" height=\"160\"></p><br>', '2020-06-11 11:28:19', '1');
INSERT INTO `chat_message` VALUES ('11', '1', '4', 'Hi', '2020-06-11 13:56:02', '0');
INSERT INTO `chat_message` VALUES ('12', '1', '4', '????????', '2020-06-11 13:56:20', '0');
INSERT INTO `chat_message` VALUES ('13', '1', '4', '?????????', '2020-06-11 13:56:35', '0');
INSERT INTO `chat_message` VALUES ('14', '4', '1', 'Hi as dsa', '2020-06-11 13:56:59', '0');
INSERT INTO `chat_message` VALUES ('15', '4', '1', '3232323', '2020-06-11 13:57:15', '0');
INSERT INTO `chat_message` VALUES ('16', '0', '1', '<p><img src=\"upload/robot_cyborg_binary_code_126175_1920x1080.jpg\" class=\"img-thumbnail\" width=\"200\" height=\"160\"></p><br>', '2020-06-12 15:27:48', '1');

-- ----------------------------
-- Table structure for login
-- ----------------------------
DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `st_user` int(2) NOT NULL DEFAULT '0',
  `display_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of login
-- ----------------------------
INSERT INTO `login` VALUES ('1', '10185', '1', '10185', '$2y$10$DEJMIgBD6b6ibcEvgwCcYeJao.EKgxgGC/mIbkJi9q27k2w24GfC6');
INSERT INTO `login` VALUES ('2', 'admin', '0', '?WHITE?', '$2y$10$LAMd5ofmwR0cDMk1qn3KBOeoCzpR.Uf9EJan3WlmiZIEpmy/PiXwi');
INSERT INTO `login` VALUES ('3', 'nonssk', '0', 'non', '$2y$10$fFsyDd3WkOdsH1n6h/RWp.CLFM7gmGA05no70YIVKGi.if9oXDxPG');
INSERT INTO `login` VALUES ('4', 'admin1', '0', 'ADMIN', '$2y$10$ZD3w2MlS0d62K.SmVZyFTeJEr5j97BzyMwbCqnFVULVBF4AVq8hp2');

-- ----------------------------
-- Table structure for login_details
-- ----------------------------
DROP TABLE IF EXISTS `login_details`;
CREATE TABLE `login_details` (
  `login_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_type` enum('no','yes') CHARACTER SET utf8 NOT NULL DEFAULT 'no',
  PRIMARY KEY (`login_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of login_details
-- ----------------------------
INSERT INTO `login_details` VALUES ('1', '1', '2020-06-08 17:21:00', 'no');
INSERT INTO `login_details` VALUES ('2', '2', '2020-06-08 17:26:05', 'no');
INSERT INTO `login_details` VALUES ('3', '1', '2020-06-08 17:30:06', 'no');
INSERT INTO `login_details` VALUES ('4', '2', '2020-06-08 18:16:19', 'no');
INSERT INTO `login_details` VALUES ('5', '1', '2020-06-08 17:38:24', 'no');
INSERT INTO `login_details` VALUES ('6', '1', '2020-06-08 17:55:53', 'yes');
INSERT INTO `login_details` VALUES ('7', '1', '2020-06-08 17:57:09', 'no');
INSERT INTO `login_details` VALUES ('8', '1', '2020-06-08 17:58:15', 'no');
INSERT INTO `login_details` VALUES ('9', '1', '2020-06-08 18:06:19', 'no');
INSERT INTO `login_details` VALUES ('10', '3', '2020-06-08 18:08:22', 'no');
INSERT INTO `login_details` VALUES ('11', '1', '2020-06-08 21:18:25', 'no');
INSERT INTO `login_details` VALUES ('12', '1', '2020-06-09 15:56:07', 'no');
INSERT INTO `login_details` VALUES ('13', '1', '2020-06-12 00:41:10', 'no');
INSERT INTO `login_details` VALUES ('14', '4', '2020-06-12 09:32:56', 'no');
INSERT INTO `login_details` VALUES ('15', '1', '2020-06-12 15:37:58', 'no');
