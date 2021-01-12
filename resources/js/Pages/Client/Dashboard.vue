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
                </div>
                <div class="col-md-9">
                    <personal-profile-component :profile="client"></personal-profile-component>
                    <!-- <client-initial-requirements></client-initial-requirements> -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">My Courses</h5>
                            <div class="card-tools">
                                <button class="btn btn-xs btn-primary" data-target="#modal-default" data-toggle="modal">Enroll New Course</button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-sm table-bordered table-striped">
                                <thead class="text-center">
                                    <tr>
                                        <th class="text-left">Program</th>
                                        <th>Course</th>
                                        <th>Status</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <!-- <th style="width: 30%">Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="p in userPrograms" :key="p.id">
                                        <td class="text-sm">{{ p.course.name }}</td>
                                        <td class="text-center text-sm">{{ p.program.name }}</td>
                                        <td class="text-center text-sm text-bold">
                                            <i class="text-danger" v-if="p.application_status">Newly Enrolled</i>
                                            <i class="text-success" v-else>Complete</i>
                                        </td>
                                        <td class="text-center text-sm">{{ p.start_date }}</td>
                                        <td class="text-center text-sm">{{ p.end_date}}</td>
                                        <!-- <td class="text-center">
                                            <inertia-link :href="`/client/${p.program.id}/requirements`" class="btn btn-xs btn-success">View Requirements</inertia-link>
                                        </td> -->
                                    </tr >
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">My Payments</h5>
                            <div class="card-tools">
                                <button class="btn btn-xs btn-primary" data-target="#modal-payment" data-toggle="modal">Upload Deposit Slip</button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-sm table-bordered table-striped">
                                <thead class="text-center">
                                    <tr>
                                        <th class="text-left">Type</th>
                                        <th>Date Uploaded</th>
                                        <th>Verified</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody v-if="payments.length > 0">
                                    <tr v-for="payment in payments" :key="payment.id" class="text-center">
                                        <td class="text-left text-sm">{{ payment.purpose }}</td>
                                        <td class="text-sm">{{ payment.created_at }}</td>
                                        <td class="text-sm">
                                            <i v-if="payment.isVerified" class="fas fa-check text-green"></i>
                                            <i v-else class="fas fa-times text-red"></i>
                                        </td>
                                        <td>
                                            <button v-if="!payment.isVerified" @click="removeDepositSlip(payment.id)" class="btn btn-danger btn-xs">Remove</button>
                                            <i v-else>Not Applicable</i>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr class="text-center">
                                        <td class="text-sm text-center" colspan="4">No Payment Registered</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <div class="modal fade show" id="modal-payment" aria-modal="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                        <div v-if="isUploading" class="overlay d-flex justify-content-center align-items-center">
                            <i class="fas fa-spinner fa-2x fa-pulse"></i>
                        </div>
                        <div class="modal-header">
                            <h5 class="modal-title">Upload Deposit Slip</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Type</label>
                                <select v-model="payment.purpose" class="form-control form-control-sm">
                                    <option selected>Select purpose</option>
                                    <option value="Initial Payment (60%)">Initial Payment (60%)</option>
                                    <option value="Second Payment (40%)">Second Payment (40%)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Deposit Slip</label>
                                <div class="input-group input-group-sm">
                                    <input @change="fileHandler()" type="file" ref="slip" id="deposit-form" style="display:none">
                                    <input v-model="payment.filename" type="text" disabled>
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
        </div>
    </client-layout>
</template>

<script>
    import ClientLayout from '../../Layouts/ClientLayout.vue';
    import PersonalProfileComponent from '../../components/PersonalProfileComponent.vue';
    import ClientInitialRequirements from '../../components/ClientInitialRequirement.vue';
    export default {
        props: ['user', 'client', 'userPrograms', 'onlinePrograms', 'payments'],
        components: {
            ClientLayout,
            ClientInitialRequirements,
            PersonalProfileComponent
        },
        data () {
            return {
                programs: [],
                form: {
                    program_id: 0,
                    courses: [],
                    hours_needed: 0,
                    start_date: '',
                    end_date: ''
                },
                payment: {
                    purpose: '',
                    file: '',
                    filename: ''
                },
                isUploading: false
            }
        },
        computed: {
            filteredCourse () {
                return this.programs.filter(e => e.course_id == this.form.program_id);
            }
        },
        mounted () {
            this.getAllPrograms();
        },
        methods: {
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
                this.$inertia.post('/addNewProgram', this.form)
                    .then((response) => {
                        $('#modal-default').modal('hide');
                    })
            },
            addDepositSlip () {
                this.isUploading = true;
                let formData = new FormData();
                formData.append('purpose', this.payment.purpose);
                formData.append('file', this.payment.file);
                this.$inertia.post('/addDepositSlip', formData)
                    .then((response) => {
                        this.isUploading = false;
                        $('#modal-payment').modal('hide');
                    })
            },
            removeDepositSlip (id) {
                let r = confirm('Remove deposit slip?');

                if(r == true) {
                    this.$inertia.delete(`/removeDepositSlip/${id}`)
                    .then((response) => {
                        tostr.info('Deposit slip deleted.');
                    })
                }
            },
            browseFile () {
                document.getElementById('deposit-form').click();
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
