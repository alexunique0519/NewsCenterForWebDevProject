$("#edit").submit(function () {
    //console.log($(this).serializeArray());

    var title = $("#title").val();
    var category = $("#category").val();
    var article = $("#article").val();
    var link = $("#link").val();

    if (title == '' || category == '' || article == '' || link == '') {
        alert("Please Fill All Info");
    } else {

        jQuery.ajax({
            type: 'post',
            dataType: "json",
            url: "http://firstphp-alexunique0519.rhcloud.com/upload.php",
            data: {
                'title_name': title,
                'category_name': category,
                'article_name': article,
                'link_name': link
            },
            success: function (data) {
                alert(data.result);
            },
            error: function () {
                alert("submission failed");
            }
        });

    }
    return false;
});