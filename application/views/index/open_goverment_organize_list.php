  <div class="breadcrumb">您所在的位置：<a href="/index.php">首页</a> &gt;&gt; <a href="/index.php/open_goverment">政务公开</a> &gt;&gt; 
    <span class="active">组织机构</span>
  </div>
  <!--breadcrumb end-->
  <div class="clear"></div>
  <div class="left_side">
    <div class="left_menu"> <img src="/public/index/images/left_menu_tit_opengovement.png" />
      <ul>
        <li><a href="/index.php/open_goverment/nlists/news">新闻动态</a></li>
        <li><a href="/index.php/open_goverment/nlists/notice">公告信息</a></li>
        <li><a target="_blank" href="/index.php/open_goverment/view/page/154">领导之窗</a></li>
        <li><a style="background: #0067ad;color: #FFF;" href="/index.php/open_goverment/organize">组织机构</a></li>
        <li><a href="/index.php/open_goverment/lists/zcwj">政策文件</a></li>
        <li><a href="/index.php/open_goverment/lists/rsxx">人事信息</a></li>
        <li><a href="/index.php/open_goverment/lists/fzjh">规划计划</a></li>
        <li><a href="/index.php/open_goverment/lists/tjsj">统计数据</a></li>
        <li><a href="/index.php/open_goverment/lists/zsyz">招商引资</a></li>
        <li><a href="/index.php/open_goverment/nlists/tender">招标采购</a></li>
        <li><a href="/index.php/open_goverment/lists/75">重大项目</a></li>
        <li><a href="/index.php/open_goverment/lists/czxx">财政信息</a></li>
        <li><a href="/index.php/open_goverment/nlists/qzqd">权责清单</a></li>
        <li><a  href="/index.php/open_goverment/video">视频专区</a></li>
        <li><a href="/index.php/topic_page/lists">热点专题</a></li>
      </ul>
    </div>
    <div class="clear2"></div>
    <div class="left_menu"> <a target="_blank" href="/index.php/open_goverment/zwgk"><img src="/public/index/images/left_menu_tit_pic1.png" /></a>
      <ul>
        <li><a class="con_1" href="/index.php/open_goverment/lists/gkzn">信息公开指南</a></li>
        <li><a class="con_2" href="/index.php/open_goverment/lists/gkgd" target="_blank">信息公开规定</a></li>
        <li><a class="con_3" href="/index.php/open_goverment/lists/gkbg">公开年度报告</a></li>
        <li><a class="con_4" href="/index.php/open_goverment/nlists/gkbg/zfgkbg" target="_blank">依申请公开</a></li>
		<li><a<?php if($listType=='yjx'): ?> style="background:url(/public/index/images/inf_disclosure_con_5_5.png) no-repeat 45px 6px #0067ad;color: #FFF;"<?php endif; ?> class="con_5" href="/index.php/open_goverment/nlists/yjx/zfyjx">&nbsp;&nbsp;信息公开意见箱</a></li>
      </ul>
    </div>
  </div>
  <!--left_side end-->
  <div class="right_side">
    <div class="news_list2">
      <div class="organization">
        <?php foreach($lists as $list):?>
        <div class="list">
          <div class="tit"><?php echo htmlspecialchars($list['listName']);?></div>
          <ul>
          	<?php foreach($list['rows'] as $li):?>
            <li><a href="<?php if($li->is_redirect){ echo $li->redirect_url;} else{?>/index.php/open_goverment/view/article/<?php echo $li->aid;}?>" target="_blank">·<?php echo htmlspecialchars($li->title);?></a></li>
          	<?php endforeach;?>
          </ul>
        </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>
</div>
<!--warper end-->
