<template>
    <teacher-layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <img class="avatar" src="/man.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="overlay" v-if="isLoading">
                            <i class="fas fa-spinner fa-2x fa-pulse"></i>
                        </div>
                        <div class="card-header">
                            <div class="card-tools">
                                <input v-model="searchGrade" type="text" placeholder="Search" class="form-control form-control-sm">
                            </div>
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
                                    <tr class="text-center text-sm" v-for="i in filteredGrades" :key="i.id">
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
                        <div class="card-footer p-2">
                            <button @click="prevPage" :disabled="!grades.prev_page_url" class="btn btn-primary btn-xs">Prev</button>
                            <button @click="nextPage" :disabled="!grades.next_page_url" class="btn btn-primary btn-xs">Next</button>
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
        props: [
            'grades'
        ],
        components: {
            TeacherLayout
        },
        data () {
            return {
                form: {
                    grade: ''
                },
                isEdit: false,
                isLoading: false,
                searchGrade: ''
            }
        },
        computed: {
            filteredGrades () {
                return this.grades.data.filter(e => e.title.toLowerCase().includes(this.searchGrade.toLowerCase()));
            }
        },
        methods: {
            prevPage() {
                this.$inertia.visit(this.grades.prev_page_url, {preserveState: true});
            },
            nextPage() {
                this.$inertia.visit(this.grades.next_page_url, {preserveState: true});
            },
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
</style>