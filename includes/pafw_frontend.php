<?php

if (!defined('ABSPATH'))
  exit;

if (!class_exists('PAFW_frontend_menu')) {

    class PAFW_frontend_menu {

        protected static $PAFW_front_instance;
        
        function pafw_woo_custom_product_tabs( $tabs ) {
            global $pafw_comman;

            if($pafw_comman['pafw_set_product_attachment_tab_default_selected'] == 'yes'){
                $tab_priority = 1;
            } elseif($pafw_comman['pafw_set_product_attachment_tab_default_selected'] == 'no') {
                $tab_priority = 100;
            }
            $args = array(  
                'post_type' => 'product_attachment',
                'post_status' => 'publish',
                'posts_per_page' => -1, 
                'orderby' => 'date', 
                'order' => 'ASC', 
            );

            $posts = new WP_Query( $args ); 
            foreach ($posts->posts as $key => $value) {
                $productsa = get_post_meta( $value->ID, 'pafw_select2', true);
                
                if (!empty($productsa) && in_array(get_the_ID(), $productsa)) {
                    $pafw_show_only_for_logged_in_users = get_post_meta($value->ID,'pafw_show_only_for_logged_in_users', true);
                    if ( $pafw_show_only_for_logged_in_users == 'yes' && is_user_logged_in()){
                        $tab_prioritye = apply_filters( 'attrib_desc_tab_priority_no', $tab_priority );
                        $tabs['attrib_desc_tab'] = array(
                            'title'     => __( $pafw_comman['pafw_frontend_product_page_tab_title'], 'woocommerce' ),
                            'priority'  => $tab_prioritye,
                            'callback'  => array($this,'woo_attachment_details')
                        );
                    }
              
                }
               
            }
            return $tabs;
        }

        function woo_attachment_details() {
            global $pafw_comman;
            ?>
            <h2 class="pafw_attachment_head_on_order_page">
                <?php echo $pafw_comman['pafw_frontend_product_page_tab_title'];?>
            </h2>
            <?php
            $args = array(  
                'post_type' => 'product_attachment',
                'post_status' => 'publish',
                'posts_per_page' => -1, 
                'orderby' => 'date', 
                'order' => 'ASC', 
            );
            $posts = new WP_Query( $args ); 
            

            foreach ($posts->posts as $key => $value) {
                $productsa = get_post_meta( $value->ID, 'pafw_select2', true);
              
                if (!empty($productsa) && in_array(get_the_ID(), $productsa)) {
                    $psfw_attachment_status = get_post_meta( $value->ID, 'psfw_attachment_status', true);
                    $pafw_attachment_visibility_pages = get_post_meta( $value->ID, 'pafw_attachment_visibility_pages', true);
                    $pafw_show_only_for_logged_in_users = get_post_meta($value->ID,'pafw_show_only_for_logged_in_users',true);
                    $pafw_shop_imagelogo_id = get_post_meta( $value->ID, 'pafw_shop_imagelogo', true);
                    $pafw_shop_image_logo = wp_get_attachment_url( $pafw_shop_imagelogo_id, 'full' );
                    $pafw_specific_date = get_post_meta( $value->ID, 'pafw_specific_date', true);
                    $currentDateTime = strtotime(date('Y-m-d'));
                    $expire_date = strtotime($pafw_specific_date);

                    $pafw_attch_down_or_view = get_post_meta( $value->ID, 'pafw_attch_down_or_view', true);
                    if ($pafw_attch_down_or_view == 'download_only') {
                        $down_or_view = 'download';
                        $dv_button = '<i class="fa fa-download"></i>'.$pafw_comman['pafw_download_view_button'];
                    }elseif ($pafw_attch_down_or_view == 'view_only') {
                        $down_or_view = 'target="_blank"';
                        $dv_button = '<i class="fa fa-eye" aria-hidden="true"></i>'.$pafw_comman['pafw_pdf_view_button'];
                    }
                    if ($pafw_attachment_visibility_pages == 'product_details_page' || $pafw_attachment_visibility_pages == 'both_pages') {
                        if ($psfw_attachment_status == 'enable') {
                            $pafw_set_expire_date_and_time = get_post_meta( $value->ID, 'pafw_set_expire_date_and_time', true);
                            $pafw_show_attach_expire_date = get_post_meta( $value->ID, 'pafw_show_attach_expire_date', true);
                                        
                            if($pafw_set_expire_date_and_time == 'specific_date' && $pafw_show_attach_expire_date == 'yes'){
                                if (!empty($pafw_shop_image_logo) && $currentDateTime > $expire_date) {
                                    $date = '* This Attachment Expired.';
                                    $download_button = '<a class="pafw_expire button" style="color:'.$pafw_comman['pdfdownloadtextcolor'].';background:'.$pafw_comman['pdfdownloadbackcolor'].'; font-size:'.$pafw_comman['pafw_title_text_size'].'px">'.$dv_button.'</a>';
                                }elseif(!empty($pafw_shop_image_logo) && $currentDateTime <= $expire_date){
                                    $date = '* This Attachment Expiry Date : '.$pafw_specific_date;
                                    $download_button = '<a class="pafw_attachmentbtn button" style="color:'.$pafw_comman['pdfdownloadtextcolor'].';background:'.$pafw_comman['pdfdownloadbackcolor'].';font-size:'.$pafw_comman['pafw_title_text_size'].'px"   href="' . $pafw_shop_image_logo .'"  '.$down_or_view.'>'.$dv_button.'</a>';               
                                }elseif ( empty($pafw_shop_image_logo) ) {
                                    $date = '* Attachment Is Not Set.';
                                    $download_button = '';
                                }else{
                                    $date = '* Attachment Is Not Set.';
                                    $download_button = '';
                                }
                            }elseif($pafw_set_expire_date_and_time == 'no' && $pafw_show_attach_expire_date == 'yes'){
                                if ( !empty($pafw_shop_image_logo) ) {
                                    $date = 'This attachment is not expire any time.';
                                    $download_button = '<a class="pafw_attachmentbtn button" style="color:'.$pafw_comman['pdfdownloadtextcolor'].';background:'.$pafw_comman['pdfdownloadbackcolor'].';font-size:'.$pafw_comman['pafw_title_text_size'].'px"    href="' . $pafw_shop_image_logo .'"  '.$down_or_view.'>'.$dv_button.'</a>';
                                }elseif ( empty($pafw_shop_image_logo) ) {
                                    $date = '* Attachment Is Not Set.';
                                    $download_button = '';
                                }
                            }else{
                                if ( !empty($pafw_shop_image_logo) ) {
                                    $date = '';
                                    $download_button = '<a class="pafw_attachmentbtn button" style="color:'.$pafw_comman['pdfdownloadtextcolor'].';background:'.$pafw_comman['pdfdownloadbackcolor'].';font-size:'.$pafw_comman['pafw_title_text_size'].'px"    href="' . $pafw_shop_image_logo .'"  '.$down_or_view.'>'.$dv_button.'</a>';
                                }elseif ( empty($pafw_shop_image_logo) ) {
                                    $date = '* Attachment Is Not Set.';
                                    $download_button = '';
                                }
                            }
                            ?>

                            <div class="pafw_attachment">
                                <h3 class="pafw_attachment_name" style="color:<?php  echo  $pafw_comman['pdfdownloadtextcolor'];?>">
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
                                    echo __($pafw_attachment_discription , 'products-attachments-for-woocommerce'); ?>                    
                                </p>
                            </div>
                            <?php
                        }
                    }
                }
            }
        }

        function pafw_attachment_order_details_page($order_id) {
            $this->PAFW_order_page_callback($order_id);
        }

        function my_custom_tracking( $order_id ){
            $this->PAFW_order_page_callback($order_id);
        }


        function PAFW_order_page_callback($order_id){
            global $pafw_comman;
            $order = new WC_Order( $order_id );
            $order_status = get_option('pafw_order_status_select');
            $status = array();
            if (!empty($order_status)) {
                foreach ($order_status as $key => $value) {
                    $status_order = str_replace("wc-","",$value);
                    $status[] = $status_order;
                }
            }else{
               $array = wc_get_order_statuses();
               foreach ($array  as $key => $value) {
                 $status[] =  $key;           
               }
            }
            $order_in_show = false;
            if (in_array($order->get_status(),$status)) {
                $order_in_show = true;
            }elseif(empty($order_status)){
                $order_in_show = true;
            }
            if ($order_in_show == true) {
               
                ?>
                <h2 class="pafw_attachment_head_on_order_page">
                    <?php echo $pafw_comman['pafw_order_details_page_tab_title'];?>

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
                        $productsa = get_post_meta($value->ID, 'pafw_select2', true);

                        $items = $order->get_items();
                        $pro_id_array = array();
                        foreach ( $items as $item ) {
                            $pro_id_array[] = $item['product_id'];
                        }
                        $confirmation = false;
                        foreach ($pro_id_array as $key => $pro_id) {
                            if(!empty($productsa)){
                                 if (in_array($pro_id, $productsa)) {
                                    $confirmation = true;
                                }
                            }
                        }
                        if ($confirmation == true) {
                            get_option('stock_position' , 'left');
                            $psfw_attachment_status = get_post_meta( $value->ID, 'psfw_attachment_status', true);
                            $pafw_attachment_visibility_pages = get_post_meta( $value->ID, 'pafw_attachment_visibility_pages', true);
                            $pafw_show_only_for_logged_in_users = get_post_meta($value->ID,'pafw_show_only_for_logged_in_users',true);
                            $pafw_shop_imagelogo_id = get_post_meta( $value->ID, 'pafw_shop_imagelogo', true);
                            $pafw_shop_image_logo = wp_get_attachment_url( $pafw_shop_imagelogo_id, 'full' );
                            $pafw_specific_date = get_post_meta( $value->ID, 'pafw_specific_date', true);
                            $currentDateTime = strtotime(date('Y-m-d'));
                            $expire_date = strtotime($pafw_specific_date);

                            $pafw_attch_down_or_view = get_post_meta( $value->ID, 'pafw_attch_down_or_view', true);
                            if ($pafw_attch_down_or_view == 'download_only') {
                                $down_or_view = 'download';
                                $dv_button = '<i class="fa fa-download"></i>'.$pafw_comman['pafw_download_view_button'];
                            }elseif ($pafw_attch_down_or_view == 'view_only') {
                                $down_or_view = 'target="_blank"';
                                $dv_button = '<i class="fa fa-eye" aria-hidden="true"></i>'.$pafw_comman['pafw_pdf_view_button'];
                            }
                            if ($pafw_attachment_visibility_pages == 'order_details_page' || $pafw_attachment_visibility_pages == 'both_pages') {
                                if ($psfw_attachment_status == 'enable') {
                                    $pafw_set_expire_date_and_time = get_post_meta( $value->ID, 'pafw_set_expire_date_and_time', true);
                                    $pafw_show_attach_expire_date = get_post_meta( $value->ID, 'pafw_show_attach_expire_date', true);
                                    if($pafw_set_expire_date_and_time == 'specific_date' && $pafw_show_attach_expire_date == 'yes'){
                                        if ($currentDateTime > $expire_date) {
                                            $date = '* This Attachment Expired.';
                                            $download_button = '<a class="pafw_expire button" style="color:'.$pafw_comman['pdfdownloadtextcolor'].';background:'.$pafw_comman['pdfdownloadbackcolor'].';font-size:'.$pafw_comman['pafw_title_text_size'].'px">'.$dv_button.'</a>';
                                        }elseif($currentDateTime <= $expire_date){
                                            $date = '* This Attachment Expiry Date : '.$pafw_specific_date;
                                            $download_button = '<a class="pafw_attachmentbtn button" style="color:'.$pafw_comman['pdfdownloadtextcolor'].';background:'.$pafw_comman['pdfdownloadbackcolor'].';font-size:'.$pafw_comman['pafw_title_text_size'].'px" href="' . $pafw_shop_image_logo .'"  '.$down_or_view.'>'.$dv_button.'</a>';               
                                        }elseif ( !isset($pafw_shop_image_logo) ) {
                                            $date = '* Attachment Is Not Set.';
                                            $download_button = '';
                                        }else{
                                            $date = '* Attachment Is Not Set.';
                                            $download_button = '';
                                        }
                                    }elseif($pafw_set_expire_date_and_time == 'no' && $pafw_show_attach_expire_date == 'yes'){
                                        $date = "This attachment is not expire any time.";
                                        $download_button = '<a class="pafw_attachmentbtn button" style="color:'.$pafw_comman['pdfdownloadtextcolor'].';background:'.$pafw_comman['pdfdownloadbackcolor'].';font-size:'.$pafw_comman['pafw_title_text_size'].'px"   href="' . $pafw_shop_image_logo .'"  '.$down_or_view.'>'.$dv_button.'</a>';
                                    }else{
                                        $date = '';
                                        $download_button = '<a class="pafw_attachmentbtn button" style="color:'.$pafw_comman['pdfdownloadtextcolor'].';background:'.$pafw_comman['pdfdownloadbackcolor'].';font-size:'.$pafw_comman['pafw_title_text_size'].'px"  href="' . $pafw_shop_image_logo .'"  '.$down_or_view.'>'.$dv_button.'</a>';
                                    }
                                    ?>
                                    <div class="pafw_attachment">
                                        <h3 class="pafw_attachment_name" style="color:<?php  echo  $pafw_comman['pdfdownloadtextcolor'];?>">
                                            <?php echo $value->post_title;?>                    
                                        </h3>
                                        <div class="date_download_attach">
                                            <p class="order_att_expire_date">
                                                <?php echo $date;?>                   
                                            </p>
                                            <?php echo $download_button;?>
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
            }
        }


        function init() {
            global $post,$pafw_comman;
            $user = wp_get_current_user();
            $roles = $user->roles;
            $user_role1 = get_option('pafw_roles_select');

            if (!empty($user_role1) && !empty($roles) && in_array($roles['0'], $user_role1)) {
                add_filter( 'woocommerce_product_tabs', array($this,'pafw_woo_custom_product_tabs') );
                if ($pafw_comman['pafw_show_attach_on_orders_detail_page'] == 'enable') {
                    add_action( 'woocommerce_view_order', array($this,'my_custom_tracking'),1 );
                }
                 if ($pafw_comman['pafw_show_attach_in_thank_you_page'] == 'enable') {
                    add_action( 'woocommerce_thankyou', array($this,'pafw_attachment_order_details_page'),10,1 );
                 }
            }elseif (empty($user_role1)) {
                add_filter( 'woocommerce_product_tabs', array($this,'pafw_woo_custom_product_tabs') );
                if ($pafw_comman['pafw_show_attach_on_orders_detail_page'] == 'enable') {
                    add_action( 'woocommerce_view_order', array($this,'my_custom_tracking'),1 );
                }
                if ($pafw_comman['pafw_show_attach_in_thank_you_page'] == 'enable') {
                    add_action( 'woocommerce_thankyou', array($this,'pafw_attachment_order_details_page'),10,1 );
                }
            }
        }       

        public static function PAFW_front_instance() {
            if (!isset(self::$PAFW_front_instance)) {
                self::$PAFW_front_instance = new self();
                self::$PAFW_front_instance->init();
            }
            return self::$PAFW_front_instance;
        }
    }
    PAFW_frontend_menu::PAFW_front_instance();
}

?>