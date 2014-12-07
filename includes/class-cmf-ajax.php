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
	  $_ = get_option( WP_CMF_OPTION );
      die( json_encode( !empty( $_ ) ? $_ : array() ) );
    }
  }
}