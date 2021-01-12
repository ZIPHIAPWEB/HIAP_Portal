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
                            <input @change="fileHandler" type="file" ref="cert" name="" id="">
                            <button @click="saveFile">Save</button>
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
                                    <th>School</th>
                                    <th>Program/Track</th>
                                    <th>Gold Medals</th>
                                    <th>Silver Medals</th>
                                    <th>Bronze Medals</th>
                                    <th>Total Grade</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-xs text-center" v-for="cert in certs" :key="cert.id">
                                    <td class="text-left">{{ cert.cert_no }}</td>
                                    <td>{{ cert.name }}</td>
                                    <td>{{ cert.school }}</td>
                                    <td>{{ cert.program }}</td>
                                    <td>{{ cert.gold_medal }}</td>
                                    <td>{{ cert.silver_medal }}</td>
                                    <td>{{ cert.bronze_medal }}</td>
                                    <td class="text-bold">{{ cert.total_grade }}</td>
                                    <td>
                                        <button @click="deleteFile(cert.id)" class="btn btn-danger btn-xs">
                                            <span class="fas fa-trash"></span>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
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
        props: ['certs'],
        components: {
            SuperadminLayout
        },
        data () {
            return {
                form: {
                    file: ''
                }
            }
        },
        methods : {
            fileHandler () {
                this.form.file = this.$refs.cert.files[0];
            },
            saveFile () {
                let formData = new FormData();
                formData.append('file', this.form.file);
                this.$inertia.post('/uploadCertificate', formData);
            },
            deleteFile (id) {
                let q = confirm('Delete this certificate?');
                
                if (q) {
                    this.$inertia.delete(`/deleteCertificate/${id}`);
                }
            }
        }
    }
</script>