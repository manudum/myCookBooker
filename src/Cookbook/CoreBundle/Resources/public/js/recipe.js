$(document).ready(function() {

   //listen for the form beeing submitted
   $("#add_categ").click(function(){
      //get the url for the form
      var url='../../categoryrecipe/new';
   
      //start send the post request
      
       $.get(url,{
           other:"attributes"
       },function(data){
           //the response is in the data variable
  
              //if you want to print the error:
              $('#new_cat').html(data);
              
              
               $("#cat_new").click(function(){
                    //get the url for the form
                    var url=$("#cat_form").attr("action");

                    //start send the post request
                    $.post(url,{
                        name:$("#form_name").val(), 
                    },function(data){
                        //the response is in the data variable

                            $("#cookbook_corebundle_recipetype_category").addValue($("#form_name").val());
                            $('#new_cat').html();
                    });//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down

                    //we dont what the browser to submit the form
                    return false;
                });
           
       });//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down

      //we dont what the browser to submit the form
      return false;
   });


});