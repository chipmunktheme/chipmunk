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
    }
  },

  updateRows(input) {
    const style = window.getComputedStyle(input);
    const lineHeight = parseInt(style.getPropertyValue('line-height'));
    const padding = parseInt(style.getPropertyValue('padding-top')) + parseInt(style.getPropertyValue('padding-bottom'));

    let rows = parseInt((input.scrollHeight - padding) / lineHeight);

    if (rows > this.options.rows) {
      rows = this.options.rows;
    }

    input.setAttribute('rows', rows);
  }
};

export default DynamicRows;
