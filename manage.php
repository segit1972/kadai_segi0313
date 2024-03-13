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

    // トグルスイッチの変更を反映する
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $contid = $_POST['contid'];
        $displayflag = $_POST['displayflag'];

        $stmt = $pdo->prepare("UPDATE contactdb SET displayflag = :displayflag WHERE contid = :contid");
        $stmt->execute(['displayflag' => $displayflag, 'contid' => $contid]);
        
        exit(); // データベースの更新後に即座に終了する
    }
    } catch (PDOException $e) {
        exit("データベースに接続できませんでした: " . $e->getMessage());
    }

?>
<body>
  <div class="cont-button-container">
        <a href="index.html">ホーム</a>
        <a href="contact.php">お問い合わせ<br>フォーム</a>
        <a href="comment.php">コメント<br>セクション</a>
  </div>
  <header>
    <h2>お問い合せ管理ページ</h2>
  </header>
  <div id="contactList">
    <table border="1">
      <thead>
        <tr>
        <th style="width: 5%;">管理ID</th> <!-- 各列の幅の設定 -->
        <th style="width: 20%;">お客様氏名</th>
        <th style="width: 25%;">お客様メールアドレス</th>
        <th style="width: 40%;">お問い合わせ内容</th>
        <th style="width: 15%;"><span class="titlehidden">非表示</span>⇔<span class="titlevisible">表示</span></th>
        </tr>
      </thead>
      <tbody>
        <!--PHPで生成される各行のデータ-->
        <?php
          // データベースからデータを取得してテーブルの各行を生成するPHPコードを記述します。
          $sql = "SELECT contid, contname, contemail, conttext, displayflag FROM contactdb";
          $stmt = $pdo->query($sql);

          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // レコードの表示/非表示状態に応じてクラス設定
            $class = $row['displayflag'] ? 'green-bg' : 'red-bg';
            
            /////////////////////////////////////////////////////////////////////////////////////////////////////////
            // レコードの背景色　：　ここで定義！！！
            /////////////////////////////////////////////////////////////////////////////////////////////////////////
            $background_color = '#fff';  // 背景色を初期化
            
            // レコードのフォントカラー
            $font_color_id = '#000'; // 問い合わせid（contid）列は常に表示
            $font_color_others = $row['displayflag'] ? '#000' : 'transparent'; // contname, contemail, conttext列のフォントカラー設定
  
            echo "<tr class='$class'>";
            echo "<td>".$row['contid']."</td>";
            echo "<td>".$row['contname']."</td>";
            echo "<td class='contemail-column'>".$row['contemail']."</td>";
            echo "<td class='conttext-column'>";
            echo "<div class='comment-wrapper'>";
            $conttext = $row['conttext'];
            $display_conttext = mb_substr($conttext, 0, 20, "UTF-8"); // 最初の20文字のみ表示
            // 文字数が20文字を超える＝＞"..."を追加
            $display_conttext_with_dots = mb_strlen($conttext, "UTF-8") > 20 ? $display_conttext . '...' : $display_conttext;
            echo "<span class='full-text'>" . htmlspecialchars($display_conttext_with_dots, ENT_QUOTES, 'UTF-8') . "</span>";
              // 文字数が16文字を超える＝＞全体表示ボタン
            if (mb_strlen($conttext, "UTF-8") > 20) {
                echo "<button class='show-full-text-btn' data-hidden-text='" . htmlspecialchars($conttext, ENT_QUOTES, 'UTF-8') . "'>全体表示</button>";
            }
            echo "<button class='show-simple-text-btn'>縮小表示</button>"; // 縮小表示ボタン
            echo "</div>"; // .comment-wrapperの終了
            echo "</td>";
            echo "<td>";
            echo "<label class='switch'>";
            echo "<input type='checkbox' class='toggle-switch' data-contid='" . $row['contid'] . "' " . ($row['displayflag'] == 1 ? 'checked' : '') . ">";
            echo "<span class='slider'></span>";
            echo "</label>";
            echo "</td>";
            echo "</tr>";
            }
        ?>
      </tbody>
    </table>
  </div>
  <!-- footer -->
  <footer class="footer">
    <div class="logo"><a href="https://jisouswitch.jp/"><img src="images/jisouswitch_mini.png" alt="JISOU_SWITCH"></a></div>
    <div class="copyright">&copy; 2024 JISOU SWITCH</div>
  </footer>
  <!-- /footer -->
</body>
</html>