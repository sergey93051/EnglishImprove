<template>
    <div class="container">
        Home path
    </div>
</template>
<script>


export default {
    beforeCreate() {
        this.$store.dispatch('verify');
    },
}
</script>
