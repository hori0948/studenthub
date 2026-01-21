$(function () {

    // 検索中に「全表示に戻る」ボタンを表示する
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('grade') || urlParams.get('studentname')) {
        $('#reset-button').show();
    }

    function updateStudentList(url, params) {

        $.ajax({
            url: url,
            type: 'GET',
            data: params,
            dataType: 'html',
            beforeSend: function () {
                $('#student-list').css('opacity', '0.5');
            }
        })
            .done(function (data) {
                // サーバーから受け取ったHTMLでテーブル部分を書き換え
                $('#student-list').html(data);

                // 検索パラメータの有無で「全表示に戻る」ボタンの表示を切り替え
                if (params.grade || params.studentname) {
                    $('#reset-button').show();
                } else {
                    $('#reset-button').hide();
                }
            })
            .fail(function (xhr) {
                console.error('通信失敗:', xhr.responseText);
                alert('通信に失敗しました。');
            })
            .always(function () {
                $('#student-list').css('opacity', '1.0');
            });
    }

    // 検索ボタンクリック時
    $('#ajax-search-btn').on('click', function () {
        const params = {
            grade: $('#search-grade').val(),
            studentname: $('#search-name').val()
        };
        updateStudentList(window.location.href, params);
    });

    // 学年ソートクリック時（動的要素に対応）
    $(document).on('click', '#sort-grade', function (e) {
        e.preventDefault();

        const params = {
            grade: $('#search-grade').val(),
            studentname: $('#search-name').val(),
            sort: 'grade',
            order: $(this).data('order')
        };
        updateStudentList(window.location.href, params);
    });
});