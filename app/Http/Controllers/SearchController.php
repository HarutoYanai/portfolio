<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\RecipeHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use RakutenRws_Client;
//require_once dirname(__FILE__, 4) . '/vendor/rakuten-ws/rws-php-sdk/autoload.php';

class SearchController extends Controller
{
    public function top() {
        return view('project.top');
    }

    public function search(Category $category, Request $request) {
        //楽天APIクライアントの作成
        $client = new RakutenRws_Client();
        $client->setApplicationId(config('app.rakuten_app_id'));
        
        //categoryId取得
        $categoryId = $category->where('category_name', $request['ingredient'])->select('category_id')->first();
        //dd($categoryId['category_id']);
        if (!$categoryId) {
            echo 'そのIDは無効です';
        } else {

            //入力パラメータの指定
            $response = $client->execute('RecipeCategoryRanking', array(
                'categoryId' => $categoryId['category_id'],
    
            ));
    
            if ($response->isOk()) {
                //出力パラメータを変数に格納
                
                foreach($response as $result) {
                    $recipes[] = [
                    'user_id' => auth()->id(),
                    'ingredient' => $request['ingredient'],
                    'recipe_id' => $result['recipeId'],
                    'recipe_title' => $result['recipeTitle'],
                    'recipe_url' => $result['recipeUrl'],
                    'image_url' => $result['mediumImageUrl'],
                    //'recipe_description' => $result['recipeDescription'],
                    'recipe_material' => $result['recipeMaterial'],
                    //'recipe_indication' =>$result['recipeCost'],
                    //'recipe_cost' => $result['recipeCost'],
                    //'recipe_publishday' => $result['recipePublishday'],
                    'rank' => $result['rank'],
                    ];
                }
                //dd($recipes);
                
                //recipe_hitoriesテーブルに保存
                foreach($recipes as $data) {
                    //データが既に格納されているかチェック
                    $existing = RecipeHistory::where('recipe_id', $data['recipe_id'])->first();
                    
                    if($existing) {
                        $existing->fill($data)->update();
                    } else {
                        $recipeHistory = new RecipeHistory;
                        $recipeHistory->fill($data)->save();
                    }
                }
                
                //view表示
                return view('project.index')->with('recipes', $recipes);
                
            } else  {
                echo 'Error:'. $response->getMessage();
            }
        }
    }

    public function show(RecipeHistory $recipeHistory) {
        //dd($recipeHistory);
        return view('project.view')->with('recipe', $recipeHistory);
       
    }

}


