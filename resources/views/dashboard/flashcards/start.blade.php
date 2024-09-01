<!-- resources/views/dashboard/flashcards/start.blade.php -->

<div class="container">
    <h1>{{ $subject->vak_naam }} - Beantwoorden</h1>
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $flashcard->question }}</h5>
            <form action="{{ route('dashboard.flashcards.answer', $subject) }}" method="POST">
                @csrf
                <input type="hidden" name="flashcard_id" value="{{ $flashcard->id }}">
                <div class="mb-3">
                    <input type="text" name="answer" class="form-control" placeholder="Uw antwoord" required>
                </div>
                <button type="submit" class="btn btn-primary">Antwoord</button>
            </form>
        </div>
    </div>
</div>
