window.addEventListener("scroll", () => {
    document.querySelectorAll(".second-nav").forEach((navbar) => {
        const scrollY = window.scrollY || document.documentElement.scrollTop;
        const scrollDistance = 200;

        if (scrollY <= scrollDistance) {
            const opacity = scrollY / scrollDistance;
            navbar.style.opacity = opacity;

            // Change z-index based on opacity
            navbar.style.zIndex = opacity === 0 ? -1 : 1;
        } else {
            navbar.style.opacity = 1;
            navbar.style.zIndex = 1;
        }
    });
});
