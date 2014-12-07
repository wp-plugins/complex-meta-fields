/*! Complex Meta Fields - v1.0.2
 * http://eney-solutions.com.ua/complex-meta-fields
 * Copyright (c) 2014; * Licensed GPLv2+ */
(function (window, undefined) { 
  'use strict';
  
  //** Input variants values constructor */
  var _FieldValue = function() {
    return {
      key: '',
      label: ''
    };
  };
  
  //** Field Constructor */
  var _Field = function() {
    return {
      input: 'text',
      name: '',
      options: [new _FieldValue()]
    };
  };
  
  //** FieldSet Constructor */
  var _FieldSet = function() {
    return {
      show: true,
      name: 'New FieldSet', 
      post_type: 'post',
      options: [new _Field()]
    };
  };

  //** Start with Angular */
  var cmf = window.cmf = angular
  
  //** Create module */
  .module( 'cmfApp', ['slugifier'] )
  
  //** Create controller for Fields Builder */
  .controller( 'cmfWorkspace', function( $scope, $http ){
    
    $scope.is_loading = false;
    
    /**
     * GET FieldSets
     * @returns {undefined}
     */
    $scope.getFieldSets = function() {
      $scope.is_loading = true;
      $http.get( ajaxurl + '?action=cmf_get_fieldsets' ).success(function(data) {
        $scope.fieldsets = data;
        $scope.is_loading = false;
      });
    };
    
    /**
     * Add Field Set
     * @param {type} fieldsets
     * @returns {undefined}
     */
    $scope.addFieldSet = function( fieldsets ) {
      fieldsets.push(new _FieldSet());
    };
    
    /**
     * 
     * @param {type} fieldsets
     * @param {type} item
     * @returns {undefined}
     */
    $scope.removeFieldSet = function( fieldsets, item ) {
      if ( confirm( cmfL10N.sure ) ) fieldsets.splice(item, 1);
    };
    
    /**
     * 
     * @param {type} options
     * @param {type} item
     * @returns {undefined}
     */
    $scope.removeFieldValue = function( options, item ) {
      if ( confirm( cmfL10N.sure ) ) options.splice(item, 1);
    };
    
    /**
     * Add new Field into field set
     * @param {type} options
     * @returns {undefined}
     */
    $scope.addField = function( options ) {
      options.push(new _Field());
    };
    
    /**
     * 
     * @param {type} options
     * @returns {undefined}
     */
    $scope.addFieldValue = function( options ) {
      options.push(new _FieldValue());
    };
    
    /**
     * Remove Field from field set
     * @param {type} options
     * @param {type} item
     * @returns {undefined}
     */
    $scope.removeField = function( options, item ) {
      if ( confirm( cmfL10N.sure ) ) options.splice(item, 1);
    };
    
    /**
     * Check whether to show values intup for field or not
     * @param {type} option
     * @returns {Boolean}
     */
    $scope.fieldHasValues = function( option ) {
      return ['select', 'radio', 'checkbox'].indexOf( option.input ) !== -1;
    };
    
  })
  
  //** Create controller for help area */
  .controller( 'cmfHelp', function( $scope ){
    
    //** Sections list */
    $scope.sections = {};
    
    //** Init current sections */
    $scope.init = function( sections ) {
      $scope.sections = sections;
    };
    
    //** Sections toggler */
    $scope.toggleSection = function( section ){
      for( var i in $scope.sections ) {
        $scope.sections[i] = false;
      }
      $scope.sections[section] = true;
    };
    
  })
  
  //** Create Controller for MetaBox */
  .controller( 'cmfMetaBox', function( $scope ){
    
    //** Templates URL */
    $scope.templates_url = cmfL10N.templates_url;
    
    //** Fields Collection */
    $scope.fieldsets = [];
    
    //** Init function */
    $scope.initialize = function( args, template ) { 
      $scope.template = template;
      $scope.fieldsets = args;
    };
    
    //** Add Fieldset function */
    $scope.addFieldSet = function( fieldsets ) {
      fieldsets.push( angular.copy( $scope.template ) );
    };
    
    $scope.removeFieldSet = function( fieldsets, item ) {
      if ( confirm( cmfL10N.sure ) ) fieldsets.splice(item, 1);
    };
    
  });

})(this);