<?php
return array(
	//'配置项'=>'配置值'
	'URL_MODEL'            => 1, //URL模式
    //主题静态文件路径
    'TMPL_PARSE_STRING' => array(
        '__STATIC__' => '/Application/'.MODULE_NAME.'/View/' . 'Public/static',),

//    //Rbac配置
//    'RBAC_SUPERADMIN'=>'admin',         //超级管理员名称
//    'ADMIN_AUTH_KEY'=>'superadmin',     //超级管理员识别，存放在Session中
//    'USER_AUTH_ON'=>true,               //是否开启权限认证
//    'USER_AUTH_TYPE'=>1,                //验证类型 1-登陆时验证 2-实时验证
//    'USER_AUTH_KEY'=>'uid',             //存储在session中的识别号
//    'NOT_AUTH_MODULE'=>'Index',              //无需验证的控制器
//    'NOT_AUTH_ACTION'=>'add_role_handle',              //无需验证的方法
//    'RBAC_ROLE_TABLE'=>'tp_role',      //角色表名称
//    'RBAC_USER_TABLE'=>'tp_role_user', //角色与用户的中间表名称（注意）
//    'RBAC_ACCESS_TABLE'=>'tp_access',  //权限表名称
//    'RBAC_NODE_TABLE'=>'tp_node',      //节点表名称
       'SHOW_PAGE_TRACE' =>false,
);
