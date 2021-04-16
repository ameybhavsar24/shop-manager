$(document).ready(function () {
  $('.sidenav').sidenav({
    draggable: true,
  });
  $('#modal-add-item').modal();
  let modals_edit = $('.modal-edit');
  modals_edit.modal();
  //     for (let i=0; i<modals_edit.length; i++) {
  //       modals_edit
  //     }
  $('input#item_name').characterCounter();
  $('select').formSelect();
});
