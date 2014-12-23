<?php

/**
 * Namespace
 */
namespace ENEYSolutions\CMF {
  
  /**
   * AJAX Service
   */
  class AJAX {
    
    /**
     * Apply Singleton
     */
        /**
     * Instance holder
     * @var type 
     */
    protected static $instance;

    /**
     * Singleton innit
     * @return type
     */
    final public static function getInstance() {
      return isset(static::$instance) ? static::$instance : static::$instance = new static;
    }
    
    /**
     * Get fieldsets list
     */
    public function ajax_get_fieldsets() {
	  $_ = apply_filters( WP_CMF_DOMAIN . '_ajax_get_fieldsets', get_option( WP_CMF_OPTION ) );
      die( json_encode( !empty( $_ ) ? $_ : array() ) );
    }
    
    /**
     * Get attachment thumb by ID
     */
    public function ajax_get_attachment_thumbnail() {
      
      if ( empty( $_GET['id'] ) || !is_numeric( $_GET['id'] ) ) {
        wp_send_json_error(__( 'Attachment ID is not presented', WP_CMF_DOMAIN ));
      }
      
      wp_send_json_success( apply_filters( WP_CMF_DOMAIN . '_ajax_get_attachment_thumbnail', wp_get_attachment_thumb_url( $_GET['id'] ) ) );
    }
  }
}