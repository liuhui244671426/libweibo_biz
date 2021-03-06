<?php
/**
 * 测试
 *
 * author liuhui9<liuhui9@staff.sina.com.cn>
 * @version 16/3/22
 * @copyright copyright(2016) weibo.com all rights reserved
 */
define('CURRENT_PATH', realpath(__DIR__ . '/'));

require_once CURRENT_PATH . '/../vendor/autoload.php';
require_once CURRENT_PATH . '/../biz_apis.php';
require_once CURRENT_PATH . '/./config.php';

ini_set('date.timezone','Asia/Shanghai');
set_time_limit(0);



$object = new biz_apis(APPKEY, APPSECRET, TOKEN);
$keyword = urlencode('php');
$weiboID = '3953931363797697';
$uid = 1748248662;
$uid1 = 1571420880;//猪头哥哥
$stime = strtotime('2012-03-21 00:00:00').'000';
$etime = strtotime('2012-03-22 00:00:00').'000';
//任务参数
$taskID = 12476150;
$secret_key = 'e71b4cf96b5d5ae0f2b8';
//订阅服务
$sub_keywords = '阿里巴巴,楼市,股市';
$sub_uids = '';

//$object->oauth->debug=true;
//ok
//$ret = $object->search_statuses_limited($keyword);
//ok
//$ret = $object->statuses_repost_timeline_all($weiboID);
//还有点问题,无返回值
//无返回值的问题已经查明, 是命令行的 php curl 出现 SSLRead() return error -9806 的错误,如何修复还待确认
//$ret = $object->statuses_upload_biz('我是测试1234', 'f.jpeg');
//ok
//$ret = $object->statuses_mentions_other($uid);
//ok
//$ret = $object->statuses_user_timeline_batch($uid);
//ok
//$ret = $object->place_user_timeline_other($uid);
//ok
//$ret = $object->comments_show_all($weiboID);
//ok
//$ret = $object->comments_by_me_other($uid);
//ok
//$ret = $object->comments_to_me_other($uid);
//ok
//$ret = $object->comments_timeline_other($uid);
//ok
//$ret = $object->comments_mentions_other($uid);
//ok
//$ret = $object->search_statuses_historical_create($keyword, false,false,false,$stime,$etime);
//ok
//$ret = $object->search_statuses_historical_check(3047579336, $taskID, time(), $secret_key);
//
//$ret = $object->search_statuses_historical_download(3047579336, $taskID, time(), $secret_key);

//ok
//$ret = $object->subscribe_update_subscribe(SUBID, false, false, false, false, '5674554136');
//$ret = $object->subscribe_update_subscribe(SUBID);
//$ret = $object->subscribe_update_subscribe(SUBID,'魏则西');
//$ret = $object->subscribe_get_subscribe(SUBID);

//$ret = $object->datapush_status(SUBID);
//$ret = $object->datapush_comment(SUBID);

//ok
//$ret = $object->users_show_batch_other($uid1);
//ok
//$ret = $object->tags_tags_batch_other($uid);
//ok
//$ret = $object->users_counts_batch_other($uid1);
//ok
//$ret = $object->statuses_public_timeline_biz(1);

//$ret = $object->comments_mentions_biz();
$ret = $object->attitudes_to_me_biz();
var_dump($ret);
//print_r($ret);

die;
