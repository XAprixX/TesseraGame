document.addEventListener("DOMContentLoaded", function () {
  const cardContainer = document.querySelector(".card-container");
  const cards = document.querySelectorAll(".card");
  let currentIndex = 0;

  function showCard(index) {
    cards[currentIndex].classList.remove("visible");
    cards[currentIndex].classList.add("hidden-left");

    currentIndex = (index + cards.length) % cards.length;

    cards[currentIndex].classList.remove("hidden-left");
    cards[currentIndex].classList.add("visible");
  }

  showCard(currentIndex);

  cardContainer.addEventListener("click", function (event) {
    if (!event.target.closest(".card")) {
      if (event.clientX < window.innerWidth / 2) {
        showCard(currentIndex - 1 < 0 ? cards.length - 1 : currentIndex - 1);
      } else {
        showCard((currentIndex + 1) % cards.length);
      }
    }
  });
});


