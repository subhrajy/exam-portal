`use strict`;

const btn_login = document.querySelector(`.btn-login`);
const btn_register = document.querySelector(`.btn-register`);
const overlay = document.querySelector(`.overlay`);
const login_popup = document.querySelector(`.login-popup`);
const register_popup = document.querySelector(`.register-popup`);
const studentImage = document.querySelector(`#student-image`);
const studentImageBox = document.querySelector(`#student-image--box`);

console.log(studentImage);
console.log(studentImageBox);

btn_login.addEventListener("click", (event) => {
  event.preventDefault();
  login_popup.classList.remove(`hidden`);
  overlay.classList.remove(`hidden`);
});

overlay.addEventListener("click", () => {
  overlay.classList.add(`hidden`);
  login_popup.classList.add(`hidden`);
});

if(studentImage != null)
{
  studentImage.onchange = (event) => {
    const [file] = studentImage.files;

    if (file) {
      studentImageBox.src = URL.createObjectURL(file);
    }
  };
}
