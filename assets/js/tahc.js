/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
       
    var fStart = $.now();


    //  alert(fStartp);
    $('form[name="form-msg"]').attr('id', $.rc4EncryptStr('form-msg', fStart.toString()));
    $('input[name="yek"]').attr('id', 'yek');
    $('input[name="msg"]').attr('id', $.rc4EncryptStr('msg', fStart.toString()));
    $('input[name="msg"]').attr('id');
    $('#' + $.rc4EncryptStr('form-msg', fStart.toString())).attr('action', 'enviar');
    $('#' + $.rc4EncryptStr('form-msg', fStart.toString())).attr('method', 'post');
    $('#' + $.rc4EncryptStr('form-msg', fStart.toString())).hide();

    $('#' + $.rc4EncryptStr('form-msg', fStart.toString())).submit(function (event) {
        // alert($('#'+$.rc4EncryptStr('yek', fStart.toString())).val());
        // return false;
        if ($('#' + $.rc4EncryptStr('yek', fStart.toString())).val() === "")
            return false;
        if ($('#' + $.rc4EncryptStr('msg', fStart.toString())).val() === "")
            return false;


        // $('msg-per').val($('input[name="msg"]').val());

        $('msg-per').val($.rc4EncryptStr($('input[name="msg"]').val(), $.rc4DecryptStr($.base64.decode($('#yek').val()), fStart.toString())));
        //alert($('msg-per').val());
        //alert($.base64.encode($('msg-per').val()));
        $.ajax({
            type: 'post',
            url: 'hobbychat/send',
            dataType: 'json',
            data: {'dat': { 'contenido': $.base64.encode($('msg-per').val()), 'chats_idchats' : '1', 'idusuario_envio' : $('#user-cod').val()}}

        }).done(function (resp) {

           alert(resp);
            //  $('#tahc').append($.rc4DecryptStr($.base64.decode(resp, true), $('#yek').val()));

            // var r = JSON.parse(resp);

          //  alert(resp.msg);
            $('#tahc').append('<div>' + $('input[name="msg"]').val() + '</div>');
            


        }).fail(function (resp) {

            alert('fail');
            alert(resp);

        });

        return false;

    });
    
    $('#form-login').submit(function(){
       
       $('#form-login input[name="clave"]').val($.md5($('#form-login input[name="clave"]').val()));
       $.ajax({
           
           type : 'post',
           url : 'usuario/login',
           dataType : 'json',
           data : { user : $('#form-login input[name="user"]').val(), pass : $.base64.encode($('#form-login input[name="clave"]').val()) }
           
       }).done(function(resp){
          
         // alert(resp);
          
          if (resp.status == 200){
              $('#user-label').html($('#form-login input[name="user"]').val());
            //  alert(resp.datos[0]['idusuario']);
              $('#user-cod').val(resp.datos[0]['idusuario']);
              $('#' + $.rc4EncryptStr('form-msg', fStart.toString())).show('slow');
              $('#form-login input[name="clave"]').attr('disabled', '');
              $('#form-login input[name="name"]').attr('disabled', '');
              $('#form-login').hide('slow');
          } else {
              
              alert(resp.msg);
              $('#form-login input[name="clave"]').val('');
          }
          
       
       }).fail(function (){
           
           alert('error ajax');
           
       });
        return false;
        
    });
    
    
    
    $('#addUser').click(function(){
       
       addUser();
        
    });
    
     $('#deleteUser').click(function(){
       
       deleteUser();
        
    });
    
    $('#updateUser').click(function(){
       
       updateUser();
        
    });
    
    $('#logout').click(function(){
       
       logout();
        
    });



    $('#onkey').click(function () {
        //   alert('a');
        onKey('yek');

    });



    function logout(){
        
        $.ajax({
            
            type : 'put',
            url: 'usuario/logout/1',
            dataType: 'json'
            
        }).done(function(resp){
            
            alert(resp.msg);
            
        }).fail(function(){
            
            alert('fail ajax');
        });
        
        
    }

    function onKey(id) {

        var v = $('#' + id).val();
        
        if ($('#' + id).val() == ""){
            return false;
        }
        
        $('#' + id).val($.base64.encode($.rc4EncryptStr($('#' + id).val(), fStart.toString())));

        $.ajax({
            type: 'post',
            url: 'key/savekey',
            typeData : 'json',
            data: { 'dat' : {
                    'key_utilizada': $.base64.encode(v),
                    'status' : 'A',
                    'chats_idchats' : '1'
                } }

        }).done(function (resp) {
      //  alert('fffd')     ;
       // alert(resp['status']);
           // var r = JSON.parse(resp);

            //alert(r.resp);

            if (resp.status == 200) {

                $('#' + id).attr('disabled', '');
                $('#onkey').html("Liberar Llave");
                $('#onkey').unbind('click');
                $('#onkey').click(function () {

                    freeKey(id);

                });
                $('yek-id').val(resp.id);
              //  alert($('yek-id').val());
              //  alert(resp.msg);
                receive($('#' + id).val());
            }

        }).always(function () {




        });


    }



    function freeKey(id) {

        //  alert('liberar');

        $.ajax({
            type: 'put',
            url: 'key/freekey/'+$('yek-id').val()


        }).done(function (resp) {
          //  alert(resp);
            //var r = JSON.parse(resp);

         //  alert(resp.status);

            if (resp.status == 200) {

                $('#' + id).removeAttr('disabled');
                $('#' + id).val('');
                $('#onkey').html("Establecer Llave");
                $('#onkey').unbind('click');
                $('#onkey').click(function () {

                    onKey('yek');

                });
                $('yek-id').val('');
               // alert(resp.msg);

            } else {
                alert(resp.msg);
            }

        });

    }


    function receive(key) {

      //  alert(key);

        $.ajax({
            type: 'get',
            url: 'hobbychat/receive/1/'+$('#user-cod').val(),
            dataType: 'json'


        }).done(function (resp) {
            //  alert(resp);
            //  var r = JSON.parse(resp);

         //   alert(resp.status);

            if (resp.status == 200) {

          // alert(resp.data.length);
            
            for (var i = 0; i < (resp.data).length; i++){
                
          // alert($.base64.decode(resp.data[i]['contenido']));
            
            if (resp.data['contenido'] != false) {
                var str = $.rc4DecryptStr($.base64.decode(resp.data[i]['contenido']), $.rc4DecryptStr($.base64.decode(key), fStart.toString()));
             

                if (str == -1) {

                    alert('Imposible obtener valores, verifique su llave');
                    return;
                } else {

                    $('#tahc').append('<div>' + str + '</div>');

                }
            }
            
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
    
    
        function updateUser(){
        
        $.ajax({
            
            
            type : 'put',
            dataType : 'json',
            url : 'usuario/updateUser/1',
            data : { 'dat' : { 'name' : 'Henry Martínez',
                               'user' : 'martinezhenry',
                               'email': 'hmartinez@sistemashm.com',
                               'pass' : '123456'
                               
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



          