module.exports = {
  extends: [
    '@roots/sage/stylelint-config',
    '@roots/bud-sass/stylelint-config',
  ],
  rules: {
    // 'selector-max-compound-selectors': 4,
    // 'selector-no-qualifying-type': null,
    // 'selector-max-id': 1,
    // 'max-nesting-depth': 5,
    'no-descending-specificity': null,
    'selector-class-pattern': null,
    'custom-property-pattern': null,
    'value-list-comma-newline-after': null,
    'string-quotes': 'single',
  },
};
