<template>
    <superadmin-layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">Lesson</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" v-model="form.title" class="form-control form-control-sm" placeholder="Enter valid lesson title">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" v-model="form.description" class="form-control form-control-sm" placeholder="Enter valid lesson description">
                            </div>
                            <div class="d-flex">
                                <button @click="submitLesson" class="btn btn-success btn-sm ml-auto mx-1">{{ method }}</button>
                                <button @click="cancelEntry" class="btn btn-danger btn-sm">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="card">
                        <div class="card-header"></div>
                        <div class="card-body p-0">
                            <table class="table table-striped table-hovered table-sm">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-left">#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody v-if="lessons.length > 0">
                                    <tr  v-for="lesson in lessons" :key="lesson.id" class="text-center">
                                        <td class="text-left">{{ lesson.id }}</td>
                                        <td>{{ lesson.title }}</td>
                                        <td>{{ lesson.description }}</td>
                                        <td>
                                            <button @click="editEntry(lesson)" class="btn btn-success btn-xs">Edit</button>
                                            <button @click="deleteLesson(lesson)" class="btn btn-danger btn-xs">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td colspan="4" class="text-center">No Lessons</td>
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
    import SuperadminLayout from '../../Layouts/SuperadminLayout.vue';
    export default {
        props: ['lessons', 'programId'],   
        components: {
            SuperadminLayout
        },
        data() {
            return {
                form: {
                    title: '',
                    description: ''
                },
                method: 'Add'
            }
        },
        methods: {
            submitLesson() {
                let formData = new FormData();
                formData.append('program_id', this.programId);
                formData.append('title', this.form.title);
                formData.append('description', this.form.description);

                switch(this.method) {
                    case 'Add':
                        this.$inertia.post('/storeLesson', formData)
                            .then((response) => {
                                this.cancelEntry();
                            })
                        break;

                    case 'Update':
                        formData.append('_method', 'PUT');
                        this.$inertia.post(`/updateLesson/${this.form.id}`, formData)
                            .then((response) => {
                                this.cancelEntry();
                            })
                        break
                }
            },
            deleteLesson(lesson) {
                var r = confirm('Delete this lesson?');

                if(r) {
                    this.$inertia.delete(`/deleteLesson/${lesson.id}`);
                } 
            },
            cancelEntry() {
                this.form = {};
                this.method = 'Add';
            },
            editEntry(entry) {
                this.method = 'Update';
                this.form = {...entry};
            }
        }
    }
</script>