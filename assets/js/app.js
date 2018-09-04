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
import {MDCTopAppBar} from '@material/top-app-bar/index';
import {MDCList} from "@material/list";
import {MDCDrawer} from "@material/drawer";
import {MDCIconToggle} from '@material/icon-toggle';


//const buttonRipple = new MDCRipple(document.querySelector('.mdc-button'));
mdcAutoInit.register('MDCTextField', MDCTextField);
mdcAutoInit.register('MDCButton', MDCRipple);
try {
  const drawer = MDCDrawer.attachTo(document.querySelector('.mdc-drawer'));
  const list = MDCList.attachTo(document.querySelector('.mdc-list'));
  list.wrapFocus = true;
  mdcAutoInit.register('MDCTopAppBar', MDCTopAppBar);
  const topAppBar = MDCTopAppBar.attachTo(document.getElementById('app-bar'));
  topAppBar.setScrollTarget(document.getElementById('main-content'));
  topAppBar.listen('MDCTopAppBar:nav', () => {
    drawer.open = !drawer.open;
  });
} catch (e) {}

// Toggle button init
try {
  //MDCIconToggle.attachTo(document.querySelector('.mdc-icon-toggle'));
  mdcAutoInit.register('MDCToggle', MDCIconToggle);
} catch (e) {}

//

//const textField = new MDCTextField(document.querySelector('.mdc-text-field'));
//mdcAutoInit.register('MDCTextField', MDCTextField);


// search for all capsule in the page thanks to data-capsule-redirect attribute
// and set a on click listener so when the user click on a capsule he is redirect
// to the capsule page
document.querySelectorAll('[data-capsule-redirect]').forEach((el) => {
  el.addEventListener('click', () => {
    window.location = `/capsule/${el.getAttribute('data-capsule-redirect')}`
  });
});