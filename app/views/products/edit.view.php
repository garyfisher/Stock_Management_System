<form class="f-row form-style products-create" method="post" autocomplete="off">
    <span class="form-title bn">{ text_title_form }</span>

    <div class="input-group-s col-md-down-1 col-lg-up-3 col-md-up-2">
        <label >{ label_kod }</label>
        <input type="text" name="kod" value="{ Products->kod }" min="3" max="240"  data-pattern="^[\w\(\):?!\-\,\.\/\' 0-9\u0600-\u06FF]{3,240}$" >
    </div>

    <div class="input-group-s col-md-down-1 col-lg-up-3 col-md-up-2">
        <label >{ label_title }</label>
        <input type="text" name="title" value="{ Products->Title }" min="3" max="240" >
    </div>

    <div class="input-group-s col-md-down-1 col-lg-up-3 col-md-up-2">
        <label>{ label_quantity_in }</label>
        <select name="unit_id">
            <option value="0" disabled selected>{ label_quantity_in }</option>
            @foreach (#Units as $key => $unit)
            <option value="{! $unit->UnitId !}" @if (#Products->UnitId == $unit->UnitId) selected @endif > {! $unit->Name !}</option>
            @endforeach
        </select>
    </div>

    <!-- <div class="input-group-s col-md-down-1 col-lg-up-3 col-md-up-2">
        <label >{ label_quantity }</label>
        <input type="text" name="quantity" value="@number_zero (#Products->Quantity)" max="10"  data-pattern="^[0-9]{1,16}(\.[0-9]{1,6})?$" >
    </div>


    <div class="input-group-s col-md-down-1 col-lg-up-3 col-md-up-2">
        <label >{ label_notification_quantity }</label>
        <input type="text" name="notification_quantity" value="@number_zero (#Products->NotificationQuantity)" max="10"  data-pattern="^[0-9]{1,16}(\.[0-9]{1,6})?$" >
    </div>


    @tax_allow
    <div class="input-group-s col-md-down-1 col-lg-up-3 col-md-up-2">
        <label >{ label_tax }</label>
        <input type="text" name="tax" value="@number_parse_inp (#Products->Tax,false)" max="10"  data-pattern="^[0-9]{1,18}(\.[0-9]{1,8})?$|^[0-9]{1,3}(\.[0-9]{1,2})?%$" >
    </div>
    @end -->

    <div class="input-group-s col-md-down-1 col-lg-up-3 col-md-up-2">
        <label >{ label_buy_price }</label>
        <input type="text" name="buy_price" value="@currency_input (#Products->BuyPrice)" max="25"  data-pattern="^[0-9]+(\.[0-9]{1,8})?$" >
    </div>

    <div class="input-group-s col-md-down-1 col-lg-up-3 col-md-up-2">
        <label >{ label_sell_price }</label>
        <input type="text" name="sell_price" value="@currency_input (#Products->SellPrice)" max="25"  data-pattern="^[0-9]+(\.[0-9]{1,8})?$" >
    </div>

    <div class="input-group-s col-md-down-1 col-lg-up-3 col-md-up-2">
        <label >{ label_promo_price }</label>
        <input type="text" name="promo_price" value="@currency_input (#Products->PromoPrice)" max="25" >
    </div>

    <!-- <div class="input-group-s col-md-down-1 col-lg-up-3 col-md-up-2">
        <label>{ label_made_country }</label>
        <select name="madeCountry">
            <option value="0" disabled selected>{ label_made_country }</option>
            @foreach (#countries as $key => $country) ?>
                <option value="{! $key !}"
                    @if (#Products->MadeCountry == $key)
                    selected @endif > {! $country !}
                </option>
            @endforeach
        </select>
    </div> -->

    <div class="input-group-s col-md-down-1 col-lg-up-3 col-md-up-2">
        <label>{ label_category_product }</label>
        <select name="categoryId" id="category">
            <option value="0" disabled selected>{ label_category_product }</option>
            @foreach (#Categories as $Category)
                @if ($Category->ProductCategoryParentId == 0)
                    <option value="{! $Category->ProductCategoryId; !}" @if (#Products->CategoryId == $Category->ProductCategoryId)
                        selected @endif >{! $Category->Name !}</option>
                @endif
            @endforeach
        </select>
    </div>

    <div class="input-group-s col-md-down-1 col-lg-up-3 col-md-up-2">
        <label>{ label_sub_category_product }</label>
        <select name="subcategoryId" id="subcategory">
            <option value="0" disabled selected>{ label_sub_category_product }</option>
            @foreach (#Categories as $Category)
                @if ($Category->ProductCategoryParentId > 0)
                    <option value="{! $Category->ProductCategoryId !}" class="subcat" id="{! $Category->ProductCategoryParentId; !}" @if (#Products->SubCategoryId == $Category->ProductCategoryId):
                        selected
                    @else
                        @if (#Products->CategoryId == $Category->ProductCategoryParentId)

                        @else
                            style="display: none;"
                        @endif
                    @endif > {! $this->getGet('name'); !} {! $Category->Name !} </option>
                @endif
            @endforeach
        </select>
    </div>

    <div class="input-group-s col-md-down-1 col-lg-up-3 col-md-up-2">
        <label>{ label_warehouse_product }</label>
        <select name="warehouseId">
            <option value="0" disabled selected>{ label_warehouse_product }</option>
            @foreach (#Warehouses as $Warehouse)
                <option value="{! $Warehouse->ProductWarehouseId; !}" @if (#Products->WarehouseId == $Warehouse->ProductWarehouseId)
                    selected @endif >{! $Warehouse->Name !}</option>
            @endforeach
        </select>
    </div>

    <div class="input-group-s col-md-down-1 col-lg-up-3 col-md-up-2">
        <label >{ label_barcode }</label>
        <input type="text" name="barcode" value="{ Products->Barcode }" id="barcode" >
    </div>

    <div class="input-group-s col-md-down-1 col-lg-up-3 col-md-up-2">
        <label >{ label_frame }</label>
        <select name="frameId">
            <option value="0" disabled selected>{ label_frame }</option>
            <option value="1" @if (#Products->FrameId == '1')
                selected @endif >{ array_frame[1] }</option>
            <option value="2" @if (#Products->FrameId == '2')
                selected @endif >{ array_frame[2] }</option>
            <option value="3" @if (#Products->FrameId == '3')
                selected @endif >{ array_frame[3] }</option>
            <option value="4" @if (#Products->FrameId == '4')
                selected @endif >{ array_frame[4] }</option>
            <option value="5" @if (#Products->FrameId == '5')
                selected @endif >{ array_frame[5] }</option>
            <option value="6" @if (#Products->FrameId == '6')
                selected @endif >{ array_frame[6] }</option>
            <option value="7" @if (#Products->FrameId == '7')
                selected @endif >{ array_frame[7] }</option>
            <option value="8" @if (#Products->FrameId == '8')
                selected @endif >{ array_frame[8] }</option>
            <option value="9" @if (#Products->FrameId == '9')
                selected @endif >{ array_frame[9] }</option>
            <option value="10" @if (#Products->FrameId == '10')
                selected @endif >{ array_frame[10] }</option>
            <option value="11" @if (#Products->FrameId == '11')
                selected @endif >{ array_frame[11] }</option>
            <option value="12" @if (#Products->FrameId == '12')
                selected @endif >{ array_frame[12] }</option>
            <option value="13" @if (#Products->FrameId == '13')
                selected @endif >{ array_frame[13] }</option>
            <option value="14" @if (#Products->FrameId == '14')
                selected @endif >{ array_frame[14] }</option>
            <option value="15" @if (#Products->FrameId == '15')
                selected @endif >{ array_frame[15] }</option>
            <option value="16" @if (#Products->FrameId == '16')
                selected @endif >{ array_frame[16] }</option>
            <option value="17" @if (#Products->FrameId == '17')
                selected @endif >{ array_frame[17] }</option>
            <option value="18" @if (#Products->FrameId == '18')
                selected @endif >{ array_frame[18] }</option>
            <option value="19" @if (#Products->FrameId == '19')
                selected @endif >{ array_frame[19] }</option>
            <option value="20" @if (#Products->FrameId == '20')
                selected @endif >{ array_frame[20] }</option>
            <option value="21" @if (#Products->FrameId == '21')
                selected @endif >{ array_frame[21] }</option>
            <option value="22" @if (#Products->FrameId == '22')
                selected @endif >{ array_frame[22] }</option>
            <option value="23" @if (#Products->FrameId == '23')
                selected @endif >{ array_frame[23] }</option>
            <option value="24" @if (#Products->FrameId == '24')
                selected @endif >{ array_frame[24] }</option>
            <option value="25" @if (#Products->FrameId == '25')
                selected @endif >{ array_frame[25] }</option>
            <option value="26" @if (#Products->FrameId == '26')
                selected @endif >{ array_frame[26] }</option>
            <option value="27" @if (#Products->FrameId == '27')
                selected @endif >{ array_frame[27] }</option>
            <option value="28" @if (#Products->FrameId == '28')
                selected @endif >{ array_frame[28] }</option>
            <option value="29" @if (#Products->FrameId == '29')
                selected @endif >{ array_frame[29] }</option>
            <option value="30" @if (#Products->FrameId == '30')
                selected @endif >{ array_frame[30] }</option>
            <option value="31" @if (#Products->FrameId == '31')
                selected @endif >{ array_frame[31] }</option>
            <option value="32" @if (#Products->FrameId == '32')
                selected @endif >{ array_frame[32] }</option>
            <option value="33" @if (#Products->FrameId == '33')
                selected @endif >{ array_frame[33] }</option>
            <option value="34" @if (#Products->FrameId == '34')
                selected @endif >{ array_frame[34] }</option>
        </select>
    </div>

    <div class="input-group-s col-md-down-1 col-lg-up-3 col-md-up-2">
        <label >{ label_rims }</label>
        <select name="rimsId">
            <option value="0" disabled selected>{ label_rims }</option>
            <option value="1" @if (#Products->RimsId == '1')
                selected @endif >{ array_rims[1] }</option>
            <option value="2" @if (#Products->RimsId == '2')
                selected @endif >{ array_rims[2] }</option>
            <option value="3" @if (#Products->RimsId == '3')
                selected @endif >{ array_rims[3] }</option>
            <option value="4" @if (#Products->RimsId == '4')
                selected @endif >{ array_rims[4] }</option>
            <option value="5" @if (#Products->RimsId == '5')
                selected @endif >{ array_rims[5] }</option>
            <option value="6" @if (#Products->RimsId == '6')
                selected @endif >{ array_rims[6] }</option>
            <option value="7" @if (#Products->RimsId == '7')
                selected @endif >{ array_rims[7] }</option>
            <option value="8" @if (#Products->RimsId == '8')
                selected @endif >{ array_rims[8] }</option>
            <option value="9" @if (#Products->RimsId == '9')
                selected @endif >{ array_rims[9] }</option>
        </select>
    </div>

    <div class="input-group-s col-md-down-1 col-lg-up-3 col-md-up-2">
        <label >{ label_year }</label>
        <select name="yearId">
            <option value="0" disabled selected>{ label_year }</option>
            <option value="7" @if (#Products->YearId == '7')
                selected @endif >{ array_year[7] }</option>
            <option value="1" @if (#Products->YearId == '1')
                selected @endif >{ array_year[1] }</option>
            <option value="2" @if (#Products->YearId == '2')
                selected @endif >{ array_year[2] }</option>
            <option value="3" @if (#Products->YearId == '3')
                selected @endif >{ array_year[3] }</option>
            <option value="4" @if (#Products->YearId == '4')
                selected @endif >{ array_year[4] }</option>
            <option value="5" @if (#Products->YearId == '5')
                selected @endif >{ array_year[5] }</option>
            <option value="6" @if (#Products->YearId == '6')
                selected @endif >{ array_year[6] }</option>
        </select>
    </div>

    <div class="input-group-s col-md-down-1 col-lg-up-3 col-md-up-2">
        <label >{ label_type }</label>
        <select name="typeId">
            <option value="0" disabled selected>{ label_type }</option>
            <option value="1" @if (#Products->TypeId == '1')
                selected @endif >{ array_type[1] }</option>
            <option value="2" @if (#Products->TypeId == '2')
                selected @endif >{ array_type[2] }</option>
            <option value="3" @if (#Products->TypeId == '3')
                selected @endif >{ array_type[3] }</option>
            <option value="4" @if (#Products->TypeId == '4')
                selected @endif >{ array_type[4] }</option>
        </select>
    </div>

    <div class="input-group-s col-md-down-1 col-lg-up-3 col-md-up-2">
        <label >{ label_www }</label>
        <select name="wwwId">
            <option value="0" disabled selected>{ label_www }</option>
            <option value="1" @if (#Products->WwwId == '1')
                selected @endif >{ array_www[1] }</option>
            <option value="2" @if (#Products->WwwId == '2')
                selected @endif >{ array_www[2] }</option>
        </select>
    </div>

    <div class="input-group-s col-md-down-1 col-lg-up-3 col-md-up-2">
        <label >{ label_www_url }</label>
        <input type="text" name="wwwurl" value="{ Products->WwwUrl }" min="3" max="1000" >
    </div>

    <div class="input-group-s col-md-down-1 col-lg-up-3 col-md-up-2">
        <label >{ label_allegro }</label>
        <input type="text" name="allegro" value="{ Products->Allegro }" min="9" max="12" >
    </div>

    <div class="input-group-s col-md-down-1 col-lg-up-3 col-md-up-2">
        <label >{ label_status }</label>
        <select name="statusId">
            <option value="0" disabled selected>{ label_status }</option>
            <option value="1" @if (#Products->StatusId == '1')
                selected @endif >{ array_status[1] }</option>
            <option value="2" @if (#Products->StatusId == '2')
                selected @endif >{ array_status[2] }</option>
            <option value="3" @if (#Products->StatusId == '3')
                selected @endif >{ array_status[3] }</option>
        </select>
    </div>

    <div class="input-group-s col-md-down-1 col-lg-up-3 col-md-up-2">
        <label >{ label_reservation }</label>
        <select name="reservationId">
            <option value="0" disabled selected>{ label_reservation }</option>
            <option value="1" @if (#Products->ReservationId == '1')
                selected @endif >{ array_reservation[1] }</option>
            <option value="2" @if (#Products->ReservationId == '2')
                selected @endif >{ array_reservation[2] }</option>
        </select>
    </div>

    <div class="input-group-s col-md-down-1 col-lg-up-3 col-md-up-2">
        <label >{ label_quantity_reservation }</label>
        <input type="text" name="quantityreservation" value="@number_zero (#Products->QuantityReservation)" max="10"  data-pattern="^[0-9]{1,16}(\.[0-9]{1,6})?$" >
    </div>

    <div class="input-group-s col-md-down-1 col-lg-up-1 col-md-up-1">
        <label >{ label_comment }</label>
        <input type="text" name="comment" value="{ Products->Comment }" min="3" max="1000" >
    </div>

    <div class="input-submit-p">
        <input type="submit" class="bn b-primary-submit" name="submit" value="{ text_save }" >
    </div>


</form>