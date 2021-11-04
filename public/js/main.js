let form = document.querySelector("#form");
let result = document.querySelector("#box-result");
let resultDetails = document.querySelector("#box-result-details");
let btnSubmit = document.querySelector("#btn-submit")
let input = document.querySelector("#form-input")
let home = document.querySelector("#home-header");
let btnNew = document.querySelector("#btn-new");
let img = document.querySelector("#img-header");

form.addEventListener("submit", (e)=> {
  e.preventDefault();
  let url = "./app/modules/searchData.php";


  result.innerHTML = '<br><div class="d-flex justify-content-center text-warning" style="margin-top:25vh"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';
  home.classList.remove("m-top");

  input.classList.add("d-none");
  img.classList.remove("mx-auto", "d-block", "mt-5", "mb-2");
  img.classList.add("img-header-new");
  btnSubmit.classList.add("d-none");
  btnNew.classList.add("btn-submit-new");
  btnNew.classList.remove("d-none");
  btnNew.classList.add("d-block", "btn-sm");

  fetch(url, {
    method: 'POST',
    body: new FormData(form)
  })
  .then(response => response.text())
  .then(res => {
    input.value = "";
    result.innerHTML = res;

  })
  .catch(error => {
    alert(error);
  })
});

function formEventDetails(id) {

  const urli = "./app/modules/searchDataDetails.php";
  const formDetails = document.querySelector("#form-details-"+id);

  result.classList.add("d-none");
  resultDetails.classList.remove("d-none");
  resultDetails.classList.add("d-block");

  resultDetails.innerHTML = '<br><div class="d-flex justify-content-center text-warning" style="margin-top:25vh"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';
  home.classList.remove("m-top");

  input.classList.add("d-none");
  img.classList.remove("mx-auto", "d-block", "mt-5", "mb-2");
  img.classList.add("img-header-new");
  btnSubmit.classList.add("d-none");
  btnNew.classList.add("btn-submit-new");
  btnNew.classList.remove("d-none");
  btnNew.classList.add("d-block", "btn-sm");

  fetch(urli, {
    method: 'POST',
    body: new FormData(formDetails)
  })
  .then(response => response.text())
  .then(res => {
    resultDetails.innerHTML = res;
  })
  .catch(error => {
    alert(error);
  })
}

function toggleBoxDisplay(){
  resultDetails.classList.remove("d-block");
  resultDetails.classList.add("d-none");
  result.classList.remove("d-none");
  result.classList.add("d-block");
}