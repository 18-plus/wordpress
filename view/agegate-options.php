<div class="wrap">
    <h1 class="wp-heading-inline">
        <?php _e('18+ Age Gateway Settings', 'agegate'); ?>
    </h1>
	
    <hr class="wp-header-end">
    
    <div class="content">
        <form method="post" id="agegateform">
            <div>
                <h2><?php _e('General', 'agegate'); ?></h2>
                
                <div class="form-group">
                    <label class="label" for="agegate_on_off_plugin"><?php _e('18+ Age Gateway On/Off', 'agegate'); ?></label>
                    
                    <label class="switch label_for">
                        <input type="checkbox" id="agegate_on_off_plugin" value="1" name="agegate_on_off_plugin" <?=(get_option('agegate_on_off_plugin') ? 'checked' : '');?>>
                        <span class="slider round"></span>                        
                    </label>
                </div>
            </div>
            
            <div>
                <h2><?php _e('Styling', 'agegate'); ?></h2>
                
                <?php include('agegate-styling.php'); ?>
            </div>
            
            <div>
                <h2><?php _e('Testing', 'agegate'); ?></h2>
                <div class="form-group">
                    <label class="label" for="agegate_test_mode"><?php _e('Testing mode', 'agegate'); ?></label>
                    
                    <label class="switch label_for">
                        <input type="checkbox" name="agegate_test_mode" id="agegate_test_mode" <?=(get_option('agegate_test_mode') ? 'checked' : '');?>>
                        <span class="slider round"></span>                        
                    </label>
                    <div><small><?php _e('Turning Testing Mode on will override the start date setting and activate the Age Gateway immediately', 'agegate'); ?></small></div>
                </div>
            
                <div class="form-group">
                    <label class="label" for="agegate_test_anyip"><?php _e('Any IP Address', 'agegate'); ?></label>
                    
                    <label class="switch label_for">
                        <input type="checkbox" name="agegate_test_anyip" id="agegate_test_anyip" <?=(get_option('agegate_test_anyip') ? 'checked' : '');?>>
                        <span class="slider round"></span>                        
                    </label>
                    <div><small><?php _e('Turning this on will show the Age Gateway in Testing Mode for all IP addresses accessing the website', 'agegate'); ?></small></div>
                </div>
                
                <div class="row">
                    <div class="col-lg-6 col-md-7 order-md-1">
                        <div class="mb-3">
                            <label for="agegate_test_ip"><?php _e('Test IP Address', 'agegate') ?></label>
                            <input type="text" class="form-control" id="agegate_test_ip" maxlength="300" name="agegate_test_ip" value="<?php echo get_option('agegate_custom_text'); ?>">
                            <small><?php _e('Current IP:', 'agegate'); ?> <?php echo $ip; ?></small>
                            <div><small><?php _e('Enter the IP address from which you want to test the Age Gateway in testing Mode. The Age Gateway will be shown only on those IP address. Note: by default, the Age Gateway when activated will only show to UK based IP addresses. Therefore, specifying a non-UK IP address here is only way to see Age Gateway from a non-UK based IP address.', 'agegate'); ?></small></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div>
                <h2><?php _e('Advanced Settings', 'agegate'); ?></h2>
                <div class="row">
                    <div class="col-lg-6 col-md-7 order-md-1">
                        <div class="mb-3">
                            <label for="agegate_start_from"><?php _e('Start from', 'agegate') ?></label>
                            <input type="text" class="form-control" id="datetimepicker" readonly maxlength="50" name="agegate_start_from" value="<?php echo get_option('agegate_start_from'); ?>">
                            <small><?php _e('When activated, the Age Gateway will be active for UK based IP address starting at Midnight on 15 July 2019. You can change the starting date here but remember the law requires age verification from 15 July 2019.', 'agegate'); ?></small>
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
                            <label for="agegate_desktop_session_lifetime"><?php _e('Desktop Session Lifetime', 'agegate') ?> </label>
                            
                            <div class="inputPicker">  
                                <input readonly class="inputPickerResult form-control">
                                <div class="inputPickerBody">
                                    <small>Max value: 2 days</small>
                                    <div class="input-group">
                                        <input type="button" value="-" class="button-minus">
                                        <input type="number" id="agegate_desktop_session_lifetime_d" class="quantity-field" name="agegate_desktop_session_lifetime[d]" value="<?php echo get_option('agegate_desktop_session_lifetime')['d']; ?>">
                                        <input type="button" value="+" class="button-plus">
                                        <span><?php _e('Days', 'agegate'); ?></span>
                                    </div>
                                
                                    <div class="input-group">
                                      <input type="button" value="-" class="button-minus">
                                      <input type="number" class="quantity-field" id="agegate_desktop_session_lifetime_h" name="agegate_desktop_session_lifetime[h]" value="<?php echo isset(get_option('agegate_desktop_session_lifetime')['h']) ? get_option('agegate_desktop_session_lifetime')['h'] : '1'; ?>">
                                      <input type="button" value="+" class="button-plus">
                                      <?php _e('Hours', 'agegate'); ?>
                                    </div>
                                
                                    <div class="input-group">
                                      <input type="button" value="-" class="button-minus">
                                      <input type="number" class="quantity-field" id="agegate_desktop_session_lifetime_m" name="agegate_desktop_session_lifetime[m]" value="<?php echo get_option('agegate_desktop_session_lifetime')['m']; ?>">
                                      <input type="button" value="+" class="button-plus">
                                      <?php _e('Minutes', 'agegate'); ?>
                                    </div>
                                </div>
                            </div>
                            <small><?php _e('The Age Gateway will trigger once per session for eah visitor. You can change the lifetime of the session. By default, the session lifetime is 1 hour for desktop and 2 hours for mobile.', 'agegate'); ?></small>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 order-md-1">
                        <div class="mb-3">
                            <label for="agegate_mobile_session_lifetime"><?php _e('Mobile Session Lifetime', 'agegate') ?> </label>
                            <div class="inputPicker">  
                                <input readonly class="inputPickerResult form-control">
                                <div class="inputPickerBody">
                                    <small>Max value: 7 days</small>
                                    <div class="input-group">
                                        <input type="button" value="-" class="button-minus">
                                        <input type="number" id="agegate_mobile_session_lifetime_d" class="quantity-field" name="agegate_mobile_session_lifetime[d]" value="<?php echo get_option('agegate_mobile_session_lifetime')['d']; ?>">
                                        <input type="button" value="+" class="button-plus">
                                        <span><?php _e('Days', 'agegate'); ?></span>
                                    </div>
                                    
                                    <div class="input-group">
                                      <input type="button" value="-" class="button-minus">
                                      <input type="number" class="quantity-field" id="agegate_mobile_session_lifetime_h" name="agegate_mobile_session_lifetime[h]" value="<?php echo isset(get_option('agegate_mobile_session_lifetime')['h']) ? get_option('agegate_mobile_session_lifetime')['h'] : '2'; ?>">
                                      <input type="button" value="+" class="button-plus">
                                      <?php _e('Hours', 'agegate'); ?>
                                    </div>
                                    
                                    <div class="input-group">
                                      <input type="button" value="-" class="button-minus">
                                      <input type="number" class="quantity-field" id="agegate_mobile_session_lifetime_m" name="agegate_mobile_session_lifetime[m]" value="<?php echo get_option('agegate_mobile_session_lifetime')['m']; ?>">
                                      <input type="button" value="+" class="button-plus">
                                      <?php _e('Minutes', 'agegate'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <p class="submit">
                <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('Save changes', 'agegate'); ?>">
            </p>
        </form>
    </div>
    
    <small>
        The 18+ Age Gateway presents an age verification solution for UK based visitors to enable your website to comply with the Digital Economy Act 2017.   The gateway works in conjunction with the 18+ App, available on the App Store and Google Play Store.   Use of the 18+ Age Gateway is free.  However, use of the 18+ Age Gateway is subject to our <a href="https://www.agegateway.com/terms.html" target="_blank">Terms and Conditions</a>.  For more information or support, please visit <a href="https://www.agegateway.com/">https://www.agegateway.com/</a>.  (c) Copyright 2019 by 18 Plus Ltd.  All Rights Reserved.
    </small>
</div>

<script>
(function() {
    
    pickerInit();
    
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
    
    this.remove_logo = jQuery('#agegate_remove_logo');
    
    this.enableInputs = function() {
        this.test_anyip.prop('disabled', !this.test_mode.is(':checked'));
        this.test_ip.prop('disabled', !this.test_mode.is(':checked'));
        
        this.test_ip.prop('disabled', this.test_anyip.is(':checked'));
    }
    
    this.test_mode.on('click', () => {this.enableInputs()});
    this.test_anyip.on('click', () => {this.enableInputs()});
    this.remove_logo.on('click', () => {
        jQuery('#agegate-preview-image')[0].src = 'https://via.placeholder.com/80x80';
        jQuery('#agegate-preview-image')[0].srcset = '';
        jQuery('#agegate_image_id').val('');
        jQuery('#agegate_image_src').val('');
        
        textChange();
    });
    this.enableInputs();
}

function pickerInit() {
    calculateResult();
    
    function incrementValue(e) {
      e.preventDefault();

      var parent = jQuery(e.target).closest('div');
      var field = parent.find('input[type="number"]');
      var currentVal = parseInt(field.val(), 10);

      if (!isNaN(currentVal)) {
        field.val(currentVal + 1);
      } else {
        field.val(0);
      }
      calculateResult();
    }

    function decrementValue(e) {
      e.preventDefault();
      
      var parent = jQuery(e.target).closest('div');
      var field = parent.find('input[type="number"]');
      var currentVal = parseInt(field.val(), 10);

      if (!isNaN(currentVal) && currentVal > 0) {
        field.val(currentVal - 1);
      } else {
        field.val(0);
      }
      calculateResult();
    }
    
    function calculateResult() {
        jQuery('.inputPicker').each(function(){
            var result = jQuery(this).find('.inputPickerResult');
            var fields = jQuery(this).find('.quantity-field');
            
            var str = `${fields[0].value || 0} days ${fields[1].value || 0} hours ${fields[2].value || 0} minutes`;
            
            result.val(str);
        })
    }

    jQuery('.input-group').on('click', '.button-plus', function(e) {
        incrementValue(e);
    });

    jQuery('.input-group').on('click', '.button-minus', function(e) {
      decrementValue(e);
    });
    
    jQuery('.inputPickerResult').on('click', function(){
        jQuery(this).closest('.inputPicker').find('.inputPickerBody').show();
    });
    jQuery(document).on('click', function(event){
        if (!jQuery(event.target).parents('.inputPicker').length) {
            calculateResult();
            jQuery('.inputPickerBody').hide();
        }
    });
}
</script>

