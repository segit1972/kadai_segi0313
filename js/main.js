/*//////////////////////////////////////////////////////////////////////////
//index.html  ホームヘッダー：ハンバーガーメニュー　ホバーしてメニュー出る
//////////////////////////////////////////////////////////////////////////*/
function showMenuOnHover() {
    var menuItems = document.getElementById("menuItems");
    menuItems.style.display = "block";

    setTimeout(function() {
      menuItems.style.display = "none";
    }, 5000); // メニュー非表示までの時間　5 seconds (5000 milliseconds)
}
function hideMenuOnHover() {
  var menuItems = document.getElementById("menuItems");
  var isHovered = false;

  menuItems.addEventListener("mouseenter", function() {
      isHovered = true;
  });

  menuItems.addEventListener("mouseleave", function() {
      isHovered = false;
      setTimeout(function() {
          if (!isHovered) {
              menuItems.style.display = "none";
          }
      }, 800); // マウスがメニューから離れてから0.8秒後に非表示
  });
}

$(document).ready(function() {  //読み込み完了待ち　＝＞　ホバーメニュー動作に影響

////////////////////////////////////////////////////////////////////////////
//loginmanage.php　ログイン画面：                ＝＞問い合わせ管理ページ　　
////////////////////////////////////////////////////////////////////////////

// 管理者IDの入力欄でのリアルタイムバリデーション
$('#adminname').on('input', function() {
    validateAdminName(); // バリデーションを実行
});

// メールアドレスの入力欄でのリアルタイムバリデーション
$('#adminemail').on('input', function() {
    validateAdminEmail(); // バリデーションを実行
});

// パスワードの入力欄でのリアルタイムバリデーション
$('#adminpass').on('input', function() {
    validateAdminPass(); // バリデーションを実行
});

$('#adminloginForm').submit(function(e) {
    e.preventDefault();

    // バリデーションチェック
    if (!validateAdminName() || !validateAdminPass()) {
        // NGの場合はアラートを表示して処理を終了
        alert('入力内容を確認してください。');
        return;
    }
});

function validateAdminName() {
    var name = $('#adminname').val().trim();
    var isValid = name !== '' && !/^\s+$/.test(name); // 空欄でないこと、スペース文字のみでないこと
    var isValidLength = name.length <= 50;

    $('#adminname').toggleClass('input-invalid', !(isValid && isValidLength));
    $('#adminname').toggleClass('input-valid', isValid && isValidLength);

    checkLoginButton(); // ログインボタンをチェック
    return isValid && isValidLength; // 追加
}

function validateAdminPass() {
    var pass = $('#adminpass').val().trim(); // 変数名修正
    var isValid = pass !== '' && pass.length >= 8 && pass.length <= 15; // パスワードの長さをチェック

    $('#adminpass').toggleClass('input-invalid', !isValid);
    $('#adminpass').toggleClass('input-valid', isValid);

    checkLoginButton(); // ログインボタンをチェック
    return isValid; // 追加
}

function checkLoginButton() {
    var nameValid = $('#adminname').hasClass('input-valid');
    var passValid = $('#adminpass').hasClass('input-valid');

    if (nameValid && passValid) {
        $('#adminloginbtn').prop('disabled', false); // 全ての入力が有効な場合、ログインボタンを有効にする
    } else {
        $('#adminloginbtn').prop('disabled', true); // 入力が不完全な場合、ログインボタンを無効にする
    }
}

////////////////////////////////////////////////////////////////////////////
//registmanage.php　＝＞管理者登録ページ　登録画面：　
////////////////////////////////////////////////////////////////////////////
$('#adminregistbtn').click(function(event) {
    // バリデーションチェック
    if (!validateAdminName() || !validateAdminEmail() || !validateAdminPass() || !validateAdminPassMatch()) {
        // NGの場合はアラートを表示して処理を終了
        alert('入力内容を確認してください。');
    }
});

$('#registloginpass, #registloginpassre').on('input', function() {
    validateAdminPassMatch(); // パスワード一致チェック
});

// 管理者IDの入力欄でのリアルタイムバリデーション
$('#registloginname').on('input', function() {
    validateAdminName(); // バリデーションを実行
});

// メールアドレスの入力欄でのリアルタイムバリデーション
$('#registloginemail').on('input', function() {
    validateAdminEmail(); // バリデーションを実行
});

// パスワードの入力欄でのリアルタイムバリデーション
$('#registloginpass').on('input', function() {
    validateAdminPass(); // バリデーションを実行
});

function validateAdminName() {
    var name = $('#registloginname').val().trim();
    var isValid = name !== ''; // 空欄でないこと

    $('#registloginname').toggleClass('input-invalid', !isValid);
    $('#registloginname').toggleClass('input-valid', isValid);

    checkRegisterButton(); // 登録ボタンをチェック
    return isValid;
}

function validateAdminEmail() {
    var email = $('#registloginemail').val().trim();
    var isValidFormat = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email); // バリデーションパターンに合致するか
    var isValidCharacters = /^[\x20-\x7E]+$/.test(email); // 文字が半角のみか

    var isValid = isValidFormat && isValidCharacters;

    $('#registloginemail').toggleClass('input-invalid', !isValid);
    $('#registloginemail').toggleClass('input-valid', isValid);

    checkRegisterButton(); // 登録ボタンをチェック
    return isValid;
}

function validateAdminPass() {
    var pass = $('#registloginpass').val().trim();
    var isValid = pass !== '' && pass.length >= 8 && pass.length <= 15; // パスワードの長さをチェック

    $('#registloginpass').toggleClass('input-invalid', !isValid);
    $('#registloginpass').toggleClass('input-valid', isValid);

    checkRegisterButton(); // 登録ボタンをチェック
    return isValid;
}

function validateAdminPassMatch() {
    var pass = $('#registloginpass').val().trim();
    var passre = $('#registloginpassre').val().trim();
    var isValid = pass === passre; // パスワードと再入力が一致するかどうか

    $('#registloginpass').toggleClass('input-invalid', !isValid);
    $('#registloginpassre').toggleClass('input-valid', isValid);

    if (!isValid) {
        $('#passmatch-alert').show(); // パスワードが一致しない場合、アラートを表示
    } else {
        $('#passmatch-alert').hide(); // 一致する場合は非表示
    }

    checkRegisterButton(); // 登録ボタンをチェック
    return isValid;
}

function checkRegisterButton() {
    var nameValid = $('#registloginname').hasClass('input-valid');
    var emailValid = $('#registloginemail').hasClass('input-valid');
    var passValid = $('#registloginpass').hasClass('input-valid');
    var passMatch = $('#registloginpassre').hasClass('input-valid'); // パスワード一致

    if (nameValid && emailValid && passValid && passMatch) {
        $('#adminregistbtn').prop('disabled', false);
        $('#adminregistbtn').addClass('active-button');
    } else {
        $('#adminregistbtn').prop('disabled', true);
        $('#adminregistbtn').removeClass('active-button');
    }
}
// 登録ボタンクリック
$('#adminregistbtn').click(function(event) {
    var confirmation = confirm("登録しますか？");

    // ユーザーがOKを選択した場合の処理
    if (confirmation) {
        // フォームの送信フラグをセットしてフォームを送信
        $('#confirmed').val('yes');
        $('#registForm').submit(); // フォームの送信をトリガー
    } else {
        // キャンセルクリック＝＞フォームの送信をキャンセル
        event.preventDefault();
        return false;
    }
});

});