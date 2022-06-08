

$('document').ready(function() {


    var studio_name = $('#newEntryForm').find( "input[name='studio']" ).val();
    var studio_name_ru = $('#newEntryForm').find( "input[name='studio_name_ru']" ).val();
    var studio_id = $('#newEntryForm').find( "input[name='studio_id']" ).val();
    var chat_message = $('#formForMatrixChat').find( "input[name='message']" ).val();
    var operator_name = $('.auth-drop-down').data('operator-name');



    var chatToken;
   function getTokenFromCache(){


        $.ajax({
            type: "GET",
            url: '/cache-token',
            async: true,
            dataType:"text",
            success: function(data){
                console.log('dd');
                console.log('check : '+ data);
                if(data != chatToken){
                    renderingChatTable(studio_id, 10);
                   chatToken = data;
                }

            },
            error: function(jqXHR, textStatus, error){

                console.log(error);
            }
        });
        }


    getTokenFromCache();


    var refreshCounter = 0;
   // / renderingChatTable(studio_id);  // render chat table for a first time

    window.setInterval(function(){  //repeat every 10 sec. Check new messages in chat via Api
        getTokenFromCache();
    }, 10000);




    $('#showAllChatMessages').click(function(){  // return and display chat history
        renderingChatTable(studio_id,30);
    });







    $(".tech-suport-specific-msg-sender").click(function(evt){  // send message to support
        evt.preventDefault();




        var studio_name_ru = $(this).data('studio');
        var chat_message2 = $(this).prev().val();

        $.session.set('tech_msg_description_text', $(this).prev().val());
        $.session.set('tech_msg_description_text_exist', 'true' );

        var clicked_object2 = $(this);



        $(this).html('<img height="14px;" src="../img/load.gif">').delay(10000000);
        $(this).addClass('pressed-support-msg');

        var data = {
            'support':1,
            'description_type_id':12,
            'studio_id':studio_id,
            'studio_name':studio_name,
            'studio_name_ru':studio_name_ru,
            'chat_message':chat_message2
        };

        $.ajax({
            type: "GET",
            url: '/matrix/send-message',
            async: true,
            data:data,
            dataType:"text",
            success: function(data){
                clicked_object2.html('Отправить');


                $('.successfully-send-msg-to-support').toggleClass('hidden');
                $('.successfully-send-msg-to-support-proceed-btn').removeClass('hidden');


                $('#divForBegginers').hide();
                $('#exampleModalLabel').hide();


                if(data && $.isNumeric(data)){

                    getLatestEntry(data, studio_name);
                }
            },
            error: function(jqXHR, textStatus, error){
                alert('Произошла ошибка, попробуйте снова!');
                console.log("ошибка чата");
                console.log(error);
            }
        });
    });


    $(".msg-for-support").click(function(evt){  // send message to support
            evt.preventDefault();


            var tech_msg_description_id = $(this).data('description-id');

            $.session.set('tech_msg_description_id', tech_msg_description_id);
            var clicked_object = $(this);
            var object_text = $(this).text();
            var chat_message = $(this).val();

            $(this).html('Отправляем <img height="16px;" src="../img/load.gif">');
            $(this).addClass('pressed-support-msg');

            var data = {
                'support':1,
                'description_type_id':12,
                'studio_id':studio_id,
                'studio_name':studio_name,
                'studio_name_ru':studio_name_ru,
                'chat_message':chat_message
            };

            $.ajax({
                type: "GET",
                url: '/matrix/send-message',
                async: true,
                data:data,
                dataType:"text",
                success: function(data){
                   clicked_object.text(object_text);

                   $('.successfully-send-msg-to-support').toggleClass('hidden');
                   $('.successfully-send-msg-to-support-proceed-btn').removeClass('hidden');

                   $('#divForBegginers').hide();
                   $('#exampleModalLabel').hide();


                   if(data && $.isNumeric(data)){

                      getLatestEntry(data, studio_name);
                   }
                },
                error: function(jqXHR, textStatus, error){
                    clicked_object.text('Не отправлено').text(object_text);
                    $('.un-successfully-send-msg-to-support').removeClass('hidden');

                }
            });
        });




    function getLatestEntry(id, studioName){

        $.ajax({
            type: "GET",
            url: '/studio/'+studioName+'/entry/show',
            async: true,
            data:{'id':id},
            dataType:"json",
            success: function(data){
                 $('.entry-list-tbody').prepend("<tr class='entry-table-row'><td data-label='Тур' data-entry-id='' class='table-text tourForPicker'></td>" +
                     "<td data-label='Число' data-entry-id='' class='table-text  tableDateSize'>"+data.date+"</td>"+
                     "<td data-label='Время' data-entry-id='' class='table-text timeForPicker'>"+data.time+"</td>"+
                     "<td data-label='Оператор' data-entry-id="+data.id+" class='table-text operator-name'>"+operator_name+" </td>"+
                     "<td data-label='Описание' data-entry-id="+data.id+" class='table-text'>"+data.description +"</td><td></td></tr>");


                // console.log('returned data:');
                  //console.log(data);
                return data;
            },
            error: function(jqXHR, textStatus, error){

                console.log('miss');
                console.log(error);
            }
        });

    }


        $('#textAreaForMatrixChat').focus(function(){
                $('#sendMessageToChat').html('Отправить');
        });

        $('#sendMessageToChat').click(function(evt){
            evt.preventDefault();
            var chat_message = $('#textAreaForMatrixChat').val();
            if(chat_message==''){
                alert('Введите что-нибудь!');
                return;}
            $(this).html('Отправляем <img height="20px;" src="../img/load.gif">').prop('disabled', true);
            var data = {
                'studio_id':studio_id,
                'studio_name':studio_name,
                'chat_message':chat_message
            };
            console.log(studio_name);
            $.ajax({
                type: "GET",
                url: '/matrix/send-message',
                async: true,
                data: data,
                dataType:"text",
                success: function(data){
                    console.log(data);
                    $('#sendMessageToChat').html('Отправлено <img height="20px;" src="../img/new_check.png">').prop('disabled', false);
                    $('#textAreaForMatrixChat').val('');
                    renderingChatTable(studio_id);
                },
                error: function(jqXHR, textStatus, error){
                    alert('Произошла ошибка, попробуйте снова!');
                    console.log(error);
                }
            });
        });


    function renderingChatTable(studio_id, limit=10){

        $.ajax({
            type: "GET",
            url: '/matrix/grab-messages',
            async: true,
            data:{'studio_id':studio_id,'limit':limit},
            dataType:"json",
            success: function(data){
                console.log('return data');
                // console.log(data);
                var currentChatState = $('.matrixChatMessageList').html();
               $('.matrixChatMessageList').html('');
                $.each( data, function( key, value ) {

                    var prepareChatElement =  "<p><i class='glyphicon glyphicon-triangle-right'></i> <span>"+value.age+": "+value.sender+" </span>"+value.body+"</p>";
                    $('.matrixChatMessageList').prepend(prepareChatElement);
                });
                var newChatState = $('.matrixChatMessageList').html();

                if(currentChatState!=newChatState && !$('#divForChat').hasClass('show-support-message-blog') && refreshCounter>0){
                    $('.openChat').addClass('redButtonBorder');
                    alert('Новое сообщение!');
                }
                refreshCounter++;
            },
            error: function(jqXHR, textStatus, error){
                $('.matrixChatMessageList').html('Ошибка загрузки сообщений, обновите страницу!');
                console.log(error);
            }
        });

    }





    });

