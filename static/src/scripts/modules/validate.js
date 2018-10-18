import Parsley from 'parsleyjs';

const Validate = {
  messages: {
    'pl-PL': {
      defaultMessage: "Wartość wygląda na nieprawidłową",
      type: {
        email:        "Wpisz poprawny adres e-mail.",
        url:          "Wpisz poprawny adres URL.",
        number:       "Wpisz poprawną liczbę.",
        integer:      "Dozwolone są jedynie liczby całkowite.",
        digits:       "Dozwolone są jedynie cyfry.",
        alphanum:     "Dozwolone są jedynie znaki alfanumeryczne."
      },
      notblank:       "Pole nie może być puste.",
      required:       "Pole jest wymagane.",
      pattern:        "Pole zawiera nieprawidłową wartość.",
      min:            "Wartość nie może być mniejsza od %s.",
      max:            "Wartość nie może być większa od %s.",
      range:          "Wartość powinna zaweriać się pomiędzy %s a %s.",
      minlength:      "Minimalna ilość znaków wynosi %s.",
      maxlength:      "Maksymalna ilość znaków wynosi %s.",
      length:         "Ilość znaków wynosi od %s do %s.",
      mincheck:       "Wybierz minimalnie %s opcji.",
      maxcheck:       "Wybierz maksymalnie %s opcji.",
      check:          "Wybierz od %s do %s opcji.",
      equalto:        "Wartości nie są identyczne."
    },

    'es-ES': {
      defaultMessage: "Este valor parece ser inválido.",
      type: {
        email:        "Este valor debe ser un correo válido.",
        url:          "Este valor debe ser una URL válida.",
        number:       "Este valor debe ser un número válido.",
        integer:      "Este valor debe ser un número válido.",
        digits:       "Este valor debe ser un dígito válido.",
        alphanum:     "Este valor debe ser alfanumérico."
      },
      notblank:       "Este valor no debe estar en blanco.",
      required:       "Este valor es requerido.",
      pattern:        "Este valor es incorrecto.",
      min:            "Este valor no debe ser menor que %s.",
      max:            "Este valor no debe ser mayor que %s.",
      range:          "Este valor debe estar entre %s y %s.",
      minlength:      "Este valor es muy corto. La longitud mínima es de %s caracteres.",
      maxlength:      "Este valor es muy largo. La longitud máxima es de %s caracteres.",
      length:         "La longitud de este valor debe estar entre %s y %s caracteres.",
      mincheck:       "Debe seleccionar al menos %s opciones.",
      maxcheck:       "Debe seleccionar %s opciones o menos.",
      check:          "Debe seleccionar entre %s y %s opciones.",
      equalto:        "Este valor debe ser idéntico."
    },

    'it-IT': {
      defaultMessage: "Questo valore sembra essere non valido.",
      type: {
        email:        "Questo valore deve essere un indirizzo email valido.",
        url:          "Questo valore deve essere un URL valido.",
        number:       "Questo valore deve essere un numero valido.",
        integer:      "Questo valore deve essere un numero valido.",
        digits:       "Questo valore deve essere di tipo numerico.",
        alphanum:     "Questo valore deve essere di tipo alfanumerico."
      },
      notblank:       "Questo valore non deve essere vuoto.",
      required:       "Questo valore è richiesto.",
      pattern:        "Questo valore non è corretto.",
      min:            "Questo valore deve essere maggiore di %s.",
      max:            "Questo valore deve essere minore di %s.",
      range:          "Questo valore deve essere compreso tra %s e %s.",
      minlength:      "Questo valore è troppo corto. La lunghezza minima è di %s caratteri.",
      maxlength:      "Questo valore è troppo lungo. La lunghezza massima è di %s caratteri.",
      length:         "La lunghezza di questo valore deve essere compresa fra %s e %s caratteri.",
      mincheck:       "Devi scegliere almeno %s opzioni.",
      maxcheck:       "Devi scegliere al più %s opzioni.",
      check:          "Devi scegliere tra %s e %s opzioni.",
      equalto:        "Questo valore deve essere identico."
    },

    'nb-NO': {
      defaultMessage: "Verdien er ugyldig.",
      type: {
        email:        "Verdien må være en gyldig e-postadresse.",
        url:          "Verdien må være en gyldig url.",
        number:       "Verdien må være et gyldig tall.",
        integer:      "Verdien må være et gyldig heltall.",
        digits:       "Verdien må være et siffer.",
        alphanum:     "Verdien må være alfanumerisk"
      },
      notblank:       "Verdien kan ikke være blank.",
      required:       "Verdien er obligatorisk.",
      pattern:        "Verdien er ugyldig.",
      min:            "Verdien må være større eller lik %s.",
      max:            "Verdien må være mindre eller lik %s.",
      range:          "Verdien må være mellom %s and %s.",
      minlength:      "Verdien er for kort. Den må bestå av minst %s tegn.",
      maxlength:      "Verdien er for lang. Den kan bestå av maksimalt %s tegn.",
      length:         "Verdien har ugyldig lengde. Den må være mellom %s og %s tegn lang.",
      mincheck:       "Du må velge minst %s alternativer.",
      maxcheck:       "Du må velge %s eller færre alternativer.",
      check:          "Du må velge mellom %s og %s alternativer.",
      equalto:        "Verdien må være lik."
    },

    'pt-BR': {
      defaultMessage: "Este valor parece ser inválido.",
      type: {
        email:        "Este campo deve ser um email válido.",
        url:          "Este campo deve ser um URL válida.",
        number:       "Este campo deve ser um número válido.",
        integer:      "Este campo deve ser um inteiro válido.",
        digits:       "Este campo deve conter apenas dígitos.",
        alphanum:     "Este campo deve ser alfa numérico."
      },
      notblank:       "Este campo não pode ficar vazio.",
      required:       "Este campo é obrigatório.",
      pattern:        "Este campo parece estar inválido.",
      min:            "Este campo deve ser maior ou igual a %s.",
      max:            "Este campo deve ser menor ou igual a %s.",
      range:          "Este campo deve estar entre %s e %s.",
      minlength:      "Este campo é pequeno demais. Ele deveria ter %s caracteres ou mais.",
      maxlength:      "Este campo é grande demais. Ele deveria ter %s caracteres ou menos.",
      length:         "O tamanho deste campo é inválido. Ele deveria ter entre %s e %s caracteres.",
      mincheck:       "Você deve escolher pelo menos %s opções.",
      maxcheck:       "Você deve escolher %s opções ou mais",
      check:          "Você deve escolher entre %s e %s opções.",
      equalto:        "Este valor deveria ser igual."
    },

    'de-DE': {
      defaultMessage: "Die Eingabe scheint nicht korrekt zu sein.",
      type: {
        email:        "Die Eingabe muss eine gültige E-Mail-Adresse sein.",
        url:          "Die Eingabe muss eine gültige URL sein.",
        number:       "Die Eingabe muss eine Zahl sein.",
        integer:      "Die Eingabe muss eine Zahl sein.",
        digits:       "Die Eingabe darf nur Ziffern enthalten.",
        alphanum:     "Die Eingabe muss alphanumerisch sein."
      },
      notblank:       "Die Eingabe darf nicht leer sein.",
      required:       "Dies ist ein Pflichtfeld.",
      pattern:        "Die Eingabe scheint ungültig zu sein.",
      min:            "Die Eingabe muss größer oder gleich %s sein.",
      max:            "Die Eingabe muss kleiner oder gleich %s sein.",
      range:          "Die Eingabe muss zwischen %s und %s liegen.",
      minlength:      "Die Eingabe ist zu kurz. Es müssen mindestens %s Zeichen eingegeben werden.",
      maxlength:      "Die Eingabe ist zu lang. Es dürfen höchstens %s Zeichen eingegeben werden.",
      length:         "Die Länge der Eingabe ist ungültig. Es müssen zwischen %s und %s Zeichen eingegeben werden.",
      mincheck:       "Wählen Sie mindestens %s Angaben aus.",
      maxcheck:       "Wählen Sie maximal %s Angaben aus.",
      check:          "Wählen Sie zwischen %s und %s Angaben.",
      equalto:        "Dieses Feld muss dem anderen entsprechen."
    },
  },

  init() {
    this.lang = document.documentElement.lang;
    this.triggers = document.querySelectorAll('[data-validate]');

    if (this.triggers) {
      [].forEach.call(this.triggers, trigger => this.validate(trigger));

      if (this.lang && this.lang !== 'en-US' && this.messages[this.lang]) {
        Parsley.addMessages(this.lang, this.messages[this.lang]);
        Parsley.setLocale(this.lang);
      }
    }
  },

  validate(form) {
    const instance = new Parsley.Factory(form);

    [].forEach.call(form.querySelectorAll('.custom-select'), select => {
      select.onchange = () => {
        instance.validate({ group: 'select' });
      };
    });
  },
};

export default Validate;
