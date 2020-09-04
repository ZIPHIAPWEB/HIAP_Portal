<template>
    <div class="application-form">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3">
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
                                            <label for="">First Name <i class="text-danger">*</i></label>
                                            <input v-model="form.first_name" type="text" name="" id="" :class="hasFirstNameError" placeholder="Jane">
                                            <span class="error invalid-feedback" v-if="errors.first_name">{{ $page.errors.first_name }}</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Middle Name</label>
                                            <input v-model="form.middle_name" type="text" name="" id="" class="form-control" placeholder="Doe">
                                            <span class="error invalid-feedback" v-if="errors.middle_name">{{ $page.errors.middle_name }}</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Last Name <i class="text-danger">*</i></label>
                                            <input v-model="form.last_name" type="text" name="" id="" :class="hasLastNameError" placeholder="Doe">
                                            <span class="error invalid-feedback" v-if="errors.last_name">{{ $page.errors.last_name }}</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Address <i class="text-danger">*</i></label>
                                            <input v-model="form.address" type="text" name="" id="" :class="hasAddressError" placeholder="xxxx xxxx xxx">
                                            <span class="error invalid-feedback" v-if="errors.address">{{ $page.errors.address }}</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Contact Number <i class="text-danger">*</i></label>
                                            <input v-model="form.contact_number" type="text" name="" id="" :class="hasContactError" placeholder="09123456789">
                                            <span class="error invalid-feedback" v-if="errors.contact_number">{{ $page.errors.contact_number }}</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <label for="">School/Organization <i class="text-danger">*</i></label>
                                                <div class="form-check ml-auto">
                                                    <input v-model="isOrganization" type="checkbox" name="" id="">
                                                    <i for="">already employed</i>
                                                </div>
                                            </div>
                                            <input v-model="form.school" v-if="isOrganization" type="text" class="form-control" placeholder="Enter organization">
                                            <select v-model="form.school" v-else type="text" class="form-control" placeholder="School/Organization">
                                                <option value="">Select School</option>
                                                <option v-for="school in schools" :key="school.id" :value="school.name">{{ school.display_name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Program <i class="text-danger">*</i></label>
                                            <select v-model="form.program" :class="hasProgramError">
                                                <option value="">Select Program</option>
                                                <option v-for="program in programs" :key="program.id" :value="program.id">{{ program.name }}</option>
                                            </select>
                                            <span class="error invalid-feedback" v-if="errors.program">{{ $page.errors.program }}</span>
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
        props: ['errors', 'schools'],
        data() {
            return {
                form: {
                    first_name: '',
                    middle_name: '',
                    last_name: '',
                    address: '',
                    contact_number: '',
                    school: '',
                    program: ''
                },
                programs: [],
                isOrganization: false,
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
                return this.errors.contact_number ? 'form-control is-invalid' : 'form-control';
            },
            hasProgramError () {
                return this.errors.program ? 'form-control is-invalid' : 'form-control';
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
