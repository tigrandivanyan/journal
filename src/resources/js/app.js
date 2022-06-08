require('./bootstrap');

window.Vue = require('vue');
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

import store from './store'
import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'




// modal notification part
Vue.component('modal-notification', require('./components/general/ModalNotification.vue').default);
// modal notification part - END -



// studio part
Vue.component('studio-list', require('./components/studio/StudioList.vue').default);
Vue.component('studio-add-form', require('./components/studio/StudioAddForm.vue').default);
Vue.component('studio-edit-form', require('./components/studio/StudioEditForm.vue').default);
Vue.component('modal-notification-on-studio-delete', require('./components/studio/ModalNotificationOnStudioDelete.vue').default);
// studio part - END -


// admin(administrator) part
Vue.component('administrator-list', require('./components/staff/administrator/AdministratorList.vue').default);
Vue.component('administrator-add-form', require('./components/staff/administrator/AdministratorAddForm.vue').default);
Vue.component('modal-notification-on-administrator-role-retract', require('./components/staff/administrator/ModalNotificationOnAdministratorRoleRetract.vue').default);



// operator part
Vue.component('operator-list', require('./components/staff/operator/OperatorList.vue').default);
Vue.component('operator-add-form', require('./components/staff/operator/OperatorAddForm.vue').default);
Vue.component('operator-edit-form', require('./components/staff/operator/OperatorEditForm.vue').default);
Vue.component('operator-restore-list', require('./components/staff/operator/RestoreOperatorList.vue').default);
// operator part - END -


// chef part
Vue.component('chef-list', require('./components/staff/chef/ChefList.vue').default);
Vue.component('chef-add-form', require('./components/staff/chef/ChefAddForm.vue').default);
Vue.component('chef-edit-form', require('./components/staff/chef/ChefEditForm.vue').default);
Vue.component('chef-restore-list', require('./components/staff/chef/RestoreChefList.vue').default);
// chef part - END -


// ball_technician part
Vue.component('ball-technician-list', require('./components/staff/ball_technician/BallTechniciansList.vue').default);
Vue.component('ball-technician-add-form', require('./components/staff/ball_technician/BallTechnicianAddForm.vue').default);
Vue.component('ball-technician-edit-form', require('./components/staff/ball_technician/BallTechnicianEditForm.vue').default);
Vue.component('ball-technician-restore-list', require('./components/staff/ball_technician/RestoreBallTechniciansList.vue').default);
// ball_technician part - END -



// access structure part
Vue.component('abilities', require('./components/staff/access_structure/Abilities.vue').default);

Vue.component('assigned-roles', require('./components/staff/access_structure/AssignedRoles.vue').default);
Vue.component('add-assigned-role', require('./components/staff/access_structure/AddAssignedRole.vue').default);

Vue.component('roles-list', require('./components/staff/access_structure/RolesList.vue').default);

Vue.component('permissions', require('./components/staff/access_structure/Permissions.vue').default);
Vue.component('add-permission', require('./components/staff/access_structure/AddPermission.vue').default);
// access structure part - END -




// ball-journal part

Vue.component('ball-journal-header', require('./components/ball_journal/BallJournalHeader.vue').default);
Vue.component('ball-journal-middle', require('./components/ball_journal/BallJournalMiddle.vue').default);
Vue.component('ball-journal-entry-list', require('./components/ball_journal/BallJournalEntryList.vue').default);

// ball-journal part - END -



// entry part

Vue.component('show_one_entry_for_tech_support', require('./components/entry/show_one_entry_for_tech_support/ShowOneEntryForTechSupport.vue').default);

Vue.component('show_entries_by_studio_type_filter', require('./components/entry/admin_panel/ShowEntriesByStudioTypeFilter.vue').default);
Vue.component('show_entries_by_studio_date_filter', require('./components/entry/admin_panel/ShowEntriesByStudioDateFilter.vue').default);
Vue.component('show_entries_by_studio_list', require('./components/entry/admin_panel/ShowEntriesByStudioList.vue').default);

// entry part - END -




const app = new Vue({
    el: '#app',
    store
});
