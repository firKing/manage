<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
        <meta charset="utf-8">
        <title>首页</title>
        <link rel="stylesheet" type="text/css" href="/REM/manage/Public/style/index.css">

	</head>
<body>
		<div id="header">
			<div class="head">
				<a href="<?php echo U('Home/Index/index');?>">
					<div class="logo">
			    </div></a>
			    <?php if(!isset($_SESSION[C('USER_AUTH_KEY')])): ?><div class="login">
			            <p title="登录">登录</p>
			        </div>
			    <?php else: ?>
			        <div class="use">
			            <p><?php echo ($log); ?></p>
			            <div class="menu">
			                <div class="changepass">修改密码</div>
			                <div class="logout"><a href="<?php echo U('Admin/Index/logout');?>">退出</a></div>
			            </div>
			        </div><?php endif; ?>
			    <div clas
			    <div class="search">
			        <div id="button" title="搜索"></div>
			        <form name="search" action="##" method="post">
			            <!-- succedaneum是用来做动画效果的，search才是用来传值的 -->
			            <input type="text" name="succedaneum" id="succedaneum">
			            <input type="text" name="search"  title="搜索" id="search" placeholder="只能搜索本部门内容">
			        </form>
			    </div>
			</div>
		</div>
		<div id="img">
			<div class="txt">
				<div></div>
			</div>
		</div>
		<div id="entry">
			<div class="entry">
				<h1 title="部门入口">部门入口</h1>
				<div class="fa">
					<?php if(session('apart_id') == '5'): ?><a href="<?php echo U('Home/Apart/index');?>"><?php endif; ?>	
							<div class="department manage" title="管理规划部">
								<div class="logo"></div>
								<p>管理规划部</p>
							</div>
					<?php if(session('apart_id') == '5'): ?></a><?php endif; ?>
				</div>
				<div class="fa">
					<?php if(session('apart_id') == '6'): ?><a href="<?php echo U('Home/Apart/index');?>"><?php endif; ?>
							<div class="department visual" title="视觉设计部">
								<div class="logo"></div>
								<p>视觉设计部</p>
							</div>
					<?php if(session('apart_id') == '6'): ?></a><?php endif; ?>
				</div>
				<div class="fa">
					<?php if(session('apart_id') == '3'): ?><a href="<?php echo U('Home/Apart/index');?>"><?php endif; ?>
							<div class="department web" title="Web研发部">
								<div class="logo"></div>
								<p>Web研发部</p>
							</div>
					<?php if(session('apart_id') == '3'): ?></a><?php endif; ?>
				</div>
				<div class="fa">
					<?php if(session('apart_id') == '4'): ?><a href="<?php echo U('Home/Apart/index');?>"><?php endif; ?>
							<div class="department mobile" title="移动开发部">
								<div class="logo"></div>
								<P>移动开发部</P>
							</div>
					<?php if(session('apart_id') == '4'): ?></a><?php endif; ?>
				</div>
				<div class="fa">
					<?php if(session('apart_id') == '7'): ?><a href="<?php echo U('Home/Apart/index');?>"><?php endif; ?>
							<div class="department operation" title="运营维护部">
								<div class="logo"></div>
								<P>运营维护部</P>
							</div>
					<?php if(session('apart_id') == '7'): ?></a><?php endif; ?>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>

		<div id="work">
			<div class="content">
				<h1 title="网校任务">网校任务</h1>
				<div class="work">
					<div class="left" title="前四项任务">
					</div>
					<div class="out">
						<div class="in">
							<div class="mid">
								<?php if(is_array($list)): $i = 0; $__LIST__ = array_slice($list,0,4,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="txt"><span class="title"><?php echo ($vo["title"]); ?></span><span class="time"><?php echo date("m-d H:i",$vo['createtime']);?></span><span class="people">发布人：红岩网校</span></div><?php endforeach; endif; else: echo "" ;endif; ?>
							</div>
							<div class="mid">
								<?php if(is_array($list)): $i = 0; $__LIST__ = array_slice($list,4,4,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="txt"><span class="title"><?php echo ($vo["title"]); ?></span><span class="time"><?php echo date("m-d H:i",$vo['createtime']);?></span><span class="people">发布人：红岩网校</span></div><?php endforeach; endif; else: echo "" ;endif; ?>
							</div>
							<div class="mid">
								<?php if(is_array($list)): $i = 0; $__LIST__ = array_slice($list,8,4,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="txt"><span class="title"><?php echo ($vo["title"]); ?></span><span class="time"><?php echo date("m-d H:i",$vo['createtime']);?></span><span class="people">发布人：红岩网校</span></div><?php endforeach; endif; else: echo "" ;endif; ?>
							</div>
						</div>
					</div>
					<div class="right" title="后四项任务">
					</div>
				</div>
			</div>
		</div>

<div id="footer">
	<p><a href="##" title="关于红岩网校">关于红岩网校</a> | <a href="##" title="网站地图">网站地图</a> | <a href="##" title="指出错误">指出错误</a> | <a href="/REM/manage/index.php/Admin/Index/index" title="管理入口">管理入口</a> | <a href="">用户注册</a> </p>
	<p>本网站由红岩网校工作站负责开发，管理，不经红岩网校委员会书面同意，不得进行转载</p>
	<p>地址：重庆市南岸区崇文路2号（重庆邮电大学内） 400065 E-mail:redrock@cqupt.edu.cn (023-62461084)</p>
</div>

<div id="theme-popover">
	<div class="theme-poptit">
		<div title="关闭" class="close"></div>
		<h1 title="登录">登录</h1>
	</div>
	<div class="theme-popbod dform">
		<form class="theme-signin" name="loginform" action="<?php echo U('Home/Login/login');?>" method="post">
			<ol>
				<li><input class="user" title="姓名" type="text" name="log" placeholder="姓名" size="20" /></li>
				<li><input class="pass" title="密码" type="password" name="pwd" placeholder="密码" size="20" /></li>
				<li><input class="btn" title="登录" type="submit" name="submit" value=" 登 录 " /></li>
			</ol>
		</form>
	</div>
</div>

<div id="changepass">
	<div class="theme-poptit">
		<div title="关闭" class="close"></div>
		<h1 title="登录"> 修 改 密 码 </h1>
	</div>
	<div class="theme-popbod dform">
		<form class="theme-signin" name="loginform" action="<?php echo U('Admin/Index/pwdHandle');?>" method="post">
			<ol>
		<li><input class="pass" title="旧密码" type="password" name="pass" placeholder="旧密码" size="20" /></li>
				<li><input class="pass" title="新密码" type="password" name="newPass" placeholder="新密码" size="20" /></li>
				<li><input class="pass" title="再次输入新密码" type="password" name="newPassEnter" placeholder="再次输入新密码" size="20" /></li>
				<li><input class="btn" title="登录" type="submit" name="submit" value=" 确 认 修 改 " /></li>
			</ol>
		</form>
	</div>
</div>

<div class="theme-popover-mask"></div>
<div class="theme-popover-mask-fff"></div>

<script type="text/javascript" src="/REM/manage/Public/js/jQueryv1.7.2.js"></script>
<script type="text/javascript" src="/REM/manage/Public/js/index.js"></script>
</body>
</html>