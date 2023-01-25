<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli">網站標題管理</p>
    <form method="post" action="api/edit.php">
        <table width="100%">
            <tbody>
                <tr class="yel">
                    <td width="45%">網站標題</td>
                    <td width="23%">替代文字</td>
                    <td width="7%">顯示</td>
                    <td width="7%">刪除</td>
                    <td></td>
                </tr>
                <?php
                    //因為我們一開始就設計admin.php的$do變數和各資料表名稱一樣
                    //所以在這裏也利用$do變數來當成資料表名加以使用
                    //能理解變數應用的同學可以省略$table=$do這一行，直接使用$do即可
                    $table = $do;
                    $db = new DB($table);
                    $rows = $db->all();
                    foreach ($rows as $row) {
                        $isChk = ($row['sh'] == 1) ? 'checked' : '';
                ?>
                <tr>
                    <td width="45%"><img src='img/<?=$row['img'];?>' style="width:300px;height:30px"></td>
                    <td width="23%"><input type="text" name="text[]" value="<?=$row['text'];?>"> </td>
                    <td width="7%"><input type="radio" name="sh" value="<?=$row['id'];?>" <?=$isChk;?>> </td>
                    <td width="7%"><input type="checkbox" name="del[]" value="<?=$row['id'];?>"></td>
                    <td><input type="button" value="更新圖片"
                            onclick="op('#cover','#cvr','modal/upload_title.php?id=<?=$row['id'];?>&table=<?=$table;?>')">
                    </td>
                    <input type="hidden" name="id[]" value="<?=$row['id'];?>">
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
        <table style="margin-top:40px; width:70%;">
            <tbody>
                <tr>
                    <td width="200px"><input type="button"
                            onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;modal/title.php?table=<?=$table;?>&#39;)"
                            value="新增網站標題圖片"></td>
                    <input type="hidden" name="table" value='<?=$table;?>'>
                    <td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>