<template>
  <div class="container">
    <h1>Add Clothing Item</h1>
    <form @submit.prevent="addItem" class="form-container">
      <div class="form-group">
        <label>Name:</label>
        <input v-model="name" required>
      </div>
      <div class="form-group">
        <label>Category:</label>
        <input v-model="category" required>
      </div>
      <div class="form-group">
        <label>Size:</label>
        <input v-model="size" required>
      </div>
      <div class="form-group">
        <label>Color:</label>
        <input v-model="color" required>
      </div>
      <button type="submit" class="submit-button">Add Item</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      name: '',
      category: '',
      size: '',
      color: ''
    };
  },
  methods: {
    addItem() {
      const formData = new FormData();
      formData.append('name', this.name);
      formData.append('category', this.category);
      formData.append('size', this.size);
      formData.append('color', this.color);

      axios.post('/clothing-items', formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
      .then(response => {
        alert('Item added successfully!');
        this.$router.push('/clothing-items');
      })
      .catch(error => {
        console.error("There was an error adding the item:", error);
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
  padding: 20px;
  text-align: center;
  font-family: 'Arial', sans-serif;
  color: #333;
}

h1 {
  font-size: 2rem;
  margin-bottom: 20px;
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

.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

.form-group input {
  width: 100%;
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 1rem;
}

.submit-button {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  cursor: pointer;
  border-radius: 5px;
  font-size: 1rem;
}

.submit-button:hover {
  background-color: #0056b3;
}
</style>