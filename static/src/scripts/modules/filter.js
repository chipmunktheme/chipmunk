import queryString from 'query-string';

const Filter = {
  init(element = document) {
    this.filters = Array.from(element.querySelectorAll('[data-filter]'));

    this.filters.forEach((filter) => {
      filter.onchange = this.filterResults.bind(this);
    });
  },

  filterResults() {
    const params = queryString.parse(window.location.search);

    this.filters.forEach((filter) => {
      const name = filter.dataset.filter;
      const { value } = filter;

      if (value !== '') {
        params[name] = value;
      } else {
        delete params[name];
      }
    });

    const search = queryString.stringify(params);
    const pageRegex = /\/page\/[0-9]+\//g;

    if (params.tag) {
      window.location.href = `${window.location.origin + window.location.pathname.replace(pageRegex, '/')}?${search}`;
    } else {
      window.location.search = search;
    }
  },
};

export default Filter;
