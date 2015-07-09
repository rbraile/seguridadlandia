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
    setTimeout(function(){window.location = url;}, 2000); 
}

function redirectToTime(url) {
    $(".message").removeClass("hide");
    setTimeout(function(){window.location = url;}, 2000); 
}