



$('document').ready(function() {

    var currentRngTour;
    var currentGameStatus;


//announcements handling area

//make last seen element, bottom corners little round, so they stick in design
    $('.div-announcement-elements:eq( 2 )').css({'border-bottom-right-radius':'4px','border-bottom-left-radius':'4px'});



// announcements handling area,
    const announcementElements = document.querySelectorAll('.div-announcement-elements');

    let showAllAnnouncementsBtn = document.querySelector('#showAllAnnouncementsBtn'); //  show all announcements press button action
    showAllAnnouncementsBtn.addEventListener("click",function(e){
        document.querySelector('.announcements-wrapper').classList.add('ins');
        announcementElements.forEach(function(elem) {
            elem.classList.remove('hidden');
        });
        document.querySelectorAll('.delete-notification-btn').forEach(function(elem){
            elem.classList.remove('hidden');
        });
    }, false);
//END

//reveal only announcements to show

    if(announcementElements.length >=3){
        for( let i = 0; i<3; i++){
            announcementElements[i].classList.remove('hidden');
        }
    }else{
        announcementElements.forEach(function(e){
            e.classList.remove('hidden');
        });
    }
//END



    // $('.popUp').on('dialogclose', function(event) {  // trigger new entry add form after we close dialog box after sending message to a support
    $('.successfully-send-msg-to-support-proceed-btn').on('click', function(event) {  // trigger new entry add form after we close dialog box after sending message to a support

        setTimeout(function(){
            $('.show-form-btn').trigger("click");
        }, 300);

        $('#entrySelect').show();
        $('#entryTypeSelector').hide();
        $('.new-entry-div').find('div.col-md-6').first().append("<input type='hidden' name='tech_msg' value='1' >");

        if($.session.get('tech_msg_description_text_exist')){  // execute this part if operator send individual message to support

            var descriptionText = $.session.get('tech_msg_description_text');

            $('.addEntryButton').prop('disabled', true);
            $('#entryDescription').text(descriptionText);
            $('#entrySelect').hide();show-form-btn
            $('#entryTypeSelector').show();

            $('#entryTypeSelectorSelector').change(function(){

                $('#entryDescription').prop('disabled', false).fadeTo(400,1).focus();
                $('.addEntryButton').prop('disabled', false);
                $(this).fadeTo(400,0.4);
            });

            $.session.remove('tech_msg_description_text_exist');
        }else {  // execute this part if we send msg to support from templates


            var descriptionId = $.session.get('tech_msg_description_id');
            $('.description-class').each(function () {
                var tempDescriptionValue = $(this).data('description-id');
                if (tempDescriptionValue == descriptionId) {
                    $(this).attr('selected', 'selected');
                    $('#entryDescription').prop('disabled', false);
                    $('#entryDescription').text($(this).text());

                } else {
                    $(this).removeAttr('selected');
                }
            });

        }
    });




    var studio_name = $('#newEntryForm').find("input[name='studio']").val();
    var studio_id = $('#newEntryForm').find("input[name='studio_id']").val();
    var studio_order_id = $('#newEntryForm').find("input[name='studio_order_id']").val();
    var rng_id = $('#newEntryForm').find("input[name='rng_id']").val();


    $('.alertInfoBtn').hover(function(event){
        $(this).parent().parent().find('.show-alert-date').toggleClass('show-alert-date-hover');
    });


    $('.entry-table-row').hover(function(){// hovering on entry table row, to display edit entry button
        $('.entry-table-row').not(this).removeClass('entry-row-hover');
        $(this).toggleClass('entry-row-hover');
        $('.editButton').not($(this).find('.editButton')).addClass('unvisible-entry-edit-btn');
        $(this).find('.editButton').toggleClass('unvisible-entry-edit-btn');
    });


    $('.new-entry-div').hide();  // hide new entry area when  page loads
    $('#entryDescription').prop('disabled', true).fadeTo(400,0.4);  // disable text area for new entry, to avoid not choosing entry type



    $('.show-form-btn').click(function(){  //add new entry btn click
        $('.new-entry-div').show();   //display new entry area block



// right now this approach with synchronous api call, is bed because if the APi would not response, all the rest JS will not work
        $.ajax({
            async: false,
            type: 'GET',
            url: '/api/api_get_current_tour/'+rng_id,
            success: function(data) {
                currentRngTour = data[1];
                currentRngTour = parseInt(currentRngTour);
            }
        });

        // console.log('this is studio rng id: '+ studio_order_id);

        var dt = new Date();   // date and time calculation for new entry form
        var seconds, minutes, month, day, currentHour;
        month = dt.getMonth() + 1;
        day = dt.getDate();
        if(month<10){month = '0'+ month}
        if(day<10){day = '0'+ day}
        var myDate = dt.getFullYear() + "-" + month + "-" + day;

        if (dt.getHours()<10 ) {
            currentHour = '0' + dt.getHours();
        }else{
            currentHour = dt.getHours();
        }
        if(dt.getSeconds()<10 && dt.getMinutes()<10){
            seconds = '0'+ dt.getSeconds();
            minutes = '0'+ dt.getMinutes();
            myTime = currentHour + ":" + minutes + ":" + seconds;
        } else if (dt.getSeconds()<10 ){
            seconds = '0'+ dt.getSeconds();
            myTime = currentHour + ":" + dt.getMinutes() + ":" + seconds;
        } else if (dt.getMinutes()<10) {
            minutes = '0'+ dt.getMinutes();
            myTime = currentHour + ":" + minutes + ":" +  dt.getSeconds();
        } else {
            myTime = currentHour + ":" + dt.getMinutes() + ":" + dt.getSeconds();
        }

        $('.new-entry-div input#entryTime').val(myTime);  //  substitute calculated time value to input
        $('.new-entry-div input#entryDate').val(myDate);  //  substitute calculated date value to input




        if(studio_name == "wheel") {   // if studio WHEEL

            $('.description-class:eq(0)').addClass('sectorCorrection');  // add classes for entry description for first 2 options, to then call help window
            $('.description-class:eq(1)').addClass('sectorCorrection2');

        }


        var tourNum = 0;
        var objectWithRightTour;
        var oldTourTime;
        var oldTourDate;

       var maybeTour =  $('.tourForPicker').each(function(){
           var tourNumTemp = $.trim($(this).text());
           if ( $.isNumeric( tourNumTemp ) && tourNumTemp > 0 ){
              tourNum = tourNumTemp;
               objectWithRightTour = $(this);
                oldTourTime = objectWithRightTour.next().next().text();
                oldTourDate = objectWithRightTour.next().text();
               return false;
           }else{
               tourNum = 0;
           }
        });

        $('#entryTour').val(currentRngTour);


       // if (studio_name == "keno" && Number.isInteger(currentRngTour) ){
       //     $('#entryTour').val(currentRngTour);
       // }else{
       //
       //      if ($.trim(myDate) != $.trim(oldTourDate)) {
       //              } else {
       //                  s = oldTourTime.split(':');
       //                  e = myTime.split(':');
       //
       //
       //                  var sec = e[2] - s[2];
       //                  var min_carry = 0;
       //                  if (sec < 0) {
       //                      sec += 60;
       //                      min_carry += 1;
       //                  }
       //
       //
       //                  var min = e[1] - s[1] - min_carry;
       //                  var hour_carry = 0;
       //                  if (min < 0) {
       //                      min += 60;
       //                      hour_carry += 1;
       //                  }
       //                  var hour = e[0] - s[0] - hour_carry;
       //                  if (hour < 0) {
       //                      hour += 24;
       //                  }
       //                  if (hour < 10) {
       //                      hour = '0' + hour;
       //                  }
       //                  if (min < 10) {
       //                      min = '0' + min;
       //                  }
       //                  if (sec < 10) {
       //                      sec = '0' + sec;
       //                  }
       //                  var diff = hour + ":" + min + ":" + sec;
       //                  var resInSec = hour * 3600 + min * 60 + sec * 1;
       //                  var averageGameTime = 60;
       //
       //                  if (studio_name == "keno") {
       //                      averageGameTime = 150;
       //                  } else if (studio_name == "wheel") {
       //                      averageGameTime = 70;
       //                  } else if (studio_name == "poker") {
       //                      averageGameTime = 240;
       //                  } else if (studio_name == "fruits") {
       //                      averageGameTime = 150;
       //                  } else if (studio_name == "roulette") {
       //                      averageGameTime = 50;
       //                  } else if (studio_name == "bingo37") {
       //                      averageGameTime = 60;
       //                  } else if (studio_name == "bingo38") {
       //                      averageGameTime = 73;
       //                  } else {
       //                      averageGameTime = 60;
       //                  }
       //                  var resInSecInt = parseInt(resInSec);
       //                  averageGameTime = parseInt(averageGameTime);
       //                  var gameTotal = parseInt(resInSecInt / averageGameTime);
       //                  gameTotal = parseInt(gameTotal);
       //                  tourNum = parseInt(tourNum);
       //                  tourNum += gameTotal;
       //                  $('#entryTour').val(tourNum);  //substitute calculated tour to a new entry tour number
       //              }
       // }



        var curTime = new Date();  // add time range for new event description block
        var curMinutes, totalTime;

        curHour = '0'+ curTime.getHours();
        curMinutes = '0'+ curTime.getMinutes();
        totalTime = curHour+":"+curMinutes;

        var options = { now: totalTime, //hh:mm 24 hour format only, defaults to current time
            twentyFour: true, //Display 24 hour format, defaults to false
            upArrow: 'wickedpicker__controls__control-up', //The up arrow class selector to use, for custom CSS
            downArrow: 'wickedpicker__controls__control-down', //The down arrow class selector to use, for custom CSS
            close: 'wickedpicker__close', //The close class selector to use, for custom CSS
            hoverState: 'hover-state', //The hover state class to use, for custom CSS
            title: 'Выберите время', //The Wickedpicker's title,
            showSeconds: false, //Whether or not to show seconds,
            secondsInterval: 1, //Change interval for seconds, defaults to 1
            minutesInterval: 1, //Change interval for minutes, defaults to 1
            beforeShow: null, //A function to be called before the Wickedpicker is shown
            show: null, //A function to be called when the Wickedpicker is shown
            clearable: false //Make the picker's input clearable (has clickable "x")
        };

        $('#entryStartTimePicker').wickedpicker(options);
        $('#entryEndTimePicker').wickedpicker(options);
        // $('#textAreaForMatrixChat').wickedpicker(options);   dont know why i did this, but consider to remove

    }); // _END_ add new entry btn click



        $('#addTimeIntervalShowBtn').click(function(event){ // add time interval bnt click
            event.preventDefault();
            $(this).hide();
            $('.add-time-interval-div').show();
            $('.wickedpicker').css({'z-index':'1000000'});
        });

        $('#addTimeIntervalToTextarea').click(function(event){  // add time interval to an new entry text description area, calculation and checking is time interval ir correct
            event.preventDefault();

            var myTime = new Date();
            var myYear = myTime.getFullYear();
            var myMonth = myTime.getMonth() + 1;
            var myDay = myTime.getDate();


            var startTime = $(this).prev().prev().val();
            var startTime1 = startTime.substring(0, 2);
            var startTime2 = startTime.substring(5, 7);
            var endTime = $(this).prev().val();
            var endTime1 = endTime.substring(0, 2);
            var endTime2 = endTime.substring(5, 7);
            var textareaText = $('#entryDescription').val();



            var reserv = new Date(myYear,myMonth,myDay,startTime1,startTime2)/1000;
            if((endTime1 - startTime1)<0){
                myDay++;
            }
            var reserv2 = new Date(myYear,myMonth,myDay,endTime1,endTime2)/1000;

            var unixtime = reserv/1000;
            var unixtime2 = reserv2/1000;
            var absolute =  reserv2 -reserv ;
            if(absolute>= 0 ) {


                if (textareaText.includes(startTime1) || textareaText.includes(startTime2) || textareaText.includes(endTime1) || textareaText.includes(endTime2)) {
                    textareaText = textareaText.substring(16);
                    textareaText = startTime1 + ":" + startTime2 + " - " + endTime1 + ":" + endTime2 + " : " + textareaText;
                    $('#entryDescription').val(textareaText);
                } else {
                    textareaText = startTime1 + ":" + startTime2 + " - " + endTime1 + ":" + endTime2 + " : " + textareaText;
                    $('#entryDescription').val(textareaText);
                }
            }else{
                alert('Интервал времени выбран не правильно!');
            }


        });


    $.mask.definitions['h'] = "[0-2]";   // new entry form time input validation
    $("#entryTime").mask('h9:99:99');

    $("#newEntryForm").validate({   // new entry form inputs validation
        rules: {
            tour: {
                required: false,
                maxlength: 9,
                minlength: 1,
                number:true
            },
            date: {
                required: true,
                date:true
            },
            time: {
                required: true
            },

            description: {
                required: true,
                minlength:4
            },
        },
        messages: {

            tour: {

                minlength: "Поле не должно быть короче 1 символа",
                maxlength: "Поле не должно быть длиннее 9 символов",
                number: "Поле должно состоять из цифр"
            },
            date: {
                required: "Поле не может быть пустым",
                date: "Формат даты должен быть ГГГГ-ММ-ЧЧ"
            },
            time: {
                required: "Поле не может быть пустым"
            },
            description: {
                required: "Поле не может быть пустым",
                minlength: "Поле не должно быть короче 4 символов"
            }

        },
        submitHandler: function(form) {
            form.submit();
        }
    });    //  _END_ new entry form time input validation



    $('.instructionShowBtn').click(function(){      // operator instruction show button
        $('.operator-instruction-wrapper').show();
    });

    $('#instructionHideBtn').click(function(){      // operator instruction hide button
        $('.operator-instruction-wrapper').hide();
    });


    $('#sectorTourCorrection').hide();      // studio wheel tour correction help area hide

    // if(studio_name == "wheel" || studio_name == "poker") {        // studio wheel show + - buttons for tour correction
        var tourVar = 0;
        $('.tour-control-button').show();

        $('#tourPlus').click(function(){    // wheel tour correction + button click
            tourVar = $('#entryTour').val();
            tourVar++;
            $('#entryTour').val(tourVar);
        });

        $('#tourMinus').click(function(){    // wheel tour correction - button click
            tourVar = $('#entryTour').val();
            tourVar--;
            $('#entryTour').val(tourVar);
        });
    // }


    $('.entryTableSort').click(function(){  // entry filter(today, yesterday ...) meny item click, inserting criteria to a form and submiting it
        var sortCriteria = $(this).first().val();
        $('#criteriaName').val(sortCriteria);
        $('#entrieSort').submit();
    });


        $('#buttonForSend').hide();         // entry filter by date (date picker)
        $( "#datepicker" ).datepicker({
            dateFormat: "yy-mm-dd",
            showOn: "button",
            buttonImage:"/img/calendar.gif",
            buttonImageOnly: true
        });

        $( "#datepicker" ).next().hide();  // date picker calendar image hide

        $('.entryTableSortSpecial').click(function(){  // clicking on 'Sort By Date' filter entry item, so it display datepicker calendar and input area
            $(this).hide();
            $( "#datepicker" ).next().show();
            $( "#datepicker" ).show();
        });

        $( "#datepicker" ).change(function(){  // after date was selected trigger that event and submit a filter form
            var sortCriteria = $(this).val();
            $('#criteriaName').val("dateEntries");
            $('#criteriaDate').val(sortCriteria);
            $('#entrieSort').submit();
        });


    $('.editButton').click(function(){      // edit entry button click, showing edit window, and substitute particular values to an form
        if($(this).hasClass('disabled')) {
            alert("Вы можете редактировать только свои записи!");
        }else
            {
            $('.editEntryTd').toggleClass('hiddenTd');

            var entry_id = $(this).data('entry-id');
            var entryTour = $('[data-label="Тур"][data-entry-id='+entry_id+']').html();
            var entryDate = $('[data-label="Число"][data-entry-id='+entry_id+']').html();
            var entryTime = $('[data-label="Время"][data-entry-id='+entry_id+']').html();
            var entryDescription = $('[data-label="Описание"][data-entry-id='+entry_id+']').html();
            var entryAnnouncement = $('[data-label-for-edit="announcement"][data-entry-id='+entry_id+']').html();

            $('.entry-edit-form-wrapper #entry_id').val(entry_id);
            $('.div-for-edit-input #entry-tour').val(entryTour);
            $('.div-for-edit-input #entry-date').val(entryDate);
            $('.div-for-edit-input #entry-time').val(entryTime);
            $('.div-for-edit-textarea').val(entryDescription);

            if(entryAnnouncement==1) {
                $('#divForCheckbox #announcement').attr('checked', 'cheked');
            }else{
                $('#divForCheckbox #announcement').attr('checked', false);
            }
            }
    });



    $('.hideTdBtn').click(function(event){      // entry edit window Cancel button press
        event.preventDefault();
        $('.editEntryTd').addClass('hiddenTd');
    });


        $('#entrySelect').change(function(event){  // add new entry description change, and description type order set

            $('#sectorTourCorrection').hide();
            var labelResult1, labelResult2, labelResult3, globalText;
            var optionText = $( "#entrySelect option:selected" ).text();

            if ( $( "#entrySelect option:selected" ).hasClass( "entry-description-another-problem" ) ) {
                $('#entryTypeSelector').show().delay(600);
                $('#entryTypeSelectorSelector').focus();
                $('#entrySelect').fadeTo(400,0.4);
                $('#entryDescription').prop('disabled', true).fadeTo(400,0.4);
                $('#entryTypeSelectorSelector').change(function(){
                    var result =  $(this).val();
                    $('#entrySelect').val(result).hide();
                    $(this).fadeTo(400,0.4);
                    $('#entryDescription').val('').prop('disabled', false).fadeTo(400,1).focus();
                });
            }else{
                $('#entryTypeSelector').hide();
                $('#entryDescription').prop('disabled', false);

                    if ( $( "#entrySelect option:selected" ).hasClass( "sectorCorrection" ) ) { // studio wheel wrong sector correction helper, first choice '-->'
                        $('#sectorTourCorrection').show();

                        $(".ui-checkboxradio[name='radio-1']").click(function(){
                            labelResult1 = $(this).prev().text();
                        });
                        $(".ui-checkboxradio[name='radio-2']").click(function(){
                            labelResult2 = $(this).prev().text();
                        });
                        $(".ui-checkboxradio[name='radio-3']").click(function(){
                            if(labelResult1 && labelResult2) {
                                labelResult3 = $(this).prev().text();
                                globalText = 'Число сектора ' + labelResult1 + ' --> ' + labelResult2 + ' ID: ' + labelResult3;
                                $('#entryDescription').val(globalText).focus();
                                $('#entrySelect').fadeTo(400, 0.4);
                            }else{
                                alert ('Вначале выберите Начальное значение и Конечное значение!');
                            }
                        });
                    }


                    if ( $( "#entrySelect option:selected" ).hasClass( "sectorCorrection2" ) ) {  // studio wheel wrong sector correction helper, second choice '<--'
                        $('#sectorTourCorrection').show();
                        $(".ui-checkboxradio[name='radio-1']").click(function(){
                            labelResult1 = $(this).prev().text();
                        });

                        $(".ui-checkboxradio[name='radio-2']").click(function(){
                            labelResult2 = $(this).prev().text();
                        });

                        $(".ui-checkboxradio[name='radio-3']").click(function(){
                            if(labelResult1 && labelResult2) {
                                labelResult3 = $(this).prev().text();
                                globalText = 'Число сектора '+labelResult1 +' <-- '+labelResult2+' ID: '+labelResult3;
                                $('#entryDescription').val(globalText).focus();
                                $('#entrySelect').fadeTo(400,0.4);
                            }else{
                                alert ('Вначале выберите Начальное значение и Конечное значение!');
                            }
                        });

                    }

            $('#entryDescription').val(optionText).focus().fadeTo(400,1);
            $('#entrySelect').fadeTo(400,0.4);

            }
        });




    $('.openSupportButtons').click(function() {  // technical support button opener
        $('#divForBegginers').toggleClass("show-support-message-blog");

    } );

    $('.openChat').click(function() {  // technical chat open btn
        $('#divForChat').toggleClass("show-support-message-blog");
        $(this).removeClass('redButtonBorder');
    } );


    $( function() {
            $( "input.ui" ).checkboxradio({
                icon: false
            });
        } );


    function getTimeBreaks() {  // display time-breaks intervals// unuset block // consider to delete
        var getUrl = window.location;
        var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.substr(1);

        $.get(baseUrl+'/ajax/time-break').done(function(data) {
            $('.timeBreakContainer').html(data);
        })
    }


    if ($('.timeBreakContainer')) {
        getTimeBreaks();
        setInterval(getTimeBreaks, 5000);
    }


    });

