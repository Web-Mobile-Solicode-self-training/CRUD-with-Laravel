@extends('layouts.app')

@section('content')
  <div class="card">
    <h2>{{ $title }}</h2>
    <p>Vous pouvez nous contacter via le formulaire ci-dessous :</p>

    <form method="POST" action="#">
      @csrf
      <label for="name">Nom :</label><br>
      <input type="text" id="name" name="name" required><br><br>

      <label for="email">Email :</label><br>
      <input type="email" id="email" name="email" required><br><br>

      <label for="message">Message :</label><br>
      <textarea id="message" name="message" rows="4" cols="40" required></textarea><br><br>

      <button type="submit">Envoyer</button>
    </form>
  </div>
@endsection
