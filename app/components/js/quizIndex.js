$(document).ready(function () {
  // AJAX pour input de niveau
  $(".onChangeLevel").on("change", function () {
    var level = $("#level-select").val();

    var checkButton = document.getElementsByClassName("onChangeCategorie");

    $.ajax({
      url: "/ajax/getCategoriesByLevel",
      type: "post",
      data: {
        level: level,
      },
      success: function (res) {
        res = JSON.parse(res);
        finalRes = Object.entries(res);
        deleteCategoriesButtons();
        generateCategoriesButtons(finalRes);

        getArrayCategories(checkButton);

        // console.log(getArrayCategories(checkButton));
      },
      error: function (status, error) {
        console.log("échec : " + status + error);
      },
      done: function () {},
    });
  });

  setTimeout(function () {
    $("#divAlert").fadeOut();
  }, 3000);

  /**
   * Function that generate a div with all categories (buttons) related to the choosen level
   */
  function generateCategoriesButtons(array) {
    var categorieDiv = `<div id="initialCat"></div>`;

    $("#levelDiv").after(categorieDiv);
    console.log(array);

    for (var i = 0; i < array.length; i++) {
      let categorieId = parseInt(array[i][0]);
      let categorieName = array[i][1];

      // var categorieLabel = `<label class="btn btn-info mx-1" for="${categorieId}"><input type="checkbox" id="${categorieId}" value="${categorieId}" name="categories[]" class="onChangeCategorie">${categorieName}</label>`;

      var categorieLabel = `<label class="btn btn-info mx-1" for="${categorieId}"><img src="/app/components/img/categorie_picture/pierre.svg" width="30px" height="30px"><input type="checkbox" id="${categorieId}" value="${categorieId}" name="categories[]" class="onChangeCategorie">${categorieName}</label>`;

      $("#initialCat").append(categorieLabel);
    }
  }

  /**
   * Function that remove the previous div with categorie buttons before generating a new one
   */
  function deleteCategoriesButtons() {
    removeCatButtons = $("#initialCat");

    if (removeCatButtons) {
      removeCatButtons.remove();
    }
  }

  // variable du tableau de catégories
  var categorieArray = [];

  /**
   * Fonction qui récupère les valeurs des catégories sélectionnées
   */
  function getArrayCategories(checkButton) {
    // on parcourt tous les boutons
    for (let i = 0; i < checkButton.length; i++) {
      // Quand on clique sur un bouton
      checkButton[i].addEventListener("click", function () {
        // On récupère sa valeur
        var value = checkButton[i].value;

        // Si le bouton est coché
        if (checkButton[i].checked) {
          // On insère sa valeur dans le tableau des catégories
          categorieArray.push(value);
        } else {
          // Si le bouton est décoché et que la valeur est déjà dans le tableau des catégories
          if (categorieArray.includes(value)) {
            // On récpuère sa position dans le tableau
            valueIndex = categorieArray.indexOf(value);
            // on supprime la valeur du tableau
            categorieArray.splice(valueIndex, 1);
          }
        }
        // console.log(categorieArray);
        getMaxQuestions(categorieArray);
        return categorieArray;
        // TODO : utiliser le tableau des catégories pour faire un appel AJAX et récupérer le nombre maximal de questions à afficher ensuite
      });
    }
  }

  function getMaxQuestions(data) {
    // récupération du niveau du quiz
    var level = $("#level-select").val();

    // requête AJAX
    $.ajax({
      url: "/ajax/getMaxQuestions",
      type: "post",
      data: {
        data: data,
        level: level,
      },
      success: function (res) {
        // On parse le résultat et on récupère le nombre de questions
        finalRes = $.parseJSON(res);
        var nb = finalRes[0]["nb"];

        // On supprimer les options déjà existantes et on affiche les nouvelles
        deleteQuestionNbs();
        createQuestionNbs(nb);
      },
      error: function (status, error) {
        console.log("échec : " + status + error);
      },
      done: function () {},
    });
  }

  function createQuestionNbs(nb) {
    // TODO : voir si on peut afficher uniquement les multiples de 5 et le dernier nombre par exemple ?
    for (i = 1; i <= nb; i++) {
      $("#questionNb").append(
        $("<option>", {
          value: i,
          text: i,
        })
      );
    }
  }

  function deleteQuestionNbs() {
    questionNbs = $("#questionNb option");

    if (questionNbs) {
      questionNbs.remove();
    }
  }
});
