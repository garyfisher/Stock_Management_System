<div class="actions">
    <a class="b-primary-upt bn" href="/products/Create/">{ text_new_product }</a>
</div>

<table id="products" class="display compact responsive dataTableEnable" style="width:100%">
    <thead>
    <tr>
        <!-- <th width="100px">{ text_product_id }</th> -->
        <th>{ text_kod }</th>
        <th>{ text_title }</th>
        <th>{ text_category_name }</th>
        <th>{ text_sub_category_name }</th>
        <th>{ text_warehouse_name }</th>
        <th>{ text_frame }</th>
        <!-- <th>{ text_made_country }</th> -->
        <th>{ text_quantity }</th>
        <th>{ text_quantity_order }</th>
        <th>{ text_quantity_reservation }</th>
        <!--<th>{ text_barcode }</th>
        @tax_allow
        <th>{ text_tax }</th>
        @end -->
        <th>{ text_reservation }</th>
        <th>{ text_buy_price }</th>
        <th>{ text_sell_price }</th>
        <th>{ text_promo_price }</th>
        <th>{ text_added_date }</th>
        <th>{ text_status }</th>
        <th>{ text_control }</th>
    </tr>
    </thead>
    <tbody>

    @foreach (#Products as $Product)
    <tr @if ($Product->ReservationId == 2) style="background-color: LightGray;" @endif
        @if ($Product->TypeId == 1) style="background-color: violet;" @endif >
        <!-- <td>{! $Product->ProductId !}</td> -->
        <td data-cut-title="15"><a href="/products/Preview/?id={! $Product->ProductId !}" data-top-title="{ title_preview }">{! $Product->kod !}</a></td>
        <td data-cut-title="45"><a href="/products/Preview/?id={! $Product->ProductId !}" data-top-title="{ title_preview }">{! $Product->Title !}</a></td>
        <td data-cut-title="45">{! $Product->Name !}</td>
        <td> @if (\Store\Models\ProductsCategoriesModel::getColByKey('Name',$Product->SubCategoryId)): {! \Store\Models\ProductsCategoriesModel::getColByKey('Name',$Product->SubCategoryId) !} @endif </td>
        <td>{! $Product->NameWarehouses !}</td>
        <td>{ array_frame[$Product->FrameId] }</td>
        <!-- <td>{ countries[$Product->MadeCountry] }</td> -->
        <td @if ($Product->ReservationId == 2) style="background-color: LightGray;" @endif
            @if ($Product->TypeId == 1) style="background-color: violet;" @endif
                 data-bottom-title="{! self::format_quantity($Product->Quantity) _ $Product->UnitName !}" ><bdi>{! self::format_quantity($Product->Quantity) _ $Product->UnitCode !}</bdi></td>
        <td data-bottom-title="{! self::format_quantity($Product->QuantityOrder) _ $Product->UnitName !}" ><bdi>{! self::format_quantity($Product->QuantityOrder) _ $Product->UnitCode !}</bdi></td>
        <td data-bottom-title="{! self::format_quantity($Product->QuantityReservation) _ $Product->UnitName !}" ><bdi>{! self::format_quantity($Product->QuantityReservation) _ $Product->UnitCode !}</bdi></td>
        <td @if (!empty($Product->Comment))
                 data-bottom-title="{! $Product->Comment !}" @endif >{ array_reservation[$Product->ReservationId] } @if (!empty($Product->Comment)) <b>INFO</b> @endif </td>
        <!-- <td>{! $Product->Barcode !}</td>
        @tax_allow
        <td>@number_parse ($Product->Tax)</td>
        @end -->
        <td style="font-weight: bolder;">@currency_input ($Product->BuyPrice)</td>
        <td>@currency_input ($Product->SellPrice)</td>
        @if ($Product->PromoPrice > 0)
            <td style="font-weight: bolder;color: #5600ff;">@currency_input ($Product->PromoPrice)</td>
        @else
            <td>brak</td>
        @endif
        <td data-bottom-title="{ on_time } @time_format ($Product->AddedDate)">@date_format ($Product->AddedDate)</td>
        <td>{ array_status[$Product->StatusId] }</td>
        <td>
        @if (!empty($Product->WwwUrl))
            <a href="{! $Product->WwwUrl !}" data-top-title="{ title_wwwurl }" target="_blank"><i class="fa fa-globe"></i></a>
        @endif
        @if ($Product->Allegro > 0)
            <a href="https://allegro.pl/oferta/{! $Product->Allegro !}" data-top-title="{ title_allegro }" target="_blank"><i class="fa fa-balance-scale"></i></a>
        @endif
            <a href="/products/Preview/?id={! $Product->ProductId !}" data-top-title="{ title_preview }"><i class="far fa-eye"></i></a>
            <a href="/products/Edit/?id={! $Product->ProductId !}" data-top-title="{ title_edit }"><i class="far fa-edit"></i></a>
            <a href="/products/Delete/?id={! $Product->ProductId !}" data-top-title="{ title_delete }" onclick="return confirm('do you want delete this Product')"><i class="far fa-trash-alt"></i></a>
        </td>

    </tr>
    @endforeach
    </tbody>
</table>


