$(document).ready(function() {

//////////////////////////////////////////////////////////////////////////////
//お問い合わせ　送信フォーム
var typingTimer;

$('#contname').on('keyup', function() {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(validateName, 300); // 300ミリ秒後にバリデーションを実行
});

$('#contemail').on('keyup', function() {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(validateEmail, 300); // 300ミリ秒後にバリデーションを実行
});

$('#conttext').on('input', function() {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(validateTextAndCountCharacters, 300); // 300ミリ秒後にバリデーションを実行
});

$('#contemail').on('blur', function() {
    validateEmail(); // フォーカスが外れたときにもバリデーションを実行
});

function validateName() {
    var name = $('#contname').val().trim();
    var isValid = name !== '' && !/^\s+$/.test(name); // 空欄でないこと、スペース文字のみでないこと
    var isValidLength = name.length <= 50;

    $('#contname').toggleClass('input-invalid', !(isValid && isValidLength));
    $('#contname').toggleClass('input-valid', isValid && isValidLength);

    return isValid && isValidLength;
}

function validateEmail() {
    var email = $('#contemail').val().trim();
    var isValidFormat = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email); // 正しいメールアドレスの形式かどうか
    var isValidLength = email.length <= 255;

    $('#contemail').toggleClass('input-invalid', !(isValidFormat && isValidLength));
    $('#contemail').toggleClass('input-valid', isValidFormat && isValidLength);

    return isValidFormat && isValidLength;
}

function validateTextAndCountCharacters() {
    var text = $('#conttext').val().trim();
    var length = text.length;
    var isValid = text !== '' && text.split(' ').join('') !== '' && length <= 1000; // 空欄でないこと、1000文字以内であること

    // 入力フィールドの色を変更
    if (length > 1000) {
        $('#count').css('color', 'red');
        $('#conttext').addClass('input-invalid');
        alert('文字数を超えています。');
    } else {
        $('#count').css('color', 'black');
        $('#conttext').removeClass('input-invalid');
    }

    $('#count').text(length);

    $('#conttext').toggleClass('input-invalid', !isValid);
    $('#conttext').toggleClass('input-valid', isValid);

    return isValid;
}

$('#contactForm').submit(function(e) {
    e.preventDefault();

    // バリデーションチェック
    if (!validateName() || !validateEmail() || !validateTextAndCountCharacters()) {
    // NGの場合はアラートを表示して処理を終了
    alert('入力内容を確認してください。');
    return;
}

var confirmed = confirm("本当に送信しますか？");// 送信前確認ダイアログ

if (!confirmed) {
    return;
}

// バリデーションを満たした場合、フォームを送信
$.ajax({
    url: $(this).attr('action'),
    type: 'POST',
    data: $(this).serialize(),
    success: function(response) {
        alert('お問い合わせが送信されました。');
        $('#contactForm')[0].reset();
    },
    error: function(xhr, status, error) {
        alert('エラーが発生しました。もう一度お試しください。');
    }
});
});

////////////////////////////////////////////////////////////////////////////
//問い合わせ管理ページ
////////////////////////////////////////////////////////////////////////////

$('.show-simple-text-btn').hide();

// 全体表示
$('.show-full-text-btn').click(function() {
    var hiddenText = $(this).data('hidden-text');
    $(this).siblings('.full-text').text(hiddenText);
    $(this).hide(); // 全体表示ボタンを非表示にする
    $(this).siblings('.show-simple-text-btn').show(); // 縮小表示ボタンを表示する
});

// 縮小表示
$('.show-simple-text-btn').click(function() {
    var displayText = $(this).siblings('.full-text').text().substr(0, 20); // 最初の20文字のみ表示
    displayText += "...";
    $(this).siblings('.full-text').text(displayText);
    $(this).hide(); // 縮小表示ボタンを非表示にする
    $(this).siblings('.show-full-text-btn').show(); // 全体表示ボタンを表示する
});

// トグルスイッチの変更検知
$('.toggle-switch').on('change', function() {
    var contid = $(this).data('contid');
    var displayflag = this.checked ? 1 : 0;

    // トグルスイッチが右に変更された場合のみ確認ダイアログ表示
    if (this.checked) {
        var confirmed = confirm("内容を表示してよろしいですか？");
        if (!confirmed) {
            $(this).prop('checked', !this.checked); // トグルスイッチ戻す
            return;
        }
    }

    // Ajaxリクエスト送信
    $.ajax({
        type: 'POST',
        url: 'manage.php',
        data: { contid: contid, displayflag: displayflag },
        success: function(response) {
            var $toggleSwitch = $('.toggle-switch[data-contid="' + contid + '"]');
            var $row = $toggleSwitch.closest('tr');

            if (displayflag == 1) {
                $row.removeClass('red-bg').addClass('green-bg');
            } else {
                $row.removeClass('green-bg').addClass('red-bg');
            }
        },
        error: function(xhr, status, error) {
            console.error('エラー:', error);
        }
    });
});



});  //$(document).ready(function() {・・・の終わり