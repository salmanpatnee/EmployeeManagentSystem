<template>
    <div>
        <h1 class="mt-4">Add Employee</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">
                <a href="/dashboard" class="breadcrumb-item">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <router-link class="breadcrumb-item" :to="{ name: 'employees.index' }">All Employees</router-link>
            </li>
            <li class="breadcrumb-item active">Add Employee</li>
        </ol>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card mb-2">
                        <div class="card-header">
                            Add Employee
                        </div>

                        <div class="card-body">
                            <form @submit.prevent="store()" @keydown="form.onKeydown($event)">
                                <div class="row mb-3">
                                    <label for="first_name" class="col-md-4 col-form-label text-md-end">First
                                        Name</label>
                                    <div class="col-md-6">
                                        <input v-model="form.first_name" type="text" id="first_name"
                                            class="form-control" name="first_name" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="middle_name" class="col-md-4 col-form-label text-md-end">Middle
                                        Name</label>
                                    <div class="col-md-6">
                                        <input v-model="form.middle_name" type="text" id="middle_name"
                                            class="form-control" name="middle_name">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="last_name" class="col-md-4 col-form-label text-md-end">Last
                                        Name</label>
                                    <div class="col-md-6">
                                        <input v-model="form.last_name" type="text" id="last_name" class="form-control"
                                            name="last_name" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="address" class="col-md-4 col-form-label text-md-end">Address</label>
                                    <div class="col-md-6">
                                        <input v-model="form.address" type="text" id="address" class="form-control"
                                            name="address" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="department_id"
                                        class="col-md-4 col-form-label text-md-end">Department</label>
                                    <div class="col-md-6">
                                        <select v-model="form.department_id" name="department_id" class="form-control">
                                            <option v-for="department in departments" :key="department.id"
                                                :value="department.id">
                                                {{ department.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="country_id" class="col-md-4 col-form-label text-md-end">Country</label>
                                    <div class="col-md-6">
                                        <select v-model="form.country_id" @change="getStates()" name="country_id"
                                            class="form-control">

                                            <option v-for="country in countries" :key="country.id" :value="country.id">
                                                {{ country.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="state_id" class="col-md-4 col-form-label text-md-end">State</label>
                                    <div class="col-md-6">
                                        <select v-model="form.state_id" @change="getCities()" name="state_id"
                                            class="form-control">

                                            <option v-for="state in states" :key="state.id" :value="state.id">
                                                {{ state.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="city_id" class="col-md-4 col-form-label text-md-end">City</label>
                                    <div class="col-md-6">
                                        <select v-model="form.city_id" name="city_id" class="form-control"
                                            placeholder="Select a City">

                                            <option v-for="city in cities" :key="city.id" :value="city.id">
                                                {{ city.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="zip_code" class="col-md-4 col-form-label text-md-end">Zip Code</label>
                                    <div class="col-md-6">
                                        <input v-model="form.zip_code" type="text" id="zip_code" class="form-control"
                                            name="zip_code" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="birthdate" class="col-md-4 col-form-label text-md-end">Birthdate</label>
                                    <div class="col-md-6">
                                        <datepicker v-model="form.birthdate" input-class="form-control">
                                        </datepicker>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="date_hired" class="col-md-4 col-form-label text-md-end">Date
                                        Hired</label>
                                    <div class="col-md-6">
                                        <datepicker v-model="form.date_hired" input-class="form-control">
                                        </datepicker>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Add Employee
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import Moment from 'moment';

export default {
    data() {
        return {
            countries: [],
            states: [],
            cities: [],
            departments: [],
            form: new Form({
                first_name: '',
                middle_name: '',
                last_name: '',
                address: '',
                department_id: '',
                country_id: '',
                state_id: '',
                city_id: '',
                zip_code: '',
                birthdate: '',
                date_hired: '',
            })
        }
    },
    components: {
        Datepicker
    },
    methods: {
        store() {
            this.form.post("/api/employees").then(() => {
                // Notification.success('Product Added');
                this.$router.push({ name: 'employees.index' })
            }).catch((error) => {
                console.log(error)
            });
        },
        formatDate(date) {
            return Moment(date).format('YYYY-MM-DD');
        },
        getCountries() {
            axios.get("/api/employees/countries"
            ).then(({ data }) => this.countries = data
            ).catch(error => console.log('Error: ' + error));
        },
        getStates() {
            axios.get("/api/employees/" + this.form.country_id + "/states"
            ).then(({ data }) => this.states = data
            ).catch(error => console.log('Error: ' + error));
        },
        getCities() {
            axios.get("/api/employees/" + this.form.state_id + "/cities"
            ).then(({ data }) => this.cities = data
            ).catch(error => console.log('Error: ' + error));
        },
        getDepartments() {
            axios.get("/api/employees/departments"
            ).then(({ data }) => this.departments = data
            ).catch(error => console.log('Error: ' + error));
        },
    },
    created() {
        this.getCountries();
        this.getDepartments();
    }
}
</script>