<!-- resources/views/dashboard/flashcards/answer_result.blade.php -->

<div class="container">
    <h1>Resultaten</h1>
    @if($correct)
        <p>Correct! Je hebt {{ $points }} punten verdiend.</p>
    @else
        <p>Helaas, dat was niet correct. Geen punten verdiend.</p>
    @endif

    @if($finished)
        <p>Goed gedaan! Je hebt alle flitskaarten van dit vak voltooid.</p>
        <a href="{{ route('dashboard.flashcards.result', $subject->id) }}" class="btn btn-primary">Bekijk totaalresultaat</a>
    @else
        <a href="{{ route('dashboard.flashcards.start', $subject->id) }}" class="btn btn-primary">Volgende Flitskaart</a>
    @endif
</div>
