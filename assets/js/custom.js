function UpdateNotifications(forceShow = false) {

	$.post("assets/php/checkNotificaciones.php", function(json) {

		var notifications="";

		if(json.qty > 0) {

			for (var i = 0; i < json.qty; i++) {

				if(json.rows[i].cell[3]==null) {

					notifications+='<tr><td class="product__info"><div class="product__info-content"><h5 class="product__name"><a href="'+json.rows[i].cell[2]+'">'+json.rows[i].cell[0]+'</a></h5><span class="product__cat"><a href="'+json.rows[i].cell[2]+'">'+json.rows[i].cell[1]+'</a></span></div></td><td class="product__remove"><a href="javascript: void(0)" class="product__remove-icon" data-notification="'+json.rows[i].id+'"></a></td></tr>';
					
				}
				else {
					
					notifications+='<tr><td class="product__info"><div class="product__info-content"><h5 class="product__name"><a class="text-muted" href="'+json.rows[i].cell[2]+'">'+json.rows[i].cell[0]+'</a></h5><a href="'+json.rows[i].cell[2]+'"><span class="product__cat text-muted">'+json.rows[i].cell[1]+'</a></span></div></td><td class=""></td></tr>';
					
				}
				
			
			}
		}

		$(".header-cart-toggle__items-count, .cart-panel__items-count").html(json.unread);
		$(".notifications-table-body").html(notifications);


		$(".product__remove-icon").click(function() {
			
			$.post("assets/php/borrarNotificaciones.php", {id: $(this).data('notification')}, function() {
//                alert("1");
				UpdateNotifications();
//                alert("2");
			});
		});

		
		
		if(forceShow) {
			$('.header-cart-toggle').click();
		}
	
		
	});

	
	//cada 5 minutos se repite
	setTimeout(UpdateNotifications, 5 * 60 * 1000);


}



function toggleOverlay(mode) {
	if(mode=="show") {
		$(".site-overlay").css({"visibility":"visible", "opacity": "1", "background-color": "rgba(21, 23, 32, 0.96)"});
	}
	else {
		$(".site-overlay").removeAttr('style');
	}
}


UpdateNotifications();
