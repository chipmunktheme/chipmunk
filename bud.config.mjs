// @ts-check

/**
 * Build configuration
 *
 * @see {@link https://bud.js.org/guides/getting-started/configure}
 * @param {import('@roots/bud').Bud} app
 */
export default async (app) => {
  app
    /**
     * Application entrypoints
     */
    .entry({
      theme: ['@scripts/theme', '@styles/theme'],
      editor: ['@scripts/editor', '@styles/editor'],
      admin: ['@styles/admin'],
    })

    /**
     * Directory contents to be included in the compilation
     */
    .assets(['images'])

    /**
     * Matched files trigger a page reload when modified
     */
    .watch(['resources/views/**/*', 'app/**/*'])

    /**
     * Proxy origin (`WP_HOME`)
     */
    .proxy('http://chipmunk.test')

    /**
     * Development origin
     */
    .serve('http://0.0.0.0:8000')

    /**
     * URI of the `public` directory
     */
    .setPublicPath('/app/themes/chipmunk/public/');
};
