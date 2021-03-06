
<div class="preview-products">
    <div class="actions">
        <!-- <button class="b-primary-upt bn" id="print_products">{ text_print }</button> -->
        <a class="b-primary-upt bn" href="javascript:history.back()" >{ title_back }</a>
        <a class="b-primary-upt bn" href="/products/Edit/?id={ products->ProductId }" >{ title_edit }</a>
        <a class="b-primary-upt bn" href="/products/Delete/?id={ products->ProductId }" onclick="return confirm('do you want delete this Product');" >{ title_delete }</a>
    </div>
    <div id="preview-products" >
        <div class="box-content f-row" id="box-content">
            <div class="bar-code col-1">
                <img id="barcode_preview" data-barcode="{ products->Barcode }">
            </div>

            <div class="col-2 property_products"><b>{ label_kod }</b> : { products->kod }</div>
            <div class="col-2 property_products"><b>{ label_barcode }</b> : { products->Barcode }</div>
            <div class="col-2 property_products"><b>{ label_title }</b> : { products->Title }</div>
            <div class="col-2 property_products"><b>{ label_quantity_in }</b> : { products->UnitName }</div>
            <div class="col-2 property_products"><b>{ label_quantity }</b> : <bdi>@format_num (#products->Quantity) { products->UnitCode }</bdi></div>
            <div class="col-2 property_products"><b>{ label_quantity_order }</b> : <bdi>@format_num (#products->QuantityOrder) { products->UnitCode }</bdi></div>
            <div class="col-2 property_products"><b>{ label_quantity_reservation }</b> : <bdi>@format_num (#products->QuantityReservation) { products->UnitCode }</bdi></div>
            @if (#products->NotificationQuantity != '')
            <div class="col-2 property_products"><b>{ label_notification_quantity }</b> : <bdi>@format_num (#products->NotificationQuantity) { products->UnitCode }</bdi></div>
            @endif
            @if (#products->MadeCountry != '')
            <div class="col-2 property_products"><b>{ label_made_country }</b> : {countries[#products->MadeCountry]}</div>
            @endif
            <div class="col-2 property_products"><b>{ label_category_product }</b> : { products->Name }</div>
            <div class="col-2 property_products"><b>{ label_sub_category_product }</b> : @if (\Store\Models\ProductsCategoriesModel::getColByKey('Name',#products->SubCategoryId)): {! \Store\Models\ProductsCategoriesModel::getColByKey('Name',#products->SubCategoryId) !} @endif </div>
            <div class="col-2 property_products"><b>{ label_warehouse_product }</b> : { products->NameWarehouses }</div>
            <div class="col-1 property_products"></div>
            <div class="col-2 property_products"><b>{ label_buy_price }</b> : @Currency (#products->BuyPrice)</div>
            <div class="col-2 property_products"><b>{ label_sell_price }</b> : @Currency (#products->SellPrice)</div>
            <div class="col-2 property_products"><b>{ label_promo_price }</b> : @Currency (#products->SellPrice)</div>
            @if (#products->Tax != '')
            <div class="col-2 property_products"><b>{ label_tax }</b> : @number_parse (#products->Tax)</div>
            @endif
            <div class="col-1 property_products"></div>
            <div class="col-2 property_products"><b>{ label_www }</b> : { array_www[#products->WwwId] }</div>
            @if (!empty(#products->WwwUrl))
                <div class="col-2 property_products"><b>{ title_wwwurl }</b> :<a href="{ products->WwwUrl }" data-top-title="{ title_wwwurl }" target="_blank"><i class="fa fa-globe"></i></a></div>
            @endif
            @if (#products->Allegro > 0)
                <div class="col-2 property_products"><b>{ title_allegro }</b> :<a href="https://allegro.pl/oferta/{ products->Allegro }" data-top-title="{ title_allegro }" target="_blank"><i class="fa fa-balance-scale"></i></a></div>
            @endif
            <div class="col-2 property_products"><b>{ label_reservation }</b> : { array_www[#products->ReservationId] }</div>
            <div class="col-2 property_products"><b>{ label_status }</b> : { array_status[#products->StatusId] }</div>
            <div class="col-1 property_products"></div>
            <div class="col-2 property_products"><b>{ label_type }</b> : { array_type[#products->TypeId] }</div>
            <div class="col-2 property_products"><b>{ label_year }</b> : { array_year[#products->YearId] }</div>
            <div class="col-2 property_products"><b>{ label_rims }</b> : { array_rims[#products->RimsId] }</div>
            <div class="col-2 property_products"><b>{ label_frame }</b> : { array_frame[#products->FrameId] }</div>
            <div class="col-1 property_products"></div>
            <div class="col-1 property_products"><b>{ label_comment }</b> : { products->Comment }</div>
            <div class="col-1 property_products"></div>
            <div class="col-2 property_products"><b>{ label_added_date }</b> : @full_date_format (#products->AddedDate)</div>
            <div class="col-2 property_products"><b>{ label_added_name }</b> : { products->AddedName }</div>
            <div class="col-2 property_products"><b>{ label_modify_date }</b> : @full_date_format (#products->ModifyDate)</div>
            <div class="col-2 property_products"><b>{ label_modify_name }</b> : { products->ModifyName }</div>

            <div class="col-2 property_products"><b>{ text_purchases_invoices }</b></div>
            <table class="display preview-products table-custom" style="font-size: 14px;width: 100%;">
                <thead>
                    <tr>
                        <th width="50px">{ text_purchase_id }</th>
                        <th>{ text_quantity }</th>
                        <th>{ text_payment_type }</th>
                        <th>{ text_payment_status }</th>
                        <th>{ text_OrderDelivered }</th>
                        <th>{ text_created_date }</th>
                        <th>{ text_modify_date }</th>
                        <th>{ text_comment }</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (#Purchases as $Purchase)
                        <tr>
                            <td><a href="/Purchases/Edit/?id={! $Purchase->InvoiceId !}" data-top-title="{ title_edit }">{! $Purchase->InvoiceId !}</a></td>
                            <td>{! self::format_quantity($Purchase->QuantityPurchases) !}</td>
                            <td>
                                @if ((\Store\Models\PurchasesInvoicesModel::getColByKey('PaymentType',$Purchase->InvoiceId)) == 1)
                                    Terminal
                                @else
                                    @if ((\Store\Models\PurchasesInvoicesModel::getColByKey('PaymentType',$Purchase->InvoiceId)) == 2)
                                        Gotówka
                                    @else
                                        @if ((\Store\Models\PurchasesInvoicesModel::getColByKey('PaymentType',$Purchase->InvoiceId)) == 3)
                                            Przelew
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if ((\Store\Models\PurchasesInvoicesModel::getColByKey('PaymentStatus',$Purchase->InvoiceId)) == 0)
                                    niezapłacone
                                @else
                                    @if ((\Store\Models\PurchasesInvoicesModel::getColByKey('PaymentStatus',$Purchase->InvoiceId)) == 1)
                                        zapłacone
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if ((\Store\Models\PurchasesInvoicesModel::getColByKey('OrderDelivered',$Purchase->InvoiceId)) == 1)
                                    nie
                                @else
                                    @if ((\Store\Models\PurchasesInvoicesModel::getColByKey('OrderDelivered',$Purchase->InvoiceId)) == 2)
                                        tak
                                    @endif
                                @endif
                            </td>
                            <td data-bottom-title="{ on_time } @time_format ($Purchase->CreatedDate)">@date_format ($Purchase->CreatedDate)</td>
                            <td data-bottom-title="{ on_time } @time_format ($Purchase->ModifyDate)">@date_format ($Purchase->ModifyDate) - {! Store\Models\PurchasesInvoicesModel::getColByKey('ModifyUser',$Purchase->InvoiceId) !}</td>
                            <td data-bottom-title="{! Store\Models\PurchasesInvoicesModel::getColByKey('Comment',$Purchase->InvoiceId) !}">INFO</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col-2 property_products"><b>{ text_sales_invoices }</b></div>
            <table class="display preview-products table-custom" style="font-size: 14px;width: 100%;margin-bottom: 10px;">
                <thead>
                    <tr>
                        <th width="50px">{ text_purchase_id }</th>
                        <th>{ text_quantity }</th>
                        <th>{ text_payment_type }</th>
                        <th>{ text_payment_status }</th>
                        <th>{ text_created_date }</th>
                        <th>{ text_modify_date }</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (#Sales as $Sale)
                        <tr>
                            <td><a href="/Sales/Edit//?id={! $Sale->InvoiceId !}" data-top-title="{ title_edit }">{! $Sale->InvoiceId !}</a></td>
                            <td>{! self::format_quantity($Sale->QuantitySales) !}</td>
                            <td>
                                @if ((\Store\Models\SalesInvoicesModel::getColByKey('PaymentType',$Sale->InvoiceId)) == 1)
                                    Terminal
                                @else
                                    @if ((\Store\Models\SalesInvoicesModel::getColByKey('PaymentType',$Sale->InvoiceId)) == 2)
                                        Gotówka
                                    @else
                                        @if ((\Store\Models\SalesInvoicesModel::getColByKey('PaymentType',$Sale->InvoiceId)) == 3)
                                            Przelew
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if ((\Store\Models\SalesInvoicesModel::getColByKey('PaymentStatus',$Sale->InvoiceId)) == 0)
                                    niezapłacone
                                @else
                                    @if ((\Store\Models\SalesInvoicesModel::getColByKey('PaymentStatus',$Sale->InvoiceId)) == 1)
                                        zapłacone
                                    @endif
                                @endif
                            </td>
                            <td data-bottom-title="{ on_time } @time_format ($Sale->CreatedDate)">@date_format ($Sale->CreatedDate)</td>
                            <td data-bottom-title="{ on_time } @time_format ($Sale->ModifyDate)">@date_format ($Sale->ModifyDate) - {! Store\Models\SalesInvoicesModel::getColByKey('ModifyUser',$Sale->SaleId) !}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>