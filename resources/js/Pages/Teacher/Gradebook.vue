<template>
    <teacher-layout>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ program.name }} Gradebook</h5>
                    <div class="card-tools">
                        <download-excel
                            class="btn btn-primary btn-xs"
                            :fields="exp.fields"
                            :data="exp.data"
                            :name="program.name"
                        >Export</download-excel>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 15%;">Full Name</th>
                                <th style="width: 3%" class="text-center">
                                    <button :disabled="(lessons.length -1) == step ? false : true" @click="step--" class="btn btn-default btn-xs">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                </th>
                                <th class="text-center" v-for="h in lessons[step]" :key="h.id" :id="h.id">{{ h.title }}</th>
                                <th style="width: 3%;" class="text-center">
                                    <button :disabled="(lessons.length - 1) == step ? true : false" @click="step++" class="btn btn-default btn-xs">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="stud in students" :key="stud.id">
                                <td>{{ stud.full_name }}</td>
                                <td></td>
                                <td class="text-center text-xs" v-for="g in stud.lessons[step]" :key="g.id">
                                    <i>{{ g.grade ? g.grade.grade : 'None' }}</i>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </teacher-layout>
</template>

<script>
    import TeacherLayout from '../../Layouts/TeacherLayout.vue';
    export default {
        props: ['lessons', 'students', 'program', 'exp'],
        components: {
            TeacherLayout
        },
        data () {
            return {
                step: 0,
                json_field: {
                    'Full name': 'full_name',
                    'First': 'lessons.first'
                },
                json_data: [
                    {
                        full_name: 'Renz Mergenio',
                        lessons: {
                            first: '12'
                        }
                    },
                ]
            }
        }
    }
</script>