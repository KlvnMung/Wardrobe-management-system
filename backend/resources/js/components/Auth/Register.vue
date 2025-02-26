<template>
  <div>
    <h1>Sign Up</h1>
    <form @submit.prevent="signup">
      <div>
        <label>Name:</label>
        <input v-model="name" required>
      </div>
      <div>
        <label>Email:</label>
        <input v-model="email" type="email" required>
      </div>
      <div>
        <label>Password:</label>
        <input :type="showPassword ? 'text' : 'password'" v-model="password" required>
        <button type="button" @click="toggleShowPassword">{{ showPassword ? 'Hide' : 'Show' }}</button>
      </div>
      <div>
        <label>Confirm Password:</label>
        <input :type="showPassword ? 'text' : 'password'" v-model="confirmPassword" required>
      </div>
      <button type="submit">Sign Up</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      name: '',
      email: '',
      password: '',
      confirmPassword: '',
      showPassword: false
    };
  },
  methods: {
    toggleShowPassword() {
      this.showPassword = !this.showPassword;
    },
    signup() {
      if (this.password !== this.confirmPassword) {
        alert("Passwords do not match!");
        return;
      }
      axios.post('/register', {
        name: this.name,
        email: this.email,
        password: this.password,
        password_confirmation: this.confirmPassword
      })
      .then(response => {
        alert('Sign up successful!');
        this.$router.push('/login');
      })
      .catch(error => {
        console.error("There was an error signing up:", error);
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