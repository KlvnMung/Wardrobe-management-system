<template>
  <div class="container">
    <h1>Clothing Items</h1>
    <div class="controls">
      <input type="text" v-model="searchQuery" placeholder="Search items..." class="search-input">
      <select v-model="selectedCategory" class="filter-select">
        <option value="">All Categories</option>
        <option v-for="category in categories" :key="category" :value="category">{{ category }}</option>
      </select>
      <router-link to="/add" class="add-button">
        <i class="fas fa-plus"></i> <span>Add Item</span>
      </router-link>
    </div>
    <div class="table-container">
      <table class="clothing-table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Size</th>
            <th>Color</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in filteredItems" :key="item.id">
            <td>{{ item.name }}</td>
            <td>{{ item.category }}</td>
            <td>{{ item.size }}</td>
            <td>{{ item.color }}</td>
            <td>
              <router-link :to="`/edit/${item.id}`" class="action-button">
                <i class="fas fa-edit"></i> <span>Edit</span>
              </router-link>
              <button @click="deleteItem(item.id)" class="action-button">
                <i class="fas fa-trash"></i> <span>Delete</span>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="pagination">
      <button @click="prevPage" :disabled="currentPage === 1">Previous</button>
      <span>Page {{ currentPage }} of {{ totalPages }}</span>
      <button @click="nextPage" :disabled="currentPage === totalPages">Next</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      items: [],
      searchQuery: '',
      selectedCategory: '',
      categories: [],
      currentPage: 1,
      itemsPerPage: 10,
      totalItems: 0
    };
  },
  created() {
    this.fetchItems();
  },
  computed: {
    filteredItems() {
      return this.items.filter(item => {
        const matchesSearch = item.name.toLowerCase().includes(this.searchQuery.toLowerCase());
        const matchesCategory = this.selectedCategory ? item.category === this.selectedCategory : true;
        return matchesSearch && matchesCategory;
      }).slice((this.currentPage - 1) * this.itemsPerPage, this.currentPage * this.itemsPerPage);
    },
    totalPages() {
      return Math.ceil(this.totalItems / this.itemsPerPage);
    }
  },
  methods: {
    fetchItems() {
      axios.get('/clothing-items')
        .then(response => {
          this.items = response.data;
          this.totalItems = this.items.length;
          this.categories = [...new Set(this.items.map(item => item.category))];
        });
    },
    deleteItem(id) {
      axios.delete(`/clothing-items/${id}`)
        .then(() => {
          this.fetchItems();
        });
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
      }
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

.controls {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
  gap: 10px;
}

.search-input {
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 1rem;
}

.filter-select {
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 1rem;
}

.add-button {
  display: flex;
  align-items: center;
  background-color: #28a745;
  color: white;
  padding: 0.5rem 1rem;
  text-decoration: none;
  border-radius: 5px;
  font-size: 1rem;
}

.add-button i {
  margin-right: 5px;
}

.add-button:hover {
  background-color: #218838;
}

.table-container {
  width: 100%;
  max-width: 800px;
  overflow-x: auto;
}

.clothing-table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
}

.clothing-table th, .clothing-table td {
  border: 1px solid #ccc;
  padding: 10px;
  text-align: left;
}

.clothing-table th {
  background-color: #f8f9fa;
}

.action-button {
  display: flex;
  align-items: center;
  background-color: transparent;
  border: none;
  color: #007bff;
  cursor: pointer;
  font-size: 1rem;
  margin-right: 10px;
}

.action-button i {
  margin-right: 5px;
}

.action-button:hover {
  color: #0056b3;
}

.action-button span {
  opacity: 0.7;
}

.action-button:hover span {
  opacity: 1;
}

.pagination {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-top: 20px;
}

.pagination button {
  padding: 0.5rem 1rem;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #f8f9fa;
  cursor: pointer;
}

.pagination button:disabled {
  cursor: not-allowed;
  opacity: 0.5;
}
</style>