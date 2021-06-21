<template>
    <superadmin-layout>
        <div class="row">
            <div class="col-sm-12">
                <a href="/sa/blogs">Go back to list</a>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit Blog</h5>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="updateBlog()">
                            <div class="form-group">
                                <label for="blog-title">Title</label>
                                <input v-model="form.title" type="text" class="form-control form-control-sm" placeholder="Blog title">
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
                                <button type="submit" class="btn btn-success btn-sm">Update</button>
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
        props: [
            'selectedBlog'
        ],
        data () {
            return {
                form: {
                    id: this.selectedBlog.id,
                    title: this.selectedBlog.title,
                    initial_content: this.selectedBlog.initial_content,
                    content: this.selectedBlog.content,
                    img_collection: []
                },
                editor: ClassicEditor,
                editorConfig: {
                    extraPlugins: [SimpleUploadAdapterPlugin]
                }
            }
        },
        mounted () {
            let doc = new DOMParser().parseFromString(this.selectedBlog.content, 'text/html');
            let imgCollection = doc.getElementsByTagName('img');

            for(var i = 0; i < imgCollection.length; i++) {
                this.form.img_collection.push(imgCollection[i].src);
                console.log(imgCollection[i].src);
            }
        },
        methods: {
            updateBlog () {
                this.$inertia.patch('/blogUpdate', this.form, {
                    onBefore: () => confirm('Update this blog?'),
                    onSuccess: () => {
                        toastr.info('Blog Updated!');
                    }
                })
            },
        }
    }
</script>