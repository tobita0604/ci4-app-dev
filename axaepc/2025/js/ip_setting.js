$(document).ready(function () {
    $('.btn-save').click(function () {
        var result = window.confirm('許可IPを登録します。よろしいですか？');
        if (result) {
            $('#ip_form').submit();
        }
    });

    $('.btn-edit').click(function () {
        var result = window.confirm('変更します。よろしいですか？');
        if (result) {
            $('#ip_form').submit();
        }
    });

    $('.btn-del').click(function () {
        var msg = $(this).data('msg');
        var url = $(this).data('url');
        var result = window.confirm(msg + "を削除します。よろしいですか？");
        if (result) {
            location.href = url;
        }
    });
});
