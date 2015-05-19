		<div class="floor_1">
			<div class="news_play">
				<div id="hotpic">
					<div id="NewsPic">
					<?php foreach($thumbs as $thkey=>$thval):?>
					<?php if($thkey==0):?>
         				<a target="_blank" href="/index.php/open_goverment/view/article/<?php echo $thval->aid; ?>" style="visibility: visible; display: block;">
                		<img width="350px" height="260px" src="<?php echo $thval->thumb; ?>" class="Picture" alt="<?php echo $thval->title; ?>" title="<?php echo $thval->title; ?>" /></a>
           			<?php else:?>  
           				<a style="visibility: hidden; display: none;" target="_blank" href="/index.php/open_goverment/view/article/<?php echo $thval->aid; ?>">
                		<img class="Picture" src="<?php echo $thval->thumb; ?>" style="width: 350px; height: 260px;" alt="<?php echo $thval->title; ?>" title="<?php echo $thval->title; ?>" /></a>
           			<?php endif;?>
                	<?php endforeach;?>  
						<div class="Nav">
                            <?php for($i=1;$i<=count($thumbs);$i++){ ?>
			    			<span <?php if($i==1):?>class="Cur" style="width:60px;"<?php else:?>class="Normal"<?php endif;?>><?php echo $i;?></span>
			    			<?php }?>
						</div>
						<div id="NewsPicTxt" style="width: 370px; overflow: hidden">
							<a target="_blank" href="/index.php/open_goverment/view/article/<?php echo $thumbs[0]->aid; ?>"><?php echo $thumbs[0]->title; ?></a>
						</div>
					</div>
				</div>
				<script type="text/javascript" src="/public/index/js/jquery.litenav.js"></script>
				<script type="text/javascript">
          $('#hotpic').liteNav(2000);
        </script>
			</div>
			<!--news_play end-->
			<div class="center_news_list">
				<div class="news_list">
					<div id="tabbox">
						<ul class="tabs" id="tabs">
							<li><a href="/index.php/open_goverment/nlists/news/5">板芙新闻</a></li>
							<li><a href="/index.php/open_goverment/nlists/news/6">部门动态</a></li>
							<li><a href="/index.php/open_goverment/nlists/news/7">媒体聚焦</a></li>
							<li><a href="/index.php/open_goverment/nlists/news/zsyw">中山要闻</a></li>
						</ul>
						<div class="news_list_more">
							<a target="_blank" href="/index.php/open_goverment/nlists/news">更多&gt;&gt;</a>
						</div>
						<ul class="tab_conbox" id="tab_conbox">
						<?php if(count($news_bfxw) > 0):?>
							<li class="tab_con">
								<?php foreach ($news_bfxw as $row_item): ?>
								<span><font><?php echo date("m-d",$row_item->rel_date); ?></font><a target="_blank" href="<?php if($row_item->is_redirect){ echo $row_item->redirect_url;} else {?>/index.php/open_goverment/view/article/<?php echo $row_item->aid; }?>"><?php echo htmlspecialchars($row_item->title); ?></a></span>
								<?php endforeach ?>
							</li>
						<?php else:?>
            				<li class="no_data" style="margin-top:100px;">暂无数据</li>
            			<?php endif;?>
            			
            			<?php if(count($news_bmdt) > 0):?>
							<li class="tab_con">
								<?php foreach ($news_bmdt as $row_item): ?>
								<span><font><?php echo date("m-d",$row_item->rel_date); ?></font><a target="_blank" href="<?php if($row_item->is_redirect){ echo $row_item->redirect_url;} else {?>/index.php/open_goverment/view/article/<?php echo $row_item->aid; }?>"><?php echo htmlspecialchars($row_item->title); ?></a></span>
								<?php endforeach ?>
							</li>
						<?php else:?>
            				<li class="no_data" style="margin-top:100px;">暂无数据</li>
            			<?php endif;?>
							
						<?php if(count($news_mtjj) > 0):?>
							<li class="tab_con">
								<?php foreach ($news_mtjj as $row_item): ?>
								<span><font><?php echo date("m-d",$row_item->rel_date); ?></font><a target="_blank" href="<?php if($row_item->is_redirect){ echo $row_item->redirect_url;} else {?>/index.php/open_goverment/view/article/<?php echo $row_item->aid; }?>"><?php echo htmlspecialchars($row_item->title); ?></a></span>
								<?php endforeach ?>
							</li>
						<?php else:?>
            				<li class="no_data">暂无数据</li>
            			<?php endif;?>
            			
            			<?php if(count($row_zsyw) > 0):?>
							<li class="tab_con">
								<?php foreach ($row_zsyw as $row_item): ?>
								<span><font><?php echo date("m-d",strtotime($row_item['date']));?></font><a target="_blank" href="/index.php/open_goverment/view/zsyw/<?php echo $row_item['id'] ?>"><?php echo $row_item['title'] ?></a></span>
								<?php endforeach ?>
							</li>
						<?php else:?>
            				<li class="no_data">暂无数据</li>
            			<?php endif;?>
						</ul>
					</div>
					<!--tabbox end -->
				</div>
				<!--news_list end-->
			</div>
			<!--center_news_list end-->
			<div class="leader_survey">
				<div class="tit"><!--<a href="/index.php/open_goverment/nlists/yjx/zfyjx"><img src="/public/attached/thumb/20141226/gov_idea_btn.png"></a>--></div>
				<div class="con">
					<ul>
						<li class="leader_survey_ico1"><a target="_blank" href="/index.php/open_goverment/view/page/154"> <img src="/public/index/images/leader_survey_ico1.png" /> <font>领导之窗</font></a></li>
						<li class="leader_survey_ico2"><a target="_blank" href="/index.php/open_goverment/organize"> <img src="/public/index/images/leader_survey_ico2.png" /> <font>组织机构</font></a></li>
						<li class="leader_survey_ico3"><a target="_blank" href="/index.php/open_goverment/lists/zfwork"> <img src="/public/index/images/leader_survey_ico3.png" /> <font>总结公报</font></a></li>
						<li class="leader_survey_ico4"><a target="_blank" href="/index.php/open_goverment/video"> <img src="/public/index/images/leader_survey_ico4.png" /> <font>视频专区</font></a></li>
					</ul>
				</div>
			</div>
		</div>
		<!--floor_1 end-->
		<div class="info_public_bar">
			<div class="tit"><a href="/index.php/open_goverment/zwgk" target="_blank">
				<img src="/public/index/images/info_public_bar_pic.jpg" / border="0"></a>
			</div>
			<div class="con">
				<ul class="tabs3">
					<li><a target="_blank" class="inf_disclosure_con_1" href="/index.php/open_goverment/lists/gkzn">信息公开指南</a></li>
					<li><a target="_blank" class="inf_disclosure_con_2" href="/index.php/open_goverment/lists/gkgd">信息公开规定</a></li>
					<li><a target="_blank" class="inf_disclosure_con_3" href="/index.php/open_goverment/nlists/yjx/zfyjx">信息公开意见箱</a></li>
					<li><a target="_blank" class="inf_disclosure_con_4" href="/index.php/open_goverment/nlists/gkbg/zfgkbg">依申请公开</a></li>
				</ul>
				<ul class="tab_conbox3">
					<li class="tab_con3">
						<a target="_blank" href="/index.php/open_goverment/view/page/154"><i>&middot;</i>领导之窗</a> 
						<a target="_blank" href="/index.php/open_goverment/organize"><i>&middot;</i>组织机构</a> 
						<a target="_blank" href="/index.php/open_goverment/nlists/notice"><i>&middot;</i>公告信息</a> 
						<a target="_blank" href="/index.php/open_goverment/lists/zcwj"><i>&middot;</i>政策文件</a> 
						<a target="_blank" href="/index.php/open_goverment/nlists/rsxx/rsrm"><i>&middot;</i>人事信息</a> 
						<a target="_blank" href="/index.php/open_goverment/lists/fzjh"><i>&middot;</i>规划计划</a> 
						<a target="_blank" href="/index.php/open_goverment/lists/tjsj"><i>&middot;</i>统计数据</a> 
						<a target="_blank" href="/index.php/open_goverment/lists/zsyz"><i>&middot;</i>招商引资</a> 
						<a target="_blank" href="/index.php/open_goverment/lists/75"><i>&middot;</i>重大项目</a> 
						<a target="_blank" href="/index.php/open_goverment/lists/czxx"><i>&middot;</i>财政信息</a> 
						<a target="_blank" href="/index.php/open_goverment/nlists/qzqd"><i>&middot;</i>权责清单</a> 
						<a target="_blank" href="/index.php/topic_page/lists"><i>&middot;</i>热点专题</a>
					</li>
				</ul>
			</div>
		</div>
		<!--info_public_bar end-->
		<div class="open_gov_main">
			<div class="gov_top_left">
				<a target="_blank" href="/index.php/open_goverment/nlists/notice/"><img src="/public/index/images/open_gov_main_pic1.png" /></a>
				<ul>
				<?php if(count($row_tzgg)>0):?>
					<?php foreach ($row_tzgg as $row_item): ?>
					<li><font><?php echo date("m-d",$row_item->rel_date); ?></font><a target="_blank" href="<?php if($row_item->is_redirect){ echo $row_item->redirect_url;} else {?>/index.php/open_goverment/view/article/<?php echo $row_item->aid; }?>" title="<?php echo htmlspecialchars($row_item->title) ?>"><i>&middot;</i><?php echo htmlspecialchars($row_item->title) ?></a></li>
					<?php endforeach ?>
				<?php else:?>
            		<li class="no_data" style="margin-top:50px;">暂无数据</li>
				<?php endif;?>
				</ul>
			</div>
			<div class="gov_top_center">
				<a target="_blank" href="/index.php/open_goverment/nlists/rsxx/rsrm"><img src="/public/index/images/open_gov_main_pic2.png" /></a>
				<ul>
				<?php if(count($row_rsxx)>0):?>
					<?php foreach ($row_rsxx as $row_item): ?>
					<li><font><?php echo date("m-d",strtotime($row_item['date'])); ?></font><a target="_blank" href="/index.php/open_goverment/view/rsxx/<?php echo $row_item['id']; ?>" title="<?php echo $row_item['title']; ?>"><i>&middot;</i><?php echo $row_item['title']; ?></a></li>
					<?php endforeach ?>
				<?php else:?>
            		<li class="no_data" style="margin-top:50px;">暂无数据</li>
				<?php endif;?>
				</ul>
			</div>
			<div class="gov_top_center">
				<a target="_blank" href="/index.php/open_goverment/lists/zcwj"><img src="/public/index/images/open_gov_main_pic3.png" /></a>
				<ul>
				<?php if(count($row_zcwj)>0):?>
					<?php foreach ($row_zcwj as $row_item): ?>
					<li><font><?php echo date("m-d",strtotime($row_item['date'])); ?></font><a target="_blank" href="/index.php/open_goverment/view/zcwj/<?php echo $row_item['id']; ?>" title="<?php echo $row_item['title']; ?>"><i>&middot;</i><?php echo $row_item['title']; ?></a></li>
					<?php endforeach ?>
				<?php else:?>
            		<li class="no_data" style="margin-top:50px;">暂无数据</li>
				<?php endif;?>
				</ul>
			</div>
			<div class="gov_top_right">
				<a target="_blank" href="/index.php/open_goverment/lists/fzjh"><img src="/public/index/images/open_gov_main_pic4.png" /></a>
				<ul>
				<?php if(count($row_fzjh)>0):?>
					<?php foreach ($row_fzjh as $row_item): ?>
					<li><font><?php echo date("m-d",strtotime($row_item['date'])); ?></font><a target="_blank" href="/index.php/open_goverment/view/fzjh/<?php echo $row_item['id']; ?>" title="<?php echo $row_item['title']; ?>"><i>&middot;</i><?php echo $row_item['title']; ?></a></li>
					<?php endforeach ?>
				<?php else:?>
            		<li class="no_data" style="margin-top:50px;">暂无数据</li>
				<?php endif;?>
				</ul>
			</div>
			<div class="gov_foot_left">
				<a target="_blank" href="/index.php/open_goverment/lists/tjsj"><img src="/public/index/images/open_gov_main_pic5.png" /></a>
				<ul>
				<?php if(count($row_tjsj)>0):?>
					<?php foreach ($row_tjsj as $row_item): ?>
					<li><font><?php echo date("m-d",strtotime($row_item['date'])); ?></font><a target="_blank" href="/index.php/open_goverment/view/tjsj/<?php echo $row_item['id']; ?>" title="<?php echo $row_item['title']; ?>"><i>&middot;</i><?php echo $row_item['title'] ?></a></li>
					<?php endforeach ?>
				<?php else:?>
            		<li class="no_data" style="margin-top:50px;">暂无数据</li>
				<?php endif;?>
				</ul>
			</div>
			<div class="gov_foot_center">
				<a target="_blank" href="/index.php/open_goverment/nlists/tender"><img src="/public/index/images/open_gov_main_pic6.png" /></a>
				<ul>
				<?php if(count($row_zbgs)>0):?>
					<?php foreach ($row_zbgs as $row_item): ?>
					<li><font><?php echo date("m-d",$row_item->rel_date); ?></font><a target="_blank" href="<?php if($row_item->is_redirect){ echo $row_item->redirect_url;} else {?>/index.php/open_goverment/view/article/<?php echo $row_item->aid; }?>" title="<?php echo htmlspecialchars($row_item->title) ?>"><i>&middot;</i><?php echo htmlspecialchars($row_item->title) ?></a></li>
					<?php endforeach ?>
				<?php else:?>
            		<li class="no_data" style="margin-top:50px;">暂无数据</li>
				<?php endif;?>
				</ul>
			</div>
			<div class="gov_foot_center">
				<a target="_blank" href="/index.php/open_goverment/lists/75"><img src="/public/index/images/open_gov_main_pic7.png" /></a>
				<ul>
				<?php if(count($row_zdxm)>0):?>
					<?php foreach ($row_zdxm as $row_item): ?>
					<li><font><?php echo date("m-d",$row_item->rel_date); ?></font><a target="_blank" href="<?php if($row_item->is_redirect){ echo $row_item->redirect_url;} else {?>/index.php/open_goverment/view/article/<?php echo $row_item->aid; }?>" title="<?php echo htmlspecialchars($row_item->title) ?>"><i>&middot;</i><?php echo htmlspecialchars($row_item->title) ?></a></li>
					<?php endforeach ?>
				<?php else:?>
            		<li class="no_data" style="margin-top:50px;">暂无数据</li>
				<?php endif;?>
				</ul>
			</div>
			<div class="gov_foot_right">
				<a target="_blank"s href="/index.php/open_goverment/lists/czxx"><img src="/public/index/images/open_gov_main_pic8.png" /></a>
				<ul>
				<?php if(count($row_czxx)>0):?>
					<?php foreach ($row_czxx as $row_item): ?>
					<li><font><?php echo date("m-d",strtotime($row_item['date'])); ?></font><a target="_blank" href="/index.php/open_goverment/view/czxx/<?php echo $row_item['id']; ?>" title="<?php echo $row_item['title']; ?>"><i>&middot;</i><?php echo $row_item['title']; ?></a></li>
					<?php endforeach ?>
				<?php else:?>
            		<li class="no_data" style="margin-top:50px;">暂无数据</li>
				<?php endif;?>
				</ul>
			</div>
		</div>
		<!--open_gov_main end-->
		<div class="hot_topic">
			<div class="tit">
				<img src="/public/index/images/hot_topic.png" />
			</div>
			<script type="text/javascript">
    //js无缝滚动代码
    function marquee(i, direction){
        var obj = document.getElementById("marquee" + i);
        var obj1 = document.getElementById("marquee" + i + "_1");
        var obj2 = document.getElementById("marquee" + i + "_2");
            if (obj2.offsetWidth - obj.scrollLeft <= 0){
                obj.scrollLeft -= obj1.offsetWidth;
            }else{
                obj.scrollLeft++;
            }
        }
    function marqueeStart(i, direction){
        var obj = document.getElementById("marquee" + i);
        var obj1 = document.getElementById("marquee" + i + "_1");
        var obj2 = document.getElementById("marquee" + i + "_2");
        obj2.innerHTML = obj1.innerHTML;
        var marqueeVar = window.setInterval("marquee("+ i +", '"+ direction +"')", 30);
        obj.onmouseover = function(){
            window.clearInterval(marqueeVar);
        }
        obj.onmouseout = function(){
            marqueeVar = window.setInterval("marquee("+ i +", '"+ direction +"')", 30);
        }
    }
    </script>
			<div id="marquee1" class="marqueeleft">
				<div style="width: 8000px;">
					<ul id="marquee1_1">
						<?php foreach ($row_rdzt as $row_item): ?>
						<li><a target="_blank" href="/index.php/topic_page/index/<?php echo $row_item->cat_id; ?>" target="_blank"><img src="<?php echo $row_item->cat_thumb; ?>" width="220" height="100"></a></li>
						<?php endforeach;?>
					</ul>
					<ul id="marquee1_2"></ul>
				</div>
			</div>
			<script type="text/javascript">marqueeStart(1, "");</script>
			<!--marqueeleft end-->
		</div>
		<!--hot_topic end-->
	</div>
	<!--warper end-->