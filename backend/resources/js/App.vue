<template>
  <div id="app">
    <header class="header">
      <nav>
        <router-link to="/" class="nav-link">Home</router-link>
        <router-link to="/stylists" class="nav-link">Stylists</router-link>
        <router-link to="/shared-wardrobes" class="nav-link">Share Wardrobe</router-link>
        <router-link to="/logout" class="nav-link" @click.native="logout">Logout</router-link>
      </nav>
    </header>
    <router-view />
  </div>
</template>

<script>
export default {
  name: 'App',
  methods: {
    logout() {
      localStorage.removeItem('auth');
      this.$router.push('/login');
    }
  }
};
</script>

<style>
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.header {
  background-color: white;
  padding: 10px;
  text-align: center;
}

.nav-link {
  margin-right: 15px;
  color: blue;
  text-decoration: none;
}

.nav-link:hover {
  text-decoration: underline;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  margin: 0.5rem 0;
}

button {
  margin-left: 1rem;
  background-color: #dc3545;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  cursor: pointer;
}

button:hover {
  background-color: #c82333;
}

@media (max-width: 600px) {
  .nav-link {
    display: block;
    margin: 0.5rem 0;
  }
}
</style>