<h1>Obras de Arte (Harvard Museum)</h1>

<form method="GET" action="{{ url('/apis.harvard_index') }}" style="margin-bottom: 2rem;">
    <label>Buscar por artista:</label>
    <input type="text" name="artist" value="{{ $artist ?? '' }}" placeholder="Ej. Rembrandt, Da Vinci">
    <button type="submit">Buscar</button>
</form>

@forelse ($artworks as $art)
    <div style="margin-bottom: 2rem;">
        <h3>{{ $art['title'] ?? 'Sin título' }}</h3>
        <p><strong>Artista:</strong> {{ $art['people'][0]['name'] ?? 'Desconocido' }}</p>
        <p><strong>Año:</strong> {{ $art['dated'] ?? 'Desconocido' }}</p>
        @if (isset($art['primaryimageurl']))
            <img src="{{ $art['primaryimageurl'] }}" style="max-width: 300px;">
        @endif
    </div>
@empty
    <p>No se encontraron resultados.</p>
@endforelse
