<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('getPrefecture'))
{
function getPrefecture($id=''){
	$prefecture_arr=array(
		'1'=>'北海道',
		'2'=>'青森県',
		'3'=>'岩手県',
		'4'=>'宮城県',
		'5'=>'秋田県',
		'6'=>'山形県',
		'7'=>'福島県',
		'8'=>'茨城県',
		'9'=>'栃木県',
		'10'=>'群馬県',
		'11'=>'埼玉県',
		'12'=>'千葉県',
		'13'=>'東京都',
		'14'=>'神奈川県',
		'15'=>'新潟県',
		'16'=>'富山県',
		'17'=>'石川県',
		'18'=>'福井県',
		'19'=>'山梨県',
		'20'=>'長野県',
		'21'=>'岐阜県',
		'22'=>'静岡県',
		'23'=>'愛知県',
		'24'=>'三重県',
		'25'=>'滋賀県',
		'26'=>'京都府',
		'27'=>'大阪府',
		'28'=>'兵庫県',
		'29'=>'奈良県',
		'30'=>'和歌山県',
		'31'=>'鳥取県',
		'32'=>'島根県',
		'33'=>'岡山県',
		'34'=>'広島県',
		'35'=>'山口県',
		'36'=>'徳島県',
		'37'=>'香川県',
		'38'=>'愛媛県',
		'39'=>'高知県',
		'40'=>'福岡県',
		'41'=>'佐賀県',
		'42'=>'長崎県',
		'43'=>'熊本県',
		'44'=>'大分県',
		'45'=>'宮崎県',
		'46'=>'鹿児島県',
		'47'=>'沖縄県',
		'99'=>'海外'
	);	
	if($id == ''){
		return $prefecture_arr;
	}else if($id == '0'){
		return '';
	}else{
		return $prefecture_arr[$id];
	}
}
}
if ( ! function_exists('getRelationship'))
{
function getRelationship($id=''){
	$relation_arr=array(
		'1'=>'配偶者',
		'2'=>'両親',
		'3'=>'子供',
		'4'=>'兄弟',
		'5'=>'祖父母',
		'6'=>'配偶者の両親',
		'7'=>'本部承認済'
	);	
	if($id == ''){
		return $relation_arr;
	}else if($id == '0'){
		return '';
	}else{
		return $relation_arr[$id];
	}
}
}
if ( ! function_exists('get_extension')) {
	function get_extension($str) {
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}
}
if ( ! function_exists('download_name')) {
	function download_name($reserve) {
		$extension = get_extension($reserve['R01_Brochure_Img']);
		//$name = $reserve['R01_Id'].'_'.$reserve['R01_Roma_Last'].'_'.$reserve['R01_Roma_First'];
		$name = $reserve['R01_Code'].'_'.$reserve['R01_Roma_Last'].'_'.$reserve['R01_Roma_First'];
		return $name.'.'.$extension;
	}
}
if ( ! function_exists('empty_date')) {
	function empty_date($str) {
		return empty($str) || $str == '0000-00-00 00:00:00';
	}
}
if ( ! function_exists('explode_date')) {
	function explode_date($str) {
		if(!empty_date($str)){
			return explode('-', $str);
		} else {
			return array('','','');
		}
	}
}
if ( ! function_exists('calculate_age')) {
	function calculate_age($birthdate) {
		$departure_date = date_create(DEPARTURE_DATE);
		$birth_date = date_create($birthdate);
		if(!empty_date($birthdate) && $birth_date) {
			$interval = date_diff($departure_date, $birth_date);
			return $interval->format('%y');
		} else {
			return '-1';
		}
	}
}
if ( ! function_exists('get_label')) {
	function get_label($kubun, $id) {
		switch ($kubun) {
		case '性別':
			switch($id) {
			case '1':
				return '男性';
			case '2':
				return '女性';
			default:
				return '';
			}
		case 'ESTA':
			switch($id) {
			case '1':
				return '有り';
			case '2':
				return '代行申込';
			default:
				return '';
			}
		case '請求':
			switch($id) {
			case '1':
				return 'ご自宅';
			case '2':
				return '支社';
			default:
				return '';
			}
		case 'レンタカー':
			switch($id) {
			case '1':
				return '当サイトよりレンタカーの手配をする';
			case '2':
				return 'ご自身でレンタカーを手配する';
			case '3':
				return '利用しない';
			default:
				return '';
			}	
		case '参加不参加':
			switch($id) {
			case '0':
				return '';
			case '1':
				return '不参加';
			default:
				return '';
			}	
		case '入力状態':
			switch($id) {
			case '0':
				return '未';
			case '1':
				return '済';
			default:
				return '';
			}	
		case 'カテゴリ':
			switch($id) {
			case 'C01':
				return 'FA部門 ダイヤモンド';
			case 'C02':
				return 'FA部門 プラチナ';
			case 'C03':
				return 'FA部門 ゴールド';
			case 'C04':
				return 'FA部門 シルバー';
			case 'C05':
				return 'FA部門 ブロンズ';
			case 'C06':
				return 'FA部門 ブロンズ/MGR部門 EPC特別入賞';
			case 'C07':
				return 'FA部門 KP特別賞';
			case 'C08':
				return 'FA部門 特別連月挙績';
			case 'C09':
				return 'FA部門 カスタマーアワード特別';
			case 'C10':
				return 'FA部門 300週以上連挙特別';
			case 'C11':
				return 'FAMGR部門 大規模ダイヤモンド';
			case 'C12':
				return 'FAMGR部門 小規模ゴールド';
			case 'C13':
				return 'FAMGR部門 大規模シルバー';
			case 'C14':
				return 'FAMGR部門 中規模シルバー';
			case 'C15':
				return 'FAMGR部門 小規模シルバー';
			case 'C16':
				return 'FAMGR部門 EPC特別招待(連月達成）';
			case 'C17':
				return 'FAMGR部門 EPC特別招待(SD最多賞）';
			case 'C18':
				return '職変MGR部門 EPC特別入賞';
			case 'C19':
				return 'FA部門 連月挙績賞（Monthly）特別賞';
			case 'C20':
				return 'FA部門 300週以上連挙(Weekly)特別賞';
			case 'C21':
				return 'FAMGR部門 中規模ダイヤモンド';
			case 'C22':
				return 'FAMGR部門 大規模ダイヤモンド';
			case 'C23':
				return 'FAMGR部門 中規模ダイヤモンド';
			case 'C24':
				return 'FAMGR部門 大規模プラチナ';
			case 'C25':
				return 'FAMGR部門 中規模プラチナ';
			case 'C26':
				return 'FAMGR部門 中規模ゴールド';
			case 'C27':
				return 'FAMGR部門　12ヶ月連月予算達成特別賞';
			case 'C28':
				return 'FAMGR部門　EPC特別賞';
			case 'C29':
				return '支社長部門 入賞';
			case 'C30':
				return '支社長部門 特別招待';
			case 'C31':
				return 'FA部門 連月挙績特別賞';
			case 'C32':
				return 'FA部門 連挙300W以上特別賞';
			case 'C33':
				return 'MGR部門　大規模プラチナ';
			case 'C34':
				return 'MGR部門　大規模シルバー';
			case 'C35':
				return 'MGR部門　12ヶ月連月予算達成特別賞';
			case 'C36':
				return 'MGR部門　SD最多輩出特別賞';
			case 'C37':
				return '職変MGR部門 特別入賞';
			case 'C38':
				return 'MGR部門　中規模プラチナ';
			case 'C39':
				return 'MGR部門　中規模シルバー';
			case 'C40':
				return 'MGR部門　小規模シルバー';
			case 'C99':
				return '支社の部 入賞';
			default:
				return '';
			}
		case '1Q':
		case '4Q':
			switch($id) {
			case 'S':
				return 'S オプショナルツアーS無料招待<br>(本人・家族招待枠・自費参加者3名まで)<br> or 自費参加費最大10万円の補助';
			case 'A':
				return 'A オプショナルツアーA無料招待<br>(本人・家族招待枠・自費参加者2名まで)<br> or 自費参加費最大6万円の補助';
			case 'B':
				return 'B オプショナルツアーB無料招待<br>(本人・家族招待枠)<br> or 自費参加費最大3万円の補助';
			case 'C':
				return 'C オプショナルツアーC無料招待<br>(本人)<br> or 自費参加費最大2万円の補助';
			default:
				return '';
			}
		case '自費補助':
			switch($id) {
			case '0':
				return '4Q利用';
			case '1':
				return '自費補助';
			default:
				return '';
			}
		case 'パーク':
			switch($id) {
			case '1':
				return '獲得';
			default:
				return '';
			}
		case '機内食':
			switch($id) {
			case '1':
				return 'チャイルドミール（2歳以上　12歳未満）';
			case '2':
				return 'ベビーミール（2歳未満）';
			case '3':
				return '大人と一緒';
			case '4':
				return '不要';
			default:
				return '';
			}
		case 'バシネット':
		case 'ハイチェア':
			switch($id) {
			case '1':
				return '希望する';
			case '2':
				return '希望しない';
			default:
				return '';
			}
		case 'ベビーベッド':
			switch($id) {
			case '1':
				return '希望する';
			case '2':
				return '希望しない';
			case '3':
				return '大人用ベッドを1台利用する';
			default:
				return '';
			}
		case 'ベビーベッド2':
			switch($id) {
			case '1':
				return '大人用ベッドを1台利用する';
			case '2':
				return '希望しない';
			default:
				return '';
			}
		case '子供ベッド':
			switch($id) {
			case '1':
				return '大人用ベッドを1台利用する';
			case '2':
				return '希望しない';
			default:
				return '';
			}
		case '子供ハイチェア':
			switch($id) {
			case '1':
				return '希望する';
			case '2':
				return '希望しない';
			default:
				return '';
			}
		case 'パーティ飲食12':
			switch($id) {
			case '1':
				return 'キッズプレートを希望する';
			case '2':
				return '希望しない';
			default:
				return '';
			}
		case 'パーティ飲食':
			switch($id) {
			case '1':
				return 'キッズプレートを希望する';
			case '2':
				return '大人用メニューを希望する';
			default:
				return '';
			}
		case '航空座席':
			switch($id) {
			case '1':
				return '大人1名のお膝の上';
			case '2':
				return '座席を利用する';
			default:
				return '';
			}
		case 'ベビーカー':
			switch($id) {
			case '1':
				return 'A型';
			case '2':
				return 'B型';
			case '3':
				return '希望しない';
			default:
				return '';
			}
		case 'AMPM':
			switch($id) {
			case '1':
				return '午前';
			case '2':
				return '午後';
			default:
				return '';
			}
		case 'クラブ':
			switch($id) {
			case '0':
				return '持参する';
			case '1':
				return 'レンタルクラブ（ゴルフ場へ直接予約）';
			default:
				return '';
			}
		case 'オプション権利':
			switch($id) {
			case '0':
				return '（有料）';
			case '1':
				return '（無料）';
			default:
				return '';
			}
		case 'オプションパーク':
		case 'オプションゴルフ':
			switch($id) {
			case '0':
				return '不参加';
			case '1':
				return '申込み';
			default:
				return '';
			}
		case 'オプション牧場':
			switch($id) {
			case '0':
				return '不参加';
			case '1':
				return '申込み（7/31）';
			case '2':
				return '申込み（8/1）';
			default:
				return '';
			}
		default:
			return '';
		}
	}
}

/**
 * CSRF対策 token 生成
 * @return string $bin2hex
 */
if (!function_exists('getCsrfToken')) {
    function getCsrfToken()
    {
        $TOKEN_LENGTH = 32;
        $bytes = openssl_random_pseudo_bytes($TOKEN_LENGTH);
        return bin2hex($bytes);
    }
}

if (!function_exists('h')) {
    function h($text, $double = true, $charset = null)
    {
        if (is_string($text)) {
            //optimize for strings
        } elseif (is_array($text)) {
            $texts = [];
            foreach ($text as $k => $t) {
                $texts[$k] = h($t, $double, $charset);
            }

            return $texts;
        } elseif (is_object($text)) {
            if (method_exists($text, '__toString')) {
                $text = (string)$text;
            } else {
                $text = '(object)' . get_class($text);
            }
        } elseif (is_bool($text) || is_null($text) || is_int($text)) {
            return $text;
        }

        static $defaultCharset = false;
        if ($defaultCharset === false) {
            $defaultCharset = mb_internal_encoding();
            if ($defaultCharset === null) {
                $defaultCharset = 'UTF-8';
            }
        }
        if (is_string($double)) {
            $charset = $double;
        }

        return htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, $charset ?: $defaultCharset, $double);
    }
}

if (!function_exists('v')) {
    function v($array, $key, $default = '')
    {
        if (isset($array[$key])) {
            return $array[$key];
        }
        return $default;
    }
}