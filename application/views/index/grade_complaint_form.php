<div class="box2" style="" >
	 <!--当前位置-->
     <div class="public_nav">

     <p>当前位置：<a href="index.asp" target="_blank" title="点击打开中国中小商业企业协会首页">首页</a>&nbsp;/&nbsp;

		 <span>评级申请</span>
	 
	 </p>
     
	 <!--分享-->
     <div style="MARGIN: 0px; PADDING: 0px; float:right; width:305px;margin-top:-18px;" class="shareBox">
<!-- Baidu Button BEGIN -->
<div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
<span class="bds_more">分享到：</span>
<a class="bds_hi" title="分享到百度空间" href="http://www.zxsx.org/newn.asp?id=#"></a>
<a class="bds_tieba" title="分享到百度贴吧" href="http://www.zxsx.org/newn.asp?id=#"></a>
<a class="bds_sqq" title="分享到QQ好友" href="http://www.zxsx.org/newn.asp?id=#"></a>
<a class="bds_thx" title="分享到和讯微博" href="http://www.zxsx.org/newn.asp?id=#"></a>
<a class="bds_tsina" title="分享到新浪微博" href="http://www.zxsx.org/newn.asp?id=#"></a>
<a class="bds_tqq" title="分享到腾讯微博" href="http://www.zxsx.org/newn.asp?id=#"></a>
<a class="bds_print" title="分享到打印" href="http://www.zxsx.org/newn.asp?id=#"></a>
<a class="bds_copy" title="分享到复制网址" href="http://www.zxsx.org/newn.asp?id=#"></a>
<a class="shareCount" href="http://www.zxsx.org/newn.asp?id=#" title="累计分享0次">0</a>
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
     <div style=" margin-top:20px;height:1015px;" class="public_pt_left">
	 
	 <!--新闻内容-->    
<script type="text/javascript" src="/public/index/js/verification.js"></script>
<link rel="stylesheet" type="text/css" href="/public/index/css/style.css">
<script type="text/javascript">

$(function(){
 
	$.Tipmsg.r=null;
	var showmsg=function(msg){//假定你的信息提示方法为showmsg， 在方法里可以接收参数msg，当然也可以接收到o及cssctl;
		alert(msg);
	}
	$(".registerform").Validform({
	    tiptype:function(msg){
			showmsg(msg);
		},
		tipSweep:true,
		});
})
 

</script>

	<div class="detail"><form action="/index.php/grade/handle" method="post" name="frmlyb" target="_self" id="frmlyb"  class="registerform">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
                    
                        <tbody><tr>
                          <td width="136" align="right" bgcolor="#FFFFFF">单位名称&nbsp;&nbsp;</td>
                          <td colspan="3" bgcolor="#FFFFFF">
                              <input type="text" name="c_name" id="cname" datatype="s1-18" nullmsg="请填入单位名称！" > 
							  <span class="STYLE1">*(注：带*的是必填项)</span>                          </td>
                        </tr>
		 
                        <tr>
                          <td width="136" align="right" bgcolor="#FFFFFF">实际经营地址&nbsp;&nbsp;</td>
                          <td colspan="3" bgcolor="#FFFFFF">
                              <input type="text" name="t_address" id="address" datatype="s1-18" nullmsg="请填入实际经营地址！">
                         <span class="STYLE1">*</span>                     </td>
                        </tr>
                        <tr>
                          <td width="136" align="right" bgcolor="#FFFFFF">注册地址&nbsp;&nbsp;</td>
                          <td colspan="3" bgcolor="#FFFFFF">
                          <input type="text" name="r_address" id="regaddress"  datatype="s1-18" nullmsg="请填入注册地址！"><span class="STYLE1"> *</span>                          </td>
                        </tr>
                        <tr>
                          <td width="136" align="right" bgcolor="#FFFFFF">联 系 人&nbsp;&nbsp;</td>
                          <td width="218" bgcolor="#FFFFFF">
                          <input type="text" name="contacts" id="contact"  datatype="s1-18" nullmsg="请填入联系人！">
                          <span class="STYLE1"> *</span> </td>
                          <td width="112" align="right" bgcolor="#FFFFFF">联系电话&nbsp;&nbsp;</td>
                          <td width="239" bgcolor="#FFFFFF">
                              <input type="text" name="phone" id="phone"  datatype="n7-11" nullmsg="请填入联系电话">
                          <span class="STYLE1"> *</span>                          </td>
                        </tr>
                        <tr>
                          <td width="136" align="right" bgcolor="#FFFFFF">传真&nbsp;&nbsp;</td>
                          <td width="218" bgcolor="#FFFFFF">
                              <input type="text" name="fax" id="fax" datatype="n7-11" nullmsg="请填入传真！">
                          <span class="STYLE1"> *</span>                          </td>
                          <td width="112" align="right" bgcolor="#FFFFFF">手   机&nbsp;&nbsp;</td>
                          <td width="239" bgcolor="#FFFFFF">
                              <input type="text" name="mobile" id="mphone" datatype="m" nullmsg="请填入手机！">
                          <span class="STYLE1"> *</span>                          </td>
                        </tr>
                        <tr>
                          <td width="136" align="right" bgcolor="#FFFFFF">E-mail&nbsp;&nbsp;</td>
                          <td width="218" bgcolor="#FFFFFF">
                              <input type="text" name="email" id="mail" datatype="e" nullmsg="请填入E-mail！">
                          <span class="STYLE1"> *</span>                          </td>
                          <td width="112" align="right" bgcolor="#FFFFFF">网址&nbsp;&nbsp;</td>
                          <td width="239" bgcolor="#FFFFFF">
                              <input type="text" name="webaddress" id="webaddress" datatype="url" nullmsg="请填入网址！">
                          <span class="STYLE1"> *</span>                          </td>
                        </tr>
                        <tr>
                          <td width="136" align="right" bgcolor="#FFFFFF">营业执照注册号&nbsp;&nbsp;</td>
                          <td width="218" bgcolor="#FFFFFF">
                              <input type="text" name="business_licence" id="zhizhao" datatype="n6-16" nullmsg="请填入营业执照注册号！">
                          <span class="STYLE1"> *</span>                          </td>
                          <td width="112" align="right" bgcolor="#FFFFFF">注册资金(万)&nbsp;&nbsp;</td>
                          <td width="239" bgcolor="#FFFFFF">
                              <input name="registered_capital" type="text" id="zhuce" datatype="n1-16" nullmsg="请填入注册资金！">
                          <span class="STYLE1">*</span></td>
                        </tr>
                        <tr>
                          <td width="136" align="right" bgcolor="#FFFFFF">法人代表&nbsp;&nbsp;</td>
                          <td width="218" bgcolor="#FFFFFF">
                              <input type="text" name="legal_person" id="daibiao" datatype="s1-18" nullmsg="请填入法人代表！" >
                          <span class="STYLE1"> *</span>                          </td>
                          <td width="112" align="right" bgcolor="#FFFFFF">工商登记机关&nbsp;&nbsp;</td>
                          <td width="239" bgcolor="#FFFFFF">
                              <input type="text" name="registration_authority" id="gongshang" datatype="s1-18" nullmsg="请填入工商登记机关！" >
                          <span class="STYLE1"> *</span>                          </td>
                        </tr>
                        <tr>
                          <td colspan="4" bgcolor="#FFFFFF"><strong>请  在  下  列  选  项  中  申报</strong></td>
                        </tr>
                        <tr>
                          <td colspan="4" bgcolor="#FFFFFF"> 　信用认证项目</td>
                        </tr>
                        <tr>
                          <td colspan="4" bgcolor="#FFFFFF">　信用等级企业
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input name="trustworthiness_rank[]" type="checkbox" id="dengji1" value="1">
                              
                              A级
                              <input name="trustworthiness_rank[]" type="checkbox" id="dengji2" value="1">
                              
                              AA级
                              <input name="trustworthiness_rank[]" type="checkbox" id="dengji3" value="1">
                          AAA级 </td>
                        </tr>
						
						 <tr>
                          <td colspan="4" bgcolor="#FFFFFF">　文明诚信企业
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input name="civilized_rank[]" type="checkbox" id="wmcx1" value="1">
                              
                              A级
                              <input name="civilized_rank[]" type="checkbox" id="wmcx2" value="1">
                              
                              AA级
                              <input name="civilized_rank[]" type="checkbox" id="wmcx3" value="1">
                          AAA级 </td>
                        </tr>
                        <tr>
                          <td colspan="4" bgcolor="#FFFFFF">　质量、服务诚信单位 
                              
                               <input name="quality_rank[]" type="checkbox" id="chengxin1" value="1">
                              A级
                              <input name="quality_rank[]" type="checkbox" id="chengxin2" value="1">
                              AA级
                              
                              <input name="quality_rank[]" type="checkbox" id="chengxin3" value="1">
                          AAA级</td>
                        </tr>
                        <tr>
                          <td colspan="4" bgcolor="#FFFFFF">　重合同守信用单位
                              &nbsp;
                              
                              <input name="contract_rank[]" type="checkbox" id="hetong1" value="1">
                              A级
                              
                              <input name="contract_rank[]" type="checkbox" id="hetong2" value="1">
                              AA级
                              
                              <input name="contract_rank[]" type="checkbox" id="hetong3" value="1">
                          AAA级</td>
                        </tr>
                        <tr>
                          <td colspan="4" bgcolor="#FFFFFF">　重服务守信用单位
                              &nbsp;
                              
                              <input name="services_rank[]" type="checkbox" id="fuwu1" value="1">
                              A级
                              
                              <input name="services_rank[]" type="checkbox" id="fuwu2" value="1">
                              AA级
                              
                              <input name="services_rank[]" type="checkbox" id="fuwu3" value="1">
                          AAA级</td>
                        </tr>
                        <tr>
                          <td colspan="4" bgcolor="#FFFFFF">　重质量守信用单位
                              &nbsp;
                              
                              <input name="i_quality_rank[]" type="checkbox" id="zhiliang1" value="1">
                              A级
                              
                              <input name="i_quality_rank[]" type="checkbox" id="zhiliang2" value="1">
                              AA级
                              
                              <input name="i_quality_rank[]" type="checkbox" id="zhiliang3" value="1">
                          AAA级</td>
                        </tr>
						<tr>
                          <td colspan="4" bgcolor="#FFFFFF">　行业标志产品认证
                              
                              <input name="trade_mark_rank[]" type="checkbox" id="hybscp1" value="1">
                              
                              A级
                              
                              <input name="trade_mark_rank[]" type="checkbox" id="hybscp2" value="1">
                              AA级
                              
                              <input name="trade_mark_rank[]" type="checkbox" id="hybscp3" value="1">
                          AAA级</td>
                        </tr>
                        <tr>
                          <td colspan="4" bgcolor="#FFFFFF">　行业诚信单位
                              
                              <input name="sincerity_rank[]" type="checkbox" id="hangye1" value="2">
                              
                              A级
                              
                              <input name="sincerity_rank[]" type="checkbox" id="hangye2" value="3">
                              AA级
                              
                              <input name="sincerity_rank[]" type="checkbox" id="hangye3" value="4">
                          AAA级</td>
                        </tr>
                        <tr>
                          <td colspan="4" bgcolor="#FFFFFF">　QE:9000国际信用管理体系认证
                              <input type="checkbox" name="qe" value="1">                          </td>
                        </tr>
                        <tr>
                          <td colspan="4" bgcolor="#FFFFFF">　中国QE品牌认证            
                              <input name="qe_rank[]" type="checkbox" id="QE1" value="1">
                              推广品牌
                              
                              <input name="qe_rank[]" type="checkbox" id="QE2" value="2">
                              知名品牌
                              <input name="qe_rank[]" type="checkbox" id="QE3" value="3">
                              著名品牌
                              <input name="qe_rank[]" type="checkbox" id="QE4" value="4">
                              驰名品牌                          </td>
                        </tr>
                        <tr>
                          <td colspan="4" bgcolor="#FFFFFF">　中国信用品牌认证
                              <input name="china_authentication" type="checkbox" id="xinyong" value="1">                          </td>
                        </tr>
                        <tr>
                          <td colspan="4" bgcolor="#FFFFFF">　诚信经营示范单位
                              
                              <input name="example_rank[]" type="checkbox" id="shifan1" value="1">
                              A级
                              
                              <input name="example_rank[]" type="checkbox" id="shifan2" value="2">
                              AA级
                              
                              <input name="example_rank[]" type="checkbox" id="shifan3" value="3">
                          AAA级 </td>
                        </tr>
                        <tr>
                          <td colspan="4" bgcolor="#FFFFFF">　中国
                              诚信企业家
                              <input type="checkbox" name="type" value="1">
                              诚信经理人
                              <input type="checkbox" name="type" value="2">                          </td>
                        </tr>
                        <tr>
                          <td colspan="4" bgcolor="#FFFFFF">　免费会员
                              <input type="checkbox" name="free" value="1">                          </td>
                        </tr>
                        <tr>
                          <td width="136" bgcolor="#FFFFFF">　申请承诺 </td>
                          <td colspan="3" valign="top" bgcolor="#FFFFFF">
                              <textarea name="desc" cols="60" rows="6">我单位按国家信用政策依据QE:9000信用管理体系标准向信用认证机构申请诚信评定、信用评级、信用认证，所提交的材料都是真实的，对信用评定程序、费用标准及服务内容已知悉并承担要求暂停或撤销信用公告引起的责任。
							  </textarea>                          </td>
                        </tr>
                        <tr>
                          <td height="30" colspan="4" align="center" bgcolor="#FFFFFF" class="top3"><input name="btnSubmit" type="submit" value="提  交">
                            &nbsp;&nbsp;
                            <input name="btnReset" type="button" onclick="javascript:return clearText();" value="重  置">                          </td>
                        </tr>
          </tbody></table>
        </form>	<BR />
		<bR />
		<BR />
	
		<!--内容结束-->
		<div class="cl"></div>
	</div>
	<!--详细信息结束-->
	<div class="cl"></div>







     
	  
     </div>
 <!--[if !IE]>右边<![endif]-->
     <!--[if !IE]>搜索<![endif]-->  
	    
		<!--搜索-->
          <div class="sousuo">

<form name="search" action="searchs.asp" method="post" class="border_radius" style=" margin-left:10px;">

  <table cellspacing="0" cellpadding="0" width="100%" border="0">
    <tbody><tr>
      <td align="right" width="66%" height="28">
  <input type="hidden" checked="" value="Article" name="ModuleName"> 
  <input type="hidden" value="shop" name="ModuleName"> 
  <input type="hidden" value="Soft" name="ModuleName"> 
        <input id="Keyword" onblur="if(this.value==&#39;&#39;)this.value=&#39;点击输入搜索内容&#39;" class="input_txt border_radius" onfocus="if(this.value=&#39;点击输入搜索内容&#39;)this.value=&#39;&#39;" value="点击输入搜索内容" name="name"></td>
      <td width="34%">
  <input id="Submit" style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; background-image:url(/public/index/css/imageszhong/aritcle-list1.jpg);  BORDER-LEFT: 0px; width:56px; height:27px; BORDER-BOTTOM: 0px;" type="submit" value="" name="Submit"> 
         </td>
    </tr>
  </tbody></table>
</form>
  
          </div>
		  
		  <!--右边-->
     <div class="public_pt_right">
     <!--[if !IE]>专业书刊<![endif]-->

<DIV class="bannerBar-right" style=" margin-top:10px; height:250px;">
<DIV class="tit-arrow">
<H3>会长致辞</H3></DIV>
<UL>

  	     	 
  <LI style="text-align:center;"><A href="guanyu.asp" 
  target="_blank">
  
  <img src="/public/index/css/imageszhong/2014-3-281035370.jpg" style="border:0px;" />
  
  </A></LI>
  
  
  <LI style="border:0px;"><A href="guanyu.asp" 
  target="_blank">
	



	
各位朋友：



		大家好！欢迎访问中国中小商业企业协会网站！



		风雨兼程，企聚会兴。作为由国务院国资委主......</A></LI>
  <LI style="border:0px; text-align:right;"><A class=" txt_blue" 
  href="guanyu.asp" target="_blank" style="color: rgb(195, 5, 5);">查看详细</A></LI>
</UL></DIV>


<DIV class="bannerBar-right"  style="  height: 370px; width:218px; margin-top:10px;  margin-bottom:10px; ">

<DIV class="tit-arrow">
<H3>领导机构</H3></DIV>

<DIV class="block marginB10" style="border:0px;">

<ul  class="bloer" > 
				 

<LI style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left 10px  no-repeat; height:17px; padding-top:4px; "><strong>会　长:</strong>　姜 明 </LI>
<LI style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left 10px  no-repeat; height:17px; padding-top:4px; "><strong> 执行会长：</strong>  王 民　 李镇西</LI>
<LI style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left 10px no-repeat; height:34px; padding-top:4px; "><strong>常务副会长:</strong><bR />杨 斐　易中舸　任兴磊　</LI>
<LI style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left 10px no-repeat; height:17px; padding-top:4px; "><strong>副会长:</strong>　姚 勇　何 红</LI>
<LI style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left 10px  no-repeat; height:17px; padding-top:4px; "><strong>秘书长:</strong>　杨 斐(兼) </LI>
<LI style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left 10px no-repeat; height:17px; padding-top:4px; "><strong>会长助理:</strong> 许 湘 （兼）　肖 瑶 　  </LI>
<LI style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left 10px  no-repeat; height:17px; padding-top:4px; "><strong>常务副秘书长:</strong>许 湘　沈亚桂 　 </LI> 
<LI style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left 10px  no-repeat; height:55px; padding-top:4px; "><strong>
副秘书长：</strong><BR />
 汪 燕 杨 猛 葛成新 张仲超 李同政<BR />陶 伟 邹 倩 张永红   
</LI>
<LI style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left 10px  no-repeat; height:17px; padding-top:4px; "><A href="http://www.zxsx.org/guanyu.asp" target="_blank" style=" color:rgb(195, 5, 5);">更多>></A></LI>

   </ul>
     
</DIV>


</DIV>

<style type="text/css">
	 .searchthree{ line-height:22px; height:27px; font-size:10px; }
	 .text33{width:140px; height:14px; border:1px #d1cecb solid;}
.button33{width:42px; height:22px;line-height:16px;background:url(imageszhong/登陆.jpg) no-repeat 0 center;border:none;font-size:12px;color:#606060;}
.button22{width:42px; height:22px;line-height:16px;background:url(imageszhong/注册.jpg) no-repeat 0 center;border:none;font-size:12px;color:#606060;}
.button44{width:42px; height:22px;line-height:16px;background:url(imageszhong/查询.jpg) no-repeat 0 center;border:none;font-size:12px;color:#606060;}
	 </style>
	 	   
<DIV class="bannerBar-right"  style="float:left;  height: 405px;  margin-bottom:10px; margin-left:10px;   ">

<DIV class="tit-arrow">
<H3>联系方式</H3></DIV>
<DIV class="block marginB10" style="border:0px;">

<ul  class="bloer" > 

<li style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left center no-repeat; height:13px; padding-top:3px; " >综合部:  010-68392920</li>			
<li style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left center no-repeat; height:13px; padding-top:3px; " >会员部:  010-82038067</li>
<li style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left center no-repeat; height:13px; padding-top:3px;" >会员发展处：010-82030305</li>
<li style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left center no-repeat; height:13px; padding-top:3px;" >培训部:  010-82036385</li>
<li style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left center no-repeat; height:13px; padding-top:3px;" >地方联络处：010-82030675</li>

<li style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left center no-repeat; height:13px; padding-top:3px; " >园区专委会:  010-010-82030302</li>

<li style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left center no-repeat; height:13px; padding-top:3px; " >创投会:  010-87169330</li>
<li style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left center no-repeat; height:13px; padding-top:3px; " >融资服务办公室:  010-87169380</li>
<li style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left center no-repeat; height:13px; padding-top:3px;" >市场部:010-87169330 </li>
<li style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left center no-repeat; height:13px; padding-top:3px;" >行业发展部:  010-68392420</li>
<li style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left center no-repeat; height:13px; padding-top:3px;" >项目合作部:  010-68583775</li>
<li style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left center no-repeat; height:13px; padding-top:3px;" >信用专委会:010-68392420</li>
<li style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left center no-repeat; height:13px; padding-top:3px;" >企业权益保护办公室：82036756</li>
<li style="padding-left:10px;background:url(imageszhong/arrow-ico.png) left center no-repeat; height:13px; padding-top:3px;" >科技质量部：010-82036381</li>


   </ul>
  
  </DIV>


</DIV>








</div>





</div>







 