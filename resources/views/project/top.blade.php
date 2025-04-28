<x-app-layout>
    <div class="">
        <p>Freige</p>
        <p>{{ Auth::user()->name }}でログイン中</p>
    </div>
    <div class="">
        <div class="">
            <h1>余っている食材からレシピを検索</h1>
            <p>食材を入力してください</p>
        </div>
        <form action="/search" method="get" class="">
            @csrf
            <div class="">
                <input type="text" name="ingredient" placehodler="（例：レタス、豚バラ、牛乳）" />
            </div>
            <div class="">
                <input type="submit" value="検索"/>
            </div>
        </form>
    </div>
</x-app-layout>
