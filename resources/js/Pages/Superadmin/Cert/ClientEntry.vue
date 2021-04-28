<template>
    <superadmin-layout>
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Participants Entry</h6>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="saveFile()">
                            <div class="form-group">
                                <input @change="fileHandler" type="file" ref="participants" name="" id="">
                            </div>
                            <div class="form-group">
                                <label>Cert Layout</label>
                                <select v-model="form.layout_id" class="form-control form-control-sm">
                                    <option value="">Select Layout</option>
                                    <option v-for="layout in layouts" :key="layout.id" :value="layout.id">{{ layout.name }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-xs">Add Record</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Participants</h6>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-left">#</th>
                                    <th>Full Name</th>
                                    <th>E-mail</th>
                                    <th>School</th>
                                    <th>Layout</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody v-if="participants.data.length > 0">
                                <tr v-for="participant in participants.data" :key="participant.id" class="text-center">
                                    <td class="text-left">{{ participant.id }}</td>
                                    <td>{{ participant.full_name }}</td>
                                    <td>{{ participant.email }}</td>
                                    <td>{{ participant.school }}</td>
                                    <td>{{ participant.layout.name }}</td>
                                    <td>
                                        <!-- <a :href="`/certClientActual/${participant.id}`" target="_blank" class="btn btn-success btn-xs">View</a> -->
                                        <button @click="downloadCert(participant.id)" class="btn btn-warning btn-xs">Download</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr class="text-center">
                                    <td colspan="6">No Records</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>  
                   <div class="card-footer p-2">
                        <button :disabled="!participants.prev_page_url" @click="prevPage()" class="btn btn-primary btn-xs">Prev</button>
                        <button :disabled="!participants.next_page_url" @click="nextPage()" class="btn btn-primary btn-xs">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </superadmin-layout>    
</template>

<script>
    import SuperadminLayout from '../../../Layouts/SuperadminLayout.vue';
    export default {
        props: [
            'layouts', 'participants'
        ],
        components: {
            SuperadminLayout
        },
        data () {
            return {
                form: {
                    file: '',
                    layout_id: ''
                }
            }
        },
        methods: {
            nextPage() {
                this.$inertia.visit(this.participants.next_page_url);
            },
            prevPage() {
                this.$inertia.visit(this.participants.prev_page_url);
            },
            fileHandler () {
                this.form.file = this.$refs.participants.files[0];
            },
            saveFile () {
                this.$inertia.post('/certClientsAddBulk', this.form, {
                    onBefore: () => confirm('Add this datas?'),
                    onSuccess: () => {
                        toastr.info('Data added.');
                    },
                    onError: () => {
                        toastr.error('Error occured.');
                    }
                })
            },
            downloadCert (id) {
                this.$inertia.get(`/certDownloadActual/${id}`, {
                    onBefore: () => confirm('Download this cert?'),
                    onSuccess: () => {
                        toastr.info('Cert Downloaded');
                    }
                })
            }
        }
    }
</script>