<?php

//大会名、その日程のデータを表示するためのクラス。（※実際の運用ではデータベースに接続するのでこのようなクラスは使わない。）
class Tounament{
   function __construct($tounamentDistrict,$tounamentDate){
       $this->tounamentDistrict = $tounamentDistrict;
       $this->tounamentDate = $tounamentDate;
   }
    
    public function getTounamentDistrict(){
        return $this->tounamentDistrict; 
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

//実施予定の大会のデータ(※実際の運用ではデータベースに接続してデータを取得して表示させるのでこのようなインスタンス生成は行わない。)
    $tounament1 = new Tounament('札幌','2022-05-04');
    $tounament2 = new Tounament('仙台','2022-06-05');
    $tounament3 = new Tounament('東京','2022-07-12');
    $tounament4 = new Tounament('名古屋','2022-8-02');
    $tounament5 = new Tounament('大阪','2022-9-21');
    $tounament6 = new Tounament('広島','2022-10-13');
    $tounament7 = new Tounament('福岡','2022-11-08');
    $tounament8 = new Tounament('那覇','2022-12-15');
    $tounament9 = new Tounament('京都','2023-01-15');
    $tounaments1 = array($tounament1,$tounament2,$tounament3,$tounament4,$tounament5,$tounament6,$tounament7,$tounament8,$tounament9);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>申し込みフォーム</title>
    </head>
    <body>

    <h1 style="font-size:22px; font-weight: normal;">（仮）素人囲碁クラス別日本一決定戦&nbsp;&nbsp;申し込みページ</h1>
        <h2 style="font-size:19px; font-weight: normal; font-size:20px;">・大会一覧（半年以内に行われるもの）</h2>
        <div class="apply_select_place">
           <ul>
              <?php foreach($tounaments1 as $tounament1):?>
               
               <?php if($tounament1->getInvertBetTodayToTouna() === 1 && $tounament1->getDifferBetTodayToTouna() >= 0 && $tounament1->getDifferBetTodayToTouna() <= 60){ echo '<li style="list-style-type: none;">'.$tounament1->getTounamentDistrict().'大会（受付は終了いたしました。）['.$tounament1->getTounamentDate().']</li>';} else if( $tounament1->getInvertBetTodayToTouna() === 0 && $tounament1->getDifferBetTodayToTouna() > 0 && $tounament1->getDifferBetTodayToTouna() < 90){ echo '<li style="list-style-type: none;"><a href="#">'.$tounament1->getTounamentDistrict().'大会</a>（受付中）&nbsp;&nbsp;['.$tounament1->getTounamentDate().']</li>';} else if($tounament1->getDifferBetTodayToTouna() >= 90 && $tounament1->getDifferBetTodayToTouna() < 180 ){ echo '<li style="list-style-type: none;">'.$tounament1->getTounamentDistrict().'大会（準備中です。）['.$tounament1->getTounamentDate().']</li>';}else{ continue; } ?> 
               <?php endforeach;?>
           </ul>　 
            <!-- 上のコードでやっていることは...１、過去の大会でかつ６０日過ぎたものは表示しない。２、過去の大会で６０日以内のものは「受付終了」としリンクを外したうえで表示。３，大会当日から９０日以内は「受付中」としてリンクをオンにして表示。４，大会まで９０日以上１８０日以内のものは「準備中」としてリンクを外して表示。５，大会まで９０日以上のものは表示しない。-->
        </div>
        
     </body>
    </html>