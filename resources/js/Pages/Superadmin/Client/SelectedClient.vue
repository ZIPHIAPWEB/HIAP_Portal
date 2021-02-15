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
                        <div class="card-header bg-info">
                            <h5 class="card-title">Personal Profile</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-sm">
                                <tbody class="text-sm">
                                    <tr>
                                        <td>First name</td>
                                        <td class="text-center">{{ client.first_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Middle name</td>
                                        <td class="text-center">{{ client.middle_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Last name</td>
                                        <td class="text-center">{{ client.last_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Course</td>
                                        <td class="text-center">{{ client.course }}</td>
                                    </tr>
                                    <tr>
                                        <td>Year</td>
                                        <td class="text-center">{{ client.school_year }}</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td class="text-center">{{ client.address }}</td>
                                    </tr>
                                    <tr>
                                        <td>Contact No.</td>
                                        <td class="text-center">{{ client.contact_no }}</td>
                                    </tr>
                                    <tr>
                                        <td>School/Organization</td>
                                        <td class="text-center">{{ client.school ? client.school.name : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>E-mail Address</td>
                                        <td class="text-center">{{ client.user.email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Facebook Profile</td>
                                        <td class="text-center">
                                            <a :href="client.fb_link">{{ client.fb_link }}</a>
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
                                        <th>Course</th>
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
                                        <td>{{ p.program.name }}</td>
                                        <th class="text-center">{{ p.course.name }}</th>
                                        <td class="text-center">
                                            <i class="text-green">{{ p.application_status }}</i>
                                        </td>
                                        <td class="text-center">{{ p.start_date }}</td>
                                        <td class="text-center">{{ p.end_date }}</td>
                                        <td class="text-center">{{ p.hours_needed }}</td>
                                        <td style="width:30%;" class="text-center">
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
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
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
            'online_programs'
        ],
        data () {
            return {
                selectedProgram: [],
                loadingProgram: false
            }
        },
        components: {
            SuperadminLayout
        },
        methods: {
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
