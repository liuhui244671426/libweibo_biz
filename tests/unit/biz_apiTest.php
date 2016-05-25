<?php
//cmd : codecept run unit biz_apiTest:method --debug

class biz_apiTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    protected $biz_object;
    protected $weibo_uids;

    protected function _before()
    {
        $this->biz_object = new biz_apis(APPKEY, APPSECRET, TOKEN);
        $this->weibo_uids = '1748248662';
    }

    protected function _after()
    {
    }

    public function test__search_statuses_limited()
    {
        $keyword = '科比';
        $ret = $this->biz_object->search_statuses_limited($keyword);
        $this->assertArrayHasKey('statuses', $ret);
        $this->assertArrayHasKey('total_number', $ret);
        $this->assertCount(10, $ret['statuses']);
        $this->assertInternalType('int', $ret['total_number']);
        codecept_debug($ret);
    }

    public function test__statuses_repost_timeline_all()
    {
        $weibo_id = '3978593266160955';
        $ret = $this->biz_object->statuses_repost_timeline_all($weibo_id, 2, 1);
        $this->assertArrayHasKey('reposts', $ret);
        $this->assertArrayHasKey('total_number', $ret);
        $this->assertInternalType('int', $ret['total_number']);

        codecept_debug($ret);
    }

    public function test__statuses_user_timeline_batch()
    {
        $ret = $this->biz_object->statuses_user_timeline_batch($this->weibo_uids, 2);
        $this->assertArrayHasKey('statuses', $ret);
        $this->assertArrayHasKey('total_number', $ret);


        $this->assertInternalType('array', $ret['statuses']);
        $this->assertInternalType('int', $ret['total_number']);
        codecept_debug($ret);
    }


    public function test__statuses_mentions_other()
    {
        $ret = $this->biz_object->statuses_mentions_other($this->weibo_uids, 0, 0, 2);

        $this->assertArrayHasKey('statuses', $ret);
        $this->assertArrayHasKey('total_number', $ret);
        $this->assertArrayHasKey('next_cursor', $ret);
        $this->assertArrayHasKey('previous_cursor', $ret);
        $this->assertCount(2, $ret['statuses']);
        $this->assertInternalType('int', $ret['total_number']);
        $this->assertEquals(0, $ret['next_cursor']);//暂未支持
        $this->assertEquals(0, $ret['previous_cursor']);//暂未支持

        codecept_debug($ret);
    }

    public function test__place_user_timeline_other()
    {
        $ret = $this->biz_object->place_user_timeline_other($this->weibo_uids, 0, 0, 2);
        $this->assertArrayHasKey('statuses', $ret);
        $this->assertArrayHasKey('total_number', $ret);
        $this->assertArrayHasKey('states', $ret);
        $this->assertInternalType('array', $ret['statuses']);
        $this->assertInternalType('array', $ret['states']);
        $this->assertNotEmpty($ret['statuses']);

        codecept_debug($ret);
    }

    public function test__comments_show_all()
    {
        $weibo_id = '3978593266160955';
        $ret = $this->biz_object->comments_show_all($weibo_id, 5);
        $this->assertArrayHasKey('comments', $ret);
        $this->assertArrayHasKey('total_number', $ret);
        $this->assertArrayHasKey('marks', $ret);
        $this->assertInternalType('array', $ret['comments']);
        $this->assertInternalType('int', $ret['total_number']);

        codecept_debug($ret);
    }

    public function test__comments_by_me_other()
    {
        $ret = $this->biz_object->comments_by_me_other($this->weibo_uids, 0, 0, 2);
        $this->assertArrayHasKey('comments', $ret);
        $this->assertArrayHasKey('total_number', $ret);
        $this->assertInternalType('array', $ret['comments']);
        $this->assertInternalType('int', $ret['total_number']);

        codecept_debug($ret);
    }

    public function test__comments_timeline_other()
    {
        $ret = $this->biz_object->comments_timeline_other($this->weibo_uids, 0, 0, 2);
        $this->assertArrayHasKey('comments', $ret);
        $this->assertArrayHasKey('total_number', $ret);
        $this->assertInternalType('array', $ret['comments']);
        $this->assertInternalType('int', $ret['total_number']);
        $this->assertEquals($this->weibo_uids, $ret['comments'][0]['user']['id']);

        codecept_debug($ret);
    }

    public function test__comments_mentions_other()
    {
        $ret = $this->biz_object->comments_mentions_other($this->weibo_uids, 0, 0, 2);
        $this->assertArrayHasKey('comments', $ret);
        $this->assertArrayHasKey('total_number', $ret);
        $this->assertInternalType('array', $ret['comments']);
        $this->assertInternalType('int', $ret['total_number']);

        codecept_debug($ret);
    }

    /*public function test__search_statuses_historical()
    {
        $stime = strtotime('2016-04-20 00:00:00') . '000';
        $etime = strtotime('2016-04-21 00:00:00') . '000';
        $q = '科比';
        $ret = $this->biz_object->search_statuses_historical_create($q, $stime, $etime);
        codecept_debug($ret);

        $this->assertArrayHasKey('id', $ret);
        $this->assertArrayHasKey('task_id', $ret);
        $this->assertArrayHasKey('secret_key', $ret);
        $this->assertArrayHasKey('starttime', $ret);
        $this->assertArrayHasKey('endtime', $ret);
        $this->assertInternalType('int', $ret['id']);
        $this->assertInternalType('int', $ret['task_id']);
        $this->assertInternalType('string', $ret['secret_key']);
        $this->assertEquals($stime, $ret['starttime']);
        $this->assertEquals($etime, $ret['endtime']);
        $this->assertEquals($q, $ret['q']);

        $now = time();
        $ret1 = $this->biz_object->search_statuses_historical_check($ret['id'], $ret['task_id'], $now, $ret['secret_key']);

        codecept_debug($ret1);
    }*/

    public function test__users_show_batch_other()
    {
        $ret = $this->biz_object->users_show_batch_other($this->weibo_uids);
        $this->assertArrayHasKey('users', $ret);
        $this->assertArrayHasKey('total_number', $ret);
        $this->assertInternalType('array', $ret['users']);
        $this->assertInternalType('int', $ret['total_number']);

        codecept_debug($ret);
    }

    public function test__tags_tags_batch_other()
    {
        $ret = $this->biz_object->tags_tags_batch_other($this->weibo_uids);
        $this->assertInternalType('array', $ret);
        $this->assertArrayHasKey('id', $ret[0]);
        $this->assertArrayHasKey('tags', $ret[0]);

        codecept_debug($ret);
    }

    public function test__users_counts_batch_other()
    {
        $ret = $this->biz_object->users_counts_batch_other($this->weibo_uids);
        $this->assertArrayHasKey('id', $ret[0]);
        $this->assertArrayHasKey('followers_count', $ret[0]);
        $this->assertArrayHasKey('friends_count', $ret[0]);
        $this->assertArrayHasKey('statuses_count', $ret[0]);
        $this->assertArrayHasKey('private_friends_count', $ret[0]);
        $this->assertArrayHasKey('pagefriends_count', $ret[0]);

        codecept_debug($ret);
    }


    public function test__subscribe_update_subscribe()
    {
        $ret = $this->biz_object->subscribe_update_subscribe(SUBID);
        $this->assertArrayHasKey('appkey', $ret);
        $this->assertArrayHasKey('subid', $ret);
        $this->assertArrayHasKey('subname', $ret);
        $this->assertArrayHasKey('ip', $ret);
        $this->assertArrayHasKey('filters', $ret);
        $this->assertArrayHasKey('strategy', $ret);
        $this->assertArrayHasKey('delay_minute', $ret);
        $this->assertArrayHasKey('userfilter', $ret['filters']);
        $this->assertArrayHasKey('userblockfilter', $ret['filters']);
        $this->assertArrayHasKey('domainfilter', $ret['filters']);
        $this->assertArrayHasKey('mediafilter', $ret['filters']);
        $this->assertArrayHasKey('keywordfilter', $ret['filters']);
        $this->assertArrayHasKey('appfilter', $ret['filters']);
        $this->assertArrayHasKey('datafilter', $ret['filters']);

        codecept_debug($ret);
    }
}