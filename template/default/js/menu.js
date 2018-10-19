$(function () {
    $(".nav_home").on({
        mouseover: function () {
            $(".sub_mv").hide();
            $(".sub_mymusic").hide();
            $(".sub_lib").show();
        }
    });
    $(".nav_mv").on({
        mouseover: function () {
            $(".sub_lib").hide();
            $(".sub_mymusic").hide();
            $(".sub_mv").show();
        }
    });
    $(".nav_mymusic").on({
        mouseover: function () {
            $(".sub_lib").hide();
            $(".sub_mv").hide();
            $(".sub_mymusic").show();
        }
    });
    $(".nav_musicvip").on({
        mouseover: function () {
            $(".sub_lib").hide();
            $(".sub_mv").hide();
            $(".sub_mymusic").hide();
        }
    });
    $(".main_top").on({
        mouseleave: function () {
            if (_menu == "music") {
                $(".sub_mv").hide();
                $(".sub_mymusic").hide();
                $(".sub_lib").show();
            } else {
                $(".sub_lib").hide();
                $(".sub_mymusic").hide();
                $(".sub_mv").show();
            }
        }
    });
});