const Validate = {
  errorClass: 'c-form__error',

  init(element = document) {
    this.forms = element.querySelectorAll('[data-validate], #commentform');

    this.forms.forEach((form) => this.validate(form));
  },

  validate(form) {
    form.addEventListener('submit', (ev) => {
      const inputs = form.querySelectorAll('input:not([type="hidden"]), textarea, select');
      const invalidInputs = Array.from(inputs).filter(this.isInvalidElement);

      if (invalidInputs.length) {
        ev.preventDefault();
        ev.stopImmediatePropagation();

        inputs.forEach((input) => {
          this.validateElement(input);
          input.addEventListener('input', this.validateElement);
        });

        invalidInputs[0].focus();
      }
    });
  },

  isInvalidElement(target) {
    const element = target instanceof Element ? target : target.target;
    return !element.checkValidity();
  },

  validateElement(target) {
    const element = target instanceof Element ? target : target.target;
    const elementName = element.name.toLowerCase();
    let message = element.closest('form').querySelector(`[data-validate-message="${elementName}"`);

    if (!element.checkValidity()) {
      if (!message) {
        message = document.createElement('div');
        message.classList.add(element.dataset.validateClass ?? this.errorClass);
        message.dataset.validateMessage = elementName;
        element.parentNode.appendChild(message);
      }

      message.innerHTML = element.validationMessage;
    } else if (message) {
      message.innerHTML = '';
    }
  },
};

export default Validate;
