<template>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                <a data-toggle="collapse" data-parent="#accordion" :href="`#collapsed-${index}`" class="collapsed" aria-expanded="false">
                    Layout
                </a>
            </h4>
        </div>
        <div :id="`collapsed-${index}`" class="panel-collapse in collapse" style="">
            <div class="card-body">
                <form @submit.prevent="submitChanges()">
                    <div class="form-group">
                        <label>Layout Name</label>
                        <input type="text" v-model="form.name" class="form-control form-control-sm" placeholder="layout-one">
                    </div>
                    <div class="form-group">
                        <label>Font Style</label>
                        <input type="text" v-model="form.style.font_style" class="form-control form-control-sm" placeholder="'Montserrat', sans-serif">
                    </div>
                    <div class="form-group">
                        <label>Font Weight</label>
                        <input type="text" v-model="form.style.font_weight" class="form-control form-control-sm" placeholder="bold">
                    </div>
                    <div class="form-group">
                        <label>Font Size</label>
                        <input type="text" v-model="form.style.font_size" class="form-control form-control-sm" placeholder="5em">
                    </div>
                    <div class="form-group">
                        <label>Alignment</label>
                        <input type="text" v-model="form.style.text_align" class="form-control form-control-sm" placeholder="left">
                    </div>
                    <div class="form-group">
                        <label>Color</label>
                        <input type="text" v-model="form.style.color" class="form-control form-control-sm" placeholder="#910824">
                    </div>
                    <div class="form-group">
                        <label>Top Position</label>
                        <input type="text" v-model="form.style.top_pos" class="form-control form-control-sm" placeholder="31%">
                    </div>
                    <div class="form-group">
                        <label>Bottom Position</label>
                        <input type="text" v-model="form.style.bot_pos" class="form-control form-control-sm" placeholder="50%">
                    </div>
                    <div class="form-group">
                        <label>Right Position</label>
                        <input type="text" v-model="form.style.right_pos" class="form-control form-control-sm" placeholder="50%">
                    </div>
                    <div class="form-group">
                        <label>Left Position</label>
                        <input type="text" v-model="form.style.left_pos" class="form-control form-control-sm" placeholder="50%">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-sm" type="submit">Apply Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'styles',
        'index'
    ],
    data() {
        return {
            form: {
                name: this.styles.name,
                style: { ...this.styles.raw_style }
            }
        }
    },
    methods: {
        submitChanges () {
            this.$inertia.patch(`/updateStyleToCertificate/${this.styles.id}`, this.form, {
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