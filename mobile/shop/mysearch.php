<?php
include_once('./_common.php');

// 테마에 mypage.php 있으면 include
if(defined('G5_THEME_SHOP_PATH')) {
    $theme_mypage_file = G5_THEME_MSHOP_PATH.'/mygame.php';
    if(is_file($theme_mypage_file)) {
        include_once($theme_mypage_file);
        return;
        unset($theme_mypage_file);
    }
}

$g5['title'] = '교차감지 시스템';
include_once(G5_MSHOP_PATH.'/_head.php');

// 쿠폰
$cp_count = 0;
$sql = " select cp_id
            from {$g5['g5_shop_coupon_table']}
            where mb_id IN ( '{$member['mb_id']}', '전체회원' )
            and cp_start <= '".G5_TIME_YMD."'
            and cp_end >= '".G5_TIME_YMD."' ";
$res = sql_query($sql);

for($k=0; $cp=sql_fetch_array($res); $k++) {
    if(!is_used_coupon($member['mb_id'], $cp['cp_id']))
        $cp_count++;
}
?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<style type="text/css">
.my_pocou_calling{padding:10px 5px;background:#fff}
.my_pocou_calling li{position:relative;padding:0 10px;line-height:30px;border-bottom: 1px solid #efefef;font-size:1.2em}
.my_pocou_calling span{position:absolute;top:0;right:10px;font-size:0.8em } 
.my_pocou_calling p{position:absolute;top:0;right:20px;} 

button {
    font-size:0.8em;
    height:55px;
    width:45%;
}

button .Warning{
    font-size:0.8em;
    height:55px;
    width:45%;
    color:#FF4848;
}
label, input { display:block;  }
input.text { margin-bottom:12px; width:100%; padding: .4em; }
fieldset { padding:0; border:0; margin-top:25px; }
</style>

<div id="smb_my">
    <section id="smb_my_ov">
        <h2>회원정보 개요</h2>
        <ul class="my_pocou_calling">
            <br><li class="my_cou">
                        <center><img src="<?php echo G5_THEME_MSHOP_URL ?>/img/00.png" width="100%" height="30%;"></center>
                        </li>
            <br><li class="my_cou">
                        <center><img src="<?php echo G5_THEME_MSHOP_URL ?>/img/labo.png"></center>
                        </li>
            <br><li class="my_cou">
                        <center><b>'정상적으로 가고 있다면 검증을 함께 해주세요.'</b></center>
                        </li>
            <br><li class="my_cou">
                        <center><a href="<?php echo G5_SHOP_URL; ?>/mycall_ok.php"><button>그만하기</button></a>　<a href="#"><button style="background-color:#FF4848;">Warning 보고</button></a></center>
                        </li></a>
            <br><li class="my_cou">
                        <center><b>'경로가 이상하다면 즉시 Warning 보고를 해주세요.'</b></center>
                        </li>
        </ul>
    </section>
</div>

<?php
include_once(G5_MSHOP_PATH.'/_tail.php');
?>