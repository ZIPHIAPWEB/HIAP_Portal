<template>
    <superadmin-layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table table-hover table-sm">
                                <tbody>
                                    <tr>
                                        <td>Application Status</td>
                                        <td class="text-center">
                                            <select v-model="userProgram.application_status" @change="setApplicationStatus" class="form-control form-control-sm">
                                                <option value="Newly Registered">Newly Registered</option>
                                                <option value="Confirmed Learner">Confirmed Learner</option>
                                                <option value="On-going Learner">On-going Learner</option>
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
                                            <i v-if="initial.client_initial" class="text-success fas fa-check"></i>
                                            <i v-else class="text-danger fas fa-times"></i>
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
        props: ['programId', 'initials', 'userProgram'],
        components: {
            SuperadminLayout
        },
        methods: {
            setApplicationStatus(e)
            {
                this.$inertia.post(`/setApplicationStatus/${this.userProgram.user_id}`, 
                    {
                        application_status: e.target.value,
                        program_id: this.userProgram.program_id
                    })
            }
        }
    }
</script>