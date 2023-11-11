const formOpenBtn = document.querySelector("#form-open"),
    popupcontainer = document.querySelector(".popup-container"),
    popup = document.querySelector(".popup"),
    formCloseBtn = document.querySelector(".form-close"),
    body = document.querySelector("body"),
    header = document.querySelector("header"),
    sidebarOpen = document.querySelector(".sidebarOpen"),
    siderbarClose = document.querySelector(".siderbarClose");

formOpenBtn.addEventListener("click", () => popupcontainer.classList.add("show"));
formCloseBtn.addEventListener("click", () => popupcontainer.classList.remove("show"));

sidebarOpen.addEventListener("click" , () =>{
    header.classList.add("active");
});

body.addEventListener("click" , e =>{
    let clickedElm = e.target;
    if(!clickedElm.classList.contains("sidebarOpen") && !clickedElm.classList.contains("menu")){
        header.classList.remove("active");
    }
});

