@component('mail::message')
# {{ $nomeSerie }} criada

A série {{ $nomeSerie }} com {{ $qtdTemporadas }} temporadas e {{ $episodiosPorTemporada }} episódios foi criada.

Acesse aqui:

@component('mail::button', ['url' => route('seasons.index', $idSerie)])
    Ver série
@endcomponent
@endcomponent