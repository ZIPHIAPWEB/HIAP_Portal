<template>
    <superadmin-layout>
        <div class="row">
            <div class="col-sm-12">
                <a href="/sa/blogs">Go back to list</a>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Create Blog</h5>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="publishBlog()">
                            <div class="form-group">
                                <label for="blog-title">Title</label>
                                <input type="text" v-model="form.title" class="form-control form-control-sm" placeholder="Blog title">
                            </div>
                            <div class="form-group">
                                <label for="blog-initial">Initial Content</label>
                                <textarea v-model="form.initial_content" name="blog-initial" id="blog-initial" cols="30" rows="5" class="form-control form-control-sm" placeholder="Blog initial content"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="blog-content">Content</label>
                                <ckeditor :editor="editor" v-model="form.content" :config="editorConfig"></ckeditor>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-sm">Publish</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </superadmin-layout>
</template>

<script>
    import SuperadminLayout from '../../../Layouts/SuperadminLayout.vue';
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import { SimpleUploadAdapterPlugin } from '../../../Services/MyUploadAdapter.js';

    export default {
        components: {
            SuperadminLayout
        },
        beforeDestroy (e) {
            console.log(e);
        },
        data () {
            return {
                form: {
                    title: '',
                    initial_content: '',
                    content: ''
                },
                editor: ClassicEditor,
                editorConfig: {
                    extraPlugins: [SimpleUploadAdapterPlugin]
                }
            }
        },
        methods: {
            publishBlog () {
                this.$inertia.post('/publishBlog', this.form, {
                    onBefore: () => confirm('Save this blog?'),
                    onSuccess: () => {
                        toastr.info('Published!');
                    }
                })
            }
        }
    }
</script>