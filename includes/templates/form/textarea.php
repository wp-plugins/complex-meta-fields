<?php

/**
 * Template for textarea
 */

?>

<label>
  <b>{{field.name}}</b><br />
  <textarea ng-model="field.value" name="cmf[{{fieldset.slug}}][{{$parent.$parent.$index}}][{{field.slug}}]"></textarea>
</label>