<template>
  <div class="container">
    <h1>Sign Up</h1>
    <form @submit.prevent="signup" class="form-container">
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
      </div>
      <div>
        <label>Confirm Password:</label>
        <input :type="showPassword ? 'text' : 'password'" v-model="confirmPassword" required>
      </div>
      <div>
        <button type="button" @click="toggleShowPassword">{{ showPassword ? 'Hide' : 'Show' }} Password</button>
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
</style>