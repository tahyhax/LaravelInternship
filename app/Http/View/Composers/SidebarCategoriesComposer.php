<?php

namespace App\Http\View\Composers;

use App\Models\Category;
use Illuminate\View\View;

class SidebarCategoriesComposer
{
    /**
     * The category model.
     *
     * @var $category
     */
    protected $category;

    /**
     * Create a new profile composer.
     *
     * @param  Category $category
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $categories = $this->category->with(['products', 'children'])->withCount('products')
            ->rootLevel()
            ->get();
        $view->with('categories', $categories);
    }
}