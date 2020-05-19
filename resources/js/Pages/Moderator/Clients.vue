
<template>
    <moderator-layout>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="m-0 card-title flex-grow-1">Clients</h5>
                <div>
                    <input type="text" class="form-control form-control-sm mx-auto" v-model="filterName" placeholder="Search by last name">
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr class="text-xs text-center">
                            <th class="text-left">#</th>
                            <th>Application Status</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Program</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody v-if="filteredClients.length > 0">
                        <tr class="text-xs text-center" v-for="client in filteredClients" :key="client.id">
                            <td class="text-left">{{ client.id }}</td>
                            <td>{{ client.application_status }}</td>
                            <td>{{ client.first_name }}</td>
                            <td>{{ client.middle_name}}</td>
                            <td>{{ client.last_name }}</td>
                            <td>{{ client.program.name }}</td>
                            <td>
                                <button @click="viewClientDetails(client.user_id)" class="btn btn-success btn-xs btn-flat">View</button>
                                <button @click="deleteClientDetails(client.user_id)" class="btn btn-danger btn-xs btn-flat">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr class="text-xs text-center">
                            <td colspan="7">No Client Registered</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </moderator-layout>
</template>

<script>
    import ModeratorLayout from '../../Layouts/ModeratorLayout.vue';
    export default {
        props: ['clients'],
        components: {
            ModeratorLayout
        },
        data () {
            return {
                filterName: ''
            }
        },
        computed: {
            filteredClients () {
                    return this.clients.filter(e => {
                        return e.last_name.toLowerCase().includes(this.filterName.toLowerCase());
                    })
                },
        },
        methods: {
            viewClientDetails (userId) {
                this.$inertia.visit(`/md/client/${userId}`);
            },
            deleteClientDetails (userId) {
                this.$inertia.delete(`/deleteClientDetails/${userId}`);
            }
        }
    }
</script>
