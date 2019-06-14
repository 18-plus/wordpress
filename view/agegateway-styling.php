    <div class="row">
        <div class="col-lg-6 col-md-7 order-md-1">
            <div class="mb-3">
                <label for="agegateway_title"><?php _e('Title', 'agegateway'); ?></label>
                <input type="text" class="form-control" id="agegateway_title" placeholder=""  onchange="textChange()"
                       maxlength="300" name="agegateway_title" value="<?php echo esc_html(get_option('agegateway_title')); ?>">
                <div class="invalid-feedback">
                </div>
            </div>
            <div class="mb-3">
                <div>
                    <?php
                    $image_id = get_option( 'agegateway_site_logo' );
                    if( intval( $image_id ) > 0 ) {
                        // Change with the image size you want to use
                        $image = wp_get_attachment_image( $image_id, 'thumbnail', false, array( 'id' => 'agegateway-preview-image' ) );
                    } else {
                        // Some default image
                        $image = '<img id="agegateway-preview-image" src="'.plugins_url('../img/placeholder.png', __FILE__).'" />';
                    }
                    echo $image; 
                    ?>
                    <input type="hidden" name="agegateway_site_logo" id="agegateway_image_id" value="<?php echo esc_attr( $image_id ); ?>" />
                    <input type="hidden" id="agegateway_image_src" value="<?php echo wp_get_attachment_image_url( $image_id, 'thumbnail'); ?>" />
                    <div>
                        <input type='button' class="button" value="<?php esc_attr_e( 'Select site logo', 'agegateway' ); ?>" id="agegateway_media_manager"/>
                        <input type='button' class="button" value="<?php esc_attr_e( 'Remove logo', 'agegateway' ); ?>" id="agegateway_remove_logo"/>
                        
                    </div>
                </div>
            </div>
            
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="showAgeGateWayLogo" <?=(get_option('agegateway_show_agegateway_logo') ? 'checked' : ''); ?> onchange="textChange()" name="agegateway_show_agegateway_logo">
                <label class="c-custom-control-label custom-control-label" for="showAgeGateWayLogo"><?php _e('Show Age Gateway Logo', 'agegateway'); ?></label>
            </div>
            
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="showBackgroundImage" <?=(get_option('agegateway_show_background_image') ? 'checked' : ''); ?> onchange="textChange()" name="agegateway_show_background_image">
                <label class="c-custom-control-label custom-control-label" for="showBackgroundImage"><?php _e('Show Background Image', 'agegateway'); ?></label>
            </div>
            
            <div class="mb-3">
                <label for="address"><?php _e('Site Name', 'agegateway'); ?></label>
                <input type="text" class="form-control" id="site_name" placeholder="" 
                       onchange="textChange()" maxlength="200" name="agegateway_site_name" value="<?php echo esc_html(get_option('agegateway_site_name')); ?>">
                <div class="invalid-feedback">

                </div>
            </div>
            <div class="mb-3">
                <label for="address"><?php _e('Custom Text', 'agegateway'); ?></label>
                <input type="text" class="form-control" id="custom_text" placeholder="" 
                       onchange="textChange()" maxlength="300" name="agegateway_custom_text" value="<?php echo esc_html(get_option('agegateway_custom_text')); ?>">
                <div class="invalid-feedback">

                </div>
            </div>
            <div class="d-block my-3">
                <label style="margin-left: 0px; padding-left: 0px;" class="col-lg-12"><?php _e('Custom Text Location', 'agegateway'); ?></label>
                <div class="custom-control custom-radio">
                    <input id="belowLogo" name="agegateway_custom_text_location" type="radio" class="custom-control-input"
                           onchange="textChange()"  value="top" <?=(get_option('agegateway_custom_text_location') == 'top' ? 'checked' : ''); ?>>
                    <label class="custom-control-label" for="belowLogo"><?php _e('Below Age Gateway', 'agegateway'); ?></label>
                </div>
                <div class="custom-control custom-radio">
                    <input id="belowText" name="agegateway_custom_text_location" type="radio" class="custom-control-input"
                           onchange="textChange()"  value="bottom" <?=(get_option('agegateway_custom_text_location') == 'bottom' ? 'checked' : ''); ?>>
                    <label class="custom-control-label" for="belowText"><?php _e('Above 18+ Logo', 'agegateway'); ?></label>
                </div>
            </div>
            <div id="bgColor" class="input-group" style="margin-bottom: 1rem!important;">
                <label style="margin-left: 0px; padding-left: 0px;" class="col-lg-12" for="address"><?php _e('Background
                    Color', 'agegateway'); ?></label>
                <input type="text" class="form-control" id="bgColorInput" placeholder="" 
                       onchange="textChange()" maxlength="200" name="agegateway_background_color" value="<?php echo get_option('agegateway_background_color'); ?>">
                <span class="input-group-append">
                        <span class="input-group-text colorpicker-input-addon"><i></i></span>
                    </span>
                <div class="invalid-feedback">

                </div>
            </div>
            <div id="textColor" class="input-group" style="margin-bottom: 1rem!important;">
                <label style="margin-left: 0px; padding-left: 0px;" class="col-lg-12" for="address"><?php _e('Text Color', 'agegateway'); ?></label>
                <input type="text" class="form-control" id="textColorInput" placeholder="" 
                       onchange="textChange()" maxlength="200" name="agegateway_text_color" value="<?php echo get_option('agegateway_text_color'); ?>">
                <span class="input-group-append">
                        <span class="input-group-text colorpicker-input-addon"><i></i></span>
                    </span>
                <div class="invalid-feedback">

                </div>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="showDigital" onchange="textChange()" name="agegateway_remove_reference" <?=(get_option('agegateway_remove_reference') ? 'checked' : ''); ?>>
                <label class="custom-control-label" for="showDigital"><?php _e('Remove reference to Digital Economy Act', 'agegateway'); ?></label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="fromUK" onchange="textChange()" name="agegateway_remove_visiting" <?=(get_option('agegateway_remove_visiting') ? 'checked' : ''); ?>>
                <label class="custom-control-label" for="fromUK"><?php _e('Remove \'you are visiting from UK\' text', 'agegateway'); ?></label>
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
    var showAgeGateWayLogo = true;
    var showBackgroundImage = true;
    var testUrl = 'https://global.cdn.agegateway.com';
    var prod = 'https://uk.cdn.agegateway.com';
    var initialCode = '&ltscript src="' + testUrl + '/agegateway.js">&lt/script> \n' +
            '&ltscript>window.addEventListener("load", function(){\n' +
            'window.initiateAgeGatewayXTYGHY({\n' +
            '    agegateway_logo_url: "",\n' +
            '    agegateway_site_name: "",\n' +
            '    agegateway_custom_text: "",\n' +
            '    agegateway_bg_color: "#F7F1F1",\n' +
            '    agegateway_text_color: "#212529",\n' +
            '    agegateway_show_digital_act: true,\n' +
            '    agegateway_custom_text_top: true,\n' +
            '    agegateway_show_from_uk: true,\n' +
            '    agegateway_show_logo: true,\n' +
            '    agegateway_show_background_image: true\n' +
            '});});&lt/script>';
    var initialCodeProd = '&ltscript src="' + prod + '/agegateway.js">&lt/script> \n' +
            '&ltscript>window.addEventListener("load", function(){\n' +
            'window.initiateAgeGatewayXTYGHY({\n' +
            '    agegateway_logo_url: "",\n' +
            '    agegateway_site_name: "",\n' +
            '    agegateway_custom_text: "",\n' +
            '    agegateway_bg_color: "#F7F1F1",\n' +
            '    agegateway_text_color: "#212529",\n' +
            '    agegateway_show_digital_act: true,\n' +
            '    agegateway_custom_text_top: true,\n' +
            '    agegateway_show_from_uk: true,\n' +
            '    agegateway_show_logo: true,\n' +
            '    agegateway_show_background_image: true\n' +
            '});});&lt/script>';
    $('#code').html(initialCode);
    $('#codeProd').html(initialCodeProd);
    //fa
    // initiate variables
    var logoUrl = baseLogoUrl;
    var siteName = baseSiteName;
    var customText = baseCustomText;
    var bgColor = baseBgColor;
    var textColor = baseTextColor;
    let uuidv4 = function () {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
            var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    } // END let uuidv4
    let sessionID = uuidv4()
    const PostbackURL = "https://age.reallyme.net/api"
    const AgeCheckURL = "https://deep.reallyme.net/agecheck"
    let url = AgeCheckURL +
            "?agid=" + encodeURI(sessionID) +
            // "&url" + encodeURI() +
            "&postback=" + encodeURI(PostbackURL)
    function copyToClipboard() {
        gtag('event', 'Copy From Code', {
            'event_category' : 'Copy Button',
            'event_label' : 'Copy From Code'
        });
        var text = $('#code').clone().find('br').prepend('\r\n').end().text()
        element = $('<textarea>').appendTo('body').val(text).select()
        document.execCommand('copy')
        element.remove();
    }
    function copyToClipboardProd() {
        gtag('event', 'Copy From Code', {
            'event_category' : 'Copy Button',
            'event_label' : 'Copy From Code'
        });
        var text = $('#codeProd').clone().find('br').prepend('\r\n').end().text()
        element = $('<textarea>').appendTo('body').val(text).select()
        document.execCommand('copy')
        element.remove();
    }
    function textChange() {
        if ($('#agegateway_image_src').val()) {
            logoUrl = $('#agegateway_image_src').val();
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
        if ($('#showAgeGateWayLogo').is(':checked')) {
            showAgeGateWayLogo = true;
        }
        else {
            showAgeGateWayLogo = false;
        }
        if ($('#showBackgroundImage').is(':checked')) {
            showBackgroundImage = true;
        }
        else {
            showBackgroundImage = false;
        }
        initialCode = '&ltscript src="https://global.cdn.agegateway.com/agegateway.js">&lt/script> \n' +
                '&ltscript>window.addEventListener("load", function(){\n' +
                'window.initiateAgeGatewayXTYGHY({\n' +
                '    agegateway_logo_url: "' + logoUrl + '",\n' +
                '    agegateway_site_name: "' + siteName + '",\n' +
                '    agegateway_custom_text: "' + customText + '",\n' +
                '    agegateway_bg_color: "' + bgColor + '",\n' +
                '    agegateway_text_color: "' + textColor + '",\n' +
                '    agegateway_show_digital_act: ' + showDigitalAct + ',\n' +
                '    agegateway_custom_text_top: ' + customTextTop + ',\n' +
                '    agegateway_show_from_uk: ' + showFromUK + ',\n' +
                '    agegateway_show_logo: ' + showAgeGateWayLogo + ',\n' +
                '    agegateway_show_background_image: ' + showBackgroundImage + '\n' +
                '});});&lt/script>';
        initialCodeProd = '&ltscript src="' + prod + '/agegateway.js">&lt/script> \n' +
                '&ltscript>window.addEventListener("load", function(){\n' +
                'window.initiateAgeGatewayXTYGHY({\n' +
                '    agegateway_logo_url: "' + logoUrl + '",\n' +
                '    agegateway_site_name: "' + siteName + '",\n' +
                '    agegateway_custom_text: "' + customText + '",\n' +
                '    agegateway_bg_color: "' + bgColor + '",\n' +
                '    agegateway_text_color: "' + textColor + '",\n' +
                '    agegateway_show_digital_act: ' + showDigitalAct + ',\n' +
                '    agegateway_custom_text_top: ' + customTextTop + ',\n' +
                '    agegateway_show_from_uk: ' + showFromUK + ',\n' +
                '    agegateway_show_logo: ' + showAgeGateWayLogo + ',\n' +
                '    agegateway_show_background_image: ' + showBackgroundImage + '\n' +
                '});});&lt/script>';
        $('#code').html(initialCode);
        $('#codeProd').html(initialCodeProd);
        updateVisual(logoUrl, siteName, customText, bgColor, textColor, showDigitalAct, customTextTop, showFromUK, showAgeGateWayLogo, showBackgroundImage)
    }
    updateVisual(logoUrl, siteName, customText, bgColor, textColor, showDigitalAct, customTextTop, showFromUK, showAgeGateWayLogo, showBackgroundImage)
    function updateVisual(logoUrl, siteName, customText, bgColor, textColor, showDigitalAct, customTextTop, showFromUK, showAgeGateWayLogo, showBackgroundImage) {
        // END link
        let isMobile = {
            Android: function () {
                return navigator.userAgent.match(/Android/i);
            },
            BlackBerry: function () {
                return navigator.userAgent.match(/BlackBerry/i);
            },
            iOS: function () {
                return navigator.userAgent.match(/iPhone/i);
            },
            Opera: function () {
                return navigator.userAgent.match(/Opera Mini/i);
            },
            Windows: function () {
                return navigator.userAgent.match(/IEMobile/i);
            },
            any: function () {
                return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
            }
        };
        let qrSrc = "https://age.reallyme.net/qr?uuid=" + sessionID
        let mobile = false
        let scanText = 'Scan the QR from your camera or click here to verify your age.'
        let qrContainer = '<a href="' + url + '"><img src="' + qrSrc + '"></a><br><br>'
        let topCustomText = ''
        let bottomCustomText = ''
        if (isMobile.any()) {
            mobile = true;
            scanText = 'Click on 18+ logo or <a href="' + url + '">here</a> to verify'
            qrContainer = ''
        }
        let textDigitalAct = '';
        if (showDigitalAct) {
            textDigitalAct = 'Pursuant to The Digital Economy Act 2017, we are required to verify that all visitors to this website are least age 18. Further information about this law can be found <a href="https://www.ageverificationregulator.com">https://www.ageverificationregulator.com</a>';
        }
        let textFromUK = '';
        if (showFromUK) {
            textFromUK = 'You are visiting this website from within the United Kingdom. ';
        }
        if (customTextTop) {
            if (customText) {
                customText = '<p style="font-weight: normal !important;font-size: 14px !important;line-height: 1.5 !important;margin-top: 15px !important;margin-bottom: 0px !important;">' + customText + '</p>';
            }
            topCustomText = customText
        }
        else {
            if (customText) {
                customText = '<p style="font-weight: normal !important;font-size: 14px !important;line-height: 1.5 !important;margin-top: 5px !important;margin-bottom: 0px !important;">' + customText + '</p>';
            }
            bottomCustomText = customText
        }
        htmlLogoUrl = '';
        ageGatewayHtml = '';
        backgroundImage = '';
        if (logoUrl) {
            htmlLogoUrl = '<img src="' + logoUrl + '" style="max-width: 200px;max-height: 101px;margin-bottom: 15px;"><br>';
        }
        if (showAgeGateWayLogo) {
            ageGatewayHtml = '<img style="float: none !important;position: unset !important;visibility: visible !important;margin-bottom: 0px !important;margin-top: 10px !important;padding: 0px !important;text-align: center !important;z-index: 9999 !important;background-image: none !important;opacity: 1 !important;display: inline-block !important; margin-left: auto !important;margin-right: auto !important;width: 100% !important;height: auto !important;min-width: unset !important;max-width: 422px !important;max-height: 64px !important;min-height: unset !important;margin-bottom: 20px !important;" src="<?=plugins_url('../img/agegateway_black.svg', __FILE__); ?>">';
        }
        if (showBackgroundImage) {
            backgroundImage = 'background-image: url(<?=plugins_url('../img/agegateway_bkgd_600.png', __FILE__); ?>) !important;';
        }
        htmlSiteName = ''
        if (siteName) {
            htmlSiteName = ' <p style="font-weight: bold;font-size: 22px;margin-top: 0px;line-height: 1.2;margin-bottom: 0px;">' + siteName + '</p>'
        }
        $("#mainDiv").html('<div style="background:' + bgColor + '; ' + 'height: 100%;background-repeat: no-repeat !important;background-position: center top !important;font-family: \'Cabin\', sans-serif !important;' +
                '    ' + backgroundImage + ';height: fit-content;">' +
                '    <div style="max-width: 1140px;width: 95%;margin-left: auto;margin-right: auto;text-align: center;color: ' + textColor + ';font-family: \'Cabin\', sans-serif !important;;padding-top: 12px;margin-bottom: 74px;">' +
                '        <div style="padding-top: 30px;" class="">' +
                '            <div style="padding-top: 10px;max-width: 340px;margin-left: auto;margin-right: auto;display: block;width: 95%;">' +
                '                ' + htmlLogoUrl + htmlSiteName + topCustomText + ageGatewayHtml +
                '                <br><p style="font-weight: normal !important;font-size: 14px !important;line-height: 1.5 !important;margin-top: 5px !important;margin-bottom: 1rem !important;">' + textFromUK + 'To proceed please verify your age.</p>' +
                '                <p style="font-weight: normal !important;font-size: 14px !important;line-height: 1.5 !important;margin-top: 5px !important;margin-bottom: 1rem !important;">' + textDigitalAct + '</p>' + bottomCustomText +
                '            </div>' +
                '        </div>' +
                '        <div style="padding: 0px !important;z-index: 99999 !important;padding-top: 20px !important;margin-bottom: 20px !important;margin-left: auto !important;margin-right: auto !important;padding-bottom: unset !important;padding-left: unset !important;position: unset !important;width: 330px !important;display: block !important;">\n' +
                '    <div class="mainDivAgeGateYGTHAVVBFHR"\n' +
                '         style="border: none !important;visibility: visible !important;opacity: 1 !important;background-image: none !important;padding: 0px !important;z-index: 99999 !important;min-height: unset !important;max-height: unset !important;min-width: unset !important;left: 0px !important;top: 0px !important;background-color: white !important;height: initial !important;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)  !important;padding-right: 0px !important;margin-left: auto !important;margin-right: auto !important;position: unset !important;margin-top: unset !important;margin-bottom: unset !important;">\n' +
                '        <div class="childDivSecondTYHGWEGHBSDXG"\n' +
                '             style="border: none !important;visibility: visible !important;opacity: 1 !important;background-image: none !important;z-index: 99999 !important;background-color: transparent !important;min-height: unset !important;max-height: unset !important;min-width: unset !important;left: 0px !important;top: 0px !important;text-align: center !important;padding-top: 45px !important;height: 100% !important;margin: 0px !important;position: unset !important;padding-bottom: 0px !important;padding-left: 0px !important;padding-right: 0px !important;display: block !important;width: 100% !important;">\n' +
                '            <p style="min-height: unset !important;max-height: unset !important;background-color: transparent !important;padding: 0px !important;    max-width: none !important;min-width: unset !important;width: 100% !important;margin-left: auto !important;margin-right: auto !important;float: none !important;text-align: center !important;color: #212529 !important;font-family: \'Cabin\', sans-serif !important;border: none !important;display: block !important;visibility: visible !important;opacity: 1 !important;background-image: none !important;z-index: 99999 !important;height: initial !important;position: initial !important;font-family: \'Cormorant Infant\' !important;color: black !important;font-weight: 500 !important;font-size: 42px !important;line-height: 1.5 !important;margin-top: 0px !important;margin-bottom: -9px !important;max-width: 300px !important;">\n' +
                '                I\'m 18+ </p>            <a\n' +
                '                style="float: none !important;position: unset !important;visibility: visible !important;margin-bottom: 0px !important;margin-top: 0px !important;padding: 0px !important;text-align: center !important;z-index: 9999 !important;background-image: none !important;opacity: 1 !important;margin-left: auto !important;margin-right: auto !important;display: block !important;width: 140px !important;height: 140px !important;min-width: 140px !important;max-width: 140px !important;max-height: 140px !important;min-height: 140px !important;"' +
                '                href="#">\n' +
                '            <img style="float: none !important;position: unset !important;visibility: visible !important;margin-bottom: 0px !important;margin-top: 45px !important;padding: 0px !important;text-align: center !important;z-index: 9999 !important;margin-left: auto !important;margin-right: auto !important;display: block !important;width: 140px !important;"' +
                '                 src="<?=plugins_url('../img/18plus_icon_small.png', __FILE__); ?>"></a>\n' +
                '            <p style="font-size: 14px !important;margin-top: 50px !important;min-height: unset !important;max-height: unset !important;background-color: transparent !important;padding: 0px !important;    max-width: none !important;min-width: unset !important;width: 100% !important;margin-left: auto !important;margin-right: auto !important;float: none !important;text-align: center !important;color: #212529 !important;font-family: \'Avenir LT W01_45 Book1475508\', sans-serif !important;border: none !important;display: block !important;visibility: visible !important;opacity: 1 !important;background-image: none !important;z-index: 99999 !important;height: initial !important;position: initial !important;max-width: 256px !important;font-weight: normal !important;line-height: 1.6 !important;margin-bottom: 50px !important;">\n' +
                '                Confirm your age to this website with the 18+ App. Click the above logo to launch</p></div>' +
                '        <div class="childDivAgeGateTHRRRRBFSS"\n' +
                '             style="border: none !important;visibility: visible !important;opacity: 1 !important;background-image: none !important;z-index: 99999 !important;background-color: transparent !important;min-height: unset !important;max-height: unset !important;min-width: unset !important;left: 0px !important;top: 0px !important;background-color: black !important;height: 100% !important;margin: 0px !important;position: unset !important;padding-bottom: 0px !important;padding-left: 0px !important;padding-right: 0px !important;padding-top: 45px !important;">\n' +
                '            <p style="min-height: unset !important;max-height: unset !important;background-color: transparent !important;padding: 0px !important;    max-width: none !important;min-width: unset !important;width: 100% !important;margin-left: auto !important;margin-right: auto !important;float: none !important;text-align: center !important;color: #212529 !important;font-family: \'Cabin\', sans-serif !important;border: none !important;display: block !important;visibility: visible !important;opacity: 1 !important;background-image: none !important;z-index: 99999 !important;height: initial !important;position: initial !important;font-family: \'Cormorant Infant\', serif !important;;color: white !important;font-weight: 500 !important;font-size: 42px !important;line-height: 1.5 !important;margin-top: 0px !important;margin-bottom: 10px !important;max-width: 300px !important;">\n' +
                '                Are You 18+? </p>\n' +
                '            <p style="min-height: unset !important;max-height: unset !important;background-color: transparent !important;padding: 0px !important;    max-width: none !important;min-width: unset !important;width: 100% !important;margin-left: auto !important;margin-right: auto !important;float: none !important;text-align: center !important;color: #212529 !important;font-family: \'Avenir LT W01_45 Book1475508\', sans-serif !important;border: none !important;display: block !important;visibility: visible !important;opacity: 1 !important;background-image: none !important;z-index: 99999 !important;height: initial !important;position: initial !important;color: white !important;font-weight: normal !important;font-size: 14px !important;line-height: 1.5 !important;margin-top: 0px !important;margin-bottom: 15px !important;max-width: 300px !important;">\n' +
                '                The Simplest &amp; Most Anonymous <br> Age Verification System </p>\n' +
                '            <p style="min-height: unset !important;max-height: unset !important;background-color: transparent !important;padding: 0px !important;    max-width: none !important;min-width: unset !important;width: 100% !important;margin-left: auto !important;margin-right: auto !important;float: none !important;text-align: center !important;color: #212529 !important;font-family: \'Avenir LT W01_45 Book1475508\', sans-serif !important;border: none !important;display: block !important;visibility: visible !important;opacity: 1 !important;background-image: none !important;z-index: 99999 !important;height: initial !important;position: initial !important;text-align: center !important;margin-top: 30px !important;color: white !important;font-weight: normal !important;font-size: 14px !important;line-height: 1.5 !important;margin-top: 30px !important;margin-bottom: 5px !important;max-width: 300px !important;">\n' +
                '                One-Time Age Verification Options </p>\n' +
                '            <div class="divWithMatginAgeGateGWINMROKG" style="\n' +
                '    /* padding-top: 45px !important; */\n' +
                '    padding-left: 65px !important;\n' +
                '">\n' +
                '                <p style="min-height: unset !important;max-height: unset !important;background-color: transparent !important;padding: 0px !important;    max-width: none !important;min-width: unset !important;width: 100% !important;margin-left: auto !important;margin-right: auto !important;float: none !important;text-align: center !important;color: #212529 !important;font-family: \'Avenir LT W01_45 Book1475508\', sans-serif !important;border: none !important;display: block !important;visibility: visible !important;opacity: 1 !important;background-image: none !important;z-index: 99999 !important;height: initial !important;position: initial !important;text-align: left !important;margin-top: 10px !important;color: white !important;font-weight: normal !important;font-size: 12px !important;line-height: 1.5 !important;margin-bottom: 5px !important;max-width: 300px !important;">\n' +
                '                    <img style="float: none !important;position: unset !important;visibility: visible !important;margin-bottom: 0px !important;margin-top: 0px !important;padding: 0px !important;text-align: center !important;z-index: 9999 !important;background-image: none !important;opacity: 1 !important;display: inline-block !important; margin-left: auto !important;margin-right: auto !important;width: 23px !important;height: 21px !important;min-width: 23px !important;max-width: 23px !important;max-height: 21px !important;min-height: 21px !important;vertical-align: sub !important;"\n' +
                '                         src="<?=plugins_url('../img/smsSmall.png', __FILE__); ?>"> <span\n' +
                '                        style="text-align: left !important;display: inline-block !important;line-height: 27px !important;font-size: 11px !important;vertical-align: super !important;margin-left: 7px !important;                   min-height: unset !important;max-height: unset !important;background-color: transparent !important;min-width: unset !important;float: none !important;border: none !important;visibility: visible !important;    background-image: unset !important;position: unset !important;z-index: 99999 !important;height: initial !important;padding: 0px !important;margin-bottom: 0px !important;margin-top: 0px !important;">Verify by SMS</span>\n' +
                '                </p>' +
                '                <p style="min-height: unset !important;max-height: unset !important;background-color: transparent !important;padding: 0px !important;    max-width: none !important;min-width: unset !important;width: 100% !important;margin-left: auto !important;margin-right: auto !important;float: none !important;text-align: center !important;color: #212529 !important;font-family: \'Avenir LT W01_45 Book1475508\', sans-serif !important;border: none !important;display: block !important;visibility: visible !important;opacity: 1 !important;background-image: none !important;z-index: 99999 !important;height: initial !important;position: initial !important;text-align: left !important;margin-top: 10px !important;color: white !important;font-weight: normal !important;font-size: 12px !important;line-height: 1.5 !important;margin-top: 5px !important;margin-bottom: 5px !important;max-width: 300px !important;">\n' +
                '                    <img style="float: none !important;position: unset !important;visibility: visible !important;margin-bottom: 0px !important;margin-top: 0px !important;padding: 0px !important;text-align: center !important;z-index: 9999 !important;background-image: none !important;opacity: 1 !important;display: inline-block !important; margin-left: auto !important;margin-right: auto !important;width: 23px !important;height: 17px !important;min-width: 23px !important;max-width: 23px !important;max-height: 17px !important;min-height: 17px !important;vertical-align: baseline !important;"\n' +
                '                         src="<?=plugins_url('../img/credit_card_small.png', __FILE__); ?>"> <span\n' +
                '                        style="text-align: left !important;display: inline-block !important;line-height: 27px !important;font-size: 11px !important;vertical-align: super !important;margin-left: 7px !important;                    min-height: unset !important;max-height: unset !important;background-color: transparent !important;min-width: unset !important;float: none !important;border: none !important;visibility: visible !important;                    background-image: unset !important;position: unset !important;z-index: 99999 !important;height: initial !important;padding: 0px !important;margin-bottom: 0px !important;margin-top: 0px !important;">Verify by credit card </span>\n' +
                '                </p>' +
                '                <p style="min-height: unset !important;max-height: unset !important;background-color: transparent !important;padding: 0px !important;    max-width: none !important;min-width: unset !important;width: 100% !important;margin-left: auto !important;margin-right: auto !important;float: none !important;text-align: center !important;color: #212529 !important;font-family: \'Avenir LT W01_45 Book1475508\', sans-serif !important;border: none !important;display: block !important;visibility: visible !important;opacity: 1 !important;background-image: none !important;z-index: 99999 !important;height: initial !important;position: initial !important;text-align: left !important;margin-top: 10px !important;color: white !important;font-weight: normal !important;font-size: 12px !important;line-height: 1.5 !important;margin-top: 5px !important;margin-bottom: 15px !important;max-width: 300px !important;">\n' +
                '                    <img style="float: none !important;position: unset !important;visibility: visible !important;margin-bottom: 0px !important;margin-top: 0px !important;padding: 0px !important;text-align: center !important;z-index: 9999 !important;background-image: none !important;opacity: 1 !important;display: inline-block !important; margin-left: auto !important;margin-right: auto !important;width: 23px !important;height: 23px !important;min-width: 23px !important;max-width: 23px !important;max-height: 23px !important;min-height: 23px !important; vertical-align: sub !important;"\n' +
                '                         src="<?=plugins_url('../img/RM_Logo_60px.png', __FILE__); ?>"> <span\n' +
                '                        style="text-align: left !important;display: inline-block !important;line-height: 16px !important;font-size: 11px !important;vertical-align: sub !important;margin-left: 7px !important;                    min-height: unset !important;max-height: unset !important;background-color: transparent !important;min-width: unset !important;float: none !important;border: none !important;visibility: visible !important;                    background-image: unset !important;position: unset !important;z-index: 99999 !important;height: initial !important;padding: 0px !important;margin-bottom: 0px !important;margin-top: 0px !important;">                        Verify with a ReallyMe identity <br> set up with your driver\'s license or passport <span>  </span></span>\n' +
                '                </p></div>' +
                '            <p style="min-height: unset !important;max-height: unset !important;background-color: transparent !important;padding: 0px !important;    max-width: none !important;min-width: unset !important;width: 100% !important;margin-left: auto !important;margin-right: auto !important;float: none !important;text-align: center !important;color: #212529 !important;font-family: \'Avenir LT W01_45 Book1475508\', sans-serif !important;border: none !important;display: block !important;visibility: visible !important;opacity: 1 !important;background-image: none !important;z-index: 99999 !important;height: initial !important;position: initial !important;text-align: center !important;margin-top: 35px !important;color: white !important;font-weight: normal !important;font-size: 12px !important;line-height: 1.5 !important;margin-bottom: 5px !important;max-width: 300px !important;">\n' +
                '                Get the 18+ App to start </p>' +
                '            <div style="border: none !important;visibility: visible !important;opacity: 1 !important;background-image: none !important;padding: 0px !important;z-index: 99999 !important;background-color: transparent !important;min-height: unset !important;max-height: unset !important;min-width: unset !important;left: 0px !important;top: 0px !important;margin-bottom: 45px !important;margin-top: 18px !important;width: 95% !important;margin-left: auto !important;margin-right: auto !important;text-align: center !important;color: #212529 !important;   font-family: \'Cabin\', sans-serif !important;height: initial !important;position: initial !important;float: none !important;">\n' +
                '                <a target="_blank" style="float: none !important;position: unset !important;visibility: visible !important;margin-bottom: 0px !important;margin-top: 0px !important;padding: 0px !important;text-align: center !important;z-index: 9999 !important;background-image: none !important;opacity: 1 !important;display: inline-block !important; margin-left: auto !important;margin-right: auto !important;width: 108px !important;height: 32px !important;min-width: 108px !important;max-width: 108px !important;max-height: 32px !important;min-height: 32px !important;margin-right: 10px !important;"\n' +
                '                   href="https://itunes.apple.com/gb/app/18/id1464599161?ls=1&mt=8"> <img' +
                '                        style="float: none !important;position: unset !important;visibility: visible !important;margin-bottom: 0px !important;margin-top: 0px !important;padding: 0px !important;text-align: center !important;z-index: 9999 !important;background-image: none !important;opacity: 1 !important;display: inline-block !important; margin-left: auto !important;margin-right: auto !important;width: 108px !important;height: 32px !important;min-width: 108px !important;max-width: 108px !important;max-height: 32px !important;min-height: 32px !important;"\n' +
                '                        src="<?=plugins_url('../img/download_on_the_App_Store_Badge.svg', __FILE__); ?>"></a> <a target="_blank"' +
                '                    style="float: none !important;position: unset !important;visibility: visible !important;margin-bottom: 0px !important;margin-top: 0px !important;padding: 0px !important;text-align: center !important;z-index: 9999 !important;background-image: none !important;opacity: 1 !important;display: inline-block !important; margin-left: auto !important;margin-right: auto !important;width: 108px !important;height: 32px !important;min-width: 108px !important;max-width: 108px !important;max-height: 32px !important;min-height: 32px !important;;margin-left: 10px !important;margin-top: 7px !important;"\n' +
                '                    href="https://play.google.com/store/apps/details?id=org.plus18.android"> <img' +
                '                    style="float: none !important;position: unset !important;visibility: visible !important;margin-bottom: 0px !important;margin-top: 0px !important;padding: 0px !important;text-align: center !important;z-index: 9999 !important;background-image: none !important;opacity: 1 !important;display: inline-block !important; margin-left: auto !important;margin-right: auto !important;width: 108px !important;height: 32px !important;min-width: 108px !important;max-width: 108px !important;max-height: 32px !important;min-height: 32px !important;"\n' +
                '                    src="<?=plugins_url('../img/get_it_on_google_play.svg', __FILE__); ?>"></a></div>' +
                '        </div>\n' +
                '    </div>\n' +
                '</div>' +
                '    </div>' +
                '</div>');
    }

</script>