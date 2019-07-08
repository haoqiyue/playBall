<?php

namespace app\admin\controller;


/**
 * 积分控制器
 */
class Score extends AdminBase
{

    /**
     * 积分列表
     */
    public function scoreList()
    {
        $where = $this->logicScore->getWhere($this->param);

        $list = $this->logicScore->getScoreList($where);

        $this->assign('list', $list);
        return $this->fetch('score_list');
    }

    /**
     * 提现记录审核
     */

    public function  scoreExamine()
    {

        $this->jump($this->logicScore->examine($this->param));
    }

    /**
     * 提现信息查看
     */

    public function scoreInfo()
    {

        IS_POST && $this->jump($this->logicScore->scoreInfo($this->param));


        $info = $this->logicScore->getScoreInfo(['scoreid' => $this->param['scoreid']]);

        $this->assign('info', $info);

        return  $this->fetch('score_info');
    }

}