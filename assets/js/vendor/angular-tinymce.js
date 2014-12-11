/**
 * angular-tinymce
 *
 * Copyright © 2014 Anton Korotkov <anton@eney-solutions.com.ua>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the “Software”), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
"use strict";

(function () {

  //** Create module */
  var mod = angular.module('ui.tinymce', []);

  //** Define values */
  mod.value('uiTinymceConfig', {});

  //** Add Directive */
  mod.directive('uiTinymce', ['uiTinymceConfig', function (uiTinymceConfig) {
      
    uiTinymceConfig = uiTinymceConfig || {};
    
    var generatedIds = 0;
    
    return {
      
        require: 'ngModel',
        link: function (scope, elm, attrs, ngModel) {
          
          var expression, options, tinyInstance;
          
          if (!attrs.id) {
            attrs.$set('id', 'uiTinymce' + generatedIds++);
          }
          
          options = {
            
            //** Update model when calling setContent (such as from the source editor popup) */
            setup: function (ed) {
              ed.on('init', function (args) {
                ngModel.$render();
              });
              
              //** Update model on button click */
              ed.on('ExecCommand', function (e) {
                ed.save();
                ngModel.$setViewValue(elm.val());
                if (!scope.$$phase) {
                  scope.$apply();
                }
              });
              
              //** Update model on keypress */
              ed.on('KeyUp', function (e) {
                console.log(ed.isDirty());
                ed.save();
                ngModel.$setViewValue(elm.val());
                if (!scope.$$phase) {
                  scope.$apply();
                }
              });
            },
            
            mode: 'exact',
            elements: attrs.id
          };
          
          if (attrs.uiTinymce) {
            expression = scope.$eval(attrs.uiTinymce);
          } else {
            expression = {};
          }
          
          angular.extend(options, uiTinymceConfig, expression);
          
          setTimeout(function () {
            tinymce.init(options);
          });

          ngModel.$render = function () {
            
            if (!tinyInstance) {
              tinyInstance = tinymce.get(attrs.id);
            }
            
            if (tinyInstance) {
              tinyInstance.setContent(ngModel.$viewValue || '');
            }
          };
        }
      };
    }]);
})();