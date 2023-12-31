<?php
return array(
    'TOKEN_ON'      =>    true,  // 是否开启令牌验证 默认关闭
    'TOKEN_NAME'    =>    '__hash__',    // 令牌验证的表单隐藏字段名称，默认为__hash__
    'TOKEN_TYPE'    =>    'md5',  //令牌哈希验证规则 默认为MD5
    'TOKEN_RESET'   =>    true,  //令牌验证出错后是否重置令牌 默认为true
    //是否开启模板布局 根据个人习惯设置
    'LAYOUT_ON'=>false,
    'SHOW_PAGE_TRACE' =>false,
//    PC和Mb端 切换
    'DEFAULT_THEME' => 'Pc',
    'THEME_LIST' => 'Pc,Mb',
    'TMPL_DETECT_THEME' => true,
);