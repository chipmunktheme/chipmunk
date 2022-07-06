const Helpers = {
  getBreakpoint() {
    const property = window.getComputedStyle(document.body, '::before');
    const value = property.getPropertyValue('content').replace(/\"/g, '');

    return value;
  },
};

export default Helpers;
