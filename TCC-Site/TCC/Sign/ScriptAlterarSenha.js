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
      email: "",
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
  created() {
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

      re = new RegExp('^9792');
      if (number.match(re) != null) return 'cno';

      return "cno"; // default type
    },
    generateCardNumberMask() {
      return this.getCardType === "amex" ? this.amexCardMask : this.otherCardMask;
    },
    minCardMonth() {
      if (this.cardYear === this.minCardYear) return new Date().getMonth() + 1;
      return 1;
    },
    cardNumberSpaced() {
      let formattedNumber = this.cardNumber.replace(/\s/g, "");
      formattedNumber = formattedNumber.replace(/(\d{4})/g, "$1 ");
      return formattedNumber.trim();
    },
    formattedCardNumber() {
      let formattedNumber = this.cardNumber.replace(/\s/g, "");
      formattedNumber = formattedNumber.replace(/(\d{4})/g, "$1 ");
      return formattedNumber.trim();
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

    clearEmail() {
      this.email = ""; // Limpa o valor do campo de e-mail
    },
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
    sendVerificationEmail() {
      axios
        .post('/enviar-verificacao', { email: this.email })
        .then(function(response) {
          console.log('E-mail de verificação enviado com sucesso!');
        })
        .catch(function(error) {
          console.error('Erro ao enviar e-mail de verificação:', error);
        });
        
    },
    changeBackgroundImage() {
      var randomIndex = Math.floor(Math.random() * this.backgroundImages.length);
      this.currentBackgroundImage = this.backgroundImages[randomIndex];
    }
  }
});
