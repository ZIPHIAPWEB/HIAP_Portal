<template>
    <superadmin-layout>
        <div class="container">
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
                        <div class="card-body p-0">
                            <table class="table table-hover table-sm">
                                <tbody>
                                    <tr>
                                        <td>Application Status</td>
                                        <td class="text-center">
                                            <select v-model="client.application_status" @change="setApplicationStatus" class="form-control form-control-sm">
                                                <option value="New Applicant">New Applicant</option>
                                                <option value="Requirement Submitted">Requirement Submitted</option>
                                                <option value="Application Processing">Application Processing</option>
                                                <option value="Program Completed">Program Completed</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
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
                                        <td>E-mail Address</td>
                                        <td class="text-center">{{ client.user.email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Program</td>
                                        <td class="text-center">{{ client.program.name }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Initial Requirement</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hovered table-sm">
                                <thead>
                                    <tr class="text-xs text-center">
                                        <th class="text-left">Requirements</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center text-sm" v-for="initial in initials" :key="initial.id">
                                        <td class="text-left">{{ initial.name }}</td>
                                        <td>
                                            <i v-if="initial.client_initial" class="fas fa-check"></i>
                                            <i v-else class="fas fa-times"></i>
                                        </td>
                                        <td>
                                            <span v-if="!initial.client_initial" class="text-sm">No File Uploaded</span>
                                            <div v-else>
                                                <a :href="'/uploads/' + initial.client_initial.file_path" download>Download File</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </superadmin-layout>
</template>

<script>
    import SuperadminLayout from '../../../Layouts/SuperadminLayout.vue';
    export default {
        props: ['client', 'initials'],
        components: {
            SuperadminLayout
        },
        methods: {
            setApplicationStatus(e)
            {
                this.$inertia.post(`/setApplicationStatus/${this.client.user_id}`, { application_status: e.target.value})
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
