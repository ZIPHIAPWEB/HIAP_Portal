<template>
    <certificate-layout>
        <div class="container-fluid d-flex flex-column align-items-center justify-content-center cert-bg">
            <img src="/logo2.png" alt="HIAP Logo">
            <div class="input-group input-group-lg justify-content-center">
                <input v-model="certId" type="text" class="form-control-lg text-sm" placeholder="ENTER CERTIFICATE NO.">
                <div class="input-group-append">
                    <button @click="search" class="btn btn-flat text-sm">SEARCH</button>
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
        },
        data () {
            return {
                certId: ''
            }
        },
        methods: {
            search () {
                this.$inertia.visit(`/cert/${this.certId}`);
            }
        }
    }
</script>

<style lang="scss" scoped>
    .cert-bg {
        height: 100vh;
        background: url('/assets/img/cert-background.jpg');
        background-size: cover;
        background-position: center;
        font-family: Montserrat;

        img {
            height: 200px;
            margin: 2em;
        }

        input {
            width: 50vw;
            padding: 20px;
            background: #cacaca;
            color: #424242;
            font-weight: bold;
            text-transform: uppercase;
            border: 0;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        button {
            background: #910824;
            color: white;
            font-weight: bold;
        }

        @media (min-width: 576px) {
            input {
                width: 40vw;
            }

            img {
                height: 240px;
            }

            button {
                font-size: 5px;
            }
        }
    }

    ::placeholder {
        color: #424242;
        font-weight: bold;
        opacity: 1;
    }

    :-ms-input-placeholder {
        color: #424242;
        font-weight: bold;
    }

    ::-ms-input-placeholder {
        color: #424242;
        font-weight: bold;
    }
</style>