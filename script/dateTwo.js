
const editButtons = document.getElementById('edit');

editButtons.addEventListener('click', function (e){
    e.preventDefault();
    changeDataTwo()
});



let modal = document.getElementById("modal");
console.log(modal)

let closemodal = document.getElementsByClassName("closemodal")[0];

function openmodal() {
    console.log(modal)
    modal.style.display = "block";

}

closemodal.onclick = function () {
    modal.style.display = "none";
    document.location.reload();
}
window.onclick = function (event) {
    if (event.target === modal) {
        modal.style.display = "none";
        document.location.reload();
    }
}
// Функция для изменения данных блока
 function changeDataTwo() {
    // Получаем родительский блок
    // const adminBlock = editButton.closest('.admin_title_content');
    //
    // // Получаем данные из нужных полей
    // const fullname = adminBlock.querySelector('.fullname').textContent;
    // const status = adminBlock.querySelector('.status').textContent;
    // const date = adminBlock.querySelector('.date').textContent;
    // const cabinet = adminBlock.querySelector('.cabinet').textContent;
    // // Меняем данные у другого блока
    // const otherBlock = document.querySelector('.content_users');
    //
    //
    // otherBlock.querySelector('.user_name_admin').value = fullname;
    // otherBlock.querySelector('.user_status_admin').value = status;
    // otherBlock.querySelector('.user_date_admin').value = date;
    // otherBlock.querySelector('.user_cabinet_admin').value = cabinet;
    openmodal()
}
