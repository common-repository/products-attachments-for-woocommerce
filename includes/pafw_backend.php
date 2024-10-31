<?php

if (!defined('ABSPATH'))
  exit;

if (!class_exists('PAFW_admin_menu')) {

    class PAFW_admin_menu {

        protected static $PAFW_instance;

        function PAFW_submenu_page() {
            add_submenu_page('edit.php?post_type=product_attachment',__( 'woocommerce Products Attachments', 'Products Attachments' ),'Settings','manage_options','products-attachments-settings',array($this, 'PAFW_callback'));
        }

        function PAFW_callback(){
        	global $pafw_comman;
        	?>
        	<div class="pafw-container">
	            <form method="post" enctype="multipart/form-data">
	            	<div class="wrap">
	                	<h2><?php echo __("Products Attachments for WooCommerce","products-attachments-for-woocommerce");?></h2>	            		
	            	</div>
	                <div class="pafw-tab-content"> 
	                	<h3><?php echo __("FRONTEND: PRODUCT PAGE","products-attachments-for-woocommerce");?></h3>
	                    <table class="data_table">
	                        <tbody>
	                            <tr class="pafw_table_inner_tr">
	                                <th>
	                                    <label><?php echo __("Single Product Page Tab Title","products-attachments-for-woocommerce");?></label>
	                                </th>
	                                <td>
	                                    <input type="text" class="regular-text" name="pafw_comman[pafw_frontend_product_page_tab_title]" value="<?php echo esc_attr($pafw_comman['pafw_frontend_product_page_tab_title']);?>">
	                                </td>
	                            </tr>
	                            <tr class="pafw_table_inner_tr">
				                  	<th>
	                                    <label><?php echo __("Title Text color","products-attachments-for-woocommerce");?></label>
	                                </th>
			                        <td>
			                            <input type="text" class="color-picker" data-alpha="true" data-default-color="<?php echo $pafw_comman['pdftitletextcolor']; ?>" name="pafw_comman[pdftitletextcolor]" value="<?php echo esc_attr($pafw_comman['pdftitletextcolor']); ?>"/>
			                        </td>
			                  	</tr>
			                  	<tr class="pafw_table_inner_tr">
			                  		<th>
			                  			<label><?php echo __("Title Text Size" , "products-attachments-for-woocommerce"); ?></label>
			                  		</th>
			                  		<td>
			                            <input type="number" class="regular-text" name="pafw_comman[pafw_title_text_size]" value="<?php echo esc_attr($pafw_comman['pafw_title_text_size']);?>"><p><i>give text size in px</i></p>
			                        </td>
			                        
			                  	</tr>
	                            <tr class="pafw_table_inner_tr">
				                  	<th>
	                                    <label><?php echo __("Pdf Download button text color","products-attachments-for-woocommerce");?></label>
	                                </th>
			                        <td>
			                            <input type="text" class="color-picker" data-alpha="true" data-default-color="<?php echo esc_attr($pafw_comman['pdfdownloadtextcolor']); ?>" name="pafw_comman[pdfdownloadtextcolor]" value="<?php echo esc_attr($pafw_comman['pdfdownloadtextcolor']); ?>"/>
			                        </td>
			                  	</tr>
			                  	<tr class="pafw_table_inner_tr">
				                  	
				                  	<th>
	                                    <label><?php echo __("Pdf Download button background color","products-attachments-for-woocommerce");?></label>
	                                </th>
			                        <td>
			                            <input type="text" class="color-picker" data-alpha="true" data-default-color="<?php echo esc_attr($pafw_comman['pdfdownloadbackcolor']); ?>" name="pafw_comman[pdfdownloadbackcolor]" value="<?php echo esc_attr($pafw_comman['pdfdownloadbackcolor']); ?>"/>
			                        </td>
			                  	</tr>
			                  	<tr class="pafw_table_inner_tr">
				                  	<th>
	                                    <label><?php echo __("Pdf View Button text","products-attachments-for-woocommerce");?></label>
	                                </th>
			                        <td>
			                            <input type="text" class="regular-text" name="pafw_comman[pafw_pdf_view_button]" value="<?php echo esc_attr($pafw_comman['pafw_pdf_view_button']);?>">
			                        </td>
			                  	</tr>
			                  	<tr class="pafw_table_inner_tr">
				                  	<th>
	                                    <label><?php echo __("Pdf Download Button text","products-attachments-for-woocommerce");?></label>
	                                </th>
			                        <td>
			                            <input type="text" class="regular-text" name="pafw_comman[pafw_download_view_button]" value="<?php echo esc_attr($pafw_comman['pafw_download_view_button']);?>">
			                        </td>
			                  	</tr>
	                            <tr class="pafw_table_inner_tr">
	                                <th>
	                                    <label><?php echo __("Display Attachments Selected User Roles.","products-attachments-for-woocommerce");?></label>
	                                </th>
	                                <td>
	                                    <select id="pafw_select_user_role" name="pafw_roles_select[]" multiple="multiple" style="width:100%;">
                                            <?php 
                                                $user_roles = get_option('pafw_roles_select');
                                                
                                                if (!empty($user_roles)) {
                                                    foreach ($user_roles as $key => $value) {
                                                        $role_names = ( mb_strlen( $value ) > 50 ) ? mb_substr( $value, 0, 49 ) . '...' : $value;?>
                                                            <option value="<?php echo $value;?>" selected="selected"><?php echo $role_names;?></option>
                                                        <?php   
                                                    }
                                                }
                                            ?>
                                        </select>
	                                </td>
	                            </tr>
	                            <tr class="pafw_table_inner_tr">
	                                <th>
	                                    <label><?php echo __("Display Attachments Show Selected Order Status.","products-attachments-for-woocommerce");?></label>
	                                </th>
	                                <td>
	                                    <select id="pafw_select_order_status" name="pafw_order_status_select[]" multiple="multiple" style="width:100%;">
                                            <?php 
                                                $order_status = get_option('pafw_order_status_select');

                                                if (!empty($order_status)) {
                                                    foreach ($order_status as $key => $value) {
                                                        $order_name = ( mb_strlen( $value ) > 50 ) ? mb_substr( $value, 0, 49 ) . '...' : $value;
                                                        ?>
                                                            <option value="<?php echo $value;?>" selected="selected"><?php echo $order_name;?></option>
                                                        <?php   
                                                    }
                                                }
                                            ?>
                                        </select>
	                                </td>
	                            </tr>
	                            <tr class="pafw_table_inner_tr">
	                                <th>
	                                    <label><?php echo __("Set product attachment tab default selected","products-attachments-for-woocommerce");?></label>
	                                </th>
	                                <td>
	                                    <input type="radio" name="pafw_comman[pafw_set_product_attachment_tab_default_selected]" value="yes"<?php if($pafw_comman['pafw_set_product_attachment_tab_default_selected'] == 'yes'){echo "checked";}?>>
	                                    <span>Yes</span>
	                                    <input type="radio" name="pafw_comman[pafw_set_product_attachment_tab_default_selected]" value="no"<?php if($pafw_comman['pafw_set_product_attachment_tab_default_selected'] == 'no'){echo "checked";}?>>
	                                    <span>No</span>
	                                </td>
	                            </tr>
	                        </tbody>
	                    </table>
	                    <h3><?php echo __("ORDER ATTACHMENT SETTING","products-attachments-for-woocommerce");?></h3>
	                    <table class="data_table">
	                        <tbody>
	                            <tr class="pafw_table_inner_tr">
	                                <th>
	                                    <label><?php echo __("Order Details Page Heading Text","products-attachments-for-woocommerce");?></label>
	                                </th>
	                                <td>
	                                    <input type="text" class="regular-text" name="pafw_comman[pafw_order_details_page_tab_title]" value="<?php echo esc_attr($pafw_comman['pafw_order_details_page_tab_title']);?>">
	                                </td>
	                            </tr>
	                            <tr class="pafw_table_inner_tr">
	                                <th>
	                                    <label><?php echo __("Show Attachments on Myaccount Order Detail Page ","products-attachments-for-woocommerce");?></label>
	                                </th>
	                                <td>
	                                    <input type="radio" name="pafw_comman[pafw_show_attach_on_orders_detail_page]" value="enable"<?php if($pafw_comman['pafw_show_attach_on_orders_detail_page'] == 'enable'){echo "checked";}?>>
	                                    <span><?php echo __("Enable","products-attachments-for-woocommerce");?></span>
	                                    <input type="radio" name="pafw_comman[pafw_show_attach_on_orders_detail_page]" value="disable"<?php if($pafw_comman['pafw_show_attach_on_orders_detail_page'] == 'disable'){echo "checked";}?>>
	                                    <span><?php echo __("Disable","products-attachments-for-woocommerce");?></span>
	                                </td>
	                            </tr>
	                            <tr class="pafw_table_inner_tr">
	                                <th>
	                                    <label><?php echo __("Admin Order Details Page Metabox Title","products-attachments-for-woocommerce");?></label>
	                                </th>
	                                <td>
	                                   	<input type="text" class="regular-text" name="pafw_comman[pafw_admin_order_details_page_tab_title]" value="<?php echo esc_attr($pafw_comman['pafw_admin_order_details_page_tab_title']);?>">
	                                </td>
	                            </tr>
	                            <tr class="pafw_table_inner_tr">
	                                <th>
	                                    <label><?php echo __("Show Attachments in Thank You Page","products-attachments-for-woocommerce");?></label>
	                                </th>
	                                <td>
	                                    <input type="radio" name="pafw_comman[pafw_show_attach_in_thank_you_page]" value="enable"<?php if($pafw_comman['pafw_show_attach_in_thank_you_page'] == 'enable'){echo "checked";}?>>
	                                    <span><?php echo __("Enable","products-attachments-for-woocommerce");?></span>
	                                    <input type="radio" name="pafw_comman[pafw_show_attach_in_thank_you_page]" value="disable"<?php if($pafw_comman['pafw_show_attach_in_thank_you_page'] == 'disable'){echo "checked";}?>>
	                                    <span><?php echo __("Disable","products-attachments-for-woocommerce");?></span>
	                                </td>
	                            </tr>
	                            <tr class="pafw_table_inner_tr">
	                                <th>
	                                    <label><?php echo __("Show Attachments in Admin Order Page","products-attachments-for-woocommerce");?></label>
	                                </th>
	                                <td>
                                        <input type="checkbox" name="pafw_comman[admin_side_attachment]" value="yes" <?php if ($pafw_comman['f'] == "yes" ) { echo 'checked="checked"'; } ?>>
                                    </td>
	                            </tr>
	                          
	                        </tbody>
	                    </table>
	                </div> 
	                <div class="submit_button">
	                    <input type="hidden" name="pafw_form_submit" value="pafw_save_option">
	                    <input type="submit" value="Save changes" name="submit" class="button-primary" id="pafw-btn-space">
	                </div>              
	            </form>  
	        </div>
	        <?php
        }

        function pafw_role_ajax(){
            global $wp_roles;
            $return = array();
            
            foreach( $wp_roles->role_names as $role => $name ) {
                $return[] = array( $role, $name );
            }

            echo json_encode( $return );
            die;
        }

        function pafw_order_status_ajax(){
            $order_statuses = wc_get_order_statuses();
            $return = array();
            
            foreach( $order_statuses as $order_slug => $name ) {
                $return[] = array( $order_slug, $name );
            }

            echo json_encode( $return );
            die;
        }

        function PAFW_recursive_sanitize_text_field( $array ) {
            foreach ( $array as $key => $value ) {
                if ( is_array( $value ) ) {
                    $value = $this->PAFW_recursive_sanitize_text_field($value);
                }else{
                    $value = sanitize_text_field( $value );
                }
            }
            return $array;
        }

        function PAFW_save_option(){
        	if( current_user_can('administrator') ) { 
	            if(isset($_REQUEST['pafw_form_submit']) && $_REQUEST['pafw_form_submit'] == 'pafw_save_option'){
	                //if(!empty($_REQUEST['pafw_comman'])){
	                    $isecheckbox = array(
	                    	'admin_side_attachment',
	                    );
	                    foreach ($isecheckbox as $key_isecheckbox => $value_isecheckbox) {
	                        if(!isset($_REQUEST['pafw_comman'][$value_isecheckbox])){
	                            $_REQUEST['pafw_comman'][$value_isecheckbox] ='no';
	                        }
	                    }	
	                    $pafw_roles_select = $this->PAFW_recursive_sanitize_text_field( $_REQUEST['pafw_roles_select'] );
                        update_option('pafw_roles_select', $pafw_roles_select, 'yes');

                        $pafw_order_status_select = $this->PAFW_recursive_sanitize_text_field( $_REQUEST['pafw_order_status_select'] );
                        update_option('pafw_order_status_select', $pafw_order_status_select, 'yes');                   
	                    foreach ($_REQUEST['pafw_comman'] as $key_pafw_comman => $value_pafw_comman) {
	                        update_option($key_pafw_comman, sanitize_text_field($value_pafw_comman), 'yes');
	                    }   

	                wp_redirect( admin_url( '/admin.php?page=products-attachments-settings' ) );
	                exit;     
	            }
	        }
        }

	    function pafw_mv_add_meta_boxes(){
	    	global $pafw_comman;
	        add_meta_box( 'mv_other_fields', __(''.$pafw_comman['pafw_admin_order_details_page_tab_title'].'','woocommerce'), array($this,'mv_add_other_fields_for_packaging'), 'shop_order', 'side', 'core' );
	    }

	    function mv_add_other_fields_for_packaging(){
	        global $post,$pafw_comman;
            // $order = new WC_Order( $post->ID );
            // $order_status = get_option('pafw_order_status_select');
            // $status = array();
            // if (!empty($order_status)) {
	           //  foreach ($order_status as $key => $value) {
	           //      $status_order = str_replace("wc-","",$value);
	           //      $status[] = $status_order;
	           //  }
            // }
            // $order_in_show = false;
            // if (in_array($order->get_status(),$status)) {
            // 	$order_in_show = true;
            // }elseif(empty($order_status)){
            // 	$order_in_show = true;
            // }
            // if ($order_in_show == true) {
	            ?>
	            <h2 class="pafw_attachment_head_on_order_page">
	                <?php echo __($pafw_comman['pafw_admin_order_details_page_tab_title'] , 'products-attachments-for-woocommerce'); ?>
	            </h2>
	            <div class="pafw_attachment_main_div">
	                <?php
	                $args = array(  
	                    'post_type' => 'product_attachment',
	                    'post_status' => 'publish',
	                    'posts_per_page' => -1, 
	                    'orderby' => 'date', 
	                    'order' => 'ASC', 
	                );

	                $posts = new WP_Query( $args );

	                $no_attachments = false;
	                foreach ($posts->posts as $key => $value) {
	                    $productsa = get_post_meta( $value->ID, 'pafw_select2', true);

	                    $order = new WC_Order( $post->ID );
	                    $items = $order->get_items();
	                    $pro_id_array = array();
	                    foreach ( $items as $item ) {
	                        $pro_id_array[] = $item['product_id'];
	                    }
	                    $confirmation = false;
	                    foreach ($pro_id_array as $key => $pro_id) {
	                        if (in_array($pro_id, $productsa)) {
	                            $confirmation = true;
	                        }
	                    }
	                    if ($confirmation == true) {
	                        $psfw_attachment_status = get_post_meta( $value->ID, 'psfw_attachment_status', true);
	                        $pafw_attachment_visibility_pages = get_post_meta( $value->ID, 'pafw_attachment_visibility_pages', true);
	                        $pafw_show_only_for_logged_in_users = get_post_meta($value->ID,'pafw_show_only_for_logged_in_users',true);
	                        $pafw_attch_down_or_view = get_post_meta( $value->ID, 'pafw_attch_down_or_view', true);
		                    if ($pafw_attch_down_or_view == 'download_only') {
		                        $down_or_view = 'download';
		                        $dv_button = '<i class="fa fa-download"></i>Download';
		                    }elseif ($pafw_attch_down_or_view == 'view_only') {
		                        $down_or_view = 'target="_blank"';
		                        $dv_button = '<i class="fa fa-eye" aria-hidden="true"></i>View';
		                    }

	                        $pafw_shop_imagelogo_id = get_post_meta( $value->ID, 'pafw_shop_imagelogo', true);
	                        $pafw_shop_image_logo = wp_get_attachment_url( $pafw_shop_imagelogo_id, 'full' );
	                        $pafw_specific_date = get_post_meta( $value->ID, 'pafw_specific_date', true);
	                        $currentDateTime = strtotime(date('Y-m-d'));
	                        $expire_date = strtotime($pafw_specific_date);
	                       		if($pafw_comman['admin_side_attachment'] == "yes") {
		                            if ($psfw_attachment_status == 'enable') {
		                            	$pafw_set_expire_date_and_time = get_post_meta( $value->ID, 'pafw_set_expire_date_and_time', true);
		                                $pafw_show_attach_expire_date = get_post_meta( $value->ID, 'pafw_show_attach_expire_date', true);
		                                if($pafw_set_expire_date_and_time =='specific_date' && $pafw_show_attach_expire_date == 'yes'){
			                                if ($currentDateTime > $expire_date) {
			                                    $date = '* This Attachment Expired.';
			                                    $download_button = '<a class="pafw_expire button">'.$dv_button.'</a>';
			                                }elseif($currentDateTime <= $expire_date){
			                                    $date = '* This Attachment Expiry Date : '.$pafw_specific_date;
			                                    $download_button = '<a class="pafw_attachmentbtn button" style="'.$pafw_comman['pdfdownloadtextcolor'].'" href="' . $pafw_shop_image_logo .'"  '.$down_or_view.'>'.$dv_button.'</a>';               
			                                }elseif ( !isset($pafw_shop_image_logo) ) {
			                                    $date = '* Attachment Is Not Set.';
			                                    $download_button = '';
			                                }else{
			                                    $date = '* Attachment Is Not Set.';
			                                    $download_button = '';
			                                }
			                            }elseif($pafw_set_expire_date_and_time =='no' && $pafw_show_attach_expire_date == 'yes'){
											$date = "This attachment is not expire any time.";
											$download_button = '<a class="pafw_attachmentbtn button" style="'.$pafw_comman['pdfdownloadtextcolor'].'" href="' . $pafw_shop_image_logo .'"  '.$down_or_view.'>'.$dv_button.'</a>';
			                            }else{
		                                    $date = '';
		                                    $download_button = '<a class="pafw_attachmentbtn button" style="'.$pafw_comman['pdfdownloadtextcolor'].'" href="' . $pafw_shop_image_logo .'"  '.$down_or_view.'>'.$dv_button.'</a>';
		                                }
		                                ?>

		                                <div class="pafw_attachment">
		                                    <h3 class="pafw_attachment_name">
		                                       <?php echo __($value->post_title , 'products-attachments-for-woocommerce');?>                   
		                                    </h3>
		                                    <div class="date_download_attach">
		                                        <p class="order_att_expire_date">
		                                            <?php echo __($date , 'products-attachments-for-woocommerce');?>                            
		                                        </p>
		                                         <?php echo __( $download_button, 'products-attachments-for-woocommerce');?>
		                                    </div>
		                                    <p class="pafw_attachment_desc">
		                                    	<strong>Discription : </strong>
		                                        <?php $pafw_attachment_discription = get_post_meta( $value->ID, 'pafw_attachment_discription', true);
		                                        echo $pafw_attachment_discription;?>                    
		                                    </p>
		                                </div>
		                                <?php
		                            }
		                        }
	                    }else{
	                        $no_attachments = true;
	                    }
	                }
	                if ($no_attachments == true) {
	                    echo "<div class='empty_attach'>";
	                    echo "This order in not have any attachments....!";
	                    echo "</div>";
	                }
	                ?>
	            </div>
	            <?php
            // }
	    }

	    function PAFW_create_post_type() {
            $post_type = 'product_attachment';
            $singular_name = 'Product Attachments';
            $plural_name = 'Attachments';
            $slug = 'product_attachment';
            $labels = array(
                'name'               => _x( $plural_name, 'post type general name', 'products-attachments-for-woocommerce' ),
                'singular_name'      => _x( $singular_name, 'post type singular name', 'products-attachments-for-woocommerce' ),
                'menu_name'          => _x( $singular_name, 'admin menu name', 'products-attachments-for-woocommerce' ),
                'name_admin_bar'     => _x( $singular_name, 'add new name on admin bar', 'products-attachments-for-woocommerce' ),
                'add_new'            => __( 'Add New', 'products-attachments-for-woocommerce' ),
                'add_new_item'       => __( 'Add New '.$singular_name, 'products-attachments-for-woocommerce' ),
                'new_item'           => __( 'New '.$singular_name, 'products-attachments-for-woocommerce' ),
                'edit_item'          => __( 'Edit '.$singular_name, 'products-attachments-for-woocommerce' ),
                'view_item'          => __( 'View '.$singular_name, 'products-attachments-for-woocommerce' ),
                'all_items'          => __( 'All '.$plural_name, 'products-attachments-for-woocommerce' ),
                'search_items'       => __( 'Search '.$plural_name, 'products-attachments-for-woocommerce' ),
                'parent_item_colon'  => __( 'Parent '.$plural_name.':', 'products-attachments-for-woocommerce' ),
                'not_found'          => __( 'No Product Attachment found.', 'products-attachments-for-woocommerce' ),
                'not_found_in_trash' => __( 'No Product Attachment found in Trash.', 'products-attachments-for-woocommerce' )
            );

            $args = array(
                'labels'             => $labels,
                'description'        => __( 'Description', 'products-attachments-for-woocommerce' ),
                'public'             => false,
                'publicly_queryable' => false,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => $slug ),
                'capability_type'    => 'post',
                'has_archive'        => true,
                'hierarchical'       => false,
                'menu_position'      => null,
                'supports'           => array( 'title', 'thumbnail' ),
                'menu_icon'          => 'dashicons-text-page'
            );
            register_post_type( $post_type, $args );
        }

        function PAFW_add_meta_box() {
            add_meta_box(
                'pafw_metabox',
                __( 'All Product Attachment Options', 'products-attachments-for-woocommerce' ),
                array($this, 'pafw_metabox_call_back'),
                'product_attachment',
                'normal'
            );
        }

        function pafw_metabox_call_back(){
        	$post_id = get_the_ID();
        	?>
        	<div class="attachment_setting">
                <table class="data_table">
                	<tbody>
                        <tr class="pafw_table_inner_tr">
                            <th>
                                <label>Status</label>
                            </th>
                            <td>
                            	<?php
                            		$psfw_attachment_status = get_post_meta( $post_id, 'psfw_attachment_status', true);
                            	?>
                                <select name="psfw_attachment_status" class="regular-text" >
                                	<option value="enable" <?php if($psfw_attachment_status == 'enable'){echo "selected";}?>>Enable</option>
                                	<option value="disable" <?php if($psfw_attachment_status == 'disable'){echo "selected";}?>>Disable</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="pafw_table_inner_tr">
                            <th>
                                <label>Description</label>
                            </th>
                            <td>
                            	<?php
                            	$pafw_attachment_discription = get_post_meta( $post_id, 'pafw_attachment_discription', true);
                            	?>
                                <textarea name="pafw_attachment_discription" class="regular-text" rows="6" cols="80"><?php echo $pafw_attachment_discription;?></textarea>
                            </td>
                        </tr>
                        <tr class="pafw_table_inner_tr">
                            <th>
                                <label>Upload Attachment File</label>
                            </th>
                            <td>
                            	<?php
                            		$pafw_shop_imagelogo_id = get_post_meta( $post_id, 'pafw_shop_imagelogo', true);
			                        $pafw_shop_image_logo = wp_get_attachment_url( $pafw_shop_imagelogo_id, 'full' );
                            	?>
                            	<div class="pafw_upload_image_main">
                            		<a href="#" class="pafw_upload_image_button button">Set Attachment</a>
                            		<a href="#" class="pafw_remove_image_button button">Remove Attachment</a>
                            		<input type="hidden" name="pafw_shop_imagelogo" id="pafw_shop_imagelogo" value="" />
								</div>
								<input type="text" name="pafw_pdf_logo_prvw_image" class="pafw_pdf_logo_prvw_image regular-text" value="<?php echo $pafw_shop_image_logo;?>" readonly>
								<input type="hidden" name="pafw_shop_imagelogo" class="pafw_pdf_logo_hidden_img" value="<?php echo $pafw_shop_imagelogo_id;?>">
                            </td>
                        </tr>
                        <tr class="pafw_table_inner_tr">
                            <th>
                                <label>Attachment Visibility Pages</label>
                            </th>
                            <td>
                            	<?php
                            		$pafw_attachment_visibility_pages = get_post_meta( $post_id, 'pafw_attachment_visibility_pages', true);
                            	?>
                            	<select name="pafw_attachment_visibility_pages" class="regular-text" >
                            		<option value="order_details_page" <?php if($pafw_attachment_visibility_pages == 'order_details_page'){echo "selected";}?>>Order Details Page</option>
                            		<option value="product_details_page" <?php if($pafw_attachment_visibility_pages == 'product_details_page'){echo "selected";}?>>Product Details Page</option>
                            		<option value="both_pages" <?php if($pafw_attachment_visibility_pages == 'both_pages'){echo "selected";}?>>Both</option>
                            	</select>
                            </td>
                        </tr>
                        <tr class="pafw_table_inner_tr">
                            <th>
                                <label>Show only for logged in users</label>
                            </th>
                            <td>
                            	<?php
                            	$pafw_show_only_for_logged_in_users = get_post_meta( $post_id, 'pafw_show_only_for_logged_in_users', true);
                            	?>
                            	<select name="pafw_show_only_for_logged_in_users" class="regular-text" >
                            		<option value="yes" <?php if($pafw_show_only_for_logged_in_users == 'yes'){echo "selected";}?>>Yes</option>
                            		<option value="no" <?php if($pafw_show_only_for_logged_in_users == 'no'){echo "selected";}?>>No</option>
                            	</select>
                            </td>
                        </tr>
                        <tr class="pafw_table_inner_tr">
                            <th>
                                <label>Attcahment Download Or View</label>
                            </th>
                            <td>
                            	<?php
                            	$pafw_attch_down_or_view = get_post_meta( $post_id, 'pafw_attch_down_or_view', true);
                            	?>
                            	<select name="pafw_attch_down_or_view" class="regular-text" >
                            		<option value="download_only" <?php if($pafw_attch_down_or_view == 'download_only'){echo "selected";}?>>Download</option>
                            		<option value="view_only" <?php if($pafw_attch_down_or_view == 'view_only'){echo "selected";}?>>Only View</option>
                            	</select>
                            </td>
                        </tr>
                        <tr class="pafw_table_inner_tr">
                        	<th>
                        		<label>Select Products</label>
                        	</th>
                        	<td>
                        		<select id="pafw_select_product" name="pafw_select2[]" multiple="multiple" style="width:100%;max-width:15em;">
                                    <?php 
                                        $productsa = get_post_meta( $post_id, 'pafw_select2', true);
                                        foreach ($productsa as $value) {
                                            $productc = wc_get_product( $value );
                                            if ( $productc && $productc->is_in_stock() && $productc->is_purchasable() ) {
                                                $title = $productc->get_name();
                                                ?>
                                                    <option value="<?php echo $value; ?>" selected="selected"><?php echo $title; ?></option>
                                                <?php   
                                            }
                                        }
                                    ?>
                               </select>
                               <p class="pafw_discription"><strong>Note</strong> : Select any product for showing attachment on a single product page & this select box is empty then this attachment is not shown anywhere.</p>
                        	</td>
                        </tr>
                        <tr class="pafw_table_inner_tr">
                            <th>
                                <label>Show Attachments Expire Date</label>
                            </th>
                            <td>
                            	<?php
                            	$pafw_show_attach_expire_date = get_post_meta( $post_id, 'pafw_show_attach_expire_date', true);
                            	?>
                                <input type="radio" name="pafw_show_attach_expire_date" class="pafw_show_attach_expire" value="yes" <?php if($pafw_show_attach_expire_date == 'yes'){echo "checked";}?>>
                                <span>Yes</span>
                                <input type="radio" name="pafw_show_attach_expire_date" class="pafw_show_attach_expire" value="no" <?php if($pafw_show_attach_expire_date == 'no'){echo "checked";}?>>
                                <span>No</span>
                            </td>
                        </tr>
                        <tr class="pafw_table_inner_tr pafw_date_section_hide_show">
                            <th>
                                <label>Set Expire date/time</label>
                            </th>
                            <td>
                            	<?php
                            	$pafw_set_expire_date_and_time = get_post_meta( $post_id, 'pafw_set_expire_date_and_time', true);
                            	?>
                            	<select id="pafw_date_option" class="regular-text" name="pafw_set_expire_date_and_time">
                            		<option value="no" <?php if($pafw_set_expire_date_and_time == 'no'){echo "selected";}?>>No</option>
                            		<option value="specific_date" <?php if($pafw_set_expire_date_and_time == 'specific_date'){echo "selected";}?>>Specific Date</option>
                            	</select>
                            </td>
                        </tr>
                        <tr class="pafw_table_inner_tr pafw_date_section_hide_show" id="pafw_date_hide_show">
                            <th>
                                <label>Specific Date</label>
                            </th>
                            <td>
                            	<?php
                            	$pafw_specific_date = get_post_meta( $post_id, 'pafw_specific_date', true);
                            	?>
                            	<input type="text" class="regular-text custom_css_date" readonly name="pafw_specific_date" id="datepicker" value="<?php echo $pafw_specific_date;?>">
                            </td>
                        </tr>
                        
                	</tbody>
                </table>
        	</div>
        	<?php
        }

        function PAFW_meta_save( $post_id, $post ) {
         
	         // print_r($_REQUEST);
	         // exit;
            if ($post->post_type != 'product_attachment') { return; }
         
            if ( !current_user_can( 'edit_post', $post_id )) return;
            $is_autosave = wp_is_post_autosave($post_id);
            $is_revision = wp_is_post_revision($post_id);
            $is_valid_nonce = (isset($_POST['pafw_meta_save_nounce']) && wp_verify_nonce( $_POST['pafw_meta_save_nounce'], 'pafw_meta_save' )? 'true': 'false');

            if ( $is_autosave || $is_revision || !$is_valid_nonce ) return;

            $psfw_attachment_status             = sanitize_text_field( $_REQUEST['psfw_attachment_status'] );
            $pafw_attachment_discription        = sanitize_text_field( $_REQUEST['pafw_attachment_discription'] );
            $pafw_shop_imagelogo      		    = sanitize_text_field( $_REQUEST['pafw_shop_imagelogo'] );
            $pafw_attachment_visibility_pages   = sanitize_text_field( $_REQUEST['pafw_attachment_visibility_pages'] );
            $pafw_show_only_for_logged_in_users = sanitize_text_field( $_REQUEST['pafw_show_only_for_logged_in_users'] );
            $pafw_attch_down_or_view			= sanitize_text_field( $_REQUEST['pafw_attch_down_or_view'] );
            $pafw_show_attach_expire_date       = sanitize_text_field( $_REQUEST['pafw_show_attach_expire_date'] );
            $pafw_set_expire_date_and_time      = sanitize_text_field( $_REQUEST['pafw_set_expire_date_and_time'] );
            $pafw_specific_date                 = sanitize_text_field( $_REQUEST['pafw_specific_date'] );            

            update_post_meta( $post_id,'psfw_attachment_status', $psfw_attachment_status );
            update_post_meta( $post_id,'pafw_attachment_discription', $pafw_attachment_discription );
            update_post_meta( $post_id,'pafw_shop_imagelogo', $pafw_shop_imagelogo );
            update_post_meta( $post_id,'pafw_attachment_visibility_pages', $pafw_attachment_visibility_pages );
            update_post_meta( $post_id,'pafw_show_only_for_logged_in_users', $pafw_show_only_for_logged_in_users );
            update_post_meta( $post_id,'pafw_attch_down_or_view', $pafw_attch_down_or_view );
            update_post_meta( $post_id,'pafw_show_attach_expire_date', $pafw_show_attach_expire_date );
            update_post_meta( $post_id,'pafw_set_expire_date_and_time', $pafw_set_expire_date_and_time );
            update_post_meta( $post_id,'pafw_specific_date', $pafw_specific_date );
			$pafw_select2 = $this->PAFW_recursive_sanitize_text_field($_REQUEST['pafw_select2'] );
            update_post_meta($post_id,'pafw_select2', $pafw_select2);
           
        }


	    function pafw_product_ajax() {
          
            $return = array();
            $post_types = array( 'product','product_variation');

            $search_results = new WP_Query( array( 
                's'=> sanitize_text_field($_GET['q']),
                'post_status' => 'publish',
                'post_type' => $post_types,
                'posts_per_page' => -1,
                 'post_parent' => 0,
                'meta_query' => array(
                    array(
                        'key' => '_stock_status',
                        'value' => 'instock',
                        'compare' => '=',
                    )
                )
            ));
             
            if( $search_results->have_posts() ) {
               	while( $search_results->have_posts() ) { $search_results->the_post();   
                  	$productc = wc_get_product( $search_results->post->ID );
                  	if ( $productc && $productc->is_in_stock() && $productc->is_purchasable() ) {
						$title = $search_results->post->post_title;
						$price = $productc->get_price_html();
						$return[] = array( $search_results->post->ID, $title, $price);   
                  	}
               	}
           	}
            echo json_encode( $return );
            die;
        }
		
        function init() {
        	global $pafw_comman;
        	add_action( 'init', array($this, 'PAFW_create_post_type'));
            add_action( 'add_meta_boxes', array($this, 'PAFW_add_meta_box'));
			add_action( 'edit_post', array($this, 'PAFW_meta_save'), 10, 2);
            add_action( 'wp_ajax_nopriv_pafw_roles_ajax',array($this, 'pafw_role_ajax') );
            add_action( 'wp_ajax_pafw_roles_ajax', array($this, 'pafw_role_ajax') );
            add_action( 'wp_ajax_nopriv_pafw_order_status_ajax',array($this, 'pafw_order_status_ajax') );
            add_action( 'wp_ajax_pafw_order_status_ajax', array($this, 'pafw_order_status_ajax') );
        	add_action( 'admin_menu',  array($this, 'PAFW_submenu_page'));
        	add_action( 'init',  array($this, 'PAFW_save_option'));
            add_action( 'wp_ajax_nopriv_pafw_product_ajax',array($this, 'pafw_product_ajax') );
            add_action( 'wp_ajax_pafw_product_ajax', array($this, 'pafw_product_ajax') );
        	if ($pafw_comman['pafw_show_attach_on_orders_detail_page'] == 'enable') {
	        	add_action( 'add_meta_boxes', array($this,'pafw_mv_add_meta_boxes') );
		    }elseif ($pafw_comman['pafw_show_attach_on_orders_detail_page'] == 'disable') {
            	echo "";
            }
        }		

        public static function PAFW_instance() {
            if (!isset(self::$PAFW_instance)) {
                self::$PAFW_instance = new self();
                self::$PAFW_instance->init();
            }
            return self::$PAFW_instance;
        }
    }
    PAFW_admin_menu::PAFW_instance();
}

?>