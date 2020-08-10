<template>
    <teacher-layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Students</h5>
                            <div class="card-tools">
                                <select v-model="program" class="form-control form-control-sm">
                                    <option value="all" selected>All</option>
                                    <option v-for="program in filteredPrograms" :key="program.id" :value="program.id">{{ program.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-body p-0">
                             <table class="table table-sm table-striped table-hover">
                                <thead>
                                    <tr class="text-sm text-center">
                                        <th class="text-left">First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Address</th>
                                        <th>Contact No.</th>
                                        <th>Email Address</th>
                                        <th>Program</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody v-if="filteredStudents.length > 0">
                                    <tr class="text-xs text-center" v-for="student in filteredStudents" :key="student.id">
                                        <td class="text-left">{{ student.first_name }}</td>
                                        <td>{{ student.middle_name }}</td>
                                        <td>{{ student.last_name }}</td>
                                        <td>{{ student.address }}</td>
                                        <td>{{ student.contact_no }}</td>
                                        <td>{{ student.user.email }}</td>
                                        <td>{{ student.program.name }}</td>
                                        <td>
                                            <inertia-link :href="`/teacher/stud-profile/${student.user_id}`" class="btn btn-success btn-xs">More Details</inertia-link>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td colspan="11" class="text-center">No Student Record</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer" v-if="students.total >= students.per_page">
                            <button :disabled="students.current_page === students.last_page" @click="prevPage" class="btn btn-primary btn-xs">Prev</button>
                            <button :disabled="students.current_page === students.last_page" @click="nextPage" class="btn btn-primary btn-xs">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </teacher-layout>
</template>

<script>
    import TeacherLayout from '../../Layouts/TeacherLayout.vue';
    export default {
        props: ['students', 'programs'],
        components: {
            TeacherLayout
        },
        data () {
            return {
                program: 'all'
            }
        },
        computed: {
            filteredPrograms() {
                return this.programs.filter(e => e.clients.length > 0)
            },
            filteredStudents() {
                return this.students.data.filter(e => {
                    if (this.program == 'all') {
                        return e;
                    } else {
                        return e.program_id == this.program;
                    }
                });
            }
        },
        methods: {
            prevPage() {
                this.$inertia.visit(this.students.prev_page_url, {preserveState: true});
            },
            nextPage() {
                this.$inertia.visit(this.students.next_page_url, {preserveState: true});
            }
        }
    }
</script>