function deleteLink(id) {
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "/page/_script/profile_url_delete.php");

    xhttp.onload = function() {
        if(xhttp.status === 200) {
            alert("The shortened URL was deleted successfully.\nRefresh the page to see changes.");
        }
        else {
            alert("Unable to delete the shortened URL.\nPlease contact the website administrator at the contact page.");
        }
    }

    var deleteData = "action=deleteLink&id=" + encodeURIComponent(id);

    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(deleteData);
}