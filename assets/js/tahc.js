/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {

    //$('msg-per').val('primero');
    var fStart = $.now();


    //  alert(fStartp);
    $('form[name="form-msg"]').attr('id', $.rc4EncryptStr('form-msg', fStart.toString()));
    $('input[name="yek"]').attr('id', 'yek');
    $('input[name="msg"]').attr('id', $.rc4EncryptStr('msg', fStart.toString()));

    $('#' + $.rc4EncryptStr('form-msg', fStart.toString())).attr('action', 'enviar');
    $('#' + $.rc4EncryptStr('form-msg', fStart.toString())).attr('method', 'post');

    $('#' + $.rc4EncryptStr('form-msg', fStart.toString())).submit(function (event) {
        // alert($('#'+$.rc4EncryptStr('yek', fStart.toString())).val());
        // return false;
        if ($('#' + $.rc4EncryptStr('yek', fStart.toString())).val() === "")
            return false;
        if ($('#' + $.rc4EncryptStr('msg', fStart.toString())).val() === "")
            return false;


        // $('msg-per').val($('input[name="msg"]').val());

        $('msg-per').val($.rc4EncryptStr($('input[name="msg"]').val(), $.rc4DecryptStr($.base64.decode($('#yek').val()), fStart.toString())));
        alert($('msg-per').val());
        alert($.base64.encode($('msg-per').val()));
        $.ajax({
            type: 'post',
            url: 'hobbychat/send',
            dataType: 'json',
            data: {'dat': {'key': $.base64.encode($('#yek').val()), 'message': $.base64.encode($('msg-per').val())}}

        }).done(function (resp) {

            alert(resp);
            //  $('#tahc').append($.rc4DecryptStr($.base64.decode(resp, true), $('#yek').val()));

            // var r = JSON.parse(resp);

            alert(resp.msg);


        }).fail(function (resp) {

            alert('fail');
            alert(resp);

        });

        return false;

    });
    
    
    
    $('#addUser').click(function(){
       
       addUser();
        
    });
    
     $('#deleteUser').click(function(){
       
       deleteUser();
        
    });


    $('#onkey').click(function () {
        //   alert('a');
        onKey('yek');

    });





    function onKey(id) {

        var v = $('#' + id).val();
        $('#' + id).val($.base64.encode($.rc4EncryptStr($('#' + id).val(), fStart.toString())));

        $.ajax({
            type: 'post',
            url: 'hobbychat/onkey',
            data: {yek: $.base64.encode(v)}

        }).done(function (resp) {
            // alert(resp);
            var r = JSON.parse(resp);

            //alert(r.resp);

            if (r.resp === 200) {

                $('#' + id).attr('disabled', '');
                $('#onkey').html("Liberar Llave");
                $('#onkey').unbind('click');
                $('#onkey').click(function () {

                    freeKey(id);

                });
                alert(r.msg);
                receive($('#' + id).val());
            }

        }).always(function () {




        });


    }



    function freeKey(id) {

        //  alert('liberar');

        $.ajax({
            type: 'put',
            url: 'hobbychat/freekey'


        }).done(function (resp) {
            alert(resp);
            var r = JSON.parse(resp);

            //alert(r.resp);

            if (r.resp == 200) {

                $('#' + id).removeAttr('disabled');
                $('#' + id).val();
                $('#onkey').html("Establer Llave");
                $('#onkey').unbind('click');
                $('#onkey').click(function () {

                    onKey('yek');

                });
                alert(r.msg);

            }

        });

    }


    function receive(key) {

        alert(key);

        $.ajax({
            type: 'get',
            url: 'hobbychat/receive',
            dataType: 'json'


        }).done(function (resp) {
            //  alert(resp);
            //  var r = JSON.parse(resp);

            //alert(resp.resp);

            if (resp.resp == 200) {


                var str = $.rc4DecryptStr($.base64.decode(resp.msg['message']), $.rc4DecryptStr($.base64.decode(key), fStart.toString()));

                if (str == -1) {

                    alert('Imposible obtener valores, verifique su llave');

                } else {

                    $('#tahc').append('<div>' + str + '</div>');

                }

            }

        });

    }
    
    function addUser(){
        
        $.ajax({
            
            
            type : 'post',
            dataType : 'json',
            url : 'usuario/addUser',
            data : { 'dat' : { 'name' : 'Henry Martínez',
                               'user' : 'martinezherny2',
                               'email': 'hmartinez@sistemashm.com2',
                               'pass' : '12345'
                               
                    } }
            
        }).done(function(resp){
            
            alert(resp.status);
            alert(resp.msg);
        }).fail(function(resp){
            alert(resp.status);
            alert(resp.msg);
        });
        
    }
    
    function deleteUser(){
        
        $.ajax({
            
            
            type : 'delete',
            dataType : 'json',
            url : 'usuario/deleteUser/16'
           // data : { 'dat' : { 'idusuario' : '16'
                               
                    
            
        }).done(function(resp){
            
            alert(resp.status);
            alert(resp.msg);
        }).fail(function(resp){
            alert(resp.status);
            alert(resp.msg);
        });
        
    }



});



          