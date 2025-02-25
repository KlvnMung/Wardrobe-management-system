<template>
    <div>
        <h1>Clothing Items</h1>
       <ul> 
        <li v-for="item in items" :key="item.id">
            {{ item.name }} - {{ item.category }} - {{ item.size }} - {{ item.color }} 
            <button @click="deleteItem(item.id)">Delete</button>

        </li>
       </ul>
       <router-link to="/add">Add Item</router-link>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data(){
        return {
            items: []
        };
    },
    created(){
        this.fetchItems();
    },
    methods:{
        fetchItems(){
            axios.get('/clothing-items')
            .then(response => {
                this.items = response.data;
            });
        },
        deleteItem(id){
            axios.delete(`/clothing-items/${id}`)
            .then(() => {
                this.fetchItems();
            });
        }
    }
}
</script>