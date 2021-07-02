let myFilesContainerListening = document.getElementById("file_container");
let myFilesListening =
  myFilesContainerListening.querySelectorAll(".open_modal");

myFilesListening.forEach((element) => {
  element.addEventListener("dblclick", openModal);
});

function openModal() {
  let mySource = this.dataset.source;

  const file_mp4 = ".mp4";
  const file_mp3 = ".mp3";
  const file_image_png = ".png";
  const file_img_jpg = ".jpg";

  if(mySource.includes(file_mp4)){

    let myModalSection = document.getElementById("section_modal");
    const templateContent = document.getElementById("modalTemplate_video").content;
    let templateClone = document.importNode(templateContent, true);
    myModalSection.style.display = "block";
    myModalSection.append(templateClone);
    let btnCloseModal = document.getElementById("btnCloseModal");
    btnCloseModal.addEventListener("click", closeModal);

    let my_source_container = document.getElementById("video_source");
    my_source_container.setAttribute("src", mySource);

  } else if (mySource.includes(file_mp3)){

    let myModalSection = document.getElementById("section_modal");
    const templateContent = document.getElementById("modalTemplate_sound").content;
    let templateClone = document.importNode(templateContent, true);
    myModalSection.style.display = "block";
    myModalSection.append(templateClone);
    let btnCloseModal = document.getElementById("btnCloseModal");
    btnCloseModal.addEventListener("click", closeModal);

    let my_source_container = document.getElementById("sound_source");
    my_source_container.setAttribute("src", mySource);

  } else if(mySource.includes(file_image_png) || mySource.includes(file_img_jpg)){

    let myModalSection = document.getElementById("section_modal");
    const templateContent = document.getElementById("modalTemplate_img").content;
    let templateClone = document.importNode(templateContent, true);
    myModalSection.style.display = "block";
    myModalSection.append(templateClone);
    let btnCloseModal = document.getElementById("btnCloseModal");
    btnCloseModal.addEventListener("click", closeModal);

    let my_source_container = document.getElementById("img_source");
    my_source_container.setAttribute("src", mySource);

  } else {

    let myModalSection = document.getElementById("section_modal");
    const templateContent = document.getElementById("modalTemplate").content;
    let templateClone = document.importNode(templateContent, true);
    myModalSection.style.display = "block";
    myModalSection.append(templateClone);
    let btnCloseModal = document.getElementById("btnCloseModal");
    btnCloseModal.addEventListener("click", closeModal);

  }
}

function closeModal() {
  let myModalSection = document.getElementById("section_modal");
  let myChilds = myModalSection.querySelector("div");
  myModalSection.style.display = "none";
  myModalSection.removeChild(myChilds);
}