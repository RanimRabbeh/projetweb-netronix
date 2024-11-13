function searchProduct() {
    var input, filter, items, item, title, i;
    input = document.getElementById("search-bar");
    filter = input.value.toUpperCase();
    items = document.getElementsByClassName("shop-item");
    
    for (i = 0; i < items.length; i++) {
        item = items[i];
        title = item.getAttribute("data-name");
        
        if (title.toUpperCase().indexOf(filter) > -1) {
            item.style.display = "";
        } else {
            item.style.display = "none";
        }
    }
}