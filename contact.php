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
<body>
  <div class="cont-button-container">
        <a href="index.html">ホーム</a>
        <a href="comment.php">コメント<br>セクション</a>
  </div>
  <header>
    <h2>お問い合わせフォーム</h2>
  </header>
  <div class="wrap">  <!--最大枠-->
    <nav id= "nav">
      <img id="logo" name="logo" src="images/logo_mie.png" alt="ロゴ"><br>
    </nav>
    <main id="main" name="main">
    <form id="contactForm" action="contact.php" method="POST">
        お名前：<br />
        <input id="contname" type="text" name="contname" value="" class="input-field" /><br><br>
        メールアドレス：<br />
        <input id="contemail" type="text" name="contemail" value="" class="input-field" /><br><br>
        お問い合わせ内容：<br />
        <textarea id="conttext" name="conttext" class="input-field"></textarea><br>
        <span id="count" name="count">0</span>/1000 文字<br><br><br>            
        <button type="submit" id="contformbtn" name="contformbtn">送信する</button>
    </form>
    </main>
  </div>
<?php
  /////////////////////////////////////////////////////////////////////////////////////
  //初期処理
  //日次ズレ防止
  date_default_timezone_set('Asia/Tokyo');
  /////////////////////////////////////////////////////////////////////////////////////
  //MYSQL接続＝＞　データベース:surumie　／　テーブル：contactdb
  // PDO接続情報
  $dsn = 'mysql:host=127.0.0.1;dbname=surumie';
  $username = 'root';
  $password = '';
  try {
      // PDOインスタンスの生成
      $pdo = new PDO($dsn, $username, $password);
      // 文字コード設定
      $pdo->exec("set names utf8");
      // エラーモードを例外に設定
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //echo "データベースに接続しました。";
  } catch (PDOException $e) {  // 接続エラー時の処理
      exit("データベースに接続できませんでした: " . $e->getMessage());
  }
  // フォームのデータを取得
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contname = $_POST['contname'];
    $contemail = $_POST['contemail'];
    $conttext = $_POST['conttext'];
    try {
        // SQL文を準備
        $sql = "INSERT INTO contactdb (id, contname, contemail, conttext, displayflag) VALUES (0, :contname, :contemail, :conttext, 0)";

        // プリペアドステートメントを準備
        $stmt = $pdo->prepare($sql);

        // パラメータに値をバインド
        $stmt->bindParam(':contname', $contname, PDO::PARAM_STR);
        $stmt->bindParam(':contemail', $contemail, PDO::PARAM_STR);
        $stmt->bindParam(':conttext', $conttext, PDO::PARAM_STR);

        // ステートメントを実行
        $stmt->execute();

        // 成功メッセージを表示
        echo "データが正常に送信されました。";
    } catch(PDOException $e) {
        // エラーメッセージを表示
        echo "データベースエラー: " . $e->getMessage();
    }
  }
?>
  <!-- footer -->
  <footer class="footer">
    <div class="logo"><a href="https://jisouswitch.jp/"><img src="images/jisouswitch.png" alt="JISOU_SWITCH"></a></div>
    <div class="copyright">&copy; 2024 JISOU SWITCH</div>
  </footer>
  <!-- /footer -->
</body>
</html>