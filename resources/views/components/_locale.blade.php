@php
    $flag = $lang;

    if($lang === 'en'){
        $flag = 'gb';   
    }
@endphp

<form action="{{ route('set.locale', $lang) }}"
      method="POST"
      class="d-inline">
    @csrf

    <button type="submit"
            class="btn btn-link p-0 border-0">

        <img src="{{ asset('vendor/blade-flags/country-' . $flag . '.svg') }}"
             width="25"
             alt="{{ $lang }}"
             class="rounded shadow-sm">
    </button>
</form>
