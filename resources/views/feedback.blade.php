@extends('authLayout')

@section('title','Feedback')

@section('content')
    <div class="container">
        <h1>Donner votre feedback pour l'intervention #{{ $intervention->id }}</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (!$intervention->feedback)
            <form action="{{ route('feedback.submit', $intervention->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="feedback">Feedback</label>
                    <textarea name="feedback" id="feedback" class="form-control" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Soumettre</button>
            </form>
        @else
            <p>Vous avez déjà soumis un feedback pour cette intervention.</p>
        @endif
    </div>
@endsection
