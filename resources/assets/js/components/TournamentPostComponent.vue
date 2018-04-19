<template>
    <div>
        <h3>{{title}}</h3>
        <span>tornooi id: {{id}}</span><br>
        <span>start: {{start}} end: {{end}}</span><br>
        <span>location: {{address}}</span><br>
        <span>contact: {{contact}}</span><br>
        <span>klassement: </span>
    </div>
</template>

<script>
    export default {
        props:['title', 'id', 'start', 'end', 'address', 'contact'],
        data() {
            return {
            }
        },
        methods: {

        }
    }
</script>

<style scoped>

</style>