<template>
    <superadmin-layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">Staffs</h6>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr class="text-center text-sm">
                                        <th class="text-left">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>School</th>
                                        <th>Position</th>
                                        <th>Contact No.</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="staff in staffs" :key="staff.id" class="text-sm text-center">
                                        <td class="text-left">{{ staff.id }}</td>
                                        <td>{{ staff.name }}</td>
                                        <td>{{ staff.user.email }}</td>
                                        <td>{{ staff.school.name }}</td>
                                        <td>{{ staff.position }}</td>
                                        <td>{{ staff.contact_no }}</td>
                                        <td>
                                            <button @click="activate(staff.user_id)" class="btn btn-success btn-xs">
                                                <span class="fas fa-check"></span>
                                            </button>
                                            <button @click="remove(staff.user_id)" class="btn btn-danger btn-xs">
                                                <span class="fas fa-times"></span>
                                            </button>
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
    import SuperadminLayout from '../../Layouts/SuperadminLayout.vue';
    export default {
        props: ['staffs'],
        components: {
            SuperadminLayout
        },
        methods: {
            activate(userId) {
                this.$inertia.post(`/activateStaff/${userId}`);
            },
            remove(userId) {
                this.$inertia.delete(`/removeStaff/${userId}`);
            }
        }
    }
</script>