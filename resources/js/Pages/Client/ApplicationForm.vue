<template>
    <div class="application-form">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-6">
                    <div class="card">
                        <div class="overlay" v-if="loading">
                            <i class="fas fa-spinner fa-2x fa-pulse"></i>
                        </div>
                        <div class="card-header text-center">
                            <h3>Registration Form</h3>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="step++" v-if="step == 1">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">First Name <i class="text-danger">*</i></label>
                                            <input v-model="form.first_name" type="text" name="" id="" :class="hasFirstNameError" placeholder="Jane" required>
                                            <span class="error invalid-feedback" v-if="errors.first_name">{{ $page.errors.first_name }}</span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Middle Name</label>
                                            <input v-model="form.middle_name" type="text" name="" id="" class="form-control" placeholder="Doe">
                                            <span class="error invalid-feedback" v-if="errors.middle_name">{{ $page.errors.middle_name }}</span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Last Name <i class="text-danger">*</i></label>
                                            <input v-model="form.last_name" type="text" name="" id="" :class="hasLastNameError" placeholder="Doe" required>
                                            <span class="error invalid-feedback" v-if="errors.last_name">{{ $page.errors.last_name }}</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Address <i class="text-danger">*</i></label>
                                            <input v-model="form.address" type="text" name="" id="" :class="hasAddressError" placeholder="xxxx xxxx xxx" required>
                                            <span class="error invalid-feedback" v-if="errors.address">{{ $page.errors.address }}</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Contact Number <i class="text-danger">*</i></label>
                                            <input v-model="form.contact_number" type="number" name="" id="" :class="hasContactError" placeholder="09123456789" required>
                                            <span class="error invalid-feedback" v-if="errors.contact_number">{{ $page.errors.contact_number }}</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Year Level <i class="text-danger">*</i></label>
                                            <select v-model="form.school_year" name="" id="" class="form-control" required>
                                                <option value="">Select Year    </option>
                                                <option value="First Year">First Year</option>
                                                <option value="Second Year">Second Year</option>
                                                <option value="Third Year">Third Year</option>
                                                <option value="Fourth Year">Fourth Year</option>
                                                <option value="Graduate">Graduate</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Course <i class="text-danger">*</i></label>
                                            <input v-model="form.course" type="text" class="form-control" placeholder="Course" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <label for="">School <i class="text-danger">*</i></label>
                                            </div>
                                            <select v-model="form.school" type="text" class="form-control" placeholder="School/Organization" required>
                                                <option value="">Select School</option>
                                                <option v-for="school in schools" :key="school.id" :value="school.id">{{ school.display_name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Facebook Profile Link <i class="text-danger">*</i></label>
                                            <input v-model="form.fb_link" type="text" class="form-control" placeholder="https://facebook.com/jane.doe" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Personal/Alternate Email <i class="text-danger">*</i></label>
                                            <input v-model="form.alternate_email" type="text" class="form-control" placeholder="jane.doe@app.com">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-block">Next</button>
                                    </div>
                                    <!-- <div class="col-6">
                                        <button class="btn btn-primary btn-block">Submit</button>
                                    </div> -->
                                </div>
                            </form>
                            <form v-if="step == 2" @submit.prevent="submitApplication()">
                                <div class="row" >
                                    <!-- <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Programs <i class="text-danger">*</i></label>
                                            <select v-model="form.program" class="form-control">
                                                <option value="">Select something</option>
                                                <option v-for="program in courses" :key="program.id" :value="program.id">
                                                    {{ program.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Courses (Can select multiple courses)<i class="text-danger">*</i></label>
                                            <v-select v-model="form.course_id" label="name" multiple :options="filteredCourse"></v-select>
                                            <span class="error invalid-feedback" v-if="errors.program">{{ $page.errors.program }}</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">No. of Hours Needed <i class="text-danger">*</i></label>
                                            <input v-model="form.hours_needed" type="number" placeholder="0" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Target Start Date</label>
                                            <input v-model="form.start_date" type="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Target Date of Completion</label>
                                            <input v-model="form.end_date" type="date" class="form-control">
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
        props: ['errors', 'schools', 'courses', 'programs', 'program_id'],
        data() {
            return {
                form: {
                    first_name: '',
                    middle_name: '',
                    last_name: '',
                    address: '',
                    contact_number: '',
                    school: '',
                    program: '',
                    course: '',
                    school_year: '',
                    course_id: [],
                    hours_needed: '',
                    start_date: '',
                    end_date: '',
                    fb_link: '',
                    alternate_email: ''
                },
                isOrganization: false,
                loading: false,
                step: 1,
            }
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
                return this.errors.program ? 'form-control is-invalid' : 'form-control select2 select2-hidden-accessible';
            },
            filteredCourse () {
                return this.programs.filter(e => e.course_id == this.program_id);
            }
        },
        methods: {
            submitApplication () {
                this.loading = true;
                this.$inertia.post('/client/sendApplication', this.form, {
                    onSuccess: () => {
                        this.loading = false;
                    },
                    onError: () => {
                        this.loading = false;
                    }
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
