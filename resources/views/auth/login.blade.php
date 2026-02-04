<x-layout title="Login">
    <div class="container">
        <form method="POST" action="{{ route('login') }}" class="col-md-6 mx-auto">
            @csrf

            <input name="email" type="email" class="form-control mb-3" placeholder="Email">
            <input name="password" type="password" class="form-control mb-3" placeholder="Password">

            <button class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</x-layout>
