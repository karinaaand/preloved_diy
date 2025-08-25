<form method="POST" action="/register">
  @csrf
  <input name="name" placeholder="Nama"><br>
  <input name="email" type="email" placeholder="Email"><br>
  <input name="password" type="password" placeholder="Password"><br>
  <button type="submit">Register</button>
</form>
