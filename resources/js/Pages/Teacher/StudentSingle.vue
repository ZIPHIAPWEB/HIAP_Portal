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
                                        <td class="text-bold" style="width: 25%;">School/Organization</td>
                                        <td class="text-center">{{ student.school }}</td>
                                    </tr>
                                    <tr class="text-sm">
                                        <td class="text-bold" style="width: 25%;">E-mail Address</td>
                                        <td class="text-center">{{ student.user.email }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5>Enrolled Programs</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>Programs</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="c in courses" :key="c.id">
                                        <td>{{ c.program.name }}</td>
                                        <td class="text-center">
                                            <inertia-link :href="`/teacher/student/${c.user_id}/gradebook/${c.program_id}`" class="btn btn-xs btn-primary">View Gradebook</inertia-link>
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
        props: ['student', 'grades', 'courses'],
        components: {
            TeacherLayout
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