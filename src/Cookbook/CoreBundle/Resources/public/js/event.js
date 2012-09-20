var recipiesList, friendsList;

jQuery(function($){
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
});

$(document).ready(function() {
    if ( $.attrFn ) {$.attrFn.text = true;}
    $( "form input.date" ).datepicker();
    friendsList = $("#cookbook_corebundle_recipetype_friends").multiselect();
    recipiesList = $("#cookbook_corebundle_recipetype_recipes").multiselect();
    $('input[type=radio]').change(refreshRecipes);
    $.browser.mozilla && $('input[type=radio]').each( function() {
	this.checked = this.defaultChecked;
    });
    $('#categories_recipe').buttonset();
    $('#types_recipe').buttonset();
    $('#formats_recipe').buttonset();
    $( "input:submit, button").button();
    if ( $("#addFriend").length ) $('#addFriend').click(function(){
      //get the url for the form
      var url='../../friend/new';
   
      //start send the post request
      
       $.get(url,{
           other:"attributes"
       },function(data){
           //the response is in the data variable
  
              //if you want to print the error:
              $('#new').html(data);
              $('#new').dialog({
			autoOpen: true,
			height: 300,
			width: 350,
			modal: true,
                        title: "Nouvel invité",
                        buttons: {
                            "Ajouter": function() {
                                    //get the url for the form
                                    var url=$("#friend_form").attr("action");
                                    
                                    $("#friend_form").submit(function(){
                                        if(!this.checkValidity || this.checkValidity()){

                                        $.post(url,
                                        $("#friend_form").serialize(),function(data){
                                            //the response is in the data variable
                                                 friendsList.multiselect("addNewSelected",data);
                                                $('#new').html();
                                        }, 'json');//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down

                                        //we dont what the browser to submit the form
                                       // $( this ).dialog( "close" );
                                        }
                                        return false;
                                    });
                                    $("#friend_form").submit();
                                    //start send the post request
                                    
                            },
                            "Annuler": function() {
                                        $( this ).dialog( "close" );
                            }
                        },
			close: function() {
				//allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});
              
               
           
       });//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down

      //we dont what the browser to submit the form
      return false;
   });
   
   if ( $("#addRecipe").length ) $('#addRecipe').click(function(){
      //get the url for the form
      var url='../../recipe/new';
   
      //start send the post request
      
       $.get(url,{
           other:"attributes"
       },function(data){
           //the response is in the data variable
  
              //if you want to print the error:
              $('#new').html(data);
              if ( $("#categories").length ) $('#categories').buttonset();
    
              $('#new').dialog({
			autoOpen: true,
			height: 300,
			width: 350,
			modal: true,
                        title: "Nouveau plat",
                        buttons: {
                            "Ajouter": function() {
                                    //get the url for the form
                                    var url=$("#recipe_form").attr("action");

                                    //start send the post request
                                    $.post(url,
                                        $("#recipe_form").serialize(),function(data){
                                        //the response is in the data variable
                                             recipiesList.multiselect("addNewSelected",data);
                                            $('#new').html();
                                    }, 'json');//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down

                                    //we dont what the browser to submit the form
                                    $( this ).dialog( "close" );
                            },
                            "Annuler": function() {
                                        $( this ).dialog( "close" );
                            }
                        },
			close: function() {
				//allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});
              
               
           
       });//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down

      //we dont what the browser to submit the form
      return false;
   });
    

});

function refreshRecipes()
{
    //get the url for the form
    var url='../../recipe/get';

    //start send the post request
    $.post(url,{
           category:$('input[type=radio][name=category]:checked').attr('value'),
           type:$('input[type=radio][name=type]:checked').attr('value'),
           format:$('input[type=radio][name=format]:checked').attr('value')
       },function(data){
        //the response is in the data variable
            recipiesList.multiselect("refreshAvailableList",data);
            
    },
    'json');//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down


}
