const inpFile = document.getElementById("inpFile");
const previewContainer = document.getElementById("content_apercu_img");
const previewImage = previewContainer.querySelector(".apercu_img");

inpFile.addEventListener("change", function () {
  const file = this.files[0];
  if (file) {
    const reader = new FileReader();
    previewImage.style.display = "block";

    reader.addEventListener("load", function () {
      previewImage.setAttribute("src", this.result);
      console.log(previewImage);
    });

    reader.readAsDataURL(file);
  } else {
    previewImage.style.display = null;
    previewImage.setAttribute("src", "");
  }
});
