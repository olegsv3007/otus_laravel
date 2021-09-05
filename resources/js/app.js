require('./bootstrap');

//Сделать строки таблиц в CMS кликабельными
let rows = document.getElementsByClassName('clickable-row');

 for (let i = 0; i < rows.length; i++) {
     rows[i].addEventListener('click', e => {
         e.preventDefault();
         if (e.target.closest('tr').dataset.href) {
             document.location = e.target.closest('tr').dataset.href;
         }
     });
 }

//Вызывать submit у скрытых форм
let buttons = document.getElementsByClassName('btn-form');
 for (let i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener('click', e => {
        let id = e.target.dataset.form;
        document.getElementById(id).submit();
    });
 }

