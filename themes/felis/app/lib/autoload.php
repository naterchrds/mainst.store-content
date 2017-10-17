<?php
    /**
     * Autoload Class
     *
     * @since  cactus alpha 1.0
     * @package cactus
     */

    require_once "ClassLoader/Psr4ClassLoader.php";

    use Symfony\Component\ClassLoader\Psr4ClassLoader;

    $loader = new Psr4ClassLoader();

    //Register Prefix
    $loader->addPrefix('App', get_template_directory() . '/app');

    $loader->addPrefix('App\\Models', get_template_directory() . '/app/models');
	$loader->addPrefix('App\\Config', get_template_directory() . '/app/config');
    $loader->addPrefix('App\\Models\\Entity', get_template_directory() . '/app/models/entity');

    $loader->addPrefix('App\\Views', get_template_directory() . '/app/views');

    $loader->addPrefix('App\\Plugins', get_template_directory() . '/app/plugins');
    $loader->addPrefix('App\\Plugins\\Widgets', get_template_directory() . '/app/plugins/cactus-widgets');
    $loader->addPrefix('App\\Plugins\\Megamenu', get_template_directory() . '/app/plugins/cactus-megamenu');
    $loader->addPrefix('App\\Plugins\\Walker_Nav_Menu', get_template_directory() . '/app/plugins/cactus-walker-nav-menu');
    $loader->addPrefix('App\\Plugins\\TGM_Plugin_Activation', get_template_directory() . '/app/plugins/cactus-tgm-plugin-activation');    
    $loader->addPrefix('App\\Plugins\\Cactus_Option_Tree', get_template_directory() . '/app/plugins/cactus-option-tree');
    $loader->addPrefix('App\\Plugins\\Cactus_Welcome', get_template_directory() . '/app/plugins/cactus-welcome');
    $loader->addPrefix('App\\Plugins\\Cactus_LandingPage', get_template_directory() . '/app/plugins/cactus-landing-page');
    $loader->addPrefix('App\\Plugins\\Cactus_Starter_Content', get_template_directory() . '/app/plugins/cactus-starter-content');
	$loader->addPrefix('App\\Plugins\\Cactus_Author', get_template_directory() . '/app/plugins/cactus-author');
	$loader->addPrefix('App\\Plugins\\Cactus_WooCommerce', get_template_directory() . '/app/plugins/cactus-woocommerce');
	$loader->addPrefix('App\\Plugins\\Cactus_Events_Calendar', get_template_directory() . '/app/plugins/cactus-events_calendar');
	$loader->addPrefix('App\\Plugins\\Cactus_VC', get_template_directory() . '/app/plugins/cactus-vc');

    $loader->addPrefix('App\\Lib', get_template_directory() . '/app/lib');

    $loader->addPrefix('App\\Metadatas', get_template_directory() . '/app/metadatas');

    $loader->addPrefix('App\\Helpers', get_template_directory() . '/app/helpers');

    //Register Loader
    $loader->register();
	