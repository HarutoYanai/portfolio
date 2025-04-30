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
                <a href="/search/{{ $recipe['recipe_id'] }}">
                    <h2>{{ $recipe['recipe_title'] }} </h2>
                </a>
            </div>
            <div class="">
                <a href="/search/{{ $recipe['recipe_id'] }}">
                    <img src="{{ $recipe['image_url'] }}">
                </a>
            </div>
        @endforeach
    </div>
</x-app-layout>