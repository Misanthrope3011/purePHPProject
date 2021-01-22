
function createPopup(title, bodyText) {
  $(".modal-title").text(title);
  $(".modal-body").text(bodyText);
  $('#myModal').modal('show');
}