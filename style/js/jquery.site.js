function setPage(url) {
	var content = $('section.content');
	if(content.attr('url') !== url || content.attr('url') == undefined) {
		$.ajax({
			type:'GET',
			url:url,
			dataType:'json',
			success:function(data){
				$('h1.header-title').html(data.title);
				$('section.content').html(data.content);
				$('section.content').attr('url',url);
			},
			error:function(data){
				if(data.status == "404") {
					$('section.content').html('ERROR 404!');
				}
			}
		})
	}
}