<!-- 更新のPHP　更新ボタンを押した後に出てくる画面 -->

<?php
//１．PHP
//select.phpのPHPコードをマルっとコピーしてきます。
//※SQLとデータ取得の箇所を修正します。
$id = $_GET["id"];

include("funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM php_kadai2_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

//全データ取得　1行だけとる（一番上の1行）
$v =  $stmt->fetch();




?>
<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
理由：入力項目は「登録/更新」はほぼ同じになるからです。
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>アンケートフォーム</title>

</head>
<body>
    <form method="POST" action="update.php">
        <div class="form-row">
            <label for="q1" class="form-label">Q1: 弊社サービスに対する満足度を教えてください。</label>
            <select id="q1" name="q1">
                <option value="非常に満足"<?= $v["q1_manzoku"] == "非常に満足" ? "selected" : "" ?>>非常に満足</option>
                <option value="やや満足"<?= $v["q1_manzoku"] == "やや満足" ? "selected" : "" ?>>やや満足</option>
                <option value="どちらともいえない"<?= $v["q1_manzoku"] == "どちらともいえない" ? "selected" : "" ?>>どちらともいえない</option>
                <option value="やや不満"<?= $v["q1_manzoku"] == "やや不満" ? "selected" : "" ?>>やや不満</option>
                <option value="非常に不満"<?= $v["q1_manzoku"] == "非常に不満" ? "selected" : "" ?>>非常に不満</option>
            </select>
        </div>

        <div class="form-row">
            <label for="q2" class="form-label">Q2: Q1のように回答された理由をお聞かせください。</label>
            <textarea id="q2" name="q2" rows="4" placeholder="理由を入力してください"><?=$v["q2_reason"]?></textarea>
        </div>

        <div class="form-row">
            <h3>Q3: 弊社サービスの次の点について満足度を教えてください。</h3>

            <!-- 質問① -->
            <div class="question-group">
                <p class="question-title">① 品質の良さ</p>
                <div class="options">
                    <label><input type="radio" name="q3_1" value="非常に満足"<?= $v["q3_quality"] == "非常に満足" ? "checked" : "" ?>> 非常に満足</label><br>
                    <label><input type="radio" name="q3_1" value="やや満足"<?= $v["q3_quality"] == "やや満足" ? "checked" : "" ?>> やや満足</label><br>
                    <label><input type="radio" name="q3_1" value="どちらともいえない"<?= $v["q3_quality"] == "どちらともいえない" ? "checked" : "" ?>> どちらともいえない</label><br>
                    <label><input type="radio" name="q3_1" value="やや不満"<?= $v["q3_quality"] == "やや不満" ? "checked" : "" ?>> やや不満</label><br>
                    <label><input type="radio" name="q3_1" value="非常に不満"<?= $v["q3_quality"] == "非常に不満" ? "checked" : "" ?>> 非常に不満</label>
                </div>
            </div>

            <!-- 質問② -->
            <div class="question-group">
                <p class="question-title">② 使いやすさ</p>
                <div class="options">
                    <label><input type="radio" name="q3_2" value="非常に満足"<?= $v["q3_usability"] == "非常に満足" ? "checked" : "" ?>> 非常に満足</label><br>
                    <label><input type="radio" name="q3_2" value="やや満足"<?= $v["q3_usability"] == "やや満足" ? "checked" : "" ?>> やや満足</label><br>
                    <label><input type="radio" name="q3_2" value="どちらともいえない"<?= $v["q3_usability"] == "どちらともいえない" ? "checked" : "" ?>> どちらともいえない</label><br>
                    <label><input type="radio" name="q3_2" value="やや不満"<?= $v["q3_usability"] == "やや不満" ? "checked" : "" ?>> やや不満</label><br>
                    <label><input type="radio" name="q3_2" value="非常に不満"<?= $v["q3_usability"] == "非常に不満" ? "checked" : "" ?>> 非常に不満</label>
                </div>
            </div>

            <!-- 質問③ -->
            <div class="question-group">
                <p class="question-title">③ 価格</p>
                <div class="options">
                    <label><input type="radio" name="q3_3" value="非常に満足"<?= $v["q3_price"] == "非常に満足" ? "checked" : "" ?>> 非常に満足</label><br>
                    <label><input type="radio" name="q3_3" value="やや満足"<?= $v["q3_price"] == "やや満足" ? "checked" : "" ?>> やや満足</label><br>
                    <label><input type="radio" name="q3_3" value="どちらともいえない"<?= $v["q3_price"] == "どちらともいえない" ? "checked" : "" ?>> どちらともいえない</label><br>
                    <label><input type="radio" name="q3_3" value="やや不満"<?= $v["q3_price"] == "やや不満" ? "checked" : "" ?>> やや不満</label><br>
                    <label><input type="radio" name="q3_3" value="非常に不満"<?= $v["q3_price"] == "非常に不満" ? "checked" : "" ?>> 非常に不満</label>
                </div>
            </div>

            <!-- 質問④ -->
            <div class="question-group">
                <p class="question-title">④ お客様サポート</p>
                <div class="options">
                    <label><input type="radio" name="q3_4" value="非常に満足"<?= $v["q3_support"] == "非常に満足" ? "checked" : "" ?>> 非常に満足</label><br>
                    <label><input type="radio" name="q3_4" value="やや満足"<?= $v["q3_support"] == "やや満足" ? "checked" : "" ?>> やや満足</label><br>
                    <label><input type="radio" name="q3_4" value="どちらともいえない"<?= $v["q3_support"] == "どちらともいえない" ? "checked" : "" ?>> どちらともいえない</label><br>
                    <label><input type="radio" name="q3_4" value="やや不満"<?= $v["q3_support"] == "やや不満" ? "checked" : "" ?>> やや不満</label><br>
                    <label><input type="radio" name="q3_4" value="非常に不満"<?= $v["q3_support"] == "非常に不満" ? "checked" : "" ?>> 非常に不満</label>
                </div>
            </div>
        </div>

        <div class="form-row">
            <label for="q4" class="form-label">Q4: 弊社サービスを友人や家族に勧めたいと思いますか。</label>
            <select id="q4" name="q4">
                <option value="非常にそう思う"<?= $v["q4_recommend"] == "非常にそう思う" ? "selected" : "" ?>>非常にそう思う</option>
                <option value="ややそう思う"<?= $v["q4_recommend"] == "ややそう思う" ? "selected" : "" ?>>ややそう思う</option>
                <option value="どちらともいえない"<?= $v["q4_recommend"] == "どちらともいえない" ? "selected" : "" ?>>どちらともいえない</option>
                <option value="あまりそう思わない"<?= $v["q4_recommend"] == "あまりそう思わない" ? "selected" : "" ?>>あまりそう思わない</option>
                <option value="まったくそう思わない"<?= $v["q4_recommend"] == "まったくそう思わない" ? "selected" : "" ?>>まったくそう思わない</option>
            </select>
        </div>

        <div class="form-row">
            <label for="q5" class="form-label">Q5: Q4のように回答された理由をお聞かせください。</label>
            <textarea id="q5" name="q5" rows="4" placeholder="理由を入力してください"><?=$v["q5_q4reason"]?></textarea>
        </div>

        <div class="form-row">
            <label for="q6" class="form-label">Q6: 弊社サービスについて満足な点・ご不満な点などご自由にお聞かせください。</label>
            <textarea id="q6" name="q6" rows="4" placeholder="ご意見を入力してください"><?=$v["q6_review"]?></textarea>
        </div>

        <div class="form-row">
            <label for="name" class="form-label">お名前:</label>
            <input type="text" id="name" name="name" placeholder="お名前を入力してください" value="<?=$v["name"]?>">
        </div>

        <!-- <div class="form-row">
            <label for="age" class="form-label">年齢:</label>
            <input type="number" id="age" name="age" placeholder="年齢を入力してください">
        </div> -->

        <!-- <div class="form-row">
            <label for="age" class="form-label">年齢:</label>
            <input type="number" id="age" name="age" placeholder="年齢を入力してください" min="18" max="100">
        </div> -->

        <div class="form-row">
            <label for="age" class="form-label">年齢</label>
            <select id="age" name="age">
                <option value="10代"<?= $v["age"] == "10代" ? "selected" : "" ?>>10代</option>
                <option value="20代"<?= $v["age"] == "20代" ? "selected" : "" ?>>20代</option>
                <option value="30代"<?= $v["age"] == "30代" ? "selected" : "" ?>>30代</option>
                <option value="40代"<?= $v["age"] == "40代" ? "selected" : "" ?>>40代</option>
                <option value="50代"<?= $v["age"] == "50代" ? "selected" : "" ?>>50代</option>
                <option value="60代"<?= $v["age"] == "60代" ? "selected" : "" ?>>60代</option>
                <option value="70代"<?= $v["age"] == "70代" ? "selected" : "" ?>>70代</option>
            </select>
        </div>
        

        <div class="form-row">
            <label for="gender" class="form-label">性別:</label>
            <select id="gender" name="gender">
                <option value="男性"<?= $v["seibetsu"] == "男性" ? "selected" : "" ?>>男性</option>
                <option value="女性"<?= $v["seibetsu"] == "女性" ? "selected" : "" ?>>女性</option>
            </select>
        </div>

        <div class="form-row">
            <label for="source" class="form-label">弊社サービスを知ったきっかけ:</label>
            <select id="source" name="source">
                <option value="Webサイト"<?= $v["kikkake"] == "Webサイト" ? "selected" : "" ?>>Webサイト</option>
                <option value="SNS"<?= $v["kikkake"] == "女性" ? "SNS" : "" ?>>SNS</option>
                <option value="検索エンジン"<?= $v["kikkake"] == "検索エンジン" ? "selected" : "" ?>>検索エンジン</option>
                <option value="知人の紹介"<?= $v["kikkake"] == "知人の紹介" ? "selected" : "" ?>>知人の紹介</option>
                <option value="その他"<?= $v["kikkake"] == "その他" ? "selected" : "" ?>>その他</option>
            </select>
        </div>

        <div class="form-row">
            <label for="frequency" class="form-label">弊社サービスのご利用頻度:</label>
            <select id="frequency" name="frequency">
                <option value="1週間に1回以上"<?= $v["hindo"] == "1週間に1回以上" ? "selected" : "" ?>>1週間に1回以上</option>
                <option value="1ヶ月に1回以上"<?= $v["hindo"] == "1ヶ月に1回以上" ? "selected" : "" ?>>1ヶ月に1回以上</option>
                <option value="半年に1回以上"<?= $v["hindo"] == "半年に1回以上" ? "selected" : "" ?>>半年に1回以上</option>
                <option value="その他"<?= $v["hindo"] == "その他" ? "selected" : "" ?>>その他</option>
            </select>
        </div>

        <button type="submit">送信</button>
        <input type="hidden" name="id" value="<?=$v["id"]?>">
        </form>
</body>
</html>


