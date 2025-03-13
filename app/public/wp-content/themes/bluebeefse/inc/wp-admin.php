<?php
/**
 * Admin area login page styles.
 *
 * @return void
 */
if (!function_exists('bb_admin_styles')) {
    function bb_admin_styles()
    { ?>
        <style>
            #toplevel_page_edit-post_type-wp_block,
            #toplevel_page_greenshift_dashboard {
                display: none;
            }
        </style>
    <?php }
    add_action('admin_head', 'bb_admin_styles');
}

/**
 * Admin area login page styles.
 *
 * @return void
 */
if (!function_exists('bb_admin_login_styles')) {
    function bb_admin_login_styles()
    { ?>
        <style>
            @font-face {
                font-family: "Manrope";
                src: url(<?php echo get_template_directory_uri(); ?>'/assets/fonts/manrope_normal_400.ttf');
            }

            body {
                background-color: #222222 !important;
                display: flex;
                flex-direction: column;
                gap: 40px;
                font-family: "Manrope", -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif !important;

                @media screen and (min-width: 768px) {
                    /*background-image: url("*/<?php //echo get_template_directory_uri(); ?>/*/assets/images/DSC_0773.jpg") !important;*/
                    /*background-image: url("*/<?php //echo get_template_directory_uri(); ?>/*/assets/images/BB-62.jpg") !important;*/
                    background-repeat: no-repeat;
                    background-size: cover !important;
                    flex-direction: row;
                }
            }

            .login #login {
                background-color: white;
                border-radius: 16px;
                box-sizing: border-box;
                flex: 1;
                margin: auto !important;
                padding: 30px 20px !important;
                width: unset !important;
            }

            @media screen and (min-width: 768px) {
                .login #login {
                    margin: auto auto auto 10% !important;
                    padding: 40px 60px !important;
                }
            }

            .login form {
                border: unset !important;
                border-radius: 16px;
                box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px !important;
                padding: 26px 24px !important;
            }

            #login h1 a,
            .login h1 a {
                background-image: unset;
                /* background-position: left;
                    background-size: contain;
                    background-repeat: no-repeat; */
                color: #222222;
                font-size: clamp(32px, 2.7vw, 42px);
                font-weight: bold;
                height: unset;
                margin: 0;
                text-align: left;
                text-indent: unset;
                width: 100%;
            }

            #login h2 {
                color: #0A0233;
                font-size: clamp(18px, 1.7vw, 24px);
                margin: 0 0 12px 0;
            }

            .login #backtoblog {
                padding: 0 !important;
            }

            .login #backtoblog a {
                color: #222222 !important;
            }

            .login #login_error,
            .login .message,
            .login .success {
                border-color: #0A0233 !important;
            }

            .admin-email__actions-primary .button.button-large {
                margin-top: 12px !important;
            }

            .wp-core-ui .button-primary {
                background-color: #E53FAB !important;
                border-color: #E53FAB !important;
                border-radius: 4px !important;
                float: unset !important;
                margin-top: 12px !important;
            }

            .intro-message {
                color: #222222;
                font-size: 12px;
                margin-bottom: 12px !important;
            }

            .intro-message span {
                margin-bottom: 6px;
            }

            .intro-message a {
                color: #222222;
                font-size: 12px;
                font-weight: bold;
                text-decoration: none;
            }

            .intro-message a:hover {
                color: #222222;
                text-decoration: underline;
            }

            #login .privacy-policy-page-link {
                margin-bottom: 0;
                padding: 0;
                text-align: unset !important;
            }

            .privacy-policy-link {
                color: #222222;
            }

            p#nav {
                padding: 0 !important;
            }

            #login p#nav a {
                background-color: #222222;
                border-radius: 4px;
                color: white !important;
                display: inline-block;
                line-height: 2.30769231;
                padding: 0 12px;
            }

            #login form p.forgetmenot {
                float: unset;
            }

            #login #copy {
                cursor: pointer;
                display: inline-block;
                font-size: 14px;
                margin-left: 5px;
            }

            .bb-advertising-area {
                align-items: center;
                display: flex;
                flex: 1;
                flex-direction: column;
                justify-content: center;
                margin: auto !important;
                padding: 30px 20px !important;

                @media screen and (min-width: 768px) {
                    margin: auto 10% auto auto !important;
                }

                .advertising-area--inner{
                    display: flex;
                    flex-direction: row;
                    flex-wrap: wrap;
                    gap: 20px;
                    justify-content: center;
                }

                h2{
                    align-self: flex-start;
                    color: #ffffff;
                    margin-bottom: 25px;

                    /*@media screen and (min-width: 768px) {*/
                    /*    color: white;*/
                    /*}*/
                }

                .advertising-area-item {
                    background-color: white;
                    border-radius: 16px;
                    box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;
                    box-sizing: border-box;
                    color: #222222;
                    cursor: pointer;
                    display: inline-block;
                    flex: 45%;
                    margin: 0;
                    max-width: 550px;
                    text-decoration: unset;
                    transition-property: box-shadow, background-color, color;
                    transition-duration: 0.2s;
                    transition-timing-function: ease-in-out;
                    padding: 30px !important;
                    width: unset !important;

                    &:hover{
                        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px !important;
                        color: white;
                    }

                    &:nth-of-type(3n+1){
                        &:hover{
                            background-color: #E53FAB;
                        }
                    }

                    &:nth-of-type(3n+2){
                        &:hover{
                            background-color: #00CCFF;
                        }
                    }

                    &:nth-of-type(3n+3){
                        &:hover{
                            background-color: #DCE700;
                        }
                    }

                    &.hive-item{
                        &:hover{
                            background-color: #FB1E50;
                        }
                    }

                    h3{
                        font-size: clamp(18px, 1.7vw, 24px);
                        margin-bottom: 10px;
                    }
                }
            }
        </style>
    <?php }
    add_action('login_enqueue_scripts', 'bb_admin_login_styles');
}

/**
 * Admin area login page additional content.
 *
 * @return void
 */
function bb_admin_login_content() {
    ?>
    <div class="bb-advertising-area">
        <h2>Get more from Blue Bee!</h2>
        <div class="advertising-area--inner">

            <a href="https://bluebee.co.uk/marketing?source=fse-login" target="_blank" class="advertising-area-item">
                <h3>Digital Marketing</h3>
                <p>Did we mention we’re a Google Partner? Our expertise in SEO, PPC and search engine marketing has been recognised by Google, meaning your online presence is in safe hands with us.</p>
            </a>
            <a href="https://bluebee.co.uk/marketing/google-ads?source=fse-login" target="_blank" class="advertising-area-item">
                <h3>Google Ads</h3>
                <p>Increase your online visibilty and see a positive rerun on investment with a strategic Google Ads campaign.</p>
            </a>
            <a href="https://bluebee.co.uk/design?source=fse-login" target="_blank" class="advertising-area-item">
                <h3>Design, Creative and Print</h3>
                <p>We know that graphic design can unleash your business potential, and we’ve got the expertise to take your business to the next level with our range of creative services.</p>
            </a>
            <a href="https://bluebee.co.uk/hive-communications/?source=fse-login" target="_blank" class="advertising-area-item hive-item">
                <h3>IT Support, Cyber Security & Telecoms</h3>
                <p>Discover how our award-winning sister company Hive Communications can help your business for all things support, security, cloud services and telecoms.</p>
            </a>
        </div>
    </div>
    <?php
}
add_action( 'login_footer', 'bb_admin_login_content' );

/**
 * Admin area login page logo url.
 *
 * @return void
 */
function bb_change_loginlogo_url($url)
{
    return get_site_url();
}
add_filter('login_headerurl', 'bb_change_loginlogo_url');


/**
 * Admin area login page remove language switcher.
 */
add_filter('login_display_language_dropdown', '__return_false');


/**
 * Admin area login page title.
 *
 */
if (!function_exists('bb_admin_login_title')) {
    function bb_admin_login_title()
    {
        return get_bloginfo();
    }
    add_action('login_headertext', 'bb_admin_login_title');
}

/**
 * Admin area login page message.
 *
 */
if (!function_exists('bb_admin_login_message')) {
    function bb_admin_login_message($message)
    {
        if (empty($message)) {
            return "<h2>Site Administrator Access</h2>
                        <p class='intro-message'><span>Looking for some technical support? That's what we're here for!</span><br>
                        Email us: <a href='mailto:tech@bluebee.co.uk'>tech@bluebee.co.uk</a></p>";
        } else {
            return $message;
        }
    }
    add_action('login_message', 'bb_admin_login_message');
}

/**
 * Add content to admin area footer.
 *
 */
if (!function_exists('bb_admin_footer_text')) {
    function bb_admin_footer_text()
    {
        echo "Looking for some technical support? Email: <a href='mailto:tech@bluebee.co.uk'>tech@bluebee.co.uk</a>";
    }

    add_filter('admin_footer_text', 'bb_admin_footer_text');
}

/**
 * Allow Editor user role to access Appearance > Editor.
 *
 */
function add_theme_capability_to_editor() {
    $role = get_role('editor'); // Get the editor role
    if ($role) {
        $role->add_cap('edit_theme_options'); // Add capability to edit theme options
    }
}
add_action('init', 'add_theme_capability_to_editor');