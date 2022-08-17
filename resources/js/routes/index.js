import Vue from 'vue';
import VueRouter from 'vue-router';
import Employees from '../components/employees/Index';
import EmployeesCreate from '../components/employees/Create';
import EmployeesEdit from '../components/employees/Edit';

Vue.use(VueRouter);

const Routes = new VueRouter({
    routes: [
        { path: '/', component: Employees, name: 'app' },

        { path: '/employees', component: Employees, name: 'employees.index' },
        { path: '/employees/create', component: EmployeesCreate, name: 'employees.create' },
        { path: '/employees/edit/:id', component: EmployeesEdit, name: 'employees.edit' },
    ],
    mode: 'history'
});

/*
Routes.beforeEach((to, from, next) => {

    const { requiresAuth, authorize } = to.meta;
    const { authenticated } = store.getters;

    if (requiresAuth) {
        if (authenticated) {
            const { permissions } = store.getters.user.data;

            if (authorize) {
                if (!authorize.some(permission => permissions.includes(permission))) {
                    next({ name: 'login' });
                }
            } else {
                next();
            }
            next();
        } else {
            next({ name: 'login' });
        }
    }
    next();
});
*/

export default Routes;