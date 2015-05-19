<div class="breadcrumb">您所在的位置：<a href="/">首页</a> &gt;&gt; 
  <?php if(isset($cats) and is_array($cats)){
  foreach($cats as $caval){
  ?> <?php if($caval->cat_id!==$cats_selected){?>
  <a href="/index.php/view/category/<?php echo $caval->cat_id.'/'.$caval->cat_type_id; ?>"><?php echo $caval->name ;?></a> &gt;&gt; 
  <?php }else{?><span class="active"><?php echo $caval->name ;?></span>
  <?}?>
  <?php
  }
  }
  ?>
   </div>
  <!--breadcrumb end-->
  <div class="clear"></div>
  <div class="full_content">
    <h1><?php echo $news->title; ?></h1>
    <div class="content_info">发布日期：<?php echo date("Y-m-d",$news->rel_date); ?></div>
  
<div class="MainBg">
  <div class="OriginalPicBorder">
    <div id="OriginalPic">
      <div id="aPrev" class="CursorL"></div>
      <div id="aNext" class="CursorR"></div>
	  <?php if(isset($thumbs)){
	  //print_r($thumbs);
	  foreach($thumbs as $tval){
	  ?>
      <p class="Hidden">
        <span class="SliderPicBorder"><img src="<?php echo $tval->thumb_path;?>" /></span>
        <span class="Summary"><font class="Counter">（<span class="CounterCurrent">1</span>/7）</font>title1</span>
        <span class="Clearer"></span>
        <span class="view_full_img"><a href="public/index/picture/127e5101-309d-4699-9e14-93150b1eb36f.jpg" target="_blank">查看原图</a></span>
      </p>
	  
	  <?php 
	  }
	  } ?>
      
    </div>
  </div>
  <!--大图区域-->
  
  <div class="ThumbPicBorder">
		<img src="public/index/images/ArrowL.jpg" id="btnPrev"  style="cursor:pointer; float:left;" />
		<div class="jCarouselLite">
			<ul id="ThumbPic">
			<?php if(isset($thumbs)){
	  foreach($thumbs as $tval){
	  ?>
				<li rel='1'><img src="public/index/picture/127e5101-309d-4699-9e14-93150b1eb36f_T.jpg" /></li>
				<?php 
	  }
	  } ?>
			</ul>
			<div class="Clearer"></div>
		</div>
		<img src="public/index/images/ArrowR.jpg" id="btnNext" style="cursor:pointer; float:left;" />
		<div class="Clearer"></div>
	</div>
  <!--小图滚动-->  
</div>
<script type="text/javascript">
//缩略图滚动事件
$(".jCarouselLite").jCarouselLite({
	btnNext: "#btnNext",
	btnPrev: "#btnPrev",
	scroll: 1,
	speed: 240,
	circular: false,//是否循环
	visible: 5//显示缩略图张数
});
</script> 
<script type="text/javascript">
var currentImage;
var currentIndex = -1;

//显示大图(参数index从0开始计数)
function showImage(index){

	//更新当前图片页码
	$(".CounterCurrent").html(index + 1);

	//隐藏或显示向左向右鼠标手势
	var len = $('#OriginalPic img').length;
	if(index == len - 1){
		$("#aNext").hide();
	}else{
		$("#aNext").show();
	}

	if(index == 0){
		$("#aPrev").hide();
	}else{
		$("#aPrev").show();
	}

	//显示大图            
	if(index < $('#OriginalPic img').length){
		var indexImage = $('#OriginalPic p')[index];

		//隐藏当前的图
		if(currentImage){
			if(currentImage != indexImage){
				$(currentImage).css('z-index', 2);	
				$(currentImage).fadeOut(0,function(){
					$(this).css({'display':'none','z-index':1})
				});
			}
		}

		//显示用户选择的图
		$(indexImage).show().css({'opacity': 0.4});
		$(indexImage).animate({opacity:1},{duration:200});

		//更新变量
		currentImage = indexImage;
		currentIndex = index;

		//移除并添加高亮
		$('#ThumbPic img').removeClass('active');
		$($('#ThumbPic img')[index]).addClass('active');

		//设置向左向右鼠标手势区域的高度                        
		//var tempHeight = $($('#OriginalPic img')[index]).height();
		//$('#aPrev').height(tempHeight);
		//$('#aNext').height(tempHeight);                        
	}
}

//下一张
function ShowNext(){
	var len = $('#OriginalPic img').length;
	var next = currentIndex < (len - 1) ? currentIndex + 1 : 0;
	showImage(next);
}

//上一张
function ShowPrep(){
	var len = $('#OriginalPic img').length;
	var next = currentIndex == 0 ? (len - 1) : currentIndex - 1;
	showImage(next);
}

//下一张事件
$("#aNext").click(function(){
	ShowNext();
	if($(".active").position().left >= 144 * 5){
		$("#btnNext").click();
	}
});

//上一张事件
$("#aPrev").click(function(){
	ShowPrep();
	if($(".active").position().left <= 144 * 5){
		$("#btnPrev").click();
	}
});

//初始化事件
$(".OriginalPicBorder").ready(function(){
	ShowNext();

	//绑定缩略图点击事件
	$('#ThumbPic li').bind('click',function(e){
		var count = $(this).attr('rel');
		showImage(parseInt(count) - 1);
	});
});
</script>
  </div>
</div>

