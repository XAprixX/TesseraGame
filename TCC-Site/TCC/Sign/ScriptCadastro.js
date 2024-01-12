function generateRandomCardNumber() {
  var cardNumber = "";
  for (var i = 0; i < 16; i++) {
    cardNumber += Math.floor(Math.random() * 10);
  }
  return cardNumber;
}

var backgroundImages = [
  "../img/caindoPixel.jpg",
  "../img/Camp.png",
  "../img/Cidade_Fundo.png",
  "../img/Espaço.jpg",
  "../img/fundoCard.jpeg",
  "../img/Laleira.jpg",
  "../img/montanhafundo.jpg",
  "../img/TelaBalão.png"
];

new Vue({
  el: "#app",
  data() {
    return {
      currentCardBackground: Math.floor(Math.random() * 25 + 1), // just for fun :D
      cardName: "",
      cardNumber: generateRandomCardNumber(),
      cardType: "", // Added cardType property
      cardMonth: "",
      cardYear: "",
      cardCvv: "",
      cardPassword: '',
      minCardYear: new Date().getFullYear(),
      amexCardMask: "#### ###### #####",
      otherCardMask: "#### #### #### ####",
      cardNumberTemp: "",
      isCardFlipped: false,
      focusElementStyle: null,
      isInputFocused: false,
      backgroundImages: backgroundImages,
      currentBackgroundImage: "../img/fundoCard.jpeg"
    };
  },
  created: function() {
    this.changeBackgroundImage(); // Chama a função para trocar a imagem de fundo inicialmente
  },
  mounted() {
    this.cardNumberTemp = this.otherCardMask;
    document.getElementById("cardNumber").focus();
  },
  computed: {
    getCardType() {
      let number = this.cardNumber;
      let re = new RegExp("^4");
      if (number.match(re) != null) return "cno";

      re = new RegExp("^(34|37)");
      if (number.match(re) != null) return "cno";

      re = new RegExp("^5[1-5]");
      if (number.match(re) != null) return "cno";

      re = new RegExp("^6011");
      if (number.match(re) != null) return "cno";

      re = new RegExp("^9792");
      if (number.match(re) != null) return "cno";

      return "cno"; // default type
    },

    generateCardNumberMask() {
      return this.getCardType === "amex" ? this.amexCardMask : this.otherCardMask;
    },

    cardNumberSpaced() {
      let formattedNumber = this.cardNumber.replace(/\s/g, ""); // remove espaços em branco
      formattedNumber = formattedNumber.replace(/(\d{4})/g, "$1 "); // adiciona espaço a cada 4 dígitos
      return formattedNumber.trim(); // remove espaços extras no início e no fim
    },
    formattedCardNumber() {
      let formattedNumber = this.cardNumber.replace(/\s/g, ""); // remove espaços em branco
      formattedNumber = formattedNumber.replace(/(\d{4})/g, "$1 "); // adiciona espaço a cada 4 dígitos
      return formattedNumber.trim(); // remove espaços extras no início e no fim
    }
  },
  watch: {
    cardYear() {
      if (this.cardMonth < this.minCardMonth) {
        this.cardMonth = "";
      }
    }
  },
  methods: {
    flipCard(status) {
      this.isCardFlipped = status;
    },
    focusInput(e) {
      this.isInputFocused = true;
      let targetRef = e.target.dataset.ref;
      let target = this.$refs[targetRef];
      this.focusElementStyle = {
        width: `${target.offsetWidth}px`,
        height: `${target.offsetHeight}px`,
        transform: `translateX(${target.offsetLeft}px) translateY(${target.offsetTop}px)`
      };
    },
    blurInput() {
      let vm = this;
      setTimeout(() => {
        if (!vm.isInputFocused) {
          vm.focusElementStyle = null;
        }
      }, 300);
      vm.isInputFocused = false;
    },
    clearPassword() {
      this.cardPassword = ""; // Limpa o valor da variável cardPassword
    },
    submitForm() {

      if (!this.cardName || !this.cardNumber || !this.cardCvv) {
        alert("Por favor, preencha todos os campos antes de prosseguir.");
        return;
      }

     this.cardType = this.getCardType; // Transcribe card type to cardType property
      alert("Cadastro concluído com sucesso!");
      const queryParams = new URLSearchParams({
        cardNumber: this.cardNumber,
        cardName: this.cardName,
        cardCvv: this.cardCvv,
      });
      window.location.href = `SignUp.html?${queryParams.toString()}`;
    },
    
    changeBackgroundImage() {
      var randomIndex = Math.floor(Math.random() * this.backgroundImages.length);
      this.currentBackgroundImage = this.backgroundImages[randomIndex];
    }
  }
});
