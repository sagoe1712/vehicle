<template>
    <div>
        <h1>Netwatch Global Vehicle Search</h1>
        <form @submit.prevent="searchSubmit">
            <p>Make <span v-if="required"><span style="color: red" v-if="!make">*</span></span></p>
            <input v-model="make" placeholder="Make">
            <p>Model <span v-if="required"><span style="color: red" v-if="!model">*</span></span></p>
            <input v-model="model" placeholder="Model">
            <p>Registration <span v-if="required"><span style="color: red" v-if="!registration">*</span></span></p>
            <input v-model="registration" placeholder="Registration">
            <p></p>
            <button>Search</button>
        </form>
        <span v-if="errors" >{{errors}}</span>
        <span v-else>
        <table>
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


