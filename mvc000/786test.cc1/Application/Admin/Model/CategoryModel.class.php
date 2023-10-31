<?php
namespace Admin\Model;
use Think\Model;
class CategoryModel extends Model{
    protected $_validate = array(
        array('name','require','请填写项目标题！'), //默认情况下用正则进行验证
        array('short_name','require','请填写项目副名称！'), //默认情况下用正则进行验证
        array('type','require','请选择项目类型！'), //默认情况下用正则进行验证
        array('short_name','','项目副名称已经存在！',0,'unique',self::MODEL_BOTH), // 在新增的时候验证name字段是否唯一
        array(array('type','Effective_betting','Application_date','Member_name','Number_participants','Can_win_prizes','Losses','Contact_QQ','Note_the_single_amount','Apply_for_days','Apply_for_customs_number','WinnerPaid','Multiple_water','Game_project','Contact_via_mail','Note_the_single_code','Quantity_completion','Profit_quota','Application_type'),array(1,2),'请勿恶意修改字段',2,'in'), // 当值不为空的时候判断是否在一个范围内
//        array('youxiao',array(1,2,3,4),'请勿恶意修改字段',3,'in'), // 当值不为空的时候判断是否在一个范围内
    );

}