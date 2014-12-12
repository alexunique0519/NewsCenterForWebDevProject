$("#edit").submit(function () {
    var title_ = $("#title").val();
    var category_ = $("#category").val();
    var article_ = $("#article").val();
    var link_ = $("#link").val();
    var source_ = $("#source").val();

    if (title_ == '' || category_ == '' || article_ == '' || link_ == '' || source_ == '') {
        alert("Please Fill All Info");
    } else {
        jQuery.ajax({
            type: 'post',
            dataType: "json",
            url: "http://firstphp-alexunique0519.rhcloud.com/upload.php",
            data: {
                'source_name': source_,
                'title_name': title_,
                'category_name': category_,
                'article_name': article_,
                'link_name': link_
            },
            success: function (data) {
                alert(data.result);
                window.location.href="index.html";
            },
            error: function () {
                alert("submission failed");
            }
        });

    }
    return false;
});