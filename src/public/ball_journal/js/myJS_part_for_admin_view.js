
//set a limitations on what date can be set when filtering events by date(not further then today)
        let inputDateElements = document.querySelectorAll('.form-date');
        inputDateElements.forEach(function(elem) {
            elem.value = todayDayt;
            elem.setAttribute('max', todayDayt);
        });

        document.querySelector('#filterDateStart').setAttribute('max', todayDayt);
        document.querySelector('#filterDateEnd').setAttribute('max', todayDayt);
//END


// action on what to do when pressing 'Enter' button while in ball set filtering mode
        const filterBallSetInput = document.querySelector(".entry-filter-ball-set-number-submit-input");

        filterBallSetInput.addEventListener("keypress", function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                document.querySelector(".entry-filter-ball-set-number-submit-button").click();
            }
        });
//END


// adding event listeners no filtering area to handle opening and hidding different area of filtering
        document.querySelector('.entry-filter-ball-set-number').addEventListener("click",function(e){
            e.preventDefault();
            document.querySelector('.entry-filter-ball-set-number-container').classList.toggle('d-none');
        }, false);


        document.querySelector('.entry-filter-event-type').addEventListener("click",function(e){
            e.preventDefault();
            document.querySelector('.entry-filter-event-type-container').classList.toggle('d-none');
        }, false);

        document.querySelector('.entry-filter-time-interval').addEventListener("click",function(e){
            e.preventDefault();
            document.querySelector('.entry-filter-time-interval-container').classList.toggle('d-none');
        }, false);

        document.querySelector('.entry-filter-studio').addEventListener("click",function(e){
            e.preventDefault();
            document.querySelector('.entry-filter-studio-container').classList.toggle('d-none');
        }, false);
//END


// make some preprocessing and creating links to the filtering area to handle opening and hidding different area of filtering
        document.querySelector('.entry-filter-ball-set-number-submit-button').addEventListener("click",function(e) {
            let tempCellNumber = document.querySelector('.entry-filter-ball-set-number-submit-input').value;
            let tempLink = this.getAttribute('href');
            let resultingLink = tempLink+"="+tempCellNumber;
            this.setAttribute('href', resultingLink);
        }, false);

        document.querySelector('.entry-filter-event-type-submit-button').addEventListener("click",function(e) {
            let tempEventType = $('.entry-filter-event-type-submit-select').val();
            let tempLink = this.getAttribute('href');
            let resultingLink = tempLink+"="+tempEventType;
            this.setAttribute('href', resultingLink);
        }, false);


        document.querySelector('.entry-filter-time-interval-submit-button').addEventListener("click",function(e) {
            let tempTimeIntervalStart = document.querySelector('.entry-filter-time-interval-start-input').value;
            let tempTimeIntervalEnd = document.querySelector('.entry-filter-time-interval-end-input').value;

            if(isValidDate( tempTimeIntervalStart ) && isValidDate( tempTimeIntervalEnd )){
                let tempLink = this.getAttribute('href');
                let resultingLink = tempLink+"_start="+tempTimeIntervalStart+"&entry_filter_time_interval_end="+tempTimeIntervalEnd;
                this.setAttribute('href', resultingLink);
            }else{
                e.preventDefault();
                alert("Диапазон чисел выбран не правильно");
            }
        }, false);

        document.querySelector('.entry-filter-studio-submit-button').addEventListener("click",function(e) {
            let tempEventType = document.querySelector('.entry-filter-studio-submit-select').value;
            let tempLink = this.getAttribute('href');
            let resultingLink = tempLink+"="+tempEventType;
            this.setAttribute('href', resultingLink);
        }, false);
//END





