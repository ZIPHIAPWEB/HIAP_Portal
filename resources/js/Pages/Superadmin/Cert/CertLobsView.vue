<template>
    <superadmin-layout>
        <div class="row">
            <div class="col-md-3">
                <button class="btn btn-primary btn-sm btn-block mb-2" @click="addField()">Add Field</button>
                <div id="accordion">
                    <cert-style-form v-for="(style, index) in lobster_layout.cert_styles" :styles="style" :key="index" :index="index"></cert-style-form>
                </div>
            </div>
            <div class="col-md-9">
                <iframe id="cert-actual-view" :src="`/lobsterCertForEditor/${lobster_layout.id}`" title="W3Schools Free Online Web Tutorials" style="height: 100vh; width: 100%; "></iframe>
            </div>
        </div>
    </superadmin-layout>
</template>

<script>
    import SuperadminLayout from '../../../Layouts/SuperadminLayout.vue';
    import CertStyleForm from '../../../components/CertStyleForm.vue';
    export default {
        props: [
            'lobster_layout'
        ],
        components: {
            SuperadminLayout,
            CertStyleForm
        },
        data () {
            return {
                form: {
                    cert_id: this.lobster_layout.id,
                    name: this.lobster_layout.name,
                    f_style: {
                        font_style: '',
                        font_align: '',
                        font_size: '',
                        font_weight: '',
                        color: '',
                        top_pos: '',
                        bot_pos: '',
                        right_pos: '',
                        left_pos: '',
                    },
                    bg_img: '',
                },
                styles: 0
            }
        },
        methods: {
            fileHandler () {
                this.form.bg_img = this.$refs.img.files[0];
            },
            addField () {
                this.$inertia.post('/addStyleToCertificate', this.form, {
                    onBefore: () => confirm('Add new field?')
                })
            }
        }
    }
</script>