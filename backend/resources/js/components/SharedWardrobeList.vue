<template>
  <div class="container">
    <h1>Shared Wardrobes</h1>
    <router-link to="/share-wardrobe" class="add-button">
      <i class="fas fa-plus"></i> <span>Share Wardrobe</span>
    </router-link>
    <div class="invite-section">
      <input type="email" v-model="inviteEmail" placeholder="Enter email to invite" class="invite-input">
      <button @click="sendInvitation" class="invite-button">Invite</button>
    </div>
    <table class="clothing-table">
      <thead>
        <tr>
          <th>Friend</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="sharedWardrobe in sharedWardrobes" :key="sharedWardrobe.id">
          <td>{{ sharedWardrobe.friend.name }}</td>
          <td>
            <button @click="unshareWardrobe(sharedWardrobe.id)" class="action-button">
              <i class="fas fa-trash"></i> <span>Unshare</span>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      sharedWardrobes: [],
      inviteEmail: '',
      loading: false,
      error: null
    };
  },
  created() {
    this.fetchSharedWardrobes();
  },
  methods: {
    fetchSharedWardrobes() {
      axios.get('/shared-wardrobes')
        .then(response => {
          this.sharedWardrobes = response.data;
        })
        .catch(error => {
          console.error('Error fetching shared wardrobes:', error.response || error.message);
        });
    },
    unshareWardrobe(id) {
      axios.delete(`/shared-wardrobes/${id}`)
        .then(() => {
          this.fetchSharedWardrobes();
        })
        .catch(error => {
          console.error('Error unsharing wardrobe:', error.response || error.message);
        });
    },
    sendInvitation() {
      if (!this.inviteEmail) {
        alert('Please enter an email address.');
        return;
      }

      axios.post('/shared-wardrobes/invite', { email: this.inviteEmail })
        .then(response => {
          alert('Invitation sent successfully.');
          this.inviteEmail = '';
        })
        .catch(error => {
          console.error('Error sending invitation:', error.response || error.message);
          alert('Failed to send invitation. Please try again later.');
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

.add-button {
  display: flex;
  align-items: center;
  background-color: #28a745;
  color: white;
  padding: 0.5rem 1rem;
  text-decoration: none;
  border-radius: 5px;
  font-size: 1rem;
  margin-bottom: 20px;
}

.add-button i {
  margin-right: 5px;
}

.add-button:hover {
  background-color: #218838;
}

.invite-section {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
}

.invite-input {
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 1rem;
  margin-right: 10px;
}

.invite-button {
  background-color: #007bff;
  color: white;
  padding: 0.5rem 1rem;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.invite-button:hover {
  background-color: #0056b3;
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
</style>