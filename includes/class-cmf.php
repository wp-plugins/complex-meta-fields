<?php

/**
 * My global namespace
 */

namespace ENEYSolutions {

  /**
   * Main class
   */
  class CMF {

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
     * Pages of admin area
     * @var type 
     */
    private $admin_pages = array();

    /**
     * Ajax Service
     * @var type 
     */
    private $ajax;

    /**
     * Construct
     */
    public function __construct() {

      //** Register AJAX Handler */
      $this->ajax = \ENEYSolutions\CMF\AJAX::getInstance();

      //** Register metabox handler */
      $this->metabox = \ENEYSolutions\CMF\MetaBox::getInstance();

      //** General actions */
      add_action('admin_menu', array($this, 'admin_menu'));
      add_action('admin_init', array($this, 'admin_init'));
      add_action('admin_enqueue_scripts', array($this, 'load_assets'));
      add_action('add_meta_boxes', array($this->metabox, 'construct'));
      add_action('post_edit_form_tag', array($this, 'post_edit_form_tag'));
      add_action('save_post', array($this->metabox, 'save_post'));

      //** Filters */
      add_filter(WP_CMF_DOMAIN . '_js_l10n', array($this, 'l10n'));
      add_filter(WP_CMF_DOMAIN . '_have_meta_prepare', array($this, 'have_meta_prepare'), 10, 2);
      add_filter(WP_CMF_DOMAIN . '_meta_field_prepare', array($this, 'meta_field_prepare'), 10, 2);

      //** AJAX */
      add_action('wp_ajax_cmf_get_fieldsets', array($this->ajax, 'ajax_get_fieldsets'));
      add_action('wp_ajax_cmf_get_attachment_thumbnail', array($this->ajax, 'ajax_get_attachment_thumbnail'));
    }

    /**
     * Allow to use ng-app on edit post
     */
    function post_edit_form_tag() {
      echo ' ng-app="cmfApp"';
    }

    /**
     * Localization strings
     * 
     * @param array $array
     * @return type
     */
    function l10n($array) {
      
      $array['sure'] = __('Sure?', WP_CMF_DOMAIN);
      
      //** cmfMetaBox */
      $array['cmfMetaBox']['att_id'] = __('Attachment ID', WP_CMF_DOMAIN);
      $array['cmfMetaBox']['select'] = __('Select', WP_CMF_DOMAIN);
      $array['cmfMetaBox']['remove'] = __('Remove', WP_CMF_DOMAIN);
      
      return $array;
    }

    /**
     * Prepare meta
     * 
     * @param type $meta
     * @param type $key
     * @return type
     */
    function have_meta_prepare($meta, $key) {

      //** Get all settings */
      $_fieldsets = get_option(WP_CMF_OPTION);

      if (empty($_fieldsets) || !is_array($_fieldsets)) {
        return $meta;
      }

      //** Go through them */ 
      foreach ($_fieldsets as $_fieldset) {

        //** Search only for ones we need */
        if ($_fieldset['slug'] !== $key)
          continue;

        if (!empty($_fieldset['options']) && is_array($_fieldset['options'])) {
          foreach ($_fieldset['options'] as $_option) {
            if (!empty($meta) && is_array($meta)) {
              foreach ($meta as $_key => $_fields) {
                if (!empty($_fields) && is_array($_fields)) {
                  foreach ($_fields as $_field_key => $_field_value) {
                    if ($_option['slug'] !== $_field_key)
                      continue;
                    $meta[$_key][$_field_key] = apply_filters(WP_CMF_DOMAIN . '_meta_field_prepare', $_field_value, $_option['input']);
                  }
                }
              }
            }
          }
        }
      }

      return $meta;
    }

    /**
     * Prepare fields
     * 
     * @param type $meta
     * @param type $type
     * @return type
     */
    function meta_field_prepare($meta, $type) {

      switch ($type) {

        //** If type is image */
        case 'image':
          
          //** Set up an empty array for the links. */
          $images = array();

          //** Get the intermediate image sizes and add the full size to the array. */
          $sizes = get_intermediate_image_sizes();
          $sizes[] = 'full';

          //** Loop through each of the image sizes. */
          foreach ($sizes as $size) {

            //** Get the image source, width, height, and whether it's intermediate. */
            $images[$size] = wp_get_attachment_image_src($meta, $size);
          }
          
          return $images;
          
          break;

        //** Other cases */
        default:
          return $meta;
          break;
      }

      return $meta;
    }

    /**
     * Load assets
     */
    function load_assets() {

      //** Register Angular JS */
      wp_register_script('angular-core', '//ajax.googleapis.com/ajax/libs/angularjs/1.3.3/angular.js', false, '1.3.3');
      wp_register_script('angular-slugify', WP_CMF_URL . 'assets/js/vendor/angular-slugify.js', false, WP_CMF_VERSION);
      wp_register_script('angular-tinymce', WP_CMF_URL . 'assets/js/vendor/angular-tinymce.js', false, WP_CMF_VERSION);

      //** Resgister Plugn Script */
      wp_register_script('cmf-core', WP_CMF_URL . 'assets/js/complex_meta_fields.js', false, WP_CMF_VERSION);

      //** Register Plugin Styles */
      wp_register_style('cmf-core', WP_CMF_URL . 'assets/css/complex_meta_fields.css', false, WP_CMF_VERSION);

      $translation_array = apply_filters(WP_CMF_DOMAIN . '_js_l10n', array('templates_url' => WP_CMF_TEMPLATES_URL));
      wp_localize_script('cmf-core', 'cmfL10N', $translation_array);

      //** Include it everywhere in admin */
      wp_enqueue_script('angular-core');
      wp_enqueue_script('angular-slugify');
      wp_enqueue_script('angular-tinymce');
      wp_enqueue_script('cmf-core');
      wp_enqueue_style('cmf-core');
    }

    /**
     * Admin menu cb function
     */
    public function admin_menu() {
      $this->admin_pages['toplevel'] = \add_menu_page(__('Complex Meta Fields Welcome', WP_CMF_DOMAIN), __('Complex Meta Fields', WP_CMF_DOMAIN), 'manage_options', 'wp_cmf', array($this, 'ui_root_page'), WP_CMF_URL . '/images/icon.png', 100);
      $this->admin_pages['root'] = \add_submenu_page('wp_cmf', __('Complex Meta Fields', WP_CMF_DOMAIN), __('Welcome', WP_CMF_DOMAIN), 'manage_options', 'wp_cmf', array($this, 'ui_root_page'));
      $this->admin_pages['manage'] = \add_submenu_page('wp_cmf', __('Complex Meta Fields', WP_CMF_DOMAIN), __('Manage', WP_CMF_DOMAIN), 'manage_options', 'wp_cmf_manage', array($this, 'ui_manage_page'));
    }

    /**
     * Admin Actions
     */
    public function admin_init() {
      if (!empty($_POST['cmf-save-fieldsets'])) {
        update_option(WP_CMF_OPTION, !empty($_POST['fieldsets']) ? $_POST['fieldsets'] : array() );
      }
    }

    /**
     * Welcome page cb
     */
    public function ui_root_page() {
      include WP_CMF_TEMPLATES_PATH . 'root-page.php';
    }

    /**
     * Manage page cb
     */
    public function ui_manage_page() {
      include WP_CMF_TEMPLATES_PATH . 'manage-page.php';
    }

  }

}