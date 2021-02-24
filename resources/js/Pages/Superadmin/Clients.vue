
<template>
    <superadmin-layout>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="m-0 card-title flex-grow-1">Enrollees</h5>
                <div>
                    <input type="text" class="form-control form-control-sm mx-auto" v-model="filterName" placeholder="Search by last name">
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr class="text-xs text-center">
                            <th class="text-left">#</th>
                            <th>Email</th>
                            <th>Is Verified</th>
                            <th>Is Filled</th>
                            <th>Has Client Record</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody v-if="filteredClients.length > 0">
                        <tr class="text-xs text-center" v-for="client in filteredClients" :key="client.id">
                            <td class="text-left">{{ client.id }}</td>
                            <td>{{ client.email }}</td>
                            <td>
                                <span v-if="client.email_verified_at" class="fas fa-check text-green"></span>
                                <span v-else class="fas fa-times text-red"></span>
                            </td>
                            <td>
                                <span v-if="client.isFilled" class="fas fa-check text-green"></span>
                                <span v-else class="fas fa-times text-red"></span>
                            </td>
                            <td>
                                <span v-if="client.client" class="fas fa-check text-green"></span>
                                <span v-else class="fas fa-times text-red"></span>
                            </td>
                            <th>{{ client.created_at }}</th>
                            <td>
                                <button v-if="client.client" @click="viewClientDetails(client.id)" class="btn btn-success btn-xs btn-flat">View</button>
                                <button @click="deleteClientDetails(client.id)" class="btn btn-danger btn-xs btn-flat">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr class="text-xs text-center">
                            <td colspan="6">No Client Registered</td>
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
        props: ['clients'],
        components: {
            SuperadminLayout
        },
        data () {
            return {
                filterName: ''
            }
        },
        computed: {
            filteredClients () {
                    return this.clients.filter(e => {
                        return e.email.toLowerCase().includes(this.filterName.toLowerCase());
                    })
                },
        },
        watch: {
            flash: function (value) {
                toastr.info(value.message)
            }
        },
        methods: {
            viewClientDetails (userId) {
                this.$inertia.visit(`/sa/client/${userId}`);
            },
            deleteClientDetails (userId) {
                this.$inertia.delete(`/deleteClientDetails/${userId}`, {
                    onBefore: () => confirm("Are you sure to delete this record?"),
                    onSuccess: () => {
                        tostr.info('Client details deleted.');
                    }
                });
            }
        }
    }
</script>
