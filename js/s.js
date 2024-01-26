// script.js

let idImage = document.getElementById('id-image');

let xhr = new XMLHttpRequest();
xhr.open('GET', 'get-image.php', true);
xhr.responseType = 'json';
xhr.onload = function () {
    if (xhr.status === 200) {
        let image = xhr.response;
        idImage.src = 'data:image/png;base64,' + image.base64_encoded_data;
    }
};
xhr.send();