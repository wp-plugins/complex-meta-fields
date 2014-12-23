<?php 

/**
 * Metabox UI
 */

 $_  = $return;
 $__ = $metabox['args'];
 
?>

<?php do_action( WP_CMF_DOMAIN . '_metabox_before_content', $__, $_ ); ?>

<div class="metabox" ng-controller="cmfMetaBox">
  
  <ul ng-init='initialize(<?php echo json_encode( !empty( $_ ) ? $_ : array() ) ?>, <?php echo json_encode( !empty( $__ ) ? $__ : array() ) ?>)'>
    
    <li class="fieldset" ng-repeat="fieldset in fieldsets">

      <!-- The list of fields for this metabox -->
      <ul>

        <!-- Field Item. Loads input templates -->
        <li class="field" ng-repeat="field in fieldset.options" ng-include="templates_url + 'form/' + field.input + '.php'"></li>

      </ul>
      
      <!-- Delete button -->
      <div class="button button-primary" ng-click="removeFieldSet(fieldsets, $index)"><?php _e( 'Delete', WP_CMF_DOMAIN ); ?></div>

    </li>
    

  </ul>

  <!-- Add New button -->
  <div class="button button-primary right" ng-click="addFieldSet(fieldsets)"><?php _e( 'Add New', WP_CMF_DOMAIN ); ?></div>
  
  <div class="clear"></div>
  
</div>

<?php do_action( WP_CMF_DOMAIN . '_metabox_after_content', $__ );