$(function () {
    //
    function updateGradeList(params) {

        $.ajax({
            url: window.location.pathname, // 現在のパス
            type: 'GET',
            data: params,
            dataType: 'html',
            beforeSend: function () {
                $('#grade-list').css('opacity', '0.5');
            }
        })
            .done(function (data) {
                // サーバーから返ってきたHTMLでテーブルエリアを更新
                $('#grade-list').html(data);
            })
            .fail(function () {
                alert('成績の取得に失敗しました。');
            })
            .always(function () {
                $('#grade-list').css('opacity', '1.0');
            });
    }

    // 検索ボタンクリック
    $('#ajax-grade-search-btn').on('click', function () {
        const params = {
            search_grade: $('#search-grade').val(),
            search_term: $('#search-term').val()
        };
        updateGradeList(params);
    });
});