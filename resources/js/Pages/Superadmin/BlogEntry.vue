<template>
    <superadmin-layout>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Blogs</h5>
                        <div class="card-tools">
                            <inertia-link href="/sa/blogs/create" class="btn btn-primary btn-xs">Create Blog</inertia-link>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-left">Title</th>
                                    <th>Slug</th>
                                    <th>Initial Content</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="blog in blogs" :key="blog.id" class="text-center text-xs">
                                    <td class="text-left">{{ blog.title }}</td>
                                    <td>{{ blog.slug }}</td>
                                    <td style="width: 60%">{{ blog.initial_content}}</td>
                                    <td>
                                        <a :href="blog.actions.view_url" target="_blank" class="btn btn-info btn-xs">View</a>
                                        <inertia-link :href="blog.actions.edit_url" class="btn btn-success btn-xs">Edit</inertia-link>
                                        <button @click="deleteBlog(blog.actions.delete_url)" class="btn btn-danger btn-xs">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </superadmin-layout>
</template>

<script>
    import SuperadminLayout from '../../Layouts/SuperadminLayout.vue';
    export default {
        props: [
            'blogs'
        ],
        components: {
            SuperadminLayout
        },
        methods: {
            deleteBlog (url) {
                this.$inertia.delete(url, {
                    onBefore: () => confirm('Delete this blog?'),
                    onSuccess: () => {
                        toastr.info('Blog deleted');
                    }
                })
            }
        }
    }
</script>