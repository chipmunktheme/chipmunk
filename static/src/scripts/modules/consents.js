const Consents = {
  element: '[data-consent]',

  init() {
    const consents = document.querySelectorAll(this.element);

    [].forEach.call(consents, consent => {
      const form = consent.closest('form');
      const fields = form.querySelectorAll('input, textarea');

      form.addEventListener('submit', () => {
        consent.classList.add('is-visible');
      });

      [].forEach.call(fields, field => {
        field.addEventListener('focus', () => {
          consent.classList.add('is-visible');
        });
      });
    });
  },
};

export default Consents;
