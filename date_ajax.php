<?php

//大会名、その日程のデータを表示するためのクラス。（※実際の運用ではデータベースに接続するのでこのようなクラスによる管理は行わない。）
class Tounament{
   function __construct($tounamentDistrict,$tounamentDistrictId,$tounamentDate){
       $this->tounamentDistrict = $tounamentDistrict;
       $this->tounamentDistrictId = $tounamentDistrictId;
       $this->tounamentDate = $tounamentDate;
   }
    
    public function getTounamentDistrict(){
        return $this->tounamentDistrict; 
    }
    public function getTounamentDistrictId(){
        return $this->tounamentDistrictId; 
    }
    public function getTounamentDate(){
        return $this->tounamentDate; 
    }
    public function getDifferBetTodayToTouna(){
        $dayOfToday = date('Y-m-d'); //今日の日付取得（yyyy-mm-dd）の形で
        $dayOfToday = new DateTime("{$dayOfToday}"); //DateTimeクラスのインスタンス生成
        $dateOfTounament = new DateTime("{$this->getTounamentDate()}"); //DateTimeクラスのインスタンス生成
        $differ = $dateOfTounament->diff($dayOfToday); //$dateOfTounamentと$dayOfTodayの差分についてのDateIntervalオブジェクトを作成。 
        return $differ->days; //期日（$day1）と今日の差分を数値化。
    }
    public function getInvertBetTodayToTouna(){
        $dayOfToday = date('Y-m-d'); //今日の日付取得（yyyy-mm-dd）の形で
        $dayOfToday = new DateTime("{$dayOfToday}"); //DateTimeクラスのインスタンス生成
        $dateOfTounament = new DateTime("{$this->getTounamentDate()}"); //DateTimeクラスのインスタンス生成
        $invertDate = date_diff($dayOfToday,$dateOfTounament); //date_diff()関数を使用し2つのDateTimeオブジェクト間の差を返す。
        $invert = $invertDate->invert;
        return  $invert; //大会日が過去のものかどうかを判別するためのもの。戻り値が1なら過去、0なら未来。
    }
}

//実施予定の大会のデータ(※実際の運用ではデータベースに接続してデータを取得して表示させるのでこのようなインスタンス生成などは行わない。)
    $tounament1 = new Tounament('札幌','sapporo','2022-05-04');
    $tounament2 = new Tounament('仙台','sendai','2022-06-05');
    $tounament3 = new Tounament('東京','tokyo','2022-07-12');
    $tounament4 = new Tounament('名古屋','nagoya','2022-08-02');
    $tounament5 = new Tounament('大阪','osaka','2022-09-21');
    $tounament6 = new Tounament('広島','hiroshima','2022-10-13');
    $tounament7 = new Tounament('福岡','fukuoka','2022-11-08');
    $tounament8 = new Tounament('那覇','naha','2022-12-15');
    $tounament9 = new Tounament('京都','kyoto','2023-01-15');
    $tounaments1 = array($tounament1,$tounament2,$tounament3,$tounament4,$tounament5,$tounament6,$tounament7,$tounament8,$tounament9);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>申し込みフォーム</title>
        <link rel="stylesheet" href="date_ajax.css">
    </head>
    <body>
       
       <h1>（仮）素人囲碁クラス別日本一決定戦&nbsp;&nbsp;申し込みページ</h1>
        <h2>無差別クラス　大会一覧（半年以内に行われるもの）</h2>
           <div class="apply_select_place">
            <ul class="apply_place_list">
              <?php foreach($tounaments1 as $tounament1):?> 
               <?php if($tounament1->getInvertBetTodayToTouna() === 1 && $tounament1->getDifferBetTodayToTouna() >= 0 && $tounament1->getDifferBetTodayToTouna() <= 60){ echo '<li class="place" id="'.$tounament1->getTounamentDistrictId().'"><h2>'.$tounament1->getTounamentDistrict().'大会（終了）</h2><p class="date">'.$tounament1->getTounamentDate().'</p><p class="check gray">受付は終了しました。</p></li>';} else if($tounament1->getInvertBetTodayToTouna() === 0 && $tounament1->getDifferBetTodayToTouna() > 0 && $tounament1->getDifferBetTodayToTouna() < 90){ echo '<li class="place" id="'.$tounament1->getTounamentDistrictId().'"><h2 ><a href="#">'.$tounament1->getTounamentDistrict().'大会</a>（受付中）</h2><p class="date">'.$tounament1->getTounamentDate().'</p><p class="check">予約状況を確認</p></li>';} else if($tounament1->getDifferBetTodayToTouna() >= 90 && $tounament1->getDifferBetTodayToTouna() < 180 ){ echo'<li class="place" id="'.$tounament1->getTounamentDistrictId().'"><h2>'.$tounament1->getTounamentDistrict().'大会（準備中）</h2><p class="date">'.$tounament1->getTounamentDate().'</p><p class="check gray">準備中</p></li>' ;}else{ continue; } ?> 
               <?php endforeach;?>
           　</ul>
            <!-- 上のコードでやっていることは...１、過去の大会でかつ６０日過ぎたものは表示しない。２、過去の大会で６０日以内のものは「受付終了」としリンクを外したうえで表示。３，大会当日から９０日以内は「受付中」としてリンクをオンにして表示。４，９０日以上先及び１８０日以内に行われる大会は「準備中」としてリンクを外して表示。５，１８０日以上先の大会は表示しない。-->
           </div>
        
        <script src="js/jquery-3.4.1.min.js"></script>
        <script> 
            'use strict';
            
            $(document).ready(function(){
                $.ajax({url:'./date_ajax.json',dataType:'json'}) 
                .done(function(data){
                    console.log(data);
                    data.forEach(function(item,index){
                        if(item.resav_status === '1'){
                        const idName = '#' + item.id;
                        $(idName).find('.check').addClass('vacant');
                        }else if(item.resav_status === '2'){
                        const idName = '#' + item.id;
                        $(idName).find('.check').addClass('crowded');
                        }else if(item.resav_status === '3'){
                        const idName = '#' + item.id;
                        $(idName).find('.check').addClass('no_vacant');
                        $(idName).remove('a');
                        }else{
                             return true;  // continue の代わり
                        }
                 });
                    
            }).fail(function(){
                window.alert('error!');
            });
            
            $('.check').on('click',function(){
                if($(this).hasClass('no_vacant')){
                    $(this).text('満員です').addClass('red');
                }else if($(this).hasClass('crowded')){
                    $(this).text('空き枠はわずかです').addClass('yellow');
                }else{
                    $(this).text('空きがあります').addClass('green');
                }
            });
            });   //※data_ajax.jsonには各地区の予約状況のデータが書かれている。
        </script>

     </body>
    </html>