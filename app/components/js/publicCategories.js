$(document).ready(function () {
  //Defining position for all ronds and boxes div
  let maxRond = $(".rond").length;
  let line = 0;

  for (i = 1; i <= maxRond; i++) {
    line = 80 + 306 * (i - 1);
    $(".r" + i).css({
      top: 80 + 306 * (i - 1) + "px",
    });
    $(".b" + i).css({
      top: 80 + 306 * (i - 1) + "px",
    });
  }

  //   Defining line's height
  let lineHeight = line + "px";
  $(".ligne").css({
    height: lineHeight,
  });

  // Defining position for all boxes
  $(".box").even().css({ left: "calc(50% - 270px)" });
  $(".box").odd().css({ left: "calc(50% + 270px)" });
});

// Introducing ScrollMagic
const allRonds = document.querySelectorAll(".rond");
const allBoxes = document.querySelectorAll(".box");

var controller = new ScrollMagic.Controller();

allBoxes.forEach((box) => {
  for (i = 0; i < allRonds.length; i++) {
    if (
      allRonds[i].getAttribute("data-anim") === box.getAttribute("data-anim")
    ) {
      let tween = gsap.from(box, { y: -50, opacity: 0, duration: 0.5 });

      let scene = new ScrollMagic.Scene({
        triggerElement: allRonds[i],
        reverse: true,
      })
        .setTween(tween)
        // .addIndicators()
        .addTo(controller);
    }
  }
});
