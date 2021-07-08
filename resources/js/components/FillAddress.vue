<template>

</template>

<script>
    export default {
        name: "FillAddress",
        props:['address'],
        created() {
            this.$root.$emit("fillAddress",this.address)
        }
    }
</script>

<style scoped>

</style>
