<?php
    /**
     * Add metadata (meta-boxes) for all post types
     */
    require get_parent_theme_file_path('/app/metadatas/page-metadatas.php');

    // App\Plugins\Cactus_Author\Author::initialize();
    /**
     * Add metadata for post
     */
    require get_parent_theme_file_path('/app/metadatas/post-metadatas.php');

    /**
     * Add metadata for product
     */
    if ( class_exists( 'WooCommerce') ) {
        require get_parent_theme_file_path('/app/metadatas/product-metadatas.php');
    }

    /**
     * Add metadata for video presentation
     */
    if ( class_exists( 'FelisVideo') ) {
        require get_parent_theme_file_path('/app/metadatas/video-metadatas.php');
    }
    