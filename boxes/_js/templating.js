(function() {
	var body = document.getElementsByTagName('body')[0],
		outlinkContainer, outlink;
	outlinkContainer = document.createElement('div');
	outlinkContainer.setAttribute('class', "templating_outlink");
	outlinkContainer.setAttribute('style', "background:rgba(40,40,40,.4);border:1px solid rgba(40,40,40,.2);border-top:0px;top:0px;position:fixed;right:5px;width:25px;height:35px;-webkit-border-radius: 0px 0px 3px 3px;border-radius: 0px 0px 3px 3px;-webkit-box-shadow: 1px 1px 2px 1px rgba(0, 0, 0, .2);box-shadow: 1px 1px 2px 1px rgba(0, 0, 0, .2);");
	
	outlink = document.createElement('a');
	outlink.setAttribute('href', "index.php");
	outlink.setAttribute('title', "Templates index");
	outlink.setAttribute('style', "background:transparent url(./_img/ico_home.png) center center no-repeat;display:block;height:35px;overflow:hidden;text-indent:-10000px;width:25px;");
	outlink.innerHTML = "Index";
	
	outlinkContainer.appendChild(outlink);
	body.appendChild(outlinkContainer);
}());