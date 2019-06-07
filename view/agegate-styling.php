    <div class="row">
        <div class="col-lg-6 col-md-7 order-md-1">
            <div class="mb-3">
                <label for="agegate_title"><?php _e('Title', 'agegate'); ?></label>
                <input type="text" class="form-control" id="agegate_title" placeholder=""  onchange="textChange()"
                       maxlength="300" name="agegate_title" value="<?php echo get_option('agegate_title'); ?>">
                <div class="invalid-feedback">
                </div>
            </div>
            <div class="mb-3">
                <div>
                    <?php
                    $image_id = get_option( 'agegate_site_logo' );
                    if( intval( $image_id ) > 0 ) {
                        // Change with the image size you want to use
                        $image = wp_get_attachment_image( $image_id, 'thumbnail', false, array( 'id' => 'agegate-preview-image' ) );
                    } else {
                        // Some default image
                        $image = '<img id="agegate-preview-image" src="https://via.placeholder.com/80x80" />';
                    }
                    echo $image; 
                    ?>
                    <input type="hidden" name="agegate_site_logo" id="agegate_image_id" value="<?php echo esc_attr( $image_id ); ?>" />
                    <input type="hidden" id="agegate_image_src" value="<?php echo wp_get_attachment_image_url( $image_id, 'thumbnail'); ?>" />
                    <div>
                        <input type='button' class="button" value="<?php esc_attr_e( 'Select site logo', 'agegate' ); ?>" id="agegate_media_manager"/>
                        <input type='button' class="button" value="<?php esc_attr_e( 'Remove logo', 'agegate' ); ?>" id="agegate_remove_logo"/>
                        
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="address"><?php _e('Site Name', 'agegate'); ?></label>
                <input type="text" class="form-control" id="site_name" placeholder="" 
                       onchange="textChange()" maxlength="200" name="agegate_site_name" value="<?php echo get_option('agegate_site_name'); ?>">
                <div class="invalid-feedback">

                </div>
            </div>
            <div class="mb-3">
                <label for="address"><?php _e('Custom Text', 'agegate'); ?></label>
                <input type="text" class="form-control" id="custom_text" placeholder="" 
                       onchange="textChange()" maxlength="300" name="agegate_custom_text" value="<?php echo get_option('agegate_custom_text'); ?>">
                <div class="invalid-feedback">

                </div>
            </div>
            <div class="d-block my-3">
                <label style="margin-left: 0px; padding-left: 0px;" class="col-lg-12"><?php _e('Custom Text Location', 'agegate'); ?></label>
                <div class="custom-control custom-radio">
                    <input id="belowLogo" name="agegate_custom_text_location" type="radio" class="custom-control-input"
                           onchange="textChange()"  value="top" <?=(get_option('agegate_custom_text_location') == 'top' ? 'checked' : ''); ?>>
                    <label class="custom-control-label" for="belowLogo"><?php _e('Below Age Gateway', 'agegate'); ?></label>
                </div>
                <div class="custom-control custom-radio">
                    <input id="belowText" name="agegate_custom_text_location" type="radio" class="custom-control-input"
                           onchange="textChange()"  value="bottom" <?=(get_option('agegate_custom_text_location') == 'bottom' ? 'checked' : ''); ?>>
                    <label class="custom-control-label" for="belowText"><?php _e('Above 18+ Logo', 'agegate'); ?></label>
                </div>
            </div>
            <div id="bgColor" class="input-group" style="margin-bottom: 1rem!important;">
                <label style="margin-left: 0px; padding-left: 0px;" class="col-lg-12" for="address"><?php _e('Background
                    Color', 'agegate'); ?></label>
                <input type="text" class="form-control" id="bgColorInput" placeholder="" 
                       onchange="textChange()" maxlength="200" name="agegate_background_color" value="<?php echo get_option('agegate_background_color'); ?>">
                <span class="input-group-append">
                        <span class="input-group-text colorpicker-input-addon"><i></i></span>
                    </span>
                <div class="invalid-feedback">

                </div>
            </div>
            <div id="textColor" class="input-group" style="margin-bottom: 1rem!important;">
                <label style="margin-left: 0px; padding-left: 0px;" class="col-lg-12" for="address"><?php _e('Text Color', 'agegate'); ?></label>
                <input type="text" class="form-control" id="textColorInput" placeholder="" 
                       onchange="textChange()" maxlength="200" name="agegate_text_color" value="<?php echo get_option('agegate_text_color'); ?>">
                <span class="input-group-append">
                        <span class="input-group-text colorpicker-input-addon"><i></i></span>
                    </span>
                <div class="invalid-feedback">

                </div>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="showDigital" onchange="textChange()" name="agegate_remove_reference" <?=(get_option('agegate_remove_reference') ? 'checked' : ''); ?>>
                <label class="custom-control-label" for="showDigital"><?php _e('Remove reference to Digital Economy Act', 'agegate'); ?></label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="fromUK" onchange="textChange()" name="agegate_remove_visiting" <?=(get_option('agegate_remove_visiting') ? 'checked' : ''); ?>>
                <label class="custom-control-label" for="fromUK"><?php _e('Remove \'you are visiting from UK\' text', 'agegate'); ?></label>
            </div>
            <hr class="mb-4">
        </div>
        <div class="col-lg-6 col-md-5 order-md-2 mb-4">
            <div id="mainDiv">
            </div>
        </div>
    </div>

<script>

    $(function () {
        $('#bgColor').colorpicker();
        $('#textColor').colorpicker();
    });

    var baseLogoUrl = '';
    var baseSiteName = '';
    var baseCustomText = '';
    var baseBgColor = '#F7F1F1';
    var baseTextColor = '#212529';
    var showDigitalAct = true;
    var customTextTop = true;
    var showFromUK = true;

    // initiate variables

    var logoUrl = baseLogoUrl;
    var siteName = baseSiteName;
    var customText = baseCustomText;
    var bgColor = baseBgColor;
    var textColor = baseTextColor;

    function textChange() {

        if ($('#agegate_image_src').val()) {
            logoUrl = $('#agegate_image_src').val();
        }
        else {
            var logoUrl = baseLogoUrl;
        }
        if ($('#site_name').val()) {
            siteName = $('#site_name').val();
        }
        else {
            var siteName = baseSiteName;
        }
        if ($('#custom_text').val()) {
            customText = $('#custom_text').val();
        }
        else {
            var customText = baseCustomText;
        }
        if ($('#textColorInput').val()) {
            textColor = $('#textColorInput').val();
        }
        else {
            var textColor = baseTextColor;
        }
        if ($('#bgColorInput').val()) {
            bgColor = $('#bgColorInput').val();
        }
        else {
            var bgColor = baseBgColor;
        }
        if ($('#showDigital').is(':checked')) {
            showDigitalAct = false;
        }
        else {
            showDigitalAct = true;
        }
        if ($('#fromUK').is(':checked')) {
            showFromUK = false;
        }
        else {
            showFromUK = true;
        }
        if ($('#belowLogo').is(':checked')) {
            customTextTop = true;
        }
        else {
            customTextTop = false;
        }

        updateVisual(logoUrl, siteName, customText, bgColor, textColor, showDigitalAct, customTextTop, showFromUK)

    }

    updateVisual(logoUrl, siteName, customText, bgColor, textColor, showDigitalAct, customTextTop, showFromUK)

    function updateVisual(logoUrl, siteName, customText, bgColor, textColor, showDigitalAct, customTextTop, showFromUK) {

        let topCustomText = ''
        let bottomCustomText = ''
        let textDigitalAct = '';

        if (showDigitalAct) {
            textDigitalAct = 'Pursuant to The Digital Economy Act 2017, we are required to verify that all visitors to this website are least age 18. Further information about this law can be found <a href="https://www.ageverificationregulator.com">https://www.ageverificationregulator.com</a>';
        }

        let textFromUK = '';

        if (showFromUK) {
            textFromUK = 'You are visiting this website from within the United Kingdom. ';
        }

        if (customText) {
            customText = '<p style="font-weight:normal;line-height: 1.5;margin-top: 5px;margin-bottom: 0px;">' + customText + '</p>';
        }

        if (customTextTop) {
            topCustomText = customText
        }
        else {
            bottomCustomText = customText
        }

        htmlLogoUrl = ''

        if( logoUrl ){
            htmlLogoUrl = '<img src="' + logoUrl + '" style="max-width: 200px;max-height: 101px;"><br>';
        }

        htmlSiteName = ''

        if( siteName ){
            htmlSiteName = ' <p style="font-weight: bold;font-size: 22px;margin-top: 6px;line-height: 1.2;margin-bottom: .5rem;">' + siteName + '</p>'
        }

        $("#mainDiv").html('<div style="background:' + bgColor + '; ' + 'height: 100%;background-repeat: no-repeat !important;background-position: center top !important;font-family: \'Cabin\', sans-serif !important;' +
            '    background-image: url(https://global.cdn.agegateway.com/agegateway/agegate_bkgd_1200.png) !important;height: fit-content;">' +
            '    <div style="margin-top: 30px;max-width: 1140px;width: 95%;margin-left: auto;margin-right: auto;text-align: center;color: ' + textColor + ';font-family: \'Cabin\', sans-serif !important;;padding-top: 30px;margin-bottom: 74px;">' +
            '        <div class="">' +
            '            <div style="max-width: 760px;margin-left: auto;margin-right: auto;display: block;width: 95%;">' +
            '                ' + htmlLogoUrl + htmlSiteName +
            '                <h1 style="font-family: \'Cormorant Infant\', serif !important;font-weight: 500;font-size: 40px;margin-top: 6px;line-height: 1.2;margin-bottom: .5rem;"><img style="max-width: 100%;" src="https://global.cdn.agegateway.com/assets/img/agegateway_black.svg"></h1>' + topCustomText +
            '                <br><p style="font-weight:normal;line-height: 1.5;margin-top: 5px;font-family: \'Cabin\', sans-serif !important;">' + textFromUK + 'To proceed please verify your age.</p>' +
            '                <p style="font-weight:normal;line-height: 1.5;">' + textDigitalAct + '</p>' + bottomCustomText +
            '            </div>' +
            '        </div><br>' +
            '        <div class="mainDiv" style="background-color: white;width: 330px;height: 400px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);display: flex;padding-right: 0px;margin-left: auto;margin-right: auto;">\n' +
            '                    <div class="childDiv" style="display: inline-block;height: 100%;width: 100%;padding-top: 55px;">\n' +
            '                        <a href="#" style="float: none !important;position: unset !important;visibility: visible !important;margin-bottom: 0px !important;margin-top: 0px !important;padding: 0px !important;text-align: center !important;z-index: 9999 !important;\n' +
            '    background-image: none !important;opacity: 1 !important;margin-left: auto !important;margin-right: auto !important;display: block !important;width: 100px !important;min-width: 100px !important;max-width: 100px !important;min-height: 100px !important;\n' +
            '    height: 100px !important;max-height: 100px !important;">\n' +
            '                            <img src="<?php echo plugin_dir_url(__FILE__);?>emblem.png" style="float: none !important;position: unset !important;visibility: visible !important;margin-bottom: 0px !important;margin-top: 0px !important;padding: 0px !important;text-align: center !important;z-index: 9999 !important;\n' +
            '    background-image: none !important;opacity: 1 !important;margin-left: auto !important;margin-right: auto !important;display: block !important;width: 100px !important;min-width: 100px !important;max-width: 100px !important;min-height: 100px !important;\n' +
            '    height: 100px !important;max-height: 100px !important;"></a>\n' +
            '                        <p style="min-height: unset !important;max-height: unset !important;background-color: transparent !important;padding: 0px !important;    max-width: 300px !important;min-width: unset !important;width: 100% !important;\n' +
            '                margin-left: auto !important;margin-right: auto !important;float: none !important;text-align: center !important;color: #212529 !important;font-family: \'Cabin\', sans-serif !important;border: none !important;display: block !important;\n' +
            '                visibility: visible !important;opacity: 1 !important;background-image: none !important;z-index: 99999 !important;height: initial !important;position: initial !important;font-weight: normal !important;font-size: 14px !important;\n' +
            '                line-height: 1.5 !important;margin-top: 43px !important;margin-bottom: 15px !important;">\n' +
            '                            <span style="display: block" class="mobileSpan">Click the 18+ logo to start age verification with 18+</span>\n' +
            '                            You need to have the 18+ app installed to verify. You can download it here:</p>\n' +
            '                        <div style="border: none !important;display:block !important;visibility: visible !important;opacity: 1 !important;background-image: none !important;padding: 0px !important;z-index: 99999 !important;background-color: transparent !important;min-height: unset !important;max-height: unset !important;min-width: unset !important;left: 0px !important;top: 0px !important;margin-bottom: 20px !important;margin-top: 0px !important;width: 95% !important;margin-left: auto !important;margin-right: auto !important;text-align: center !important;color: #212529 !important;   font-family: \'Cabin\', sans-serif !important;height: initial !important;position: initial !important;float: none !important;max-width: 760px !important;">\n' +
            '                            <a style="float: none !important;position: unset !important;visibility: visible !important;margin-bottom: 0px !important;margin-top: 0px !important;padding: 0px !important;text-align: center !important;\n' +
            '                    z-index: 9999 !important;background-image: none !important;opacity: 1 !important;display: inline-block; margin-left: auto !important;margin-right: auto !important;width: 135px !important;height: 40px !important;\n' +
            '                    min-width: 135px !important;max-width: 135px !important;max-height: 40px !important;min-height: 40px !important;margin-right: 0px !important;" href="https://itunes.apple.com/gb/app/18/id1464599161?ls=1&mt=8"> <img style="float: none !important;position: unset !important;visibility: visible !important;margin-bottom: 0px !important;margin-top: 0px !important;padding: 0px !important;text-align: center !important;z-index: 9999 !important;background-image: none !important;opacity: 1 !important;display: block; margin-left: auto !important;margin-right: auto !important;width: 135px !important;height: 40px !important;min-width: 135px !important;max-width: 135px !important;max-height: 40px !important;min-height: 40px !important;" src="https://global.cdn.agegateway.com/agegateway/Download_on_the_App_Store_Badge.svg"></a>\n' +
            '                            <a style="float: none !important;position: unset !important;visibility: visible !important;margin-bottom: 0px !important;padding: 0px !important;text-align: center !important;\n' +
            '                    z-index: 9999 !important;background-image: none !important;opacity: 1 !important;display: block; margin-left: auto !important;margin-right: auto !important;width: 135px !important;height: 40px !important;\n' +
            '                    min-width: 135px !important;max-width: 135px !important;max-height: 40px !important;min-height: 40px !important;" href="https://play.google.com/store/apps/details?id=org.plus18.android"> <img style="float: none !important;position: unset !important;visibility: visible !important;margin-bottom: 0px !important;margin-top: 0px !important;padding: 0px !important;text-align: center !important;z-index: 9999 !important;background-image: none !important;opacity: 1 !important;display: inline-block; margin-left: auto !important;margin-right: auto !important;width: 135px !important;height: 40px !important;min-width: 135px !important;max-width: 135px !important;max-height: 40px !important;min-height: 40px !important;" src="https://global.cdn.agegateway.com/agegateway/get_it_on_google_play.svg"></a></div>\n' +
            '                    </div>\n' +
            '                    \n' +
            '                </div>' +
            '    </div>' +
            '</div>');
    }

</script>