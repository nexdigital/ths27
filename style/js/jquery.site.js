function setPage(url) {
	$.ajax({
		type:'GET',
		url:url,
		dataType:'json',
		success:function(data){
			$('h1.header-title').html(data.title);
			$('div.content').html(data.content);
		},
		error:function(data){
			if(data.status == "404") {
				$('div.content').html('ERROR 404!');
			}
		}
	});
}