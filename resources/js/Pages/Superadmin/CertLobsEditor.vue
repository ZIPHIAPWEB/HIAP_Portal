<template>
    <superadmin-layout>
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <div v-if="isLoading" class="overlay d-flex justify-content-center align-items-center">
                        <i class="fas fa-spinner fa-2x fa-pulse"></i>
                    </div>
                    <div class="card-header">
                        <h5 class="card-title">Create Template</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" v-model="form.name" class="form-control form-control-sm" placeholder="Sample Name">
                        </div>
                        <div class="form-group">
                            <label>Styles</label>
                            <v-select v-model="form.styles" label="name" multiple :options="styles"></v-select>
                        </div>
                        <div class="form-group">
                            <label>Template</label>
                            <div><input @change="fileHandler()" ref="img" type="file"></div>
                        </div>
                        <div class="form-group">
                            <button v-if="!isEdit" class="btn btn-primary btn-sm" @click="saveTemplate()">Add Template</button>
                            <div v-else>
                                <button class="btn btn-success btn-sm" @click="updateTemplate()">Update</button>
                                <button class="btn btn-danger btn-sm" @click="isEdit = false">Cancel Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Layouts</h5>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-sm">
                            <thead >
                                <tr class="text-center">
                                    <th class="text-left">#</th>
                                    <th>Layout Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center text-xs" v-for="layout in layouts.data" :key="layout.id">
                                    <td class="text-left">{{ layout.id }}</td>
                                    <td>{{ layout.name }}</td>
                                    <td class="text-center">
                                        <button @click="viewLayout(layout.id)" class="btn btn-success btn-xs">View</button>
                                        <button @click="editTemplate(layout)" class="btn btn-warning btn-xs">Edit</button>
                                        <button @click="removeTemplate(layout.id)" class="btn btn-danger btn-xs">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer p-2">
                        <button :disabled="!layouts.prev_page_url" @click="prevPage()" class="btn btn-primary btn-xs">Prev</button>
                        <button :disabled="!layouts.next_page_url" @click="nextPage()" class="btn btn-primary btn-xs">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </superadmin-layout>
</template>

<script>
import SuperadminLayout from '../../Layouts/SuperadminLayout.vue'
export default {
    components: {
        SuperadminLayout
    },
    props: [
        'lobster_layout',
        'styles'
    ],
    data () {
        return {
            form: {
                name: '',
                styles: [],
                file: ''
            },
            selected: [],
            isEdit: false,
            isLoading: false
        }
    },
    computed: {
        layouts () {
            return this.lobster_layout;
        }
    },
    methods: {
        nextPage () {
            this.$inertia.visit(this.layouts.next_page_url, {
                preserveState: true,    
                preserveScroll: true
            });
        },
        prevPage () {
            this.$inertia.visit(this.layouts.prev_page_url, {
                preserveState: true,
                preserveScroll: true
            });
        },
        fileHandler () {
            this.form.file = this.$refs.img.files[0];
        },
        viewLayout(layoutId) {
            this.$inertia.get(`/lobsterCertLayoutView/${layoutId}`)
        },
        saveTemplate() {
            this.isLoading = true;
            this.$inertia.post('/lobsterCertLayoutStore', this.form, {
                onBefore: () => confirm('Add this template?'),
                onSuccess: () => {
                    toastr.info('New Template Added.')
                    this.isLoading = false;
                }
            })
        },
        editTemplate(template) {
            this.isEdit = true;
            this.form = template;
        },
        updateTemplate() {
            this.isLoading = true;
            this.$inertia.post('/lobsterCertLayoutUpdate', {_method: 'patch', ...this.form}, {
                preserveState: true,
                preserveScroll: true,
                onBefore: () => confirm('Update this template'),
                onSuccess: () => {
                    toastr.info('Template Updated.');
                    this.isLoading = false;
                }
            })
        },
        removeTemplate(layoutId) {
            this.$inertia.delete(`/lobsterCertLayoutDelete/${layoutId}`, {
                preserveState: true,
                preserveScroll: true,
                onBefore: () => confirm('Delete this template')
            })
        }

    }
}
</script>