<marquee scrolldelay="120" direction="left" style="position:absolute; width:100%; height:40px;">
<?php
    //撈出跑馬燈文字資料並顯示在畫面上
    $ad=new DB("ad");
    $ads=$ad->all(['sh'=>1]);
    foreach($ads as $ad){
        echo $ad['text'];
        echo "&nbsp;&nbsp;&nbsp;&nbsp;";
    }
?>
</marquee>