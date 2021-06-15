/* const chooseCategory = document.getElementById("choose-catedory");
const categoryInput = document.getElementById("add-category");
const categoryBtn = document.getElementById("add-category-btn"); */
const bannerImg = document.querySelector(".banner-img");
const uploadBanner = document.getElementById("uploadBanner");


/* categoryBtn.addEventListener("click", (e) => {
  e.preventDefault();

  let value = categoryInput.value;

  if (value) {
    let option = document.createElement("option");
    option.value = value.toLowerCase();
    option.textContent = value;
    option.setAttribute("selected", true);
    chooseCategory.appendChild(option);
    categoryInput.value = "";
    alert(`New category "${value}" added!`);
  } else {
    alert("Please enter a category name");
  }
}); */

uploadBanner.addEventListener("change", () => {
  const file = uploadBanner.files[0];

  if (file) {
    const reader = new FileReader();

    reader.addEventListener("load", function () {
      bannerImg.setAttribute("src", this.result);
    });

    reader.readAsDataURL(file);
  }
});




