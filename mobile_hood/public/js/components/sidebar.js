document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.querySelector(".sidebar");
    const closeBtn = document.querySelector("#btn");
    const menu = document.querySelector(".bx-menu");

    closeBtn.addEventListener("click", function () {
        sidebar.classList.toggle("open");
        menuBtnChange();
    });

    menu.addEventListener("click", function () {
        sidebar.classList.toggle("open");
        menuBtnChange();
    });

    function menuBtnChange() {
        if (sidebar.classList.contains("open")) {
            closeBtn.classList.add(
                "bx",
                "bx-left-arrow-alt",
                "pt-4",
                "text-light",
            );
        } else {
            closeBtn.classList.remove(
                "bx",
                "bx-left-arrow-alt",
                "pt-4",
                "text-light",
            );
        }
    }
});
