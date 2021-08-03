$(document).ready(function () {
  // VARIABLES
  let button = $("[id^='questionDiv']").find(".btnNext"); // selection of the btnNext button
  button.attr("disabled", "disabled"); // adding the disabled attribute to the button in order to prevent people from validates

  $(".cont").hide(); // cache par défaut toutes les questions
  $("#questionDiv" + 1).show();

  // Quand on clique sur un bouton radio, When clicking on any radio button, add the selectedAnswer Class to parent div
  $("[name^='radio']").click(function () {
    if ($(this).is(":checked")) {
      self = $(this).parent();

      selectedAnswer = $(".answersDiv").find("div.selectedAnswer");
      selectedAnswer.removeClass("selectedAnswer");
      button.removeAttr("disabled"); // on enlève l'attribut "disabled"
      button.addClass("validate"); // on remet

      self.toggleClass("selectedAnswer");
    }
  });

  var array = [];
  // Quand on clique sur le bouton pour passer à la question suivante
  $(document).on("click", ".btnNext", function (e) {
    e.preventDefault();
    last = parseInt($(this).attr("id")); // on récupère l'id qui correspond au numéro de la question
    next = last + 1; // on définit le numéro dela question suivante
    $("#questionDiv" + last).hide(); // on cache la question qu'on vient de faire
    $("#questionDiv" + next).show(); // on affiche la suivante
    button.attr("disabled", "disabled"); // on remet le bouton de validation en disabled
    button.removeClass("validate"); // on enlève la classe "validate" qui active le bouton

    let userAnswer = $("input:checked").map(function () {
      return $(this).val();
    });
    userAnswer = userAnswer.get();
    $('input[type="hidden"][name*="userAnswers"]').val(userAnswer);
  });

  $(document).on("click", ".endQuizBtn", function (e) {
    let userAnswer = $("input:checked").map(function () {
      return $(this).val();
    });
    userAnswer = userAnswer.get();
    $('input[type="hidden"][name*="userAnswers"]').val(userAnswer);
  });
});
