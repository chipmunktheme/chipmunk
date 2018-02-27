import queryString from 'query-string';

const Filter = {
  element: '[data-filter]',

  init() {
    this.filters = document.querySelectorAll(this.element);

    [].forEach.call(this.filters, filter => {
      filter.onchange = this.filterResults.bind(this);
    });
  },

  filterResults() {
    const params = queryString.parse(location.search);

    [].forEach.call(this.filters, filter => {
      const name = filter.dataset.filter;
      const value = filter.value;

      if (value !== '') {
        params[name] = value;
      } else {
        delete params[name];
      }
    });

    const search = queryString.stringify(params);
    const pageRegex = /\/page\/[0-9]+\//g;

    if (params['tag']) {
      location.href = location.origin + location.pathname.replace(pageRegex, '/') + '?' + search;
    } else {
      location.search = search;
    }
  },
};

export default Filter;
