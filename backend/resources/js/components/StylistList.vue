<template>
  <div class="container">
    <h1>Stylists</h1>
    <router-link to="/add-stylist" class="add-button">
      <i class="fas fa-plus"></i> <span>Add Stylist</span>
    </router-link>
    <table class="clothing-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="stylist in stylists" :key="stylist.id">
          <td>{{ stylist.name }}</td>
          <td>{{ stylist.email }}</td>
          <td>
            <router-link :to="`/edit-stylist/${stylist.id}`" class="action-button">
              <i class="fas fa-edit"></i> <span>Edit</span>
            </router-link>
            <button @click="deleteStylist(stylist.id)" class="action-button">
              <i class="fas fa-trash"></i> <span>Delete</span>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <h1>Recommended Styles</h1>
    <button @click="fetchRecommendations" class="recommend-button">
      <i class="fas fa-sync"></i> <span>Get Recommendations</span>
    </button>
    <div v-if="loading" class="loading">Loading...</div>
    <div v-if="error" class="error">{{ error }}</div>
    <div v-if="recommendations.length" class="recommendations">
      <div v-for="recommendation in recommendations" :key="recommendation.id" class="recommendation">
        <h2>{{ recommendation.title }}</h2>
        <p>{{ recommendation.description }}</p>
        <img :src="recommendation.image" alt="Style Image" class="style-image">
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      stylists: [],
      recommendations: [],
      loading: false,
      error: null
    };
  },
  created() {
    this.fetchStylists();
  },
  methods: {
    fetchStylists() {
      axios.get('/stylists')
        .then(response => {
          this.stylists = response.data;
        })
        .catch(error => {
          console.error('Error fetching stylists:', error.response || error.message);
        });
    },
    deleteStylist(id) {
      axios.delete(`/stylists/${id}`)
        .then(() => {
          this.fetchStylists();
        });
    },
    fetchRecommendations() {
      this.loading = true;
      this.error = null;

      // Fetch current wardrobe items from your backend
      axios.get('/clothing-items')
        .then(response => {
          const wardrobeItems = response.data;

          // Send a request to the external styling API with the wardrobe items
          return axios.post('https://api.fashionrecommender.com/recommend', { items: wardrobeItems });
        })
        .then(response => {
          this.recommendations = response.data;
          this.loading = false;
        })
        .catch(error => {
          this.error = 'Failed to fetch recommendations';
          this.loading = false;
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

.clothing-table {
  width: 100%;
  max-width: 800px;
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
</style>