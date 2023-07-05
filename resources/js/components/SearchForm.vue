<template>
    <div>
        <h1>Netwatch Global Vehicle Search</h1>
        <form @submit.prevent="searchSubmit">
            <label>Make <span v-if="required"><span style="color: red" v-if="!make">*</span></span></label>
            <input class="form-control" v-model="make" placeholder="Make">
            <label class="mt-2">Model <span v-if="required"><span style="color: red" v-if="!model">*</span></span></label>
            <input class="form-control" v-model="model" placeholder="Model">
            <label class="mt-2">Registration <span v-if="required"><span style="color: red" v-if="!registration">*</span></span></label>
            <input class="form-control" v-model="registration" placeholder="Registration">
            <button class="btn btn-primary btn-lg mt-3 mb-3 w-100">Search</button>
        </form>
        <span v-if="errors" >{{errors}}</span>
        <span v-else>
        <table v-if="vehicles" class="table w-100">
            <thead>
            <th>SN</th>
            <th>Make</th>
            <th>Model</th>
            <th>Registration</th>
            </thead>
        <tr id="carList" >

            <tr v-for="(vehicle, index) in vehicles">
                <td>{{index + 1}}</td>
                <td>{{ vehicle.make }}</td>
                <td>{{ vehicle.model }}</td>
                <td>{{ vehicle.registration }}</td>
            </tr>
        </tr>
        </table>
        </span>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            make: '',
            model: '',
            registration: '',
            errors: '',
            vehicles:'',
            required:false,
        };
    },
    methods: {
        async searchSubmit() {
            const params = {
                make: this.make,
                model: this.model,
                registration: this.registration,
            };


            try {
                const response = await axios.post('/api/vehicles', params);
                this.vehicles = response.data;

                if (this.vehicles.length > 0) {
                    this.errors = '';
                } else {
                    this.errors = 'No Vehicle';
                }

            } catch (error) {
                this.errors = error;
            }
        },
    },

};
</script>


