<x-layout title="Solice">

    @foreach($trails as $trail)
        {{ $trail->name }}
    @endforeach

    @include('partials.navigation')
        <section class="h-screen relative bg-cover bg-center bg-no-repeat bg-[url('https://cdn.suwalls.com/wallpapers/nature/path-in-the-forest-15174-1920x1080.jpg')]">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="relative isolate px-6 pt-14 lg:px-8">
                <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
                    <div class="text-center">
                        <h1 class="text-balance text-4xl font-bold tracking-tight text-white sm:text-6xl drop-shadow-lg">Welcome to Solice.</h1>
                        <p class="mt-6 text-lg text-white leading-8">We offer the best Hiking Trails for you to explore. Get to exploring!</p>
                        <div class="mt-10 flex items-center justify-center gap-x-6">
                            <a href="#" class="rounded-md bg-green-700 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Get started</a>
                            <a href="#" class="text-sm text-white font-semibold leading-6">Learn more about us! <span aria-hidden="true">→</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('partials.footer')
</x-layout>
