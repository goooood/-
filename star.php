<?php

/**
 *
 * 对各种数据进行星号处理
 */

//姓名
function asterisk_name($name) {
    $len = mb_strlen($name, 'utf8');
    if ($len == 2) { //2个字的名字
        return mb_substr($name, 0, 1, 'utf8') . '*';
    } else if ($len == 3) { //3个字的名字
        return mb_substr($name, 0, 1, 'utf8') . '**';
    } else if ($len == 4) { //复姓
        return mb_substr($name, 0, 2, 'utf8') . '**';
    } else { //
        return false;
    }
}

//用户名
function asterisk_user_name($name) {
    $len_a = mb_strlen($name, 'utf8') - 2;  //星号部分长度
    return mb_substr($name, 0, 2, 'utf8') . sprintf("%'*{$len_a}s", '');
}

//电子邮件 替换中间的1/2为*
function asterisk_email($email) {
    $username_suffix = explode('@', $email);
    if (!isset($username_suffix[1])) {
        return false;
    }
    $len = strlen($username_suffix[0]);
    $sub_len = $len / 2;
    return substr($username_suffix[0], 0, $sub_len / 2)
            . sprintf("%'*{$sub_len}s", '')
            . substr($username_suffix[0], -ceil($sub_len / 2))
            . "@{$username_suffix[1]}";
}

//身份证号 替换生日部分为*
function asterisk_id($id) {
    $len = strlen($id);
    if ($len == 18) {
        return substr($id, 0, 6) . '********' . substr($id, -4);
    } else if ($len == 15) {
        return substr($id, 0, 6) . '******' . substr($id, -3);
    } else { //不正确的身份证号
        return false;
    }
}

//电话号码,目前仅仅支持11位手机号
function asterisk_phone($phone) {
    if (empty($phone)) {
        return false;
    }
    return substr($phone, 0, 3) . '****' . substr($phone, -4);
}

/*echo asterisk_name('上官飞扬'), "\n";
echo asterisk_user_name('abcdefg'), "\n";
echo asterisk_email('123456@qq.com'), "\n";
echo asterisk_id('222301880101242'), "\n";
echo asterisk_phone(18224535585), "\n";
echo '------------',"\n";
echo asterisk_name(''), "\n";
echo asterisk_user_name(''), "\n";
echo asterisk_email(''), "\n";
echo asterisk_id('132456'), "\n";
echo asterisk_phone(18224535585), "\n";*/