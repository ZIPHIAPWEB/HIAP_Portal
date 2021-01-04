<template>
    <superadmin-layout>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h6>Insert Data</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h6>Certs</h6>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr class="text-xs text-center">
                                    <th class="text-left">Cert. ID</th>
                                    <th>Name</th>
                                    <th>Program/Track</th>
                                    <th>Gold Medals</th>
                                    <th>Silver Medals</th>
                                    <th>Bronze Medals</th>
                                    <th>Total Grade</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </superadmin-layout>
</template>

<script>
    import SuperadminLayout from '../../Layouts/SuperadminLayout.vue';
    export default {
        components: {
            SuperadminLayout
        }
    }
</script>