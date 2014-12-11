<?php

/**
 * Template for input date
 */

?>

<label>
  <b>{{field.name}}</b><br />
  <input ng-model="field.value" placeholder="YYYY-MM-DD" type="date" name="cmf[{{fieldset.slug}}][{{$parent.$parent.$index}}][{{field.slug}}]" />
</label>