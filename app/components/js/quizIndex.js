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

        // On vérifie si la div s'est bien ajoutée et on modifie le margin de la div d'en dessous en fonction du nombre de catégories affichées
        var categories = $("#initialCat");
        var divHeight = categories.height() + 30;
        var questionSelect = $("#questionNbSelect");
        !categories
          ? ""
          : questionSelect.attr(
              "style",
              "margin-top: " + divHeight + "px !important"
            );
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

    for (var i = 0; i < array.length; i++) {
      let data = array[i][1];

      var categorieLabel = `<label class="btn mx-1 catLabel" for="${data[0]}"><img src="/app/components/img/categorie_pictures/${data[2]}" width="30px" height="30px"><input type="checkbox" id="${data[0]}" value="${data[0]}" name="categories[]" class="onChangeCategorie">${data[1]}</label>`;

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

        // On modifie le background du label parent
        var label = this.parentNode;
        label.classList.toggle("checkedButton");

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
        getMaxQuestions(categorieArray);
        return categorieArray;
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
    for (i = 1; i <= nb; i++) {
      if (i == 1) {
        $("#questionNb").append(
          $("<option>", {
            value: i,
            text: i,
          })
        );
      } else if (i % 5 == 0) {
        $("#questionNb").append(
          $("<option>", {
            value: i,
            text: i,
          })
        );
      } else if (i == nb) {
        $("#questionNb").append(
          $("<option>", {
            value: i,
            text: i,
          })
        );
      }
    }
  }

  function deleteQuestionNbs() {
    questionNbs = $("#questionNb option");

    if (questionNbs) {
      questionNbs.remove();
    }
  }
});
