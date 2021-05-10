<?php
	add_action('admin_menu', 'gfg_menu');
 
	function gfg_menu(){
        add_menu_page( 'GF Gate', 'GF Gate', 'manage_options', 'gf-gate', 'gfg_init', 'dashicons-lock' );
	}
	function gfg_init(){
	    wp_enqueue_style( 'mht-admin-css', plugin_dir_url( __FILE__ ) . '../css/gfg-admin.css', '1.0', true);
	    wp_enqueue_script( 'mht-admin-js', plugin_dir_url( __FILE__ ) . '../js/gfg-admin.js', '1.0', true);
	    ?>

	    <h1>Gravity Form Site Gate</h1>
	    <button name="save" class="gfg-save-btn" value="save"><span>save</span></button>
	    <?php
	        $form_ID     	    	= get_option('gfg_form_id');
	        $page_ID	          	= get_option('gfg_page_id');
	    ?>    
	    <div class='section-wrap'>
	        <div class='sections'>
	            <h2 class="instagram-heading">Settings</h2>
	            <div>
	            	<h3>Instructions</h3>
		            <p><b>Gravity Form ID:</b> This is the form ID that you are using to gate the site. You can find it by looking at the list of your forms and the ID column next to your desired form.</p>
					<p><b>Page ID:</b> This is page that contains the form that you are using to redirect. You can find your page ID by going to Pages > All Pages. When you hover over the desired page title or the edit link your will see in the url <i>post=12345&action=edit</i>. Enter just the numbers in the Page ID field. </p>
		        </div>
	            <div>
	            	<h3>Information</h3>
		            <label for="gfg_form_id">Gravity Form ID</label>
		            <input type='text' name='gfg_form_id' class='textfield' id='gfg_form_id' value='<?php echo $form_ID; ?>' />
		            <label for="gfg_page_id">Page ID</label>
		            <input type='text' name='gfg_page_id' class='textfield' id='gfg_page_id' value='<?php echo $page_ID; ?>' />
		        </div>

	        </div>
	    </div>
	    <pre>
	    </pre>
	    <button name="save" class="gfg-save-btn" value="save"><span>save</span></button>
	    <div class="result">
	    	
	    </div>
	    <?php

	    
	}

	function update_gfg_settings(){
	    $gfg_form_id      		= $_POST['gfg_form_id'];
	    $gfg_page_id	     	= $_POST['gfg_page_id'];

	    update_option( 'gfg_form_id', $gfg_form_id);
	    update_option( 'gfg_page_id', $gfg_page_id);

	    echo "saved";
	    exit();
	}

	//Cron Actions to create posts
	add_action('wp_ajax_update_gfg_settings', 'update_gfg_settings');
	add_action('wp_ajax_nopriv_update_gfg_settings', 'update_gfg_settings');