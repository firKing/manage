<?php if (!defined('THINK_PATH')) exit();?><div id="header">
<div class="head">
    <div class="logo">       
    </div>
    <?php if(!isset($_SESSION[C('USER_AUTH_KEY')])): ?><div class="login">
            <p title="登录">登录</p>
        </div>
    <?php else: ?>
        <div class="use">
            <p><?php echo ($log); ?></p>
            <div class="menu">
                <div class="changepass">修改密码</div>
                <div class="logout"><a href="<?php echo U('Home/Index/logout');?>">退出</a></div>
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