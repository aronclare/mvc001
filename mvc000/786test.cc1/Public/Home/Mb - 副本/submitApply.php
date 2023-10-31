<?php
$arr = array(
    'success' => true,
    'errcode' => '',
    'message' => '项目申请成功',
    'id' => $_POST['id'],
  );
echo json_encode($arr);
