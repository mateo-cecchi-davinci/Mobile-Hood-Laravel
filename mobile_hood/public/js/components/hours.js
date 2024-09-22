function toggleDayInputs(input) {
    var day = input.getAttribute("data-day");
    var label = document.getElementById(day + "_label");
    var openTime = document.getElementById(day + "_open_time");
    var openPeriod = document.getElementById(day + "_time_period_open");
    var closeTime = document.getElementById(day + "_close_time");
    var closePeriod = document.getElementById(day + "_time_period_close");

    if (input.checked) {
        label.innerText = "Abierto";
        openTime.disabled = false;
        openPeriod.disabled = false;
        closeTime.disabled = false;
        closePeriod.disabled = false;
    } else {
        label.innerText = "Cerrado";
        openTime.disabled = true;
        openPeriod.disabled = true;
        closeTime.disabled = true;
        closePeriod.disabled = true;
    }
}

document.querySelectorAll(".form-check-input").forEach(function (input) {
    toggleDayInputs(input);

    input.addEventListener("change", function () {
        toggleDayInputs(input);
    });
});
