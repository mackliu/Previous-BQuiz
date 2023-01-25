<div>目前位置：首頁 > 分類網誌 > <span id='navType'></span></div>
<fieldset style="width:15%;display:inline-block;vertical-align:top">
    <legend>分類網誌</legend>
    <p><a class="type" id="t1" href="#">健康新知</a></p>
    <p><a class="type" id="t2" href="#">菸害防制</a></p>
    <p><a class="type" id="t3" href="#">癌症防治</a></p>
    <p><a class="type" id="t4" href="#">慢性病防治</a></p>
</fieldset>
<fieldset style="width:75%;display:inline-block">
    <legend id="legendTitle">文章列表</legend>
    <div id="titles"></div>
    <div id="Post"></div>
</fieldset>


<script>

getList(1)

$(".type").on("click",function(){
    type=$(this).attr('id').replace("t","")
    getList(type)
})

function getList(type){
    $("#navType").html($("#t"+type).text());
    //去後端撈文章列表
    $.get('api/get_list.php',{type},(list)=>{
            $("#Post").html("")
            $("#titles").html(list)
            $("#legendTitle").html("文章列表")
         }
        )
}

function getNews(id){
    $.get("api/get_post.php",{id},(post)=>{
        $("#Post").html(post)
        $("#legendTitle").html("文章內容")
        $("#titles").html("")
    })
}

</script>