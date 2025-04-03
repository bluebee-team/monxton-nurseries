document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.drawer-trigger').forEach(function(trigger) {
        trigger.addEventListener('click', function() {
            // Find the .drawer element inside the clicked .drawer-trigger
            const drawer = trigger.querySelector('.drawer');

            if (drawer) {
                // Check if the drawer is already active
                if (drawer.classList.contains('active')) {
                    // If active, remove the .active class from drawer and button
                    drawer.classList.remove('active');
                    trigger.classList.remove('active');
                } else {
                    // Otherwise, close any open drawers and deactivate any active buttons
                    closeActiveDrawersAndButtons(function() {
                        // Add the .active class to the drawer element and the clicked button
                        drawer.classList.add('active');
                        trigger.classList.add('active');
                    });
                }
            }
        });
    });

    function closeActiveDrawersAndButtons(callback) {
        // Find all active drawers
        const activeDrawers = document.querySelectorAll('.drawer.active');

        if (activeDrawers.length > 0) {
            // Remove the .active class from all active drawers with a delay
            activeDrawers.forEach(function(drawer) {
                drawer.classList.remove('active');
            });

            // Find all active buttons
            const activeButtons = document.querySelectorAll('.drawer-trigger.active');

            if (activeButtons.length > 0) {
                // Remove the .active class from all active buttons
                activeButtons.forEach(function(button) {
                    button.classList.remove('active');
                });
            }

            // Add a delay before invoking the callback to activate the new drawer
            setTimeout(callback, 300);
        } else {
            // If no active drawers, invoke the callback immediately
            callback();
        }
    }
});
