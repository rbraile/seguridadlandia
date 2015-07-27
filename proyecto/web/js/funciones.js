(function($) {
    $(document).ready(function() {
        $(".logout").click(function() {
            logout();
        });

        if($(".page-facturas").length > 0) {
            $(".navbar-nav .active").removeClass("active");
            $(".navbar-nav .facturas-link").parent("li").addClass("active");
        }
    });
})(jQuery);

function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

function error(url) {
    $(".error").removeClass("hide");
    $("html, body").animate({scrollTop: 0}, 800);
    if(url != "") {
        setTimeout(function(){window.location = url;}, 2000); 
    }
}

function redirectToTime(url) {
    $(".error").addClass("hide");
    $(".message").removeClass("hide");
    $("html, body").animate({scrollTop: 0}, 800);
    setTimeout(function(){window.location = url;}, 2000); 
}

function logout() {
    $.ajax({
      method: "GET",
      url: "/api/logout"
    })
    .done(function( msg ) {
        var url = "/";
        window.location = url;
    });
}