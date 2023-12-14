const imageInput = document.getElementById('image-input');
    const imagePreview = document.getElementById('image-preview');
    const noImageMessage = document.getElementById('no-image-message');   

const body = document.querySelector("body"),
    // modeToggle = body.querySelector(".mode-toggle");
sidebar = body.querySelector("nav");
sidebarToggle = body.querySelector(".sidebar-toggle");

let getMode = localStorage.getItem("mode");
if (getMode && getMode === "dark") {
    body.classList.toggle("dark");
}

let getStatus = localStorage.getItem("status");
if (getStatus && getStatus === "close") {
    sidebar.classList.toggle("close");
}

// modeToggle.addEventListener("click", () => {
//     body.classList.toggle("dark");
//     if (body.classList.contains("dark")) {
//         localStorage.setItem("mode", "dark");
//     } else {
//         localStorage.setItem("mode", "light");
//     }
// });

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if (sidebar.classList.contains("close")) {
        localStorage.setItem("status", "close");
    } else {
        localStorage.setItem("status", "open");
    }
})

imageInput.addEventListener('change', function () {
    const file = this.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            imagePreview.src = e.target.result;
            noImageMessage.style.display = 'none';
        };

        reader.readAsDataURL(file);
    } else {
        imagePreview.src = '';
        noImageMessage.style.display = 'block';
    }
});


