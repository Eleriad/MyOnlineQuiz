$(document).ready(function () {
  // AJAX pour input de niveau
  $(".onChangeLevel").on("change", function () {
    var level = $("#level-select").val();

    $.ajax({
      url: "index",
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

        // TODO : utiliser le tableau des catégories pour faire un appel AJAX et récupérer le nombre maximal de questions à afficher ensuite
      },
      error: function (status, error) {
        console.log("échec : " + status + error);
      },
    });
  });

  setTimeout(function () {
    $("#divAlert").fadeOut();
  }, 3000);

  // AJAX pour sélection de catégories
});

checkButton = document.getElementsByClassName("onChangeCategorie");

/**
 * Function that generate a div with all categories (buttons) related to the choosen level
 */
function generateCategoriesButtons(array) {
  var categorieDiv = `<div id="initialCat"></div>`;

  $("#levelDiv").after(categorieDiv);

  for (var i = 0; i < array.length; i++) {
    let categorieId = parseInt(array[i][0]);
    let categorieName = array[i][1];

    var categorieLabel = `<label class="btn btn-primary mx-1" for="${categorieId}"><input type="checkbox" id="${categorieId}" value="${categorieId}" name="categories[]" class="onChangeCategorie">${categorieName}</label>`;

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

function checkCategorie(id) {
  var checkedCategorie = $("#" + id);
  checkedCategorie.attr("checked", !checkedCategorie.attr("checked"));
}

/**
 * Fonction qui récupère les valeurs des catégories sélectionnées
 */
function getArrayCategories(checkButton) {
  // variable du tableau de catégories
  var categorieArray = [];

  // on parcourt tous les boutons
  for (let i = 0; i < checkButton.length; i++) {
    // Quand on clique sur un bouton
    checkButton[i].addEventListener("click", function () {
      // ON récupère sa valeur
      var value = checkButton[i].value;

      // Si le bouton est coché
      if (checkButton[i].checked) {
        // ON insère sa valeur dans le tableau des catégories
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
      return categorieArray;
    });
  }
}
