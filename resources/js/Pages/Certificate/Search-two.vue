<template>
    <certificate-layout>
        <div class="row align-items-center" style="height: 90vh;">
            <div class="col-md-4 offset-md-4">
                <div class="form-group">
                    <input type="text" placeholder="Certificate code" class="form-control" style="text-transform: uppercase">
                </div>
            </div>
        </div>
    </certificate-layout>    
</template>

<script>
    import CertificateLayout from '../../Layouts/CertificateLayout.vue';
    export default {
        components: {
            CertificateLayout
        }
    }
</script>