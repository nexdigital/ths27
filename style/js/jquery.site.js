function setPage(url) {
	$('aside.main-content').attr('url',url);
	$('aside.main-content').load(url, function(responseTxt, statusTxt, xhr){
		if(statusTxt == 'error') {
			$('aside.main-content').html('<div style="font-size:22px; font-weight:bold; text-align:center; margin-top:50px;">SERVER ERROR!</div>');
		}
	});
}
function reloadContent(){
	var url = $('aside.main-content').attr('url');
	if(url != '' || url != undefined) {
		setPage(url);
	} else {
		setPage('dashboard');		
	}
	return false;
}