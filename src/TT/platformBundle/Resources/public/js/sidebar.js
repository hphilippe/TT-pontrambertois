$(function(){
	$('.list-group').hide();
	$('.mini-submenu').show();

 	setTimeout(function(){
        $('.mini-submenu').click();
    }, 500);  

	$('#slide-submenu').on('click',function() {			        
        $(this).closest('.list-group').fadeOut('slide',function(){
        	$('.mini-submenu').fadeIn();	
        });
        
      });

	$('.mini-submenu').on('click',function(){		
        $(this).next('.list-group').toggle('slide');
        $('.mini-submenu').hide();
	})
})
