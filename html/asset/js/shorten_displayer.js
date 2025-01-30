//limits recordsPerPage with xhttp without refreshing the site
function recordsPerPage(recordsPerPage) {
    var url = new URL(window.location.href);
    url.searchParams.set('recordsPerPage', recordsPerPage);
    
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", url, true);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200){
            location.reload();
        }
    }
    xhttp.send();
}