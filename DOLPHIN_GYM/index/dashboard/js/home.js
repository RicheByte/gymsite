// Add smooth scrolling for navbar links
document.addEventListener("DOMContentLoaded", function () {
    const navLinks = document.querySelectorAll(".nav-link");

    navLinks.forEach(link => {
        link.addEventListener("click", function (event) {
            const targetHref = this.getAttribute("href");

            // Only prevent default if the link is an anchor to a section on the same page
            if (targetHref.startsWith("#")) {
                event.preventDefault();
                const targetId = targetHref.substring(1); // Remove '#' from href
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    targetElement.scrollIntoView({ behavior: "smooth", block: "start" });
                }
            }
            // Otherwise, allow the default navigation to another page
        });
    });
});

// Example: The welcome message code has been removed.

