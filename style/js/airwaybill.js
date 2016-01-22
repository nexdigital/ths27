var base_url = 'http://localhost/ths27/';

$(document).ready(function(){
	$(document).on('click','.add-item',function(){
		var type = $(this).data('type');

		if($('#add-item-invoice').length > 0) return false;

		var element;
		element = '<div id="add-item-invoice">'+
			'<input type="hidden" name="item_type" value="'+type+'">'+
			'<input type="text" name="item_name" placeholder="Item name">'+
			'<input type="number" name="item_value" placeholder="Item value">'+
			'<button class="add-item-submit">Save</button>'+
			'<button class="add-item-cancel">Cancel</button>'+
			'</div>';

		$('div.' + type).append(element);
		$('#add-item-invoice').find('input[name=item_name]').focus();
	});

	$(document).on('click','.add-item-submit',function(){
		var hawb_no = $('input[name=item_hawb_no]').val(); 
		var type = $('input[name=item_type]').val(); 
		var name = $('input[name=item_name]').val(); 
		var value = $('input[name=item_value]').val();

		if(name && value){
			$.ajax({
				type:'POST',
				url:base_url + 'invoice/add_item',
				data:{'hawb_no':hawb_no,'type':type,'name':name,'value':value},
				dataType:'json',
				success:function(data){
					$('#add-item-invoice').remove();
					var element;
					element = '<div class="item-'+data.id+'"><div class="item" style="width:160px;">'+data.name+' <a href="javascript:void(0)" class="remove-item" data-id="'+data.id+'" title="Remove item">X</a></div>'+
					'<div class="item" style="width:20px;">RP</div>'+
					'<div class="value">'+data.value+'</div></div>';
					$('div.' + type).append(element);
					update_invoice();
				}
			});
		} else {
			alert('Please complete form');
		}
	});

	$(document).on('click','.add-item-cancel',function(){
		$('#add-item-invoice').remove();
	});

	$(document).on('click','.remove-item',function(){
		var id = $(this).data('id');
		$('div.item-' + id).remove();
		$.post(base_url + 'invoice/remove_item',{'item_id':id},function(){
			update_invoice();
		});
	});
	
	$(document).on('click','.item-tax',function(){
		var hawb_no = $('input[name=item_hawb_no]').val();
		$.post(base_url + 'invoice/updatetax/' + this.checked,{'hawb_no':hawb_no},function(){
			update_invoice();
		});		
	});
	
	$(document).on('click','.btn-back',function(){
		window.top.close();
	});
	
	$(document).on('click','.btn-print',function(){
		var $hawb_no = $('input[name=item_hawb_no]').val();
		window.location = base_url+'invoice/printout/'+$hawb_no;
	});
});

function update_invoice(){
	var hawb_no = $('input[name=item_hawb_no]').val();
	$.get(base_url + 'invoice/total/' + hawb_no,function(total){
		$('.invoice_total').text(total);
	});
	
	$.get(base_url + 'invoice/gettax/' + hawb_no,function(total){
		$('.invoice_tax').text(total);
	});
}