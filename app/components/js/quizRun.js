$(document).ready(function () {
  // VARIABLES
  let userAnswer = []; // tableau qui va accueillir les réponses de l'utilisateur
  let questionNb = 1; // nombre de départ des questions
  let maxQuestion = $('input[name="maxQuestion"]').val(); // récupération du nombre maximal de questions

  // for (i = questionNb; i < maxQuestion; i++) {
  // When clicking on any radio button, add the selectedAnswer Class to parent div
  $("[name^='radio_']").click(function () {
    if ($(this).is(":checked")) {
      self = $(this).parent();

      selectedAnswer = $(".answersDiv").find("div.selectedAnswer");
      selectedAnswer.removeClass("selectedAnswer");
      let button = $("[class^='questionDiv']").find("[id^='confirmBtn']");
      button.removeClass("disabled");
      console.log(button);
      // console.log("#confirmBtn_" + i);

      // TODO : vérifier que cela n'enlève la classe disabled qu'au bouton de la question en cours ("#confirmBtn_" + i ne fonctionne pas et .BtnNext les disabled tous)

      self.toggleClass("selectedAnswer");
    }
  });

  // When clicking on button that has confirmBtn's id, add the user answer to the userAnswer array
  // $("#confirmBtn_" + i).click(function (e) {
  //   e.preventDefault();
  //   let answer = $(".selectedAnswer :input").val();
  //   userAnswer.push(answer);
  //   console.log(userAnswer);
  // });
  // }
});

// TODO : voir comment récupérer toutes les div sauf celle de la question en cours
// let questionNb = 1;
// displayCurrentQuestion(questionNb);

// function displayCurrentQuestion(nb) {
// $('div[class^="questionDiv"]').siblings().parent().css('display', 'none');
// $('.questionDiv_' + nb).show();

// }

// TODO : on click sur le bouton : cela permet d'enregistrer la réponse de l'utilisateur + cache la question précédente et affiche la question suivante
// (sauf si dernière question, dans ce cas, on renvoie sur la page de feedback)

// TODO : on cache ici les questions qui ne sont pas celle en cours
// $('.questionDiv_1').parent().css('display', 'none');
// $('.questionDiv_2').parent().css('display', 'none');
// $('.questionDiv_3').parent().css('display', 'none');
// $('.questionDiv_4').parent().css('display', 'none');
// $('.questionDiv_5').parent().css('display', 'none');
