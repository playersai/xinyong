<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" >
<title>中山市板芙镇人民政府</title>
<link href="/public/index/css/css.css" rel="stylesheet" type="text/css" media="screen" />
<link href="/public/index/css/flexigrid.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="/public/index/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="/public/index/js/jquery.jslides.js"></script>
<script type="text/javascript" src="/public/index/js/jquery.scrollbox.js"></script>
<script type="text/javascript" src="/public/index/js/koala.min.1.5.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
<script type="text/javascript" src="/public/index/js/centerwell.js"></script>
<script type="text/javascript" src="/public/index/js/select_ie8.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		jQuery.jqtab = function(tabtit,tab_conbox,shijian) {
			$(tab_conbox).find("li").hide();
			$(tabtit).find("li:first").addClass("thistab").show(); 
			$(tab_conbox).find("li:first").show();
			
			$(tabtit).find("li").bind(shijian,function(){
				$(this).addClass("thistab").siblings("li").removeClass("thistab"); 
				var activeindex = $(tabtit).find("li").index(this);
				$(tab_conbox).children().eq(activeindex).show().siblings().hide();
				return false;
			});
		};
		
		/*调用方法如下：*/		
		$.jqtab("#tabs","#tab_conbox","mouseenter");
		$.jqtab("#tabs2","#tab_conbox2","mouseenter");
		// $.jqtab("#tabs3","#tab_conbox3","click");
		$.jqtab("#tabs4","#tab_conbox4","mouseenter");
		$.jqtab("#tabs5","#tab_conbox5","mouseenter");
		$.jqtab("#tabs6","#tab_conbox6","mouseenter");
		$.jqtab("#tabs7","#tab_conbox7","mouseenter");
		$.jqtab("#tabs8","#tab_conbox8","mouseenter");
		$.jqtab("#tabs9","#tab_conbox9","mouseenter");
		$.jqtab("#tabs10","#tab_conbox10","mouseenter");
		$.jqtab("#tabs11","#tab_conbox11","mouseenter");
		$.jqtab("#tabs12","#tab_conbox12","mouseenter");
		$.jqtab("#tabs13","#tab_conbox13","click");
	});
</script>

<script>
	$(document).ready(function(){
		lastBlock = $("#a1");
		maxWidth = 628;
		minWidth = 41;	

		$("ul li em").hover(function(){
			$(lastBlock).animate({width: minWidth+"px"}, { queue:false, duration:1 });
			$(this).animate({width: maxWidth+"px"}, { queue:false, duration:1});
			lastBlock = this;
		});

		// 关闭漂浮广告
		$(".adclose").click(function(){
			$(this).parent().css("display", "none");
		});
	});
</script>

<?php if(isset($floatad) && $floatad->is_float_ad==1) { ?>
<div id=moveAdv style="Z-INDEX: 3000; LEFT: 2px; WIDTH:198px; POSITION: absolute; TOP: 43px; HEIGHT:129px; visibility: visible;">
  <a href="<?php echo $floatad->float_ad_link; ?>" target=_blank>
    <!-- <img width=200 height=120 src="<?php echo $floatad->float_ad; ?>" border=0 onMouseover="clearInterval(interval)" onmouseout="interval = setInterval('changePos()',30);"> -->
    <img width=200 height=120 src="<?php echo $floatad->float_ad; ?>" border=0>
  </a>
  <div class="adclose" style="FONT-SIZE: 10pt; cursor:pointer;" align=right>◎ 关闭 ◎</div> 
</div>

<script>
	// 漂浮广告脚本
	var x = 60;
	var y = 50;
	var xin = true;
	var yin = true;
	var step = 1;
	var delay = 60;
	var obj=document.getElementById("moveAdv");
	var objWidth  = $("#moveAdv").width();
	var objHeight = $("#moveAdv").height();	
	function floatAD() {
		var L = document.documentElement.scrollLeft;
		var T  = document.documentElement.scrollTop;
		var R = L - objWidth;
		var B = T - objHeight;
		if ($.browser.msie) {
			R = R + document.documentElement.clientWidth;
			B = B + document.documentElement.clientHeight;
		} else {
			R = R + window.innerWidth - 16;
			B = B + window.innerHeight;
		}
		$("#moveAdv").css("left", x);
		$("#moveAdv").css("top" , y);
		x = x + step*(xin?1:-1);
		if (x <= L) { 
			xin = true; 
			x = L;
		}
		if (x >= R){ 
			xin = false; 
			x = R;
		}
		y = y + step*(yin?1:-1);
		if (y <= T) { 
			yin = true; 
			y = T; 
		}
		if (y >= B) { 
			yin = false; 
			y = B; 
		}
	
	}
	var itl= setInterval("floatAD()", delay)
	obj.onmouseover=function(){clearInterval(itl)}
	obj.onmouseout=function(){itl=setInterval("floatAD()", delay)}
</script>
<?php } ?>

</head>
<body>
<div class="top_bg"></div>
<div class="warper">
  <div class="top">
    <div class="top_left"><?php echo date('Y年m月d日',time())?>&nbsp;&nbsp;星期<?php $week=date('w',time()); 
	switch($week){
		case 0 : $wstr='日';break;
		case 1 : $wstr='一';break;
		case 2 : $wstr='二';break;
		case 3 : $wstr='三';break;
		case 4 : $wstr='四';break;
		case 5 : $wstr='五';break;
		case 6 : $wstr='六';break;
	}
	echo $wstr;
	?>&nbsp;&nbsp;</div>
	
    <div class="top_right">
    <div class="OA_link"><a target="_blank" href="http://zqkx.qiwutong.com/">无址办公系统</a></div>
      <span>
        <input type="text" id="fox_ie8" value="请输入关键词" onfocus="if(value=='请输入关键词'){value=''}" onblur="if (value ==''){value='请输入关键词'}" />
        <a id="searchAll"></a>
      </span>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>
    
    <script src="/public/index/js/base64.js" type="text/javascript"></script>
    <script type="text/javascript">
	$(function(){
		$('#fox_ie8').click(function(){
			$(this).css("color","#333").siblings().removeClass();
	  });
	});
	$(function(){
		$('#fox_ie8').blur(function(){
			$(this).css("color","#000").siblings().removeClass();
	  });
	});
    </script>
    <script>
	$("#searchAll").click(function() {
		var base64 = new Base64();
		var queryStr = $('#fox_ie8').val();
		enStr = base64.encode(queryStr);  
		enStr = enStr.replace(/\+/g, "-");
		enStr = enStr.replace(/\//g, "_");
		if(enStr != "" && queryStr != "请输入关键词")
			window.open("/index.php/search/index/" + enStr);
		else
			alert("请先输入待搜索的关键词！");
	});  
    </script>
  </div>
  <!--top end-->
  <div class="head">
    <div class="logo"></div>
    <div class="head_banner">
      <div id="full-screen-slider">
          <ul id="slides">
 		    <li style="background:url('/public/attached/thumb/20141226/8.png') no-repeat right top;background-size:800px 148px; width:800px; height:148px;"><a href="<?php echo $topval->link; ?>"></a></li>
			 
          </ul>
      </div>    
    </div>
    <!--head_banner end-->
  </div>
  <!--head end-->
  <div class="nav">
    <ul>
	  <?php foreach($navs as $nkey=>$nval){ ?>
      <li <?php if($nkey==0){?>class="nav_li"<?php }?>><a href="<?php echo $navs_url[$nkey]; ?>" <?php if($nkey==$nav_selected){echo 'class="nav_act"';}?>><span><?php echo $nval; ?></span><i><?php echo $en_navs[$nkey]; ?></i></a></li>
      <?php if($nkey + 1 != count($navs)): ?><li><img src="/public/index/images/nav_bg_2.png" height="50" width="2" /></li><?php endif; ?>
	  <?php } ?>
      <!--  <li><a href="/index.php/topic_page/" <?php if($nav_selected=='5'){echo 'class="nav_act"';}?>><span>热点专题</span><i>HOT&nbsp;TOPIC</i></a></li>--> 
    </ul>
  </div>
  <!--nav end-->