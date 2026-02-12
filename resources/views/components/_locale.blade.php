<form action="{{ route('set.locale', $lang) }}"
      method="POST"
      class="d-inline">
    @csrf

    <button type="submit"
            class="btn btn-link p-0 border-0">

        <img src="{{ asset("vendor/blade-flags/$lang.svg") }}"
             width="25"
             alt="{{ $lang }}">
    </button>
</form>
