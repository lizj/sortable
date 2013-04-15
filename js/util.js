            
$(function() {
    tourl='manageDB/db_persona.php?op=1';
    modalForm("Add",0,tourl);
    $( "#add" )
    .click(function() {
        $( "#person-form" ).dialog( "open" );
    });
});

function deleteRow(id){
    $("#confirm-delete").dialog({
        resizable: false,
        height:140,
        modal: true,
        title: "Delete record",
        buttons: {
            "Yes": function() {
                $.ajax({
                    type: 'post',
                    data: "id="+id,
                    url: 'manageDB/db_persona.php?op=3',
                    success: function(response) {
                        $("#container").load('persona.php');
                        $("#confirm-delete").dialog("close");
                        
                    }
                });
          
            },
            "No": function() {
                $( this ).dialog( "close" );
            }
        }
    });
    
    $("#confirm-delete").show();
}

function editRow(id){
    tourl='manageDB/db_persona.php?op=2';
    modalForm("Edit",id,tourl);
    $( "#person-form" ).dialog( "open" );
}

function addRow(){
    tourl='manageDB/db_persona.php?op=1';
    modalForm("Add",0,tourl);
    $( "#person-form" ).dialog( "open" );
}

function orderBy(value){
    divListado = document.getElementById('container');
    ajax = objetoAjax();
    ajax.open("get", "persona.php"+"?orderby="+value);
    ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
            divListado.innerHTML = ajax.responseText
        }
    }
    ajax.send(null)
}

function objetoAjax()
{
    var xmlhttp = false;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    }catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
 
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

function modalForm(title,id,tourl){
    $("#person-form").attr("title", title);
    var first_name,last_name,country,city,address,email;
    if(id>0){
        $( "#first-name" ).val($( "#first_name_"+id ).html());
        $( "#last-name" ).val($( "#last_name_"+id ).html());
        $( "#country" ).val($( "#country_"+id ).html());
        $( "#city" ).val($( "#city_"+id ).html());
        $( "#address" ).val($( "#address_"+id ).html());
        $( "#email" ).val($( "#email_"+id ).html());
    }
    first_name = $( "#first-name" ),last_name = $( "#last-name" ),
    country = $( "#country" ),city = $( "#city" ),
    address = $( "#address" ),email = $( "#email" );
    var allFields = $( [] ).add(first_name).add(last_name).
    add(country).add(city).add(address).add(email),
    tips = $( ".validateTips" );
 
    function updateTips( t ) {
        tips
        .text( t )
        .addClass( "ui-state-highlight" );
    }
 
    function checkLength( o, n, min, max ) {
        if ( o.val().length > max || o.val().length < min ) {
            o.addClass( "ui-state-error" );
            updateTips( "Length of " + n + " must be between " +  min + " and " + max + "." );
            return false;
        } else {
            return true;
        }
    }
 
    function checkRegexp( o, regexp, n ) {
        if ( !( regexp.test( o.val() ) ) ) {
            o.addClass( "ui-state-error" );
            updateTips( n );
            return false;
        } else {
            return true;
        }
    }
    $( "#person-form" ).dialog({
        autoOpen: false,
        height: 300,
        width: 350,
        modal: true,
        buttons: {
            Save: function() {
                var bValid = true;
                allFields.removeClass( "ui-state-error" );
                bValid = bValid && checkLength( first_name, "", 3, 50 );
                bValid = bValid && checkLength( last_name, "", 3, 100 );
                bValid = bValid && checkLength( email, "email", 6, 100 );
                bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. name@domino.com" );
 
                if ( bValid ) {
                    $.ajax({
                        type: 'post',
                        data: $("#new").serialize()+ "&id=" + id,
                        url: tourl,
                        success: function(response) {
                            $("#message").replaceWith(response);
                            $("#person-form").dialog("close");
                            $("#container").load('persona.php');
                        }
                    });
                }
            },
            Cancel: function() {
                $( this ).dialog( "close" );
                tips.html("");
            }
        },
        close: function() {
            allFields.val( "" ).removeClass( "ui-state-error" );
            tips.removeClass( "ui-state-highlight" );
            tips.html("");
                        
        }
    });
}