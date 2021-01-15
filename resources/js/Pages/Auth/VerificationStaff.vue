<template>
    <auth-layout>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Verification Staff</h3>
                    </div>
                    <div class="card-body">
                        <p>We send you a verification on your email. Please verify to activate your account.</p>
                    </div>
                </div>
            </div>
        </div>
    </auth-layout>
</template>

<script>
    import AuthLayout from '../../Layouts/AuthLayout.vue';
    export default {
        components: {
            AuthLayout
        },
    }
</script>
