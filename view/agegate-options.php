<div class="wrap">
    <h1 class="wp-heading-inline">
        <?php _e('AgeGate Options', 'agegate'); ?>
    </h1>
	
    <hr class="wp-header-end">
    
    <div style="background: white; padding: 20px; margin-top: 1.5em; border: 1px solid #e5e5e5;">
        <form method="post">
            <?php _e('Current ip:', 'agegate'); echo $ip; ?>
            <div>
                <label>
                    <span style="width: 100px; display: inline-block;"><?php _e('Test ip', 'agegate') ?></span>
                    <input type="text" size="50" name="agegate_test_ip" value="<?php echo get_option('agegate_test_ip'); ?>">
                </label>
            </div>
        
            <div>
                <label>
                    <span style="width: 100px; display: inline-block;"><?php _e('AgeGate Title', 'agegate') ?></span>
                    <input type="text" size="50" name="agegate_title" value="<?php echo get_option('agegate_title'); ?>">
                </label>
            </div>
            
            <div>
                <label>
                    <span style="width: 100px; display: inline-block;"><?php _e('Start from', 'agegate') ?></span>
                    <input 
                        type="datetime-local" 
                        size="50" 
                        name="agegate_start_from" 
                        value="<?php echo get_option('agegate_start_from'); ?>" 
                        placeholder="2019-07-15 12:00:00"
                        max="9999-12-31T23:59"
                        />
                    <small><?php _e('Default starts from 15.07.2019 12AM'); ?></small>
                </label>
            </div>
            
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
                <input type="hidden" name="agegate_site_logo" id="agegate_image_id" value="<?php echo esc_attr( $image_id ); ?>" class="regular-text" />
                <div>
                    <input type='button' class="button" value="<?php esc_attr_e( 'Select site logo', 'agegate' ); ?>" id="agegate_media_manager"/>
                </div>
            </div>
            
            <p class="submit">
                <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('Save changes', 'agegate'); ?>">
            </p>
        </form>
    </div>

</div>

