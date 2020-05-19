<template>
    <superadmin-layout>
        <initial-requirements-component :program="program"></initial-requirements-component>
    </superadmin-layout>
</template>

<script>
    import SuperadminLayout from '../../Layouts/SuperadminLayout.vue';
    import InitialRequirementsComponent from '../../components/InitialRequirementsComponent.vue';
    export default {
        components: {
            SuperadminLayout,
            InitialRequirementsComponent
        },
        props: ['program']
    }
</script>
