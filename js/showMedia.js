const showMediaContainer = document.querySelector("#showMediaContainer");
const showMediaChild = document.querySelector("#showMediaChild");
const previwChild = document.querySelector("#previwChild");
let xIcon;

function showMedia() {
    previwChild.style.display = "none";
    previwChild.innerHTML = "";
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
    }
    xIcon = document.querySelector("#xIcon");
    xIcon.addEventListener("click", hideMedia);
    window.addEventListener('click', clickOutside);
}

function clickOutside(e){
    if (!document.getElementById('showMediaChild').contains(e.target)){
        hideMedia();
    }
}

function hideMedia(){
    showMediaContainer.style.display = "none";
    showMediaChild.innerHTML = "";
    xIcon.removeEventListener("click", hideMedia);
    window.removeEventListener("click", clickOutside);
}

function showPreview(){
    let dataPathWithoutSlash = dataPath.substring(0, dataPath.length - 1);
    if (dataPath.includes(".mp4")) {
        setPreview();
        previwChild.innerHTML = "<img id='xIcon' src='images/xIcon.png' alt='x icon'><video class='thumbnail-media' width='320' height='240' controls autoplay><source src='./files/" + dataPathWithoutSlash + "' type='video/mp4'>Sorry, your browser doesn't support the video element.</video>";
    } else if (dataPath.includes(".mp3")) {
        setPreview();
        previwChild.innerHTML = "<img id='xIcon' src='images/xIcon.png' alt='x icon'><audio class='thumbnail-media' controls><source src='./files/" + dataPathWithoutSlash + "' type='audio/mpeg'>Sorry, your browser does not support the audio element.</audio>";
    } else if (dataPath.includes(".jpg") || dataPath.includes(".jpeg")) {
        setPreview();
        previwChild.innerHTML = "<img id='xIcon' src='images/xIcon.png' alt='x icon'><img id='shownImage' class='thumbnail-media' src='./files/" + dataPathWithoutSlash + "' type='image/jpg'>";
    } else if (dataPath.includes(".png")) {
        setPreview();
        previwChild.innerHTML = "<img id='xIcon' src='images/xIcon.png' alt='x icon'><img id='shownImage' class='thumbnail-media' src='./files/" + dataPathWithoutSlash + "' type='image/jpg'>";
    }
}

function setPreview(){
    previewText.style.display = "none";
    previwChild.style.display = "flex";
    ul.addEventListener("click", hidePreview);
}

function hidePreview(){
    previwChild.innerHTML = "";
    previewText.style.display = "block";
    ul.removeEventListener("click", hidePreview);
}