<template>
    <superadmin-layout>
        <div class="card ">
            <div class="overlay" v-if="loading">
                <i class="fas fa-spinner fa-2x fa-pulse"></i>
            </div>
            <div class="card-header">
                <h5 class="card-title">Moderators</h5>
                <inertia-link href="/sa/moderators/create" class="btn btn-primary btn-sm float-right">Create Moderator</inertia-link>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr class="text-sm text-center">
                            <th class="text-left">First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Email Address</th>
                            <th>Last Known Action</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody v-if="moderators.length > 0">
                        <tr class="text-center text-xs" v-for="moderator in moderators" :key="moderator.id">
                            <td class="text-left">{{ moderator.first_name }}</td>
                            <td>{{ moderator.middle_name }}</td>
                            <td>{{ moderator.last_name }}</td>
                            <td>{{ moderator.user.email }}</td>
                            <td>Nothing</td>
                            <td>
                                <button class="btn btn-primary btn-xs">Logs</button>
                                <button @click="editModerator(moderator.user.id)" class="btn btn-success btn-xs">Edit</button>
                                <button @click="deleteModerator(moderator.user.id)" class="btn btn-danger btn-xs">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr class="text-center text-sm">
                            <td colspan="6">No Moderators Added</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </superadmin-layout>
</template>

<script>
    import SuperadminLayout from '../../Layouts/SuperadminLayout.vue';
    export default {
        props: ['moderators'],
        components: {
            SuperadminLayout
        },
        data () {
            return {
                loading: false,
                moderators: []
            }
        },
        methods: {
            getAllModerators() {
                this.loading = true;
                axios.get('/moderators/all')
                    .then(({data}) => {
                        this.moderators = data;
                        this.loading = false;
                    })
            },
            deleteModerator(userId) {
                this.loading = true;
                this.$inertia.delete(`/moderators/delete/${userId}`)
                    .then((response) => {
                        this.loading = false;
                    })
            },
            editModerator(userId) {
                this.$inertia.visit(`/moderators/edit/${userId}`);
            }
        }
    }
</script>
