<?php

/**
 * Front-end API functions
 */

if ( !function_exists( 'cmf_have_meta' ) ) {
  
  /**
   * Loop meta implementation
   * 
   * @global type $wp_query
   * @param type $meta_key
   * @return boolean
   */
  function cmf_have_meta( $meta_key ) {
    global $wp_query;
    
    if ( empty( $wp_query->post->cmf ) ) {
      $wp_query->post->cmf = array();
    }
    
    //** Add cmf data if not exists yet */
    if ( !isset( $wp_query->post->cmf[$meta_key] ) ) {
      if ( !empty( $meta_key ) && is_string( $meta_key ) ) {
        if ( !empty( $wp_query->post ) && !empty( $wp_query->post->ID ) ) {
          $_post_meta = get_post_meta( $wp_query->post->ID, $meta_key, 1 );
          if ( !empty( $_post_meta ) ) {
            $wp_query->post->cmf[$meta_key] = $_post_meta;
            $wp_query->post->cmf[$meta_key.'_current'] = key($wp_query->post->cmf[$meta_key]);
          } else {
            return false;
          }
        }
      }
    }
    
    if ( array_key_exists( $wp_query->post->cmf[$meta_key.'_current'], $wp_query->post->cmf[$meta_key] ) ) {
      return true;
    }
    
    return false;

  }
  
}

if ( !function_exists( 'cmf_the_meta' ) ) {
  
  /**
   * Loop the_meta implementation
   * 
   * @global type $wp_query
   * @param type $meta_key
   * @return boolean
   */
  function cmf_the_meta( $meta_key ) {
    global $wp_query;
    
    if ( empty( $wp_query->post->cmf ) || empty( $wp_query->post->cmf[$meta_key] ) ) {
      return false;
    }
    
    $wp_query->post->cmf[ 'current_object' ] = $wp_query->post->cmf[$meta_key][$wp_query->post->cmf[$meta_key.'_current']];
    $wp_query->post->cmf[$meta_key.'_current']++;
  }
  
}

if ( !function_exists( 'cmf_get_field' ) ) {
  
  /**
   * Field getter
   * 
   * @global type $wp_query
   * @param type $slug
   * @return type
   */
  function cmf_get_field( $slug ) {
    global $wp_query;
    
    if ( isset( $wp_query->post->cmf[ 'current_object' ][$slug] ) ) {
      return $wp_query->post->cmf[ 'current_object' ][$slug];
    }
    
    return null;
  }
}

if ( !function_exists( 'cmf_the_field' ) ) {
  
  /**
   * Print field
   * 
   * @param type $slug
   */
  function cmf_the_field( $slug ) {
    echo cmf_get_field( $slug );
  }
}