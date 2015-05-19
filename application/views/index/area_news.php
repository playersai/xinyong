  
<div class="box2" style="" >
	 <!--当前位置-->
     <div class="public_nav" style="padding-top:15px;">

    <p>当前位置：<a href="index.asp" target="_blank" title="点击打开中国中小商业企业协会首页">首页</a>&nbsp;/&nbsp;
	 
		
		 <span>协会动态</span>
		
	
	 
	 </p>
     
	 <!--分享-->
     <div style="MARGIN: 0px; PADDING: 0px; float:right; width:305px;margin-top:-18px;" class="shareBox">
<!-- Baidu Button BEGIN -->
<div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
<span class="bds_more">分享到：</span>
<a class="bds_hi" title="分享到百度空间" href="http://www.zxsx.org/newnsxin.asp?class=1#"></a>
<a class="bds_tieba" title="分享到百度贴吧" href="http://www.zxsx.org/newnsxin.asp?class=1#"></a>
<a class="bds_sqq" title="分享到QQ好友" href="http://www.zxsx.org/newnsxin.asp?class=1#"></a>
<a class="bds_thx" title="分享到和讯微博" href="http://www.zxsx.org/newnsxin.asp?class=1#"></a>
<a class="bds_tsina" title="分享到新浪微博" href="http://www.zxsx.org/newnsxin.asp?class=1#"></a>
<a class="bds_tqq" title="分享到腾讯微博" href="http://www.zxsx.org/newnsxin.asp?class=1#"></a>
<a class="bds_print" title="分享到打印" href="http://www.zxsx.org/newnsxin.asp?class=1#"></a>
<a class="bds_copy" title="分享到复制网址" href="http://www.zxsx.org/newnsxin.asp?class=1#"></a>
<a class="shareCount" href="hhttp://www.zxsx.org/newnsxin.asp?class=1#" title="累计分享0次">0</a>
</div>
<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=0" src="/public/index/js/bds_s_v2.js"></script>

<script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script>
<!-- Baidu Button END -->
</div>

     <div class="public_nav_gray"></div>
     <div class="public_nav_red"></div>
     <div class="public_nav_blue"></div>
     </div>
	 
	 
     
     <!--[if !IE]>左边<![endif]-->
     <div style=" margin-top:20px; width:1000px; border:0px;" class="public_pt_left">
	 
	 <!--新闻内容-->


     <!--相关推荐-->
         <div class="article_xiangguantuijian" style="border:0px; margin-top:0px; width:1000px; border:0px;">

       <ul style="margin-top:0px; width:1000px;">
	  
		    <?php foreach ($rows as $k=>$row_item): ?>	
			<li style="border:0px; font-size:12px; width:1000px; clear:both; "><p style="float:left; width:500px;" > ·<a href="/index.php/zxsx/view/article/<?php echo $row_item->aid;  ?>" target="_blank">  <?php echo htmlspecialchars($row_item->title); ?></a></p><p style="float:right; width:120px; color:#d2d2d2;"> <span style=" color:#606060;"><?php echo date("Y-m-d",$row_item->addtime); ?></span></p></li>
            <?php if(floor($k%8)==0&&$k<32&&$k>0) echo '<li style="border-bottom:#d2d2d2 1px dotted; width:1000px; clear:both;"></li>'?>			
			<?php endforeach ?>
			<li style=" width:1000px; height:14px; clear:both; "></li>
			<li style="width:1000px; clear:both;">&nbsp; 共 <span class="right_tou"><?php echo $totalRows; ?></span> 篇文章<?php echo $link; ?> 页次：<span class="right_tou"><?php echo $howPages ;?></span>/<span class="right_tou"><?php echo $totalPages ;?></span>页 <span class="right_tou"><?php echo $num ;?></span>篇文章/页</li>
      </ul>
      </div> 
	  
     </div>
 <!--[if !IE]>右边<![endif]-->
     <!--[if !IE]>搜索<![endif]-->  
	    
		<!--搜索-->
          
		  
		  <!--右边-->






</div>

 
 
