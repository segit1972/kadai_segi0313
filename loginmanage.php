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
  //PDO接続処理
  try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->exec("set names utf8");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  } catch (PDOException $e) {
    exit("データベースに接続できませんでした: " . $e->getMessage());
  }

// POSTリクエスト処理
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // フォームから送られてきた管理者IDとパスワードを取得します
  $adminname = $_POST['adminname'];
  $adminpass = $_POST['adminpass'];
  
  // データベースから管理者IDとハッシュ化されたパスワードを取得します
  try {
      // SQL文を準備します
      $sql = "SELECT * FROM adminmie WHERE adminname = :adminname";
      // SQLを実行する準備をします
      $stmt = $pdo->prepare($sql);
      // プレースホルダーに値をバインドします
      $stmt->bindParam(':adminname', $adminname);
      // SQL文を実行します
      $stmt->execute();
      // 結果を取得します
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      // 結果が取得できたか確認します
      if ($result) {
          // ハッシュ化されたパスワードの一致を確認します
          if (password_verify($adminpass, $result['adminpass'])) {
              // ログイン成功の処理
              echo '<script>alert("ログインしました。"); window.location.href = "manage.php";</script>';
              // ログイン成功後、manage.phpにリダイレクトします
          } else {
              // ログイン失敗の処理
              echo '<script>alert("管理者ID もしくは パスワード が違います。");</script>';
              // ログイン失敗時、ログインページにとどまります（何もしない）
          }
      } else {
          // ログイン失敗の処理
          echo '<script>alert("管理者ID もしくは パスワード が違います。");</script>';
          // ログイン失敗時、ログインページにとどまります（何もしない）
      }
  } catch (PDOException $e) {
      // エラーが発生した場合の処理
      exit("データベースエラー: " . $e->getMessage());
  }
}






?>
<body>
    <div class="admin-login-header">
      <h3>（お問い合わせ管理画面へ）</h3><br>
      <h2>管理者ログイン</h2>
    </div>
    <div class="loginInputArea">
        <div class="wrap2">
            <form id="adminloginForm" action="loginmanage.php" method="POST">
                管理者ＩＤ：<input id="adminname" type="text" name="adminname" value="" class="admininput-field" /><br><br>
                パスワード：<input id="adminpass" type="password" name="adminpass" value="" class="admininput-field" /><br><br><br>
                <button type="submit" id="adminloginbtn" name="adminloginbtn" disabled>ログインする</button>
            </form>
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