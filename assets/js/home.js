const nav = document.querySelector(".navbar_menu");
const toggle = document.querySelector(".nav-toggle");
const close = document.querySelector(".nav-close");
const courseCategory = document.querySelector(".courseCategory");
const courseCategoryIcon = document.querySelector(".courseCategoryIcon");

toggle.addEventListener("click", () => {
  nav.classList.add("active");
  close.classList.add("visible");
  toggle.classList.add("invisible");
})
close.addEventListener("click", () => {
  nav.classList.remove("active");
  close.classList.remove("visible");
  toggle.classList.remove("invisible");
})

// Changing icon direction on click on Course Button

courseCategory.addEventListener("click", () => {
  courseCategory.classList.toggle("close");
  iconBtnChange();//calling the function(optional)
});

function iconBtnChange() {
  if (courseCategory.classList.contains("close")) {
    courseCategoryIcon.classList.replace("fa-chevron-down", "fa-chevron-up");//replacing the iocns class
  } else {
    courseCategoryIcon.classList.replace("fa-chevron-up", "fa-chevron-down");//replacing the iocns class
  }
}

// category sub menu opening
const courseDropDown = document.querySelector(".sub-menu-wrap-courses");
function showParentMenu() {
  courseDropDown.classList.add("hoverSubMenu");
}
function hideParentMenu() {
  courseDropDown.classList.remove("hoverSubMenu");
}

// courseDropDown.addEventListener("mouseover", ()=>{
//     courseDropDown.classList.add("hoverSubMenu");
//   });
// courseDropDown.addEventListener("mouseleave", ()=>{
//     courseDropDown.classList.remove("hoverSubMenu");
//   });

const developmentCategory = document.querySelector(`[data-category="Development"]`);
const businessCategory = document.querySelector(`[data-category="Business"]`);
const financeCategory = document.querySelector(`[data-category="Finance"]`);
const itsoftwareCategory = document.querySelector(`[data-category="IT Software"]`);
const officeCategory = document.querySelector(`[data-category="Office Productivity"]`);
const personalCategory = document.querySelector(`[data-category="Personal Development"]`);
const designCategory = document.querySelector(`[data-category="Design"]`);
const marketingCategory = document.querySelector(`[data-category="Marketing"]`);
const lifestyleCategory = document.querySelector(`[data-category="Lifestyle"]`);
const photoCategory = document.querySelector(`[data-category="Photography & Video"]`);
const healthCategory = document.querySelector(`[data-category="Health & Fitness"]`);
const musicCategory = document.querySelector(`[data-category="Music"]`);
const teachingCategory = document.querySelector(`[data-category="Teaching & Academics"]`);

developmentCategory.addEventListener("mouseover", () => {
  document.querySelector(".sub-menu-wrap-development").classList.add("hoverSubMenu");
  document.querySelector(".sub-menu-wrap-development").classList.remove("hoverSubMenuClose");
});
developmentCategory.addEventListener("mouseleave", () => {
  document.querySelector(".sub-menu-wrap-development").classList.remove("hoverSubMenu");
  document.querySelector(".sub-menu-wrap-development").classList.add("hoverSubMenuClose");
});


businessCategory.addEventListener("mouseover", () => {
  document.querySelector(".sub-menu-wrap-business").classList.add("hoverSubMenu");
  document.querySelector(".sub-menu-wrap-business").classList.remove("hoverSubMenuClose");
});
businessCategory.addEventListener("mouseleave", () => {
  document.querySelector(".sub-menu-wrap-business").classList.remove("hoverSubMenu");
  document.querySelector(".sub-menu-wrap-business").classList.add("hoverSubMenuClose");
});


financeCategory.addEventListener("mouseover", () => {
  document.querySelector(".sub-menu-wrap-finance").classList.add("hoverSubMenu");
  document.querySelector(".sub-menu-wrap-finance").classList.remove("hoverSubMenuClose");
});
financeCategory.addEventListener("mouseleave", () => {
  document.querySelector(".sub-menu-wrap-finance").classList.remove("hoverSubMenu");
  document.querySelector(".sub-menu-wrap-finance").classList.add("hoverSubMenuClose");
});


itsoftwareCategory.addEventListener("mouseover", () => {
  document.querySelector(".sub-menu-wrap-software").classList.add("hoverSubMenu");
  document.querySelector(".sub-menu-wrap-software").classList.remove("hoverSubMenuClose");
});
itsoftwareCategory.addEventListener("mouseleave", () => {
  document.querySelector(".sub-menu-wrap-software").classList.remove("hoverSubMenu");
  document.querySelector(".sub-menu-wrap-software").classList.add("hoverSubMenuClose");
});

officeCategory.addEventListener("mouseover", () => {
  document.querySelector(".sub-menu-wrap-office").classList.add("hoverSubMenu");
  document.querySelector(".sub-menu-wrap-office").classList.remove("hoverSubMenuClose");
});
officeCategory.addEventListener("mouseleave", () => {
  document.querySelector(".sub-menu-wrap-office").classList.remove("hoverSubMenu");
  document.querySelector(".sub-menu-wrap-office").classList.add("hoverSubMenuClose");
});

personalCategory.addEventListener("mouseover", () => {
  document.querySelector(".sub-menu-wrap-personal").classList.add("hoverSubMenu");
  document.querySelector(".sub-menu-wrap-personal").classList.remove("hoverSubMenuClose");
});
personalCategory.addEventListener("mouseleave", () => {
  document.querySelector(".sub-menu-wrap-personal").classList.remove("hoverSubMenu");
  document.querySelector(".sub-menu-wrap-personal").classList.add("hoverSubMenuClose");
});

designCategory.addEventListener("mouseover", () => {
  document.querySelector(".sub-menu-wrap-design").classList.add("hoverSubMenu");
  document.querySelector(".sub-menu-wrap-design").classList.remove("hoverSubMenuClose");
});
designCategory.addEventListener("mouseleave", () => {
  document.querySelector(".sub-menu-wrap-design").classList.remove("hoverSubMenu");
  document.querySelector(".sub-menu-wrap-design").classList.add("hoverSubMenuClose");
});

marketingCategory.addEventListener("mouseover", () => {
  document.querySelector(".sub-menu-wrap-marketing").classList.add("hoverSubMenu");
  document.querySelector(".sub-menu-wrap-marketing").classList.remove("hoverSubMenuClose");
});
marketingCategory.addEventListener("mouseleave", () => {
  document.querySelector(".sub-menu-wrap-marketing").classList.remove("hoverSubMenu");
  document.querySelector(".sub-menu-wrap-marketing").classList.add("hoverSubMenuClose");
});

lifestyleCategory.addEventListener("mouseover", () => {
  document.querySelector(".sub-menu-wrap-lifestyle").classList.add("hoverSubMenu");
  document.querySelector(".sub-menu-wrap-lifestyle").classList.remove("hoverSubMenuClose");
});
lifestyleCategory.addEventListener("mouseleave", () => {
  document.querySelector(".sub-menu-wrap-lifestyle").classList.remove("hoverSubMenu");
  document.querySelector(".sub-menu-wrap-lifestyle").classList.add("hoverSubMenuClose");
});

photoCategory.addEventListener("mouseover", () => {
  document.querySelector(".sub-menu-wrap-photograph").classList.add("hoverSubMenu");
  document.querySelector(".sub-menu-wrap-photograph").classList.remove("hoverSubMenuClose");
});
photoCategory.addEventListener("mouseleave", () => {
  document.querySelector(".sub-menu-wrap-photograph").classList.remove("hoverSubMenu");
  document.querySelector(".sub-menu-wrap-photograph").classList.add("hoverSubMenuClose");
});

musicCategory.addEventListener("mouseover", () => {
  document.querySelector(".sub-menu-wrap-music").classList.add("hoverSubMenu");
  document.querySelector(".sub-menu-wrap-music").classList.remove("hoverSubMenuClose");
});
musicCategory.addEventListener("mouseleave", () => {
  document.querySelector(".sub-menu-wrap-music").classList.remove("hoverSubMenu");
  document.querySelector(".sub-menu-wrap-music").classList.add("hoverSubMenuClose");
});

teachingCategory.addEventListener("mouseover", () => {
  document.querySelector(".sub-menu-wrap-teaching").classList.add("hoverSubMenu");
  document.querySelector(".sub-menu-wrap-teaching").classList.remove("hoverSubMenuClose");
});
teachingCategory.addEventListener("mouseleave", () => {
  document.querySelector(".sub-menu-wrap-teaching").classList.remove("hoverSubMenu");
  document.querySelector(".sub-menu-wrap-teaching").classList.add("hoverSubMenuClose");
});



// Mobile Cat and SubCate Nav Bar

function showSubCate(event) {
  event.preventDefault(); // prevent the default behavior of the clicked link
  var clickedLink = event.target;
  var subCategoryName = clickedLink.dataset.subcategory;
  var idsubCategoryName = '#'+subCategoryName;
  document.querySelector(idsubCategoryName).classList.add("active");
}

function hideSubCate() {
  var clickedLink1 = event.target;
  var subCategoryName1 = clickedLink1.dataset.subcategory;
  var idsubCategoryName1 = '#'+subCategoryName1;
  document.querySelector(idsubCategoryName1).classList.remove("active");

}





// for Recommend Course

const wrapperSlider = document.querySelector(".wrapperSlider");
const carouselSlider = wrapperSlider.querySelector(".carouselSlider");
firstImg = wrapperSlider.querySelectorAll('img')[0];
arrowIcons = wrapperSlider.querySelectorAll(".wrapperSlider i");

let isDragStart = false, isDragging = false, prevPageX, prevScrollLeft, positionDiff;


const showHideIcons = () => {

  let scrollWidth = carouselSlider.scrollWidth - carouselSlider.clientWidth; //getting max scrollable width
  // if the carousel scroll left val is 0 then hide the prev icon else show it
  arrowIcons[0].style.display = carouselSlider.scrollLeft == 0 ? "none" : "block";
  arrowIcons[1].style.display = carouselSlider.scrollLeft == scrollWidth ? "none" : "block";

}

arrowIcons.forEach(icon => {
  icon.addEventListener("click", () => {

    let firstImgWidth = firstImg.clientWidth + 14; //getting first img width & adding 14 px val of margin
    // if clicked icon is left, reduce width value from the carousel scroll left else add to it
    carouselSlider.scrollLeft += icon.id == "left" ? -firstImgWidth : firstImgWidth;

    // if(icon.id == "left")
    // {
    //     carouselSlider.scrollLeft -= firstImgWidth;
    // }
    // else
    // {   
    //     carouselSlider.scrollLeft += firstImgWidth;
    // }

    setTimeout(() => showHideIcons(), 60); //calling shiowHideIcons after 60ms
  });
});

const autoSlieToMiddle = () => {

  //if there is no img left to scroll then return from here
  if (carouselSlider.scrollLeft == (carouselSlider.scrollWidth - carouselSlider.clientWidth)) return;


  positionDiff = Math.abs(positionDiff); // making positionDIff into positive value
  let firstImgWidth = firstImg.clientWidth + 14;
  //getting idfference value that needs to add or reduce from carousel left to take img to middle center
  let valDifference = firstImgWidth - positionDiff;


  if (carouselSlider.scrollLeft > prevScrollLeft) //user is scrolling to the right
  {
    return carouselSlider.scrollLeft += positionDiff > firstImgWidth / 3 ? valDifference : -positionDiff;

    //    if(positionDiff > firstImgWidth / 3)
    //    {
    //         carouselSlider.scrollLeft += valDifference;
    //    }
    //    else
    //    {
    //         carouselSlider.scrollLeft -= positionDiff;
    //    }



  }
  else // user is scrolling to the left
    carouselSlider.scrollLeft -= positionDiff > firstImgWidth / 3 ? valDifference : -positionDiff;

}

const dragStart = (e) => {
  //updating global variables value on mouse down event
  isDragStart = true;
  // For X coordinate of the mouse pointer or touch
  prevPageX = e.pageX || e.touches[0].pageX; //e.pageX will run on desktop devices and on touch devices e.touches[0].pageX run
  prevScrollLeft = carouselSlider.scrollLeft;
}

const dragging = (e) => {
  // scrolling images/slider to left according to mouse pointer
  if (!isDragStart) return;
  e.preventDefault(); //prevent dragging images on move
  isDragging = true;
  carouselSlider.classList.add('dragging');
  positionDiff = (e.pageX || e.touches[0].pageX) - prevPageX;
  carouselSlider.scrollLeft = prevScrollLeft - positionDiff;
  showHideIcons();
}

const dragStop = () => {
  isDragStart = false;
  carouselSlider.classList.remove('dragging');

  if (!isDragging) return;
  isDragging = false;
  autoSlieToMiddle();
}

carouselSlider.addEventListener("mousedown", dragStart);
carouselSlider.addEventListener("touchstart", dragStart);

carouselSlider.addEventListener("mousemove", dragging);
carouselSlider.addEventListener("touchmove", dragging);

carouselSlider.addEventListener("mouseup", dragStop);
carouselSlider.addEventListener("mouseleave", dragStop);
carouselSlider.addEventListener("touchend", dragStop);


/** =================== Fro Recent Free Courses Slider =================== */


const wrapperSlider1 = document.querySelector(".wrapperSlider1");
const carouselSlider1 = wrapperSlider1.querySelector(".carouselSlider1");
firstImg1 = wrapperSlider1.querySelectorAll('img')[0];
arrowIcons1 = wrapperSlider1.querySelectorAll(".wrapperSlider1 i");

let isdragStart11 = false, isdragging11 = false, prevPageX1, prevScrollLeft1, positionDiff1;


const showHideIcons1 = () => {

  let scrollWidth = carouselSlider1.scrollWidth - carouselSlider1.clientWidth; //getting max scrollable width
  // if the carousel scroll left val is 0 then hide the prev icon else show it
  arrowIcons1[0].style.display = carouselSlider1.scrollLeft == 0 ? "none" : "block";
  arrowIcons1[1].style.display = carouselSlider1.scrollLeft == scrollWidth ? "none" : "block";

}

arrowIcons1.forEach(icon => {
  icon.addEventListener("click", () => {

    let firstImg1Width1 = firstImg1.clientWidth + 14; //getting first img width & adding 14 px val of margin
    // if clicked icon is left, reduce width value from the carousel scroll left else add to it
    carouselSlider1.scrollLeft += icon.id == "left" ? -firstImg1Width1 : firstImg1Width1;

    // if(icon.id == "left")
    // {
    //     carouselSlider1.scrollLeft -= firstImg1Width1;
    // }
    // else
    // {   
    //     carouselSlider1.scrollLeft += firstImg1Width1;
    // }

    setTimeout(() => showHideIcons1(), 60); //calling shiowHideIcons after 60ms
  });
});

const autoSlieToMiddle1 = () => {

  // //if there is no img left to scroll then return from here
  // if (carouselSlider1.scrollLeft == (carouselSlider1.scrollWidth - carouselSlider1.clientWidth)) return;


  // positionDiff1 = Math.abs(positionDiff1); // making positionDiff1 into positive value
  // let firstImg1Width1 = firstImg1.clientWidth + 14;
  // //getting idfference value that needs to add or reduce from carousel left to take img to middle center
  // let valDifference1 = firstImg1Width1 - positionDiff1;


  // if (carouselSlider1.scrollLeft > prevScrollLeft1) //user is scrolling to the right
  // {
  //     return carouselSlider1.scrollLeft += positionDiff1 > firstImg1Width1 / 3 ? valDifference1 : -positionDiff1;

  //     //    if(positionDiff1 > firstImg1Width1 / 3)
  //     //    {
  //     //         carouselSlider1.scrollLeft += valDifference1;
  //     //    }
  //     //    else
  //     //    {
  //     //         carouselSlider1.scrollLeft -= positionDiff1;
  //     //    }



  // }
  // else // user is scrolling to the left
  //     carouselSlider1.scrollLeft -= positionDiff1 > firstImg1Width1 / 3 ? valDifference1 : -positionDiff1;

}

const dragStart1 = (e) => {
  //updating global variables value on mouse down event
  isdragStart11 = true;
  // For X coordinate of the mouse pointer or touch
  prevPageX1 = e.pageX || e.touches[0].pageX; //e.pageX will run on desktop devices and on touch devices e.touches[0].pageX run
  prevScrollLeft1 = carouselSlider1.scrollLeft;
}

const dragging1 = (e) => {

  // scrolling images/slider to left according to mouse pointer
  if (!isdragStart11) return;
  e.preventDefault(); //prevent dragging images on move
  isdragging11 = true;
  carouselSlider1.classList.add('dragging1');
  positionDiff1 = (e.pageX || e.touches[0].pageX) - prevPageX1;
  carouselSlider1.scrollLeft = prevScrollLeft1 - positionDiff1;
  showHideIcons1();

}

const dragStop1 = () => {

  isdragStart11 = false;
  carouselSlider1.classList.remove('dragging1');

  if (!isdragging11) return;
  isdragging11 = false;
  autoSlieToMiddle1();
}

carouselSlider1.addEventListener("mousedown", dragStart1);
carouselSlider1.addEventListener("touchstart", dragStart1);

carouselSlider1.addEventListener("mousemove", dragging1);
carouselSlider1.addEventListener("touchmove", dragging1);

carouselSlider1.addEventListener("mouseup", dragStop1);
carouselSlider1.addEventListener("mouseleave", dragStop1);
carouselSlider1.addEventListener("touchend", dragStop1);


/** ======== End of Recent Free Course ======== */


/**========== Top Seller Slider Course ============ */

const wrapperSlider2 = document.querySelector(".wrapperSlider2");
const carouselSlider2 = wrapperSlider2.querySelector(".carouselSlider2");
firstImg2 = wrapperSlider2.querySelectorAll('img')[0];
arrowIcons2 = wrapperSlider2.querySelectorAll(".wrapperSlider2 i");

let isdragStart2 = false,
  isdragging2 = false,
  prevPageX2, prevScrollLeft2, positionDiff2;


const showHideIcons2 = () => {

  let scrollWidth = carouselSlider2.scrollWidth - carouselSlider2.clientWidth; //getting max scrollable width
  // if the carousel scroll left val is 0 then hide the prev icon else show it
  arrowIcons2[0].style.display = carouselSlider2.scrollLeft == 0 ? "none" : "block";
  arrowIcons2[1].style.display = carouselSlider2.scrollLeft == scrollWidth ? "none" : "block";

}

arrowIcons2.forEach(icon => {
  icon.addEventListener("click", () => {

    let firstImg2Width2 = firstImg2.clientWidth + 14; //getting first img width & adding 14 px val of margin
    // if clicked icon is left, reduce width value from the carousel scroll left else add to it
    carouselSlider2.scrollLeft += icon.id == "left" ? -firstImg2Width2 : firstImg2Width2;

    // if(icon.id == "left")
    // {
    //     carouselSlider2.scrollLeft -= firstImg2Width2;
    // }
    // else
    // {   
    //     carouselSlider2.scrollLeft += firstImg2Width2;
    // }

    setTimeout(() => showHideIcons2(), 60); //calling shiowHideIcons after 60ms
  });
});

const autoSlieToMiddle2 = () => {

  // //if there is no img left to scroll then return from here
  // if (carouselSlider2.scrollLeft == (carouselSlider2.scrollWidth - carouselSlider2.clientWidth)) return;


  // positionDiff2 = Math.abs(positionDiff2); // making positionDiff2 into positive value
  // let firstImg2Width2 = firstImg2.clientWidth + 14;
  // //getting idfference value that needs to add or reduce from carousel left to take img to middle center
  // let valDifference2 = firstImg2Width2 - positionDiff2;


  // if (carouselSlider2.scrollLeft > prevScrollLeft2) //user is scrolling to the right
  // {
  //     return carouselSlider2.scrollLeft += positionDiff2 > firstImg2Width2 / 3 ? valDifference2 : -positionDiff2;

  //     //    if(positionDiff2 > firstImg2Width2 / 3)
  //     //    {
  //     //         carouselSlider2.scrollLeft += valDifference2;
  //     //    }
  //     //    else
  //     //    {
  //     //         carouselSlider2.scrollLeft -= positionDiff2;
  //     //    }



  // }
  // else // user is scrolling to the left
  //     carouselSlider2.scrollLeft -= positionDiff2 > firstImg2Width2 / 3 ? valDifference2 : -positionDiff2;

}

const dragStart2 = (e) => {
  //updating global variables value on mouse down event
  isdragStart2 = true;
  // For X coordinate of the mouse pointer or touch
  prevPageX2 = e.pageX || e.touches[0].pageX; //e.pageX will run on desktop devices and on touch devices e.touches[0].pageX run
  prevScrollLeft2 = carouselSlider2.scrollLeft;
}

const dragging2 = (e) => {
  if (!isdragStart2) return;
  e.preventDefault();
  isdragging2 = true;
  carouselSlider2.classList.add('dragging2');
  positionDiff2 = (e.pageX || e.touches[0].pageX) - prevPageX2;

  requestAnimationFrame(() => {
    carouselSlider2.scrollLeft = prevScrollLeft2 - positionDiff2;
    showHideIcons2();
  });
}

const dragStop2 = () => {
  isdragStart2 = false;
  carouselSlider2.classList.remove('dragging2');

  if (!isdragging2) return;
  isdragging2 = false;
  autoSlieToMiddle2();
}

carouselSlider2.addEventListener("mousedown", dragStart2);
carouselSlider2.addEventListener("touchstart", dragStart2);

carouselSlider2.addEventListener("mousemove", dragging2);
carouselSlider2.addEventListener("touchmove", dragging2);

carouselSlider2.addEventListener("mouseup", dragStop2);
carouselSlider2.addEventListener("mouseleave", dragStop2);
carouselSlider2.addEventListener("touchend", dragStop2);


/** ===== End of Top Seller Course =========== */