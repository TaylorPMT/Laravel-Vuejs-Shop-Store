window.addEventListener('DOMContentLoaded', (event) => {
    const img = document.getElementsByTagName("img");
    for (const element of img) {
        element.addEventListener("error", function (event) {
            event.target.src = "/images/default/default-image.jpg";
            event.onerror = null
        })
    }
});
