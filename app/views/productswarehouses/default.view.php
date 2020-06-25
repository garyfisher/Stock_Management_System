<div class="actions">
    <a class="b-primary-upt bn" href="/ProductsWarehouses/Create/">{ text_new_warehouse }</a>
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
        @if (!empty(#ProductsWarehouses))
            @foreach (#ProductsWarehouses as $ProductWarehouse)
            <div class="card-category">
                <h3>{! $ProductWarehouse->Name !}</h3>
                @if ($ProductWarehouse->Description != '')
                <p>{!$ProductWarehouse->Description!}</p>
                @endif
                <span class="card-control">
                    <a href="/ProductsWarehouses/Edit/?id={! $ProductWarehouse->ProductWarehouseId !}">
                        <i class="far fa-edit"></i>
                    </a>
                    <a href="/ProductsWarehouses/Delete/?id={! $ProductWarehouse->ProductWarehouseId !}" onclick="return confirm('do you want delete this product Category')">
                        <i class="far fa-trash-alt"></i>
                    </a>
                </span>
            </div>
            @endforeach
        @else
            <div class="not-found-category">
                <span>ليس هناك أي قسم</span>
            </div>
        @endif
    </div>
</div>
