<template>
    <client-layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <img class="avatar" src="/man.png" alt="">
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <button data-toggle="modal" data-target="#modal-change-password" class="btn btn-primary btn-block">Change Password</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <personal-profile-component :profile="client" :schools="schools"></personal-profile-component>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Program Information</h5>
                            <div class="card-tools">
                                <button class="btn btn-xs btn-primary" data-target="#modal-default" data-toggle="modal">Enroll New Course</button>
                            </div>
                        </div>
                        <div style="overflow: auto;" class="card-body p-0">
                            <table class="table table-sm table-bordered table-striped">
                                <thead class="text-center">
                                    <tr>
                                        <th class="text-left">Program</th>
                                        <th>Course</th>
                                        <th>Status</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Hours Needed</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="p in userPrograms" :key="p.id">
                                        <td class="text-sm">{{ (p.course) ? p.course.name : '' }}</td>
                                        <td class="text-center text-sm">{{ (p.program) ? p.program.name : '' }}</td>
                                        <td class="text-center text-sm text-bold text-green">{{ p.application_status }}</td>
                                        <td class="text-center text-sm">{{ p.start_date }}</td>
                                        <td class="text-center text-sm">{{ p.end_date}}</td>
                                        <td class="text-center text-sm">{{ p.hours_needed }}</td>
                                        <td class="text-center">
                                            <button v-if="p.application_status == 'New Learner'" class="btn btn-success btn-xs" @click="selectedCourse(p)">Edit</button>
                                            <!-- <button v-if="p.application_status == 'New Learner'" class="btn btn-danger btn-xs" @click="removeProgram(p.id)">Delete</button> -->
                                            <i v-else>Not Applicable</i>
                                        </td>
                                    </tr >
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="card-footer">
                            <i class="text-xs">You can't edit course details anymore once you have tagged as <b class="text-green">Confirmed Learner</b>.</i>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Learner's Fees</h5>
                            <div class="card-tools">
                                <button class="btn btn-xs btn-primary" data-target="#modal-choices" data-toggle="modal">Upload Proof of Payment</button>
                            </div>
                        </div>
                        <div style="overflow: auto;" class="card-body p-0">
                            <table class="table table-sm table-bordered table-striped">
                                <thead class="text-center">
                                    <tr>
                                        <th class="text-left">Type</th>
                                        <th>Mode of Payment</th>
                                        <th>Amount</th>
                                        <th>Payment for course</th>
                                        <th>Date Paid</th>
                                        <!-- <th>Date Uploaded</th> -->
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody v-if="payments.length > 0">
                                    <tr v-for="payment in payments" :key="payment.id" class="text-center">
                                        <td class="text-left text-sm">{{ payment.purpose }}</td>
                                        <td class="text-sm">{{ payment.mop }}</td>
                                        <td class="text-sm">{{ payment.amount_paid }}</td>
                                        <td class="text-sm">{{ payment.track.name }}</td>
                                        <td class="text-sm">{{ payment.date_paid }}</td>
                                        <td>
                                            <button v-if="!payment.isVerified" @click="removeDepositSlip(payment.id)" class="btn btn-danger btn-xs">Remove</button>
                                            <i v-else>For sending invitation code</i>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr class="text-center">
                                        <td class="text-sm text-center" colspan="6">No Payment Registered</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <client-initial-requirements></client-initial-requirements>

                </div>
            </div>

            <div class="modal fade show" id="modal-default" aria-modal="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Enroll Program(s)</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Is it your first time enrolling in HIAP Program?</label>
                                <select v-model="form.returnee" class="form-control form-control-sm">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Program</label>
                                <select v-model="form.program_id" class="form-control form-control-sm">
                                    <option selected value="">Select program</option>
                                    <option v-for="program in onlinePrograms" :key="program.id" :value="program.id">{{ program.name }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Course</label>
                                <v-select v-model="form.courses"  label="name" multiple :options="filteredCourse"></v-select>
                            </div>
                            <div class="form-group">
                                <label for="">Hours Needed</label>
                                <input v-model="form.hours_needed" type="text" placeholder="0" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="">Start Date</label>
                                <input v-model="form.start_date" type="date" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="">End Date</label>
                                <input v-model="form.end_date" type="date" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button @click="addNewProgram" type="button" class="btn btn-block btn-sm btn-primary">Enroll</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade show" id="modal-payment" aria-modal="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <div v-if="isUploading" class="overlay d-flex justify-content-center align-items-center">
                            <i class="fas fa-spinner fa-2x fa-pulse"></i>
                        </div>
                        <div class="modal-header">
                            <h5 class="modal-title">Upload Proof of payment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <i>NOTE: Please write your name in your deposit slip/receipt.</i>
                            </div>
                            <div class="form-group">
                                <label for="">Type</label>
                                <select v-model="payment.purpose" class="form-control form-control-sm">
                                    <option selected>Select purpose</option>
                                    <option value="Initial Payment">Initial Payment</option>
                                    <option value="Final Payment">Final Payment</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Payment Method</label>
                                <select v-model="payment.mop" class="form-control form-control-sm">
                                    <option selected>Select payment method</option>
                                    <option value="GCash">GCash</option>
                                    <option value="Bank Online Transfer">Bank Online Transfer</option>
                                    <option value="Bank Deposit">Bank Deposit</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Date Paid</label>
                                <input v-model="payment.date_paid" type="date" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="">Amount Paid</label>
                                <input v-model="payment.amount_paid" type="text" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="">Program Fee</label>
                                <input v-model="payment.program_fee" type="text" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="">Course to be paid</label>
                                <select v-model="payment.course_id" class="form-control form-control-sm">
                                    <option selected>Select payment method</option>
                                    <option v-for="program in userPrograms" :key="program.id" :value="program.id">{{ program.program.name }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Proof of Payment</label>
                                <div class="input-group input-group-sm">
                                    <input @change="fileHandler()" type="file" ref="slip" id="deposit-form" style="display:none">
                                    <input v-model="payment.filename" type="text" class="form-control" disabled>
                                    <span class="input-group-append">
                                        <button @click="browseFile()" class="btn btn-info btn-flat">Browse</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-sm btn-block" @click="addDepositSlip()">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade show" id="modal-choices" aria-modal="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <div v-if="isLoading" class="overlay d-flex justify-content-center align-items-center">
                            <i class="fas fa-spinner fa-2x fa-pulse"></i>
                        </div>
                        <div class="modal-header">
                            <h5>Select Mode</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <button class="btn btn-primary btn-block btn-lg" @click="payBy('student')">Paid By Student</button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-success btn-block btn-lg" @click="payBy('school')">Paid By School</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade show" id="modal-update" aria-modal="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Update Program</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Is it your first time enrolling in HIAP Program?</label>
                                <select v-model="selected.returnee" class="form-control form-control-sm">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Program</label>
                                <select v-model="selected.course_id" class="form-control form-control-sm">
                                    <option selected value="">Select program</option>
                                    <option v-for="program in onlinePrograms" :key="program.id" :value="program.id">{{ program.name }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Course</label>
                                <select class="form-control form-control-sm" v-model="selected.program_id">
                                    <option v-for="course in filteredCourse" :key="course.id" :value="course.id">{{ course.name }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Hours Needed</label>
                                <input v-model="selected.hours_needed" type="text" placeholder="0" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="">Start Date</label>
                                <input v-model="selected.start_date" type="date" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="">End Date</label>
                                <input v-model="selected.end_date" type="date" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button @click="updateProgram" type="button" class="btn btn-block btn-sm btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade show" id="modal-change-password" aria-modal="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Change password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input v-model="changePassForm.current" type="password" :class="(errors.current) ? 'is-invalid' : ''" class="form-control form-control-sm">
                                <i v-if="errors.current" class="text-xs text-danger">{{ errors.current[0] }}</i>
                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input v-model="changePassForm.password" type="password" :class="(errors.password) ? 'is-invalid' : ''" class="form-control form-control-sm">
                                <i v-if="errors.password" class="text-xs text-danger">{{ errors.password[0] }}</i>
                            </div>
                            <div class="form-group">
                                <label for="re_new_password">Retype New Password</label>
                                <input v-model="changePassForm.password_confirmation" type="password" :class="(errors.password_confirmation) ? 'is-invalid' : ''" class="form-control form-control-sm">
                                <i v-if="errors.password_confirmation" class="text-xs text-danger">{{ errors.password_confirmation[0] }}</i>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button @click="updatePassword()" type="button" class="btn btn-block btn-sm btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </client-layout>
</template>

<script>
    import ClientLayout from '../../Layouts/ClientLayout.vue';
    import PersonalProfileComponent from '../../components/PersonalProfileComponent.vue';
    import ClientInitialRequirements from '../../components/ClientInitialRequirement.vue';
    export default {
        props: ['user', 'client', 'userPrograms', 'onlinePrograms', 'payments', 'flash', 'schools', 'errors'],
        components: {
            ClientLayout,
            ClientInitialRequirements,
            PersonalProfileComponent
        },
        data () {
            return {
                programs: [],
                selected: [],
                form: {
                    program_id: 0,
                    courses: [],
                    hours_needed: 0,
                    start_date: '',
                    end_date: '',
                    returnee: false
                },
                payment: {
                    purpose: '',
                    mop: '',
                    date_paid: '',
                    amount_paid: '',
                    program_fee: '',
                    course_id: '',
                    file: '',
                    filename: ''
                },
                changePassForm: {
                    current: '',
                    password: '',
                    password_confirmation: ''
                },
                isUploading: false,
                isLoading: false
            }
        },
        watch: {
            flash: function (value) {
                if(value.message) {
                    toastr.info(value.message);
                }
            },
            errors: function (value) {
                let error = Object.values(value);
                error.forEach(e => {
                    toastr.error(e[0]);
                })
            }
        },
        computed: {
            filteredCourse () {
                return this.programs.filter(e => e.course_id == this.form.program_id || this.selected.program_id);
            }
        },
        mounted () {
            this.getAllPrograms();
        },
        methods: {
            selectedCourse(data) {
                this.selected = data;
                $('#modal-update').modal('show');
            },
            fileHandler() {
                this.payment.file = this.$refs.slip.files[0];
                this.payment.filename = this.payment.file.name;
            },
            getAllPrograms () {
                axios.get('/getAllPrograms')
                    .then((response) => {
                        this.programs = response.data;
                    })
            },
            addNewProgram () {
                this.$inertia.post('/addNewProgram', this.form, {
                    onSuccess: () => {
                        $('#modal-default').modal('hide');
                    }
                })
            },
            updateProgram () {
                this.$inertia.put('/updateUserProgram', this.selected, {
                    onBefore: () => confirm('Update this program?'),
                    onSuccess: () => {
                        this.loadingProgram = false;
                        $('#modal-update').modal('hide');
                    }
                })
            },
            removeProgram (id) {
                this.$inertia.delete(`/deleteUserProgram/${id}`, {
                    onBefore: () => confirm('Remove this program?')
                })
            },
            addDepositSlip () {
                this.isUploading = true;
                this.$inertia.post('/addDepositSlip', this.payment, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                    onSuccess: () => {
                        this.isUploading = false;
                        $('#modal-payment').modal('hide');
                    },
                    onError: () => {
                        this.isUploading = false;
                    }
                })
            },
            removeDepositSlip (id) {
                this.$inertia.delete(`/removeDepositSlip/${id}`, {
                    onBefore: () => confirm('Remove deposit slip?'),
                })
            },
            browseFile () {
                document.getElementById('deposit-form').click();
            },
            payBy (mode) {
                switch(mode) {
                    case 'student':
                        $('#modal-choices').modal('hide');
                        $('#modal-payment').modal('show');
                    break;

                    case 'school':
                        this.isLoading = true;
                        this.$inertia.post('/payBySchool', {}, {
                            onSuccess: () => {
                                this.isLoading = false;
                                $('#modal-choices').modal('hide');
                            }
                        })
                        
                    break;
                }
            },
            updatePassword() {
                this.$inertia.post('/updateUserPassword', this.changePassForm, {
                    onSuccess: (data) => {
                        alert('Password Updated!');
                        this.changePassForm.current = '';
                        this.changePassForm.password = '';
                        this.changePassForm.password_confirmation = '';
                    },
                    onError: errors => {
                        console.log(errors);
                    }
                })
            }
        }
    }
</script>

<style lang="scss" scoped>
    .avatar {
        width: 100%;
        height: 100%;
        border-radius: 100%;
        border: solid 0px gray;
        transition: border-width ease-out 250ms;
        cursor: pointer;
        &:hover {
            border-width: 3px;
        }
    }
</style>
