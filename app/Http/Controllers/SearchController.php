<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
                    'ingredient' => $request['ingredient'],
                    'title' => $result['recipeTitle'],
                    'url' => $result['recipeUrl'],
                    'image' => $result['mediumImageUrl'],
                    ];
                }
    
                return view('project.index')->with('recipes', $recipes);
                //var_dump($recipes);
            } else  {
                echo 'Error:'. $response->getMessage();
            }
        }
    }

}


