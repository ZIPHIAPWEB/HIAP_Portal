
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
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Contact Number</th>
                            <th>School/Organization</th>
                            <th>Enrolled Course(s)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody v-if="filteredClients.length > 0">
                        <tr class="text-xs text-center" v-for="client in filteredClients" :key="client.id">
                            <td class="text-left">{{ client.id }}</td>
                            <td>{{ client.first_name }}</td>
                            <td>{{ client.middle_name}}</td>
                            <td>{{ client.last_name }}</td>
                            <td>{{ client.contact_no }}</td>
                            <td>{{ client.school ? client.school.name : '' }}</td>
                            <th>{{ (client.user_program.length == 1) ? client.user_program[0]['program'].name : client.user_program.length + ' Courses' }}</th>
                            <td>
                                <button @click="viewClientDetails(client.user_id)" class="btn btn-success btn-xs btn-flat">View</button>
                                <button @click="deleteClientDetails(client.user_id)" class="btn btn-danger btn-xs btn-flat">Delete</button>
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
                        return e.last_name.toLowerCase().includes(this.filterName.toLowerCase());
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
