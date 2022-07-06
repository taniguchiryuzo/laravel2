<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Recipe;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecipeController extends Controller
{
    //
    public function show(Recipe $recipe)
    {
        // TODO: ここに表示用ロジックをつくる（今はテスト）

        $recipe->load('ingredients');
        dd($recipe->toArray());
    }

    public function create()
    {
        return view('recipe.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'ingredients' => ['required'],
            'ingredients.*' => ['required', 'distinct'],
        ]);

        $result = false;

        DB::beginTransaction();

        try {

            $recipe = new Recipe();
            $recipe->name = $request->name;
            $recipe->save();

            foreach ($request->ingredients as $ingredient_name) {

                $ingredient = new Ingredient();
                $ingredient->recipe_id = $recipe->id;
                $ingredient->name = $ingredient_name;
                $ingredient->save();

            }

            DB::commit();
            $result = true;

        } catch (\Exception $e) {

            DB::rollBack();

        }

        return ['result' => $result];
    }
}
