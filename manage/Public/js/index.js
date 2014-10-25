


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





//轮播器
var left = $('.left');
var right = $('.right');
var _in = $(".in");
var left_num = 0;
var min_left = -($('.mid').length - 1)*520;
var max_left = 0;

left.click(function(){
	right.css("display","block");
	left_num += 520;
	if(left_num > max_left){
		left_num = max_left;
		left.css("display","none");
	}
	_in.animate({left:left_num+'px'},"slow");
	_in.animate({left:(left_num/16)+'rem'},"slow");
	setTimeout(function(){
		if(left_num == max_left){
			left.css("display","none");
		}
	},1000);
});

right.click(function(){
	left.css("display","block");
	left_num -= 520;
	if(left_num < min_left){
		left_num = min_left;
		right.css("display","none");
	}
	_in.animate({left:left_num+'px'},"slow");
	_in.animate({left:(left_num/16)+'rem'},"slow");
	setTimeout(function(){
		if(left_num == min_left){
			right.css("display","none");
		}
	},1000);
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







