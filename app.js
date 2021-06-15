const popupCon = document.querySelector(".popup-con");
const popup = document.querySelector(".popup");
const mainArea = document.querySelector(".main-area");
const hamburger = document.querySelector(".hamburger");
const sideMenu = document.querySelector(".side-menu");

hamburger.addEventListener("click", () => {
  console.log("entered");
  hamburger.classList.toggle("times");
  hamburger.classList.toggle("move-left");
  sideMenu.classList.toggle("open");
});

document.addEventListener("load", () => {
  console.log("Okay");
});

document.body.addEventListener("click", (e) => {
  if (e.target.classList.contains("popup")) {
    fadeout();
  }
});

document.addEventListener("keydown", (e) => {
  if (e.key === "Escape") {
    fadeout();
  }
});

function fadeout() {
  popupCon.classList.add("fade-out");
  popup.classList.add("pop-fadeout");

  setTimeout(() => {
    popup.style.display = "none";
    popupCon.classList.remove("fade-out");
    popupCon.classList.remove("fade-in");
    popup.classList.remove("pop-fadeout");
    popup.classList.remove("pop-fadein");
  }, 600);
}
