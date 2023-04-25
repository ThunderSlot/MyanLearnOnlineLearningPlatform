// Show Nav Bar
const nav = document.querySelector(".nav");
const toggle = document.querySelector(".nav-toggle");
const close = document.querySelector(".nav-close");

toggle.addEventListener("click", ()=>{
    nav.classList.add("show-menu");
    close.classList.add("visible");
})
close.addEventListener("click", ()=>{
    nav.classList.remove("show-menu")
    close.classList.remove("visible");
})

// Remove Menu Bar on Mobile
const navLink = document.querySelectorAll('.nav-link')
function linkAction(){
    nav.classList.remove("show-menu")
    close.classList.remove("visible");
}
navLink.forEach(n => n.addEventListener('click', linkAction))

//Change Active Link
const linkColor = document.querySelectorAll('.nav-link')
function colorLink(){
    if(colorLink){
        linkColor.forEach(l => l.classList.remove('active'))
        this.classList.add('active')
    }
}
linkColor.forEach(l=>l.addEventListener('click', colorLink))

//Scroll To Top Button
let up = document.querySelector(".up");
window.addEventListener("scroll", ()=>{
    up.classList.toggle("show", window.scrollY >= 560)
    up.onclick = ()=>{
        window.scrollTo({behavior: "smooth", top:"0"})
    }
})