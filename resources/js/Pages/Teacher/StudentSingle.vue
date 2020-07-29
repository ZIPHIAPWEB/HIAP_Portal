<template>
    <teacher-layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <img class="avatar" src="/man.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">Profile</h6>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped table-hover table-bordered table-sm">
                                <tbody>
                                    <tr class="text-sm">
                                        <td class="text-bold" style="width: 25%;">First Name</td>
                                        <td class="text-center">{{ student.first_name }}</td>
                                    </tr>
                                    <tr class="text-sm">
                                        <td class="text-bold" style="width: 25%;">Middle Name</td>
                                        <td class="text-center">{{ student.middle_name}}</td>
                                    </tr>
                                    <tr class="text-sm">
                                        <td class="text-bold" style="width: 25%;">Last Name</td>
                                        <td class="text-center">{{ student.last_name }}</td>
                                    </tr>
                                    <tr class="text-sm">
                                        <td class="text-bold" style="width: 25%;">Address</td>
                                        <td class="text-center">{{ student.address }}</td>
                                    </tr>
                                    <tr class="text-sm">
                                        <td class="text-bold" style="width: 25%;">Contact Number</td>
                                        <td class="text-center">{{ student.contact_no }}</td>
                                    </tr>
                                    <tr class="text-sm">
                                        <td class="text-bold" style="width: 25%;">E-mail Address</td>
                                        <td class="text-center">{{ student.user.email }}</td>
                                    </tr>
                                    <tr class="text-sm">
                                        <td class="text-bold">Program</td>
                                        <td class="text-center">{{ student.program.name }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="overlay" v-if="isLoading">
                            <i class="fas fa-spinner fa-2x fa-pulse"></i>
                        </div>
                        
                        <div class="card-body p-0">
                            <table class="table table-striped table-hover table-sm">
                                <thead>
                                    <tr class="text-center text-sm">
                                        <th class="text-left">Quizzes</th>
                                        <th>Grade</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <tr v-if="create">
                                        <td>
                                            <input v-model="form.title" type="text" class="text-center form-control form-control-sm" placeholder="Quiz Title">
                                        </td>
                                        <td>
                                            <input v-model="form.grade" type="text" class="text-center form-control form-control-sm" placeholder="Grade ">
                                        </td>
                                        <td class="text-center d-block justify-content-center">
                                            <button @click="submitGrade()" class="btn btn-primary btn-xs">Submit</button>
                                            <button @click="create = false;" class="btn btn-danger btn-xs">Cancel</button>
                                        </td>
                                    </tr>
                                    <tr v-else>
                                        <td colspan="3" class="text-center">
                                            <button @click="create = true;" class="btn btn-xs btn-block">Add New</button>
                                        </td>
                                    </tr> -->
                                    <tr class="text-center text-sm" v-for="i in grades" :key="i.id">
                                        <td class="text-left">{{ i.title }}</td>
                                        <td>
                                            <input v-model="form.grade" type="text" class="text-center form-control form-control-sm" v-if="isEdit == i.id">
                                            <span v-else>
                                                {{ (i.grade) ? i.grade.grade : 'Not Yet Assigned' }}
                                            </span>
                                        </td>
                                        <td v-if="isEdit !== i.id">
                                            <button v-if="!i.grade" @click="isEdit = i.id;" class="btn btn-success btn-xs">
                                                <i class="fas fa-pencil-alt text-xs"></i>
                                            </button>
                                            <button @click="deleteGrade(i.grade.id)" v-else class="btn btn-danger btn-xs">
                                                <i class="fas fa-times text-sm"></i>
                                            </button>
                                        </td>
                                        <td v-else>
                                            <button @click="submitGrade(i)" class="btn btn-info btn-xs">
                                                <i class="fas fa-check text-xs"></i>
                                            </button>
                                            <button @click="isEdit = false;" class="btn btn-danger btn-xs">
                                                <i class="fas fa-times text-sm"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
        props: ['student', 'grades'],
        components: {
            TeacherLayout
        },
        data () {
            return {
                form: {
                    grade: ''
                },
                isEdit: false,
                isLoading: false
            }
        },
        methods: {
            submitGrade(i) {
                console.log(i);
                let formData = new FormData();
                formData.append('user_id', this.student.user_id);
                formData.append('program_id', i.program_id);
                formData.append('lesson_id', i.id)
                formData.append('grade', this.form.grade);

                this.isLoading = true;

                this.$inertia.post('/storeGrade', formData)
                    .then((response) => {
                        this.isLoading = false;
                        this.form.grade = '';
                        this.isEdit = false;               
                    })

                
            },
            deleteGrade(gradeId) {
                var r = confirm('Delete this grade?');
                if (r) {
                    this.isLoading = true;
                    this.$inertia.delete(`/deleteGrade/${gradeId}`, { preserveState: true })
                        .then((response) => {
                            this.isLoading = false;
                        })
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    .avatar {
        width: 100%;
        height: 100%;
        border-radius: 100%;
        border: solid 0px gray;
        transition: border-width ease-out 250ms;
        cursor: pointer;
        &:hover {
            border-width: 3px;
        }
    }
</style>w