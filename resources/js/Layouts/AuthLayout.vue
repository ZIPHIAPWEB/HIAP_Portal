<template>
    <div class="login-container">
        <slot />
    </div>
</template>

<script>
export default {

}
</script>

<style class="sass" scoped>
    .login-container {
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: lightgray
    }
</style>
