<p>hello calendar</p>
<style>

html {
  font-family: sans-serif;
  font-size: 15px;
  line-height: 1.4;
  color: #444;
}

body {
  margin: 0;
  font-size: 1em;
}

.wrapper {
  margin: 15px auto;
  max-width: 1100px;
  display: inline-block;
}

.container-calendar {
  background: #ffffff;
  padding: 15px;
  max-width: 300px;
  margin: 0 auto;
  overflow: auto;
  border: 1px solid #000;
  display: inline-block;
  float: left;
}

button {
  border: none;
  background-color: #fff;
  font-size: 30px;
}

.button-container-calendar button {
  cursor: pointer;
  display: inline-block;
  zoom: 1;
  outline: none;
}

.table-calendar {
  border-collapse: collapse;
  width: 100%;
}

.table-calendar td,
.table-calendar th {
  padding: 5px;
  border: none;
  text-align: center;
  vertical-align: top;
}

td {
  cursor: pointer;
}

.date-picker.selected {
  font-weight: bold;
}

.date-picker.selected span {
  border-bottom: 2px solid currentColor;
}

span {
  pointer-events: none;
}

/* sunday */

.date-picker:nth-child(1) {
  color: red;
}

/* friday */

.date-picker:nth-child(6) {
  color: green;
}

#monthAndYear {
  text-align: center;
  margin: 0;
  width: 200px;
  display: inline-block;
  margin-top: 15px;
  font-weight: bold;
}

.button-container-calendar {
  position: relative;
  margin-bottom: 1em;
  overflow: hidden;
  clear: both;
  text-align: center;
}

#previous {
  float: left;
}

#next {
  float: right;
}

.footer-container-calendar {
  margin-top: 1em;
  border-top: 1px solid #dadada;
  padding: 10px 0;
}

.footer-container-calendar select {
  cursor: pointer;
  display: inline-block;
  zoom: 1;
  background: #ffffff;
  color: #585858;
  border: 1px solid #bfc5c5;
  border-radius: 3px;
  padding: 5px 1em;
}

p {
  border: 1px solid black;
  border-radius: 50%;
  width: 3px;
  height: 3px;
  background-color: black;
  text-align: center;
  margin-left: 15px;
  display: none;
}

.events-wrappers {
  display: inline-block;
  margin-left: 100px;
}

.events-wrappers > .previous-events {
  display: block;
}

.events-wrappers > .today-events {
  display: block;
}

.events-wrappers > .nearest-events {
  display: block;
}
</style>
<div class="wrapper">
    <div class="container-calendar">
        <div class="button-container-calendar">
            <button id="previous" onclick="previous()">&#8249;</button>
            <h3 id="monthAndYear"></h3>
            <button id="next" onclick="next()">&#8250;</button>
        </div>
        <table class="table-calendar" id="calendar" data-lang="en">
            <thead id="thead-month"></thead>
            <tbody id="calendar-body"></tbody>
        </table>
    </div>
    <div class="events-wrappers">
    
    </div>
</div>


<script>
function generate_year_range(start, end) {
    let years = "";
    for (let year = start; year <= end; year++) {
        years += "<option value='" + year + "'>" + year + "</option>";
    }
    return years;
}
today = new Date();
currentMonth = today.getMonth();
currentYear = today.getFullYear();
selectYear = document.getElementById("year");
selectMonth = document.getElementById("month");
createYear = generate_year_range(1970, 2050);
/** or
 * createYear = generate_year_range( 1970, currentYear );
 */
// document.getElementById("year").innerHTML = createYear;
let calendar = document.getElementById("calendar");
let lang = calendar.getAttribute('data-lang');
let months = "";
let days = "";
let cellId = "";
let monthDefault = ["Sausis", "Vasaris", "Kovas", "Balandis", "Gegužė", "Birželis", "Liepa", "Rugpjūtis", "Rugsėjis", "Spalis", "Lapkritis", "Gruodis"];
let dayDefault = ["S", "P", "A", "T", "K", "P", "Š"];
if (lang == "en") {
    months = monthDefault;
    days = dayDefault;
} else {
    months = monthDefault;
    days = dayDefault;
}
let $dataHead = "<tr>";
for (dhead in days) {
    $dataHead += "<th data-days='" + days[dhead] + "'>" + days[dhead] + "</th>";
}
$dataHead += "</tr>";
//alert($dataHead);
document.getElementById("thead-month").innerHTML = $dataHead;
monthAndYear = document.getElementById("monthAndYear");
showCalendar(currentMonth, currentYear);
function next() {
    currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
    currentMonth = (currentMonth + 1) % 12;
    showCalendar(currentMonth, currentYear);
}
function previous() {
    currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
    currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
    showCalendar(currentMonth,currentYear );
}
function showCalendar(month, year) {
    let firstDay = ( new Date( year, month ) ).getDay();
    tbl = document.getElementById("calendar-body");
    tbl.innerHTML = "";
    monthAndYear.innerHTML = year + " " + months[month]  ;
    // selectYear.value = year;
    // selectMonth.value = month;
    // creating all cells
    let date = 1;
    for ( let i = 0; i < 6; i++ ) {
        let row = document.createElement("tr");
        for ( let j = 0; j < 7; j++ ) {
            if ( i === 0 && j < firstDay ) {
                cell = document.createElement( "td" );
                cellText = document.createTextNode("");
                cell.appendChild(cellText);
                row.appendChild(cell);
            } else if (date > daysInMonth(month, year)) {
                break;
            } else {
                cell = document.createElement("td");
                cell3 = document.createElement("span");
                cell.setAttribute("data_date", date);
                cell.setAttribute("id", date );
                cell.setAttribute("data_month", month + 1);
                cell.setAttribute("data_year", year);
                cell.setAttribute("data-month_name", months[month]);
                cell.innerHTML = '<span>'+date+'</span>';
                if ( date === today.getDate() && year === today.getFullYear() && month === today.getMonth() ) {
                    cell.className = "date-picker selected";
                }
                row.appendChild(cell);
                date++;
            }
        }
        tbl.appendChild(row);
    }
}
event();
function event(cell){
    document.getElementById('calendar-body').addEventListener('click',(e)=>{
        e.target.style.backgroundColor = 'pink';
        // console.log(e.target);
        var table = document.getElementsByTagName("table")[0];
        let takeCell = document.getElementsByTagName("td");
        let a= Object.values(data[0].content);
        let b= Object.values(data[1].content);
        let c= Object.values(data[2].content);
        let HTML = ''; 
        takeCell[20].setAttribute("ivykis",a);
        takeCell[10].setAttribute("ivykis",b);
        takeCell[30].setAttribute("ivykis",c);
                    for (var i = 0, row; row = table.rows[i]; i++) {
                        for (var j = 0, col; col = row.cells[j]; j++) {
                            // console.log(row.cells[j]);
                            if(row.cells[j].getAttribute("ivykis")){
                                console.log(row.cells[j].getAttribute("ivykis"));
                            }
                        }
                    }
    if(e.target.getAttribute("ivykis") != null ){
        for (let i = 0; i < data.length; i++) {
            HTML+=`
            <div class="today-events">
            <h2>Siandienos ivykiai: ${e.target.getAttribute("data_year")}.${e.target.getAttribute("data_month")}.${e.target.getAttribute("data_date")}</h2> 
            <div class="data-time">${JSON.stringify(e.target.getAttribute("ivykis"))}</div>
            <span></span>
            <div class="event"></div>
            </div>
            `;
            // var td = table.getElementsByTagName("td");
            // console.log(e.target.closest('td').getAttribute("ivykis"));
            // let tableRows = document.getElementsByTagName("table")[0].rows[3].cells[6].attributes[5];
            // console.log(tableRows);
            return  document.querySelector('.events-wrappers').innerHTML = HTML;
        }
    } else {
        HTML+=`
        <div class="today-events">
        <h2>Siandiena ivykiu nera</h2>
        </div>
        `;
        return  document.querySelector('.events-wrappers').innerHTML = HTML;
    }
});
}
function daysInMonth(iMonth, iYear) {
    return 32 - new Date(iYear, iMonth, 32).getDate();
}
</script>