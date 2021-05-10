jQuery('.gfg-save-btn').on('click', function(){
	var base_url 	= window.location.origin;

	var gfg_form_id 				= jQuery('#gfg_form_id').val();
	var gfg_page_id 			= jQuery('#gfg_page_id').val();

	//Add a simple animation to show something is happening
	jQuery( ".gfg-save-btn" ).each(function() {
		jQuery(this).addClass('saving');
	});
	
	// AJAX post method to send the data
	jQuery.ajax({ 
		method: "POST",
		data:{
			action:'update_gfg_settings',
			gfg_page_id: gfg_page_id,
			gfg_form_id: gfg_form_id
		},
		url: base_url+"/wp-admin/admin-ajax.php",
		success:function(result){
			setTimeout(function(){
				jQuery(".result").html(result);
				jQuery( ".gfg-save-btn" ).each(function() {
					jQuery(this).removeClass('saving');
				});
			}, 1000);
			
		},
		error:function(error){
			console.log(error);
		}
	});
});