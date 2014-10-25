<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>部门首页</title>
    <link rel="stylesheet" href="/REM/manage/Public/style/style1.css" type="text/css">
    <script type="text/javascript" src="/REM/manage/Public/js/jQueryv1.7.2.js"></script><meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport" />
    <script type="text/javascript">
     var url = '<?php echo U('Home/Ajax/index', '', '');?>';
    </script>

</head>
<body>
    <div id="header">
        <div class="head">
            <a href="<?php echo U('Home/Index/index');?>">
                <div class="logo"></div>
             </a>
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
    <div id="main">
        <div id="nav">
            <h1><?php echo ($apart); ?></h1>
            <ul>
                <li class="nav_li onclick" id="task"><span>&#xf0003;</span>部门任务</li>
                <li class="nav_li" id="share"><span>&#x3442;</span>资源共享</li>
                <li class="nav_li" id="address"><span>&#xf0012;</span>通讯录</li>
                <li class="nav_li" id="question"><span>&#xe62a;</span>问答</li>
            </ul>
        </div>
        <div id="aside">
            <div id="deadline">
                <span>距离任务结束还有<h1><?php echo ($lefttime); ?></h1>天</span>
                <div>
                    <ul>
                        <li>
                            <div class="to_do">
                                <h1><?php echo ($going); ?></h1>待完成任务
                            </div>
                        </li>
                        <li>
                            <div class="out_of_date">
                                <h1><?php echo ($failed); ?></h1>过期任务
                            </div>
                        </li>
                        <li>
                            <div class="done">
                                <h1><?php echo ($over); ?></h1>已完成任务
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="latest_task">
                <span class="task_icon"><h1>&#xf0054;</h1>部门通知</span>
                <p><?php echo (htmlspecialchars_decode($new_notice["content"])); ?></p>
                <span class="task_date">发布日期:<span><?php echo (date("m-d H:i", $new_notice["createtime"])); ?></span></span>
            </div>
            <div id="hand_list">
                <span class="list_icon"><h1>&#xe648;</h1>提交列表</span>
                <ul>
                <?php if(is_array($upworklist)): foreach($upworklist as $key=>$v): ?><li>
                        <span class="user_name"><?php echo ($v["username"]); ?></span>
                        <!-- <span class="list_date"><?php echo (date( "m-d H:i", $v["time"])); ?></span> -->
                        <span>提交了</span>
                        <span class="task_name"><?php echo ($v["title"]); ?></span>
                    </li><?php endforeach; endif; ?>
                </ul>
            </div>
        </div>
        <div id="content">
            <div class="content_top" id="task1">
                <div class="list_bc">
                    <ul class="task">
                        <li class="onclick to_do">待完成任务</li>
                        <li class="out_of_date">过期任务</li>
                        <li class="done">已完成任务</li>
                    </ul>
                </div>
                <div class="out">
                    <div class="in">
                        <div class="lump doing">
                            <?php if($weijiao == null): ?><div class="content_main">
                                    <h1 class="content_name">没有任务</h1>
                                </div><?php endif; ?>
                        <?php if(is_array($weijiao)): foreach($weijiao as $key=>$v): ?><div class="content_main">
                                <h1 class="content_name"><?php echo ($v["title"]); ?></h1>
                                <span class="content_icon">任务</span>
                                    <p><?php echo (htmlspecialchars_decode($v["content"])); ?></p>
                                <div class="content_date"><span><?php echo ($v["deadline"]); ?></span></div>
                                <div class="clearfix">
                                    <form action="<?php echo U('Home/Resource/work', array('work_id'=>$v['id'], 'user_id'=>session('uid')));?>" enctype="multipart/form-data" method="post" >
                                        <input type="file" name="file" class="select_file" />
                                        <button class="button" type="submit"></button>
                                    </form>
                                </div>
                            </div><?php endforeach; endif; ?>
                        </div>
                        <div class="lump">
                            <?php if($guoqi == null): ?><div class="content_main">
                                    <h1 class="content_name">没有任务</h1>
                                </div><?php endif; ?>
                        <?php if(is_array($guoqi)): foreach($guoqi as $key=>$v): ?><div class="content_main">
                                <h1 class="content_name"><?php echo ($v["title"]); ?></h1>
                                <span class="content_icon">任务</span>
                                <p><?php echo (htmlspecialchars_decode($v["content"])); ?></p>
                                <div class="content_date"><span><?php echo ($v["deadline"]); ?></span></div>
                                <div class="button finish"></div>
                                <div class="clearfix"></div>
                            </div><?php endforeach; endif; ?>
                        </div>
                        <div class="lump finish">
                            <?php if($finished == null): ?><div class="content_main">
                                    <h1 class="content_name">没有任务</h1>
                                </div><?php endif; ?>
                        <?php if(is_array($finished)): foreach($finished as $key=>$v): ?><div class="content_main">
                                <h1 class="content_name"><?php echo ($v["title"]); ?></h1>
                                <span class="content_icon">任务</span>
                                <p><?php echo (htmlspecialchars_decode($v["content"])); ?></p>
                                <div class="content_date"><span><?php echo ($v["deadline"]); ?></span></div>
                                <div class="button"></div>
                                <div class="clearfix"></div>
                            </div><?php endforeach; endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content_top" id="task2">
                <div class="list_bc">
                    <ul class="task">
                        <li class="onclick valid">有效任务</li>
                        <li class="vain">无效任务</li>
                    </ul>
                </div>
                <div class="out">
                    <div class="in">
                        <div class="lump">
                            <?php if($effective_list == null): ?><div class="content_main">
                                    <h1 class="content_name">没有任务</h1>
                                </div><?php endif; ?>
                        <?php if(is_array($effective_list)): foreach($effective_list as $key=>$v): ?><div class="content_main">
                                <h1 class="content_name"><?php echo ($v['title']); ?></h1>
                                <span class="content_icon">任务</span>
                                <p><?php echo (htmlspecialchars_decode($v["content"])); ?></p>
                                <div class="info">
                                    <p class="member"><span>相关人员</span>
                                        <?php if(is_array($acc)): foreach($acc as $key=>$d): if($v['id'] == $d[0]['work_id']): ?>| <?php echo ($d[0]['name']); ?> |<?php endif; endforeach; endif; ?>
                                    </p>
                                    <p class="time"><span>截止时间</span><?php echo ($v["deadline"]); ?></p>
                                </div>
                                <div class="content_date"><span><?php echo (date( "Y-m-d H:i", $v["createtime"])); ?></span></div>
                                <div class="content_open"><span>查看详情</span></div>
                            </div><?php endforeach; endif; ?>
                            <div class="content_page">
                                <ul>
                                    <li><?php echo ($page); ?></li>
                            </div>
                        </div>
                        <div class="lump">
                            <?php if($invalid_list == null): ?><div class="content_main">
                                    <h1 class="content_name">没有任务</h1>
                                </div><?php endif; ?>
                        <?php if(is_array($invalid_list)): foreach($invalid_list as $key=>$v): ?><div class="content_main">
                                <h1 class="content_name"><?php echo ($v["title"]); ?></h1>
                                <span class="content_icon">任务</span>
                                <p><?php echo (htmlspecialchars_decode($v["content"])); ?></p>
                                <div class="info">
                                    <p class="member"><span>任务成员</span>
                                        <?php if(is_array($acc)): foreach($acc as $key=>$d): ?><!-- <?php if($v['id'] == $d[0]['work_id']): ?>-->
                                        | <?php echo ($d[0]['username']); ?> |
                                        <!--<?php endif; ?> --><?php endforeach; endif; ?>
                                    </p>
                                    <p class="time"><span>截止时间</span><?php echo ($v["deadline"]); ?></p>
                                </div>
                                <div class="content_date"><span><?php echo (date( "Y-m-d H:i", $v["createtime"])); ?></span></div>
                                <div class="content_open"><span>查看详情</span></div>
                            </div><?php endforeach; endif; ?>
                            <div class="content_page">
                                <ul>
                                    <li><?php echo ($invalid_page); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content_top" id="share_">
                <div class="list_bc">
                    
                    <ul class="task">
                        <li class="onclick">资源共享</li>
                        <div class="button">
                            <span class="up">
                                <h1>&#xe719;</h1>上传文件
                            </span>
                        </div>
                    </ul>
                    
                </div>
                
                <div class="inform">
                    <table cellspacing="0">
                        <tr class="inform_odd inform_header">
                            <th>文件名</th>
                            <th><p>格式</p></th>
                            <th>大小</th>
                            <th>上传时间</th>
                            <th>下载</th>
                        </tr>
                        <?php if(is_array($Resource_list)): $i = 0; $__LIST__ = $Resource_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$resource): $mod = ($i % 2 );++$i;?><tr class="inform_even">
                            <td><span class="doc_icon">&#xe6e4;</span><?php echo ($resource["filename"]); ?></td>
                            <td class="doc"><?php echo ($resource["type"]); ?></td>
                            <td><?php echo sprintf("%.2f",$resource['size']/1024/1024); ?>Mb</td>
                            <td><?php echo date("m-d H:i",$resource['time']);?></td>
                            <td><a href="/REM/manage/Uploads/resource/<?php echo ($resource["savepath"]); ?>" class="inform_down">&#xe718;</a></td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </table>
                </div>
                <span class="share_more">查看更多</span>
                <div class="content_page">
                    <ul>
                        <li></li>
                    </ul>
                </div>
            </div>
            <div class="content_top" id="addressbook">
                <div class="list_bc">
                    <ul class="task">
                        <li class="onclick">通讯录</li>
                        <div class="button"><span class="change"><h1>&#xe630;</h1>修改信息</span></div>
                    </ul>
                </div>
                
               <div class="inform phone_message">
                    <table cellspacing="0">
                        <tr class="inform_odd inform_header">
                            <th>姓名</th>
                            <th>电话</th>
                            <th>QQ</th>
                            <th>邮箱</th>
                        </tr>
                        <?php if(is_array($info_list)): $i = 0; $__LIST__ = $info_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info_list): $mod = ($i % 2 );++$i;?><tr class="inform_even">
                            <td class="username"><?php echo ($info_list["username"]); ?></td>
                            <td class="phone"><?php echo ($info_list["phone"]); ?></td>
                            <td class="qq"><?php echo ($info_list["txqq"]); ?></td>
                            <td class="email"><?php echo ($info_list["email"]); ?></td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </table>   
                </div>
                <span class="phone_more">查看更多</span>
            </div>
            <div class="content_top" id="que">
                <div class="list_bc">
                    <ul class="task">
                        <li class="onclick">问答</li>
                        <div class="button"><span class="upload"><h1>&#xe630;</h1>我要提问</span></div>
                    </ul>
                </div>
                <script>
                    var url="/REM/manage/index.php/Home/Apart/ajax";
                    var url1="/REM/manage/index.php/Home/Apart/ajax1";
                    var url2="/REM/manage/index.php/Home/Apart/ajax2";
                
                </script>
                <div class="inform">
                    <table cellspacing="0">
                        <tr class="inform_odd inform_header">
                            <th>标题</th>
                            <th>回复数</th>
                            <th>提问时间</th>
                        </tr>
                        <?php if(is_array($Question_list)): $i = 0; $__LIST__ = $Question_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$Question): $mod = ($i % 2 );++$i;?><tr class="inform_even que" onclick="cake(<?php echo ($Question['question_id']); ?>)" id="<?php echo ($Question['question_id']); ?>">
                            <td class="inform_name"><?php echo ($Question["title"]); ?></td>
                            <td><?php echo ($Question["reply_count"]); ?></td>
                            <td><?php echo date("Y-m-d H:i", $Question['time']);;?></td>
                        </tr>
                        <script>
                    var num = <?php echo ($Question["id"]); ?>;
                </script><?php endforeach; endif; else: echo "" ;endif; ?>
                    </table>
                </div>
                <span class="que_more">查看更多</span>
            </div>
            <!-- <div class="content_bottom">
                <div><a href="">关于红岩网站</a><a href="">网站地图</a><a href="">指出错误</a><a href="<?php echo U('Admin/Index/index');?>">管理入口</a></div>

                <p>本网站由红岩网校工作站负责开发，管理，不经红岩网校委员会书面同意，不得进行转载</p>
                <p>地址：重庆市南岸区崇文路2号（重庆邮电大学内） 400065 E-mail:redrock@cqupt.edu.cn (023-62461084)</p>
            </div> -->
        </div>
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
    <div id="wenda">
        <div title="关闭" class="close"></div>
        <div class="tie">
        <form action="<?php echo U('Question/submitquestion');?>" method="post">
            <input id="wenda_title" type="text" name="title" placeholder="标题">
            <textarea id="wenda_content" name="content" placeholder="内容"></textarea>
            <input id="wenda_button" type="submit" name="submit" value="提问">
        </form>
        </div>
    </div>  
    <div id="message">
        <div class="theme-poptit">
            <div title="关闭" class="close"></div>
            <h1 title="登录">修 改 信 息</h1>
        </div>
        <div class="theme-popbod dform">
            <form class="theme-signin" name="changeinfo" action="<?php echo U('Admin/Index/infHandle');?>" method="post">
                <ol>
                    <li><input class="phone" title="手机" type="text" name="phone" placeholder="手机" size="20" /></li>
                    <li><input class="qq" title="QQ" type="text" name="qq" placeholder="QQ" size="20" /></li>
                    <li><input class="email" title="邮箱" type="text" name="email" placeholder="邮箱" size="20" /></li>
                    <li><input class="btn" title="登录" type="submit" name="submit" value=" 确 认 修 改 " /></li>
                </ol>
            </form>
        </div>
    </div> 
    <div id="reply">
        <div class="reply_close" title="关闭" ></div>
        <div class="reply_tie">
        <div class="question" id="reply_question">
            <h1 class="question_title">xxx</h1>
            <span class="asker">xxx</span>
            <p class="question_content">xxxx</p>
            <span class="question_date">xxxx-xx-xx xx:xx</span>
        </div>
        <textarea class="your_ans" name="your_reply" id="my_reply"></textarea>
        <input class="response" type="submit" name="submit" value="回复" onclick="ajax2()">
      
        <div class="answer_box">
            
        </div>
        <span id="more">查看更多回复</span>
        <span id="less">收起</span>
    </div>
        </div> 
    <div id="upload_file" type = "width:500pxeven">
         <div class="upload_file_close"></div>
         <form action="<?php echo U('Home/Resource/index');?>" enctype="multipart/form-data" method="post" >
             <input type="file" name="file" type="float:left" />
             <input type="submit" class="upload_button" value="上传" >
         </form>
     </div> 

    <div class="theme-popover-mask"></div>
    <div class="theme-popover-mask-fff"></div>
</body>
<script type="text/javascript" src="/REM/manage/Public/js/main1.js"></script>
<script type="text/javascript" src="/REM/manage/Public/js/ajax.js"></script>
</html>