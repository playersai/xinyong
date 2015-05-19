
<div class="clear"></div>

<div class="full_content">
	<h1><?php echo htmlspecialchars($photo_info->title); ?></h1>
	<div class="content_info">发布日期：<?php echo date("Y-m-d",$photo_info->rel_date); ?></div>
	<div><?php echo $photo_info->content; ?></div>
	<div class="MainBg">
	    <?php if($thumb_rows){?>
		<div class="OriginalPicBorder">
			<div id="OriginalPic">
				<div id="aPrev" class="CursorL" style="display: none;"></div>
				<div id="aNext" class="CursorR"></div>
				<?php foreach ($thumb_rows as $tval):?>
				<p class="Hidden">
        			<span class="SliderPicBorder"><img src="<?php echo $tval->thumb_path;?>" /></span>
        			<span class="Summary"><a href="<?php echo $tval->thumb_path;?>" target="_blank">查看原图</a><font class="Counter">（<span class="CounterCurrent">1</span>/<?php echo count($thumb_rows); ?>）</font><?php echo htmlspecialchars($tval->content);?></span>
        			<span class="Clearer"></span>
      			</p>
      			<?php endforeach;?>
			</div>
		</div>
		<!--大图区域-->

		<div class="ThumbPicBorder">
			<div style="padding: 10px;">
				<a id="btnPrev"></a>
				<div class="jCarouselLite" style="visibility: visible; overflow: hidden; position: relative; z-index: 2; left: 0px; width: 576px;">
					<ul id="ThumbPic" style="margin: 0px; padding: 0px; position: relative; list-style-type: none; z-index: 1; width: 864px; left: 0px;">
						<?php foreach ($thumb_rows as $tkey=>$tval):?>
						<li rel='<?php echo $tkey+1;?>'><img src="<?php echo $tval->thumb_path;?>" width="" /></li>
						<?php endforeach;?>
					</ul>
					<div class="Clearer"></div>
				</div>
				<a id="btnNext"></a>
			</div>
			<div class="Clearer"></div>
		</div>
		<!--小图滚动-->
		<?php }else{ ?>
		<div class="no_data">暂无图片</div>
		<?php }?>
	</div>
	<script type="text/javascript" src="/public/index/js/jquery.jcarousellite.min.js"></script>

	<script type="text/javascript">
		//缩略图滚动事件
		$(".jCarouselLite").jCarouselLite({
			btnNext: "#btnNext",
			btnPrev: "#btnPrev",
			scroll: 1,
			speed: 240,
			circular: false,//是否循环
			visible: 4//显示缩略图张数
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
	<div style="height: 30px;"></div>
</div>

