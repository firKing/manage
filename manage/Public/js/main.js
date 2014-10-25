/**
 * Created by wang on 2014/9/2.
 */
//搜索
var button = $("#button");
var search = $("#search");
var succedaneum = $("#succedaneum");

button.click(display);

function display(){
    button.css("display","none");
    succedaneum.css("display","block");
    succedaneum.animate({width:'210px'},"slow");
    succedaneum.animate({width:'13.125rem'},"slow");
    setTimeout(function(){
        succedaneum.css("display","none");
        search.css("display","block");
    },1000);
}


var open = $(".content_open span");

open.each(function(){
    $(this).attr("name","close");
    $(this).click(function(){
        if($(this).attr("name") == "close"){
            $(this).parent().parent().children('.member').css('display','block');
            $(this).parent().parent().children('.time').css('display','block');
            $(this).html('收起');
            $(this).attr("name","open");
        }else{
            $(this).parent().parent().children('.member').css('display','none');
            $(this).parent().parent().children('.time').css('display','none');
            $(this).html('查看全文');
            $(this).attr("name","close");
        }
        a();
    });
});

function a(){
    var height = document.getElementById('content').offsetHeight;
    var nav = document.getElementById('nav');
    var aside = document.getElementById('aside');
    var content = document.getElementById('content');
    var Height = document.documentElement.clientHeight;
    var Width = document.documentElement.clientWidth;
    content.style.width = Width - 600  + 'px';
    if(height < Height - 60){
        nav.style.height = Height - 60+ 'px';
        aside.style.height = Height - 60+ 'px';
    }else{
        nav.style.height = height + 'px';
        aside.style.height = height + 'px';
    }
}


//登录框弹出
var login = $('.login');
var mask = $('.theme-popover-mask');
var popover = $('#theme-popover');


$('.login').click(function(){
    mask.fadeIn(500);
    popover.slideDown(500);
});
$('#theme-popover .close').click(function(){
    mask.fadeOut(500);
    popover.slideUp(500);
});

//个人信息
var user = $(".use");
var menu = $(".menu");
var time = 0;
var mask_fff = $('.theme-popover-mask-fff');
var changepass = $(".menu .changepass");
var changePass = $("#changepass");

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

mask_fff.click(function(){
    menu.slideUp(500);
    setTimeout(function(){
        user.css("background-color","#303030");
        user.children("p").css("color","#a4a4a4");
    },500);
    mask_fff.fadeOut(500);
    time = 0;
});

//弹出修改信息
changepass.click(function(){
    mask.fadeIn(500);
    changePass.slideDown(500);
});
$('#changepass .close').click(function(){
    mask.fadeOut(500);
    changePass.slideUp(500);
});


