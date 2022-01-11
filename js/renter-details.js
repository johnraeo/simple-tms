
const addButton = document.querySelector('#add-payment');
const addModal = document.querySelector('.section-add-modal');
const editModal = document.querySelector('.section-edit-modal');
const deleteModal = document.querySelector('.section-delete-modal');
const abandonModal = document.querySelector('.section-abandon-modal');
const editTenantBtn = document.querySelector('#editTenantBtn');
const deleteTenantBtn = document.querySelector('#deleteTenantBtn');
const cancelDeleteBtn = document.querySelector('.section-delete-modal .box-1 .btn')
const abandonTenantBtn = document.querySelector('#abandonTenant');

const add = () => {
  // addModal.style.display = "block";
  addModal.style.display = 'block !important';
  addModal.style.visibility = 'visible';
  // console.log(addModal.style.display = "block !important");
}

const editTenant = () => {
  editModal.style.display = 'block !important';
  editModal.style.visibility = 'visible';
}

const deleteTenant = () => {
  deleteModal.style.display = 'block !important';
  deleteModal.style.visibility = 'visible';
}

const abandonTenant = () => {
  abandonModal.style.display = 'block !important';
  abandonModal.style.visibility = 'visible';
}

addButton.addEventListener('click', add);
editTenantBtn.addEventListener('click', editTenant);
deleteTenantBtn.addEventListener('click', deleteTenant);
abandonTenantBtn.addEventListener('click', abandonTenant);

window.addEventListener('click', (e) => {
  if (e.target.className.includes("section-add-modal") || e.target.className.includes("row")) {
    addModal.style.display = 'none !important';
    addModal.style.visibility = 'hidden';
  }

  if (e.target.className.includes("section-edit-modal") || e.target.className.includes("row")) {
    editModal.style.display = 'none !important';
    editModal.style.visibility = 'hidden';
  }

  if (e.target.className.includes("section-delete-modal") || e.target.className.includes("row") || e.target.className.includes("cancel-delete")) {
    deleteModal.style.display = 'none !important';
    deleteModal.style.visibility = 'hidden';
  }

  if (e.target.className.includes("section-abandon-modal") || e.target.className.includes("row") || e.target.className.includes("cancel-delete")) {
    abandonModal.style.display = 'none !important';
    abandonModal.style.visibility = 'hidden';
  }
});