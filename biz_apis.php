<?php

/**
 * 商业数据接口 SDK for PHP
 *
 * 错误代码说明: http://open.weibo.com/wiki/Error_code
 *
 * author liuhui9<liuhui9@staff.sina.com.cn>
 * @version 16/3/17
 * @copyright copyright(2016) weibo.com all rights reserved
 */


class biz_apis
{
    const C_API_2_URL = 'https://c.api.weibo.com/2/';
    const C_API_1_URL = 'https://c.api.weibo.com/';//订阅接口还未切换过来

    public function __construct($appkey, $appsecret, $token)
    {
        $this->oauth = new SaeTOAuthV2($appkey, $appsecret, $token);
        $this->oauth->host = self::C_API_2_URL;
    }

    public function set_debug($bool = false){
        return $this->oauth->debug = $bool;
    }

    /*搜索最近数据（收费）*/
    /**
     * 搜索含某关键词的微博 。
     *
     * @pamram  string  q            搜索的关键字( 不能包含{、}、“ 等特殊字符)。必须进行URLencode。
     * @pamram  string  ids            搜索指定批量用户的微博，传用户UID，多个用~分隔，最多不超过50个。
     * @pamram  int     province    搜索的省份ID，参考省份城市编码表，参数q为空表示搜索这个省份的所有微博。
     * @pamram  int     city        搜索的城市ID，参考省份城市编码表，参数q为空表示搜索这个城市的所有微博。
     * @pamram  string  sort        排序方式，time：时间倒序、hot：热门度、fwnum：按转发数倒序、cmtnum：评论数倒序，默认为time。
     * @pamram  int     starttime    搜索范围起始时间，取值为时间戳，单位为秒。
     * @pamram  int     endtime        搜索范围结束时间，取值为时间戳，单位为秒。
     * @pamram  int     hasori        是否包含原创，0：不包含原创、1：只包含原创，默认为空（全部）。
     * @pamram  int     hasret        是否包含转发，0：不包含转发、1：只包含转发，默认为空（全部）。
     * @pamram  int     hastext        是否包含纯文本，0：不包含纯文本、1：只包含纯文本，默认为空（全部）。
     * @pamram  int     haspic        是否包含图片，0：不包含图片、1：只包含图片，默认为空（全部）。
     * @pamram  int     hasvideo    是否包含视频，0：不包含视频、1：只包含视频，默认为空（全部）。
     * @pamram  int     hasmusic    是否包含音乐，0：不包含音乐、1：只包含音乐，默认为空（全部）。
     * @pamram  int     haslink        是否包含链接，0：不包含链接、1：只包含链接，默认为空（全部）。
     * @pamram  int     hasat        是否包含@，0：不包含@、1：只包含@，默认为空（全部）。
     * @pamram  int     hasv        是否为v用户发言，0：否、1：是，默认为空（全部）。
     * @pamram  int     istag        是否严格为搜##内的话题，0：否、1：##内模糊匹配、2：##内精确匹配，默认为0。
     * @pamram  int     onlynum        是否只返回总数，0：否、1：是，默认为0。
     * @pamram  int     dup         是否排重（不显示相似数据），0：否、1：是，默认为1。
     * @pamram  int     antispam    是否反垃圾（不显示低质量数据），0：否、1：是，默认为1。
     * @pamram  int     page        页码，默认为1。
     * @pamram  int     count        每页返回的数量，默认10，最大50。（默认返回10条）
     * @pamram  int     base_app    是否只获取当前应用的数据。0为否（所有数据），1为是（仅当前应用），默认为0。
     *
     *
     *
     *
     *
     * wiki:http://open.weibo.com/wiki/C/2/search/statuses/limited
     * */
    public function search_statuses_limited($q, $ids = false, $province = false, $city = false, $sort = 'time', $starttime = false, $endtime = false,
                                            $hasori = '', $hasret = '', $hastext = '', $haspic = '', $hasvideo = '', $hasmusic = '',
                                            $haslink = '', $hasat = '', $hasv = '', $istag = 0, $onlynum = 0, $dup = 1, $antispam = 1,
                                            $page = 1, $count = 10, $base_app = 0)
    {
        $params = array(
            'q'         => $q,
            'ids'       => $ids,
            'province'  => $province,
            'city'      => $city,
            'sort'      => $sort,
            'starttime' => $starttime,
            'endtime'   => $endtime,
            'hasori'    => $hasori,
            'hasret'    => $hasret,
            'hastext'   => $hastext,
            'haspic'    => $haspic,
            'hasvideo'  => $hasvideo,
            'hasmusic'  => $hasmusic,
            'haslink'   => $haslink,
            'hasat'     => $hasat,
            'hasv'      => $hasv,
            'istag'     => $istag,
            'onlynum'   => $onlynum,
            'dup'       => $dup,
            'antispam'  => $antispam,
            'page'      => $page,
            'count'     => $count,
            'base_app'  => $base_app,
        );
        $params = $this->rid_false_for_array($params);
        //print_r($params);
        //die;

        $ret = $this->oauth->get('search/statuses/limited', $params);
        return $ret;
    }

    /*搜索最近数据（收费）*/


    /*微博内容数据（收费）*/
    /**
     * 返回一条微博的全部转发微博列表。
     *
     * @param int $id 需要查询的微博ID。
     * @param int $count 单页返回的记录条数，最大不超过200，默认为20。
     * @param int $page 返回结果的页码，默认为1。
     * @param int $filter_by_author 作者筛选类型，0：全部、1：我关注的人、2：陌生人，默认为0。
     * @return mixed
     *
     * wiki:http://open.weibo.com/wiki/C/2/statuses/repost_timeline/all
     * */
    public function statuses_repost_timeline_all($id, $count = 20, $page = 1, $filter_by_author = 0)
    {

        $params = array(
            'id'               => $id,
            'count'            => $count,
            'page'             => $page,
            'filter_by_author' => $filter_by_author,
        );

        $ret = $this->oauth->get('statuses/repost_timeline/all', $params);
        return $ret;
    }

    /**
     * 批量获取用户个人微博列表。
     * wiki:http://open.weibo.com/wiki/C/2/statuses/user_timeline_batch
     * */
    public function statuses_user_timeline_batch($uids, $count = 20, $page = 1, $flag = 0, $base_app = 0, $feature = 0)
    {
        $params = array(
            'uids'     => $uids,
            'count'    => $count,
            'page'     => $page,
            'flag'     => $flag,
            'base_app' => $base_app,
            'feature'  => $feature,
        );
        $params = $this->rid_false_for_array($params);
        $ret = $this->oauth->get('statuses/user_timeline_batch', $params);
        return $ret;
    }

    /**
     * 获取@某人的微博。
     * http://open.weibo.com/wiki/C/2/statuses/mentions/other
     *
     * */
    public function statuses_mentions_other($uid, $since_id = 0, $max_id = 0, $count = 20, $page = 1, $filter_by_author = 0, $filter_by_source = 0, $filter_by_type = 0)
    {
        $params = array(
            'uid'              => $uid,
            'since_id'         => $since_id,
            'max_id'           => $max_id,
            'count'            => $count,
            'page'             => $page,
            'filter_by_author' => $filter_by_author,
            'filter_by_source' => $filter_by_source,
            'filter_by_type'   => $filter_by_type,
        );

        $ret = $this->oauth->get('statuses/mentions/other', $params);
        return $ret;
    }

    /**
     * 获取某个用户的位置动态。
     *
     * wiki:http://open.weibo.com/wiki/C/2/place/user_timeline/other
     * */
    public function place_user_timeline_other($uid, $since_id = 0, $max_id = 0, $count = 20, $page = 1, $base_app = 0)
    {
        $params = array(
            'uid'      => $uid,
            'since_id' => $since_id,
            'max_id'   => $max_id,
            'count'    => $count,
            'page'     => $page,
            'base_app' => $base_app,
        );
        $ret = $this->oauth->get('place/user_timeline/other', $params);
        return $ret;
    }

    /**
     *
     * 返回一条微博的全部评论列表。
     * wiki:http://open.weibo.com/wiki/C/2/comments/show/all
     * */
    public function comments_show_all($id, $count = 50, $page = 1, $filter_by_author = 0)
    {
        $params = array(
            'id'               => $id,
            'count'            => $count,
            'page'             => $page,
            'filter_by_author' => $filter_by_author,
        );
        $ret = $this->oauth->get('comments/show/all', $params);
        return $ret;
    }

    /**
     * 获取某个用户发出的评论列表
     * wiki:http://open.weibo.com/wiki/C/2/comments/by_me/other
     * */
    public function comments_by_me_other($uid, $since_id = 0, $max_id = 0, $count = 50, $page = 1, $filter_by_type = 0)
    {
        $params = array(
            'uid'            => $uid,
            'since_id'       => $since_id,
            'max_id'         => $max_id,
            'count'          => $count,
            'page'           => $page,
            'filter_by_type' => $filter_by_type,
        );
        $ret = $this->oauth->get('comments/by_me/other', $params);
        return $ret;
    }

    /**
     * 获取某个用户收到的评论列表
     * wiki:http://open.weibo.com/wiki/C/2/comments/to_me/other
     *
     * */
    public function comments_to_me_other($uid, $since_id = 0, $max_id = 0, $count = 50, $page = 1, $filter_by_author = 0, $filter_by_source = 0)
    {
        $params = array(
            'uid'              => $uid,
            'since_id'         => $since_id,
            'max_id'           => $max_id,
            'count'            => $count,
            'page'             => $page,
            'filter_by_author' => $filter_by_author,
            'filter_by_source' => $filter_by_source,
        );
        $ret = $this->oauth->get('comments/to_me/other', $params);
        return $ret;
    }

    /**
     * 获取某个用户发出和收到的评论列表
     * wiki:http://open.weibo.com/wiki/C/2/comments/timeline/other
     * */
    public function comments_timeline_other($uid, $since_id = 0, $max_id = 0, $count = 50, $page = 1, $trim_user = 0)
    {
        $params = array(
            'uid'       => $uid,
            'since_id'  => $since_id,
            'max_id'    => $max_id,
            'count'     => $count,
            'page'      => $page,
            'trim_user' => $trim_user,
        );
        $ret = $this->oauth->get('comments/timeline/other', $params);
        return $ret;
    }

    /**
     * 获取@某人的评论
     * wiki:http://open.weibo.com/wiki/C/2/comments/mentions/other
     * */
    public function comments_mentions_other($uid, $since_id = 0, $max_id = 0, $count = 50, $page = 1, $filter_by_author = 0, $filter_by_source = 0)
    {
        $params = array(
            'uid'              => $uid,
            'since_id'         => $since_id,
            'max_id'           => $max_id,
            'count'            => $count,
            'page'             => $page,
            'filter_by_author' => $filter_by_author,
            'filter_by_source' => $filter_by_source,
        );
        $ret = $this->oauth->get('comments/mentions/other', $params);
        return $ret;
    }


    /*微博内容数据（收费）*/


    /*检索历史全量数据（收费）*/

    /**
     * 创建检索历史数据任务。
     * wiki:http://open.weibo.com/wiki/C/2/search/statuses/historical/create
     * */
    public function search_statuses_historical_create($q, $ids = false, $province = false, $city = false, $starttime = false, $endtime = false, $type = false, $hasv = false, $onlynum = 100)
    {
        $params = array(
            'q'         => $q,
            'ids'       => $ids,
            'province'  => $province,
            'city'      => $city,
            'starttime' => $starttime,
            'endtime'   => $endtime,
            'type'      => $type,
            'hasv'      => $hasv,
            'onlynum'   => $onlynum,
        );
        $params = $this->rid_false_for_array($params);
        $ret = $this->oauth->post('search/statuses/historical/create', $params);
        return $ret;
    }

    /**
     * 查看检索历史数据任务的执行状态。
     * wiki:http://open.weibo.com/wiki/C/2/search/statuses/historical/check
     *
     *
     * @param int $id 创建任务者的ID, 类似APPKEY
     * @param string $secret_key 创建后返回的字段 secret_key
     * @return array
     * status 任务执行状态，true:完成，false:执行中
     * count 任务结果条数，当status为false时，该字段返回0
     * */
    public function search_statuses_historical_check($id, $task_id, $timestamp, $secret_key)
    {
        //认证签名。
        //加密方式为signature = md5(id + secret_key + timestamp)。id为任务创建者ID，id,secret_key平台方通过task_id得到。
        $signature = md5($id . $secret_key . $timestamp);
        $params = array(
            'task_id'   => $task_id,
            'timestamp' => $timestamp,
            'signature' => $signature,
        );
        $ret = $this->oauth->get('search/statuses/historical/check', $params);
        return $ret;
    }
    
    /**
     * 下载任务执行后的结果数据
     * wiki:http://open.weibo.com/wiki/C/2/search/statuses/historical/download
     * */
    public function search_statuses_historical_download($id, $task_id, $timestamp, $secret_key)
    {
        //认证签名。
        //加密方式为signature = md5(id + secret_key + timestamp)。id为任务创建者ID，id,secret_key平台方通过task_id得到。
        $signature = md5($id . $secret_key . $timestamp);
        $params = array(
            'task_id'   => $task_id,
            'timestamp' => $timestamp,
            'signature' => $signature,
        );
        $ret = $this->oauth->get('search/statuses/historical/download', $params);
        return $ret;

    }
    /*检索历史全量数据（收费）*/

    /*微博用户数据（免费）*/
    /**
     * 批量获取其他用户的基本信息。
     *
     * @param string $uids 需要查询的用户ID，用半角逗号分隔，一次最多50个。
     * @return array
     * wiki: http://open.weibo.com/wiki/C/2/users/show_batch/other
     * */
    public function users_show_batch_other($source, $access_token, $uids)
    {
        $params = array(
            'source' => $source,
            'access_token' => $access_token,
            'uids' => $uids
        );
        $ret = $this->oauth->get('users/show_batch/other', $params);
        return $ret;

    }

    /**
     * 批量获取用户标签。
     *
     * @param string $uids 需要查询的用户ID，用半角逗号分隔，一次最多50个。
     * @return array
     * wiki: http://open.weibo.com/wiki/C/2/tags/tags_batch/other
     * */
    public function tags_tags_batch_other($source, $access_token, $uids)
    {
        $params = array(
            'source' => $source,
            'access_token' => $access_token,
            'uids' => $uids
        );
        $ret = $this->oauth->get('tags/tags_batch/other', $params);
        return $ret;

    }

    /*微博用户数据（免费）*/

    /**
     * 上传图片并发布一条微博。
     * wiki:http://open.weibo.com/wiki/C/2/statuses/upload/biz
     * */
    public function statuses_upload_biz($status, $pic, $visible = 0, $list_id = false, $lat = 0.0, $long = 0.0,
                                        $annotations = false, $rip = false)
    {
        $params = array(
            'status'      => $status,
            'visible'     => $visible,
            'list_id'     => $list_id,
            'pic'         => '@' . $pic,
            'lat'         => $lat,
            'long'        => $long,
            'annotations' => $annotations,
            'rip'         => $rip,
        );

        $params = $this->rid_false_for_array($params);
        $ret = $this->oauth->post('statuses/upload/biz', $params, true);
        return $ret;
    }

    /*订阅服务（收费）*/

    /**
     * 订阅关键词、用户。
     *
     * wiki:http://open.weibo.com/wiki/C/2/subscribe/update_subscribe
     * @param string $add_blocked_uids 需要屏蔽的 uids ,默认不自动开启,通知审核人员开启
     * */
    public function subscribe_update_subscribe($subid, $source, $access_token = false, $add_keywords = false, $del_keywords = false,
                                               $add_uids = false, $del_uids = false, $add_blocked_uids = false, $del_blocked_uids = false, $_version=1)
    {
        $params = array(
            'source' => $source,
            'access_token' => $access_token,
            'subid' =>  $subid,
            'add_keywords'  => $add_keywords,
            'del_keywords'  => $del_keywords,
            'add_uids' =>  $add_uids,
            'del_uids' =>  $del_uids,
            'add_blocked_uids' => $add_blocked_uids,//屏蔽 uid
            'del_blocked_uids' => $del_blocked_uids,
        );
        $this->oauth->host = ($_version == 1)
            ?   self::C_API_1_URL  :   self::C_API_2_URL;
        $params = $this->rid_false_for_array($params);
        $ret = $this->oauth->post('subscribe/update_subscribe', $params, true);
        return $ret;
    }

    /**
     * 查看订阅信息
     * //todo 网络问题,没走通
     * */
    public function subscribe_get_subscribe($subid){
        $params = array(
            'subid' => $subid,
        );
        $this->oauth->debug = true;
        $this->oauth->host = 'http://i.open.t.sina.com.cn/';
        $this->oauth->format = 'php';
        $ret = $this->oauth->get('subscribe/get_subscribe', $params);
        return $ret;

    }
    /**
     * 进行连接，接收微博数据。
     *
     * @param int $_version 暂时只支持c.api.weibo.com
     * wiki:http://open.weibo.com/wiki/C/2/datapush/status
     * */
    public function datapush_status($subid, $source = false, $since_id = false, $_version=1)
    {
        $params = array(
            'subid' =>  $subid,
            'source' => $source,
            'since_id'  => $since_id,
        );
        $this->oauth->host = ($_version == 1)
            ?   'http://c.api.weibo.com/'  :   self::C_API_2_URL;
        $params = $this->rid_false_for_array($params);
        $url = $this->oauth->host.'datapush/status';

        include_once 'biz_subscribe.php';
        $sub_obj = new biz_subscribe();

        $ret = $sub_obj->push_method($url, $params);

        //debug code
//        require_once 'libs/httpWrap.php';
//        $obj = new HttpWrap();
//        $params = http_build_query($params);
//        $url .= '?'.$params;
//        $ret = $obj->init($url);


        //var_dump($ret);
        //return $ret;
    }

    /*订阅服务（收费）*/


    /**
     * 将数组中 false 字段删除
     * */
    private function rid_false_for_array($arr)
    {
        foreach ($arr as $k => $v) {
            if ($v === false || $v === null) {
                unset($arr[ $k ]);
            }
        }
        return $arr;
    }
}
