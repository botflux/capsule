require('../css/vanilla.scss')

import mdcAutoInit from '@material/auto-init';
import {MDCTextField} from '@material/textfield';
import {MDCRipple} from '@material/ripple';
import {MDCTopAppBar} from '@material/top-app-bar/index';
import {MDCIconToggle} from '@material/icon-toggle';
import {MDCDialog} from '@material/dialog';
import {MDCChipSet} from '@material/chips';
import {MDCTextFieldHelperText} from '@material/textfield/helper-text';

window.mdcAutoInit = mdcAutoInit;

// registering text fields for initialization
mdcAutoInit.register('MDCTextField', MDCTextField);
// registering button for initialization
mdcAutoInit.register('MDCButton', MDCRipple);
// registering chips for initialization
mdcAutoInit.register('MDCChips', MDCChipSet);
// initialization of toggle button (favorite button in dashboard)
mdcAutoInit.register('MDCToggle', MDCIconToggle);
// registering of modal dialog
mdcAutoInit.register('MDCDialog', MDCDialog);
// registering of top app bar
mdcAutoInit.register('MDCTopAppBar', MDCTopAppBar);
// registering help text
mdcAutoInit.register('MDCHelperText', MDCTextFieldHelperText);