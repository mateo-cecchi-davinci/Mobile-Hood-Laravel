document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener("partialViewLoaded", function () {
        var container = document.getElementById("toastContainer");

        if (container.firstChild) {
            container.removeChild(container.firstChild);
        }

        var toast = document.getElementById("noResultsToast");

        container.appendChild(toast);

        const close_btn = document.getElementById("close-icon");

        setTimeout(() => {
            if (toast) {
                toast.classList.add("show");
                toast.classList.remove("close");
            }

            setTimeout(() => {
                if (toast) {
                    toast.classList.remove("show");
                    toast.classList.add("close");
                }
            }, 2500);
        }, 500);

        if (close_btn) {
            close_btn.addEventListener("click", function () {
                toast.classList.remove("show");
                toast.classList.add("close");
            });
        }
    });
});
