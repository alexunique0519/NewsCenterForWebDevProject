jQuery(document).ready(function () {
    jQuery.ajax("http://firstphp-alexunique0519.rhcloud.com/query_temp.php").done(function (aResults) {
        if(aResults == 0)
        {
            jQuery("#info").append("Sorry, there is nothing to delete. :(");
            $("#submit").remove();
            $("#newslist").remove();
            return false;
        }


        for (var n = 0; n < aResults.length; n++) {
            var oNews = aResults[n];
            var sRow = "<tr><td>" + oNews.id + "</td><td>" + oNews.title + "</td><td>" + oNews.timestamp + "</td><td>" + "<input type='checkbox' name='ids'" + "value=" + oNews.id + ">" + "</td></tr>";

            jQuery("#newslist").append(sRow);

        }

    });


    $("#delete").submit(function () {

        var checked = $('input[name="ids"]:checked');
        var checkedValues = [];
        checked.each(function (i) {

            // add checked values to our temporary list
            checkedValues.push(checked[i].value);
        });

        jQuery.ajax({
            type: 'post',
            dataType: "json",
            url: "http://firstphp-alexunique0519.rhcloud.com/delete.php",
            data: {
                'ids': checkedValues
            },
            success: function (data) {
                alert(data.result);
                window.location.href = "delete.html"
            },
            error: function () {
                alert("delete failed");
            }
        });
        return false;
    });


});