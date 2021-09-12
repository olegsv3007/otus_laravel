require('./bootstrap');

//Сделать строки таблиц в CMS кликабельными
let rows = document.getElementsByClassName('clickable-row');

 for (let i = 0; i < rows.length; i++) {
     rows[i].addEventListener('click', e => {
         document.location = e.currentTarget.closest('tr').dataset.href;
     });
 }

//Вызывать submit у скрытых форм
let buttons = document.getElementsByClassName('btn-form');
 for (let i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener('click', e => {
        let id = e.currentTarget.dataset.form;
        document.getElementById(id).submit();
    });
 }

