<template>
    <moderator-layout>
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Certs</h6>
                <div class="card-tools">
                        <div class="input-group input-group-sm">
                        <input @keypress.enter="searchByNameOrCertId()" type="text" class="form-control" v-model="search"  placeholder="Search by cert id/name">
                        <span class="input-group-append">
                            <button @click="searchByNameOrCertId()" class="btn btn-info btn-flat">
                                <span class="fas fa-search"></span>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover">
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
                            <th>Total Medals</th>
                            <th>Proficiency</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-xs text-center" v-for="cert in sCerts.data" :key="cert.id">
                            <td class="text-left">{{ cert.cert_no }}</td>
                            <td>{{ cert.name }}</td>
                            <td>{{ cert.school }}</td>
                            <td>{{ cert.program }}</td>
                            <td>{{ cert.gold_medal }}</td>
                            <td>{{ cert.silver_medal }}</td>
                            <td>{{ cert.bronze_medal }}</td>
                            <td class="text-bold">{{ cert.total_grade }}</td>
                            <td class="text-bold">{{ cert.total_medal }}</td>
                            <td>{{ cert.proficiency }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer p-2">
                <button :disabled="!certs.prev_page_url" @click="prevPage()" class="btn btn-primary btn-xs">Prev</button>
                <button :disabled="!certs.next_page_url" @click="nextPage()" class="btn btn-primary btn-xs">Next</button>
            </div>
        </div>
    </moderator-layout>
</template>

<script>
    import ModeratorLayout from '../../Layouts/ModeratorLayout.vue';

    export default {
        props: ['certs'],
        components: {
            ModeratorLayout
        },
        data () {
            return {
                search: '',
                sCerts: this.certs,
            }
        },
        methods: {
            prevPage() {
                this.$inertia.visit(this.certs.prev_page_url, { preserveScroll: true });
            },
            nextPage() {
                this.$inertia.visit(this.certs.next_page_url, { preserveScroll: true });
            },
            searchByNameOrCertId() {
                let formData = new FormData();
                formData.append('search', this.search);
                axios.post('/searchLobsterInkCertificate', formData)
                    .then((response) => {
                        this.sCerts = response.data
                    })
            },
        }
    }
</script>