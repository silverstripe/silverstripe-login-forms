const Path = require('path');
const { JavascriptWebpackConfig, CssWebpackConfig } = require('@silverstripe/webpack-config');

const ENV = process.env.NODE_ENV;
const PATHS = {
  ROOT: Path.resolve(),
  SRC: Path.resolve('client/src'),
  DIST: Path.resolve('client/dist'),
};

// Main JS bundle
const jsConfig = new JavascriptWebpackConfig('js', PATHS, 'silverstripe/login-forms')
  .setEntry({
    bundle: `${PATHS.SRC}/js/bundle.js`,
  })
  .getConfig();

// This module isn't actually withing the CMS context, so it won't have access
// to the externals
delete jsConfig.externals;

const config = [
  jsConfig,
  // sass to css
  new CssWebpackConfig('css', PATHS)
    .setEntry({
      bundle: `${PATHS.SRC}/styles/bundle.scss`,
      darkmode: `${PATHS.SRC}/styles/dark-mode.scss`
    })
    .getConfig(),
];

// Use WEBPACK_CHILD=js or WEBPACK_CHILD=css env var to run a single config
module.exports = (process.env.WEBPACK_CHILD)
  ? config.find((entry) => entry.name === process.env.WEBPACK_CHILD)
  : config;
