window.addEventListener("scroll", () => {
    const navbar = document.querySelector(".second-nav");
    const scrollY = window.scrollY || document.documentElement.scrollTop;
    const scrollDistance = 250;

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
