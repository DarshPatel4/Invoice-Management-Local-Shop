document.addEventListener("DOMContentLoaded", function () {
    var dropdowns = document.querySelectorAll('.dropdown');

    dropdowns.forEach(function (dropdown) {
        var dropbtn = dropdown.querySelector('.dropbtn');
        var dropdownContent = dropdown.querySelector('.dropdown-content');

        dropbtn.addEventListener('click', function () {
            var isActive = dropdown.classList.contains('active');
            dropdowns.forEach(function (item) {
                item.classList.remove('active');
            });
            if (!isActive) {
                dropdown.classList.add('active');
            }
        });
    });
});

document.getElementById('addProduct').addEventListener('click', function () {
    var productItem = document.querySelector('.product-item');
    var newProduct = productItem.cloneNode(true);
    newProduct.querySelectorAll('input').forEach(function(input) {
        input.value = '';
    });
    document.getElementById('productList').appendChild(newProduct);
});
