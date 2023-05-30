<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Trainer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    //https://laravel.com/docs/10.x/eloquent#mass-assignment
    // https://stackoverflow.com/questions/22279435/what-does-mass-assignment-mean-in-laravel
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username', 'name', 'email', 'password', 'state',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function scopeFilter($query, array $filters)
    {

        if ($filters['keywords'] ?? false) {
            //             where: This is a method on the query builder that adds a WHERE clause to the query.
            // 'tags': This is the name of the column in the table that we want to filter on.
            // 'like': This is a comparison operator that checks if the value in the column is similar to a pattern.
            // '%'.request('tag'). '%': This is the pattern we're using to compare against the values in the 'tags' column. 
            // The request('tag') method is getting the value of the 'tag' parameter from the HTTP request. 
            // The % symbols are wildcard characters that match any number of characters before or after the tag value.
            $query->where('name', 'like', '%' . request('keywords') . '%')
                ->orWhere('specialization_title', 'like', '%' . request('keywords') . '%')
                ->orWhere('specialization_description', 'like', '%' . request('keywords') . '%')
                ->orWhere('skills_expertise', 'like', '%' . request('keywords') . '%');
        }

        if ($filters['category'] ?? false) {
            $category = explode(',', $filters['category']); // split the types into an array
            $query->whereIn('category', $category); // use whereIn to match multiple types
            //This is similar to SELECT * FROM table_name WHERE category LIKE '%category%'
        }

        if ($filters['state'] ?? false) {
            $state = explode(',', $filters['state']); // split the types into an array
            $query->whereIn('state', $state); // use whereIn to match multiple types
            //This is similar to SELECT * FROM table_name WHERE category LIKE '%category%'
        }

        if ($filters['rate'] ?? false) {

            $rate = explode(',', $filters['rate']); // split the types into an array
            $query->whereIn('hourly_rate', $rate); // use whereIn to match multiple types
            //This is similar to SELECT * FROM table_name WHERE category LIKE '%category%'
        }

        if ($filters['level'] ?? false) {

            $experience = explode(',', $filters['level']); // split the types into an array
            $query->whereIn('english_level', $experience); // use whereIn to match multiple types
            //This is similar to SELECT * FROM table_name WHERE category LIKE '%category%'
        }
    }
}
