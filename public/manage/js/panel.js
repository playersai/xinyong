function setVar(){
    topBox = $('#top');//顶部容器
    leftBox = $('#left');//左边容器
    rightBox = $('#right');//右边容器
    tabBox = $('#tab');//标签容器
    contentBox = $('#content');//内容容器
    topOuterHeight = topBox.outerHeight();//顶部容器高度（包括padding和border）
    leftWidth = leftBox.width();//左边容器宽度
    leftOuter = leftBox.outerWidth()-leftWidth;//左边padding和border
    //tabHeight = tabBox.outerHeight();//标签容器高度
    var tab = tabBox.find('span').eq(0);
    eachTabWidth = tab.width();//单个标签宽度
    eachTabOuterWidth = tab.outerWidth();//单个标签宽度（包括padding和border）
    firstTabMargin = parseInt( tab.css('margin-left') );//第一个标签距左边距离
    iframePaddingTop = parseInt( rightBox.find('iframe').eq(0).css('padding-top') );//iframe留间隔
}
function initSize(){
    winHeight = $(window).height();//窗口高度
    winWidth = $(window).width();//窗口宽度
    leftBox.height(winHeight-topOuterHeight);
    leftBox.find('.left_top').height(winHeight-topOuterHeight);
    leftBox.find('.left_bottom').height(winHeight-topOuterHeight);
    rightBox.width(winWidth-leftWidth-leftOuter);
    rightBox.height(winHeight-topOuterHeight);
    rightBox.find('iframe').width(winWidth-leftWidth-leftOuter);
    rightBox.find('iframe').height(winHeight-topOuterHeight-iframePaddingTop);
    $('#skinFlashBox img').height(winHeight);
}
function initTabLinks(){
    $('a[target="_tab"]').click(function(){
        var id = $(this).attr('rel');
        var url = $(this).attr('href');
        var text = $(this).attr('title') || $(this).text();
        rightBox.find('iframe').hide();
        tabBox.find('span').attr('class','off');
        if($('#tab_'+id)[0]){
            $('#tab_'+id).attr('class','on');
            $('#content_'+id).attr('src',url).show();
        }else{
            tabBox.append('<span id="tab_'+id+'" class="on" onclick="changeTab(\''+id+'\');">'+text+'<a href="javascript:closeTab(\''+id+'\');">x</a></span>');
            contentBox.append('<iframe id="content_'+id+'" frameborder="0" allowtransparency="true" src="'+url+'"></iframe>');
            initSize();
            resizeTab();
        }
        return false;
    });
}
function initDialogLinks(){
    $('a[target="_dialog"]').click(function(){
        art.dialog.open($(this).attr('href'),{
            id : $(this).attr('rel'),
            fixed : true,
            title : $(this).attr('title'),
            width : $(this).attr('width')+'px',
            height : $(this).attr('height')+'px'
        });
        return false;
    });
}
function initMenu(){
    var tt;
    leftBox.find('.menu').find('li.main').hover(
    function(){
        obj=$(this).children('ul');
        tt=setTimeout(function(){
            leftBox.find('.menu').find('ul.sub').hide();
            obj.show();
         },300);
      },
      function(){
          clearTimeout(tt);
     });
     leftBox.find('.menu').find('ul.sub').eq(0).slideDown('slow');
}
function closeTab(id){
    $('#tab_'+id).remove();
    $('#content_'+id).remove();
    rightBox.find('iframe:last').show();
    tabBox.find('span:last').attr('class','on');
    resizeTab();
}
function changeTab(id){
    rightBox.find('iframe').hide();
    tabBox.find('span').attr('class','off');
    $('#tab_'+id).attr('class','on');
    $('#content_'+id).show();
}
function resizeTab(){
    var tabTotal = tabBox.find('span').size();
    var w = (tabBox.width()-firstTabMargin-20) / tabTotal;//留出20px避免误差或设置标签间隔
    if( w < eachTabOuterWidth ){
        var padding = eachTabOuterWidth - eachTabWidth;
        tabBox.find('span').width( w - padding );
    }else{
        tabBox.find('span').width( eachTabWidth );
    }
}
function tabHover(){//要用live方法，因为标签都是动态添加的
    tabBox.find('span').live('mouseover',function(){
        if( $(this).hasClass('off') ) $(this).addClass('hover');
    });
    tabBox.find('span').live('mouseout',function(){
        $(this).removeClass('hover');
    });
}
function sideBarSwitch(obj){
    if(typeof(leftWidthOrg)=='undefined') leftWidthOrg = leftWidth;
    if(leftWidth==0){
        $(obj).html('<i class="ico icon-arrow-left"></i>隐藏左栏菜单</a>');
        leftWidth = leftWidthOrg;
        initSize();
        leftBox.width(leftWidth);
    }else{
        $(obj).html('<i class="ico icon-arrow-right"></i>展开左栏菜单</a>');
        leftWidth = 0;
        initSize();
        leftBox.width(leftWidth);
    }
}
function setSkin(skin){
    $('#skinFlashBox').remove();//切换皮肤需移除先前加载的动态皮肤
    skinImgNum = 0;//动态皮肤图片数归0，以便切换
    if(typeof(flashSkinHandler)!='undefined') clearInterval(flashSkinHandler);
    loadSkin(skin);
    setCookie('uadminSkin',skin,86400000,'/');
}
function setDialogSkin(skin){
    loadDialogSkin(skin);
    setCookie('uadminDialogSkin',skin,86400000,'/');
    art.dialog({
        id: 'dialogTest',
        title: '窗口风格演示',
        time: 5,
        icon: 'succeed',
        content: '<b>窗口皮肤设置成功！</b><br /><br />请问我漂亮吗？我5秒后自动消失！',
        button: [
            {
                name: '漂亮',
                focus: true
            },
            {
                name: '不漂亮',
                disabled: true
            }]
    });
}
function loadDialogSkin(){
    var skin = arguments[0] ? arguments[0] : getCookie('uadminDialogSkin');
    if(skin == null) skin = 'blue';
    var skinObj = $('head #artDialogCss');
    skinObj.attr('href',skinObj.attr('path')+skin+'.css');
}
function loadSkin(){
    var skin = arguments[0] ? arguments[0] : getCookie('uadminSkin');
    if(skin == null) skin = 'metro';
    if(skin.substr(0,6) == 'flash_'){//以这个开头的为动态皮肤
        skin = skin.substr(6);
        $('body').prepend('<div id="skinFlashBox"><div id="flash_'+skin+'"></div></div>');
        initFlashSkin(skin);
    }
    var skinObj = $('head #skinCss');
    skinObj.attr('href',skinObj.attr('path')+skin+'.css');
    skinObj.load(function(){
        fixLogoPNG();//for IE6
    });
}
function initFlashSkin(skin){
    skinFlash = $('#skinFlashBox').find('#flash_'+skin);
    if(skinFlash.css('background-image')=='none'){//为什么不用css的onload事件来判断呢？chrome中无效。
        setTimeout(function(){initFlashSkin(skin);},10);
    }else{
        skinImgUrl = skinFlash.css('background-image');
        skinImgUrl = skinImgUrl.match(/url\("?(.*?)"?\)/)[1];//借来定义背景图路径（chrome有双引号，其他无）
        skinImgNum = 0 - skinFlash.css('z-index');//借来定义背景图数量
        $('<img id="skinimg_0" src="'+skinImgUrl+'" />').prependTo(skinFlash).height( $(window).height() ).show();
        skinImgIndex = 1;
        flashSkinHandler = setInterval(flashSkin,12000);
    }
}
function flashSkin(){
    if(skinImgNum<2) return;
    if(skinImgIndex == skinImgNum) skinImgIndex = 0;
    skinImgPre = skinImgIndex - 1;
    if(skinImgPre < 0) skinImgPre = skinImgNum-1;//索引从0开始，所以最大索引比总数小1
    if(!$('#skinimg_'+skinImgIndex)[0]){
        $('<img id="skinimg_'+skinImgIndex+'" src="'+skinImgUrl.replace('skin_0.jpg','skin_'+skinImgIndex+'.jpg')+'" />').prependTo(skinFlash).height( $(window).height() ).load(function(){flashSkin();});
    }else{
        $('#skinimg_'+skinImgPre).css('z-index',-10).fadeOut(1200);
        $('#skinimg_'+skinImgIndex).css('z-index',-11).fadeIn(1200);
        skinImgIndex++;
    }
}
function fixLogoPNG(){//修复IE6中LOGO用PNG图片无法透明的问题
    if((window.XMLHttpRequest == undefined) && (ActiveXObject != undefined)){//IE6检测
        topBox.find('.logo').each(function(){
            $(this).attr('style','');//因为下面设置了background-image为none;所以如果切换样式。必须移除这个东西，才能得到新的background-image
            var bgIMG = $(this).css('background-image');
            if(bgIMG.indexOf(".png")!=-1){
                var iebg = bgIMG.split('url("')[1].split('")')[0];
                $(this).css('background-image', 'none');
                $(this).get(0).runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + iebg + "',sizingMethod='scale')";//WIN7中的IETester无效？XP中的IETester又可以？还是IETester版本所致？
            }
        });
    }
}
function setCookie(name,value,seconds,path,domain,secure) {
    var expires = new Date();
    expires.setTime( expires.getTime() + parseInt(seconds)*1000 );
    document.cookie = name + "=" + escape (value) +
        ((expires) ? "; expires=" + expires.toGMTString() : "") +
        ((path) ? "; path=" + path : "") +
        ((domain) ? "; domain=" + domain : "") +
        ((secure) ? "; secure" : "");
}
function getCookie(name) {
    var $ = document.cookie.match(new RegExp("(^| )" + name + "=([^;]*)(;|$)"));
    if ($ != null) return unescape(unescape($[2]));
    return null
}
$(document).ready(function(){
    setVar();//设置变量（放最前）
    loadSkin();//加载皮肤CSS
    loadDialogSkin();
    initSize();//初始化各容器尺寸
    initTabLinks();//设置使用标签页打开的链接
    initDialogLinks();//设置使用窗口打开的链接
    initMenu();//设置菜单效果
    tabHover();//标签卡鼠标放上去效果
});
$(window).load(function(){
    initSize();//全部加载完了再搞一下，保险点
});
$(window).resize(function(){
    //窗口的突然变小，会导致滚动条的出现从而影响对各容器的重新设置尺寸（firefox）
    leftBox.height(0);
    rightBox.height(0);
    rightBox.width(0);
    $('#skinFlashBox img').height(0);
    initSize();//这下再重新设置各容器尺寸
    resizeTab();
});