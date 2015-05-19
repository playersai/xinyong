
  <div class="breadcrumb">您所在的位置：<a href="/index.php">首页</a> &gt;&gt; <a href="/index.php/online_services">网上服务</a> &gt;&gt;
    <span class="active">公共服务</span>
  </div>
  <!--breadcrumb end-->
  <div class="clear"></div>
  <div class="left_side">
    <div class="left_menu"> <img src="/public/index/images/left_menu_tit_online_services.png" />
      <ul>
        <li><a href="/index.php/online_services/service">办事服务</a></li>
        <li><a href="/index.php/online_services/form">表格下载</a></li>
        <li><a style="background: #0067ad;color: #FFF;" href="/index.php/online_services/state">公共服务</a></li>
        <li><a href="/index.php/online_services/utility">实用查询</a></li>
        <li><a href="/index.php/online_services/legal">执法依据</a></li>
      </ul>
    </div>
  </div>
  <!--left_side end-->
  <div class="right_side">
    <div class="public_service_box">
      <ul class="public_service_tabs" id="">
        <li<?php if($mainid==23): ?> class="thistab"<?php endif; ?>> <a href="/index.php/online_services/state/23"><img src="/public/index/images/public_service_pic1.png" /><br />
        教育文化</a></li>
        <li<?php if($mainid==24): ?> class="thistab"<?php endif; ?>> <a href="/index.php/online_services/state/24"><img src="/public/index/images/public_service_pic2.png" /><br />
        社保服务</a></li>
        <li<?php if($mainid==25): ?> class="thistab"<?php endif; ?>> <a href="/index.php/online_services/state/25"><img src="/public/index/images/public_service_pic3.png" /><br />
        就业服务</a></li>
        <li<?php if($mainid==26): ?> class="thistab"<?php endif; ?>> <a href="/index.php/online_services/state/26"><img src="/public/index/images/public_service_pic4.png" /><br />
        招商引资</a></li>
        <li<?php if($mainid==27): ?> class="thistab"<?php endif; ?>> <a href="/index.php/online_services/state/27"><img src="/public/index/images/public_service_pic5.png" /><br />
        医疗服务</a></li>
        <li<?php if($mainid==28): ?> class="thistab"<?php endif; ?>> <a href="/index.php/online_services/state/28"><img src="/public/index/images/public_service_pic6.png" /><br />
        住房服务</a></li>
        <li<?php if($mainid==29): ?> class="thistab"<?php endif; ?>> <a href="/index.php/online_services/state/29"><img src="/public/index/images/public_service_pic7.png" /><br />
        交通出行</a></li>
        <li<?php if($mainid==30): ?> class="thistab"<?php endif; ?>> <a href="/index.php/online_services/state/30"><img src="/public/index/images/public_service_pic8.png" /><br />
        企业开办</a></li>
        <li<?php if($mainid==31): ?> class="thistab"<?php endif; ?>> <a href="/index.php/online_services/state/31"><img src="/public/index/images/public_service_pic9.png" /><br />
        婚育收养</a></li>
        <li<?php if($mainid==32): ?> class="thistab"<?php endif; ?>> <a href="/index.php/online_services/state/32"><img src="/public/index/images/public_service_pic10.png" /><br />
        公共事业</a></li>
        <li<?php if($mainid==33): ?> class="thistab"<?php endif; ?>> <a href="/index.php/online_services/state/33"><img src="/public/index/images/public_service_pic11.png" /><br />
        证件办理</a></li>
        <li<?php if($mainid==34): ?> class="thistab"<?php endif; ?>> <a href="/index.php/online_services/state/34"><img src="/public/index/images/public_service_pic12.png" /><br />
        电子地图</a></li>
      </ul>
      <div class="public_service_conbox">
        <ul class="public_service_tab_conbox" id="tab_conbox6">
          <li class="public_service_tab_con">
          <?php foreach ($row_service as $row_item): ?>			
          <span><a <?php if($row_item->id==$serviceid): ?> style="background: url(/public/index/images/legal_basis_arrowhover.png) no-repeat 20px 10px #0067ad;color: #fff;"<?php endif; ?> href="/index.php/online_services/state/<?php echo $row_item->parentid;?>/<?php echo $row_item->id;?>"><?php echo $row_item->name;?></a></span>
		  <?php endforeach ?>
          </li>
        </ul>
        <div class="clear"></div>
        <div class="tit"><?php echo $service_name;?></div>
        <div class="con">
        <?php if ($mainid == 34): ?> 
          <!--百度地图容器-->
          <div style="width:800px;height:380px;" id="dituContent"></div>
          <script type="text/javascript">
            //创建和初始化地图函数：
            function initMap(){
                createMap();//创建地图
                setMapEvent();//设置地图事件
                addMapControl();//向地图添加控件
            }
            //创建地图函数：
            function createMap(){
                var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
                var point = new BMap.Point(113.328872,22.422652);//定义一个中心点坐标
                map.centerAndZoom(point,18);//设定地图的中心点和坐标并将地图显示在地图容器中
                window.map = map;//将map变量存储在全局
            }
            //地图事件设置函数：
            function setMapEvent(){
                map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
                map.enableScrollWheelZoom();//启用地图滚轮放大缩小
                map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
                map.enableKeyboard();//启用键盘上下左右键移动地图
            }
            //地图控件添加函数：
            function addMapControl(){
                //向地图中添加缩放控件
            var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_ZOOM});
            map.addControl(ctrl_nav);
                //向地图中添加缩略图控件
            var ctrl_ove = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:0});
            map.addControl(ctrl_ove);
                }
            initMap();//创建和初始化地图
          </script>
        <?php elseif ($mainid==26):?>
          <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="800" height="600"><param name="movie" value="http://www.banfu.gov.cn/view/vcastr22.swf"><param name="quality" value="high"><param name="allowFullScreen" value="true"><param name="FlashVars" value="vcastr_file=http://www.banfu.gov.cn/websit/upload/flv/20130238招商片（有字幕）.flv"><embed src="http://www.banfu.gov.cn/view/vcastr22.swf" allowfullscreen="true" flashvars="vcastr_file=http://www.banfu.gov.cn/websit/upload/flv/20130238招商片（有字幕）.flv" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="800" height="600"></object>
        <?php else: ?> 
          <ul>
          	<?php foreach ($rows as $row_item): ?>
            <li>
              <?php if ($row_item['showtype'] == 6): ?>
                <a><?php echo $row_item['name'];?></a>
                <span>
                  <?php foreach ($row_item['items'] as $r_item): ?>
                  	<a target="_blank" href="<?php if(substr($r_item['link'], 0, 1)=='/'){echo 'http://www.zs.gov.cn'.$r_item['link'];} else {echo $r_item['link'];} ?>"><?php echo $r_item['name']; ?></a>
                  <?php endforeach ?>
                </span>
              <?php else: ?>
                <?php if(substr($row_item['url'], 0,1)=='/') $row_item['url']='http://www.zs.gov.cn'.$row_item['url']; ?>
              	<a target="_blank" href="<?php echo $row_item['url']; ?>"><?php echo $row_item['name'];?></a>
              	<font><?php echo $row_item['content'];?></font>
              <?php endif; ?>
            </li>
          	<?php endforeach ?>
          </ul> 
        <?php endif; ?>  
        </div>
        <div class="clear"></div>
      </div>
    </div>
  </div>
</div>
<!--warper end-->