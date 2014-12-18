<?php
/**
 * Image field
 */
?>

<label>
  
  <b>{{field.name}}</b><br />
  <span ng-hide="!field.value">{{l10n.att_id}}: <input ng-init="initImage()" ng-model="field.value" type="text" readonly name="cmf[{{fieldset.slug}}][{{$parent.$parent.$index}}][{{field.slug}}]" /></span>
  
  <div class="button-secondary" ng-click="selectImage()">{{l10n.select}}</div>
  <div class="button-secondary" ng-hide="!field.thumb" ng-click="removeImage()">{{l10n.remove}}</div>
  <br />
  <br />
  <img ng-src="{{field.thumb}}" ng-hide="!field.thumb" />
  
</label>