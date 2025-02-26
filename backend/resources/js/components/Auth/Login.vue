<template>
  <div>
    <h1>Login</h1>
    <form @submit.prevent="login">
      <div>
        <label>Email:</label>
        <input v-model="email" type="email" required autocomplete="username">
      </div>
      <div>
        <label>Password:</label>
        <input :type="showPassword ? 'text' : 'password'" v-model="password" required autocomplete="current-password">
        <button type="button" @click="toggleShowPassword">{{ showPassword ? 'Hide' : 'Show' }}</button>
      </div>
      <button type="submit">Login</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      email: '',
      password: '',
      showPassword: false
    };
  },
  methods: {
    toggleShowPassword() {
      this.showPassword = !this.showPassword;
    },
    login() {
      axios.post('/login', {
        email: this.email,
        password: this.password
      })
      .then(response => {
        alert('Login successful!');
        localStorage.setItem('auth', true);
        this.$router.push('/clothing-items');
      })
      .catch(error => {
        console.error("There was an error logging in:", error);
      });
    }
  }
};
</script>

<style>
button {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}
</style>