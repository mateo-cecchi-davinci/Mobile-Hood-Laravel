document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener("partialViewLoaded", function () {
        let toast = document.getElementById("noResultsToast");
        const close_btn = document.getElementById("close-icon");

        setTimeout(() => {
            if (toast) {
                toast.classList.add("show");
                toast.classList.remove("close");
            }
        }, 500);

        if (close_btn) {
            close_btn.addEventListener("click", function () {
                toast.classList.remove("show");
                toast.classList.add("close");
            });
        }
    });
});
