let folderIdSelectedContext;

// Show the context menu.
for (let i = 0; i < document.getElementsByClassName("item-contextmenu").length; i++) {
  document.getElementsByClassName("item-contextmenu")[i].addEventListener("contextmenu", function (event) {
    event.preventDefault();

    folderIdSelectedContext = this.getAttribute("value");

    let menu = document.getElementById("context-menu");
    let menuState = menu.style.display;
    let back = document.getElementById("back-context");

    if (menuState == "none") {
      menu.style.display = "block";
      back.style.display = "block";

      let clickPosX = event.pageX;
      let clickPosY = event.pageY;

      let menuWidth = menu.offsetWidth + 5;
      let menuHeight = menu.offsetHeight + 5;
      let windowWidth = window.innerWidth;
      let windowHeight = window.innerHeight;

      if (windowWidth - clickPosX < menuWidth) menu.style.left = windowWidth - menuWidth + "px";
      else menu.style.left = clickPosX + "px";

      if (windowHeight - clickPosY < menuHeight) menu.style.top = windowHeight - menuHeight + "px";
      else menu.style.top = clickPosY + "px";
    }
    else {
      menu.style.display = "none";
      back.style.display = "none";
    }
  });
}

// Hide the context menu.
document.getElementById("back-context").addEventListener("mousedown", function () {
  document.getElementById("context-menu").style.display = "none";
  document.getElementById("back-context").style.display = "none";
});

// Modal of the creation of folder context menu.
document.getElementById("new-folder-context").addEventListener("click", function () {
  document.getElementById("context-menu").style.display = "none";
  document.getElementById("back-context").style.display = "none";

  let myModalSection = document.getElementById("section_modal");
  const templateContent = document.getElementById("modalTemplate-create-folder").content;
  let templateClone = document.importNode(templateContent, true);
  myModalSection.style.display = "block";
  myModalSection.append(templateClone);

  let btnCloseModal = document.getElementById("btnCloseModal");
  btnCloseModal.addEventListener("click", function(){
    let myModalSection = document.getElementById("section_modal");
    let myChilds = myModalSection.querySelector("div");
    myModalSection.style.display = "none";
    myModalSection.removeChild(myChilds);
  });

  document.getElementById("new-folder-context-form").addEventListener("submit", function(event){
    event.preventDefault();

    let newNameInput = document.querySelector("#new-folder-context-form input").value;
    
    $.ajax({
      url: "../../php/local_files/new_folder_context.php",
      type: "post",
      data: {
        "folder-id": folderIdSelectedContext,
        "new-folder-name": newNameInput
      }
    });

    window.location = `${window.location.pathname}?folder-id=${folderIdSelectedContext}`;
  });
});

// Modal of the rename folder context menu.
document.getElementById("rename-folder-context").addEventListener("click", function () {
  document.getElementById("context-menu").style.display = "none";
  document.getElementById("back-context").style.display = "none";

  let myModalSection = document.getElementById("section_modal");
  const templateContent = document.getElementById("modalTemplate-rename-folder").content;
  let templateClone = document.importNode(templateContent, true);
  myModalSection.style.display = "block";
  myModalSection.append(templateClone);

  let btnCloseModal = document.getElementById("btnCloseModal");
  btnCloseModal.addEventListener("click", function(){
    let myModalSection = document.getElementById("section_modal");
    let myChilds = myModalSection.querySelector("div");
    myModalSection.style.display = "none";
    myModalSection.removeChild(myChilds);
  });

  document.getElementById("rename-folder-context-form").addEventListener("submit", function(event){
    event.preventDefault();

    let newNameInput = document.querySelector("#rename-folder-context-form input").value;
    
    $.ajax({
      url: "../../php/local_files/rename_folder_context.php",
      type: "post",
      data: {
        "folder-id": folderIdSelectedContext,
        "new-folder-name": newNameInput
      },
    });

    location.reload();
  });
});

// Modal of the delete folder context menu.
document.getElementById("delete-folder-context").addEventListener("click", function () {
  document.getElementById("context-menu").style.display = "none";
  document.getElementById("back-context").style.display = "none";

  let myModalSection = document.getElementById("section_modal");
  const templateContent = document.getElementById("modalTemplate-delete-folder").content;
  let templateClone = document.importNode(templateContent, true);
  myModalSection.style.display = "block";
  myModalSection.append(templateClone);

  let btnCloseModal = document.getElementById("btnCloseModal");
  btnCloseModal.addEventListener("click", function(){
    let myModalSection = document.getElementById("section_modal");
    let myChilds = myModalSection.querySelector("div");
    myModalSection.style.display = "none";
    myModalSection.removeChild(myChilds);
  });

  document.getElementById("confirm-delete-btn").addEventListener("click", function(){
    let folderIdReload;

    $.ajax({
      url: "../../php/local_files/delete_folder_context.php",
      type: "post",
      data: {
        "folder-id": folderIdSelectedContext
      },
      success: function(res){
        folderIdReload = res;
        window.location = `${window.location.pathname}?folder-id=${folderIdReload}`;
      }
    });
  });
});