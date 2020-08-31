<template>
<div>
    <router-link :to="{ name: 'show'}">Все заказы</router-link>
    <router-link :to="{ name: 'create'}">Создать</router-link>
    <router-view></router-view>
</div>
</template>

<script>

</script>

<style>

</style>