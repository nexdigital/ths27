function setPage(url) {
	$('.autocomplete-suggestions ').remove();
	$('aside.main-content').load(url, function(responseTxt, statusTxt, xhr){});
}