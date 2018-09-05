/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.scss in this case)
require('../css/app.scss');

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

// registering text fields for initialization
mdcAutoInit.register('MDCTextField', MDCTextField);
// registering button for initialization
mdcAutoInit.register('MDCButton', MDCRipple);
// registering chips for initialization
mdcAutoInit.register('MDCChips', MDCChipSet);

// this entire block represent the initialization of the drawer and the top app bar.
// the block is surrounded by a try because the script will be execute on every page but
// those components will not be on every page (such as register or login).
try {
  // declaring app drawer (left modal menu)
  const drawer = MDCDrawer.attachTo(document.querySelector('.mdc-drawer'));
  // declaring the list inside the app drawer
  const list = MDCList.attachTo(document.querySelector('.mdc-list'));
  list.wrapFocus = true;
  // register the top app bar for initialization
  mdcAutoInit.register('MDCTopAppBar', MDCTopAppBar);
  // initialize top app bar
  const topAppBar = MDCTopAppBar.attachTo(document.getElementById('app-bar'));
  topAppBar.setScrollTarget(document.getElementById('main-content'));
  // listen for the top app bar nav button to be click
  topAppBar.listen('MDCTopAppBar:nav', () => {
    drawer.open = !drawer.open;
  });
} catch (e) {}

// initialization of toggle button (favorite button in dashboard)
try {
  //MDCIconToggle.attachTo(document.querySelector('.mdc-icon-toggle'));
  mdcAutoInit.register('MDCToggle', MDCIconToggle);
} catch (e) {}

// initialization of modal dialog
try {
  mdcAutoInit.register('MDCDialog', MDCDialog);
} catch (e) {}

// this block represent the initialization of the invite link modal dialog
try {
  // represent the dialog
  const dialog = new MDCDialog(document.querySelector('#link-dialog'));

  // search for the link icon with a custom attribute. when this icon will be click
  // the dialog will be show
  document.querySelector('[data-link-capsule]').addEventListener('click', () => {
    dialog.show();
  });

  // listen when the invite link dialog is accepted
  dialog.listen('MDCDialog:accept', () => {
    // get the input entered into the text field
    let inviteCode = document.querySelector('#join-capsule-text-field').value;
    // tell the http client to make a call to the api with the code got into the field
    axios.get(`/capsule/invite/${inviteCode}`)
      // if 200 status response
      .then((response) => {
        // get the response and parse it into a js object
        let data = JSON.parse(response.data);
        // redirect the user to the capsule editing page
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