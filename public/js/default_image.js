window.addEventListener('load', (event) => {
    const img = document.getElementsByTagName("img");
    for (const element of img) {
        element.addEventListener("error", function (event) {
            event.target.src = "https://skillz4kidzmartialarts.com/wp-content/uploads/2017/04/default-image.jpg"
            event.onerror = null
        })
    }
});
