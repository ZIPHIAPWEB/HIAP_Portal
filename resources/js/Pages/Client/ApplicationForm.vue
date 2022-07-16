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
                            <h3>REGISTRATION FORM</h3>
                            <small>Please ensure that all information provided are complete and accurate. Put <strong>N/A</strong> if not applicable.</small>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="validateBasicInfo()" v-if="step == 1">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            {{ errors[0] }}
                                            <label for="">First Name <i class="text-danger">*</i></label>
                                            <input v-model="form.first_name" type="text" name="" id="" :class="hasFirstNameError" placeholder="Jane">
                                            <!-- <span class="error invalid-feedback" v-if="errors.first_name">{{ $page.errors.first_name }}</span> -->
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="">Middle Name</label>
                                            <input v-model="form.middle_name" type="text" name="" id="" class="form-control" placeholder="Doe">
                                            <!-- <span class="error invalid-feedback" v-if="errors.middle_name">{{ $page.errors.middle_name }}</span> -->
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="">Last Name <i class="text-danger">*</i></label>
                                            <input v-model="form.last_name" type="text" name="" id="" :class="hasLastNameError" placeholder="Doe">
                                            <!-- <span class="error invalid-feedback" v-if="errors.last_name">{{ $page.errors.last_name }}</span> -->
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="">Address <i class="text-danger">*</i></label>
                                            <input v-model="form.address" type="text" name="" id="" :class="hasAddressError" placeholder="xxxx xxxx xxx">
                                            <!-- <span class="error invalid-feedback" v-if="errors.address">{{ $page.errors.address }}</span> -->
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="">Contact Number <i class="text-danger">*</i></label>
                                            <input v-model="form.contact_number" type="number" name="" id="" :class="hasContactError" placeholder="09123456789">
                                            <!-- <span class="error invalid-feedback" v-if="errors.contact_number">{{ $page.errors.contact_number }}</span> -->
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="">Year Level <i class="text-danger">*</i></label>
                                            <select v-model="form.school_year" name="" id="" :class="hasYearLevelError">
                                                <option value="">Select Year    </option>
                                                <option value="First Year">First Year</option>
                                                <option value="Second Year">Second Year</option>
                                                <option value="Third Year">Third Year</option>
                                                <option value="Fourth Year">Fourth Year</option>
                                                <option value="Graduate">Graduate</option>
                                            </select>
                                        </div>
                                        <!-- <span class="error invalid-feedback" v-if="errors.school_year">{{ $page.errors.school_year }}</span> -->
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="">Course <i class="text-danger">*</i></label>
                                            <input v-model="form.course" type="text" :class="hasCourseError" placeholder="Course">
                                            <!-- <span class="error invalid-feedback" v-if="errors.course">{{ $page.errors.course }}</span> -->
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="">Section <i class="text-danger">*</i></label>
                                            <input v-model="form.section" type="text" :class="hasSectionError" placeholder="Section">
                                            <!-- <span class="error invalid-feedback" v-if="errors.section">{{ $page.errors.section }}</span> -->
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <label for="">School <i class="text-danger">*</i></label>
                                            </div>
                                            <select v-model="form.school" type="text" :class="hasSectionError" placeholder="School/Organization">
                                                <option value="">Select School</option>
                                                <option v-for="school in schools" :key="school.id" :value="school.id">{{ school.display_name }}</option>
                                                <!-- <span class="error invalid-feedback" v-if="errors.school">{{ $page.errors.school }}</span> -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="">Expected date of graduation <i class="text-danger">*</i></label>                                            
                                            <input type="month" v-model="form.expected_graduation" :class="hasExpectedGraduationError">
                                            <!-- <span class="error invalid-feedback" v-if="errors.expected_graduation">{{ $page.errors.expected_graduation }}</span> -->
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="">Facebook Profile Link <i class="text-danger">*</i></label>
                                            <input v-model="form.fb_link" type="text" :class="hasFBLinkError" placeholder="https://facebook.com/jane.doe">
                                            <!-- <span class="error invalid-feedback" v-if="errors.fb_link">{{ $page.errors.fb_link }}</span> -->
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="">Personal/Alternate Email <i class="text-danger">*</i></label>
                                            <input v-model="form.alternate_email" type="text" :class="hasAlternateEmailError" placeholder="jane.doe@app.com">
                                            <input @change="setCurrentEmail" type="checkbox"><i class="text-sm mx-1">Use current email</i>
                                            <!-- <span class="error invalid-feedback" v-if="errors.alternate_email">{{ $page.errors.alternate_email }}</span> -->
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
                                            <label>Is it your first time enrolling in HIAP Program?</label>
                                            <select v-model="form.returnee" :class="hasReturneeError">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Program Track <small>(Can select multiple tracks. Note: Don't type your tracks, please select on the choices below.)</small><i class="text-danger">*</i></label>
                                            <v-select v-model="form.course_id" label="name" multiple :options="filteredCourse">
                                                <template #search="{attributes, events}">
                                                    <input
                                                        :class="hasCourseIdError"
                                                        v-bind="attributes"
                                                        v-on="events"
                                                    />
                                                </template>
                                            </v-select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">No. of Hours Needed <i class="text-danger">*</i></label>
                                            <input v-model="form.hours_needed" type="number" placeholder="0" :class="hasHoursNeededError">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Target Start Date</label>
                                            <input v-model="form.start_date" type="date" :class="hasStartDateError">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Target Date of Completion</label>
                                            <input v-model="form.end_date" type="date" :class="hasEndDateError">
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
        props: ['auth', 'errors', 'schools', 'courses', 'programs', 'program_id', 'special_tracks'],
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
                    expected_graduation: '',
                    course_id: [],
                    hours_needed: '',
                    start_date: '',
                    end_date: '',
                    fb_link: '',
                    alternate_email: '',
                    section: '',
                    returnee: ''
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
            hasYearLevelError () {
                return this.errors.contact_number ? 'form-control is-invalid' : 'form-control';
            },
            hasCourseError () {
                return this.errors.course ? 'form-control is-invalid' : 'form-control';
            },
            hasSectionError () {
                return this.errors.section ? 'form-control is-invalid' : 'form-control';
            },
            hasSchoolYearError () {
                return this.errors.school_year ? 'form-control is-invalid' : 'form-control';
            },
            hasExpectedGraduationError () {
                return this.errors.expected_graduation ? 'form-control is-invalid' : 'form-control';
            },
            hasFBLinkError () {
                return this.errors.fb_link ? 'form-control is-invalid' : 'form-control';
            },
            hasAlternateEmailError () {
                return this.errors.alternate_email ? 'form-control is-invalid' : 'form-control';
            },
            hasReturneeError () {
                return this.errors.returnee ? 'form-control is-invalid' : 'form-control';
            },
            hasCourseIdError () {
                return this.errors.course_id ? 'form-control is-invalid' : 'form-control';
            },
            hasHoursNeededError () {
                return this.errors.hours_needed ? 'form-control is-invalid' : 'form-control';
            },
            hasStartDateError () {
                return this.errors.start_date ? 'form-control is-invalid' : 'form-control';
            },
            hasEndDateError () {
                return this.errors.end_date ? 'form-control is-invalid' : 'form-control';
            },
            filteredCourse () {
                if (this.form.school === 1) return this.special_tracks.filter(e => e.course_id == this.program_id);
                if (this.form.school === 2) return this.special_tracks.filter(e => e.course_id == this.program_id);
                if (this.form.school === 3) return this.special_tracks.filter(e => e.course_id == this.program_id);
                if (this.form.school === 4) return this.special_tracks.filter(e => e.course_id == this.program_id);
                if (this.form.school === 5) return this.special_tracks.filter(e => e.course_id == this.program_id);
                if (this.form.school === 256) return this.special_tracks.filter(e => e.course_id == this.program_id);

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
            },
            validateBasicInfo () {
                this.loading = true;
                this.$inertia.post('/client/basic-validation', this.form, {
                    onSuccess: () => {
                        this.loading = false;
                        this.step += 1;
                    },
                    onError: () => {
                        this.loading = false;
                    }
                })
            },
            setCurrentEmail (e) {
                if(e.target.checked == true) {
                    this.form.alternate_email = this.auth.email;
                } else {
                    this.form.alternate_email = ''
                }
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

    @media only screen and (max-width: 576px) {
        .container-fluid {
            margin-top: 20px;
            height: 100%;
            overflow: auto;
        }   
    }
</style>
