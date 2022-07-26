const DynamicRows = {
  options: {
    rows: 5,
  },

  init(element = document) {
    this.inputs = Array.from(element.querySelectorAll('[data-dynamic-rows]'));

    this.inputs.forEach((input) => {
      input.addEventListener('keyup', this.updateRows.bind(this, input));
    });

    window.addEventListener('load', () => {
      this.inputs.forEach((input) => {
        this.updateRows(input);
      });
    });
  },

  updateRows(input) {
    if (!input.value) {
      return;
    }

    const style = window.getComputedStyle(input);
    const lineHeight = parseInt(style.getPropertyValue('line-height'), 10);
    const padding =
      parseInt(style.getPropertyValue('padding-top'), 10) + parseInt(style.getPropertyValue('padding-bottom'), 10);

    const rowLimit = parseInt(input.dataset.dynamicRows ?? this.options.rows, 10);
    const rows = parseInt((input.scrollHeight - padding) / lineHeight, 10);

    input.setAttribute('rows', rows > rowLimit ? rowLimit : rows);
  },
};

export default DynamicRows;
