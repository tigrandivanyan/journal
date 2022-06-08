

// check if date_start and date_end passed to entry filtration have a correct format
function isValidDate(value, userFormat) {
    userFormat = userFormat || 'yyyy-mm-dd';
    let delimiter = /[^mdy]/.exec(userFormat)[0];
    let theFormat = userFormat.split(delimiter);
    let theDate = value.split(delimiter);

    function isDate(date, format) {
        let m, d, y, i = 0, len = format.length, f;
        for (i; i < len; i++) {
            f = format[i];
            if (/m/.test(f)) m = date[i];
            if (/d/.test(f)) d = date[i];
            if (/y/.test(f)) y = date[i];
        }
        return (
            m > 0 && m < 13 &&
            y && y.length === 4 &&
            d > 0 &&
            // Is it a valid day of the month?
            d <= (new Date(y, m, 0)).getDate()
        );
    }

    return isDate(theDate, theFormat);

}
//END



// announcements handling area,
        const announcementElements = document.querySelectorAll('.div-announcement-elements');

        let showAllAnnouncementsBtn = document.querySelector('#showAllAnnouncementsBtn'); //  show all announcements press button action
        showAllAnnouncementsBtn.addEventListener("click",function(e){
            document.querySelector('.announcements-wrapper').classList.add('ins');
            announcementElements.forEach(function(elem) {
                elem.classList.remove('d-none');
            });
            document.querySelectorAll('.delete-notification-btn').forEach(function(elem){
                elem.classList.remove('d-none');
            });
        }, false);
//END


//reveal only announcements to show

    if(announcementElements.length >=3){
        for( let i = 0; i<3; i++){
            announcementElements[i].classList.remove('d-none');
        }
    }else{
        announcementElements.forEach(function(e){
            e.classList.remove('d-none');
        });
    }
//END



// date and time calculation
        let dt = new Date();
        let seconds, minutes, month, day, currentHour, year;

        day = dt.getDate();
        month = dt.getMonth() + 1;
        year = dt.getFullYear();

        if(month<10){month = '0'+ month}
        if(day<10){day = '0'+ day}

        if (dt.getHours()<10 ) {currentHour = '0' + dt.getHours(); }else{currentHour = dt.getHours(); }
        if (dt.getMinutes()<10 ) {currentMinutes = '0' + dt.getMinutes();}else{currentMinutes = dt.getMinutes();}

        let todayDayt = year+"-"+month+"-"+day;

//END



// button handler which helps user to fill current time in time input field
        document.querySelectorAll('.set-current-time-for-form').forEach(function(elem) {
            elem.addEventListener('click',  function(e) {
                elem.nextSibling.value = currentHour+":"+ currentMinutes;
            }, false  );
        });
//END



// pagination correction, needed because laravel 5.4 generates wrong markup for bootstrap 4 (its being generates for bootstrap 3 )
        let paginationElements = document.querySelectorAll('.pagination li');
        let paginationElementsInside = document.querySelectorAll('.pagination li *');

        paginationElements.forEach(function(elem) {
            elem.classList.add('page-item');
        });

        paginationElementsInside.forEach(function(elem) {
            elem.classList.add('page-link');
        });
//END


// function to handle modal property selection, and revealing necessary areas of events
        const eventTypeViews = document.querySelectorAll('.main-middle-section article');
        const eventTypeButtons = document.querySelectorAll('.event-type-btn-group button');

        eventTypeButtons.forEach(function(elem) {
            elem.addEventListener('click',  function(e) { reveal(e, elem); }, false  );
        });

        function reveal(e,current) {

            $('#plannedBallSetChangeDate').val(todayDayt);
            $('#unplannedBallSetChangeDate').val(todayDayt);


            $('.bd-example-modal-lg').modal('hide');
            let dataViewType = current.dataset.viewType;
            eventTypeViews.forEach(function(elem) {
                if(dataViewType == elem.dataset.viewType){
                    elem.classList.remove("hidden-container");
                    document.querySelector('.announcements-section').classList.add("hidden-container");
                }else{
                    elem.classList.add("hidden-container");
                }
            });
        }
//END


//-------------------------------------------------------------------------------------------



document.querySelectorAll('.event-edit-button').forEach(function(elem) {
    elem.addEventListener('click',  function(e) {

        axios.post('/ball-journal/get-one-entry-json-format', {
            entryId: elem.dataset.entryId
        })
            .then(function (response) {
                let entryType = response.data.type.name_eng;

                let tempTimeString = response.data.time;
                let timeString = tempTimeString.substring(0, 5);
// console.log(timeString);
                switch(entryType){


                    case "planned_ball_set_change":
                        document.querySelectorAll('.edit-entry-section > article').forEach(function(elem) {
                            elem.classList.add('hidden-container');
                        });
                        document.querySelector('.ball-set-planned-change-edit-modal').classList.remove('hidden-container');
                        document.querySelector('#plannedBallSetChangeDateEdit').value = response.data.date;
                        document.querySelector('#plannedBallSetChangeTimeEdit').value = timeString
                        document.querySelector('#plannedBallSetChangeNumberEdit').value = response.data.ball_set_number;
                        document.querySelectorAll('#plannedBallSetChangeStudioNameEdit option').forEach(function(element){
                            if(element.value == response.data.studio.id){
                                element.selected = 'selected';
                            }
                        });
                        document.querySelector('.planned-ball-set-change-edit-entry_id').value = response.data.id;
                        break;



                    case "unplanned_ball_set_change":
                        document.querySelectorAll('.edit-entry-section > article').forEach(function(elem) {
                            elem.classList.add('hidden-container');
                        });
                        document.querySelector('.ball-set-unplanned-change-edit-modal').classList.remove('hidden-container');

                        document.querySelector('#unplannedBallSetChangeDateEdit').value = response.data.date;
                        document.querySelector('#unplannedBallSetChangeTimeEdit').value = response.data.time;
                        document.querySelectorAll('#unplannedBallSetChangeStudioNameEdit option').forEach(function(element){
                            if(element.value == response.data.studio.id){
                                element.selected = 'selected';
                            }
                        });
                        document.querySelector('#unplannedBallSetChangeNumberEdit').value = response.data.ball_set_number;
                        document.querySelector('#unplannedBallSetChangeDescriptionEdit').value = response.data.description;
                        document.querySelector('.unplanned-ball-set-change-edit-entry_id').value = response.data.id;

                        break;




                    case "ball_change":
                        document.querySelectorAll('.edit-entry-section > article').forEach(function(elem) {
                            elem.classList.add('hidden-container');
                        });
                        document.querySelector('.ball-change-event-modal').classList.remove('hidden-container');

                        document.querySelectorAll('#ballChangeStudioNameEdit option').forEach(function(element){
                            if(element.value == response.data.studio.id){
                                element.selected = 'selected';
                            }
                        });
                        document.querySelector('#ballChangeBallSetNumberEdit').value = response.data.ball_set_number;
                        document.querySelector('#ballChangeBallNumberEdit').value = response.data.ball_number;
                        document.querySelectorAll('#ballChangeBallChangeReasonEdit option').forEach(function(element){
                            if(element.value == response.data.ball_change_reason){
                                element.selected = 'selected';
                            }
                        });
                        document.querySelector('.ball-change-edit-entry_id').value = response.data.id;

                        break;



                    case "technical_message":
                        document.querySelectorAll('.edit-entry-section > article').forEach(function(elem) {
                            elem.classList.add('hidden-container');
                        });
                        document.querySelector('.simple-text-event-edit-modal').classList.remove('hidden-container');
                        document.querySelector('#technicalMessageDescriptionEdit').value = response.data.description;
                        if(response.data.announcement == 1) {
                            document.querySelector('#technicalMessageAnnouncementEdit').checked = true;
                        }else{
                            document.querySelector('#technicalMessageAnnouncementEdit').checked = false;
                        }
                        document.querySelector('.technical-message-edit-entry_id').value = response.data.id;

                        break;
                }


            })
            .catch(function (error) {
                alert('Что то пошло не так, попробуйте еще раз.');
                console.log(error);
            });




        // elem.nextSibling.value = currentHour+":"+ currentMinutes;
    }, false  );
});



