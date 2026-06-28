<?php

use App\Models\Category;
use App\Models\Book;

$books = Book::where('category_id', 11)->update(['category_id' => 7]);
echo "Updated $books books from category 11 to 7.\n";

$cat11 = Category::find(11);
if ($cat11) {
    $cat11->delete();
    echo "Deleted category 11 (Ilmu Terapan).\n";
}
