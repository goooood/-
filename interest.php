<?php

/**
 * 贷款相关函数
 */

/**
 * 计算每月付利息多少 例子：interest($type = '等额本息', $principal = 100000, $apr_year = 0.02, $month = 6);
 * @param string $type  贷款方式 例子： 一次性还款、等额本息、等额本金、每月付息到期还本
 * @param int $principal 本金 例子: 100000
 * @param float $apr_year 年利率 例子：18%写为浮点型是0.18
 * @param int $month 贷款多少月
 * @return array|false 返回一个保存每个月利息的数组
 */
function interest($type = '', $principal = 0, $apr_year = 0.00, $month = 0) {
    if (!$type or ! $principal or ! $apr_year or ! $month) {
        return false;
    }
    $apr_month = $apr_year / 12;    //转为月利率
    $return = array();
    switch ($type) {
        case '等额本息':
            for ($i = 1; $i <= $month; $i++) {
                $return[$i] = $principal * $apr_month * (pow((1 + $apr_month), $month) - pow((1 + $apr_month), ($i - 1))) / (pow((1 + $apr_month), $month) - 1);
            }
            break;
        case '每月付息到期还本':
            for ($i = 1; $i <= $month; $i++) {
                $return[$i] = $principal * $apr_month;
            }
            break;
        case '一次性还款':
            for ($i = 1; $i <= $month; $i++) {
                if ($i != $month) {
                    $return[$i] = 0;
                } else {    //最后一月
                    $return[$i] = $principal * $apr_month * $month;
                }
            }
            break;
        case '等额本金':
            $first_month = $principal / $month; //第一个月应还本金也就是每月应还本金
            for ($i = 1; $i <= $month; $i++) {
                $return[$i] = ($principal - $first_month * ($i - 1) ) * $apr_month;
            }
            break;
        default:
            return false;
    }
    //保留两位小数，四舍五入
    foreach ($return as &$value) {
        $value = round($value, 2);
    }
    return $return;
}

/**
 * 每月付本息多少
 * @param type $type
 * @param type $principal
 * @param float $apr_year 年利率 例子：18%写为浮点型是0.18
 * @param type $month
 * @return array|false 返回一个保存每个所付款（利息+本金）的数组
 */
function repay($type = '', $principal = 0, $apr_year = 0.0000, $month = 0) {
    if (!$type or ! $principal or ! $apr_year or ! $month) {
        return false;
    }
    $apr_month = $apr_year / 12;    //转为月利率
    //echo "$type | $principal | $apr_year | $month";
    $return = array();
    switch ($type) {
        case '一次性还款':


            break;
        case '等额本息':
            for ($i = 1; $i <= $month; $i++) {
                $return[$i] = $principal * $apr_month * pow(( 1 + $apr_month), $month) / ( pow((1 + $apr_month), $month) - 1);
            }
            break;
        case '等额本金':


            break;
        case '每月付息到期还本':


            break;

        default:
            return false;
    }
    //保留两位小数，四舍五入
    foreach ($return as &$value) {
        $value = round($value, 2);
    }
    return $return;
}

/**
 * 计算总利息
 * @param string $type  贷款方式 例子： 一次性还款、等额本息、等额本金、每月付息到期还本
 * @param int $principal 本金 例子: 100000
 * @param float $apr_year 年利率 例子：18%写为浮点型是0.18
 * @param int $month 贷款多少月
 * @return array|false 返回一个所有月利息之和的数字
 */
function total_profit($type = '', $principal = 0, $apr_year = 0.00, $month = 0) {
    $return = interest($type, $principal, $apr_year, $month);  //获取每个月的利息
    if ($return !== false) {
        return array_sum($return);  //计算利息总和
    } else {
        return false;
    }
}

/*function number_format() {
    return 0;
}*/
