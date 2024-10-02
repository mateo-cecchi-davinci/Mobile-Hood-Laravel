function moveIcon(startTime, endTime) {
    const icon = document.querySelector(".time");
    const start = new Date(startTime).getTime();
    const end = new Date(endTime).getTime();
    const remainingDuration = end - start;

    if (remainingDuration > 0) {
        icon.style.transitionDuration = remainingDuration + "ms";

        setTimeout(() => {
            icon.classList.add("move");
        }, 0);
    }
}

const orderTime = document.getElementById("orderTime").innerHTML.trim();
const formattedOrderTime = orderTime.replace(" ", "T");

const startTime = new Date(formattedOrderTime).toISOString();
const endTime = new Date(
    new Date(formattedOrderTime).getTime() + 1 * 60 * 1000, //m-s-ms
).toISOString();

moveIcon(startTime, endTime);
