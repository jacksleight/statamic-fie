import '../css/addon.scss';

import FieFieldtype from './components/fieldtypes/Fie.vue';

Statamic.booting(() => {

    Statamic.$components.register('fie-fieldtype', FieFieldtype);

});
