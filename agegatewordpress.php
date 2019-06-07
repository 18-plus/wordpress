<?php
/*
Plugin Name: 18+ Age Gateway
Description: Integrate a UK compliant age verification tool to ensure your UK based visitors confirm they are aged 18+ in a secure and anonymous way.
Author: 18+
Version: 1.2.1
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
        
        register_activation_hook( __FILE__, array( $this, 'install' ) );
    }
    
    public function install()
    {
        delete_option('agegate_test_mode');
        delete_option('agegate_test_anyip');
        delete_option('agegate_test_ip');
        delete_option('agegate_desktop_session_lifetime');
        delete_option('agegate_mobile_session_lifetime');
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
            
            if (get_option('agegate_on_off_plugin')) {
                $gate = new AgeGate(get_site_url());
                $gate->setTitle(get_option('agegate_title'));
                $gate->setLogo($logo);
                
                $gate->setSiteName(get_option('agegate_site_name'));
                $gate->setCustomText(get_option('agegate_custom_text'));
                $gate->setCustomLocation(get_option('agegate_custom_text_location'));
                
                $gate->setBackgroundColor(get_option('agegate_background_color'));
                $gate->setTextColor(get_option('agegate_text_color'));
                
                $gate->setRemoveReference(get_option('agegate_remove_reference'));
                $gate->setRemoveVisiting(get_option('agegate_remove_visiting'));
                
                $gate->setTestMode(get_option('agegate_test_mode'));
                $gate->setTestAnyIp(get_option('agegate_test_anyip'));
                $gate->setTestIp(get_option('agegate_test_ip'));
                
                $gate->setStartFrom(get_option('agegate_start_from'));
                
                $desktop = $this->toHours(get_option('agegate_desktop_session_lifetime'));
                $desktop = is_null($desktop) ? 1 : $desktop;
                $mobile = $this->toHours(get_option('agegate_mobile_session_lifetime'));
                $mobile = is_null($mobile) ? 2 : $mobile;
                $gate->setDesktopSessionLifetime($desktop);
                $gate->setMobileSessionLifetime($mobile);
                
                $gate->run();
            }
        }
    }
    
    private function toHours($options)
    {
        if (empty($options) || !is_array($options)) {
            return null;
        }
        
        return $options['d'] * 24 + $options['h'] + $options['m'] / 60;
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
        add_plugins_page('18+ Age Gateway', '18+ Age Gateway', 'manage_options', 'edit-agegate-options', array($this, 'ageGateOptionsEdit'));
    }
    
    public function load_wp_media_files($page)
    {
        if ($page == 'plugins_page_edit-agegate-options') {
            // Enqueue WordPress media scripts
            wp_enqueue_media();
            // Enqueue custom script that will interact with wp.media
            wp_enqueue_script('agegate_script', plugins_url( '/js/agegate.js' , __FILE__ ), array('jquery'), '0.1');
            
            wp_enqueue_script('datetimepicker', plugins_url( '/js/jquery.datetimepicker.full.min.js' , __FILE__ ), array('jquery'), '0.1');
            wp_enqueue_style('datetimepicker_css', plugins_url( '/css/jquery.datetimepicker.min.css' , __FILE__ ));
            
            wp_enqueue_script('bootstrap', '//cdn.rawgit.com/twbs/bootstrap/v4.1.3/dist/js/bootstrap.bundle.min.js', array('jquery'), '0.1');
            wp_enqueue_script('bootstrap_colorpicker', plugins_url( '/js/bootstrap-colorpicker.js' , __FILE__ ), array('jquery', 'bootstrap'), '0.1');
            wp_enqueue_style('bootstrap_css', '//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
            wp_enqueue_style('bootstrap_colorpicker_css', plugins_url( '/css/bootstrap-colorpicker.css' , __FILE__ ));
            
            wp_enqueue_style('agegatestyle', plugins_url( '/css/style.css' , __FILE__ ));
        }
    }
    
    public function agegate_get_image() 
    {
        if (isset($_GET['id'])) {
            $image = wp_get_attachment_image( filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT ), 'thumbnail', false, array( 'id' => 'agegate-preview-image' ) );
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
    
    public function ageGateOptionsEdit()
    {
        $ip = Utils::getClientIp();
        
        if ($_POST) {
            update_option('agegate_on_off_plugin', $_POST['agegate_on_off_plugin']);
            
            update_option('agegate_title', $_POST['agegate_title']);
            update_option('agegate_site_logo', $_POST['agegate_site_logo']);
            
            update_option('agegate_site_name', $_POST['agegate_site_name']);
            update_option('agegate_custom_text', $_POST['agegate_custom_text']);
            update_option('agegate_custom_text_location', $_POST['agegate_custom_text_location']);
            
            update_option('agegate_background_color', $_POST['agegate_background_color']);
            update_option('agegate_text_color', $_POST['agegate_text_color']);
            
            update_option('agegate_remove_reference', $_POST['agegate_remove_reference']);
            update_option('agegate_remove_visiting', $_POST['agegate_remove_visiting']);
            
            update_option('agegate_test_mode', $_POST['agegate_test_mode']);
            update_option('agegate_test_anyip', $_POST['agegate_test_anyip']);
            update_option('agegate_test_ip', $_POST['agegate_test_ip']);
            
            update_option('agegate_start_from', $_POST['agegate_start_from']);
            
            
            $desktopMaxTime = 2;
            $desktopTime = $this->toHours($_POST['agegate_desktop_session_lifetime']);
            if ($desktopTime > $desktopMaxTime * 24) {
                update_option('agegate_desktop_session_lifetime', array('d' => $desktopMaxTime, 'h' => 0, 'm' => 0));
            } else {                
                update_option('agegate_desktop_session_lifetime', $_POST['agegate_desktop_session_lifetime']);
            }
            
            $mobileMaxTime = 7;
            $mobileTime = $this->toHours($_POST['agegate_mobile_session_lifetime']);
            if ($mobileTime > $mobileMaxTime * 24) {
                update_option('agegate_mobile_session_lifetime', array('d' => $mobileMaxTime, 'h' => 0, 'm' => 0));
            } else {                
                update_option('agegate_mobile_session_lifetime', $_POST['agegate_mobile_session_lifetime']);
            }
        }
        
        $desktop = $this->toHours(get_option('agegate_desktop_session_lifetime'));
        $desktop = is_null($desktop) ? 1 : $desktop;
        
        $mobile = $this->toHours(get_option('agegate_mobile_session_lifetime'));
        $mobile = is_null($mobile) ? 2 : $mobile;
        
        $sessionLifeTime = ini_get("session.gc_maxlifetime") / 3600;
        if ($sessionLifeTime < $desktop || $sessionLifeTime < $mobile) {
            $warning = true;
        } else {
            $warning = false;
        }
        
        require __DIR__ . '/view/agegate-options.php';
    }
}

new AgeGateWordpress();


