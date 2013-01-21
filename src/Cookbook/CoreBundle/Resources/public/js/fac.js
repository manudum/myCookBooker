/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(function($){
    if (jQuery.ui){
        $.datepicker.regional['fr'] = {
           closeText: 'Fermer',
           prevText: '<Préc',
           nextText: 'Suiv>',
           currentText: 'Courant',
           monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
           'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
           monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun',
           'Jul','Aoû','Sep','Oct','Nov','Déc'],
           dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
           dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
           dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
           weekHeader: 'Sm',
           //dateFormat: 'dd/mm/yy',
                     dateFormat: 'dd/mm/yy',
           firstDay: 1,
           isRTL: false,
           showMonthAfterYear: false,
           yearSuffix: ''};
        $.datepicker.setDefaults($.datepicker.regional['fr']);
    }
});

(function(){
  var cache = {};
  
  this.tmpl = function tmpl(str, data){
    // Figure out if we're getting a template, or if we need to
    // load the template - and be sure to cache the result.
    var fn = !/\W/.test(str) ?
      cache[str] = cache[str] ||
        tmpl(document.getElementById(str).innerHTML) :
      
      // Generate a reusable function that will serve as a template
      // generator (and which will be cached).
      new Function("obj",
        "var p=[],print=function(){p.push.apply(p,arguments);};" +
        
        // Introduce the data as local variables using with(){}
        "with(obj){p.push('" +
        
        // Convert the template into pure JavaScript
        str
          .replace(/[\r\t\n]/g, " ")
          .split("<%").join("\t")
          .replace(/((^|%>)[^\t]*)'/g, "$1\r")
          .replace(/\t=(.*?)%>/g, "',$1,'")
          .split("\t").join("');")
          .split("%>").join("p.push('")
          .split("\r").join("\\'")
      + "');}return p.join('');");
    
    // Provide some basic currying to the user
    return data ? fn( data ) : fn;
  };
})();
