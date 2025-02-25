<template>
  <div>
    <nav>
      <router-link to="/">Home</router-link>
      <router-link to="/add">Add Item</router-link>
    </nav>
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: 'App'
};
</script>