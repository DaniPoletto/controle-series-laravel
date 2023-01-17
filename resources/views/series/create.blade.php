<x-layout title="Nova Série">
    <form action="{{ route('series.store') }}" method="post">
        @csrf

        <div class="row mb-3">
            <div class="col-8">
                <label for="nome" class="form-label">Nome:</label>
                <input
                    autofocus
                    type="text"
                    id="nome"
                    name="nome"
                    class="form-control" 
                    value="{{ old('nome') }}"
                >
            </div>
            <div class="col-2">
                <label for="seasonsQty" class="form-label">Nº de Temporadas:</label>
                <input
                    type="text"
                    id="seasonsQty"
                    name="seasonsQty"
                    class="form-control" 
                    value="{{ old('seasonsQty') }}"
                >
            </div>
            <div class="col-2">
                <label for="episodesPerSeason" class="form-label">Episódios por temporada:</label>
                <input
                    type="text"
                    id="episodesPerSeason"
                    name="episodesPerSeason"
                    class="form-control" 
                    value="{{ old('episodesPerSeason') }}"
                >
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>
</x-layout>