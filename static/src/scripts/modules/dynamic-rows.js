const DynamicRows = {
  element: '[data-dynamic-rows]',

  options: {
    rows: 5,
  },

  init() {
    this.inputs = document.querySelectorAll(this.element);

    if (this.inputs.length) {
      [].forEach.call(this.inputs, input => {
        input.addEventListener('keyup', this.updateRows.bind(this, input));
      });

      window.addEventListener('load', () => {
        [].forEach.call(this.inputs, input => {
          this.updateRows(input);
        });
      });
    }
  },

  updateRows(input) {
    if (!input.value) {
      return;
    }

    const style = window.getComputedStyle(input);
    const lineHeight = parseInt(style.getPropertyValue('line-height'));
    const padding = parseInt(style.getPropertyValue('padding-top')) + parseInt(style.getPropertyValue('padding-bottom'));
    const rowLimit = parseInt(input.dataset.dynamicRows ? input.dataset.dynamicRows : this.options.rows);

    let rows = parseInt((input.scrollHeight - padding) / lineHeight);

    input.setAttribute('rows', rows > rowLimit ? rowLimit : rows);
  }
};

export default DynamicRows;
