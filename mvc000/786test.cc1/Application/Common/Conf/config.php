<?php

return array(

	//'配置项' =>'配置值'

	//我们用了入口版定 所以下面这行可以注释掉

	'SHOW_PAGE_TRACE'   =>  true, 

	'LOAD_EXT_CONFIG'   => 'db,wechat,oauth',



    //申请项目字段

	'CUSTOM_FIELDS' => array(

        'effective_betting'=>'周有效投注',

        'application_date'=>'连拿时间',

        'member_name'=>'会员姓名',

        'number_participants'=>'日有效投注',

        'can_win_prizes'=>'注单时间',

        'losses'=>'亏损金额',

        'contact_qq'=>'联系QQ',

        'note_the_single_amount'=>'单笔存款金额',

        'apply_for_days'=>'连赢时间',

        'apply_for_customs_number'=>'申请关数',

        'winner_paid'=>'申请金额',

        'multiple_water'=>'流水倍数',

        'game_project'=>'游戏项目',

        'contact_via_mail'=>'联系邮箱',

        'note_the_single_code'=>'申请牌型',

        'quantity_completion'=>'连赢局数',

        'profit_quota'=>'盈利额度',

        'application_type'=>'申请类型（话费或流量）',

        'old_username'=>'上级ID',

        'old_name'=>'会员ID',

        'old_phone'=>'注单号后7位',

        'new_username'=>'下级ID',

        'new_name'=>'被推荐人微信号',

        'new_phone'=>'个人微信号',

        'friends'=>'邀请好友',

        'referees'=>'推荐人ID',
        
        'referral'=>'被推荐人手机号',
 

    ),



	//'DEFAULT_FILTER'        => 'htmlspecialchars',

	'SUPER_ADMIN_ID'=>1,  //超级管理员id 删除用户的时候用这个禁止删除

	'SHOW_ERROR_MSG'        =>  true, 

	//用户注册默认信息

	'DEFAULT_SCORE'=>100,

	'LOTTERY_NUM'=>3,



	'DEFAULT_MODULE' => 'Home',

	'DEFAULT_CONTROLLER' => 'Index',



    /* URL配置 */

    'URL_CASE_INSENSITIVE' => true, //默认false 表示URL区分大小写 true则表示不区分大小写

	'URL_HTML_SUFFIX'  =>'html',

	'TMPL_CACHE_ON' => false,

    'URL_MODEL'            => 1, //URL模式

    'VAR_URL_PARAMS'       => '', // PATHINFO URL参数变量

    'URL_PATHINFO_DEPR'    => '/', //PATHINFO URL分割符 



    /* 系统变量名称设置 */

    'VAR_GROUP'             => 'g',     // 默认分组获取变量

    'VAR_MODULE'            => 'm',  // 默认模块获取变量

    'VAR_ACTION'            => 'a',  // 默认操作获取变量

    'VAR_ROUTER'            => 'r',     // 默认路由获取变量

    'VAR_PAGE'              => 'p',  // 默认分页跳转变量

    'VAR_TEMPLATE'          => 't',  // 默认模板切换变量

	'VAR_LANGUAGE'          => 'l',  // 默认语言切换变量

    'VAR_AJAX_SUBMIT'       => 'ajax',  // 默认的AJAX提交变量

    'VAR_PATHINFO'          => 's', // PATHINFO 兼容模式获取变量例如 ?s=/module/action/id/1 后面的参数取决于URL_PATHINFO_MODEL 和 URL_PATHINFO



    /* 模板相关配置 */

    'TMPL_PARSE_STRING' => array(

        '__PUBLIC__' => __ROOT__ . '/Public',

        '__IMG__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/images',

        '__CSS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/css',

        '__JS__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/js',

    ),

);