<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Money\Currency;
use Money\Money;

class Productos{
	public $title;
	public $excerpt;
	public $date;
	public $body;
	public $slug;

	public function __construct($title,$excerpt,$date,$body,$slug)
	{
		$this->title = $title;
		$this->excerpt = $excerpt;
		$this->date = $date;
		$this->body = $body;
		$this->slug = $slug;
	}

	public static function all()
	{
		return cache()->remember('productos.all',20,function(){
			return collect(File::files(resource_path("catalogo")))
		        ->map(fn($file)=>YamlFrontMatter::parseFile($file))
		        ->map(fn($document)=>new Productos(
		                $document->title,
		                $document->excerpt,
		                $document->date,
		                $document->body(),
		                $document->slug,
		    ))->sortByDesc('date');
		});
	}

	public static function money()
	{
		$fiver = Money::EUR(500.00);
	}

	public static function find($slug)
	{
       return static::all()->firstWhere('slug',$slug);
	}

	public static function findOrFail($slug)
	{
		$producto = Productos::find($slug);

        if (!$producto) {
        	return abort(404);
        }

        return $producto;
	}

}