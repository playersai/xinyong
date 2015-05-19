
  <div class="clear"></div>
  <div class="online_service">
    <div class="tit">办事服务</div>
    <div class="con"><img src="/public/index/images/online_service_tit1.png" />
      <ul>
      	<?php foreach ($row_grfw as $row_item): ?>
        <li><a target="_blank" href="/index.php/online_services/service/<?php echo $row_item->parentid;?>/<?php echo $row_item->id;?>"><?php echo $row_item->name;?></a></li>
		<?php endforeach ?>
      </ul>
    </div>
    <div class="con"><img src="/public/index/images/online_service_tit2.png" />
      <ul>
        <?php foreach ($row_qyfw as $row_item): ?>
        <li><a target="_blank" href="/index.php/online_services/service/<?php echo $row_item->parentid;?>/<?php echo $row_item->id;?>"><?php echo $row_item->name;?></a></li>
		<?php endforeach ?>
      </ul>
    </div>
    <div class="con"><img src="/public/index/images/online_service_tit3.png" />
      <ul>
        <?php foreach ($row_snfw as $row_item): ?>
        <li><a target="_blank" href="/index.php/online_services/service/<?php echo $row_item->parentid;?>/<?php echo $row_item->id;?>"><?php echo $row_item->name;?></a></li>
		<?php endforeach ?>
      </ul>
    </div>
  </div>
<!--online_service end-->
<div class="service_search">
    <ul class="tabs2" id="tabs13">
      <li><a href="">事项搜索</a></li>
      <li><a href="">表格搜索</a></li>
      <li><a href="">结果查询</a></li>
    </ul>
    <ul class="tab_conbox2" id="tab_conbox13">
      <li class="tab_con2">
      <input id="ipt_query" class="service_search_box1" name="query" type="text" />
      <select id="sel_deptName" name="deptName" class="select" onmouseover="FixWidth(this)">
            <option value="" selected="selected">请选择部门</option>
			<option value="中山市政府办公室">中山市政府办公室</option>
            <option value="发展和改革局">发展和改革局</option>
            <option value="安监局">安全生产监督管理局</option>
            <option value="保密局">保密局</option>
			<option value="编委办">编委办</option>
			<option value="财政局">财政局</option>
			<option value="残联">残联</option>
			<option value="城管执法局">城管执法局</option>
			<option value="档案局">档案局</option>
			<option value="地税局">地税局</option>
			<option value="法制局">法制局</option>
			<option value="工商局">工商局</option>
			<option value="公安边防支队">公安边防支队</option>
			<option value="公安交警支队">公安交警支队</option>
			<option value="公安局">公安局</option>
			<option value="公安消防支队">公安消防支队</option>
			<option value="公共汽车公司">公共汽车公司</option>
			<option value="公路局">公路局</option>
			<option value="供电局">供电局</option>
			<option value="规划局">规划局</option>
			<option value="国税局">国税局</option>
			<option value="国土资源局">国土资源局</option>
			<option value="海事局">海事局</option>
			<option value="海洋与渔业局">海洋与渔业局</option>
			<option value="航道局">航道局</option>
			<option value="红十字会">红十字会</option>
			<option value="环保局">环保局</option>
			<option value="检察院">检察院</option>
			<option value="住房和城乡建设局">住房和城乡建设局</option>
			<option value="交通运输局">交通运输局</option>
			<option value="教育局">教育局</option>
			<option value="经信局">经信局</option>
			<option value="科技局">科技局</option>
			<option value="人力资源和社会保障局">人力资源和社会保障局</option>
			<option value="林业局">林业局</option>
			<option value="旅游局">旅游局</option>
			<option value="民政局">民政局</option>
			<option value="民族宗教事务局">民族宗教事务局</option>
			<option value="农业局">农业局</option>
			<option value="气象局">气象局</option>
			<option value="人口和计划生育局">人口和计划生育局</option> 
			<option value="审改办">审改办</option>
			<option value="食品药品监督管理局">食品药品监督管理局</option>
			<option value="检察院">检察院</option>
			<option value="市投诉中心">市投诉中心</option>
			<option value="水务局">水务局</option>
			<option value="司法局">司法局</option>
			<option value="台湾事务局">台湾事务局</option>
			<option value="体育局">体育局</option>
			<option value="统计局">统计局</option>
			<option value="外经贸局">外经贸局</option>
			<option value="外事局">外事局</option>
			<option value="卫生局">卫生局</option>
			<option value="文化广电新闻出版局">文化广电新闻出版局</option>
			<option value="无管办">无管办</option>
			<option value="无委办">无委办</option>
			<option value="物价局">物价局</option>
			<option value="烟草专卖局">烟草专卖局</option>
			<option value="盐务局">盐务局</option>
			<option value="邮政局">邮政局</option>
			<option value="知识产权局">知识产权局</option>
			<option value="质监局">质监局</option>
			<option value="中山电信">中山电信</option>
			<option value="中山广播电视台">中山广播电视台</option>
			<option value="中山市人民防空办公室">中山市人民防空办公室</option>
			<option value="中山海关">中山海关</option>
			<option value="总工会">总工会</option>
      </select>
      <select id="sel_type" name="type" class="select" onmouseover="FixWidth(this)">
            <option value="0" selected="selected">请选择事项类别</option>
			<option value="1">行政许可</option>
			<option value="2">非行政许可</option>
			<option value="3">服务事项</option>
			<option value="4">查询事项</option>
          </select>
      <input id="btn_search" class="service_search_btn" name="service_search_btn" type="button" value="搜索" />
      <script src="/public/index/js/base64.js" type="text/javascript"></script>
      <script>
          $("#btn_search").click(function() {
              var base64 = new Base64();
              var queryStr = $('#sel_type').val() + "@" + $('#ipt_query').val() + "@" + $('#sel_deptName').val();
	          queryStr = base64.encode(queryStr);  
	          queryStr = queryStr.replace(/\+/g, "-");
	          queryStr = queryStr.replace(/\//g, "_");
	          window.open("/index.php/online_services/search/all/" + queryStr,"_blank");
          });
      </script>
      </li>
      <li class="tab_con2">
      <input id="ipt_query_table" class="service_search_box2" name="service_search" type="text" />
      <input id="btn_search_table" class="service_search_btn" name="service_search_btn" type="button" value="搜索" />
      <script>
          $("#btn_search_table").click(function() {
              var base64 = new Base64();
              var queryStr = "@" + $('#ipt_query_table').val() + "@";
	          queryStr = base64.encode(queryStr);  
	          queryStr = queryStr.replace(/\+/g, "-");
	          queryStr = queryStr.replace(/\//g, "_");
	          queryStr = queryStr.replace(/\=/g, "");
	          window.open("/index.php/online_services/search/form/" + queryStr,"_blank");
          });
      </script>
      </li>
      <li class="tab_con2">
      <form method="post" action="http://www.zs.gov.cn/main/services/results/index.action" onsubmit="document.charset='gbk'" target="_blank" id="1363871720">
		<input type="text" name="query" id="" value="" onclick="javascript:if (this.value=='请输入关键字') {this.value='';}" class="service_search_box2">
		<input type="submit" value="查询" class="service_search_btn">
	  </form>
      </li>
    </ul>
  </div>
     <!--service_search end-->
     <div class="download_forms">
    <div class="tit">
         <span><font>表格下载</font>DOWNLOAD FORMS<a target="_blank" href="/index.php/online_services/form">更多&gt;&gt;</a></span>
       </div>
       <div class="con">
         <ul>
          <?php foreach ($row_0 as $row_item): ?>
          <li><font><?php echo $row_item['dept'] ?></font><a target="_blank" href="http://www.zs.gov.cn/ajax/infoFlowDownload.action?id=<?php echo $row_item['id'] ?>" title="<?php echo $row_item['name'] ?>"><?php echo $row_item['name'] ?></a></li>
          <?php endforeach ?>
         </ul>
       </div>
  </div>
     <!--download_forms end-->
<div class="public_service_2">
    <div class="tit">公共服务</div>
    <div class="con">
      <ul>
        <li> <a target="_blank" href="/index.php/online_services/state/23"><img src="/public/index/images/public_service_pic1.png" /><br />教育文化</a></li>
        <li> <a target="_blank" href="/index.php/online_services/state/24"><img src="/public/index/images/public_service_pic2.png" /><br />社保服务</a></li>
        <li> <a target="_blank" href="/index.php/online_services/state/25"><img src="/public/index/images/public_service_pic3.png" /><br />就业服务</a></li>
        <li> <a target="_blank" href="/index.php/online_services/state/26"><img src="/public/index/images/public_service_pic4.png" /><br />招商引资</a></li>
        <li> <a target="_blank" href="/index.php/online_services/state/27"><img src="/public/index/images/public_service_pic5.png" /><br />医疗服务</a></li>
        <li> <a target="_blank" href="/index.php/online_services/state/28"><img src="/public/index/images/public_service_pic6.png" /><br />住房服务</a></li>
        <li> <a target="_blank" href="/index.php/online_services/state/29"><img src="/public/index/images/public_service_pic7.png" /><br />交通出行</a></li>
        <li> <a target="_blank" href="/index.php/online_services/state/30"><img src="/public/index/images/public_service_pic8.png" /><br />企业开办</a></li>
        <li> <a target="_blank" href="/index.php/online_services/state/31"><img src="/public/index/images/public_service_pic9.png" /><br />婚育收养</a></li>
        <li> <a target="_blank" href="/index.php/online_services/state/32"><img src="/public/index/images/public_service_pic10.png" /><br />公共事业</a></li>
        <li> <a target="_blank" href="/index.php/online_services/state/33"><img src="/public/index/images/public_service_pic11.png" /><br />证件办理</a></li>
        <li style="width:93px; border-right:1px solid #ccc;"> <a target="_blank"  href="/index.php/online_services/state/34"><img src="/public/index/images/public_service_pic12.png" /><br />电子地图</a></li>
     </ul>
    </div>
  </div>
  <!--public_service_2 end-->
  <div class="legal_basis">
    <div class="tit">执法依据<a target="_blank" href="/index.php/online_services/legal">更多&gt;&gt;</a></div>
    <div class="con">
      <ul>
        <?php foreach ($row_zfyj as $row_item): ?>
        <li><a target="_blank" href="/index.php/online_services/legal/<?php echo $row_item->cat_id;?>"><?php echo $row_item->name;?></a></li>
        <?php endforeach;?>
      </ul>
    </div>
  </div>
  <!--legal_basis end-->
  <div class="scene_service">
      <div class="tit">场景服务<a target="_blank" href="http://www.zs.gov.cn/main/services/scene1/index.action?dirId=2&subId=23">更多&gt;&gt;</a></div>
      <div class="con">
        <ul>
          <li><a target="_blank" href="http://www.zs.gov.cn/main/services/scene1/index.action?dirId=2&subId=23" class="scene_service_pic_1"><font>养老保险</font></a></li>
          <li><a target="_blank" href="http://www.zs.gov.cn/main/services/scene1/index.action?dirId=2&subId=6" class="scene_service_pic_2"><font>婚育收养</font></a></li>
          <li><a target="_blank" href="http://www.zs.gov.cn/main/services/scene1/index.action?dirId=2&subId=21" class="scene_service_pic_3"><font>出境入境</font></a></li>
          <li><a target="_blank" href="http://www.zs.gov.cn/main/services/scene1/index.action?dirId=2&subId=10" class="scene_service_pic_4"><font>户籍办理</font></a></li>
          <li><a target="_blank" href="http://www.zs.gov.cn/main/services/scene2/index.action?dirId=3&subId=26" class="scene_service_pic_5"><font>设立经营</font></a></li>
          <li><a target="_blank" href="http://www.zs.gov.cn/main/services/scene1/index.action?dirId=2&subId=19" class="scene_service_pic_6"><font>交通出行</font></a></li>
          <li><a target="_blank" href="http://www.gdzs.lss.gov.cn/main/netservice/scene/index.action?did=3701" class="scene_service_pic_7"><font>医疗保险</font></a></li>
          <li><a target="_blank" href="http://www.zsws.gov.cn/main/netservice/scene/index.action?did=16" class="scene_service_pic_8"><font>医疗卫生</font></a></li>
        </ul>
      </div>
    </div>
    <!--scene_service end-->
  <div class="total_search">
      <ul class="tabs6" id="tabs6">
        <img src="/public/index/images/total_search_pic.png" />
        <li><a target="_blank" class="total_search_ico01" href="">公众教育</a></li>
        <li><a target="_blank" class="total_search_ico02" href="">医疗卫生</a></li>
        <li><a target="_blank" class="total_search_ico03" href="">社会保险</a></li>
        <li><a target="_blank" class="total_search_ico04" href="">交通出行</a></li>
        <li><a target="_blank" class="total_search_ico05" href="">公用事业</a></li>
        <li><a target="_blank" class="total_search_ico06" href="">价格收费</a></li>
        <li><a target="_blank" class="total_search_ico07" href="">公积金房产</a></li>
        <li><a target="_blank" class="total_search_ico08" href="">气象水文</a></li>
        <li><a target="_blank" class="total_search_ico09" href="">财税金融</a></li>
        <li><a target="_blank" class="total_search_ico10" href="">公安司法</a></li>
      </ul>
      <ul class="tab_conbox6" id="tab_conbox6">
        <li class="tab_con6">
          <span><a href="http://dt.zsedu.net/" target="_blank" title="中山三维学区查询"><i>&middot;</i>中山三维学区查询</a></span>
          <span><a href="http://yj.zsedu.net/zw05-3.html" target="_blank" title="中山市托儿所一览表"><i>&middot;</i>托儿所一览表</a></span>	
          <span><a href="http://www.zsedu.net/gov/school.html" target="_blank" title="中小学校一览表"><i>&middot;</i>中小学校一览表</a></span>				 
          <span><a href="http://yj.zsedu.net/zw05-2.html" target="_blank" title="中山市幼儿园一览表"><i>&middot;</i>幼儿园一览表</a></span>			 		 
          <span><a href="http://www.zs.gov.cn/UserFiles//File/mbxx.xls" target="_blank" title="中山市民办学校一览表"><i>&middot;</i>民办学校一览表</a></span> 
          <span><a href="http://www.zs.gov.cn/main/services/hotview/index.action?id=105477" target="_blank" title="中山市特殊教育学校一览表"><i>&middot;</i>特殊教育学校一览表</a></span>
          <span><a href="http://www.zs.gov.cn/main/services/hotview/index.action?id=105452" target="_blank" title="中山市中等职业学校一览表"><i>&middot;</i>中等职业学校一览表</a></span>
          <span><a href="http://www.chsi.com.cn/xlcx/" target="_blank" title="高教学历证书查询"><i>&middot;</i>高教学历证书查询</a></span>
          <span><a href="http://score.zsedu.net/students.html" target="_blank" title="高中学生成绩查询"><i>&middot;</i>高中学生成绩查询</a></span>
          <span><a href="http://219.128.51.232/htm/cx.htm" target="_blank" title="教师继续教育号查询"><i>&middot;</i>教师继续教育号查询</a></span>
        </li>
        <li class="tab_con6">
          <span><a href="http://www.zsws.gov.cn/main/netservice/srvorgan/index.action" target="_blank" title="中山市医疗机构"><i>&middot;</i>中山市医疗机构</a></span>
          <span><a href="http://myt.zsemail.com/" target="_blank" title="中山市医疗专家"><i>&middot;</i>中山市医疗专家</a></span>
          <span><a href="http://www.gdzs.si.gov.cn/main/myprofile/index.action?did=1" target="_blank" title="个人医疗帐户查询"><i>&middot;</i>个人医疗帐户查询</a></span>
          <span><a href="http://www.zs.gov.cn/main/services/content/index.action?id=1504" target="_blank" title="计划生育服务机构"><i>&middot;</i>计划生育服务机构</a></span>
          <span><a href="http://app1.sfda.gov.cn/" target="_blank" title="食品药品监督信息"><i>&middot;</i>食品药品监督信息</a></span>
          <span><a href="http://app1.sfda.gov.cn/datasearch/face3/base.jsp?tableId=25&amp;tableName=TABLE25&amp;title=%B9%FA%B2%FA%D2%A9%C6%B7&amp;bcId=118102890099723943731486814455" target="_blank" title="药品信息查询"><i>&middot;</i>药品信息查询</a></span>
          <span><a href="http://app1.sfda.gov.cn/datasearch/face3/base.jsp?tableId=30&amp;tableName=TABLE30&amp;title=%B9%FA%B2%FA%B1%A3%BD%A1%CA%B3%C6%B7&amp;bcId=118103385532690845640177699192" target="_blank" title="保健食品信息查询"><i>&middot;</i>保健食品信息查询</a></span>
          <span><a href="http://www.gdzs.si.gov.cn/main/service/view/index.action?id=1415" target="_blank" title="医保定点药店"><i>&middot;</i>医保定点药店</a></span>
          <span><a href="http://www.gdzs.si.gov.cn/main/service/view/index.action?id=1221" target="_blank" title="医保定点医疗机构"><i>&middot;</i>医保定点医疗机构</a></span>
          <span><a href="http://www.zswjj.gov.cn/UserFiles/img/1302657072781.xls" target="_blank" title="医疗服务价格查询"><i>&middot;</i>医疗服务价格查询</a></span>
          <span><a href="http://app1.sfda.gov.cn/datasearch/face3/base.jsp?tableId=26&amp;tableName=TABLE26&amp;title=%B9%FA%B2%FA%C6%F7%D0%B5&amp;bcId=118103058617027083838706701567" target="_blank" title="医疗器械信息查询"><i>&middot;</i>医疗器械信息查询</a></span>
          <span><a href="http://www.zs.gov.cn/UserFiles//main/upfile/jz.xls" target="_blank" title="中山市接种单位名录"><i>&middot;</i>接种单位名录</a></span>
          <span><a href="http://www.zs.gov.cn/UserFiles/main//file/yd.xls" target="_blank" title="中山市零售、连锁药店"><i>&middot;</i>零售、连锁药店</a></span>
          <span><a href="http://www.zs.gov.cn/UserFiles/main//file/ypsc.xls" target="_blank" title="中山市药品生产企业"><i>&middot;</i>中山市药品生产企业</a></span>
        </li>
        <li class="tab_con6">
          <span><a href="http://www.gdzs.si.gov.cn/main/myprofile/index.action?did=1" target="_blank" title="个人养老帐户查询"><i>&middot;</i>个人养老帐户查询</a></span>
          <span><a href="http://www.gdzs.si.gov.cn/main/myprofile/index.action?did=1" target="_blank" title="个人医疗帐户查询"><i>&middot;</i>个人医疗帐户查询</a></span>
          <span><a href="http://www.gdzs.lss.gov.cn:8011/ggfwweb/" target="_blank" title="工伤个人业务查询"><i>&middot;</i>工伤个人业务查询</a></span>
          <span><a href="http://www.gdzs.si.gov.cn/main/myprofile/index.action?did=1" target="_blank" title="退休养老帐户查询"><i>&middot;</i>退休养老帐户查询</a></span>
          <span><a href="http://www.gdzs.si.gov.cn/main/myprofile/index.action?did=3" target="_blank" title="单位征收数据查询"><i>&middot;</i>单位征收数据查询</a></span>				
          <span><a href="http://www.gdzs.si.gov.cn/main/myprofile/index.action?did=3" target="_blank" title="未平帐数据查询"><i>&middot;</i>未平帐数据查询</a></span>
          <span><a href="http://www.gdzs.si.gov.cn/main/service/view/index.action?id=1415" target="_blank" title="医疗保险定点药店"><i>&middot;</i>医疗保险定点药店</a></span>
          <span><a href="http://www.gdzs.si.gov.cn/main/service/view/index.action?id=1221" target="_blank" title="医疗保险定点医疗机构"><i>&middot;</i>医保定点医疗机构</a></span>
          <span><a href="http://www.gdzs.si.gov.cn/main/service/view/index.action?did=41&amp;id=1499" target="_blank" title="中山市基本医疗保险的药品目录、诊疗项目、医疗服务设施"><i>&middot;</i>基本医疗保险的药品目录、诊疗项目、医疗服务设施</a></span>
          <span><a href="http://www.zsmz.gov.cn/display.php?id=908" target="_blank" title="中山市养老机构名录"><i>&middot;</i>中山市养老机构名录</a></span>	
        </li>
        <li class="tab_con6">
          <span><a href="http://www.0760js.com/wfcx/" target="_blank" title="交通违法查询"><i>&middot;</i>交通违法查询</a></span>
          <span><a href="http://www.12306.cn/mormhweb/kyfw/" target="_blank" title="广珠城轨车次查询"><i>&middot;</i>广珠城轨车次查询</a></span>
          <span><a href="http://211.139.216.188:30380/" target="_blank" title="中山市实时路况"><i>&middot;</i>中山市实时路况</a></span>
          <span><a href="http://www.zsbus.cn" target="_blank" title="中山市公交线路查询"><i>&middot;</i>中山市公交线路查询</a></span>
          <span><a href="http://www.zhongshantong.net/zhongshantong/company.asp?comid=23" target="_blank" title="中山通IC卡办理网点"><i>&middot;</i>中山通IC卡办理网点</a></span>
          <span><a href="http://www.zsbicycle.com/zsbicycle/cx.asp" target="_blank" title="公共自行车借车记录"><i>&middot;</i>公共自行车借车记录</a></span>
          <span><a href="http://www.zsbicycle.com/zsbicycle/map.asp" target="_blank" title="公共自行车站点信息"><i>&middot;</i>公共自行车站点信息</a></span>
          <span><a href="http://www.ctrip.com/supermarket/Flight/SuperFlightSearch.asp" target="_blank" title="飞机航班查询"><i>&middot;</i>飞机航班查询</a></span>			 
          <span><a href="http://wap.zspd.cn/parking/parkingdetail.aspx?sz_corpid=34&amp;sz_businid=34001&amp;ua=Mozilla&amp;token=&amp;userid=&amp;pt=wap" target="_blank" title="车位查询"><i>&middot;</i>车位查询</a></span>
          <span><a href="/main/zwgk/newsview/index.action?id=106863" target="_blank" title="闯红灯自动记录电子警察系统点位清单"><i>&middot;</i>自动记录闯红灯点位</a></span>
          <span><a href="/main/zwgk/newsview/index.action?id=106864" target="_blank" title="已启用电子警察监控系统的单行道路"><i>&middot;</i>电子警察监控单行道</a></span>
          <span><a href="http://www.zsnet.com/fly/" target="_blank" title="中山候机楼汽车班次"><i>&middot;</i>中山候机楼汽车班次</a></span>
          <span><a href="http://www.zhongshanbus.com/query.php" target="_blank" title="市汽车总站汽车班次"><i>&middot;</i>市汽车总站汽车班次</a></span>
          <span><a href="http://www.zspassenger.com.cn/zh-CN/search.html" target="_blank"><i>&middot;</i>中港客运班船表</a></span>
        </li>
        <li class="tab_con6">
          <span><a href="http://www.gdzs.csg.cn/service/business.do?act=input&amp;type=cost" target="_blank" title="电费查询"><i>&middot;</i>电费查询</a></span>
          <span><a href="http://www.gdzs.csg.cn/powercut/list.do" target="_blank" title="停电信息查询"><i>&middot;</i>停电信息查询</a></span>
          <span><a href="http://zhongshan.towngas.com.cn/JV/zs/03custom/index_5.htm" target="_blank" title="港华煤气收费事宜"><i>&middot;</i>港华煤气收费事宜</a></span>
          <span><a href="http://gd.10086.cn/services/BillSearch/index.jsp" target="_blank" title="移动账单查询"><i>&middot;</i>移动账单查询</a></span>
          <span><a href="http://www.10010.com/menuengine/turntodestination.action?menuId=002001" target="_blank" title="联通账单查询"><i>&middot;</i>联通账单查询</a></span>	
          <span><a href="http://info.10010.com/lt/profile/city/sd/file4.jsp?id=&amp;arno=000100040004" target="_blank" title="中山联通营业网点查询"><i>&middot;</i>中山联通营业网点</a></span>							
          <span><a href="http://gd.ct10000.com/service/bill/fyjg.jsp?query_type=BillQry" target="_blank" title="电信账单查询"><i>&middot;</i>电信账单查询</a></span> 
          <span><a href="http://gd.ct10000.com/support/self_h_p2.jsp" target="_blank" title="中山电信营业网点查询"><i>&middot;</i>电信营业网点查询</a></span> 
          <span><a href="http://gd.ct10000.com/support/domesticnum_query.jsp" target="_blank" title="电话区号查询"><i>&middot;</i>电话区号查询</a></span>	
          <span><a href="http://www.shpost.com.cn/customer/customer_bianmachaxun.php" target="_blank" title="邮政编码查询"><i>&middot;</i>邮政编码查询</a></span>
          <span><a href="http://www.zs.gov.cn/main/services/content/index.action?id=1515" target="_blank" title="体育设施名录"><i>&middot;</i>体育设施名录</a></span>
          <span><a href="http://www.zs.gov.cn/main/services/content/index.action?id=1516" target="_blank" title="文化设施名录"><i>&middot;</i>文化设施名录</a></span>
          <span><a href="http://www.wh3351.com/wykx/yzyx.php" target="_blank" title="一周影讯"><i>&middot;</i>一周影讯</a></span>								
          <span><a href="http://www.zsbtv.com.cn/" target="_blank" title="中山广播电视节目时间表"><i>&middot;</i>广播电视节目时间表</a></span>
        </li>
        <li class="tab_con6">
          <span><a href="http://www.zswjj.gov.cn/JumpManage?action=tolist&amp;id=56&amp;pid=2" target="_blank" title="中山市成品油最高销售价格"><i>&middot;</i>成品油价格</a></span>
          <span><a href="http://www.zswjj.gov.cn/JumpManage?action=tolist&amp;id=55&amp;pid=2" target="_blank" title="中山市城区居民用户管道天然气价格"><i>&middot;</i>天然气价格</a></span>
          <span><a href="http://www.zswjj.gov.cn/JumpManage?action=tolist&amp;id=108&amp;pid=2" target="_blank" title="中山市城市生活垃圾处理费"><i>&middot;</i>生活垃圾处理费</a></span>
          <span><a href="http://www.zswjj.gov.cn/JumpManage?action=tolist&amp;id=104&amp;pid=2" target="_blank" title="中山市城镇公共汽车线路票价"><i>&middot;</i>公共汽车票价</a></span>
          <span><a href="http://www.zswjj.gov.cn/JumpManage?action=tolist&amp;id=109&amp;pid=2" target="_blank" title="中山市出租车收费标准"><i>&middot;</i>出租车收费标准</a></span>
          <span><a href="http://www.zswjj.gov.cn/JumpManage?action=tolist&amp;id=57&amp;pid=2" target="_blank" title="中山市电价"><i>&middot;</i>中山市电价</a></span>
          <span><a href="http://www.zswjj.gov.cn/JumpManage?action=tolist&amp;id=51&amp;pid=2" target="_blank" title="中山市机动车停放保管服务收费"><i>&middot;</i>机动车停放保管收费</a></span>
          <span><a href="http://www.zswjj.gov.cn/UserFiles/img/1303805407430.xls" target="_blank" title="中山市客运票价"><i>&middot;</i>中山市客运票价</a></span>
          <span><a href="http://www.zswjj.gov.cn/JumpManage?action=tolist&amp;id=113&amp;pid=2" target="_blank" title="中山市路桥收费"><i>&middot;</i>中山市路桥收费</a></span>
          <span><a href="http://www.zswjj.gov.cn/JumpManage?action=tolist&amp;id=107&amp;pid=2" target="_blank" title="中山市瓶装液化石油气价格"><i>&middot;</i>液化石油气价格</a></span>
          <span><a href="http://www.zswjj.gov.cn/JumpManage?action=tolist&amp;id=58&amp;pid=2" target="_blank" title="中山市污水处理费"><i>&middot;</i>污水处理费</a></span>
          <span><a href="http://www.zswjj.gov.cn/JumpManage?action=tolist&amp;id=50&amp;pid=2" target="_blank" title="中山市物业服务收费"><i>&middot;</i>物业服务收费</a></span>
          <span><a href="http://www.zswjj.gov.cn/JumpManage?action=tolist&amp;id=106&amp;pid=2" target="_blank" title="中山市有线电视收费"><i>&middot;</i>有线电视收费</a></span>
          <span><a href="http://www.zswjj.gov.cn/JumpManage?action=tolist&amp;id=54&amp;pid=2" target="_blank" title="中山市自来水价格"><i>&middot;</i>自来水价格</a></span>			
        </li>
        <li class="tab_con6">
          <span><a href="http://www.zsjs.gov.cn/view_content.asp?uid=4539" target="_blank" title="中山市保障性安居工程项目查询"><i>&middot;</i>保障性安居项目查询</a></span>
          <span><a href="http://www.zsfdc.gov.cn/housefrom.aspx" target="_blank" title="中山市新建商品房房源信息查询"><i>&middot;</i>新建房房源信息查询</a></span>
          <span><a href="http://www.zsfdc.gov.cn/pub_ProjectQuery.aspx" target="_blank" title="中山市新建商品房项目信息查询"><i>&middot;</i>新建房项目信息查询</a></span>
          <span><a href="http://www.zsfdc.gov.cn/dangan/" target="_blank" title="中山市土地房产产权查询"><i>&middot;</i>土地房产产权查询</a></span>
          <span><a href="http://www.zsfdc.gov.cn/zsfdczjnj.aspx" target="_blank" title="中山市房地产中介机构"><i>&middot;</i>房地产中介机构</a></span>
          <span><a href="http://www.zsfdc.gov.cn/Broker.aspx" target="_blank" title="中山市房地产经纪人信息"><i>&middot;</i>房地产经纪人信息</a></span>
          <span><a href="http://www.zswjj.gov.cn/JumpManage?action=tolist&amp;id=110&amp;pid=2" target="_blank" title="房地产中介收费标准"><i>&middot;</i>房地产中介收费标准</a></span>
          <span><a href="http://www.zszfgjj.gov.cn/?con=wsfw&amp;ac=gjjsearch" target="_blank" title="个人公积金查询"><i>&middot;</i>个人公积金查询</a></span>				
          <span><a href="http://www.zszfgjj.gov.cn/?con=wsfw&amp;ac=dkjd" target="_blank" title="公积金贷款进度查询"><i>&middot;</i>公积金贷款进度查询</a></span>
          <span><a href="http://www.zszfgjj.gov.cn/?con=gdy&amp;ac=edjsq" target="_blank" title="公积金贷款额度计算器"><i>&middot;</i>公积金贷款额度计算器</a></span>
          <span><a href="http://www.zszfgjj.gov.cn/?con=gdy&amp;ac=dkjsq" target="_blank" title="公积金贷款计算器"><i>&middot;</i>公积金贷款计算器</a></span>
          <span><a href="http://yuyue.zszfgjj.gov.cn/Modules/PrintJczm/Jczm.aspx" target="_blank" title="公积金缴存证明查询打印"><i>&middot;</i>公积金缴存证明查询打印</a></span>
          <span><a href="http://gjjdk.zszfgjj.gov.cn/Login.aspx?ReturnUrl=%2fdefault.aspx" target="_blank" title="公积金贷款网上办公平台"><i>&middot;</i>公积金贷款网上办公平台</a></span>
          <span><a href="http://yuyue.zszfgjj.gov.cn/Booking/Booking.aspx" target="_blank" title="公积金网上预约平台"><i>&middot;</i>公积金网上预约平台</a></span>
        </li>
        <li class="tab_con6">
          <span><a href="http://www.zsqx.gov.cn/weather/" target="_blank" title="天气预报"><i>&middot;</i>天气预报</a></span>				
          <span><a href="http://aqi.zsepb.gov.cn/" target="_blank" title="空气质量预报"><i>&middot;</i>空气质量预报</a></span>
          <span><a href="http://www.zswater.gov.cn/main/netservice/weather9/" target="_blank" title="台风路径查询"><i>&middot;</i>台风路径查询</a></span>
          <span><a href="http://www.zswater.gov.cn/main/netservice/weather11/" target="_blank" title="天气雷达图"><i>&middot;</i>天气雷达图</a></span>
          <span><a href="http://www.zswater.gov.cn/main/netservice/weather10/index.htm" target="_blank" title="卫星云图"><i>&middot;</i>卫星云图</a></span>		
          <span><a href="http://www.zsepb.gov.cn/" target="_blank" title="饮用水质月报、周报"><i>&middot;</i>饮用水质月报、周报</a></span>						
          <span><a href="http://www.zswater.gov.cn/main/netservice/weather1/index.action" target="_blank" title="实时水情信息查询"><i>&middot;</i>实时水情信息查询</a></span>
          <span><a href="http://www.zswater.gov.cn/main/netservice/weather4/index.action" target="_blank" title="实时雨情信息查询"><i>&middot;</i>实时雨情信息查询</a></span>
          <span><a href="http://www.zswater.gov.cn/main/netservice/weather7/index.action" target="_blank" title="实时咸情信息查询"><i>&middot;</i>实时咸情信息查询</a></span> 
        </li>
        <li class="tab_con6">
          <span><a href="http://app.gd-n-tax.gov.cn/wssw/showReport.do?falcon_falconId=561018AB10D10FF6010D10D1107D0004&amp;falcon_method=method.postRestrict&amp;firstFlag=1&amp;falcon_report_restrict_swjgbm=4420000000" target="_blank" title="企业国税税务登记查询"><i>&middot;</i>国税税务登记查询</a></span>
          <span><a href="http://app.gd-n-tax.gov.cn/wssw/showReport.do?falcon_falconId=561018AB10D0A412010D10D0A5D90010&amp;falcon_method=method.postRestrict&amp;firstFlag=1&amp;falcon_report_restrict_swjgbm=4420000000" target="_blank" title="企业国税申报情况查询"><i>&middot;</i>国税申报情况查询</a></span>
          <span><a href="http://app.gd-n-tax.gov.cn/wssw/jsp/common/query/fpcy.jsp" target="_blank" title="国税发票查验"><i>&middot;</i>国税发票查验</a></span>
          <span><a href="http://app.gd-n-tax.gov.cn/wssw/showReport.do?falcon_falconId=561018AB10D0A412010D10D0A5EC0017&amp;falcon_method=method.postRestrict&amp;firstFlag=1" target="_blank" title="国税发票遗失声明查询"><i>&middot;</i>国税发票遗失声明</a></span>
          <span><a href="http://app.gd-n-tax.gov.cn/wssw/showReport.do?falcon_falconId=C0A800801073A5E701071073A6AE0003&amp;falcon_method=method.postRestrict&amp;firstFlag=1" target="_blank" title="商品退税率查询"><i>&middot;</i>商品退税率查询</a></span>
          <span><a href="http://etax.zstax.gov.cn/bmfw_easyperInq_Login2.jsp" target="_blank" title="纳税户涉税查询"><i>&middot;</i>纳税户涉税查询</a></span>
          <span><a href="http://etax.zstax.gov.cn/bmfw/wsjycx.do?method=showWSYZQueryPage" target="_blank" title="纳税证明验证查询"><i>&middot;</i>纳税证明验证查询</a></span>
          <span><a href="http://etax.zstax.gov.cn/bmfw/easyPersonLogin.do?method=showSwryPage" target="_blank" title="税管员查询"><i>&middot;</i>税管员查询</a></span>
          <span><a href="http://www.gdltax.gov.cn/portal/zs/N6A0TAHTPQVAP6Z04TVY39M11YVIPKBI.htm" target="_blank" title="“南粤金税”发票抽奖查询"><i>&middot;</i>地税发票抽奖</a></span>
          <span><a href="http://etax.zstax.gov.cn/bmfw/easyPersonLogin.do?method=showCCSQueryPage" target="_blank" title="车船完税查询"><i>&middot;</i>车船完税查询</a></span>
          <span><a href="http://www.gdltax.gov.cn/portal/zs/MGH3TLUM4391QZ2PPKZI7PF0Z1ISAEEH.htm" target="_blank" title="地税发票信息查询"><i>&middot;</i>地税发票信息查询</a></span>
          <span><a href="http://etax.zstax.gov.cn/bmfw_easyperInq_Login.jsp" target="_blank" title="个人所得税查询"><i>&middot;</i>个人所得税查询</a></span>
          <span><a href="http://www.zsjs.gov.cn/new/index.asp?FileType=%D5%FE%B8%AE%B9%AB%CE%C4" target="_blank" title="工程建设招标查询"><i>&middot;</i>工程建设招标查询</a></span>
        </li>
        <li class="tab_con6">
          <span><a href="http://www.gdga.gov.cn/sfzbl/queryHzyw.do" target="_blank" title="广东省户政业务审批结果查询"><i>&middot;</i>广东省户政业务审批结果查询</a></span>
          <span><a href="http://www.gdga.gov.cn/sfzbl/search.do" target="_blank" title="广东省居民身份证办理进度查询"><i>&middot;</i>广东省居民身份证办理进度查询</a></span>
          <span><a href="http://jj.gdga.gov.cn/cx/wzss/wzss.do" target="_blank" title="广东省交通违法查询系统"><i>&middot;</i>广东省交通违法查询系统</a></span>
          <span><a href="http://www.0760js.com/wfcx/" target="_blank" title="中山本地交通违法查询"><i>&middot;</i>中山本地交通违法查询</a></span>
          <span><a href="http://jj.gdga.gov.cn/acdfile/searchacdfile.jsp" target="_blank" title="交通事故查询"><i>&middot;</i>交通事故查询</a></span>
          <span><a href="http://jj.gdga.gov.cn/cx/vehicle/vehicle.do" target="_blank" title="车辆核实查询"><i>&middot;</i>车辆核实查询</a></span>
          <span><a href="http://jj.gdga.gov.cn/vehicle/vehiclesearch.jsp" target="_blank" title="驾驶证核实查询"><i>&middot;</i>驾驶证核实查询</a></span>
          <span><a href="http://jj.gdga.gov.cn/drivinglicense/drivinglicensesearch.jsp" target="_blank" title="广东省常住户口居民出入境审批进度查询"><i>&middot;</i>广东省常住户口居民出入境审批进度查询</a></span>
          <span><a href="http://110.gdga.gov.cn/newwebsite/main.jsp?id=4420&amp;adir=&amp;wy=1" target="_blank" title="中山网警业务办理进度查询"><i>&middot;</i>中山网警业务办理进度查询</a></span>
          <span><a href="http://110.gdga.gov.cn/newwebsite/main.jsp?id=4420&amp;adir=&amp;wy=1" target="_blank" title="网站备案审核结果查询"><i>&middot;</i>网站备案审核结果查询</a></span>
          <span><a href="http://wsbs.gdfire.gov.cn/index.aspx?AspxAutoDetectCookieSupport=1#" target="_blank" title="公安消防业务查询"><i>&middot;</i>公安消防业务查询</a></span>
          <span><a href="http://www.zssf.gov.cn/?op=show_news&amp;id=955" target="_blank" title="各镇区法律援助工作站一览表"><i>&middot;</i>各镇区法律援助工作站一览表</a></span>
          <span><a href="http://www.zsnews.cn/zt/zslx/showindex_1785.shtml" target="_blank" title="中山市律师事务所查询"><i>&middot;</i>中山市律师事务所查询</a></span>
          <span><a href="http://www.zswjj.gov.cn/JumpManage?action=tolist&amp;id=111&amp;pid=2" target="_blank" title="律师服务收费标准"><i>&middot;</i>律师服务收费标准</a></span>
        </li>
      </ul>
    </div>
    <!--total_search end--> 
</div>
<!--warper end-->
