const editQuestionForm = document.getElementById('editQuestionForm');
const errorMessage = document.getElementById('errorMessage');

editQuestionForm.addEventListener('submit', verif);

function verif(e) {
    var checkLength = 0;
    var boxes = document.getElementsByClassName('inputCategories');
    for (var i = 0; i < boxes.length; i++) {
        boxes[i].checked ? checkLength++ : null;
    }

    if (checkLength === 0) {
        e.preventDefault();
        errorMessage.classList.add('alert', 'alert-danger', 'my-3');
        errorMessage.innerHTML = "Aucune catégorie n'a été sélectionnée !";
    }
}