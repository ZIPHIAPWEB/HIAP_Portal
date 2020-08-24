<template>
    <client-layout>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <img class="avatar" src="/man.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <personal-profile-component></personal-profile-component>
                    <client-initial-requirements :programId="programId"></client-initial-requirements>
                </div>
            </div>
        </div>
    </client-layout>
</template>

<script>
    import ClientLayout from '../../Layouts/ClientLayout.vue';
    import PersonalProfileComponent from '../../components/PersonalProfileComponent.vue';
    import ClientInitialRequirements from '../../components/ClientInitialRequirement.vue';
    export default {
        props: ['programId'],
        components: {
            ClientLayout,
            ClientInitialRequirements,
            PersonalProfileComponent
        }
    }
</script>

<style lang="scss" scoped>
    .avatar {
        width: 100%;
        height: 100%;
        border-radius: 100%;
        border: solid 0px gray;
        transition: border-width ease-out 250ms;
        cursor: pointer;
        &:hover {
            border-width: 3px;
        }
    }
</style>
