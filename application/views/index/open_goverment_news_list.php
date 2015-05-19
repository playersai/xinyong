
  <div class="breadcrumb">您所在的位置：<a href="/index.php">首页</a> &gt;&gt; <a href="/index.php/open_goverment">政务公开</a> &gt;&gt; 
  	<?php if($listType=='news'): ?> <a href="/index.php/open_goverment/nlists/news">新闻动态</a> &gt;&gt; <?php endif; ?>
	<?php if($listType=='rsxx'): ?> <a href="/index.php/open_goverment/nlists/rsxx">人事信息</a> &gt;&gt; <?php endif; ?>
  	<?php if($listType=='notice'): ?> <a href="/index.php/open_goverment/nlists/notice">公告信息</a> &gt;&gt; <?php endif; ?>
  	<?php if($listType=='tender'): ?> <a href="/index.php/open_goverment/nlists/tender">招标采购</a> &gt;&gt; <?php endif; ?>
    <span class="active"><?php echo $categoryName; ?></span>
  </div>
  <!--breadcrumb end-->
  <div class="clear"></div>
  <div class="left_side">
    <div class="left_menu"> <img src="/public/index/images/left_menu_tit_opengovement.png" />
      <ul>
        <li><a<?php if($listType=='news'): ?> style="background: #0067ad;color: #FFF;"<?php endif; ?> href="/index.php/open_goverment/nlists/news">新闻动态</a></li>
        <li><a<?php if($listType=='notice'): ?> style="background: #0067ad;color: #FFF;"<?php endif; ?> href="/index.php/open_goverment/nlists/notice">公告信息</a></li>
        <li><a target="_blank" href="/index.php/open_goverment/view/page/154">领导之窗</a></li>
        <li><a href="/index.php/open_goverment/organize">组织机构</a></li>
        <li><a href="/index.php/open_goverment/lists/zcwj">政策文件</a></li>
        <li><a<?php if($catid=='rsrm'||$catid==225): ?> style="background: #0067ad;color: #FFF;"<?php endif; ?> href="/index.php/open_goverment/nlists/rsxx/rsrm">人事信息</a></li>
        <li><a href="/index.php/open_goverment/lists/fzjh">规划计划</a></li>
        <li><a href="/index.php/open_goverment/lists/tjsj">统计数据</a></li>
        <li><a href="/index.php/open_goverment/lists/zsyz">招商引资</a></li>
        <li><a<?php if($listType=='tender'): ?> style="background: #0067ad;color: #FFF;"<?php endif; ?> href="/index.php/open_goverment/nlists/tender">招标采购</a></li>
        <li><a href="/index.php/open_goverment/lists/75">重大项目</a></li>
        <li><a href="/index.php/open_goverment/lists/czxx">财政信息</a></li>
        <li><a<?php if($listType=='qzqd'): ?> style="background: #0067ad;color: #FFF;"<?php endif; ?>  href="/index.php/open_goverment/nlists/qzqd">权责清单</a></li>
        <li><a href="/index.php/open_goverment/video">视频专区</a></li>
        <li><a href="/index.php/topic_page/lists">热点专题</a></li>
      </ul>
    </div>
    <div class="clear2"></div>
    <div class="left_menu"> <a target="_blank" href="/index.php/open_goverment/zwgk"><img src="/public/index/images/left_menu_tit_pic1.png" /></a>
      <ul>
        <li><a class="con_1" href="/index.php/open_goverment/lists/gkzn">信息公开指南</a></li>
        <li><a class="con_2" href="/index.php/open_goverment/lists/gkgd" target="_blank">信息公开规定</a></li>
        <li><a class="con_3" href="/index.php/open_goverment/lists/gkbg">公开年度报告</a></li>
        <li><a<?php if($listType=='gkbg'): ?> style="background:url(/public/index/images/inf_disclosure_con_4_4.png) no-repeat 45px 6px #0067ad;color: #FFF;"<?php endif; ?> class="con_4" href="/index.php/open_goverment/nlists/gkbg/zfgkbg">依申请公开</a></li>
		<li><a<?php if($listType=='yjx'): ?> style="background:url(/public/index/images/inf_disclosure_con_5_5.png) no-repeat 45px 6px #0067ad;color: #FFF;"<?php endif; ?> class="con_5" href="/index.php/open_goverment/nlists/yjx/zfyjx">&nbsp;&nbsp;信息公开意见箱</a></li>
      </ul>
    </div>
  </div>
  <!--left_side end-->
  <div class="right_side">
    <div class="news_list2">
	<?php if($listType=='gkbg'): ?> 
 
    <iframe name="listFrame" onload="this.height=listFrame.document.body.scrollHeight" id="listFrame" src="http://www.zs.gov.cn/main/zwgk/open/request3/index.action?pubcode=1-04C-20" frameborder="0" height="805" width="100%" scrolling="no"></iframe>
  
	<?php elseif($listType=='yjx'): ?>
 
	<div style="width:868px;border: 1px solid #ccc;float: left;">
		 <span style="width: 237px;float: left;margin-top: 100px;margin-left: 300px;margin-bottom: 100px;">
		   <a style="float:left; margin-bottom:20px;" target="_blank" href="http://www.zs.gov.cn/main/zwgk/xxgkyjx/xycn/index.action?id=1"><img src="/public/index/images/mailbuttonsbg_01.png" height="54" width="237" /></a>
		   <a style="float:left; margin-bottom:20px;" target="_blank" href="http://www.zs.gov.cn/main/zwgk/xxgkyjx/xycn/index.action?id=2"><img src="/public/index/images/mailbuttonsbg_02.png" height="54" width="237" /></a>
		   <a style="float:left; margin-bottom:20px;" target="_blank" href="http://www.zs.gov.cn/main/zwgk/xxgkyjx/search/index.action"><img src="/public/index/images/mailbuttonsbg_03.png" height="54" width="237" /></a>
		   <a target="_blank" href="http://www.zs.gov.cn/main/zwgk/open/index.action?did=2"><img src="/public/index/images/mailbuttonsbg_04.png" height="54" width="237" /></a>
		 </span>
    </div>
	<?php else: ?>
      <?php if($listType!='qzqd'): ?>
      <ul class="tabs" id="tab">
      	<?php if($listType=='notice'): ?>
      	<li<?php if($catid=='9'): ?> class="thistab"<?php endif; ?>><a href="/index.php/open_goverment/nlists/notice/9">通知公告</a></li>
        <li<?php if($catid=='sjtz'): ?> class="thistab"<?php endif; ?>><a href="/index.php/open_goverment/nlists/notice/sjtz">市级通知</a></li>
      	<?php elseif ($listType=='news'): ?>
        <li<?php if($catid=='5'): ?> class="thistab"<?php endif; ?>><a href="/index.php/open_goverment/nlists/news/5">板芙新闻</a></li>
        <li<?php if($catid=='6'): ?> class="thistab"<?php endif; ?>><a href="/index.php/open_goverment/nlists/news/6">部门动态</a></li>
        <li<?php if($catid=='7'): ?> class="thistab"<?php endif; ?>><a href="/index.php/open_goverment/nlists/news/7">媒体聚焦</a></li>
        <li<?php if($catid=='zsyw'): ?> class="thistab"<?php endif; ?>><a href="/index.php/open_goverment/nlists/news/zsyw">中山要闻</a></li>
		    <?php elseif ($listType=='rsxx'): ?>
        <li<?php if($catid=='rsrm'): ?> class="thistab"<?php endif; ?>><a href="/index.php/open_goverment/nlists/rsxx/rsrm">人事任免</a></li>
        <li<?php if($catid=='225'): ?> class="thistab"<?php endif; ?>><a href="/index.php/open_goverment/nlists/rsxx/225">机关人员招录</a></li>
        <?php elseif ($listType=='tender'): ?>
        <li<?php if($catid=='183'): ?> class="thistab"<?php endif; ?>><a href="/index.php/open_goverment/nlists/tender/183">招标公示</a></li>
        <li<?php if($catid=='184'): ?> class="thistab"<?php endif; ?>><a href="/index.php/open_goverment/nlists/tender/184">中标公示</a></li> 
        <?php endif; ?>
      </ul>
     <?php endif; ?>
      <ul class="tab_conbox" id="tab_con">
        <li class="tab_con">
        <?php if($catid=='zsyw'): ?> 
        	<?php foreach ($rows as $row_item): ?>
        	<span><font><?php echo $row_item['date']; ?></font><a target="_blank"  href="/index.php/open_goverment/view/zsyw/<?php echo $row_item['id']; ?>"><?php echo $row_item['title']; ?></a></span>
        	<?php endforeach ?>
        <?php elseif ($catid == 'sjtz'): ?>
        	<?php foreach ($rows as $row_item): ?>
        	<span><font><?php echo $row_item['date']; ?></font><a target="_blank"  href="/index.php/open_goverment/view/sjtz/<?php echo $row_item['id']; ?>"><?php echo $row_item['title']; ?></a></span>
        	<?php endforeach ?>
		<?php elseif ($catid == 'rsrm'): ?>
        	<?php foreach ($rows as $row_item): ?>
        	<span><font><?php echo $row_item['date']; ?></font><a target="_blank"  href="/index.php/open_goverment/view/rsxx/<?php echo $row_item['id']; ?>"><?php echo $row_item['title']; ?></a></span>
        	<?php endforeach ?>
        <?php else: ?>
        	<?php foreach ($rows as $row_item): ?>
        	<span><font><?php echo date("Y-m-d",$row_item->rel_date); ?></font><a target="_blank"  href="<?php if($row_item->is_redirect){ echo $row_item->redirect_url;} else {?>/index.php/open_goverment/view/article/<?php echo $row_item->aid; }?>"><?php echo htmlspecialchars($row_item->title); ?></a></span>
        	<?php endforeach ?>
        <?php endif; ?>
        <div class="clear"></div>
       	<div class="page">共<span style="color:#f00;"><?php echo $totalRows; ?></span>条记录，分<span style="color:#f00;"><?php echo $totalPages; ?></span>页显示 <?php echo $link; ?></div>
        </li>
      </ul>

	   <?php endif; ?>
    </div>
  </div>
</div>

<!--warper end-->
