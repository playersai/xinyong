
  <div class="breadcrumb">您所在的位置：<a href="/">首页</a> &gt;&gt; <a href="/index.php/open_goverment">政务公开</a> &gt;&gt; 
  	<span class="active"><?php echo $categoryName; ?></span>
  </div>
  <!--breadcrumb end-->
  <div class="clear"></div>
  <div class="left_side">
    <div class="left_menu"> <img src="/public/index/images/left_menu_tit_opengovement.png" />
      <ul>
        <li><a href="/index.php/open_goverment/nlists/news">新闻动态</a></li>
        <li><a href="/index.php/open_goverment/nlists/notice">公告信息</a></li>
        <li><a target="_blank" href="/index.php/open_goverment/view/page/154">领导之窗</a></li>
        <li><a href="/index.php/open_goverment/organize">组织机构</a></li>
        <li><a<?php if($catid=='zcwj'): ?> style="background: #0067ad;color: #FFF;"<?php endif; ?> href="/index.php/open_goverment/lists/zcwj">政策文件</a></li>
		<li><a<?php if($catid=='rsrm'||$catid==225): ?> style="background: #0067ad;color: #FFF;"<?php endif; ?> href="/index.php/open_goverment/nlists/rsxx/rsrm">人事信息</a></li>
        <li><a<?php if($catid=='fzjh'||$catid=='zfwork'): ?> style="background: #0067ad;color: #FFF;"<?php endif; ?> href="/index.php/open_goverment/lists/fzjh">规划计划</a></li>
        <li><a<?php if($catid=='tjsj'): ?> style="background: #0067ad;color: #FFF;"<?php endif; ?> href="/index.php/open_goverment/lists/tjsj">统计数据</a></li>
        <li><a<?php if($catid=='zsyz'): ?> style="background: #0067ad;color: #FFF;"<?php endif; ?> href="/index.php/open_goverment/lists/zsyz">招商引资</a></li>
        <li><a href="/index.php/open_goverment/nlists/tender">招标采购</a></li>
        <li><a<?php if($catid==75): ?> style="background: #0067ad;color: #FFF;"<?php endif; ?> href="/index.php/open_goverment/lists/75">重大项目</a></li>
        <li><a<?php if($catid=='czxx'): ?> style="background: #0067ad;color: #FFF;"<?php endif; ?> href="/index.php/open_goverment/lists/czxx">财政信息</a></li>
        <li><a href="/index.php/open_goverment/nlists/qzqd">权责清单</a></li>
        <li><a  href="/index.php/open_goverment/video">视频专区</a></li>
        <li><a href="/index.php/topic_page/lists">热点专题</a></li>
      </ul>
    </div>
    <div class="clear2"></div>
    <div class="left_menu"> <a target="_blank" href="/index.php/open_goverment/zwgk"><img src="/public/index/images/left_menu_tit_pic1.png" /></a>
      <ul>
        <li><a<?php if($catid=='gkzn'): ?> style="background:url(/public/index/images/inf_disclosure_con_1_1.png) no-repeat 45px 6px #0067ad;color: #FFF;"<?php endif; ?> class="con_1" href="/index.php/open_goverment/lists/gkzn">信息公开指南</a></li>
        <li><a class="con_2" href="/index.php/open_goverment/lists/gkgd" target="_blank">信息公开规定</a></li>
        <li><a<?php if($catid=='gkbg'): ?> style="background:url(/public/index/images/inf_disclosure_con_3_3.png) no-repeat 45px 6px #0067ad;color: #FFF;"<?php endif; ?> class="con_3" href="/index.php/open_goverment/lists/gkbg">公开年度报告</a></li>
        <li><a class="con_4" href="/index.php/open_goverment/nlists/gkbg/zfgkbg" target="_blank">依申请公开</a></li>
		<li><a<?php if($listType=='yjx'): ?> style="background:url(/public/index/images/inf_disclosure_con_5_5.png) no-repeat 45px 6px #0067ad;color: #FFF;"<?php endif; ?> class="con_5" href="/index.php/open_goverment/nlists/yjx/zfyjx">&nbsp;&nbsp;信息公开意见箱</a></li>
      </ul>
    </div>
  </div>
  <!--left_side end-->
  <div class="right_side">
    <div class="news_list2">
	<?php if($listType=='1'||$listType=='2'): ?>
	   <ul class="tabs" id="tab">
      	<li<?php if($catid=='fzjh'): ?> class="thistab"<?php endif; ?>><a href="/index.php/open_goverment/lists/fzjh">规划计划</a></li>
        <li<?php if($catid=='zfwork'): ?> class="thistab"<?php endif; ?>><a href="/index.php/open_goverment/lists/zfwork">政府工作报告</a></li>
      
      </ul>
	    <?php endif; ?>
      <ul class="tab_conbox" id="tab_conbox">
        <li class="tab_con">
        <?php if($isJsonData):?>
        	<?php foreach ($rows as $row_item): ?>
        	<span><font><?php echo $row_item['date']; ?></font><a target="_blank"  href="/index.php/open_goverment/view/<?php echo $catid; ?>/<?php echo $row_item['id']; ?>"><?php echo $row_item['title']; ?></a></span>
        	<?php endforeach ?>
        <?php else:?>
        	<?php foreach ($rows as $row_item): ?>
        	<span><font><?php echo date("Y-m-d",$row_item->rel_date); ?></font><a target="_blank"  href="<?php if($row_item->is_redirect){ echo $row_item->redirect_url;} else {?>/index.php/open_goverment/view/article/<?php echo $row_item->aid; }?>"><?php echo htmlspecialchars($row_item->title); ?></a></span>
        	<?php endforeach ?>
        <?php endif;?>
        <div class="clear"></div>
       	<div class="page">共<span style="color:#f00;"><?php echo $totalRows; ?></span>条记录，分<span style="color:#f00;"><?php echo $totalPages; ?></span>页显示 <?php echo $link; ?></div>
        </li>
      </ul>
    </div>
  </div>
</div>
<!--warper end-->

