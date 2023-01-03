import queryString from 'query-string';

const Filter = {
  params: {},
  splittables: { 'order': ['orderby', 'order'] },

  init(element = document) {
    this.filters = Array.from(element.querySelectorAll('[data-filter]'));

    this.filters.forEach((filter) => {
      filter.onchange = this.filterResults.bind(this);
    });
  },

  filterResults() {
    this.params = queryString.parse(window.location.search);

    this.filters.forEach((filter) => {
      const key = filter.dataset.filter;
      const { value } = filter;

      this.addCustomParam(key, value, true);
    });

    const search = queryString.stringify(this.params);
    const pageRegex = /\/page\/[0-9]+\//g;

    if (this.params.tag) {
      window.location.href = `${window.location.origin + window.location.pathname.replace(pageRegex, '/')}?${search}`;
    } else {
      window.location.search = search;
    }
  },

  addCustomParam(key, value, split = false) {
    if (!value) {
      delete this.params[key];
      return;
    }

    if (split && key in this.splittables) {
      // Remove all of the old params
      this.splittables[key].forEach(val => {
        delete this.params[val];
      });

      // Assign new params
      value.split('-').forEach((val, i) => {
        this.addCustomParam(this.splittables[key][i], val);
      });

      return;
    }

    this.params[key] = value;
  },
};

export default Filter;
