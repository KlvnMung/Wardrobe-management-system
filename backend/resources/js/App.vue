<template>
  <div>
    <header>
      <nav>
        <router-link to="/">Home</router-link>
        <router-link to="/add">Add Item</router-link>
        <router-link to="/clothing-items">Clothing Items</router-link>
        <router-link to="/logout" @click.native="logout">Logout</router-link>
      </nav>
    </header>
    <router-view></router-view>
    <footer>
      <p>&copy; 2025 Wardrobe Management System</p>
    </footer>
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

header, footer {
  background-color: #f8f9fa;
  padding: 1rem;
  text-align: center;
}

nav a {
  margin: 0 1rem;
  text-decoration: none;
  color: #007bff;
}

nav a:hover {
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
  nav a {
    display: block;
    margin: 0.5rem 0;
  }
}
</style>