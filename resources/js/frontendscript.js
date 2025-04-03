jQuery(document).ready(function($) {

    // Error Pop Up function
    const $errorPopup = $('#errorPopupContainer');
    const $progressBar = $('#progressBar');
    
    if ($errorPopup.length !== 0 && $errorPopup.html().trim().length > 0) {
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

    // Function to handle the Filter Form
    const currentUrl = window.location.href.split('?')[0];
    $('#authorFilterForm').submit(function(e) {
        const authorInput = $(this).find('input[name="author"]').val().trim();
        if (authorInput == '') {
            // If the input is empty, set the action to the base URL without query parameters
            window.location.href = currentUrl; // set the base URL
            e.preventDefault();
        }
        return true; // Allow the form to be submitted
    });

    // Custom Js code to handle the animation/styling of form input-labels
    $('.CustomForm input').on('input focus', function(e){
        var InputParent = $(this).parent();
        if(InputParent.children('label')){
            InputParent.children('label').removeClass("top-1/4").addClass("top-[-30%] bg-white pr-2")
        }
    }).on('blur', function() {
        var InputParent = $(this).parent();
        if(InputParent.children('label')){
            if ($(this).val().trim() === '') {
                InputParent.children('label').removeClass("top-[-30%] bg-white pr-2").addClass("top-1/4");
            };
        }
    });

    // Mobile Navigation Show Hide - Hamburger Menu
    // Toggle mobile menu
    $('.mobileMenu.menuClose').on('click', function() {
        $('.MobileNav').removeClass('max-h-0 opacity-0').addClass('max-h-screen opacity-100');
        $('.mobileMenu.menuClose').addClass('hidden');
        $('.mobileMenu.menuOpen').removeClass('hidden');
    });

    $('.mobileMenu.menuOpen').on('click', function() {
        $('.MobileNav').removeClass('max-h-screen opacity-100').addClass('max-h-0 opacity-0');
        $('.mobileMenu.menuClose').removeClass('hidden');
        $('.mobileMenu.menuOpen').addClass('hidden');
    });

});
