const form = document.querySelector('form');
const continueBtn = document.querySelector(".submit");
errorText = document.querySelector(".warningNote");

form.onsubmit = (e) => {
    e.preventDefault(); //Prevent from submit
}

continueBtn.onclick = ()=>{
    // Ajax start here
    let xhr = new XMLHttpRequest(); //cXML obj
    xhr.open("POST", "php/login.php");
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                console.log(data);
                if(data == "success")
                {
                    location.href = "home.php";
                }
                else
                {
                    errorText.textContent = data;
                    errorText.style.display = "block";
                }
            }
        }
    }
    // sending form data through ajax to php
    let formData = new FormData(form); // creating new formData obj
    // console.log(formData);
    xhr.send(formData); //sending form data to php
    
}