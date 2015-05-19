<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<title>板芙政府网网站管理系统</title>
<link rel="stylesheet" href="/public/manage/css/panel.css" type="text/css" />
<link rel="stylesheet" path="/public/manage/css/" type="text/css" id="skinCss" />
<script type="text/javascript" src="/public/manage/js/jquery.js"></script>
<script type="text/javascript" src="/public/manage/js/panel.js"></script>

</head>

<body>
<div id="top">
    <div class="top_left">
        <div class="top_right">
            <div class="logo"><a href="/index.php/admin/main/">&nbsp;</a></div>
            <p class="sideBarSwitch"><a href="javascript:void(0);" onclick="sideBarSwitch(this);"><i class="ico icon-arrow-left"></i>隐藏左栏菜单</a></p>
            <ul class="topLinks">
                <li><a rel="cache" width="680" height="380" href="/index.php/admin/main/" title="首页"><strong>首页</strong></a></li>
				<li>｜</li>
			    <li><a rel="cache" width="680" height="380" href="../menu/1" title="文章发布"><strong>文章发布</strong></a></li>
				<li>｜</li>
				<li><a rel="cache" width="680" height="380" href="../menu/2" title="文件下载"><strong>文件下载</strong></a></li>
				<li>｜</li>
				<li><a rel="cache" width="680" height="380" href="../menu/3" title="交流互动"><strong>交流互动</strong></a></li>
				<li>｜</li>
                <li><a rel="cache" width="680" height="380" href="../menu/4" title="走进板芙"><strong>走进板芙</strong></a></li>
                <li>｜</li>
				<li><a rel="cache" width="680" height="380" href="../menu/5" title="热点专题"><strong>热点专题</strong></a></li>
                <li>｜</li>
                <?php if($_SESSION['group_id']=='1'):?>
                <li><a width="480" height="280" rel="pwd" href="../menu/6" title="系统设置"><strong>系统设置</strong></a></li>
                <li>｜</li>
				<?php endif;?>
                <li><a href="/index.php/admin_user/edit/<?php echo $_SESSION['user_id']; ?>" title="编辑用户" target="_tab" ><i class="iconfont fl">&#xf00ec;</i><?php echo $_SESSION['manage']; ?></a></li>
                <li>｜</li>
                <li><a href="/index.php/admin/logout/" title="退出" onclick="return confirm('是否执行安全退出管理后台?')"><i class="iconfont">&#xf017c;</i>退出</a></li>
            </ul>
            <div id="tab">
                <div class="tab_line"></div>
                <span id="tab_home" class="on" onclick="changeTab('home');"><i class="iconfont">&#x344c;</i>我的主页</span>
            </div>
        </div>
    </div>
</div>
<div id="left">
    <div class="left_top">
        <div class="left_bottom">
            <div class="menu">
                <ul class="main">
				
				<?php foreach($parent as $pkey=>$pval){ ?>
                    <li class="main">
                        <a href="javascript:void(0);" class="main"><i class="iconfont">。</i><?php echo $pval; ?></a>
                       <?php if(is_array($son[ $pkey ])){
					   
					   ?>
                        <ul class="sub">
                            <?php foreach($son[ $pkey ] as $skey=>$sval){ ?>
                            <li class="sub"><a class="sub" target="_tab" rel="menu_<?php echo $pkey.$skey;?>" href="<?php echo $sval['url']; ?>"><?php echo $sval['name']; ?></a></li>
                            <?php } ?>
                        </ul>
                       <?php }?>
                    </li>
                    <?php }?>
                 </ul>
            </div>
        </div>
    </div>
</div>
<div id="right">
    <div id="content">
        <iframe id="content_home" frameborder="0" allowtransparency="true" src="/index.php/admin/welcome/"></iframe>
    </div>
	
</div>

</body>
</html>