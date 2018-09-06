import {MDCDrawer} from "@material/drawer/index";
import {MDCList} from "@material/list/index";
import {MDCTopAppBar} from "@material/top-app-bar/index";
import axios from "axios/index";
import {MDCDialog} from "@material/dialog/index";

require('./capsule-chips-filter');
//require('./capsule-card');
import CardInteraction from './capsule-card';
CardInteraction();

const drawer = MDCDrawer.attachTo(document.querySelector('.mdc-drawer'));
// declaring the list inside the app drawer
const list = MDCList.attachTo(document.querySelector('.mdc-list'));
list.wrapFocus = true;
// register the top app bar for initialization
// initialize top app bar
const topAppBar = MDCTopAppBar.attachTo(document.getElementById('app-bar'));
topAppBar.setScrollTarget(document.getElementById('main-content'));
// listen for the top app bar nav button to be click
topAppBar.listen('MDCTopAppBar:nav', () => {
  drawer.open = !drawer.open;
});

/**
 * Represent the invite id capsule modal dialog
 * @type {MDCDialog}
 */
const linkDialog = new MDCDialog(document.querySelector('#link-dialog'));

// when the link button is click, show the dialog
document.querySelector('[data-link-capsule]').addEventListener('click', () => {
  linkDialog.show();
});

// when the dialog is accept, send request to the server
linkDialog.listen('MDCDialog:accept', () => {
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
