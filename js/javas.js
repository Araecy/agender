const currentDate = document.querySelector(".current-date");
const daysTag = document.querySelector(".days");
let tempVal;
prevNextIcon = document.querySelectorAll(".icons span");

let date = new Date(),
    currYear = date.getFullYear(),
    currMonth = date.getMonth();

// console.log(date, currYear,currMonth);
const months = ["Januari", "Februari", "Maart", "April", "Mei",
    "Juni", "Juli", "Augustus", "September", "Oktober", "November", "December"
];
const renderCalendar = () => {
    let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), //eerste dag van maand
        lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), //laatste dag van maand

        lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), //laatste dag van maand

        lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); //laatste datum verleden maand


    let liTag = "";

    for (let i = firstDayofMonth; i > 0; i--) {
        if (currMonth - 1 < 0) {
            liTag += `<li id="${lastDateofLastMonth - i + 1 } ${11} ${currYear -1}" class="inactive valid">${lastDateofLastMonth - i + 1 }</li>`;
        } else {
            liTag += `<li id="${lastDateofLastMonth - i + 1 } ${currMonth - 1} ${currYear}" class="inactive valid">${lastDateofLastMonth - i + 1 }</li>`;
        }
    }

    for (let i = 1; i <= lastDateofMonth; i++) {
        let isToday = i === date.getDate() && currMonth === new Date().getMonth() &&
            currYear === new Date().getFullYear() ? "active" : "";
        liTag += `<li id="${i} ${currMonth} ${currYear}" class="${isToday} valid">${i}</li>`;
    }

    for (let i = lastDayofMonth; i < 6; i++) {
        if (currMonth + 1 > 11) {
            liTag += `<li id="${i - lastDayofMonth + 1 } ${0} ${currYear +1}" class="inactive valid">${i - lastDayofMonth + 1 }</li>`;
        } else {
            liTag += `<li id="${i - lastDayofMonth + 1 } ${currMonth + 1} ${currYear}" class="inactive valid">${i - lastDayofMonth + 1 }</li>`;

        }
    }
    currentDate.innerText = `${months[currMonth]} ${currYear}`;
    daysTag.innerHTML = liTag;
    document.querySelectorAll('.valid').forEach(item => {
        item.addEventListener('click', event => {
            tempVal = item.id;
        //Te doen lijst tonen:
            document.getElementById("events").style.opacity = 1;
            document.getElementById("events").style.height = '100%';
            document.getElementById("events").style.width = '100%';

            document.getElementById("eventName").style.opacity = 1;
            document.getElementById("eventBeschrijf").style.opacity = 1;
            document.getElementById("eventTijd").style.opacity = 1;

            document.getElementById("tedoen").style.opacity = 1;

            
            document.getElementById("toevoegen").style.opacity = 1;

            document.getElementById("formW").style.height = '390px';
            document.getElementById("formW").style.width = '450px';
            document.getElementById("formW").style.opacity = 1;

            document.getElementById("containerForm").style.opacity = 0;
            document.getElementById("containerForm").style.height = 0;
            document.getElementById("containerForm").style.width = 0;


            document.getElementById('containerForm').style.display = 'none';

            document.getElementById("events").style.opacity = 1;

            let ids = item.id.split(" ");
            // document.getElementById("innerToevoeg").id = item.id;
            let dayLi = ids[0];
            let monthLi = months[ids[1]];
            let yearLi = ids[2];

            document.getElementById("datumtekst").innerText = dayLi + " " + monthLi + " " + yearLi
            document.getElementById("datumVal").value = yearLi + "-" + ids[1] + "-" + dayLi;
            console.log("day: " + dayLi);
            console.log("month: " + monthLi);
            console.log("year: " + yearLi);
        });
    });

    document.querySelectorAll('.innerToevoeg').forEach(item => {
        item.addEventListener('click', event => {

            document.getElementById('containerForm').style.display = 'block';

            document.getElementById("formW").style.height = '390px';
            document.getElementById("formW").style.width = '450px';
            document.getElementById("formW").style.opacity = 1;

            document.getElementById("containerForm").style.opacity = 1;
            document.getElementById("containerForm").style.height = '390px';
            document.getElementById("containerForm").style.width = '450px';

            document.getElementById("events").style.opacity = 0;
            document.getElementById("events").style.height = 0;
            document.getElementById("events").style.width = 0;

            document.getElementById("containerForm").style.transition = 'none';
            document.getElementById("events").style.transition = 'none';

            document.getElementById("eventName").style.opacity = 0;
            document.getElementById("eventBeschrijf").style.opacity = 0;
            document.getElementById("eventTijd").style.opacity = 0;

            document.getElementById("tedoen").style.opacity = 0;
            
            document.getElementById("toevoegen").style.opacity = 0;
            
            let ids = tempVal.split(" ");
            let dayLi = ids[0];
            let monthLi = months[ids[1]];
            let yearLi = ids[2];

            document.getElementById("datumtekst").innerText = dayLi + " " + monthLi + " " + yearLi
            document.getElementById("datumVal").value = yearLi + "-" + ids[1] + "-" + dayLi;
            console.log("day: " + dayLi);
            console.log("month: " + monthLi);
            console.log("year: " + yearLi);
        });
    });
};
renderCalendar();

prevNextIcon.forEach(icon => {
    icon.addEventListener("click", () => {
        currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

        if (currMonth < 0 || currMonth > 11) {
            date = new Date(currYear, currMonth, new Date().getDate());
            currYear = date.getFullYear();
            currMonth = date.getMonth();
        } else {
            date = new Date();
        }
        renderCalendar();
    });
});