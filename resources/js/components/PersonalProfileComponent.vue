<template>
    <div class="card">
        <div v-if="loading" class="overlay">
            <i class="fas fa-2x fa-spinner fa-pulse"></i>
        </div>
        <div class="card-header d-flex justify-content-between">
            <h5 class="m-0 flex-fill">Learner's Profile</h5>
            <div v-if="!isEdit" >
                <button @click="isEdit = true" class="btn btn-primary btn-xs">Edit</button>
            </div>
            <div v-else>
                <button @click="updateProfileDetails" class="btn btn-success btn-xs">Save</button>
                <button @click="isEdit = false;" class="btn btn-danger btn-xs">Cancel</button>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-striped table-sm">
                <tbody class="tbody-custom">
                    <tr>
                        <td style="width: 45%">First Name</td>
                        <td class="text-left">
                            <strong v-if="!isEdit">{{ client.first_name }}</strong>
                            <input v-model="client.first_name" v-else type="text" class="form-control form-control-sm w-100">
                        </td>
                    </tr>
                    <tr>
                        <td>Middle Name</td>
                        <td class="text-left">
                            <strong v-if="!isEdit">{{ client.middle_name}}</strong>
                            <input v-model="client.middle_name" v-else type="text" class="form-control form-control-sm w-100">
                        </td>
                    </tr>
                    <tr>
                        <td >Last Name</td>
                        <td class="text-left">
                            <strong v-if="!isEdit">{{ client.last_name }}</strong>
                            <input v-model="client.last_name" v-else type="text" class="form-control form-control-sm w-100">
                        </td>
                    </tr>
                    <tr>
                        <td >Course</td>
                        <td class="text-left">
                            <strong v-if="!isEdit">{{ profile.course }}</strong>
                            <input v-model="profile.course" v-else type="text" class="form-control form-control-sm w-100">
                        </td>
                    </tr>
                    <tr>
                        <td>Year Level</td>
                        <td class="text-left">
                            <strong v-if="!isEdit">{{ client.school_year }}</strong>
                            <select v-model="client.school_year" v-else class="form-control form-control sm w-100">
                                <option value="">Select</option>
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
                        <td class="text-left">
                            <strong v-if="!isEdit">{{ client.address }}</strong>
                            <input v-model="client.address" v-else type="text" class="form-control form-control-sm w-100">
                        </td>
                    </tr>
                    <tr>
                        <td>Contact Number</td>
                        <td class="text-left">
                            <strong v-if="!isEdit">{{ client.contact_no }}</strong>
                            <input v-model="client.contact_no" v-else type="text" class="form-control form-control-sm w-100">
                        </td>
                    </tr>
                    <tr>
                        <td>FB Profile Link</td>
                        <td class="text-left">
                            <strong v-if="!isEdit">{{ client.fb_link }}</strong>
                            <input v-model="client.fb_link" v-else type="text" class="form-control form-control-sm w-100">
                        </td>
                    </tr>
                    <tr>
                        <td>School/Organization</td>
                        <td class="text-left">
                            <strong v-if="!isEdit">{{ client.school.name }}</strong>
                            <select v-model="client.school_id" v-else class="form-control form-control sm w-100">
                                <option v-for="school in schools" :key="school.id" :value="school.id">{{ school.name }}</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Expected graduation</td>
                        <td class="text-left">
                            <strong v-if="!isEdit">{{ client.expected_graduation_formatted }}</strong>
                            <input v-model="client.expected_graduation" v-else type="month" class="form-control form-control-sm w-100">
                        </td>
                    </tr>
                    <tr>
                        <td>E-mail Address</td>
                        <td class="text-left">
                            <strong v-if="!isEdit">{{ client.user.email }}</strong>
                            <input v-model="client.user.email" v-else type="text" class="form-control form-control-sm w-100" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>Alternate E-mail Address</td>
                        <td class="text-left">
                            <strong v-if="!isEdit">{{ client.alternate_email }}</strong>
                            <input v-else v-model="client.alternate_email" type="text" class="form-control form-control-sm w-100">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>import { keys } from "../../../public/adminlte/plugins/fullcalendar/locales-all";

    export default {
        props: ['profile', 'schools'],
        data () {
            return {
                isEdit: false,
                loading: false,
            }
        },
        computed: {
            client () {
                return {...this.profile}
            }
        },
        methods: {
            updateProfileDetails () {
                this.loading = true;
                this.$inertia.post('/updateClientDetails', this.client, {
                    onBefore: () => confirm('Update this details?'),
                    onSuccess: () => {
                        this.isEdit = false;
                        this.loading = false;
                    },
                    onError: () => {
                        this.loading = false;
                    }
                });  
            }
        }
    }
</script>
