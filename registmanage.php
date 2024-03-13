<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>20240222_KADAI_segi</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" type="image/png" href="images/favicon_mie.png" />
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="js/main.js"></script>
</head>
<?php
  /////////////////////////////////////////////////////////////////////////////////////
  //初期処理
  //日時ズレ防止
  date_default_timezone_set('Asia/Tokyo');
  /////////////////////////////////////////////////////////////////////////////////////
  //MYSQL～PDO接続＝＞　データベース:surumie　／　テーブル：adminmie
  // PDO接続情報
  $dsn = 'mysql:host=127.0.0.1;dbname=surumie';
  $username = 'root';
  $password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->exec("set names utf8");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    exit("データベースに接続できませんでした: " . $e->getMessage());
}

// POSTリクエスト処理
  // フォームのデータを取得
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $registloginname = $_POST['registloginname'];
  $registloginemail = $_POST['registloginemail'];
  $registloginpass = $_POST['registloginpass'];
  $registloginpassre = $_POST['registloginpassre'];

  try {
      // データベースに管理者IDまたはメールアドレスが存在するかチェック
      // プリペアドステートメントを準備      
      $stmt = $pdo->prepare("SELECT * FROM adminmie WHERE adminname = :registloginname OR adminemail = :registloginemail");
      $stmt->bindParam(':registloginname', $registloginname);
      $stmt->bindParam(':registloginemail', $registloginemail);
      $stmt->execute();  // ステートメントを実行
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($result) {
        echo "<script>alert('すでに同じIDまたはメールアドレスが存在します。');</script>";
      } else {
          // パスワードをハッシュ化
          $hashed_password = password_hash($registloginpass, PASSWORD_DEFAULT);

          // JavaScriptから送信された確認ダイアログの結果を取得します
          if (isset($_POST['confirmed']) && $_POST['confirmed'] === 'yes') {
              // 新規登録
              $sql_insert = "INSERT INTO adminmie (adminname, adminemail, adminpasshash) VALUES (:registloginname, :registloginemail, :registloginpasshash)";
              $stmt_insert = $pdo->prepare($sql_insert);
              $stmt_insert->bindParam(':registloginname', $registloginname);
              $stmt_insert->bindParam(':registloginemail', $registloginemail);
              $stmt_insert->bindParam(':registloginpasshash', $hashed_password);
              $stmt_insert->execute();

              echo "<script>alert('登録しました。');</script>";
          } else {
              echo "<script>alert('登録をキャンセルしました。');</script>";
          }
      }
  } catch (PDOException $e) {
      // エラーメッセージを表示
      echo "<script>alert('データベースエラー');</script>" . $e->getMessage();
  }
}
?>
<body>
<div class="admin-regist-header">
    <h3>（お問い合わせ管理画面）</h3><br>
    <h2>管理者登録</h2>
</div>
<div class="registInputArea">
    <div class="wrap3">
        <form method="POST" action="registmanage.php">
        <div class="registmenu">
            管理者ID：<input id="registloginname" type="text" name="registloginname" value="" class="adminregist-field" /><br><br>
            メールアドレス：<input id="registloginemail" type="email" name="registloginemail" value="" class="adminregist-field" /><br><br><br>
            パスワード：<input id="registloginpass" type="password" name="registloginpass" class="adminregist-field" autocomplete="new-password"><br><br>
            パスワード（再入力）：<input id="registloginpassre" type="password" name="registloginpassre" value="" class="adminregist-field" autocomplete="new-password"><br><br>
            <div id="passmatch-alert" style="display: none; color: red;">パスワードが一致していません。</div>
        </div>
        <div class="registbtn">
        <button type="submit" id="adminregistbtn" name="adminregistbtn">登録する</button>
        </div>
        <input type="hidden" id="confirmed" name="confirmed" value="">
        </form>
    </div>
    <div class="registtologinlink">
        <button onclick="location='loginmanage.php'">管理者ログイン画面へ</button>
    </div>
</div>
    <!-- footer -->
    <footer class="footer2">
      <div class="logo2"><a href="https://jisouswitch.jp/"><img src="images/jisouswitch.png" alt="JISOU_SWITCH"></a></div>
      <div class="copyright2">&copy; 2024 JISOU SWITCH</div>
    </footer>
    <!-- /footer -->

</body>
</html>