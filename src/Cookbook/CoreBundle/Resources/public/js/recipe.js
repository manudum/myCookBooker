$(document).ready(function() {
    if ($.attrFn) {
        $.attrFn.text = true;
    }
    //listen for the form beeing submitted
    if ($("#add_categ").length)
        $("#add_categ").click(function() {
            //get the url for the form
            var url = '../../categoryrecipe/new';

            //start send the post request

            $.get(url, {
                other: "attributes"
            }, function(data) {
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
                            var url = $("#cat_form").attr("action");

                            //start send the post request
                            $.post(url,
                                    $("#cat_form").serialize(), function(data) {
                                //the response is in the data variable
                                if ($('#cookbook_corebundle_recipetype_category').length)
                                    $('#cookbook_corebundle_recipetype_category').append('<option value="' + data.id + '" selected="selected">' + data.name + '</option>');
                                if ($('#listCategories').length) {
                                    $('#listCategories').append('<li class="ui-state-default" id="order_' + data.id + '"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><span id="order_span_' + data.id + '" onclick="editCategory(' + data.id + ');">' + data.name + '</span><span class="rfloat hand" onclick="removeCategory(' + data.id + '); return false;">x</span></li>');
                                    reorderCategory();
                                }
                                $('#new_cat').html();
                            });//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down

                            //we dont what the browser to submit the form
                            $(this).dialog("close");
                        },
                        "Annuler": function() {
                            $(this).dialog("close");
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



    if ($("#add_format").length)
        $("#add_format").click(function() {
            //get the url for the form
            var url = '../../formatrecipe/new';

            //start send the post request

            $.get(url, {
                other: "attributes"
            }, function(data) {
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
                            var url = $("#format_form").attr("action");

                            //start send the post request
                            $.post(url,
                                    $("#format_form").serialize(), function(data) {
                                //the response is in the data variable
                                if ($('#cookbook_corebundle_recipetype_format').length)
                                    $('#cookbook_corebundle_recipetype_format').append('<option value="' + data.id + '" selected="selected">' + data.name + '</option>');
                                if ($('#listFormats').length) {
                                    $('#listFormats').append('<li class="ui-state-default" id="order_' + data.id + '"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><span id="order_span_' + data.id + '" onclick="editFormat(' + data.id + ')">' + data.name + '</span><span class="rfloat hand" onclick="removeFormat(' + data.id + '); return false;">x</span></li>');
                                    reorderFormat();
                                }
                                $('#new_format').html();
                            });//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down

                            //we dont what the browser to submit the form
                            $(this).dialog("close");
                        },
                        "Annuler": function() {
                            $(this).dialog("close");
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


    if ($("#add_type").length)
        $("#add_type").click(function() {
            //get the url for the form
            var url = '../../typerecipe/new';

            //start send the post request

            $.get(url, {
                other: "attributes"
            }, function(data) {
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
                            var url = $("#type_form").attr("action");

                            //start send the post request
                            $.post(url,
                                    $("#type_form").serialize(), function(data) {
                                //the response is in the data variable
                                if ($('#cookbook_corebundle_recipetype_type').length)
                                    $('#cookbook_corebundle_recipetype_type').append('<option value="' + data.id + '" selected="selected">' + data.name + '</option>');
                                if ($('#listTypes').length) {
                                    $('#listTypes').append('<li class="ui-state-default" id="order_' + data.id + '"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><span id="order_span_' + data.id + '" onclick="editType(' + data.id + ')">' + data.name + '</span><span class="rfloat hand" onclick="removeType(' + data.id + '); return false;">x</span></li>');
                                    reorderType();
                                }

                                $('#new_type').html();
                            });//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down

                            //we dont what the browser to submit the form
                            $(this).dialog("close");
                        },
                        "Annuler": function() {
                            $(this).dialog("close");
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



    if ($("#libCategory").length)
        $("#libCategory").click(function() {
            //get the url for the form
            var url = '../../categoryrecipe/list';

            //start send the post request

            $.get(url, {
                other: "attributes"
            }, function(data) {
                //the response is in the data variable

                //if you want to print the error:
                var htmlcategory = '<select id="selectCategory">';
                data.map(function(i) {
                    htmlcategory += '<option value="' + i.id + '"';
                    if (i.name == $("#libCategory").html()) {
                        htmlcategory += ' selected="selected"';
                    }
                    htmlcategory += '>' + i.name + '</li>';

                });
                htmlcategory += '</select>';


                $("#dialog-changeCategory").html(htmlcategory);

                $("#selectCategory").change(function() {
                    var url = '../../recipe/changeCategory/' + $("#recipe_id").val();
                    $.post(url,
                            'new_categ=' + $(this).val(), function(data) {
                        //the response is in the data variable

                        $("#libCategory").html($('#selectCategory option:selected').text());
                        $("#dialog-changeCategory").dialog("close");

                    });



                });

                $('#dialog-changeCategory').dialog({
                    autoOpen: true,
                    height: 100,
                    width: 350,
                    modal: true,
                    title: "Changer la catégorie"
                });



            }, 'json');//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down

            //we dont what the browser to submit the form
            return false;
        });


    if ($("#libType").length)
        $("#libType").click(function() {
            //get the url for the form
            var url = '../../typerecipe/list';

            //start send the post request

            $.get(url, {
                other: "attributes"
            }, function(data) {
                //the response is in the data variable

                //if you want to print the error:
                var htmltype = '<select id="selectType"><option value="">Sans</option>';
                data.map(function(i) {
                    htmltype += '<option value="' + i.id + '"';
                    if (i.name == $("#libType").html()) {
                        htmltype += ' selected="selected"';
                    }
                    htmltype += '>' + i.name + '</li>';

                });
                htmltype += '</select>';


                $("#dialog-changeCategory").html(htmltype);

                $("#selectType").change(function() {
                    var url = '../../recipe/changeType/' + $("#recipe_id").val();
                    $.post(url,
                            'new_type=' + $(this).val(), function(data) {
                        //the response is in the data variable

                        $("#libType").html($('#selectType option:selected').text());
                        $("#dialog-changeCategory").dialog("close");

                    });
                });

                $('#dialog-changeCategory').dialog({
                    autoOpen: true,
                    height: 100,
                    width: 350,
                    modal: true,
                    title: "Changer le Type"
                });



            }, 'json');//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down

            //we dont what the browser to submit the form
            return false;
        });

    if ($("#libFormat").length)
        $("#libFormat").click(function() {
            //get the url for the form
            var url = '../../formatrecipe/list';

            //start send the post request

            $.get(url, {
                other: "attributes"
            }, function(data) {
                //the response is in the data variable

                //if you want to print the error:
                var htmlformat = '<select id="selectFormat"><option value="">Sans</option>';
                data.map(function(i) {
                    htmlformat += '<option value="' + i.id + '"';
                    if (i.name == $("#libFormat").html()) {
                        htmlformat += ' selected="selected"';
                    }
                    htmlformat += '>' + i.name + '</li>';

                });
                htmlformat += '</select>';


                $("#dialog-changeCategory").html(htmlformat);

                $("#selectFormat").change(function() {
                    var url = '../../recipe/changeFormat/' + $("#recipe_id").val();
                    $.post(url,
                            'new_format=' + $(this).val(), function(data) {
                        //the response is in the data variable

                        $("#libFormat").html($('#selectFormat option:selected').text());
                        $("#dialog-changeCategory").dialog("close");

                    });
                });

                $('#dialog-changeCategory').dialog({
                    autoOpen: true,
                    height: 100,
                    width: 350,
                    modal: true,
                    title: "Changer le Format"
                });



            }, 'json');//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down

            //we dont what the browser to submit the form
            return false;
        });

    if ($("#libPrepareTime").length)
        $("#libPrepareTime").click(function() {


            //if you want to print the error:
            var htmlPrepareTime = '<input id="inputPrepareTime" value="' + $("#libPrepareTime").html().replace('??', '') + '" />';



            $("#dialog-changeCategory").html(htmlPrepareTime);

            $("#inputPrepareTime").change(function() {
                var url = '../../recipe/changePrepareTime/' + $("#recipe_id").val();
                $.post(url,
                        'new_prepareTime=' + $(this).val(), function(data) {
                    //the response is in the data variable

                    $("#libPrepareTime").html($('#inputPrepareTime').val());
                    $("#dialog-changeCategory").dialog("close");

                });



            });

            $('#dialog-changeCategory').dialog({
                autoOpen: true,
                height: 100,
                width: 350,
                modal: true,
                title: "Changer le temps de préparation"
            });



            //we dont what the browser to submit the form
            return false;
        });

    if ($("#libCookTime").length)
        $("#libCookTime").click(function() {


            //if you want to print the error:
            var htmlCookTime = '<input id="inputCookTime" value="' + $("#libCookTime").html().replace('??', '') + '" />';



            $("#dialog-changeCategory").html(htmlCookTime);

            $("#inputCookTime").change(function() {
                var url = '../../recipe/changeCookTime/' + $("#recipe_id").val();
                $.post(url,
                        'new_cookTime=' + $(this).val(), function(data) {
                    //the response is in the data variable

                    $("#libCookTime").html($('#inputCookTime').val());
                    $("#dialog-changeCategory").dialog("close");

                });



            });

            $('#dialog-changeCategory').dialog({
                autoOpen: true,
                height: 100,
                width: 350,
                modal: true,
                title: "Changer le temps de cuisson"
            });



            //we dont what the browser to submit the form
            return false;
        });

    if ($("#picture_recipe").length)
        $("#picture_recipe").click(function() {
            //get the url for the form
            var url = location.href + '../../../..' + '/recipe/upload/' + $("#recipe_id").val();
            //$('#upload_picture').show();
            //start send the post request
            $('#upload_iframe').attr('src', url).dialog({autoOpen: true,
                title: 'Ajouter une photo',
                maxWidth: 500,
                maxHeight: 200,
                width: 500,
                height: 200,
                modal: true
            });

            $('#upload_iframe').load(function()
            {
                if ($("#upload_iframe").contents().find("#upload_submit").length) {
                    $("#upload_iframe").contents().find("#upload_submit").click(function()
                    {
                        $("#upload_iframe").contents().find("#upload_form").submit();
                        return false;

                    });
                } else {
                    var img = $("#upload_iframe").contents().find('body').html();
                    $('#picture').attr('src', img);
                    $('#picture').removeClass("opacity20");
                    $('#upload_iframe').dialog("close");
                    $('#content_recipe').focus();
                }

            });


            return false;
        });

    if ($("#new_ingredient").length)
    {
        //get the url for the form
        var url = '../../ingredient/new';

        //start send the post request

        $.get(url, {
            other: "attributes"
        }, function(data) {
            //the response is in the data variable

            //if you want to print the error:
            $('#new_ingredient').html(data);

            $("#add_ingredient").click(addIngredient);

        });



    }

    if ($("#listFormats").length) {
        $("#listFormats").sortable({
            stop: reorderFormat
        });
        $("#listFormats").disableSelection();
    }

    if ($("#listCategories").length) {
        $("#listCategories").sortable({
            stop: reorderCategory
        });
        $("#listCategories").disableSelection();
    }

    if ($("#listTypes").length) {
        $("#listTypes").sortable({
            stop: reorderType
        });
        $("#listTypes").disableSelection();
    }


    if ($("#categories").length)
        $('#categories').buttonset();
    if ($("#types").length)
        $('#types').buttonset();
    if ($("#formats").length)
        $('#formats').buttonset();
    if ($("#difficulties").length) {
        $('#difficulties input').rating({
            callback: changeDifficulty
        });

    }

    if ($("#btn-addNote").length)
    {
        $('#btn-addNote').click(addPostIt);
    }

    if ($("#btnMod").length)
        $("#btnMod").button({
            icons: {
                primary: "ui-icon-pencil"
            }
        });
    if ($("#btnSuppr").length)
        $("#btnSuppr").button({
            icons: {
                primary: "ui-icon-trash"
            }
        });


    if ($("#content_recipe").length)
    {
        editor = new wysihtml5.Editor("content_recipe", {// id of textarea element
            toolbar: "toolbar", // id of toolbar element
            parserRules: wysihtml5ParserRules,
            stylesheets: ["../../../bundles/cookbookcore/wysiwyg/editor.css"]
        });

        editor.on("change", saveContentRecipe);
        editor.on("focus", function() {
            $('#toolbar').show();
        });
        /*editor.on("blur", function(){
         $('#toolbar').hide();
         });*/
    }
// observe

    $(document).ajaxSuccess(function(event, request, settings) {
        if (settings.type == 'POST') {
            $("#msg").append("<li>Modification sauvegardée</li>");
            setTimeout(function() {
                $("#msg").html('');
            }, 1000);
        }
    });

});

var editor;

function removeType(id)
{
    //get the url for the form
    var url = '../../typerecipe/delete/' + id;
    $("#dialog:ui-dialog").dialog("destroy");

    $("#dialog-confirm").dialog({
        resizable: false,
        height: 140,
        modal: true,
        buttons: {
            "Supprimer le type": function() {
                $.get(url, {
                    other: "attributes"
                }, function(data) {
                    $('#order_' + id).remove();
                    reorderType();
                });

                $(this).dialog("close");
            },
            Annuler: function() {
                $(this).dialog("close");
            }
        }
    });
}

function reorderType() {
    var param = $("#listTypes").sortable("serialize");
    $.post('../../typerecipe/reorder',
            param, function(data) {
                //the response is in the data variable
                //console.log('done');
            });
}

function editType(id) {
    //get the url for the form
    var url = '../../typerecipe/edit/' + id;

    //start send the post request

    $.get(url, {
        other: "attributes"
    }, function(data) {
        //the response is in the data variable

        //if you want to print the error:
        $('#new_type').html(data);
        $('#new_type').dialog({
            autoOpen: true,
            height: 300,
            width: 350,
            modal: true,
            title: "Modification Type",
            buttons: {
                "Modifier": function() {
                    //get the url for the form
                    var url = $("#type_form").attr("action");

                    //start send the post request
                    $.post(url,
                            $("#type_form").serialize(), function(data) {
                        //the response is in the data variable
                        if ($('#listTypes').length) {
                            $('#order_span_' + id).html(data.name);
                        }

                        $('#new_type').html();
                    });//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down

                    //we dont what the browser to submit the form
                    $(this).dialog("close");
                },
                "Annuler": function() {
                    $(this).dialog("close");
                }
            },
            close: function() {
                //allFields.val( "" ).removeClass( "ui-state-error" );
            }
        });



    });//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down

}

function removeFormat(id)
{
    //get the url for the form
    var url = '../../formatrecipe/delete/' + id;
    $("#dialog:ui-dialog").dialog("destroy");

    $("#dialog-confirm").dialog({
        resizable: false,
        height: 140,
        modal: true,
        buttons: {
            "Supprimer le format": function() {
                $.get(url, {
                    other: "attributes"
                }, function(data) {
                    $('#order_' + id).remove();
                    reorderFormat();
                });

                $(this).dialog("close");
            },
            Annuler: function() {
                $(this).dialog("close");
            }
        }
    });
}

function reorderFormat() {
    var param = $("#listFormats").sortable("serialize");
    $.post('../../formatrecipe/reorder',
            param, function(data) {
                //the response is in the data variable
                //console.log('done');
            });
}

function editFormat(id) {
    //get the url for the form
    var url = '../../formatrecipe/edit/' + id;

    //start send the post request

    $.get(url, {
        other: "attributes"
    }, function(data) {
        //the response is in the data variable

        //if you want to print the error:
        $('#new_format').html(data);
        $('#new_format').dialog({
            autoOpen: true,
            height: 300,
            width: 350,
            modal: true,
            title: "Modification Format",
            buttons: {
                "Modifier": function() {
                    //get the url for the form
                    var url = $("#format_form").attr("action");

                    //start send the post request
                    $.post(url,
                            $("#format_form").serialize(), function(data) {
                        //the response is in the data variable
                        if ($('#listFormats').length) {
                            $('#order_span_' + id).html(data.name);
                        }

                        $('#new_format').html();
                    });//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down

                    //we dont what the browser to submit the form
                    $(this).dialog("close");
                },
                "Annuler": function() {
                    $(this).dialog("close");
                }
            },
            close: function() {
                //allFields.val( "" ).removeClass( "ui-state-error" );
            }
        });



    });//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down

}

function removeCategory(id)
{
    //get the url for the form
    var url = '../../categoryrecipe/delete/' + id;
    $("#dialog:ui-dialog").dialog("destroy");

    $("#dialog-confirm").dialog({
        resizable: false,
        height: 140,
        modal: true,
        buttons: {
            "Supprimer le category": function() {
                $.get(url, {
                    other: "attributes"
                }, function(data) {
                    $('#order_' + id).remove();
                    reorderCategory();
                });

                $(this).dialog("close");
            },
            Annuler: function() {
                $(this).dialog("close");
            }
        }
    });
}

function reorderCategory() {
    var param = $("#listCategories").sortable("serialize");
    $.post('../../categoryrecipe/reorder',
            param, function(data) {
                //the response is in the data variable
                //console.log('done');
            });
}

function editCategory(id) {
    //get the url for the form
    var url = '../../categoryrecipe/edit/' + id;

    //start send the post request

    $.get(url, {
        other: "attributes"
    }, function(data) {
        //the response is in the data variable

        //if you want to print the error:
        $('#new_cat').html(data);
        $('#new_cat').dialog({
            autoOpen: true,
            height: 300,
            width: 350,
            modal: true,
            title: "Modification Categorie",
            buttons: {
                "Modifier": function() {
                    //get the url for the form
                    var url = $("#cat_form").attr("action");

                    //start send the post request
                    $.post(url,
                            $("#cat_form").serialize(), function(data) {
                        //the response is in the data variable
                        if ($('#listCategories').length) {
                            $('#order_span_' + id).html(data.name);
                        }

                        $('#new_cat').html();
                    });//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down

                    //we dont what the browser to submit the form
                    $(this).dialog("close");
                },
                "Annuler": function() {
                    $(this).dialog("close");
                }
            },
            close: function() {
                //allFields.val( "" ).removeClass( "ui-state-error" );
            }
        });



    });//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down

}

function removeIngredient(id)
{
    //get the url for the form
    var url = '../../ingredient/delete/' + id;
    $("#dialog:ui-dialog").dialog("destroy");

    $("#dialog-confirm").dialog({
        resizable: false,
        height: 140,
        modal: true,
        buttons: {
            "Supprimer l'ingrédient": function() {
                $.get(url, {
                    other: "attributes"
                }, function(data) {
                    $('#ingredient-' + id).remove();
                });

                $(this).dialog("close");
            },
            Annuler: function() {
                $(this).dialog("close");
            }
        }
    });

}

function addIngredient()
{
    //get the url for the form
    var url = $("#ingredient_form").attr("action");

    //start send the post request
    $.post(url,
            $("#ingredient_form").serialize() + '&recipe_id=' + $("#recipe_id").val(), function(data) {
        //the response is in the data variable
        $("#ingredients_list").append('<li id="ingredient-' + data.id + '"><a href="#">' + data.name + '</a><span class="rfloat hand" onclick="removeIngredient(' + data.id + '); return false;">x</span></li>');
        //$('#cookbook_corebundle_recipetype_type').append('<option value="'+data.id+'" selected="selected">'+data.name+'</option>')
        $('#form_name').val('');
    });//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down

    //we dont what the browser to submit the form
    $(this).dialog("close");

}


function saveContentRecipe() {
    //get the url for the form
    var url = '../../recipe/changeContent/' + $("#recipe_id").val();

    //start send the post request
    $.post(url,
            'content=' + editor.getValue());//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down

}
;


function removePostIt(id)
{
    //get the url for the form
    var url = '../../postitrecipe/delete/' + id;
    $("#dialog:ui-dialog").dialog("destroy");

    $("#dialog-confirm").dialog({
        resizable: false,
        height: 140,
        modal: true,
        buttons: {
            "Supprimer ce post-it": function() {
                $.get(url, {
                    other: "attributes"
                }, function(data) {
                    $('#postit-' + id).remove();
                });

                $(this).dialog("close");
            },
            Annuler: function() {
                $(this).dialog("close");
            }
        }
    });

}

function addPostIt()
{
    //get the url for the form
    var url = '../../postitrecipe/new/';

    //start send the post request
    $.post(url,
            'recipe_id=' + $("#recipe_id").val(), function(data) {
        //the response is in the data variable
        $('#board ul').append('<li id="postit-' + data.id + '"><div><h2 contenteditable="true" onblur="changePostItTitle(' + data.id + ');">' + data.title + '</h2><span class="rfloat hand" onclick="removePostIt(' + data.id + '); return false;">x</span><p contenteditable="true" onblur="changePostItContent(' + data.id + ');">' + data.comment + '</p></div></li>');

    });//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down


}

function changePostItTitle(id, content) {
    //get the url for the form
    var url = '../../postitrecipe/changetitle/';

    //start send the post request
    $.post(url,
            'id=' + id + '&title=' + $(content).html(), function(data) {
        return true;

    });//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down   
}

function changePostItContent(id, content) {
    //get the url for the form
    var url = '../../postitrecipe/changecontent/';

    //start send the post request
    $.post(url,
            'id=' + id + '&content=' + $(content).html(), function(data) {
        //the response is in the data variable

    });//It is silly. But you should not write 'json' or any thing as the fourth parameter. It should be undefined. I'll explain it futher down   
}


function changeDifficulty(value, link) {
    console.debug('rate');
    console.debug(value);
    var url = '../../recipe/changeDifficulty/' + $("#recipe_id").val();
    $.post(url,
            'new_difficulty=' + value, null);

}


function removeRecipe(lien)
{
    //get the url for the form
    url = lien.href;
    $("#del").dialog({
        resizable: false,
        height: 140,
        modal: true,
        buttons: {
            "Supprimer ce Plat": function() {

                $(this).dialog("close");
                window.location.href = url;
                return true;
            },
            Annuler: function() {
                $(this).dialog("close");
                return false;
            }
        }
    });
}





