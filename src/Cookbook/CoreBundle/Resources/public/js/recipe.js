$(document).ready(function() {
if ( $.attrFn ) { $.attrFn.text = true; }
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
              $('#new_cat').dialog({
			autoOpen: true,
			height: 300,
			width: 350,
			modal: true,
                        title: "Nouvelle Catégorie",
                        buttons: {
                            "Ajouter": function() {
                                    //get the url for the form
                                    var url=$("#cat_form").attr("action");

                                    //start send the post request
                                    $.post(url,
                                        $("#cat_form").serialize(),function(data){
                                        //the response is in the data variable
                                            $('#cookbook_corebundle_recipetype_category').append('<option value="'+data.id+'" selected="selected">'+data.name+'</option>')
                                            $('#new_cat').html();
                                    });//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down

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
   
   
   
   $("#add_format").click(function(){
      //get the url for the form
      var url='../../formatrecipe/new';
   
      //start send the post request
      
       $.get(url,{
           other:"attributes"
       },function(data){
           //the response is in the data variable
  
              //if you want to print the error:
              $('#new_format').html(data);
              $('#new_format').dialog({
			autoOpen: true,
			height: 300,
			width: 350,
			modal: true,
                        title: "Nouveau format",
                        buttons: {
                            "Ajouter": function() {
                                    //get the url for the form
                                    var url=$("#format_form").attr("action");

                                    //start send the post request
                                    $.post(url,
                                        $("#format_form").serialize(),function(data){
                                        //the response is in the data variable
                                            $('#cookbook_corebundle_recipetype_format').append('<option value="'+data.id+'" selected="selected">'+data.name+'</option>')
                                            $('#new_format').html();
                                    });//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down

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
   
   
   $("#add_type").click(function(){
      //get the url for the form
      var url='../../typerecipe/new';
   
      //start send the post request
      
       $.get(url,{
           other:"attributes"
       },function(data){
           //the response is in the data variable
  
              //if you want to print the error:
              $('#new_type').html(data);
              $('#new_type').dialog({
			autoOpen: true,
			height: 300,
			width: 350,
			modal: true,
                        title: "Nouveau Type",
                        buttons: {
                            "Ajouter": function() {
                                    //get the url for the form
                                    var url=$("#type_form").attr("action");

                                    //start send the post request
                                    $.post(url,
                                        $("#type_form").serialize(),function(data){
                                        //the response is in the data variable
                                            $('#cookbook_corebundle_recipetype_type').append('<option value="'+data.id+'" selected="selected">'+data.name+'</option>')
                                            $('#new_type').html();
                                    });//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down

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