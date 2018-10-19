var setDoodle = function (fid, oid, url, tid, from) {
    $("#textarea").val($("#textarea").val() + "[img]" + url + "[/img]");
    $("#textarea").focus();
    layer.closeAll();
};
var f_getURL = function () {
    return in_path + "source/pack/upload/save.php";
};
var f_getMAX = function () {
    return 60;
};
var f_getMIN = function () {
    return 3;
};
var f_complete = function (filename) {
    if (filename == "error") {
        $("#textarea").val($("#textarea").val() + "[语音保存失败]");
    } else {
        $("#textarea").val($("#textarea").val() + "[record:" + filename.substr(9, filename.length - 13) + "]");
    }
    $("#textarea").focus();
    $(".wl_faces_box8").hide();
};
var listenMsg = {
    nid: 0,
    mid: 0,
    gid: 0,
    cid: 0,
    queryUrl: in_path + "source/plugin/webim/source/",
    stop: function () {
        clearTimeout(listenMsg.nid);
        listenMsg.nid = 0;
        clearTimeout(listenMsg.mid);
        listenMsg.mid = 0;
        clearTimeout(listenMsg.gid);
        listenMsg.gid = 0;
        clearTimeout(listenMsg.cid);
        listenMsg.cid = 0;
        $(".message_box").text("");
    },
    start: function (_uid, _type, _do) {
        ajax({
            type: "get",
            url: listenMsg.queryUrl + "start.php?ac=start&type=" + _type + "&do=" + _do + "&uid=" + _uid + "&sec=" + in_sec,
            dataType: "json",
            success: function (data) {
                if (data["start"] == -1) {
                    listenMsg.stop();
                    $("#send_tips").text("您已下线");
                    $(".chat03_content li b").text("");
                    $(".chat03_content li label").removeClass("online offline").addClass("offline");
                    if ($("#list_reload").hasClass("chat02_title_t")) {
                        $("#list_reload").removeClass("chat02_title_t").addClass("chat002_title_t");
                    }
                } else {
                    if (_type == "msg") {
                        clearTimeout(listenMsg.mid);
                        clearTimeout(listenMsg.gid);
                        if (isNaN(data["start"])) {
                            $(".close_btn").html("<span>" + getplayer("send") + "</span>");
                            $(".message_box").append(data["start"]);
                            $(".chat01_content").scrollTop($(".message_box").height());
                        }
                        listenMsg.mid = setTimeout("listenMsg.start(" + _uid + ", '" + _type + "', 0);", in_time);
                    } else {
                        if (data["status"] > 0) {
                            if ($("#uid_" + _uid + " label").hasClass("offline")) {
                                $("#uid_" + _uid + " label").html("<span>" + getplayer("online") + "</span>");
                                $("#uid_" + _uid + " label").removeClass("offline").addClass("online");
                            }
                        } else {
                            if ($("#uid_" + _uid + " label").hasClass("online")) {
                                $("#uid_" + _uid + " label").removeClass("online").addClass("offline");
                            }
                        }
                        if (data["start"] > 0) {
                            $("#uid_" + _uid + " b").html(data["start"] + "<span>" + getplayer("msg") + "</span>");
                            $(".chat03_content").animate({
                                scrollTop: $("#uid_" + _uid).offset().top - $(".chat03_content").offset().top
                            }, 100);
                        } else {
                            $("#uid_" + _uid + " b").text("");
                        }
                        listenMsg.nid = setTimeout("listenMsg.start(" + _uid + ", '" + _type + "', 0);", in_time);
                    }
                }
            }
        });
    },
    group: function (_num) {
        ajax({
            type: "get",
            url: listenMsg.queryUrl + "group.php?ac=group&num=" + _num + "&nums=" + in_num,
            dataType: "json",
            success: function (data) {
                if (data["group"] != -1) {
                    clearTimeout(listenMsg.gid);
                    if (data["num"] > _num) {
                        $(".close_btn").html("<span>" + getplayer("send") + "</span>");
                        $(".talkTo").attr("num", data["num"]);
                        $(".message_box").append(data["group"]);
                        $(".chat01_content").scrollTop($(".message_box").height());
                    }
                    listenMsg.gid = setTimeout("listenMsg.group(" + data["num"] + ");", in_time);
                }
            }
        });
    },
    count: function (_gid) {
        ajax({
            type: "get",
            url: listenMsg.queryUrl + "count.php?gid=" + _gid,
            dataType: "json",
            success: function (data) {
                if (data["count"] != -1) {
                    $("#gid_" + _gid).html("<b>" + $("#gid_" + _gid).attr("title") + "</b> " + data["count"]);
                    listenMsg.cid = setTimeout("listenMsg.count(" + _gid + ");", in_time);
                }
            }
        });
    },
    load: function () {
        $(".chat03_content").html('<img src="' + in_path + 'static/admincp/images/loading.gif">');
        listenMsg.stop();
        listenMsg.group($(".talkTo").attr("num"));
        listenMsg.list();
        $(".talkTo a").text("公共频道");
        $(".talkTo a").attr("uid", 0);
    },
    list: function () {
        ajax({
            type: "get",
            url: listenMsg.queryUrl + "list.php?ac=list",
            dataType: "json",
            success: function (data) {
                if (data["list"] != -1) {
                    if ($("#list_reload").hasClass("chat002_title_t")) {
                        $("#send_tips").text("按 Enter 键快捷发送");
                        $("#list_reload").removeClass("chat002_title_t").addClass("chat02_title_t");
                    }
                    $(".chat03_content").html(data["list"]);
                    jQuery.getScript(in_path + "static/pack/chat/js/menu.js", function () {
                        $(".chat03_content #girl li").contextMenu("menu_girl", {
                            bindings: {
                                space: function (t) {
                                    window.open(in_space.replace(/0/, t.id.substr(4)));
                                },
                                move: function (t) {
                                    pop.move(t.title, t.lang);
                                },
                                del: function (t) {
                                    pop.confirm("friend", t.lang);
                                }
                            }
                        });
                        $(".chat03_content #boy li").contextMenu("menu_boy", {
                            bindings: {
                                space: function (t) {
                                    window.open(in_space.replace(/0/, t.id.substr(4)));
                                },
                                add: function (t) {
                                    pop.add(t.title);
                                },
                                lock: function (t) {
                                    pop.confirm("other", t.id.substr(4));
                                }
                            }
                        });
                        $(".chat03_content #group").contextMenu("menu_group", {
                            bindings: {
                                insert: function (t) {
                                    layer.prompt({
                                        title: "新增分组"
                                    }, function (title) {
                                        pop.addgroup(title);
                                    });
                                },
                                edit: function (t) {
                                    layer.prompt({
                                        title: "修改分组"
                                    }, function (title) {
                                        pop.edigroup(t.lang, title);
                                    });
                                },
                                cancel: function (t) {
                                    pop.confirm("group", t.lang);
                                }
                            }
                        });
                        $(".chat03_content #preset").contextMenu("menu_preset", {
                            bindings: {
                                insert: function (t) {
                                    layer.prompt({
                                        title: "新增分组"
                                    }, function (title) {
                                        pop.addgroup(title);
                                    });
                                }
                            }
                        });
                    });
                }
            }
        });
    },
    send: function () {
        if ($("#textarea").val() == "") {
            $("#textarea").focus();
            return;
        }
        ajax({
            type: "get",
            url: listenMsg.queryUrl + "send.php?ac=send&text=" + escape($("#textarea").val()) + "&uname=" + escape($(".talkTo a").text()) + "&uid=" + $(".talkTo a").attr("uid"),
            dataType: "json",
            success: function (data) {
                if (data["send"] == -1) {
                    $("#send_tips").text("请先登录");
                } else {
                    $("#textarea").val("");
                    if ($(".talkTo a").attr("uid") > 0) {
                        listenMsg.start($(".talkTo a").attr("uid"), "msg", 1);
                    } else {
                        listenMsg.group($(".talkTo").attr("num"));
                    }
                }
            }
        });
    }
};
$(document).ready(function () {
    $("body").delegate(".chat03_content p", "click", function () {
        if ($(this).children().hasClass("friend_menu_add")) {
            $(this).children().removeClass("friend_menu_add").addClass("friend_menu_desc");
            $(this).next().show();
        } else {
            $(this).children().removeClass("friend_menu_desc").addClass("friend_menu_add");
            $(this).next().hide();
        }
    });
    $("body").delegate(".chat03_content li", "mouseover", function () {
        $(this).addClass("hover").siblings().removeClass("hover");
    });
    $("body").delegate(".chat03_content li", "mouseout", function () {
        $(this).removeClass("hover").siblings().removeClass("hover");
    });
    $("body").delegate(".chat03_content li", "click", function () {
        $(this).addClass("choosed").siblings().removeClass("choosed");
        $(this).parent().siblings().children().removeClass("choosed");
        $(".talkTo a").text($(this).children(".chat03_name").text());
        $(".talkTo a").attr("uid", $(this).children(".chat03_name").attr("uid"));
        $(".message_box").text("");
        listenMsg.start($(this).children(".chat03_name").attr("uid"), "msg", 2);
    });
    $("#_emoji").mouseover(function () {
        $(this).removeClass("ctb00").addClass("ctb01");
        $(".wl_faces_box").show();
    }).mouseout(function () {
        $(this).removeClass("ctb01").addClass("ctb00");
        $(".wl_faces_box").hide();
    });
    $("#_record").mouseover(function () {
        $(this).removeClass("ctb07").addClass("ctb08");
        $(".wl_faces_box8").show();
    }).mouseout(function () {
        $(this).removeClass("ctb08").addClass("ctb07");
        $(".wl_faces_box8").hide();
    });
    $(".ctb02").mouseover(function () {
        $(".wl_faces_box2").show();
    }).mouseout(function () {
        $(".wl_faces_box2").hide();
    });
    $(".ctb03").mouseover(function () {
        $(".wl_faces_box3").show();
    }).mouseout(function () {
        $(".wl_faces_box3").hide();
    });
    $("#_shake").mouseover(function () {
        $(this).removeClass("ctb04").addClass("ctb05");
    }).mouseout(function () {
        $(this).removeClass("ctb05").addClass("ctb04");
    });
    $("#_shake").click(function () {
        $("#textarea").val($("#textarea").val() + "[event:shake]");
        $("#textarea").focus();
    });
    $("#_upload").mouseover(function () {
        $(this).removeClass("ctb09").addClass("ctb10");
    }).mouseout(function () {
        $(this).removeClass("ctb10").addClass("ctb09");
    });
    $(".ctb06").click(function () {
        lib.doodle();
    });
    $(".wl_faces_box").mouseover(function () {
        $("#_emoji").removeClass("ctb00").addClass("ctb01");
        $(this).show();
    }).mouseout(function () {
        $("#_emoji").removeClass("ctb01").addClass("ctb00");
        $(this).hide();
    });
    $(".wl_faces_box8").mouseover(function () {
        $("#_record").removeClass("ctb07").addClass("ctb08");
        $(this).show();
    }).mouseout(function () {
        $("#_record").removeClass("ctb08").addClass("ctb07");
        $(this).hide();
    });
    $(".wl_faces_box2").mouseover(function () {
        $(this).show();
    }).mouseout(function () {
        $(this).hide();
    });
    $(".wl_faces_box3").mouseover(function () {
        $(this).show();
    }).mouseout(function () {
        $(this).hide();
    });
    $(".wl_faces_close").click(function () {
        $(".wl_faces_box").hide();
    });
    $(".wl_faces_close8").click(function () {
        $(".wl_faces_box8").hide();
    });
    $(".wl_faces_close2").click(function () {
        $(".wl_faces_box2").hide();
    });
    $(".wl_faces_close3").click(function () {
        $(".wl_faces_box3").hide();
    });
    $(".close_btn").click(function () {
        $(".message_box").text("");
    });
    $("#list_reload").click(function () {
        listenMsg.load();
    });
    $(".wl_faces_main img").click(function () {
        var i = $(this).attr("src");
        $("#textarea").val($("#textarea").val() + "[emoji:" + i.substr(i.indexOf("emoji/") + 10, 2) + "]");
        $("#textarea").focus();
        $(".wl_faces_box").hide();
    });
});