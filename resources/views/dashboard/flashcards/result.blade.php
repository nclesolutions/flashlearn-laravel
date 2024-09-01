<!-- resources/views/dashboard/flashcards/result.blade.php -->

<div class="container">
    <h1>Resultaten voor {{ $subject->name }}</h1>
    <p>Je hebt {{ $correctAnswers }} van de {{ $totalFlashcards }} flitskaarten correct beantwoord!</p>
    <p>Je hebt in totaal {{ auth()->user()->points }} punten verdiend.</p>
    <a href="{{ route('dashboard.flashcards.index') }}" class="btn btn-primary">Terug naar overzicht</a>
</div>
