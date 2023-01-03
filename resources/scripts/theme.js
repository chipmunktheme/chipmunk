import {domReady} from '@roots/sage/client';

import ui from './utils/ui';
import panels from './utils/panels';

/**
 * app.main
 */
const main = async (err) => {
  if (err) {
    // handle hmr errors
    console.error(err);
  }

  // Panels
  panels.init();

  // UI
  ui.init();
};

/**
 * Initialize
 *
 * @see https://webpack.js.org/api/hot-module-replacement
 */
domReady(main);
import.meta.webpackHot?.accept(main);
