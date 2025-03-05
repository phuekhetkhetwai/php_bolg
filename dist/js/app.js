$(document).ready(function(){
//Start Navbar
    //start left sidebar
    $(".sidebarlinks").click(function(){
        $(".sidebarlinks").removeClass("currents");
        $(this).addClass("currents");

    });
    //start left sidebar
});

//End Navbar

//Start Footer
const getyear = document.getElementById("getyear");
const getfullyear = new Date().getFullYear();
getyear.textContent = getfullyear;
//End Footer
