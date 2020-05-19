<template>
    <superadmin-layout>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Logs</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr class="text-center text-xs">
                            <th>#</th>
                            <th>Logs</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </superadmin-layout>
</template>

<script>
    import SuperadminLayout from '../../../Layouts/SuperadminLayout.vue';
    export default {
        components: {
            SuperadminLayout
        }
    }
</script>
