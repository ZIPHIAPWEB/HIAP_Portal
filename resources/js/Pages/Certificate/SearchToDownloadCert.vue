<template>
    <div class="wrapper">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Search</h6>
                <div class="card-tools">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" v-model="search"  placeholder="Search by email">
                        <span class="input-group-append">
                            <button @click="searchByEmail()" class="btn btn-info btn-flat">
                                <span class="fas fa-search"></span>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th class="text-left">Name</th>
                            <th>Date Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody v-if="certs.length > 0">
                        <tr v-for="cert in certs" :key="cert.id" class="text-center">
                            <td class="text-left">{{ cert.full_name }}</td>
                            <td>{{ cert.cert_created_at }}</td>
                            <td>
                                <button @click="downloadCert(cert.id)" class="btn btn-primary btn-xs">Download</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                search: '',
                certs: []
            }
        },
        methods: {
            searchByEmail () {
                axios.post('/getSearchedCertificate', { search: this.search})
                    .then(response => {
                        this.certs = response.data;
                        console.log(response);
                    })
            },
            downloadCert(userId) {
                this.$inertia.post(`/certDownloadActual/${userId}`, {}, {
                    onBefore: () => confirm('Download this certificate?')
                })
            }
        }
    }
</script>

<style lang="scss" scoped>
    .wrapper {
        height: 100vh;
        width: 100%;
        background: rgb(229, 226, 226);

        display: flex;
        align-items: center;
        justify-content: center;

        .card {
            width: 750px;
        }
    }
</style>