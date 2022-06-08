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

//set a limitations on what date can be set when filtering events by date(not further then today)
let inputDateElements = document.querySelectorAll('.form-date');
inputDateElements.forEach(function(elem) {
    elem.value = todayDayt;
    elem.setAttribute('max', todayDayt);
});

document.querySelector('#filterDateStart').setAttribute('max', todayDayt);
document.querySelector('#filterDateEnd').setAttribute('max', todayDayt);
//END



// make some preprocessing and creating links to the filtering area to handle different area of filtering

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

        let firstDate = new Date(tempTimeIntervalStart);
        let secondDate = new Date(tempTimeIntervalEnd);
        if(firstDate > secondDate){
            e.preventDefault();
            alert("Диапазон чисел выбран не правильно");
        }
        let tempLink = this.getAttribute('href');
        let resultingLink = tempLink+"_start="+tempTimeIntervalStart+"&entry_filter_time_interval_end="+tempTimeIntervalEnd;
        this.setAttribute('href', resultingLink);
    }else{
        e.preventDefault();
        alert("Диапазон чисел выбран не правильно");
    }
}, false);


//END





