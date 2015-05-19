<script src="/public/index/js/flexigrid.js"></script>
<script>
$(document).ready(function(){
	$("#tousuGrid").flexigrid({
		url: '/index.php/ajax/tousu',
		dataType: 'json',
		colModel : [ 
			{display: '来件标题', name : 'fTopic', width : 200, sortable : false, align: 'left'},
			{display: '类别', name : 'fType', width : 70, sortable : false, align: 'center'},
			{display: '反映日期', name : 'fRDate', width : 70, sortable : false, align: 'center'},
			{display: '受理状态', name : 'fState', width : 70, sortable : false, align: 'center'}
		],
		//sortname: "fRDate",
		//sortorder: "desc",
		usepager: true,
		useRp: true,
		rp: 10,
		showTableToggleBtn: true,
		resizable: false,
		width: 477,
		height: 144
	});   
 });
</script>


   <div class="sousuo" style="background-color:#FFFFFF;  padding-left:200px; height:32px;  margin: 0px auto; width: 1000px; padding-bottom:5px; margin-top:0px; padding-top:0px; ">

<div style="color:#666666; padding:0px; float:left;" class="fl"  ><img src="/public/index/css/imageszhong/laba.gif" style="float:left;"  /><p style="float:left; height:27px; padding-top:5px; padding-left:5px; width:85px;"> 及时滚动新闻：</p>
</div>

<div style="float:left; width:650px; padding-top:5px;">


	  <div id="demos_lefts4" style="overflow: hidden; width: 640px; ">
<table>
<tr>
<td id="demo1s_lefts4">
<table style=" width:3200px;" cellpadding="0" cellspacing="0">

 <tr>
          <td valign="top" >
		  	<LI style="height:32px; ">
  <p style="line-height:18px; font-size:12px;" >
  
				<?php if(count($gundong_news) > 0):?>

				<?php foreach($gundong_news as $key=>$row_item):?>
				 <a target="_blank" href="<?php if($row_item->is_redirect){ echo $row_item->redirect_url;} else {?>/index.php/open_goverment/view/article/<?php echo $row_item->aid; }?>"><?php echo htmlspecialchars($row_item->title); ?></a>&nbsp;&nbsp;&nbsp;
				<?php endforeach;?>

				<?php else:?>
				<a href="newn.asp?id=11086" target="_blank">暂无数据</a> &nbsp;&nbsp;&nbsp;
				<?php endif;?>
				
				 
				
				
		
	</p>
  </LI>
			
    </td>
         
        </tr>
</table>
</td>
<td id="demo2s_lefts4">
</td>
</tr>
</table>
</div>

<script type="text/javascript">
		var speed_lefts4=20 //速度数值越大速度越慢
		demo2s_lefts4.innerHTML=demo1s_lefts4.innerHTML
		function Marquee_lefts4(){
		if(demo2s_lefts4.offsetWidth-demos_lefts4.scrollLeft<=0)
		demos_lefts4.scrollLeft-=demo1s_lefts4.offsetWidth
		else{
		demos_lefts4.scrollLeft++
		}
		}
		var MyMars_left4=setInterval(Marquee_lefts4,speed_lefts4)
		demos_lefts4.onmouseover=function() {clearInterval(MyMars_left4)}
		demos_lefts4.onmouseout=function() {MyMars_left4=setInterval(Marquee_lefts4,speed_lefts4)}
</script>

</div>


     <form action="searchsxin.asp" method="post">
    <div class="searchthree fr" style=" padding-top:5px; font-size:12px;">站内搜索：
      <input name="name" type="text" class="text33"/>
      <input type="submit" value="" class="button4"/>
    </div>
	 </form>
	 
	 

	 

</div>
  
<DIV id="containner">


<DIV class="bannerBar clearfix marginB10" >
<DIV class="banner"><!--lunbo-->		 
<DIV class="lunbo_box">
 <div class="news_play">
<div id="hotpic">
			<div id="NewsPic">
	       		<?php foreach($thumbs as $thkey=>$thval):?>
				  <?php if($thkey==0):?>
	         	  <a target="_blank" href=<?php if($thval->is_redirect==1){ echo $thval->redirect_url;}else{ echo'/index.php/open_goverment/view/article/'.$thval->aid; }?> style="visibility: visible; display: block;"> <img width="320px" height="260px" src="<?php echo $thval->thumb; ?>" class="Picture" alt="<?php echo htmlspecialchars($thval->title); ?>" title="<?php echo htmlspecialchars($thval->title); ?>" /></a>
	       		  <?php else:?>  
	         	  <a style="visibility: hidden; display: none;" target="_blank" href=<?php if($thval->is_redirect==1){ echo $thval->redirect_url;}else{ echo'/index.php/open_goverment/view/article/'.$thval->aid; }?>> <img class="Picture" src="<?php echo $thval->thumb; ?>" style="width: 320px; height: 260px;" alt="<?php echo htmlspecialchars($thval->title); ?>" title="<?php echo htmlspecialchars($thval->title); ?>" /></a>
	       		  <?php endif;?>
	       		<?php endforeach;?>     
       
          		<div class="Nav">
          			<?php for($i=1;$i<=count($thumbs);$i++){ ?>
			    	<span <?php if($i==1):?>class="Cur" style="width:55px;"<?php else:?>class="Normal"<?php endif;?>><?php echo $i;?></span>
			    	<?php }?>
				</div>
				<div id="NewsPicTxt" style="width: 370px; overflow: hidden">
					<a target="_blank" href=<?php if($thumbs[0]->is_redirect==1){ echo $thumbs[0]->redirect_url;}else{ echo "/index.php/open_goverment/view/article/".$thumbs[0]->aid;}?>><?php echo $thumbs[0]->title; ?></a>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="/public/index/js/jquery.litenav.js"></script>
		<script type="text/javascript">
        $('#hotpic').liteNav(2000);
      </script>
 </div>
</DIV> 

         </DIV>
		 
<DIV class="bannerBar-zhong" >
   
        <div class="Menubox">
          <span class="Mtitle">信用新闻</span><span  target="_blank" style="float:right"><a href="/index.php/zxsx/dynamic">更多>></a></span>
		 
           
        </div>
		<div style="border-top:1px dashed #cccccc"></div>
        <div class="Contentbox">
       
			<!--热点新闻-->
			
			
			<DIV id="con_one_1" class="foot" >
			
				 
						 <ul class="suul bodys">  		
						 			
							<?php if(count($bf_news) > 0):?>
						
							<?php foreach($bf_news as $key=>$row_item):?>
							 	<li style="width:390px;"><a target="_blank" href="<?php if($row_item->is_redirect){ echo $row_item->redirect_url;} else {?>/index.php/open_goverment/view/article/<?php echo $row_item->aid; }?>"><?php echo htmlspecialchars($row_item->title); ?></a> </li>
							<?php endforeach;?>
							
							<?php else:?>
							<li class="no_data" style="margin-top:100px;">暂无数据</li>
							<?php endif;?>
							
							 
							
                            
							
							</ul>
			
          </DIV>
    
		   <div id="con_one_2" class="foot" style="display:none">
		  <!--通知栏-->
						 
						
						<div style="padding:5px; margin:10px 10px 0px 10px; border:1px dotted #CCCCCC; height:70px;">
			 <h4 class="hover_su bodys"><a href="newnxin.asp?id=946" target="_blank" class="hover_su bodys">中国中小商业企业协会2014年第三批行业</a></h4>
			 <p style="font-size:12px; color:#666666;">
	
	商务部信用工作办公室、国资委行业协会联系办公室：



					中国中小商业企业根据原全国整顿和规......</p> 
			 </div>
						 <ul class="suul bodys">  					
						
							
							<li style="width:390px;"><a href="newnxin.asp?id=945" target="_blank">关于开展2015年中小商业企业信用评价工作的通知</a></li>
							
                            
							
							<li style="width:390px;"><a href="newnxin.asp?id=944" target="_blank">关于取消失信企业信用等级评价级别的通知</a></li>
							
                            
							
							<li style="width:390px;"><a href="newnxin.asp?id=930" target="_blank">公告</a></li>
							
                            
							
							<li style="width:390px;"><a href="newnxin.asp?id=924" target="_blank">商务部 国资委召开2010年行业信用建设工作会</a></li>
							
                            
							
							<li style="width:390px;"><a href="newnxin.asp?id=616" target="_blank">关于开展首批行业信用评价试点工作的通知</a></li>
							
                            
							
							<li style="width:390px;"><a href="newnxin.asp?id=615" target="_blank">务部信用工作办公室、国资委行业协会联系办公室关于行业信用评价工作有关事</a></li>
							
                            
							</ul>
			
          </div>
		  
          <div id="con_one_3" class="foot" style="display:none">
           <!--聚焦中小-->
			
						 
						
						<div style="padding:5px; margin:10px 10px 0px 10px; border:1px dotted #CCCCCC; height:70px;">
			 <h4 class="hover_su bodys"><a href="newnxin.asp?id=993" target="_blank" class="hover_su bodys">信用工作委员会业务范围</a></h4>
			 <p style="font-size:12px; color:#666666;">
	信用工作委员会业务范围：


	根据协会章程，按照中国中小商业企业协会推动的“汇众工程六台一会”——“工作推动平台”即......</p> 
			 </div>
						 <ul class="suul bodys">  					
						
							
							<li style="width:390px;"><a href="newnxin.asp?id=629" target="_blank">中国中小商业企业信用等级评价申报表</a></li>
							
                            
							
							<li style="width:390px;"><a href="newnxin.asp?id=607" target="_blank">关于加强中小企业信用管理工作的若干意见国办发［2000］59号</a></li>
							
                            
							
							<li style="width:390px;"><a href="newnxin.asp?id=606" target="_blank">国务院办公厅关于社会信用体系建设的若干意见国办发[2007]17号</a></li>
							
                            
							
							<li style="width:390px;"><a href="newnxin.asp?id=603" target="_blank">中小企业标准暂行规定</a></li>
							
                            
							
							<li style="width:390px;"><a href="newnxin.asp?id=602" target="_blank">中国中小商业企业协会信用信息管理办法</a></li>
							
                            
							</ul>
			
          </div>
		  
  
	

	
		   
        </div>
     
</DIV>		 
		 
<DIV class="bannerBar-right">
<DIV class="tit-arrow">
<H3>部门介绍</H3></DIV>


<DIV class="block marginB10" style="border:0px;">

<ul  class="bloer" > 
				 


<LI style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left 10px no-repeat; height:16px; padding-top:4px; width:200px; "><strong>负责人：</strong> 王卫东</LI>
<LI style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left 10px no-repeat; height:16px; padding-top:4px; width:200px; "><strong>联系人：</strong> 王卫东、常云丽</LI>
<LI style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left 10px no-repeat; height:16px; padding-top:4px; width:200px; "><strong>信评二部：</strong> </LI>
<LI style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left 10px  no-repeat; height:16px; padding-top:4px; width:200px; "><strong>负责人:</strong> 马战利 </LI>
<LI style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left 10px no-repeat; height:16px; padding-top:4px; width:200px; "> <strong>联系人:</strong> 周  杨</LI>
<LI style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left 10px  no-repeat; height:16px; padding-top:4px; width:200px; "><strong>电 话：</strong> 010-68392420</LI>  
<LI style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left 10px  no-repeat; height:16px; padding-top:4px; width:200px; "><strong>传 真：</strong> 010-68392420 
 </LI>



   </ul>
     
</DIV>


   </DIV>

  </DIV>
  
<DIV class="recBar clearfix marginB10" style=" height:655px;">


<div style="float:left; width:740px; height:650px; ">



<DIV class="recBar-right" style="width:365px; margin-right:10px; height:290px; ">

        <div class="menu">
          <ul>
            <li id="two1" onMouseOver="setTab('two',1,2)" class="hover">文件下载</li>
			<li id="two2" onMouseOver="setTab('two',2,2)" >企业公示</li>
          </ul>
        </div>
		
<DIV class="block" style="height:260px; ">

<DIV id="con_two_1" class="block" style=" border:0px;" >
   
						
						
<DIV class="top clearfix" style="padding:10px; height:80px;">
<DIV class="left" style="float:left; width:110px;"><A href="newnxin.asp?id=1004" target="_blank"><IMG 
width="107" height="70" class="pic1" src="uploadimg/2015-2-21618360.jpg" 
border="0"></A></DIV>

<DIV class="right" style="float:right; width:220px; ">
<H2 class="yahei font_14"><A class="txt_blue" href="newnxin.asp?id=1004" 
target="_blank">AAA证书展示</A></H2>
<P><A class="txt_grey" href="newnxin.asp?id=1004" 
target="_blank">......</A></P></DIV></DIV>	


<DIV class="foot">
                         <UL>
						
							<?php if(count($file_news) > 0):?>
						 
							<?php foreach($file_news as $key=>$row_item):?>
							<LI><DIV class="left"><a target="_blank" href="<?php if($row_item->is_redirect){ echo $row_item->redirect_url;} else {?>/index.php/open_goverment/view/article/<?php echo $row_item->aid; }?>"><?php echo htmlspecialchars($row_item->title); ?></a> </DIV></LI>
							<?php endforeach;?>
							 
							<?php else:?>
							<li>暂无数据</li>
							<?php endif;?>
						 
						  </UL>					  
						  
  </DIV>



</DIV>

<DIV id="con_two_2" class="block" style=" display:none; border:0px;" >

<!--fyfw-->

<DIV class="foot">
	<UL>                 
		<?php if(count($company_news) > 0):?>

		<?php foreach($company_news as $key=>$row_item):?>
		<LI><DIV class="left"><a target="_blank" href="<?php if($row_item->is_redirect){ echo $row_item->redirect_url;} else {?>/index.php/open_goverment/view/article/<?php echo $row_item->aid; }?>"><?php echo htmlspecialchars($row_item->title); ?></a> </DIV></LI>
		<?php endforeach;?>

		<?php else:?>
		<li>暂无数据</li>
		<?php endif;?>
	</UL>					  
</DIV>



</DIV>


</DIV>

</DIV>

<DIV class="recBar-right" style="width:365px; height:290px; margin:0px;">

        <div class="menu">
          <ul>
           
            <li id="fff1" onMouseOver="setTab('fff',1,2)" class="hover">A级企业展示</li>
            <li id="fff2" onMouseOver="setTab('fff',2,2)" >AA级企业展示</li>
		
          </ul>
        </div>

<DIV class="block" style="height:260px;">
  
<DIV id="con_fff_1" class="block" style=" border:0px;" >

 
						
						
<DIV class="top clearfix" style="padding:10px; height:80px;">
<DIV class="left" style="float:left; width:110px;"><A href="newnxin.asp?id=929" target="_blank"><IMG 
width="107" height="70" class="pic1" src="uploadimg/2015-2-21629410.jpg" 
border="0"></A></DIV>

<DIV class="right" style="float:right; width:220px; ">
<H2 class="yahei font_14"><A class="txt_blue" href="newnxin.asp?id=929" 
target="_blank">徐州市金慧汽车销售服务有限公司</A></H2>
<P><A class="txt_grey" href="newnxin.asp?id=929" 
target="_blank">
	徐州市金慧汽车销售服务有限公司信用状况优良评为AAA级企业



	证书编号：2011......</A></P></DIV></DIV>	


<DIV class="foot">
   	<UL>                 
		<?php if(count($Acompany_news) > 0):?>

		<?php foreach($Acompany_news as $key=>$row_item):?>
		<LI><DIV class="left"><a target="_blank" href="<?php if($row_item->is_redirect){ echo $row_item->redirect_url;} else {?>/index.php/open_goverment/view/article/<?php echo $row_item->aid; }?>"><?php echo htmlspecialchars($row_item->title); ?></a> </DIV></LI>
		<?php endforeach;?>

		<?php else:?>
		<li>暂无数据</li>
		<?php endif;?>
	</UL>					  					  
			  
  </DIV>
						 

</DIV>

<DIV id="con_fff_2" class="block" style="display:none; border:0px;" >


                         
						
						
<DIV class="top clearfix" style="padding:10px; height:80px;">
<DIV class="left" style="float:left; width:110px;"><A href="newnxin.asp?id=1057" target="_blank"><IMG 
width="107" height="70" class="pic1" src="" 
border="0"></A></DIV>

<DIV class="right" style="float:right; width:220px; ">
<H2 class="yahei font_14"><A class="txt_blue" href="newnxin.asp?id=1057" 
target="_blank">新疆嘉利可电力安装工程有限公司</A></H2>
<P><A class="txt_grey" href="newnxin.asp?id=1057" 
target="_blank">
	企业名称：新疆嘉利可电力安装工程有限公司


	信用等级：AA


	信用编号：201503401100012
......</A></P></DIV></DIV>	


<DIV class="foot">
   	<UL>                 
		<?php if(count($AAcompany_news) > 0):?>

		<?php foreach($AAcompany_news as $key=>$row_item):?>
		<LI><DIV class="left"><a target="_blank" href="<?php if($row_item->is_redirect){ echo $row_item->redirect_url;} else {?>/index.php/open_goverment/view/article/<?php echo $row_item->aid; }?>"><?php echo htmlspecialchars($row_item->title); ?></a> </DIV></LI>
		<?php endforeach;?>

		<?php else:?>
		<li>暂无数据</li>
		<?php endif;?>
	</UL>					  				  
			  
  </DIV>


</DIV>



</DIV>

</DIV>

 
  <style type="text/css">
 
#scrollDiv2{width:738px;height:80px;min-height:25px;line-height:25px;border:#ccc 1px solid;overflow:hidden}
#scrollDiv2 li{height:80px;}
</style>
<div id="scrollDiv2">
  <ul>
    <li><img src="/public/index/css/imageszhong/huodong.jpg"></li>
  
  </ul>
</div>
 

<DIV class="recBar-right" style="width:365px; margin-right:10px; height:270px; margin-top:6px; ">

        <div class="menu">
          <ul>
            <li id="far1" onMouseOver="setTab('far',1,2)" >AAA级企业展示</li>
			<li id="far2" onMouseOver="setTab('far',2,2)" class="hover" >地区合作</li>
          </ul>
        </div>
		
<DIV class="block" style="height:240px; ">

<DIV id="con_far_1" class="block" style=" display:none; border:0px;" >


<DIV class="foot">
 
   	<UL>                 
		<?php if(count($AAAcompany_news) > 0):?>

		<?php foreach($AAAcompany_news as $key=>$row_item):?>
		<LI><DIV class="left"><a target="_blank" href="<?php if($row_item->is_redirect){ echo $row_item->redirect_url;} else {?>/index.php/open_goverment/view/article/<?php echo $row_item->aid; }?>"><?php echo htmlspecialchars($row_item->title); ?></a> </DIV></LI>
		<?php endforeach;?>

		<?php else:?>
		<li>暂无数据</li>
		<?php endif;?>
	</UL>						  
						  
  </DIV>


<!--												

-->


</DIV>

<DIV id="con_far_2" class="block" style=" border:0px;" >


						


<DIV class="foot">
  	<UL>                 
		<?php if(count($area_news) > 0):?>

		<?php foreach($area_news as $key=>$row_item):?>
		<LI><DIV class="left"><a target="_blank" href="<?php if($row_item->is_redirect){ echo $row_item->redirect_url;} else {?>/index.php/open_goverment/view/article/<?php echo $row_item->aid; }?>"><?php echo htmlspecialchars($row_item->title); ?></a> </DIV></LI>
		<?php endforeach;?>

		<?php else:?>
		<li>暂无数据</li>
		<?php endif;?>
	</UL>					  
						  
  </DIV>



</DIV>

</DIV>

</DIV>

<DIV class="recBar-right" style="width:365px; height:270px; margin-top:6px;">

        <div class="menu">
          <ul>
           
            <li id="rights1" onMouseOver="setTab('rights',1,2)">成功案例</li>
            <li id="rights2" onMouseOver="setTab('rights',2,2)" class="hover">行业研究</li>
		
          </ul>
        </div>

<DIV class="block" style="height:240px;">
  
<DIV id="con_rights_1" class="block" style="display:none; border:0px;" >

						 
						 

						
						



<DIV class="foot">
                      	<UL>                 
		<?php if(count($success_news) > 0):?>

		<?php foreach($success_news as $key=>$row_item):?>
		<LI><DIV class="left"><a target="_blank" href="<?php if($row_item->is_redirect){ echo $row_item->redirect_url;} else {?>/index.php/open_goverment/view/article/<?php echo $row_item->aid; }?>"><?php echo htmlspecialchars($row_item->title); ?></a> </DIV></LI>
		<?php endforeach;?>

		<?php else:?>
		<li>暂无数据</li>
		<?php endif;?>
	</UL>						  
			  
  </DIV>
						 

</DIV>

<DIV id="con_rights_2" class="block" style=" border:0px;" >


 
						
						
<DIV class="top clearfix" style="padding:10px; height:80px;">
<DIV class="left" style="float:left; width:110px;"><A href="newnxin.asp?id=1002" target="_blank"><IMG 
width="107" height="70" class="pic1" src="" 
border="0"></A></DIV>

<DIV class="right" style="float:right; width:220px; ">
<H2 class="yahei font_14"><A class="txt_blue" href="newnxin.asp?id=1002" 
target="_blank">多家央企上榜建筑质量黑名单 专家称应加大</A></H2>
<P><A class="txt_grey" href="newnxin.asp?id=1002" 
target="_blank">
	自住建部开展“工程质量治理两年行动”4个月来，已有30家建筑企业陆续上榜建筑质量违法......</A></P></DIV></DIV>	


<DIV class="foot">
  	<UL>                 
		<?php if(count($profession_news) > 0):?>

		<?php foreach($profession_news as $key=>$row_item):?>
		<LI><DIV class="left"><a target="_blank" href="<?php if($row_item->is_redirect){ echo $row_item->redirect_url;} else {?>/index.php/open_goverment/view/article/<?php echo $row_item->aid; }?>"><?php echo htmlspecialchars($row_item->title); ?></a> </DIV></LI>
		<?php endforeach;?>

		<?php else:?>
		<li>暂无数据</li>
		<?php endif;?>
	</UL>					  
			  
  </DIV>


</DIV>


</DIV>

</DIV>



</div>




<div style="float:right; height:650px; width:248px; ">

<DIV class="bannerBar-right" style="height:73px; padding:0px; width:248px; clear:both; margin-bottom:10px;">
<a href="/index.php/grade/complaint_form" target="_blank"> <img src="/public/index/css/imageszhong/shenqing.jpg" border="0" /></a>
</DIV>




<DIV class="company_show">

<DIV class="tit-arrow">
<H3>企业展示</H3></DIV>

<DIV class="block marginB10" style="border:0px;overflow:hidden;height: 300px;" id="company_con">
<div id="company_con1">
<ul>
		<?php if(count($Acompany_news) > 0):?>

		<?php foreach($Acompany_news as $key=>$row_item):?>
		<LI ><DIV class="left"><a target="_blank" href="<?php if($row_item->is_redirect){ echo $row_item->redirect_url;} else {?>/index.php/open_goverment/view/article/<?php echo $row_item->aid; }?>">·&nbsp;<?php echo htmlspecialchars($row_item->title); ?></a> </DIV></LI>
		<?php endforeach;?>

		<?php else:?>
		<li>暂无数据</li>
		<?php endif;?>
		<?php if(count($AAAcompany_news) > 0):?>

		<?php foreach($AAAcompany_news as $key=>$row_item):?>
		<LI><DIV class="left"><a target="_blank" href="<?php if($row_item->is_redirect){ echo $row_item->redirect_url;} else {?>/index.php/open_goverment/view/article/<?php echo $row_item->aid; }?>">·&nbsp;<?php echo htmlspecialchars($row_item->title); ?></a> </DIV></LI>
		<?php endforeach;?>

		<?php else:?>
		<li>暂无数据</li>
		<?php endif;?>
</ul>
</div>
<div id="company_con2" style="height: 300px;"></div>
 

    
     
</DIV>

<script>
 
var speed=40; //数字越大速度越慢
var tab=document.getElementById("company_con");
var tab1=document.getElementById("company_con1");
var tab2=document.getElementById("company_con2");
tab2.innerHTML=tab1.innerHTML; //克隆demo1为demo2
function Marquee(){
 
if(tab2.offsetTop-tab.scrollTop<=633)//当滚动至demo1与demo2交界时 离头部高度tab2.offsetTop
tab.scrollTop-=tab1.offsetHeight //demo跳到最顶端
else{
tab.scrollTop++
}
}
var MyMar=setInterval(Marquee,speed);
tab.onmouseover=function() {clearInterval(MyMar)};//鼠标移上时清除定时器达到滚动停止的目的
tab.onmouseout=function() {MyMar=setInterval(Marquee,speed)};//鼠标移开时重设定时器
 
</script>
</DIV>



<!--
<DIV class="bannerBar-right" style="height:73px; padding:0px; width:248px; clear:both; margin-bottom:10px;  ">

<IMG 
width="248" height="73" title="" alt="" src="imageszhong/shangxueyuan.jpg"  style="border:0px;">

</DIV>
-->

<A href="zhuanjia.asp" target="_blank"><img  title="" alt="" src="/public/index/ss/imageszhong/imageszhong/智库.jpg"   style="border:0px;" /></A>




</div>


  </DIV>
  <style type="text/css">
 
#scrollDiv{width:1000px;height:80px;min-height:25px;line-height:25px;border:#ccc 1px solid;overflow:hidden}
#scrollDiv li{height:80px;}
</style>
<div id="scrollDiv">
  <ul>
    <li><img src="/public/index/css/imageszhong/huodong.jpg"></li>
    <li><img src="/public/index/css/imageszhong/huodong.jpg"></li>
    <li><img src="/public/index/css/imageszhong/huodong.jpg"></li>
    <li><img src="/public/index/css/imageszhong/huodong.jpg"></li>
    <li><img src="/public/index/css/imageszhong/huodong.jpg"></li>
    <li><img src="/public/index/css/imageszhong/huodong.jpg"></li>
    <li><img src="/public/index/css/imageszhong/huodong.jpg"></li>
    <li><img src="/public/index/css/imageszhong/huodong.jpg"></li>
    <li><img src="/public/index/css/imageszhong/huodong.jpg"></li>
  </ul>
</div>
<script type="text/javascript">
//滚动插件
$(document).ready(function(){
        $("#scrollDiv").Scroll({line:1,speed:5000,timer:1000});
		 
});
</script>

<!--插入-->






<script>
var isIe=(document.all)?true:false;
//设置select的可见状态
function setSelectState(state)
{
var objl=document.getElementsByTagName('select');
for(var i=0;i<objl.length;i++)
{
objl[i].style.visibility=state;
}
}
function mousePosition(ev)
{
if(ev.pageX || ev.pageY)
{
return {x:ev.pageX, y:ev.pageY};
}
return {
x:ev.clientX + document.body.scrollLeft - document.body.clientLeft,y:ev.clientY + document.body.scrollTop - document.body.clientTop
};
}
//弹出方法
function showMessageBox(wTitle,content,pos,wWidth)
{
closeWindow();
var bWidth=parseInt(document.documentElement.scrollWidth);
var bHeight=parseInt(document.documentElement.scrollHeight);
if(isIe){
setSelectState('hidden');}
var back=document.createElement("div");
back.id="back";
var styleStr="top:0px;left:0px;position:absolute;background:#666;width:"+bWidth+"px;height:"+bHeight+"px;";
styleStr+=(isIe)?"filter:alpha(opacity=0);":"opacity:0;";
back.style.cssText=styleStr;
document.body.appendChild(back);
showBackground(back,50);
var mesW=document.createElement("div");
mesW.id="mesWindow";
mesW.className="mesWindow";
mesW.innerHTML="<div class='mesWindowTop'><table width='100%' height='100%'><tr><td style='font-size:12px; color:#899bc8'>"+wTitle+"</td><td style='width:1px;'><input type='button' onclick='closeWindow();' title='关闭窗口'  class='close' value='关闭' /></td></tr></table></div><div class='mesWindowContent' id='mesWindowContent'>"+content+"</div><div class='mesWindowBottom'></div>";
styleStr="left:"+(((pos.x-wWidth)>0)?(pos.x-wWidth):pos.x)+"px;top:"+(pos.y)+"px;position:absolute;width:"+wWidth+"px;";
//styleStr="left:30px;top:"+(pos.y)+"px;position:absolute;width:"+wWidth+"px;";
mesW.style.cssText=styleStr;
document.body.appendChild(mesW);
}
//让背景渐渐变暗
function showBackground(obj,endInt)
{
if(isIe)
{
obj.filters.alpha.opacity+=1;
if(obj.filters.alpha.opacity<endInt)
{
setTimeout(function(){showBackground(obj,endInt)},5);
}
}else{
var al=parseFloat(obj.style.opacity);al+=0.01;
obj.style.opacity=al;
if(al<(endInt/100))
{setTimeout(function(){showBackground(obj,endInt)},5);}
}
}
//关闭窗口
function closeWindow()
{
if(document.getElementById('back')!=null)
{
document.getElementById('back').parentNode.removeChild(document.getElementById('back'));
}
if(document.getElementById('mesWindow')!=null)
{
document.getElementById('mesWindow').parentNode.removeChild(document.getElementById('mesWindow'));
}
if(isIe){
setSelectState('');}
}
//测试弹出

</script>
 
<script type="text/javascript" language="javascript">
	  function diss()
	  {
	    var objPos = mousePosition(event);
		

	     $.post("huiyuan.aspx",{Action:"post",userID:$("#far_certt").val()}
                ,function(aa,textStatus){
                   alert(aa.qq);
				//var hh=aa.qq;   	
				//messContent="<div style='padding:20px 20px 20px 20px;text-align:left;'>"+hh+"</div>";		 
//showMessageBox('中国中小商业企业协会会员证查询',messContent,objPos,350);
                 //  sAlert(aa.qq);
                },"json" );
				
	  }
</script>

<!--
<bR />

</DIV>  -->
  

<DIV class="clientBar clearfix marginB10" >
<DIV class="clientBar-left1" style="float:left; width:1000px;" >
<DIV class="menu" style="background-image:url(/public/index/css/imageszhong/友情链接.jpg); height:34px;">
<!--<A href="" target="_blank">查看更多</A>-->
<H3></H3></DIV>
<DIV class="block" >
<UL class="clearfix">
 
		<?php foreach ($link as $key=>$row_item):?>
		<?php if($key==0):?>
		<li><a target="_blank" href="<?php echo $row_item->url;?>">
		<img idth="105" height="45" src="<?php echo $row_item->logo;?>" />
		</a></li>
		<?php else:?>
		<li><a target="_blank" href="<?php echo $row_item->url;?>">
		<img src="<?php echo $row_item->logo;?>" />
		</a></li>
		<?php endif; ?>
		<?php endforeach;?>
 </UL></DIV></DIV>
</DIV>  
  
  
  <!--
<DIV class="aboutBar clearfix">
<DIV class="left">
<H3 class="txt_red">国培发展</H3>
<DIV>国培机构以商学培训、国培资讯为平台，以国培咨询和国培投资为助力，为客户提供包括咨询、资讯、资本和人才的组合服务。累积服务全国各地企事业单位两万多家，从业人员近十万人。</DIV></DIV>
<DIV class="mid">
<H3 class="txt_green">国培核心业务</H3>
<DIV>国培机构目前涉及小额信贷、担保、典当、高级财务、互联网金融等领域的商学培训、企业咨询、信息资讯、商业投资。 </DIV></DIV>
<DIV class="right">
<H3 class="txt_blue">联系我们</H3>
<DIV>业务咨询：400-650-8932<BR>公司总机：010-82103216<BR>邮 箱：info@guopeijigou.com<BR>地 
址：北京市海淀区北三环西路甲18号大钟寺中坤国际广场E座10005室             </DIV></DIV></DIV>

-->

</DIV>
<script type="text/javascript">
//滚动插件
(function($){
	    
$.fn.extend({
        Scroll:function(opt,callback){
                //参数初始化
                if(!opt) var opt={};
                var _this=this.eq(0).find("ul:first");
                var        lineH=_this.find("li:first").height(), //获取行高
                        line=opt.line?parseInt(opt.line,10):parseInt(this.height()/lineH,10), //每次滚动的行数，默认为一屏，即父容器高度
                        speed=opt.speed?parseInt(opt.speed,10):500, //卷动速度，数值越大，速度越慢（毫秒）
                        timer=opt.timer?parseInt(opt.timer,10):3000; //滚动的时间间隔（毫秒）
                if(line==0) line=1;
                var upHeight=0-line*lineH;
                //滚动函数
                scrollUp=function(){
                        _this.animate({
                                marginTop:upHeight
                        },speed,function(){
                                for(i=1;i<=line;i++){
                                        _this.find("li:first").appendTo(_this);
                                }
                                _this.css({marginTop:0});
                        });
                }
                //鼠标事件绑定
                _this.hover(function(){
                        clearInterval(timerID);
                },function(){
                        timerID=setInterval("scrollUp()",timer);
                }).mouseout();
        }        
})
})(jQuery);

 
</script>
<script type="text/javascript">
function setTab(name,cursel,n){
for(i=1;i<=n;i++){
var menu=document.getElementById(name+i);
var con=document.getElementById("con_"+name+"_"+i);
menu.className=i==cursel?"hover":"";
con.style.display=i==cursel?"block":"none";
}
}
</script>
</div>
<!--warper end-->

