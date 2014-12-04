<?php

/**
 * Plugin Name: Complex Meta Fields
 * Plugin URI:  http://eney-solutions.com.ua/complex-meta-fields
 * Description: Manage complex meta data for any post type.
 * Version:     1.0.0
 * Author:      Anton Korotkov
 * Author URI:  http://eney-solutions.com.ua
 * License:     GPLv2+
 * Text Domain: wp_cmf
 * Domain Path: /languages
 */

/**
 * Copyright (c) 2014 Anton Korotkov (email : anton@eney-solutions.com.ua)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/**
 * Constants
 */
define('WP_CMF_VERSION', '1.0.0');
define('WP_CMF_DOMAIN', 'wp_cmf');
define('WP_CMF_URL', plugin_dir_url(__FILE__));
define('WP_CMF_PATH', dirname(__FILE__) . '/');
define('WP_CMF_TEMPLATES_PATH', WP_CMF_PATH . 'includes/templates/');
define('WP_CMF_TEMPLATES_URL', WP_CMF_URL . 'includes/templates/');
define('WP_CMF_OPTION', 'wp_cmf_options');

/**
 * Includes
 */

/**
 * Sorry, traits... Not this time.
 * 
 * require_once WP_CMF_PATH . 'includes/trait-singleton.php';
 */
require_once WP_CMF_PATH . 'includes/class-cmf-ajax.php';
require_once WP_CMF_PATH . 'includes/class-cmf-metabox.php';
require_once WP_CMF_PATH . 'includes/class-cmf.php';
require_once WP_CMF_PATH . 'includes/frontend-api.php';

/**
 * Wrapper function
 * @return CMF
 */
function wp_cmf() {
  return \ENEYSolutions\CMF::getInstance();
}

/**
 * Init function
 */
function wp_cmf_init() {
  $locale = apply_filters('plugin_locale', get_locale(), 'wp_cmf');
  load_textdomain('wp_cmf', WP_LANG_DIR . '/wp_cmf/wp_cmf-' . $locale . '.mo');
  load_plugin_textdomain('wp_cmf', false, dirname(plugin_basename(__FILE__)) . '/languages/');
  
  wp_cmf();
}

/**
 * Activation hook
 */
function wp_cmf_activate() {
  wp_cmf_init();
  flush_rewrite_rules();
}

/**
 * Deactivation hook
 */
function wp_cmf_deactivate() {}

/**
 * Initial hooks
 */
register_activation_hook(__FILE__, 'wp_cmf_activate');
register_deactivation_hook(__FILE__, 'wp_cmf_deactivate');
add_action('init', 'wp_cmf_init');
