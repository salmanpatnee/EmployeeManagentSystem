import Vue from 'vue';
import router from './routes/index';
import { Form } from 'vform';
require('./bootstrap');

/* Components */
import { Button, HasError, AlertErrors } from 'vform/src/components/bootstrap5';
import Employees from './components/employees/Index';

Vue.component(Button.name, Button)
Vue.component(HasError.name, HasError)
Vue.component(AlertErrors.name, AlertErrors)

window.Form = Form;

const app = new Vue({
    el: '#app',
    components: {
        Employees
    },
    router
});
