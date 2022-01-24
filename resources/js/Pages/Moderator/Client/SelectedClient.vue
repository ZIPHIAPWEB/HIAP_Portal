<template>
    <moderator-layout>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <img class="avatar" src="https://placeimg.com/480/480/any" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="card">
                        <div class="card-header bg-info d-flex justify-content-between">
                            <h5 class="m-0 flex-fill">Profile</h5>
                            <div v-if="!isEdit" >
                                <button @click="isEdit = true" class="btn btn-primary btn-xs">Edit</button>
                            </div>
                            <div v-else>
                                <button @click="updatePersonalProfile()" class="btn btn-success btn-xs">Update</button>
                                <button @click="isEdit = false;" class="btn btn-danger btn-xs">Cancel</button>
                            </div>
                        </div>  
                        <div class="card-body p-0">
                            <table class="table table-hover table-sm table-bordered">
                                <tbody class="text-sm">
                                    <tr>
                                        <td>First name</td>
                                        <td>
                                            <span v-if="!isEdit" class="text-bold">{{ client.first_name }}</span>
                                            <input v-else type="text" v-model="client.first_name" class="form-control form-control-sm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Middle name</td>
                                        <td>
                                            <span v-if="!isEdit" class="text-bold">{{ client.middle_name }}</span>
                                            <input v-else type="text" v-model="client.middle_name" class="form-control form-control-sm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Last name</td>
                                        <td>
                                            <span v-if="!isEdit" class="text-bold">{{ client.last_name }}</span>
                                            <input v-else type="text" v-model="client.last_name" class="form-control form-control-sm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Course</td>
                                        <td>
                                            <span v-if="!isEdit" class="text-bold">{{ client.course }}</span>
                                            <input v-else type="text" v-model="client.course" class="form-control form-control-sm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Year</td>
                                        <td>
                                            <span v-if="!isEdit" class="text-bold">{{ client.school_year }}</span>
                                            <select v-else v-model="client.school_year" class="form-control form-control-sm">
                                                <option value="">Select Year</option>
                                                <option value="First Year">First Year</option>
                                                <option value="Second Year">Second Year</option>
                                                <option value="Third Year">Third Year</option>
                                                <option value="Fourth Year">Fourth Year</option>
                                                <option value="Graduate">Graduate</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Expected Graduation</td>
                                        <td>
                                            <span v-if="!isEdit" class="text-bold">{{ client.expected_graduation_formatted }}</span>
                                            <input v-else type="month" v-model="client.expected_graduation" class="form-control form-control-sm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>
                                            <span v-if="!isEdit" class="text-bold">{{ client.address }}</span>
                                            <input v-else type="text" v-model="client.address" class="form-control form-control-sm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Contact No.</td>
                                        <td>
                                            <span v-if="!isEdit" class="text-bold">{{ client.contact_no }}</span>
                                            <input v-else type="text" v-model="client.contact_no" class="form-control form-control-sm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>School/Organization</td>
                                        <td>
                                            <span v-if="!isEdit" class="text-bold">{{ client.school ? client.school.name : '' }}</span>
                                            <select v-else v-model="client.school_id" class="form-control form-control-sm text-sm">
                                                <option value="">Select School</option>
                                                <option v-for="school in schools" :key="school.id" :value="school.id">{{ school.name }}</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Facebook Profile</td>
                                        <td>
                                            <a v-if="!isEdit" :href="client.fb_link">{{ client.fb_link }}</a>
                                            <input v-else v-model="client.fb_link" type="text" class="form-control form-control-sm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>E-mail Address</td>
                                        <td>
                                            <span v-if="!isEdit" class="text-bold">{{ client.user.email }}</span>
                                            <input v-else type="text" v-model="client.user.email" disabled class="form-control form-control-sm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Alternate E-mail Address</td>
                                        <td>
                                            <span v-if="!isEdit" class="text-bold">{{ client.alternate_email }}</span>
                                            <input v-else type="text" v-model="client.alternate_email" class="form-control form-control-sm">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-info">
                            <h5 class="card-title">Enrolled Programs</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hovered table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Program</th>
                                        <th class="text-center">Courses</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Hours Needed</th>
                                        <th class="text-center">Start Date</th>
                                        <th class="text-center">End Date</th>
                                        <th class="text-center">Enrolled Since</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody v-if="userPrograms.length > 0">
                                    <tr v-for="p in userPrograms" :key="p.id" class="text-sm">
                                        <td>{{ p.course.name }}</td>
                                        <td class="text-center">{{ p.program.name }}</td>
                                        <td class="text-center">
                                            <select @change="updateStatus" v-model="p.application_status" :dataid="p.id" class="form-control form-control-sm">
                                                <option value="New Learner">New Learner</option>
                                                <option value="Confirmed Learner">Confirmed Learner</option>
                                                <option value="Complete Learner">Complete Learner</option>
                                                <option value="Cancelled Learner">Cancelled Learner</option>
                                                <option value="Not Enrolled">Not Enrolled</option>
                                            </select>
                                            <!-- <i class="text-red" v-if="p.application_status == 0">Newly Enrolled</i>
                                            <i class="text-green" v-else>Completed</i> -->
                                        </td>
                                        <td class="text-center">{{ p.hours_needed }}</td>
                                        <td class="text-center">{{ p.start_date }}</td>
                                        <td class="text-center">{{ p.end_date }}</td>
                                        <td class="text-center text-bold">{{ p.created_at }}</td>
                                        <td class="text-center ">
                                            <button @click="editProgram(p)" class="btn btn-success btn-xs">Edit</button>
                                            <button @click="deleteUserProgram(p.id)" class="btn-danger btn-xs">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td colspan="8" class="text-center text-sm">Not enrolled in any program</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-info">
                            <h5 class="card-title">Payment</h5>
                            <div class="card-tools">
                                <button class="btn btn-xs btn-primary" data-target="#modal-choices" data-toggle="modal">Upload Proof of Payment</button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-sm table-bordered table-striped">
                                <thead class="text-center">
                                    <tr>
                                        <th class="text-left">Type</th>
                                        <th>Mode of Payment</th>
                                        <th>Amount</th>
                                        <th>Payment for course</th>
                                        <th>Date Paid</th>
                                        <th>Paid By</th>
                                        <th>Date Uploaded</th>
                                        <th>Verified</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody v-if="payments.length > 0">
                                    <tr v-for="payment in payments" :key="payment.id" class="text-center">
                                        <td class="text-left text-sm">{{ payment.purpose }}</td>
                                        <td class="text-sm">{{ payment.mop }}</td>
                                        <td class="text-sm">{{ payment.amount_paid }}</td>
                                        <td class="text-sm">{{ payment.track.name }} </td>
                                        <td class="text-s">{{ payment.date_paid }}</td>
                                        <td class="text-sm">{{ payment.paid_from }}</td>
                                        <td class="text-sm">{{ payment.created_at }}</td>
                                        <td class="text-sm">
                                            <i v-if="payment.isVerified" class="fas fa-check text-green"></i>
                                            <i v-else class="fas fa-times text-red"></i>
                                        </td>
                                        <td class="text-sm">
                                            <a v-if="payment.path != ''" :href="payment.path" class="btn btn-primary btn-xs" target="_blank">View</a>
                                            <span v-else>No file to view</span>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr class="text-center">
                                        <td class="text-sm text-center" colspan="9">No Payment Registered</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-info">
                            <h5>Program Requirements</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hovered table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th style="width: 50%;">Requirements</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Value</th>
                                    </tr>
                                </thead>
                                <tbody v-if="initials.length > 0">
                                    <tr v-for="initial in initials" :key="initial.id">
                                        <td>{{ initial.name }}</td>
                                        <td class="text-center">
                                            <i v-if="initial.client_initial.status" class="fas fa-check text-green"></i>
                                            <i v-else class="fas fa-times text-red"></i>
                                        </td>
                                        <td class="text-center">
                                            <template v-if="initial.client_initial.status">
                                                <a v-if="initial.type === 'file'" :href="initial.client_initial.file_path" download="" class="btn btn-primary btn-xs">Download</a>
                                                <i v-else>{{ initial.client_initial.file_path }}</i>
                                            </template>
                                            <i v-else class="text-sm">Not Applicable</i>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td colspan="3" class="text-center">No Requirements</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade show" id="modal-default" aria-modal="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Selected Program</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Program</label>
                            <select v-model="selectedProgram.course_id" name="" id="" class="form-control form-control-xs">
                                <option value="">Select</option>
                                <option v-for="program in online_programs" :key="program.id" :value="program.id">{{ program.name }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Course</label>
                            <select v-model="selectedProgram.program_id" name="" id="" class="form-control form-control-xs">
                                <option value="">Select</option>
                                <option v-for="course in courses" :key="course.id" :value="course.id">{{ course.name }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Application Status</label>
                            <select v-model="selectedProgram.application_status" name="" id="" class="form-control form-control-xs">
                                <option value="">Select</option>
                                <option value="New Learner">New Learner</option>
                                <option value="Confirmed Learner">Confirmed Learner</option>
                                <option value="Complete Learner">Complete Learner</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Start Date</label>
                            <input v-model="selectedProgram.start_date" type="date" class="form-control form-control-xs">
                        </div>
                        <div class="form-group">
                            <label for="">End Date</label>
                            <input v-model="selectedProgram.end_date" type="date" class="form-control form-control-xs">
                        </div>
                        <div class="form-group">
                            <label for="">No. of Hours</label>
                            <input v-model="selectedProgram.hours_needed" type="number" class="form-control form-control-xs">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button @click="updateUserProgram()" class="btn btn-primary btn-block">Update</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade show" id="modal-payment" aria-modal="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
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
                                <label for="">Proof of Payment</label>
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
    </moderator-layout>
</template>

<script>
    import ModeratorLayout from '../../../Layouts/ModeratorLayout.vue';
    export default {
        props: [
            'selectedClient',
            'initials',
            'userPrograms',
            'payments',
            'schools',
            'online_programs',
            'courses'
        ],
        data () {
            return {
                isEdit: false,
                isLoading: false,
                selectedProgram: [],
                payment: {
                    purpose: '',
                    file: '',
                    filename: ''
                },
                isUploading: false
            }
        },
        components: {
            ModeratorLayout
        },
        computed: {
            client () {
                return {...this.selectedClient};
            }
        },
        watch: {
            flash: function (value) {
                toastr.info(value.message);
            }
        },
        methods: {
            updateStatus(e) {
                this.$inertia.post(`/setApplicationStatus/${e.target.getAttribute('dataid')}`, { status : e.target.value}, {
                    onBefore: () => confirm('Set application status?'),
                    onSuccess: () => {
                        toastr.info(`Application status set to ${e.target.value}`);
                    }
                })
            },
            updateUserProgram() {
                this.loadingProgram = true;
                this.$inertia.put('/updateUserProgram', this.selectedProgram, {
                    onBefore: () => confirm('Update this program?'),
                    onSuccess: () => {
                        this.loadingProgram = false;
                        $('#modal-default').modal('hide');
                        toastr.info('Selected program updated.');
                    }
                })
            },
            deleteUserProgram(programId) {
                this.$inertia.delete(`/deleteUserProgram/${programId}`, {
                    onBefore: () => confirm('Delete this program?'),
                    onSuccess: () => {
                        toastr.info('Selected program deleted.')
                    }
                })
            },
            editProgram(data) {
                this.selectedProgram = data;
                $('#modal-default').modal('show');
            },
            addDepositSlip () {
                this.isUploading = true;
                let formData = new FormData();
                formData.append('purpose', this.payment.purpose);
                formData.append('file', this.payment.file);
                formData.append('client_id', this.client.user_id);
                this.$inertia.post('/addDepositSlip', formData, {
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
            updatePersonalProfile () {
                this.loading = true;
                this.$inertia.post('/updateClientDetails', this.client, {
                    onBefore: () => confirm('Update this details?'),
                    onSuccess: () => {
                        this.isEdit = false;
                        this.loading = false;
                    },
                    onError: () => {
                        this.isEdit = false;
                        this.loading = false;
                        toastr.error('An error has occured.');
                    }
                });  
            },
            payBy (mode) {
                switch(mode) {
                    case 'student':
                        $('#modal-choices').modal('hide');
                        $('#modal-payment').modal('show');
                    break;

                    case 'school':
                        this.isLoading = true;
                        this.$inertia.post('/payBySchool', { client_id: this.client.user_id }, {
                            onSuccess: () => {
                                this.isLoading = false;
                                $('#modal-choices').modal('hide');
                            }
                        })
                        
                    break;
                }
            },
            fileHandler() {
                this.payment.file = this.$refs.slip.files[0];
                this.payment.filename = this.payment.file.name;
            },
            browseFile () {
                document.getElementById('deposit-form').click();
            },
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
