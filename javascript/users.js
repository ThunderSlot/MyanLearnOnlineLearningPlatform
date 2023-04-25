const searchBar = document.querySelector(".searchChatUser"),
searchIcon = document.querySelector(".search button"),
usersList = document.querySelector(".users-list"),
usersList1 = document.querySelector(".users-list1");

searchIcon.onclick = ()=>{
  searchBar.classList.toggle("show");
  searchIcon.classList.toggle("active");
  searchBar.focus();
  if(searchBar.classList.contains("active")){
    searchBar.value = "";
    searchBar.classList.remove("active");
  }
}

searchBar.onkeyup = ()=>{
  let searchTerm = searchBar.value;
  if(searchTerm != ""){
    searchBar.classList.add("active");
  }else{
    searchBar.classList.remove("active");
  }
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/search.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          let data = JSON.parse(xhr.response);
          usersList.innerHTML = data.output; // access output
          usersList1.innerHTML = data.output1; // access output1
        }
    }
  }
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("searchTerm=" + searchTerm);
}


setInterval(() =>{
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "php/users.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          let data = xhr.response;
          if(!searchBar.classList.contains("active")){
            let response = JSON.parse(data);
            usersList.innerHTML = response.output;
            usersList1.innerHTML = response.output1;
          }
        }
    }
  }
  xhr.send();
}, 500);

