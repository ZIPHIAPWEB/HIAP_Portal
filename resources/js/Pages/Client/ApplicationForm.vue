<template>
    <div class="application-form">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-3">
                    <div class="card">
                        <div class="overlay" v-if="loading">
                            <i class="fas fa-spinner fa-2x fa-pulse"></i>
                        </div>
                        <div class="card-header text-center">
                            <h3>Application Form</h3>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="submitApplication">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">First Name</label>
                                            <input v-model="form.first_name" type="text" name="" id="" :class="hasFirstNameError" placeholder="Jane">
                                            <span class="error invalid-feedback" v-if="errors.first_name">This field is required.</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Middle Name</label>
                                            <input v-model="form.middle_name" type="text" name="" id="" class="form-control" placeholder="Doe">
                                            <span class="error invalid-feedback" v-if="errors.middle_name">This field is required.</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Last Name</label>
                                            <input v-model="form.last_name" type="text" name="" id="" :class="hasLastNameError" placeholder="Doe">
                                            <span class="error invalid-feedback" v-if="errors.last_name">This field is required.</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Address</label>
                                            <input v-model="form.address" type="text" name="" id="" :class="hasAddressError" placeholder="xxxx xxxx xxx">
                                            <span class="error invalid-feedback" v-if="errors.address">This field is required.</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Contact Number</label>
                                            <input v-model="form.contact_no" type="text" name="" id="" :class="hasContactError" placeholder="09123456789">
                                            <span class="error invalid-feedback" v-if="errors.contact_no">This field is required.</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Program</label>
                                            <select v-model="form.program_id" :class="hasProgramError">
                                                <option value="">Select Program</option>
                                                <option v-for="program in programs" :key="program.id" :value="program.id">{{ program.name }}</option>
                                            </select>
                                            <span class="error invalid-feedback" v-if="errors.program_id">This field is required.</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-block">Submit</button>
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
    export default {
        props: ['errors'],
        data() {
            return {
                form: {
                    first_name: '',
                    middle_name: '',
                    last_name: '',
                    address: '',
                    contact_no: '',
                    program_id: ''
                },
                programs: [],
                loading: false
            }
        },
        mounted() {
            this.getAllPrograms();
        },
        computed: {
            hasFirstNameError () {
                return this.errors.first_name ? 'form-control is-invalid' : 'form-control';
            },
            hasLastNameError () {
                return this.errors.last_name ? 'form-control is-invalid' : 'form-control';
            },
            hasAddressError () {
                return this.errors.address ? 'form-control is-invalid' : 'form-control';
            },
            hasContactError () {
                return this.errors.contact_no ? 'form-control is-invalid' : 'form-control';
            },
            hasProgramError () {
                return this.errors.program_id ? 'form-control is-invalid' : 'form-control';
            }
        },
        methods: {
            submitApplication () {
                this.loading = true;
                this.$inertia.post('/client/sendApplication', this.form)
                    .then((response) => {
                        this.loading = false;
                        console.log(response);
                    })
                    .catch(error => {
                        this.loading = false;
                    })
            },
            getAllPrograms() {
                axios.get('/getAllPrograms')
                    .then((response) => {
                        this.programs = response.data;
                    })
            }
        }
    }
</script>

<style lang="scss" scoped>
    .application-form {
        width: 100%;
        height: 100vh;
        background: lightgray;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
