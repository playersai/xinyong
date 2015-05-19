<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $html_title; ?></title>
<link href="/public/index/css/css.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="/public/index/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="/public/index/js/jquery.litenav.js"></script>
<script type="text/javascript" src="/public/index/js/jquery.scrollbox.js"></script>
</head>

<body>
<div class="top_bg"></div>
<div class="warper">
  <div class="top">
    <div class="top_left">
    <?php echo date('Y年m月d',time())?>&nbsp;&nbsp;星期<?php $week=date('w',time()); 
	switch($week){
		case 0 : $wstr='日';break;
		case 1 : $wstr='一';break;
		case 2 : $wstr='二';break;
		case 3 : $wstr='三';break;
		case 4 : $wstr='四';break;
		case 5 : $wstr='五';break;
		case 6 : $wstr='六';break;
	}
	echo $wstr; ?>
	</div>
    <div class="top_right">
      <div class="back_home"><a href="/index.php">返回首页</a></div>
      <span><input type="text" id="fox_ie8" value="请输入关键词" onfocus="if(value=='请输入关键词'){value=''}" onblur="if (value ==''){value='请输入关键词'}" />
        <a id="searchAll"></a>
      </span>
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
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>
  </div>
  <!--top end-->
  <div class="topic_banner">
  <?php if(!empty($topic_info->banner_thumb) ):?>
    <img src="<?php echo $topic_info->banner_thumb;?>" width="1140" />
  <?php else:?>
	暂无banner图
  <?php endif;?>
  </div>
  <!--head end-->
  <div class="topic_nav">
    <ul>
      <li><a href="/index.php/topic_page/index/<?php echo $topic_info->cat_id;?>"><span>专题首页</span></a></li>
	  <?php foreach($topic_nav as $tnval):?>
      <li <?php if($nav_selected==$tnval->cat_id) echo 'class="topic_nav_li"';?>><a href="/index.php/topic_page/<?php echo $tnval->cat_id; ?>"><span><?php echo $tnval->name; ?></span></a></li>
	  <?php endforeach;?>
    </ul>
  </div>
  <!--nav end-->