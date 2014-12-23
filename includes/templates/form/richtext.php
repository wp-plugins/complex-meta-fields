<label>
  <b>{{field.name}}</b><br />
  <textarea data-ui-tinymce id="tinymce{{$parent.$parent.$index}}" ng-model="field.value" name="cmf[{{fieldset.slug}}][{{$parent.$parent.$index}}][{{field.slug}}]"></textarea>
</label>
