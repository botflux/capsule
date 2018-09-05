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

import mdcAutoInit from '@material/auto-init';
import {MDCTextField} from '@material/textfield';
import {MDCRipple} from '@material/ripple';
import {MDCTopAppBar} from '@material/top-app-bar/index';
import {MDCList} from "@material/list";
import {MDCDrawer} from "@material/drawer";
import {MDCIconToggle} from '@material/icon-toggle';
import {MDCDialog} from '@material/dialog';
import {MDCChipSet} from '@material/chips';
import axios from 'axios';
window.mdcAutoInit = mdcAutoInit;

mdcAutoInit.register('MDCTextField', MDCTextField);
mdcAutoInit.register('MDCButton', MDCRipple);
mdcAutoInit.register('MDCChips', MDCChipSet);

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

try {
  mdcAutoInit.register('MDCDialog', MDCDialog);
} catch (e) {}

//const textField = new MDCTextField(document.querySelector('.mdc-text-field'));
//mdcAutoInit.register('MDCTextField', MDCTextField);
try {
  const dialog = new MDCDialog(document.querySelector('#link-dialog'));

  document.querySelector('[data-link-capsule]').addEventListener('click', () => {
    dialog.show();
  });

    dialog.listen('MDCDialog:accept', () => {
        // get link inside the text box
        let inviteCode = document.querySelector('#join-capsule-text-field').value;
        axios.get(`/capsule/invite/${inviteCode}`)
            .then((response) => {
                let data = JSON.parse(response.data);
                window.location = `/capsule/${data.id}`;
            })
            .catch((error) => {
                console.log(error);
            });

    });
} catch (e) {

}

try {

// search for all capsule in the page thanks to data-capsule-redirect attribute
// and set a on click listener so when the user click on a capsule he is redirect
// to the capsule page
    document.querySelectorAll('[data-capsule-redirect]').forEach((el) => {
        el.addEventListener('click', () => {
            window.location = `/capsule/${el.getAttribute('data-capsule-redirect')}`
        });
    });
} catch (e) {}

let orderChipsSet = document.querySelectorAll('[data-chips-capsule-order]');

if (orderChipsSet !== undefined) {
  orderChipsSet.forEach((el) => {
    el.addEventListener('click', () => {
      window.location = `/dashboard?order=${el.getAttribute('data-chips-capsule-order')}`;
    });
  });
}