<template>
  <div class="container">
    <h1>Login</h1>
    <form @submit.prevent="login" class="form-container">
      <div>
        <label>Email:</label>
        <input v-model="email" type="email" required autocomplete="username">
      </div>
      <div>
        <label>Password:</label>
        <input :type="showPassword ? 'text' : 'password'" v-model="password" required autocomplete="current-password">
        <button type="button" @click="toggleShowPassword">{{ showPassword ? 'Hide' : 'Show' }} Password</button>
      </div>
      <button type="submit">Login</button>
    </form>
    <p>Do not have an account? <router-link to="/register" class="register-link">Register one today</router-link>.</p>
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
.container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
}

.form-container {
  display: flex;
  flex-direction: column;
  width: 300px;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 10px;
  background-color: #f9f9f9;
}

.form-container div {
  margin-bottom: 15px;
}

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

.register-link {
  color: red;
  text-decoration: none;
}

.register-link:hover {
  color: green;
}
</style>