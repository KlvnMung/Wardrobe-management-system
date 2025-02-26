<template>
  <div>
    <h1>Clothing Items</h1>
    <router-link to="/add">Add Item</router-link>
    <ul>
      <li v-for="item in items" :key="item.id">
        {{ item.name }} - {{ item.category }} - {{ item.size }} - {{ item.color }}
        <router-link :to="`/edit/${item.id}`">Edit</router-link>
        <button @click="deleteItem(item.id)">Delete</button>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      items: []
    };
  },
  created() {
    this.fetchItems();
  },
  methods: {
    fetchItems() {
      axios.get('/clothing-items')
        .then(response => {
          this.items = response.data;
        });
    },
    deleteItem(id) {
      axios.delete(`/clothing-items/${id}`)
        .then(() => {
          this.fetchItems();
        });
    }
  }
};
</script>