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
      },
      error: function (status, error) {
        console.log("échec : " + status + error);
      },
    });
  });

  setTimeout(function () {
    $("#divAlert").fadeOut();
  }, 3000);
});

/**
 * Function that generate a div with all categories (buttons) related to the choosen level
 */
function generateCategoriesButtons(array) {
  var categorieDiv = `<div class="my-3" id="categorieButtonsDiv"><div class="btn-group-toggle" data-toggle="buttons" id="initialCat"></div></div>`;

  $("#levelDiv").after(categorieDiv);

  for (var i = 0; i < array.length; i++) {
    let categorieId = parseInt(array[i][0]);
    let categorieName = array[i][1];

    var categorieLabel = `<label class="btn btn-primary mx-1" for="${categorieId}"><input type="checkbox" id="${categorieId}" value="${categorieId}" name="Categories[]" onclick="checkCategorie(${categorieId})" class="onChangeCategorie">${categorieName}</label>`;

    $("#initialCat").append(categorieLabel);
  }
}

/**
 * Function that remove the previous div with categorie buttons before generating a new one
 */
function deleteCategoriesButtons() {
  removeCatButtons = $("#categorieButtonsDiv");

  if (removeCatButtons) {
    removeCatButtons.remove();
  }
}

function checkCategorie(id) {
  var checkedCategorie = $("#" + id);
  checkedCategorie.attr("checked", !checkedCategorie.attr("checked"));
}

// var categorieArray = [];
// var checked = document.getElementsByClassName("onChangeCategorie");
// console.log(checked);

// $(".onChangeCategorie").on("change", function () {
//   console.log("tata");
//   if (this.checked) {
//     console.log("toto");
//   }
// categorieArray.push($(this).val());
// });
// console.log(categorieArray);

// Récupère la ou les valeurs de l'input
// var categorieArray = [];
// $("input:checkbox[class='onChange']:checked").each(function() {
//     categorieArray.push($(this).val());
// });
// console.log(categorieArray);
