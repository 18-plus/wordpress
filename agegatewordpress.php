<?php
/*
Plugin Name: agegatewordpress
Description: Integrate a UK compliant Age 18+ age verification tool to your back-end so that your UK based visitors can confirm they are age 18 or over in a secure and anonymous way.
Author: Osoro
Version: 1.0.0
*/

namespace EighteenPlus\AgeGateWordpress;

use EighteenPlus\AgeGate\AgeGate;
use EighteenPlus\AgeGate\Utils;

class AgeGateWordpress
{
    public function __construct()
    {
        add_action('init', array($this, 'run'));
        add_action('admin_notices', array($this, 'ageGateAdminNotices'));
        add_action('admin_menu', array($this, 'ageGateMenu'));
        
        add_action('admin_enqueue_scripts', array($this, 'load_wp_media_files'));
        add_action('wp_ajax_agegate_get_image', array($this,'agegate_get_image'));
    }
    
    public function run()
    {
        if (!file_exists(__DIR__ . '/vendor')) {
            return;
        }
        
        include __DIR__ . '/vendor/autoload.php';
        
        // Start AgeGate only if not admin and not login page
        if (!is_admin() && !strpos($_SERVER['REQUEST_URI'], 'wp-login.php') && !current_user_can('administrator')) {
            $logo = wp_get_attachment_image_url( get_option('agegate_site_logo'), 'thumbnail');
            
            $gate = new AgeGate(get_site_url());
            $gate->setTitle(get_option('agegate_title'));
            $gate->setLogo($logo);
            $gate->setTestIp(get_option('agegate_test_ip'));
            $gate->setStartFrom(get_option('agegate_start_from'));
            $gate->run();
        }
    }
    
    public function ageGateAdminNotices()
    {
        if (!file_exists(__DIR__ . '/vendor')) {
            echo '<div class="notice notice-warning">
                <p>You have to run "composer install" command in plugin/agegatewordpress directory</p>
            </div>';
        }
    }
    
    public function ageGateMenu() 
    {
        add_plugins_page('AgeGate', 'AgeGate', 'manage_options', 'edit-agegate-options', array($this, 'ageGateOptionsEdit'));
    }
    
    public function load_wp_media_files($page)
    {
        if ($page == 'plugins_page_edit-agegate-options') {
            // Enqueue WordPress media scripts
            wp_enqueue_media();
            // Enqueue custom script that will interact with wp.media
            wp_enqueue_script('agegate_script', plugins_url( '/js/agegate.js' , __FILE__ ), array('jquery'), '0.1');
        }
    }
    
    public function agegate_get_image() 
    {
        if (isset($_GET['id'])) {
            $image = wp_get_attachment_image( filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT ), 'thumbnail', false, array( 'id' => 'agegate-preview-image' ) );
            if (!$image) {                
                wp_send_json_error();
            }
            
            wp_send_json_success(array(
                'image' => $image,
            ));
        } else {
            wp_send_json_error();
        }
    }
    
    public function ageGateOptionsEdit()
    {
        $ip = Utils::getClientIp();
        
        if ($_POST) {
            update_option('agegate_test_ip', $_POST['agegate_test_ip']);
            update_option('agegate_title', $_POST['agegate_title']);
            update_option('agegate_site_logo', $_POST['agegate_site_logo']);
            update_option('agegate_start_from', $_POST['agegate_start_from']);
        }
        
        require __DIR__ . '/view/agegate-options.php';
    }
}

new AgeGateWordpress();


