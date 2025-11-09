<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Convert_format
{
    private $CI;
    public function __construct()
    {
        $this->CI = &get_instance();
    }
    /*
     * 日本語の曜日に変化
     */
    function ChangeJpDate($date)
    {
        date_default_timezone_set('Asia/Tokyo');
        // 日付を指定
        $year = date('Y', strtotime($date));
        $month = date('m', strtotime($date));
        $day = date('d', strtotime($date));
        if (($date != NULL || $date != '') && ($date != '0000-00-00')) {
            // 指定日の日本語曜日を出力
            return $year . '年' . $month . '月' . $day . '日';
        } else {
            return NULL;
        }
    }

    /*
     * 日付変化（曜日）
     */
    function ChangeJpDay($date)
    {
        date_default_timezone_set('Asia/Tokyo');
        // 日本語の曜日配列
        $weekjp = array(
            '日', // 0
            '月', // 1
            '火', // 2
            '水', // 3
            '木', // 4
            '金', // 5
            '土'
        ) // 6
        ;

        // 日付を指定
        $year = date('Y', strtotime($date));
        $month = date('m', strtotime($date));
        $day = date('d', strtotime($date));
        // 指定日のタイムスタンプを取得
        $timestamp = mktime(0, 0, 0, $month, $day, $year);

        // 指定日の曜日番号（日:0 月:1 火:2 水:3 木:4 金:5 土:6）を取得
        $weekno = date('w', $timestamp);
        if (($date != NULL || $date != '') && ($date != '0000-00-00')) {
            // 指定日の日本語曜日を出力
            return $year . '年' . $month . '月' . $day . '日' . '(' . $weekjp[$weekno] . ')';
        } else {
            return NULL;
        }
    }

    function ChangeJpDay_NoYear($date)
    {
        date_default_timezone_set('Asia/Tokyo');
        // 日本語の曜日配列
        $weekjp = array(
            '日', // 0
            '月', // 1
            '火', // 2
            '水', // 3
            '木', // 4
            '金', // 5
            '土'
        ) // 6
        ;

        // 日付を指定
        $year = date('Y', strtotime($date));
        $month = date('m', strtotime($date));
        $day = date('d', strtotime($date));
        // 指定日のタイムスタンプを取得
        $timestamp = mktime(0, 0, 0, $month, $day, $year);

        // 指定日の曜日番号（日:0 月:1 火:2 水:3 木:4 金:5 土:6）を取得
        $weekno = date('w', $timestamp);
        if (($date != NULL || $date != '') && ($date != '0000-00-00')) {
            // 指定日の日本語曜日を出力
            return $month[1] . '月' . $day . '日' . '(' . $weekjp[$weekno] . ')';
        } else {
            return NULL;
        }
    }

    /*
     * 前日の計算
     */
    function increaseOneDay($param)
    {
        date_default_timezone_set('Asia/Tokyo');
        if ($param != '' || $param != NULL) {
            $date = new DateTime($param);
            $date->modify('+1 day');
            return $date->format('Y-m-d');
        } else {
            return NULL;
        }
    }
    function increaseTwoDay($param)
    {
        date_default_timezone_set('Asia/Tokyo');
        if ($param != '' || $param != NULL) {
            $date = new DateTime($param);
            $date->modify('+2 day');
            return $date->format('Y-m-d');
        } else {
            return NULL;
        }
    }
    /*
     *
     */
    function DayCalculate($param, $DayVal)
    {
        date_default_timezone_set('Asia/Tokyo');
        if ($param != '' || $param != NULL) {
            $date = new DateTime($param);
            $num_day = '+' . $DayVal . ' day';
            $date->modify($num_day);
            return $date->format('Y-m-d');
        } else {
            return NULL;
        }
    }

    /*
     *
     * 今日+1計算
     */
    function decreaseOneDay($param)
    {
        date_default_timezone_set('Asia/Tokyo');
        if ($param != '' || $param != NULL) {
            $date = new DateTime($param);
            $date->modify('-1 day');
            return $date->format('Y-m-d');
        } else {
            return NULL;
        }
    }
    /*
     * //参加日程選択項目計算
     */
    function DateTypeCalculate($param, $DayVal)
    {
        date_default_timezone_set('Asia/Tokyo');

        if ($param != '' || $param != NULL) {
            $date = new DateTime($param);
            $num_day = '+' . $DayVal . ' day';
            $date->modify($num_day);
            return $date->format('Y-m-d');
        } else {
            return NULL;
        }
    }
    /*
     *
     * 曜日を計算
     */
    function ChangeJPdayofWeek($date)
    {
        date_default_timezone_set('Asia/Tokyo');
        // 日本語の曜日配列
        $weekjp = array(
            '日', // 0
            '月', // 1
            '火', // 2
            '水', // 3
            '木', // 4
            '金', // 5
            '土'
        ) // 6
        ;

        // 日付を指定
        $year = date('Y', strtotime($date));
        $month = date('m', strtotime($date));
        $day = date('d', strtotime($date));
        // 指定日のタイムスタンプを取得
        $timestamp = mktime(0, 0, 0, $month, $day, $year);

        // 指定日の曜日番号（日:0 月:1 火:2 水:3 木:4 金:5 土:6）を取得
        $weekno = date('w', $timestamp);
        if (($date != NULL || $date != '') && ($date != '0000-00-00')) {
            // 指定日の日本語曜日を出力
            return '(' . $weekjp[$weekno] . ')';
        } else {
            return NULL;
        }
    }
}
