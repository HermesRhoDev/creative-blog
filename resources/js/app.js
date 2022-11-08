// import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();

// SESSION FLASH
function preview() {
    thumb.src=URL.createObjectURL(event.target.files[0]);
}

document.addEventListener('DOMContentLoaded', function() {
    const alert = document.getElementById('alert')
    setTimeout(() => {
        alert.style.display = "none";
    }, 4000);
    document.querySelector("#image_file_name").onchange = function (e) {
        preview();
    }
}, false);