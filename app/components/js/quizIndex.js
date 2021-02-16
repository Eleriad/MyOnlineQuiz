$(document).ready(function () {
  // AJAX pour input de niveau
  $(".onChangeLevel").on("change", function () {
    var level = $("#level-select").val();

    $.ajax({
      url: "index.php",
      type: "post",
      data: {
        level: level,
      },
      success: function (res) {
        res = JSON.parse(res);
        finalRes = Object.entries(res);
        generateCategories(finalRes);
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

function generateCategories(array) {
  var categorieLabel;

  if (categorieLabel !== undefined) {
    categorieLabel.remove();
  }

  var categorieDiv = `<div class="my-3"><div class="btn-group-toggle" data-toggle="buttons" id="initialCat"></div></div>`;

  $("#levelDiv").after(categorieDiv);

  for (var i = 0; i < array.length; i++) {
    let categorieId = parseInt(array[i][0]);
    let categorieName = array[i][1];

    var categorieLabel = `<label class="btn btn-primary" for="${categorieId}"><input type="checkbox" id="${categorieId}" value="${categorieId}" name="Categories[]" class="onChangeCategorie">${categorieName}</label>`;

    $("#initialCat").append(categorieLabel);
  }
}

// TODO : supprimer la div existante à chaque fois qu'on relance la fonction

// Récupère la ou les valeurs de l'input
// var categorieArray = [];
// $("input:checkbox[class='onChange']:checked").each(function() {
//     categorieArray.push($(this).val());
// });
// console.log(categorieArray);
