<?php
use App\Models\Category;

$cats = Category::where('name', 'like', '%Geografi%')->orWhere('name', 'like', '%Sejarah%')->get();

foreach($cats as $c) {
    echo "ID: " . $c->id . " Name: " . $c->name . "\n";
}
