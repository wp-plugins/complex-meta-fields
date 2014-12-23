<?php

/**
 * Template for input text
 */

?>

<label>
  <b>{{field.name}}</b><br />
  <input ng-model="field.value" type="number" name="cmf[{{fieldset.slug}}][{{$parent.$parent.$index}}][{{field.slug}}]" />
</label>