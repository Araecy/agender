const currentDate = document.querySelector(".current-date");
const daysTag = document.querySelector(".days");

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
            liTag += `<li id="${lastDateofLastMonth - i + 1 } ${11} ${currYear -1}" class="inactive">${lastDateofLastMonth - i + 1 }</li>`;
        } else {
            liTag += `<li id="${lastDateofLastMonth - i + 1 } ${currMonth - 1} ${currYear}" class="inactive">${lastDateofLastMonth - i + 1 }</li>`;
        }
    }

    for (let i = 1; i <= lastDateofMonth; i++) {
        let isToday = i === date.getDate() && currMonth === new Date().getMonth() &&
            currYear === new Date().getFullYear() ? "active" : "";
        liTag += `<li id="${i} ${currMonth} ${currYear}" class="${isToday}">${i}</li>`;
    }

    for (let i = lastDayofMonth; i < 6; i++) {
        if (currMonth + 1 > 11) {
            liTag += `<li id="${i - lastDayofMonth + 1 } ${0} ${currYear +1}" class="inactive">${i - lastDayofMonth + 1 }</li>`;
        } else {
            liTag += `<li id="${i - lastDayofMonth + 1 } ${currMonth + 1} ${currYear}" class="inactive">${i - lastDayofMonth + 1 }</li>`;

        }
    }
    currentDate.innerText = `${months[currMonth]} ${currYear}`;
    daysTag.innerHTML = liTag;
    document.querySelectorAll('li').forEach(item => {
        item.addEventListener('click', event => {
            document.getElementById("formW").style.height = '350px';
            document.getElementById("formW").style.width = '450px';
            document.getElementById("formW").style.opacity = 1;
            document.getElementById("containerForm").style.opacity = 1;
            let ids = item.id.split(" ");
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