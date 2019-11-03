<?php
/*
 * Plugin Name: CapsLock Relative links
 * Description: Description
 * Author: Dima Solovey
 * Version: 1.0 
 */

defined( 'ABSPATH' )|| exit;

if ( ! defined( 'CPLCK_SITE_URL' ) ) {
    define( 'CPLCK_SITE_URL', site_url() );
}

if ( ! defined( 'CPLCK_HOME_URL' ) ) {
    define( 'CPLCK_HOME_URL', home_url() );
}

/**
 * 
 */
function cplck_replacer( $link, $is_home = true ) {
    return '/' . trim( str_replace( ( $is_home ? CPLCK_HOME_URL : CPLCK_SITE_URL ), '', $link ), '/' );
}

/**
 * 
 */
function cplck_replacer_site_url( $link ) {
    return cplck_replacer( $link, false );
}

/**
 * 
 */
function cplck_replacer_home_url( $link ) {
    return cplck_replacer( $link );
}

if ( ! is_admin() ) {
    add_filter( 'wp_get_attachment_url', 'cplck_replacer_site_url' );
    add_filter( 'theme_root_uri', 'cplck_replacer_site_url' );
    add_filter( 'plugins_url', 'cplck_replacer_site_url' );
    add_filter( 'home_url', 'cplck_replacer_home_url' );
}
