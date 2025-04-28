<x-app-layout>
    <div class="">
        <h1>検索結果</h1>
    </div>
    <div class="">
            <p>{{ $recipes[0]['ingredient'] }}から作れるレシピ</p>
    </div>
    <div class="">
        @foreach ($recipes as $recipe)
            <div class="">
                <a href="{{ $recipe['url'] }}">
                    <h2>{{ $recipe['title'] }} </h2>
                </a>
            </div>
            <div class="">
                <a href="{{ $recipe['url'] }}">
                    <img src="{{ $recipe['image'] }}">
                </a>
            </div>
        @endforeach
    </div>
</x-app-layout>