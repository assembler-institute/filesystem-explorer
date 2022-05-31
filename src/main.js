import {appendInfoToFilePreview ,displayFileIcon} from './JS/utilities.js'

// Global variables
const fileCards = document.querySelectorAll('[file-cards]');


const displayFilePreview =  (e) => {
  const fileCardEl =  e.currentTarget;
  const fileTitle = fileCardEl.querySelector('[file-title]').textContent;
  appendInfoToFilePreview(fileTitle)
}



displayFileIcon()




// Event Listener
fileCards.forEach(card => card.addEventListener('click', displayFilePreview))
