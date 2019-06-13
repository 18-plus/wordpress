<div class="wrap">
    <div>
        <small>
            The 18+ Age Gateway presents an age verification solution for UK based visitors to enable your website to comply with the Digital Economy Act 2017.   The gateway works in conjunction with the 18+ App, available on the App Store and Google Play Store.   Use of the 18+ Age Gateway is free.  However, use of the 18+ Age Gateway is subject to our <a href="https://www.agegateway.com/terms.html" target="_blank">Terms and Conditions</a>.  For more information or support, please visit <a href="https://www.agegateway.com/">https://www.agegateway.com/</a>.  (c) Copyright 2019 by 18 Plus Ltd.  All Rights Reserved.
        </small>
    </div>
    <h1 class="wp-heading-inline">
        <?php _e('18+ Age Gateway Settings', 'agegateway'); ?>
    </h1>
	
    <hr class="wp-header-end">
    
    <div class="content">
        <form method="post" id="agegatewayform">
            <div>
                <h2><?php _e('General', 'agegateway'); ?></h2>
                
                <div class="form-group">
                    <label class="label" for="agegateway_on_off_plugin"><?php _e('18+ Age Gateway On/Off', 'agegateway'); ?></label>
                    
                    <label class="switch label_for">
                        <input type="checkbox" id="agegateway_on_off_plugin" value="1" name="agegateway_on_off_plugin" <?=(get_option('agegateway_on_off_plugin') ? 'checked' : '');?>>
                        <span class="slider round"></span>                        
                    </label>
                </div>
            </div>
            
            <div>
                <h2><?php _e('Styling', 'agegateway'); ?></h2>
                
                <?php include('agegateway-styling.php'); ?>
            </div>
            
            <div>
                <h2><?php _e('Testing', 'agegateway'); ?></h2>
                <div class="form-group">
                    <label class="label" for="agegateway_test_mode"><?php _e('Testing mode', 'agegateway'); ?></label>
                    
                    <label class="switch label_for">
                        <input type="checkbox" name="agegateway_test_mode" id="agegateway_test_mode" <?=(get_option('agegateway_test_mode') ? 'checked' : '');?>>
                        <span class="slider round"></span>                        
                    </label>
                    <div><small><?php _e('Turning Testing Mode on will override the start date setting and activate the Age Gateway immediately', 'agegateway'); ?></small></div>
                </div>
            
                <div class="form-group">
                    <label class="label" for="agegateway_test_anyip"><?php _e('Any IP Address', 'agegateway'); ?></label>
                    
                    <label class="switch label_for">
                        <input type="checkbox" name="agegateway_test_anyip" id="agegateway_test_anyip" <?=(get_option('agegateway_test_anyip') ? 'checked' : '');?>>
                        <span class="slider round"></span>                        
                    </label>
                    <div><small><?php _e('Turning this on will show the Age Gateway in Testing Mode for all IP addresses accessing the website', 'agegateway'); ?></small></div>
                </div>
                
                <div class="row">
                    <div class="col-lg-6 col-md-7 order-md-1">
                        <div class="mb-3">
                            <label for="agegateway_test_ip"><?php _e('Test IP Address', 'agegateway') ?></label>
                            <input type="text" class="form-control" id="agegateway_test_ip" maxlength="300" name="agegateway_test_ip" value="<?php echo get_option('agegateway_test_ip'); ?>">
                            <small><?php _e('Current IP:', 'agegateway'); ?> <?php echo $ip; ?></small>
                            <div><small><?php _e('Enter the IP address from which you want to test the Age Gateway in testing Mode. The Age Gateway will be shown only on those IP address. Note: by default, the Age Gateway when activated will only show to UK based IP addresses. Therefore, specifying a non-UK IP address here is only way to see Age Gateway from a non-UK based IP address.', 'agegateway'); ?></small></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div>
                <h2><?php _e('Advanced Settings', 'agegateway'); ?></h2>
                <div class="row">
                    <div class="col-lg-6 col-md-7 order-md-1">
                        <div class="mb-3">
                            <label for="agegateway_start_from"><?php _e('Start from', 'agegateway') ?></label>
                            <input type="text" class="form-control" id="datetimepicker" readonly maxlength="50" name="agegateway_start_from" value="<?php echo get_option('agegateway_start_from'); ?>">
                            <small><?php _e('When activated, the Age Gateway will be active for UK based IP address starting at Midnight on 15 July 2019. You can change the starting date here but remember the law requires age verification from 15 July 2019.', 'agegateway'); ?></small>
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
                            <label for="agegateway_desktop_session_lifetime"><?php _e('Desktop Session Lifetime', 'agegateway') ?> </label>
                            
                            <div class="inputPicker">  
                                <input readonly class="inputPickerResult form-control">
                                <div class="inputPickerBody">
                                    <small>Max value: 2 days</small>
                                    <div class="input-group">
                                        <input type="button" value="-" class="button-minus">
                                        <input type="number" id="agegateway_desktop_session_lifetime_d" class="quantity-field" name="agegateway_desktop_session_lifetime[d]" value="<?php echo get_option('agegateway_desktop_session_lifetime')['d']; ?>">
                                        <input type="button" value="+" class="button-plus">
                                        <span><?php _e('Days', 'agegateway'); ?></span>
                                    </div>
                                
                                    <div class="input-group">
                                      <input type="button" value="-" class="button-minus">
                                      <input type="number" class="quantity-field" id="agegateway_desktop_session_lifetime_h" name="agegateway_desktop_session_lifetime[h]" value="<?php echo get_option('agegateway_desktop_session_lifetime')['h']; ?>">
                                      <input type="button" value="+" class="button-plus">
                                      <?php _e('Hours', 'agegateway'); ?>
                                    </div>
                                
                                    <div class="input-group">
                                      <input type="button" value="-" class="button-minus">
                                      <input type="number" class="quantity-field" id="agegateway_desktop_session_lifetime_m" name="agegateway_desktop_session_lifetime[m]" value="<?php echo get_option('agegateway_desktop_session_lifetime')['m']; ?>">
                                      <input type="button" value="+" class="button-plus">
                                      <?php _e('Minutes', 'agegateway'); ?>
                                    </div>
                                </div>
                            </div>
                            <small><?php _e('The Age Gateway will trigger once per session for eah visitor. You can change the lifetime of the session. By default, the session lifetime is 1 hour for desktop and 2 hours for mobile.', 'agegateway'); ?></small>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 order-md-1">
                        <div class="mb-3">
                            <label for="agegateway_mobile_session_lifetime"><?php _e('Mobile Session Lifetime', 'agegateway') ?> </label>
                            <div class="inputPicker">  
                                <input readonly class="inputPickerResult form-control">
                                <div class="inputPickerBody">
                                    <small>Max value: 7 days</small>
                                    <div class="input-group">
                                        <input type="button" value="-" class="button-minus">
                                        <input type="number" id="agegateway_mobile_session_lifetime_d" class="quantity-field" name="agegateway_mobile_session_lifetime[d]" value="<?php echo get_option('agegateway_mobile_session_lifetime')['d']; ?>">
                                        <input type="button" value="+" class="button-plus">
                                        <span><?php _e('Days', 'agegateway'); ?></span>
                                    </div>
                                    
                                    <div class="input-group">
                                      <input type="button" value="-" class="button-minus">
                                      <input type="number" class="quantity-field" id="agegateway_mobile_session_lifetime_h" name="agegateway_mobile_session_lifetime[h]" value="<?php echo get_option('agegateway_mobile_session_lifetime')['h']; ?>">
                                      <input type="button" value="+" class="button-plus">
                                      <?php _e('Hours', 'agegateway'); ?>
                                    </div>
                                    
                                    <div class="input-group">
                                      <input type="button" value="-" class="button-minus">
                                      <input type="number" class="quantity-field" id="agegateway_mobile_session_lifetime_m" name="agegateway_mobile_session_lifetime[m]" value="<?php echo get_option('agegateway_mobile_session_lifetime')['m']; ?>">
                                      <input type="button" value="+" class="button-plus">
                                      <?php _e('Minutes', 'agegateway'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <p class="submit">
                <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('Save changes', 'agegateway'); ?>">
            </p>
        </form>
    </div>
</div>

<script>
(function() {
    
    pickerInit();
    
    new AgeGatewayForm();
    
    textChange();
    
    jQuery('#datetimepicker').datetimepicker({
        format: 'Y-m-d H:i'
    });
    
})();

function AgeGatewayForm() {
    this.form = jQuery('#agegatewayform');
    
    this.test_mode = jQuery('[name="agegateway_test_mode"]');
    this.test_anyip = jQuery('[name="agegateway_test_anyip"]');
    this.test_ip = jQuery('[name="agegateway_test_ip"]');
    
    this.remove_logo = jQuery('#agegateway_remove_logo');
    
    this.enableInputs = function() {
        this.test_anyip.prop('disabled', !this.test_mode.is(':checked'));
        this.test_ip.prop('disabled', !this.test_mode.is(':checked'));
        
        this.test_ip.prop('disabled', this.test_anyip.is(':checked'));
    }
    
    this.test_mode.on('click', () => {this.enableInputs()});
    this.test_anyip.on('click', () => {this.enableInputs()});
    this.remove_logo.on('click', () => {
        jQuery('#agegateway-preview-image')[0].src = '<?=plugins_url('../img/placeholder.png', __FILE__);?>';
        jQuery('#agegateway-preview-image')[0].srcset = '';
        jQuery('#agegateway_image_id').val('');
        jQuery('#agegateway_image_src').val('');
        
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

