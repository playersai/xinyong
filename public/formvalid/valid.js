function check_isIntger(num) {
	if (parseInt(num) == num) {
		return true;
	} else {
		return false;
	}
}

// function check_isURL(url) {
// var Expression = /http(s)?:////([\w-]+\.)+[\w-]+(\/[\w- .\/?%&=]*)?/;
// var objExp = new RegExp(Expression);
// if (url.indexOf("localhost")) {
// str = url.replace("localhost", "127.0.0.1");
// }
// return objExp.test(url);
// }

function check_isURL(str_url) {
	// 验证url
	// var strRegex = "^((https|http)?://)"
	// + "?(([0-9a-z_!~*'().&=+$%-]+: )?[0-9a-z_!~*'().&=+$%-]+@)?" // ftp的user@
	// + "(([0-9]{1,3}\.){3}[0-9]{1,3}" // IP形式的URL- 199.194.52.184
	// + "|" // 允许IP和DOMAIN（域名）
	// + "([0-9a-z_!~*'()-]+\.)*" // 域名- www.
	// + "([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]\." // 二级域名
	// + "[a-z]{2,6})" // first level domain- .com or .museum
	// + "(:[0-9]{1,4})?" // 端口- :80
	// + "((/?)|" // a slash isn't required if there is no file name
	// + "(/[0-9a-z_!~*'().;?:@&=+$,%#-]+)+/?)$";

	str_url = str_url.toLowerCase();

	var strRegex1 = /^((https|http)?:\/\/)/i;
	var re1 = new RegExp(strRegex1);
	if (!re1.test(str_url)) {
		return false;
	}

	var strRegex2 = /^((https|http)?:\/\/)?(([0-9a-z_!~*'().&=+$%-]+: )?[0-9a-z_!~*'().&=+$%-]+@)?(([0-9]{1,3}\.){3}[0-9]{1,3}|([0-9a-z_!~*'()-]+\.)*([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]\.[a-z]{2,6})(:[0-9]{1,4})?((\/?)|(\/[0-9a-z_!~*'().;?:@&=+$,%#-]+)+\/?)$/;
	var re2 = new RegExp(strRegex2);
	return re2.test(str_url);
}

function check_isRelativePath(path) {
	if (path.substr(0, 1) == '/') {
		return true;
	} else {
		return false;
	}
}

function check_isillegalChar(str) {
	var pattern = /[`~!@#$%^&*()_+<>?:"{},.\/;'[\]]/im;
	if (pattern.test(str)) {
		return false;
	}
	return true;
}

function check_isRegisterUserName(str) {
	var patrn = /^[a-zA-Z]{1}([a-zA-Z0-9]|[-_]){4,19}$/;
	if (!patrn.exec(str)) {
		return false
	}
	return true
}

function stripscript(str) {
	var pattern = new RegExp(
			"[`~!@#$^&*()=|{}':;',\\[\\].<>/?~！@#￥……&*（）——|{}【】‘；：”“'。，、？%]")
	var rs = "";
	for ( var i = 0; i < str.length; i++) {
		rs = rs + str.substr(i, 1).replace(pattern, '');
	}
	return rs;
}

function clearSpecialChar(str) {
	str = str.replace(/\"/g, "&quot;");
	str = str.replace(/</g, "&lt;");
	str = str.replace(/>/g, "&gt;");
	return str;
}

function trim(str) {
	str = str.replace(/^\s+|\s+$/g, "");
	return str;
}

function check_isMoblieNum(mobileStr) {
	// var myreg = /^(((13[0-9]{1})|150|153|189)+\d{8})$/; //自由配置号段
	var myreg = /^0?(13[0-9]|15[012356789]|18[0236789]|14[57])[0-9]{8}$/;
	return myreg.test(mobileStr);
}

function check_isOfficeNum(phoneStr) {
	var myreg = /^((0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$/;
	return myreg.test(phoneStr);

}

function check_isEmail(emailStr) {
	var myreg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
	return myreg.test(emailStr);
}

// alert(compareDate("2004-12-01","2004-05-02"));
function compareDate(DateOne, DateTwo) {
	var OneMonth = DateOne.substring(5, DateOne.lastIndexOf("-"));
	var OneDay = DateOne
			.substring(DateOne.length, DateOne.lastIndexOf("-") + 1);
	var OneYear = DateOne.substring(0, DateOne.indexOf("-"));

	var TwoMonth = DateTwo.substring(5, DateTwo.lastIndexOf("-"));
	var TwoDay = DateTwo
			.substring(DateTwo.length, DateTwo.lastIndexOf("-") + 1);
	var TwoYear = DateTwo.substring(0, DateTwo.indexOf("-"));

	if (Date.parse(OneMonth + "/" + OneDay + "/" + OneYear) > Date
			.parse(TwoMonth + "/" + TwoDay + "/" + TwoYear)) {
		return false;
	} else {
		return true;
	}

}
