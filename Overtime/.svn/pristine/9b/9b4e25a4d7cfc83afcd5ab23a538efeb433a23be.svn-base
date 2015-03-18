<?php

/**
 * Edit by shaob.liu@samsung.com 
 * Read Excel转义字符
 * PHPWord: http://phpword.codeplex.com
 * PHPPowerPoint: http://phppowerpoint.codeplex.com/
 * PHPLINQ: http://phplinq.codeplex.com/
 * */
include_once 'head.php';
/*global $username;
if (strlen($username) < 2 || $password != "123") {//用户名登陆出错
    echo "2";
    exit(1);
}*/

if (($data = exit2read()) == 0) {
    create();
    echo 0; //没有文件，自动创建
    exit(1);
}

for ($i = 2; $i < 40; $i++) {
    if ($username == $data[$i][A]) {
        echo '1'; //查到该用户信息
        //var_dump($data[$i]);
        exit(1);
    }
}
echo '0'; //未查到该用户信息
exit(1);
?>
