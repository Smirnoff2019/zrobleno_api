$(document).ready(function(){
    (() => {
        const portfolioCollapse = $("#form-append-new-contractor-portfolio").css("display", "none");
        const portfolioCreateButton = $("#append-new-contractor-portfolio");

        portfolioCreateButton.on("click", function(){
            portfolioCollapse.show();
        });

    })(jQuery);
});