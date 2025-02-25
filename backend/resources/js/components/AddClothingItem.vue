<template>
  <div>
    <h1>Add Clothing Item</h1>
    <form @submit.prevent="addItem">
      <div>
        <label>Name:</label>
        <input v-model="name" required>
      </div>
      <div>
        <label>Category:</label>
        <input v-model="category" required>
      </div>
      <div>
        <label>Size:</label>
        <input v-model="size" required>
      </div>
      <div>
        <label>Color:</label>
        <input v-model="color" required>
      </div>
      <button type="submit">Add Item</button>
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
      axios.post('/clothing-items', {
        name: this.name,
        category: this.category,
        size: this.size,
        color: this.color
      })
      .then(response => {
        alert('Item added successfully!');
        this.name = '';
        this.category = '';
        this.size = '';
        this.color = '';
        this.$router.push('/');
      })
      .catch(error => {
        console.error("There was an error adding the item:", error);
      });
    }
  }
};
</script>