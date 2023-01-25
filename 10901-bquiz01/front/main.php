<div class="di"
    style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
    <!--因為跑馬燈功能包含了三個頁面，因此我們選擇將跑馬燈功能切出去成為一個獨立的檔案-->
    <?php include "maquree.php";?>
    <div style="height:32px; display:block;"></div>
    <!--正中央-->
    
    <div style="width:100%; padding:2px; height:290px;">
        <div id="mwww" loop="true" style="width:100%; height:100%;">
            <div style="width:99%; height:100%; position:relative;" class="cent">沒有資料</div>
        </div>
    </div>
    <script>
    var lin = new Array();
        <?php
            //撈出需要顯示的動畫圖片，再以js的array.push功能將路徑字串加入到陣列中
            $mvim=new DB("mvim");
            $mvs=$mvim->all(['sh'=>1]);
            foreach($mvs as $mv){
        ?>
            lin.push('img/<?=$mv['img'];?>')
        <?php }  ?>

    var now = 0;
    //在輪播程式執行前先單獨執行一次ww()程式，把第一張動畫先放到畫面中
    ww();
    if (lin.length > 1) {
        setInterval("ww()", 3000);
        now = 1;
    }

    function ww() {
        $("#mwww").html("<embed loop=true src='" + lin[now] + "' style='width:99%; height:100%;'></embed>")
        
        //$("#mwww").attr("src",lin[now])
        now++;
        if (now >= lin.length)
            now = 0;
    }

    </script>    
    <div
        style="width:95%; padding:2px; height:190px; margin-top:10px; padding:5px 10px 5px 10px; border:#0C3 dashed 3px; position:relative;">
        <span class="t botli">最新消息區
            <?php
                $news=new DB("news");

                //先判斷需要顯示的最消息是否大於5筆
                $chk=$news->count(['sh'=>1]);
                if($chk>=5){
                    echo "<a href='index.php?do=news' style='float:right'>More...</a>";
                }
            ?>
        </span>
        <ul class="ssaa" style="list-style-type:decimal;">
            <?php
                //撈出最多五筆最新消息並顯示前20個字在畫面上
                $ns=$news->all(['sh'=>1]," limit 5");
                foreach($ns as $n){
            ?>
            <li><?=mb_substr($n['text'],0,20,'utf8');?>...
                <!--塞一個子元素在最新消息的每一則列表中，再透過素材附的js程式顯示完整內容在彈出視窗中-->
                <div class='all' style="display:none"><?=$n['text'];?></div>
            </li> 
            <?php
            }
            ?>
        </ul>
        <div id="altt"
            style="position: absolute; width: 350px; min-height: 100px; background-color: rgb(255, 255, 204); top: 50px; left: 130px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;">
        
        </div>
        <script>
        $(".ssaa li").hover(
            function() {
                $("#altt").html("<pre>" + $(this).children(".all").html() + "</pre>")
                $("#altt").show()
            }
        )
        $(".ssaa li").mouseout(
            function() {
                $("#altt").hide()
            }
        )
        </script>
    </div>
</div>