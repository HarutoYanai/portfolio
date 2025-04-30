<x-app-layout>
    <div class="">
        <p>{{ $recipe->recipe_title }}</p>
    </div>

    <div class="">
        <img src="{{ $recipe->image_url }}">
    </div>
    <div class="">
        <p>ランキング：{{ $recipe->rank }}位</p>
    </div>

    <div class="">
        <div class="">
            <p>材料</p>
        </div>
        <div class="">
            @foreach($recipe['recipe_material'] as $material)
                <p>{{ $material }}</p>
            @endforeach
        </div>
    </div>

    <div class="">
        <div class="">
            <p>詳しい調理方法はこちら</p>
        </div>
        <div class="">
            <a href="{{ $recipe->recipe_url }}">こちら</a>
        </div>
    </div>

</x-app-layout>">