fetch("partials/header.html")
.then(r=>r.text())
.then(html=>{
    document.getElementById("header").innerHTML = html;
    const page = document.body.dataset.page;
    document.querySelectorAll(".main-nav a").forEach(a=>{
        if(a.dataset.page === page){
            a.classList.add("active");
        }
    });
});
