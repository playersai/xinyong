// JavaScript Document
function swap_tab(n)
{
 for(var i=1;i<=4;i++){
  var curC=document.getElementById("tab_"+i);
  var curB=document.getElementById("tab_t"+i);
  if(n==i){
   curC.style.display="block";
   curB.className="active"
  }else{
   curC.style.display="none";
   curB.className="normal"
  }
 }
} 




var screens=false;
function nonemenu(){
	
	function $(e){return document.getElementById(e);}
	
	var menu=$("menu");
	var main=$("ifmain");
	var topWin = window.top.document.getElementById("ifmain").contentWindow;



	if(screens==false){
		menu.style.display='none';
		main.style.left='0';
		topWin.document.getElementById("main").style.paddingRight = "0";
		screens=true;
		$('closs_menu').innerHTML = "鈭� 鎵撳紑宸︽爮"
	}else{
		menu.style.display='block';
		main.style.left='220px';
		topWin.document.getElementById("main").style.paddingRight = "220px";
		screens=false;
		$('closs_menu').innerHTML = "脳 鍏抽棴宸︽爮" 
	}
}

var screensa=true;
function article_more_info(){
	
	function $(e){return document.getElementById(e);}
	
	var article_more_info=$("article_more_info");
	
	if(screensa==false){
		article_more_info.style.display='none';
		screensa=true;
		$('article_more').innerHTML = "<em class='up_jt'></em>鏇村鎺у埗閫夐」"
	}else{
		article_more_info.style.display='block';
		screensa=false;
		$('article_more').innerHTML = "<em class='down_jt'></em>鏇村鎺у埗閫夐」" 
	}
}

function checkAll() {
for (var j = 1; j <= 1000; j++) {
box = eval("document.checkboxform.record" + j); 
if (box.checked == false) box.checked = true;
   }
}

function uncheckAll() {
for (var j = 1; j <= 1000; j++) {
box = eval("document.checkboxform.record" + j); 
if (box.checked == true) box.checked = false;
   }
}

function switchAll() {
for (var j = 1; j <= 1000; j++) {
box = eval("document.checkboxform.record" + j); 
box.checked = !box.checked;
   }
}

function load(url){
	$(function(){
		$("#body").load(url);
	});
}

function link(id){
	$(function(){
		load($(id).attr("url"));
	});
}

function Gotonew(url){
	window.location = url;   //url涓轰綘瑕佽烦杞殑椤甸潰鐨剈rl
}

window.onerror=function(){return true;} 