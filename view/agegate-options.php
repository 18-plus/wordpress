<div class="wrap">
    <h1 class="wp-heading-inline">
        <?php _e('AgeGate Options', 'agegate'); ?>
    </h1>
	
    <hr class="wp-header-end">
    
    <div class="content">
        <form method="post" id="agegateform">
            <div>
                <h2><?php _e('Genaral', 'agegate'); ?></h2>
                
                <div class="form-group">
                    <label class="label" for="agegate_on_off_plugin"><?php _e('On/Off plugin', 'agegate'); ?></label>
                    
                    <label class="switch label_for">
                        <input type="checkbox" id="agegate_on_off_plugin" value="1" name="agegate_on_off_plugin" <?=(get_option('agegate_on_off_plugin') ? 'checked' : '');?>>
                        <span class="slider round"></span>                        
                    </label>
                </div>
            </div>
            
            <div>
                <h2><?php _e('Styling', 'agegate'); ?></h2>
                
                <?php include('agegate-styling.php'); ?>
            <div>
            
            <div>
                <h2><?php _e('Testing', 'agegate'); ?></h2>
                <div class="form-group">
                    <label class="label" for="agegate_test_mode"><?php _e('Test mode', 'agegate'); ?></label>
                    
                    <label class="switch label_for">
                        <input type="checkbox" name="agegate_test_mode" id="agegate_test_mode" <?=(get_option('agegate_test_mode') ? 'checked' : '');?>>
                        <span class="slider round"></span>                        
                    </label>
                </div>
            
                <div class="form-group">
                    <label class="label" for="agegate_test_anyip"><?php _e('Any ip', 'agegate'); ?></label>
                    
                    <label class="switch label_for">
                        <input type="checkbox" name="agegate_test_anyip" id="agegate_test_anyip" <?=(get_option('agegate_test_anyip') ? 'checked' : '');?>>
                        <span class="slider round"></span>                        
                    </label>
                </div>
                
                <div class="row">
                    <div class="col-lg-6 col-md-7 order-md-1">
                        <div class="mb-3">
                            <label for="agegate_test_ip"><?php _e('Test ip', 'agegate') ?></label>
                            <input type="text" class="form-control" id="agegate_test_ip" maxlength="300" name="agegate_test_ip" value="<?php echo get_option('agegate_custom_text'); ?>">
                            <small><?php _e('Current ip:', 'agegate'); ?> <?php echo $ip; ?></small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div>
                <h2><?php _e('Advanced', 'agegate'); ?></h2>
                <div class="row">
                    <div class="col-lg-6 col-md-7 order-md-1">
                        <div class="mb-3">
                            <label for="agegate_start_from"><?php _e('Start from', 'agegate') ?></label>
                            <input type="text" class="form-control" id="datetimepicker" maxlength="50" name="agegate_start_from" value="<?php echo get_option('agegate_start_from'); ?>">
                            <small><?php _e('Default starts from 15.07.2019 12AM', 'agegate'); ?></small>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <?php if ($warning): ?>
                    <div class="col-lg-12 col-md-12 order-md-1">
                        <div class="alert alert-warning"><?php _e("Server session lifetime ({$sessionLifeTime} hours) is too short for selected values"); ?></div>
                    </div>
                    <?php endif; ?>
                    
                    <div class="col-lg-6 col-md-6 order-md-1">
                        <div class="mb-3">
                            <label for="agegate_desktop_session_lifetime"><?php _e('Desktop Session Lifetime', 'agegate') ?></label>
                            <input type="number" class="form-control" min="1" max="24" id="agegate_desktop_session_lifetime" name="agegate_desktop_session_lifetime" value="<?php echo get_option('agegate_desktop_session_lifetime'); ?>">
                            <small><?php _e('Default 24 hours', 'agegate'); ?></small>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 order-md-1">
                        <div class="mb-3">
                            <label for="agegate_mobile_session_lifetime"><?php _e('Mobile Session Lifetime', 'agegate') ?></label>
                            <input type="number" class="form-control" min="1" max="240" id="agegate_mobile_session_lifetime" name="agegate_mobile_session_lifetime" value="<?php echo get_option('agegate_mobile_session_lifetime'); ?>">
                            <small><?php _e('Default 24 hours', 'agegate'); ?></small>
                        </div>
                    </div>
                </div>
            </div>
            
            <p class="submit">
                <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('Save changes', 'agegate'); ?>">
            </p>
        </form>
    </div>

</div>

<script>
(function() {
    
    new AgeGateForm();
    
    textChange();
    
    jQuery('#datetimepicker').datetimepicker({
        format: 'Y-m-d H:i'
    });
    
})();

function AgeGateForm() {
    this.form = jQuery('#agegateform');
    
    this.test_mode = jQuery('[name="agegate_test_mode"]');
    this.test_anyip = jQuery('[name="agegate_test_anyip"]');
    this.test_ip = jQuery('[name="agegate_test_ip"]');
    
    this.enableInputs = function() {
        this.test_anyip.prop('disabled', !this.test_mode.is(':checked'));
        this.test_ip.prop('disabled', !this.test_mode.is(':checked'));
        
        this.test_ip.prop('disabled', this.test_anyip.is(':checked'));
    }
    
    this.test_mode.on('click', () => {this.enableInputs()});
    this.test_anyip.on('click', () => {this.enableInputs()});
    this.enableInputs();
}
</script>

