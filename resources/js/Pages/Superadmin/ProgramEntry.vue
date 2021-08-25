<template>
    <superadmin-layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Course Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Course Name</label>
                                <input v-model="form.name" type="text" placeholder="Sample Program" class="form-control form-control-sm ">
                            </div>
                            <div class="form-group">
                                <label>Course Description</label>
                                <input v-model="form.description" type="text" placeholder="Sample Description" class="form-control form-control-sm ">
                            </div>
                            <div class="form-group">
                                <label>Program Category</label>
                                <select v-model="form.course" class="form-control form-control-sm">
                                    <option selected value="">Select Program</option>
                                    <option v-for="course in courses" :key="course.id" :value="course.id">{{ course.name }}</option>
                                </select>
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
                            <h6 class="card-title">Programs</h6>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-sm table-hover table-striped">
                                <thead>
                                    <tr class="text-center text-xs">
                                        <th class="text-left">Name</th>
                                        <th>Description</th>
                                        <th>Program</th>
                                        <th>isActive</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center text-xs" v-for="program in programs" :key="program.id">
                                        <td class="text-left">{{ program.name }}</td>
                                        <td>{{ program.description }}</td>
                                        <td>{{ program.online_program }}</td>
                                        <td>
                                            <i v-if="program.isActive" class="text-bold text-green">Active</i>
                                            <i v-else class="class text-bold text-red">Inactive</i>
                                        </td>
                                        <td>
                                            <inertia-link :href="`/sa/program/initials/${program.course_id}`" class="btn btn-warning btn-xs">
                                                View Requirements
                                            </inertia-link>
                                            <!-- <inertia-link :href="`/sa/${program.id}/lessons`" class="btn btn-info btn-xs">View Gradebook</inertia-link> -->
                                            <button v-if="!program.isActive" @click="activateProgram(program.id)" class="btn btn-info btn-xs">Activate</button>
                                            <button v-else @click="deactivateProgram(program.id)" class="btn btn-warning btn-xs">Deactivate</button>
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
    props: ['programs', 'courses', 'flash'],
    components: {
        SuperadminLayout
    },
    data() {
        return {
            form: {
                name: '',
                description: '',
                course: ''
            },
            loading: false,
            method: 'create',
            buttonName: 'Add'
        }
    },
    watch: {
        flash: function (value) {
            toastr.info(value.message);
        }
    },
    methods: {
        deleteDetails(program) {
            this.$inertia.delete(`/deleteProgramDetails/${program.id}`, {
                onBefore: () => confirm('Delete this program?')
            });
        },
        submitDetails() {
            switch(this.method) {
                case 'create':
                    this.$inertia.post('/storeProgramDetails', this.form, {
                        onSuccess: () => {
                            this.method = 'create';
                            this.cancelRecord();
                        },
                        onBefore: () => confirm('Add this program?')
                    })
                    break;

                case 'edit':
                    this.$inertia.patch(`/updateProgramDetails/${this.form.id}`, this.form, {
                        onSuccess: () => {
                            this.method = 'edit',
                            this.cancelRecord();
                        },
                        onBefore: () => confirm('Update this program?')
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
        },
        activateProgram(id) {
            this.$inertia.post(`/activateProgram/${id}`, {}, {
                onBefore: () => confirm('Activate?')
            });
        },
        deactivateProgram(id) {
            this.$inertia.post(`/deactivateProgram/${id}`, {}, {
                onBefore: () => confirm('Deactivate?')
            });
        }
    }
}
</script>
