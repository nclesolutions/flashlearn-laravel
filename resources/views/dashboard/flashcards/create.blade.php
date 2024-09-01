<!-- resources/views/dashboard/flashcards/create.blade.php -->

<div class="container">
    <h1>Nieuwe Flitskaarten</h1>
    <form action="{{ route('dashboard.flashcards.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="subject_id" class="form-label">Vak</label>
            <select name="subject_id" id="subject_id" class="form-control" required>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->vak_naam }}</option>
                @endforeach
            </select>
        </div>
        <div id="flashcard-container">
            <div class="flashcard">
                <div class="mb-3">
                    <label for="flashcards[0][question]" class="form-label">Vraag</label>
                    <input type="text" name="flashcards[0][question]" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="flashcards[0][answer]" class="form-label">Antwoord</label>
                    <input type="text" name="flashcards[0][answer]" class="form-control" required>
                </div>
            </div>
        </div>
        <button type="button" id="add-flashcard" class="btn btn-secondary mb-3">Voeg nog een flitskaart toe</button>
        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>
</div>

<script>
    let flashcardIndex = 1;

    document.getElementById('add-flashcard').addEventListener('click', function() {
        const flashcardContainer = document.getElementById('flashcard-container');
        const newFlashcard = document.createElement('div');
        newFlashcard.classList.add('flashcard');
        newFlashcard.innerHTML = `
            <div class="mb-3">
                <label for="flashcards[${flashcardIndex}][question]" class="form-label">Vraag</label>
                <input type="text" name="flashcards[${flashcardIndex}][question]" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="flashcards[${flashcardIndex}][answer]" class="form-label">Antwoord</label>
                <input type="text" name="flashcards[${flashcardIndex}][answer]" class="form-control" required>
            </div>
        `;
        flashcardContainer.appendChild(newFlashcard);
        flashcardIndex++;
    });
</script>