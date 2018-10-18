import Rellax from 'rellax';

const Animations = {
  init() {
    if (document.querySelector('[data-rellax]')) {
      new Rellax('[data-rellax]');
    }
  },
};

export default Animations;
