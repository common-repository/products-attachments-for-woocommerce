<?php
if (!defined('ABSPATH'))
  exit;

if (!class_exists('PAFW_comman')) {

    class PAFW_comman {

        protected static $instance;

        public static function instance() {
            if (!isset(self::$instance)) {
                self::$instance = new self();
                self::$instance->init();
            }
             return self::$instance;
        }
         function init() {
            global $pafw_comman;
            $optionget = array(
                'pafw_frontend_product_page_tab_title' => 'Attachments',
                'pafw_order_details_page_tab_title' => 'Spacific Attachment',
                'pafw_show_attach_on_orders_detail_page' => 'enable',
                'pafw_admin_order_details_page_tab_title' => 'Admin Attachment',
                'pafw_show_attach_in_thank_you_page' => 'enable',
                'pafw_set_product_attachment_tab_default_selected' => 'no',
                'admin_side_attachment'=>'yes',
                'pdfdownloadtextcolor'=>'#ffffff',
                'pdfdownloadbackcolor'=>'#000000',
                'pafw_pdf_view_button'=>'View',
                'pafw_download_view_button'=>'Download',
                'pdftitletextcolor'=>'#000000',
                'pafw_title_text_size'=> 19,
            );
           
            foreach ($optionget as $key_optionget => $value_optionget) {
               $pafw_comman[$key_optionget] = get_option( $key_optionget,$value_optionget );
            }
        }
    }

    PAFW_comman::instance();
}
?>