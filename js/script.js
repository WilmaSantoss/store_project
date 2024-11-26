/* atendimento - email */
const buttonEmail = document.querySelector('.mais_info_email');
const dialogEmail = document.querySelector('.dialog_email');
const buttonCloseEmail = document.querySelector('.buttonCloseEmail');

buttonEmail.onclick = function () {
    dialogEmail.showModal();
}

buttonCloseEmail.onclick = function () {
    dialogEmail.close();
}

/* atendimento - telefone */

const buttonTel = document.querySelector('.mais_info_tel');
const dialogTel = document.querySelector('.dialog_tel');
const buttonCloseTel = document.querySelector('.buttonCloseTel');

buttonTel.onclick = function () {
    dialogTel.showModal();
}

buttonCloseTel.onclick = function () {
    dialogTel.close();
}

/* atendimento - presencial */

const buttonPresen = document.querySelector('.mais_info_presen');
const dialogPresen = document.querySelector('.dialog_presen');
const buttonClosePresen = document.querySelector('.buttonClosePresen');

buttonPresen.onclick = function () {
    dialogPresen.showModal();
}

buttonClosePresen.onclick = function () {
    dialogPresen.close();
}


  