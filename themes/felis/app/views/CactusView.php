<?php

/**
 * @version    1.0
 * @package    Cactus
 * @author     CactusThemes Team <hi@cactusthemes.com>
 * @copyright  Copyright (C) 2014 CactusThemes.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://www.cactusthemes.com
 */

/**
 * Class that provides common render functions.
 *
 * @package  Cactus
 * @since    1.0
 */
namespace App\Views;

class CactusView{
    /**
     * Render HTML of different part on page
     */
    public static function render(){
		$numArgs = func_num_args();
		if($numArgs > 0){
			$component = func_get_arg(0);
			
			// remove first arg
			$args = func_get_args();
			$params = array();
			$i = 0;
			foreach($args as $key => $value){
				if($key > 0){
					array_push($params, $value);
					$i++;
				}
			}
			
			// call appropriate function
			call_user_func('App\Views\CactusView::render' . $component, $params);
		}
    }
    /**
     * Get title of current page (Post, Page, Category, Tag...)
     */
    public static function renderTitle( $echo = false ){
        $pageTitle = new ParsePageTitle();
		
		if( !$echo )
			return $pageTitle->render( false );
		else
			$pageTitle->render( true );
    }

    public static function renderSubtitle( $echo = false ){
        $pageSubtitle = new ParsePageSubtitle();
		
		if ( !$echo )
			return $pageSubtitle->render( false );
		else 
			$pageSubtitle->render( true );
    }
    
    public static function renderBreadcrumbs( $echo = false ){
        $breadcumbs = new ParseBreadcumbs();
		
		if( !$echo ) {
			return $breadcumbs->render( false );
		}
		else
			$breadcumbs->render( true );
    }
    
    public static function renderAuthorAvatar( $echo = false ){

        $author = new ParseAuthor();		
        return $author->renderAuthorAvatar();

    }
	
	public static function renderAuthorSocialAccounts( $params = array(), $echo = false  ){
		$author = new ParseAuthor();
		
		list( $user_id, $echo ) = $params;

		return $author->renderSocialAccounts( $user_id, $echo );
	}
    
    public static function renderPostNavigation( $echo = false ){
        $postNavigation = new ParsePostNavigation();
        return $postNavigation->render();
    }
}