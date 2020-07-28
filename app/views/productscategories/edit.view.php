<form class="f-row form-style products-categories-edit" method="post" autocomplete="off">
    <span class="form-title bn">{ text_title_form }</span>
    <div class="input-group-s col-md-down-1 col-md-up-2">
        <label >{ label_name }</label>
        <input type="text" name="name" value="{ ProductCategory->Name }" min="3" max="40"  data-pattern="^[A-z \u0600-\u06FF]{3,40}$" >
    </div>

    <div class="input-group-s col-md-down-1 col-md-up-2">
        <label>{ label_sub_category_name }</label>
        <select name="subcategory">
            <option value="0">{ label_no_sub_category }</option>
            @foreach (#ProductsCategories as $ProductCategory)
                @if ($ProductCategory->ProductCategoryParentId == 0)
                    <option value="{! $ProductCategory->ProductCategoryId !}" @if ($ProductCategory->ProductCategoryId == #ProductCategory->ProductCategoryParentId):  selected @endif > {! $this->getGet('name'); !} {! $ProductCategory->Name !} </option>
                @endif
            @endforeach
        </select>
    </div>

    <div class="input-group-s col-md-down-1 col-md-up-2">
        <label >{ label_description }</label>
        <input type="text" name="description" value="{ ProductCategory->Name }" min="0" max="5000"  data-pattern="^[\w\(\):?!\- \u0600-\u06FF]{0,5000}$" >
    </div>

    <div class="input-submit-p">
        <input type="submit" class="bn b-primary-submit" name="submit" value="{ text_save }" >
    </div>

</form>
