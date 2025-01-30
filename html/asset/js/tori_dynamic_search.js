function removeAccents(str) {
    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
}

document.getElementById('searchInput').addEventListener('input', function() {
    var searchQuery = removeAccents(this.value.toLowerCase());
    var listItems = document.querySelectorAll('#vazlat-lista li a');

    listItems.forEach(function(item) {
        var listItemText = removeAccents(item.textContent.toLowerCase());

        if (listItemText.includes(searchQuery)) {
            item.parentElement.classList.remove("d-none"); //<li> tagekre
            item.style.display = 'block'; //<a> tagekre
        }
        else {
            item.parentElement.classList.add("d-none");
            item.style.display = 'none';
        }
    });
});