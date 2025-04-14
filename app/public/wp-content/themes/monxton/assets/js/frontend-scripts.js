
// // Avoid Header
function updatePadding() {
    // Get the header element
    const header = document.querySelector('header.wp-block-template-part');

    // Check if the header element exists
    if (header) {
        // Get the height of the header
        const headerHeight = header.offsetHeight; // Add 60px to the header height

        // Get all elements with the class .is-style-avoid-header
        const elements = document.querySelectorAll('header.wp-block-template-part + .wp-block-group, header.wp-block-template-part + .wp-block-cover, .entry-content:not(.inner-content) > .wp-block-group:first-child, .entry-content:not(.inner-content) > .wp-block-cover:first-child:not(:has(> .wp-block-cover__inner-container > .wp-block-cover:first-child)), .entry-content:not(.inner-content) > .wp-block-cover:first-child > .wp-block-cover__inner-container > .wp-block-cover:first-child, .is-style-sticky');

        // Add padding to the top of each element equal to the header height
        elements.forEach(function(element) {
            element.style.paddingTop = headerHeight + 'px';
        });

        console.log(header.offsetHeight);
    }
}

window.addEventListener('load', function() {
    updatePadding();
});

// Run Avoid Header on full page load
document.addEventListener('DOMContentLoaded', function() {
    updatePadding();
});

// Run Avoid Header on page resize
window.addEventListener('resize', function() {
    updatePadding();
});

// Scrolling Header
function scrollingHeader() {
    // Get the header element
    const header = document.querySelector('header.wp-block-template-part');

    window.addEventListener("scroll", function () {
        var scroll = window.scrollY || document.documentElement.scrollTop;
        const headerLogo = document.querySelector('.wp-block-site-logo');
        const headerLogoWhite = document.querySelector('.white-logo');

        // Add the scrolling class when scrolled down more than 100px
        if (scroll > 60) {
            header.classList.add("scrolling");
            headerLogo.style.display='none';
            headerLogoWhite.style.display='block';
        }
        // Remove the scrolling class when scrolled up to less than 50px
        else if (scroll < 50) {
            header.classList.remove("scrolling");
            headerLogo.style.display='block';
            headerLogoWhite.style.display='none';
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    scrollingHeader();
});