<template>
  <div>
    <h1>Edit Clothing Item</h1>
    <form @submit.prevent="updateItem">
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
      <button type="submit">Update Item</button>
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
  created() {
    this.fetchItem();
  },
  methods: {
    fetchItem() {
      axios.get(`/clothing-items/${this.$route.params.id}`)
        .then(response => {
          const item = response.data;
          this.name = item.name;
          this.category = item.category;
          this.size = item.size;
          this.color = item.color;
        });
    },
    updateItem() {
      axios.put(`/clothing-items/${this.$route.params.id}`, {
        name: this.name,
        category: this.category,
        size: this.size,
        color: this.color
      })
      .then(response => {
        alert('Item updated successfully!');
        this.$router.push('/clothing-items');
      })
      .catch(error => {
        console.error("There was an error updating the item:", error);
      });
    }
  }
};
</script>