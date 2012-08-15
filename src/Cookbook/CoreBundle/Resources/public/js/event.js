var eventsList;

$(document).ready(function() {
    $( "form input.date" ).datepicker();
    $("#cookbook_corebundle_recipetype_friends").multiselect();
    eventsList = $("#cookbook_corebundle_recipetype_recipes").multiselect();
    $('input[type=radio]').change(refreshRecipes
    );

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
            eventsList.multiselect("refreshAvailableList",data);
            
    });//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down


}
