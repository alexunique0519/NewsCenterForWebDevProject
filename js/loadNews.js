jQuery(document).ready(function () {
    jQuery.ajax("http://firstphp-alexunique0519.rhcloud.com/query_temp.php").done(function (aResults) {
        if(aResults == 0)
        {
            jQuery("#info").append("Sorry, there is not News. :(");
          
            return false;
        }
        
        
        for (var n = 0; n < aResults.length; n++) {
            var oNews = aResults[n];
            var sRow = "<h1>" + oNews.title + "</h1><p>" + oNews.source + "</p><p>" + oNews.timestamp + "</p><br>" + "<img src='" + oNews.imageURL + "'" 
                        + "alt=" + oNews.title + "height = '300' width ='400'><p></p>";

            jQuery("#news").append(sRow);
           
        }

    });
    
    });