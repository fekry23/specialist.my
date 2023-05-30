<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;

    //https://laravel.com/docs/10.x/eloquent#mass-assignment
    // https://stackoverflow.com/questions/22279435/what-does-mass-assignment-mean-in-laravel
    protected $fillable = [
        'title', 'state', 'description', 'category', 'type', 'rate', 'exp_level', 'project_length', 'skills', 'employer_id'
    ];

    protected $guarded = [
        'id', 'employer_id', 'created_at', 'updated_at'
    ];

    //https://laravel.com/docs/5.0/eloquent#query-scopes
    // array $filters dapat dari file nama app/Controller/ListingController.php
    public function scopeFilter($query, array $filters)
    {
        //https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/Nullish_coalescing
        if ($filters['keywords'] ?? false) {
            //             where: This is a method on the query builder that adds a WHERE clause to the query.
            // 'tags': This is the name of the column in the table that we want to filter on.
            // 'like': This is a comparison operator that checks if the value in the column is similar to a pattern.
            // '%'.request('tag'). '%': This is the pattern we're using to compare against the values in the 'tags' column. 
            // The request('tag') method is getting the value of the 'tag' parameter from the HTTP request. 
            // The % symbols are wildcard characters that match any number of characters before or after the tag value.
            $query->where('title', 'like', '%' . request('keywords') . '%')
                ->orWhere('description', 'like', '%' . request('keywords') . '%')
                ->orWhere('skills', 'like', '%' . request('keywords') . '%')
                ->orWhere('category', 'like', '%' . request('keywords') . '%');
            //This is similar to SELECT * FROM table_name WHERE tags LIKE '%tag_value%'
        }

        if ($filters['skills'] ?? false) {
            $query->where('skills', 'like', '%' . request('skills') . '%');
            //This is similar to SELECT * FROM table_name WHERE tags LIKE '%tag_value%'
        }

        if ($filters['category'] ?? false) {
            $category = explode(',', $filters['category']); // split the types into an array
            $query->whereIn('category', $category); // use whereIn to match multiple types
            //This is similar to SELECT * FROM table_name WHERE category LIKE '%category%'
        }


        // 
        if ($filters['state'] ?? false) {
            $state = explode(',', $filters['state']); // split the types into an array
            $query->whereIn('state', $state); // use whereIn to match multiple types
            //This is similar to SELECT * FROM table_name WHERE category LIKE '%category%'
        }

        if ($filters['type'] ?? false) {
            // dd($filters['type']);
            $types = explode(',', $filters['type']); // split the types into an array
            $query->whereIn('type', $types); // use whereIn to match multiple types
            //This is similar to SELECT * FROM table_name WHERE category LIKE '%category%'
        }

        if ($filters['skill'] ?? false) {
            // dd($filters['type']);
            $skill = explode(',', $filters['skill']); // split the types into an array
            $query->whereIn('skills', $skill); // use whereIn to match multiple types
            //This is similar to SELECT * FROM table_name WHERE category LIKE '%category%'
        }

        if ($filters['experience'] ?? false) {

            $experience = explode(',', $filters['experience']); // split the types into an array
            $query->whereIn('exp_level', $experience); // use whereIn to match multiple types
            //This is similar to SELECT * FROM table_name WHERE category LIKE '%category%'
        }

        //Modified later after have employer database !!!!!
        //Modified later after have employer database !!!!!
        //Modified later after have employer database !!!!!
        // if ($filters['history'] ?? false) {

        //     $query->where('exp_level', 'like', '%' . request('experience') . '%');
        //     //This is similar to SELECT * FROM table_name WHERE category LIKE '%category%'
        // }

        if ($filters['length'] ?? false) {

            $length = explode(',', $filters['length']); // split the types into an array
            $query->whereIn('project_length', $length); // use whereIn to match multiple types
            //This is similar to SELECT * FROM table_name WHERE category LIKE '%category%'
        }
    }
}
