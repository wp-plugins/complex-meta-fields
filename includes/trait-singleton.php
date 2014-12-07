<?php

/**
 * Namespace
 */
namespace ENEYSolutions {

  /**
   * Sinbleton trait
   */
  trait Singleton {

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

  }
}