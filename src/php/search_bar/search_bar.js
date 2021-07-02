let searchBarInput = document.getElementById("search__bar--input");
let searchBarInputContainer = document.getElementById(
  "search__bar--main--container"
);

searchBarInput.addEventListener("keyup", handle_change_input);
searchBarInputContainer.addEventListener("mouseover", handle_open_input);
searchBarInputContainer.addEventListener("mouseout", handle_close_input);

function handle_change_input() {
  let searchBarInputValue = document.getElementById("search__bar--input").value;
  searchBarInputContainer.style.display = "block";

  $.ajax({
    url: "../../php/search_bar/search_bar.php",
    type: "post",
    data: { inputSearch: searchBarInputValue },
    success: function (response) {
      searchBarInputContainer.innerHTML = response;
      putListenersOnseacrhText();
    },
  });
}
function handle_open_input() {
  searchBarInputContainer.style.display = "block";
}
function handle_close_input() {
  searchBarInputContainer.style.display = "none";
}

function putListenersOnseacrhText() {
  let mySearchContainerListening = document.getElementById(
    "text__inside--input"
  );
  let mySearListening = mySearchContainerListening.querySelectorAll(
    ".input__search--files"
  );

  mySearListening.forEach((element) => {
    element.addEventListener("click", openModal);
  });
}

function openModal() {
  let myId = event.target;
  let mySource = myId.dataset.source;

  const file_mp4 = ".mp4";
  const file_mp3 = ".mp3";
  const file_image_png = ".png";
  const file_img_jpg = ".jpg";

  if (mySource.includes(file_mp4)) {
    let myModalSection = document.getElementById("section_modal");
    const templateContent = document.getElementById(
      "modalTemplate_video"
    ).content;
    let templateClone = document.importNode(templateContent, true);
    myModalSection.style.display = "block";
    myModalSection.append(templateClone);
    let btnCloseModal = document.getElementById("btnCloseModal");
    btnCloseModal.addEventListener("click", closeModal);

    let my_source_container = document.getElementById("video_source");
    my_source_container.setAttribute("src", mySource);
  } else if (mySource.includes(file_mp3)) {
    let myModalSection = document.getElementById("section_modal");
    const templateContent = document.getElementById(
      "modalTemplate_sound"
    ).content;
    let templateClone = document.importNode(templateContent, true);
    myModalSection.style.display = "block";
    myModalSection.append(templateClone);
    let btnCloseModal = document.getElementById("btnCloseModal");
    btnCloseModal.addEventListener("click", closeModal);

    let my_source_container = document.getElementById("sound_source");
    my_source_container.setAttribute("src", mySource);
  } else if (
    mySource.includes(file_image_png) ||
    mySource.includes(file_img_jpg)
  ) {
    let myModalSection = document.getElementById("section_modal");
    const templateContent =
      document.getElementById("modalTemplate_img").content;
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

  function closeModal() {
    let myModalSection = document.getElementById("section_modal");
    let myChilds = myModalSection.querySelector("div");
    myModalSection.style.display = "none";
    myModalSection.removeChild(myChilds);
  }
}

