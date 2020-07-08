<template>
    <superadmin-layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Program Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Program Name</label>
                                <input v-model="form.name" type="text" placeholder="Sample Program" class="form-control form-control-sm ">
                            </div>
                            <div class="form-group">
                                <label>Program Description</label>
                                <input v-model="form.description" type="text" placeholder="Sample Description" class="form-control form-control-sm ">
                            </div>
                            <div class="d-flex">
                                <button @click="submitDetails" class="btn btn-success btn-sm ml-auto mx-1">{{ buttonName }}</button>
                                <button @click="cancelRecord" class="btn btn-danger btn-sm">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <div class="mr-auto">
                                <input type="text" class="form-control form-control-sm" placeholder="Search program by name">
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-sm table-hover table-striped">
                                <thead>
                                    <tr class="text-center text-xs">
                                        <th class="text-left">Name</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center text-xs" v-for="program in programs" :key="program.id">
                                        <td class="text-left">{{ program.name }}</td>
                                        <td>{{ program.description }}</td>
                                        <td>
                                            <inertia-link :href="`/sa/program/initials/${program.id}`" class="btn btn-warning btn-xs">
                                                View Requirements
                                            </inertia-link>
                                            <button @click="editDetails(program)" class="btn btn-success btn-xs">Edit</button>
                                            <button @click="deleteDetails(program)" class="btn btn-danger btn-xs">Delete</button>
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
import ProgramEntryComponent from '../../components/ProgramEntryComponent.vue';
import SuperadminLayout from '../../Layouts/SuperadminLayout.vue';
export default {
    props: ['programs'],
    components: {
        SuperadminLayout
    },
    data() {
        return {
            form: {
                name: '',
                description: ''
            },
            loading: false,
            method: 'create',
            buttonName: 'Add'
        }
    },
    methods: {
        deleteDetails(program) {
            var r = confirm("Are you sure to delete this record?");
            if (r == true) {
                this.$inertia.delete(`/deleteProgramDetails/${program.id}`);
                toastr.info('Program deleted!');
            }
        },
        submitDetails() {
            switch(this.method) {
                case 'create':
                    this.$inertia.post('/storeProgramDetails', this.form)
                        .then((response) => {
                            this.method = 'create';
                            this.cancelRecord();
                        })
                    break;

                case 'edit':
                    this.$inertia.patch(`/updateProgramDetails/${this.form.id}`, this.form)
                        .then((response) => {
                            this.method = 'edit';
                            this.cancelRecord();
                        })
                    break;
            }
        },
        editDetails (program) {
            this.form = {...program};
            this.buttonName = 'Update';
            this.method = 'edit';
        },
        cancelRecord () {
            this.form = {};
            this.buttonName = 'Add';
        }
    }
}
</script>
