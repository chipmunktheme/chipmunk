const Consents = {
  init(element = document) {
    this.consents = Array.from(element.querySelectorAll('[data-consent]'));

    this.consents.forEach((consent) => {
      const form = consent.closest('form');
      const fields = Array.from(form.querySelectorAll('input, textarea'));

      form.addEventListener('submit', () => {
        consent.classList.add('is-visible');
      });

      fields.forEach((field) => {
        field.addEventListener('focus', () => {
          consent.classList.add('is-visible');
        });
      });
    });
  },
};

export default Consents;
