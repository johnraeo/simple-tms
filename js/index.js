
const addButton = document.querySelector('#add-button');
const addModal = document.querySelector('.section-add-modal');

const add = () => {
  // addModal.style.display = "block";
  addModal.style.display = 'block !important';
  addModal.style.visibility = 'visible';
  // console.log(addModal.style.display = "block !important");
}

addButton.addEventListener('click', add);

window.addEventListener('click', (e) => {
  if (e.target.className.includes("section-add-modal") || e.target.className.includes("row")) {
    addModal.style.display = 'none !important';
    addModal.style.visibility = 'hidden';
  }
});