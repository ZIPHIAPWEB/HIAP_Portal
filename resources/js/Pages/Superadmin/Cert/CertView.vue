<template>
    <superadmin-layout>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Cert Layout</h6>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submitChanges()">
                            <div class="form-group">
                                <label>Layout Name</label>
                                <input type="text" v-model="form.name" class="form-control form-control-sm" placeholder="layout-one">
                            </div>
                            <div class="form-group">
                                <label>Font Style</label>
                                <input type="text" v-model="form.f_style.font_style" class="form-control form-control-sm" placeholder="'Montserrat', sans-serif">
                            </div>
                            <div class="form-group">
                                <label>Font Size</label>
                                <input type="text" v-model="form.f_style.font_size" class="form-control form-control-sm" placeholder="5em">
                            </div>
                            <div class="form-group">
                                <label>Color</label>
                                <input type="text" v-model="form.f_style.color" class="form-control form-control-sm" placeholder="#910824">
                            </div>
                            <div class="form-group">
                                <label>Top Position</label>
                                <input type="text" v-model="form.f_style.top_pos" class="form-control form-control-sm" placeholder="31%">
                            </div>
                            <div class="form-group">
                                <label>Bottom Position</label>
                                <input type="text" v-model="form.f_style.bot_pos" class="form-control form-control-sm" placeholder="50%">
                            </div>
                            <div class="form-group">
                                <label>Background</label>
                                <input @change="fileHandler()" type="file" ref="img">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-sm" type="submit">Apply Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <iframe id="cert-actual-view" :src="`/certActual/${layout.id}`" title="W3Schools Free Online Web Tutorials" style="height: 80vh; width: 100%; "></iframe>
            </div>
        </div>
    </superadmin-layout>
</template>

<script>
    import SuperadminLayout from '../../../Layouts/SuperadminLayout.vue';
    export default {
        props: [
            'layout'
        ],
        components: {
            SuperadminLayout
        },
        data () {
            return {
                form: {
                    id: this.layout.id,
                    name: this.layout.name,
                    f_style: {
                        font_style: '',
                        font_size: '',
                        color: '',
                        top_pos: '',
                        bot_pos: ''
                    },
                    bg_img: ''
                }
            }
        },
        methods: {
            fileHandler () {
                this.form.bg_img = this.$refs.img.files[0];
            },
            submitChanges () {
                this.$inertia.post('/certChange', this.form, {
                    onBefore: () => confirm('Save Changes?'),
                    onSuccess: () => {
                        document.getElementById('cert-actual-view').contentWindow.location.reload();
                        toastr.info('Changes Applied');
                    },
                    onError: () => {
                        toastr.error('Error Occurs');
                    }
                })
            }
        }
    }
</script>