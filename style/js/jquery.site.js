function setPage(url) {
	$('aside.main-content').load(url, function(responseTxt, statusTxt, xhr){});
}