<template>
    <div class="wrapper">
        

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper p-3">
            <slot />
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->
    </div>
</template>

<script>
    export default {
        mounted () {
            document.body.classList.add('layout-top-nav');
        },
        methods: {
            logout () {
                axios.post('/logout')
                    .then((response) => {
                        window.location.replace('/');
                    })
            }
        }
    }
</script>
