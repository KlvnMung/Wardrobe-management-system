<template>
  <div class="landing-container">
    <header>
      <h1>Welcome to the Wardrobe Management System</h1>
      <p>Organize your wardrobe effortlessly and stylishly.</p>
    </header>
    <section class="features">
      <h2>Features</h2>
      <ul>
        <li>Track and manage your clothing items with ease.</li>
        <li>add new clothes with ease</li>
        <li>Search for clothes in your wardrobe</li>
        <li>Keep an inventory of your wardrobe and avoid duplicates.</li>
        
      </ul>
    </section>
    <footer>
      <p>Join us today and revolutionize the way you manage your wardrobe!</p>
      <div class="buttons">
        <router-link to="/login" class="button">Login</router-link>
        <router-link to="/register" class="button">Sign Up</router-link>
      </div>
    </footer>
  </div>
</template>

<script>
export default {
  name: 'LandingPage'
};
</script>

<style>
.landing-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 20px;
  text-align: center;
  font-family: 'Arial', sans-serif;
  color: #333;
}

header {
  margin-bottom: 40px;
}

header h1 {
  font-size: 2.5rem;
  margin-bottom: 10px;
}

header p {
  font-size: 1.2rem;
  color: #666;
}

.features {
  margin-bottom: 40px;
}

.features h2 {
  font-size: 2rem;
  margin-bottom: 20px;
}

.features ul {
  list-style-type: none;
  padding: 0;
}

.features li {
  font-size: 1.1rem;
  margin-bottom: 10px;
}

footer {
  margin-top: 40px;
}

footer p {
  font-size: 1.2rem;
  margin-bottom: 20px;
}

.buttons {
  display: flex;
  gap: 20px;
}

.button {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  text-decoration: none;
  border-radius: 5px;
  font-size: 1rem;
  cursor: pointer;
}

.button:hover {
  background-color: #0056b3;
}
</style>