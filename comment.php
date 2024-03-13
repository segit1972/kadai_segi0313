<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>20240222_KADAI_segi</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/stylecont.css">
  <link rel="icon" type="image/png" href="images/favicon_mie.png" />
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="js/cont.js"></script>
</head>
<?php
  /////////////////////////////////////////////////////////////////////////////////////
  //初期処理
  //日時ズレ防止
  date_default_timezone_set('Asia/Tokyo');
  /////////////////////////////////////////////////////////////////////////////////////
  //MYSQL～PDO接続＝＞　データベース:surumie　／　テーブル：contactdb
  // PDO接続情報
  $dsn = 'mysql:host=127.0.0.1;dbname=surumie';
  $username = 'root';
  $password = '';
  //PDO接続処理
  try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->exec("set names utf8");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  } catch (PDOException $e) {
    exit("データベースに接続できませんでした: " . $e->getMessage());
  }

?>
<body>
  <div class="cont-button-container">
        <a href="index.html">ホーム</a>
        <a href="contact.php">お問い合わせ<br>フォーム</a>
  </div>
  <header>
    <h2>来訪者の声ページ</h2>
  </header>
  <main2>
    <div class="customerPhoto">
      <!--<img src="images/22274833.jpg">
      <img src="images/akahuku.webp">-->
    </div>
    <div id="commentSection" style="commentSection">
      <table border="1">
        <thead>
          <tr>
          <th style="width: 15%;">お客様氏名</th> <!-- 各列の幅の設定 -->
          <th style="width: 25%;">お客様メールアドレス</th>
          <th style="width: 40%;">お問い合わせ内容</th>
          </tr>
        </thead>
        <tbody>
          <!--PHPで生成される各行のデータ-->
          <?php
            // データベースからデータを取得してテーブルの各行を生成するPHPコードを記述します。
            $sql = "SELECT contname, contemail, conttext FROM contactdb WHERE displayflag = 1";
            $stmt = $pdo->query($sql);
            if ($stmt->rowCount() > 0) {
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {            
                /////////////////////////////////////////////////////////////////////////////////////////////////////////
                // レコードの背景色　：　ここで定義！！！
                /////////////////////////////////////////////////////////////////////////////////////////////////////////
                $background_color = '#dae4ae';  // 背景色を初期化
                
                // レコードのフォントカラー
                $font_color_id = '#000'; // フォントカラー設定
      
                echo "<tr style='color: $font_color_id;'>";
                echo "<td style='color: $font_color_id;'>".$row['contname']."　様</td>";
                echo "<td style='color: $font_color_id;' class='contemail-column'>".$row['contemail']."</td>";
                echo "<td style='color: $font_color_id;' class='conttext-column'>".$row['conttext']."</td>";
                echo "</tr>";
              }
            } else {
                echo "<tr><td colspan='3'>データがありません。</td></tr>";
              }
          ?>
        </tbody>
      </table>
    </div>
  </main>
  <!-- footer -->
  <footer class="footer">
    <div class="logo"><a href="https://jisouswitch.jp/"><img src="images/jisouswitch.png" alt="JISOU_SWITCH"></a></div>
    <div class="copyright">&copy; 2024 JISOU SWITCH</div>
  </footer>
  <!-- /footer -->
</body>
</html>