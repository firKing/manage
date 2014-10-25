

//搜索
var button = $("#button");
var search = $("#search");
var succedaneum = $("#succedaneum");

button.click(function(){
    button.css("display","none");
    succedaneum.css("display","block");
    succedaneum.animate({width:'210px'},"slow");
    succedaneum.animate({width:'13.125rem'},"slow");
    setTimeout(function(){
        succedaneum.css("display","none");
        search.css("display","block");
    },1000);
});


//查看全文
var open = $(".content_open span");
var in_height = $("#task2 .in").height();

open.each(function(){
    var obj = $(this);
    var info = obj.parent().parent().children('.info');
    obj.attr("name","close");
    obj.click(function(){
        if(obj.attr("name") == "close"){
            info.css("display","block");
            in_height = $("#task2 .in").height();
            info.css("display","none");
            info.slideDown(500);
            setTimeout(function(){
                obj.html('收起');
                obj.attr("name","open");
            },500);
            changeHeight();
        }else{
            info.css("display","none");
            in_height = $("#task2 .in").height();
            info.css("display","block");
            info.slideUp(500);
            setTimeout(function(){
                obj.html('查看全文');
                obj.attr("name","close");
                changeHeight();
            },500);
        }
    });
});



//弹出
var popover = $('#theme-popover');
var changePass = $("#changepass");
var wenda = $('#wenda');
var message = $("#message");
var reply = $("#reply");
var mask = $('.theme-popover-mask');

function extend(obj){
    mask.fadeIn(500);
    obj.slideDown(500);
}
function shrink(obj){
    mask.fadeOut(500);
    obj.slideUp(500);
}

$('.login').click(function(){
    extend(popover);
});
$('#theme-popover .close').click(function(){
    shrink(popover);
});

$(".menu .changepass").click(function(){
    extend(changePass);
});
$('#changepass .close').click(function(){
    shrink(changePass);
});

$(".upload").click(function(){
    extend(wenda);
});
$('#wenda .close').click(function(){
    shrink(wenda);
});

$(".change").click(function(){
    extend(message);
});
$('#message .close').click(function(){
    shrink(message);
});

$(".que").click(function(){
    extend(reply);
    var attr_id = $(this).attr('id');
    $('#reply').attr('class',attr_id);
});
$('#reply .reply_close').click(function(){
    shrink(reply);
});



//伸缩菜单
var user = $(".use");
var menu = $(".menu");
var from_fa = $(".from_fa");
var form = $(".form");
var time = 0;
var Time = 0;
var mask_fff = $('.theme-popover-mask-fff');

user.click(function(){
    time++;
    if(time%2){
        user.css("background-color","#353535");
        user.children("p").css("color","#fff");
        menu.slideDown(500);
        mask_fff.fadeIn(500);
    }else{
        menu.slideUp(500);
        setTimeout(function(){
            user.css("background-color","#303030");
            user.children("p").css("color","#a4a4a4");
        },500);
        mask_fff.fadeOut(500);
    }
});

$(".form").click(function(){
    Time++;
    if(Time%2){
        from_fa.css("background-color","#E9E9E9");
        form.slideDown(500);
        mask_fff.fadeIn(500);
    }else{
        form.slideUp(500);
        setTimeout(function(){
            from_fa.css("background-color","#f5f5f5");
        },500);
        mask_fff.fadeOut(500);
    }
});

from_fa.click(function(){
    Time++;
    if(Time%2){
        from_fa.css("background-color","#E9E9E9");
        form.slideDown(500);
        mask_fff.fadeIn(500);
    }else{
        form.slideUp(500);
        setTimeout(function(){
            from_fa.css("background-color","#f5f5f5");
        },500);
        mask_fff.fadeOut(500);
    }
});

mask_fff.click(function(){
    menu.slideUp(500);
    form.slideUp(500);
    setTimeout(function(){
        user.css("background-color","#303030");
        user.children("p").css("color","#a4a4a4");
        from_fa.css("background-color","#f5f5f5");
    },500);
    mask_fff.fadeOut(500);
    time = 0;
    Time = 0;
});

//修改高度
function changeHeight(){
    var aside = $("#aside");
    var content = $("#content");
    Width = document.documentElement.clientWidth;
    var lump = $(".lump");
    var out = $("#content .out");
    if(Width < 1000){
        Width = 1000;
    }
    lump.css("width",(Width-620)*.9);
    out.css("width",(Width-620)*.9);
    content.css("width",Width-620);
    out.css("height",in_height);
    var height = content.height();
    aside.css("height",height);

}
$(window).resize(function() {
    changeHeight();
});
changeHeight();

//轮播
var toDo = $(".to_do");
var outOfDate = $(".out_of_date");
var done = $(".done");
var valid = $(".valid");
var vain = $(".vain");
var task = $("#task");
var _in = $("#task1 .in");
var _In = $("#task2 .in");

function slide(fa,_in,Left,obj){
    hide();
    fa.css("display","block");
    in_height = _in.height();
    changeHeight();
    var onclick = $(".onclick");
    onclick.removeClass("onclick");
    _in.animate({left:Left},"slow");
    obj.addClass("onclick");
}

toDo.click(function(){
    slide($("#task1"),_in,0,toDo);
});
outOfDate.click(function(){
    slide($("#task1"),_in,-(Width-620)*.9,outOfDate);
});
done.click(function(){
    slide($("#task1"),_in,-(Width-620)*1.8,done);
});
valid.click(function(){
    slide($("#task2"),_In,0,valid);
    task.addClass("onclick");
});
vain.click(function(){
    slide($("#task2"),_In,-(Width-620)*.9,vain);
    task.addClass("onclick");
});
$("#task").click(function(){
    slide($("#task2"),_In,0,valid);
    task.addClass("onclick");
});


//左侧导航
function navigation(obj,nav){
    hide();
    obj.css("display","block");
    var onclick = $(".onclick");
    onclick.removeClass("onclick");
    nav.addClass("onclick");
    $(".task li").addClass("onclick");
}

$("#question").click(function(){
    navigation($("#que"),$("#question"));
});
$("#address").click(function(){
    navigation($("#addressbook"),$("#address"));
});
$("#share").click(function(){
    navigation($("#share_"),$("#share"));
});


//隐藏
function hide(){
    $("#task1").css("display","none");
    $("#task2").css("display","none");
    $("#addressbook").css("display","none");
    $("#que").css("display","none");
    $("#share_").css("display","none");
}

hide();
$("#task2").css("display","block");
changeHeight();

//上传文件
$('.up').click(function() {
    $('#upload_file').css("display","block");
});
$('.upload_file_close').click(function(){
    $('#upload_file').css("display","none");
});

//wenda MORE
(function(){
    $("#more").click(function(){
        $('#more').css('display','none');
        $('#less').css('display','block');
        $('.answer_none').css('display','block');
    });
    $("#less").click(function(){
        $('#less').css('display','none');
        $('#more').css('display','block');
        $('.answer_none').css('display','none');
    });
})();

/*//通讯录更多
var page_num = 0;
$('.phone_more').click(function(){
    $.ajax({
             type: "POST",
             url: url,
             dataType: "json",
             success: function(data){
                        if (data.status==200) {
                                var this_page = data.phone.page[num];
                                for(var i = 0; i < this_page.length;i++){
                                    var text = "<tr class='inform_even'><td class='username'>"+this_page.phone_message[i].username+"</td><td class='phone'>"+"</td><td class='qq'>"+"</td><td class='email'>"+"</td></tr>";
                                    $(text).appendTo('.phone_more_message table');                       
                                }
                                page_num++;     
                        }
                         else
                         {
                            alert("错误!");
                         }
                      }
         });
});*/



