<?php
/*
Plugin Name: 18+ Age Gateway
Description: Integrate a UK compliant age verification tool to ensure your UK based visitors confirm they are aged 18+ in a secure and anonymous way.
Author: 18+
Version: 1.2.3
*/

namespace EighteenPlus\AgeGatewayWordpress;

use EighteenPlus\AgeGateway\AgeGateway;
use EighteenPlus\AgeGateway\Utils;

class AgeGatewayWordpress
{
    public function __construct()
    {
        add_action('init', array($this, 'run'));
        add_action('admin_notices', array($this, 'ageGatewayAdminNotices'));
        add_action('admin_menu', array($this, 'ageGatewayMenu'));
        
        add_action('admin_enqueue_scripts', array($this, 'load_wp_media_files'));
        add_action('wp_ajax_agegateway_get_image', array($this,'agegateway_get_image'));
        
        register_activation_hook( __FILE__, array( $this, 'activate' ) );
        register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
    }
    
    public function activate()
    {
        add_option('agegateway_desktop_session_lifetime', array(
            'd' => 0,
            'h' => 1,
            'm' => 0,
        ));
        add_option('agegateway_mobile_session_lifetime', array(
            'd' => 0,
            'h' => 2,
            'm' => 0,
        ));
        
        add_option('agegateway_show_agegateway_logo', true);
        add_option('agegateway_show_background_image', true);
    }
    
    public function deactivate()
    {
        delete_option('agegateway_test_mode');
        delete_option('agegateway_test_anyip');
        delete_option('agegateway_test_ip');
        delete_option('agegateway_desktop_session_lifetime');
        delete_option('agegateway_mobile_session_lifetime');
        delete_option('agegateway_show_agegateway_logo');
        delete_option('agegateway_show_background_image');
    }
    
    public function run()
    {
        if (!file_exists(__DIR__ . '/vendor')) {
            return;
        }
        
        include __DIR__ . '/vendor/autoload.php';
        
        // Start AgeGateway only if not admin and not login page
        if (!is_admin() && !strpos($_SERVER['REQUEST_URI'], 'wp-login.php') && !current_user_can('administrator')) {
            $logo = wp_get_attachment_image_url( get_option('agegateway_site_logo'), 'thumbnail');
            
            if (get_option('agegateway_on_off_plugin')) {
                $gate = new AgeGateway(get_site_url());
                $gate->setTitle(get_option('agegateway_title'));
                $gate->setLogo($logo);
                
                $gate->setShowAgeGatewayLogo(get_option('agegateway_show_agegateway_logo'));
                $gate->setShowBackgroundImage(get_option('agegateway_show_background_image'));
                
                $gate->setSiteName(get_option('agegateway_site_name'));
                $gate->setCustomText(get_option('agegateway_custom_text'));
                $gate->setCustomLocation(get_option('agegateway_custom_text_location'));
                
                $gate->setBackgroundColor(get_option('agegateway_background_color'));
                $gate->setTextColor(get_option('agegateway_text_color'));
                
                $gate->setRemoveReference(get_option('agegateway_remove_reference'));
                $gate->setRemoveVisiting(get_option('agegateway_remove_visiting'));
                
                $gate->setTestMode(get_option('agegateway_test_mode'));
                $gate->setTestAnyIp(get_option('agegateway_test_anyip'));
                $gate->setTestIp(get_option('agegateway_test_ip'));
                
                $gate->setStartFrom(get_option('agegateway_start_from'));
                
                $desktop = Utils::toHours(get_option('agegateway_desktop_session_lifetime'));
                $mobile = Utils::toHours(get_option('agegateway_mobile_session_lifetime'));
                $gate->setDesktopSessionLifetime($desktop);
                $gate->setMobileSessionLifetime($mobile);
                
                $gate->run();
            }
        }
    }
    
    public function ageGatewayAdminNotices()
    {
        if (!file_exists(__DIR__ . '/vendor')) {
            echo '<div class="notice notice-warning">
                <p>You have to run "composer install" command in plugin/agegatewaywordpress directory</p>
            </div>';
        }
    }
    
    public function ageGatewayMenu() 
    {
        add_plugins_page('18+ Age Gateway', '18+ Age Gateway', 'manage_options', 'edit-agegateway-options', array($this, 'ageGatewayOptionsEdit'));
    }
    
    public function load_wp_media_files($page)
    {
        if ($page == 'plugins_page_edit-agegateway-options') {
            // Enqueue WordPress media scripts
            wp_enqueue_media();
            // Enqueue custom script that will interact with wp.media
            wp_enqueue_script('agegateway_script', plugins_url( '/js/agegateway.js' , __FILE__ ), array('jquery'), '0.1');
            
            wp_enqueue_script('datetimepicker', plugins_url( '/js/jquery.datetimepicker.full.min.js' , __FILE__ ), array('jquery'), '0.1');
            wp_enqueue_style('datetimepicker_css', plugins_url( '/css/jquery.datetimepicker.min.css' , __FILE__ ));
            
            wp_enqueue_script('bootstrap', plugins_url( '/js/bootstrap.bundle.min.js', __FILE__ ), array('jquery'), '0.1');
            wp_enqueue_script('bootstrap_colorpicker', plugins_url( '/js/bootstrap-colorpicker.js' , __FILE__ ), array('jquery', 'bootstrap'), '0.1');
            wp_enqueue_style('bootstrap_css', plugins_url('/css/bootstrap.min.css' , __FILE__ ));
            wp_enqueue_style('bootstrap_colorpicker_css', plugins_url( '/css/bootstrap-colorpicker.css' , __FILE__ ));
            
            wp_enqueue_style('agegatestyle', plugins_url( '/css/style.css' , __FILE__ ));
        }
    }
    
    public function agegateway_get_image() 
    {
        if (isset($_GET['id'])) {
            $image = wp_get_attachment_image( filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT ), 'thumbnail', false, array( 'id' => 'agegateway-preview-image' ) );
            $image_url = wp_get_attachment_image_url( filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT ), 'thumbnail');
            if (!$image) {                
                wp_send_json_error();
            }
            
            wp_send_json_success(array(
                'image' => $image,
                'image_url' => $image_url,
            ));
        } else {
            wp_send_json_error();
        }
    }
    
    public function ageGatewayOptionsEdit()
    {
        $ip = Utils::getClientIp();
        
        if ($_POST) {
            update_option('agegateway_on_off_plugin', (bool)$_POST['agegateway_on_off_plugin']);
            
            update_option('agegateway_title', sanitize_text_field(stripslashes($_POST['agegateway_title'])));
            update_option('agegateway_site_logo', intval($_POST['agegateway_site_logo']));
            
            update_option('agegateway_show_agegateway_logo', (bool)$_POST['agegateway_show_agegateway_logo']);
            update_option('agegateway_show_background_image', (bool)$_POST['agegateway_show_background_image']);
            
            update_option('agegateway_site_name', sanitize_text_field(stripslashes($_POST['agegateway_site_name'])));
            update_option('agegateway_custom_text', sanitize_text_field(stripslashes($_POST['agegateway_custom_text'])));
            update_option('agegateway_custom_text_location', sanitize_text_field($_POST['agegateway_custom_text_location']));
            
            update_option('agegateway_background_color', sanitize_hex_color($_POST['agegateway_background_color']));
            update_option('agegateway_text_color', sanitize_hex_color($_POST['agegateway_text_color']));
            
            update_option('agegateway_remove_reference', (bool)$_POST['agegateway_remove_reference']);
            update_option('agegateway_remove_visiting', (bool)$_POST['agegateway_remove_visiting']);
            
            update_option('agegateway_test_mode', (bool)$_POST['agegateway_test_mode']);
            update_option('agegateway_test_anyip', (bool)$_POST['agegateway_test_anyip']);
            
            $ip = $_POST['agegateway_test_ip'];
            $ip = filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
            update_option('agegateway_test_ip', $ip);
            
            $agegateway_start_from = sanitize_text_field($_POST['agegateway_start_from']);
            if ($this->checkDate($agegateway_start_from)) {
                update_option('agegateway_start_from', $agegateway_start_from);
            } else {                
                update_option('agegateway_start_from', '2019-07-15 12:00');
            }
            
            $desktopMaxTime = 2;
            $agegateway_desktop_session_lifetime = array_map('intval', $_POST['agegateway_desktop_session_lifetime']);
            $desktopTime = Utils::toHours($agegateway_desktop_session_lifetime);
            if ($desktopTime > $desktopMaxTime * 24) {
                update_option('agegateway_desktop_session_lifetime', array('d' => $desktopMaxTime, 'h' => 0, 'm' => 0));
            } else {                
                update_option('agegateway_desktop_session_lifetime', $agegateway_desktop_session_lifetime);
            }
            
            $mobileMaxTime = 7;
            $agegateway_mobile_session_lifetime = array_map('intval', $_POST['agegateway_mobile_session_lifetime']);
            $mobileTime = Utils::toHours($agegateway_mobile_session_lifetime);
            if ($mobileTime > $mobileMaxTime * 24) {
                update_option('agegateway_mobile_session_lifetime', array('d' => $mobileMaxTime, 'h' => 0, 'm' => 0));
            } else {                
                update_option('agegateway_mobile_session_lifetime', $agegateway_mobile_session_lifetime);
            }
        }
        
        $desktop = Utils::toHours(get_option('agegateway_desktop_session_lifetime'));
        $mobile = Utils::toHours(get_option('agegateway_mobile_session_lifetime'));
        
        $sessionLifeTime = ini_get("session.gc_maxlifetime") / 3600;
        if ($sessionLifeTime < $desktop || $sessionLifeTime < $mobile) {
            $warning = true;
        } else {
            $warning = false;
        }
        
        require __DIR__ . '/view/agegateway-options.php';
    }
    
    protected function checkDate($date, $format = 'Y-m-d H:i') 
    {
        return \DateTime::createFromFormat($format, $date) !== false;
    }
}

new AgeGatewayWordpress();
