<?php

/**
 * Manage CMF page UI
 */

//** Public Post Types */
$post_types=get_post_types(array(
   'public'   => true
), 'objects');

?>
<div class="wrap">
  
  <h2><?php _e('Fields Constructor', WP_CMF_DOMAIN); ?></h2>
  
  <hr />
  
  <form action="" method="POST">
    
    <?php do_action( WP_CMF_DOMAIN . '_settings_form_start' ); ?>

    <!-- ng app -->
    <section id="cmf-fields-managed" ng-app="cmfApp">

      <!-- UI cols -->
      <table width="100%">
        <tr valign="top">
          
          <!-- Left col -->
          <td width="70%" ng-controller="cmfWorkspace" ng-init="getFieldSets()">
            
            <!-- Col Title -->
            <h2><?php _e( 'Workspace', WP_CMF_DOMAIN ); ?></h2>
            
            <!-- Fields Set List -->
            <ul class="field-set-list">
      
              <li class="nothing-yet" ng-show="!fieldsets.length && !is_loading">
                <?php _e( 'There are no FieldSets found yet.', WP_CMF_DOMAIN ); ?>
                <a href="javascript:void(0);" ng-click="addFieldSet(fieldsets)"><?php _e( 'Add one!', WP_CMF_DOMAIN ); ?></a>
              </li>
              
              <li class="loading" ng-show="is_loading">
                <img src="<?php echo includes_url( 'images/wpspin.gif' ) ?>" /> <?php _e( 'Loading...', WP_CMF_DOMAIN ) ?>
              </li>
              
              <!-- Fields Set -->
              <li class="field-set-item" ng-repeat="fieldset in fieldsets">
                
                <!-- Fields Set Name -->
                <h3 ng-click="fieldset.show = !fieldset.show">{{fieldset.name}} <small>[{{fieldset.post_type}}]</small></h3>
                
                <!-- Remove Field Set -->
                <input type="button" class="button-secondary remove-field-set" value="<?php _e( 'Delete', WP_CMF_DOMAIN ); ?>" ng-click="removeFieldSet(fieldsets, $index)" />
                
                <div class="clear"></div>
                
                <!-- Expandable area -->
                <div class="expandable" ng-show="fieldset.show">
                  
                  <hr />
                  
                  <table width="100%" cellpadding="0" cellspacing="0">
                    <tr valign="top">
                      
                      <!-- Fields Set Settings -->
                      <td width="25%" class="left">

                        <!-- Fieldset name field -->
                        <p>
                          <label>
                            <?php _e( 'FieldSet Name', WP_CMF_DOMAIN ); ?><br />
                            <input name="fieldsets[{{$index}}][name]" required type="text" ng-model="fieldset.name" />
                          </label>
                        </p>
                        
                        <!-- Fieldset slug -->
                        <p>
                          <label>
                            <?php _e( 'Slug', WP_CMF_DOMAIN ); ?><br />
                            <slug from="fieldset.name" to="fieldset.slug">
                              <input name="fieldsets[{{$index}}][slug]" readonly="" type="text" ng-model="fieldset.slug" />
                            </slug>
                          </label>
                        </p>
                        
                        <!-- Post Type selector -->
                        <p>
                          <label>
                            <?php _e( 'Use for', WP_CMF_DOMAIN ); ?><br />
                            <select name="fieldsets[{{$index}}][post_type]" ng-model="fieldset.post_type">
                              <?php foreach ($post_types as $post_type): ?>
                              <option value="<?php echo esc_attr($post_type->name); ?>"><?php echo esc_html($post_type->label); ?></option>
                              <?php endforeach; ?>
                            </select>
                          </label>
                        </p>
                        
                        <p>
                          <!-- Add Field Button -->
                          <input type="button" class="button-secondary" value="<?php _e( 'Add Field', WP_CMF_DOMAIN ); ?>" ng-click="addField(fieldset.options)" />
                        </p>
                 
                      </td>
                      <td class="right">

                        <!-- FieldSet Options -->
                        <ul>
                          <li class="field-item" ng-repeat="option in fieldset.options">
                            
                            <table width="100%" cellpadding="0" cellspacing="0">
                              <tr valign="top">
                                
                                <!-- Field Name and Slug -->
                                <td width="45%">
                                  <label>
                                    <?php _e('Field Name', WP_CMF_DOMAIN); ?><br />
                                    <input name="fieldsets[{{$parent.$index}}][options][{{$index}}][name]" required type="text" ng-model="option.name" />
                                  </label>
                                  <slug from="option.name" to="option.slug"></slug>
                                  <input name="fieldsets[{{$parent.$index}}][options][{{$index}}][slug]" readonly type="text" ng-model="option.slug" />
                                </td>
                                
                                <!-- Field type input -->
                                <td width="45%">
                                  <label>
                                    <?php _e('Field Input', WP_CMF_DOMAIN); ?><br />
                                    <select required name="fieldsets[{{$parent.$index}}][options][{{$index}}][input]" ng-model="option.input">
                                      
                                      <!-- @todo: Apply filter here -->
                                      <optgroup label="<?php _e('Common', WP_CMF_DOMAIN); ?>">
                                        
                                        <option value="text"><?php _e('Text Line', WP_CMF_DOMAIN); ?></option>
                                        <option value="textarea"><?php _e('Text Area', WP_CMF_DOMAIN); ?></option>
                                        <option value="checkbox"><?php _e('Check Box', WP_CMF_DOMAIN); ?></option>
                                        <option value="radio"><?php _e('Radio', WP_CMF_DOMAIN); ?></option>
                                        <option value="select"><?php _e('Dropdown', WP_CMF_DOMAIN); ?></option>
                                        
                                      </optgroup>
                                      
                                      <optgroup label="<?php _e('HTML5', WP_CMF_DOMAIN); ?>">
                                      
                                        <option value="date"><?php _e('Date', WP_CMF_DOMAIN); ?></option>
                                        <option value="email"><?php _e('Email', WP_CMF_DOMAIN); ?></option>
                                        <option value="number"><?php _e('Number', WP_CMF_DOMAIN); ?></option>
                                        <option value="url"><?php _e('URL', WP_CMF_DOMAIN); ?></option>
                                        
                                      </optgroup>
                                      
                                      <optgroup label="<?php _e('Advanced', WP_CMF_DOMAIN); ?>">
                                      
                                        <option value="richtext"><?php _e('Editor', WP_CMF_DOMAIN); ?></option>
                                        <option value="image"><?php _e('Image', WP_CMF_DOMAIN); ?></option>
                                        
                                      </optgroup>
                                      
                                    </select>
                                  </label>
                                </td>
                                
                                <td valign="top">
                                  <!-- Remove Field Button -->
                                  <input type="button" value="-" ng-show="fieldset.options.length > 1" class="button-secondary remove-field" ng-click="removeField(fieldset.options, $index);" />
                                </td>
                                
                              </tr>
                              
                              <tr valign="top">
                                <td colspan="3">
                                  
                                  <div ng-show="fieldHasValues(option)">
                                    <br />
                                    <label>
                                      <?php _e('Options', WP_CMF_DOMAIN); ?>
                                    </label>

                                    <ul>
                                      <li ng-repeat="value in option.options">
                                        <table width="100%">
                                          <tr>
                                            <td width="5%">
                                              <span>{{$index+1}}</span>
                                            </td>
                                            
                                            <td width="45%">
                                              <input type="text" ng-model="value.label" name="fieldsets[{{$parent.$parent.$index}}][options][{{$parent.$index}}][options][{{$index}}][label]" />
                                            </td>
                                            
                                            <td width="45%">
                                              <slug from="value.label" to="value.key"></slug>
                                              <input type="text" readonly ng-model="value.key" name="fieldsets[{{$parent.$parent.$index}}][options][{{$parent.$index}}][options][{{$index}}][key]" />
                                            </td>
                                            
                                            <td width="5%">
                                              <input type="button" value="-" ng-show="option.options.length > 1" class="button-secondary remove-field" ng-click="removeFieldValue(option.options, $index);" />
                                            </td>
                                          </tr>
                                        </table>
                                      </li>
                                    </ul>

                                    <input type="button" value="<?php _e( 'Add Option', WP_CMF_DOMAIN ); ?>" class="button-secondary add-field" ng-click="addFieldValue(option.options)" />
                                  </div>
                                </td>
                              </tr>
                            </table>

                          </li>
                        </ul>
                        
                      </td>
                    </tr>
                  </table>
                </div>
                
              </li>
              
            </ul>
            
            <!-- Add Fields Set -->
            <input type="button" class="button-secondary" value="<?php _e( 'New FieldSet', WP_CMF_DOMAIN ); ?>" ng-click="addFieldSet(fieldsets)" />
            
            <input name="cmf-save-fieldsets" type="submit" class="button-primary" value="<?php _e( 'Save All', WP_CMF_DOMAIN ) ?>" />
          </td>
          
          <!-- Right col -->
          <td ng-controller="cmfHelp" ng-init="
            init({
              why_this_plugin:true,
              what_is_fieldset:false,
              what_is_field:false,
              what_is_post_type:false,
              front_end_api:false
            })
          ">
            <h2><?php _e( 'Help', WP_CMF_DOMAIN ); ?></h2>
            
            <p><?php _e( 'Hi there! This section allows you to manage your FieldSets and Fields for different Post Types.', WP_CMF_DOMAIN ) ?></p>
            
            <?php do_action( WP_CMF_DOMAIN . '_help_before_menu' ); ?>
            
            <ul>
              <li><a ng-class="{active: sections.why_this_plugin}" ng-click="toggleSection('why_this_plugin')" href="javascript:void(0);"><?php _e( 'Why this plugin?', WP_CMF_DOMAIN ); ?></a></li>
              <li><a ng-class="{active: sections.what_is_fieldset}" ng-click="toggleSection('what_is_fieldset')" href="javascript:void(0);"><?php _e( 'What is FieldSet?', WP_CMF_DOMAIN ); ?></a></li>
              <li><a ng-class="{active: sections.what_is_field}" ng-click="toggleSection('what_is_field')" href="javascript:void(0);"><?php _e( 'What is Field?', WP_CMF_DOMAIN ); ?></a></li>
              <li><a ng-class="{active: sections.what_is_post_type}" ng-click="toggleSection('what_is_post_type')" href="javascript:void(0);"><?php _e( 'What is Post Type?', WP_CMF_DOMAIN ); ?></a></li>
              <li><a ng-class="{active: sections.front_end_api}" ng-click="toggleSection('front_end_api')" href="javascript:void(0);"><?php _e( 'Front-end API', WP_CMF_DOMAIN ); ?></a></li>
              <li><a target="_blank" href="https://wordpress.org/support/plugin/complex-meta-fields"><?php _e( 'Support', WP_CMF_DOMAIN ); ?></a></li>
              <li><a target="_blank" href="http://eney-solutions.com.ua/complex-meta-fields"><?php _e( 'More about plugin', WP_CMF_DOMAIN ); ?></a></li>
              
              <?php do_action( WP_CMF_DOMAIN . '_help_menu' ); ?>
              
            </ul>
            
            <?php do_action( WP_CMF_DOMAIN . '_help_after_menu' ); ?>
            
            <section ng-show="sections.why_this_plugin">
              <h4><?php _e( 'Why this plugin?', WP_CMF_DOMAIN ); ?></h4>
              <p><?php _e( 'You may notice there are a lot of plugins that do almost the same things as this one. But there always is a small difference.', WP_CMF_DOMAIN ) ?></p>
              <p><?php _e( 'In current case plugin allows to add REPEATABLE field sets for any Post Type. Meaning you can add any amount of the same field sets to a post or page while editing it.', WP_CMF_DOMAIN ) ?></p>
              <p><?php _e( 'Then you can output them in a post loop using built-in API.', WP_CMF_DOMAIN ); ?></p>
              <p><?php _e( 'Moreover, it is light, simple and useful in the same time.', WP_CMF_DOMAIN ); ?></p>
            </section>
            
            <section ng-show="sections.what_is_fieldset">
              <h4><?php _e( 'What is FieldSet?', WP_CMF_DOMAIN ); ?></h4>
              <p><?php _e( 'FieldSet is simply a set of fields that you are going to use while editing posts. FieldSet may consist of any amount of fields inside and may be repeated multiple times in order to provide multiple objects into the post.', WP_CMF_DOMAIN ); ?></p>
              <p><?php _e( 'When creating new FieldSet you will need to provide Name and select a post type to specify where you want this FieldSet to be used. FieldSet Slug is used to show FieldSet data on front-end and it is generated automatically depending on Name. See <b>Front-end API</b> for more.', WP_CMF_DOMAIN ); ?></p>
            </section>
            
            <section ng-show="sections.what_is_field">
              <h4><?php _e( 'What is Field?', WP_CMF_DOMAIN ); ?></h4>
              <p><?php _e( 'There is nothing special about Fields. It is simply html inputs of different types inside a FieldSets. There are some predefined types for common use. More types later!', WP_CMF_DOMAIN ); ?></p>
            </section>
            
            <section ng-show="sections.what_is_post_type">
              <h4><?php _e( 'What is Post Type?', WP_CMF_DOMAIN ); ?></h4>
              <p><?php _e( 'This question is not related to the plugin and Post Types are completely described here: ', WP_CMF_DOMAIN ) ?><a target="_blank" href="http://codex.wordpress.org/Post_Types">http://codex.wordpress.org/Post_Types</a></p>
            </section>
            
            <section ng-show="sections.front_end_api">
              <h4><?php _e( 'Front-end API', WP_CMF_DOMAIN ); ?></h4>
              <p><?php _e( 'Plugin has simple API for front-end that helps to work with FieldSets and Fields inside them.', WP_CMF_DOMAIN ); ?></p>
              <p><?php _e( 'It works the way similar to standard post loop.', WP_CMF_DOMAIN ); ?></p>
              <p><?php _e( '<b>API Functions</b>', WP_CMF_DOMAIN ); ?></p>
              
              <ul class="api-functions">
                <li>
                  <code>cmf_have_meta( $fieldset_slug )</code>
                  <p><?php _e( 'An alias of <code>have_posts()</code> function. Need to use inside <code>have_posts()</code> loop. Returns true if there are FieldSets left which you can interact with. Accepts one agrument that is FieldSet Slug which you can find when creating new FieldSet.', WP_CMF_DOMAIN ); ?></p>
                </li>
                <li>
                  <code>cmf_the_meta( $fieldset_slug )</code>
                  <p><?php _e( 'An alias of <code>the_post()</code> function. Need to use inside <code>cmf_have_meta()</code> loop. Sets current FieldSet. Accepts one agrument that is FieldSet Slug which you can find when creating new FieldSet.', WP_CMF_DOMAIN ); ?></p>
                </li>
                <li>
                  <code>cmf_the_field( $field_slug )</code>
                  <p><?php _e( 'Function that actually prints field\'s value. Accepts one agrument that is Field Slug which you can find when creating new Field in some of the FieldSets.', WP_CMF_DOMAIN ); ?></p>
                  <p><u><?php _e( 'Notice!', WP_CMF_DOMAIN ); ?></u> <?php _e( 'The value for field of type checkbox will be Array, so there is no need to use this function for this kind of type. Use <code>cmf_get_field( $field_slug )</code> instead.', WP_CMF_DOMAIN ); ?> </p>
                </li>
                <li>
                  <code>cmf_get_field( $field_slug )</code>
                  <p><?php _e( 'Function does the same as function above but returns value instead of printing. You are free to get the value of the field and do any manipulations with it before using. Accepts one agrument that is Field Slug which you can find when creating new Field in some of the FieldSets.', WP_CMF_DOMAIN ); ?></p>
                </li>
              </ul>
              
              <p><a target="_blank" href="http://eney-solutions.com.ua/complex-meta-fields#functions"><?php _e( 'More Function...', WP_CMF_DOMAIN ); ?></a></p>
              
              <p><?php _e( 'If you need more custom things done with FieldSets then you always can use function <code>get_post_meta($post_id, $fieldset_slug)</code> to get FieldSets in any places of your code.', WP_CMF_DOMAIN ); ?></p>
              
              <p><?php _e( '<b>Very important!</b>', WP_CMF_DOMAIN ); ?></p>
              
              <p><?php _e( 'Always do <code>cmf_the_meta( $fieldset_slug )</code> inside cmf_have_meta loop in order to prevent infinite loop on your post page.', WP_CMF_DOMAIN ); ?></p>
              
            </section>
            
            <?php do_action( WP_CMF_DOMAIN . '_help_after_sections' ); ?>
            
          </td>
        </tr>
      </table>

    </section>
    
    <?php do_action( WP_CMF_DOMAIN . '_settings_form_end' ); ?>
    
  </form>
  <img src="http://eney-solutions.com.ua?ping=cmf" />
</div>