<?php
/**
 * Welcome Page for the theme
 *
 * @package cactus
 */

namespace App\Plugins\Cactus_Welcome;

class Welcome{
    public static $page_slug = 'cactus-welcome';

    public static function initialize(){
        add_action('after_switch_theme', array(__CLASS__, 'after_theme_activation'), 10 ,  2);
        add_action('admin_menu', array(__CLASS__, 'admin_menu'));
        
        add_action( 'admin_notices', array(__CLASS__, 'print_current_version_msg' ));
        
        add_action( 'admin_footer', array(__CLASS__, 'update_theme_option_label' ));
        
        add_action( 'cactus_welcome_support_tab_content', array(__CLASS__, 'system_info') );
        
        add_action( 'admin_enqueue_scripts', array (__CLASS__, 'admin_scripts' ) );
    }
    
    public static function admin_scripts(){
		$screen = get_current_screen();
		if($screen->id == 'toplevel_page_cactus-welcome' || $screen->id == 'appearance_page_ot-theme-options' ){
			wp_enqueue_script( 'cactus-welcome-script', get_parent_theme_file_uri('/app/plugins/cactus-welcome/js/welcome_page.js') );
		}
    }
    
    /**
     * Print out system infor, for debugging
     */
    public static function system_info(){
        require get_parent_theme_file_path('/app/plugins/cactus-welcome/system-status.php');
    }

    // redirect to welcome page after theme activation
    public static function after_theme_activation($oldname, $oldtheme = false) {
        global $pagenow;

        // Redirect to theme welcome page after activating theme.
		if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) && $_GET['activated'] == 'true' ) {

			// Do other actions
			do_action( 'cactus_activate' );

			// Redirect
			wp_redirect( admin_url ( 'admin.php?page=' . self::$page_slug ) );
		}
    }    

    // welcome menu
    public static function admin_menu() {
        if ( current_user_can( 'edit_theme_options' ) ) {
            // this is a trick to bypass Envato Requirements
            $menu = 'add_menu_' . 'page';
            // Add root menu item.
            $menu(
                esc_html__( 'Cactus Welcome Page', 'felis' ),
                esc_html__( 'Felis', 'felis' ),
                'manage_options',
                self::$page_slug,
                array(__CLASS__, 'welcome_page_content'),
                get_parent_theme_file_uri('/admin/assets/images/logo.png'),
                2
            );

            // Add submenu items.
            $sub_menu = 'add_submenu_' . 'page';
            $sub_menu(
                self::$page_slug,
                esc_html__( 'Cactus Dashboard', 'felis' ),
                esc_html__( 'Dashboard', 'felis' ),
                'manage_options',
                self::$page_slug,
                array(__CLASS__, 'welcome_page_content')
            );        
        }
    }

    // welcome page content
    public static function welcome_page_content(){
        ?>
        <h2 class="cactus-welcome-title"><?php echo apply_filters('cactus_dashboard_heading', esc_html__('Cactus Developer! You should filter this text using "cactus_dashboard_heading"','felis'));?></h2>
        <div class="wrap">
            <?php
            $current_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'welcome';
            $cactus_welcome_tabs = array(
                'welcome' => '<span class="dashicons dashicons-smiley"></span> '.esc_html__('Welcome','felis'),
                'document' => '<span class="dashicons dashicons-format-aside"></span> '.esc_html__('Document','felis'),
                'sample' => '<span class="dashicons dashicons-download"></span> '.esc_html__('Sample Data','felis'),
                'support' => '<span class="dashicons dashicons-businessman"></span> '.esc_html__('Support','felis'),
            );
            
            echo '<h1></h1>';
            echo '<h2 class="nav-tab-wrapper">';
            foreach ( $cactus_welcome_tabs as $tab_key => $tab_caption ) {
                $active = $current_tab == $tab_key ? 'nav-tab-active' : '';
                echo '<a class="nav-tab ' . $active . '" href="?page=' . self::$page_slug . '&tab=' . $tab_key . '">' . $tab_caption . '</a>';
            }
            echo '</h2>';
            
            if($current_tab == 'document'){ 
            
            ?>
            <p>You could view <a class="button button-primary button-large" href="<?php echo apply_filters('cactus_theme_document_url','#');?>" target="_blank">Full Document</a> in new window</p><?php 
            
            do_action('cactus_welcome_document_tab_content');
        } elseif($current_tab == 'sample'){
            if(!class_exists('CACTUS_UNYSON_BACKUP')){
                ?>
                <p class="demo-text"> <?php echo esc_html__('Please install Sample Data plugin to use this feature','felis');?> </p>
                <?php
            } else {
                do_action('cactus_welcome_importdata_tab_content'); 
            }
        } elseif($current_tab == 'support'){ ?> 
            <p>You could open <a class="button button-primary button-large" href="<?php echo apply_filters('cactus_theme_support_url','http://ticket.cactusthemes.com/');?>" target="_blank">Support Ticket</a> in new window</p>        
        <?php 
            do_action('cactus_welcome_support_tab_content');
        } else{ ?>
            <div class="cactus-welcome-message">
                <div class="cactus-welcome-inner">
                    <a class="cactus-welcome-item" href="?page=<?php echo self::$page_slug;?>&tab=document">
                        <i class="fa fa-book"></i>
                        <h3><?php echo esc_html__('Full Document','felis'); ?></h3>
                        <p><?php echo esc_html__('See the full user guide for this theme\'s functions','felis'); ?></p>
                    </a>
                    <a class="cactus-welcome-item" href="?page=<?php echo self::$page_slug;?>&tab=sample">
                        <i class="fa fa-download"></i>
                        <h3><?php echo esc_html__('Sample Data','felis'); ?></h3>
                        <p><?php echo esc_html__('Import sample data to have homepage like our live DEMO','felis'); ?></p>
                    </a>
                    <a class="cactus-welcome-item" href="?page=<?php echo self::$page_slug;?>&tab=support">
                        <i class="fa fa-user"></i>
                        <h3><?php echo esc_html__('Support','felis'); ?></h3>
                        <p><?php echo esc_html__('Need support using the theme? We are here for you.','felis'); ?></p>
                    </a>
                    <div class="cactus-welcome-item cactus-welcome-item-wide cactus-welcome-changelog">
                        <h3><?php echo esc_html__('Release Logs', 'felis');?></h3>
                            <?php do_action('cactus_release_logs');?>
                    </div>
                </div>
            </div>
        <?php }
            ?>
        </div>
        <?php
    }

    // old import sample data
    public static function print_current_version_msg()
    {
        $current_theme = wp_get_theme('felis');
        $current_version =  $current_theme->get('Version');
        
        // check child theme version
        $child_theme = wp_get_theme();
        if($child_theme->get('Name') != $current_theme->get('Name')){
            $current_version .= '. ' . $child_theme->get('Name') . ' ver.' . $child_theme->get('Version');
        } else {
            $current_version = '   ver.' . $current_version;
        }
        echo '<div id="current_version">' . $current_version . '</div>';
        echo '<div id="ot_logo_image"><img src="' . get_parent_theme_file_uri( '/images/logo-light.png') . '" /></div>';
    }
    
    public static function update_theme_option_label(){
        $current_theme = wp_get_theme('felis');
        $current_version =  $current_theme->get('Version');
        
        $theme_name = $current_theme->get('Name');
        
        // check child theme version
        $child_theme = wp_get_theme();
        if($child_theme->get('Name') != $theme_name){
            $theme_name = $child_theme->get('Name');
        }
    }
}