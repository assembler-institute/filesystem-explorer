const showMediaContainer = document.querySelector("#showMediaContainer");
const showMediaChild = document.querySelector("#showMediaChild");
const previewChild = document.querySelector("#previewChild");
let xIcon;

function showMedia() {
    previewChild.style.display = "none";
    previewChild.innerHTML = "";
    let dataPathWithoutSlash = dataPath.substring(0, dataPath.length - 1);
    if (dataPath.includes(".mp4")) {
        showMediaContainer.style.display = "flex";
        showMediaChild.innerHTML = "<img id='xIcon' src='images/xIcon.png' alt='x icon'><video width='320' height='240' controls autoplay><source src='./files/" + dataPathWithoutSlash + "' type='video/mp4'>Sorry, your browser doesn't support the video element.</video>";
    } else if (dataPath.includes(".mp3")) {
        showMediaContainer.style.display = "flex";
        showMediaChild.innerHTML = "<img id='xIcon' src='images/xIcon.png' alt='x icon'><audio controls><source src='./files/" + dataPathWithoutSlash + "' type='audio/mpeg'>Sorry, your browser does not support the audio element.</audio>";
    } else if (dataPath.includes(".jpg") || dataPath.includes(".jpeg")) {
        showMediaContainer.style.display = "flex";
        showMediaChild.innerHTML = "<img id='xIcon' src='images/xIcon.png' alt='x icon'><img id='shownImage' src='./files/" + dataPathWithoutSlash + "' type='image/jpg'>";
    } else if (dataPath.includes(".png")) {
        showMediaContainer.style.display = "flex";
        showMediaChild.innerHTML = "<img id='xIcon' src='images/xIcon.png' alt='x icon'><img id='shownImage' src='./files/" + dataPathWithoutSlash + "' type='image/jpg'>";
    } else if (dataPath.includes(".svg")) {
        showMediaContainer.style.display = "flex";
        showMediaChild.innerHTML = "<img id='xIcon' src='images/xIcon.png' alt='x icon'><img id='shownImage' src='./files/" + dataPathWithoutSlash + "' type='image/svg'>";
    } else if (dataPath.includes(".pdf")) {
        showMediaContainer.style.display = "flex";
        showMediaChild.innerHTML = "<img id='xIcon' src='images/xIcon.png' alt='x icon'><iframe src='./files/" + dataPathWithoutSlash + "' width='700' height='550' allowfullscreen webkitallowfullscreen></iframe>";
    }
    xIcon = document.querySelector("#xIcon");
    xIcon.addEventListener("click", hideMedia);
    window.addEventListener('click', clickOutside);
}

function clickOutside(e) {
    if (!document.getElementById('showMediaChild').contains(e.target)) {
        hideMedia();
    }
}

function hideMedia() {
    showMediaContainer.style.display = "none";
    showMediaChild.innerHTML = "";
    xIcon.removeEventListener("click", hideMedia);
    window.removeEventListener("click", clickOutside);
}

function showPreview() {
    let dataPathWithoutSlash;
    let slashOrNoSlash = dataPath.slice(-1)[0];
    if (slashOrNoSlash == "/") {
        dataPathWithoutSlash = dataPath.substring(0, dataPath.length - 1);
    } else {
        dataPathWithoutSlash = dataPath;
    }
    if (dataPath.includes(".mp4")) {
        setPreview();
        previewChild.innerHTML = "<video class='thumbnail-media' width='320' height='240' controls autoplay><source src='./files/" + dataPathWithoutSlash + "' type='video/mp4'>Sorry, your browser doesn't support the video element.</video>";
    } else if (dataPath.includes(".mp3")) {
        setPreview();
        previewChild.innerHTML = "<audio class='thumbnail-media' controls><source src='./files/" + dataPathWithoutSlash + "' type='audio/mpeg'>Sorry, your browser does not support the audio element.</audio>";
    } else if (dataPath.includes(".jpg") || dataPath.includes(".jpeg")) {
        setPreview();
        previewChild.innerHTML = "<img id='shownImage' class='thumbnail-media' src='./files/" + dataPathWithoutSlash + "' type='image/jpg'>";
    } else if (dataPath.includes(".png")) {
        setPreview();
        previewChild.innerHTML = "<img id='shownImage' class='thumbnail-media' src='./files/" + dataPathWithoutSlash + "' type='image/png'>";
    } else if (dataPath.includes(".svg")) {
        setPreview();
        previewChild.innerHTML = "<img id='shownImage' class='thumbnail-media' src='./files/" + dataPathWithoutSlash + "' type='image/svg'>";
    } else if (dataPath.includes(".pdf")) {
        setPreview();
        previewChild.innerHTML = "<iframe src='./files/" + dataPathWithoutSlash + "' width='90%' height='500' allowfullscreen webkitallowfullscreen></iframe>";
    }
}

function setPreview() {
    previewText.style.display = "none";
    previewChild.style.display = "flex";
    ul.addEventListener("click", hidePreview);
}

function hidePreview() {
    if (typeDocument == "folder") {
        previewChild.innerHTML = "";
        previewChild.style.display = "none";
        previewText.style.display = "block";
        ul.removeEventListener("click", hidePreview);
    }
}