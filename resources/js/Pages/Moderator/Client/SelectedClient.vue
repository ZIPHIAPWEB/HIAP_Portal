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
                                        <td>Address</td>
                                        <td class="text-center">{{ client.address }}</td>
                                    </tr>
                                    <tr>
                                        <td>Contact No.</td>
                                        <td class="text-center">{{ client.contact_no }}</td>
                                    </tr>
                                    <tr>
                                        <td>School/Organization</td>
                                        <td class="text-center">{{ client.school.name }}</td>
                                    </tr>
                                    <tr>
                                        <td>E-mail Address</td>
                                        <td class="text-center">{{ client.user.email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Facebook Profile</td>
                                        <td class="text-center"></td>
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
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody v-if="userPrograms.length > 0">
                                    <tr v-for="p in userPrograms" :key="p.id" class="text-xs">
                                        <td>{{ p.course.name }}</td>
                                        <td class="text-center">{{ p.program.name }}</td>
                                        <td class="text-center">
                                            <i class="text-red" v-if="p.application_status == 0">Newly Enrolled</i>
                                            <i class="text-green" v-else>Completed</i>
                                        </td>
                                        <td class="text-center">{{ p.hours_needed }}</td>
                                        <td class="text-center">{{ p.start_date }}</td>
                                        <td class="text-center">{{ p.end_date }}</td>
                                        <td style="width:30%;" class="text-center">
                                            <button @click="UpdateStatus(p)" class="btn btn-xs btn-success">
                                                <i v-if="p.application_status == 0" class="fas fa-check"></i>
                                                <i v-else class="fas fa-redo-alt"></i>
                                            </button>
                                            <!-- <inertia-link :href="`/md/client/${client.user_id}/program/${p.program.id}`" class="btn btn-primary btn-xs">
                                                <i class="fas fa-eye"></i>
                                            </inertia-link> -->
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
    </moderator-layout>
</template>

<script>
    import ModeratorLayout from '../../../Layouts/ModeratorLayout.vue';
    export default {
        props: [
            'client',
            'initials',
            'userPrograms',
            'payments'
        ],
        components: {
            ModeratorLayout
        },
        methods: {
            UpdateStatus(data) {
                let r = confirm('Set application status?');
                
                if(r) {
                    this.$inertia.post(`/setApplicationStatus/${data.id}`, data);
                }
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
