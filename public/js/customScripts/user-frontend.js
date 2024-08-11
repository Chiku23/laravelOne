$(document).ready(function() {
    const $errorPopup = $('#errorPopupContainer');
    const $progressBar = $('#progressBar');

    if ($errorPopup.html().trim().length > 0) {
        console.log('Yes');
       $errorPopup.removeClass("translate-x-[150%]");
       $errorPopup.addClass("translate-x-0");
       startProgressBar();
    }
    $(".error-popup-close").on('click',function(){
        $errorPopup.removeClass("translate-x-0");
        $errorPopup.addClass("translate-x-[150%]");

        // Wait for 500ms and then remove the content inside $errorPopup
        setTimeout(function() {
            $errorPopup.empty(); // Removes the content inside the popup
        }, 500);
    })
    function startProgressBar() {
        $progressBar.css("width", "0%"); // Start filling the progress bar
        setTimeout(function() {
            $errorPopup.removeClass("translate-x-0").addClass("translate-x-[150%]");
            $progressBar.stop().css("width", "100%"); // Stop the progress bar animation
            setTimeout(function() {
                $errorPopup.empty(); // Removes the content inside the popup
                $progressBar.remove(); // Remove progress bar element
            }, 500);
        }, 3000); // Progress bar duration
    }
});
