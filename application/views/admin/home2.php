<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<title>cms</title>
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
               
			    <li><a target="_dialog" rel="cache" width="680" height="380" href="{url f='cache'}" title="清空缓存"><strong>政务公开</strong></a></li>
				 <li>｜</li>
				 
				 <li><a target="_dialog" rel="cache" width="680" height="380" href="{url f='cache'}" title=""><strong>网上服务</strong></a></li>
				  <li>｜</li>
				  <li><a target="_dialog" rel="cache" width="680" height="380" href="{url f='cache'}" title=""><strong>交流互动</strong></a></li>
				   <li>｜</li>
                <li><a target="_dialog" rel="cache" width="680" height="380" href="{url f='cache'}" title=""><strong>山水板芙</strong></a></li>
                <li>｜</li>
				<li><a target="_dialog" rel="cache" width="680" height="380" href="{url f='cache'}" title=""><strong>热点专题</strong></a></li>
                <li>｜</li>
                <li><a target="_dialog" width="480" height="280" rel="pwd" href="{url a='AdminUser' f='changePwd'}" title="修改密码"><i class="iconfont">&#xf00ee;</i>修改密码</a></li>
                <li>｜</li>
                <li><a href="javascript:void(0);"><i class="iconfont fl">&#xf00ec;</i><?php echo $_SESSION['manage']; ?></a></li>
                <li>｜</li>
                <li><a href="/index.php/admin/logout/"><i class="iconfont">&#xf017c;</i>退出</a></li>
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