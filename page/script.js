
document.addEventListener("DOMContentLoaded", function () {
    document.querySelector("a[href='#user-info']").addEventListener("click", function (e) {
        e.preventDefault();
        let target = document.querySelector("#user-info");
        
        window.scrollTo({
            top: target.getBoundingClientRect().top + window.scrollY - 50, // -50 agar tidak terlalu mepet
            behavior: "smooth"
        });
    });
});
