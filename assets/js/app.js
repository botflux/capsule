/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.scss in this case)
require('../css/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// var $ = require('jquery');

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
import mdcAutoInit from '@material/auto-init';
window.mdcAutoInit = mdcAutoInit;

import {MDCTextField} from '@material/textfield';
import {MDCRipple} from '@material/ripple';

//const buttonRipple = new MDCRipple(document.querySelector('.mdc-button'));
mdcAutoInit.register('MDCTextField', MDCTextField);
mdcAutoInit.register('MDCButton', MDCRipple);

//const textField = new MDCTextField(document.querySelector('.mdc-text-field'));
//mdcAutoInit.register('MDCTextField', MDCTextField);
