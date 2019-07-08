<?php

namespace app\admin\logic;

/**
 *  积分逻辑
 */
class Score extends AdminBase
{

    /**
     * 获取积分列表信息
     */

    public function getScoreList($where = [], $field = 's.*,u.phone,u.photo,u.name,t.title,t.type as ta_type,t.status as t_status,t.tasktype,m.nickname', $order = '', $paginate = DB_LIST_ROWS)
    {
        $this->modelScore -> alias('s');

        $join = [
            [SYS_DB_PREFIX . 'user u', 's.userid = u.userid', 'LEFT'],
            [SYS_DB_PREFIX . 'task t', 's.pid = t.id', 'LEFT'],
            [SYS_DB_PREFIX . 'member m', 't.member_id = m.id', 'LEFT'],

        ];

        $this->modelScore->join = $join;

        $list = $this->modelScore->getList($where,$field,$order,$paginate);
        return $list;
    }

    /**
     * 获取用户积分搜索条件
     */

    public function getWhere($data = [])
    {
        $where = [];
        !empty($data['name']) && $where['u.name'] = ['like', '%'.$data['name'].'%'];
        !empty($data['phone']) && $where['u.phone'] = ['like', '%'.$data['phone'].'%'];
        !empty($data['title']) && $where['t.title'] = ['like', '%'.$data['title'].'%'];
        !empty($data['type']) && $where['s.type'] = ['=', $data['type']];

        return $where;
    }

    /**
     * 审核提现申请
     */

    public function examine($param)
    {
        $url=url('scorelist');

        $where = ['scoreid' => $param['scoreid']];

        $result = $this->modelScore->updateInfo($where,['status' => $param['status']]);

        $result && action_log('提现申请', '审核提现申请' . '，scoreid：' . $param['scoreid'] . '，status：' . $param['status']);

        return $result ? [RESULT_SUCCESS,'操作成功',$url] : [RESULT_ERROR, $this->modelScore->getError()];

    }

    /**
     * 获取提现信息
     */

    public function getScoreInfo($where = [])
    {

        $this->modelScore->alias('s');

        $join = [
            [SYS_DB_PREFIX . 'user u', 's.userid = u.userid', 'LEFT'],
            [SYS_DB_PREFIX . 'task t', 's.pid = t.id', 'LEFT'],
            [SYS_DB_PREFIX . 'member m', 't.member_id = m.id', 'LEFT'],
        ];

        $info = $this->modelScore->join($join)->where(['scoreid' => $where['scoreid']])->field('s.*,u.phone,u.photo,u.name,t.title,t.type as ta_type,t.status as t_status,t.tasktype,m.nickname')->find();

        return $info;

    }


}