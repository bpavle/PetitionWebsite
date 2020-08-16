function validateForm() {
  var forDelitation = [];

  var checkboxes = document.getElementById("jsChecboxId");

  for (var i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked) {
      forDelitation.push(checkboxes[i].value);
    }
  }

  return confirm("Пажња! Обрисаћете следеће редове" + checkboxes);
}
