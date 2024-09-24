document.addEventListener("DOMContentLoaded", function () {
    const btn_categories = document.getElementById("btn-categories");
    const categories = document.getElementById("categories");
    const right_arrow = document.getElementById("right-arrow");
    const down_arrow = document.getElementById("down-arrow");

    btn_categories.addEventListener("click", function () {
        categories.classList.toggle("open");
        menuBtnChange();
    });

    function menuBtnChange() {
        if (categories.classList.contains("open")) {
            categories.classList.add("d-block");
            categories.classList.remove("d-none");
            right_arrow.classList.remove("d-block");
            right_arrow.classList.add("d-none");
            down_arrow.classList.add("d-block");
            down_arrow.classList.remove("d-none");
        } else {
            categories.classList.remove("d-block");
            categories.classList.add("d-none");
            right_arrow.classList.remove("d-none");
            right_arrow.classList.add("d-block");
            down_arrow.classList.add("d-none");
            down_arrow.classList.remove("d-block");
        }
    }
});
