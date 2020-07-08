<template>
    <superadmin-layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">General Logs</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr class="text-center text-xs">
                                        <th class="text-left">#</th>
                                        <th>User</th>
                                        <th>Role</th>
                                        <th>Log</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody v-if="logs.length > 0">
                                    <tr class="text-center text-xs" v-for="log in logs" :key="log.id">
                                        <td class="text-left">{{ log.id }}</td>
                                        <td>{{ log.user.email }}</td>
                                        <td>{{ log.user.role }}</td>
                                        <td>{{ log.action }}</td>
                                        <td>
                                            <button @click="deleteLog(log.id)" class="btn btn-danger btn-xs">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr class="text-center text-xs">
                                        <td colspan="4">No logs registered</td>
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
        props: ['logs'],
        components: {
            SuperadminLayout
        },
        methods: {
            deleteLog(logId) {
                var r = confirm('Delete this log?');

                if(r) {
                    this.$inertia.delete(`/logs/delete/${logId}`);
                }
            }
        }
    }
</script>
