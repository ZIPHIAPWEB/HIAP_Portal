<template>
    <superadmin-layout>
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
                                <button @click="updateProfileDetails" class="btn btn-success btn-xs">Update</button>
                                <button @click="isEdit = false;" class="btn btn-danger btn-xs">Cancel</button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-sm table-bordered">
                                <tbody class="text-sm">
                                    <tr>
                                        <td>First name</td>
                                        <td class="text-center">
                                            <span v-if="!isEdit" class="text-bold">{{ client.first_name }}</span>
                                            <input v-else type="text" v-model="client.first_name" class="form-control form-control-sm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Middle name</td>
                                        <td class="text-center">
                                            <span v-if="!isEdit" class="text-bold">{{ client.middle_name }}</span>
                                            <input v-else type="text" v-model="client.middle_name" class="form-control form-control-sm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Last name</td>
                                        <td class="text-center">
                                            <span v-if="!isEdit" class="text-bold">{{ client.last_name }}</span>
                                            <input v-else type="text" v-model="client.last_name" class="form-control form-control-sm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Course</td>
                                        <td class="text-center">
                                            <span v-if="!isEdit" class="text-bold">{{ client.course }}</span>
                                            <input v-else type="text" v-model="client.course" class="form-control form-control-sm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Year</td>
                                        <td class="text-center">
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
                                        <td>Address</td>
                                        <td class="text-center">
                                            <span v-if="!isEdit" class="text-bold">{{ client.address }}</span>
                                            <input v-else type="text" v-model="client.address" class="form-control form-control-sm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Contact No.</td>
                                        <td class="text-center">
                                            <span v-if="!isEdit" class="text-bold">{{ client.contact_no }}</span>
                                            <input v-else type="text" v-model="client.contact_no" class="form-control form-control-sm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>School/Organization</td>
                                        <td class="text-center">
                                            <span v-if="!isEdit" class="text-bold">{{ client.school ? client.school.name : '' }}</span>
                                            <select v-else v-model="client.school_id" class="form-control form-control-sm text-sm">
                                                <option value="">Select School</option>
                                                <option v-for="school in schools" :key="school.id" :value="school.id">{{ school.name }}</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Facebook Profile</td>
                                        <td class="text-center">
                                            <a v-if="!isEdit" :href="client.fb_link">{{ client.fb_link }}</a>
                                            <input v-else v-model="client.fb_link" type="text" class="form-control form-control-sm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>E-mail Address</td>
                                        <td class="text-center">
                                            <span v-if="!isEdit" class="text-bold">{{ client.user.email }}</span>
                                            <input v-else type="text" v-model="client.user.email" disabled class="form-control form-control-sm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Alternate E-mail Address</td>
                                        <td class="text-center">
                                            <span v-if="!isEdit" class="text-bold">{{ client.alternate_email }}</span>
                                            <input v-else type="text" v-model="client.alternate_email" class="form-control form-control-sm">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    
                    <div class="card">
                        <div class="card-header bg-info d-flex justify-content-between">
                            <h5 class="m-0 flex-fill">Enrolled Programs</h5>
                            <div>
                                <button data-toggle="modal" data-target="#modal-added" class="btn btn-primary btn-xs">Add Program</button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hovered table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Course</th>
                                        <th class="text-center">Program</th>
                                        <th class="text-center">Application Status</th>
                                        <th class="text-center">Start Date</th>
                                        <th class="text-center">End Date</th>
                                        <th class="text-center">Hours Needed</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody v-if="userPrograms.length > 0">
                                    <tr v-for="p in userPrograms" :key="p.id" class="text-xs">
                                        <td>{{ p.id }}</td>
                                        <td class="text-center">{{ p.program.name }}</td>
                                        <th class="text-center">{{ p.course.name }}</th>
                                        <td class="text-center">
                                            <i class="text-green">{{ p.application_status }}</i>
                                        </td>
                                        <td class="text-center">{{ p.start_date }}</td>
                                        <td class="text-center">{{ p.end_date }}</td>
                                        <td class="text-center">{{ p.hours_needed }}</td>
                                        <td style="width:15%;" class="text-center">
                                            <!-- <inertia-link :href="`/sa/client/${client.user_id}/program/${p.program.id}`" class="btn btn-primary btn-xs">View Records</inertia-link> -->
                                            <button @click="editProgram(p)" class="btn btn-success btn-xs">Edit</button>
                                            <button @click="removeProgram(p.id)" class="btn btn-danger btn-xs">Remove</button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td colspan="3" class="text-center text-sm">Not enrolled in any program</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-info">
                            <h5 class="card-title">Payment</h5>
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
                                            <a :href="payment.path" class="btn btn-primary btn-xs" target="_blank">View</a>
                                            <button @click="removeDepositSlip(payment.id)" class="btn btn-danger btn-xs">Remove</button>
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
        </div>
        <div class="modal fade show" id="modal-added" aria-modal="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Program</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Program</label>
                            <select v-model="toBeAdded.program_id" name="" id="" class="form-control form-control-xs">
                                <option value="">Select</option>
                                <option v-for="program in online_programs" :key="program.id" :value="program.id">{{ program.name }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Course</label>
                            <select v-model="toBeAdded.course_id" name="" id="" class="form-control form-control-xs">
                                <option value="">Select</option>
                                <option v-for="course in courses" :key="course.id" :value="course.id">{{ course.name }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Application Status</label>
                            <select v-model="toBeAdded.application_status" name="" id="" class="form-control form-control-xs">
                                <option value="">Select</option>
                                <option value="New Learner">New Learner</option>
                                <option value="Confirmed Learner">Confirmed Learner</option>
                                <option value="Complete Learner">Complete Learner</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Start Date</label>
                            <input v-model="toBeAdded.start_date" type="date" class="form-control form-control-xs">
                        </div>
                        <div class="form-group">
                            <label for="">End Date</label>
                            <input v-model="toBeAdded.end_date" type="date" class="form-control form-control-xs">
                        </div>
                        <div class="form-group">
                            <label for="">No. of Hours</label>
                            <input v-model="toBeAdded.hours_needed" type="number" class="form-control form-control-xs">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button @click="addProgram()" class="btn btn-primary btn-block">Add</button>
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
    </superadmin-layout>
</template>

<script>
    import SuperadminLayout from '../../../Layouts/SuperadminLayout.vue';
    export default {
        props: [
            'client',
            'initials',
            'userPrograms',
            'payments',
            'courses',
            'online_programs',
            'schools'
        ],
        data () {
            return {
                toBeAdded: {
                    user_id: this.client.user_id,
                    program_id: '',
                    course_id: '',
                    application_status: '',
                    start_date: '',
                    end_date: '',
                    hours_needed: ''
                },
                selectedProgram: [],
                loadingProgram: false,
                isEdit: false,
                loading: false
            }
        },
        components: {
            SuperadminLayout
        },
        methods: {
            addProgram () {
                this.loading = true;
                this.$inertia.post('/addClientUserProgram', this.toBeAdded, {
                    onBefore: () => confirm('Save this details.'),
                    onSuccess: () => {
                        this.loading = false;
                        $('#modal-added').modal('hide');
                        toastr.success('Program track has been added.');
                    },
                    onError: () => {
                        this.loading = false;
                        toastr.error('An error has occured.')
                    }
                })
            },
            updateProfileDetails () {
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
            editProgram(data) {
                this.selectedProgram = data;
                $('#modal-default').modal('show');
                console.log(data)
            },
            updateUserProgram()
            {
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
            removeProgram (id) {
                this.$inertia.delete(`/deleteUserProgram/${id}`, {
                    onBefore: () => confirm('Remove this program?')
                })
            } ,
            removeDepositSlip (id) {
                let r = confirm('Remove deposit slip?');

                if(r == true) {
                    this.$inertia.delete(`/removeDepositSlip/${id}`, {
                        onSuccess: () => {
                            tostr.info('Deposit slip deleted.');
                        }
                    })
                }
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
