<template>
    <div>
        <h1 class="mt-4">Employees</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Employees</li>
        </ol>
        <div class="container">

            <div class="row">
                <div class="col-md-6">
                    <form class="row row-cols-lg-auto g-3 align-items-center mb-3" action="">
                        <div class="col-12">
                            <input type="search" v-model.trim.lazy="search" name="search" class="form-control"
                                placeholder="Search employees">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <router-link class="btn btn-primary" :to="{ name: 'employees.create' }">Add Employee</router-link>
                </div>
            </div>


            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card mb-2">
                        <div class="card-header">
                            Employees
                        </div>

                        <div class="card-body">

                            <div v-show="showMessage" class="alert alert-success" role="alert">
                                {{ message }}
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">First name</th>
                                            <th scope="col">Middle name</th>
                                            <th scope="col">Last name</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Department</th>
                                            <th scope="col">Date hired</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="employee in employees" :key="employee.id">
                                            <th scope="row">{{ employee.id }}</th>
                                            <td>{{ employee.first_name }}</td>
                                            <td>{{ employee.middle_name }}</td>
                                            <td>{{ employee.last_name }}</td>
                                            <td>{{ employee.address }}</td>
                                            <td>{{ employee.department }}</td>
                                            <td>{{ employee.date_hired }}</td>
                                            <td>
                                                <router-link class="btn btn-primary btn-sm"
                                                    :to="{ name: 'employees.edit', params: { 'id': employee.id } }">Edit
                                                </router-link>
                                                <button type="button" @click="deleteEmployee(employee.id)"
                                                    class="btn btn-danger btn-sm">Delete</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            employees: [],
            message: '',
            showMessage: false,
            search: ''
        }
    },
    watch: {
        search: function ($value) {
            this.getEmployees();
        },
    },
    methods: {
        getEmployees() {
            axios.get("/api/employees?search=" + this.search
            ).then(({ data }) => this.employees = data.data
            ).catch(error => console.log('Error: ' + error));
        },
        deleteEmployee(id) {

            axios.delete("/api/employees/" + id
            ).then(({ data }) => {

                this.message = "Employee deleted!";
                this.showMessage = true;

                this.getEmployees();
            }
            ).catch(error => console.log('Error: ' + error));
        }
    },
    created() {
        this.getEmployees();
    }
}
</script>