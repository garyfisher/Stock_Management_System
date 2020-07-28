<div class="actions">
    <a class="b-primary-upt bn" href="/ProductsCategories/Create/">{ text_new_category }</a>
</div>

<div class="card">
    <div class="card-header">
        <span>{ text_card_title }</span>
        <div class="card-header-control">
            <div class="card-control-view">
                { text_view } : <span>{ text_classic }</span> | <span>{ text_full }</span>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if (!empty(#ProductsCategories))
            @foreach (#ProductsCategories as $ProductCategory)
                @if ($ProductCategory->ProductCategoryParentId == 0)
                    <div class="card-category">
                        <h3>{! $ProductCategory->Name !}</h3>
                        @if ($ProductCategory->Description != '')
                            <p>{!$ProductCategory->Description!}</p>
                        @endif
                        <span class="card-control">
                            <a href="/ProductsCategories/Edit/?id={! $ProductCategory->ProductCategoryId !}">
                                <i class="far fa-edit"></i>
                            </a>
                            <a href="/ProductsCategories/Delete/?id={! $ProductCategory->ProductCategoryId !}" onclick="return confirm('do you want delete this product Category')">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </span>
                    </div>
                @endif
            @endforeach
        @else
            <div class="not-found-category">
                <span>Brak kategorii</span>
            </div>
        @endif
    </div>
</div>

<div class="card" style="margin-top: 15px;">
    <div class="card-header">
        <span>{ text_card_sub_title }</span>
        <div class="card-header-control">
            <div class="card-control-view">
                { text_view } : <span>{ text_classic }</span> | <span>{ text_full }</span>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if (!empty(#ProductsCategories))
            @foreach (#ProductsCategories as $ProductCategory)
                @if ($ProductCategory->ProductCategoryParentId > 0)
                    <div class="card-category">
                        <h3> @if (\Store\Models\ProductsCategoriesModel::getColByKey('Name',$ProductCategory->ProductCategoryParentId)): {! \Store\Models\ProductsCategoriesModel::getColByKey('Name',$ProductCategory->ProductCategoryParentId) !} @else { text_category_notfound } @endif / {! $ProductCategory->Name !}</h3>
                        @if ($ProductCategory->Description != '')
                            <p>{!$ProductCategory->Description!}</p>
                        @endif
                        <span class="card-control">
                            <a href="/ProductsCategories/Edit/?id={! $ProductCategory->ProductCategoryId !}">
                                <i class="far fa-edit"></i>
                            </a>
                            <a href="/ProductsCategories/Delete/?id={! $ProductCategory->ProductCategoryId !}" onclick="return confirm('do you want delete this product Category')">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </span>
                    </div>
                @endif
            @endforeach
        @else
            <div class="not-found-category">
                <span>Brak kategorii</span>
            </div>
        @endif
    </div>
</div>