import Vuex from 'vuex';
import Vue from 'vue';

import abilities from './modules/staff/access_structure/abilities';
import assigned_roles from './modules/staff/access_structure/assigned_roles';
import permissions from './modules/staff/access_structure/permissions';
import roles from './modules/staff/access_structure/roles';


import administrator from './modules/staff/administrator/administrator';
import operator from './modules/staff/operator/operator';
import chef from './modules/staff/chef/chef';
import ball_technician from './modules/staff/ball_technician/ball_technician';


import studio from './modules/studio/studio';


import ball_journal from './modules/ball_journal/ball_journal';


import show_one_entry_for_tech_support from './modules/entry/show_one_entry_for_tech_support';
import show_entries_by_studio_in_admin_panel from './modules/entry/show_entries_by_studio_in_admin_panel';


import modal_notification from './modules/general/modal_notification';
import validation_errors from './modules/general/validation_errors';

Vue.use(Vuex);



export default new Vuex.Store({
    modules:{
        abilities,
        assigned_roles,
        permissions,
        roles,
        operator,
        administrator,
        chef,
        ball_technician,
        studio,
        modal_notification,
        validation_errors,
        ball_journal,
        show_one_entry_for_tech_support,
        show_entries_by_studio_in_admin_panel,
    }

});